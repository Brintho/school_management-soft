<?php

namespace App\Models;

use App\Models\Scopes\scopeSchool;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    public $timestamps  = true;
    protected $fillable = [
        'school_id',
        'name',
        'slug',
        'status',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function student()
    {
        return $this->hasMany(Student::class, 'shift_id', 'id');
    }
}
