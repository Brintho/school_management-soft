<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'class_id',
        'section_id',
        'shift_id',
        'school_id',
        'mother_name',
        'father_name',
        'additional_info',
        'unique_id',
        'documents',
        'guardian_number',
    ];

    protected function documents(): Attribute
    {
        return Attribute::make(
            get: fn($value) => getImage($value),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function class ()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id', 'id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    protected $casts = [
        'documents' => 'array',
    ];
}
