<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class AcTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('acs')->insert([
            'symbol' => 'usd',
            'is_asset' => false,
            'is_currency' => true,
        ]);

        DB::table('acs')->insert([
            'symbol' => 'btc',
            'is_asset' => true,
            'is_currency' => true,
        ]);

        DB::table('acs')->insert([
            'symbol' => 'irr',
            'is_asset' => false,
            'is_currency' => true,
        ]);


        DB::table('acs')->insert([
            'symbol' => 'eth',
            'is_asset' => true,
            'is_currency' => true,
        ]);

        DB::table('acs')->insert([
            'symbol' => 'iota',
            'is_asset' => true,
            'is_currency' => false,
        ]);

        DB::table('acs')->insert([
            'symbol' => 'xrp',
            'is_asset' => true,
            'is_currency' => false,
        ]);

        DB::table('acs')->insert([
            'symbol' => 'xmr',
            'is_asset' => true,
            'is_currency' => false,
        ]);
    }
}
