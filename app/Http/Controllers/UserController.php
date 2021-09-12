<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('user-index',[
            'users'=>$users,
                'title'=>'All Users',
            ]
        );
    }

    public function delete(User $user){
        $user->delete();
        return back();
    }
}
