<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    public static function datas()
    {
        return view('about', [
            "title" => "About",
            "active" => "about",
            "datas" => About::data()
        ]);
    }
}
