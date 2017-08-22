<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Oracexcel;
use phpDocumentor\Reflection\Types\Null_;

class ReportController extends Controller
{
    public function allreport(){
        $lastupdate = Oracexcel::select('lastupdate')->first();
        $pivot = DB::select('select moli_status, moli_milestone, 
                                count(case when ORDER_SUBTYPE=\'disconnect\' then 1 end) do,
                                count(case when ORDER_SUBTYPE=\'modify\' then 1 end) mo,
                                count(case when ORDER_SUBTYPE=\'new install\' then 1 end) ao,
                                count(case when ORDER_SUBTYPE=\'resume\' then 1 end) ro,
                                count(case when ORDER_SUBTYPE=\'suspend\' then 1 end) so
                            from oraexcel pt group by moli_milestone,moli_status');

        #call integrasi
        $call = array();

        $a = array();
        $nol = DB::select('select order_num from crm_dashboard.oraexcel where moli_status = \'submitted\' and moli_milestone=\'none\'');
        foreach ($nol as $n){
            array_push($a,$n->order_num);
        }
        array_push($call,$a);

        $a = array();
        $nol = DB::select('select order_num from crm_dashboard.oraexcel where moli_status = \'in progress\' and moli_milestone=\'none\'');
        foreach ($nol as $n){
            array_push($a,$n->order_num);
        }
        array_push($call,$a);

        $a = array();
        $nol = DB::select('select order_num from crm_dashboard.oraexcel where moli_status = \'in progress\' and moli_milestone=\'SYNC CUSTOMER START\'');
        foreach ($nol as $n){
            array_push($a,$n->order_num);
        }
        array_push($call,$a);

        $a = array();
        $nol = DB::select('select order_num from crm_dashboard.oraexcel where moli_status = \'in progress\' and moli_milestone=\'SYNC CUSTOMER COMPLETE\'');
        foreach ($nol as $n){
            array_push($a,$n->order_num);
        }
        array_push($call,$a);
        #var_dump($call);

        $file = fopen('/var/www/html/crm/public/scripts/param.txt','w+');
        fwrite($file,json_encode($call));
        fclose($file);

        #$command    = "/usr/bin/python /var/www/html/crm/public/scripts/getint.py";
        #$output     = shell_exec($command);
        #$output     = json_decode($output);
        #var_dump($output);

        $status = ['Pending', 'Submitted', 'In Progress', 'In Progress', 'In Progress', 'In Progress', 'In Progress', 'Pending BASO', 'Pending BASO', 'Pending Billing Approval', 'Pending Billing Approval', 'Complete', 'Complete', 'Failed', 'Pending Cancel', 'Pending Cancel', 'Pending Cancel', 'Pending Cancel', 'Pending Cancel', 'Cancelled', 'Cancelled'];
        $milestone = ['None', 'None', 'None', 'SYNC CUSTOMER START', 'SYNC CUSTOMER COMPLETE', 'PROVISION START', 'PROVISION ISSUED', 'PROVISION COMPLETE', 'BASO STARTED', 'BILLING APPROVAL STARTED', 'FULFILL BILLING START', 'PROVISION COMPLETE', 'FULFILL BILLING COMPLETE', 'SYNC CUSTOMER START', 'None', 'SYNC CUSTOMER START', 'SYNC CUSTOMER COMPLETE', 'PROVISION START', 'PROVISION COMPLETE', 'None', 'SYNC CUSTOMER COMPLETE'];

        $return = array();
        $countverarr = array();
        $all = 0;
        for($i=0;$i<count($status);$i++){
            $state = 0;
            foreach ($pivot as $data){
                if($data->moli_status==$status[$i] and $data->moli_milestone==$milestone[$i]){
                    $state = 1;
                    array_push($return,$data);
                    $countver = $data->do+$data->mo+$data->ao+$data->ro+$data->so;
                    array_push($countverarr,$countver);
                    break;
                }
            }
            if(!$state){
                $temp = new \stdClass();
                $temp->moli_status = $status[$i];
                $temp->moli_milestone = $milestone[$i];
                $temp->do = 0;
                $temp->mo = 0;
                $temp->ao = 0;
                $temp->ro = 0;
                $temp->so = 0;
                array_push($return,$temp);
                array_push($countverarr,0);
            }
        }
        $counthorarr = array();
        $counthorarr[0] = 0;$counthorarr[1] = 0;$counthorarr[2] = 0;$counthorarr[3] = 0;$counthorarr[4] = 0;
        foreach ($return as $r){
            $counthorarr[0] += $r->do;
            $counthorarr[1] += $r->mo;
            $counthorarr[2] += $r->ao;
            $counthorarr[3] += $r->ro;
            $counthorarr[4] += $r->so;
        }

        #return view('report.allreport',['data'=>$return,'hor'=>$counthorarr,'ver'=>$countverarr,'lu'=>$lastupdate->lastupdate]);
    }

    public function reviewtransaksi(){
        $command    = "/usr/bin/python /var/www/html/crm/public/scripts/getrt.py";
        $output     = shell_exec($command);
        $output     = json_decode($output);
        $lead       = $output[0];
        $quote      = $output[1];
        $agree      = $output[2];
        $order      = $output[3];
        return view('report.review',['lead'=>$lead,'quote'=>$quote,'agree'=>$agree,'order'=>$order]);
    }
}