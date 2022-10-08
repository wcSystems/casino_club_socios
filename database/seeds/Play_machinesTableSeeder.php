<?php

use Illuminate\Database\Seeder;

class Play_machinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('play_machines')->insert(['name' => "Example"]);
    }
}
