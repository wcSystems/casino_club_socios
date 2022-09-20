<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Aca creamos el usuario principal */

        DB::table('users')->insert(['name' => "Willinthon Carriedo",'email' => 'willinthon','password' => bcrypt('12345678'),'level_id' => '1']);
        DB::table('users')->insert(['name' => "Julio Cruzado",'email' => 'jcruzado','password' => bcrypt('12345678'),'level_id' => '1']);
        DB::table('users')->insert(['name' => "Lorena Mendoza",'email' => 'lmendoza','password' => bcrypt('12345678'),'level_id' => '1']);
        DB::table('users')->insert(['name' => "Milena Fontao",'email' => 'mfontao','password' => bcrypt('12345678'),'level_id' => '1']);
        DB::table('users')->insert(['name' => "Nicole Estadistica",'email' => 'nicole','password' => bcrypt('12345678'),'level_id' => '1']);
        DB::table('users')->insert(['name' => "Wilson Aponte",'email' => 'waponte','password' => bcrypt('12345678'),'level_id' => '1']);
        
    }
}
