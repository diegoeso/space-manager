<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cal1')->nullable()->default('1');
            $table->integer('cal2')->nullable()->default('1');
            $table->integer('cal3')->nullable()->default('1');
            $table->integer('cal4')->nullable()->default('1');
            $table->integer('cal5')->nullable()->default('1');
            $table->integer('solicitud_id')->unsigned();
            // Quien evalua
            $table->integer('evaluador')->unsigned();
            $table->integer('tipoCuentaEvaluador')->unsigned();
            // A quien evaluaron
            $table->integer('evaluado')->unsigned();
            $table->integer('tipoCuentaEvaluado')->unsigned();
            $table->integer('estado')->unsigned();
            $table->foreign('solicitud_id')->references('id')->on('solicitudes')->onDelete('cascade');
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
        Schema::dropIfExists('evaluaciones');
    }
}
