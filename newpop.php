<?php

include "inc.php";

if($_REQUEST['action']=='amendaction'){

$styleId = decode($_REQUEST['styleId']);
$stylesubtabid = trim($_REQUEST['stylesubtabid']);
$costsheetVersionId = trim($_REQUEST['costsheetVersionId']);
$bomAvg = trim($_REQUEST['bomAvg']);
$bomWidth = trim($_REQUEST['bomWidth']);
$bomUnit = trim($_REQUEST['bomUnit']);
$wastagePersent = trim($_REQUEST['wastagePersent']);
$avgIncWastage = trim($_REQUEST['avgIncWastage']);
$matCurrency = trim($_REQUEST['matCurrency']);
$matPrice = trim($_REQUEST['matPrice']);
$materialType = trim($_REQUEST['materialType']);

$rstype=GetPageRecord('name','materialTypeMaster','id="'.$materialType.'"');
$resListingType=mysqli_fetch_array($rstype);
?>

<div style="padding:10px;">
  <table width="100%" border="1" cellspacing="2" cellpadding="2" style="margin-top:5px;text-align: center;border: 1px solid #ccc;" class="">
   <tr style="background-color: #969696; color: #fff; font-weight: 600;">
    <td colspan="6" align="left">
	<div style="padding:5px;">
	<?php echo $resListingType['name']; ?> - <?php
	$rsunit11=GetPageRecord('name','styleSubCategoryMaster','id="'.$stylesubtabid.'"');
	$resListingunit11=mysqli_fetch_array($rsunit11);
	echo $resListingunit11['name'];
	?>
	</div></td>
    </tr>
</table>
</div>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<input type="hidden" name="styleId"  class="form-control" value="<?php echo $styleId; ?>" />
<input type="hidden" name="stylesubtabid"  class="form-control" value="<?php echo $stylesubtabid; ?>" />
<input type="hidden" name="costsheetVersionId"  class="form-control" value="<?php echo $costsheetVersionId; ?>" />
<input type="hidden" name="bomAvgOld"  class="form-control" value="<?php echo $bomAvg; ?>" />
<input type="hidden" name="bomWidthOld"  class="form-control" value="<?php echo $bomWidth; ?>" />
<input type="hidden" name="bomUnitOld"  class="form-control" value="<?php echo $bomUnit; ?>" />
<input type="hidden" name="wastagePersentOld"  class="form-control" value="<?php echo $wastagePersent; ?>" />
<input type="hidden" name="avgIncWastageOld"  class="form-control" value="<?php echo $avgIncWastage; ?>" />
<input type="hidden" name="matCurrencyOld"  class="form-control" value="<?php echo $matCurrency; ?>" />
<input type="hidden" name="matPriceOld"  class="form-control" value="<?php echo $matPrice; ?>" />
<input type="hidden" name="materialType"  class="form-control" value="<?php echo $materialType; ?>" />
  <div class="card-body">
    <div class="row">
	  <div class="col-md-3">
		<div class="form-group">
		  <label>Amendment Type</label>
		 	<select class="form-control" name="amendType" required onchange="unclockField(this.value);">
			<option value="">Select</option>
			<?php
			$rsunit12=GetPageRecord('*','amendmentTypeMaster','1 and id in (1,8,9,10,11) order by name asc');
			while($resListingunit12=mysqli_fetch_array($rsunit12)){
			?>
				<option value="<?php echo $resListingunit12['id']; ?>"><?php echo $resListingunit12['name']; ?></option>
			<?php } ?>
			</select>
		</div>
	  </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Width/Size</label>
          <input name="bomWidth" type="text" class="form-control" id="9" value="<?php echo $bomWidth; ?>" readonly="readonly" >
        </div>
      </div>
	  <div class="col-md-3">
        <div class="form-group">
          <label>Avg/Qty.</label>
          <input name="bomAvg" type="text" class="form-control" id="1" value="<?php echo $bomAvg; ?>" readonly="readonly" >
        </div>
      </div>
	  <div class="col-md-3">
        <div class="form-group">
          <label>UOM</label>
          <select name="bomUnit" id="11" class="form-control" readonly="readonly" >
			<?php
			$selectunit='*';
			$whereunit='materialtype="'.$materialType.'" order by name asc';
			$rsunit=GetPageRecord($selectunit,'unitMaster',$whereunit);
			while($resListingunit=mysqli_fetch_array($rsunit)){
			?>
				<option value="<?php echo $resListingunit['name']; ?>" <?php if($resListingunit['name']==$bomUnit){ ?>selected<?php }?>><?php echo $resListingunit['name']; ?></option>
			<?php } ?>
        </select>
        </div>
      </div>

	  <div class="col-md-3">
        <div class="form-group">
          <label>Wastage%</label>
          <input name="wastagePersent" type="text" class="form-control" id="10" value="<?php echo $wastagePersent; ?>" readonly="readonly" >
        </div>
      </div>
	  <!--<div class="col-md-3">
        <div class="form-group">
          <label>Avg. Inc. Wastage</label>
          <input name="avgIncWastage" type="text" class="form-control" id="avgIncWastage" value="<?php echo $avgIncWastage; ?>" >
        </div>
      </div>-->
      <div class="col-md-3">
        <div class="form-group">
          <label>Price</label>
          <input name="matPrice" type="text" class="form-control" id="8" value="<?php echo $matPrice; ?>" readonly="readonly" >
        </div>
      </div>


      <!--<div class="col-md-3">
        <div class="form-group">
          <label>Requested Date</label>
		   <input type="text" name="receivedDate" id="receivedDate" value="<?php echo date('d-m-Y'); ?>" class="form-control " readonly />
         </div>
      </div>-->

      <div class="col-md-6">
        <div class="form-group">
          <label>Reason</label>
          <select class="form-control" name="reason" required >
		 		<option value="">Select</option>
				<?php
			$rsunit1=GetPageRecord('*','reasonMaster','1 order by name asc');
			while($resListingunit1=mysqli_fetch_array($rsunit1)){
			?>
				<option value="<?php echo $resListingunit1['id']; ?>"><?php echo $resListingunit1['name']; ?></option>
			<?php } ?>
			</select>
        </div>
      </div>
<script>
function unclockField(fieldId){
	if(fieldId==fieldId){
		document.getElementById(fieldId).readOnly = false;
	}
}
</script>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
    <button type="submit" class="btn bg-info">Save</button>
  </div>
  <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php }

if($_REQUEST['action']=='salesorderamedaction'){

$styleId = decode($_REQUEST['styleId']);
$sizeRowId = trim($_REQUEST['id']);
$finishOld = trim($_REQUEST['finish']);
$colorOld = trim($_REQUEST['color']);
$sizeOld = trim($_REQUEST['size']);
$gdQtyOld = trim($_REQUEST['gdQty']);

?>


<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<input type="hidden" name="styleId"  class="form-control" value="<?php echo $styleId; ?>" />
<input type="hidden" name="purchaseOrderId"  class="form-control" value="<?php echo $purchaseOrderId; ?>" />
<input type="hidden" name="finishOld"  class="form-control" value="<?php echo $finishOld; ?>" />
<input type="hidden" name="colorOld"  class="form-control" value="<?php echo $colorOld; ?>" />
<input type="hidden" name="sizeOld"  class="form-control" value="<?php echo $sizeOld; ?>" />
<input type="hidden" name="gdQtyOld"  class="form-control" value="<?php echo $gdQtyOld; ?>" />
<input type="hidden" name="sizeRowId"  class="form-control" value="<?php echo $sizeRowId; ?>" />

  <div class="card-body">
    <div class="row">
	<div class="col-md-6">
		<div class="form-group">
		  <label>Amendment Type</label>
		 	<select class="form-control" name="amendType" onChange="unclockField(this.value);" required>
			<option value="">Select</option>
			<?php
			$rsunit12=GetPageRecord('*','amendmentTypeMaster','1 and id in (3,4,5) order by name asc');
			while($resListingunit12=mysqli_fetch_array($rsunit12)){
			?>
				<option value="<?php echo $resListingunit12['id']; ?>"><?php echo $resListingunit12['name']; ?></option>
			<?php } ?>
			</select>
		</div>
	</div>
	<div class="col-md-3">
        <div class="form-group">
          <label>Destination</label>
          <input type="text" name="finish" id="finish" value="<?php echo $finishOld; ?>" class="form-control" readonly="readonly" />
        </div>
      </div>
	  <div class="col-md-3">
        <div class="form-group">
          <label>Color</label>
          <select id="color" name="color" class="form-control" readonly="readonly">
			<option value="">Select</option>
			<?php
			$select='';
			$where='';
			$rs='';
			$select='*';
			$where='1 and deletestatus=0 and status=1 order by name asc';
			$rs11=GetPageRecord('DISTINCT(name),id','colorCardMaster',$where);
			while($resListing11=mysqli_fetch_array($rs11)){
			?>
			<option value="<?php echo strip($resListing11['id']); ?>" <?php if($colorOld==$resListing11['id']){ echo 'selected';  }?>><?php echo strip($resListing11['name']); ?></option>
			<?php } ?>
		</select>
        </div>
      </div>
	  <div class="col-md-3">
        <div class="form-group">
          <label>Size</label>
          <input type="text" name="size" id="5" value="<?php echo $sizeOld; ?>" class="form-control" readonly="readonly" />
        </div>
      </div>
	  <div class="col-md-3">
        <div class="form-group">
          <label>Qty</label>
          <input type="number" name="gdQty" id="4" value="<?php echo $gdQtyOld; ?>" class="form-control" readonly="readonly"  />
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label>Reason</label>
          <select class="form-control" name="reason" required>
		 		<option value="">Select</option>
				<?php
			$rsunit1=GetPageRecord('*','reasonMaster','1 order by name asc');
			while($resListingunit1=mysqli_fetch_array($rsunit1)){
			?>
				<option value="<?php echo $resListingunit1['id']; ?>"><?php echo $resListingunit1['name']; ?></option>
			<?php } ?>
			</select>
        </div>
      </div>

    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
    <button type="submit" class="btn bg-info">Save</button>
  </div>
  <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<script>
function unclockField(fieldId){
if(fieldId==fieldId){
		document.getElementById(fieldId).readOnly = false;
}
}
</script>
<?php }

if($_REQUEST['action']=='amendactiongreige'){

$requisitionId = decode($_REQUEST['requisitionId']);
$materialId = trim($_REQUEST['materialId']);
$materialType = trim($_REQUEST['materialType']);
$finalQtyOld = trim($_REQUEST['finalQty']);

$rstype=GetPageRecord('name','materialTypeMaster','id="'.$materialType.'"');
$resListingType=mysqli_fetch_array($rstype);
?>

<div style="padding:10px;">
  <table width="100%" border="1" cellspacing="2" cellpadding="2" style="margin-top:5px;text-align: center;border: 1px solid #ccc;" class="">
   <tr style="background-color: #969696; color: #fff; font-weight: 600;">
    <td colspan="6" align="left">
	<div style="padding:5px;">
	<?php echo $resListingType['name']; ?> - <?php
	$rsunit11=GetPageRecord('name','materialMaster','id="'.$materialId.'"');
	$resListingunit11=mysqli_fetch_array($rsunit11);
	echo $resListingunit11['name'];
	?>
	</div></td>
    </tr>
</table>
</div>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<input type="hidden" name="requisitionId"  class="form-control" value="<?php echo $requisitionId; ?>" />
<input type="hidden" name="materialId"  class="form-control" value="<?php echo $materialId; ?>" />
<input type="hidden" name="materialType"  class="form-control" value="<?php echo $materialType; ?>" />
<input type="hidden" name="finalQtyOld"  class="form-control" value="<?php echo $finalQtyOld; ?>" />
  <div class="card-body">
    <div class="row">
	  <div class="col-md-3">
		<div class="form-group">
		  <label>Amendment Type</label>
		 	<select class="form-control" name="amendType" required onchange="unclockField(this.value);">
			<option value="">Select</option>
			<?php
			$rsunit12=GetPageRecord('*','amendmentTypeMaster','1 and id in (12) order by name asc');
			while($resListingunit12=mysqli_fetch_array($rsunit12)){
			?>
				<option value="<?php echo $resListingunit12['id']; ?>"><?php echo $resListingunit12['name']; ?></option>
			<?php } ?>
			</select>
		</div>
	  </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Final Qty.</label>
          <input name="finalQty" type="text" class="form-control" id="12" value="" readonly="readonly" >
        </div>
      </div>






      <div class="col-md-6">
        <div class="form-group">
          <label>Reason</label>
          <select class="form-control" name="reason" required >
		 		<option value="">Select</option>
				<?php
			$rsunit1=GetPageRecord('*','reasonMaster','1 order by name asc');
			while($resListingunit1=mysqli_fetch_array($rsunit1)){
			?>
				<option value="<?php echo $resListingunit1['id']; ?>"><?php echo $resListingunit1['name']; ?></option>
			<?php } ?>
			</select>
        </div>
      </div>
<script>
function unclockField(fieldId){
	if(fieldId==fieldId){
		document.getElementById(fieldId).readOnly = false;
	}
}
</script>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
    <button type="submit" class="btn bg-info">Save</button>
  </div>
  <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php }
?>