<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class ReportController extends Controller
{
    public function allreport(){
        $pivot = DB::select('select moli_status, moli_milestone, 
                                count(case when ORDER_SUBTYPE=\'disconnect\' then 1 end) do,
                                count(case when ORDER_SUBTYPE=\'modify\' then 1 end) mo,
                                count(case when ORDER_SUBTYPE=\'new install\' then 1 end) ao,
                                count(case when ORDER_SUBTYPE=\'resume\' then 1 end) ro,
                                count(case when ORDER_SUBTYPE=\'suspend\' then 1 end) so
                            from crm_dashboard.oraexcel pt group by moli_milestone,moli_status');
        $data = array();
        foreach ($pivot as $d){
            $data[0] = ($d->moli_status=='Pending' and $d->moli_milestone='None') ? $d : null;
            $data[1] = ($d->moli_status=='Submitted' and $d->moli_milestone='None') ? $d : null;
            $data[2] = ($d->moli_status=='In Progress' and $d->moli_milestone='None') ? $d : null;
            $data[3] = ($d->moli_status=='In Progress' and $d->moli_milestone='SYNC CUSTOMER START') ? $d : null;
            $data[4] = ($d->moli_status=='In Progress' and $d->moli_milestone='SYNC CUSTOMER COMPLETE') ? $d : null;
            $data[5] = ($d->moli_status=='In Progress' and $d->moli_milestone='PROVISION START') ? $d : null;
            $data[6] =($d->moli_status=='In Progress' and $d->moli_milestone='PROVISION ISSUED') ? $d : null;
            $data[7] =($d->moli_status=='Pending BASO' and $d->moli_milestone='PROVISION COMPLETE') ? $d : null;
            $data[8] =($d->moli_status=='Pending BASO' and $d->moli_milestone='BASO STARTED') ? $d : null;
            $data[9] =($d->moli_status=='Pending Billing Approval' and $d->moli_milestone='BILLING APPROVAL STARTED') ? $d : null;
            $data[10] =($d->moli_status=='Pending Billing Approval' and $d->moli_milestone='FULFILL BILLING START') ? $d : null;
            $data[11] =($d->moli_status=='Complete' and $d->moli_milestone='PROVISION COMPLETE') ? $d : null;
            $data[12] =($d->moli_status=='Complete' and $d->moli_milestone='FULFILL BILLING COMPLETE') ? $d : null;
            $data[13] =($d->moli_status=='Failed' and $d->moli_milestone='SYNC CUSTOMER START') ? $d : null;
            $data[14] =($d->moli_status=='Pending Cancel' and $d->moli_milestone='None') ? $d : null;
            $data[15] =($d->moli_status=='Pending Cancel' and $d->moli_milestone='SYNC CUSTOMER START') ? $d : null;
            $data[16] =($d->moli_status=='Pending Cancel' and $d->moli_milestone='SYNC CUSTOMER COMPLETE') ? $d : null;
            $data[17] =($d->moli_status=='Pending Cancel' and $d->moli_milestone='PROVISION START') ? $d : null;
            $data[18] =($d->moli_status=='Pending Cancel' and $d->moli_milestone='PROVISION COMPLETE') ? $d : null;
            $data[19] =($d->moli_status=='Cancelled' and $d->moli_milestone='None') ? $d : null;
            $data[20] =($d->moli_status=='Pending' and $d->moli_milestone='SYNC CUSTOMER COMPLETE') ? $d : null;
        }
        $status = [
            'Pending',
            'Submitted',
            'In Progress',
            '',
            '',
            '',
            '',
            'Pending BASO',
            '',
            'Pending Billing Approval',
            '',
            'Complete',
            '',
            'Failed',
            'Pending Cancel',
            '',
            '',
            '',
            '',
            'Cancelled',
            ''
        ];
        $milestone = [
            'NULL',
            'NULL',
            'NULL',
            'SYNC CUSTOMER START',
            'SYNC CUSTOMER COMPLETE',
            'PROVISION START',
            'PROVISION ISSUED',
            'PROVISION COMPLETE',
            'BASO STARTED',
            'BILLING APPROVAL STARTED',
            'FULFILL BILLING START',
            'PROVISION COMPLETE',
            'FULFILL BILLING COMPLETE',
            'SYNC CUSTOMER START',
            'NULL',
            'SYNC CUSTOMER START',
            'SYNC CUSTOMER COMPLETE',
            'PROVISION START',
            'PROVISION COMPLETE',
            'NULL',
            'SYNC CUSTOMER COMPLETE'
        ];
        return view('report.allreport',['data'=>$data,'status'=>$status,'milestone'=>$milestone]);
    }
}
