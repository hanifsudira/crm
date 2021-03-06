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
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#data" data-toggle="tab">Data</a></li>
                        <li><a href="#error" data-toggle="tab">Error</a></li>
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
                                            <a href="{{ Route('ora.downloadexcelli') }}" class="btn btn-app" id="btn-upload"><i class="fa fa-cloud-upload"></i>Export Excel</a>
                                        </div>
                                        <div class="box-body">
                                            <table id="datatable" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>ORDER_NUM</th>
                                                    <th>ROW_ID</th>
                                                    <th>INT_ID</th>
                                                    <th>ORDER_SUBTYPE</th>
                                                    <th>REV</th>
                                                    <th>PRODUCT</th>
                                                    <th>OH_STATUS</th>
                                                    <th>LI_STATUS</th>
                                                    <th>MILESTONE</th>
                                                    <th>CREATED_AT</th>
                                                    <th>FULFILL_STATUS</th>
                                                    <th>ACC_NAS</th>
                                                    <th>NIPNAS</th>
                                                    <th>SID_NUM</th>
                                                    <th>OH_SEQ</th>
                                                    <th>MSTONE_SEQ</th>
                                                    <th>LI_STATUS_INT</th>
                                                    <th>MILE_STATUS_INT</th>
                                                    <th>INT_NOTE</th>
                                                    <th>SEGMENT</th>
                                                    <th>TSQ_STATE</th>
                                                    <th>TSQ_DESC</th>
                                                    <th>DELIVER_STATE</th>
                                                    <th>DELIVER_DESC</th>
                                                    <th>AGREE_NUM</th>
                                                    <th>AGREE_REV</th>
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
                        <!-- Error Data -->
                        <div class="tab-pane" id="error">
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
                                            <table id="datatable2" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>ORDER_NUM</th>
                                                    <th>ROW_ID</th>
                                                    <th>INT_ID</th>
                                                    <th>ORDER_SUBTYPE</th>
                                                    <th>REV</th>
                                                    <th>PRODUCT</th>
                                                    <th>OH_STATUS</th>
                                                    <th>LI_STATUS</th>
                                                    <th>MILESTONE</th>
                                                    <th>CREATED_AT</th>
                                                    <th>FULFILL_STATUS</th>
                                                    <th>ACC_NAS</th>
                                                    <th>NIPNAS</th>
                                                    <th>SID_NUM</th>
                                                    <th>OH_SEQ</th>
                                                    <th>MSTONE_SEQ</th>
                                                    <th>LI_STATUS_INT</th>
                                                    <th>MILE_STATUS_INT</th>
                                                    <th>INT_NOTE</th>
                                                    <th>SEGMENT</th>
                                                    <th>TSQ_STATE</th>
                                                    <th>TSQ_DESC</th>
                                                    <th>DELIVER_STATE</th>
                                                    <th>DELIVER_DESC</th>
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
                                        <h1 class="box-title">Last Update : <a>{{$luli}}</a></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box">
                                        <div class="box-body">
                                            <table id="summarytable" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>OH_STATUS</th>
                                                    <th>LI_STATUS</th>
                                                    <th>MILESTONE</th>
                                                    <th>JUMLAH</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($lisummary as $d)
                                                    <tr>
                                                        <td>{{$d->OH_STATUS}}</td>
                                                        <td>{{$d->LI_STATUS}}</td>
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
                ajax: '{{ route('ora.getlireport') }}',
                columns: [
                    { data: 'ORDER_NUM',name: 'ORDER_NUM'},
                    { data: 'ROW_ID',name: 'ROW_ID'},
                    { data: 'INT_ID',name: 'INT_ID'},
                    { data: 'ORDER_SUBTYPE',name: 'ORDER_SUBTYPE'},
                    { data: 'REV',name: 'REV'},
                    { data: 'PRODUCT',name: 'PRODUCT'},
                    { data: 'OH_STATUS',name: 'OH_STATUS'},
                    { data: 'LI_STATUS',name: 'LI_STATUS'},
                    { data: 'MILESTONE',name: 'MILESTONE'},
                    { data: 'CREATED_AT',name: 'CREATED_AT'},
                    { data: 'FULFILL_STATUS',name: 'FULFILL_STATUS'},
                    { data: 'ACC_NAS',name: 'ACC_NAS'},
                    { data: 'NIPNAS',name: 'NIPNAS'},
                    { data: 'SID_NUM',name: 'SID_NUM'},
                    { data: 'OH_SEQ',name: 'OH_SEQ'},
                    { data: 'MSTONE_SEQ',name: 'MSTONE_SEQ'},
                    { data: 'LI_STATUS_INT',name: 'LI_STATUS_INT'},
                    { data: 'MILE_STATUS_INT',name: 'MILE_STATUS_INT'},
                    { data: 'INT_NOTE',name: 'INT_NOTE'},
                    { data: 'SEGMENT',name: 'SEGMENT'},
                    { data: 'TSQ_STATE',name: 'TSQ_STATE'},
                    { data: 'TSQ_DESC',name: 'TSQ_DESC'},
                    { data: 'DELIVER_STATE',name: 'DELIVER_STATE'},
                    { data: 'DELIVER_DESC',name: 'DELIVER_DESC'},
                    { data: 'AGREE_NUM',name: 'AGREE_NUM'},
                    { data: 'AGREE_REV',name: 'AGREE_REV'}
                ],initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        var input = document.createElement("input");
                        $(input).appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? val : '', true, false).draw();
                            });
                    });
                }
            });
            var table2 =  $('#datatable2').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('ora.errorlineitem') }}',
                columns: [
                    { data: 'ORDER_NUM',name: 'ORDER_NUM'},
                    { data: 'ROW_ID',name: 'ROW_ID'},
                    { data: 'INT_ID',name: 'INT_ID'},
                    { data: 'ORDER_SUBTYPE',name: 'ORDER_SUBTYPE'},
                    { data: 'REV',name: 'REV'},
                    { data: 'PRODUCT',name: 'PRODUCT'},
                    { data: 'OH_STATUS',name: 'OH_STATUS'},
                    { data: 'LI_STATUS',name: 'LI_STATUS'},
                    { data: 'MILESTONE',name: 'MILESTONE'},
                    { data: 'CREATED_AT',name: 'CREATED_AT'},
                    { data: 'FULFILL_STATUS',name: 'FULFILL_STATUS'},
                    { data: 'ACC_NAS',name: 'ACC_NAS'},
                    { data: 'NIPNAS',name: 'NIPNAS'},
                    { data: 'SID_NUM',name: 'SID_NUM'},
                    { data: 'OH_SEQ',name: 'OH_SEQ'},
                    { data: 'MSTONE_SEQ',name: 'MSTONE_SEQ'},
                    { data: 'LI_STATUS_INT',name: 'LI_STATUS_INT'},
                    { data: 'MILE_STATUS_INT',name: 'MILE_STATUS_INT'},
                    { data: 'INT_NOTE',name: 'INT_NOTE'},
                    { data: 'SEGMENT',name: 'SEGMENT'}
                ]
            });
        });
    </script>
@endsection