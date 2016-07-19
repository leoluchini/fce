<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosAdicionalesTable extends Migration
{

    public function up()
    {
        Schema::create('datos_adicionales', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('descripcion');
            $table->integer('informacion_id')->unsigned();
            $table->timestamps();
            // claves foraneas
            $table->foreign('informacion_id')
                  ->references('id')
                  ->on('informacion_adicional');
        });
    }

    public function down()
    {
        Schema::dropIfExists('datos_adicionales');
    }
}
