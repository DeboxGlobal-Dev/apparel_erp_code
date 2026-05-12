<?php
include('inc.php');

if($_REQUEST['action']=="loadAssignedResourceUser"){
$profileId  = $_REQUEST['profileId'];
$id  = $_REQUEST['id'];
?>
<option value="">Select</option>
<?php
$rss=GetPageRecord('assignTo','resourceAllocationBrandWise','id="'.$id.'"');
$resListingaa=mysqli_fetch_array($rss);
$assignTo = $resListingaa['assignTo'];
if($assignTo==0){
$assignToVal = ' and profileId="'.$profileId.'"';
}else{
$assignToVal = ' and id in ('.$assignTo.')';
}

$select='';
$where='';
$rs='';
$select='*';
$where=' deletestatus=0 and status=1 '.$assignToVal.' order by firstName asc';
$rs=GetPageRecord($select,'userMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo $resListing['id']; ?>"><?php echo getUserName($resListing['id']); ?></option>
<?php
}
}
?>


