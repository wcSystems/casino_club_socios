<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Img_ayb_item extends Model
{
    protected $fillable = [
        'name',
        'ayb_item_id',
    ];

    public function item() {
        return $this->belongsTo('App\Models\Ayb_item');
    }
}
