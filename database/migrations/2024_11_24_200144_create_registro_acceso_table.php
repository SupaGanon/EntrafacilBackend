<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('registro_accesos', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->string('apellidoP');
            $table->string('apellidoM');
            $table->timestamps();
            $table->string('tipoClave');
            $table->string('tipoAcceso');
            $table->string('id_usuario');
            $table->foreign('id_usuario')->references('id_usuario')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('registro_accesos');
    }
};

