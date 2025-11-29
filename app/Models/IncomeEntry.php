<?php

namespace App\Models;

use App\Models\Scopes\scopeSchool;
use Illuminate\Database\Eloquent\Model;

class IncomeEntry extends Model
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
