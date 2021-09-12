<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
//Facebook login staff


Route::get('/login/facebook', function () {
    return Socialite::driver('facebook')->redirect();
})->middleware('guest');

Route::get('/login/facebook/callback', [\App\Http\Controllers\HomeController::class, 'facebookCallback'])->middleware('guest');

Route::get('/',[\App\Http\Controllers\HomeController::class,'index']);
Route::get('/register',[App\Http\Controllers\HomeController::class,'register'])->middleware('guest');
Route::get('login',[\App\Http\Controllers\HomeController::class,'login'])->middleware('guest')->name('login');
Route::post('login',[\App\Http\Controllers\HomeController::class,'login_process'])->middleware('guest');
Route::get('logout',[\App\Http\Controllers\HomeController::class,'logout'])->middleware('auth');
Route::post('register',[\App\Http\Controllers\HomeController::class,'register_process'])->middleware('guest');
Route::get('dashboard',[\App\Http\Controllers\DashboardController::class,'index'])->middleware('auth');
Route::get('profile',[\App\Http\Controllers\DashboardController::class,'profile'])->middleware('auth');
Route::post('profile',[\App\Http\Controllers\DashboardController::class,'edit_profile'])->middleware('auth');
Route::get('view-profile',[\App\Http\Controllers\DashboardController::class,'view_profile'])->middleware('auth');
Route::get('category',[\App\Http\Controllers\CategoryController::class,'index'])->middleware('auth', 'admin');
Route::post('category',[\App\Http\Controllers\CategoryController::class,'create'])->middleware('auth', 'admin');
Route::get('post',[\App\Http\Controllers\PostController::class,'index'])->middleware('auth', 'admin');
Route::get('category/{category}',[\App\Http\Controllers\PostController::class,'showByCategory']);
Route::post('post',[\App\Http\Controllers\PostController::class,'create'])->middleware('auth', 'admin');
Route::post('edit/{post}',[\App\Http\Controllers\PostController::class,'edit_process'])->middleware('auth','admin');
Route::get('edit/{post}',[\App\Http\Controllers\PostController::class,'edit'])->middleware('auth','admin');
Route::get('posts',[\App\Http\Controllers\PostController::class,'all']);
Route::get('posts/{post}', [\App\Http\Controllers\PostController::class, 'show']);
Route::post('posts/{post}', [\App\Http\Controllers\CommentController::class, 'create'])->middleware('auth');
Route::get('delete/{post}',[\App\Http\Controllers\PostController::class,'delete'])->middleware('auth','admin');
Route::get('policy',function (){
    return view('facebook-privacy');
});
Route::get('delete-image/{post}',[\App\Http\Controllers\PostController::class,'delete_image'])->middleware('auth','admin');
//Testing GitHub

// what you see in the URL of the browser
// the controller and the function
