<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tarjeta;

class tarjetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tarjeta = new tarjeta();
        $tarjeta -> UID = "44848E71";
        $tarjeta -> tipo = "Master";
        $tarjeta -> activo = true;
        $tarjeta -> id_usuario = "AleAdm";
        $tarjeta -> save();

        $tarjeta = new tarjeta();
        $tarjeta -> UID = "93D0440E";
        $tarjeta -> tipo = "Master";
        $tarjeta -> activo = true;
        $tarjeta -> id_usuario = "ErickAdm";
        $tarjeta -> save();
        
        $tarjeta = new tarjeta();
        $tarjeta -> UID = "0370310E";
        $tarjeta -> tipo = "Usuario";
        $tarjeta -> activo = true;
        $tarjeta -> id_usuario = "Test1";
        $tarjeta -> save();
    }
}
