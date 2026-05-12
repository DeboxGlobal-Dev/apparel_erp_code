<?php
if($_POST['siteName']!='' &&  $_POST['siteURL']!='' &&  $_POST['contactEmail']!=''){
$where='parentId="'.$_SESSION['userid'].'"';
$namevalue ='siteName="'.addslashes(trim($_POST['siteName'])).'",siteURL="'.addslashes(trim($_POST['siteURL'])).'",contactEmail="'.addslashes(trim($_POST['contactEmail'])).'",emailTo="'.addslashes(trim($_POST['emailTo'])).'"';
$update = updatelisting('userMaster',$namevalue,$where);
$updatepage='1';
}

$select1='*';
$where1='parentId='.$_SESSION['userid'].'';
$rs1=GetPageRecord($select1,'userMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
?>
	<div class="page-content">

		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><span class="font-weight-semibold">Chat Widget</span> -  Widget Settings</h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>


				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content pt-0">




				<!-- Dashboard content -->
				<div class="row">
				<div class="col-xl-6">
				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">
									<i class="icon-cog3 mr-2"></i>
									Property Settings
								</h6>
							</div>

						<form action="" method="post" enctype="multipart/form-data">

							<div class="card-body">
							<?php if($updatepage=='1'){ ?>
							<span class="badge d-block badge-info form-text text-center" style="margin-bottom: 20px; font-size: 12px; padding: 10px;">Successfully Updated</span>
							<?php } ?>
							<div class="form-group">
									<label>Site Name</label>
									<input name="siteName" type="text" class="form-control" id="siteName" value="<?php echo stripslashes($editresult['siteName']); ?>">
							  </div>

								<div class="form-group">
									<label>Site URL</label>
									<input name="siteURL" type="text" class="form-control" id="siteURL" value="<?php echo stripslashes($editresult['siteURL']); ?>">
								</div>

								<div class="form-group">
									<label>Email (Contact Form Mail To)</label>
									<input name="contactEmail" type="text" class="form-control" id="contactEmail" value="<?php echo stripslashes($editresult['contactEmail']); ?>">
								</div>

								<div class="form-group">
									<label>Email (Contact Form Mail From)</label>
									<input name="emailTo" type="text" class="form-control" id="emailTo" value="<?php echo stripslashes($editresult['emailTo']); ?>">
								</div>

								 <div class="text-right">
								<button type="submit" class="btn btn-primary">Save <i class="icon-paperplane ml-2"></i></button>
							</div>
							</div>

							</form>
						</div>


					</div>

					<div class="col-xl-6">
				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">
									<i class="icon-cog3 mr-2"></i>
									Channel
								</h6>
							</div>

							<div class="card-body">

								<div class="form-group">
									<label><i class="fa fa-code" aria-hidden="true"></i>  Widget Code (Paste this code in head)</label>
<textarea rows="3" class="form-control"><script type="text/javascript" src="<?php echo $fullurl; ?>js/wechat.js"></script></textarea>
								</div>

								<div class="form-group">
									<label><i class="fa fa-link" aria-hidden="true"></i>  Direct Chat Link</label>
                                    <input type="text" class="form-control" value="<?php echo $fullurl; ?>chatwidget.php">
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

