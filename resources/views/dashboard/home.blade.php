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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Quote Report</h3>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas id="ctxquote" style="height:230px"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Agreement Report</h3>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas id="ctxagree" style="height:230px"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Order Report</h3>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas id="ctxorder" style="height:230px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script>

	var bccolor = [
        "rgba(255, 99, 132, 0.2)",
        "rgba(255, 159, 64, 0.2)",
        "rgba(255, 205, 86, 0.2)",
        "rgba(75, 192, 192, 0.2)",
        "rgba(54, 162, 235, 0.2)",
        "rgba(153, 102, 255, 0.2)",
        "rgba(201, 203, 207, 0.2)"
	];
	var bdcolor = [
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
			var ctxdate = document.getElementById("ctxsumber");
			var config = {
				type: 'pie',
				data: data,
				options: {
					animation: {
  						duration: 0,
  						onComplete: function () {
    						var self = this,
        					chartInstance = this.chart,
        					ctx = chartInstance.ctx;
    						ctx.font = '12px Arial';
    						ctx.textAlign = "center";
    						ctx.fillStyle = "#000";
    						
    						Chart.helpers.each(self.data.datasets.forEach(function (dataset, datasetIndex) {
        						var meta = self.getDatasetMeta(datasetIndex),
	            					total = 0, //total values to compute fraction
	            					labelxy = [],
	            					offset = Math.PI / 2, //start sector from top
	            					radius,
						            centerx,
						            centery, 
						            lastend = 0; //prev arc's end line: starting with 0
        						
        						for (var val of dataset.data) { total += val; } 
        						Chart.helpers.each(meta.data.forEach( function (element, index) {
            						radius = 0.9 * element._model.outerRadius - element._model.innerRadius;
            						centerx = element._model.x;
            						centery = element._model.y;
            						var thispart = dataset.data[index],
                						arcsector = Math.PI * (2 * thispart / total);
            						if (element.hasValue() && dataset.data[index] > 0) {
              							labelxy.push(lastend + arcsector / 2 + Math.PI + offset);
            						}
            						else {
              							labelxy.push(-1);
            						}
            						lastend += arcsector;
        						}), self)
        						
        						var lradius = radius * 3 / 4;
        						for (var idx in labelxy) {
	          						if (labelxy[idx] === -1) continue;
	          						var langle = labelxy[idx],
	              						dx = centerx + lradius * Math.cos(langle),
	              						dy = centery + lradius * Math.sin(langle),
	              						val = Math.round(dataset.data[idx] );
	          						ctx.fillText(val, dx, dy);
        						}
    						}), self);
  						}
					},	
				},
			};

			var myBarChart = new Chart(ctxdate, config);
		});

		$.getJSON("{{ route('home.getbykategori') }}", function (result) {
			var labels = [],data=[];
			for (var i = 0; i < result.length; i++) {
				var temp = result[i].kategori == '' ? '-' : result[i].kategori;
				labels.push(temp);
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
			var ctxdate = document.getElementById("ctxkategori");
			var config = {
				type: 'pie',
				data: data,
				options: {
					animation: {
  						duration: 0,
  						onComplete: function () {
    						var self = this,
        					chartInstance = this.chart,
        					ctx = chartInstance.ctx;
    						ctx.font = '12px Arial';
    						ctx.textAlign = "center";
    						ctx.fillStyle = "#000";
    						
    						Chart.helpers.each(self.data.datasets.forEach(function (dataset, datasetIndex) {
        						var meta = self.getDatasetMeta(datasetIndex),
	            					total = 0, //total values to compute fraction
	            					labelxy = [],
	            					offset = Math.PI / 2, //start sector from top
	            					radius,
						            centerx,
						            centery, 
						            lastend = 0; //prev arc's end line: starting with 0
        						
        						for (var val of dataset.data) { total += val; } 
        						Chart.helpers.each(meta.data.forEach( function (element, index) {
            						radius = 0.9 * element._model.outerRadius - element._model.innerRadius;
            						centerx = element._model.x;
            						centery = element._model.y;
            						var thispart = dataset.data[index],
                						arcsector = Math.PI * (2 * thispart / total);
            						if (element.hasValue() && dataset.data[index] > 0) {
              							labelxy.push(lastend + arcsector / 2 + Math.PI + offset);
            						}
            						else {
              							labelxy.push(-1);
            						}
            						lastend += arcsector;
        						}), self)
        						
        						var lradius = radius * 3 / 4;
        						for (var idx in labelxy) {
	          						if (labelxy[idx] === -1) continue;
	          						var langle = labelxy[idx],
	              						dx = centerx + lradius * Math.cos(langle),
	              						dy = centery + lradius * Math.sin(langle),
	              						val = Math.round(dataset.data[idx] );
	          						ctx.fillText(val, dx, dy);
        						}
    						}), self);
  						}
					},	
				},
			};
			
			var myBarChart = new Chart(ctxdate, config);
		});

        $.getJSON("https://spreadsheets.google.com/feeds/list/15lS2Ik7CnOKFyi0pG1-TW-X67yPBdS5Jt7xZFc5kV20/od6/public/values?alt=json", function (result) {
            var mydata = result['feed']['entry'];
            var labels=[],inprogress=[],approvalprocess=[],acceptedbycustomer=[],orderplaced=[],cancelled=[],newtoday=[],totalquote=[];
            for (var i = 0; i < mydata.length; i++) {
                labels.push(mydata[i].gsx$tanggal.$t);
                inprogress.push(mydata[i].gsx$inprogress.$t);
                approvalprocess.push(mydata[i].gsx$approvalprocess.$t);
                acceptedbycustomer.push(mydata[i].gsx$acceptedbycustomer.$t);
                orderplaced.push(mydata[i].gsx$orderplaced.$t);
                cancelled.push(mydata[i].gsx$cancelled.$t);
                newtoday.push(mydata[i].gsx$newtoday.$t);
                totalquote.push(mydata[i].gsx$totalquote.$t);
            }

            var data = {
                labels : labels,
                datasets : [
                    {
                        label   : "In Progress",
                        borderWidth : 1,
                        backgroundColor: "rgba(255, 159, 64, 0.2)",
                        borderColor : "rgba(255, 159, 64, 0.2)",
                        data    : inprogress
                    },
                    {
                        label   : "Approval Process",
                        borderWidth : 1,
                        backgroundColor: "rgba(255, 99, 132, 0.2)",
                        borderColor : "rgba(255, 99, 132, 0.2)",
                        data    : approvalprocess
                    },
                    {
                        label   : "Accepted by Customer",
                        borderWidth : 1,
                        backgroundColor: "rgba(255, 205, 86, 0.2)",
                        borderColor : "rgba(255, 205, 86, 0.2)",
                        data    : acceptedbycustomer
                    },
                    {
                        label   : "Order Placed",
                        borderWidth : 1,
                        backgroundColor: "rgba(75, 192, 192, 0.2)",
                        borderColor : "rgba(75, 192, 192, 0.2)",
                        data    : orderplaced
                    },
                    {
                        label   : "Cancelled",
                        borderWidth : 1,
                        backgroundColor: "rgba(54, 162, 235, 0.2)",
                        borderColor : "rgba(54, 162, 235, 0.2)",
                        data    : cancelled
                    },
                    {
                        label   : "New Today",
                        borderWidth : 1,
                        backgroundColor: "rgba(153, 102, 255, 0.2)",
                        borderColor : "rgba(153, 102, 255, 0.2)",
                        data    : newtoday
                    },
                    {
                        label   : "Total Quote",
                        borderWidth : 1,
                        backgroundColor: "rgba(201, 203, 207, 0.2)",
                        borderColor : "rgba(201, 203, 207, 0.2)",
                        data    : totalquote
                    }
                ]
            };

            var ctxdate = document.getElementById("ctxquote").getContext("2d");
            var myBarChart = new Chart(ctxdate, {
                type: 'bar',
                data: data,
                options: {
                    barValueSpacing: 10,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }]
                    }
                }
            });
        });

        $.getJSON("https://spreadsheets.google.com/feeds/list/1HN-7aiTT6r1j3BeJIeRWv2WhaW49vimMvyNd767rKv8/od6/public/values?alt=json", function (result) {
            var mydata = result['feed']['entry'];
            var labels=[],newtoday=[],totalagreement=[];
            for (var i = 0; i < mydata.length; i++) {
                labels.push(mydata[i].gsx$tanggal.$t);
                newtoday.push(mydata[i].gsx$newtoday.$t);
                totalagreement.push(mydata[i].gsx$totalagreement.$t);
            }

            var data = {
                labels : labels,
                datasets : [
                    {
                        label   : "New Today",
                        borderWidth : 1,
                        backgroundColor: "rgba(153, 102, 255, 0.2)",
                        borderColor : "rgba(153, 102, 255, 0.2)",
                        data    : newtoday
                    },
                    {
                        label   : "Total Agreement",
                        borderWidth : 1,
                        backgroundColor: "rgba(201, 203, 207, 0.2)",
                        borderColor : "rgba(201, 203, 207, 0.2)",
                        data    : totalagreement
                    }
                ]
            };

            var ctxdate = document.getElementById("ctxagree").getContext("2d");
            var myBarChart = new Chart(ctxdate, {
                type: 'bar',
                data: data,
                options: {
                    barValueSpacing: 10,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }]
                    }
                }
            });
        });

        $.getJSON("https://spreadsheets.google.com/feeds/list/1TsQ59RKgTO9mVLKgp2sjW86eC_JJ0UCx9ox-0_Gv67I/od6/public/values?alt=json", function (result) {
            var mydata = result['feed']['entry'];
            var labels=[],submitted=[],ossprocess=[],baso=[],billingapproval=[],complete=[],invalidfailed=[],newtoday=[],totalorder=[];
            for (var i = 0; i < mydata.length; i++) {
                labels.push(mydata[i].gsx$tanggal.$t);
                submitted.push(mydata[i].gsx$submitted.$t);
                ossprocess.push(mydata[i].gsx$ossprocess.$t);
                baso.push(mydata[i].gsx$baso.$t);
                billingapproval.push(mydata[i].gsx$billingapproval.$t);
                complete.push(mydata[i].gsx$complete.$t);
                invalidfailed.push(mydata[i].gsx$invalidfailed.$t);
                newtoday.push(mydata[i].gsx$newtoday.$t);
                totalorder.push(mydata[i].gsx$totalorder.$t);
            }

            var data = {
                labels : labels,
                datasets : [
                    {
                        label   : "Submitted",
                        borderWidth : 1,
                        backgroundColor: "rgba(255, 159, 64, 0.2)",
                        borderColor : "rgba(255, 159, 64, 0.2)",
                        data    : submitted
                    },
                    {
                        label   : "OSS Process",
                        borderWidth : 1,
                        backgroundColor: "rgba(255, 99, 132, 0.2)",
                        borderColor : "rgba(255, 99, 132, 0.2)",
                        data    : ossprocess
                    },
                    {
                        label   : "BASO",
                        borderWidth : 1,
                        backgroundColor: "rgba(255, 205, 86, 0.2)",
                        borderColor : "rgba(255, 205, 86, 0.2)",
                        data    : baso
                    },
                    {
                        label   : "Billing Approval",
                        borderWidth : 1,
                        backgroundColor: "rgba(75, 192, 192, 0.2)",
                        borderColor : "rgba(75, 192, 192, 0.2)",
                        data    : billingapproval
                    },
                    {
                        label   : "Complete",
                        borderWidth : 1,
                        backgroundColor: "rgba(54, 162, 235, 0.2)",
                        borderColor : "rgba(54, 162, 235, 0.2)",
                        data    : complete
                    },
                    {
                        label   : "Invalid/Failed",
                        borderWidth : 1,
                        backgroundColor: "rgba(54, 162, 144, 0.2)",
                        borderColor : "rgba(54, 162, 144, 0.2)",
                        data    : invalidfailed
                    },
                    {
                        label   : "New Today",
                        borderWidth : 1,
                        backgroundColor: "rgba(153, 102, 255, 0.2)",
                        borderColor : "rgba(153, 102, 255, 0.2)",
                        data    : newtoday
                    },
                    {
                        label   : "Total Order",
                        borderWidth : 1,
                        backgroundColor: "rgba(201, 203, 207, 0.2)",
                        borderColor : "rgba(201, 203, 207, 0.2)",
                        data    : totalorder
                    }
                ]
            };

            var ctxdate = document.getElementById("ctxorder").getContext("2d");
            var myBarChart = new Chart(ctxdate, {
                type: 'bar',
                data: data,
                options: {
                    barValueSpacing: 10,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }]
                    }
                }
            });
        });

    });
</script>
@endsection