<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TreeController extends Controller
{
    public function treeview(){
        return view('tree.hirarchy');
    }

    public function gettreeview(Request $request){
        $ordernum = $request->order;
        $root = DB::select("select distinct(n.agg_num), n.agg_name, n.rev_num, n.parent, n.agg_id from ( select t.* from tree t inner join (select agg_num, max(rev_num) as latest from tree where agg_type!='Contract Amendment' group by agg_num ) as groupped on t.agg_num=groupped.agg_num and t.rev_num=groupped.latest where t.site = '$ordernum' order by t.rev_num desc) as n;");
        foreach ($root as $d){
            $temp = array(
                'id'        => $d->rev_num,
                'text'      => $d->agg_name,
                'parent'    => $d->parent,
                'children'	=> true
            );
        }
        $jstree[] = $temp;
        return view('tree.tree',['data' => $jstree]);
    }
}
