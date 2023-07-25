<?php

namespace App\Models;

use App\Models\Course;
use App\Models\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'email',
        'profession',
        'description',
        'github',
        'linkedin',
        'image_id'
    ];
    
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function image()
    {
        return $this->belongsTo(File::class);
    }
}
