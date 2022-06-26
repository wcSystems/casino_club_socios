<?php

use Illuminate\Database\Seeder;

class DrinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drinks')->insert([
            'name' => "Ron"
        ]);
        DB::table('drinks')->insert([
            'name' => "Cerveza"
        ]);
        DB::table('drinks')->insert([
            'name' => "Vino"
        ]);
    }
}
