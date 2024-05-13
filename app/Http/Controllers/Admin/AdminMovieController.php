<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminMovieController extends Controller
{
    public function index(){
        return view('Admin.Movie.index',[
            'movies' => Movie::latest()->paginate(5)
        ]);
    }


    public function create()
    {
        return view('Admin.Movie.create',[
            'genres' => Genre::all()
        ]);
    }


    public function store(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            // Assuming you want unique slugs
            'excerpt' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
            'movie_url' => 'nullable|url', // Optional URL validation
            'genres' => 'required|array', // Ensure genres is an array
            'genres.*' => 'exists:genres,id' // Ensure each genre exists in the database
        ]);


        // Create a sanitized slug from the title for uniqueness and URL friendliness
        $sanitizedSlug = Str::slug($validatedData['title'], '-'); // Use Str::slug for better slug generation

        // Ensure unique slug by appending a counter if necessary
        $slug = $sanitizedSlug;
        $counter = 1;
        while (Movie::where('slug', $slug)->exists()) {
            $slug = $sanitizedSlug . '-' . $counter;
            $counter++;
        }

        // Create a new Movie instance with synchronized title and slug
        $movie = Movie::create([
            'title' => $validatedData['title'],
            'slug' => $slug,
            'excerpt' => $validatedData['excerpt'],
            'synopsis' => $validatedData['synopsis'],
            'image' => $this->handleImageUpload($request), // Handle image upload if needed
            'movie_url' => $validatedData['movie_url'],
        ]);

        // Attach genres to the movie
        $movie->genre()->attach($validatedData['genres']);

        // Handle successful movie creation (e.g., redirect with success message)
        return redirect()->route('admin.movies')->with('success', 'Movie added successfully!');
    }



    public function show(Movie $movie)
    {
        return view('Admin.Movie.show',[
            'movie' => $movie,
        ]);
    }


    public function edit(Movie $movie)
    {
        return view('Admin.Movie.update',[
            'movie' => $movie,
            'genres' => Genre::all()
        ]);
    }


    public function update(Request $request, Movie $movie)
    {
        // Validate input data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
            'movie_url' => 'nullable|url', // Optional URL validation
            'genres' => 'required|array', // Ensure genres is an array
            'genres.*' => 'exists:genres,id' // Ensure each genre exists in the database
        ]);

        // Update movie attributes
        $movie->title = $validatedData['title'];
        $movie->excerpt = $validatedData['excerpt'];
        $movie->synopsis = $validatedData['synopsis'];
        $movie->movie_url = $validatedData['movie_url'];

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $movie->image = $this->handleImageUpload($request);
        }

        // Save the updated movie
        $movie->save();

        // Sync genres
        $movie->genre()->sync($validatedData['genres']);

        // Redirect with success message
        return redirect()->route('admin.movies')->with('success', 'Movie updated successfully!');
    }


    public function destroy(Movie $movie)
    {
        // Hapus catatan terkait dari tabel pivot movie_genre
        $movie->genre()->detach();

        // Hapus film
        $movie->delete();

        // Redirect ke halaman daftar film dengan pesan keberhasilan
        return redirect()->route('admin.movies')->with('success', 'Movie deleted successfully!');
    }


    public function handleImageUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Validate image file type
            if ($image->isValid() && in_array($image->getClientOriginalExtension(), ['jpeg', 'png', 'jpg', 'gif'])) {
                $fileName = uniqid() . '.' . $image->getClientOriginalExtension(); // Generate unique filename

                // Store image
                $image->storeAs('public/movies', $fileName);

                return 'movies/' . $fileName; // Return relative path to storage
            }
        }

        return null; // Return null if no image uploaded or invalid image
    }


}
