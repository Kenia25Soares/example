<x-layout>
    <x-slot:heading>
        Post Details
    </x-slot:heading>

    <h2 class="font-bold text-lg mb-2">{{ $post->title }}</h2>

    <p class="text-gray-700">
        {{ $post->body }}
    </p>

    <div class="text-sm text-gray-500">
        Written by: <strong>{{ $post->user->first_name ?? 'Unknown Author' }}</strong>
    </div>
    
    <p class="mt-6">
        <x-button href="/posts/{{ $post->id }}/edit">Edit Post</x-button>
    </p>
</x-layout>
