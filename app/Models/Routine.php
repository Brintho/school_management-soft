<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    use HasFactory;

    // Mass assignable fields
    protected $fillable = [
        'class_id',
        'section_id',
        'subject_id',
        'teacher_id',
        'proxy_teacher_id',
        'room_id',
        'shift_id',
        'date',
        'day',
        'class_start',
        'class_end',
        'status',
    ];

    /**
     * Relationships
     */

    // Class relationship
    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    // Section relationship
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    // Subject relationship
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    // Main Teacher
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function proxyTeacher()
    {
        return $this->belongsTo(User::class, 'proxy_teacher_id', 'id');
    }

    // Room relationship
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    // Shift relationship
    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

    // Attendance relationship
    public function attendances()
    {
        return $this->hasMany(StudentAttendanceFilter::class);
    }
}
