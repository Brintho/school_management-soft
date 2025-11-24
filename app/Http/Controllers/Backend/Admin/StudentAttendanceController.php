<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Routine;
use App\Models\StudentAttendanceFilter;
use Illuminate\Http\Request;

class StudentAttendanceController extends Controller
{
    public function filter()
    {
        $query = Routine::query()->with(['classes', 'section', 'subject']);

        if (auth()->user()->role_id == getRoleId('teacher')) {
            $query->where('teacher_id', auth()->id());
        }

        $page_date['data'] = $query->get();
        return view('backend::admin.attendance.student.filter', $page_date);
    }

    public function store(Request $request)
    {
        $filter = StudentAttendanceFilter::create([
            'school_id'  => getSchoolId(),
            'routine_id' => $request->routine_id,
            'date'       => $request->date,
        ]);

        return redirect()->route('attendance')->with('success', 'Filter created successfully');
    }

    public function index()
    {
        $page_date['data'] = StudentAttendanceFilter::where('school_id', getSchoolId())->get();
        return view('backend::admin.attendance.student.index', $page_date);
    }
}
