<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class packageFeatures extends Model
{
    public $timestamps  = true;
    protected $fillable = [
        'title', 'slug', 'package_id', 'sort_order',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

}
