<?php 
if($_SESSION['username']=="" || $_SESSION['sessionid']!=session_id() || $_SESSION['userid']=="" || $_SESSION['uSession']==""){ 
header("Location:login.crm");
exit(); } 
include "config/userinfo.php";
?>