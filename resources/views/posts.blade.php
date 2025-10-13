<x-layout>
    <x-slot:heading>
        Post Listings
    </x-slot:heading>

    <div>
        @foreach ($posts as $post)
            <a href="/posts/{{ $post->id }}" class="block px-4 py-6 border border-gray-200 hover:bg-gray-50 rounded-lg mb-4">
                <div class="font-bold text-blue-600 text-lg mb-2">
                    {{ $post->title }}
                </div>
                <div class="text-gray-700">
                    {{ Str::limit($post->body, 100) }}
                </div>
            </a>
        @endforeach
    </div>
</x-layout>
