<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_has_order_buy()
    {
        $user = create('App\User');
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->orderBuy);
    }

    /**
     * @test
     */
    public function it_has_order_sale()
    {
        $user = create('App\User');
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->orderBuy);
    }
}
