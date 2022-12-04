<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\AdminCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home', [
        "title" => "Home",
        "active" => "home"
    ]);
});


Route::get('/about', [AboutController::class, 'datas']);

Route::get('/posts', [PostController::class, 'index']);

// single post
// Route::get('/post/{slug}', [PostController::class, 'show']);


Route::get('/post/{post:slug}', [PostController::class, 'show']);


// categories
Route::get('/categories', [CategoryController::class, 'index']);


// Route::get('/categories/{category:slug}', [CategoryController::class, 'show']);


// author
// Route::get('/authors/{author:username}', [UserController::class, 'show']);


// login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
//  authenticate login
Route::post('/login', [LoginController::class, 'authenticate']);

// register
Route::get('/register', [RegisterController::class, 'index'])->middleware(('guest'));
Route::post('/register', [RegisterController::class, 'store']);
// logout
Route::post('/logout', [LoginController::class, 'logout']);

// dashboard
Route::get('/dashboard', function () {
    return view('dashboard.index', [
        "title" => "Dashboard"
    ]);
})->middleware('auth');

Route::get('/dashboard/posts/createSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
// dashboard post
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// admin authorization
// except : digunakan untuk pengecualian method pada controller
// Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');

// admin authorisasi menggunakan gate
// except : artinya method show tidak digunakan
Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show');
