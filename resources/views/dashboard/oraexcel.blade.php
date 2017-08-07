@extends('dashboard.app')
@section('title', 'All Status')
@section('content')
    <section class="content-header">
        <h1>All Item</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Oracle</li>
            <li class="active">All Status</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#data" data-toggle="tab">Data</a></li>
                        <li><a href="#summary" data-toggle="tab">Summary</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- DATA -->
                        <div class="tab-pane active" id="data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-header">
                                        <h1 class="box-title">Last Update : <a>{{$lastupdate}}</a></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box">
                                        <div class="box-body">
                                            <a href="{{ Route('ora.downloadexcel') }}" class="btn btn-app" id="btn-upload"><i class="fa fa-cloud-upload"></i>Export Excel</a>
                                        </div>
                                        <div class="box-body">
                                            <table id="datatable" class="table table-bordered table-striped">
                                                <thead>
                                                {{--<tr>--}}
                                                    {{--<th>TOMSOM</th>--}}
                                                    {{--<th>ORDER_NUM</th>--}}
                                                    {{--<th>ORDER_SUBTYPE</th>--}}
                                                    {{--<th>OH_STATUS</th>--}}
                                                    {{--<th>MOLI_ROW_ID</th>--}}
                                                    {{--<th>MOLI_CREATED_DT</th>--}}
                                                    {{--<th>MOLI_LAST_UPDATED_DT</th>--}}
                                                    {{--<th>MOLI_PRODUCT_NAME</th>--}}
                                                    {{--<th>MOLI_STATUS</th>--}}
                                                    {{--<th>MOLI_FULFILLMENT_STATUS</th>--}}
                                                    {{--<th>MOLI_MILESTONE</th>--}}
                                                    {{--<th>MOLI_SERVICE_ID</th>--}}
                                                    {{--<th>MOLI_ASSET_INTEG_ID</th>--}}
                                                    {{--<th>MOLI_BILL_</th>--}}
                                                    {{--<th>MOLI_AGREE_NUM</th>--}}
                                                {{--</tr>--}}
                                                <tr>
                                                    <th>TOMSOM</th>
                                                    <th>ORDER_NUM</th>
                                                    <th>MOLI_ASSET_INTEG_ID</th>
                                                    <th>MOLI_PRODUCT_NAME</th>
                                                    <th>ORDER_SUBTYPE</th>
                                                    <th>OH_STATUS</th>
                                                    <th>MOLI_STATUS</th>
                                                    <th>MOLI_FULFILLMENT_STATUS</th>
                                                    <th>MOLI_MILESTONE</th>
                                                    <th>MOLI_CREATED_DT</th>
                                                    <th>MOLI_LAST_UPDATED_DT</th>
                                                    <th>MOLI_ROW_ID</th>
                                                    <th>MOLI_SERVICE_ID</th>
                                                    <th>MOLI_AGREE_NUM</th>
                                                    <th>MOLI_BILL_</th>
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
                        </div>
                        <!-- SUMMARY -->
                        <div class="tab-pane" id="summary">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-header">
                                        <h1 class="box-title">Last Update : <a>{{$lastupdate}}</a></h1>
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
                                                    <th>STATUS_ORDER</th>
                                                    <th>STATUS_FULFILLMENT</th>
                                                    <th>MILESTONE</th>
                                                    <th>JUMLAH</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data as $d)
                                                    <tr>
                                                        <td>{{$d->STATUS_ORDER}}</td>
                                                        <td>{{$d->STATUS_FULFILLMENT}}</td>
                                                        <td>{{$d->MILESTONE}}</td>
                                                        <td>{{$d->JUMLAH}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('ora.oraexcelget') }}',
                columns: [
                    { data: 'action', name: 'action', orderable: false, searchable: false},
                    { data: 'ORDER_NUM',name: 'ORDER_NUM'},
                    { data: 'MOLI_ASSET_INTEG_ID',name: 'MOLI_ASSET_INTEG_ID'},
                    { data: 'MOLI_PRODUCT_NAME',name: 'MOLI_PRODUCT_NAME'},
                    { data: 'ORDER_SUBTYPE',name: 'ORDER_SUBTYPE'},
                    { data: 'OH_STATUS',name: 'OH_STATUS'},
                    { data: 'MOLI_STATUS',name: 'MOLI_STATUS'},
                    { data: 'MOLI_FULFILLMENT_STATUS',name: 'MOLI_FULFILLMENT_STATUS'},
                    { data: 'MOLI_MILESTONE',name: 'MOLI_MILESTONE'},
                    { data: 'MOLI_CREATED_DT',name: 'MOLI_CREATED_DT'},
                    { data: 'MOLI_LAST_UPDATED_DT',name: 'MOLI_LAST_UPDATED_DT'},
                    { data: 'MOLI_ROW_ID',name: 'MOLI_ROW_ID'},
                    { data: 'MOLI_SERVICE_ID',name: 'MOLI_SERVICE_ID'},
                    { data: 'MOLI_AGREE_NUM',name: 'MOLI_AGREE_NUM'},
                    { data: 'MOLI_BILL_',name: 'MOLI_BILL_'}
                ],
                initComplete: function () {
                    this.api().columns([3,5,6,7,8]).every(function () {
                        var column = this;
                        var input = document.createElement("input");
                        $(input).appendTo($(column.footer()).empty())
                            .on('change', function () {
                                column.search($(this).val(), false, false, true).draw();
                            });
                    });
                }
            });
        });
    </script>
@endsection