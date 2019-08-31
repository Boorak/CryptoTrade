<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @test
     */
    function a_user_may_register_for_an_account_but_must_confirm_their_email_address()
    {
    }
}





