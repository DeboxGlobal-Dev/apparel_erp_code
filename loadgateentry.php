<?php
include('inc.php');
if($_REQUEST['id']!=''){

$grnLastId = decode($_REQUEST['id']);
$rschaalan=GetPageRecord('*','gateentrymaster','id="'.$grnLastId.'"');
$userschaalan=mysqli_fetch_array($rschaalan);

if($_REQUEST['addsize']==1 && $_REQUEST['id']!='' && $_REQUEST['action']=='addnewrow'){

	$no=1;
	$totalqty = 0;
	$wherenew='poNumber="'.$_REQUEST['poid'].'"';
	$rsnew=GetPageRecord('*','indentCreationMaster',$wherenew);
	while($rslistnew=mysqli_fetch_array($rsnew)){
		if($rslistnew['requisitionNo']==''){
			$styleId= $rslistnew['styleId'];
			$requisitionNo= '';
		}else{
			$styleId= '';
			$requisitionNo= $rslistnew['requisitionNo'];
		}

	if($rslistnew['poTypeId']==4){

		$totalqty = $totalqty+$rslistnew['orderQty'];

		if($no==1){

			$rsorderQty=GetPageRecord('SUM(orderQty) as TotalQty','indentCreationMaster','poNumber="'.$_REQUEST['poid'].'" and materialMasterId="'.$rslistnew['materialMasterId'].'"');
			$rsorderQtyFinal=mysqli_fetch_array($rsorderQty);

			$namevalue ='parentId="'.decode($_REQUEST['id']).'",supplierPurchaseOrderId="'.$_REQUEST['poid'].'",styleId="'.$styleId.'",materialId="'.$rslistnew['materialId'].'",uom="'.$rslistnew['uom'].'",orderQty="'.$rsorderQtyFinal['TotalQty'].'",price="'.$rslistnew['sellingRate'].'",color="'.$rslistnew['color'].'",size="'.$rslistnew['size'].'",requisitionNo="'.$rslistnew['requisitionNo'].'",ponumber="'.$_REQUEST['poid'].'",indentCreationId="'.$rslistnew['id'].'",materialMasterId="'.$rslistnew['materialMasterId'].'"';
			addlistinggetlastid('gateentrymaster',$namevalue);
		}
	}else{

		$namevalue ='parentId="'.decode($_REQUEST['id']).'",supplierPurchaseOrderId="'.$_REQUEST['poid'].'",styleId="'.$styleId.'",materialId="'.$rslistnew['materialId'].'",uom="'.$rslistnew['uom'].'",orderQty="'.$rslistnew['orderQty'].'",price="'.$rslistnew['sellingRate'].'",color="'.$rslistnew['color'].'",size="'.$rslistnew['size'].'",requisitionNo="'.$rslistnew['requisitionNo'].'",ponumber="'.$_REQUEST['poid'].'",indentCreationId="'.$rslistnew['id'].'",materialMasterId="'.$rslistnew['materialMasterId'].'"';

		addlistinggetlastid('gateentrymaster',$namevalue);
	}


	$no++;

	}


}
if($_REQUEST['deletestatus']=="yes" && $_REQUEST['rowid']!=''){
deleteRecord('gateentrymaster','id="'.$_REQUEST['rowid'].'"');
}
?>
<?php
$netReceivedFinal = 0;
$no = 1;
$wherenew='parentId="'.$grnLastId.'" order by id asc';
$rsnew=GetPageRecord('*','gateentrymaster',$wherenew);
while($rslistnew=mysqli_fetch_array($rsnew)){

if($rslistnew['requisitionNo']==''){
	$colorMatch = ' and color="'.$rslistnew['color'].'"';
}

$wheresum='materialMasterId="'.$rslistnew['materialMasterId'].'" '.$colorMatch.' and ponumber="'.$_REQUEST['poid'].'"';
$rssum=GetPageRecord('SUM(qty) AS netReceivedFinal','gateentrymaster',$wheresum);
$rslistsum=mysqli_fetch_array($rssum);
$netReceivedFinal = $rslistsum['netReceivedFinal'];
?>
<tr>
    <td><a href="javascript:void(0);" onclick="deleterow('<?php echo $rslistnew['id']; ?>');">
	<i class="icon-trash"
                style="font-size:13px;cursor:pointer; color:#FF0000;"></i></a></td>
    <td> <?php echo getMaterialName($rslistnew['materialMasterId']); ?>  </td>
    <td>
        <?php
	$rs11=GetPageRecord('name','colorCardMaster','id="'.$rslistnew['color'].'"');
	$resListing11=mysqli_fetch_array($rs11);
	echo $resListing11['name'];
	?>
    </td>
    <td align="center"><?php echo $rslistnew['orderQty']; ?></td>
    <td><input type="text" name="qty" id="qty<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['qty']; ?>"
    <?php if($_REQUEST['addsize']==1){ ?> onBlur="savelinedetail<?php echo $rslistnew['id']; ?>();" <?php } ?> <?php if($_REQUEST['addsize']!=1){ ?>readonly<?php } ?> style="width:80px;" /></td>
    <td><input type="text" name="netReceived" id="netReceived<?php echo $rslistnew['id']; ?>"
            value="<?php if($_REQUEST['addsize']!=1){ echo $rslistnew['netReceived']; }else{ echo $rslistnew['netReceived']; } ?>" <?php if($_REQUEST['addsize']==1){ ?> onBlur="savelinedetail<?php echo $rslistnew['id']; ?>();" <?php } ?> <?php if($_REQUEST['addsize']!=1){ ?>readonly<?php } ?> style="width:80px;" /></td>
    <td align="center"><?php echo $rslistnew['uom']; ?></td>
    <td><input type="text" name="price" id="price<?php echo $rslistnew['id']; ?>"
            value="<?php echo $rslistnew['price']; ?>" style="width:80px;" readonly="readonly"></td>
    <td><input type="text" name="packages" id="packages<?php echo $rslistnew['id']; ?>"
            value="<?php echo $rslistnew['packages']; ?>" <?php if($_REQUEST['addsize']==1){ ?> onBlur="savelinedetail<?php echo $rslistnew['id']; ?>();" <?php } ?> style="width:80px;" <?php if($_REQUEST['addsize']!=1){ ?>readonly<?php } ?> /></td>
    <td style="display:none;"><input type="text" name="amount" id="amount<?php echo $rslistnew['id']; ?>"
            value="<?php echo $rslistnew['amount']; ?>" onBlur="savelinedetail<?php echo $rslistnew['id']; ?>();"
            style="width:80px;" readonly></td>
    <td><input type="text" name="dispatch" id="dispatch<?php echo $rslistnew['id']; ?>"
            value="<?php echo $rslistnew['dispatch']; ?>" <?php if($_REQUEST['addsize']==1){ ?> onBlur="savelinedetail<?php echo $rslistnew['id']; ?>();" <?php } ?> style="width:80px;" <?php if($_REQUEST['addsize']!=1){ ?>readonly<?php } ?> /></td>

</tr>
<script>
function savelinedetail<?php echo $rslistnew['id']; ?>() {
     <?php if($_REQUEST['addsize']==1){ ?>
        var qty = encodeURI($('#qty<?php echo $rslistnew['id']; ?>').val());

        var netReceivedFinal = '<?php echo $netReceivedFinal; ?>';
        var enterFinalQty = Number(qty)+Number(netReceivedFinal);
        //$('#netReceived<?php echo $rslistnew['id']; ?>').val(enterFinalQty);

        var totalOrderQty = '<?php echo $rslistnew['orderQty']; ?>';
        ////Add 5 % in order total qty
        var totalOrderQtyPlus5 = Number((totalOrderQty * 5) / 100);
        totalOrderQtyPlus5 = Number(totalOrderQty) + Number(totalOrderQtyPlus5);
        ////Subtract 5 % in order total qty
        var totalOrderQtySub5 = Number((totalOrderQty * 5) / 100);
        totalOrderQtySub5 = Number(totalOrderQty) - Number(totalOrderQtySub5);

    // if (enterFinalQty > totalOrderQtyPlus5) {
    //    // alert('You can not enter more then 5% of order Quantity.');
    //     //encodeURI($('#qty<?php echo $rslistnew['id']; ?>').val(0));
    // } else {
    //     var enterQty = encodeURI($('#qty<?php echo $rslistnew['id']; ?>').val());
    // }
    var enterQty = encodeURI($('#qty<?php echo $rslistnew['id']; ?>').val());
    var netReceived = encodeURI($('#netReceived<?php echo $rslistnew['id']; ?>').val());
    var packages = encodeURI($('#packages<?php echo $rslistnew['id']; ?>').val());
    var price = encodeURI($('#price<?php echo $rslistnew['id']; ?>').val());
    var amount1 = Number(netReceived * price);
    $('#amount<?php echo $rslistnew['id']; ?>').val(amount1.toFixed(2));
    var amount = encodeURI($('#amount<?php echo $rslistnew['id']; ?>').val());
    var dispatch = encodeURI($('#dispatch<?php echo $rslistnew['id']; ?>').val());

    $('#savedata').load('allaction.php?action=gateentrydetail&id=<?php echo $rslistnew['id']; ?>&qty=' + enterQty +
        '&packages=' + packages + '&amount=' + amount + '&dispatch=' + dispatch + '&netReceived=' + netReceived);
    <?php } ?>
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