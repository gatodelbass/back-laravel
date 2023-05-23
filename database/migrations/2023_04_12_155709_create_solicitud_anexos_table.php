<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudAnexosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('solicitud_anexos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('solanexo_solicitud')->unsigned();
            $table->bigInteger('solanexo_tipo')->unsigned();
            $table->string('solanexo_nombrearchivo')->nullable();
            $table->string('solanexo_anexo')->nullable();
            $table->foreign('solanexo_solicitud')->references('id')->on('solicitudes');
            $table->foreign('solanexo_tipo')->references('id')->on('anexo_tipos');
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
