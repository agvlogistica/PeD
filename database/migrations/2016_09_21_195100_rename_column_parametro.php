<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnParametro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parametros', function ($table) {
            $table->renameColumn('grupo', 'controle');
            $table->renameColumn('subgrupo', 'tipo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parametros', function ($table) {
            $table->renameColumn('controle', 'grupo');
            $table->renameColumn('tipo', 'subgrupo');
        });
    }
}
