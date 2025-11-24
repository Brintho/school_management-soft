<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseEntry extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'school_id',
        'chart_of_accounts_id',
        'transaction_date',
        'title',
        'details',
        'amount',
    ];
}
