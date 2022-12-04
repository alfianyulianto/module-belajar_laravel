<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            "title" => "Register",
            "active" => "register"
        ]);
    }

    public function store(Request $request)
    {
        // return $request->all();

        $validatedData = $request->validate([
            "name" => "required|max:255",
            "username" => ['required', 'min:5', 'max:255', 'unique:users'],
            "email" => "required|email:dns|unique:users",
            "password" => "required|min:8|max:255"
        ]);
        // $validatedData['password'] = bcrypt($validatedData['password']);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        // $request->session()->flash('success', 'Registration succsessfull! Pleas login');

        // redirect ke halaman login
        return redirect('/login')->with('success', 'Registration succsessfull! Pleas login');
    }
}
