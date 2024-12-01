<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\API'],function()
{
    // --------------- register and login ----------------//
    Route::controller(AuthenticationController::class)->group(function () {
        Route::post('register', 'register')->name('register');
        Route::post('login', 'login')->name('login');
        Route::post('login/out', 'logOut')->name('login/out');
    });
    // ------------------ get data ----------------------//
    Route::controller(AuthenticationController::class)->group(function () {
        Route::get('get-user', 'userInfo')->middleware('auth:api')->name('get-user');
        Route::middleware('auth:api')->get('/user', [AuthenticationController::class, 'user']);
        Route::get('/user1', function (Request $request) {
        return $request->user();
    })->middleware('auth:api');
    });

    
    

    Route::controller(TarjetaController::class)->group(function () {
        Route::post('registrarUID','registrarUID')->name('registrarUID');
        Route::put('editarEstado/{id}','editarEstado')->name('editarEstado');
        Route::delete('borrarTarjeta/{id}','borrar')->name('borrarTarjeta');
        Route::get('get-tarjetas', 'obtenerTodas')->name('obtenerTodas');
        Route::get('Entrada/{UID}', 'Entrada')->name('Entrada');
        Route::get('tarjetas/usuario/{id_usuario}', 'obtenerPorUsuario')->name('obtenerPorUsuario');
    });

    Route::controller(registro_accesoController::class)->group(function () {
        Route::get('registro_acceso/{id}','registro_acceso')->name('registro_acceso');
    });

});