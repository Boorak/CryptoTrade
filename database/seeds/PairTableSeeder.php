<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class PairTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pairs')->insert([
            'pair' => 'btcusd',
            'asset_id' => 2,
            'currency_id' => 1,
        ]);

        DB::table('pairs')->insert([
            'pair' => 'btcirr',
            'asset_id' => 2,
            'currency_id' => 3,
        ]);

        DB::table('pairs')->insert([
            'pair' => 'ethusd',
            'asset_id' => 4,
            'currency_id' => 1,
        ]);

        DB::table('pairs')->insert([
            'pair' => 'ethirr',
            'asset_id' => 4,
            'currency_id' => 3,
        ]);

        DB::table('pairs')->insert([
            'pair' => 'ethbtc',
            'asset_id' => 4,
            'currency_id' => 2,
        ]);

        DB::table('pairs')->insert([
            'pair' => 'iotausd',
            'asset_id' => 5,
            'currency_id' => 1,
        ]);

        DB::table('pairs')->insert([
            'pair' => 'iotairr',
            'asset_id' => 5,
            'currency_id' => 3,
        ]);

        DB::table('pairs')->insert([
            'pair' => 'iotabtc',
            'asset_id' => 5,
            'currency_id' => 2,
        ]);

        DB::table('pairs')->insert([
            'pair' => 'xrpusd',
            'asset_id' => 6,
            'currency_id' => 1,
        ]);

        DB::table('pairs')->insert([
            'pair' => 'xrpirr',
            'asset_id' => 6,
            'currency_id' => 3,
        ]);

        DB::table('pairs')->insert([
            'pair' => 'xrpbtc',
            'asset_id' => 6,
            'currency_id' => 2,
        ]);

        DB::table('pairs')->insert([
            'pair' => 'xmrusd',
            'asset_id' => 7,
            'currency_id' => 1,
        ]);

        DB::table('pairs')->insert([
            'pair' => 'xmrirr',
            'asset_id' => 7,
            'currency_id' => 3,
        ]);

        DB::table('pairs')->insert([
            'pair' => 'xmrbtc',
            'asset_id' => 7,
            'currency_id' => 2,
        ]);
    }
}
