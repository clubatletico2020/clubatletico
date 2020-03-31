<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo',120);
            $table->string('url',120);
            $table->text('descripcion');
            $table->string('link_pago',120);
            $table->dateTime('fecha_realizacion');
            $table->string('lugar_realizacion',120);
            $table->unsignedBigInteger('estado_id');

            $table->foreign('estado_id')->references('id')->on('estados');
            $table->rememberToken();
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
        Schema::dropIfExists('eventos');
    }
}
