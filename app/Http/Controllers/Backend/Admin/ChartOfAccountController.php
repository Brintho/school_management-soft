<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChartOfAccount;
use App\Models\ExpenseEntry;
use App\Models\IncomeEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartOfAccountController extends Controller
{
    public function index()
    {
        $page_data['chartofaccounts'] = ChartOfAccount::orderBy("created_at", "desc")->paginate(20);
        return view('backend::admin.accounts.chart_of_account.index', $page_data);
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'account_name' => 'required|string|max:255',
            'account_type' => 'required|in:asset,liability,income,expense,equity',
            'notes'        => 'nullable|string',
        ]);
        $validation['school_id'] = getSchoolId();
        $validation['user_id']   = auth()->user()->id;

        ChartOfAccount::create($validation);
        return goBack('success', 'Chart of account created successfully');
    }
    public function update(Request $request, $id)
    {
        $chartofaccount = ChartOfAccount::findOrFail($id);

        $validation = $request->validate([
            'account_name' => 'required|string|max:255',
            'account_type' => 'required|in:asset,liability,income,expense,equity',
            'notes'        => 'nullable|string',
        ]);
        $validation['school_id'] = getSchoolId();
        $validation['user_id']   = auth()->user()->id;

        $chartofaccount->update($validation);
        return goBack('success', 'Chart of account updated successfully');
    }

    public function delete($id)
    {
        $chartofaccount = ChartOfAccount::findOrFail($id);
        $chartofaccount->delete();
        return goBack('success', 'Chart of account deleted successfully');
    }

}
