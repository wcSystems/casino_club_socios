<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'last_name',
        'f_nac',
        'email',
        'address',
        'phone',
        'cedula',
        'transportation_id',
        'club_vip',
        'referido',
        'vive_cerca',
        'trabaja_cerca',
        'solo_de_paso',
        'descuento',
        'puntos_por_canje',
        'ticket_souvenirs',
    ];

    public function transportation_one() {
        return $this->belongsTo('App\Models\Transportation');
    }
    public function machines() {
        return $this->belongsToMany('App\Models\Machine','client_machines');
    }
    public function tables() {
        return $this->belongsToMany('App\Models\Table','client_tables');
    }
    public function foods() {
        return $this->belongsToMany('App\Models\Food','client_foods');
    }
    public function juices() {
        return $this->belongsToMany('App\Models\Juice','client_juices');
    }
    public function drinks() {
        return $this->belongsToMany('App\Models\Drink','client_drinks');
    }

}
