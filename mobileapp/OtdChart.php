<?php
include '../inc.php';




header("Content-Type: application/json");
class clsListData
{
public $FactorySot;
public $OverallSot;
public $CFair;
public $AirPort;
public $SeaPort;





}
$listArray=array();


$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit='20000';

$where='where status != "0" ';
$page=$_GET['page'];
$f=0;
$gt=0;
$fd=0;
$air=0;
$sea=0;
$fvv=0;
$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,'packinglistMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$f=$f+1;
if($resultlists['orignalshipmode']==$resultlists['actualshipmode']){
$gt=$gt+1;
}
if($resultlists['orignalexfactory']==$resultlists['actualexfactory'] ){
$fd=$fd+1;
}
if($resultlists['toport']=='1' ){
$air=$air+1;
}
if($resultlists['actualshipmode']=='Sea' ){
$sea=$sea+1;
}

if($resultlists['orignalexfactory']!=$resultlists['actualexfactory'] ){
$fvv=$fvv+1;
}
}



$calc=($gt/$f)*100;


$calc1=($fd/$f)*100;

$calc2=($air/$f)*100;
$calc3=($sea/$f)*100;

$calc4=($fvv/$f)*100;




$objListData = new clsListData();
$objListData->FactorySot =round($calc1,2);
$objListData->OverallSot =round($calc,2);
$objListData->CFair =round($calc4,2);
$objListData->AirPort =round($calc2,2);
$objListData->SeaPort =round($calc3,2);




array_push($listArray, $objListData);

echo json_encode(['Status'=>'0','Message'=>'Success','ChartRecord'=>$listArray],JSON_PRETTY_PRINT);


?>