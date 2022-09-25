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
        DB::table('ayb_items')->insert([ 'name' => "Almuerzo", 'price' => 12 , 'description' => " n/a ", 'sede_id' => "6", 'group_menu_id' => 1  ]);
        DB::table('ayb_items')->insert([ 'name' => "Ensalada Cesar", 'price' => 15 , 'description' => " n/a ", 'sede_id' => "6", 'group_menu_id' => 1  ]);
        DB::table('ayb_items')->insert([ 'name' => "Parrilla", 'price' => 16 , 'description' => " n/a ", 'sede_id' => "6", 'group_menu_id' => 1  ]);
        DB::table('ayb_items')->insert([ 'name' => "Sandwich", 'price' => 11 , 'description' => " n/a ", 'sede_id' => "6", 'group_menu_id' => 1  ]);
        DB::table('ayb_items')->insert([ 'name' => "Pollo a la plancha", 'price' => 54 , 'description' => " n/a ", 'sede_id' => "6", 'group_menu_id' => 1  ]);
        DB::table('ayb_items')->insert([ 'name' => "Pasapalo personal", 'price' => 99 , 'description' => " n/a ", 'sede_id' => "6", 'group_menu_id' => 1  ]);
        DB::table('ayb_items')->insert([ 'name' => "Chuleta / Churrasco", 'price' => 24 , 'description' => " n/a ", 'sede_id' => "6", 'group_menu_id' => 1  ]);
        DB::table('ayb_items')->insert([ 'name' => "Pasta", 'price' => 44 , 'description' => " n/a ", 'sede_id' => "6", 'group_menu_id' => 1  ]);
        DB::table('ayb_items')->insert([ 'name' => "Pollo a la pancha con pure", 'price' => 77 , 'description' => " n/a ", 'sede_id' => "6", 'group_menu_id' => 1  ]);
        DB::table('ayb_items')->insert([ 'name' => "Quesillo", 'price' => 84 , 'description' => " n/a ", 'sede_id' => "6", 'group_menu_id' => 1  ]);
        DB::table('ayb_items')->insert([ 'name' => "Canolis", 'price' => 23 , 'description' => " n/a ", 'sede_id' => "6", 'group_menu_id' => 1  ]);
        DB::table('ayb_items')->insert([ 'name' => "Yukeri", 'price' => 21 , 'description' => " n/a ", 'sede_id' => "6", 'group_menu_id' => 1  ]);
        DB::table('ayb_items')->insert([ 'name' => "Cervezas", 'price' => 19 , 'description' => " n/a ", 'sede_id' => "6", 'group_menu_id' => 1  ]);
        DB::table('ayb_items')->insert([ 'name' => "Tinto de Verano", 'price' => 17 , 'description' => " n/a ", 'sede_id' => "6", 'group_menu_id' => 1  ]);
        DB::table('ayb_items')->insert([ 'name' => "Whisky", 'price' => 41 , 'description' => " n/a ", 'sede_id' => "6", 'group_menu_id' => 1  ]);
        DB::table('ayb_items')->insert([ 'name' => "Ron", 'price' => 10 , 'description' => " n/a ", 'sede_id' => "6", 'group_menu_id' => 1  ]);

        DB::table('ayb_items')->insert([ 'name' => "SANDWICH FRIOS", 'price' => 0, 'description' => "Presentación con tostones o chips de papas o batata", 'sede_id' => "6", 'group_menu_id' => 2  ]);
        DB::table('ayb_items')->insert([ 'name' => "MINI HAMBURGUESAS", 'price' => 0, 'description' => "Presentación con tostones o chips de papas o batata", 'sede_id' => "6", 'group_menu_id' => 2  ]);
        DB::table('ayb_items')->insert([ 'name' => "PASTELES SALADOS", 'price' => 0, 'description' => "Presentación con ensalada", 'sede_id' => "6", 'group_menu_id' => 2  ]);
        DB::table('ayb_items')->insert([ 'name' => "PINCHOS", 'price' => 0, 'description' => "Se adiciona la ensalada con fruta y vinagreta dulce (alternativa a la Cesar)", 'sede_id' => "6", 'group_menu_id' => 2  ]);
    }
}
