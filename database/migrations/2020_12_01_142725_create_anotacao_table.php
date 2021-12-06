<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnotacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Anotacao', function (Blueprint $table) {
            $table->id('AnotacaoID');
            $table->unsignedBigInteger('UsuarioIDFK');
            $table->integer('CriadorAnotacao');
            $table->string('Descricao', 600);
            $table->dateTime('DataCriacao');
            $table->boolean('Concluido')->nullable();
            $table->dateTime('DataConclusao')->nullable();

            $table->foreign('UsuarioIDFK')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Anotacao');
    }
}
