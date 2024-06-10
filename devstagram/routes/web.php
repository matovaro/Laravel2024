<?php

use App\Http\Controllers\ComentarioController;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RegisterController;
use App\Models\Comentario;
use App\Models\Like;
use App\Models\Post;

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



Route::get('/edit-profile', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/edit-profile', [PerfilController::class, 'store'])->name('perfil.store');


Route::get('/change-password', [PerfilController::class, 'passwordForm'])->name('perfil.formPass');
Route::post('/change-password', [PerfilController::class, 'storePassword'])->name('perfil.storePassword');

// Si se tienen las mismas URL, el name aplica para multiples rutas
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

// POST para poder usar form para deslogueo y poner seguridad csrf
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post:uniqueHash}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/{user:username}/posts/{post:uniqueHash}', [ComentarioController::class, 'store'])->name('comentarios.store');

Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

//Al ponerlo dentro de llaves, el utiliza el modelo User
// Despues de los ':' se pone el atributo que deseamos que se muestre
Route::get('/{user:username}', [PostController::class, 'index'])->name('post.index');