<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinAccesoTable extends Migration
{
    public function up()
    {
        Schema::create('pin_accesos', function (Blueprint $table) {
            $table->id();
            $table->string('pinUsuario');
            $table->timestamps();
            $table->string('id_usuario');
            $table->foreign('id_usuario')->references('id_usuario')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pin_accesos');
    }
}
