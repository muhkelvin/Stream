<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public function genre()
    {
        return $this->belongsToMany(Genre::class,'movie_genre', 'movie_id', 'genre_id');
    }
}
