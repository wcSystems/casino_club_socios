<?php

use Illuminate\Database\Seeder;

class Room_groupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('room_groups')->insert(['name' => "Sala"]);
        DB::table('room_groups')->insert(['name' => "Galpon"]);
    }
}
