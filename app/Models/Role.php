<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'title',
        'slug',
        'is_default',
        'status',
    ];
}
