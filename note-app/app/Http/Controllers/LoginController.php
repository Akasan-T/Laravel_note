<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APP\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function index() {
        return view("login.index");
    }

    function store(Request $request) {
        $email = $request["email"];
        $password = $request["password"];
    
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            $error = "メールアドレスまたはパスワードが間違っています";
            return view('login.index', compact("error"));
        }

        auth()->login($user);

        return redirect()->route("note");
    }
}
