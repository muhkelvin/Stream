<x-layout>
<ul class="list-disc space-y-2">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">{{ $movie->title }}</h1>
        @if ($movie->movie_url)
            <div class="movie-container">
                <iframe width="560" height="315" src="{{ $movie->movie_url }}" frameborder="0" allowfullscreen></iframe>
            </div>
        @endif

        <div class="text-gray-700 prose prose-sm">{!! $movie->body !!}</div>

        <p class="text-gray-500 text-sm mt-4">
            By: {{ $movie->title }} ({{ $movie->created_at->format('d F Y') }})
            <a href="">Genre:
                @forelse($movie->genre as $genre)
                    {{ $genre->name }}
                @empty
                    No genre
                @endforelse
            </a>
        </p>
    </div>
</ul>
</x-layout>
