<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Tarjeta;

class TarjetaController extends Controller
{
    // Función para registrar una nueva tarjeta
    public function registrarUID(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'UID' => 'required|string|unique:tarjetas', // Cambia el nombre de la tabla aquí
            'tipo' => 'required|string',
            'id_usuario' => 'required|string|exists:users,id_usuario'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $tarjeta = new Tarjeta();
        $tarjeta->UID = $request->UID;
        $tarjeta->tipo = $request->tipo;
        $tarjeta->activo = true; // Por defecto, la tarjeta se registra como activa
        $tarjeta->id_usuario = $request->id_usuario;
        $tarjeta->save();

        return response()->json(['message' => 'Tarjeta registrada exitosamente'], 201);
    }

    // Función para editar el estado de activo de una tarjeta
    public function editarEstado(Request $request, $id)
    {
        $tarjeta = Tarjeta::find($id);

        if (!$tarjeta) {
            return response()->json(['error' => 'Tarjeta no encontrada'], 404);
        }

        $tarjeta->activo = !$tarjeta->activo; // Alternar el estado de activo
        $tarjeta->save();

        return response()->json(['message' => 'Estado de la tarjeta actualizado exitosamente'], 200);
    }

    // Función para borrar una tarjeta
    public function borrar($id)
    {
        $tarjeta = Tarjeta::find($id);

        if (!$tarjeta) {
            return response()->json(['error' => 'Tarjeta no encontrada'], 404);
        }

        $tarjeta->delete();

        return response()->json(['message' => 'Tarjeta borrada exitosamente'], 200);
    }
    public function obtenerPorUsuario($id_usuario) { 
        $tarjetas = Tarjeta::where('id_usuario', $id_usuario)->get(); 
        if ($tarjetas->isEmpty()) { 
            return response()->json(['error' => 'No se encontraron tarjetas para el usuario dado'], 404); } 
        return response()->json($tarjetas, 200); 
    }
    public function obtenerTodas() { 
        $tarjetas = Tarjeta::all(); 
        return response()->json($tarjetas, 200); 
    }
    public function Entrada($UID) { 
        $tarjetas = Tarjeta::where('UID', $UID)->get(); 
        if ($tarjetas->isEmpty()) { 
            return response()->json(['error' => 'No se encontraron tarjetas para el usuario dado'], 404); } 
        return response()->json($tarjetas, 200); 
    }
}
