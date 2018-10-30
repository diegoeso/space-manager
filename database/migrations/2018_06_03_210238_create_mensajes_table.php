<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('mensajes', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('solicitud_id')->unsigned();
        //     $table->integer('para')->unsigned();
        //     $table->integer('de')->unsigned();
        //     $table->string('asunto', 120);
        //     $table->text('mensaje');
        //     $table->boolean('leido')->default(0)->nullable();
        //     $table->boolean('estado')->default(0)->nullable();
        //     $table->foreign('solicitud_id')->references('id')->on('solicitudes')
        //         ->onDelete('cascade')
        //         ->onUpdate('cascade');
        //     $table->timestamps();
        // });
        Schema::create('mensajes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('solicitud_id')->unsigned()->nullable();
            $table->string('de');
            $table->string('para');
            $table->string('asunto')->nullable();
            $table->mediumText('mensaje')->nullable();
            $table->boolean('leido')->nullable();
            $table->boolean('delete_de_a')->nullable()->default(0);
            $table->boolean('delete_para_a')->nullable()->default(0);
            $table->boolean('delete_de_u')->nullable()->default(0);
            $table->boolean('delete_para_u')->nullable()->default(0);
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
        Schema::dropIfExists('mensajes');
    }
}
