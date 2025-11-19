<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Services\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function index()
    {
        $page_data['packages'] = Package::orderBy("created_at", "desc")->paginate(20);

        return view('app.superAdmin.package.index', $page_data);

    }

    public function store(Request $request)
    {

        $request->merge(['slug' => slugify($request->title)]);
        $validate = $request->validate([

            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|unique:packages,slug',
            'sub_title'   => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'discount'    => 'nullable|numeric|min:0',
            'icon'        => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'type'        => 'required|string|max:255',
            'order'       => 'nullable|integer',
            'status'      => 'required|boolean',
            'period'      => 'required|string|in:monthly,yearly,lifetime',
        ]);

        // File upload
        if ($request->hasFile('icon')) {
            $validate['icon'] = FileUploader::upload($request->file('icon'), 'package');
        }
        // Database insert
        Package::create($validate);

        return goBack('success', 'Package Created Successfully');

    }

    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);

        if ($request->has('status')) {
            $package->update(['status' => $request->status]);
            return back()->with('success', 'Status updated successfully!');
        }

        $request->merge(['slug' => slugify($request->title)]);

        $validate = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|unique:packages,slug,' . $id,
            'sub_title'   => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'discount'    => 'nullable|numeric|min:0',
            'icon'        => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'type'        => 'required|string|max:255',
            'order'       => 'nullable|integer',
            'status'      => 'required|boolean',
            'period'      => 'required|string|in:monthly,yearly,lifetime',

        ]);
        if ($request->hasFile('icon') && $request->file('icon')->isValid()) {
            $validate['icon'] = FileUploader::upload($request->file('icon'), 'package');
        }

        $package->update($validate);

        return back()->with('success', 'Package updated successfully!');
    }

    public function delete($id)
    {
        $package = Package::with('features')->findOrFail($id);

        DB::transaction(function () use ($package) {
            $package->features()->delete();
            $package->delete();
        });

        return back()->with('success', 'Package deleted successfully!');
    }

}
