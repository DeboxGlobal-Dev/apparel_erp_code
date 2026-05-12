<?php

$select1='*';
$where1='id="'.$_SESSION['userid'].'"';
$rs1=GetPageRecord($select1,'userMaster',$where1);
$getusername=mysqli_fetch_array($rs1);


$select='*';
$where='email="'.$getusername['userName'].'"';
$rs=GetPageRecord($select,_EMAIL_SETTING_MASTER_,$where);
$countmail = mysqli_num_rows($rs);




while($emailsetting=mysqli_fetch_array($rs)){
$from_name=clean($emailsetting['from_name']);
$email=clean($emailsetting['email']);
$password=clean($emailsetting['password']);
$smtp_server=str_replace('.mail','',$emailsetting['smtp_server']);
$port=clean($emailsetting['port']);
$incomingPort=clean($emailsetting['incomingPort']);
$security_type=clean($emailsetting['security_type']);
}

if($email==''){


$select='*';
$where='email="info@deboxcrm.com"';
$rs=GetPageRecord($select,_EMAIL_SETTING_MASTER_,$where);
$countmail = mysqli_num_rows($rs);




while($emailsetting=mysqli_fetch_array($rs)){
$from_name=clean($emailsetting['from_name']);
$email=clean($emailsetting['email']);
$password=clean($emailsetting['password']);
$smtp_server=str_replace('.mail','',$emailsetting['smtp_server']);
$port=clean($emailsetting['port']);
$incomingPort=clean($emailsetting['incomingPort']);
$security_type=clean($emailsetting['security_type']);
}


}


$hostname = '{'.$smtp_server.':'.$incomingPort.'/ssl/novalidate-cert}INBOX';
$username = $email;
$password = $password;
?>