<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proxy;
use Illuminate\Http\Request;

class ProxyController extends Controller
{
    public function index()
    {
        $page_data['proxies'] = Proxy::with(['user', 'school'])->orderBy("created_at", "desc")->paginate(20);
        return view('backend::admin.proxies.index', $page_data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:users,id',
        ]);

        Proxy::create([
            'teacher_id' => $request->teacher_id,
            'school_id'  => getSchoolId(),
        ]);
        return goBack('success', translate('Proxy created successfully.'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'teacher_id' => 'required|exists:users,id',
        ]);

        $proxy = Proxy::find($id);
        $proxy->update([
            'teacher_id' => $request->teacher_id,
        ]);
        return goBack('success', translate('Proxy updated successfully.'));
    }

    public function delete($id)
    {
        Proxy::find($id)->delete();
        return goBack('success', translate('Proxy deleted successfully.'));
    }

}
