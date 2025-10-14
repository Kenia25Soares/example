<x-layout>
    <x-slot:heading>
        Post Details
    </x-slot:heading>

    <h2 class="font-bold text-lg mb-2">{{ $post->title }}</h2>

    <p class="text-gray-700">
        {{ $post->body }}
    </p>
</x-layout>
