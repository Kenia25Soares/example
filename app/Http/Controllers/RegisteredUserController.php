<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    public function create()
    {
        // dd('hello'); // fazer debug indo no browser example.test/register  se tiver correcto ira aparecer hello
         return view('auth.register');
    }

    public function store()
    {
         dd(request()->all());
    }
}
