<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;
use App\Models\Post;


#TODO - revert
// Route::get('/', function () {
//     // $jobs = Job::all();
//      // dd($jobs[2]->title);
//     return view('home');
// });

Route::get('/', function () {
   return view('home', [
        'jobs' => [],
        'posts' => [],
    ]);
});

# ----------------------------
# JOBS
# ----------------------------

//Index
Route::get('/jobs', function () {
    // $jobs = Job::with('employer')->cursorPaginate(3);
    $jobs = Job::with('employer')->latest()->simplePaginate(3);
    // $jobs = Job::with('employer')->paginate(3);  // Add Paginação

    return view('jobs.index', [
               'jobs' => $jobs
    ]);
});

// Create
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

// Show
Route::get('/jobs/{id}', function ($id) {
        $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});

// Store
// Armazena ou grava um novo trabalho na DB
Route::post('/jobs', function () {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

// Edit
Route::get('/jobs/{id}/edit', function ($id) {
        $job = Job::find($id);
    return view('jobs.edit', ['job' => $job]);
});

// Update  --Patch
Route::patch('/jobs/{id}', function ($id) {
    // validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    // authorize --em espera(On hold)

    $job = Job::findOrFail($id);  // findOrFail lança uma exceção de modelo não encontrado

    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    return redirect('/jobs/' . $job->id);
});

// Delete --Destroy
Route::delete('/jobs/{id}', function ($id) {
    // authorize (On hold/ em espera)

    Job::findOrFail($id)->delete();  // delete the  job

    return redirect('/jobs');
});

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
        $post = Post::findOrFail($id);
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

Route::get('/contact', function () {
    return view('contact');
});