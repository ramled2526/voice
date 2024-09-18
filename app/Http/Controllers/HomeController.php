<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function show()
    {
        return view('select-user.registration');
    }
    public function view()
    {
        return view('view-profile.login');
    }
}
