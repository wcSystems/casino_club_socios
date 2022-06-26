<?php

use Illuminate\Database\Seeder;

class TransportationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transportations')->insert([
            'name' => "Vehiculo Propio",
        ]);
        DB::table('transportations')->insert([
            'name' => "Taxi",
        ]);
        DB::table('transportations')->insert([
            'name' => "Transporte Publico",
        ]);
    }
}
