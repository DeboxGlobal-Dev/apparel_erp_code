<?php
ob_start();
include "inc.php";
include "config/logincheck.php";

?>


 <?php

 if($_REQUEST['clientType']=='1'){
$select='';
$where='';
$rs='';
$select='*';
$where=' name!=""';
$rs=GetPageRecord($select,'accountsMaster',$where);
while($resListing=mysqli_fetch_array($rs)){

?>
<option value="<?php echo strip($resListing['id']); ?>"><?php echo strip($resListing['name']); ?></option>
<?php } } else {

$select='';
$where='';
$rs='';
$select='*';
$where=' firstName!=""';
$rs=GetPageRecord($select,'contactsMaster',$where);
while($resListing=mysqli_fetch_array($rs)){

?>
<option value="<?php echo strip($resListing['id']); ?>"><?php echo strip($resListing['firstName']); ?> <?php echo strip($resListing['lastName']); ?></option>
<?php } } ?>