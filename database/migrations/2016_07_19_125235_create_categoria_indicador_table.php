<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaIndicadorTable extends Migration
{
    public function up()
    {
        Schema::create('categorias_indicadores', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('codigo');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->integer('categoria_padre_id')->unsigned()->nullable();
            $table->timestamps();
            // claves foraneas
            $table->foreign('categoria_padre_id')
                  ->references('id')
                  ->on('categorias_indicadores');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categorias_indicadores');
    }
}
