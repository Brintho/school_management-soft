<?php
namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $page_data['subjects'] = Subject::orderBy("created_at", "desc")->paginate(20);
        return view('backend::admin.subjects.index', $page_data);

    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'name'     => 'required|string|max:255',
            'category' => 'required|in:compulsory,optional',
            'marks'    => 'required|integer|min:1|max:100',
            'status'   => 'required|boolean',
        ]);

        $subject = Subject::create($validation);
        return goBack('success', 'Subject created successfully');
    }

    public function update(Request $request, $id)
    {
        $subject    = Subject::findOrFail($id);
        $validation = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'name'     => 'required|string|max:255',
            'category' => 'required|in:compulsory,optional',
            'marks'    => 'required|integer|min:1|max:100',
            'status'   => 'required|boolean',
        ]);

        $subject->update($validation);
        return goBack('success', 'Subject updated successfully');
    }

    public function delete($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return goBack('success', 'Subject deleted successfully');
    }

    public function getSubjects(Request $request)
    {
        $class_id = $request->class_id;

        $subjects = Subject::where('class_id', $class_id)
            ->where('status', 1)
            ->get();

        return response()->json(['subjects' => $subjects]);
    }

}
