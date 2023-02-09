<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorize extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'categorize_id',
        'categorize_type',
    ];
}
