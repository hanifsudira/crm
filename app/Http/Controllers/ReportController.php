<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Oracexcel;
use Excel;
use function MongoDB\BSON\fromJSON;
use phpDocumentor\Reflection\Types\Null_;

class ReportController extends Controller
{
    public function allreport(){
        $lastupdate = DB::select('select lastupdate from int_report limit 1')[0];
        $pivot = DB::select('select li_status, milestone, 
                                count(case when ORDER_SUBTYPE=\'disconnect\' then 1 end) do,
                                count(case when ORDER_SUBTYPE=\'modify\' then 1 end) mo,
                                count(case when ORDER_SUBTYPE=\'new install\' then 1 end) ao,
                                count(case when ORDER_SUBTYPE=\'resume\' then 1 end) ro,
                                count(case when ORDER_SUBTYPE=\'suspend\' then 1 end) so
                            from int_report pt group by milestone,li_status');

        $pivotint = DB::select('select li_status_int, mile_status_int, count(*) as jumlah
                                from int_report 
                                group by mile_status_int,li_status_int order by li_status_int desc;');

        $status = ['Pending', 'Submitted', 'In Progress', 'In Progress', 'In Progress', 'In Progress', 'In Progress', 'Pending BASO', 'Pending BASO', 'Pending Billing Approval', 'Pending Billing Approval', 'Complete', 'Complete', 'Failed', 'Pending Cancel', 'Pending Cancel', 'Pending Cancel', 'Pending Cancel', 'Pending Cancel', 'Cancelled', 'Cancelled'];
        $milestone = ['None', 'None', 'None', 'SYNC CUSTOMER START', 'SYNC CUSTOMER COMPLETE', 'PROVISION START', 'PROVISION ISSUED', 'PROVISION COMPLETE', 'BASO STARTED', 'BILLING APPROVAL STARTED', 'FULFILL BILLING START', 'PROVISION COMPLETE', 'FULFILL BILLING COMPLETE', 'SYNC CUSTOMER START', 'None', 'SYNC CUSTOMER START', 'SYNC CUSTOMER COMPLETE', 'PROVISION START', 'PROVISION COMPLETE', 'None', 'SYNC CUSTOMER COMPLETE'];

        $return = array();
        $countverarr = array();
        $countverarrint = array();
        $countint = 0;
        for($i=0;$i<count($status);$i++){

            #db crm
            $state = 0;
            foreach ($pivot as $data){
                if($data->li_status==$status[$i] and $data->milestone==$milestone[$i]){
                    $state = 1;
                    array_push($return,$data);
                    $countver = $data->do+$data->mo+$data->ao+$data->ro+$data->so;
                    array_push($countverarr,$countver);
                    break;
                }
            }
            if(!$state){
                $temp = new \stdClass();
                $temp->li_status = $status[$i];
                $temp->milestone = $milestone[$i];
                $temp->do = 0;
                $temp->mo = 0;
                $temp->ao = 0;
                $temp->ro = 0;
                $temp->so = 0;
                array_push($return,$temp);
                array_push($countverarr,0);
            }

            #int
            $stateint = 0;
            foreach ($pivotint as $int){
                if($int->li_status_int==$status[$i] and $int->mile_status_int==$milestone[$i]){
                    $stateint = 1;
                    array_push($countverarrint,$int->jumlah);
                    $countint+=$int->jumlah;
                    break;
                }
            }
            if(!$stateint){
                array_push($countverarrint,0);
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

        return view('report.allreport',['data'=>$return,'hor'=>$counthorarr,'ver'=>$countverarr,'countint'=>$countint,'verint'=>$countverarrint,'lu'=>$lastupdate->lastupdate]);
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

    public function intreport(){
        $lastupdate = DB::select('select lastupdate from int_report limit 1')[0];
        $pivot = DB::select('select li_status, milestone, 
                                    count(case when INT_NOTE=\'ERROR SYNC CUSTOMER\' then 1 end) esc,
                                    count(case when INT_NOTE=\'ERROR TSQ\' then 1 end) et,
                                    count(case when INT_NOTE=\'ERROR DELIVER\' then 1 end) ed,
                                    count(case when INT_NOTE=\'ERROR FULFILL BILLING START\' then 1 end) efbs,
                                    count(case when INT_NOTE=\'None\' then 1 end) non,
                                    count(case when INT_NOTE=\'TSQ\' then 1 end) tsq,
                                    count(case when INT_NOTE=\'DELIVER\' then 1 end) del,
                                    count(case when INT_NOTE=\'PENDING BASO\' then 1 end) pb,
                                    count(case when INT_NOTE=\'PENDING BILLING APPROVAL\' then 1 end) pba,
                                    count(case when INT_NOTE=\'COMPLETE\' then 1 end) com,
                                    count(case when INT_NOTE=\'CANCEL FROM OSS\' then 1 end) cfo,
                                    count(case when INT_NOTE=\'ERROR AREA\' then 1 end) ea,
                                    count(case when INT_NOTE=\'NEED DELIVER\' then 1 end) nd
                            from int_report pt group by milestone,li_status');

        $pivotmin24 = DB::select('select li_status, milestone, 
                                    count(case when INT_NOTE=\'ERROR SYNC CUSTOMER\' then 1 end) esc,
                                    count(case when INT_NOTE=\'ERROR TSQ\' then 1 end) et,
                                    count(case when INT_NOTE=\'ERROR DELIVER\' then 1 end) ed,
                                    count(case when INT_NOTE=\'ERROR FULFILL BILLING START\' then 1 end) efbs,
                                    count(case when INT_NOTE=\'None\' then 1 end) non,
                                    count(case when INT_NOTE=\'TSQ\' then 1 end) tsq,
                                    count(case when INT_NOTE=\'DELIVER\' then 1 end) del,
                                    count(case when INT_NOTE=\'PENDING BASO\' then 1 end) pb,
                                    count(case when INT_NOTE=\'PENDING BILLING APPROVAL\' then 1 end) pba,
                                    count(case when INT_NOTE=\'COMPLETE\' then 1 end) com,
                                    count(case when INT_NOTE=\'CANCEL FROM OSS\' then 1 end) cfo,
                                    count(case when INT_NOTE=\'ERROR AREA\' then 1 end) ea,
                                    count(case when INT_NOTE=\'NEED DELIVER\' then 1 end) nd
                            from int_report pt where timestampdiff(HOUR,  str_to_date(created_at,\'%d-%b-%Y %H:%i:%s\'),now()) <=24 group by milestone,li_status;');

        $pivotmax24 = DB::select('select li_status, milestone, 
                                    count(case when INT_NOTE=\'ERROR SYNC CUSTOMER\' then 1 end) esc,
                                    count(case when INT_NOTE=\'ERROR TSQ\' then 1 end) et,
                                    count(case when INT_NOTE=\'ERROR DELIVER\' then 1 end) ed,
                                    count(case when INT_NOTE=\'ERROR FULFILL BILLING START\' then 1 end) efbs,
                                    count(case when INT_NOTE=\'None\' then 1 end) non,
                                    count(case when INT_NOTE=\'TSQ\' then 1 end) tsq,
                                    count(case when INT_NOTE=\'DELIVER\' then 1 end) del,
                                    count(case when INT_NOTE=\'PENDING BASO\' then 1 end) pb,
                                    count(case when INT_NOTE=\'PENDING BILLING APPROVAL\' then 1 end) pba,
                                    count(case when INT_NOTE=\'COMPLETE\' then 1 end) com,
                                    count(case when INT_NOTE=\'CANCEL FROM OSS\' then 1 end) cfo,
                                    count(case when INT_NOTE=\'ERROR AREA\' then 1 end) ea,
                                    count(case when INT_NOTE=\'NEED DELIVER\' then 1 end) nd
                            from int_report pt where timestampdiff(HOUR,  str_to_date(created_at,\'%d-%b-%Y %H:%i:%s\'),now()) >24 group by milestone,li_status;');

        $status = ['Pending', 'Submitted', 'In Progress', 'In Progress', 'In Progress', 'In Progress', 'In Progress', 'Pending BASO', 'Pending BASO', 'Pending Billing Approval', 'Pending Billing Approval', 'Complete', 'Complete', 'Failed', 'Pending Cancel', 'Pending Cancel', 'Pending Cancel', 'Pending Cancel', 'Pending Cancel', 'Cancelled', 'Cancelled'];
        $milestone = ['None', 'None', 'None', 'SYNC CUSTOMER START', 'SYNC CUSTOMER COMPLETE', 'PROVISION START', 'PROVISION ISSUED', 'PROVISION COMPLETE', 'BASO STARTED', 'BILLING APPROVAL STARTED', 'FULFILL BILLING START', 'PROVISION COMPLETE', 'FULFILL BILLING COMPLETE', 'SYNC CUSTOMER START', 'None', 'SYNC CUSTOMER START', 'SYNC CUSTOMER COMPLETE', 'PROVISION START', 'PROVISION COMPLETE', 'None', 'SYNC CUSTOMER COMPLETE'];

        $return = array();
        $returnmin24 = array();
        $returnmax24 = array();

        $counthorarr = array();
        $counthorarr[0] = 0;
        $counthorarr[1] = 0;
        $counthorarr[2] = 0;
        $counthorarr[3] = 0;
        $counthorarr[4] = 0;
        $counthorarr[5] = 0;
        $counthorarr[6] = 0;
        $counthorarr[7] = 0;
        $counthorarr[8] = 0;
        $counthorarr[9] = 0;
        $counthorarr[10] = 0;
        $counthorarr[11] = 0;
        $counthorarr[12] = 0;

        $counthorarrmin24 = array();
        $counthorarrmin24[0] = 0;
        $counthorarrmin24[1] = 0;
        $counthorarrmin24[2] = 0;
        $counthorarrmin24[3] = 0;
        $counthorarrmin24[4] = 0;
        $counthorarrmin24[5] = 0;
        $counthorarrmin24[6] = 0;
        $counthorarrmin24[7] = 0;
        $counthorarrmin24[8] = 0;
        $counthorarrmin24[9] = 0;
        $counthorarrmin24[10] = 0;
        $counthorarrmin24[11] = 0;
        $counthorarrmin24[12] = 0;

        $counthorarrmax24 = array();
        $counthorarrmax24[0] = 0;
        $counthorarrmax24[1] = 0;
        $counthorarrmax24[2] = 0;
        $counthorarrmax24[3] = 0;
        $counthorarrmax24[4] = 0;
        $counthorarrmax24[5] = 0;
        $counthorarrmax24[6] = 0;
        $counthorarrmax24[7] = 0;
        $counthorarrmax24[8] = 0;
        $counthorarrmax24[9] = 0;
        $counthorarrmax24[10] = 0;
        $counthorarrmax24[11] = 0;
        $counthorarrmax24[12] = 0;

        #all
        for($i=0;$i<count($status);$i++){
            #db crm
            $state = 0;
            foreach ($pivot as $data){
                if($data->li_status==$status[$i] and $data->milestone==$milestone[$i]){
                    $state = 1;
                    array_push($return,$data);
                    $counthorarr[0] += $data->esc;
                    $counthorarr[1] += $data->et;
                    $counthorarr[2] += $data->ed;
                    $counthorarr[3] += $data->efbs;
                    $counthorarr[4] += $data->non;
                    $counthorarr[5] += $data->tsq;
                    $counthorarr[6] += $data->del;
                    $counthorarr[7] += $data->pb;
                    $counthorarr[8] += $data->pba;
                    $counthorarr[9] += $data->com;
                    $counthorarr[10] += $data->cfo;
                    $counthorarr[11] += $data->ea;
                    $counthorarr[12] += $data->nd;
                    break;
                }
            }
            if(!$state){
                $temp = new \stdClass();
                $temp->li_status = $status[$i];
                $temp->milestone = $milestone[$i];
                $temp->et   = 0;
                $temp->ed   = 0;
                $temp->efbs = 0;
                $temp->esc  = 0;
                $temp->tsq  = 0;
                $temp->del  = 0;
                $temp->com  = 0;
                $temp->pb   = 0;
                $temp->pba  = 0;
                $temp->non  = 0;
                $temp->cfo  = 0;
                $temp->ea   = 0;
                $temp->nd   = 0;
                array_push($return,$temp);
                $counthorarr[0] += 0;
                $counthorarr[1] += 0;
                $counthorarr[2] += 0;
                $counthorarr[3] += 0;
                $counthorarr[4] += 0;
                $counthorarr[5] += 0;
                $counthorarr[6] += 0;
                $counthorarr[7] += 0;
                $counthorarr[8] += 0;
                $counthorarr[9] += 0;
                $counthorarr[10] += 0;
                $counthorarr[11] += 0;
                $counthorarr[12] += 0;
            }
        }

        #min24
        for($i=0;$i<count($status);$i++){
            #db crm
            $state = 0;
            foreach ($pivotmin24 as $data){
                if($data->li_status==$status[$i] and $data->milestone==$milestone[$i]){
                    $state = 1;
                    array_push($returnmin24,$data);
                    $counthorarrmin24[0] += $data->esc;
                    $counthorarrmin24[1] += $data->et;
                    $counthorarrmin24[2] += $data->ed;
                    $counthorarrmin24[3] += $data->efbs;
                    $counthorarrmin24[4] += $data->non;
                    $counthorarrmin24[5] += $data->tsq;
                    $counthorarrmin24[6] += $data->del;
                    $counthorarrmin24[7] += $data->pb;
                    $counthorarrmin24[8] += $data->pba;
                    $counthorarrmin24[9] += $data->com;
                    $counthorarrmin24[10] += $data->cfo;
                    $counthorarrmin24[11] += $data->ea;
                    $counthorarrmin24[12] += $data->nd;
                    break;
                }
            }
            if(!$state){
                $temp = new \stdClass();
                $temp->li_status = $status[$i];
                $temp->milestone = $milestone[$i];
                $temp->et   = 0;
                $temp->ed   = 0;
                $temp->efbs = 0;
                $temp->esc  = 0;
                $temp->tsq  = 0;
                $temp->del  = 0;
                $temp->com  = 0;
                $temp->pb   = 0;
                $temp->pba  = 0;
                $temp->non  = 0;
                $temp->cfo  = 0;
                $temp->ea   = 0;
                $temp->nd   = 0;
                array_push($returnmin24,$temp);
                $counthorarrmin24[0] += 0;
                $counthorarrmin24[1] += 0;
                $counthorarrmin24[2] += 0;
                $counthorarrmin24[3] += 0;
                $counthorarrmin24[4] += 0;
                $counthorarrmin24[5] += 0;
                $counthorarrmin24[6] += 0;
                $counthorarrmin24[7] += 0;
                $counthorarrmin24[8] += 0;
                $counthorarrmin24[9] += 0;
                $counthorarrmin24[10] += 0;
                $counthorarrmin24[11] += 0;
                $counthorarrmin24[12] += 0;
            }
        }

        #max24
        for($i=0;$i<count($status);$i++){
            #db crm
            $state = 0;
            foreach ($pivotmax24 as $data){
                if($data->li_status==$status[$i] and $data->milestone==$milestone[$i]){
                    $state = 1;
                    array_push($returnmax24,$data);
                    $counthorarrmax24[0] += $data->esc;
                    $counthorarrmax24[1] += $data->et;
                    $counthorarrmax24[2] += $data->ed;
                    $counthorarrmax24[3] += $data->efbs;
                    $counthorarrmax24[4] += $data->non;
                    $counthorarrmax24[5] += $data->tsq;
                    $counthorarrmax24[6] += $data->del;
                    $counthorarrmax24[7] += $data->pb;
                    $counthorarrmax24[8] += $data->pba;
                    $counthorarrmax24[9] += $data->com;
                    $counthorarrmax24[10] += $data->cfo;
                    $counthorarrmax24[11] += $data->ea;
                    $counthorarrmax24[12] += $data->nd;
                    break;
                }
            }
            if(!$state){
                $temp = new \stdClass();
                $temp->li_status = $status[$i];
                $temp->milestone = $milestone[$i];
                $temp->et   = 0;
                $temp->ed   = 0;
                $temp->efbs = 0;
                $temp->esc  = 0;
                $temp->tsq  = 0;
                $temp->del  = 0;
                $temp->com  = 0;
                $temp->pb   = 0;
                $temp->pba  = 0;
                $temp->non  = 0;
                $temp->cfo  = 0;
                $temp->ea   = 0;
                $temp->nd   = 0;
                array_push($returnmax24,$temp);
                $counthorarrmax24[0] += 0;
                $counthorarrmax24[1] += 0;
                $counthorarrmax24[2] += 0;
                $counthorarrmax24[3] += 0;
                $counthorarrmax24[4] += 0;
                $counthorarrmax24[5] += 0;
                $counthorarrmax24[6] += 0;
                $counthorarrmax24[7] += 0;
                $counthorarrmax24[8] += 0;
                $counthorarrmax24[9] += 0;
                $counthorarrmax24[10] += 0;
                $counthorarrmax24[11] += 0;
                $counthorarrmax24[12] += 0;
            }
        }

        return view('report.intreport',['data'=>$return,'datamin24'=>$returnmin24,'datamax24'=>$returnmax24,'lu'=>$lastupdate->lastupdate,'hor'=>$counthorarr,'hormin24'=>$counthorarrmin24,'hormax24'=>$counthorarrmax24]);
    }

    public function flowdatareturn(){
        $pivot = DB::select('select li_status, milestone, 
                                count(case when ORDER_SUBTYPE=\'disconnect\' then 1 end) do,
                                count(case when ORDER_SUBTYPE=\'modify\' then 1 end) mo,
                                count(case when ORDER_SUBTYPE=\'new install\' then 1 end) ao,
                                count(case when ORDER_SUBTYPE=\'resume\' then 1 end) ro,
                                count(case when ORDER_SUBTYPE=\'suspend\' then 1 end) so
                            from int_report pt group by milestone,li_status');

        $status = ['Pending', 'Submitted', 'In Progress', 'In Progress', 'In Progress', 'In Progress', 'In Progress', 'Pending BASO', 'Pending BASO', 'Pending Billing Approval', 'Pending Billing Approval', 'Complete', 'Complete', 'Failed', 'Pending Cancel', 'Pending Cancel', 'Pending Cancel', 'Pending Cancel', 'Pending Cancel', 'Cancelled', 'Cancelled'];
        $milestone = ['None', 'None', 'None', 'SYNC CUSTOMER START', 'SYNC CUSTOMER COMPLETE', 'PROVISION START', 'PROVISION ISSUED', 'PROVISION COMPLETE', 'BASO STARTED', 'BILLING APPROVAL STARTED', 'FULFILL BILLING START', 'PROVISION COMPLETE', 'FULFILL BILLING COMPLETE', 'SYNC CUSTOMER START', 'None', 'SYNC CUSTOMER START', 'SYNC CUSTOMER COMPLETE', 'PROVISION START', 'PROVISION COMPLETE', 'None', 'SYNC CUSTOMER COMPLETE'];

        $orderheader = DB::select('SELECT OH_STATUS, count(OH_STATUS) as JUMLAH FROM crm_dashboard.int_report group by OH_STATUS;');
        $tsqdeliver = DB::select('SELECT INT_NOTE, count(INT_NOTE) as JUMLAH FROM crm_dashboard.int_report group by INT_NOTE;');

        $countverarr = array();
        for($i=0;$i<count($status);$i++){

            #db crm
            $state = 0;
            foreach ($pivot as $data){
                if($data->li_status==$status[$i] and $data->milestone==$milestone[$i]){
                    $state = 1;
                    $countver = $data->do+$data->mo+$data->ao+$data->ro+$data->so;
                    array_push($countverarr,$countver);
                    break;
                }
            }
            if(!$state){
                array_push($countverarr,0);
            }
        }

        $data = new \stdClass();
        $data->class                    = "go.GraphLinksModel";
        $data->copiesArrays             = true;
        $data->copiesArrayObjects       = true;
        $data->linkFromPortIdProperty   = "fromPort";
        $data->linkToPortIdProperty     = "toPort";
        $data->nodeDataArray            =  array(
            array(
                "name"=>"1.Pending\n[".(string)$orderheader[4]->JUMLAH."]",
                "leftArray"=> [
                    array(
                        "portId"=>"left0",
                        "portColor"=>"#000"
                    )
                ],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-3,
                "loc"=>"155 0",
                "color"=>"#203864",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=> "2.Submitted\n[".(string)$orderheader[6]->JUMLAH."]",
                "leftArray"=>[
                    array(
                        "portId"=>"left0",
                        "portColor"=>"#000"
                    ),
                ],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[
                    array(
                        "portId"=>"bottom0",
                        "portColor"=>"#000"
                    ),
                ],
                "key"=>-4,
                "loc"=>"155 58",
                "color"=> "#203864",
                "width"=>"10",
                "height"=>"5"),
            array(
                "name"=>"1.Pending\n[".(string)$countverarr[0]."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-5,
                "loc"=>"265 0",
                "color"=> "#2F5596",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"2.Submitted\n[".(string)$countverarr[1]."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[
                    array(
                        "portId"=>"bottom0",
                        "portColor"=>"#000"
                    ),
                ],
                "key"=>-6,
                "loc"=>"265 58",
                "color"=> "#2F5596",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"3.Inprogress\n[".(string)$orderheader[3]->JUMLAH."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array(
                        "portId"=>"top0",
                        "portColor"=>"#000"
                    ),
                ],
                "bottomArray"=>[],
                "key"=>-7,
                "loc"=>"155 310",
                "color"=> "#203864",
                "width"=>"10",
                "height"=>"17"
            ),
            array(
                "name"=>"17.Complete\n[".(string)$orderheader[1]->JUMLAH."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-8,
                "loc"=>"155 441",
                "color"=> "#203864",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"X.Pending Cancel",
                "leftArray"=>[
                    array(
                        "portId"=>"left0",
                        "portColor"=>"#000"
                    ),
                ],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-9,
                "loc"=>"155 501",
                "color"=> "#203864",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"17.Complete\n[".(string)($countverarr[11]+$countverarr[12])."]",
                "leftArray"=>[],
                "rightArray"=>[
                    array(
                        "portId"=>"right0",
                        "portColor"=>"#000"
                    ),
                ],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-10,
                "loc"=>"265 441",
                "color"=> "#2F5596",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"X.Pending Cancel",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-11,
                "loc"=>"265 501",
                "color"=> "#2F5596",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"3.Inprogress\n[".(string)($countverarr[2]+$countverarr[3]+$countverarr[4]+$countverarr[5]+$countverarr[6])."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-12,
                "loc"=>"265 251",
                "color"=> "#2F5596",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"11.Pending BASO\n[".(string)($countverarr[7]+$countverarr[8])."]",
                "leftArray"=>[],
                "rightArray"=>[
                    array(
                        "portId"=>"right0",
                        "portColor"=>"#000"
                    ),
                ],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-13,
                "loc"=>"265 311",
                "color"=> "#2F5596",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"13.Pending Billing\nApproval [".(string)($countverarr[9]+$countverarr[10])."]",
                "leftArray"=>[],
                "rightArray"=>[
                    array(
                        "portId"=>"right0",
                        "portColor"=>"#000"
                    ),
                ],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-14,
                "loc"=>"265 371",
                "color"=> "#2F5596",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"AIA\nCOM",
                "leftArray"=> [
                    array("portId"=>"left0", "portColor"=>"#000"),
                    array("portId"=>"left1", "portColor"=>"#000"),
                    array("portId"=>"left2", "portColor"=>"#000"),
                    array("portId"=>"left3", "portColor"=>"#000"),
                    array("portId"=>"left4", "portColor"=>"#000"),
                    array("portId"=>"left5", "portColor"=>"#000"),
                ],
                "rightArray"=>[
                    array("portId"=>"right0", "portColor"=>"#000"),
                    array("portId"=>"right1", "portColor"=>"#000"),
                    array("portId"=>"right2", "portColor"=>"#000"),
                    array("portId"=>"right3", "portColor"=>"#000"),
                    array("portId"=>"right4", "portColor"=>"#000"),
                    array("portId"=>"right5", "portColor"=>"#000"),
                ],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                    array("portId"=>"top1", "portColor"=>"#000"),
                    array("portId"=>"top2", "portColor"=>"#000"),
                    array("portId"=>"top3", "portColor"=>"#000"),
                    array("portId"=>"top4", "portColor"=>"#000"),
                    array("portId"=>"top5", "portColor"=>"#000"),
                ],
                "bottomArray"=>[
                    array("portId"=>"bottom0", "portColor"=>"#000"),
                    array("portId"=>"bottom1", "portColor"=>"#000"),
                    array("portId"=>"bottom2", "portColor"=>"#000"),
                    array("portId"=>"bottom3", "portColor"=>"#000"),
                    array("portId"=>"bottom4", "portColor"=>"#000"),
                    array("portId"=>"bottom5", "portColor"=>"#000"),
                ],
                "key"=>-15,
                "loc"=>"480 160",
                "color"=> "green",
                "width"=>"15",
                "height"=>"15"
            ),
            array(
                "name"=>"X.Failed",
                "leftArray"=>[
                    array("portId"=>"left0", "portColor"=>"#000"),
                ],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-16,
                "loc"=>"209 560",
                "color"=> "#000",
                "width"=>"20",
                "height"=>"5"
            ),
            array(
                "name"=>"TSQ\n[".(string)$tsqdeliver[2]->JUMLAH."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                ],
                "bottomArray"=>[],
                "key"=>-17,
                "loc"=>"469 522",
                "color"=> "red",
                "width"=>"5",
                "height"=>"5"
            ),
            array(
                "name"=>"Deliver\n[".(string)$tsqdeliver[0]->JUMLAH."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                ],
                "bottomArray"=>[],
                "key"=>-18,
                "loc"=>"531 522",
                "color"=> "red",
                "width"=>"5",
                "height"=>"5"),
            array(
                "name"=>"TREMS",
                "leftArray"=>[
                    array("portId"=>"left0", "portColor"=>"#000"),
                ],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>-20,
                "loc"=>"458 -105",
                "color"=> "#ED7D31",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"TIBS",
                "leftArray"=>[],
                "rightArray"=>[
                    array("portId"=>"right0", "portColor"=>"#000"),
                ],
                "topArray"=>[],
                "bottomArray"=>[
                    array("portId"=>"bottom0", "portColor"=>"#000"),
                    array("portId"=>"bottom1", "portColor"=>"#000"),
                ],
                "key"=>-21,
                "loc"=>"458 -45",
                "color"=> "#ED7D31",
                "width"=>"10",
                "height"=>"5"
            ),
            array(
                "name"=>"3.SCS [".(string)$countverarr[3]."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                ],
                "bottomArray"=>[],
                "key"=>-22,
                "loc"=>"625 281",
                "color"=> "#B3C7E8",
                "width"=>"5", "height"=>"5"
            ),
            array(
                "name"=>"5.SCC [".(string)$countverarr[4]."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                ],
                "bottomArray"=>[],
                "key"=>-23,
                "loc"=>"685 281",
                "color"=> "#B3C7E8",
                "width"=>"5",
                "height"=>"5"
            ),
            array(
                "name"=>"8.PS [".(string)$countverarr[5]."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                ],
                "bottomArray"=>[],
                "key"=>-24,
                "loc"=>"745 281",
                "color"=> "#B3C7E8",
                "width"=>"5",
                "height"=>"5"
            ),
            array(
                "name"=>"10.PC [".(string)$countverarr[7]."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                ],
                "bottomArray"=>[],
                "key"=>-25,
                "loc"=>"805 281",
                "color"=> "#B3C7E8",
                "width"=>"5",
                "height"=>"5"
            ),
            array(
                "name"=>"12.BAS [".(string)$countverarr[9]."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                ],
                "bottomArray"=>[
                    array("portId"=>"bottom0", "portColor"=>"#000"),
                ],
                "key"=>-27,
                "loc"=>"925 290",
                "color"=> "#B3C7E8",
                "width"=>"5",
                "height"=>"8"
            ),
            array(
                "name"=>"15.FBS [".(string)$countverarr[10]."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                ],
                "bottomArray"=>[],
                "key"=>-28,
                "loc"=>"984 290",
                "color"=> "#B3C7E8",
                "width"=>"5",
                "height"=>"8"
            ),
            array(
                "name"=>"17.FBC [".(string)$countverarr[12]."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                ],
                "bottomArray"=>[],
                "key"=>-29,
                "loc"=>"1045 290",
                "color"=> "#B3C7E8",
                "width"=>"5",
                "height"=>"8"
            ),
            array(
                "name"=>"11.BS [".(string)$countverarr[8]."]",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[
                    array("portId"=>"top0", "portColor"=>"#000"),
                ],
                "bottomArray"=>[
                    array("portId"=>"bottom0", "portColor"=>"#000"),
                ],
                "key"=>-30,
                "loc"=>"865 281",
                "color"=> "#B3C7E8",
                "width"=>"5",
                "height"=>"5"
            ),
            array(
                "name"=>"Dictionary:\n
                SCS: Sync Customer Start\n
                SCC: Sync Customer Complete\n
                PS: Provision Start\n
                PC: Provision Complete\n
                BS: BASO Started\n
                BAS: Billing Approval Start\n
                FBS: Fulfill Billing Start\n
                FBC: Fulfill Billing Complete\n
                MS: Milestone
                ",
                "leftArray"=>[],
                "rightArray"=>[],
                "topArray"=>[],
                "bottomArray"=>[],
                "key"=>41,
                "loc"=>"1200 480",
                "color"=> "#95a5a6",
                "width"=>"23",
                "height"=>"23"
            ),
        );
        $data->linkDataArray            = array(
            array(
                "from"=>-3,
                "to"=>-4,
                "fromPort"=>"left0",
                "toPort"=>"left0",
                "points"=> [97,0,87,0,83,0,83,29,83,58,97,58],
                "text"=>"1"
            ),
            array(
                "from"=>-6,
                "to"=>-15,
                "fromPort"=>"bottom0",
                "toPort"=>"left0",
                "points"=>[265,94,265,104,265,105,324,105,383,105,397,105],
                "text"=>"2"
            ),
            array(
                "from"=>-4,
                "to"=>-15,
                "fromPort"=>"bottom0",
                "toPort"=>"left1",
                "points"=>[155,94,155,104,155,127,265,127,375,127,397,127],
                "text"=>"2"),
            array(
                "from"=>-15,
                "to"=>-16,
                "fromPort"=>"left2",
                "toPort"=>"left0",
                "points"=>[397,149,363,149,56,149,56,560,87,560,101,560]
            ),
            array(
                "from"=>-15,
                "to"=>-9,
                "fromPort"=>"left3",
                "toPort"=>"left0",
                "points"=>[397,171,371,171,83,171,83,336,83,501,97,501]
            ),
            array(
                "from"=>-15,
                "to"=>-7,
                "fromPort"=>"left4",
                "toPort"=>"top0",
                "points"=>[397,193,379,193,155,193,155,200,155,207,155,217],
                "text"=>"3"
            ),
            array(
                "from"=>-15,
                "to"=>-13,
                "fromPort"=>"left5",
                "toPort"=>"right0",
                "points"=>[397,215,387,215,360,215,360,311,337,311,323,311],
                "text"=>"11"
            ),
            array(
                "from"=>-15,
                "to"=>-14,
                "fromPort"=>"bottom0",
                "toPort"=>"right0",
                "points"=>[425,243,425,257,425,371,381,371,337,371,323,371],
                "text"=>"13"
            ),
            array(
                "from"=>-15,
                "to"=>-10,
                "fromPort"=>"bottom1",
                "toPort"=>"right0",
                "points"=>[447,243,447,265,447,441,392,441,337,441,323,441],
                "text"=>"17"
            ),
            array(
                "from"=>-15,
                "to"=>-17,
                "fromPort"=>"bottom2",
                "toPort"=>"top0",
                "points"=>[469,243,469,277,469,388.5,469,388.5,469,476,469,486],
                "text"=>"5"
            ),
            array(
                "from"=>-15,
                "to"=>-18,
                "fromPort"=>"bottom3",
                "toPort"=>"top0",
                "points"=>[491,243,491,269,491,376.5,531,376.5,531,472,531,486],
                "text"=>"6"
            ),
            array(
                "from"=>-20,
                "to"=>-15,
                "fromPort"=>"left0",
                "toPort"=>"top0",
                "points"=>[400,-105,390,-105,390,13,425,13,425,63,425,77],
                "text"=>"3"
            ),
            array(
                "from"=>-15,
                "to"=>-21,
                "fromPort"=>"top1",
                "toPort"=>"bottom0",
                "points"=>[447,77,447,35,447,10,447,10,447,9,447,-9],
                "text"=>"3"
            ),
            array(
                "from"=>-15,
                "to"=>-21,
                "fromPort"=>"top2",
                "toPort"=>"bottom1",
                "points"=>[469,77,469,43,469,10,469,10,469,1,469,-9],
                "text"=>"15"
            ),
            array(
                "from"=>-21,
                "to"=>-15,
                "fromPort"=>"right0",
                "toPort"=>"top3",
                "points"=>[516,-45,526,-45,526,15,491,15,491,51,491,77],
                "text"=>"16"
            ),
            array(
                "from"=>-15,
                "to"=>-29,
                "fromPort"=>"top4",
                "toPort"=>"top0",
                "points"=>[513,77,513,59,513,39,1045,39,1045,228,1045,242],
                "text"=>"17"
            ),
            array(
                "from"=>-15,
                "to"=>-28,
                "fromPort"=>"top5",
                "toPort"=>"top0",
                "points"=>[535,77,535,67,984,67,984,147.5,984,228,984,242],
                "text"=>"15"
            ),
            array(
                "from"=>-15,
                "to"=>-27,
                "fromPort"=>"right0",
                "toPort"=>"top0",
                "points"=>[563,105,613,105,925,105,925,166.5,925,228,925,242],
                "text"=>"13"
            ),
            array(
                "from"=>-15,
                "to"=>-30,
                "fromPort"=>"right1",
                "toPort"=>"top0",
                "points"=>[563,127,605,127,865,127,865,179,865,231,865,245],
                "text"=>"11"
            ),
            array(
                "from"=>-15,
                "to"=>-25,
                "fromPort"=>"right2",
                "toPort"=>"top0",
                "points"=>[563,149,597,149,805,149,805,190,805,231,805,245],
                "text"=>"10"
            ),
            array(
                "from"=>-15,
                "to"=>-24,
                "fromPort"=>"right3",
                "toPort"=>"top0",
                "points"=>[563,171,589,171,745,171,745,201,745,231,745,245],
                "text"=>"8"
            ),
            array(
                "from"=>-15,
                "to"=>-23,
                "fromPort"=>"right4",
                "toPort"=>"top0",
                "points"=>[563,193,581,193,685,193,685,212,685,231,685,245],
                "text"=>"4"
            ),
            array(
                "from"=>-15,
                "to"=>-22,
                "fromPort"=>"right5",
                "toPort"=>"top0",
                "points"=>[563,215,573,215,625,215,625,223,625,231,625,245],
                "text"=>"3"
            ),
            array(
                "from"=>-30,
                "to"=>-15,
                "fromPort"=>"bottom0",
                "toPort"=>"bottom5",
                "points"=>[865,317,865,331,535,331,535,292,535,253,535,243],
                "text"=>"12"
            ),
            array(
                "from"=>-27,
                "to"=>-15,
                "fromPort"=>"bottom0",
                "toPort"=>"bottom4",
                "points"=>[925,338,925,352,513,352,513,306.5,513,261,513,243],
                "text"=>"14"
            )
        );
        return json_encode($data);
    }

    public function flowreport(){
        $lastupdate = DB::select('select lastupdate from int_report limit 1')[0];
        return view('report.flowreport',['lu'=>$lastupdate->lastupdate]);
    }

    public function tomsomget(){
        $data = DB::select('SELECT INSTALLEDPRODUCTID, TSQ_STATE, TSQ_DESC, DELIVER_STATE, DELIVER_DESC FROM tomsom;');

        $return = array();
        foreach ($data as $d){
            $return[$d->INSTALLEDPRODUCTID] = array(
                'TSQ_STATE'     => $d->TSQ_STATE,
                'TSQ_DESC'      => $d->TSQ_DESC,
                'DELIVER_STATE' => $d->DELIVER_STATE,
                'DELIVER_DESC'  => $d->DELIVER_DESC
            );
        }
        return json_encode($return);
    }

    public function getorderdetail($status,$milestone,$report,$state){
        $param = [$status,$milestone,$report,$state];
        if($state=='min'){
            $sql = "SELECT t1.order_num, t1.order_subtype, t1.row_id, t1.product, t1.int_note, t1.SEGMENT, t1.CC, t1.SID_NUM, t1.INT_ID, t2.fuby, t2.fus_note
                    FROM int_report t1 inner join int_report_notes t2 on t2.row_id = t1.ROW_ID
                    WHERE li_status='$status' and 
                    milestone='$milestone' and 
                    int_note='$report' and timestampdiff(HOUR,  str_to_date(created_at,'%d-%b-%Y %H:%i:%s'),now()) <= 24;";
        }
        else{
            $sql = "SELECT t1.order_num, t1.order_subtype, t1.row_id, t1.product, t1.int_note, t1.SEGMENT, t1.CC, t1.SID_NUM, t1.INT_ID, t2.fuby, t2.fus_note
                    FROM int_report t1 inner join int_report_notes t2 on t2.row_id = t1.ROW_ID
                    WHERE li_status='$status' and 
                    milestone='$milestone' and 
                    int_note='$report' and timestampdiff(HOUR,  str_to_date(created_at,'%d-%b-%Y %H:%i:%s'),now()) <= 24;";
        }

        $data = DB::select($sql);
        return view('report.orderdetail',['data'=>$data,'param'=>$param,'count'=>count($data)]);
    }

    public function getorderactiondetail(Request $request){
        $ordernum = $request->order;
        $rowid = $request->rowid;
        $data =  DB::select("select fuby,sby,fus_note from int_report_notes where row_id='$rowid';");
        if(!$data){
            $temp = array(
                'fuby'  => '',
                'sby'   => '',
                'note'  => ''
            );
            return json_encode($temp);
        }
        else{
            $temp = array(
                'fuby'  => $data[0]->fuby,
                'sby'   => $data[0]->sby,
                'note'  => $data[0]->fus_note
            );
            return json_encode($temp);
        }
    }

    public function storedetailaction(Request $request){
        $rowid  = $request->rowid;
        $fuby   = $request->fuby;
        $sby    = $request->sby;
        $note   = $request->note;
        $query = DB::insert("INSERT INTO int_report_notes (row_id,fuby,sby,fus_note) VALUES ('$rowid','$fuby','$sby','$note') ON DUPLICATE KEY UPDATE fuby=VALUES(fuby),sby=VALUES(sby),fus_note=VALUES(fus_note)");
        return $query ? json_encode(['status'=>1]) : json_encode(['status'=>1]);
    }

    public function billing(){
        $lastupdate = DB::select('select lastupdate from int_report limit 1')[0];
        $lastupdate = $lastupdate->lastupdate !=null ? $lastupdate->lastupdate : 'Unknown';
        return view('report.billing',['lastupdate'=>$lastupdate]);
    }

    public function quote(){
        $lastupdate = DB::select('select lastupdate from int_report limit 1')[0];
        $lastupdate = $lastupdate->lastupdate !=null ? $lastupdate->lastupdate : 'Unknown';
        return view('report.quote',['lastupdate'=>$lastupdate]);
    }

    public function download($status,$milestone,$report,$state){
        if($state=='min'){
            $sql = "SELECT t1.order_num, t1.order_subtype, t1.row_id, t1.product, t1.int_note, t1.SEGMENT, t1.CC, t1.SID_NUM, t1.INT_ID, t2.fuby, t2.fus_note
                    FROM int_report t1 inner join int_report_notes t2 on t2.row_id = t1.ROW_ID
                    WHERE li_status='$status' and 
                    milestone='$milestone' and 
                    int_note='$report' and timestampdiff(HOUR,  str_to_date(created_at,'%d-%b-%Y %H:%i:%s'),now()) <= 24;";
        }
        else{
            $sql = "SELECT t1.order_num, t1.order_subtype, t1.row_id, t1.product, t1.int_note, t1.SEGMENT, t1.CC, t1.SID_NUM, t1.INT_ID, t2.fuby, t2.fus_note
                    FROM int_report t1 inner join int_report_notes t2 on t2.row_id = t1.ROW_ID
                    WHERE li_status='$status' and 
                    milestone='$milestone' and 
                    int_note='$report' and timestampdiff(HOUR,  str_to_date(created_at,'%d-%b-%Y %H:%i:%s'),now()) <= 24;";
        }
        $data = DB::select($sql);
        $data = json_decode( json_encode($data), true);
        return Excel::create('line_item', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download('xlsx');
    }

}
