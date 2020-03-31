<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_funcionarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cargo',120);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('tipo_funcionarios')->insert(['cargo' => 'Coach']);
        DB::table('tipo_funcionarios')->insert(['cargo' => 'Funcionario']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_funcionarios');
    }
}
