<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo',40);
            $table->text('descripcion');
            $table->string('url',100);
            $table->unsignedBigInteger('estado_id');
            $table->unsignedBigInteger('usuario_id');
            $table->date('fecha_noticia');
            $table->rememberToken();

            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('noticias');
    }
}
