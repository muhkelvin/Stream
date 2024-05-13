<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminGenreController extends Controller
{

    public function index()
    {
        return view('Admin.Genre.index', [
            'genres' => Genre::all()
        ]);
    }


    public function create()
    {
        return view('Admin.Genre.create');
    }




    public function store(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create slug from the provided name
        $slug = Str::slug($validatedData['name'], '-');

        // Ensure unique slug by appending a counter if necessary
        $originalSlug = $slug;
        $counter = 1;
        while (Genre::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Create Genre instance and save to the database
       Genre::create([
            'name' => $validatedData['name'],
            'slug' => $slug,
        ]);

        // Redirect with success message
        return redirect()->route('admin.genres')->with('success', 'Genre created successfully!');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(Genre $genre)
    {
    return view('Admin.Genre.update', [
        'genre' => $genre
    ]);
    }



    public function update(Request $request, Genre $genre)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the genre attributes
        $genre->name = $validatedData['name'];

        // Create slug from the updated name
        $slug = Str::slug($validatedData['name'], '-');

        // Ensure unique slug by appending a counter if necessary
        $originalSlug = $slug;
        $counter = 1;
        while (Genre::where('slug', $slug)->where('id', '!=', $genre->id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Assign the updated slug to the genre
        $genre->slug = $slug;

        // Save the updated genre
        $genre->save();

        // Redirect with success message
        return redirect()->route('admin.genres')->with('success', 'Genre updated successfully!');
    }



    public function destroy(Genre $genre)
    {
        // Detach all related movies
        $genre->movie()->detach();

        // Now delete the genre
        $genre->delete();

        return redirect()->route('admin.genres')->with('success', 'Genre deleted successfully!');
    }

}
