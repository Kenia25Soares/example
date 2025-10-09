<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;
use App\Models\Post;



Route::get('/', function () {
    // $jobs = Job::all();
     // dd($jobs[2]->title);
    return view('home');
});

Route::get('/jobs', function () {
    return view('jobs', [
               'jobs' => Job::all()
    ]);
});

Route::get('/jobs/{id}', function ($id) {
        $job = Job::find($id);
    return view('job', ['job' => $job]);
});

Route::get('/posts', function () {
    return view('posts', [
               'posts' => Post::all()
    ]);
});

Route::get('/posts/{id}', function ($id) {
        $post = Post::find($id);
    return view('post', ['post' => $post]);
});


Route::get('/contact', function () {
    return view('contact');
});