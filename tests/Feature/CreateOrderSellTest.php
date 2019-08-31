<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateOrderSellTest extends TestCase
{
    use DatabaseMigrations;

    const URL = 'api/v1/trade/ordersell';

    /**
     * @test
     */
    public function guests_may_not_create_order_sell()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $orderSell = make('App\OrderSell');
        $this->post(self::URL, $orderSell->toArray());
    }

    /**
     * @test
     */
    public function an_authenticated_user_can_create_order_sell()
    {
        $this->JWTSignIn();
        $orderSell = make('App\OrderSell');
        $response = $this->post(self::URL, $orderSell->toArray());
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    function an_authenticated_user_can_update_order_sell()
    {
        $this->JWTSignIn();
        $order = create('App\OrderSell', ['user_id' => auth()->id()]);
        $response = $this->patch("/api/v1/trade/ordersell/{$order->id}/update", [
            'price' => 99,
            'amount' => 99,
        ]);
        $response->assertStatus(201);

    }

    /**
     * @test
     */
    function an_unauthenticated_user_can_not_update_order_sell()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $order = create('App\OrderSell');
        $this->patch("/api/v1/trade/ordersell/{$order->id}/update", [
            'price' => 99,
            'amount' => 99,
        ]);
    }

    /**
     * @test
     */
    function an_authenticated_user_can_delete_order_sell()
    {
        $this->JWTSignIn();
        $order = create('App\OrderSell', ['user_id' => auth()->id()]);
        $response = $this->delete("/api/v1/trade/ordersell/{$order->id}/delete");
        $response->assertStatus(204);
    }

    /**
     * @test
     */
    function an_unauthenticated_user_can_not_remove_order_sell()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $order = create('App\OrderSell');
        $this->delete("/api/v1/trade/ordersell/{$order->id}/delete");
    }


    /**
     * @test
     */
    function a_order_sell_requires_price()
    {
        $this->expectException('Illuminate\Validation\ValidationException');
        $this->publishOrderBuy(['price' => null]);
    }

    /**
     * @test
     */
    function a_order_sell_requires_amount()
    {
        $this->expectException('Illuminate\Validation\ValidationException');
        $this->publishOrderBuy(['amount' => null]);
    }

    /**
     * @test
     */
    function a_order_sell_requires_currency_id()
    {
        $this->expectException('Illuminate\Validation\ValidationException');
        $this->publishOrderBuy(['currency_id' => null]);
    }

    /**
     * @test
     */
    function a_order_sell_price_must_be_numeric()
    {
        $this->expectException('Illuminate\Validation\ValidationException');
        $this->publishOrderBuy(['price' => "string"]);
    }

    /**
     * @test
     */
    function a_order_sell_amount_must_be_numeric()
    {
        $this->expectException('Illuminate\Validation\ValidationException');
        $this->publishOrderBuy(['amount' => "string"]);
    }

    /**
     * @param array $overrides
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    private function publishOrderBuy($overrides = [])
    {
        $this->JWTSignIn();
        $orderBuy = make('App\OrderSell', $overrides);
        return $this->post(self::URL, $orderBuy->toArray());
    }
}
