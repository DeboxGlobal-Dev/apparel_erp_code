<?php
include "inc.php";
include "config/logincheck.php";

if($_REQUEST['action']=="contactdetail"){
	$rrrr=GetPageRecord('*','userMaster','id="'.$_REQUEST['id'].'"');
	$user=mysqli_fetch_array($rrrr);
?>
<script>
parent.$('#contactPhone').val('<?php echo $user['phone']; ?>');
parent.$('#contactEmail').val('<?php echo $user['email']; ?>');
</script>
<?php
}

if($_REQUEST['action']=="companydetail"){
	$rrrr=GetPageRecord('*','companyMaster','id="'.$_REQUEST['id'].'"');
	$comp=mysqli_fetch_array($rrrr);

	$rrrr2=GetPageRecord('*','addressMaster','addressParent="'.$comp['id'].'"');
	$address=mysqli_fetch_array($rrrr2);
	$addressdetail = $address['address'].', '.getCityName($address['cityId']).', '.getStateName($address['stateId']).'-'.getCountryName($address['countryId']);

?>
<script>
parent.$('#cemail').val('<?php echo $comp['phone']; ?>');
parent.$('#cmobile').val('<?php echo $comp['email']; ?>');
parent.$('#caddress').val('<?php echo $addressdetail; ?>');
</script>
<?php
}

if($_REQUEST['action']=="labdetail"){
	$rrrr=GetPageRecord('*','labMaster','id="'.$_REQUEST['id'].'"');
	$user=mysqli_fetch_array($rrrr);
?>
<script>
parent.$('#address').val('<?php echo $user['address']; ?>');
parent.$('#lemail').val('<?php echo $user['email']; ?>');
parent.$('#phone').val('<?php echo $user['phone']; ?>');
</script>
<?php
}
if($_REQUEST['action']=="supplierdetail"){

$rrrr=GetPageRecord('supplierId','indentCreationMaster','poNumber="'.$_REQUEST['id'].'"');
$user=mysqli_fetch_array($rrrr);


?>
<script>
parent.$('#supplierName').val('<?php echo getSupplierName($user['supplierId']); ?>');
parent.$('#supplierId').val('<?php echo $user['supplierId']; ?>');
</script>
<?php
}
?>

<?php
if($_REQUEST['action']=="maintenancesupplierdetail"){

$rrrr=GetPageRecord('supplierId','requisitionIndentMaster','id="'.$_REQUEST['id'].'"');
$user=mysqli_fetch_array($rrrr);


?>
<script>
parent.$('#supplierName').val('<?php echo getSupplierName($user['supplierId']); ?>');
parent.$('#supplierId').val('<?php echo $user['supplierId']; ?>');
</script>
<?php
}
?>



<?php
if($_REQUEST['action']=='po_type'){

$poId=$_REQUEST['id'];
?>

<?php
$select='*';

$whereaq='1 and poNumber="'.$poId.'"';
$rsaq=GetPageRecord($select,'indentCreationMaster',$whereaq);
$resListingaq=mysqli_fetch_array($rsaq);


$where='1 and id="'.$resListingaq['poTypeId'].'"';
$rs=GetPageRecord($select,'poTypeMaster',$where);

$resListing=mysqli_fetch_array($rs);

$rsExt=GetPageRecord('*','externalChallan','pono="'.$poId.'"');
 $rsExtSum=mysqli_fetch_array($rsExt);

 $checkPo = checkduplicate('externalChallan','pono="'.$poId.'"');
 if($checkPo=='yes'){

?>
<option value="<?php echo strip($resListing['id']); ?>"><?php echo strip($resListing['name']); ?></option>
<?php
}else{
	?>
	<option value="<?php echo strip($resListing['id']); ?>"><?php echo strip($resListing['name']); ?></option>
<script>
	/*alert('Challan is not created!');
	parent.$('#ponumber').val("");
	location.reload();
	*/
</script>
	<?php
}

}

if($_REQUEST['action']=="getPoList"){
?>
<option value="">Select</option>
<?php
$selectId = trim($_REQUEST['selectId']);
$supplierId = trim($_REQUEST['supplierId']);
if($selectId!=''){
$where = '1 and bomPoStatus=1 and poNumber="'.$selectId.'" and isCancel="no" group by poNumber desc';
}else{
$where = '1 and bomPoStatus=1 and supplierId="'.$supplierId.'" and isCancel="no" group by poNumber desc';
}

$rs=GetPageRecord('*','indentCreationMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>

<option value="<?php echo strip($resListing['poNumber']); ?>" <?php if($selectId==$resListing['poNumber']){ ?> selected="selected" <?php } ?> ><?php echo strip($resListing['poNumber']); ?></option>
<?php
} }
?>


