<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// crud: create read update delete
Route::post('posts',[\App\Http\Controllers\ApiPostController::class,'create']);
Route::get('posts', [\App\Http\Controllers\ApiPostController::class, 'index']);
Route::get('posts/{post}',[\App\Http\Controllers\ApiPostController::class,'show']);
Route::delete('posts/{post}',[\App\Http\Controllers\ApiPostController::class,'destroy']);
Route::put('posts/{post}',[\App\Http\Controllers\ApiPostController::class,'update']);

/*
 * RESTful API in LARAVEL
 *
 * end point locally: http://theblog/api/
 * end point remotely: https://theblog.com/api/
 *
 * read certain post -  GET https://theblog.com/api/posts/1
 * read all posts -  GET https://theblog.com/api/posts
 * create new post - POST https://theblog.com/api/posts + data you want to create
 * update existing post - PUT https://theblog.com/api/posts/1 + data you want to update
 * {
    "user_id":"1",
    "category_id":"1",
    "title":"My Title",
    "featured":"My featured",
    "message":"My long message"
}
 * delete certain post - DELETE https://theblog.com/api/posts/1
 */
