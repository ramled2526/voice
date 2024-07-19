<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $defaultUsername = 'admin@login';
    private $defaultPassword = 'passAdmin';

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($request->username === $this->defaultUsername && $request->password === $this->defaultPassword) {
            // Log the admin in by setting a session variable
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard'); // Redirect to the admin dashboard
        }

        return back()->withErrors(['login' => 'Invalid credentials.']);
    }

    public function dashboard()
    {
        // Ensure this route is protected
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        return view('admin.dashboard'); // Ensure this view exists
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }

    
}

