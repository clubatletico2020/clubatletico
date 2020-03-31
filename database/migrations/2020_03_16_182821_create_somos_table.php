<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSomosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('somos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('fundacion')->nullable();
            $table->string('url_fundacion',200)->nullable();
            $table->text('mision')->nullable();
            $table->text('vision')->nullable();
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
        Schema::dropIfExists('somos');
    }
}
