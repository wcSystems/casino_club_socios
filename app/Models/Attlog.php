<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attlog extends Model
{
    protected $table = 'attlogs';

    protected $fillable = [
        'employeeID',
        'authDateTime',
        'authDate',
        'authTime',
        'direction',
        'deviceName',
        'deviceSN',
        'personName',
        'cardNo',
    ];
}
