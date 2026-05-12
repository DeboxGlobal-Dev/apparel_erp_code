<?php
$searchField=clean($_GET['searchField']);

 if($loginuserprofileId==1){

$wheresearchassign=' 1 and ';

} else {

$wheresearchassign=' ( assignTo in (select id from '._USER_MASTER_.' where  roleId in (select id from roleMaster where parentId ='.$LoginUserDetails['roleId'].') ) or assignTo in (select id from '._USER_MASTER_.' where  roleId in (select id from roleMaster where parentId in (select id from roleMaster where parentId ='.$LoginUserDetails['roleId'].')))  or assignTo in (select id from '._USER_MASTER_.' where  roleId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId ='.$LoginUserDetails['roleId'].'))))  or assignTo in (select id from '._USER_MASTER_.' where  roleId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId ='.$LoginUserDetails['roleId'].'))))) or assignTo in (select id from '._USER_MASTER_.' where  roleId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in  (select id from roleMaster where parentId in ( select id from roleMaster where parentId ='.$LoginUserDetails['roleId'].')))))) or assignTo in (select id from '._USER_MASTER_.' where  roleId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in  (select id from roleMaster where parentId in ( select id from roleMaster where parentId ='.$LoginUserDetails['roleId'].'))))))) or assignTo in (select id from '._USER_MASTER_.' where  roleId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in  (select id from roleMaster where parentId in ( select id from roleMaster where parentId in ( select id from roleMaster where parentId ='.$LoginUserDetails['roleId'].')))))))))  ';

$wheresearchassign='( '.$wheresearchassign.'  or assignTo = '.$_SESSION['userid'].' or addedBy = '.$_SESSION['userid'].') and ';

}
?>

<style>
.badge {
    width: 100%;
}
</style>
 <script src="global_assets/js/plugins/visualization/echarts/echarts.min.js"></script>
<div class="page-content">



		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->

			<!-- /page header -->


			<!-- Content area -->
			<div class="content pt-0">




				<!-- Dashboard content -->
				<div class="row">


				<div class="col-xl-9">
				<div class="card" style="margin-top: 20px;">
					 <div class="card-header header-elements-inline bg-info-700">
						<div class="col-xl-9"><h5 class="card-title"><?php echo $modfile['moduleName']; ?></h5></div>
						 <div class="col-xl-3" style="    padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">
 <a href="#" data-toggle="modal" data-target="#modalpop" onClick="opmodalpop(' Create Task','modalpop.php?action=addtask','600px','auto');" class="btn bg-teal-400"  aria-expanded="false"  style="    background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Create Task</a>





							</div></div>
					</div>



					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll"><table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead>
							<tr role="row">
							  <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First Name: activate to sort column descending">Subject</th>
							  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" aria-label="Last Name: activate to sort column ascending">Client</th>
							  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" aria-label="Last Name: activate to sort column ascending">Start</th>
							  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" aria-label="Job Title: activate to sort column ascending">Status</th>
							  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1">Assigned</th>
							  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1">Created&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
						  </tr>
						</thead>
						<tbody>
					 <?php

$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit='5000';


$where='where  1 and deletestatus=0 order by dateAdded desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module=calls&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,'tasksMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){
?>

						<tr role="row" class="odd">
								<td class="sorting_1"><a class="shorttextcard"  title="<?php echo clean($resultlists['subject']); ?>" style=" color:#2196f3; cursor:pointer; display:block; min-width:120px; max-width:250px;"  data-toggle="modal" data-target="#modalpop" onClick="opmodalpop(' View Task','modalpop.php?action=addtask&id=<?php echo encode($resultlists['id']); ?>','600px','auto');"  ><?php echo clean($resultlists['subject']); ?></a></td>
								<td class=""><?php echo showClientTypeUserName($resultlists['clientType'],$resultlists['companyId']); ?></td>
								<td class=""><?php if($resultlists['remiderDate']<date('Y-m-d H:i:s')){ ?><span class="badge badge-danger"><?php echo date('d/m/Y - h:i a',strtotime($resultlists['remiderDate'])); ?></span><?php } else {  echo date('d/m/Y - h:i a',strtotime($resultlists['remiderDate']));  } ?></td>
								<td><?php if($resultlists['status']==1){?><span class="badge badge-info">Scheduled</span><?php } if($resultlists['status']==2){ ?><span class="badge badge-success">Held</span><?php } if($resultlists['status']==3){?><span class="badge badge-danger">Canceled</span><?php }?></td>
								<td class="text-left"><div class="shorttextcard" title="<?php echo getUserName($resultlists['assignTo']); ?>"><?php echo getUserName($resultlists['assignTo']); ?></div></td>
								<td class="text-left"><div class="shorttextcard" title="<?php echo showmonthnamedate($resultlists['dateAdded']);?>"><?php echo date('d/m/Y',$resultlists['dateAdded']);?></div></td>
							</tr>


							<?php $no++; } ?>
							</tbody>
					</table>
					</div></div>
				</div>


					</div>

					 <div class="col-xl-3">
					 	<div class="card" style="margin-top:20px;">
					  <div class="card-body">
								<div class="chart-container">
									<div class="chart has-fixed-height" id="pie_basic"></div>
								</div>
							</div>
							</div>


					 </div>
				</div>
				<!-- /dashboard content -->

			</div>
			<!-- /content area -->


			<!-- Footer -->

			<!-- /footer -->

		</div>
		<!-- /main content -->

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



        // Basic pie chart
        if (pie_basic_element) {

            // Initialize chart
            var pie_basic = echarts.init(pie_basic_element);


            //
            // Chart config
            //

            // Options
            pie_basic.setOption({

                // Colors
                color: [
                    '#4caf50','#f44336','#00bcd4'
                ],

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },

                // Add title
                title: {
                    text: 'Tasks by Status',
                    subtext: ' ',
                    left: 'center',
                    textStyle: {
                        fontSize: 17,
                        fontWeight: 500
                    },
                    subtextStyle: {
                        fontSize: 12
                    }
                },

                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [10, 15],
                    textStyle: {
                        fontSize: 12,
                        fontFamily: 'Roboto, sans-serif'
                    },
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },


                // Add series
                series: [{
                    name: 'Total',
                    type: 'pie',
                    radius: '50%',
                    center: ['50%', '57.5%'],
                    itemStyle: {
                        normal: {
                            borderWidth: 1,
                            borderColor: '#fff'
                        }
                    },
                    data: [

					    <?php
					$select='';
					$where='';
					$rs='';
					$select='*';
					$where=' deletestatus=0  group by status order by id asc';
					$rs=GetPageRecord('COUNT(id) as totalid, status ','tasksMaster',$where);
					while($resListing=mysqli_fetch_array($rs)){ ?>
						{value: <?php echo $resListing['totalid']; ?>, name: '<?php if($resListing['status']=='1'){ echo 'Scheduled'; } if($resListing['status']=='2'){ echo 'Held'; }if($resListing['status']=='3'){ echo 'Canceled'; }  ?>'},
					<?php } ?>
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

</script>

