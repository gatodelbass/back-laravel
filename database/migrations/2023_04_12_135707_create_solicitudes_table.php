<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sol_cliente')->unsigned();
            $table->tinyInteger('sol_tipo');
            $table->string('sol_estado')->default("Solicitado");
            $table->string('sol_email');
            $table->string('sol_nombresolicitante');
            $table->text('sol_texto')->nullable();
            $table->text('sol_respuesta')->nullable();
            $table->foreign('sol_cliente')->references('id')->on('clientes');
            $table->date('sol_fecharespuesta')->nullable();
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
