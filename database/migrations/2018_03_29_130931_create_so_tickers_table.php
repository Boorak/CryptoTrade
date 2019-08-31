<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoTickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('so_tickers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pair_id');
            $table->float('bid');
            $table->float('bid_size');
            $table->float('ask');
            $table->float('ask_size');
            $table->float('daily_change');
            $table->float('daily_change_perc');
            $table->float('last_price');
            $table->float('volume');
            $table->float('high');
            $table->float('low');
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
        Schema::dropIfExists('so_tickers');
    }
}
