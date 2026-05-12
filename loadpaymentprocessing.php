<?php
include('inc.php');

if($_REQUEST['id']!=''){

$grnLastId = decode($_REQUEST['id']);
$rschaalan=GetPageRecord('*','grnMaster','id="'.$grnLastId.'"');
$userschaalan=mysqli_fetch_array($rschaalan);

if($_REQUEST['addsize']==1 && $_REQUEST['id']!='' && $_REQUEST['action']=='addnewrow'){


	$wherenew='parentId="'.$_REQUEST['grnNo'].'"';
	if($_REQUEST['grnNo']!=""){
		$rsnew=GetPageRecord('*','grnMaster',$wherenew);
		while($rslistnew=mysqli_fetch_array($rsnew)){

			$rsnewdd=GetPageRecord('*','grnMaster','id="'.$_REQUEST['grnNo'].'"');
			$rslistnewdd=mysqli_fetch_array($rsnewdd);
			$namevalue1 = 'grnNo="'.$rslistnewdd['grnNo'].'",styleId="'.$rslistnew['styleId'].'",supplierPurchaseOrderId="'.$rslistnew['supplierPurchaseOrderId'].'"';
			$whereval='id="'.$grnLastId.'"';
			updatelisting('billMovementMaster',$namevalue1,$whereval);

			$namevalue ='grnNo="'.$rslistnewdd['grnNo'].'",parentId="'.decode($_REQUEST['id']).'",supplierPurchaseOrderId="'.$rslistnew['supplierPurchaseOrderId'].'",materialId="'.$rslistnew['materialId'].'",styleId="'.$rslistnew['styleId'].'",color="'.$rslistnew['color'].'",size="'.$rslistnew['size'].'",orderQty="'.$rslistnew['orderQty'].'",received="'.$rslistnew['qty'].'",netReceived="'.$rslistnew['netReceived'].'",uom="'.$rslistnew['uom'].'",rate="'.$rslistnew['rate'].'",value="'.$rslistnew['value'].'"';
			addlistinggetlastid('billMovementMaster',$namevalue);
		}
	}
}


if($_REQUEST['deletestatus']=="yes" && $_REQUEST['rowid']!=''){
deleteRecord('billMovementMaster','id="'.$_REQUEST['rowid'].'"');
}

?>
					<?php
					$no = 1;
					$wherenew='parentId="'.$grnLastId.'" order by id asc';
					$rsnew=GetPageRecord('*','billMovementMaster',$wherenew);
					while($rslistnew=mysqli_fetch_array($rsnew)){

					$rs11=GetPageRecord('name','colorCardMaster','id="'.$rslistnew['color'].'"');
					$resListing11=mysqli_fetch_array($rs11);
					//echo $resListing11['name'];
					?>
                  <tr>
                    <!-- <td><a href="javascript:void(0);" onclick="deleterow('<?php echo $rslistnew['id']; ?>');"><i class="icon-trash" style="font-size:13px;cursor:pointer; color:#FF0000;"></i></a></td> -->
					<td  align="center"><?php
						$rs=GetPageRecord('*','styleSubCategoryMaster','id="'.$rslistnew['materialId'].'"');
						$resListing=mysqli_fetch_array($rs);
						echo $resListing['name'];
					?></td>
                    <td align="center"><?php echo $rslistnew['orderQty']; ?></td>
					<td align="center">-</td>
                    <td><input type="text" name="received" id="received<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['netReceived']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;text-align: center;" readonly="readonly" /></td>
					<td>-</td>
                   <td><input type="text" name="uom" id="uom<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['uom']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;text-align: center;" readonly="readonly" /></td>
					<td></td>
                    <td></td>
                    <td></td>
                	<td></td>
					<td><?php echo $rslistnew['rate']*$rslistnew['netReceived']; ?></td>
					<td><input type="text" id="paymentAmount<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['paymentAmount']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;text-align: center;"  /></td>
					<td></td>
					<td></td>

                  </tr>


				<script>
				function savelinedetail<?php echo $rslistnew['id']; ?>(){
				var paymentAmount = $('#paymentAmount<?php echo $rslistnew['id']; ?>').val();
				var abc = $('#paymentAmount<?php echo $rslistnew['id']; ?>').val();

				$('#savedata').load('savechaalandetail.php?action=savepaymentprocessing&id=<?php echo $rslistnew['id']; ?>&paymentAmount='+paymentAmount+'&abc='+abc);

				}
				savelinedetail<?php echo $rslistnew['id']; ?>();
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
