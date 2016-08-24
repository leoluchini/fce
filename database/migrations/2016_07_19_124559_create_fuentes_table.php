<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuentesTable extends Migration
{
    public function up()
    {
        Schema::create('fuentes', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('sigla');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fuentes');
    }
}
