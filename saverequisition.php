<?php
include('inc.php');
if($_REQUEST['action']=='saverequisition'){

$id=clean($_REQUEST['id']); 
$requestedQty=clean($_REQUEST['requestedQty']); 
$issuedQty=clean($_REQUEST['issuedQty']); 
$requisitionRemark=clean($_REQUEST['requisitionRemark']); 
$namevalue ='requestedQty="'.$requestedQty.'",issuedQty="'.$issuedQty.'",requisitionRemark="'.$requisitionRemark.'"'; 
$where='id="'.$id.'"';  
$update = updatelisting('indentCreationMaster',$namevalue,$where);  

}
?>