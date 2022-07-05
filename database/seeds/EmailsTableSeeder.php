<?php

use Illuminate\Database\Seeder;

class EmailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('emails')->insert(['user' => "Administrador Correos",'name' => "admin",'domain_id' => "1"]);
        DB::table('emails')->insert(['user' => "Departamento de Sistemas",'name' => "sistemas",'domain_id' => "1"]);
        DB::table('emails')->insert(['user' => "Departamento de Administracion",'name' => "administracion",'domain_id' => "1"]);
        DB::table('emails')->insert(['user' => "Willinthon Carriedo",'name' => "willinthon",'domain_id' => "1"]);
        DB::table('emails')->insert(['user' => "Zaida Garcia",'name' => "zgarcia",'domain_id' => "1"]);
        DB::table('emails')->insert(['user' => "Compras",'name' => "compras",'domain_id' => "1"]);
        DB::table('emails')->insert(['user' => "Cuentas por pagar",'name' => "cuentasporpagar",'domain_id' => "1"]);
    }
}
