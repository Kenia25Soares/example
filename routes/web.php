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

Route::get('/jobs', function () {
    // $jobs = Job::with('employer')->cursorPaginate(3);
    $jobs = Job::with('employer')->latest()->simplePaginate(3);
    // $jobs = Job::with('employer')->paginate(3);  // Add Paginação

    return view('jobs.index', [
               'jobs' => $jobs
    ]);
});


Route::get('/jobs/create', function () {
    return view('jobs.create');
});

Route::get('/jobs/{id}', function ($id) {
        $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});

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

# ----------------------------
# POSTS
# ----------------------------


Route::get('/posts', function () {
     $posts = Post::with(['user', 'tags'])->latest()->simplePaginate(3); 

    return view('posts.index', [
               'posts' => $posts
    ]);
});

Route::get('/posts/create', function () {
    return view('posts.create');
});

Route::get('/posts/{id}', function ($id) {
        $post = Post::find($id);
    return view('posts.show', ['post' => $post]);
});

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

Route::get('/contact', function () {
    return view('contact');
});