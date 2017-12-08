<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lireport extends Model
{
    protected $table = 'int_report';

    protected $fillable = [
        'ORDER_NUM',
        'ROW_ID',
        'ORDER_SUBTYPE',
        'REV',
        'PRODUCT',
        'OH_STATUS',
        'LI_STATUS',
        'MILESTONE',
        'CREATED_AT',
        'FULFILL_STATUS',
        'ACC_NAS',
        'NIPNAS',
        'SID_NUM',
        'OH_SEQ',
        'MSTONE_SEQ',
        'LI_STATUS_INT',
        'MILE_STATUS_INT',
        'INT_ID',
        'INT_NOTE'
    ];
}
