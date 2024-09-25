<x-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            @if ($movie->movie_url)
                <div class="movie-container">
                    <div style="position: relative; padding-bottom: 75%; height: 0; overflow: hidden;">
                        <iframe src={{$movie->movie_url ?? "https://www.youtube.com/embed/vi0daLtTxcc?si=Cz0Tl9dJRFEYN0oY"}} frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
                    </div>
                </div>
            @endif


            <div class="p-8">
                <h1 class="text-4xl font-bold text-gray-900">{{ $movie->title }}</h1>
                <div class="flex items-center mt-2">
                    <span class="text-yellow-500 mr-1">
                        <i class="fas fa-star"></i>
                    </span>
                    <span class="text-gray-700">{{ number_format($movie->rating, 1) }}/10</span>
                    <span class="mx-2">•</span>
                    <span class="text-gray-600">{{ $movie->release_year }}</span>
                    <span class="mx-2">•</span>
                    <span class="text-gray-600 text-sm">
                        Added on {{ $movie->created_at->format('F d, Y') }}
                    </span>
                </div>
                <div class="mt-4">
                    @forelse($movie->genre as $genre)
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $genre->name }}</span>
                    @empty
                        <span class="text-gray-500">No genres specified</span>
                    @endforelse
                </div>
            </div>

            <div class="md:flex p-8 border-t border-gray-200">
                <div class="md:flex-shrink-0 mr-8">
                    <img class="h-48 w-full object-cover md:w-48 rounded-lg" src="{{ $movie->poster_url ?? 'https://via.placeholder.com/300x450' }}" alt="{{ $movie->title }} Poster">
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Synopsis</h2>
                    <div class="prose prose-lg max-w-none text-gray-700">{!! $movie->synopsis !!}</div>
                </div>
            </div>

            @if($movie->cast)
                <div class="p-8 border-t border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Cast</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($movie->cast as $actor)
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <img src="{{ $actor->photo_url ?? 'https://via.placeholder.com/150' }}" alt="{{ $actor->name }}" class="w-full h-48 object-cover rounded-lg mb-2">
                                <h3 class="font-semibold text-gray-900">{{ $actor->name }}</h3>
                                <p class="text-gray-600 text-sm">{{ $actor->character }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layout>
