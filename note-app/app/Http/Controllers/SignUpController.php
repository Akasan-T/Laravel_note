<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignUpController extends Controller
{
    function index() {
        return view("sign_up.index");
    }

    function store (Request $request) {
        $name = $request["name"];
        $email = $request["email"];
        $password = $request["password"];
        $passwordConfirmation = $request["passwordConfirmation"];

        if($password !== $passwordConfirmation) {
            $error = "パスワードが一致しません";
            return view("sign_up.index", compact("error"));
        }

        if(User::where('email', $email)->exists()) {
            $error = "即に登録されているメールアドレスです";
            return view("sign_up.index", compact("error"));
        }

        $user=User::create([
            'name'=>$name,
            'email'=>$email,
            'password'=>Hash::make($password),
        ]);

        auth()->login($user);

        return redirect()->route('note');
    }
}
