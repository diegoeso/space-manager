<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudElementosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_elementos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->time('horaInicio');
            $table->time('horaFin');
            $table->integer('aproboSolicitud')->nullable();
            $table->integer('usuarioSolicitud')->unsigned();
            $table->integer('estado')->default('0')->unsigned();
            $table->integer('categoria_id')->unsigned();
            $table->integer('elemento_id')->unsigned();
            $table->integer('cantidad')->unsigned()->default(1);
            $table->integer('tipoUsuario')->unsigned()->nullable();
            $table->boolean('notificacion')->default(0);
            $table->foreign('elemento_id')->references('id')->on('elementos')->onDelete('cascade');
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
        Schema::dropIfExists('solicitud_elementos');
    }
}
