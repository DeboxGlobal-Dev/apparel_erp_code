<?php
include '../inc.php';




header("Content-Type: application/json");
$parameterdata = file_get_contents('php://input');



$dataToShare = json_decode($parameterdata);
$updatepassword=$dataToShare->updatepassword;
$userId=$dataToShare->userId;

 class clsListData
        {
        public $msg;
   
      
        
        
        }
    
    $listArray=array();
    
    
    
    
    
    
    
    if($updatepassword!=''){
    
    
    $namevalue ='password="'.md5($updatepassword).'"'; 
    $where='id="'.$userId.'"';  
    $update = updatelisting('userMaster',$namevalue,$where);  
    
    
    
    $objListData = new clsListData();
    $objListData->msg = 'Password has been successfully updated';
    
    
    
    array_push($listArray, $objListData);
    
    echo json_encode(['Status'=>'0','Message'=>'Password has been successfully updated','Profile'=>$listArray],JSON_PRETTY_PRINT);
    }else{
        
        echo json_encode('Invalid Credentials',JSON_PRETTY_PRINT);
    }
    
    
    ?>