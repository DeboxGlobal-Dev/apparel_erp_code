<?php
include 'inc.php';

if ($_REQUEST['id'] != '') {

    $grnLastId = decode($_REQUEST['id']);

    $rschaalan = GetPageRecord('*', 'grnMaster', 'id="' . $grnLastId . '"');
    $userschaalan = mysqli_fetch_array($rschaalan);

    if ($_REQUEST['addsize'] == 1 && $_REQUEST['id'] != '' && $_REQUEST['action'] == 'addnewrow') {

        //deleteRecord('grnMaster','parentId="'.decode($_REQUEST['id']).'" and status=1');

        $wherenew = 'parentId="' . $_REQUEST['geteEntryid'] . '"';
        $rsnew = GetPageRecord('*', 'gateentrymaster', $wherenew);
        while ($rslistnew = mysqli_fetch_array($rsnew)) {
            $namevalue = 'parentId="' . decode($_REQUEST['id']) . '",supplierPurchaseOrderId="' . $rslistnew['supplierPurchaseOrderId'] . '",materialId="' . $rslistnew['materialId'] . '",materialMasterId="' . $rslistnew['materialMasterId'] . '",styleId="' . $rslistnew['styleId'] . '",color="' . $rslistnew['color'] . '",size="' . $rslistnew['size'] . '",orderQty="' . $rslistnew['orderQty'] . '",received="' . $rslistnew['qty'] . '",netReceived="' . $rslistnew['netReceived'] . '",uom="' . $rslistnew['uom'] . '",rate="' . $rslistnew['price'] . '",value="' . $rslistnew['amount'] . '",requisitionNo="' . $rslistnew['requisitionNo'] . '",indentCreationId="' . $rslistnew['indentCreationId'] . '"';
            addlistinggetlastid('grnMaster', $namevalue);
        }
    }

    if ($_REQUEST['deletestatus'] == "yes" && $_REQUEST['rowid'] != '') {
        deleteRecord('grnMaster', 'id="' . $_REQUEST['rowid'] . '"');
    }

    ?>
<?php
$netReceivedFinal = 0;
$no = 1;
    $wherenew = 'parentId="' . $grnLastId . '" order by id asc';
    $rsnew = GetPageRecord('*', 'grnMaster', $wherenew);
    while ($rslistnew = mysqli_fetch_array($rsnew)) {

        if($rslistnew['requisitionNo']==''){
            $colorMatch = ' and color="'.$rslistnew['color'].'"';
        }

        $wheresum='materialMasterId="'.$rslistnew['materialMasterId'].'" '.$colorMatch.' and ponumber="'.$_REQUEST['poid'].'"';
$rssum=GetPageRecord('SUM(qty) AS netReceivedFinal','gateentrymaster',$wheresum);
$rslistsum=mysqli_fetch_array($rssum);
$netReceivedFinal = $rslistsum['netReceivedFinal'];

        $wherw = 'materialMasterId="' . $rslistnew['materialMasterId'] . '" and poNumber="' . $_REQUEST['poid'] . '"';
        $rsnewaa = GetPageRecord('*', 'indentCreationMaster', $wherw);
        $rslistnewqw = mysqli_fetch_array($rsnewaa);

        $wherethis = 'id="' . $rslistnew['materialMasterId'] . '"';
        $rss = GetPageRecord('name,hsnCodeId', 'materialMaster', $wherethis);
        $resListing1s = mysqli_fetch_array($rss);
        $hsnCodeId = stripslashes($resListing1s['hsnCodeId']);
		$realMaterailId = stripslashes($rslistnew['materialMasterId']);

        $rs11 = GetPageRecord('name', 'colorCardMaster', 'id="' . $rslistnew['color'] . '"');
        $resListing11 = mysqli_fetch_array($rs11);
		//echo $resListing11['name'];
        ?>
<tr>
    <td><a href="javascript:void(0);" onclick="deleterow('<?php echo $rslistnew['id']; ?>');"><i class="icon-trash"
                style="font-size:13px;cursor:pointer; color:#FF0000;"></i></a></td>
    <td>
        <?php

        if ($rslistnewqw['GreigeYarn'] != '') {
            echo $rslistnewqw['styleId'];
        } else {
            if ($rslistnew['styleId'] != '0') {
                echo '#' . getStyleRefId($rslistnew['styleId']);
            } else {
                $rsgre = GetPageRecord('styleNo', 'greigeRequisition', 'requisitionNo="' . $rslistnew['requisitionNo'] . '"');
                $rslistgre = mysqli_fetch_array($rsgre);
                echo $rslistgre['styleNo'];
            }
        }

        ?>
    </td>
    <td> <?php echo getMaterialName($realMaterailId);  ?></td>
    <td align="center"><?php $HsnCode = getHsnCode($hsnCodeId);
        if ($HsnCode != '') {
            echo $HsnCode;
        } else {?>
        <a href="#"
            onclick="opmodalpop(' Edit Material','modalpop.php?action=materialmaster&isforceaction=yes&id=<?php echo encode($realMaterailId); ?>','600px','auto');"
            data-toggle="modal" data-target="#modalpop">Link HSN</a>
        <?php }?>
    </td>

    <td align="center"><?php $rs11 = GetPageRecord('name', 'colorCardMaster', 'id="' . $rslistnew['color'] . '"');
        $resListing11 = mysqli_fetch_array($rs11);
        echo $resListing11['name'];
        ?></td>
    <td align="center"><?php echo $rslistnew['orderQty']; ?></td>
    <td><input type="text" name="received" id="received<?php echo $rslistnew['id']; ?>"
            value="<?php echo $rslistnew['received']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();"
            style="width:80px;text-align: center;" readonly="readonly" /></td>
    <!-- <td><input type="text" name="qcShortage" id="qcShortage<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['qcShortage']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" /></td>-->
    <td><input type="text" name="netReceived" id="netReceived<?php echo $rslistnew['id']; ?>"
            value="<?php echo $rslistnew['netReceived']; //$netReceivedFinal;  ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();"
            style="width:80px;text-align: center;" readonly="readonly" /></td>

    <td><input type="text" name="uom" id="uom<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['uom']; ?>"
            onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;text-align: center;"
            readonly="readonly" /></td>
    <td><input type="text" name="balQty" id="balQty<?php echo $rslistnew['id']; ?>" value=""
            style="width:80px;text-align: center;" readonly /></td>
    <td><input type="text" name="rate" id="rate<?php echo $rslistnew['id']; ?>"
            value="<?php echo $rslistnew['rate']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();"
            style="width:80px;text-align: center;" readonly="readonly" /></td>
    <td><input type="text" name="value" class="amount" id="value<?php echo $rslistnew['id']; ?>"
            value="<?php echo $rslistnew['value']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();"
            style="width:80px;text-align: center;" readonly="readonly" /></td>
    <!--   <td><input type="text" name="excess" id="excess<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['excess']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" /></td>-->
</tr>


<script>
function savelinedetail<?php echo $rslistnew['id']; ?>() {
    var qtyShipBySupplier = $('#qtyShipBySupplier<?php echo $rslistnew['id']; ?>').val();
    var received = $('#received<?php echo $rslistnew['id']; ?>').val();
    var qcShortage = $('#qcShortage<?php echo $rslistnew['id']; ?>').val();
    var netReceived = $('#netReceived<?php echo $rslistnew['id']; ?>').val();
    var sqmQty = $('#sqmQty<?php echo $rslistnew['id']; ?>').val();
    var uom = $('#uom<?php echo $rslistnew['id']; ?>').val();
    var rate = $('#rate<?php echo $rslistnew['id']; ?>').val();

    var orderQty = Number('<?php echo $rslistnew['orderQty']; ?>');

    var totalRemain = Number(orderQty - netReceived);
    $('#balQty<?php echo $rslistnew['id']; ?>').val(totalRemain);

    var totalval = Number(netReceived * rate).toFixed(2);
    var value = $('#value<?php echo $rslistnew['id']; ?>').val(totalval);

    //var excess = encodeURI($('#excess<?php echo $rslistnew['id']; ?>').val());

    $('#savedata').load(
        'savechaalandetail.php?action=savegrnitemqty&id=<?php echo $rslistnew['id']; ?>&qtyShipBySupplier=' +
        qtyShipBySupplier + '&received=' + received + '&qcShortage=' + qcShortage + '&netReceived=' + netReceived +
        '&sqmQty=' + sqmQty + '&uom=' + uom + '&rate=' + rate + '&value=' + totalval);

        var totalamount=0;
$('.amount').each(function() {
 totalamount += Number($(this).val());
});
totalamount= parseFloat(totalamount).toFixed(2);
$('#totalAmount').val(totalamount);
console.log(totalamount);


}
savelinedetail<?php echo $rslistnew['id']; ?>();
</script>

<?php $no++;}?>

<?php
if ($no == 1) {
        ?>
<tr>
    <td colspan="50" style="text-align: center;">No record found.</td>
</tr>
<?php }?>


<?php }?>