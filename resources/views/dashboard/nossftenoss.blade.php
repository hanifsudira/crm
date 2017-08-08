@extends('dashboard.app')
@section('title', 'Nossf-Tenoss')
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
    <script type="text/javascript">
        $(document).ready(function() {
            var table =  $('#datatable').DataTable({
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: '{{ route('ora.getnossftenoss') }}',
                columns: [
                    { data: 'CRMORDERID',name: 'CRMORDERID'},
                    { data: 'INSTALLEDPRODUCTID',name: 'INSTALLEDPRODUCTID'},
                    { data: 'EXTERNALID',name: 'EXTERNALID'},
                    { data: 'PRODUCTNAME',name: 'PRODUCTNAME'},
                    { data: 'ORDERTYPE',name: 'ORDERTYPE'},
                    { data: 'TSQ_STATE',name: 'TSQ_STATE'},
                    { data: 'TSQ_DESC',name: 'TSQ_DESC'},
                    { data: 'DELIVER_STATE',name: 'DELIVER_STATE'},
                    { data: 'DELIVER_DESC',name: 'DELIVER_DESC'}
                ]
            });
        });
    </script>
@endsection