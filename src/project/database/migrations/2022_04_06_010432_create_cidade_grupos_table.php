<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCidadeGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cidade_grupos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cidades_id');
            $table->foreign('cidades_id')->references('id')->on('cidades');
            $table->unsignedBigInteger('grupos_id');
            $table->foreign('grupos_id')->references('id')->on('grupos');
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
        Schema::dropIfExists('cidade_grupos');
    }
}
