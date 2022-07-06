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
        DB::table('emails')->insert(['user' => "Departamento de Sistemas",'name' => "sistemas",'domain_id' => "1", 'group' => "2"]);
        DB::table('emails')->insert(['user' => "Departamento de Administracion",'name' => "administracion",'domain_id' => "1", 'group' => "2"]);
        DB::table('emails')->insert(['user' => "Departamento de Mantenimiento",'name' => "mantenimiento",'domain_id' => "1", 'group' => "2"]);
        DB::table('emails')->insert(['user' => "Departamento de Ingenieria",'name' => "ingenieria",'domain_id' => "1", 'group' => "2"]);
        DB::table('emails')->insert(['user' => "Departamento de Alimentos y Bebidas",'name' => "ayb",'domain_id' => "1", 'group' => "2"]);
        DB::table('emails')->insert(['user' => "Departamento de Recursos Humanos",'name' => "rrhh",'domain_id' => "1", 'group' => "2"]);
        DB::table('emails')->insert(['user' => "Departamento de Almacen General",'name' => "ageneral",'domain_id' => "1", 'group' => "2"]);
        DB::table('emails')->insert(['user' => "Departamento de Estadisticas",'name' => "estadistica",'domain_id' => "1", 'group' => "2"]);
        DB::table('emails')->insert(['user' => "Departamento de Operaciones",'name' => "operaciones",'domain_id' => "1", 'group' => "2"]);
        DB::table('emails')->insert(['user' => "Departamento de Monitores",'name' => "monitores",'domain_id' => "1", 'group' => "2"]);
        DB::table('emails')->insert(['user' => "Departamento de Seguridad",'name' => "seguridad",'domain_id' => "1", 'group' => "2"]);
        DB::table('emails')->insert(['user' => "Departamento de Boveda",'name' => "boveda",'domain_id' => "1", 'group' => "2"]);

        DB::table('emails')->insert(['user' => "Willinthon Carriedo",'name' => "willinthon",'domain_id' => "1", 'group' => "1"]);
        DB::table('emails')->insert(['user' => "Zaida Garcia",'name' => "zgarcia",'domain_id' => "1", 'group' => "1"]);
        DB::table('emails')->insert(['user' => "Nailette Lozada",'name' => "nlozada",'domain_id' => "1", 'group' => "1"]);
        DB::table('emails')->insert(['user' => "Yenny Hernandez",'name' => "yhernandez",'domain_id' => "1", 'group' => "1"]);
        DB::table('emails')->insert(['user' => "Maryelin Hernandez",'name' => "mhernandez",'domain_id' => "1", 'group' => "1"]);
        DB::table('emails')->insert(['user' => "Edgar Chacon",'name' => "echacon",'domain_id' => "1", 'group' => "1"]);
        DB::table('emails')->insert(['user' => "Winder Mucie",'name' => "wmucie",'domain_id' => "1", 'group' => "1"]);
        DB::table('emails')->insert(['user' => "Raimer Fernandez",'name' => "rfernandez",'domain_id' => "1", 'group' => "1"]);
        DB::table('emails')->insert(['user' => "Lorena Mendoza",'name' => "lmendoza",'domain_id' => "1", 'group' => "1"]);
        DB::table('emails')->insert(['user' => "Julio Cruzado",'name' => "jcruzado",'domain_id' => "1", 'group' => "1"]);
        DB::table('emails')->insert(['user' => "Maria Parra",'name' => "mparra",'domain_id' => "1", 'group' => "1"]);
        DB::table('emails')->insert(['user' => "Arturo Fernandez",'name' => "mfernandez",'domain_id' => "1", 'group' => "1"]);
        DB::table('emails')->insert(['user' => "H Tenay",'name' => "htenay",'domain_id' => "1", 'group' => "1"]);
        DB::table('emails')->insert(['user' => "Natalia Villanueva",'name' => "nvillanueva",'domain_id' => "1", 'group' => "1"]);
        DB::table('emails')->insert(['user' => "Angel Torrez",'name' => "atorrez",'domain_id' => "1", 'group' => "1"]);
        DB::table('emails')->insert(['user' => "Luz Adriana",'name' => "ladriana",'domain_id' => "1", 'group' => "1"]);

        DB::table('emails')->insert(['user' => "Compras",'name' => "compras",'domain_id' => "1", 'group' => "0"]);
        DB::table('emails')->insert(['user' => "Cuentas por pagar",'name' => "cuentasporpagar",'domain_id' => "1", 'group' => "0"]);
    }
}
