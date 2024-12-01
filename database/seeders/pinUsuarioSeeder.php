<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\pin_acceso;

class pinUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pinUsuario = new pin_acceso();
        $pinUsuario -> PinUsuario = "8912";
        $pinUsuario -> id_usuario = "AleAdm";
        $pinUsuario -> save();
    }
}
