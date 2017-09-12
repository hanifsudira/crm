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
        $temp = array();
        foreach ($root as $d){
            $temp = array(
                'id'        => $d->agg_id,
                'text'      => $d->agg_name,
                'parent'    => '#',
                'children'	=> true
            );
        }
        $jstree[] = $temp;

        echo json_encode($jstree);
    }
}
