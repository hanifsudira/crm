@extends('dashboard.app')
@section('title', 'All Report')
@section('content')
    <section class="content-header">
        <h1>All Report</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Report</li>
            <li class="active">All Report</li>
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
                                    <th>Status</th>
                                    <th>Milestone</th>
                                    <th>DO</th>
                                    <th>MO</th>
                                    <th>AO</th>
                                    <th>RO</th>
                                    <th>SO</th>
                                    <th>DB CRM</th>
                                    <th>Integrasi</th>
                                    <th>DB/Total</th>
                                    <th>Int/Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--@for($i=0;$i<21;$i++)--}}
                                    {{--<tr>--}}
                                        {{--@if($i-1>-1 and $status[$i]==$status[$i-1])--}}
                                            {{--<td></td>--}}
                                        {{--@else($i)--}}
                                            {{--<td>{{$status[$i]}}</td>--}}
                                        {{--@endif--}}

                                        {{--<td>{{$milestone[$i]}}</td>--}}
                                        {{--@php--}}
                                            {{--$temp = null;--}}
                                            {{--foreach ($data as $pivot){--}}
                                                {{--if($pivot->moli_status==$status[$i] and $pivot->moli_milestone==$milestone[$i]){--}}
                                                    {{--$temp = $pivot;--}}
                                                    {{--break;--}}
                                                {{--}--}}
                                            {{--}--}}
                                        {{--@endphp--}}
                                        {{--@if($temp)--}}
                                            {{--<td>{{$pivot->do}}</td>--}}
                                            {{--<td>{{$pivot->mo}}</td>--}}
                                            {{--<td>{{$pivot->ao}}</td>--}}
                                            {{--<td>{{$pivot->ro}}</td>--}}
                                            {{--<td>{{$pivot->so}}</td>--}}
                                            {{--<td></td>--}}
                                            {{--<td></td>--}}
                                            {{--<td></td>--}}
                                            {{--<td></td>--}}
                                        {{--@else--}}
                                            {{--<td>0</td>--}}
                                            {{--<td>0</td>--}}
                                            {{--<td>0</td>--}}
                                            {{--<td>0</td>--}}
                                            {{--<td>0</td>--}}
                                            {{--<td></td>--}}
                                            {{--<td></td>--}}
                                            {{--<td></td>--}}
                                            {{--<td></td>--}}
                                        {{--@endif--}}
                                    {{--</tr>--}}
                                {{--@endfor--}}
                                @for($i=0;$i<count($data);$i++)
                                    <tr>
                                        @if($i-1>-1 and $data[$i]->moli_status==$data[$i-1]->moli_status)
                                            <td></td>
                                        @else($i)
                                            <td>{{$data[$i]->moli_status}}</td>
                                        @endif
                                            <td>{{$data[$i]->moli_milestone}}</td>
                                            <td>{{$data[$i]->do}}</td>
                                            <td>{{$data[$i]->mo}}</td>
                                            <td>{{$data[$i]->ao}}</td>
                                            <td>{{$data[$i]->ro}}</td>
                                            <td>{{$data[$i]->so}}</td>
                                            <td>{{$ver[$i]}}</td>
                                            <td></td>
                                            <td>{{number_format($ver[$i]/($hor[0]+$hor[1]+$hor[2]+$hor[3]+$hor[4]),2).'%'}}</td>
                                            <td></td>
                                    </tr>
                                @endfor
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>{{$hor[0]}}</td>
                                    <td>{{$hor[1]}}</td>
                                    <td>{{$hor[2]}}</td>
                                    <td>{{$hor[3]}}</td>
                                    <td>{{$hor[4]}}</td>
                                    <td>{{$hor[0]+$hor[1]+$hor[2]+$hor[3]+$hor[4]}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection