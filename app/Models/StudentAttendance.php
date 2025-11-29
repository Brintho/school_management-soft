<?php
namespace App\Models;

use App\Models\Scopes\scopeSchool;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    public $timestamps = true;

    protected $fillable = ['school_id', 'student_id', 'routine_id', 'status'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function routine()
    {
        return $this->belongsTo(Routine::class, 'routine_id', 'id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

}
