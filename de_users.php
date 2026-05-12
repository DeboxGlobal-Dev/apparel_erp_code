

<style>
/*.datatable-header{display:none !important;}
.datatable-footer{display:none !important;}*/
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


				<div class="col-xl-12">
				<div class="card" style="margin-top: 20px;">
					 <div class="card-header header-elements-inline bg-info-700">
						<div class="col-xl-9"><h5 class="card-title"><?php echo $modfile['moduleName']; ?></h5></div>
						 <div class="col-xl-3" style="    padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">
 <a href="#"   class="btn bg-teal-400"  aria-expanded="false"  data-toggle="modal" data-target="#modalpop" onclick="opmodalpop(' Add New  User','modalpop.php?action=adduser','600px','auto');"  style="    background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Add User</a>



							</div></div>
					</div>



					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll"><table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead>
							<tr role="row">
							  <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" aria-sort="ascending" aria-label="First Name: activate to sort column descending">&nbsp;</th>
							  <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First Name: activate to sort column descending">Full Name</th>
							  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" aria-label="Last Name: activate to sort column ascending">Email</th>
							  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" aria-label="Last Name: activate to sort column ascending">Phone</th>
							  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" aria-label="Last Name: activate to sort column ascending">Role</th>
							  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" aria-label="Job Title: activate to sort column ascending">Profile</th>
							  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" aria-label="DOB: activate to sort column ascending">Status</th>
							  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1">User Type</th>
							  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1">Date&nbsp;Modified</th>
							  </tr>
						</thead>
						<tbody>

						<?php

$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit='20000';

$mainwhere='';
if($searchField!=''){
$mainwhere=' and ( name like "%'.$searchField.'%" or contactPerson like "%'.$searchField.'%" or id in (select masterId from  '._PHONE_MASTER_.' where phoneNo like "%'.$searchField.'%"  ) or id in  (select masterId from  '._EMAIL_MASTER_.' where email like "%'.$searchField.'%"  ) ) ';
}

$assignto='';
if($_GET['assignto']!=''){
$assignto=' and	assignTo='.$_GET['assignto'].'';
}

if($loginuserprofileId==1){
$wheresearch=' 1 '.$mainwhere.'';
} else {
$wheresearch=' 1 '.$mainwhere.'';
//$wheresearch=' ( addedBy = '.$_SESSION['userid'].'  or assignTo = '.$_SESSION['userid'].'  ) '.$mainwhere.'';
}





$where='where  1 and deletestatus=0 order by dateAdded desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module=corporate&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,_USER_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){
  $corporate_id = $resultlists['id'];
?>

						<tr role="row" class="odd">
						  <td class="sorting_1"><img src="<?php if($resultlists['profilePhoto']!=''){ ?>profilepic/<?php echo $resultlists['profilePhoto']; ?><?php } else { ?>images/user.png<?php } ?>" alt="" width="40" class="rounded-circle"></td>
								<td class="sorting_1"><a data-toggle="modal" data-target="#modalpop"  class="shorttextcard"  title="<?php echo $resultlists['name']; ?>" style=" color:#2196f3; display:block; min-width:120px; max-width:120px;" href="#"  onclick="opmodalpop(' Edit User','modalpop.php?action=adduser&id=<?php echo encode($resultlists['id']); ?>','600px','auto');" ><?php echo strip($resultlists['firstName']); ?> <?php echo strip($resultlists['lastName']); ?></a></td>
								<td class="">
								<?php echo strip($resultlists['email']); ?>								</td>
								<td class=""><?php echo $resultlists['phone']; ?></td>
								<td class=""><?php
$select1='name';
$where1='id="'.$resultlists['roleId'].'"';
$rs1=GetPageRecord($select1,'roleMaster',$where1);
$res=mysqli_fetch_array($rs1);
echo strip($res['name']);
?></td>
								<td><?php
$select1='profileName';
$where1='id="'.$resultlists['profileId'].'"';
$rs1=GetPageRecord($select1,'profileMaster',$where1);
$res=mysqli_fetch_array($rs1);
echo strip($res['profileName']);
?></td>
								<td><?php if($resultlists['status']==1){ ?><span class="badge badge-success">Active</span><?php } else { ?>
      <span class="badge badge-danger">Inactive</span>  <?php  }?></td>
								<td class="text-left"><?php if('0'==$resultlists['userType']){ ?>Sales Person<?php } ?><?php if('1'==$resultlists['userType']){ ?>Operations Person<?php } ?>
								<td class="text-left"><div class="shorttextcard" title="<?php echo showmonthnamedate($resultlists['dateAdded']);?>"><?php echo date('d/m/Y - h:i a',$resultlists['dateAdded']);?></div></td>
							</tr>


							<?php $no++; } ?>
							</tbody>
					</table>
					</div></div>
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
                    '#2ec7c9','#b6a2de','#5ab1ef','#ffb980','#d87a80',
                    '#8d98b3','#e5cf0d','#97b552','#95706d','#dc69aa',
                    '#07a2a4','#9a7fd1','#588dd5','#f5994e','#c05050',
                    '#59678c','#c9ab00','#7eb00a','#6f5553','#c14089'
                ],

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },

                // Add title
                title: {
                    text: 'Vendors by City',
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
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    },
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },


                // Add series
                series: [{
                    name: 'Total Vendors',
                    type: 'pie',
                    radius: '60%',
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
					$where=' deletestatus=0 group by cityId order by id asc';
					$rs=GetPageRecord('COUNT(id) as totalid, cityId ',_VENDOR_MASTER_,$where);
					while($resListing=mysqli_fetch_array($rs)){ if($resListing['cityId']!=''){ if($resListing['cityId']!='0'){ ?>
						{value: <?php echo $resListing['totalid']; ?>, name: '<?php echo getCityName($resListing['cityId']); ?>'},
					<?php } } } ?>
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