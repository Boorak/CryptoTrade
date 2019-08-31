<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class TvSymbolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tv_symbols')->insert([
            'symbol' => 'BTCUSD',
            'full_name' => 'BTCUSD',
            'description' => "Bitcoin exchange",
            'exchange' => "XETRA",
            'type' => "stock",
        ]);

        DB::table('tv_symbols')->insert([
            'symbol' => 'BTCIRR',
            'full_name' => 'BTCIRR',
            'description' => "Bitcoin exchange",
            'exchange' => "XETRA",
            'type' => "stock",
        ]);

        DB::table('tv_symbols')->insert([
            'symbol' => 'ETHUSD',
            'full_name' => 'ETHUSD',
            'description' => "Bitcoin exchange",
            'exchange' => "XETRA",
            'type' => "stock",
        ]);

        DB::table('tv_symbols')->insert([
            'symbol' => 'ETHIRR',
            'full_name' => 'ETHIRR',
            'description' => "Bitcoin exchange",
            'exchange' => "XETRA",
            'type' => "stock",
        ]);

        DB::table('tv_symbols')->insert([
            'symbol' => 'ETHBTC',
            'full_name' => 'ETHBTC',
            'description' => "Bitcoin exchange",
            'exchange' => "XETRA",
            'type' => "stock",
        ]);
    }
}
