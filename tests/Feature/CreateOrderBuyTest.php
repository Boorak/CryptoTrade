<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateOrderBuyTest extends TestCase
{
    use DatabaseMigrations;

    const URL = 'api/v1/trade/orderbuy/';

    /**
     * @test
     */
    function guests_may_not_create_order_buy()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $orderBuy = make('App\OrderBuy');
        $this->post(self::URL, $orderBuy->toArray());
    }

    /**
     * @test
     */
    function an_authenticated_user_can_create_new_order_buy()
    {
        $this->JWTSignIn();
        $orderBuy = make('App\OrderBuy');
        $response = $this->post(self::URL, $orderBuy->toArray());
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    function an_authenticated_user_can_update_order_buy()
    {
        $this->JWTSignIn();
        $order = create('App\OrderBuy', ['user_id' => auth()->id()]);
        $response = $this->patch("/api/v1/trade/orderbuy/{$order->id}/update", [
            'price' => 99,
            'amount' => 99,
        ]);
        $response->assertStatus(201);

    }

    /**
     * @test
     */
    function an_unauthenticated_user_can_not_update_order_buy()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $order = create('App\OrderBuy');
        $this->patch("/api/v1/trade/orderbuy/{$order->id}/update", [
            'price' => 99,
            'amount' => 99,
        ]);

    }

    /**
     * @test
     */
    function an_authenticated_user_can_delete_order_buy()
    {
        $this->JWTSignIn();
        $order = create('App\OrderBuy', ['user_id' => auth()->id()]);
        $response = $this->delete("/api/v1/trade/orderbuy/{$order->id}/delete");
        $response->assertStatus(204);
    }

    /**
     * @test
     */
    function an_unauthenticated_user_can_not_remove_order_buy()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $order = create('App\OrderBuy');
        $this->delete("/api/v1/trade/orderbuy/{$order->id}/delete");
    }

    /**
     * @test
     */
    function a_order_buy_requires_price()
    {
        $this->expectException('Illuminate\Validation\ValidationException');
        $this->publishOrderBuy(['price' => null]);
    }

    /**
     * @test
     */
    function a_order_buy_requires_amount()
    {
        $this->expectException('Illuminate\Validation\ValidationException');
        $this->publishOrderBuy(['amount' => null]);
    }

    /**
     * @test
     */
    function a_order_buy_requires_currency_id()
    {
        $this->expectException('Illuminate\Validation\ValidationException');
        $this->publishOrderBuy(['currency_id' => null]);
    }

    /**
     * @test
     */
    function a_order_buy_price_must_be_numeric()
    {
        $this->expectException('Illuminate\Validation\ValidationException');
        $this->publishOrderBuy(['price' => "string"]);
    }

    /**
     * @test
     */
    function a_order_buy_amount_must_be_numeric()
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
        $orderBuy = make('App\OrderBuy', $overrides);
        return $this->post(self::URL, $orderBuy->toArray());
    }


}
