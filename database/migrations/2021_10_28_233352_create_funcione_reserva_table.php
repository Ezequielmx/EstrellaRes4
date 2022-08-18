<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncioneReservaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcione_reserva', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('funcione_id');
            $table->unsignedBigInteger('reserva_id');

            //$table->foreign('funcione_id')->references('id')->on('funciones')->onDelete('cascade');
            //$table->foreign('reserva_id')->references('id')->on('reservas')->onDelete('cascade');


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
        Schema::dropIfExists('funcione_reserva');
    }
}
