<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadesTable extends Migration
{
    public function up()
    {
        Schema::create('unidad_medidas', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('codigo');
            $table->string('nombre');
            $table->text('descripcion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('unidad_medidas');
    }
}
