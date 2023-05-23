<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('solicitud_notas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('solnota_solicitud')->unsigned();
            //$table->bigInteger('solnota_usuario')->unsigned();
            $table->text('solnota_nota');
            $table->foreign('solnota_solicitud')->references('id')->on('solicitudes');
            //$table->foreign('solnota_usuario')->references('id')->on('usuarios');
            $table->timestamps();
            $table->softDeletes();
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
