<?php
ob_start();
include "inc.php";  
include "config/logincheck.php";  
$selectedpage='1';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Dashboard - <?php echo $systemname; ?></title>
	<?php  include "headerinclude.php"; ?>
</head>
<!--style="background-image:url(images/banner.png); background-size:100% 100%;"-->
<body>
	 <script src="global_assets/js/plugins/visualization/echarts/echarts.min.js"></script> 
	<!-- Main navbar -->
	<?php include "header.php"; ?>
	<!-- /main navbar -->

					
	<!-- Page content -->
	<div class="content-wrapper">
		<div class="content">

	  <div class="row">
	  <div class="col-sm-6 col-xl-4">
	  
	  <div class="card-header bg-white">
								<h6 class="card-title">Department wise Production</h6>
							</div>
	<div class="card card-body text-center"> 
	<div id="columns_thermometer" style="height:300px;"></div>
	<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style="margin-top:10px;">
  <tr>
    <td width="6%" align="right"><strong>Production</strong></td>
    <td width="22%" align="left">3000</td>
    <td width="21%" align="left">2200</td>
    <td width="21%" align="left">2400</td>
    <td width="21%" align="left">3200</td>
  </tr>
  <tr>
    <td align="right"><strong>Target</strong></td>
    <td width="22%" align="left">2500</td>
    <td width="21%" align="left">2000</td>
    <td width="21%" align="left">1900</td>
    <td width="21%" align="left">2500</td>
  </tr>
</table>

	</div>
	</div>
	  
	  <div class="col-sm-6 col-xl-4">
	  <div class="card-header bg-white">
								<h6 class="card-title">Productivity & Line Efficiency</h6>
							</div>
	<div class="card card-body text-center"> 
	<div id="plie" style="height:300px;"></div> 
	  
     
	
	<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style="margin-top:10px;">
  <tr>
    <td width="6%" align="right"><strong>Productivity</strong></td>
    <td width="22%" align="left">14</td>
    <td width="21%" align="left">21</td>
    <td width="21%" align="left">10</td>
    <td width="21%" align="left">12</td>
  </tr>
  <tr>
    <td align="right"><strong>Line Eff </strong></td>
    <td width="22%" align="left">11</td>
    <td width="21%" align="left">15</td>
    <td width="21%" align="left">3</td>
    <td width="21%" align="left">9</td>
  </tr>
</table>

	</div>
	</div>
	<div class="col-sm-6 col-xl-4">
	  <div class="card-header bg-white">
								<h6 class="card-title">Line-wise Production and WIP</h6>
							</div>
	<div class="card card-body text-center"> 
	<div id="lwpaw" style="height:300px;"></div> 
	  
     
	
	<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style="margin-top:10px;">
  <tr>
    <td width="6%" align="right"><strong>Prodn.</strong></td>
    <td width="17%" align="left">500</td>
    <td width="14%" align="left">440</td>
    <td width="14%" align="left">700</td>
    <td width="14%" align="left">260</td>
    <td width="14%" align="left">300</td>
  </tr>
  <tr>
    <td align="right"><strong>WIP </strong></td>
    <td width="17%" align="left">350</td>
    <td width="14%" align="left">1080</td>
    <td width="14%" align="left">1400</td>
    <td width="14%" align="left">700</td>
    <td width="14%" align="left">500</td>
  </tr>
</table>

	</div>
	</div>
	  </div>
	  
	  
	  <div class="row">
	  <div class="col-sm-6 col-xl-4">
	  <div class="card-header bg-white">
								<h6 class="card-title">Style-wise Production of all Dept.</h6>
							</div>
	<div class="card card-body text-center"> 
	<div id="columnchart_material" style="height:210px;"></div> 
	
	
	
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['', 'Style 1', 'Style 2', 'Style 3', 'Style 4'],
          ['Cutting', 0, 940, 1100, 0],
          ['Sewing', 1000, 700, 500, 0],
          ['Finishing', 1500, 560, 0, 0],
          ['Shipment', 0, 0, 0, 3500]
        ]);

        var options = {
       legend: {position: 'none'},
	   
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
	  
     
	
	<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style="margin-top:10px;">
  <tr>
    <td width="6%" align="right"><strong>Style&nbsp;1</strong></td>
    <td width="17%" align="left">0</td>
    <td width="14%" align="left">940</td>
    <td width="14%" align="left">1100</td>
    <td width="14%" align="left">0</td>
    </tr>
  <tr>
    <td align="right"><strong>Style&nbsp;2 </strong></td>
    <td width="17%" align="left">1000</td>
    <td width="14%" align="left">700</td>
    <td width="14%" align="left">500</td>
    <td width="14%" align="left">0</td>
    </tr>
  <tr>
    <td align="right"><strong>Style&nbsp;3 </strong></td>
    <td align="left">1500</td>
    <td align="left">560</td>
    <td align="left">0</td>
    <td align="left">0</td>
    </tr>
  <tr>
    <td align="right"><strong>Style&nbsp;4 </strong></td>
    <td align="left">500</td>
    <td align="left">0</td>
    <td align="left">0</td>
    <td align="left">0</td>
    </tr>
  <tr>
    <td align="right"><strong>Style&nbsp;5 </strong></td>
    <td align="left">0</td>
    <td align="left">0</td>
    <td align="left">500</td>
    <td align="left">3500</td>
    </tr>
</table>

	</div>
	</div>
	  
	  
	  <div class="col-sm-6 col-xl-4">
	  <div class="card-header bg-white">
								<h6 class="card-title">Quality Report</h6>
							</div>
	<div class="card card-body text-center"> 
	<div id="qualityreport" style="height:300px;"></div> 
	  
     
	
	<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style="margin-top:10px;">
  <tr>
    <td width="6%" align="right"><strong>Sewing&nbsp;DHU</strong></td>
    <td width="17%" align="left">12</td>
    <td width="14%" align="left">21</td>
    <td width="14%" align="left">8</td>
    <td width="14%" align="left">11</td>
    <td width="14%" align="left">6</td>
  </tr>
  <tr>
    <td align="right"><strong>Finishing&nbsp;DHU </strong></td>
    <td width="17%" align="left">15</td>
    <td width="14%" align="left">18</td>
    <td width="14%" align="left">12</td>
    <td width="14%" align="left">13</td>
    <td width="14%" align="left">10</td>
  </tr>
</table>

	</div>
	</div>
	  
	  
	  
	  <div class="col-sm-6 col-xl-4">
	<div class="card-header bg-white">
								<h6 class="card-title">Earned Vs Make up% (Daily)</h6>
							</div>
	<div class="card card-body text-center"> 
	
	<div id="pie_donut" style="height:372px;"></div>
	</div>
	</div>
	  
	   </div>
	  </div>

	</div>
 

 <script>
var EchartsPiesDonuts = function() {


    //
    // Setup module components
    //

    // Pie and donut charts
    var _piesDonutsExamples = function() {
        if (typeof echarts == 'undefined') {
            console.warn('Warning - echarts.min.js is not loaded.');
            return;
        }

        // Define elements
        var pie_basic_element = document.getElementById('pie_basic'); 
 var pie_donut_element = document.getElementById('pie_donut');


        //
        // Charts configuration
        if (pie_donut_element) {

            // Initialize chart
            var pie_donut = echarts.init(pie_donut_element);


            //
            // Chart config
            //

            // Options
            pie_donut.setOption({

                // Colors
                color: ['#32b725','#bb3f3f','#5ab1ef','#ffb980','#d87a80'],

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },

               

                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [10, 15],
                    textStyle: {
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    },
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },

                // Add legend
             
                // Add series
                series: [{
                    name: 'Type',
                    type: 'pie',
                    radius: ['50%', '70%'],
                    center: ['50%', '50.5%'],
                    itemStyle: {
                        normal: {
                            borderWidth: 1,
                            borderColor: '#fff'
                        }
                    },
                    data: [
                        						{value: 45.5, name: 'Earned'}, 
												{value: 54.5, name: 'Make up'}, 
					                    ]
                }]
            });
        }

      


        //
        // Resize charts
        //

        // Resize function
        var triggerChartResize = function() {
            pie_basic_element && pie_basic.resize(); 
			pie_donut_element && pie_donut.resize();
        };

        // On sidebar width change
        $(document).on('click', '.sidebar-control', function() {
            setTimeout(function () {
                triggerChartResize();
            }, 0);
        });

        // On window resize
        var resizeCharts;
        window.onresize = function () {
            clearTimeout(resizeCharts);
            resizeCharts = setTimeout(function () {
                triggerChartResize();
            }, 200);
        };
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _piesDonutsExamples();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    EchartsPiesDonuts.init();
});
















var EchartsColumnsWaterfalls = function() {


    //
    // Setup module components
    //

    // Column and waterfall charts
    var _columnsWaterfallsExamples = function() {
        if (typeof echarts == 'undefined') {
            console.warn('Warning - echarts.min.js is not loaded.');
            return;
        }
		
		
 		 var columns_thermometer_element = document.getElementById('columns_thermometer');
        var columns_plie_element = document.getElementById('plie');  
		  var columns_basic_element = document.getElementById('lwpaw'); 
		  var columns_qualityreport_element = document.getElementById('qualityreport'); 
         
        if (columns_thermometer_element) {

            // Initialize chart
            var columns_thermometer = echarts.init(columns_thermometer_element);


            //
            // Chart config
            //

            // Options
            var columns_thermometer_options = {

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },

                // Chart animation duration
                animationDuration: 750,

                // Setup grid
                grid: {
                    left: 10,
                    right: 10,
                    top: 35,
                    bottom: 0,
                    containLabel: true
                },

                // Add legend
                legend: {
                    data: ['Actual', 'Forecast'],
                    itemHeight: 8,
                    itemGap: 20,
                    selectedMode: false
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [10, 15],
                    textStyle: {
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    },
                    axisPointer: {
                        type: 'shadow',
                        shadowStyle: {
                            color: 'rgba(0,0,0,0.025)'
                        }
                    },
                    formatter: function (params) {
                        return params[0].name + '<br/>'
                        + params[0].seriesName + ': ' + params[0].value + '<br/>'
                        + params[1].seriesName + ': ' + (params[1].value + params[0].value);
                    }
                },

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    data: ['Cutting', 'Sewing', 'Finishing', 'Shipment'],
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        show: true,
                        lineStyle: {
                            color: '#eee',
                            type: 'dashed'
                        }
                    }
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    boundaryGap: [0, 0.1],
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: '#eee'
                        }
                    },
                    splitArea: {
                        show: true,
                        areaStyle: {
                            color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.015)']
                        }
                    }
                }],

                // Add series
                series: [
                    {
                        name: 'Target',
                        type: 'bar',
                        stack: 'sum',
                        barCategoryGap: '50%',
                        itemStyle: {
                            normal: {
                                color: '#1ca805',
                                barBorderColor: '#1ca805',
                                barBorderWidth: 6,
                                label: {
                                    show: true,
                                    position: 'insideTop'
                                }
                            }
                        },
                        data: [2500, 2000, 1900, 2500]
                    },
                    {
                        name: 'Production',
                        type: 'bar',
                        stack: 'sum',
                        itemStyle: {
                            normal: {
                                color: '#f5f5f5',
                                barBorderColor: '#1ca805',
                                barBorderWidth: 6,
                                label: {
                                    show: true, 
                                    position: 'top',
                                    formatter: function (params) {
                                        for (var i = 0, l = columns_thermometer_options.xAxis[0].data.length; i < l; i++) {
                                            if (columns_thermometer_options.xAxis[0].data[i] == params.name) {
                                                return columns_thermometer_options.series[0].data[i] + params.value;
                                            }
                                        }
                                    },
                                    textStyle: {
                                        color: '#1ca805'
                                    }
                                }
                            }
                        },
                        data: [500, 200, 500, 700]
                    }
                ]
            };

            // Set options
            columns_thermometer.setOption(columns_thermometer_options);
        }
 
 
 if (columns_plie_element) {      

            // Initialize chart
            var columns_plie = echarts.init(columns_plie_element);


            //
            // Chart config
            //

            // Options
            var columns_plie_options = {

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },

                // Chart animation duration
                animationDuration: 750,

                // Setup grid
                grid: {
                    left: 10,
                    right: 10,
                    top: 35,
                    bottom: 0,
                    containLabel: true
                },

                // Add legend
                legend: {
                    data: ['Actual', 'Forecast'],
                    itemHeight: 8,
                    itemGap: 20,
                    selectedMode: false
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [10, 15],
                    textStyle: {
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    },
                    axisPointer: {
                        type: 'shadow',
                        shadowStyle: {
                            color: 'rgba(0,0,0,0.025)'
                        }
                    },
                    formatter: function (params) {
                        return params[0].name + '<br/>'
                        + params[0].seriesName + ': ' + params[0].value + '<br/>'
                        + params[1].seriesName + ': ' + (params[1].value + params[0].value);
                    }
                },

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    data: ['1', '2', '3', '4'],
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        show: true,
                        lineStyle: {
                            color: '#eee',
                            type: 'dashed'
                        }
                    }
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    boundaryGap: [0, 0.1],
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: '#eee'
                        }
                    },
                    splitArea: {
                        show: true,
                        areaStyle: {
                            color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.015)']
                        }
                    }
                }],

                // Add series
                series: [
                    {
                        name: 'Target',
                        type: 'bar',
                        stack: 'sum',
                        barCategoryGap: '50%',
                        itemStyle: {
                            normal: {
                                color: '#FF7043',
                                barBorderColor: '#FF7043',
                                barBorderWidth: 6,
                                label: {
                                    show: true,
                                    position: 'insideTop'
                                }
                            }
                        },
                        data: [11, 15, 3, 9]
                    },
                    {
                        name: 'Production',
                        type: 'bar',
                        stack: 'sum',
                        itemStyle: {
                            normal: {
                                color: '#f5f5f5',
                                barBorderColor: '#FF7043',
                                barBorderWidth: 6,
                                label: {
                                    show: true, 
                                    position: 'top',
                                    formatter: function (params) {
                                        for (var i = 0, l = columns_plie_options.xAxis[0].data.length; i < l; i++) {
                                            if (columns_plie_options.xAxis[0].data[i] == params.name) {
                                                return columns_plie_options.series[0].data[i] + params.value;
                                            }
                                        }
                                    },
                                    textStyle: {
                                        color: '#FF7043'
                                    }
                                }
                            }
                        },
                        data: [3, 6, 7, 3]
                    }
                ]
            };

            // Set options
            columns_plie.setOption(columns_plie_options);
        }
 
 
 
 
 if (columns_basic_element) {

            // Initialize chart
            var columns_basic = echarts.init(columns_basic_element);


            //
            // Chart config
            //

            // Options
            columns_basic.setOption({

                // Define colors
                color: ['#1ca805','#ff7043','#5ab1ef','#ffb980','#d87a80'],

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },

                // Chart animation duration
                animationDuration: 750,

                // Setup grid
                grid: {
                    left: 0,
                    right: 0,
                    top: 35,
                    bottom: 0,
                    containLabel: true
                },

                // Add legend
                legend: {
                    data: ['Evaporation', 'Precipitation'],
                    itemHeight: 8,
                    itemGap: 70,
                    textStyle: {
                        padding: [0, 10]
                    }
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [10, 15],
                    textStyle: {
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    }
                },

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    data: ['Line-1', 'Line-2', 'Line-3', 'Line-4', 'Line-5'],
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        show: true,
                        lineStyle: {
                            color: '#eee',
                            type: 'dashed'
                        }
                    }
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: ['#eee']
                        }
                    },
                    splitArea: {
                        show: true,
                        areaStyle: {
                            color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.01)']
                        }
                    }
                }],

                // Add series
                series: [
                    {
                        name: 'Prodn.',
                        type: 'bar',
                        data: [500, 440, 700, 260, 300],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    position: 'top',
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        } 
                    },
                    {
                        name: 'WIP',
                        type: 'bar',
                        data: [350, 1080, 1400, 700, 500],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    position: 'top',
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        } 
                    }
                ]
            });
        }

 
 
 
  
 if (columns_qualityreport_element) {

            // Initialize chart
            var columns_qualityreport = echarts.init(columns_qualityreport_element);


            //
            // Chart config
            //

            // Options
            columns_qualityreport.setOption({

                // Define colors
                color: ['#bb3f3f','#f38382','#5ab1ef','#ffb980','#d87a80'],

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },

                // Chart animation duration
                animationDuration: 750,

                // Setup grid
                grid: {
                    left: 0,
                    right: 0,
                    top: 35,
                    bottom: 0,
                    containLabel: true
                },

                // Add legend
                legend: {
                    data: ['Evaporation', 'Precipitation'],
                    itemHeight: 8,
                    itemGap: 70,
                    textStyle: {
                        padding: [0, 10]
                    }
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [10, 15],
                    textStyle: {
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    }
                },

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    data: ['Line-1', 'Line-2', 'Line-3', 'Line-4', 'Line-5'],
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        show: true,
                        lineStyle: {
                            color: '#eee',
                            type: 'dashed'
                        }
                    }
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value',
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: ['#eee']
                        }
                    },
                    splitArea: {
                        show: true,
                        areaStyle: {
                            color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.01)']
                        }
                    }
                }],

                // Add series
                series: [
                    {
                        name: 'Sewing DHU',
                        type: 'bar',
                        data: [12, 21, 8, 11, 6],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    position: 'top',
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        } 
                    },
                    {
                        name: 'Finishing DHU',
                        type: 'bar',
                        data: [15, 18, 12, 13, 10],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    position: 'top',
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        } 
                    }
                ]
            });
        }

 
 
 
        //
        // Resize charts
        //

        // Resize function
        var triggerChartResize = function() {
            columns_basic_element && columns_basic.resize();
            columns_qualityreport_element && columns_qualityreport.resize();
            columns_stacked_element && columns_stacked.resize();
            columns_thermometer_element && columns_thermometer.resize();
            columns_plie && columns_plie.resize();
            columns_clustered_element && columns_clustered.resize();
            columns_compositive_waterfall_element && columns_compositive_waterfall.resize();
            columns_change_waterfall_element && columns_change_waterfall.resize();
            columns_timeline_element && columns_timeline.resize();
        };

        // On sidebar width change
        $(document).on('click', '.sidebar-control', function() {
            setTimeout(function () {
                triggerChartResize();
            }, 0);
        });

        // On window resize
        var resizeCharts;
        window.onresize = function () {
            clearTimeout(resizeCharts);
            resizeCharts = setTimeout(function () {
                triggerChartResize();
            }, 200);
        };
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _columnsWaterfallsExamples();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    EchartsColumnsWaterfalls.init();
});
</script>
 

 <?php require "footer.php"; ?>

   
</body>
</html>

 