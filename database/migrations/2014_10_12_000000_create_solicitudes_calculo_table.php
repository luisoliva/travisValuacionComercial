<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudesCalculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Solicitudes_calculos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('colonia');
            $table->float('m2_terreno');
            $table->float('m2_construido');
            $table->string('acabados');
            $table->string('conservacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
