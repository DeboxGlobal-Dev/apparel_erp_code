<?php
error_reporting(0);

include "config/database.php";
include "config/dbtable.php";
include "config/function.php";


function showmonthnamedate($date){
    return $date=date('d/m/Y',$date);
}

$systemname='Apparel ERP';

global $clientnameglobal;
$clientnameglobal='Apparel ERP';

$fullurl="https://apparelerp.co.in/";

$client='Apparel ERP';

//$serverurlapi = $_SERVER['HTTP_HOST']."/web/account_api/";127.0.0.1
$serverurlapi = $_SERVER['HTTP_HOST']."/web/account_api/";
// upload logo in global_asset/images
//$logo='acclogo.png';
$logo='Apparel_ERP-200x1.png';

?>
