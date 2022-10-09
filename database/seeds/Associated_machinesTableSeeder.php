<?php

use Illuminate\Database\Seeder;

class Associated_machinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('associated_machines')->insert(['name' => "JA"]);
        DB::table('associated_machines')->insert(['name' => "ON-WAM"]);
        DB::table('associated_machines')->insert(['name' => "RA"]);
        DB::table('associated_machines')->insert(['name' => "SMARTGAMES"]);
        DB::table('associated_machines')->insert(['name' => "V"]);
        DB::table('associated_machines')->insert(['name' => "WAJ"]);
        DB::table('associated_machines')->insert(['name' => "WAM"]);
        DB::table('associated_machines')->insert(['name' => "WAMJU"]);
        DB::table('associated_machines')->insert(['name' => "WISI"]);
        DB::table('associated_machines')->insert(['name' => "YH"]);
        DB::table('associated_machines')->insert(['name' => "WISI C.A. AD"]);
    }
}
