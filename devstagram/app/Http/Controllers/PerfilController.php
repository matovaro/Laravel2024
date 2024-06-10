<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct() {
        // Esto hace que se valide que el usuario este autenticado para que pueda acceder a los post
        $this->middleware('auth');
    }

    public function index(){
        $user = auth()->user();
        return view('perfil.index', ['user' => $user]);
    }

    public function store(Request $request){

        // Se chequea que la contraseña suminsitrada sea la del usuario actual
        if(!(Hash::check($request->currentPassword, auth()->user()->password))){
            return back()->with('MensajePassword','Contraseña incorrecta');
        }
        //Modificar el request para tener validar usuario duplicado en formato URL - NO RECOMENDADO; HACER LO MINIMO POSIBLE
        $request->request->add(['username' => Str::slug($request->username)]);
        
        $this->validate($request, [
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users')->ignore(auth()->user()->id)],
            'email' => ['required', 'email', 'max:60', Rule::unique('users')->ignore(auth()->user())],
            'name' => ['required', 'max:30', 'alpha:ascii'],
            'currentPassword' => ['required', 'min:8']
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
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->imagen = $txtNombreImagen ?? auth()->user()->imagen ?? '';
        $usuario->save();

        return redirect()->route('post.index', ['user' => $usuario]);
    }

    public function passwordForm(){
        $user = auth()->user();
        return view('perfil.formPass', ['user' => $user]);
    }

    public function storePassword(Request $request){
        // Se chequea que la contraseña suminsitrada sea la del usuario actual
        if(!(Hash::check($request->currentPassword, auth()->user()->password))){
            return back()->with('MensajePassword','Contraseña incorrecta');
        }
        
        $this->validate($request, [
            'currentPassword' => ['required', 'min:8'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        $usuario = User::find(auth()->user()->id);

        $usuario->password = Hash::make($request->password);
        $usuario->save();

        return redirect()->route('post.index', ['user' => $usuario]);
    }
}
