<?php
if($_REQUEST['did']!=''){
$sql_del="delete from "._EMAIL_SETTING_MASTER_."  where id='".decode($_REQUEST['did'])."' and  id!=1 ";
mysql_query($sql_del) or die(mysql_error());
header('location:page.de?section=emailsetting&alt=3');
}
?>

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


				<div class="col-xl-9"style="margin-top: 20px;">

					 <div class="card-header header-elements-inline bg-info-700">
						<div class="col-xl-9"><h5 class="card-title"><?php echo $modfile['moduleName']; ?></h5></div>
						 <div class="col-xl-3" style="    padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">
 <a href="#"  class="btn bg-teal-400"  aria-expanded="false"  style="    background-color: #03d873b8;" data-toggle="modal" data-target="#modalpop" onclick="opmodalpop('Configure New Email','modalpop.php?action=addemailaccount','600px','auto');"><i class="fa fa-plus"  ></i> Configure New Email</a>





							</div></div>
					</div>



					 <div class="row" style="margin-top:20px;">
						<?php
$select='';
$where='';
$rs='';
$select='*';
$where='1 order by id asc';
$rs=GetPageRecord($select,_EMAIL_SETTING_MASTER_,$where);
while($rest=mysqli_fetch_array($rs)){
?>		<div class="col-lg-6">
								<div class="card border-left-3 border-left-danger rounded-left-0">
									<div class="card-body">
										<div class="d-sm-flex align-item-sm-center flex-sm-nowrap">


											<div>
												<h6 class="font-weight-semibold"><?php echo $rest['from_name']; ?></h6>
												<ul class="list list-unstyled mb-0">
													<li>Email: <?php echo $rest['email']; ?></li>
													<li>SMTP: <?php echo $rest['smtp_server']; ?></li>
												</ul>
											</div>

										<div class="text-sm-right mb-0 mt-3 mt-sm-0 ml-auto">
												<h6 class="font-weight-semibold">&nbsp;</h6>
												<ul class="list list-unstyled mb-0">
													<li>Outgoing Port: <span class="font-weight-semibold"><?php echo $rest['port']; ?></span></li>
													<li>Incoming Port: <span class="font-weight-semibold"><?php echo $rest['incomingPort']; ?></span></li>

												</ul>
											</div>
										</div>
									</div>

									<div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
										<span>
											<span class="badge badge-mark border-danger mr-2"></span>
											Date Modified:
											<span class="font-weight-semibold"><?php echo date('d/m/Y',$rest['dateAdded']); ?></span>
										</span>

										<ul class="list-inline list-inline-condensed mb-0 mt-2 mt-sm-0">

											<li class="list-inline-item dropdown">
												<a href="#" class="text-default dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>

												<div class="dropdown-menu dropdown-menu-right">
													<a href="#" class="dropdown-item" data-toggle="modal" data-target="#modalpop"   onclick="opmodalpop('Change Email Setting','modalpop.php?action=addemailaccount&id=<?php echo $rest['id']; ?>','600px','auto');"><i class="fa fa-pencil" aria-hidden="true"></i> Change Setting</a>

													<?php if($rest['id']!='1'){ ?>
													<a onclick="return confirm('Are you sure you want to delete this email setting?')" href="page.de?section=emailsetting&did=<?php echo encode($rest['id']); ?>" class="dropdown-item"  ><i class="fa fa-trash" aria-hidden="true"></i> Delete This Email</a>
													<?php } ?>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>

						<?php } ?>
						</div>



					</div>

					 <div class="col-xl-3">

							<div class="card"  style="margin-top:20px;"  >
							<div class="card-header header-elements-inline" style="text-align:center;">
								<h6 class="card-title" style="text-align:center; margin:auto;">Configure Email</h6>

							</div>

							 <div class="card-body"style="text-align:center;">
							 Connect your email inbox with <?php echo $systemname; ?> and transform
							 the way you do sales.							 </div>

							 <div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center" style=" background-color:#fff;    height: auto;    display: block !important;  flex: inherit;">

							<div style="text-align:center; margin-bottom:20px; width:100%; min-width: 100%;"><img src="images/emailsetting1.PNG" /><br />
							Access your customer emails with holistic CRM information</div>

							 	<div style="text-align:center; margin-bottom:20px; width:100%; min-width: 100%;"><img src="images/emailsetting2.PNG" /><br />
							Access your customer emails with holistic CRM information</div>

							 <div style="text-align:center; margin-bottom:20px; width:100%; min-width: 100%;"><img src="images/emailsetting3.PNG" /><br />
							Synchronize your email inbox with <?php echo $systemname; ?></div>

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
