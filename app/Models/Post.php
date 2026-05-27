<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'student_id',
        'title',
        'content',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
