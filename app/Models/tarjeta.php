<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tarjetas'; // Asegúrate de que el nombre de la tabla es correcto

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'UID',
        'tipo',
        'activo',
        'id_usuario',
    ];
}
