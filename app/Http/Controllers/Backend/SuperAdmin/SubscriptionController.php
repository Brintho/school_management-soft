<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $page_data['subscriptions'] = Subscription::orderBy("created_at", "desc")->paginate(20);

        return view('app.superAdmin.subscriptions.index', $page_data);
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
