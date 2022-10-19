<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert(['name' => "Gerencia"]);
        DB::table('departments')->insert(['name' => "Administracion"]);
        DB::table('departments')->insert(['name' => "Recursos Humanos"]);
        DB::table('departments')->insert(['name' => "Compras"]);
        DB::table('departments')->insert(['name' => "Estadistica"]);
        DB::table('departments')->insert(['name' => "Promociones y Eventos"]);
        DB::table('departments')->insert(['name' => "Sistemas"]);
        DB::table('departments')->insert(['name' => "Almacen"]);
        DB::table('departments')->insert(['name' => "Servicio Tecnico"]);
        DB::table('departments')->insert(['name' => "Seguridad"]);
        DB::table('departments')->insert(['name' => "CECOM"]);
        DB::table('departments')->insert(['name' => "Servicios Generales y Transporte"]);
        DB::table('departments')->insert(['name' => "Mantenimiento ( Areas )"]);
        DB::table('departments')->insert(['name' => "Maquinas"]);
        DB::table('departments')->insert(['name' => "Caja"]);
        DB::table('departments')->insert(['name' => "Servicio"]);
        DB::table('departments')->insert(['name' => "Barra"]);
        DB::table('departments')->insert(['name' => "Cocina"]);
        DB::table('departments')->insert(['name' => "Casino"]);
    }
}
