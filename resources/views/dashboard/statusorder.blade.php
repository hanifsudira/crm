@extends('dashboard.app')
@section('title', 'Line Item')
@section('content')
    <section class="content-header">
        <h1>Line Items</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Oracle</li>
            <li class="active">Status Order</li>
        </ol>
    </section>
    <section class="content">
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
                                <th>ORDER_SUBTYPE</th>
                                <th>REV</th>
                                <th>PRODUCT</th>
                                <th>LI_STATUS</th>
                                <th>MILESTONE</th>
                                <th>CREATED_AT</th>
                                <th>ACC_NAS</th>
                                <th>NIPNAS</th>
                                <th>SID_NUM</th>
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
    </section>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            var table =  $('#datatable').DataTable({
                scrollX: true,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('ora.getlireport') }}',
                columns: [
                    { data: 'ORDER_NUM',name: 'ORDER_NUM'},
                    { data: 'ROW_ID',name: 'ROW_ID'},
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
                    { data: 'MILE_STATUS_INT',name: 'MILE_STATUS_INT'}
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

        });
    </script>
@endsection