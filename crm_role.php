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



		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->

			<!-- /page header -->


			<!-- Content area -->
			<div class="content pt-0" style="margin-top:20px;">

				<!-- Dashboard content -->
				<div class="row">

				<?php include "left-setting.php"; ?>

					 <div class="col-xl-10">
				<div class="card" >
					 <div class="card-header header-elements-inline bg-info-700">
						<div class="col-xl-9"><h5 class="card-title"><?php echo $modfile['moduleName']; ?></h5></div>
						 <div class="col-xl-3" style="    padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">


   <a href="#" onclick="opmodalpop(' Add Role','modalpop.php?action=<?php echo $_GET['module']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Add Role</a>





							</div></div>
					</div>



					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll"><table width="100%" class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead>
							<tr role="row">

							  <th colspan="1" rowspan="1" align="left" class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_2" aria-sort="ascending" aria-label="First Name: activate to sort column descending">Profile Name</th>
							  		  <th colspan="1" rowspan="1" align="left" class="sorting" tabindex="0" aria-controls="DataTables_Table_2" aria-label="DOB: activate to sort column ascending">Profile Description</th>

							  <th rowspan="1" align="left" class="sorting" tabindex="0" aria-controls="DataTables_Table_2" aria-label="Last Name: activate to sort column ascending">Created By</th>
							  <th rowspan="1" align="left" class="sorting" tabindex="0" aria-controls="DataTables_Table_2" aria-label="Last Name: activate to sort column ascending">Modified By</th>


							  <th colspan="1" rowspan="1" align="left" class="sorting" style="display:none;" tabindex="0" aria-controls="DataTables_Table_2"></th>
							  <th colspan="1" rowspan="1" align="left" class="sorting" style="display:none;" tabindex="0" aria-controls="DataTables_Table_2"></th>
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
$rs=GetRecordList($select,_PROFILE_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){
  $corporate_id = $resultlists['id'];
?>

						<tr role="row" class="odd">
								<td align="left" class="sorting_1" tabindex="0"> <a href="#" onclick="opmodalpop(' Edit Profile','modalpop.php?action=<?php echo $_GET['module']; ?>&id=<?php echo encode($resultlists['id']); ?>','600px','auto');" data-toggle="modal" data-target="#modalpop"><?php echo $resultlists['profileName']; ?></a></td>




								<td width="30%" align="left"><?php echo $resultlists['profileDetails']; ?></td>

								<td align="left" class="">
								<?php $select2='';
								$where2='';
								$rs2='';
								$select2='firstName,lastName';
								$where2='id="'.$resultlists['userId'].'"';
								$rs2=GetPageRecord($select2,_USER_MASTER_,$where2);
								$userss=mysqli_fetch_array($rs2);
								echo $userss['firstName'].' '.$userss['lastName']; ?>
								 - <?php echo date('d/m/Y - h:i a',$resultlists['dateAdded']);?>								</td>
								<td align="left" class="">
								<?php $select2='';
								$where2='';
								$rs2='';
								$select2='firstName,lastName';
								$where2='id="'.$resultlists['userId'].'"';
								$rs2=GetPageRecord($select2,_USER_MASTER_,$where2);
								$userss=mysqli_fetch_array($rs2);
								echo $userss['firstName'].' '.$userss['lastName']; ?>
								 - <?php echo date('d/m/Y - h:i a',$resultlists['modifyDate']);?>								</td>


								<td align="left" class="text-left" style="display:none;"></td>
								<td align="left" class="text-left" style="display:none;"></td>
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
		<!-- /main content -->

	</div>

