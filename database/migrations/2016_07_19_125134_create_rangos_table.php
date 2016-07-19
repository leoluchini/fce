<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRangosTable extends Migration
{
    public function up()
    {
        Schema::create('rangos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->float('valor_inicio');
            $table->float('valor_fin');
            $table->string('descripcion');
            $table->integer('asociacion_id')->unsigned();
            $table->timestamps();

            // claves foraneas
            $table->foreign('asociacion_id')
                  ->references('id')
                  ->on('asociacion_rangos')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rangos');
    }
}
