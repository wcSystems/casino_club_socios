<?php

use Illuminate\Database\Seeder;

class Type_commandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_commands')->insert([
            'name' => "Venta"
        ]);
        DB::table('type_commands')->insert([
            'name' => "Cortesia"
        ]);
    }
}
