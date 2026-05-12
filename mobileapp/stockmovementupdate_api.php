<?php
include '../inc.php';
header("Content-Type: application/json");
$parameterdata = file_get_contents('php://input');

$arrData = json_decode($parameterdata);
$editId=trim($arrData->editId);

if($editId!=''){
  $namevalue ='status="1"';
  $where='id="'.$editId.'"';
  $update = updatelisting('operatorInput',$namevalue,$where);
 echo json_encode(['Status' => '0', 'Message' => 'Update Succesfully'], JSON_PRETTY_PRINT);
}else{
  echo json_encode(['Status' => '0', 'Message' => 'Failed to update.'], JSON_PRETTY_PRINT);
}

?>