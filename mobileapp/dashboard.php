<?php
include '../inc.php';




header("Content-Type: application/json");
class clsListData
{
	public $TotalStyle;
	public $Projection;
	public $OnOrder;
	public $Delayed;
	public $OnGoing;
	public $UpComing;

}
 $listArray=array();
//total style
$CountQuery1=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 and sampleStyle="1" order by id desc');
$totalQuery1=mysqli_num_rows($CountQuery1);



//projection
$rspdes=GetPageRecord('*',_QUERY_MASTER_,'  subject!=""  and deletestatus=0 and projecQty!="" ');
$resultpdes=mysqli_num_rows($rspdes);


//onorder

$rspda=GetPageRecord('*',_QUERY_MASTER_,'  orderQty!="0" and subject!=""  and deletestatus=0');
$resultpda=mysqli_num_rows($rspda);


//trafficlight

$redcount=0;
$yellowcount=0;
$greencount=0;
$NewDate=Date('Y-m-d', strtotime('+14 days'));
$trafficQ=GetPageRecord('id,complitionDate','timeActionReport','1  and taskListId in (select id from taskListMaster where tna=1) order by id');
while($trafData=mysqli_fetch_array($trafficQ)){

if($trafData['complitionDate']<=date('Y-m-d')){
++$redcount;
}
else if($trafData['complitionDate']>=$NewDate){
++$greencount;
}
else{
++$yellowcount;
}

}


$redcountr=0;

$trafficQr=GetPageRecord('id,complitionDate','timeActionReport','1 and actualDate="1970-01-01"  and taskListId in (select id from taskListMaster where tna=1) order by id');
while($trafDatar=mysqli_fetch_array($trafficQr)){

if($trafDatar['complitionDate']<=date('Y-m-d')){
++$redcountr;
}


}




//end trafficlight

        $objListData = new clsListData();
		$objListData->TotalStyle = $totalQuery1;
		$objListData->Projection= $resultpdes;
		$objListData->OnOrder= $resultpda;
	    $objListData->Delayed = $redcountr;
		$objListData->OnGoing= $yellowcount;
		$objListData->UpComing= $greencount;
		array_push($listArray, $objListData);

	echo json_encode(['Status'=>'0','Message'=>'Success','TotalRecord'=>$listArray],JSON_PRETTY_PRINT);


?>