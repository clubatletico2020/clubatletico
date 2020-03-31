<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('direccion',100)->nullable();
            $table->string('link_mapa',100)->nullable();
            $table->string('telefono',100)->nullable();
            $table->string('celular',100)->nullable();
            $table->string('correo_contacto',100)->unique()->nullable();
            $table->unsignedBigInteger('prefijo_id')->nullable();

            $table->foreign('prefijo_id')->references('id')->on('prefijos');
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
        Schema::table('contactos', function (Blueprint $table) {
            //
        });
    }
}
