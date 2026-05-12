<?php
include '../inc.php';
header("Content-Type: application/json");
$parameterdata = file_get_contents('php://input');

$arrData = json_decode($parameterdata);

$fromDate=date("Y-m-d", strtotime($arrData->fromDate));
$factoryId=addslashes($arrData->factoryId);
$line=addslashes($arrData->line);
$styleId=addslashes($arrData->styleId);
$userId=addslashes($arrData->userId);
$sequenceNo=addslashes($arrData->sequenceNo);

////////////////////For check quality//////////////
$totalCheck=addslashes($arrData->totalCheck);
$pass=addslashes($arrData->pass);
$fail=addslashes($arrData->fail);
$transferTo2=addslashes($arrData->transferTo);
$transferQty2=addslashes($arrData->transferQty);
////////////////////End here////////////////////////

if($totalCheck!='' && $transferQty2!=''){

  $namevalue2 ='fromDate="'.$fromDate.'",factoryId="'.$factoryId.'",line="'.$line.'",pass="'.$pass.'",fail="'.$fail.'",transferTo="'.$transferTo2.'",transferQty="'.$transferQty2.'",addedBy="'.$userId.'",styleId="'.$styleId.'",sequenceNo="'.$sequenceNo.'",totalCheck="'.$totalCheck.'",dateAdded="'.time().'"';

  $lastid = addlistinggetlastid('operatorInputCheck',$namevalue2);

  foreach($arrData->defectDetails as $defectRemark){
      $orderWiseNo=trim($defectRemark->orderWiseNo);
      $ticketNo=trim($defectRemark->ticketNo);
      $color=trim($defectRemark->color);
      $size=trim($defectRemark->size);
      $remark = $defectRemark->remark;

      $namevalue3 ='orderWiseNo="'.$orderWiseNo.'",ticketNo="'.$ticketNo.'",color="'.$color.'",size="'.$size.'",operatorId="'.$transferTo2.'",remark="'.$remark.'",styleId="'.$styleId.'",operatorInputId="'.$lastid.'",dateAdded="'.time().'",addedBy="'.$userId.'"';

      if($ticketNo!='' && $orderWiseNo!=''){
        addlisting('defectDetails',$namevalue3);
      }

  }

  echo json_encode(['Status' => '0', 'Message' => 'Added Succesfully'], JSON_PRETTY_PRINT);


}else{
  echo json_encode(['Status' => '0', 'Message' => 'Failed to Add'], JSON_PRETTY_PRINT);
}

?>