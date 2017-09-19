<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Massive extends Model
{
    protected $table = 'int_report2';

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
        'lastupdate', 
        'INT_ID', 
        'INT_NOTE', 
        'SEGMENT', 
        'TSQ_STATE', 
        'TSQ_DESC', 
        'DELIVER_STATE', 
        'DELIVER_DESC', 
        'ROWID_ORDER'
    ];
}
