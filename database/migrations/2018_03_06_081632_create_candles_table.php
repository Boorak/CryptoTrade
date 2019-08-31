<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pair_id')->index();
            $table->integer('time_frame')->index();
            $table->bigInteger('o')->index();
            $table->bigInteger('c')->index();
            $table->bigInteger('h')->index();
            $table->bigInteger('l')->index();
            $table->bigInteger('v')->index();
            $table->bigInteger('t')->index()->unique();
            $table->bigInteger('count')->nullable();
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
        Schema::dropIfExists('candles');
    }
}
