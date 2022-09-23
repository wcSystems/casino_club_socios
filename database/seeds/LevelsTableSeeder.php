<?php

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            'name' => "Desarrollador"
        ]);
        DB::table('levels')->insert([
            'name' => "Administrador"
        ]);
        DB::table('levels')->insert([
            'name' => "Supervisor"
        ]);
        DB::table('levels')->insert([
            'name' => "Cocina"
        ]);
        DB::table('levels')->insert([
            'name' => "Barra"
        ]);
        DB::table('levels')->insert([
            'name' => "Cecom"
        ]);
        DB::table('levels')->insert([
            'name' => "Estadistica"
        ]);
        DB::table('levels')->insert([
            'name' => "Operador"
        ]);
        DB::table('levels')->insert([
            'name' => "Anfitrion"
        ]);
        DB::table('levels')->insert([
            'name' => "Cliente"
        ]);
    }
}
