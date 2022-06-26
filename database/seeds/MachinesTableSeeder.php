<?php

use Illuminate\Database\Seeder;

class MachinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('machines')->insert([
            'name' => "Con Progresivo"
        ]);
        DB::table('machines')->insert([
            'name' => "Sin Progresivo"
        ]);
        DB::table('machines')->insert([
            'name' => "Ruleta Electronica"
        ]);
    }
}
