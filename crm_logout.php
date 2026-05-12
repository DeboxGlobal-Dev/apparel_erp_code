<?php 
include "inc.php"; 
session_regenerate_id(); 
error_reporting(0);   

setcookie("username", "", time()-3600);
setcookie("password", "", time()-3600);
unset($_SESSION['sessionid']); 
unset($_SESSION['username']); 
session_destroy(); 
header('Location: login.crm'); 
exit;  
?>