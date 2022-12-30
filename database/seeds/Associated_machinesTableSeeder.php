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
        DB::table('associated_machines')->insert(['associated_group_id' => 1, 'name' => "JA"]);
        DB::table('associated_machines')->insert(['associated_group_id' => 1, 'name' => "ON-WAM"]);
        DB::table('associated_machines')->insert(['associated_group_id' => 1, 'name' => "RA"]);
        DB::table('associated_machines')->insert(['associated_group_id' => 1, 'name' => "SMARTGAMES"]);
        DB::table('associated_machines')->insert(['associated_group_id' => 1, 'name' => "V"]);
        DB::table('associated_machines')->insert(['associated_group_id' => 1, 'name' => "WAJ"]);
        DB::table('associated_machines')->insert(['associated_group_id' => 1, 'name' => "WAM"]);
        DB::table('associated_machines')->insert(['associated_group_id' => 1, 'name' => "WAMJU"]);
        DB::table('associated_machines')->insert(['associated_group_id' => 1, 'name' => "WISI"]);
        DB::table('associated_machines')->insert(['associated_group_id' => 1, 'name' => "YH"]);
        DB::table('associated_machines')->insert(['associated_group_id' => 1, 'name' => "WISI C.A. AD"]);

        DB::table('associated_machines')->insert(['associated_group_id' => 2, 'name' => "Antonio Aponte"]);
        DB::table('associated_machines')->insert(['associated_group_id' => 2, 'name' => "Rene Aguilar"]);
        DB::table('associated_machines')->insert(['associated_group_id' => 2, 'name' => "WAMJU"]);

        // NUEVAS
        DB::table('associated_machines')->insert(['associated_group_id' => 1, 'name' => "WW"]);
        DB::table('associated_machines')->insert(['associated_group_id' => 1, 'name' => "JULIO CUESTA"]);
        DB::table('associated_machines')->insert(['associated_group_id' => 1, 'name' => "WISI C.A"]);
    }
}
