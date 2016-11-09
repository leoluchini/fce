<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoExtraVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_extra_variables', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('lote_id')->unsigned();
            $table->integer('variable_id')->unsigned();
            $table->string('dato');
            $table->timestamps();
            // claves foraneas
            $table->foreign('lote_id')
                  ->references('id')
                  ->on('lotes')->onDelete('cascade');
            $table->foreign('variable_id')
                  ->references('id')
                  ->on('variables')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_extra_variables');
    }
}
