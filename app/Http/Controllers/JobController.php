<?php

namespace App\Http\Controllers;

use App\Mail\JobPosted;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class JobController extends Controller
{
    //Index
     public function index()
    {
         $jobs = Job::with('employer')->latest()->simplePaginate(3);

        return view('jobs.index', [
               'jobs' => $jobs
        ]);
        
    }

    // Create
    public function create()
    {
         return view('jobs.create');
    }

    // Show
    public function show(Job $job)
    {
         return view('jobs.show', ['job' => $job]);
    }

    // Store
    // Armazena ou grava um novo trabalho na DB
     public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);
        
         Mail::to ($job->employer->user)->queue(
           new JobPosted($job)
           );

        return redirect('/jobs');
    }

    //Edit
    public function edit(Job $job)
    {
        // Gate::define('edit-job',function (User $user, Job $job){
        //     return $job->employer->user->is($user);
        // });  //mando isso para AppServiceProvider.php no Providers

        // if (Auth::guest()){
        //     return redirect('/login');
        // }

        Gate::authorize('edit', $job);
        // if ($job->employer->user->isNot(Auth::user())){
        //     abort(403);
        //     //Não está autorizado
        // }
        return view('jobs.edit', ['job' => $job]);

    }

    // Update  --Patch
    public function update(Job $job)
    {
        // authorize (On hold...)
        Gate::authorize('edit', $job);

        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);

        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
        Gate::authorize('edit-job', $job);
        // authorize (On hold/ em espera)
        $job->delete();  // delete the  job

        return redirect('/jobs');
    }
}
