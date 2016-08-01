<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicadoresTable extends Migration
{
    public function up()
    {
        Schema::create('indicadores', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('codigo');
            $table->string('nombre');
            $table->string('descripcion');
            $table->integer('padre_id')->unsigned();
            $table->timestamps();
            // claves foraneas
            $table->foreign('padre_id')
                  ->references('id')
                  ->on('indicadores');
        });
    }

    public function down()
    {
        Schema::dropIfExists('indicadores');
    }
}
