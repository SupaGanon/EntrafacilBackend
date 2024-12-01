<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tarjeta;
use App\Models\Pin_acceso;
use App\Models\Registro_acceso;
use App\Models\Visita_acceso;
use App\Models\User;

class registro_accesoController extends Controller
{
    public function registro_acceso($id_acceso) {
        if (empty($id_acceso)) {
            return response()->json(['error' => 'No se encontraron clave de acceso válida'], 404);
        }

        if (mb_strlen($id_acceso) >= 8) {
            $tarjeta = Tarjeta::where('UID', $id_acceso)->first();
            if (!$tarjeta) {
                return response()->json(['error' => 'No se encontraron clave de acceso válida'], 404);
            }

            $user = User::where('id_usuario', $tarjeta->id_usuario)->first();
            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }

            Registro_acceso::create([
                'Nombre' => $user->nombre,
                'apellidoP' => $user->apellidoP,
                'apellidoM' => $user->apellidoM,
                'fecha_registro' => now(),
                'tipoClave' => 'tarjeta',
                'tipoAcceso' => $user->rol,
                'id_usuario' => $tarjeta->id_usuario,
            ]);

            return response()->json(['message' => 'Registro de acceso creado con éxito', 'Activo'=>$tarjeta->activo,'id_usuario'=>$tarjeta->id_usuario], 200);
        } else {
            $pin = Pin_acceso::where('pinUsuario', $id_acceso)->first();
            if (!$pin) {
                $pinVisita = Visita_acceso::where('pinVisita', $id_acceso)->first();
                if (!$pinVisita) {
                    return response()->json(['error' => 'No se encontraron clave de acceso válida'], 404);
                }

                $user = User::where('id_usuario', $pinVisita->id_usuario)->first();
                if (!$user) {
                    return response()->json(['error' => 'Usuario no encontrado'], 404);
                }

                Registro_acceso::create([
                    'Nombre' => $user->nombre,
                    'apellidoP' => $user->apellidoP,
                    'apellidoM' => $user->apellidoM,
                    'fecha_registro' => now(),
                    'tipoClave' => 'Pin',
                    'tipoAcceso' => 'Visitante',
                    'id_usuario' => $pinVisita->id_usuario,
                ]);

                return response()->json(['message' => 'Registro de acceso creado con éxito','nombre'=>$user->nombre,'id_usuario'=>$pinVisita->id_usuario], 200);
            }

            $user = User::where('id_usuario', $pin->id_usuario)->first();
            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }

            Registro_acceso::create([
                'Nombre' => $user->nombre,
                'apellidoP' => $user->apellidoP,
                'apellidoM' => $user->apellidoM,
                'fecha_registro' => now(),
                'tipoClave' => 'Pin',
                'tipoAcceso' => $user->rol,
                'id_usuario' => $pin->id_usuario,
            ]);

            return response()->json(['message' => 'Registro de acceso creado con éxito','nombre'=>$user->nombre,'id_usuario'=>$pin->id_usuario], 200);
        }
    }
}
