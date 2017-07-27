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

	var bccolor =
	[
	"rgba(255, 99, 132, 0.2)",
	"rgba(255, 159, 64, 0.2)",
	"rgba(255, 205, 86, 0.2)",
	"rgba(75, 192, 192, 0.2)",
	"rgba(54, 162, 235, 0.2)",
	"rgba(153, 102, 255, 0.2)",
	"rgba(201, 203, 207, 0.2)"
	];
	var bdcolor =
	[
	"rgb(255, 99, 132)",
	"rgb(255, 159, 64)",
	"rgb(255, 205, 86)",
	"rgb(75, 192, 192)",
	"rgb(54, 162, 235)",
	"rgb(153, 102, 255)",
	"rgb(201, 203, 207)"
	];
	$(function(){
		$.getJSON("{{ route('home.getbydate') }}", function (result) {
			var labels = [],data=[];
			for (var i = 0; i < result.length; i++) {
				labels.push(result[i].date);
				data.push(result[i].count);
			}
			var data = {
				labels : labels,
				datasets : [
				{
					label   : "Count By Date",
					borderWidth : 1,
					backgroundColor: bccolor,
					borderColor : bdcolor,
					data    : data
				}
				]
			};
			var ctxdate = document.getElementById("ctxdate");
			var myBarChart = new Chart(ctxdate, {
				
				type: 'bar',
				data: data,
				options: {
					animation: {
						duration: 500,
						onComplete: function() {
							var ctx = this.chart.ctx;
							ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
							ctx.fillStyle = "black";
							ctx.textAlign = 'center';
							ctx.textBaseline = 'bottom';

							this.data.datasets.forEach(function(dataset) {
								for (var i = 0; i < dataset.data.length; i++) {
									for (var key in dataset._meta) {
										var model = dataset._meta[key].data[i]._model;
										ctx.fillText(dataset.data[i], model.x, model.y - 5);
									}
								}
							});
						}
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
			var data = {
				labels : labels,
				datasets : [
				{
					label   : "Count By Status",
					borderWidth : 1,
					backgroundColor: bccolor,
					borderColor : bdcolor,
					data    : data
				}
				]

			};
			var ctxdate = document.getElementById("ctxstatus");
			var myBarChart = new Chart(ctxdate, {
				type: 'bar',
				data: data,
				options: {
					animation: {
						duration: 500,
						onComplete: function() {
							var ctx = this.chart.ctx;
							ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
							ctx.fillStyle = "black";
							ctx.textAlign = 'center';
							ctx.textBaseline = 'bottom';

							this.data.datasets.forEach(function(dataset) {
								for (var i = 0; i < dataset.data.length; i++) {
									for (var key in dataset._meta) {
										var model = dataset._meta[key].data[i]._model;
										ctx.fillText(dataset.data[i], model.x, model.y - 5);
									}
								}
							});
						}
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
					borderWidth : 1,
					backgroundColor: bccolor,
					borderColor : bdcolor,
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
					borderWidth : 1,
					backgroundColor: bccolor,
					borderColor : bdcolor,
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