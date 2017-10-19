@extends('dashboard.app')
@section('title', 'Integrasi Report')
@section('content')
    <section class="content-header">
        <h1>All Report</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Report</li>
            <li class="active">Integration Report</li>
        </ol>
    </section>
    <section class="content">
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
                                    <td>{{$d->jan}}</td>
                                    <td>{{$d->feb}}</td>
                                    <td>{{$d->mar}}</td>
                                    <td>{{$d->apr}}</td>
                                    <td>{{$d->mei}}</td>
                                    <td>{{$d->jun}}</td>
                                    <td>{{$d->jul}}</td>
                                    <td>{{$d->agu}}</td>
                                    <td>{{$d->sep}}</td>
                                    <td>{{$d->okt}}</td>
                                    <td>{{$d->nov}}</td>
                                    <td>{{$d->des}}</td>
                                    <td>{{$d->jan+$d->feb+$d->mar+$d->apr+$d->mei+$d->jun+$d->jul+$d->agu+$d->sep+$d->okt+$d->nov+$d->des}}</td>
                                </tr>
                            @endforeach
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
