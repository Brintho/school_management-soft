<?php

namespace App\Models;

use App\Models\Scopes\scopeSchool;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'customer_id',
        'package_id',
        'issue',
        'expire',
        'payment_status',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }

}
