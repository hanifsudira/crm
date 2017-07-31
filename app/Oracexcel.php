<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oracexcel extends Model
{
    protected $table = 'oraexcel';

    protected $fillable = [
        'ORDER_NUM',
        'ORDER_SUBTYPE',
        'OH_STATUS',
        'MOLI_ROW_ID',
        'MOLI_CREATED_DT',
        'MOLI_LAST_UPDATED_DT',
        'MOLI_PRODUCT_NAME',
        'MOLI_STATUS',
        'MOLI_FULFILLMENT_STATUS',
        'MOLI_MILESTONE',
        'MOLI_SERVICE_ID',
        'MOLI_ASSET_INTEG_ID',
        'MOLI_BILL_',
        'MOLI_AGREE_NUM',
        'lastupdate'
    ];
}
