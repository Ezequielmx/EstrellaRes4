<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generales', function (Blueprint $table) {
            $table->id('id');
            $table->string('imagen');
            $table->longText('speach');
            $table->integer('minutos');
            $table->float('precio');
            $table->float('precio_prom');
            $table->float('precio_seg');
            $table->integer('sobreventa');            
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
        Schema::dropIfExists('generales');
    }
}
