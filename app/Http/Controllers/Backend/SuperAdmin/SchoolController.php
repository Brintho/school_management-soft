<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\User;
use App\Services\FileUploader;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SchoolController extends Controller
{
    public function index()
    {
        $page_data['schools'] = School::orderBy("id", "desc")->paginate(20);
        return view('app.superadmin.school.index', $page_data);
    }

    public function create()
    {
        return view('app.superadmin.school.create');
    }

    public function edit($id)
    {
        $page_data['school'] = School::findOrFail($id);
        return view('app.superadmin.school.edit', $page_data);
    }
    public function store(Request $request)
    {
        $request->merge(['slug' => slugify($request->school_name)]);

        $validated = $request->validate([
            'school_name'        => 'required|string|max:255',
            'slug'               => 'required|string|max:255|unique:schools,slug',
            'code'               => 'required|string|max:100',
            'email'              => 'nullable|email|max:255|unique:schools,email',
            'phone'              => 'nullable|string|max:30',
            'admin_email'        => 'required|email|max:255|unique:schools,admin_email',
            'admin_password'     => 'required|string|min:8',
            'alternative_phone'  => 'nullable|string|max:30',
            'institute_type_id'  => 'nullable|integer',
            'logo'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'website'            => 'nullable|string|max:255',
            'present_address'    => 'nullable|string',
            'permanent_address'  => 'nullable|string',
            'city'               => 'nullable|string|max:100',
            'state'              => 'nullable|string|max:100',
            'country'            => 'nullable|string|max:100',
            'zipcode'            => 'nullable|string|max:20',
            'lat'                => 'nullable|string|max:50',
            'lng'                => 'nullable|string|max:50',
            'is_admission_going' => 'required|boolean',
            'status'             => 'required|string|in:pending,active,inactive',
        ]);
        if ($request->hasFile('logo')) {
            $validated['logo'] = FileUploader::upload($request->file('logo'), 'schools/logo');
        }

        $validated['admin_password'] = Hash::make($validated['admin_password']);

        $school = School::create($validated);
        User::create([
            'username'  => Str::random(10),
            'name'      => $request->school_name,
            'email'     => $validated['admin_email'],
            'password'  => $validated['admin_password'],
            'role_id'   => getRoleId('admin'),
            'school_id' => $school->id,
        ]);

        return goBack('success', 'School created successfully!');
    }

    public function delete($id)
    {
        $school = School::findOrFail($id);

        if ($school->logo && Storage::disk('public')->exists($school->logo)) {
            Storage::disk('public')->delete($school->logo);
        }

        $school->delete();

        return goBack('success', 'School deleted successfully!');
    }
}
