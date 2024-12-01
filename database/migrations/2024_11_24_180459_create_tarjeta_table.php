<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tarjetas', function (Blueprint $table) {
            $table->id();
            $table->string('UID');
            $table->string('tipo');
            $table->boolean('activo')->default(true);
            $table->string('id_usuario');
            $table->foreign('id_usuario')->references('id_usuario')->on('users')->onDelete('cascade');
            $table->timestamps(); // Añade las columnas created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('tarjetas');
    }
};

