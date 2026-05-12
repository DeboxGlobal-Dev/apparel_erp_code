<?php
if($_POST['firstName']!=''){
$where='id="'.$_SESSION['userid'].'"';
$namevalue ='firstName="'.addslashes(trim($_POST['firstName'])).'",lastName="'.addslashes(trim($_POST['lastName'])).'",phone="'.addslashes(trim($_POST['phone'])).'"';
$update = updatelisting('userMaster',$namevalue,$where);
$updatepage='1';
}

$select1='*';
$where1='id='.$_SESSION['userid'].'';
$rs1=GetPageRecord($select1,'userMaster',$where1);
$editresult=mysqli_fetch_array($rs1);


if($_POST['oldpassword']!='' && $_POST['newpassword']!='' && $_POST['confirmpassword']!=''){

if(md5($_POST['oldpassword'])!=$editresult['password']){
?>
<script>
alert('The old password you have entered is incorrect');
window.location.href = "page.de?section=myprofile";
</script>
<?php
exit();
}

if($_POST['newpassword']!=$_POST['confirmpassword']){
?>
<script>
alert('Your password and confirmation password do not match');
window.location.href = "page.de?section=myprofile";

</script>
<?php
exit();
}


$where='id="'.$_SESSION['userid'].'"';
$namevalue ='password="'.md5(addslashes(trim($_POST['newpassword']))).'"';
$update = updatelisting('userMaster',$namevalue,$where);
$updatepage='1';

?>



<?php







?>
<script>
alert('Password reset successfully');
window.location.href = "page.de?section=myprofile";
</script>
<?php
}




$select1='*';
$where1='id='.$_SESSION['userid'].'';
$rs1=GetPageRecord($select1,_USER_MASTER_,$where1);
$editresult=mysqli_fetch_array($rs1);

$editUserId=clean($editresult['id']);
$editComapnyanme=clean($editresult['company']);
$editEmail=clean($editresult['email']);
$edituserName=clean($editresult['userName']);
$editPhone=clean($editresult['phone']);
$editPassword=clean($editresult['password']);
$editMobile=clean($editresult['mobile']);
$editStreet=clean($editresult['street']);
$editCity=clean($editresult['city']);
$editState=clean($editresult['state']);
$editZip=clean($editresult['zip']);
$editCountry=clean($editresult['country']);
$editNoofusers=clean($editresult['noofusers']);
$editServerspace=clean($editresult['serverspace']);
$editExpireDate=$editresult['expiryDate'];
$timeFormat=clean($editresult['timeFormat']);
$editCurrency=clean($editresult['currency']);
$editTimezone=clean($editresult['timeZone']);
$modifyBy=clean($editresult['modifyBy']);
$modifyDate=clean($editresult['modifyDate']);
$dateAdded=clean($editresult['dateAdded']);
$addedBy=clean($editresult['addedBy']);
$accountId=clean($editresult['accountId']);
$editfirstName=clean($editresult['firstName']);
$editlastName=clean($editresult['lastName']);
$editfullname=$editfirstName.' '.$editlastName;
$accountId=clean($editresult['accountId']);
$editroleId=clean($editresult['roleId']);
$editprofileId=clean($editresult['profileId']);
$loginuserprofilePhoto=clean($editresult['profilePhoto']);
$editcurrency=clean($editresult['currency']);
$edittimeZone=clean($editresult['timeZone']);
?>
	<div class="page-content">

		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">



			<!-- Content area -->
			<div class="content pt-0" style="margin-top:20px;">




				<!-- Dashboard content -->
				<div class="row">

				<div class="col-xl-3">
				<div class="card">
								<div class="card-body text-center">
									<div class="card-img-actions d-inline-block mb-3" style="height:170px; width:170px;">
										<img class="img-fluid rounded-circle" src="<?php if($loginuserprofilePhoto!=''){ ?>profilepic/<?php echo $loginuserprofilePhoto; ?><?php } else { ?>images/user.png<?php } ?>" width="170" height="170" alt="">
										<div class="card-img-actions-overlay card-img rounded-circle">


											<form action="ac.crm" method="post" enctype="multipart/form-data" name="actoinfrm" target="acf" id="addeditfrm">
		  <input name="changeprofilepic[]" type="file" id="changeprofilepic" accept="image/x-png,image/gif,image/jpeg" onchange="$('#addeditfrm').submit();" style="width:100%; height:100%; position:absolute; left:0px; top:0px;opacity: 0; filter: alpha(opacity=0); cursor:pointer; "/><input name="action" type="hidden" id="action" value="profilepic" />
		  <div style="width:100px; height:100px; overflow:hidden;border-radius: 100%;"><img src="<?php if($loginuserprofilePhoto!=''){ ?>profilepic/<?php echo $loginuserprofilePhoto; ?><?php } else { ?>images/user.png<?php } ?>" width="100%" /></div><div style="text-align:center; font-size:11px; margin-top:2px;"><a  >Change</a></div>

		  </form>

										</div>
								  </div>

						    		<h6 class="font-weight-semibold mb-0"><?php echo $editfullname; ?></h6>
						    		<span class="d-block text-muted"><?php
$select='profileName';
$where='id="'.$editprofileId.'"';
$rs=GetPageRecord($select,_PROFILE_MASTER_,$where);
$res=mysqli_fetch_array($rs);
echo strip($res['profileName']);
?></span>


						    	</div>
					    	</div>
				</div>




				<div class="col-xl-9">
				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">

									<i class="fa fa-user" aria-hidden="true"></i>  &nbsp;&nbsp;&nbsp;My Profile
								<a href="file:///E|/imran works/Dinesh Work/New Woodland/.htaccess"></a></h6>
							</div>

						<form action="" method="post" enctype="multipart/form-data">

							<div class="card-body">
							<?php if($updatepage=='1'){ ?>
							<span class="badge d-block badge-info form-text text-center" style="margin-bottom: 20px; font-size: 12px; padding: 10px;">Successfully Updated</span>
							<?php } ?>
							<div class="form-group">

							<div class="row">


										<div class="col-md-3">
											<div class="form-group">
												<label>First Name</label>
				                                <input name="firstName" type="text" class="form-control" id="firstName" value="<?php echo stripslashes($editfirstName); ?>"   maxlength="200">
			                                </div>
										</div>

										 	<div class="col-md-3">
											<div class="form-group">
												<label>Last Name</label>
				                                <input name="lastName" type="text" class="form-control" id="lastName" value="<?php echo stripslashes($editlastName); ?>"   maxlength="200">
			                                </div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label>Username</label>
				                                <input readonly="readonly"  type="text" class="form-control"  value="<?php echo stripslashes($editEmail); ?>"   maxlength="200">
			                                </div>
										</div>



										<div class="col-md-3">
											<div class="form-group">
												<label>Email</label>
				                                <input readonly="readonly"  type="text" class="form-control" value="<?php echo stripslashes($edituserName); ?>"   maxlength="200">
			                                </div>
										</div>

									</div>



								<div class="row" style="margin-top:20px;">



												<div class="col-md-3">
											<div class="form-group">
												<label>Phone</label>
				                                <input name="phone" type="text" class="form-control" id="phone" value="<?php echo stripslashes($editPhone); ?>"   maxlength="200">
			                                </div>
										</div>



										 	<div class="col-md-3" style="display:none;">
											<div class="form-group">
												<label>Role</label>
				                                <input name="role" type="text" readonly="readonly" class="form-control" id="role" value="<?php
$select1='name';
$where1='id="'.$editroleId.'"';
$rs1=GetPageRecord($select1,'roleMaster',$where1);
$res=mysqli_fetch_array($rs1);
echo strip($res['name']);
?>"   maxlength="200">
			                                </div>
										</div>

										<div class="col-md-3" >
											<div class="form-group">
												<label>Profile</label>
				                                <input name="profile" type="text" readonly="readonly" class="form-control" id="profile" value="<?php
$select1='profileName';
$where1='id="'.$editprofileId.'"';
$rs1=GetPageRecord($select1,'profileMaster',$where1);
$res=mysqli_fetch_array($rs1);
echo strip($res['profileName']);
?>"   maxlength="200">
			                                </div>
										</div>

										<div class="col-md-3" style="display:none;">
											<div class="form-group">
												<label>User Type</label>
				                                <input name="userType" type="text" readonly="readonly" class="form-control" id="userType" value="<?php if('0'==$editresult['userType']){ ?>Sales Person<?php } ?><?php if('1'==$resultlists['userType']){ ?>Operations Person<?php } ?> "   maxlength="200">
			                                </div>
										</div>


										<div class="col-md-3">
											<div class="form-group">
												<label>Date Modified</label>
				                                <input name="datem" type="text" readonly="readonly"  class="form-control" id="datem" value="<?php echo date('d/m/Y - h:i a',$editresult['dateAdded']);?>"   maxlength="200">
			                                </div>
										</div>
									</div>

							  </div>









								 <div class="text-right">
								<button type="submit" class="btn btn-primary">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>
							</div>
							</div>

							</form>
						</div>

<div class="card-group-control card-group-control-right">
<div class="card mb-2">
								<div class="card-header">
									<h6 class="card-title">
										<a class="text-default collapsed" data-toggle="collapse" href="#question4" aria-expanded="false">
												<i class="icon-cog3 mr-2"></i> &nbsp;Change Password
										</a>
									</h6>
								</div>

								<div id="question4" class="collapse" style="">
						<form action="" method="post" enctype="multipart/form-data"><div class="card-body">

							<div class="row" >




										 	<div class="col-md-3">
											<div class="form-group">
												<label>Old Password</label>
				                                <input name="oldpassword" type="password" class="form-control" id="firstName" value="">
			                                </div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label>New Password</label>
				                                <input name="newpassword" type="password" class="form-control" id="firstName" value="">
			                                </div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label>Confirm Password</label>
				                                <input name="confirmpassword" type="password" class="form-control" id="firstName" value="">
			                                </div>
										</div>

										<div class="col-md-3">
											<div class="form-group">

				                                <button type="submit" class="btn btn-primary" style="    margin-top: 28px;">Update Password<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>
			                                </div>
										</div>

									</div>







							</div></form>


					</div>


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

