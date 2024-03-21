<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index(){
        return view('Home.Genre.index',[
            'genres' => Genre::all()
        ]);
    }

    public function show(Genre $genre){
        $genre = $genre->load('movie');
        return view('Home.Genre.show',[
            'genre' => $genre
        ]);
    }
}
