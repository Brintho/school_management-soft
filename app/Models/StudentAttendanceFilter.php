<?php
namespace App\Models;

use App\Models\Scopes\scopeSchool;
use Illuminate\Database\Eloquent\Model;

class StudentAttendanceFilter extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'school_id',
        'routine_id',
        'date',
    ];

    // protected static function booted()
    // {
    //     static::addGlobalScope(new scopeSchool());
    // }

    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    // public function routine()
    // {
    //     return $this->belongsTo(Routine::class, 'routine_id', 'id');
    // }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

}
