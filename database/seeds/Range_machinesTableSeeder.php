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
        DB::table('range_machines')->insert(['name' => "RANGO 1"]);
        DB::table('range_machines')->insert(['name' => "RANGO 2"]);
        DB::table('range_machines')->insert(['name' => "RANGO 3"]);
        DB::table('range_machines')->insert(['name' => "RANGO 4"]);
        DB::table('range_machines')->insert(['name' => "RANGO 5"]);
        DB::table('range_machines')->insert(['name' => "RANGO VIP"]);
        DB::table('range_machines')->insert(['name' => "RANGO FUMADORES"]);
        DB::table('range_machines')->insert(['name' => "RANGO LOBBY"]);
    }
}
