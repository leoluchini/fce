<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoAdIndTable extends Migration
{
    public function up()
    {
        Schema::create('info_ad_ind', function(Blueprint $table)
        {
            $table->integer('info_indicador_id')->unsigned();
            $table->integer('info_adicional_id')->unsigned();
            // claves foraneas
            $table->foreign('info_indicador_id')
                  ->references('id')
                  ->on('informacion_indicadores');
            $table->foreign('info_adicional_id')
                  ->references('id')
                  ->on('informacion_adicional');
        });
    }

    public function down()
    {
        Schema::dropIfExists('info_ad_ind');
    }
}
