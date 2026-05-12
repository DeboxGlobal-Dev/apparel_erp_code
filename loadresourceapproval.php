
<?php
include('inc.php');

$buyerId = clean($_REQUEST['buyerId']);
$brandId = clean($_REQUEST['brandId']);

if($_REQUEST['action']=='loadresourceapprowdata'){


if(clean($_REQUEST['addid'])=='1'){
	$namevalue = 'buyerId="'.$buyerId.'",brandId="'.$brandId.'"';
	$lastId = addlistinggetlastid('resourceApprovalBrandWise',$namevalue);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['delrowid']!=''){
	deleteRecord('resourceApprovalBrandWise','id="'.$_REQUEST['delrowid'].'"');
}


$select='';
$where='';
$rs='';
$select='*';
$where=' 1 and buyerId="'.$buyerId.'" and brandId="'.$brandId.'" order by id desc';
$rs=GetPageRecord($select,'resourceApprovalBrandWise',$where);
while($resListing=mysqli_fetch_array($rs)){

?>

<tr>
	<td align="center"><i class="fa fa-trash" style="font-size: 20px; color:#FF0000; cursor:pointer;" onclick="deleterowapproval('<?php echo $resListing['id']; ?>');" ></i></td>
	<td align="left">

	<select id="profileId<?php echo $resListing['id']; ?>" name="profileId" class="form-control " onChange="savedata<?php echo $resListing['id']; ?>();getUserList<?php echo $resListing['id']; ?>(this.value);" >
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
	<select id="pageIdApp<?php echo $resListing['id']; ?>" name="pageId" class="form-control " onChange="savedata<?php echo $resListing['id']; ?>();" >
		<option value="">Select</option>
		<option value="1" <?php if($resListing['pageId']==1){ echo "selected"; }?>>Pre Order Cost</option>
		<option value="2" <?php if($resListing['pageId']==2){ echo "selected"; }?>>Buyer Cost Sheet</option>
		<option value="3" <?php if($resListing['pageId']==3){ echo "selected"; }?>>BOM</option>
		<option value="4" <?php if($resListing['pageId']==4){ echo "selected"; }?>>TNA</option>
	  </select>
	</td>
	<td align="left">
	<select id="assignToApp<?php echo $resListing['id']; ?>" name="assignTo" class="form-control " onChange="savedata<?php echo $resListing['id']; ?>();">

	  </select>
	</td>
</tr>
<script src="js/jquery-1.12.4.js"></script>
<script src="global_assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="global_assets/js/demo_pages/form_select2.js"></script>
<script>
$(document).ready(function() {
	//$("#profileIdApp").select2();
	//$("#pageIdApp").select2();
	//$("#assignToApp").select2();

});
</script>
<script>
function savedata<?php echo $resListing['id']; ?>(){

	var assignTo = encodeURI($('#assignToApp<?php echo $resListing['id']; ?>').val());
	var profileId = encodeURI($('#profileId<?php echo $resListing['id']; ?>').val());
	var pageId = encodeURI($('#pageIdApp<?php echo $resListing['id']; ?>').val());

	$('#loadDivApp').load('newaction.php?action=resourceapproval&id=<?php echo $resListing['id']; ?>&assignTo='+assignTo+'&profileId='+profileId+'&pageId='+pageId);
}

function getUserList<?php echo $resListing['id']; ?>(id){
	var selectedId = encodeURI('<?php echo $resListing['assignTo']; ?>');
	$('#assignToApp<?php echo $resListing['id']; ?>').load('newaction.php?action=loaduserList&id='+id+'&selectedId='+selectedId);
}

getUserList<?php echo $resListing['id']; ?>('<?php echo $resListing['profileId']; ?>');
</script>
<tr id="loadDivApp" style="display:none;">
	<td>Loading...</td>
</tr>

<?
}

}

?>
