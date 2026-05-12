<?php
include('inc.php');

if($_REQUEST['id']!=''){

$grnLastId = decode($_REQUEST['id']);

$rschaalan=GetPageRecord('*','grnMaster','id="'.$grnLastId.'"');
$userschaalan=mysqli_fetch_array($rschaalan);

if($_REQUEST['addsize']==1 && $_REQUEST['id']!='' && $_REQUEST['action']=='addnewrow'){
	$namevalue ='parentId="'.decode($_REQUEST['id']).'"';
	addlistinggetlastid('grnMaster',$namevalue);
}


if($_REQUEST['deletestatus']=="yes" && $_REQUEST['rowid']!=''){
deleteRecord('grnMaster','id="'.$_REQUEST['rowid'].'"');
}

?><style type="text/css">
<!--
.style1 {font-size: 16px}
-->
</style>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
				<div class="card-body">
				<div class="form-group">
				<div class="row">


<table width="100%" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#000000" style="border:1px #ccc;">
  <tr>
    <td align="center"><div style="font-size:16px; font-weight:bold; "> <?php echo $userschaalan['grnNo']; ?></div></td>
  </tr>

  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>

       <!-- <td width="30%" align="left" valign="top"><label for="supplierId" style="margin-bottom:2px;">From</label>
		<select id="supplierId" name="supplierId" class="form-control" onchange="showsupplierdetail(this.value);">
		<option value="">Select</option>
		 <?php
		$select='';
		$where='';
		$rs='';
		$select='*';
		$where='1 and deletestatus=0 order by name asc';
		$rs=GetPageRecord($select,'suppliersMaster',$where);
		while($resListing=mysqli_fetch_array($rs)){
		?>
		<option value="<?php echo strip($resListing['id']); ?>" <?php if($userschaalan['supplierId']==$resListing['id']){ ?> selected <?php }?>><?php echo strip($resListing['name']); ?></option>
		<?php } ?>
		</select>

		<div id="showsupplierdetail" style="display:none;">
		<div style="background-color: #f1f1f1; padding: 15px; margin-top: 8px;">
		  <p>name:dfdsfsdsfd<br />addressfsdfdfdfgdgdf<br />
		  Phone:<br />
		  Email<br />
		  GSTIN: <br />
		  TIN No:<br />
		  CIN No:
		  </p>
		</div>
		</div>
		<script>
		function showsupplierdetail(id){
			$('#showsupplierdetail').load('apparelbomaction.php?action=showsupplierdetail&id='+id);
		}

		showsupplierdetail('<?php echo $userschaalan['supplierId']; ?>');
		</script>
		</td>

		<td width="30%" align="left" valign="top"><label for="factoryId" style="margin-bottom:2px;">Shipped To</label>
		<select id="workPlaceId" name="workPlaceId"  class="form-control" onchange="showworkplacedetail(this.value);">
		<option value="">Select</option>
		 <?php
		$select='';
		$where='';
		$rs='';
		$select='*';
		$where='1 and status=1 order by name asc';
		$rs=GetPageRecord($select,'workplaceMaster',$where);
		while($resListing=mysqli_fetch_array($rs)){
		?>
		<option value="<?php echo strip($resListing['id']); ?>" <?php if($userschaalan['workPlaceId']==$resListing['id']){ ?> selected <?php }?> ><?php echo strip($resListing['name']); ?></option>
		<?php } ?>
		</select>

		<script>
		function showworkplacedetail(id){
			$('#showworkplacedetail').load('apparelbomaction.php?action=showworkplacedetail&id='+id);
		}

		showworkplacedetail('<?php echo $userschaalan['workPlaceId']; ?>');
		</script>

		<div id="showworkplacedetail" style="display:none;"></div>

		</td>-->
		<td width="40%" align="left" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">

  <tr>
    <td>Doc.&nbsp;No:</td>
    <td><input type="text" name="docNo" id="docNo" value="<?php echo $userschaalan['docNo']; ?>"/></td>
  </tr>
  <script>
$(function(){
	$("#docDate").datepicker();
	$("#ginDate").datepicker();
	$("#eWayBillDate").datepicker();
});
</script>
  <tr>
    <td>Doc.&nbsp;Date:</td>
    <td><input type="text" name="docDate" id="docDate" value="<?php if($userschaalan['docDate']=='0000-00-00'){ echo date('d-m-Y'); }else{  echo date('d-m-Y', strtotime($userschaalan['docDate'])); } ?>"/></td>
  </tr>
  <tr>
    <td>QC&nbsp;Status: </td>
    <td><input type="text" name="qcStatus" id="qcStatus" value="<?php echo $userschaalan['qcStatus']; ?>"/></td>
  </tr>
  <tr>
    <td>E-Way&nbsp;Bill&nbsp;No: </td>
    <td><input type="text" name="eWayBill" id="eWayBill"  value="<?php echo $userschaalan['eWayBill']; ?>" /></td>
  </tr>
  <tr>
    <td>E-Way&nbsp;Bill&nbsp;Date:</td>
    <td><input type="text" name="eWayBillDate" id="eWayBillDate" value="<?php if($userschaalan['eWayBillDate']=='0000-00-00'){ echo date('d-m-Y'); }else{  echo date('d-m-Y', strtotime($userschaalan['eWayBillDate'])); } ?>" /></td>
  </tr>
  <tr>
    <td>GIN&nbsp;No:</td>
    <td><input type="text" name="ginNo" id="ginNo" value="<?php echo $userschaalan['ginNo']; ?>" /></td>
  </tr>
  <tr>
    <td>GIN&nbsp;Date: </td>
    <td><input type="text" name="ginDate" id="ginDate" value="<?php if($userschaalan['ginDate']=='0000-00-00'){ echo date('d-m-Y'); }else{  echo date('d-m-Y', strtotime($userschaalan['ginDate'])); } ?>" /></td>
  </tr>
  <tr>
    <td>E-Sungam&nbsp;Number: </td>
    <td><input type="text" name="eSungamNo" id="eSungamNo" value="<?php echo $userschaalan['eSungamNo']; ?>" /></td>
  </tr>
</table>
</td>
      </tr>
    </table></td>
  </tr>

  <tr>
    <td>Purchase Order No: <input type="text" name="supplierPurchaseOrderId" id="supplierPurchaseOrderId" value="<?php echo $userschaalan['supplierPurchaseOrderId']; ?>" /></td>
  </tr>
  <tr>
    <td>
	<div style="width:1300px; overflow:hidden;">
	<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#000000" class="table table-responsive">
      <tr style="color:#FFFFFF;">
	  <td bgcolor="#333333"><strong><a href="javascript:void(0);" onclick="addnewline('<?php echo encode($grnLastId); ?>');"><i class="fa fa-plus" aria-hidden="true" style="font-size:17px;cursor:pointer; color:#f7f7f7;"></i></a></strong></td>
        <td bgcolor="#333333" align="center"><strong>Material</strong></td>
        <td bgcolor="#333333" align="center"><strong>HSN&nbsp;Code</strong></td>
		<td bgcolor="#333333" align="center"><strong>Color</strong></td>
        <td bgcolor="#333333" align="center"><strong>Size</strong></td>
		<td bgcolor="#333333" align="center"><strong>Style</strong></td>
		<td bgcolor="#333333" align="center"><strong>Season</strong></td>
	<!--	<td bgcolor="#333333"><strong>Ship&nbsp;By&nbsp;Supplier</strong></td>-->
		<td bgcolor="#333333" align="center"><strong>Received</strong></td>
		<!--<td bgcolor="#333333" align="center"><strong>QC&nbsp;Storage</strong></td>
		<td bgcolor="#333333" align="center"><strong>Net&nbsp;Received</strong></td>
		<td bgcolor="#333333" align="center"><strong>SQM&nbsp;Qty</strong></td>-->
  		<td bgcolor="#333333" align="center"><strong>UOM</strong></td>
        <td bgcolor="#333333" align="center"><strong>Rate(INR)</strong></td>
		<td bgcolor="#333333" align="center"><strong>Value(INR)</strong></td>
		<td bgcolor="#333333" align="center"><strong>Excess/Short(+/-)</strong></td>

      </tr>

	<?php
	$wherenew='parentId="'.decode($_REQUEST['id']).'" order by id asc';
	$rsnew=GetPageRecord('*','grnMaster',$wherenew);
	while($rslistnew=mysqli_fetch_array($rsnew)){
	?>
      <tr>
	  <td><a href="javascript:void(0);" onclick="deleterow('<?php echo $rslistnew['id']; ?>');"><i class="icon-trash" style="font-size:13px;cursor:pointer; color:#FF0000;"></i></a></td>
       	<td><select id="materialId<?php echo $rslistnew['id']; ?>" name="materialId"  class="select2 form-control" style="width:186px;" onchange="savelinedetail<?php echo $rslistnew['id']; ?>();">
		<option value="">Select</option>
		 <?php
		$select='';
		$where='';
		$rs='';
		$select='*';
		$where='1 and deletestatus=0 and status=1 order by name asc';
		$rs=GetPageRecord($select,'materialMaster',$where);
		while($resListing=mysqli_fetch_array($rs)){
		?>
		<option value="<?php echo strip($resListing['id']); ?>" <?php if($rslistnew['materialId']==$resListing['id']){ ?> selected <?php }?> ><?php echo strip($resListing['name']); ?></option>
		<?php } ?>
		</select></td>
        <td align="center"><input type="text" name="hsnCode" id="hsnCode<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['hsnCode']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px; text-align:center;" /></td>
        <td align="center"><input type="text" name="color" id="color<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['hsnCode']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px; text-align:center;" /></td>
        <td align="center"><input type="text" name="size" id="size<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['size']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px; text-align:center;" /></td>
        <td><select id="styleId<?php echo $rslistnew['id']; ?>" name="styleId"  class="form-control" style="width:150px;" onchange="savelinedetail<?php echo $rslistnew['id']; ?>();">
		<option value="">Select</option>
		 <?php
		$select='';
		$where='';
		$rs='';
		$select='*';
		$where='1 and subject!="" and deletestatus=0 order by id desc';
		$rs=GetPageRecord($select,'queryMaster',$where);
		while($resListing=mysqli_fetch_array($rs)){
		?>
		<option value="<?php echo strip($resListing['id']); ?>" <?php if($rslistnew['styleId']==$resListing['id']){ ?> selected <?php }?> ><?php echo '#'.strip($resListing['styleRefId']); ?></option>
		<?php } ?>
		</select></td>
        <td><input type="text" name="season" id="season<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['season']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" /></td>
		<!--<td><input type="number" name="qtyShipBySupplier" id="qtyShipBySupplier<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['qtyShipBySupplier']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" /></td>-->
		<td><input type="text" name="received" id="received<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['received']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" /></td>
	<!--	<td><input type="text" name="qcShortage" id="qcShortage<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['qcShortage']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" /></td>
		<td><input type="number" name="netReceived" id="netReceived<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['netReceived']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" /></td>
		<td><input type="number" name="sqmQty" id="sqmQty<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['sqmQty']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" /></td>-->
		<td><input type="text" name="uom" id="uom<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['uom']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" /></td>
		<td><input type="number" name="rate" id="rate<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['rate']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" /></td>
		<td><input type="number" name="value" id="value<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['value']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" /></td>
		<td><input type="text" name="excess" id="excess<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['excess']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" /></td>

      </tr>


<script>

$(document).ready(function() {
$(".select2").select2();
});
</script>


		<div id="loaddelgrn" style="display:none;"></div>
<script>
function savelinedetail<?php echo $rslistnew['id']; ?>(){

var materialId = encodeURI($('#materialId<?php echo $rslistnew['id']; ?>').val());
var hsnCode = encodeURI($('#hsnCode<?php echo $rslistnew['id']; ?>').val());
var color = encodeURI($('#color<?php echo $rslistnew['id']; ?>').val());
var size = encodeURI($('#size<?php echo $rslistnew['id']; ?>').val());
var styleId = encodeURI($('#styleId<?php echo $rslistnew['id']; ?>').val());
var season = encodeURI($('#season<?php echo $rslistnew['id']; ?>').val());
var qtyShipBySupplier = $('#qtyShipBySupplier<?php echo $rslistnew['id']; ?>').val();
var received = $('#received<?php echo $rslistnew['id']; ?>').val();
var qcShortage = $('#qcShortage<?php echo $rslistnew['id']; ?>').val();
var netReceived = $('#netReceived<?php echo $rslistnew['id']; ?>').val();
var sqmQty = $('#sqmQty<?php echo $rslistnew['id']; ?>').val();
var uom = $('#uom<?php echo $rslistnew['id']; ?>').val();
var rate = $('#rate<?php echo $rslistnew['id']; ?>').val();
var value = $('#value<?php echo $rslistnew['id']; ?>').val();
var excess = encodeURI($('#excess<?php echo $rslistnew['id']; ?>').val());


$('#savedetails').load('savechaalandetail.php?materialId='+materialId+'&hsnCode='+hsnCode+'&color='+color+'&size='+size+'&styleId='+styleId+'&season='+season+'&qtyShipBySupplier='+qtyShipBySupplier+'&received='+received+'&qcShortage='+qcShortage+'&netReceived='+netReceived+'&sqmQty='+sqmQty+'&uom='+uom+'&rate='+rate+'&value='+value+'&excess='+excess+'&action=savegrnitemqty&id=<?php echo encode($rslistnew['id']); ?>');

}
</script>

<?php }  ?>
<div id="savedetails"></div>
	   <tr style="color:#FFFFFF;">
        <td bgcolor="#333333" colspan="50">&nbsp;</td>

      </tr>
    </table>
	</div>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td style="border-bottom:1px solid #000;"><strong>Additional Charges Details:</strong> <input type="text" name="chargesDetail"  id="chargesDetail" value="<?php echo $userschaalan['chargesDetail']; ?>"/></td>
  </tr>
   <tr>
    <td style="border-bottom:1px solid #000;">&nbsp;</td>
  </tr>

   <tr>
    <td style="border-bottom:1px solid #000;"><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td><strong>Entered By:</strong></td>
        <td><strong>Created By: </strong></td>
        <td><strong>Authorised By:</strong></td>
        <td><strong>Received By: </strong></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
				</div>
				</div>

				<input type="hidden" name="module" value="grn">
				<input type="hidden" name="action" value="editgrn">
				<input type="hidden" name="editId" value="<?php echo encode($grnLastId); ?>">
				<div class="text-right">
					<button type="buttton" style="margin:0px;" class="btn btn-primary">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>

				    <label>

				    </label>
				</div>
				</div>

				</form>

				<div id="savechaalandetail"></div>
<script>
/*function saveChaalan(){
var departmentId = $('#departmentId').val();
var fromDepartmentId = $('#fromDepartmentId').val();
var gdiRemark = encodeURI($('#gdiRemark').val());
var chargesDetail = encodeURI($('#chargesDetail').val());
var styleId = '<?php echo $_REQUEST['styleId']; ?>';
var chaalanId = '<?php echo encode($grnLastId); ?>';
$('#savechaalandetail').load('savechaalandetail.php?action=savechaalanparentdetail&id='+chaalanId+'&departmentId='+departmentId+'&fromDepartmentId='+fromDepartmentId+'&gdiRemark='+gdiRemark+'&chargesDetail='+chargesDetail+'&styleId='+styleId);

}*/


</script>

<?php } ?>