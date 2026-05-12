<?php
include "inc.php";   

if($_REQUEST['action']=='saveunitfactory'){   
$where='id="'.decode($_REQUEST['styleId']).'"';  
$namevalue ='unitFactory="'.$_REQUEST['id'].'"';   
updatelisting(_QUERY_MASTER_,$namevalue,$where);   
 
} 


