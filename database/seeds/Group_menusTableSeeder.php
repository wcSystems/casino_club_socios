<?php

use Illuminate\Database\Seeder;

class Group_menusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group_menus')->insert([
            'name' => "Venta"
        ]);
        DB::table('group_menus')->insert([
            'name' => "Cortesia"
        ]);
    }
}
