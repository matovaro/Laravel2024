<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id',
        'uniqueHash'
    ];

    public function user(){
        // El select filtra la ifnormación que deseamos que se muestre cuando se hace el llamado al metodo
        // Si por alguna razon, no se usaran nombres en ingles, los metodos tienen un segundo parametro para definir con cual columna se hace la relacion
        return $this->belongsTo(User::class)->select(['name','username']);
    }

    public function comentarios(){
        return $this->hasMany(Comentario::class)->latest();
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user){
        return $this->likes->contains('user_id', $user->id);
    }
}
