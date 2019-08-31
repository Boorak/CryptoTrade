<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoCandlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('so_candles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pair_id');
            $table->unsignedInteger('time_frame');
            $table->bigInteger('o');
            $table->bigInteger('c');
            $table->bigInteger('h');
            $table->bigInteger('l');
            $table->bigInteger('v');
            $table->bigInteger('t')->unique();
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
        Schema::dropIfExists('so_candles');
    }
}
