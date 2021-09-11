<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ApiPostController extends Controller
{
    public function index(){
        return Post::all();
    }

    public function show(Post $post){
        return $post;
    }

    public function create(Request $request){
        //return Post::create($request->post());
        return 'test from create';
    }

    public function destroy(Post $post){
        $post->delete();
    }

    public function update(Post $post, Request $request){
        $post->update($request->post());
    }
}
