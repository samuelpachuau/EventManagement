<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthManager extends Controller
{
    function login(){

        return view("auth.login");
    }
    function loginPost(Request $request){

        $request->validate([
            "email"=> "required",
            "password"=> "required",
        ]);
        $credentials=$request->only("email","password");
         if (Auth::attempt($credentials)) {
         
        return redirect()->route('home')->with('success', 'Login successful');
    }

    return back()->with('error', 'Invalid login credentials');
    }
    function Register(){
        return view("auth.register");
    }
    function registerPost(Request $request){
    $validated = $request->validate([
        "email" => "required|email|unique:users,email",
        "password" => "required|min:6",
        "name" => "required|min:3",
    ]);

    $user = new User();
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->password = bcrypt($validated['password']); 
    if ($user->save()) {
        return redirect()->route("login")->with("success", "Registered successfully. Please login.");
    } else {
        return redirect()->route("register")->with("error", "Registration failed. Try again.");
    }
}
}