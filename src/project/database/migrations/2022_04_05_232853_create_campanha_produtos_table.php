<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampanhaProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campanha_produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campanhas_id');
            $table->foreign('campanhas_id')->references('id')->on('campanhas');
            $table->unsignedBigInteger('produtos_id');
            $table->foreign('produtos_id')->references('id')->on('produtos');
            $table->unsignedBigInteger('descontos_id')->nullable();
            $table->foreign('descontos_id')->references('id')->on('descontos');
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
        Schema::dropIfExists('campanha_produtos');
    }
}
