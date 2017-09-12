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
        <div class="lockscreen-wrapper">
            <div class="lockscreen-logo">
                <a href="../../index2.html"><b>Admin</b>LTE</a>
            </div>
            <div class="lockscreen-name">John Doe</div>

            <!-- START LOCK SCREEN ITEM -->
            <div class="lockscreen-item">
                <!-- lockscreen image -->
                <div class="lockscreen-image">
                    <img src="../../dist/img/user1-128x128.jpg" alt="User Image">
                </div>
                <!-- /.lockscreen-image -->

                <!-- lockscreen credentials (contains the form) -->
                <form class="lockscreen-credentials">
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="password">

                        <div class="input-group-btn">
                            <button type="button" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                        </div>
                    </div>
                </form>
                <!-- /.lockscreen credentials -->

            </div>
            <!-- /.lockscreen-item -->
            <div class="help-block text-center">
                Enter your password to retrieve your session
            </div>
            <div class="text-center">
                <a href="login.html">Or sign in as a different user</a>
            </div>
            <div class="lockscreen-footer text-center">
                Copyright &copy; 2014-2016 <b><a href="http://almsaeedstudio.com" class="text-black">Almsaeed Studio</a></b><br>
                All rights reserved
            </div>
        </div>
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