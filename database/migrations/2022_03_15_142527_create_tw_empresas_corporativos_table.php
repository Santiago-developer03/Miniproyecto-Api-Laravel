<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwEmpresasCorporativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tw_empresas_corporativos', function (Blueprint $table) {
            $table->id();
            $table->string('S_RazonSocial');
            $table->string('S_RFC');
            $table->string('S_Pais');
            $table->string('S_Estado');
            $table->string('S_Municipio');
            $table->string('S_ColoniaLocalidad');
            $table->string('S_Domicilio');
            $table->string('S_CodigoPostal');
            $table->string('S_UsoCFDI');
            $table->string('S_UrlRFC');
            $table->string('S_UrlActaConstitutiva');
            $table->tinyInteger('S_Activo');
            $table->string('Comentarios');
            $table->unsignedBigInteger('tw_corporativos_id');
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('tw_empresas_corporativos');
    }
}
