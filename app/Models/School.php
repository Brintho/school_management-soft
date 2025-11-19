<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public $timestamps  = true;
    protected $fillable = [
        'school_name', 'slug', 'code', 'email', 'phone', 'alternative_phone', 'institute_type_id',
        'logo', 'website', 'present_address', 'permanent_address', 'city', 'state',
        'country', 'zipcode', 'lat', 'lng', 'is_admission_going', 'status', 'admin_email', 'admin_password',
    ];

    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn($value) => getImage($value),
        );
    }

    public function teacher()
    {
        return $this->hasMany(Teacher::class, 'school_id', );
    }

}
