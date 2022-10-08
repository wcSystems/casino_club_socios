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
        DB::table('brand_machines')->insert(['name' => "Ainsworth"]);
        DB::table('brand_machines')->insert(['name' => "Aristocrat"]);
        DB::table('brand_machines')->insert(['name' => "Astro"]);
        DB::table('brand_machines')->insert(['name' => "Bally"]);
        DB::table('brand_machines')->insert(['name' => "IGT"]);
        DB::table('brand_machines')->insert(['name' => "Konami"]);
        DB::table('brand_machines')->insert(['name' => "Novomatic"]);
        DB::table('brand_machines')->insert(['name' => "Unidesa"]);
        DB::table('brand_machines')->insert(['name' => "Williams"]);
        DB::table('brand_machines')->insert(['name' => "Ruleta 1"]);
        DB::table('brand_machines')->insert(['name' => "Ruleta 2"]);
        DB::table('brand_machines')->insert(['name' => "Ruleta 3"]);
    }
}
