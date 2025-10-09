<x-layout>
    <x-slot:heading>
        Post Listings
    </x-slot:heading>

    <ul>
        @foreach ($posts as $post)
            <li class="mb-4">
                <a href="/posts/{{ $post->id }}" class="text-blue-500 hover:underline">
                    <strong>{{ $post->title }}</strong>
                </a>
            </li>
        @endforeach
    </ul>
</x-layout>
