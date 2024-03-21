<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\MovieGenre;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Membuat 40 film
        $movies = Movie::factory(40)->create();

        // Membuat 5 genre
        $genres = Genre::factory(5)->create();

        // Menghubungkan genre dengan film
        $movies->each(function ($movie) use ($genres) {
            // Ambil tiga genre secara acak
            $randomGenres = $genres->random(3);

            // Memasang genre ke film
            $randomGenres->each(function ($genre) use ($movie) {
                MovieGenre::create([
                    'genre_id' => $genre->id,
                    'movie_id' => $movie->id,
                ]);
            });
        });
    }
}
