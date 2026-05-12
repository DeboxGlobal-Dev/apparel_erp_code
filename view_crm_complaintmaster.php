<?php
$select='*';
$id=clean(decode($_GET['id']));
$where='id="'.$id.'"';
$rs=GetPageRecord($select,_COMPLAINT_MASTER_,$where);
$resultpage=mysqli_fetch_array($rs);


?>

<div class="page-content">

		<!-- Main sidebar -->

		<div class="content-wrapper">

			<div class="content pt-0" style="margin-top:20px;">


				 <div class="content">

				<div class="card border-left-3 border-left-">
				 	<div class="card-body navbar-green">
						<div class="media">
								 <div class="col-xl-6">
								<h6 class="media-title font-weight-semibold" style="    margin-top: 8px;">Complaint Id: <span style="font-weight:500; font-size:16px;"><?php echo makeQueryId($resultpage['id']); ?></span></h6>
								</div>

								<div class="col-xl-6" style="text-align:right;">
								<div class="d-flex align-items-center" style="float:right;margin-right:0px;">
		                    	<a href="showpage.crm?module=complaintmaster"><button type="button" class="btn bg-orange-400 btn-labeled btn-labeled-right ml-auto"><b><i class="fa fa-arrow-left" aria-hidden="true" style="    font-size: 17px;"></i></b>Back</button></a>
		                    	</div>

								</div>

						</div>
					</div>
				</div>


				<!-- Timeline -->

				<?php
				$select='';
				$where='';
				$rs='';
				$select='*';
				$where='complaintId="'.$resultpage['id'].'" order by id desc';
				$rs=GetPageRecord($select,_COMPLAINT_REMARK_MASTER_,$where);
				while($resultpagelist=mysqli_fetch_array($rs)){
				?>
				<div class="timeline timeline-right">
					<div class="timeline-container">


						<div class="timeline-row">
							<div class="timeline-icon">
								<div class="bg-info-400">
									<i class="icon-comment"></i>
								</div>
							</div>
							<div class="row">
<?php
if($resultpagelist["status"]=='1'){
$class="danger";
}
if($resultpagelist["status"]=='2'){
$class="primary";
}
if($resultpagelist["status"]=='3'){
$class="success";
}
?>

								<div class="col-lg-12">
									<div class="card border-left-3 border-left-<?php echo $class; ?> rounded-left-0">
										<div class="card-body">
											<div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
												<div>
													<p class="mb-3"><?php echo $resultpagelist['description']; ?></p>
												</div>

												<ul class="list list-unstyled mb-0 mt-3 mt-sm-0 ml-auto">
													<li><span class="text-muted"><?php echo date('d M, Y',$resultpagelist['dateAdded']); ?></span></li>

													<li class="dropdown">
								                		Status: &nbsp;
														<?php if($resultpagelist['status']=='1'){?><span class="badge bg-danger-400 badge-pill">Open</span> <?php }?> <?php if($resultpagelist['status']=='2'){?><span class="badge bg-primary-400 badge-pill">Resolved</span> <?php }?> <?php if($resultpagelist['status']=='3'){?><span class="badge bg-success-400 badge-pill">Closed</span> <?php }?>

													</li>
												</ul>
											</div>
										</div>

										<div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
											<span></span>

											<ul class="list-inline mb-0 mt-2 mt-sm-0">
											<li class="list-inline-item dropdown">
													<span>Submit By: <span class="font-weight-semibold"><?php echo getUserName($resultpagelist['addedBy']); ?></span></span>

												</li>

											</ul>
										</div>
									</div>
								</div>


							</div>
						</div>
						<?php } ?>

						<!-- Tasks -->
						<div class="timeline-row">
							<div class="timeline-icon">
								<div class="bg-info-400">
									<i class="icon-comment"></i>
								</div>
							</div>
							<div class="row">


								<div class="col-lg-12">
									<div class="card border-left-3 border-left-danger rounded-left-0">
										<div class="card-body">
											<div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
												<div>
													<h6 class=""><a href="#"><?php echo $resultpage['subject']; ?></a></h6>
													<p class="mb-3"><?php echo $resultpage['description']; ?></p>
												</div>

												<ul class="list list-unstyled mb-0 mt-3 mt-sm-0 ml-auto">
													<li><span class="text-muted"></span></li>
													<li class="dropdown">
								                	<li><span class="text-muted"><?php echo date('d M, Y',strtotime($resultpage['complaintDate'])); ?></span></li>
													</li>
													<li class="dropdown">
								                		Status: &nbsp;
														<?php if($resultpage['status']=='1'){?><span class="badge bg-danger-400 badge-pill">Open</span> <?php }?> <?php if($resultpage['status']=='2'){?><span class="badge bg-primary-400 badge-pill">Resolved</span> <?php }?> <?php if($resultpage['status']=='3'){?><span class="badge bg-closed-400 badge-pill">Open</span> <?php }?>

													</li>

												</ul>
											</div>
										</div>

										<div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
											<span><span class="badge badge-mark border-danger mr-2"></span>Style Id#<span class="font-weight-semibold"></span></span>

											<ul class="list-inline mb-0 mt-2 mt-sm-0">
											<li class="list-inline-item dropdown">
											Priority: &nbsp;
														<?php if($resultpage['priority']=='2'){?><span class="badge badge-danger">High</span> <?php }else{ ?> <span class="badge badge-primary">Normal</span><?php } ?>
											</li>
											<li class="list-inline-item dropdown">
													<span>Raised By: <span class="font-weight-semibold"><?php echo getUserName($resultpage['addedBy']); ?></span></span>

												</li>
												<li class="list-inline-item dropdown">
													<span>Assign To: <span class="font-weight-semibold"><?php echo getUserName($resultpage['assignTo']); ?></span></span>

												</li>
											</ul>
										</div>
									</div>
								</div>


							</div>
						</div>
						<!-- /tasks -->
					<?php
					$select='';
					$where='';
					$rs='';
					$select='*';
					$where='complaintId='.$resultpage['id'].' order by id desc';
					$rs=GetPageRecord($select,_COMPLAINT_REMARK_MASTER_,$where);
					$resultpagecomp=mysqli_fetch_array($rs);
					if($resultpagecomp['status']!='3'){
					?>
						<div class="timeline-row">
							<div class="timeline-icon">
								<div class="bg-info-400">
									<i class="icon-comment"></i>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="card border-left-3 border-left-danger rounded-left-0">
									<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
										<div class="card-body">
											<div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
												<textarea name="description" id="description" class="form-control" rows="3" cols="1" placeholder="Enter your message..."></textarea>
											</div>
										</div>

										<div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
											<span>&nbsp;<span class="font-weight-semibold">&nbsp;</span></span>

											<ul class="list-inline mb-0 mt-2 mt-sm-0">
												<li class="list-inline-item dropdown" style="display:none;" id="feedback">
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input type="radio" name="feedback" class="form-check-input" name="radio-unstyled-inline-left" value="1" checked="">
														<i class="fa fa-smile-o mr-2 text-success-400" style="font-size: 24px;"></i>
													</label>
												</div>
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input type="radio" name="feedback" class="form-check-input" name="radio-unstyled-inline-left" value="2">
														<i class="fa fa-meh-o mr-1 text-primary-400" style="font-size: 24px;"></i>
													</label>
												</div>
												<div class="form-check form-check-inline">
													<label class="form-check-label">
														<input type="radio" name="feedback" class="form-check-input" name="radio-unstyled-inline-left" value="3">
														<i class="fa fa-frown-o mr-1 text-danger-400" style="font-size: 28px;"></i>
													</label>
												</div>
												</li>
												<li class="list-inline-item dropdown">
													<select name="status" id="status" class="form-control" onchange="showfeedback();">
															<option value="1">Open</option>
															<option value="2">Resolve</option>
															<option value="3">Close</option>
														</select>
												</li>
												<li class="list-inline-item dropdown">
													<button type="submit" class="btn bg-teal-400 btn-labeled  ml-auto">Submit</button>
												</li>
											</ul>
										</div>
										<input type="hidden" name="action" value="complaintremark"/>
										<input type="hidden" name="complaintId" value="<?php echo $resultpage['id']; ?>"/>

										</form>
									</div>
								</div>


							</div>
						</div>
					<?php } ?>

					</div>
			    </div>
			    <!-- /timeline -->

			</div>


				</div>
				<!-- /dashboard content -->
			</div>
			</div>
			<!-- /content area -->


			<!-- Footer -->

			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
 <script>
  function showfeedback(){
	 var status = $('#status').val();

	 if(status == 2){
	 	$("#feedback").show();
	 }
	 if(status == 1 || status == 3){
	 	$("#feedback").hide();
	 }
  }
  </script>
 <style>
 .liststyleimg{float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}

	.badge.dropdown-toggle:after { display:none;
}

.btn-float i {
    display: block;
    top: 0;
    font-size: 20px;
}

.card-group-control-right .card-body{width:100%;}
 </style>

 <script>
 function funloadbuyercommunication(){

 $('#loadbuyercommunication').load('loadbuyercommunication.php?id=<?php echo decode($_REQUEST['id']); ?>');
 }

 $(document).ready(function() {
  funloadbuyercommunication();
  });
 </script>