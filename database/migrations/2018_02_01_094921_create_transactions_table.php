<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('seller_id');
            $table->unsignedInteger('buyer_id');
            $table->unsignedInteger('order_buy_id');
            $table->unsignedInteger('order_sale_id');
            $table->unsignedInteger('pair_id');
            $table->decimal('price', 16, 8);
            $table->decimal('amount', 16, 8);
            $table->string('type');
            $table->bigInteger('timestamp');
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
        Schema::dropIfExists('transactions');
    }
}
