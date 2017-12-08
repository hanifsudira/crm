@extends('dashboard.app')
@section('title', 'Segments')
@section('content')
    <section class="content-header">
        <h1>Segments</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Oracle</li>
            <li class="active">Segements</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    {{--<div class="box-body">--}}
                    {{--<a href="{{ Route('ora.downloadexcelli') }}" class="btn btn-app" id="btn-upload"><i class="fa fa-cloud-upload"></i>Export Excel</a>--}}
                    {{--</div>--}}
                    <div class="box-body">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>AGREE_NUM</th>
                                <th>AGREE_NAME</th>
                                <th>REV</th>
                                <th>STATUS</th>
                                <th>TYPE</th>
                                <th>START_DATE</th>
                                <th>END_DATE</th>
                                <th>NUM_PARENT</th>
                                <th>REV_PARENT</th>
                                <th>SEGMEN</th>
                            </tr>
                            </thead>
                            <tfoot>
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
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('css')
    <style>
        tfoot input {
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            var table =  $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('report.getsegmentdata') }}',
                columns: [
                    { data: 'AGREE_NUM',name: 'AGREE_NUM'},
                    { data: 'AGREE_NAME',name: 'AGREE_NAME'},
                    { data: 'REV',name: 'REV'},
                    { data: 'STATUS',name: 'STATUS'},
                    { data: 'TYPE',name: 'TYPE'},
                    { data: 'START_DATE',name: 'START_DATE'},
                    { data: 'END_DATE',name: 'END_DATE'},
                    { data: 'NUM_PARENT',name: 'NUM_PARENT'},
                    { data: 'REV_PARENT',name: 'REV_PARENT'},
                    { data: 'SEGMEN',name: 'SEGMEN'}
                ]
            });
        });
    </script>
@endsection