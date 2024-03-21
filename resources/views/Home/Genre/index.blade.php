<x-layout title="Categori List">
    <ul class="list-disc space-y-2">
        @forelse ($genres as $genre)
            <li class="p-4 bg-gray-100 rounded hover:bg-gray-200 shadow">
                <a href="{{ route('genre.show', $genre->slug) }}" class="text-blue-500 hover:underline font-bold block mb-2">
                    {{ $genre->name }}
                </a>
                <p class="text-gray-700">{{ Str::limit($genre->body, 100) }}</p>
            </li>
        @empty
            <p class="text-gray-500">No articles found.</p>
        @endforelse
    </ul>
</x-layout>
