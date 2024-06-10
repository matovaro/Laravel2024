<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct() {
        // Esto hace que se valide que el usuario este autenticado para que pueda acceder a los post
        $this->middleware('auth')->except(['show','index']);
    }

    public function index(){
        $user = auth()->user();
        return view('perfil.index', ['user' => $user]);
    }

    public function store(Request $request){
        //Modificar el request para tener validar usuario duplicado en formato URL - NO RECOMENDADO; HACER LO MINIMO POSIBLE
        $request->request->add(['username' => Str::slug($request->username)]);
        
        $this->validate($request, [
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users')->ignore(auth()->user()->id)]
        ]);

        if($request->imagen){
            $imagen = $request->file('imagen');

            $txtNombreImagen = Str::uuid() . "." . $imagen->extension();
    
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);
    
            $imagenPath = public_path('perfiles') . "/" . $txtNombreImagen;
            $imagenServidor->save($imagenPath);
        }

        $usuario = User::find(auth()->user()->id);

        $usuario->username = $request->username;
        $usuario->imagen = $txtNombreImagen ?? auth()->user()->imagen ?? '';
        $usuario->save();

        return redirect()->route('post.index', ['user' => $usuario]);
    }
}
