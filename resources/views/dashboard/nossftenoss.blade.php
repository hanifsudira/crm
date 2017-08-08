@extends('dashboard.app')
@section('title', 'Line Item')
@section('content')
    <section class="content-header">
        <h1>Line Items</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Oracle</li>
            <li class="active">Line Items</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <h1>Result</h1>
                        <table id="datatable" class="table table-bordered table-striped" style="overflow-x: scroll;">
                            <thead>
                            <tr>
                                <th>CRMORDERID</th>
                                <th>INSTALLEDPRODUCTID</th>
                                <th>EXTERNALID</th>
                                <th>PRODUCTNAME</th>
                                <th>ORDERTYPE</th>
                                <th>TSQ_STATE</th>
                                <th>TSQ_DESC</th>
                                <th>DELIVER_STATE</th>
                                <th>DELIVER_DESC</th>
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
    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function() {--}}
            {{--var table =  $('#datatable').DataTable({--}}
                {{--scrollX: true,--}}
                {{--processing: true,--}}
                {{--serverSide: true,--}}
                {{--ajax: '{{ route('ora.getlireport') }}',--}}
                {{--columns: [--}}
                    {{--{ data: 'ORDER_NUM',name: 'ORDER_NUM'},--}}
                    {{--{ data: 'REV',name: 'REV'},--}}
                    {{--{ data: 'PRODUCT',name: 'PRODUCT'},--}}
                    {{--{ data: 'OH_STATUS',name: 'OH_STATUS'},--}}
                    {{--{ data: 'LI_STATUS',name: 'LI_STATUS'},--}}
                    {{--{ data: 'MILESTONE',name: 'MILESTONE'},--}}
                    {{--{ data: 'ORDER_SUBTYPE',name: 'ORDER_SUBTYPE'},--}}
                    {{--{ data: 'CREATED_AT',name: 'CREATED_AT'},--}}
                    {{--{ data: 'FULFILL_STATUS',name: 'FULFILL_STATUS'},--}}
                    {{--{ data: 'ACC_NAS',name: 'ACC_NAS'},--}}
                    {{--{ data: 'NIPNAS',name: 'NIPNAS'},--}}
                    {{--{ data: 'SID_NUM',name: 'SID_NUM'}--}}
                {{--]--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
@endsection