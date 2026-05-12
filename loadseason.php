<?php
include "inc.php";
include "config/logincheck.php";


if($_REQUEST['action']=='changeseasonaction'){

$brandId=$_REQUEST['brandId'];
$seasonId=$_REQUEST['selectId'];
?>

<option value="">Select</option>
<?php

$select='';
$where='';
$rs='';
$select='*';
if($brandId!=''){
// $brandId=' and brandId="'.$brandId.'" ';
$brandId=' and buyerId="'.$brandId.'" ';

}
$where=' 1 '.$brandId.' and deletestatus=0 and status=1 order by name asc';
$rs=GetPageRecord($select,_SEASON_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){
  $brandId=$_REQUEST['brandId'];

    $valid=$_REQUEST['valid'];

$buy=GetPageRecord('*','seasonMaster','buyerId="'.$brandId.'" and bydefault=1');
$buy_tree=mysqli_fetch_array($buy);

if($valid==0 ){

     $sel=$_REQUEST['selectId'];

}else{
     $sel=$buy_tree['id'];

}




?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$sel){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
<?php }


}





if($_REQUEST['action']=='changesegmentaction'){

$brandId=$_REQUEST['brandId'];
$segmentId=$_REQUEST['selectId'];
?>

<option value="">Select</option>
<?php


$where='';
$rs='';
$select='*';
if($brandId!=''){
$brandId=' and brand="'.$brandId.'" ';
}
$where=' 1 '.$brandId.'  order by name asc';
$rs=GetPageRecord($select,'segmenteMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$segmentId){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
<?php }


}

?>

