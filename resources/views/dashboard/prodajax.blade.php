<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
                <h1>Result</h1>
                <table id="datatable" class="table table-bordered table-striped" style="overflow-x: scroll;">
                    <thead>
                    <tr>
                        <th>PRODUCT</th>
                        <th>STATUS</th>
                        <th>SERVICE_ID</th>
                        <th>BA</th>
                        <th>BP</th>
                        <th>START_DATE</th>
                        <th>END_DATE</th>
                        <th>BILL_START</th>
                        <th>AGREEMENT</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($data)
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
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>