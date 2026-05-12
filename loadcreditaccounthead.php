<?php
include "inc.php";
include "config/logincheck.php";

$id=$_REQUEST['id'];
$creacid=$_REQUEST['creacid'];
?>

<option value="">Select</option>
<?php
if($id!=''){
$companyQuery=' and companyid="'.$id.'" ';
}
								$rs=GetPageRecord('*','finalheadcreationmaster','1 '.$companyQuery.' and (type="cashinhand" or type="bankaccounts") order by label asc');
								while($resListing1=mysqli_fetch_array($rs)){
								?>
<option value="<?php echo $resListing1['id']; ?>" <?php if($resListing1['id']==$creacid){ ?> selected="selected" <?php } ?>><?php echo $resListing1['label']; ?></option>
<?php } ?>
