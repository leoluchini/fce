<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformacionAdicionalTable extends Migration
{

    public function up()
    {
        Schema::create('informacion_adicional', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('informacion_adicional');
    }
}
