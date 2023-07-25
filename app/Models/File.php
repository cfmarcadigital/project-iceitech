<?php

namespace App\Models;

use App\Models\Blog;
use App\Models\Course;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
    ];

    public function blog()
    {
        return $this->hasOne(Blog::class);
    }

    public function course()
    {
        return $this->hasOne(Course::class);
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }
}
