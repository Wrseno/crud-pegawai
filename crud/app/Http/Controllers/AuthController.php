<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{

    public function register() {
        return view('auth.register');
    }

    public function postregister(Request $req) {
        User::create([
            'name' => $req -> name,
            'email' => $req -> email,
            'password'=> bcrypt($req->password),
            'remember_token'=> Str::random(60),
        ]);

        return redirect()->route('login');
    }

    public function login() {
        return view('auth.login');
    }

    public function postlogin(Request $req) {
        if(Auth::attempt($req->only('email','password'))) {
            return redirect('/');
        }
        return redirect('login');
    }

    public function logout() {
        Auth::logout();
        return redirect('login');
    }
}
