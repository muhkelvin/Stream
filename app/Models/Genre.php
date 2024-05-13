<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug'
    ];
    public function movie()
    {
        return $this->belongsToMany(Movie::class,'movie_genre','genre_id','movie_id');
    }
}
