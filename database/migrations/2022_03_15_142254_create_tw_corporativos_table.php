<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwCorporativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tw_corporativos', function (Blueprint $table) {
            $table->id();
            $table->string('S_NombreCorto');
            $table->string('S_NombreCompleto');
            $table->string('S_LogoURL');
            $table->string('S_DBName');
            $table->string('S_DBUsuarios');
            $table->string('S_DBPassword');
            $table->string('S_SystemUrl');
            $table->tinyInteger('S_activo');
            $table->timestamp('D_FechaIncorporacion')->useCurrent();
            $table->unsignedBigInteger('users_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('users_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tw_corporativos');
    }
}
