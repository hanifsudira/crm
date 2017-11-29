<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Osummary extends Model
{
    protected $table = 'order_summary';

    protected $fillable = [
        'ORDER_NUM',
        'STATUS',
        'ACC_NAS',
        'NIPNAS',
        'lastupdate'
    ];
}
