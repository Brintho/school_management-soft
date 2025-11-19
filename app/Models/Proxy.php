<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proxy extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'school_id',
        'teacher_id',
    ];
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

}
