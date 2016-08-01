<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsociacionRangosTable extends Migration
{
    public function up()
    {
        Schema::create('asociacion_rangos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('orden');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asociacion_rangos');
    }
}
