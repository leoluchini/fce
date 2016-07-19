<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicacionesTable extends Migration
{
    public function up()
    {
        Schema::create('publicaciones', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('path');
            $table->string('palabras_clave');
            $table->integer('anio_publicacion');
            $table->integer('categoria_id')->unsigned();
            $table->integer('orden');
            $table->timestamps();
            
            // claves foraneas
            $table->foreign('categoria_id')
                  ->references('id')
                  ->on('categorias')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('publicaciones');
    }
}
