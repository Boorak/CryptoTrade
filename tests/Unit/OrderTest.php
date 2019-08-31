<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class OrderTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    function order_buy_has_currency()
    {
        $orderBuy = factory('App\OrderBuy')->create();
        $this->assertInstanceOf('App\Currency', $orderBuy->currency);
    }

    /**
     * @test
     */
    function order_sell_has_currency()
    {
        $orderBuy = factory('App\OrderSell')->create();
        $this->assertInstanceOf('App\Currency', $orderBuy->currency);
    }
}
