@extends('dashboard.app')
@section('title', 'Data Migrasi')
@section('content')
    <section class="content-header">
        <h1>CRM Complaint Report Dashboard<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>CRM</li>
            <li class="active">Data Table</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Migrasi</h3>
                    </div>
                    <div class="box-body">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Sumber</th>
                                <th>Onsite Support</th>
                                <th>Kategori</th>
                                <th>Status Follow Up</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('css')
    <style>
        td.details-control {
            background: url('{{ URL::asset('assets/img/details_open.png')}}') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('{{ URL::asset('assets/img/details_close.png')}}') no-repeat center center;
        }
    </style>
@endsection
@section('js')
    <script>
        function format ( d ) {
            // `d` is the original data object for the row
            return '<table class="table">'+
                '<tr>'+
                '<td>Nama User</td>'+
                '<td>'+d.nama_user+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>NIK User</td>'+
                '<td>'+d.nik_user+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td>User Login</td>'+
                '<td>'+d.user_login+'</td>'+
                '</tr>'+
                '<td>Divisi</td>'+
                '<td>'+d.divisi+'</td>'+
                '</tr>'+
                '<td>No Telp</td>'+
                '<td>'+d.no_telp+'</td>'+
                '</tr>'+
                '<td>No Quote</td>'+
                '<td>'+d.no_quote+'</td>'+
                '</tr>'+
                '<td>No Order</td>'+
                '<td>'+d.no_order+'</td>'+
                '</tr>'+
                '<td>Deskripsi Komplain</td>'+
                '<td>'+d.deskripsi_komplain+'</td>'+
                '</tr>'+
                '<td>Assignee</td>'+
                '<td>'+d.assignee+'</td>'+
                '</tr>'+
                '<td>Solusi</td>'+
                '<td>'+d.solusi+'</td>'+
                '</tr>'+
                '</table>';
        }
        $(function() {
            var table =  $('#datatable').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('home.getall') }}',
                columns: [
                    {
                        className       :'details-control',
                        orderable       : false,
                        searchable      : false,
                        data            : null,
                        defaultContent  : ''
                    },
                    { data: 'id',name: 'id'},
                    { data: 'date',name: 'date'},
                    { data: 'sumber',name: 'sumber'},
                    { data: 'onsite_support',name: 'onsite_support'},
                    { data: 'kategori',name: 'kategori'},
                    { data: 'status',name: 'status'},
                ]
            });
            $('#datatable tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );
                if ( row.child.isShown() ) {
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );
        });
    </script>
@endsection