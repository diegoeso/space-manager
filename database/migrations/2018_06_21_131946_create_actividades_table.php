<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->time('horaInicio');
            $table->time('horaFin');
            $table->text('actividadAcademica');
            $table->integer('estado')->default('0')->unsigned();
            $table->string('docente', 120)->nullable();
            $table->string('grupo', 120)->nullable();
            $table->string('semestre', 120)->nullable();
            $table->integer('carrera')->unsigned();
            $table->integer('area_id')->unsigned();
            $table->integer('espacio_id')->unsigned();
            $table->integer('tipoRegistro')->default('1');
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
        Schema::dropIfExists('actividades');
    }
}
