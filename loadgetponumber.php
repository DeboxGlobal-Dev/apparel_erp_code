<?php
include "inc.php";

$grnId= $_REQUEST['grnId'];


$where='id="'.$grnId.'" and gateEntryNo!=0 and parentId=0';
$rs=GetPageRecord("*","grnMaster",$where);
$resListing=mysqli_fetch_array($rs);

?>
<script>
   parent.$("#supplierPurchaseOrderId").val("<?php echo $resListing['supplierPurchaseOrderId']; ?>");
   parent.$("#grnDate").val("<?php echo date('d-m-Y',$resListing['dateAdded']); ?>");
   parent.$("#gateEntryNo").val("<?php echo $resListing['gateEntryNo']; ?>");
   parent.$("#supplierId").val("<?php echo $resListing['supplierId']; ?>");
</script>