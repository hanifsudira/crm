<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
                <h1>Result</h1>
                <div style="overflow-x:auto;">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ORDER_NUM</th>
                            <th>ROW_ID</th>
                            <th>INT_ID</th>
                            <th>ORDER_SUBTYPE</th>
                            <th>REV</th>
                            <th>PRODUCT</th>
                            <th>OH_STATUS</th>
                            <th>LI_STATUS</th>
                            <th>MILESTONE</th>
                            <th>CREATED_AT</th>
                            <th>FULFILL_STATUS</th>
                            <th>ACC_NAS</th>
                            <th>NIPNAS</th>
                            <th>SID_NUM</th>
                            <th>LI_STATUS_INT</th>
                            <th>MILE_STATUS_INT</th>
                            <th>INT_NOTE</th>
                            <th>Catatan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($data)
                            @foreach($data as $d)
                                <tr>
                                    <td>{{$d['ORDER_NUM']}}</td>
                                    <td>{{$d['ROW_ID']}}</td>
                                    <td>{{$d['INT_ID']}}</td>
                                    <td>{{$d['ORDER_SUBTYPE']}}</td>
                                    <td>{{$d['REV']}}</td>
                                    <td>{{$d['PRODUCT']}}</td>
                                    <td>{{$d['OH_STATUS']}}</td>
                                    <td>{{$d['LI_STATUS']}}</td>
                                    <td>{{$d['MILESTONE']}}</td>
                                    <td>{{$d['CREATED_AT']}}</td>
                                    <td>{{$d['FULFILL_STATUS']}}</td>
                                    <td>{{$d['ACC_NAS']}}</td>
                                    <td>{{$d['NIPNAS']}}</td>
                                    <td>{{$d['SID_NUM']}}</td>
                                    <td>{{$d['LI_STATUS_INT']}}</td>
                                    <td>{{$d['MILE_STATUS_INT']}}</td>
                                    <td>{{$d['INT_NOTE']}}</td>
                                    @if($d['INT_NOTE']=='ERROR TSQ' or $d['INT_NOTE']=='ERROR DELIVER' )
                                        <td>Hubungi Tim OSS dan CRM</td>
                                    @elseif($d['INT_NOTE']=='Error Sync Customer')
                                        <td>Hubungi Tim Integrasi dan CRM</td>
                                    @elseif($d['ORDER_SUBTYPE']!='New Install' and $d['SID_NUM']=='None')
                                        <td>SID Kosong. Hubungi Tim CRM</td>
                                    @elseif($d['LI_STATUS']=='Complete')
                                        <td>Complete Gan</td>
                                    @elseif($d['OH_STATUS']=='Pending')
                                        <td>Klik Submit Dulu Gan</td>
                                    @elseif($d['MILESTONE']!=$d['MILE_STATUS_INT'])
                                        <td>Status Tidak Update, Hubungi Tim CRM dan Integrasi</td>
                                    @else
                                        <td>In Progress. Semoga Lancar</td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>