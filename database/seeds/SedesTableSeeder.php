<?php

use Illuminate\Database\Seeder;

class SedesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sedes')->insert([
            'name' => "Caracas"
        ]);
        DB::table('sedes')->insert([
            'name' => "Margarita"
        ]);
        DB::table('sedes')->insert([
            'name' => "Valencia"
        ]);
        DB::table('sedes')->insert([
            'name' => "San Cristobal"
        ]);
        DB::table('sedes')->insert([
            'name' => "Puerto Ordaz"
        ]);
        DB::table('sedes')->insert([
            'name' => "Puerto la Cruz"
        ]);
    }
}
