<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelacionIndicadores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indicadores', function ($table) {
            $table->integer('lote_id')->unsigned()->nullable();
            $table->foreign('lote_id')->references('id')->on('lotes')->onDelete('cascade');
            $table->integer('tema_id')->unsigned()->nullable()->default(null);
            $table->foreign('tema_id')->references('id')->on('temas');
        });
        Schema::table('informacion_indicadores', function ($table) {
            $table->integer('lote_id')->unsigned()->nullable();
            $table->foreign('lote_id')->references('id')->on('lotes')->onDelete('cascade');
        });
        Schema::table('categorias_indicadores', function ($table) {
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
        Schema::table('indicadores', function ($table) {
            $table->dropForeign(['lote_id']);
            $table->dropColumn('lote_id');
            $table->dropForeign(['tema_id']);
            $table->dropColumn('tema_id');
        });
        Schema::table('informacion_indicadores', function ($table) {
            $table->dropForeign(['lote_id']);
            $table->dropColumn('lote_id');  
        });
        Schema::table('categorias_indicadores', function ($table) {
            $table->dropForeign(['lote_id']);
            $table->dropColumn('lote_id');  
        });
    }
}
