<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Whoops\Run;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            "title" => "Login",
            "active" => "login"
        ]);
    }

    public function authenticate(Request $request)
    {
        $credential =  $request->validate([
            "email" => "required|email:dns",
            "password" => "required"
        ]);

        if (Auth::attempt($credential)) {
            // buat session baru agar session yang lama enggak bisa buat login lagi
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
