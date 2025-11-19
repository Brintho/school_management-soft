<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'title', 'slug', 'sub_title', 'description', 'price', 'discount', 'icon', 'type', 'order', 'status', 'period',
    ];
    protected function icon(): Attribute
    {
        return Attribute::make(
            get: fn($value) => getImage($value),
        );
    }

    public function features()
    {
        return $this->hasMany(packageFeatures::class);
    }

    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class, 'package_id', 'id');
    }

}
