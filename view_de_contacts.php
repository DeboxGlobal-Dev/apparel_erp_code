<?php

if($viewpermission!=1 && $_GET['id']!=''){

header('location:'.$fullurl.'');

}







if($_GET['id']!=''){

$id=clean(decode($_GET['id']));



$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,_CONTACT_MASTER_,$where1);

$editresult=mysqli_fetch_array($rs1);



$editassignTo=clean($editresult['assignTo']);

$editcontacttitleId=clean($editresult['contacttitleId']);

$editfirstName=clean($editresult['firstName']);

$editlastName=clean($editresult['lastName']);

$editdesignationId=clean($editresult['designationId']);

$editbirthDate=clean($editresult['birthDate']);

$editanniversaryDate=clean($editresult['anniversaryDate']);

$editcompanyTypeId=clean($editresult['companyTypeId']);

$editcountryId=clean($editresult['countryId']);

$editstateId=clean($editresult['stateId']);

$editcityId=clean($editresult['cityId']);

$edittitle=clean($editresult['title']);

$addedBy=clean($editresult['addedBy']);

$dateAdded=clean($editresult['dateAdded']);

$modifyBy=clean($editresult['modifyBy']);

$modifyDate=clean($editresult['modifyDate']);

$editsupId=clean($editresult['id']);

$editaddress1=clean($editresult['address1']);

$editaddress2=clean($editresult['address2']);

$editaddress3=clean($editresult['address3']);

$editpinCode=clean($editresult['pinCode']);

$editfacebook=clean($editresult['facebook']);

$edittwitter=clean($editresult['twitter']);

$editlinkedIn=clean($editresult['linkedIn']);
$id=clean($editresult['id']);
}





if($editassignTo!=''){



$select1='firstName,lastName,id';

$where1='id='.$editassignTo.'';

$rs1=GetPageRecord($select1,_USER_MASTER_,$where1);

$editOwnerresult=mysqli_fetch_array($rs1);



$assignfullName=strip($editOwnerresult['firstName'].' '.$editOwnerresult['lastName']);

$assignfullId=encode($editOwnerresult['id']);



}

?><script src="global_assets/js/plugins/visualization/echarts/echarts.min.js"></script>

			<div class="content">

				<!-- Select2 selects -->
				<form action="ac.de" method="post" enctype="multipart/form-data" name="addedit" target="acf" id="addedit">

				<div class="row displaypageclass">
					<div class="col-md-8">
					<div class="page-header page-header-light">


				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-1" style="cursor:pointer;"  onclick="cancel();" ></i> Contact Detail</h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
					</div>

					<div class="header-elements d-none"> <button type="button" style="background-color:#ff7300;" class="btn btn-primary" onclick="editaccount('<?php echo encode($editresult['id']); ?>');"   >Edit&nbsp; <i class="fa fa-pencil" aria-hidden="true"></i></button>


					</div>
				</div>
			</div>


						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">Business Card</h5>

							</div>
<div class="card-body">

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Full Name</label>
											    <?php echo getNameTitle($editcontacttitleId).' '.$editfirstName.' '.$editlastName; ?>
			                                </div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Account</label><?php
$select='';
$where='';
$rs='';
$select='name,id';
$where=' id="'.$editresult['accountId'].'"  ';
$rs=GetPageRecord($select,_CORPORATE_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){
$accountname = $resListing['name'];
$accountid = $resListing['id'];
 } ?>
				                                <a href="page.de?section=accounts&view=yes&id=<?php echo encode($accountid); ?>" target="_blank"><?php echo strip($accountname); ?></a>
			                                </div>
										</div>
									</div>




<div class="row">

										<div class="col-md-6">
											<div class="form-group">
												<label>Assigned To</label>

												 <?php
$select='';
$where='';
$rs='';
$select='firstName,id';
$where=' deletestatus=0 and id="'.$editassignTo.'" order by firstName asc';
$rs=GetPageRecord($select,_USER_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){
echo $resListing['firstName']; } ?>
			                                </div>
										</div>
<div class="col-md-3">
											<div class="form-group">
												<label>Country</label>

												 <?php
$select='';
$where='';
$rs='';
$select='name,id';
$where=' deletestatus=0 and id="'.$editcountryId.'"  order by name asc';
$rs=GetPageRecord($select,_COUNTRY_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){
echo strip($resListing['name']); } ?>
			                                </div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label>City</label>

												 <?php
$select='';
$where='';
$rs='';
$select='name,id';
$where=' deletestatus=0 and id="'.$editcityId.'" order by name asc';
$rs=GetPageRecord($select,_CITY_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){
echo strip($resListing['name']); } ?>
			                                </div>
										</div>

									</div>







						    </div>


						</div>


						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">Contact Info </h5>

							</div>

							<div class="card-body">

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Mobile </label>
				                                <?php echo stripslashes($editresult['phone']); ?>
			                                </div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Office Phone  </label>
												<?php echo stripslashes($editresult['phone2']); ?>
			                                </div>
										</div>
									</div>


	<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Email 1 </label>
				                                <a href="mailto:<?php echo stripslashes($editresult['email']); ?>"><?php echo stripslashes($editresult['email']); ?></a>
			                                </div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Email 2 </label>
				                                <a href="mailto:<?php echo stripslashes($editresult['email2']); ?>"><?php echo stripslashes($editresult['email2']); ?></a>
			                                </div>
										</div>


									</div>



<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Address 1  </label>
				                                <?php echo stripslashes($editresult['address1']); ?>
			                                </div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Address 2  </label>
				                                <?php echo stripslashes($editresult['address2']); ?>
			                                </div>
										</div>


									</div>



						    </div>


						</div>





						<div class="card-group-control card-group-control-right">







						<div class="card mb-2">
								<div class="card-header">
									<h6 class="card-title">
										<a class="text-default collapsed" data-toggle="collapse" href="#question11" aria-expanded="false">
											<i class="fa fa-phone" aria-hidden="true"></i> &nbsp;Call
										</a>
									</h6>
								</div>

								<div id="question11" class="collapse" style="">
									<div class="card-body">

									<div class="table-responsive">
						<table class="table table-bordered table-hover dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead>
							<tr role="row">
							  <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1"   aria-label="First Name: activate to sort column descending">Subject</th>
							  <th class="" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" aria-label="Last Name: activate to sort column ascending">Start</th>
							  <th class="" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" aria-label="Job Title: activate to sort column ascending">Status</th>
							  <th class="" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1">Assigned</th>
							  <th class="" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1">Created&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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


$where='where   companyId = '.$id.' and clientType=2  and deletestatus=0 order by dateAdded desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module=calls&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,_CALLS_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){
?>

						<tr role="row" class="odd">
								<td class="sorting_1"><a class="shorttextcard"  title="<?php echo clean($resultlists['subject']); ?>" style=" color:#2196f3; cursor:pointer; display:block; min-width:250px; max-width:120px;"  data-toggle="modal" data-target="#modalpop" onClick="opmodalpop(' View Call','modalpop.php?action=addcall&id=<?php echo encode($resultlists['id']); ?>','600px','auto');"  ><?php echo clean($resultlists['subject']); ?></a></td>
								<td class=""><?php if($resultlists['remiderDate']<date('Y-m-d H:i:s')){ ?><span class="badge badge-danger"><?php echo date('d/m/Y - h:i a',strtotime($resultlists['remiderDate'])); ?></span><?php } else {  echo date('d/m/Y - h:i a',strtotime($resultlists['remiderDate']));  } ?></td>
								<td><?php if($resultlists['status']==1){?><span class="badge badge-info">Scheduled</span><?php } if($resultlists['status']==2){ ?><span class="badge badge-success">Held</span><?php } if($resultlists['status']==3){?><span class="badge badge-danger">Canceled</span><?php }?></td>
								<td class="text-left"><div class="shorttextcard" title="<?php echo getUserName($resultlists['assignTo']); ?>"><?php echo getUserName($resultlists['assignTo']); ?></div></td>
								<td class="text-left"><div class="shorttextcard" title="<?php echo showmonthnamedate($resultlists['dateAdded']);?>"><?php echo date('d/m/Y',$resultlists['dateAdded']);?></div></td>
							</tr>


							<?php $no++; } ?>
							</tbody>
					</table>
					</div>
					<?php if($no==1){ ?>
<div style="padding:20px; text-align:center; background-color:#F9F9F9; margin-top:10px;">No Call</div>
<?php } ?>

									</div>


								</div>
							</div>



							<div class="card mb-2">
								<div class="card-header">
									<h6 class="card-title">
										<a class="text-default collapsed" data-toggle="collapse" href="#question1" aria-expanded="false">
											<i class="fa fa-user-circle-o" aria-hidden="true"></i> &nbsp;Meetings
										</a>
									</h6>
								</div>

								<div id="question1" class="collapse" style="">
									<div class="card-body">

									<div class="table-responsive">
						<table class="table table-bordered table-hover dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead>
							<tr role="row">
							  <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First Name: activate to sort column descending">Meeting Agenda</th>
							  <th class="" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" aria-label="Last Name: activate to sort column ascending">Start</th>
							  <th class="" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" aria-label="Job Title: activate to sort column ascending">Status</th>
							  <th class="" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1">Assigned</th>
							  <th class="" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1">Created&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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


$where='where  companyId = '.$id.' and clientType=2  and deletestatus=0 order by dateAdded desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module=calls&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,'meetingsMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){
?>

						<tr role="row" class="odd">
								<td class="sorting_1"><a class="shorttextcard"  title="<?php echo clean($resultlists['subject']); ?>" style=" color:#2196f3; cursor:pointer; display:block; min-width:120px; max-width:250px;"  data-toggle="modal" data-target="#modalpop" onClick="opmodalpop(' View Meeting','modalpop.php?action=addmeeting&id=<?php echo encode($resultlists['id']); ?>','600px','auto');"  ><?php echo clean($resultlists['subject']); ?></a></td>
								<td class=""><?php if($resultlists['remiderDate']<date('Y-m-d H:i:s')){ ?><span class="badge badge-danger"><?php echo date('d/m/Y - h:i a',strtotime($resultlists['remiderDate'])); ?></span><?php } else {  echo date('d/m/Y - h:i a',strtotime($resultlists['remiderDate']));  } ?></td>
								<td><?php if($resultlists['status']==1){?><span class="badge badge-info">Scheduled</span><?php } if($resultlists['status']==2){ ?><span class="badge badge-success">Held</span><?php } if($resultlists['status']==3){?><span class="badge badge-danger">Canceled</span><?php }?></td>
								<td class="text-left"><div class="shorttextcard" title="<?php echo getUserName($resultlists['assignTo']); ?>"><?php echo getUserName($resultlists['assignTo']); ?></div></td>
								<td class="text-left"><div class="shorttextcard" title="<?php echo showmonthnamedate($resultlists['dateAdded']);?>"><?php echo date('d/m/Y',$resultlists['dateAdded']);?></div></td>
							</tr>


							<?php $no++; } ?>
							</tbody>
					</table>
					</div><?php if($no==1){ ?>
<div style="padding:20px; text-align:center; background-color:#F9F9F9; margin-top:10px;">No Meeting </div>
<?php } ?>
									</div>


								</div>
							</div>

							<div class="card mb-2">
								<div class="card-header">
									<h6 class="card-title">
										<a class="text-default collapsed" data-toggle="collapse" href="#question2" aria-expanded="false">
											<i class="fa fa-tasks" aria-hidden="true"></i> &nbsp;Tasks
										</a>
									</h6>
								</div>

								<div id="question2" class="collapse" style="">
									<div class="card-body">


									<div class="table-responsive">
						<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead>
							<tr role="row">
							  <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First Name: activate to sort column descending">Subject</th>
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


$where='where  companyId = '.$id.' and clientType=2 and deletestatus=0 order by dateAdded desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module=calls&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,'tasksMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){
?>

						<tr role="row" class="odd">
								<td class="sorting_1"><a class="shorttextcard"  title="<?php echo clean($resultlists['subject']); ?>" style=" color:#2196f3; cursor:pointer; display:block; min-width:120px; max-width:250px;"  data-toggle="modal" data-target="#modalpop" onClick="opmodalpop(' View Task','modalpop.php?action=addtask&id=<?php echo encode($resultlists['id']); ?>','600px','auto');"  ><?php echo clean($resultlists['subject']); ?></a></td>
								<td class=""><?php if($resultlists['remiderDate']<date('Y-m-d H:i:s')){ ?><span class="badge badge-danger"><?php echo date('d/m/Y - h:i a',strtotime($resultlists['remiderDate'])); ?></span><?php } else {  echo date('d/m/Y - h:i a',strtotime($resultlists['remiderDate']));  } ?></td>
								<td><?php if($resultlists['status']==1){?><span class="badge badge-info">Scheduled</span><?php } if($resultlists['status']==2){ ?><span class="badge badge-success">Held</span><?php } if($resultlists['status']==3){?><span class="badge badge-danger">Canceled</span><?php }?></td>
								<td class="text-left"><div class="shorttextcard" title="<?php echo getUserName($resultlists['assignTo']); ?>"><?php echo getUserName($resultlists['assignTo']); ?></div></td>
								<td class="text-left"><div class="shorttextcard" title="<?php echo showmonthnamedate($resultlists['dateAdded']);?>"><?php echo date('d/m/Y',$resultlists['dateAdded']);?></div></td>
							</tr>


							<?php $no++; } ?>
							</tbody>
					</table>
					</div><?php if($no==1){ ?>
<div style="padding:20px; text-align:center; background-color:#F9F9F9; margin-top:10px;">No Task </div>
<?php } ?>

									  </div>


								</div>
							</div>







						</div>
					</div>

					<div class="col-md-4">



							<div class="card">
					  <div class="card-body">
								<div class="chart-container">
									<div class="chart has-fixed-height" id="pie_donut"></div>
									<div class="row row-tile no-gutters">
										<div class="col-4">
											<button type="button" class="btn btn-light btn-block btn-float m-0">
												<span style="font-size: 22px; color: #0679c8;">5000</span>
												<span>Active</span>
											</button>


										</div>

										<div class="col-4">
											<button type="button" class="btn btn-light btn-block btn-float m-0">
												<span style="font-size: 22px; color: #54cb14;">2000</span>
												<span>Confirmed</span>
											</button>


										</div>

										<div class="col-4">
											<button type="button" class="btn btn-light btn-block btn-float m-0">
												<span style="font-size: 22px; color: #dc0000;">1500</span>
												<span>Lost</span>
											</button>


										</div>
									</div>
								</div>
							</div>
							</div>


							<div class="card">
							<div class="card-header header-elements-inline">
								<h6 class="card-title">Notes</h6>


							</div>

							<div class="card-body">
							<div class="list-feed">
									<div class="list-feed-item border-warning-400">
										<div class="text-muted font-size-sm mb-1">12 minutes ago</div>
										<a href="#">David Linner</a> requested refund for a double card charge
									</div>

									<div class="list-feed-item border-warning-400">
										<div class="text-muted font-size-sm mb-1">12 minutes ago</div>
										User <a href="#">Christopher Wallace</a> is awaiting for staff reply
									</div>

									<div class="list-feed-item border-warning-400">
										<div class="text-muted font-size-sm mb-1">12 minutes ago</div>
										Ticket <strong>#43683</strong> has been closed by <a href="#">Victoria Wilson</a>
									</div>

									<div class="list-feed-item border-warning-400">
										<div class="text-muted font-size-sm mb-1">12 minutes ago</div>
										All sellers have received payouts for December!
									</div>


									<div class="text-right">
										<button id="savebutton" type="button" class="btn btn-primary">Add Note&nbsp; <i class="fa fa-plus" aria-hidden="true"></i></button>
									</div>
								</div>
							</div>
						</div>










					</div>
				</div>

<input name="editId" type="hidden" id="editId" value="<?php echo encode($lastId); ?>" /><?php
		if($_GET['id']!=''){
		?>
		<input name="editedityes" type="hidden" id="editedityes" value="1" />
		<?php } ?>

		<input name="action" type="hidden" id="action" value="editaccount" />
  <input name="savenew" type="hidden" id="savenew" value="0" />
			</form>
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
                color: [
                    '#0679c8','#54cb14','#e61718','#ffb980','#d87a80',
                    '#0679c8','#54cb14','#e61718','#95706d','#dc69aa',
                    '#0679c8','#54cb14','#e61718','#f5994e','#c05050',
                    '#0679c8','#54cb14','#e61718','#6f5553','#c14089'
                ],

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },

                // Add title
                title: {
                    text: 'Lead Metrics',
                    subtext: '',
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

                // Add legend

                // Add series
                series: [{
                    name: 'Leads',
                    type: 'pie',
                    radius: ['50%', '70%'],
                    center: ['50%', '57.5%'],
                    itemStyle: {
                        normal: {
                            borderWidth: 1,
                            borderColor: '#fff'
                        }
                    },
                    data: [

						{value: 5000, name: 'Active'},
						{value: 2000, name: 'Confirmed'},
						{value: 1500, name: 'Lost'},

                    ]
                }]
            });
        }

        // Basic pie chart




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