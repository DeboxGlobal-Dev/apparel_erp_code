<?php
if($addpermission!=1 && $_GET['id']==''){
header('location:'.$fullurl.'');
}

if($editpermission!=1 && $_GET['id']!=''){
header('location:'.$fullurl.'');
}

if($_REQUEST['deleteImgId']!='' && $_REQUEST['deleteImgId']>0){

$select1='*';
$where1='id="'.$_REQUEST['deleteImgId'].'"';
$rs1=GetPageRecord($select1,'imageGalleryMaster',$where1);
$editresult=mysqli_fetch_array($rs1);

$where='id="'.$_REQUEST['deleteImgId'].'"';
$exe = deleteRecord('imageGalleryMaster',$where);
if($exe=='true'){
unlink('images/imageGallary/'.$editresult['imgUrl']);
}


}


if($_GET['id']!=''){
$id=clean(decode($_GET['id']));
$paymentTerm=1;
$select1='*';
$where1='id="'.$id.'"';
$rs1=GetPageRecord($select1,'sightseeingMaster',$where1);
$editresult=mysqli_fetch_array($rs1);

$editsupplier=clean($editresult['supplier']);
$editname=clean($editresult['name']);
$editcost=clean($editresult['cost']);
$currency=clean($editresult['currency']);
$editcountry=clean($editresult['country']);
$editdestinaton=clean($editresult['destinaton']);
$editduration=clean($editresult['duration']);
$editdescription=clean($editresult['description']);
$editinclusions=clean($editresult['inclusions']);
$editexclusions=clean($editresult['exclusions']);

$editVoucherRequirements=clean($editresult['VoucherRequirements']);
$editdepartureTime=clean($editresult['departureTime']);
$editdeparturePoint=clean($editresult['departurePoint']);
$editreturnDetails=clean($editresult['returnDetails']);
$editsalesPoints=clean($editresult['salesPoints']);
$editcategoryTags=clean($editresult['categoryTags']);
$editstarRating=clean($editresult['starRating']);
$editstatus=clean($editresult['status']);
$editupdateDate=clean($editresult['updateDate']);
$editupdateBy=clean($editresult['updateBy']);
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
						<h4><i class="icon-arrow-left52 mr-1" style="cursor:pointer;"  onclick="cancel();" ></i> Sightseeing Detail</h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
					</div>

					<div class="header-elements d-none"> <button type="button" style="background-color:#ff7300;" class="btn btn-primary" onclick="editaccount('<?php echo encode($editresult['id']); ?>');"   >Edit&nbsp; <i class="fa fa-pencil" aria-hidden="true"></i></button>


					</div>
				</div>
			</div>


						<div class="card">

<div class="card-body">

									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>Vendor</label>
											    <?php
										$select1='*';
									    $where1='id="'.$editsupplier.'"';
										$rs1=GetPageRecord($select1,_VENDOR_MASTER_,$where1);
										$editresult2=mysqli_fetch_array($rs1);
										echo $vendortype= $editresult2['name'];
								?>
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Sightseeing Name</label>
											     <?php 	echo $editname; ?>
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Cost</label>
											     <?php 	echo $editcost; ?>
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Currency</label>
											    INR
			                                </div>
										</div>


									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>Country</label>
											    <?php
										$select1='*';
									    $where1='id="'.$editcountry.'"';
										$rs1=GetPageRecord($select1,_COUNTRY_MASTER_,$where1);
										$editresult2=mysqli_fetch_array($rs1);
										echo $editresult2['name'];
								?>
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Destinaton</label>
													<?php
													$select1='*';
													$where1='id="'.$editdestinaton.'"';
													$rs1=GetPageRecord($select1,'destinationMaster',$where1);
													$editresult2=mysqli_fetch_array($rs1);
													echo $editresult2['name'];
													?>
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Duration</label>
											     <?php 	echo $editduration; ?>
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Description</label>
											       <?php echo $editduration; ?>
			                                </div>
										</div>


									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>Inclusions</label>
											     <?php
												 if($editinclusions!=''){
													$select1='*';
													$where1=' id in ('.$editinclusions.')';
													$rs1=GetPageRecord($select1,'inclusionsMaster',$where1);
													$count = mysqli_num_rows($rs1);
													while($editresult2=mysqli_fetch_array($rs1)){
													echo $editresult2['name'].'&nbsp;,&nbsp;&nbsp;';
													} }
													?>
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Exclusions</label>
											      <?php
												  if($editexclusions!=''){
													$select1='*';
													$where1=' id in ('.$editexclusions.')';
													$rs1=GetPageRecord($select1,'exclusionsMaster',$where1);
													$count = mysqli_num_rows($rs1);
													while($editresult2=mysqli_fetch_array($rs1)){
													echo $editresult2['name'].'&nbsp;,&nbsp;&nbsp;';
													} }
													?>
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Voucher Requirements</label>
											     <?php 	echo $editVoucherRequirements; ?>
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Departure Time</label>
											     <?php 	echo $editdepartureTime; ?>
			                                </div>
										</div>


									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>Departure Point</label>
											      <?php echo $editdeparturePoint; ?>
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Return Details</label>
											     <?php 	echo $editreturnDetails; ?>
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Sales Points</label>
												<?php
												if($editsalesPoints!=''){
													$select1='*';
													$where1=' id in ('.$editsalesPoints.')';
													$rs1=GetPageRecord($select1,'salesPointsMaster',$where1);
													$count = mysqli_num_rows($rs1);
													while($editresult2=mysqli_fetch_array($rs1)){
													echo $editresult2['name'].'&nbsp;,&nbsp;&nbsp;';
													} }
													?>
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Category Tags</label>
											     <?php
												 if($editcategoryTags!=''){
													$select1='*';
													$where1=' id in ('.$editcategoryTags.')';
													$rs1=GetPageRecord($select1,'categoryTypeMaster',$where1);
													$count = mysqli_num_rows($rs1);
													while($editresult2=mysqli_fetch_array($rs1)){
													echo $editresult2['name'].'&nbsp;,&nbsp;&nbsp;';
													} }
													?>
			                                </div>
										</div>


									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>Star Rating</label>
											    <?php echo  $editstarRating.'&nbsp;Star'; ?>
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Status</label>
											     <?php if($editstatus==0){ echo "Active"; }else{ echo "Inactive"; } ?>
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Update Date</label>
											     <?php 	echo date('d-m-Y H:i:a',$editupdateDate); ?>
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Update By</label>
											    <?php echo  getUserName($editupdateBy);	?>
			                                </div>
										</div>


									</div>













						    </div>


						</div>









					</div>

					<div class="col-md-4">
					<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><span class="font-weight-semibold">Photo Gallery</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					<div class="header-elements d-none"><button type="button" onclick="funuploadgallary();" style="background-color:#11a006;" class="btn btn-primary" >Add&nbsp; <i class="fa fa-plus" aria-hidden="true"></i></button>


					</div>
				</div>


			</div>

						 <div class="row" style="margin-top:20px;">
						 <?php
							$selectimg='*';
							$whereimg='parentId="'.$id.'" order by imgUrl asc';
							$rsimg=GetPageRecord($selectimg,'imageGalleryMaster',$whereimg);
							while($imgresult=mysqli_fetch_array($rsimg)){
						  ?>
					<div class="col-sm-6 col-lg-4">
						<div class="card">
							<div class="card-img-actions m-1">
								<img class="card-img img-fluid" src="<?php echo $fullurl; ?>images/imageGallary/<?php echo $imgresult['imgUrl']; ?>" alt="<?php echo $imgresult['imgUrl']; ?>">
								<div class="card-img-actions-overlay card-img">
									<a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round legitRipple" data-popup="lightbox" rel="group">
										<i class="fa fa-trash-o" aria-hidden="true" onclick="fundeleteimg('<?php echo $imgresult['id']; ?>');"></i>
									</a>


								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					<!--<div class="col-sm-6 col-lg-4">
						<div class="card">
							<div class="card-img-actions m-1">
								<img class="card-img img-fluid" src="images/placeholder.jpg" alt="">
								<div class="card-img-actions-overlay card-img">
									<a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round legitRipple" data-popup="lightbox" rel="group">
										<i class="fa fa-trash-o" aria-hidden="true"></i>
									</a>


								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-4">
						<div class="card">
							<div class="card-img-actions m-1">
								<img class="card-img img-fluid" src="images/placeholder.jpg" alt="">
								<div class="card-img-actions-overlay card-img">
									<a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round legitRipple" data-popup="lightbox" rel="group">
										<i class="fa fa-trash-o" aria-hidden="true"></i>
									</a>


								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-4">
						<div class="card">
							<div class="card-img-actions m-1">
								<img class="card-img img-fluid" src="images/placeholder.jpg" alt="">
								<div class="card-img-actions-overlay card-img">
									<a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round legitRipple" data-popup="lightbox" rel="group">
										<i class="fa fa-trash-o" aria-hidden="true"></i>
									</a>


								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-4">
						<div class="card">
							<div class="card-img-actions m-1">
								<img class="card-img img-fluid" src="images/placeholder.jpg" alt="">
								<div class="card-img-actions-overlay card-img">
									<a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round legitRipple" data-popup="lightbox" rel="group">
										<i class="fa fa-trash-o" aria-hidden="true"></i>
									</a>


								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-4">
						<div class="card">
							<div class="card-img-actions m-1">
								<img class="card-img img-fluid" src="images/placeholder.jpg" alt="">
								<div class="card-img-actions-overlay card-img">
									<a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round legitRipple" data-popup="lightbox" rel="group">
										<i class="fa fa-trash-o" aria-hidden="true"></i>
									</a>


								</div>
							</div>
						</div>
					</div> -->
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

			<form name="imageglry" id="imageglry" enctype="multipart/form-data" target="acf" action="ac.de" method="post">
			<input type="file" name="sightseeingGallary[]" id="sightseeingGallary" onchange="form.submit('#imageglry');" multiple="multiple" style="display:none;" />
			<input type="hidden" name="sectionType" value="sightseeing"  />
			<input type="hidden" name="parentId" value="<?php echo encode($id); ?>"  />
			<input type="hidden" name="action" value="sightseeingGallary"  />
			</form>
			<script>

			function fundeleteimg(imgId){
				if (confirm("Are you sure?")) {
				 window.location.href='page.de?section=sightseeingMaster&view=yes&id=<?php echo $_GET['id']; ?>&deleteImgId='+imgId;
				}
				return false;
			}

			function funuploadgallary(){
				$('#sightseeingGallary').trigger('click');

			}
			</script>

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