<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function __construct() {
        // Esto hace que se valide que el usuario este autenticado para que pueda acceder a los post
        $this->middleware('auth');
    }

    // Se incluyen user y post dado que vienen en la ruta y se requieren en el almacenamiento. Deben estar en el mismo orden que en la ruta
    public function store(Request $request, User $user, Post $post)
    {
        $this->validate($request, [
            'comentario' => ['required','max:255']
        ]);

        // Forma #1 de crear registros

        Comentario::create([
            'comentario' => $request->comentario,
            'user_id' => auth()->user()->id,
            'post_id' => $post->id
        ]); 


        return back()->with('Mensaje', 'Haz dejado tu marca');
    }
}
