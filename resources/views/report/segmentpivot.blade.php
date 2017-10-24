@extends('dashboard.app')
@section('title', 'Segment Report')
@section('content')
    <section class="content-header">
        <h1>Monitoring Agreement</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Report</li>
            <li class="active">Monitoring Agreement</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box-header">
                    <h1 id="changetext" class="box-title">Tahun : <a>{{date('Y')}}</a></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <form role="form">
                            <div class="form-group">
                                <label>Pilih Tahun</label>
                                <select id="tahun" class="form-control">
                                    @foreach($year as $y)
                                        <option value="{{$y->tahun}}">{{$y->tahun}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div id="change">
                            <table id="datatable" class="table table-bordered table-striped" style="overflow-x: scroll;">
                                <thead>
                                <tr>
                                    <th rowspan="2">SEGMEN</th>
                                    <th colspan="13" style="text-align: center;">Jumlah ID-AGREE</th>
                                </tr>
                                <tr>
                                    <th>Januari</th>
                                    <th>Februari</th>
                                    <th>Maret</th>
                                    <th>April</th>
                                    <th>Mei</th>
                                    <th>Juni</th>
                                    <th>Juli</th>
                                    <th>Agustus</th>
                                    <th>September</th>
                                    <th>Oktober</th>
                                    <th>November</th>
                                    <th>Desember</th>
                                    <th>TOTAL</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $d)
                                    <tr>
                                        <td>{{$d->SEGMEN}}</td>
                                        <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'01',$nowyear,1])}}" target="_blank">{{$d->jan}}</a></td>
                                        <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'02',$nowyear,1])}}" target="_blank">{{$d->feb}}</a></td>
                                        <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'03',$nowyear,1])}}" target="_blank">{{$d->mar}}</a></td>
                                        <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'04',$nowyear,1])}}" target="_blank">{{$d->apr}}</a></td>
                                        <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'05',$nowyear,1])}}" target="_blank">{{$d->mei}}</a></td>
                                        <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'06',$nowyear,1])}}" target="_blank">{{$d->jun}}</a></td>
                                        <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'07',$nowyear,1])}}" target="_blank">{{$d->jul}}</a></td>
                                        <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'08',$nowyear,1])}}" target="_blank">{{$d->agu}}</a></td>
                                        <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'09',$nowyear,1])}}" target="_blank">{{$d->sep}}</a></td>
                                        <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'10',$nowyear,1])}}" target="_blank">{{$d->okt}}</a></td>
                                        <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'11',$nowyear,1])}}" target="_blank">{{$d->nov}}</a></td>
                                        <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'12',$nowyear,1])}}" target="_blank">{{$d->des}}</a></td>
                                        <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'00',$nowyear,3])}}" target="_blank">{{$d->jan+$d->feb+$d->mar+$d->apr+$d->mei+$d->jun+$d->jul+$d->agu+$d->sep+$d->okt+$d->nov+$d->des}}</a></td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'01','00',2])}}" target="_blank">{{$count[0]}}</a></td>
                                    <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'02','00',2])}}" target="_blank">{{$count[1]}}</a></td>
                                    <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'03','00',2])}}" target="_blank">{{$count[2]}}</a></td>
                                    <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'04','00',2])}}" target="_blank">{{$count[3]}}</a></td>
                                    <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'05','00',2])}}" target="_blank">{{$count[4]}}</a></td>
                                    <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'06','00',2])}}" target="_blank">{{$count[5]}}</a></td>
                                    <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'07','00',2])}}" target="_blank">{{$count[6]}}</a></td>
                                    <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'08','00',2])}}" target="_blank">{{$count[7]}}</a></td>
                                    <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'09','00',2])}}" target="_blank">{{$count[8]}}</a></td>
                                    <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'10','00',2])}}" target="_blank">{{$count[9]}}</a></td>
                                    <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'11','00',2])}}" target="_blank">{{$count[10]}}</a></td>
                                    <td align="right"><a href="{{route('report.segmentdetail',[$d->SEGMEN,'12','00',2])}}" target="_blank">{{$count[11]}}</a></td>
                                    <td align="right">{{$grandtotal}}</td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="loading-image" style="display: none"></div>
@endsection
@section('css')
    <style>
        a:link { color:black; }
        a:visited { color:black; }
        #loading-image{
            position:fixed;
            top:0px;
            right:0px;
            width:100%;
            height:100%;
            background-color:#666;
            background-image:url('{{ URL::asset('assets/img/loader.gif')}}');
            background-repeat:no-repeat;
            background-position:center;
            z-index:10000000;
            opacity: 0.4;
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('select#tahun').change(function(){
                var tahun = $('select#tahun').val();
                $("#changetext").text("Tahun : "+tahun);
                $('#loading-image').show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type    : 'GET',
                    url     : '{{ route('report.segmentpivotchange') }}',
                    data    : {tahun: tahun},
                    succes  : function () {
                        console.log('Sukses');
                    },
                    error   : function (xhr, status, error) {
                        console.log(xhr);
                        console.log(status);
                        console.log(error);
                    },
                    complete : function (result) {
                        $('#loading-image').hide();
                        console.log(result);
                        $('#change').html(result.responseText);
                    }
                });

            });
        });
    </script>
@endsection
