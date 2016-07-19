<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformacionAdicionalIndicadoresTable extends Migration
{
    public function up()
    {
        Schema::create('informacion_adicional_indicadores', function(Blueprint $table)
        {
            $table->integer('informacion_indicador_id')->unsigned();
            $table->integer('informacion_adicional_id')->unsigned();
            // claves foraneas
            $table->foreign('informacion_indicador_id')
                  ->references('id')
                  ->on('informacion_indicadores');
            $table->foreign('informacion_adicional_id')
                  ->references('id')
                  ->on('informacion_adicional');
        });
    }

    public function down()
    {
        Schema::dropIfExists('informacion_adicional_indicadores');
    }
}
