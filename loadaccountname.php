<?php
include "inc.php";
include "config/logincheck.php";

$id=$_REQUEST['id'];
$accountname=$_REQUEST['accountname'];
$type=$_REQUEST['type'];
?>

<option value="">Select</option>
<?php
if($id!=''){
$companyQuery=' and companyid="'.$id.'" ';
}

if($type=='cashbook'){
$typeQuery=' and type="cashinhand"';
}elseif($type=='bankbook'){
$typeQuery=' and type="bankaccounts"';
} else{
$typeQuery=' and gl=1';
}

								$rs=GetPageRecord('*','finalheadcreationmaster','1 '.$companyQuery.' '.$typeQuery.' order by label asc');
								while($resListing1=mysqli_fetch_array($rs)){
								?>
<option value="<?php echo $resListing1['id']; ?>" <?php if($resListing1['id']==$accountname){ ?> selected="selected" <?php } ?>><?php echo $resListing1['label']; ?></option>
<?php } ?>
