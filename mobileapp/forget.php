<?php
include '../inc.php';




header("Content-Type: application/json");
$parameterdata = file_get_contents('php://input');



$dataToShare = json_decode($parameterdata);

$userId=$dataToShare->username;






$select='id';

$where='email="'.$userId.'"';
$rs=GetPageRecord($select,_USER_MASTER_,$where);
$countrows=mysqli_num_rows($rs);




if($countrows>0){

$userinfoList = mysqli_fetch_assoc($rs);


$resultlist = $userinfoList;
$jsonData = json_encode($resultlist,JSON_PRETTY_PRINT);

echo $jsonData;
}
else{
echo $jsonData = json_encode('Invalid E-mail',JSON_PRETTY_PRINT);

 }
?>