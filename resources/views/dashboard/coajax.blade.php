<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
                <h1>Result</h1>
                <table id="datatable" class="table table-bordered table-striped" style="overflow-x: scroll;">
                    <thead>
                    <tr>
                        <th>ORDER#</th>
                        <th>REV</th>
                        <th>PRODUCT</th>
                        <th>OH_STATUS</th>
                        <th>LI_STATUS</th>
                        <th>MILESTONE</th>
                        <th>ORDER_SUBTYPE</th>
                        <th>CREATED_AT</th>
                        <th>ACC_NAS</th>
                        <th>NIPNAS</th>
                        <th>WORK_PHONE</th>
                        <th>LATITUDE</th>
                        <th>LONGITUDE</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>{{$d[0]}}</td>
                            <td>{{$d[1]}}</td>
                            <td>{{$d[2]}}</td>
                            <td>{{$d[3]}}</td>
                            <td>{{$d[4]}}</td>
                            <td>{{$d[5]}}</td>
                            <td>{{$d[6]}}</td>
                            <td>{{$d[7]}}</td>
                            <td>{{$d[8]}}</td>
                            <td>{{$d[9]}}</td>
                            <td>{{$d[10]}}</td>
                            <td>{{$d[11]}}</td>
                            <td>{{$d[12]}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>