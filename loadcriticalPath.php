<?php
include "inc.php";
include "config/logincheck.php";

$id=$_REQUEST['id'];
$selectId=$_REQUEST['selectId'];

?>
<option value="">Select</option>
	 <?php
	$rs=GetPageRecord('*','taskListMaster','1 and name!="" and tnatemplate="'.$id.'" order by id asc');
    while($resListing=mysqli_fetch_array($rs)){
	?>
	<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$selectId){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
	<?php } ?>