<?php

use Illuminate\Database\Seeder;

class Condicion_groupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('condicion_groups')->insert(['name' => "Buen estado"]);
        DB::table('condicion_groups')->insert(['name' => "Defectuosa"]);
        DB::table('condicion_groups')->insert(['name' => "Solo carcasa"]);
        DB::table('condicion_groups')->insert(['name' => "Dañada ( Repuesto )"]);
    }
}
