<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformacionIndicadoresTable extends Migration
{
    public function up()
    {
        Schema::create('informacion_indicadores', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('anio');
            $table->float('valor');
            $table->integer('indicador_id')->unsigned();
            $table->integer('unidad_medida_id')->unsigned();
            $table->integer('frecuencia_id')->unsigned();
            $table->integer('fuente_id')->unsigned();
            $table->integer('zona_id')->unsigned();
            $table->timestamps();
            
            // claves foraneas
            $table->foreign('indicador_id')
                  ->references('id')
                  ->on('indicadores');
            $table->foreign('unidad_medida_id')
                  ->references('id')
                  ->on('unidades_medida');
            $table->foreign('frecuencia_id')
                  ->references('id')
                  ->on('frecuencias');
            $table->foreign('fuente_id')
                  ->references('id')
                  ->on('fuentes');
            $table->foreign('zona_id')
                  ->references('id')
                  ->on('zonas_geograficas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('informacion_indicadores');
    }
}
