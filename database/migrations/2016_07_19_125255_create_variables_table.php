<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariablesTable extends Migration
{
    public function up()
    {
        Schema::create('variables', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('codigo');
            $table->string('nombre');
            $table->text('descripcion');
            $table->integer('padre_id')->unsigned();
            $table->integer('asociacion_rango_id')->unsigned();
            $table->timestamps();
            // claves foraneas
            $table->foreign('padre_id')
                  ->references('id')
                  ->on('variables');
            $table->foreign('asociacion_rango_id')
                  ->references('id')
                  ->on('asociacion_rangos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('variables');
    }
}
