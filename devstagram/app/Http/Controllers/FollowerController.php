<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //

    public function store(User $user, Request $request){
        //Attach se usan en relaciones entre el mismo modelo, en este caso, usuarios. Sin embargo, se deben pasar los timestamps
        $user->followers()->attach(auth()->user(), ['created_at' => now(), 'updated_at' => now()]);

        return back();
    }

    public function destroy(User $user, Request $request){
        $user->followers()->detach(auth()->user(), ['created_at' => now(), 'updated_at' => now()]);

        return back();
    }
}
