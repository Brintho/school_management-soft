<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAttendanceFilter extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'school_id',
        'routine_id',
        'date',
    ];

    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }

}
