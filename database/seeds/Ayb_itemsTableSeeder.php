<?php

use Illuminate\Database\Seeder;

class Ayb_itemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ayb_items')->insert([ 'name' => "Almuerzo" ]);
        DB::table('ayb_items')->insert([ 'name' => "Ensalada Cesar" ]);
        DB::table('ayb_items')->insert([ 'name' => "Parrilla" ]);
        DB::table('ayb_items')->insert([ 'name' => "Sandwich" ]);
        DB::table('ayb_items')->insert([ 'name' => "Pollo a la plancha" ]);
        DB::table('ayb_items')->insert([ 'name' => "Pasapalo personal" ]);
        DB::table('ayb_items')->insert([ 'name' => "Chuleta / Churrasco" ]);
        DB::table('ayb_items')->insert([ 'name' => "Pasta" ]);
        DB::table('ayb_items')->insert([ 'name' => "Pollo a la pancha con pure" ]);
        DB::table('ayb_items')->insert([ 'name' => "Quesillo" ]);
        DB::table('ayb_items')->insert([ 'name' => "Canolis" ]);
        DB::table('ayb_items')->insert([ 'name' => "Yukeri" ]);
        DB::table('ayb_items')->insert([ 'name' => "Cervezas" ]);
        DB::table('ayb_items')->insert([ 'name' => "Tinto de Verano" ]);
        DB::table('ayb_items')->insert([ 'name' => "Whisky" ]);
        DB::table('ayb_items')->insert([ 'name' => "Ron" ]);
    }
}
