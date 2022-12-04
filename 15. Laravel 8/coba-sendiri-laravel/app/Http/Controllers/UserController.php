<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show(User $author)
    {
        return view('posts', [
            "title" => "Post By Author : $author->name",

            // load : untuk mengatasi lazy load pada n+1 problem
            "posts" => $author->posts->load('category', 'author')
        ]);
    }
}
