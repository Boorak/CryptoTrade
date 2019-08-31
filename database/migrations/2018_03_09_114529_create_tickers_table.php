<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pair_id');
            $table->decimal('price', 16, 8);
            $table->decimal('min', 16, 8);
            $table->decimal('max', 16, 8);
            $table->decimal('volume', 16, 8);
            $table->integer('percent_change');
            $table->string('percent_color');
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
        Schema::dropIfExists('tickers');
    }
}
