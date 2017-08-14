@extends('dashboard.app')
@section('title', 'COM')
@section('content')
    <section class="content-header">
        <h1>COM</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Oracle</li>
            <li class="active">COM</li>
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
                                <th>ORDER_NUM</th>
                                <th>ORD_CREATION_DATE</th>
                                <th>ORD_COMPLETION_DATE</th>
                                <th>TASK_MNEMONIC</th>
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
                processing: true,
                serverSide: true,
                ajax: '{{ route('ora.getcom') }}',
                columns: [
                    { data: 'ID',name: 'ID'},
                    { data: 'ORD_CREATION_DATE',name: 'ORD_CREATION_DATE'},
                    { data: 'ORD_COMPLETION_DATE',name: 'ORD_COMPLETION_DATE'},
                    { data: 'TASK_MNEMONIC',name: 'TASK_MNEMONIC'},
                ]
            });
        });
    </script>
@endsection