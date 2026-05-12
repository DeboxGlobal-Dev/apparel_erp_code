<?php 
ob_start();
session_start(); 
mysql_connect("localhost", "travcrm_crm", "DeBox@6060"); 
mysql_select_db("travcrm_crm"); 
date_default_timezone_set('Asia/Calcutta'); 
$fullurl='http://travcrm.in/'; 
?>