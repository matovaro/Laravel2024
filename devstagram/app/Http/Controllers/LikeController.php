<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct() {
        // Esto hace que se valide que el usuario este autenticado para que pueda acceder a los post
        $this->middleware('auth');
    }

    // Se incluyen user y post dado que vienen en la ruta y se requieren en el almacenamiento. Deben estar en el mismo orden que en la ruta
    public function store(Request $request, Post $post)
    {
        // Forma #1 de crear registros

        Like::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id
        ]); 


        return back();
    }

    public function destroy(Request $request, Post $post){

        $like = $request->user()->likes()->where('post_id', $post->id);
        // Verifica que se cumpla con lo que se estipula en el Policy del modelo para el metodo delete
        //$this->authorize('delete', $like);

        $like->delete();


        return back();

    }
}
