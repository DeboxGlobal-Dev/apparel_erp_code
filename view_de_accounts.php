<?php
if($addpermission!=1 && $_GET['id']==''){
header('location:'.$fullurl.'');
}

if($editpermission!=1 && $_GET['id']!=''){
header('location:'.$fullurl.'');
}




if($_GET['id']!=''){
$id=clean(decode($_GET['id']));
$paymentTerm=1;
$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,_CORPORATE_MASTER_,$where1);
$editresult=mysqli_fetch_array($rs1);

$editassignTo=clean($editresult['assignTo']);
$editname=clean($editresult['name']);
$editcontactPerson=clean($editresult['contactPerson']);
$editcompanyTypeId=clean($editresult['companyTypeId']);
$clientType=clean($editresult['companyTypeId']);
$id=clean($editresult['id']);
$editcountryId=clean($editresult['countryId']);
$editstateId=clean($editresult['stateId']);
$editcityId=clean($editresult['cityId']);
$edittitle=clean($editresult['title']);
$addedBy=clean($editresult['addedBy']);
$dateAdded=clean($editresult['dateAdded']);
$modifyBy=clean($editresult['modifyBy']);
$modifyDate=clean($editresult['modifyDate']);

$editaddress1=clean($editresult['address1']);
$editaddress2=clean($editresult['address2']);
$editaddress3=clean($editresult['address3']);
$editpinCode=clean($editresult['pinCode']);
$editgstn=clean($editresult['gstn']);
$editagreement=clean($editresult['agreement']);
$editcompanyCategory=clean($editresult['companyCategory']);
$lastId=$editresult['id'];
$paymentTerm=$editresult['paymentTerm'];
$bussinessType=clean($editresult['bussinessType']);
$editOpsAassignTo=clean($editresult['OpsAssignTo']);
$editloginUserName=clean($editresult['loginUserName']);
$editloginPassword=clean($editresult['loginPassword']);
$editattachment=clean($editresult['attachment']);
}





?> <script src="global_assets/js/plugins/visualization/echarts/echarts.min.js"></script>

			<div class="content">

				<!-- Select2 selects -->
				<form action="ac.de" method="post" enctype="multipart/form-data" name="addedit" target="acf" id="addedit">

				<div class="row displaypageclass">
					<div class="col-md-8">
					<div class="page-header page-header-light">


				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-1" style="cursor:pointer;"  onclick="cancel();" ></i> Account Detail</h4>
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
												<label>Type</label>
											    <?php if(1==$bussinessType){ echo 'Corporate'; } else { echo 'Agent'; }  ?>
			                                </div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Name</label>
				                                <?php echo $editname; ?>
			                                </div>
										</div>
									</div>


	<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Business Type</label>
				                                <?php
$select='';
$where='';
$rs='';
$select='*';
$where=' deletestatus=0 and id="'.$editcompanyTypeId.'" and status=1 order by id asc';
$rs=GetPageRecord($select,_COMPANY_TYPE_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){

 echo strip($resListing['name']);
  } ?>
			                                </div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Contact Person </label>
				                                <?php echo $editcontactPerson; ?>
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
									<style>
									.downloadbtn{    border: 1px solid #2196f3;
									padding: 5px;
									border-radius: 3px;
									color: #FFF;
									background-color: #2196f3;}
									a:hover {
									background-color: #FFF;
									}
									</style>
									<div class="col-md-6">
											<div class="form-group">
												<label>Attachment</label>
		 									<a class="downloadbtn" href="<?php echo $fullurl; ?>attachment/<?php echo $editattachment; ?>" target="_blank">Download Attachment</a>
			                                </div>
										</div>

									</div>







						    </div>


						</div>
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">Login Info </h5>

							</div>

							<div class="card-body">

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Username </label>
				                                <?php echo $editloginUserName; ?>
			                                </div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Password  </label>
				                                ************
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
												<label>Phone 1 </label>
				                                <?php echo stripslashes($editresult['phone']); ?>
			                                </div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Phone 2  </label>
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