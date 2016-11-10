<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCamposLote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lotes', function ($table) {
            $table->string('archivo');
            $table->integer('estado')->default(0);
            $table->text('error')->nullable();
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lotes', function ($table) {
            $table->dropColumn('archivo');
            $table->dropColumn('estado');
            $table->dropColumn('error');
            $table->dropIndex('usuario_id');
            $table->dropColumn('usuario_id');
        });
    }
}
