<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\PackageFeatures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PackageFeaturesController extends Controller
{
    public function index()
    {

        $page_data['packages'] = PackageFeatures::orderBy("created_at", "desc")->paginate(20);

        return view('app.superadmin.packagefeatures.index', $page_data);
    }

    public function store(Request $request)
    {
        $request->merge(['slug' => slugify($request->title)]);
        $validate = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'title'      => 'required|string|max:255',
            'slug'       => 'required|string|max:255',
        ]);

        $features = PackageFeatures::where('package_id', $request->package_id)->first();
        if ($features) {
            return back()->with('error', 'Feature already exists!');
        }
        PackageFeatures::create($validate);
        return goBack('success', 'Feature added successfully!');
    }

    public function update(Request $request, $id)
    {
        $feature = PackageFeatures::findOrFail($id);
        $request->merge(['slug' => slugify($request->title)]);

        $validate = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'title'      => 'required|string|max:255',
            'slug'       => 'required|string|max:255' . $id,
        ]);

        $features = PackageFeatures::where('package_id', $request->package_id)->first();
        if ($features) {
            return back()->with('error', 'Feature already exists!');
        }
        $feature->update($validate);
        return goBack('success', 'Feature updated successfully!');
    }

    public function delete($id)
    {
        $feature = PackageFeatures::findOrFail($id);
        $feature->delete();
        return back()->with('success', 'Feature deleted successfully!');
    }

    public function featureSort(Request $request)
    {
        $validated = $request->validate([
            'packageId' => 'required|string|exists:packages,id',
            'items'     => 'required|string',
        ]);

        $features = json_decode($validated['items'] ?? [], true);
        foreach ($features as $key => $feature) {
            PackageFeatures::where('id', $feature)->update(['sort_order' => $key]);
        }

        return response()->json([
            'success' => translate('Items has been soted successfully!'),
        ]);
    }

}
