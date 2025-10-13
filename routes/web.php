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

Route::get('/jobs', function () {
    // $jobs = Job::with('employer')->cursorPaginate(3);
    $jobs = Job::with('employer')->simplePaginate(3);
    // $jobs = Job::with('employer')->paginate(3);  // Add Paginação

    return view('jobs', [
               'jobs' => $jobs
    ]);
});

Route::get('/jobs/{id}', function ($id) {
        $job = Job::find($id);
    return view('job', ['job' => $job]);
});

Route::get('/posts', function () {
     $posts = Post::simplePaginate(3); // Exibe 5 posts por página 

    return view('posts', [
               'posts' => $posts
    ]);
});

Route::get('/posts/{id}', function ($id) {
        $post = Post::find($id);
    return view('post', ['post' => $post]);
});


Route::get('/contact', function () {
    return view('contact');
});