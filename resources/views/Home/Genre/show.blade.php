<x-layout>
    <ul class="list-disc space-y-2">
        @forelse ($genre->movie as $movie)
            <li class="p-4 bg-gray-100 rounded hover:bg-gray-200 shadow">
                <a href="{{ route('movie.show', $movie->slug) }}" class="text-blue-500 hover:underline font-bold block mb-2">
                    {{ $movie->title }}
                </a>
                <p class="text-gray-700">{{ Str::limit($movie->body, 100) }}</p>
            </li>
        @empty
            <p class="text-gray-500">No articles found.</p>
        @endforelse
    </ul>
</x-layout>
