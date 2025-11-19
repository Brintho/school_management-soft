<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table    = 'rooms';
    protected $fillable = [
        'school_id',
        'room_name',
        'status',
    ];

    public function proxyTeacher()
    {
        return $this->belongsTo(Teacher::class, 'proxy_teacher_id');
    }

}
