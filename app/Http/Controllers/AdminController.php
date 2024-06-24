<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin');  
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (($credentials)) {
            return redirect()->intended('/admin-dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
