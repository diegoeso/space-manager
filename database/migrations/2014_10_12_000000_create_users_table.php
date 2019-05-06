<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 45);
            $table->string('apellidoP', 45);
            $table->string('apellidoM', 45)->nullable();
            $table->string('nickname', 45)->unique()->nullable();
            $table->string('email', 120)->unique();
            $table->string('password', 120);
            $table->boolean('confirmacion')->default(0)->nullable();
            $table->integer('tipoCuenta');
            $table->string('telefono', 12)->unzigned()->nullable();
            $table->string('foto', 120)->nullable();
            $table->string('nombreCompleto', 191)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
