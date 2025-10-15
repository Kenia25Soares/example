<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
     // INDEX - Lista de posts
    public function index()
    {
        $posts = Post::with(['user', 'tags'])->latest()->simplePaginate(3);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    // CREATE - Formulário de criação
    public function create()
    {
        return view('posts.create');
    }

    // STORE - Salva novo post
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:3'],
            'body'  => ['required', 'min:10'],
        ]);

        Post::create([
            'title'   => $request->title,
            'body'    => $request->body,
            'user_id' => 1, // ou auth()->id() se tiver login
        ]);

        return redirect('/posts');
    }

    // SHOW - Exibe um post
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    // EDIT - Formulário de edição
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    // UPDATE - Atualiza um post
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required', 'min:3'],
            'body'  => ['required', 'min:10'],
        ]);

        $post->update([
            'title' => $request->title,
            'body'  => $request->body,
        ]);

        return redirect('/posts/' . $post->id);
    }

    // DESTROY - Deleta um post
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/posts');
    }
}
