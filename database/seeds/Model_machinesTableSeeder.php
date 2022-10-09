<?php

use Illuminate\Database\Seeder;

class Model_machinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('model_machines')->insert(['name' => "A560",'brand_machine_id' => "1"]);
        DB::table('model_machines')->insert(['name' => "A560X",'brand_machine_id' => "1"]);
        DB::table('model_machines')->insert(['name' => "A560-S32",'brand_machine_id' => "1"]);
        DB::table('model_machines')->insert(['name' => "A560X-H",'brand_machine_id' => "1"]);
        DB::table('model_machines')->insert(['name' => "A560X-L",'brand_machine_id' => "1"]);

        DB::table('model_machines')->insert(['name' => "MK4",'brand_machine_id' => "2"]);
        DB::table('model_machines')->insert(['name' => "MK5",'brand_machine_id' => "2"]);
        DB::table('model_machines')->insert(['name' => "MK6",'brand_machine_id' => "2"]);
        DB::table('model_machines')->insert(['name' => "VIRIDIAN",'brand_machine_id' => "2"]);
        DB::table('model_machines')->insert(['name' => "HELIX",'brand_machine_id' => "2"]);

        DB::table('model_machines')->insert(['name' => "ASTRO",'brand_machine_id' => "3"]);

        DB::table('model_machines')->insert(['name' => "ALPHA 1",'brand_machine_id' => "4"]);
        DB::table('model_machines')->insert(['name' => "ALPHA 1 ST",'brand_machine_id' => "4"]);
        DB::table('model_machines')->insert(['name' => "ALPHA 2 V22",'brand_machine_id' => "4"]);
        DB::table('model_machines')->insert(['name' => "ALPHA 2 V32",'brand_machine_id' => "4"]);
        DB::table('model_machines')->insert(['name' => "ALPHA 2 WV",'brand_machine_id' => "4"]);

        DB::table('model_machines')->insert(['name' => "GL20",'brand_machine_id' => "5"]);
        DB::table('model_machines')->insert(['name' => "G20",'brand_machine_id' => "5"]);

        DB::table('model_machines')->insert(['name' => "ENDEVOUR KP1",'brand_machine_id' => "6"]);
        DB::table('model_machines')->insert(['name' => "KP3",'brand_machine_id' => "6"]);
        DB::table('model_machines')->insert(['name' => "REVOLVER",'brand_machine_id' => "6"]);

        DB::table('model_machines')->insert(['name' => "CF1",'brand_machine_id' => "7"]);
        DB::table('model_machines')->insert(['name' => "CF2-610",'brand_machine_id' => "7"]);
        DB::table('model_machines')->insert(['name' => "CF2-626",'brand_machine_id' => "7"]);
        DB::table('model_machines')->insert(['name' => "CF2-680",'brand_machine_id' => "7"]);
        DB::table('model_machines')->insert(['name' => "CF2-880",'brand_machine_id' => "7"]);

        DB::table('model_machines')->insert(['name' => "CIRSA S400",'brand_machine_id' => "8"]);
        DB::table('model_machines')->insert(['name' => "CIRSA S300",'brand_machine_id' => "8"]);

        DB::table('model_machines')->insert(['name' => "BLUE BIRD ONE",'brand_machine_id' => "9"]);
        DB::table('model_machines')->insert(['name' => "BLADE",'brand_machine_id' => "9"]);

        DB::table('model_machines')->insert(['name' => "MMPG",'brand_machine_id' => "10"]);
        DB::table('model_machines')->insert(['name' => "R8TS",'brand_machine_id' => "10"]);

        DB::table('model_machines')->insert(['name' => "UPRIGHT ONE",'brand_machine_id' => "11"]);
    }
}