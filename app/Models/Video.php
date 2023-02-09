<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'url',
        'author',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorize');
    }
}
