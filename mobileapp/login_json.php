<?php
include '../inc.php';
header("Content-Type: application/json");
$parameterdata = file_get_contents('php://input');
$dataToShare = json_decode($parameterdata);
$userId = $dataToShare->username;
$password = md5($dataToShare->userpass);
$select = 'id,email,firstName,lastName,profileId';
$where = 'email="' . $userId . '" and password="' . $password . '"';
$rs = GetPageRecord($select, _USER_MASTER_, $where);

$countrows = mysqli_num_rows($rs);
if ($countrows > 0) {
    $userinfoList = mysqli_fetch_assoc($rs);

    $response = '{
        "status" : true,
        "results" : [{
            "id": "'.$userinfoList['id'].'",
    	    "email": "'.$userinfoList['email'].'",
            "firstName": "'.$userinfoList['firstName'].'",
            "lastName": "'.$userinfoList['lastName'].'",
            "profileId": "'.$userinfoList['profileId'].'"

        }]
    }';


    echo  $response;

} else {
    echo $jsonData = '{ "Message" : "Invalid Credentials" }';
}
