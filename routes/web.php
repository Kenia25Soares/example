<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Models\Post;


Route::view('/', 'home');

# ----------------------------
# JOBS
# ----------------------------

// Route::controller(JobController::class)->group(function(){
//     Route::get('/jobs','index');
//     Route::get('/jobs/create', 'create');
//     Route::get('/jobs/{job}', 'show');
//     Route::post('/jobs', 'store');
//     Route::get('/jobs/{job}/edit', 'edit');
//     Route::patch('/jobs/{job}', 'update');
//     Route::delete('/jobs/{job}', 'destroy');
// });

Route::resource('jobs', JobController::class);

# ----------------------------
# POSTS
# ----------------------------

//Index
Route::get('/posts', function () {
     $posts = Post::with(['user', 'tags'])->latest()->simplePaginate(3); 

    return view('posts.index', [
               'posts' => $posts
    ]);
});

//Create
Route::get('/posts/create', function () {
    return view('posts.create');
});

// Show
Route::get('/posts/{id}', function ($id) {
        $post = Post::find($id);

    return view('posts.show', ['post' => $post]);
});

// Store -- Armazena ou grava um novo Post na DB
Route::post('/posts', function () {
    // Validação
    request()->validate([
        'title' => ['required', 'min:3'],
        'body' => ['required', 'min:10'],
    ]);

     // Criação
    Post::create([
        'title' => request('title'),
        'body' => request('body'),
        'user_id' => 1 // exemplo: id do autor (ou auth()->id() se tiver login)//Se o user estiver autenticado, troque por'user_id' => auth()->id()
    ]);

    return redirect('/posts');
});

//Edit
Route::get('/posts/{id}/edit', function ($id) {
    $post = Post::findOrFail($id);

    return view('posts.edit', ['post' => $post]);
});

// Update - Patch
Route::patch('/posts/{id}', function ($id) {
    request()->validate([
        'title' => ['required', 'min:3'],
        'body' => ['required', 'min:10'],
    ]);

    $post = Post::findOrFail($id);

     $post->update([
        'title' => request('title'),
        'body' => request('body'),
        // 'user_id' => 1, // ou auth()->id() se houver autenticação
    ]);

    return redirect('/posts/' . $post->id);
});

// Delete --Destroy
Route::delete('/posts/{id}', function ($id) {
    Post::findOrFail($id)->delete();
    return redirect('/posts');
});


Route::view('/contact', 'contact');
