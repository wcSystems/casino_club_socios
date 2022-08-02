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

        DB::table('users')->insert(['name' => "Willinthon Carriedo",'email' => 'willinthon','password' => bcrypt('12345678'),'celular' => '4121482348','cedula' => '25047058','nacimiento' => '1996-09-13']);
        DB::table('users')->insert(['name' => "Julio Cruzado",'email' => 'jcruzado','password' => bcrypt('12345678'),'celular' => '4121482348','cedula' => '25047058','nacimiento' => '1996-09-13']);
        DB::table('users')->insert(['name' => "Lorena Mendoza",'email' => 'lmendoza','password' => bcrypt('12345678'),'celular' => '4121482348','cedula' => '25047058','nacimiento' => '1996-09-13']);
        DB::table('users')->insert(['name' => "Milena Fontao",'email' => 'mfontao','password' => bcrypt('12345678'),'celular' => '4121482348','cedula' => '25047058','nacimiento' => '1996-09-13']);
        DB::table('users')->insert(['name' => "Raimer Fernandez",'email' => 'rfernandez','password' => bcrypt('12345678'),'celular' => '4121482348','cedula' => '25047058','nacimiento' => '1996-09-13']);
        DB::table('users')->insert(['name' => "Winder Mucie",'email' => 'wmucie','password' => bcrypt('12345678'),'celular' => '4121482348','cedula' => '25047058','nacimiento' => '1996-09-13']);
        DB::table('users')->insert(['name' => "Roberto Estadistica",'email' => 'roberto','password' => bcrypt('12345678'),'celular' => '4121482348','cedula' => '25047058','nacimiento' => '1996-09-13']);
        DB::table('users')->insert(['name' => "Nicole Estadistica",'email' => 'nicole','password' => bcrypt('12345678'),'celular' => '4121482348','cedula' => '25047058','nacimiento' => '1996-09-13']);
        DB::table('users')->insert(['name' => "Monitores",'email' => 'monitores','password' => bcrypt('12345678'),'celular' => '4121482348','cedula' => '25047058','nacimiento' => '1996-09-13']);
        DB::table('users')->insert(['name' => "Laura Lozada",'email' => 'llozoada','password' => bcrypt('12345678'),'celular' => '4121482348','cedula' => '25047058','nacimiento' => '1996-09-13']);
        
    }
}
