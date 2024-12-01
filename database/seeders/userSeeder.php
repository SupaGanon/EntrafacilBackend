<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->id_usuario = "AleAdm";
        $user->nombre = "Alejandro";
        $user->apellidoP = "Miranda";
        $user->apellidoM = "Esparza";
        $user->email = "alejandro.miranda@gmail.com";
        $user->password = Hash::make("12345678"); // Asegúrate de hashear la contraseña
        $user->rol = "admin";
        $user->activo = true;
        $user->save();

        $user = new User();
        $user->id_usuario = "ErickAdm";
        $user->nombre = "Erick";
        $user->apellidoP = "Ramirez";
        $user->apellidoM = "Gurrola";
        $user->email = "erick@mail.com";
        $user->password = Hash::make("12345678"); // Asegúrate de hashear la contraseña
        $user->rol = "admin";
        $user->activo = true;
        $user->save();

        $user = new User();
        $user->id_usuario = "Test1";
        $user->nombre = "Test";
        $user->apellidoP = "prueba";
        $user->apellidoM = "Prueba";
        $user->email = "test@mail.com";
        $user->password = Hash::make("12345678"); // Asegúrate de hashear la contraseña
        $user->rol = "usuario";
        $user->activo = true;
        $user->save();
    }
}
