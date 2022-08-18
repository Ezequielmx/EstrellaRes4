<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id('id');
            $table->string('usuario',50);
            $table->string('telefono');
            $table->string('codigo_res');
            $table->float('importe');
            $table->integer('cant_adul');
            $table->integer('cant_esp');
            $table->boolean('wppconf');
            $table->boolean('wpprecord');        
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
        Schema::dropIfExists('reservas');
    }
}