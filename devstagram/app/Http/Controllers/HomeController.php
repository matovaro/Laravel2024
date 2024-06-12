<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct() {
        // Esto hace que se valide que el usuario este autenticado para que pueda acceder a los post
        $this->middleware('auth');
    }

    public function __invoke()
    {
        // Obtener a quienes seguimos

        $follows = auth()->user()->follows->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $follows)->latest()->paginate(20);
        return view('home', ['posts' => $posts]);
    }
}
