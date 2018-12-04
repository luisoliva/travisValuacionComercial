<?php
/**
 * Created by PhpStorm.
 * User: benja
 * Date: 09/11/2018
 * Time: 10:00 PM
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValuationInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valuation_info', function (Blueprint $table) {
            $table->increments('colonia_id');
            $table->string('nombre_colonia')->unique();
            $table->float('valor_metro2');
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