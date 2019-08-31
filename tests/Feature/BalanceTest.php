<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BalanceTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @test
     */
    public function get_an_authenticated_user_balance()
    {
        $this->JWTSignIn();
        $response = $this->get('api/v1/trade/user/balance');
        $response->assertStatus(200);
    }

}
