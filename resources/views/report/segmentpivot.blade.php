@extends('dashboard.app')
@section('title', 'Integrasi Report')
@section('content')
    <section class="content-header">
        <h1>Segment Pivot</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Report</li>
            <li class="active">Segment Pivot Report</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box-header">
                    <h1 class="box-title">Tahun : <a>{{date('Y')}}</a></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
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
                                    <td align="right">{{$d->jan}}</td>
                                    <td align="right">{{$d->feb}}</td>
                                    <td align="right">{{$d->mar}}</td>
                                    <td align="right">{{$d->apr}}</td>
                                    <td align="right">{{$d->mei}}</td>
                                    <td align="right">{{$d->jun}}</td>
                                    <td align="right">{{$d->jul}}</td>
                                    <td align="right">{{$d->agu}}</td>
                                    <td align="right">{{$d->sep}}</td>
                                    <td align="right">{{$d->okt}}</td>
                                    <td align="right">{{$d->nov}}</td>
                                    <td align="right">{{$d->des}}</td>
                                    <td align="right">{{$d->jan+$d->feb+$d->mar+$d->apr+$d->mei+$d->jun+$d->jul+$d->agu+$d->sep+$d->okt+$d->nov+$d->des}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td align="right">{{$count[0]}}</td>
                                <td align="right">{{$count[1]}}</td>
                                <td align="right">{{$count[2]}}</td>
                                <td align="right">{{$count[3]}}</td>
                                <td align="right">{{$count[4]}}</td>
                                <td align="right">{{$count[5]}}</td>
                                <td align="right">{{$count[6]}}</td>
                                <td align="right">{{$count[7]}}</td>
                                <td align="right">{{$count[8]}}</td>
                                <td align="right">{{$count[9]}}</td>
                                <td align="right">{{$count[10]}}</td>
                                <td align="right">{{$count[11]}}</td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('css')
    <style>
        a:link { color:black; }
        a:visited { color:black; }
    </style>
@endsection
