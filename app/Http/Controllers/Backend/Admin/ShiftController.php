<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        $page_data['shifts'] = Shift::orderBy("created_at", "desc")->paginate(20);
        return view('backend::admin.shift.index', $page_data);
    }

    public function store(Request $request)
    {
        $request->merge(['slug' => slugify($request->name)]);
        $validation = $request->validate([
            'name'   => 'required|string|max:255',
            'slug'   => 'required|string|max:255|unique:shifts,slug',
            'status' => 'required|boolean',
        ]);
        $validation['school_id'] = getSchoolId();
        Shift::create($validation);

        return goBack('success', translate('Shift created successfully.'));
    }

    public function update(Request $request, $id)
    {
        $shift = Shift::findOrFail($id);
        $request->merge(['slug' => slugify($request->name)]);
        $validation = $request->validate([
            'name'   => 'required|string|max:255',
            'slug'   => 'required|string|max:255|unique:shifts,slug,' . $id,
            'status' => 'required|boolean',
        ]);
        $validation['school_id'] = getSchoolId();
        $shift->update($validation);

        return goBack('success', translate('Shift updated successfully.'));
    }

    public function delete($id)
    {
        $shift = Shift::findOrFail($id);
        $shift->delete();

        return goBack('success', translate('Shift deleted successfully.'));
    }
}
