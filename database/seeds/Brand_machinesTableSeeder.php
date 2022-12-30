<?php

use Illuminate\Database\Seeder;

class Brand_machinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brand_machines')->insert(['name' => "AINSWORTH"]);
        DB::table('brand_machines')->insert(['name' => "ARISTOCRAT"]);
        DB::table('brand_machines')->insert(['name' => "ASTRO"]);
        DB::table('brand_machines')->insert(['name' => "BALLY"]);
        DB::table('brand_machines')->insert(['name' => "IGT"]);
        DB::table('brand_machines')->insert(['name' => "KONAMI"]);
        DB::table('brand_machines')->insert(['name' => "NOVOMATIC"]);
        DB::table('brand_machines')->insert(['name' => "UNIDESA"]);
        DB::table('brand_machines')->insert(['name' => "WILLIAMS"]);
        DB::table('brand_machines')->insert(['name' => "ALFASTREET"]);
        DB::table('brand_machines')->insert(['name' => "GOLD CLUB"]);
        DB::table('brand_machines')->insert(['name' => "INCREDIBLE TECHNOLOGIES"]);
        DB::table('brand_machines')->insert(['name' => "----"]);
        DB::table('brand_machines')->insert(['name' => "ARUZE"]);
    }
}
