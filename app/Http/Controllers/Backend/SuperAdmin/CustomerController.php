<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\FileUploader;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $page_data['customers'] = Customer::orderBy("created_at", "desc")->paginate(20);

        return view('app.superAdmin.customers.index', $page_data);
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:customers,email',
            'password' => 'required|string|min:8',
            'phone'    => 'required|string|max:30',
            'address'  => 'required|string|max:255',
            'photo'    => 'nullable|image|mimes:' . allowedFileExt() . '|max:' . allowedFileSize(),
        ]);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $validation['photo'] = FileUploader::upload($request->file('photo'), 'customer');
        }

        Customer::create($validation);

        return goBack('success', 'Customer Created Successfully');
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $validation = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:customers,email,' . $id,
            'phone'   => 'required|string|max:30',
            'address' => 'required|string|max:255',
            'photo'   => 'nullable|image|mimes:' . allowedFileExt() . '|max:' . allowedFileSize(),
        ]);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $validation['photo'] = FileUploader::upload($request->file('photo'), 'customer');
        }

        $customer->update($validation);

        return goBack('success', 'Customer Updated Successfully');
    }

    public function delete($id)
    {
        Customer::findOrFail($id)->delete();
        return goBack('success', 'Customer Deleted Successfully');
    }
}
