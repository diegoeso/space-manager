<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementoSolicitudTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elemento_solicitud', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('solicitud_id')->unsigned();
            $table->integer('elemento_id')->unsigned();
            $table->integer('cantidad')->unsigned()->nullable();
            $table->boolean('estado')->default(false)->nullable();
            $table->foreign('solicitud_id')->references('id')
                ->on('solicitudes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('elemento_id')->references('id')->on('elementos')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('elemento_solicitud');
    }
}
