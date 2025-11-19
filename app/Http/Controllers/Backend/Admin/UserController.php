<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $page_data['users'] = User::orderBy("created_at", "desc")->paginate(20);

        return view('backend::admin.users.index', $page_data);
    }

    public function create()
    {
        return view('backend::admin.users.create');
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone'    => 'required|string|max:30',
        ]);

        $data = User::create([
            'username'  => Str::random(10),
            'name'      => $validation['name'],
            'email'     => $validation['email'],
            'phone'     => $validation['phone'],
            'school_id' => auth()->user()->school_id,
            'password'  => Hash::make($request->password),
            'role'      => 'user',
        ]);

        return goBack('success', 'User created successfully');
    }

    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:30',
        ]);

        $data = User::findOrFail($id);
        $data->update([
            'name'  => $validation['name'],
            'email' => $validation['email'],
            'phone' => $validation['phone'],
        ]);

        return goBack('success', 'User updated successfully');
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return goBack('success', 'User deleted successfully');
    }

}
