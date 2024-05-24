<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //dd($request);
        //dd($request->get('username'));

        //Modificar el request para tener validar usuario duplicado en formato URL - NO RECOMENDADO; HACER LO MINIMO POSIBLE
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'name' => ['required', 'max:30', 'alpha:ascii'],
            'username' => ['required', 'unique:users', 'min:3', 'max:20'],
            'email' => ['required', 'email', 'unique:users', 'max:60'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username, //Slug lo pone en formato URL
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //Autenticar usuario
        /* auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]); */

        auth()->attempt($request->only('name', 'password'));

        return redirect()->route('post.index', ['user' => auth()->user()]);
    }
}
