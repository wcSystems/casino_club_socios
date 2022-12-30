<?php

use Illuminate\Database\Seeder;

class SexsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sexs')->insert(['name' => "Masculino"]);
        DB::table('sexs')->insert(['name' => "Femenino"]);
    }
}
