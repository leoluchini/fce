<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelacionLote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zonas_geograficas', function ($table) {
            $table->integer('lote_id')->unsigned()->nullable();
            $table->foreign('lote_id')->references('id')->on('lotes')->onDelete('cascade');
        });
        Schema::table('unidades_medida', function ($table) {
            $table->integer('lote_id')->unsigned()->nullable();
            $table->foreign('lote_id')->references('id')->on('lotes')->onDelete('cascade');
        });
        Schema::table('variables', function ($table) {
            $table->integer('lote_id')->unsigned()->nullable();
            $table->foreign('lote_id')->references('id')->on('lotes')->onDelete('cascade');
        });
        Schema::table('informacion_variables', function ($table) {
            $table->integer('lote_id')->unsigned()->nullable();
            $table->foreign('lote_id')->references('id')->on('lotes')->onDelete('cascade');
        });
        Schema::table('fuentes', function ($table) {
            $table->integer('lote_id')->unsigned()->nullable();
            $table->foreign('lote_id')->references('id')->on('lotes')->onDelete('cascade');
        });
        Schema::table('categorias_variables', function ($table) {
            $table->integer('lote_id')->unsigned()->nullable();
            $table->foreign('lote_id')->references('id')->on('lotes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zonas_geograficas', function ($table) {
            $table->dropForeign(['lote_id']);
            $table->dropColumn('lote_id');  
        });
        Schema::table('unidades_medida', function ($table) {
            $table->dropForeign(['lote_id']);
            $table->dropColumn('lote_id');  
        });
        Schema::table('variables', function ($table) {
            $table->dropForeign(['lote_id']);
            $table->dropColumn('lote_id');  
        });
        Schema::table('informacion_variables', function ($table) {
            $table->dropForeign(['lote_id']);
            $table->dropColumn('lote_id');  
        });
        Schema::table('fuentes', function ($table) {
            $table->dropForeign(['lote_id']);
            $table->dropColumn('lote_id');  
        });
        Schema::table('categorias_variables', function ($table) {
            $table->dropForeign(['lote_id']);
            $table->dropColumn('lote_id');  
        });
    }
}