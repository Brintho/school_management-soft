<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Section;
use App\Models\User;
use App\Notifications\WelcomeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ClassController extends Controller
{
    public function index()
    {
        $page_data['classes'] = Classes::with('sections')->orderBy("created_at", "desc")->paginate(20);
        return view('backend::admin.classes.index', $page_data);

    }

    public function store(Request $request)
    {
        $request->merge(['slug' => slugify($request->name)]);
        $validate = $request->validate([
            'name'        => 'required|string|max:100',
            'slug'        => 'required|string|max:100|unique:classes,slug',
            'capacity'    => 'nullable|integer|min:1|max:500',
            'class_code'  => 'nullable|string|max:20|unique:classes,class_code,',
            'description' => 'nullable|string|max:100',
            'status'      => 'required|boolean',
        ]);
        $validate['school_id'] = getSchoolId();
        $class                 = Classes::create($validate);
        return redirect()->route('classes')->with('success', 'Class created successfully');

    }
    public function update(Request $request, $id)
    {
        $class = Classes::findOrFail($id);
        $request->merge(['slug' => slugify($request->name)]);
        $validate = $request->validate([
            'name'        => 'required|string|max:100',
            'slug'        => 'required|string|max:100|unique:classes,slug,' . $id,
            'capacity'    => 'nullable|integer|min:1|max:500',
            'description' => 'nullable|string|max:225',
            'class_code'  => 'nullable|string|max:20|unique:classes,class_code,' . $id,
            'status'      => 'required|boolean',
        ]);
        $validate['school_id'] = getSchoolId();
        $class->update($validate);
        return redirect()->route('classes')->with('success', 'Class Update successfully');

    }

    public function delete($id)
    {
        $class = Classes::findOrFail($id);
        $class->delete();
        return redirect()->route('classes')->with('success', 'Class deleted successfully');
    }
}
