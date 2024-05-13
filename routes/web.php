<?php

use App\Http\Controllers\Admin\AdminGenreController;
use App\Http\Controllers\Admin\AdminMovieController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Models\Movie;
use Illuminate\Support\Facades\Route;
use function Pest\Laravel\get;

Route::get('/',[MovieController::class,'index'])->name('index');
Route::get('/movie/{movie:slug}',[MovieController::class,'show'])->name('movie.show');
Route::get('/genre',[GenreController::class,'index'])->name('genre.index');
Route::get('/genre/{genre:slug}',[GenreController::class,'show'])->name('genre.show');
Route::get('/search',[MovieController::class,'search'])->name('search');

Route::controller(AuthController::class)->group( function () {
    Route::get('/login',[AuthController::class,'login'])->name('login');
    Route::post('/login',[AuthController::class,'authenticate'])->name('login.authenticate');
    Route::get('/register',[AuthController::class,'register'])->name('register');
    Route::post('/register',[AuthController::class,'store'])->name('register.store');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
});

Route::controller(AdminMovieController::class)->middleware('auth:web')->group(function () {
    Route::get('/admin/movies',[AdminMovieController::class,'index'])->name('admin.movies');
    Route::get('/admin/movies/create',[AdminMovieController::class,'create'])->name('admin.movies.create');
    Route::get('/admin/movies/{movie:slug}',[AdminMovieController::class,'show'])->name('admin.movies.show');
    Route::post('/admin/movies',[AdminMovieController::class,'store'])->name('admin.movies.store');
    Route::get('/admin/movies/{movie:slug}/edit',[AdminMovieController::class,'edit'])->name('admin.movies.edit');
    Route::put('/admin/movies/{movie:slug}',[AdminMovieController::class,'update'])->name('admin.movies.update');
    Route::delete('/admin/movies/{movie:slug}',[AdminMovieController::class,'destroy'])->name('admin.movies.destroy');
});

Route::controller(AdminGenreController::class)->middleware('auth:web')->group(function () {
    Route::get('/admin/genres',[AdminGenreController::class,'index'])->name('admin.genres');
    Route::get('/admin/genres/create',[AdminGenreController::class,'create'])->name('admin.genres.create');
    Route::post('/admin/genres',[AdminGenreController::class,'store'])->name('admin.genres.store');
    Route::get('/admin/genres/{genre:slug}/edit',[AdminGenreController::class,'edit'])->name('admin.genres.edit');
    Route::put('/admin/genres/{genre:slug}',[AdminGenreController::class,'update'])->name('admin.genres.update');
    Route::delete('/admin/genres/{genre:slug}',[AdminGenreController::class,'destroy'])->name('admin.genres.destroy');
});

