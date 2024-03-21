<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(){
        return view('Home.index',[
            'movies' => Movie::paginate(5)
        ]);
    }

    public function show(Movie $movie){
        $movie = $movie->load('genre');
        return view('Home.show',[
            'movie' => $movie
        ]);
    }
}
