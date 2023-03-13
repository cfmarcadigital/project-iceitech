<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'image',
        'user_id',
    ];

    public function blog()
    {
        return $this->hasOne(Blog::class);
    }
}
