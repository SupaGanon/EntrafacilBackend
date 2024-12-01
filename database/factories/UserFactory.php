<?php
// database/factories/UserFactory.php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_usuario' => $this->faker->userName,
            'nombre' => $this->faker->firstName,
            'apellidoP' => $this->faker->lastName,
            'apellidoM' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // contraseña predeterminada
            'remember_token' => Str::random(10),
            'rol' => 'usuario', // rol predeterminado
            'activo' => true,
        ];
    }
}
