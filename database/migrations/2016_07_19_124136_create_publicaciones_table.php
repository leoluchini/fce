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
            $table->text('descripcion')->nullable();
            $table->string('archivo');
            $table->text('palabras_clave')->nullable();
            $table->integer('anio_publicacion');
            $table->integer('categoria_id')->unsigned();
            $table->integer('orden')->nullable();
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
