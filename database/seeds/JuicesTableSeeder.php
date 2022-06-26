<?php

use Illuminate\Database\Seeder;

class JuicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('juices')->insert([
            'name' => "Limonada"
        ]);
        DB::table('juices')->insert([
            'name' => "Guayaba"
        ]);
        DB::table('juices')->insert([
            'name' => "Pera"
        ]);
    }
}
