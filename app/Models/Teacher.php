<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'profession',
        'description',
        'github',
        'linkedin',
    ];
    
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
