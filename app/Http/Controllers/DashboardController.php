<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    //
    public function index(){
        return view('dashboard-index');
    }

    public function profile(){
        return view('dashboard-profile');
    }

    public function edit_profile(Request $request){
        // validate INPUT (form) fields
        $request->validate([
            'name'=>'required|max:100',
            'email'=>'required|email',
            'profile'=>'max:1000',
            'upload'=>'image|max:500',
        ]);

        // if they filled out the password field
        if($request->post('password')) {
            $request->validate([
                'password'=>'min:6|max:15',
            ]);
            User::where('id', Auth::user()->id)->
            update([ // on the left: table column, on the right: form input
                'password' => Hash::make($request->post('password')),
            ]);
        }

        // update table fields/columns
        User::where('id', Auth::user()->id)->
        update([ // on the left: table column, on the right: form input
            'name'=>$request->post('name'),
            'email'=>$request->post('email'),
            'profile'=>$request->post('profile')
        ]);

        // photo
        if($request->file('upload')){
            // create random name with extension
            $new_file_name = rand(10, 99) . date('dmyhi') . '.' . $request->file('upload')->extension(); // 1150820211025.jpg
            // this physically uploads image
            Storage::putFileAs('public/profiles', $request->file('upload'), $new_file_name);

            // this saves random name you assigned earlier into the table posts' column "upload"

            User::where('id', Auth::user()->id)->
            update([ // on the left: table column, on the right: form input
                'photo'=>$new_file_name
            ]);
        }

        //squarebarackets because it's an array of data
        return redirect('view-profile');
    }

    public function view_profile(){
        return view('dashboard_view_profile');
    }
}
