<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\School;
use App\Models\Section;
use App\Models\Shift;
use App\Models\Student;
use App\Models\User;
use App\Services\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        $page_data['students'] = User::with(['student.class', 'student.section', 'student.shift'])
            ->where('role_id', getRoleId('student'))
            ->whereHas('student')
            ->orderByDesc('id')
            ->paginate(20);

        return view('backend::admin.users.students.index', $page_data);
    }

    public function create()
    {
        $page_data = [
            'shifts'  => Shift::get(),
            'schools' => School::get(),
        ];

        return view('backend::admin.users.students.create', $page_data);
    }

    public function store(Request $request)
    {

        $validation = $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|string|min:8',
            'phone'             => 'required|string|max:30',
            'mother_name'       => 'required|string|max:255',
            'father_name'       => 'nullable|string|max:255',
            'present_address'   => 'required|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'photo'             => 'required|image|mimes:' . allowedFileExt() . '|max:' . allowedFileSize(),
            'documents'         => 'nullable|array',
            'gender'            => 'required|string|in:male,female,other',
            'class_id'          => 'required|integer|exists:classes,id',
            'section_id'        => 'nullable|integer|exists:sections,id',
            'shift_id'          => 'required|integer|exists:shifts,id',
            'unique_id'         => 'required|string|max:20|unique:students,unique_id',
            'guardian_number'   => 'required|string|max:30',
            'additional_info'   => 'nullable|string',
            'dob'               => 'required|date',
            'blood_group'       => 'nullable|string',
            'post_code'         => 'nullable|string',
            'brn'               => 'nullable|string',
            'status'            => 'required|boolean',
        ]);
        if ($request->hasFile('photo')) {
            $validation['photo'] = FileUploader::upload($request->file('photo'), 'students/photo');
        } else {
            $validation['photo'] = null;
        }

        $doc = [];

        if (! empty($validation['documents'])) {
            foreach ($validation['documents'] as $document) {
                $doc[] = FileUploader::upload($document, 'students/documents');
            }
        }

        $user = User::create([
            'school_id'         => getSchoolId(),
            'username'          => Str::random(10),
            'name'              => $validation['name'],
            'email'             => $validation['email'],
            'phone'             => $validation['phone'],
            'password'          => Hash::make($request->password),
            'present_address'   => $validation['present_address'],
            'permanent_address' => $validation['permanent_address'],
            'role_id'           => getRoleId('student'),
            'photo'             => $validation['photo'],
            'gender'            => $validation['gender'],
            // 'religion'          => $validation['religion'],
            'blood_group'       => $validation['blood_group'],
            'dob'               => $validation['dob'],
            'post_code'         => $validation['post_code'],
            'brn'               => $validation['brn'],
            'status'            => $validation['status'],
        ]);

        $student = Student::create([
            'mother_name'     => $validation['mother_name'],
            'father_name'     => $validation['father_name'],
            'documents'       => $doc,
            'user_id'         => $user->id,
            'school_id'       => getSchoolId(),
            'class_id'        => $validation['class_id'],
            'section_id'      => $validation['section_id'],
            'shift_id'        => $validation['shift_id'],
            'unique_id'       => $validation['unique_id'],
            'guardian_number' => $validation['guardian_number'],
            'additional_info' => $validation['additional_info'],

        ]);
        return redirect()->route('students')->with('success', 'Student created successfully');

    }

    public function edit($id)
    {
        $student = Student::with('user')->findOrFail($id);

        $page_data['student']         = $student->user;
        $page_data['student_details'] = $student; // extra
        $page_data['classes']         = Classes::get();
        $page_data['sections']        = Section::where('class_id', $student->class_id)->get();
        $page_data['shifts']          = Shift::get();

        return view('backend::admin.users.students.edit', $page_data);
    }

    public function update(Request $request, $id)
    {

        $student = Student::with('user')->where('user_id', $id)->firstOrFail();

        $user = $student->user;

        // Validation
        $validation = $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email,' . $user->id,
            'phone'             => 'required|string|max:30',
            'mother_name'       => 'required|string|max:255',
            'father_name'       => 'nullable|string|max:255',
            'present_address'   => 'required|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'photo'             => 'nullable|image|mimes:' . allowedFileExt() . '|max:' . allowedFileSize(),
            'documents'         => 'nullable|array',
            'gender'            => 'required|string|in:male,female,other',
            'class_id'          => 'required|integer|exists:classes,id',
            'section_id'        => 'nullable|integer|exists:sections,id',
            'shift_id'          => 'required|integer|exists:shifts,id',
            'unique_id'         => 'required|string|max:20|unique:students,unique_id,' . $student->id,
            'guardian_number'   => 'required|string|max:30',
            'additional_info'   => 'nullable|string',
            'dob'               => 'required|date',
            'blood_group'       => 'nullable|string',
            'post_code'         => 'nullable|string',
            'brn'               => 'nullable|string',
            'status'            => 'required|boolean',
        ]);
        // Photo update
        if ($request->hasFile('photo')) {
            $validation['photo'] = FileUploader::upload($request->file('photo'), 'students/photo');
        } else {
            $validation['photo'] = $user->photo;
        }

        // Documents update
        $doc = $student->documents ?? [];

        if (! empty($validation['documents'])) {
            foreach ($validation['documents'] as $document) {
                $doc[] = FileUploader::upload($document, 'students/documents');
            }
        }

        // UPDATE USER table
        $user->update([
            'name'              => $validation['name'],
            'email'             => $validation['email'],
            'phone'             => $validation['phone'],
            'present_address'   => $validation['present_address'],
            'permanent_address' => $validation['permanent_address'],
            'photo'             => $validation['photo'],
            'gender'            => $validation['gender'],
            'blood_group'       => $validation['blood_group'],
            'dob'               => $validation['dob'],
            'post_code'         => $validation['post_code'],
            'brn'               => $validation['brn'],
            'status'            => $validation['status'],
        ]);

        // UPDATE STUDENT table
        $student->update([
            'mother_name'     => $validation['mother_name'],
            'father_name'     => $validation['father_name'],
            'documents'       => $doc,
            'class_id'        => $validation['class_id'],
            'section_id'      => $validation['section_id'],
            'shift_id'        => $validation['shift_id'],
            'unique_id'       => $validation['unique_id'],
            'guardian_number' => $validation['guardian_number'],
            'additional_info' => $validation['additional_info'],
        ]);

        return redirect()->route('students')->with('success', 'Student updated successfully');
    }

    public function delete($id)
    {
        $student = Student::with('user')->findOrFail($id);
        if ($student->user) {
            $student->user->delete();
        }
        $student->delete();

        return goBack('success', 'Student deleted successfully');
    }

}
