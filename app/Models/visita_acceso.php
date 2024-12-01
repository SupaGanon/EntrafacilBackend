<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class visita_acceso extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pin_visitas'; // Asegúrate de que el nombre de la tabla es correcto

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellidoP',
        'apellidoM',
        'pinVisita',
        'usuario_id',
    ];
}
