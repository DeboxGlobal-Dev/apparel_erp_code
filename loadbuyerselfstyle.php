<?php
include "inc.php";

if($_REQUEST['action']=="selectstyletype"){
$selfBuyer = $_REQUEST['id'];

$selectIdstyle = decode($_REQUEST['sId']);
?>
<option value="">Select</option>
<?php
if($selfBuyer=='100'){
$where = '1 and subject!="" and deletestatus=0 and buyerId="'.$selfBuyer.'" order by id desc';
}else{
$where = '1 and subject!="" and deletestatus=0 and buyerId!=100 and sampleStyle=1 order by id desc';
}
$rs=GetPageRecord('*','queryMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>" data-overlay="<?php echo $resListing['brandId']; ?>" <?php if($selectIdstyle==$resListing['id']){ ?> selected <?php } ?> ><?php echo '#'.strip($resListing['styleRefId']); ?></option>

<?php }

}
?>