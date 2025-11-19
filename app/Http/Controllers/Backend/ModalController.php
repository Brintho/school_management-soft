<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModalController extends Controller
{
    public function show(Request $request, $path)
    {
        $pageData = $request->all();
        return view($path, $pageData);
    }
}
