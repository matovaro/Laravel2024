<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComentarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all()->pluck('id')->toArray();
        $posts = Post::all()->pluck('id')->toArray();
        return [
            'comentario' => $this->faker->sentence(5),
            'user_id' => $this->faker->randomElement($users),
            'post_id' => $this->faker->randomElement($posts)
        ];
    }
}
