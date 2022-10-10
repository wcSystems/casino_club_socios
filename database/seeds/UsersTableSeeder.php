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

        DB::table('users')->insert(['name' => "Control de Acceso",'email' => 'control','password' => bcrypt('12345678')]);
        
    }
}
