<?php

namespace App\Models;

use App\Models\Scopes\scopeSchool;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'school_id',
        'experience',
        'father_name',
        'education',
        'joining_date',
        'monthly_salary',
        'documents',
        'status',
        'shift_id',
    ];

    protected function documents(): Attribute
    {
        return Attribute::make(
            get: fn($value) => getImage($value),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function classes()
    {
        return $this->hasMany(Classes::class, 'teacher_id', 'id');
    }

    public function proxies()
    {
        return $this->hasMany(Teacher::class, 'teacher_id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'teacher_id');
    }

    public function routines()
    {
        return $this->hasMany(Routine::class, 'class_id', 'id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id', 'id');
    }
    protected $casts = [
        'documents' => 'array',
    ];

}
