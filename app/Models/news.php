<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'author', 'title', 'excerpt', 'content', 'date', 'image', 'category'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'author');
    }
}
