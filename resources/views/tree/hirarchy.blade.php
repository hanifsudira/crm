@extends('dashboard.app')
@section('title', 'Tree View')
@section('content')
    <section class="content-header">
        <h1>Tree View</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Tree</li>
            <li class="active">Amandment Hirarchy</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="search-form">
                    <div class="input-group">
                        <input type="text" id="ordernum" name="search" class="form-control" placeholder="Search">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div id="hasil">
                            <h1>Result</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="loading-image" style="display: none"></div>
    </section>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#ordernum").on('keyup', function (e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                    var ordernum = $("#ordernum").val();
                    var url = '{{route("ora.gettreeview",":ordernum")}}';
                    url = url.replace(":ordernum",btoa(ordernum));
                    window.open(url, '_blank');
                }
            });
        });
    </script>
@endsection