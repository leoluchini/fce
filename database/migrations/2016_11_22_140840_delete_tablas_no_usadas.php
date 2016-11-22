<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteTablasNoUsadas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('variables', function ($table) {
            $table->dropForeign(['asociacion_rango_id']);
            $table->dropColumn('asociacion_rango_id');  
        });
        Schema::table('indicadores', function ($table) {
            $table->dropForeign(['asociacion_rango_id']);
            $table->dropColumn('asociacion_rango_id');  
        });
        Schema::dropIfExists('rangos');
        Schema::dropIfExists('asociacion_rangos');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('asociacion_rangos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('orden');
            $table->timestamps();
        });
        Schema::create('rangos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->float('valor_inicio');
            $table->float('valor_fin');
            $table->text('descripcion')->nullable();
            $table->integer('asociacion_id')->unsigned();
            $table->timestamps();

            // claves foraneas
            $table->foreign('asociacion_id')
                  ->references('id')
                  ->on('asociacion_rangos')
                  ->onDelete('cascade');
        });
        Schema::table('variables', function ($table) {
            $table->integer('asociacion_rango_id')->unsigned()->nullable();
            $table->foreign('asociacion_rango_id')->references('id')->on('asociacion_rangos')->onDelete('cascade');
        });
        Schema::table('indicadores', function ($table) {
            $table->integer('asociacion_rango_id')->unsigned()->nullable();
            $table->foreign('asociacion_rango_id')->references('id')->on('asociacion_rangos')->onDelete('cascade');
        });
    }
}
