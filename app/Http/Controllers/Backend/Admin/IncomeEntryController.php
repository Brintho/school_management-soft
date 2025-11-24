<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\IncomeEntry;
use Illuminate\Http\Request;

class IncomeEntryController extends Controller
{
    public function store(Request $request)
    {
        $validation = $request->validate([
            'transaction_date' => 'required|date_format:Y-m-d',
            'title'            => 'required|string|max:255',
            'details'          => 'nullable|string',
            'amount'           => 'required|numeric|min:0',
        ]);
        $validation['school_id'] = getSchoolId();
        $validation['user_id']   = auth()->user()->id;
        // $validation['chart_of_accounts_id'] = $id->chart_of_accounts_id;

        IncomeEntry::create($validation);
        return goBack('success', 'Chart of account created successfully');
    }
    public function update(Request $request, $id)
    {
        $incomeEntry = IncomeEntry::findOrFail($id);

        $validation = $request->validate([
            'transaction_date' => 'required|date_format:Y-m-d',
            'title'            => 'required|string|max:255',
            'details'          => 'nullable|string',
            'amount'           => 'required|numeric|min:0',
        ]);
        $validation['school_id']            = getSchoolId();
        $validation['user_id']              = auth()->user()->id;
        $validation['chart_of_accounts_id'] = $request->chart_of_accounts_id;

        $incomeEntry->update($validation);
        return goBack('success', 'Chart of account updated successfully');
    }

    public function delete($id)
    {
        $incomeEntry = incomeEntry::findOrFail($id);
        $incomeEntry->delete();
        return goBack('success', 'Chart of account deleted successfully');
    }
}
