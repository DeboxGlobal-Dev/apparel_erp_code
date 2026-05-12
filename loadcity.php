<?php
include "inc.php";
include "config/logincheck.php";

$stateId=$_REQUEST['id'];
$selectId=$_REQUEST['selectId'];
?>

 <option value="">Select</option>
 <?php
$select='';
$where='';
$rs='';
$select='*';
if($stateId!=''){
$stateId=' and stateId="'.$stateId.'"';
}
$where=' deletestatus=0 and status=1 '.$stateId.' order by name asc';
$rs=GetPageRecord($select,_CITY_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$selectId){ ?> selected="selected" <?php } ?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>

