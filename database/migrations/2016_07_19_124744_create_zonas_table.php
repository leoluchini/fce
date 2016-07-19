<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonasTable extends Migration
{
    public function up()
    {
        Schema::create('zonas_geograficas', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('tipo');
            $table->string('codigo');
            $table->string('nombre');
            $table->string('descripcion');
            $table->integer('zona_padre_id')->unsigned();
            $table->timestamps();
            
            // claves foraneas
            $table->foreign('zona_padre_id')
                  ->references('id')
                  ->on('zonas_geograficas')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('zonas_geograficas');
    }
}
