<?php
include '../inc.php';
header("Content-Type: application/json");
$parameterdata = file_get_contents('php://input');

$arrData = json_decode($parameterdata);

$fromDate = date('Y-m-d',strtotime($arrData->fromDate));
$factoryId = $arrData->factoryId;
$line = $arrData->lineId;
$userId = $arrData->userId;

class clsListData
{
  public $styleId;
  public $subject;
  public $styleRefId;
  public $season;
  public $receivedDate;
  public $buyer;
  public $shortName;
  public $todayPlanned;
  public $tillPlannedToday;
  public $defectFormShow;
  public $receivedFromName;
  public $receivedFrom;
  public $transferToName;
  public $transferTo;
  public $receivedQty;
  public $sequenceNo;
  public $stockInHand;
}

class stockMovement {
  public $id;
  public $sequenceNo;
  public $stockInHand;
  public $receivedFrom;
  public $receivedQty;
  public $transferTo;
  public $fromSerial;
  public $toSerial;
  public $transferQty;
  public $Status;
  public $Date;
}

class defectData {
  public $id;
  public $orderWiseNo;
  public $ticketNo;
  public $color;
  public $size;
  public $remark;
  public $date;
  public $action;
}

$listArray = array();
$listStockMovementArray = array();
$listDefectData = array();

$rkdm = GetPageRecord('*', 'linePlanMaster', '1 and factoryId="' . $factoryId . '" and lineId="' . $line . '" and uploadInputDate="' . $fromDate . '" order by id desc');
$styleId = mysqli_fetch_array($rkdm);
$countresult = mysqli_num_rows($rkdm);


$krdm = GetPageRecord('*', 'queryMaster', '1 and id="' . $styleId['styleId'] . '" order by id desc');
$editresultstyle = mysqli_fetch_array($krdm);

$select2 = '*';
$where2 = 'id="' . $editresultstyle['buyerId'] . '"';
$rs2 = GetPageRecord($select2, _BUYER_MASTER_, $where2);
$editresultstyle2 = mysqli_fetch_array($rs2);

$select1 = 'name,seasonYear';
$where1 = 'id="' . $editresultstyle['seasonId'] . '"';
$rs1 = GetPageRecord($select1, _SEASON_MASTER_, $where1);
$resultlist1 = mysqli_fetch_array($rs1);

$whereline = 'styleId="' . $styleId['styleId'] . '" and factoryId="' . $factoryId . '" and lineId="' . $line . '" and uploadInputDate="' . $fromDate . '"';
$rsLine = GetPageRecord('*', 'linePlanMaster', $whereline);
$resultLine = mysqli_fetch_array($rsLine);

//////////////////////show defect form//////////////////////////
$styleFlow=GetPageRecord('*','styleWorkFlowMaster','styleId="'.$styleId['styleId'].'" and userId="'.$userId.'"');
$styleFlowData=mysqli_fetch_array($styleFlow);
$lastSequence = $styleFlowData['sequenceNo']-1;
$forwardSequence = $styleFlowData['sequenceNo']+1;

///////////////CHECK USER 1 LESS TO INDENTIFIED RECEIVED FROM//////////////////
$lastStyleFlow=GetPageRecord('userId,operatorId','styleWorkFlowMaster','styleId="'.$styleId['styleId'].'" and sequenceNo="'.$lastSequence.'"');
$latStyleFlowData=mysqli_fetch_array($lastStyleFlow);

///////////////CHECK USER 1 PLUS TO INDENTIFIED TRANSFER TO//////////////////
$forwardStyleFlow=GetPageRecord('userId,operatorId','styleWorkFlowMaster','styleId="'.$styleId['styleId'].'" and sequenceNo="'.$forwardSequence.'"');
$forwardStyleFlowData=mysqli_fetch_array($forwardStyleFlow);

///////////////CHECK FROM INPUTDATA HOW MUCH LAST SEQUENCE//////////////////
$where = 'styleId="' . $styleId['styleId'] . '" and factoryId="'.$factoryId.'" and line="'.$line.'"and fromDate="'.$fromDate.'" and sequenceNo="'.$lastSequence.'" order by id desc';
$resQuerySeq = GetPageRecord('id,SUM(transferQty) AS inStockTill', 'operatorInput', $where);
$resQuerySeqData = mysqli_fetch_array($resQuerySeq);

$wherenew = 'styleId="' . $styleId['styleId'] . '" and factoryId="'.$factoryId.'" and line="'.$line.'"and fromDate="'.$fromDate.'" and addedBy="'.$_SESSION['userid'].'" order by id desc';
$resQuerySeqnew = GetPageRecord('id,SUM(transferQty) AS inStockTill', 'operatorInput', $wherenew);
$resQuerySeqDatanew = mysqli_fetch_array($resQuerySeqnew);

///////////////CHECK FROM INPUTDATA HOW MUCH QUANTITY RECEIVE AND TRANSFER through last sequence data//////////////////
$where2 = 'id="'.$resQuerySeqData['id'].'"';
$resQuery22 = GetPageRecord('*', 'operatorInput', $where2);
$resQueryData22 = mysqli_fetch_array($resQuery22);

if($styleFlowData['sequenceNo']!=1){ $aa =  round($resQuerySeqData['inStockTill'])-$resQuerySeqDatanew['inStockTill']; }else{ $aa =   round($resQuerySeqData['inStockTill']); }

if ($countresult > 0) {

  $objListData = new clsListData();
  $objListData->styleId = $styleId['styleId'];
  $objListData->subject = $editresultstyle['subject'];
  $objListData->styleRefId = $editresultstyle['styleRefId'];
  $objListData->season = $resultlist1['name'] . '' . $resultlist1['seasonYear'];
  $objListData->receivedDate = date('d-m-Y', strtotime($editresultstyle['receivedDate']));
  $objListData->buyer = $editresultstyle2['name'];
  $objListData->shortName = $editresultstyle2['buyerShortName'];
  $objListData->todayPlanned = $resultLine['dateWiseLineInput'];
  $objListData->tillPlannedToday = round($resultLine['linewiseefficiency']);
  $objListData->defectFormShow = ($styleFlowData['checkVal'] == 1 || $styleFlowData['checkVal'] == "true") ? 'Yes' : 'No';
  $objListData->receivedFromName = getEmployeeName($latStyleFlowData['operatorId']);
  $objListData->receivedFrom = $latStyleFlowData['operatorId'];
  $objListData->transferToName = getEmployeeName($forwardStyleFlowData['operatorId']);
  $objListData->transferTo = $forwardStyleFlowData['operatorId'];
  $objListData->receivedQty = $resQueryData22['transferQty'];
  $objListData->sequenceNo = $styleFlowData['sequenceNo'];
  $objListData->stockInHand = round($aa);

  array_push($listArray, $objListData);

  $statusVal = "";
  $wherekrdm = '1 and styleId="'.$styleId['styleId'].'" and factoryId="'.$factoryId.'" and line="'.$line.'"and fromDate="'.$fromDate.'" and (addedBy="'.$userId.'" OR addedBy in (select id from userMaster where empId="'.$latStyleFlowData['operatorId'].'")) order by id desc';
  $krdm=GetPageRecord('*','operatorInput',$wherekrdm);
  while($getdatalist=mysqli_fetch_array($krdm)){

    if($getdatalist['addedBy']==$userId){
      $statusVal = ($getdatalist['status']=='0') ? "Pending" : "Sent(Accepted)";
    }else{
      if($getdatalist['status']=='0'){
        $statusVal = "Accept";
      }else{
        $statusVal ="Accepted";
      }
    }

    $objStockMovement = new stockMovement();
    $objStockMovement->id = $getdatalist['id'];
    $objStockMovement->sequenceNo = $getdatalist['sequenceNo'];
    $objStockMovement->stockInHand = $getdatalist['stockInHand'];
    $objStockMovement->receivedFrom = getEmployeeName($getdatalist['receivedFrom']);
    $objStockMovement->receivedQty = $getdatalist['receivedQty'];
    $objStockMovement->transferTo = getEmployeeName($getdatalist['transferTo']);
    $objStockMovement->fromSerial = $getdatalist['fromSerial'];
    $objStockMovement->toSerial = $getdatalist['toSerial'];
    $objStockMovement->transferQty = $getdatalist['transferQty'];
    $objStockMovement->Status = $statusVal;
    $objStockMovement->Date = date("d-M-Y",$getdatalist['dateAdded'])." ".date("h:i:sa",$getdatalist['dateAdded']);

    array_push($listStockMovementArray, $objStockMovement);

  }

$wherekrdm2 = ' styleId="'.$styleId['styleId'].'" and status=0 and operatorId in (select empId from userMaster where id="'.$userId.'")';
$krdm2=GetPageRecord('*','defectDetails',$wherekrdm2);
while($getdatalist2=mysqli_fetch_array($krdm2)){

  $defect = explode(',',$getdatalist2['remark']);
	$defectData = "";
	foreach($defect as $defectid){
		$defectData.= getColumnName("inspectionDefectMaster",$defectid).',';
	}


    $objDefectData = new defectData();
    $objDefectData->id = $getdatalist2['id'];
    $objDefectData->orderWiseNo = $getdatalist2['orderWiseNo'];
    $objDefectData->ticketNo = $getdatalist2['ticketNo'];
    $objDefectData->color = $getdatalist2['color'];
    $objDefectData->size = $getdatalist2['size'];
    $objDefectData->remark = rtrim($defectData,',');
    $objDefectData->date = date("d-M-Y",$getdatalist2['dateAdded'])." ".date("h:i:sa",$getdatalist2['dateAdded']);
    $objDefectData->action = "Alter";
    array_push($listDefectData, $objDefectData);

  }



  // if($getdatalist['addedBy']==$userId){
  //    ($getdatalist['status']=='0') ? "Pending" : "Sent(Accepted)";
  // }else{
  //   ($getdatalist['status']=='0') ? "Accept" : "Accepted";
  // }




  echo json_encode(['Status' => '0', 'Message' => 'Success', 'StyleData' => $listArray, 'StockMovement' => $listStockMovementArray, 'DefectData' => $listDefectData], JSON_PRETTY_PRINT);
}else{
  echo json_encode(['Status' => '0', 'Message' => 'No Record Found.'], JSON_PRETTY_PRINT);
}

?>