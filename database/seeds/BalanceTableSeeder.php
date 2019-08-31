<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class BalanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('balances')->insert([
            'user_id' => 1,
            'ac_id' => 1,
            'amount' => 50000,
            'available' => 50000,
        ]);

        DB::table('balances')->insert([
            'user_id' => 1,
            'ac_id' => 2,
            'amount' => 10,
            'available' => 10,
        ]);

        DB::table('balances')->insert([
            'user_id' => 1,
            'ac_id' => 3,
            'amount' => 50000,
            'available' => 50000,
        ]);

        DB::table('balances')->insert([
            'user_id' => 1,
            'ac_id' => 4,
            'amount' => 20,
            'available' => 20,
        ]);

        DB::table('balances')->insert([
            'user_id' => 1,
            'ac_id' => 5,
            'amount' => 0,
            'available' => 0,
        ]);

        DB::table('balances')->insert([
            'user_id' => 1,
            'ac_id' => 6,
            'amount' => 0,
            'available' => 0,
        ]);

        DB::table('balances')->insert([
            'user_id' => 1,
            'ac_id' => 7,
            'amount' => 0,
            'available' => 0,
        ]);

        //End Amir Boorak

        DB::table('balances')->insert([
            'user_id' => 2,
            'ac_id' => 1,
            'amount' => 50000,
            'available' => 50000,
        ]);

        DB::table('balances')->insert([
            'user_id' => 2,
            'ac_id' => 2,
            'amount' => 10,
            'available' => 10,
        ]);

        DB::table('balances')->insert([
            'user_id' => 2,
            'ac_id' => 3,
            'amount' => 50000,
            'available' => 50000,
        ]);

        DB::table('balances')->insert([
            'user_id' => 2,
            'ac_id' => 4,
            'amount' => 20,
            'available' => 20,
        ]);

        DB::table('balances')->insert([
            'user_id' => 2,
            'ac_id' => 5,
            'amount' => 0,
            'available' => 0,
        ]);

        DB::table('balances')->insert([
            'user_id' => 2,
            'ac_id' => 6,
            'amount' => 0,
            'available' => 0,
        ]);

        DB::table('balances')->insert([
            'user_id' => 2,
            'ac_id' => 7,
            'amount' => 0,
            'available' => 0,
        ]);

        //End Iman

        DB::table('balances')->insert([
            'user_id' => 3,
            'ac_id' => 1,
            'amount' => 50000,
            'available' => 50000,
        ]);

        DB::table('balances')->insert([
            'user_id' => 3,
            'ac_id' => 2,
            'amount' => 10,
            'available' => 10,
        ]);

        DB::table('balances')->insert([
            'user_id' => 3,
            'ac_id' => 3,
            'amount' => 50000,
            'available' => 50000,
        ]);

        DB::table('balances')->insert([
            'user_id' => 3,
            'ac_id' => 4,
            'amount' => 20,
            'available' => 20,
        ]);

        DB::table('balances')->insert([
            'user_id' => 3,
            'ac_id' => 5,
            'amount' => 0,
            'available' => 0,
        ]);

        DB::table('balances')->insert([
            'user_id' => 3,
            'ac_id' => 6,
            'amount' => 0,
            'available' => 0,
        ]);

        DB::table('balances')->insert([
            'user_id' => 3,
            'ac_id' => 7,
            'amount' => 0,
            'available' => 0,
        ]);
    }
}
