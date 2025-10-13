<x-layout>
    <x-slot:heading>
        Post Listings
    </x-slot:heading>

    <div class="space-y-4">
        @foreach ($posts as $post)
            <a href="/posts/{{ $post->id }}" class="block px-4 py-6 border border-gray-200 rounded-lg">
                {{-- Removemos o autor aqui --}}
                <div>
                    <strong>{{ $post->title }}:</strong>
                    {{ Str::limit($post->body, 100) }}
                </div>
            </a>
        @endforeach

        <div>
            {{ $posts->links() }}
        </div>
    </div>
</x-layout>
