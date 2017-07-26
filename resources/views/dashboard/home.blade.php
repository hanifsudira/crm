@extends('dashboard.app')
@section('title', 'Home')
@section('content')
    <section class="content-header">
        <h1>CRM Complaint Report Dashboard<small></small></h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>CRM</li>
            <li class="active">Chart</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Count By Date</h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="ctxdate" style="height:230px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Status Follow Up</h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="ctxstatus" style="height:230px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Count By Source</h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="ctxsumber" style="height:230px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Count By Category</h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="ctxkategori" style="height:230px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $(function(){
            $.getJSON("{{ route('home.getbydate') }}", function (result) {
                var labels = [],data=[];
                for (var i = 0; i < result.length; i++) {
                    labels.push(result[i].date);
                    data.push(result[i].count);
                }
                var datas = {
                    labels : labels,
                    datasets : [
                        {
                            label   : "Count By Date",
                            backgroundColor: [
                                "#2ecc71",
                                "#3498db",
                                "#95a5a6",
                                "#9b59b6",
                                "#f1c40f",
                                "#e74c3c",
                                "#34495e"
                            ],
                            data    : data
                        }
                    ]

                };
                var ctxdate = document.getElementById("ctxdate");
                var myBarChart = new Chart(ctxdate, {
                    type: 'bar',
                    data: datas,
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            });

            $.getJSON("{{ route('home.getbystatus') }}", function (result) {
                var labels = [],data=[];
                for (var i = 0; i < result.length; i++) {
                    labels.push(result[i].status);
                    data.push(result[i].count);
                }
                var datas = {
                    labels : labels,
                    datasets : [
                        {
                            label   : "Count By Status",
                            backgroundColor: [
                                "#2ecc71",
                                "#3498db",
                                "#95a5a6",
                                "#9b59b6",
                                "#f1c40f",
                                "#e74c3c",
                                "#34495e"
                            ],
                            data    : data
                        }
                    ]

                };
                var ctxdate = document.getElementById("ctxstatus");
                var myBarChart = new Chart(ctxdate, {
                    type: 'bar',
                    data: datas,
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            });

            $.getJSON("{{ route('home.getbysumber') }}", function (result) {
                var labels = [],data=[];
                for (var i = 0; i < result.length; i++) {
                    labels.push(result[i].sumber);
                    data.push(result[i].count);
                }
                var datas = {
                    labels : labels,
                    datasets : [
                        {
                            label   : "Count By Status",
                            backgroundColor: [
                                "#2ecc71",
                                "#3498db",
                                "#95a5a6",
                                "#9b59b6",
                                "#f1c40f",
                                "#e74c3c",
                                "#34495e"
                            ],
                            data    : data
                        }
                    ]

                };
                var ctxdate = document.getElementById("ctxsumber");
                var myBarChart = new Chart(ctxdate, {
                    type: 'pie',
                    data: datas,
                });
            });

            $.getJSON("{{ route('home.getbykategori') }}", function (result) {
                var labels = [],data=[];
                for (var i = 0; i < result.length; i++) {
                    var temp = result[i].kategori == '' ? '-' : result[i].kategori  ;
                    labels.push(temp);
                    data.push(result[i].count);
                }
                var datas = {
                    labels : labels,
                    datasets : [
                        {
                            label   : "Count By Status",
                            backgroundColor: [
                                "#2ecc71",
                                "#3498db",
                                "#95a5a6",
                                "#9b59b6",
                                "#f1c40f",
                                "#e74c3c",
                                "#34495e"
                            ],
                            data    : data
                        }
                    ]

                };
                var ctxdate = document.getElementById("ctxkategori");
                var myBarChart = new Chart(ctxdate, {
                    type: 'pie',
                    data: datas,
                });
            });
        });
    </script>
@endsection