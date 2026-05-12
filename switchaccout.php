<?php
include "inc.php";
include "config/logincheck.php";
$u = $_REQUEST['u'];
if($u!=''){
$selectkkk='*';
$wherekkk='1 and email="'.$_REQUEST['u'].'" and status=1';
$rskkk=GetPageRecord($selectkkk,'userMaster',$wherekkk);
$resultfinal=mysqli_fetch_array($rskkk);
$countresult=mysqli_num_rows($rskkk);
if($countresult>0){

$select='*';
$where="email='".$resultfinal['email']."'";
$rs=GetPageRecord($select,_USER_MASTER_,$where);
$userinfo=mysqli_fetch_array($rs);
$cLogin=$userinfo['cLogin'];
$currentIp=$userinfo['currentIp'];
$id=$userinfo['id'];
$randnum = mt_rand(100000, 999999);
$uSession=$randnum;


$_SESSION['userid']=$id;
$_SESSION['empid']=$userinfo['empId'];
$_SESSION['username']=$resultfinal['email'];
$_SESSION['sessionid']=session_id();
$_SESSION['uSession']=$uSession;

$sql_ins="update "._USER_MASTER_." set lLogin='$cLogin',lastIp='$currentIp',cLogin='$clogin',currentIp='$cip',uSession='".$uSession."' where id=".$_SESSION['userid']."";
mysql_query($sql_ins) or die(mysql_error());

header("location: /");

}
}
else{
header("location: /");
}
?>