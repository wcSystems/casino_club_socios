<?php

use Illuminate\Database\Seeder;

class Range_machinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('range_machines')->insert(['name' => "Rango 1"]);
        DB::table('range_machines')->insert(['name' => "Rango 2"]);
        DB::table('range_machines')->insert(['name' => "Rango 3"]);
        DB::table('range_machines')->insert(['name' => "Rango 4"]);
        DB::table('range_machines')->insert(['name' => "Rango 5"]);
        DB::table('range_machines')->insert(['name' => "Rango VIP"]);
        DB::table('range_machines')->insert(['name' => "Rango Fumadores"]);
        DB::table('range_machines')->insert(['name' => "Rango Lobby"]);
    }
}
