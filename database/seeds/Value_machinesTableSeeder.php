<?php

use Illuminate\Database\Seeder;

class Value_machinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('value_machines')->insert(['name' => "0,01"]);
        DB::table('value_machines')->insert(['name' => "0,001"]);
        DB::table('value_machines')->insert(['name' => "1"]);
    }
}
