<?php
include "inc.php"; 

if($_REQUEST['action']=="timeaction"){

$taskListId = $_REQUEST['taskid'];
$actualDate = date('Y-m-d',strtotime($_REQUEST['actualDate']));
$complitionDate = date('Y-m-d',strtotime($_REQUEST['complitionDate']));

$finalId = $_REQUEST['finalId']; 
$responsiblity = $_REQUEST['responsiblity'];  

$status = $_REQUEST['status']; 

$update = updatelisting('timeActionReport','actualDate="'.$actualDate.'",responsiblity="'.$responsiblity.'",complitionDate="'.$complitionDate.'"','id="'.$finalId.'"');
 
}

if($_REQUEST['action']=="timeactionremarks"){ 
$taskListId = $_REQUEST['taskid'];
$remark = $_REQUEST['remark'];
$styleId = $_REQUEST['styleid']; 

$update = updatelisting('timeActionReport','remark="'.$remark.'"','id="'.$taskListId.'" and styleId="'.$styleId.'"');
 
}


?>