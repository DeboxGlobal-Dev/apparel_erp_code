<?php
include('inc.php');

if($_REQUEST['id']!=''){

$grnLastId = decode($_REQUEST['id']);

$rschaalan=GetPageRecord('*','maintenancegateentrymaster','id="'.$_REQUEST['geteEntryid'].'"');
$userschaalan=mysqli_fetch_array($rschaalan);

if($_REQUEST['addsize']==1 && $_REQUEST['id']!='' && $_REQUEST['action']=='addnewrow'){

	//deleteRecord('grnMaster','parentId="'.decode($_REQUEST['id']).'" and status=1');

	$wherenew='parentId="'.$_REQUEST['geteEntryid'].'"';
	$rsnew=GetPageRecord('*','maintenancegateentrymaster',$wherenew);
	$rslistnew=mysqli_fetch_array($rsnew);
		$namevalue ='parentId="'.decode($_REQUEST['id']).'",supplierPurchaseOrderId="'.$rslistnew['supplierPurchaseOrderId'].'",materialId="'.$rslistnew['materialId'].'",styleId="'.$rslistnew['styleId'].'",color="'.$rslistnew['color'].'",size="'.$rslistnew['size'].'",orderQty="'.$rslistnew['orderQty'].'",received="'.$rslistnew['qty'].'",netReceived="'.$rslistnew['netReceived'].'",uom="'.$rslistnew['uom'].'",rate="'.$rslistnew['price'].'",value="'.$rslistnew['amount'].'",requisitionNo="'.$rslistnew['requisitionNo'].'"';
		addlistinggetlastid('maintenancegrnMaster',$namevalue);

}


if($_REQUEST['deletestatus']=="yes" && $_REQUEST['rowid']!=''){
deleteRecord('maintenancegrnMaster','id="'.$_REQUEST['rowid'].'"');
}

?>
					<?php
					$no = 1;
					$wherenew='parentId="'.$grnLastId.'" order by id asc';
					$rsnew=GetPageRecord('*','maintenancegrnMaster',$wherenew);
					$rslistnew=mysqli_fetch_array($rsnew);


				// 	$rs11=GetPageRecord('name','colorCardMaster','id="'.$rslistnew['color'].'"');
				// 	$resListing11=mysqli_fetch_array($rs11);
				// 	echo $resListing11['name'];
					?>
                  <tr>
                    <td><a href="javascript:void(0);" onclick="deleterow('<?php echo $rslistnew['id']; ?>');"><i class="icon-trash" style="font-size:13px;cursor:pointer; color:#FF0000;"></i></a></td>
					 <td style="text-align:center;"><?php echo $rslistnew['requisitionNo']; ?></td>
                    <td style="text-align:center;"> <?php
					$wherenew='id="'.$userschaalan['ponumber'].'"';
	$rsnew=GetPageRecord('*','requisitionIndentMaster',$wherenew);
$rslistneww=mysqli_fetch_array($rsnew);

	$wherenewd='id="'.$rslistneww['mainid'].'"';
	$rsnewd=GetPageRecord('*','loadmaintenance',$wherenewd);
$rslistnewd=mysqli_fetch_array($rsnewd);

$wherenewde='id="'.$rslistnewd['item'].'"';
	$rsnewde=GetPageRecord('*','maintenancegeneral_Master',$wherenewde);
$rslistnewde=mysqli_fetch_array($rsnewde);

						echo $rslistnewde['material'];
					?></td>
                    <!--<td align="center">-</td>-->

                    <td align="center"><?php $rs11=GetPageRecord('name','colorCardMaster','id="'.$rslistnew['color'].'"');
							$resListing11=mysqli_fetch_array($rs11);
							echo $resListing11['name'];
							 ?></td>
                    <td align="center"><?php echo $rslistnew['orderQty']; ?></td>
                    <td><input type="text" name="received" id="received<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['received']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;text-align: center;" readonly="readonly" /></td>
                   <!-- <td><input type="text" name="qcShortage" id="qcShortage<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['qcShortage']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" /></td>-->
                    <td><input type="text" name="netReceived" id="netReceived<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['netReceived']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;text-align: center;" readonly="readonly" /></td>

                    <td><input type="text" name="uom" id="uom<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['uom']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;text-align: center;" readonly="readonly" /></td>
					<td><input type="text" name="balQty" id="balQty<?php echo $rslistnew['id']; ?>" value="" style="width:80px;text-align: center;" readonly /></td>
                    <td><input type="text" name="rate" id="rate<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['rate']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;text-align: center;" readonly="readonly" /></td>
                    <td><input type="text" name="value" id="value<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['value']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;text-align: center;" readonly="readonly" /></td>
                 <!--   <td><input type="text" name="excess" id="excess<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['excess']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" /></td>-->
                  </tr>


				<script>
				function savelinedetail<?php echo $rslistnew['id']; ?>(){
				var qtyShipBySupplier = $('#qtyShipBySupplier<?php echo $rslistnew['id']; ?>').val();
				var received = $('#received<?php echo $rslistnew['id']; ?>').val();
				var qcShortage = $('#qcShortage<?php echo $rslistnew['id']; ?>').val();
				var netReceived = $('#netReceived<?php echo $rslistnew['id']; ?>').val();
				var sqmQty = $('#sqmQty<?php echo $rslistnew['id']; ?>').val();
				var uom = $('#uom<?php echo $rslistnew['id']; ?>').val();
				var rate = $('#rate<?php echo $rslistnew['id']; ?>').val();

				var orderQty = Number('<?php echo $rslistnew['orderQty']; ?>');

				var totalRemain = Number(orderQty-netReceived);
				$('#balQty<?php echo $rslistnew['id']; ?>').val(totalRemain);

				var totalval = Number(netReceived*rate).toFixed(2);
				var value = $('#value<?php echo $rslistnew['id']; ?>').val(totalval);

				//var excess = encodeURI($('#excess<?php echo $rslistnew['id']; ?>').val());

				$('#savedata').load('savechaalandetail.php?action=savegrnitemqty&id=<?php echo $rslistnew['id']; ?>&qtyShipBySupplier='+qtyShipBySupplier+'&received='+received+'&qcShortage='+qcShortage+'&netReceived='+netReceived+'&sqmQty='+sqmQty+'&uom='+uom+'&rate='+rate+'&value='+value);

				}
				savelinedetail<?php echo $rslistnew['id']; ?>();
				</script>

                  <?php $no++;   ?>

				  <?php
				  if($no==1){
				  ?>
				  <tr>
				  <td colspan="50" style="text-align: center;">No record found.</td>
				  </tr>
				  <?php } ?>


<?php } ?>
