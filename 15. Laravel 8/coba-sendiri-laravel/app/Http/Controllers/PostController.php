<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // public function index()
    // {
    //     return view('posts', [
    //         "title" => "Blog",
    //         "posts" => Post::all()
    //     ]);
    // }

    // public function show($slug)
    // {
    //     return view('post', [
    //         "title" => "Single Post",
    //         "posts" => Post::find($slug)
    //     ]);
    // }


    public function index()
    {
        return view('posts', [
            "title" => "All Post",
            "active" => "post",
            // "posts" => Post::all()

            // Mengambil data yang terbaru

            // with : untuk mengatasi lazy load pada n+1 problem
            "posts" => Post::latest()->search(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
        ]);
    }
    public function show(Post $post)
    {
        return view('post', [
            "title" => "Single Post",
            "active" => "post",
            "posts" => $post
        ]);
    }
}
