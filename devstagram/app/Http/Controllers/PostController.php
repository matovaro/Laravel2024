<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct() {
        // Esto hace que se valide que el usuario este autenticado para que pueda acceder a los post
        $this->middleware('auth');
    }
    
    public function index(User $user){

        // PAginate muestra automaticamente la cantidad indicada y en blade se pasa al siguiente grupo con links()
        // Hay que ajustar tailwind.config.js para que tenga en cuenta las plantillas del paginador en vendor
        $posts = Post::where('user_id',$user->id)->paginate(8);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => ['required','max:255'],
            'descripcion' => ['required'],
            'imagen' => ['required']
        ]);

        // Forma #1 de crear registros

/*         Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]); */

        // Forma #2 de crear registros

        /*$post = new Post;
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save();*/

        // Forma #3 de crear registros (Requiere que se hayan definido los hasMany, belongsTo,... en los modelos) 

        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('post.index', ['user' => auth()->user()]);
    }
}
