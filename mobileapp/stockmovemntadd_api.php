<?php
include '../inc.php';
header("Content-Type: application/json");
//$parameterdata = file_get_contents('php://input');
//$arrData = json_decode($parameterdata);

if($_REQUEST['styleId']!='' && $_REQUEST['transferTo']!='' && $_REQUEST['styleId']!=''){

$fromDate = date('Y-m-d',strtotime($_REQUEST['fromDate']));
$factoryId = $_REQUEST['factoryId'];
$line = $_REQUEST['lineId'];

$stockInHand = $_REQUEST['stockInHand'];
$receivedFrom = $_REQUEST['receivedFrom'];
$receivedQty = $_REQUEST['receivedQty'];
$transferTo = $_REQUEST['transferTo'];
$fromSerial = $_REQUEST['fromSerial'];
$toSerial = $_REQUEST['toSerial'];
$transferQty = $_REQUEST['transferQty'];
$styleId = $_REQUEST['styleId'];
$sequenceNo = $_REQUEST['sequenceNo'];
$addedBy = $_REQUEST['userId'];

$editId = $_REQUEST['editId'];
$status = $_REQUEST['status'];

if($editid!=''){
  $namevalue ='status="'.$status.'"';
  $where='id="'.$editid.'"';
  $update = updatelisting('operatorInput',$namevalue,$where);

  echo json_encode(['Status' => '0', 'Message' => 'Update Successfull'], JSON_PRETTY_PRINT);

}else{
  $namevalue ='fromDate="'.$fromDate.'",factoryId="'.$factoryId.'",line="'.$line.'",stockInHand="'.$stockInHand.'",receivedFrom="'.$receivedFrom.'",receivedQty="'.$receivedQty.'",transferTo="'.$transferTo.'",fromSerial="'.$fromSerial.'",toSerial="'.$toSerial.'",transferQty="'.$transferQty.'",addedBy="'.$addedBy.'",dateAdded="'.time().'",styleId="'.$styleId.'",sequenceNo="'.$sequenceNo.'"';
      if($styleId!='' && $transferQty!='' && $transferTo!=''){
        $lastid = addlistinggetlastid('operatorInput',$namevalue);
        echo json_encode(['Status' => '0', 'results' => [[ 'Message' => 'Added Successfull']]], JSON_PRETTY_PRINT);
      }else{
        echo json_encode(['Status' => '0', 'results' => [[ 'Message' => 'Failed to add data']]], JSON_PRETTY_PRINT);
      }
}

}else{
  echo json_encode(['Status' => '0', 'results' => [[ 'Message' => 'Failed! Stock Movement Not Added']]], JSON_PRETTY_PRINT);
}

?>