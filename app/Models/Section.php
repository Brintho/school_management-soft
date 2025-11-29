<?php

namespace App\Models;

use App\Models\Scopes\scopeSchool;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'name',
        'school_id',
        'class_id',
    ];

    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }

    public function routines()
    {
        return $this->hasMany(Routine::class, 'section_id', 'id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'section_id', 'id');

    }
}
