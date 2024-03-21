<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Models\Movie;
use Illuminate\Support\Facades\Route;
use function Pest\Laravel\get;

Route::get('/',[MovieController::class,'index'])->name('index');
Route::get('/movie/{movie:slug}',[MovieController::class,'show'])->name('movie.show');
Route::get('/genre',[GenreController::class,'index'])->name('genre.index');
Route::get('/genre/{genre:slug}',[GenreController::class,'show'])->name('genre.show');
