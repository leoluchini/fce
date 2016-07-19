<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrecuenciasTable extends Migration
{
    public function up()
    {
        Schema::create('frecuencias', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('tipo');
            $table->string('codigo');
            $table->string('nombre');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('frecuencias');
    }
}
