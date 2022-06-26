<?php

use Illuminate\Database\Seeder;

class FoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('foods')->insert([
            'name' => "Arroz con Pollo"
        ]);
        DB::table('foods')->insert([
            'name' => "Paella"
        ]);
        DB::table('foods')->insert([
            'name' => "Sopa"
        ]);
    }
}
