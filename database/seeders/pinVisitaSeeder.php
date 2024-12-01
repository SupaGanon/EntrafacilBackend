<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\visita_acceso;

class pinVisitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pinVisita = new visita_acceso();
        $pinVisita -> nombre = "Angel";
        $pinVisita -> apellidoP = "Master";
        $pinVisita -> apellidoM = "Evans";
        $pinVisita -> PinVisita = "1650";
        $pinVisita -> id_usuario = "AleAdm";
        $pinVisita -> save();

    }
}
