<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funciones', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('evento_id');
            $table->unsignedBigInteger('tema_id');

            $table->date('fecha');
            $table->time('horario');
            $table->integer('capacidad');

            //$table->foreign('evento_id')->references('id')->on('eventos')->onDelete('cascade');
            //$table->foreign('tema_id')->references('id')->on('temas')->onDelete('cascade');

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
        Schema::dropIfExists('funciones');
    }
}
