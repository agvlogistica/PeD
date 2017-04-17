<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParametrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('grupo');
            $table->string('subgrupo')->nullable();
            $table->integer('item')->nullable();
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('grupo_id')->unsigned()->nullable();
            $table->string('parametro');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });

        Schema::table('parametros', function (Blueprint $table) {
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('grupo_id')->references('id')->on('grupos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parametros');
    }
}
