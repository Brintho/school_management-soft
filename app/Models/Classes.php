<?php

namespace App\Models;

use App\Models\Scopes\CurrentSchoolScope;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'school_id',
        'teacher_id',
        'name',
        'slug',
        'section',
        'class_code',
        'shift',
        'capacity',
        'description',
        'status',
    ];

    protected $hidden = ['pivot'];

    public function subjects()
    {
        return $this->hasMany(Classes::class, 'class_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'class_id', 'id');
    }

    public function routines()
    {
        return $this->hasMany(Routine::class, 'class_id', 'id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id', 'id');
    }

    protected static function booted()
    {
        static::addGlobalScope(new CurrentSchoolScope());
    }

}
