<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelacionTema extends Migration
{
    public function up()
    {
        Schema::table('variables', function ($table) {
            $table->integer('tema_id')->unsigned()->nullable();
            $table->foreign('tema_id')->references('id')->on('temas');
        });
    }

    public function down()
    {
        Schema::table('variables', function ($table) {
            $table->dropForeign(['tema_id']);
            $table->dropColumn('tema_id');  
        });
    }
}
