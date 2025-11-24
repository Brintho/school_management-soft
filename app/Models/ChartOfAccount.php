<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChartOfAccount extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'school_id',
        'account_name',
        'account_type',
        'notes',
    ];

}
