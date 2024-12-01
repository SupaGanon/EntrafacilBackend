<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class registro_acceso extends Model
{
    use HasFactory;

    protected $fillable = [
            'Nombre',
            'apellidoP',
            'apellidoM',
            'tipoClave',
            'tipoAcceso',
            'id_usuario',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}