<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oreport extends Model
{
    protected $table = 'order_report';

    protected $fillable = [
        'STATUS',
        'JUMLAH',
        'lastupdate'
    ];
}
