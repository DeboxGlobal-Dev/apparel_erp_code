<?php
include "inc.php";

header("Content-Type: application/json");
$parameterdata = file_get_contents('php://input');
$parameterdata = str_replace("null","\"\"",$parameterdata);
logger("INSIDE UPDATE BALANCE API: ".$parameterdata);
$dataToExport = json_decode($parameterdata);

$code = $dataToExport->code;
$balance = $dataToExport->balance;

$arrayDataRows = array();

//////---------------------- Extraction from DataBase --------------------------------

if($code!=""){

  $tableName = substr($code,0, 2);
  $namevalue = 'balance="'.$balance.'"';

  if($tableName=="CP"){
    $where='companyId="'.$code.'"';
    logger("INSIDE UPDATE BALANCE QUERY IN CLINET API: ".$where);
    $update = updatelisting("companyMaster",$namevalue,$where);
  }
  else if($tableName=="BY"){
    $where='buyerId="'.$code.'"';
    logger("INSIDE UPDATE BALANCE QUERY IN CLINET API: ".$where);
    $update = updatelisting("buyerMaster",$namevalue,$where);
  }
  else if($tableName=="SP"){
    $where='supplierId="'.$code.'"';
    logger("INSIDE UPDATE BALANCE QUERY IN CLINET API: ".$where);
    $update = updatelisting("suppliersMaster",$namevalue,$where);
  }
  else{
    $where='code="'.$code.'"';
    logger("INSIDE UPDATE BALANCE QUERY IN OTHER MASTER API: ".$where);
    $update = updatelisting("othersMaster",$namevalue,$where);
  }
}

if($update=='yes'){
  echo json_encode(['status'=>1,'message'=>"succesfully updated"],JSON_PRETTY_PRINT);
}else{
  echo json_encode(['status'=>0,'message'=>"failed to updated"],JSON_PRETTY_PRINT);
}



?>