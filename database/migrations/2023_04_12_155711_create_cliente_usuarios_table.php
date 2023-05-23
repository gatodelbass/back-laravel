<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_usuarios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cliusu_cliente')->unsigned();
            $table->bigInteger('cliusu_usuario')->unsigned();
            $table->foreign('cliusu_cliente')->references('id')->on('clientes');
            $table->foreign('cliusu_usuario')->references('id')->on('users');
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
        //
    }
}
