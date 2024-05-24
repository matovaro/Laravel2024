<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
        $this->validate($request, [
            'email' => ['required', 'email', 'exists:users', 'max:60'],
            'password' => ['required', 'min:8']
        ]);

        if(!auth()->attempt($request->only('email','password'), $request->remember)){
            return back()->with('Mensaje','Credenciales incorrectas');
        }

        return redirect()->route('post.index', ['user' => auth()->user()]);
    }
}
