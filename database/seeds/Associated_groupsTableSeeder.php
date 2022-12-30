<?php

use Illuminate\Database\Seeder;

class Associated_groupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('associated_groups')->insert(['name' => "Asociado"]);
        DB::table('associated_groups')->insert(['name' => "Invitado"]);
    }
}
