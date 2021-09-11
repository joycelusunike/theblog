<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function create(Post $post, Request $request){
        //when you type a name of the class/model choose it from the list or press Enter
        // to access post id, add Post $post to the param section of your public function
        Comment::create([
            'user_id'=>Auth::user()->id,
            'post_id'=>$post->id,
            'comment'=>$request->post('comment'),
        ]);
        return back();
    }

}
