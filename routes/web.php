<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisteredUserController;
use App\Jobs\TranslateJob;
use App\Models\Job;


Route::get('test', function(){ 
  $job = Job::first();

    TranslateJob::dispatch($job);

    return 'Done';
 });

// Route::get('test', function(){ 
//    dispatch(function(){
//     logger('hello from the queue!');
//   })->delay(5);

//     return 'Done';
//  });


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

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create']);
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');
Route::get('/jobs/{job}', [JobController::class, 'show']);

Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
->middleware('auth')
->can('edit', 'job');

Route::patch('/jobs/{job}', [JobController::class, 'update']);
Route::delete('/jobs/{job}', [JobController::class, 'destroy']);

# ----------------------------
# POSTS
# ----------------------------

Route::resource('posts', PostController::class);

# ----------------------------
# CONTACT
# ----------------------------
Route::view('/contact', 'contact');

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

 Route::get('/login', [SessionController::class, 'create'])->name('login');
 Route::post('/login', [SessionController::class, 'store']);
 Route::post('/logout', [SessionController::class, 'destroy']);
