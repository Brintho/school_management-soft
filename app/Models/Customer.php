<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'address',
        'photo',
    ];
    protected function photo(): Attribute
    {
        return Attribute::make(
            get: fn($value) => getImage($value),
        );
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'customer_id', 'id');
    }

}
