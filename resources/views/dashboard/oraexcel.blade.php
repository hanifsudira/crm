@extends('dashboard.app')
@section('title', 'Oracle Query Data')
@section('content')
    <section class="content-header">
        <h1>Siebel Query Data</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Oracle</li>
            <li class="active">Data Table</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data</h3>
                    </div>
                    <div class="box-body">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ORDER_NUM</th>
                                <th>ORDER_SUBTYPE</th>
                                <th>OH_STATUS</th>
                                <th>MOLI_ROW_ID</th>
                                <th>MOLI_CREATED_DT</th>
                                <th>MOLI_LAST_UPDATED_DT</th>
                                <th>MOLI_PRODUCT_NAME</th>
                                <th>MOLI_STATUS</th>
                                <th>MOLI_FULFILLMENT_STATUS</th>
                                <th>MOLI_MILESTONE</th>
                                <th>MOLI_SERVICE_ID</th>
                                <th>MOLI_ASSET_INTEG_ID</th>
                                <th>MOLI_BILL_</th>
                                <th>MOLI_AGREE_NUM</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $(function() {
            var table =  $('#datatable').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('ora.oraexcelget') }}',
                columns: [
                    {
                        className       :'details-control',
                        orderable       : false,
                        searchable      : false,
                        data            : null,
                        defaultContent  : ''
                    },
                    { data: 'ORDER_NUM',name: 'ORDER_NUM'},
                    { data: 'ORDER_SUBTYPE',name: 'ORDER_SUBTYPE'},
                    { data: 'OH_STATUS',name: 'OH_STATUS'},
                    { data: 'MOLI_ROW_ID',name: 'MOLI_ROW_ID'},
                    { data: 'MOLI_CREATED_DT',name: 'MOLI_CREATED_DT'},
                    { data: 'MOLI_LAST_UPDATED_DT',name: 'MOLI_LAST_UPDATED_DT'},
                    { data: 'MOLI_PRODUCT_NAME',name: 'MOLI_PRODUCT_NAME'},
                    { data: 'MOLI_STATUS',name: 'MOLI_STATUS'},
                    { data: 'MOLI_FULFILLMENT_STATUS',name: 'MOLI_FULFILLMENT_STATUS'},
                    { data: 'MOLI_MILESTONE',name: 'MOLI_MILESTONE'},
                    { data: 'MOLI_SERVICE_ID',name: 'MOLI_SERVICE_ID'},
                    { data: 'MOLI_ASSET_INTEG_ID',name: 'MOLI_ASSET_INTEG_ID'},
                    { data: 'MOLI_BILL_',name: 'MOLI_BILL_'},
                    { data: 'MOLI_AGREE_NUM',name: 'MOLI_AGREE_NUM'},
                ]
            });
        });
    </script>
@endsection