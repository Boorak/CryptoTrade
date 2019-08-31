<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'verified' => true,
        'remember_token' => str_random(10),
    ];
});


$factory->define('App\Currency', function (\Faker\Generator $faker) {
    return [
        'symbol' => $faker->word,
    ];
});

$factory->define('App\OrderBuy', function (\Faker\Generator $faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'currency_id' => function () {
            return factory('App\Currency')->create()->id;
        },
        'price' => $faker->randomFloat(),
        'amount' => $faker->randomFloat(),
    ];
});


$factory->define('App\OrderSell', function (\Faker\Generator $faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'currency_id' => function () {
            return factory('App\Currency')->create()->id;
        },
        'price' => $faker->randomFloat(),
        'amount' => $faker->randomFloat(),
    ];
});


$factory->define('App\Balance', function (\Faker\Generator $faker) {
    return [
        'currency_id' => function () {
            return factory('App\Currency')->create()->id;
        },
        'amount' => $faker->randomFloat(),
    ];
});