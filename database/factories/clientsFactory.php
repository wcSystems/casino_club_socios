<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Client;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'last_name' => $faker->lastName,
        'cedula' => $faker->unique()->numberBetween($min = 10000000, $max = 99999999),
        'f_nac' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'email' => $faker->unique()->userName,
        'address' => $faker->address,
        'phone' => $faker->numberBetween($min = 10000000000, $max = 9999999999),
        'club_vip' => $faker->numberBetween($min = 0, $max = 1),
        'referido' => $faker->numberBetween($min = 0, $max = 1),
        'vive_cerca' => $faker->numberBetween($min = 0, $max = 1),
        'trabaja_cerca' => $faker->numberBetween($min = 0, $max = 1),
        'solo_de_paso' => $faker->numberBetween($min = 0, $max = 1),
        'descuento' => $faker->numberBetween($min = 0, $max = 1),
        'puntos_por_canje' => $faker->numberBetween($min = 0, $max = 1),
        'ticket_souvenirs' => $faker->numberBetween($min = 0, $max = 1),
        'transportation_id' => $faker->numberBetween($min = 1, $max = 3),
    ];
});
