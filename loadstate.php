<?php
include "inc.php";
include "config/logincheck.php";

$countryId=$_REQUEST['id'];
$selectId=$_REQUEST['selectId'];

?>
 <option value="">Select</option>
<?php
$select='';
$where='';
$rs='';
$select='*';

if($countryId!=''){
$countryId=' and countryId="'.$countryId.'" ';
}

$where=' deletestatus=0 and status=1 '.$countryId.' order by name asc';
$rs=GetPageRecord($select,_STATE_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$selectId){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>
<script>
<?php if($selectId!=''){ ?>
selectcity();
<?php } ?>
</script>