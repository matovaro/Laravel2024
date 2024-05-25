<?php

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('principal');
});

// Si se tienen las mismas URL, el name aplica para multiples rutas
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

// POST para poder usar form para deslogueo y poner seguridad csrf
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

//Al ponerlo dentro de llaves, el utiliza el modelo User
// Despues de los ':' se pone el atributo que deseamos que se muestre
Route::get('/{user:username}', [PostController::class, 'index'])->name('post.index');

Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

