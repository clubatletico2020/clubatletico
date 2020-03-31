<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrefijosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefijos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre',120);

            $table->timestamps();
            $table->rememberToken();
        });

        DB::table('prefijos')->insert(['nombre' =>'41']);
        DB::table('prefijos')->insert(['nombre' =>'2']);
        DB::table('prefijos')->insert(['nombre' =>'32']);
        DB::table('prefijos')->insert(['nombre' =>'33']);
        DB::table('prefijos')->insert(['nombre' =>'34']);
        DB::table('prefijos')->insert(['nombre' =>'35']);
        DB::table('prefijos')->insert(['nombre' =>'39']);
        DB::table('prefijos')->insert(['nombre' =>'42']);
        DB::table('prefijos')->insert(['nombre' =>'43']);
        DB::table('prefijos')->insert(['nombre' =>'44']);
        DB::table('prefijos')->insert(['nombre' =>'45']);
        DB::table('prefijos')->insert(['nombre' =>'51']);
        DB::table('prefijos')->insert(['nombre' =>'52']);
        DB::table('prefijos')->insert(['nombre' =>'53']);
        DB::table('prefijos')->insert(['nombre' =>'55']);
        DB::table('prefijos')->insert(['nombre' =>'57']);
        DB::table('prefijos')->insert(['nombre' =>'58']);
        DB::table('prefijos')->insert(['nombre' =>'61']);
        DB::table('prefijos')->insert(['nombre' =>'63']);
        DB::table('prefijos')->insert(['nombre' =>'64']);
        DB::table('prefijos')->insert(['nombre' =>'65']);
        DB::table('prefijos')->insert(['nombre' =>'67']);
        DB::table('prefijos')->insert(['nombre' =>'68']);
        DB::table('prefijos')->insert(['nombre' =>'71']);
        DB::table('prefijos')->insert(['nombre' =>'72']);
        DB::table('prefijos')->insert(['nombre' =>'73']);
        DB::table('prefijos')->insert(['nombre' =>'75']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfijos');
    }
}
