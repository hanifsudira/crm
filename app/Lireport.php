<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lireport extends Model
{
    protected $table = 'lineitem_report';

    protected $fillable = [
        'ORDER_NUM',
        'REV',
        'PRODUCT',
        'OH_STATUS',
        'LI_STATUS',
        'MILESTONE',
        'ORDER_SUBTYPE',
        'CREATED_AT',
        'FULFILL_STATUS',
        'ACC_NAS',
        'NIPNAS',
        'SID_NUM',
        'lastupdate'
    ];
}
