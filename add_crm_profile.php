<?php

if($addpermission!=1 && $_GET['id']==''){

header('location:'.$fullurl.'');

}



if($editpermission!=1 && $_GET['id']!=''){

header('location:'.$fullurl.'');

}







if($_GET['id']!=''){

 $id=clean(decode($_GET['id']));



$select1='*';

$where1='id='.$id.' and userId='.$loginusersuperParentId.'';

$rs1=GetPageRecord($select1,_PROFILE_MASTER_,$where1);

$editresult=mysqli_fetch_array($rs1);



$profileName=clean($editresult['profileName']);

$profileDetails=clean($editresult['profileDetails']);

$profileId=clean($editresult['id']);





if($editresult['deletestatus']==1){

header('location:'.$fullurl.'');

exit();

}



}







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




<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<input name="action" type="hidden" id="action" value="<?php echo clean($_GET['module']); ?>" />
<input name="savenew" type="hidden" id="savenew" value="0" />
<input name="editid" type="hidden" id="editid" value="<?php echo clean($_GET['id']); ?>" />

	<div class="card-body">
								<div class="form-group">
				<div class="row">

<?php

$select11='*';
$where11='id='.decode($_GET['id']).'';
$rs11=GetPageRecord($select11,_PROFILE_MASTER_,$where11);
$editresultprofile=mysqli_fetch_array($rs11);

?>

					<div class="col-md-3">
						<div class="form-group">
							<label>Profile Name</label>
							<input name="profileName" type="text" class="form-control" id="profileName" value="<?php echo $editresultprofile['profileName']; ?>" maxlength="200">
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label>Profile Description</label>
							<input name="profileDetails" type="text" class="form-control" id="profileDetails" value="<?php echo $editresultprofile['profileDetails']; ?>" maxlength="200">
						</div>
					</div>

					<div class="col-md-3" style="margin-top: 27px;">
					<button type="submit" class="btn btn-primary">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>

				</div>


				</div>
				  </div>


				</div>

</form>

					<div class="table-responsive">
						<?php if($profileId!=''){ ?>

<div class="innerbox">
      <h3 style="padding:20px 0px 10px 20px;">Permissions</h3>

    </div>

 <div class="datatable-scroll"><table width="100%" class="table table-bordered" id="" role="grid">



   <thead>


<style>

	 .fa-spin{font-size:24px;}

	 </style>

		<script>

		$(document).on('click', '#viewselectall', function(event) {

    event.preventDefault();

    $(".selectviewall").click();

	$('#viewselectall').html('<i class="fa fa-cog fa-spin"></i>');

	setTimeout(function(){

	window.location.href = 'showpage.crm?module=profile&edit=yes&id=<?php echo $_REQUEST['id']; ?>';



	 },12000);

});





$(document).on('click', '#addviewselectall', function(event) {

    event.preventDefault();

    $(".selectaddall").click();

	$('#addviewselectall').html('<i class="fa fa-cog fa-spin"></i>');

	setTimeout(function(){

	window.location.href = 'showpage.crm?module=profile&edit=yes&id=<?php echo $_REQUEST['id']; ?>';

	 },12000);

});



$(document).on('click', '#addeditselectall', function(event) {

    event.preventDefault();

    $(".selecteditall").click();

	$('#addeditselectall').html('<i class="fa fa-cog fa-spin"></i>');

	setTimeout(function(){

	window.location.href = 'showpage.crm?module=profile&edit=yes&id=<?php echo $_REQUEST['id']; ?>';

	 },12000);

});



$(document).on('click', '#adddeleteselectall', function(event) {

    event.preventDefault();

    $(".selectdeleteall").click();

	$('#adddeleteselectall').html('<i class="fa fa-cog fa-spin"></i>');

	setTimeout(function(){

	window.location.href = 'showpage.crm?module=profile&edit=yes&id=<?php echo $_REQUEST['id']; ?>';

	 },12000);

});







$(document).on('click', '#addimportselectall', function(event) {

    event.preventDefault();

    $(".selectimporteall").click();

	$('#addimportselectall').html('<i class="fa fa-cog fa-spin"></i>');

	setTimeout(function(){

	window.location.href = 'showpage.crm?module=profile&edit=yes&id=<?php echo $_REQUEST['id']; ?>';

	 },12000);

});







$(document).on('click', '#addexportselectall', function(event) {

    event.preventDefault();

    $(".selectexporteall").click();

	$('#addexportselectall').html('<i class="fa fa-cog fa-spin"></i>');

	setTimeout(function(){

	window.location.href = 'showpage.crm?module=profile&edit=yes&id=<?php echo $_REQUEST['id']; ?>';

	 },12000);

});



		</script>









	 <tr>

	 <th align="left" class="header"  >&nbsp;</th>

     <th align="left" class="header"><a href="#" id="viewselectall">Select All</a> </th>

     <th align="left" class="header"><a href="#" id="addviewselectall">Select All</a> </th>

     <th align="left" class="header"><a href="#" id="addeditselectall">Select All</a></th>

     <th align="left" class="header"><a href="#" id="adddeleteselectall">Select All</a></th>

     <th align="left" class="header" ><a href="#" id="addimportselectall">Select All</a></th>

     <th align="left" class="header" ><a href="#" id="addexportselectall">Select All</a></th>



     </tr>


   <tr>

     <th width="30%" align="left" class="header" >Module</th>

     <th width="10%" align="left" class="header">View</th>

     <th width="10%" align="left" class="header">Add</th>

     <th width="10%" align="left" class="header">Edit</th>

     <th width="10%" align="left" class="header">Delete</th>

     <th width="10%" align="left" class="header" >Import</th>

     <th width="10%" align="left" class="header" >Export</th>
     </tr>
   </thead>













  <tbody>

<?php

$n=1;

$select='*';

$where='parentId=0 order by parentId,id asc';

$rs=GetPageRecord($select,_MODULE_MASTER_,$where);

while($modulelist=mysqli_fetch_array($rs)){

$selecta='*';

$wherea='moduleId='.$modulelist['id'].' and profileId='.$profileId.'';

$rsa=GetPageRecord($selecta,_PERMISSION_MASTER_,$wherea);

$permissionlist=mysqli_fetch_array($rsa);

?>
  <tr <?php if($modulelist['parentId']=='0'){ ?> style="background: #6ce9ae36;" <?php } ?>>

  <td width="30%" align="left" valign="top"><?php echo $modulelist['moduleName']; ?></td>

    <td width="10%" align="left" valign="top"><div id="v<?php echo $n; ?>" onclick="userpermissiononoff('v<?php echo $n; ?>','<?php echo encode($modulelist['id']); ?>','view');" class="selectviewall switchouter <?php if($permissionlist['view']==1){ ?>switchouteron<?php } else { ?>switchouteroff<?php } ?>"></div></td>

    <td width="10%" align="left" valign="top"><div id="a<?php echo $n; ?>" onclick="userpermissiononoff('a<?php echo $n; ?>','<?php echo encode($modulelist['id']); ?>','addentry');" class="selectaddall switchouter <?php if($permissionlist['addentry']==1){ ?>switchouteron<?php } else { ?>switchouteroff<?php } ?>"></div></td>



    <td width="10%" align="left" valign="top"><div id="e<?php echo $n; ?>" onclick="userpermissiononoff('e<?php echo $n; ?>','<?php echo encode($modulelist['id']); ?>','edit');" class="selecteditall switchouter <?php if($permissionlist['edit']==1){ ?>switchouteron<?php } else { ?>switchouteroff<?php } ?>"></div></td>

    <td width="10%" align="left" valign="top"><div id="d<?php echo $n; ?>" onclick="userpermissiononoff('d<?php echo $n; ?>','<?php echo encode($modulelist['id']); ?>','dlt');" class="selectdeleteall switchouter <?php if($permissionlist['dlt']==1){ ?>switchouteron<?php } else { ?>switchouteroff<?php } ?>"></div></td>

    <td width="10%" align="left" valign="top"style="width:50px;"><div id="i<?php echo $n; ?>" onclick="userpermissiononoff('i<?php echo $n; ?>','<?php echo encode($modulelist['id']); ?>','import');" class="selectimporteall switchouter <?php if($permissionlist['import']==1){ ?>switchouteron<?php } else { ?>switchouteroff<?php } ?>"></div></td>

    <td width="10%" align="left" valign="top"style="width:50px;"><div id="ex<?php echo $n; ?>" onclick="userpermissiononoff('ex<?php echo $n; ?>','<?php echo encode($modulelist['id']); ?>','export');" class="selectexporteall switchouter <?php if($permissionlist['export']==1){ ?>switchouteron<?php } else { ?>switchouteroff<?php } ?>"></div></td>
   </tr>

   <!--show sub profile-->
<?php
$n++;

$select1='*';
$where1='parentId="'.$modulelist['id'].'" order by id asc';
$rs1=GetPageRecord($select1,_MODULE_MASTER_,$where1);
while($submodulelist=mysqli_fetch_array($rs1)){



$selectaa='*';
$whereaa='moduleId='.$submodulelist['id'].' and profileId='.$profileId.'';
$rsaa=GetPageRecord($selectaa,_PERMISSION_MASTER_,$whereaa);
$permissionlista=mysqli_fetch_array($rsaa);

//10746
?>
  <tr>
  <td width="30%" align="left" valign="top"><?php echo $submodulelist['moduleName']; ?></td>
    <td width="10%" align="left" valign="top"><div id="v<?php echo $n; ?>" onclick="userpermissiononoff('v<?php echo $n; ?>','<?php echo encode($submodulelist['id']); ?>','view');" class="selectviewall switchouter <?php if($permissionlista['view']==1){ ?>switchouteron<?php } else { ?>switchouteroff<?php } ?>"></div></td>
    <td width="10%" align="left" valign="top"><div id="a<?php echo $n; ?>" onclick="userpermissiononoff('a<?php echo $n; ?>','<?php echo encode($submodulelist['id']); ?>','addentry');" class="selectaddall switchouter <?php if($permissionlista['addentry']==1){ ?>switchouteron<?php } else { ?>switchouteroff<?php } ?>"></div></td>
    <td width="10%" align="left" valign="top"><div id="e<?php echo $n; ?>" onclick="userpermissiononoff('e<?php echo $n; ?>','<?php echo encode($submodulelist['id']); ?>','edit');" class="selecteditall switchouter <?php if($permissionlista['edit']==1){ ?>switchouteron<?php } else { ?>switchouteroff<?php } ?>"></div></td>
    <td width="10%" align="left" valign="top"><div id="d<?php echo $n; ?>" onclick="userpermissiononoff('d<?php echo $n; ?>','<?php echo encode($submodulelist['id']); ?>','dlt');" class="selectdeleteall switchouter <?php if($permissionlista['dlt']==1){ ?>switchouteron<?php } else { ?>switchouteroff<?php } ?>"></div></td>
    <td width="10%" align="left" valign="top"style="width:50px;"><div id="i<?php echo $n; ?>" onclick="userpermissiononoff('i<?php echo $n; ?>','<?php echo encode($submodulelist['id']); ?>','import');" class="selectimporteall switchouter <?php if($permissionlista['import']==1){ ?>switchouteron<?php } else { ?>switchouteroff<?php } ?>"></div></td>
    <td width="10%" align="left" valign="top"style="width:50px;"><div id="ex<?php echo $n; ?>" onclick="userpermissiononoff('ex<?php echo $n; ?>','<?php echo encode($submodulelist['id']); ?>','export');" class="selectexporteall switchouter <?php if($permissionlista['export']==1){ ?>switchouteron<?php } else { ?>switchouteroff<?php } ?>"></div></td>
   </tr>
  <?php

$n++;


$rs1a=GetPageRecord('*',_MODULE_MASTER_,'parentId="'.$submodulelist['id'].'" order by id asc');
while($submodulelista=mysqli_fetch_array($rs1a)){


$rsaa22=GetPageRecord('*',_PERMISSION_MASTER_,'moduleId='.$submodulelista['id'].' and profileId='.$profileId.'');
$permissionlistaa2=mysqli_fetch_array($rsaa22);
?>
<tr>
  <td width="30%" align="left" valign="top" ><span class="moduleId" style="display:none;"><?php echo $submodulelista['id']; ?></span><span class="moduleParentId" style="display:none;"><?php echo $submodulelista['parentId']; ?></span><?php echo $submodulelista['moduleName']; ?></td>
    <td width="10%" align="left" valign="top"><div id="v<?php echo $n; ?>" onclick="userpermissiononoff('v<?php echo $n; ?>','<?php echo encode($submodulelista['id']); ?>','view');" class="selectviewall switchouter <?php if($permissionlistaa2['view']==1){ ?>switchouteron<?php } else { ?>switchouteroff<?php } ?>"></div></td>
    <td width="10%" align="left" valign="top"><div id="a<?php echo $n; ?>" onclick="userpermissiononoff('a<?php echo $n; ?>','<?php echo encode($submodulelista['id']); ?>','addentry');" class="selectaddall switchouter <?php if($permissionlistaa2['addentry']==1){ ?>switchouteron<?php } else { ?>switchouteroff<?php } ?>"></div></td>
    <td width="10%" align="left" valign="top"><div id="e<?php echo $n; ?>" onclick="userpermissiononoff('e<?php echo $n; ?>','<?php echo encode($submodulelista['id']); ?>','edit');" class="selecteditall switchouter <?php if($permissionlistaa2['edit']==1){ ?>switchouteron<?php } else { ?>switchouteroff<?php } ?>"></div></td>
    <td width="10%" align="left" valign="top"><div id="d<?php echo $n; ?>" onclick="userpermissiononoff('d<?php echo $n; ?>','<?php echo encode($submodulelista['id']); ?>','dlt');" class="selectdeleteall switchouter <?php if($permissionlistaa2['dlt']==1){ ?>switchouteron<?php } else { ?>switchouteroff<?php } ?>"></div></td>
    <td width="10%" align="left" valign="top"style="width:50px;"><div id="i<?php echo $n; ?>" onclick="userpermissiononoff('i<?php echo $n; ?>','<?php echo encode($submodulelista['id']); ?>','import');" class="selectimporteall switchouter <?php if($permissionlistaa2['import']==1){ ?>switchouteron<?php } else { ?>switchouteroff<?php } ?>"></div></td>
    <td width="10%" align="left" valign="top"style="width:50px;"><div id="ex<?php echo $n; ?>" onclick="userpermissiononoff('ex<?php echo $n; ?>','<?php echo encode($submodulelista['id']); ?>','export');" class="selectexporteall switchouter <?php if($permissionlistaa2['export']==1){ ?>switchouteron<?php } else { ?>switchouteroff<?php } ?>"></div></td>
   </tr>

<?php
$n++;
}

} ?>

	<?php } ?>
</tbody></table>


	</div>

	<?php } ?>



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
		<!-- /main content -->

	</div>

	<style>
	.switchouteron {
    background-image: url(images/onswitch.png);
}

.switchouteroff {
    background-image: url(images/offswitch.png);
}
	.switchouter {
    width: 44px;
    height: 21px;
    background-repeat: no-repeat;
    float: left;
    cursor: pointer;
}

.switchouter {
    width: 44px;
    height: 21px;
    background-repeat: no-repeat;
    float: left;
    cursor: pointer;
}
	</style>
 <script>




function userpermissiononoff(id,modid,pagepermission){
var editid = $('#editid').val();
$('#actiondiv').load('allaction.php?action=profilepermission&editid='+editid+'&moduleId='+modid+'&pagepermission='+pagepermission+'&btnid='+id);

}



 </script>
 <div id="actiondiv" style="display:none;"></div>