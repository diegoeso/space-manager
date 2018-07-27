<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fechaInicio'); //la fecha para cuando requiere la solicitud
            $table->date('fechaFin')->nullable();
            $table->time('horaInicio');
            $table->time('horaFin');
            $table->text('actividadAcademica');
            $table->integer('asistentesEstimados')->nullable();
            $table->integer('aproboSolicitud')->nullable();
            $table->integer('usuarioSolicitud')->unsigned()->nullable();
            $table->integer('estado')->default('0')->unsigned();
            $table->text('motivo')->default(null)->nullable(); //motivo de la cancelacion o rechazo
            $table->integer('area_id')->unsigned();
            $table->integer('tipoUsuario')->unsigned()->nullable();
            $table->integer('espacio_id')->unsigned();
            $table->boolean('notificacion')->default(0);

            $table->integer('tipoRegistro')->default('0');
            $table->string('docente', 120)->nullable();
            $table->string('grupo', 120)->nullable();
            $table->string('semestre', 120)->nullable();
            $table->integer('carrera')->nullable();
            $table->string('background', 120)->nullable();

            $table->foreign('espacio_id')->references('id')->on('espacios')->onDelete('cascade');
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
        Schema::dropIfExists('solicitudes');
    }
}
