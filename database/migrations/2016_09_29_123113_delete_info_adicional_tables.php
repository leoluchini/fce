<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteInfoAdicionalTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('info_ad_ind');
        Schema::dropIfExists('info_ad_var');
        Schema::dropIfExists('datos_adicionales');
        Schema::dropIfExists('informacion_adicional');
        Schema::dropIfExists('informacion_adicional_indicadores');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('informacion_adicional', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
        });
        Schema::create('datos_adicionales', function(Blueprint $table)
        {
            $table->increments('id');
            $table->text('descripcion');
            $table->integer('informacion_id')->unsigned();
            $table->timestamps();
            // claves foraneas
            $table->foreign('informacion_id')
                  ->references('id')
                  ->on('informacion_adicional');
        });
        Schema::create('info_ad_var', function(Blueprint $table)
        {
            $table->integer('info_variable_id')->unsigned();
            $table->integer('info_adicional_id')->unsigned();
            // claves foraneas
            $table->foreign('info_variable_id')
                  ->references('id')
                  ->on('informacion_variables');
            $table->foreign('info_adicional_id')
                  ->references('id')
                  ->on('informacion_adicional');
        });
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
        Schema::create('informacion_adicional_indicadores', function(Blueprint $table)
        {
            $table->integer('informacion_indicador_id')->unsigned();
            $table->integer('informacion_adicional_id')->unsigned();
        });
    }
}
