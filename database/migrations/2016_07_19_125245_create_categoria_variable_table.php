<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaVariableTable extends Migration
{
    public function up()
    {
        Schema::create('categorias_variables', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('codigo');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->integer('categoria_padre_id')->unsigned()->nullable()->default(null);
            $table->timestamps();
            // claves foraneas
            $table->foreign('categoria_padre_id')
                  ->references('id')
                  ->on('categorias_variables');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categorias_variables');
    }
}
