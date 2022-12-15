<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([ 'group' => 1, 'name' => "Gran Casino PLC", 'address' => "S/D" ]);
        DB::table('rooms')->insert([ 'group' => 1, 'name' => "Gran Casino La Guaira", 'address' => "S/D" ]);
        DB::table('rooms')->insert([ 'group' => 1, 'name' => "Gran Casino San Cristobal", 'address' => "S/D" ]);
        DB::table('rooms')->insert([ 'group' => 1, 'name' => "Bingo Charaima", 'address' => "Avenida 4 de mayo edificio bingo charaima, isla de margarita" ]);
        DB::table('rooms')->insert([ 'group' => 1, 'name' => "Bingo caribe Plaza", 'address' => "Calle Jesús María Patiño entre avenida Santiago Mariño y calle Malavé, local Bingo Caribe Plaza,sector centro, Porlamar" ]);
        DB::table('rooms')->insert([ 'group' => 1, 'name' => "Tamanaco", 'address' => "S/D" ]);
        DB::table('rooms')->insert([ 'group' => 1, 'name' => "Plaza Mayor", 'address' => "S/D" ]);

        DB::table('rooms')->insert([ 'group' => 0, 'name' => "Gainer’s", 'address' => "Calle Carabobo # 12 puerto la Cruz" ]);
        DB::table('rooms')->insert([ 'group' => 0, 'name' => "Barrio sucre", 'address' => "Calle Guayaquil # 11-14 barrio sucre Barcelona" ]);
        DB::table('rooms')->insert([ 'group' => 0, 'name' => "Mesones ( cerca de SIGO )", 'address' => "Centro comercial Mezfari, galpón # 11 calle san Antonio, barrio pequeña y mediana industria, mesones, parroquia san Cristóbal, Barcelona estado Anzoátegui, 6001" ]);
        DB::table('rooms')->insert([ 'group' => 0, 'name' => "Edi", 'address' => "S/D" ]);
        DB::table('rooms')->insert([ 'group' => 0, 'name' => "Bolivar", 'address' => "S/D" ]);
    }
}
