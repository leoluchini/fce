<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadesTable extends Migration
{
    public function up()
    {
        Schema::create('unidades_medida', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('codigo');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('unidades_medida');
    }
}
