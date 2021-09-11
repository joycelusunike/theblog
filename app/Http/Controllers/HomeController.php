<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller
{
    public function index(){
        return view('home-index');
    }
    public function register(){
        return view('home-register');
    }
    public function register_process(Request $request){ //save whatever comes from the form with $request
        $request->validate([
            'name'=>'Required|min:5|max:150',
            'email'=>'Required|email|unique:users,email',
            'password'=>'Required|min:6|max:15',
            'password2'=>'same:password',
            'newsletter'=>'Required'
        ]);
        User::create([ //in array it's double arrow
            'name'=>$request->post('name'),
            'email'=>$request->post('email'),
            'password'=>Hash::make($request->post('password')),
        ]);
        return redirect('login');
    }
    public function login(){
        return view('home-login'); // include / require, it just includes a file
    }
    public function login_process(Request $request){
        if (Auth::attempt($request->only('email','password'))){
            return redirect('dashboard'); // goes to https://yourwebsite.com/dashboard
        }
    }

    public function facebookCallback(){
        $fb_user = Socialite::driver('facebook')->user();
        //print_r($fb_user);

        $user = User::where([
            'fb_id' => $fb_user->getId()
        ])->first();

        if ($user) {
            Auth::login($user);
            return redirect('dashboard');
        } else {
            $new_user = User::create([
                'name' => $fb_user->getName(),
                'email' => $fb_user->getEmail(),
                'password' => Hash::make(Str::random()),
                'fb_id' => $fb_user->getId()
            ]);
            Auth::login($new_user);
            return redirect('dashboard');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }
}
