<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Models\Teacher;
use App\Models\User;
use App\Services\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    public function index()
    {
        $page_data['teachers'] = User::with('teacher')
            ->where('role_id', getRoleId('teacher'))
            ->orderByDesc('id')
            ->paginate(20);

        return view('backend::admin.users.teachers.index', $page_data);
    }

    public function create()
    {
        $page_data['school'] = auth()->user()->school_id;
        $page_data['shifts'] = Shift::get();
        return view('backend::admin.users.teachers.create', $page_data);
    }
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name'              => 'required|string|max:255',
            'phone'             => 'required|string|max:30',
            'email'             => 'required|string|email|max:255|unique:users',
            'password'          => 'required|string|min:8',
            'present_address'   => 'required|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'photo'             => 'required|image|mimes:' . allowedFileExt() . '|max:' . allowedFileSize(),
            'documents'         => 'nullable|array',
            'nid'               => 'nullable|string|max:255',
            'experience'        => 'nullable|string|max:255',
            'gender'            => 'required|string|in:male,female,other',
            'education'         => 'nullable|string|max:255',
            'father_name'       => 'nullable|string|max:255',
            'religion'          => 'nullable|string|max:255',
            'blood_group'       => 'nullable|string',
            'dob'               => 'required|date',
            'joining_date'      => 'required|date',
            'monthly_salary'    => 'nullable|numeric',
            'status'            => 'required|boolean',
            'shift_id'          => 'required|integer|exists:shifts,id',
        ]);

        // Upload photo
        if ($request->hasFile('photo')) {
            $validation['photo'] = FileUploader::upload($request->file('photo'), 'teachers/photo');
        }

        $doc = [];

        if (! empty($validation['documents'])) {
            foreach ($validation['documents'] as $document) {
                $doc[] = FileUploader::upload($document, 'teachers/documents');
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
            'role_id'           => getRoleId('teacher'),
            'photo'             => $validation['photo'],
            'nid'               => $validation['nid'],
            'gender'            => $validation['gender'],
            'religion'          => $validation['religion'],
            'blood_group'       => $validation['blood_group'],
            'dob'               => $validation['dob'],
        ]);
        $teachers = Teacher::create([
            'school_id'      => getSchoolId(),
            'user_id'        => $user->id,
            'education'      => $validation['education'],
            'father_name'    => $validation['father_name'],
            'documents'      => $doc,
            'experience'     => $validation['experience'],
            'monthly_salary' => $validation['monthly_salary'],
            'joining_date'   => $validation['joining_date'],
            'status'         => $validation['status'],
            'shift_id'       => $validation['shift_id'],
        ]);
        return redirect()->route('teachers')->with('success', 'Teacher created successfully');

    }

    public function edit($id)
    {
        $page_data['teacher'] = User::with('teacher')->where('role_id', getRoleId('teacher'))->findOrFail($id);
        $page_data['shifts']  = Shift::get();
        return view('app.backend.admin.users.teachers.edit', $page_data);
    }

    public function update(Request $request, $id)
    {
        $user    = User::with('teacher')->where('role_id', getRoleId('teacher'))->findOrFail($id);
        $teacher = $user->teacher;

        $validation = $request->validate([
            'name'              => 'required|string|max:255',
            'phone'             => 'required|string|max:30',
            'email'             => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'present_address'   => 'required|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'photo'             => 'nullable|image|mimes:' . allowedFileExt() . '|max:' . allowedFileSize(),
            'documents'         => 'nullable|array',
            'nid'               => 'nullable|string|max:255',
            'experience'        => 'nullable|string|max:255',
            'gender'            => 'required|string|in:male,female,other',
            'education'         => 'nullable|string|max:255',
            'father_name'       => 'nullable|string|max:255',
            'religion'          => 'nullable|string|max:255',
            'blood_group'       => 'nullable|string',
            'dob'               => 'required|date',
            'joining_date'      => 'required|date',
            'monthly_salary'    => 'nullable|numeric',
            'status'            => 'required|boolean',
            'shift_id'          => 'required|integer|exists:shifts,id',

        ]);

        // Photo upload
        if ($request->hasFile('photo')) {
            $validation['photo'] = FileUploader::upload($request->file('photo'), 'teachers/photo');
        } else {
            $validation['photo'] = $user->photo;
        }

        // Documents upload
        $doc = $teacher->documents ?? [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $document) {
                $doc[] = FileUploader::upload($document, 'teachers/documents');
            }
        }

        // Update User
        $user->update([
            'name'              => $validation['name'],
            'email'             => $validation['email'],
            'phone'             => $validation['phone'],
            'present_address'   => $validation['present_address'],
            'permanent_address' => $validation['permanent_address'],
            'nid'               => $validation['nid'],
            'gender'            => $validation['gender'],
            'religion'          => $validation['religion'],
            'blood_group'       => $validation['blood_group'],
            'dob'               => $validation['dob'],
            'photo'             => $validation['photo'],
        ]);

        // Update Teacher
        $teacher->update([
            'education'      => $validation['education'],
            'father_name'    => $validation['father_name'],
            'documents'      => $doc,
            'experience'     => $validation['experience'],
            'monthly_salary' => $validation['monthly_salary'],
            'joining_date'   => $validation['joining_date'],
            'status'         => $validation['status'],
            'shift_id'       => $validation['shift_id'],
        ]);

        return redirect()->route('teachers')->with('success', 'Teacher updated successfully');
    }

    // View data show
    public function view($id)
    {
        $page_data['teacher'] = User::with('teacher')->where('role_id', getRoleId('teacher'))->findOrFail($id);
        $page_data['shifts']  = Shift::get();
        return view('app.backend.admin.users.teachers.view', $page_data);
    }

    // View data store

    public function delete($id)
    {
        $user = User::with('teacher')->where('role_id', getRoleId('teacher'))->findOrFail($id);
        $user->teacher()->delete();
        $user->delete();

        return goBack('success', 'Teacher deleted successfully');
    }

}
