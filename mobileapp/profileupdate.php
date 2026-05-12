<?php
include '../inc.php';




header("Content-Type: application/json");
$parameterdata = file_get_contents('php://input');



$dataToShare = json_decode($parameterdata);
$userId=$dataToShare->userId;
$firstname=$dataToShare->firstname;
$lastname=$dataToShare->lastname;
$phone=$dataToShare->phone;
 class clsListData
        {
        public $msg;
   
      
        
        
        }
    
    $listArray=array();
    
    
    
    
    
    if($phone!='' && $lastname!='' && $firstname!=''){
    
    
    
    
    $namevalue ='firstName="'.$firstname.'",lastName="'.$lastname.'",phone="'.$phone.'"'; 
    $where='id="'.$userId.'"';  
    $update = updatelisting('userMaster',$namevalue,$where);  
    
    
    
    $objListData = new clsListData();
    $objListData->msg = 'Profile has been successfully updated';
    
    
    
    array_push($listArray, $objListData);
    
    echo json_encode(['Status'=>'0','Message'=>'Profile has been successfully updated','Profile'=>$listArray],JSON_PRETTY_PRINT);
    
        }else{
        
        echo json_encode('Invalid Credentials',JSON_PRETTY_PRINT);
    }
    
    
    ?>