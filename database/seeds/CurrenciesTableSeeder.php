<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            'name' => 'Japanese Yen',
            'short_name' => 'JPY',
            'exchange_rate' => 107.17,
            'surcharge_percent' => 7.5,
            'discount_percent' => 0.0,
            'created_at' => '2018-03-17 00:00:00'
        ]);
        
        DB::table('currencies')->insert([
            'name' => 'British Pound',
            'short_name' => 'GBP',
            'exchange_rate' => 0.711178,
            'surcharge_percent' => 5,
            'discount_percent' => 0.0,
            'created_at' => '2018-03-17 00:00:00'
        ]);
        
        DB::table('currencies')->insert([
            'name' => 'Euro',
            'short_name' => 'EUR',
            'exchange_rate' => 0.884872,
            'surcharge_percent' => 5,
            'discount_percent' => 2,
            'created_at' => '2018-03-17 00:00:00'
        ]);
        
        DB::table('settings')->insert([
            'email' => 'mikn89@gmail.com',
            'created_at' => '2018-03-17 00:00:00'
        ]);
    }
}
