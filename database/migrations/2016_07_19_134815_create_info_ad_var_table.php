<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoAdVarTable extends Migration
{

    public function up()
    {
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
    }

    public function down()
    {
        Schema::dropIfExists('info_ad_var');
    }
}
