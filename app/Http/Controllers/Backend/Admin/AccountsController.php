<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExpenseEntry;
use App\Models\IncomeEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountsController extends Controller
{
    public function report()
    {
        // Income Query
        $income = IncomeEntry::select(
            'transaction_date as date',
            'title as description',
            DB::raw('amount as credit'),
            DB::raw('0 as debit'),
            DB::raw("'income' as type")
        );

        // Expense Query
        $expense = ExpenseEntry::select(
            'transaction_date as date',
            'title as description',
            DB::raw('0 as credit'),
            DB::raw('amount as debit'),
            DB::raw("'expense' as type")
        );

        // Merge + Sort
        $entries = $income
            ->unionAll($expense)
            ->orderBy('date', 'ASC')
            ->get()
            ->map(function ($row) {
                return [
                    'date'        => $row->date,
                    'description' => $row->description,
                    'credit'      => (float) $row->credit,
                    'debit'       => (float) $row->debit,
                    'net'         => (float) $row->credit - (float) $row->debit,
                    'type'        => $row->type,
                ];
            });

        return view('backend::admin.accounts.report', compact('entries'));
    }

}
