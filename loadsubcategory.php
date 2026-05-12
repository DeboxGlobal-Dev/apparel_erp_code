<?php
include "inc.php";
include "config/logincheck.php";

$categoryId=$_REQUEST['id'];
echo $selectId=$_REQUEST['selectId'];
?>

 <option value="">Select</option>
 <?php


$select='';
$where='';
$rs='';
$select='*';
if($categoryId!=''){
$categoryId=' and categoryId="'.$categoryId.'" ';
}
$where=' deletestatus=0 and status=1 '.$categoryId.' order by name asc';
$rs=GetPageRecord($select,_SUB_CATEGORY_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$selectId){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>

