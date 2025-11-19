<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $page_data['sections'] = Section::with('classes')->orderBy("created_at", "desc")->paginate(20);
        return view('backend::admin.sections.index', $page_data);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'      => 'required|string|max:100',
            'school_id' => 'nullable|exists:schools,id',
            'class_id'  => 'nullable|exists:classes,id',
        ]);

        Section::create([
            'name'      => $validate['name'],
            'school_id' => getSchoolId(),
            'class_id'  => $validate['class_id'],
        ]);
        return goBack('success', 'Section created successfully');
    }

    public function update(Request $request, $id)
    {
        $section = Section::findOrFail($id);

        $validate = $request->validate([
            'name'      => 'required|string|max:100',
            'school_id' => 'nullable|exists:schools,id',
            'class_id'  => 'nullable|exists:classes,id',
        ]);

        $section->update([
            'name'      => $validate['name'],
            'school_id' => $validate['school_id'] ?? getSchoolId(),
            'class_id'  => $validate['class_id'],
        ]);

        return goBack('success', 'Section updated successfully');
    }

    public function delete($id)
    {
        Section::findOrFail($id)->delete();
        return goBack('success', 'Section deleted successfully');
    }

    public function getSections(Request $request)
    {
        $class_id = $request->class_id;
        $sections = Section::where('class_id', $class_id)->get();

        return response()->json(['sections' => $sections]);
    }

}
