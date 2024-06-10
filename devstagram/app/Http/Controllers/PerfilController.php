<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
