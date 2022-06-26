<?php

use Illuminate\Database\Seeder;

class TablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tables')->insert([
            'name' => "Ruletas"
        ]);
        DB::table('tables')->insert([
            'name' => "Bacarat"
        ]);
        DB::table('tables')->insert([
            'name' => "Blackjack"
        ]);
    }
}
