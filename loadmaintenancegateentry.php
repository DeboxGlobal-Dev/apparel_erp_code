<?php
include('inc.php');
if($_REQUEST['id']!=''){
$grnLastId = decode($_REQUEST['id']);
$rschaalan=GetPageRecord('*','maintenancegateentrymaster','id="'.$grnLastId.'"');
$userschaalan=mysqli_fetch_array($rschaalan);




	$wherenew='id="'.$_REQUEST['poid'].'"';
	$rsnew=GetPageRecord('*','requisitionIndentMaster',$wherenew);
$rslistnew=mysqli_fetch_array($rsnew);

	$wherenewd='id="'.$rslistnew['mainid'].'"';
	$rsnewd=GetPageRecord('*','loadmaintenance',$wherenewd);
$rslistnewd=mysqli_fetch_array($rsnewd);

$wherenewde='id="'.$rslistnewd['item'].'"';
	$rsnewde=GetPageRecord('*','maintenancegeneral_Master',$wherenewde);
$rslistnewde=mysqli_fetch_array($rsnewde);

$wherenewder='id="'.$rslistnewd['parentId'].'"';
	$rsnewder=GetPageRecord('*','maintenancegi_Master',$wherenewder);
$rslistnewder=mysqli_fetch_array($rsnewder);
if($_REQUEST['addsize']==1 && $_REQUEST['id']!='' && $_REQUEST['action']=='addnewrow'){





	$namevalue ='parentId="'.decode($_REQUEST['id']).'",supplierPurchaseOrderId="'.$_REQUEST['poid'].'",materialId="'.$rslistnewde['id'].'",uom="'.$rslistnewd['uom'].'",orderQty="'.$rslistnew['orderQty'].'",price="'.$rslistnewd['price'].'",color="'.$rslistnewde['color'].'",size="'.$rslistnewd['size'].'",requisitionNo="'.$rslistnewder['requisitionno'].'"';

	addlistinggetlastid('maintenancegateentrymaster',$namevalue);




}
if($_REQUEST['deletestatus']=="yes" && $_REQUEST['rowid']!=''){
deleteRecord('maintenancegateentrymaster','id="'.$_REQUEST['rowid'].'"');
}
?>
<?php
$no = 1;
$wherenew='parentId="'.$grnLastId.'" order by id asc';
$rsnew=GetPageRecord('*','maintenancegateentrymaster',$wherenew);
while($rslistnew=mysqli_fetch_array($rsnew)){
?>
<tr>
  <td><a href="javascript:void(0);" onclick="deleterow('<?php echo $rslistnew['id']; ?>');"><i class="icon-trash" style="font-size:13px;cursor:pointer; color:#FF0000;"></i></a></td>
  <td>

 <?php


 echo $rslistnewde['material'];

 ?>
	</td>
	<td>

  </td>
  <td align="center"><?php echo $rslistnew['orderQty']; ?></td>
  <td><input type="text" name="qty" id="qty<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['qty']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" /></td>
   <td><input type="text" name="netReceived" id="netReceived<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['netReceived']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" /></td>
  <td align="center"><?php echo $rslistnew['uom']; ?></td>
  <td><input type="text" name="price" id="price<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['price']; ?>" style="width:80px;" ></td>
  <td><input type="text" name="packages" id="packages<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['packages']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" /></td>
  <td><input type="text" name="amount" id="amount<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['amount']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" readonly></td>
  <td><input type="text" name="dispatch" id="dispatch<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['dispatch']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" /></td>

</tr>
<script>
function savelinedetail<?php echo $rslistnew['id']; ?>(){
	var qty = encodeURI($('#qty<?php echo $rslistnew['id']; ?>').val());
	var netReceived = encodeURI($('#netReceived<?php echo $rslistnew['id']; ?>').val());
	var packages = encodeURI($('#packages<?php echo $rslistnew['id']; ?>').val());
	var price = encodeURI($('#price<?php echo $rslistnew['id']; ?>').val());
	var amount1 = Number(netReceived*price);
	$('#amount<?php echo $rslistnew['id']; ?>').val(amount1.toFixed(2));
	var amount = encodeURI($('#amount<?php echo $rslistnew['id']; ?>').val());
	var dispatch = encodeURI($('#dispatch<?php echo $rslistnew['id']; ?>').val());

	$('#savedata').load('allaction.php?action=maintenancegateentrydetail&id=<?php echo $rslistnew['id']; ?>&qty='+qty+'&packages='+packages+'&amount='+amount+'&dispatch='+dispatch+'&netReceived='+netReceived);
}
</script>
<?php $no++; }  ?>
<?php
if($no==1){
?>
<tr>
  <td colspan="50" style="text-align: center;">No record found.</td>
</tr>
<?php } ?>
<?php } ?>
