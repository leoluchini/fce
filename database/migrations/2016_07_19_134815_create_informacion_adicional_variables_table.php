<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformacionAdicionalVariablesTable extends Migration
{

    public function up()
    {
        Schema::create('informacion_adicional_variables', function(Blueprint $table)
        {
            $table->integer('informacion_variable_id')->unsigned();
            $table->integer('informacion_adicional_id')->unsigned();
            // claves foraneas
            $table->foreign('informacion_variable_id')
                  ->references('id')
                  ->on('informacion_variables');
            $table->foreign('informacion_adicional_id')
                  ->references('id')
                  ->on('informacion_adicional');
        });
    }

    public function down()
    {
        Schema::dropIfExists('informacion_adicional_variables');
    }
}
