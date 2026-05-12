<?php
include "inc.php";

//print_r($_POST);

$styleId = $_REQUEST['styleId'];
$uploadDate = date('Y-m-d',strtotime($_REQUEST['uploadDate']));
$uploadInput = trim($_REQUEST['uploadInput']);
$uploadInputTotal = trim($_REQUEST['uploadInputTotal']);
$factoryId = trim($_REQUEST['factoryId']);
$lineId = trim($_REQUEST['lineId']);

$namevalueadd = 'styleId="'.$styleId.'",uploadInputDate="'.$uploadDate.'",dateWiseLineInput="'.$uploadInput.'",linewiseefficiency="'.$uploadInputTotal.'",factoryId="'.$factoryId.'",lineId="'.$lineId.'"';

$where='styleId="'.$styleId.'" and uploadInputDate="'.$uploadDate.'" and factoryId="'.$factoryId.'" and lineId="'.$lineId.'"';
$checkCoderef = checkduplicate('linePlanMaster',$where);
if($checkCoderef=='no'){

  if($uploadDate!='1970-01-01'){
    addlistinggetlastid('linePlanMaster',$namevalueadd);
  }

}else{

  $whereN='styleId="'.$styleId.'" and uploadInputDate="'.$uploadDate.'" and factoryId="'.$factoryId.'" and lineId="'.$lineId.'"';
  $rsd=GetPageRecord('id','linePlanMaster',$whereN);
  $rsList=mysqli_fetch_array($rsd);


  $where22 = 'id="'.$rsList['id'].'"';
  $update = updatelisting("linePlanMaster",$namevalueadd,$where22);

}

?>






