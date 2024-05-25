<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct() {
        // Esto hace que se valide que el usuario este autenticado para que pueda acceder a los post
        $this->middleware('auth');
    }
    
    public function index(User $user){
        return view('dashboard', [
            'user' => $user
        ]);
    }

    public function create(){
        return view('posts.create');
    }
}
