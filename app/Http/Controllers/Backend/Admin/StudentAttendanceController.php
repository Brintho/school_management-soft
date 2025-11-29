<?php
namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class StudentAttendanceController extends Controller
{
    public function index()
    {

        $page_data['classes']  = Classes::where("school_id", )->get();
        $page_data['sections'] = Section::where("school_id", )->get();
        $page_data['subjects'] = Subject::where("school_id", )->get();
        $page_data['students'] = User::with('student')
            ->where('role_id', getRoleId('student'))
            ->where('school_id', )
            ->get();

        return view('backend::admin.attendance.student.filter', $page_data);
    }

    public function filter(Request $request)
    {
        $students = User::with('student')
            ->where('role_id', getRoleId('student'));

        // class filter
        if ($request->class_id) {
            $students->whereHas('student', function ($q) use ($request) {
                $q->where('class_id', $request->class_id);
            });
        }

        // section filter
        if ($request->section_id) {
            $students->whereHas('student', function ($q) use ($request) {
                $q->where('section_id', $request->section_id);
            });
        }

        // Ajax হলে JSON return করো
        if ($request->ajax()) {
            return response()->json([
                'students' => $students->get(),
            ]);
        }

        // Normal GET হলে view return
        $page_data['classes']  = Classes::where("school_id", auth()->user()->school_id)->get();
        $page_data['sections'] = Section::where("school_id", auth()->user()->school_id)->get();
        $page_data['students'] = $students->get();

        return view('backend::admin.attendance.student.filter', $page_data);
    }

}
