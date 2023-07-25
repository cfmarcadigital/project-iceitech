<?php

namespace App\Models;

use App\Models\Category;
use App\Models\File;
use App\Models\Module;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'module_duration',
        'description',
        'link',
        'requirements',
        'modality',
        'schedules',
        'image_id',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function image()
    {
        return $this->belongsTo(File::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
