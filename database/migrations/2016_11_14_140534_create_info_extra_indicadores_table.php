<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoExtraIndicadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_extra_indicadores', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('lote_id')->unsigned();
            $table->integer('indicador_id')->unsigned();
            $table->string('dato');
            $table->timestamps();
            // claves foraneas
            $table->foreign('lote_id')
                  ->references('id')
                  ->on('lotes')->onDelete('cascade');
            $table->foreign('indicador_id')
                  ->references('id')
                  ->on('indicadores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_extra_indicadores');
    }
}
