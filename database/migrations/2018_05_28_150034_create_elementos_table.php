<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elementos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 45);
            $table->text('descripcion')->nullable();
            $table->string('numeroInventario', 129)->unique();
            $table->integer('categoria_id')->unsigned();
            $table->integer('cantidad')->unsigned()->nullable();
            $table->integer('solicitados')->unsigned()->nullable();
            $table->integer('existencias')->unsigned()->nullable();
            $table->foreign('categoria_id')->references('id')->on('categoria_elementos')
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
        Schema::dropIfExists('elementos');
    }
}
