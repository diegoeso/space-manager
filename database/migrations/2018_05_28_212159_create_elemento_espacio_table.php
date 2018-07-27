<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementoEspacioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elemento_espacio', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('espacio_id')->unsigned();
            $table->integer('elemento_id')->unsigned();
            $table->integer('cantidad')->nullable()->unsigned();
            $table->foreign('espacio_id')->references('id')
                ->on('espacios')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('elemento_id')->references('id')
                ->on('elementos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('elemento_espacio');
    }
}
