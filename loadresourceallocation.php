<?php
include('inc.php');

$buyerId = clean($_REQUEST['buyerId']);
$brandId = clean($_REQUEST['brandId']);

if($_REQUEST['action']=='loadresourceallrowdata'){


if(clean($_REQUEST['addid'])=='1'){
	$namevalue = 'buyerId="'.$buyerId.'",brandId="'.$brandId.'"';
	$lastId = addlistinggetlastid('resourceAllocationBrandWise',$namevalue);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['delrowid']!=''){
	deleteRecord('resourceAllocationBrandWise','id="'.$_REQUEST['delrowid'].'"');
}


$select='';
$where='';
$rs='';
$select='*';
$where=' 1 and buyerId="'.$buyerId.'" and brandId="'.$brandId.'" order by id desc';
$rs=GetPageRecord($select,'resourceAllocationBrandWise',$where);
while($resListing=mysqli_fetch_array($rs)){

?>

<tr>
	<td align="center"><i class="fa fa-trash" style="font-size: 20px; color:#FF0000; cursor:pointer;" onclick="deleterow('<?php echo $resListing['id']; ?>');" ></i></td>
	<td align="left">

	<select id="profileId<?php echo $resListing['id']; ?>" name="profileId" class="form-control select2" onChange="savedata<?php echo $resListing['id']; ?>();getUserList<?php echo $resListing['id']; ?>(this.value);" >
		<option value="">Select</option>
		<?php
		$rsProfile=GetPageRecord('id,profileName',_PROFILE_MASTER_,' 1 and deletestatus=0 and id not in (1) order by dateAdded desc');
		while($rsUserProfile=mysqli_fetch_array($rsProfile)){
		?>
		<option value="<?php echo $rsUserProfile['id']; ?>" <?php if($rsUserProfile['id'] == $resListing['profileId']){ echo 'selected="selected"'; } ?>><?php echo $rsUserProfile['profileName']; ?></option>
		<?php } ?>
	  </select>
	</td>
	<td align="left">
	<select id="assignTo<?php echo $resListing['id']; ?>" name="assignTo[]" class="form-control select2" multiple="multiple" onChange="savedata<?php echo $resListing['id']; ?>();">

	  </select>
	</td>
</tr>
<script src="js/jquery-1.12.4.js"></script>
<script src="global_assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="global_assets/js/demo_pages/form_select2.js"></script>
<script>
$(document).ready(function() {
	//$("#profileId").select2();
	//$("#assignTo").select2();
	$(".select2").select2();
});
</script>
<script>
function savedata<?php echo $resListing['id']; ?>(){

	var assignTo = encodeURI($('#assignTo<?php echo $resListing['id']; ?>').val());
	var profileId = encodeURI($('#profileId<?php echo $resListing['id']; ?>').val());

	$('#loadDiv').load('newaction.php?action=resourceallocation&id=<?php echo $resListing['id']; ?>&assignTo='+assignTo+'&profileId='+profileId);
}

function getUserList<?php echo $resListing['id']; ?>(id){
	var selectedId = encodeURI('<?php echo $resListing['assignTo']; ?>');
	$('#assignTo<?php echo $resListing['id']; ?>').load('newaction.php?action=loaduserList&id='+id+'&selectedId='+selectedId);
}

getUserList<?php echo $resListing['id']; ?>('<?php echo $resListing['profileId']; ?>');
</script>
<tr id="loadDiv" style="display:none;">
	<td>Loading...</td>
</tr>

<?
}

}

?>
