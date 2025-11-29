<?php

namespace App\Models;

use App\Models\Scopes\scopeSchool;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{

    public $timestamps = true;

    protected $fillable = [
        'class_id',
        'name',
        'category',
        'marks',
        'status',
    ];

    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id')->where('status', 1);
    }

    public function routines()
    {
        return $this->hasMany(Routine::class, 'class_id', 'id');
    }
}
