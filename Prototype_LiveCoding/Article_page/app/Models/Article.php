<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'published_at',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
