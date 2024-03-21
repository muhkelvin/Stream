<?php

namespace Database\Factories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        $imageurl ="https://source.unsplash.com/random/300x200";
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->sentence(),
            'synopsis' => $this->faker->paragraphs(3, true),
            'image' => $imageurl,
            'movie_url' => 'https://drive.google.com/file/d/1uegA58oTjVOrs0K-MO2jDJNSVzH1m85S/view?usp=sharing'
        ];
    }
}
