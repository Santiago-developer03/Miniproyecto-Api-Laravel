<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwContactosCorporativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tw_contactos_corporativos', function (Blueprint $table) {
            $table->id();
            $table->string('S_Nombre');
            $table->string('S_Puesto');
            $table->string('S_Comentarios');
            $table->string('N_Portafolio');
            $table->integer('N_Telefonofijo');
            $table->integer('N_TelefonoMovil');
            $table->string('S_Email')->unique();
            $table->unsignedBigInteger('tw_corporativos_id');
            $table->timestamps();

            $table->foreign('tw_corporativos_id')->references('id')->on('tw_corporativos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tw_contactos_corporativos');
    }
}
