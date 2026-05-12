<?php
include "inc.php";
include "config/logincheck.php";

$factoryId=$_REQUEST['id'];
$selectId=$_REQUEST['selectId'];
$select='';
$where='';
$rs='';
$select='*';
$where='1 and factoryId="'.$factoryId.'" and status=1 order by id asc';
$rs=GetPageRecord($select,'factoryLineMaster',$where);
?>
<option value="">Select Line</option>
<?php
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$selectId){ ?> selected="selected" <?php } ?>><?php echo strip($resListing['lineName']); ?></option>
<?php } ?>

