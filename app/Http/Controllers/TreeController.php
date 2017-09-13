<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Tree;

class TreeController extends Controller
{
    public function treeview(){
        $count = DB::table('tree')->count();
        $lastupdate = Tree::select('lastupdate')->first();
        return view('tree.hirarchy',['count'=>$count,'lu'=>$lastupdate->lastupdate]);
    }

    public function gettreeview($id){
        $ordernum = base64_decode($id);
        return view('tree.tree',['order'=>$ordernum]);
    }

    public function getroot($ordernum){
        $root = DB::select("select distinct(n.agg_num), n.agg_name, n.rev_num, n.parent, n.agg_id from ( select t.* from tree t inner join (select agg_num, max(rev_num) as latest from tree where agg_type!='Contract Amendment' group by agg_num ) as groupped on t.agg_num=groupped.agg_num and t.rev_num=groupped.latest where t.site = '$ordernum' order by t.rev_num desc) as n;");
        $jstree = array();
        foreach ($root as $d){
            $temp = array(
                'id'            => $d->agg_id,
                'text'          => $d->agg_name,
                'parent'        => '#',
                'parent_num'    => $d->parent,
                'rev_num'       => $d->rev_num,
                'agg_num'       => str_replace('/',':_:',$d->agg_num),
                'level'         => '0',
                'children'	    => true
            );
            $jstree[] = $temp;
        }

        echo json_encode($jstree);
    }


    public function getchild($id,$parent_num,$rev_num,$agg_num,$level,$site){
        $agg_num = str_replace(':_:','/',$agg_num);
        #$child = DB::select("select distinct(agg_num), agg_name, rev_num, agg_id, parent from tree where (agg_num='$agg_num' and rev_num<>'$rev_num') and (parent='$parent_num');");
        $child = DB::select("select distinct(agg_num), agg_name, rev_num, parent from tree where site= '$site' and n.agg_num='$agg_num' and n.rev_num<>'$rev_num');");
        $jstree = array();
        foreach ($child as $d){
            $temp = array(
                'id'            => $d->agg_id,
                'text'          => $d->agg_name,
                'parent'        => $id,
                'parent_num'    => $d->parent,
                'rev_num'       => $d->rev_num,
                'agg_num'       => str_replace('/',':_:',$d->agg_num),
                'level'         => '1',
                'children'	    => true
            );
            $jstree[] = $temp;
        }
        echo json_encode($jstree);
    }
}
