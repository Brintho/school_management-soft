<?php
namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Routine;
use Illuminate\Http\Request;

class RoutineController extends Controller
{
    /**
     * Display all routines
     */
    public function index()
    {
        $routines = Routine::with(['classes', 'section', 'subject', 'teacher', 'room'])
            ->orderBy('day')
            ->get()
            ->groupBy('day'); // day অনুযায়ী group করা

        $days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        return view('backend::admin.routines.index', compact('routines', 'days'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id'         => 'required|exists:classes,id',
            'section_id'       => 'nullable|exists:sections,id',
            'subject_id'       => 'required|exists:subjects,id',
            'teacher_id'       => 'required|exists:users,id',
            'proxy_teacher_id' => 'nullable|exists:users,id',
            'room_id'          => 'required|exists:rooms,id',
            'date'             => 'required|date_format:Y-m-d',
            'day'              => 'required|string',
            'class_start'      => 'required|date_format:H:i',
            'class_end'        => 'required|date_format:H:i|after:class_start',
            'status'           => 'required|boolean',
        ]);

        $exists = Routine::where('class_id', $request->class_id)
            ->where('section_id', $request->section_id)
            ->where('subject_id', $request->subject_id)
            ->where('day', $request->day)
            ->where('date', $request->date)
            ->first();

        if ($exists) {
            return back()->withErrors(['duplicate' => 'Routine for this class, section, subject, and day already exists.'])->withInput();
        }

        Routine::create($request->all());

        return goBack('success', 'Routine created successfully.');
    }

    /**
     * Show form to edit routine
     */
    // public function edit($id)
    // {
    //     $routine  = Routine::findOrFail($id);
    //     $classes  = Classes::where('status', 1)->get();
    //     $sections = Section::where('status', 1)->get();
    //     $subjects = Subject::where('status', 1)->get();
    //     $teachers = Teacher::where('status', 1)->get();
    //     $rooms    = Room::where('status', 1)->get();
    //     $shifts   = Shift::where('status', 1)->get();

    //     return view('backend.admin.routines.edit', compact('routine', 'classes', 'sections', 'subjects', 'teachers', 'rooms', 'shifts'));
    // }

    /**
     * Update routine
     */
    public function update(Request $request, $id)
    {
        $routine = Routine::findOrFail($id);

        $validated = $request->validate([
            'class_id'         => 'required|exists:classes,id',
            'section_id'       => 'required|exists:sections,id',
            'subject_id'       => 'required|exists:subjects,id',
            'teacher_id'       => 'required|exists:teachers,id',
            'proxy_teacher_id' => 'nullable|exists:teachers,id',
            'room_id'          => 'required|exists:rooms,id',
            'shift_id'         => 'required|exists:shifts,id',
            'day'              => 'required|string',
            'class_start'      => 'required|date_format:H:i',
            'class_end'        => 'required|date_format:H:i|after:class_start',
            'status'           => 'required|boolean',
        ]);

        $routine->update($validated);

        return redirect()->route('routines.index')->with('success', 'Routine updated successfully.');
    }

    /**
     * Delete routine
     */
    public function delete($id)
    {
        $routine = Routine::findOrFail($id);
        $routine->delete();

        return goBack('success', 'Routine deleted successfully.');
    }
}
