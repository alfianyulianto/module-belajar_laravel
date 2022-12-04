<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About
{
    use HasFactory;



    public static function data()
    {

        $data = [
            "name" => "Alfian Yuliano",
            "email" => "alfianyulianto36@gmail.com",
            "images" => "alfian.png"
        ];

        return $data;
    }
}
