<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Toma los id de los usuarios y los convierte a array para usarlos en el factory
        $users = User::all()->pluck('id')->toArray();
        return [
            'titulo' => $this->faker->sentence(3),
            'descripcion' => $this->faker->sentence(20),
            'imagen' => $this->faker->uuid() . '.jpg',
            'user_id' => $this->faker->randomElement($users)
        ];
    }
}
