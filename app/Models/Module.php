<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'description',
        'course_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
