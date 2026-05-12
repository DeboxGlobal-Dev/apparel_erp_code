<?php
include '../inc.php';




header("Content-Type: application/json");
class clsListData
{
public $FhoEarly;
public $FhoDelayed;
public $FhoOntime;
public $PcdEarly;
public $PcdDelayed;
public $PcdOntime;
}
$listArray=array();


$select='*';
$a=0;

$early=0;
$delayed=0;
$ontime=0;
$qqps=GetPageRecord('*','timeActionReport','1 ');
while( $quarDataps=mysqli_fetch_array($qqps)){
$qqp=GetPageRecord('*','taskListMaster','1 and id="'.$quarDataps['taskListId'].'" and name="38"');
$quarDatap=mysqli_num_rows($qqp);
$quarDatapcc=mysqli_fetch_array($qqp);

$qqpx=GetPageRecord('*','timeActionReport','1 and taskListId="'.$quarDatapcc['id'].'"');
$quarDatapx=mysqli_fetch_array($qqpx);
if($quarDatapx['complitionDate']!='' &&  $quarDatapx['complitionDate']!='1970-01-01' && $quarDatapx['complitionDate']!='0000-00-00' && $quarDatapx['actualDate']!='' && $quarDatapx['actualDate']!='1970-01-01' && $quarDatapx['actualDate']!='0000-00-00'){
$plandate=date('d-m-Y', strtotime($quarDatapx['complitionDate']));
$start_date = strtotime($plandate);
$currentdate= date('d-m-Y', strtotime($quarDatapx['actualDate']));
$end_date = strtotime($currentdate);
$difference =  ($start_date - $end_date)/60/60/24;

if($difference > "0"){  $early=$early+1; } else if($difference < "0"){ $delayed=$delayed+1; }else {  $ontime=$ontime+1; }

}

}

$early1=0;
$delayed1=0;
$ontime1=0;
$qqps1=GetPageRecord('*','timeActionReport','1 ');
while( $quarDataps1=mysqli_fetch_array($qqps1)){
$qqp1=GetPageRecord('*','taskListMaster','1 and id="'.$quarDataps1['taskListId'].'" and name="42"');
$quarDatap1=mysqli_num_rows($qqp1);
$quarDatapcc1=mysqli_fetch_array($qqp1);

$qqpx1=GetPageRecord('*','timeActionReport','1 and taskListId="'.$quarDatapcc1['id'].'"');
$quarDatapx1=mysqli_fetch_array($qqpx1);
if($quarDatapx1['complitionDate']!='' &&  $quarDatapx1['complitionDate']!='1970-01-01' && $quarDatapx1['complitionDate']!='0000-00-00' && $quarDatapx1['actualDate']!='' && $quarDatapx1['actualDate']!='1970-01-01' && $quarDatapx1['actualDate']!='0000-00-00'){
$plandate1=date('d-m-Y', strtotime($quarDatapx1['complitionDate']));
$start_date1 = strtotime($plandate1);
$currentdate1= date('d-m-Y', strtotime($quarDatapx1['actualDate']));
$end_date1 = strtotime($currentdate1);
$difference1 =  ($start_date1 - $end_date1)/60/60/24;


if($difference1 > "0"){  $early1=$early1+1; } else if($difference1 < "0"){ $delayed1=$delayed1+1; }else {  $ontime1=$ontime1+1; }

}
}
$objListData = new clsListData();
$objListData->FhoEarly =strval($early);
$objListData->FhoDelayed =strval($delayed);
$objListData->FhoOntime =strval($ontime);
$objListData->PcdEarly =strval($early1);
$objListData->PcdDelayed =strval($delayed1);
$objListData->PcdOntime =strval($ontime1);




array_push($listArray, $objListData);

echo json_encode(['Status'=>'0','Message'=>'Success','ChartRecord'=>$listArray],JSON_PRETTY_PRINT);


?>