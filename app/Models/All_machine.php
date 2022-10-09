<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class All_machine extends Model
{
    protected $fillable = [
        'name',
        'sede_id',
        'brand_machine_id',
        'model_machine_id',
        'range_machine_id',
        'associated_machine_id',
        'value_machine_id',
        'play_machine_id',
    ];

    public function sede() {
        return $this->belongsTo('App\Models\Sede');
    }
    public function brand() {
        return $this->belongsTo('App\Models\Brand_machine');
    }
    public function model() {
        return $this->belongsTo('App\Models\Model_machine');
    }
    public function range() {
        return $this->belongsTo('App\Models\Range_machine');
    }
    public function associated() {
        return $this->belongsTo('App\Models\Associated_machine');
    }
    public function value() {
        return $this->belongsTo('App\Models\Value_machine');
    }
    public function play() {
        return $this->belongsTo('App\Models\Play_machine');
    }

}
