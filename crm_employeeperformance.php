
	 <script src="global_assets/js/plugins/visualization/echarts/echarts.min.js"></script>
  <div class="content-wrapper">
		<div class="content">

	  <div class="row">

	  <?php if($loginuserprofileId==1){ ?>


	  <div class="col-sm-12 col-xl-6">
	<div class="card-header bg-white">
								<h6 class="card-title">Category Wise Style Qty. </h6>
							</div>
	<div class="card card-body text-center" style="overflow:hidden;">
	 <div id="donutchart" style="height:400px;"></div>
	</div>
	</div>

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([


          ['Task', 'Hours per Day'],
		<?php
		$rscategory=GetPageRecord('*','categoryMaster','1 and deletestatus=0 order by name asc');
		while($result=mysqli_fetch_array($rscategory)){
		$rscreated=GetPageRecord('*',_QUERY_MASTER_,'categoryId="'.$result['id'].'"');
		$resultcat=mysql_num_rows($rscreated);
		if($resultcat>0){
		?>
		  ['<?php echo $result['name'] ?>',     <?php echo $resultcat; ?>],
		<?php } } ?>
        ]);

        var options = {
		 chartArea:{left:50,top:50,width:"100%",right:40,height:"100%"},
          title: '',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>





	  <div class="col-sm-12 col-xl-6">
	<div class="card-header bg-white">
								<h6 class="card-title">User Wise Style (Merchant)</h6>
							</div>
	<div class="card card-body text-center" style="overflow:hidden;">

	<div style="height:400px;">

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {packages:['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
var oldData = google.visualization.arrayToDataTable([
['Name', 'Popularity'],
['Cesar', 250],
['Rachel', 4200],
['Patrick', 2900],
['Eric', 8200]
]);

var newData = google.visualization.arrayToDataTable([
['Name', 'No. of Styles'],
<?php
$k=GetPageRecord('*','userMaster','1 and profileId=85 order by id asc');
while($userdata=mysqli_fetch_array($k)){
$rkdm=GetPageRecord('id','queryMaster','1 and assignTo="'.$userdata['id'].'" order by id desc');
$kr=mysql_num_rows($rkdm);
?>
['<?php echo $userdata['firstName'].' '.$userdata['lastName']; ?>', <?php echo $kr; ?>],
<?php } ?>
]);


var colChartBefore = new google.visualization.ColumnChart(document.getElementById('colchart_before'));
var colChartAfter = new google.visualization.ColumnChart(document.getElementById('colchart_after'));
var colChartDiff = new google.visualization.ColumnChart(document.getElementById('colchart_diff'));
var barChartDiff = new google.visualization.BarChart(document.getElementById('barchart_diff'));

var options = {
 chartArea:{left:50,top:50,width:"90%",right:40,height:"50%"},
legend: { position: 'top' } };



colChartBefore.draw(oldData, options);
colChartAfter.draw(newData, options);

var diffData = colChartDiff.computeDiff(oldData, newData);
colChartDiff.draw(diffData, options);
barChartDiff.draw(diffData, options);
}
</script>

<span id='colchart_before' style='width: 450px; height: 250px; display: none;'></span>
<div id='colchart_after' style='width: 100%; height: 350px; display: block'></div>
<span id='colchart_diff' style='width: 450px; height: 250px; display: none'></span>
<span id='barchart_diff' style='width: 450px; height: 250px; display: none'></span>

	</div>
	</div>
	</div>

	<div class="col-sm-12 col-xl-6">
	<div class="card-header bg-white">
								<h6 class="card-title">Total Task Progress (Merchant) </h6>
							</div>

	<div class="card card-body text-center" style="overflow:hidden; ">
	<div id="barchart_material2" style="height:400px;">

	</div>
	<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['RKDMMM', 'Completed', 'Remaining Task', { role: 'annotation' } ],

		<?php
$r=GetPageRecord('*','userMaster','1 and profileId=85 order by id asc');
while($userdataa=mysqli_fetch_array($r)){


$selectqty='*';
$whereqty='styleId in (select id from queryMaster where assignTo="'.$userdataa['id'].'" and analyzeMaterialListSave=1 ) and qtyStatus=1';
$rsqty=GetPageRecord($selectqty,'styleSubCategoryMaster',$whereqty);
$totalqty = mysql_num_rows($rsqty);

$selectprice='*';
$whereprice='styleId in (select id from queryMaster where assignTo="'.$userdataa['id'].'" and analyzeMaterialListSave=1 ) and  priceStatus=1';
$rsprice=GetPageRecord($selectprice,'styleSubCategoryMaster',$whereprice);
$totalprice = mysql_num_rows($rsprice);

$selectvendor='*';
$wherevendor='styleId in (select id from queryMaster where assignTo="'.$userdataa['id'].'"  and analyzeMaterialListSave=1) and  vendorStatus=1';
$rsvendor=GetPageRecord($selectvendor,'styleSubCategoryMaster',$wherevendor);
$totalvendor = mysql_num_rows($rsvendor);


$totalTask = $totalqty+$totalprice+$totalvendor;

$selecttaskComplet='*';
$wheretaskComplet='styleId in (select id from queryMaster where assignTo="'.$userdataa['id'].'"  and analyzeMaterialListSave=1) and approvedStatus=1';
$rswheretaskComplet=GetPageRecord($selecttaskComplet,'materialCostChatMaster',$wheretaskComplet);
$completed = mysql_num_rows($rswheretaskComplet);


		?>
		['<?php echo $userdataa['firstName'].' '.$userdataa['lastName']; ?>', <?php echo $completed; ?>, <?php echo $totalTask-$completed; ?>, ''],

	    <?php } ?>

	  ]);

      var options = {
	   chartArea:{left:50,top:50,width:"90%",right:40,height:"50%"},
        width: 650,
        height: 470,
        legend: { position: 'top', maxLines: 3 },
        bar: {groupWidth: '75%'},
        isStacked: true,
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('barchart_material2'));
      chart.draw(data, options);
  }
  </script>

	</div>
	</div>

	<div class="col-sm-12 col-xl-6">
	<div class="card-header bg-white">
								<h6 class="card-title">Weekly Task Progress (Merchant) </h6>
							</div>
	<div class="card card-body text-center" style="overflow:hidden;">

	 <div id="columnchart_stacked" style="height:400px;">








<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['RKDM', 'Monday', 'Tuesday', 'Wednesday', 'Thursday',
         'Friday', 'Saturday', { role: 'annotation' } ],

		<?php
		$rk=GetPageRecord('*','userMaster','1 and profileId=85 order by id asc');
		while($userdataaa=mysqli_fetch_array($rk)){
		$kr=GetPageRecord('*','queryMaster','1 and assignTo="'.$userdataaa['id'].'" order by id asc');

		?>
		['<?php echo $userdataaa['firstName'].' '.$userdataaa['lastName']; ?>', 100, 200, 300, 400, 500, 600, ''],
        <?php } ?>

	  ]);

      var options = {
	    chartArea:{left:50,top:50,width:"90%",right:40,height:"50%"},
        width: 650,
        height: 470,
        legend: { position: 'top', maxLines: 3 },
        bar: {groupWidth: '75%'},
        isStacked: true,
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_stacked'));
      chart.draw(data, options);
  }
  </script>


	</div>

	</div>
	</div>



	<?php } ?>

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
                        					<?php
											$rscategory=GetPageRecord('*','categoryMaster','1 and deletestatus=0 order by name asc');
											while($result=mysqli_fetch_array($rscategory)){

											$rscreated=GetPageRecord('*',_QUERY_MASTER_,'categoryId="'.$result['id'].'"');
											$resultcat=mysql_num_rows($rscreated);
											if($resultcat>0){
											 ?>
											 {value: <?php echo $resultcat; ?>, name: '<?php echo $result['name'] ?>',  color: 'yellow'},
											<?php } } ?>

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

					 data: [<?php $rk=GetPageRecord('*','userMaster','1 and profileId=85 order by id asc'); while($userdataaa=mysqli_fetch_array($rk)){ ?>'<?php echo $userdataaa['firstName']; ?>',<?php } ?>],


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

                // Add series////////////////////////////////////
                series: [
                    {
                        name: 'Completed',
                        type: 'bar',
                        stack: 'sum',
                        barCategoryGap: '50%',
                        itemStyle: {
                            normal: {
                                color: '#dc3912',
                                barBorderColor: '#dc3912',
                                barBorderWidth: 2,
                                label: {
                                    show: true,
                                    position: 'insideTop'
                                }
                            }
                        },

                        data:[

 <?php
$r=GetPageRecord('*','userMaster','1 and profileId=85 order by id asc');
while($userdataa=mysqli_fetch_array($r)){

$selectqty='*';
$whereqty='styleId in (select id from queryMaster where assignTo="'.$userdataa['id'].'" and analyzeMaterialListSave=1 ) and qtyStatus=1';
$rsqty=GetPageRecord($selectqty,'styleSubCategoryMaster',$whereqty);
$totalqty = mysql_num_rows($rsqty);

$selectprice='*';
$whereprice='styleId in (select id from queryMaster where assignTo="'.$userdataa['id'].'" and analyzeMaterialListSave=1 ) and  priceStatus=1';
$rsprice=GetPageRecord($selectprice,'styleSubCategoryMaster',$whereprice);
$totalprice = mysql_num_rows($rsprice);

$selectvendor='*';
$wherevendor='styleId in (select id from queryMaster where assignTo="'.$userdataa['id'].'"  and analyzeMaterialListSave=1) and  vendorStatus=1';
$rsvendor=GetPageRecord($selectvendor,'styleSubCategoryMaster',$wherevendor);
$totalvendor = mysql_num_rows($rsvendor);

$totalTask = $totalqty+$totalprice+$totalvendor;

$selecttaskComplet='*';
$wheretaskComplet='styleId in (select id from queryMaster where assignTo="'.$userdataa['id'].'"  and analyzeMaterialListSave=1) and approvedStatus=1';
$rswheretaskComplet=GetPageRecord($selecttaskComplet,'materialCostChatMaster',$wheretaskComplet);
$completed = mysql_num_rows($rswheretaskComplet);

?>
	 <?php echo $completed; ?>,

<?php } ?>
	]
                    },
                    {
                        name: 'Total',
                        type: 'bar',
                        stack: 'sum',
                        itemStyle: {
                            normal: {
                                color: '#f5f5f5',
                                barBorderColor: '#dc3912',
                                barBorderWidth: 2,
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
                         data:[

 <?php
$r=GetPageRecord('*','userMaster','1 and profileId=85 order by id asc');
while($userdataa=mysqli_fetch_array($r)){

$selectqty='*';
$whereqty='styleId in (select id from queryMaster where assignTo="'.$userdataa['id'].'" and analyzeMaterialListSave=1 ) and qtyStatus=1';
$rsqty=GetPageRecord($selectqty,'styleSubCategoryMaster',$whereqty);
$totalqty = mysql_num_rows($rsqty);

$selectprice='*';
$whereprice='styleId in (select id from queryMaster where assignTo="'.$userdataa['id'].'" and analyzeMaterialListSave=1 ) and  priceStatus=1';
$rsprice=GetPageRecord($selectprice,'styleSubCategoryMaster',$whereprice);
$totalprice = mysql_num_rows($rsprice);

$selectvendor='*';
$wherevendor='styleId in (select id from queryMaster where assignTo="'.$userdataa['id'].'"  and analyzeMaterialListSave=1) and  vendorStatus=1';
$rsvendor=GetPageRecord($selectvendor,'styleSubCategoryMaster',$wherevendor);
$totalvendor = mysql_num_rows($rsvendor);

$totalTask = $totalqty+$totalprice+$totalvendor;


$selecttaskComplet='*';
$wheretaskComplet='styleId in (select id from queryMaster where assignTo="'.$userdataa['id'].'"  and analyzeMaterialListSave=1) and approvedStatus=1';
$rswheretaskComplet=GetPageRecord($selecttaskComplet,'materialCostChatMaster',$wheretaskComplet);
$completed = mysql_num_rows($rswheretaskComplet);


?>
	 <?php echo $totalTask - $completed; ?>,

<?php } ?>
	]
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


