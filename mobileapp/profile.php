<?php
include '../inc.php';




header("Content-Type: application/json");
$parameterdata = file_get_contents('php://input');

 class clsListData
        {
        public $id;
        public $email;
        public $firstName;
        public $lastName;
        public $phone;
        public $userName;
        public $password;



        }
$listArray=array();

// $dataToShare = json_decode($parameterdata);

// $userId=$dataToShare->username;

// $password=md5($dataToShare->userpass);
if( $_GET['id']!=''){

    $ids=$_GET['id'];
}



$select='id,email,firstName,lastName,phone,userName,password';

$where='id="'.$ids.'"';
$rs=GetPageRecord($select,_USER_MASTER_,$where);
$countrows=mysqli_fetch_assoc($rs);




   $objListData = new clsListData();
        $objListData->id = $countrows['id'];
        $objListData->email = $countrows['email'];
        $objListData->firstName = $countrows['firstName'];
        $objListData->lastName = $countrows['lastName'];
        $objListData->userName = $countrows['userName'];
        $objListData->phone = $countrows['phone'];
         $objListData->password = $countrows['password'];


        array_push($listArray, $objListData);

        echo json_encode(['Status'=>'0','Message'=>'Success','Profile'=>$listArray],JSON_PRETTY_PRINT);
?>