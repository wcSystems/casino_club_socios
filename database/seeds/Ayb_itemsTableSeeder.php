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
        DB::table('ayb_items')->insert([ 'name' => "Almuerzo", 'price' => 12  ]);
        DB::table('ayb_items')->insert([ 'name' => "Ensalada Cesar", 'price' => 15  ]);
        DB::table('ayb_items')->insert([ 'name' => "Parrilla", 'price' => 16  ]);
        DB::table('ayb_items')->insert([ 'name' => "Sandwich", 'price' => 11  ]);
        DB::table('ayb_items')->insert([ 'name' => "Pollo a la plancha", 'price' => 54  ]);
        DB::table('ayb_items')->insert([ 'name' => "Pasapalo personal", 'price' => 99  ]);
        DB::table('ayb_items')->insert([ 'name' => "Chuleta / Churrasco", 'price' => 24  ]);
        DB::table('ayb_items')->insert([ 'name' => "Pasta", 'price' => 44  ]);
        DB::table('ayb_items')->insert([ 'name' => "Pollo a la pancha con pure", 'price' => 77  ]);
        DB::table('ayb_items')->insert([ 'name' => "Quesillo", 'price' => 84  ]);
        DB::table('ayb_items')->insert([ 'name' => "Canolis", 'price' => 23  ]);
        DB::table('ayb_items')->insert([ 'name' => "Yukeri", 'price' => 21  ]);
        DB::table('ayb_items')->insert([ 'name' => "Cervezas", 'price' => 19  ]);
        DB::table('ayb_items')->insert([ 'name' => "Tinto de Verano", 'price' => 17  ]);
        DB::table('ayb_items')->insert([ 'name' => "Whisky", 'price' => 41  ]);
        DB::table('ayb_items')->insert([ 'name' => "Ron", 'price' => 10  ]);
    }
}
