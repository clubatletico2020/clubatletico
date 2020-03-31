<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotivoCorreosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motivo_correos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('motivo',120);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('motivo_correos')->insert(['motivo' => 'Capacitaciones']);
        DB::table('motivo_correos')->insert(['motivo' => 'Convenios']);
        DB::table('motivo_correos')->insert(['motivo' => 'Afiliación']);
        DB::table('motivo_correos')->insert(['motivo' => 'Otros']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motivo_correos');
    }
}
