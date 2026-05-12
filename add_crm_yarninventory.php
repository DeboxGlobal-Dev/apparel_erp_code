<?php

if($_GET['id']!=''){
$select='*';
$where='id="'.decode($_GET['id']).'"';
$rs=GetPageRecord($select,'yarnRequisition',$where);
$editresultstyle=mysqli_fetch_array($rs);
@extract($editresultstyle);
$lastId=$editresultstyle['id'];
$requisitionNo = $requisitionNo;
}

if($_GET['savedata']!=''){


$no = 1;
$wherenew='parentId="'.$lastId.'" order by id asc';
$rsnew=GetPageRecord('*','yarnRequisition',$wherenew);
$rslistnew=mysqli_fetch_array($rsnew);


$tillTotalMaterialQty=0;
$rsindent=GetPageRecord('SUM(orderQty) as tillorderQty','indentCreationMaster','requisitionNo="'.$requisitionNo.'" and materialId="'.$rslistnew['srinkageId'].'" ');
$resListingIndent1=mysqli_fetch_array($rsindent);
$resListingIndent1['tillorderQty'];
$tillTotalMaterialQty= $rslistnew['finalQty']-$resListingIndent1['tillorderQty'];

$grnNo=GetPageRecord('grnNo,gateEntryNo','grnMaster','id="'.$rslistint['parentId'].'"');
$grnNoList=mysqli_fetch_array($grnNo);

$gateNo=GetPageRecord('id,entrydate','gateentrymaster','id="'.$grnNoList['gateEntryNo'].'"');
$gateNoList=mysqli_fetch_array($gateNo);

$gateEntryNo = 'GE-'.date('dmy',strtotime($gateNoList['entrydate'])).'-'.$gateNoList['id'];

}

?>

<div class="page-content">
  <!-- Main sidebar -->
  <?php include "left.php"; ?>
  <!-- /main sidebar -->
  <!-- Main content -->
  <div class="content-wrapper">
    <!-- Content area -->
    <div class="content pt-0" style="margin-top:20px;">
      <!-- Dashboard content -->
	  <div class="row">
				<div class="col-xl-12">
			 	<div class="card mb-0 rounded-bottom-0" style="padding:15px;">
				 	<div class="panel panel-flat">
					<div class="table-responsive">
			 			<table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
                              <td width="100%" style="text-align:center;"><strong style="font-size:23px;">Yarn Inventory </strong></td>
							</tr>
                          </tbody>
                        </table>
						<table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">

     					</table>

<div class="btn-group justify-content-center" style="width: fit-content; float: left; padding: 10px 0px; margin: 0px; display: none;" id="deactivatebtnpurchasemerchant">

<a onclick="opmodalpop('Assign To Sourcing','modalpop.php?action=assigntosoursingteam&styleId=<?php echo $_GET['styleid']; ?>&costsheetVersionId=1','400px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="border-radius: 2px; background-color: #0d7544; margin: 0px !important; padding: 5px 10px; font-size: 12px; font-weight: 500;"><i class="fa fa-plus" aria-hidden="true"></i> Assign To</a>

</div>

				        <div id="add_indentmpl">
					    <table width="100%" class="table table-bordered table-responsive forbom" id="tableid11" style="display:block;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body" style="background-color: #fff7b3;;">
							<!-- <th width="15%" align="center"><strong></strong><input  name="materialCheckAll" type="checkbox" class="checkalldeletematerial" id="materialCheckAll" style="height: 17px;width: 50px;margin-top: 0;text-align: center;" /></th>-->
                            <th>Item</th>
							<th>Color</th>
							<!--<th>Pro. Cons.</th>-->
							<!--<th>Pro. Width</th>-->
							<th>Qty. Received</th>
							<!--<th>UOM</th>-->
							<th>GE-GRN No.</th>
							<!--<th>Inspected</th>-->
							<th>Quantity Allocated</th>
							<th>Allocation No - To Style</th>
							<th>In Hand</th>
							<!--<th width="11%">Construction</th>
							<th width="5%">Width</th>
							<th width="11%">Process Loss</th>
							<th width="9%">Shrinkage</th>
							<th width="8%">Final&nbsp;Qty.</th>
							<th width="7%">Supplier</th>
							<th width="5%">Price</th>
							<th width="9%">Currency</th>-->
						  </tr>
						  <tr class="card-body">
						<?php
						$requestedQty = 0;
						$rsint=GetPageRecord('*','grnMaster','requisitionNo="'.decode($_GET['greReq']).'"');
						while($rslistint=mysqli_fetch_array($rsint)){


						$no = 1;
						$wherenew='parentId="'.$lastId.'" and srinkageId="'.$rslistint['materialId'].'" order by id asc';
						$rsnew=GetPageRecord('*','yarnRequisition',$wherenew);
						$rslistnew=mysqli_fetch_array($rsnew);

						$rsReq=GetPageRecord('*','yarnRequisition','requisitionNo="'.decode($_GET['greReq']).'"');
						$rslistReq=mysqli_fetch_array($rsReq);
						///////////////////////////////////

						$tillTotalMaterialQty=0;
						$rsindent=GetPageRecord('SUM(orderQty) as tillorderQty,orderQty,materialQty,final_or_died_yarn,id,poNumber','indentCreationMaster','requisitionNo="'.$requisitionNo.'" and materialId="'.$rslistint['materialId'].'" and id="'.$rslistint['indentCreationId'].'"');
						$resListingIndent1=mysqli_fetch_array($rsindent);
						//$resListingIndent1['tillorderQty'];
						$tillTotalMaterialQty= $rslistnew['finalQty']-$resListingIndent1['tillorderQty'];

						$grnNo=GetPageRecord('grnNo,gateEntryNo,orderQty as inStockQty','grnMaster','id="'.$rslistint['parentId'].'"');
						$grnNoList=mysqli_fetch_array($grnNo);

						///in stoc qty after allocate from allocation
						$allocationNo=GetPageRecord('SUM(requestedQty) AS allocateQty','yarnRequisition',' parentId in (select id from yarnRequisition where requisitionNo="'.decode($_GET['greReq']).'") and srinkageId="'.$rslistint['materialId'].'"');
						$allocationNoData=mysqli_fetch_array($allocationNo);

						$gateNo=GetPageRecord('id,entrydate','gateentrymaster','id="'.$grnNoList['gateEntryNo'].'"');
						$gateNoList=mysqli_fetch_array($gateNo);

						$inStock=GetPageRecord('SUM(materialQty) as inStockQty','indentCreationMaster','parentId="'.$resListingIndent1['id'].'"');
						$inStockData=mysqli_fetch_array($inStock);
						$parentId = $resListingIndent1['id'];
						$inStockQty = $inStockData['inStockQty'];


						/*$rsindentnew=GetPageRecord('id,poTypeId','indentCreationMaster','requisitionNo="'.$requisitionNo.'" and materialId="'.$rslistint['materialId'].'"');
						$rsindentnewdata=mysqli_fetch_array($rsindentnew);
						if($rsindentnewdata['poTypeId']==4){
							$parentId = $rsindentnewdata['id'];
							$inStockQty = $rsindentnewdata['inStockQty'];
						}else{
							$parentId = $resListingIndent1['id'];
							$inStockQty = $inStockData['inStockQty'];
						}*/

						$gateEntryNo = 'GE-'.date('dmy',strtotime($gateNoList['entrydate'])).'-'.$gateNoList['id'];
						?>
                        <tr>
						<!--<td><label class="analyselistclass">
						   	<input type="checkbox" style=" opacity:1; cursor: pointer; height: 17px; width: 50px; margin-top: 3px;" value="<?php echo $rslistnew['id']; ?>" name="analysemateriallistdelete[]" class="deletematerial" />

							</label>
							</td>-->
							<td>
							 <a href="#" onclick="opmodalpop('Yarn Process PO','modalpop.php?action=indentSendtoBomInventory&materialIdOld=<?php echo addslashes($rslistint['materialId']); ?>&uom=<?php echo addslashes($rslistnew['uom']); ?>&materialQty=<?php echo addslashes($rslistint['netReceived']); ?>&requisitionNo=<?php echo addslashes($requisitionNo); ?>&styleId=<?php echo addslashes($editresultstyle['styleNo']); ?>&count=<?php echo addslashes($rslistnew['count']); ?>&gsm=<?php echo addslashes($rslistnew['gsm']); ?>&fabricWidth=<?php echo addslashes($rslistnew['fabricWidth']); ?>&parentId=<?php echo $parentId; ?>&stockInStore=<?php echo $rslistint['orderQty']-$inStockQty; ?>','900px','auto');" data-toggle="modal" data-target="#modalpop">
							<?php
							$wherethis='id="'.$rslistint['materialId'].'"';
							$rss=GetPageRecord('name','materialMaster',$wherethis);
							$resListing1s=mysqli_fetch_array($rss);
							echo stripslashes($resListing1s['name']);

							?></a>

							</td>
							<td><?php echo getColorName($rslistint['color']); ?></td>
							<!--<td><?php echo $rslistnew['processCons']; ?></td>-->
							<!--<td><?php echo $rslistnew['processWidth']; ?></td>-->
							 <td><?php echo $rslistint['orderQty']; ?></td>
							<!--<td><?php echo $rslistint['uom']; ?></td>-->
							<!--<td><?php echo $rslistnew['construction']; ?></td>
							<td><?php echo $rslistnew['greWidth']; ?></td>
							<td><?php echo $rslistnew['processLoss']; ?></td>
							<td><?php echo $rslistnew['shrinkage']; ?></td>
							<td><?php echo $rslistnew['finalQty']; ?></td>
							<td><?php echo getSupplierName($rslistnew['supplier']); ?></td>
							<td><?php echo $rslistnew['price']; ?></td>
							<td><?php echo $rslistnew['currency']; ?></td>-->
							<td><?php echo $gateEntryNo.' - '.$grnNoList['grnNo']; ?></td>
							<!--<td><?php
				// 			$whIns = 'styleId="'.$lastId.'" and materialId="'.$rslistnew['srinkageId'].'" and greigeOrderQty="'.$rslistint['netReceived'].'"';
				// 			$rsins=GetPageRecord('acceptedField','lotWiseData',$whIns);
				// 			$resListingIns=mysqli_fetch_array($rsins);
				// 			echo stripslashes($resListingIns['acceptedField']);
							?>
							<?php echo $rslistint['orderQty']; ?>
							</td>-->
							<td><?php
							/*if($resListingIndent1['final_or_died_yarn']!=2){
							$requestedQty = 0;
							$rsstyleuse112=GetPageRecord('*','yarnRequisition','parentId="'.$lastId.'" and srinkageId="'.$rslistint['materialId'].'" and addFrom="allocation" and greigeAvg!="" and color!="" and salesOrderQty!=""');
							while($rsstyleuseList=mysqli_fetch_array($rsstyleuse112)){

							$greall=GetPageRecord('*','yarnAllocation','allocationNo="'.$rsstyleuseList['allocationNo'].'" and status=1');
							$greallocat=mysqli_fetch_array($greall);
							if($greallocat['status']=='1'){
							$requestedQty = $requestedQty + $rsstyleuseList['requestedQty'];
							}
							}
							echo $requestedQty;
							}else{
								echo $resListingIndent1['materialQty'].'+++';
								//$requestedQty = $resListingIndent1['materialQty'];
							}*/
							echo ($inStockQty!='' || $allocationNoData['allocateQty']!='') ? $inStockQty+$allocationNoData['allocateQty'] : 0;
							?></td>
							<td><?php
							$rs ='';
							$rs=GetPageRecord('*','yarnRequisition',' 1 and parentId="'.$lastId.'" and srinkageId="'.$rslistint['materialId'].'" and addFrom="allocation" and greigeAvg!="" and color!="" and salesOrderQty!="" group by allocationNo order by id asc');
							while($rsstyleuseList12=mysqli_fetch_array($rs)){

							$greall12=GetPageRecord('*','yarnAllocation','allocationNo="'.$rsstyleuseList12['allocationNo'].'" and status=1');
							$greallocat12=mysqli_fetch_array($greall12);
							?>
							<span style="color: green; font-weight: 700;"><?php echo $greallocat12['allocationNo'].' - '.getStyleRefId($greallocat12['styleId'])."<br>"; ?></span>
						<?php } ?></td>
						<td>
						<?php
 $rsExt=GetPageRecord('SUM(qty) AS totalexport','loadExternalChallanMaster','1 and itemCode="'.$rslistint['materialId'].'" and parentId in (select id from externalChallan where pono="'.$resListingIndent1['poNumber'].'")');
 $rsExtSum=mysqli_fetch_array($rsExt);
?>

						<?php echo $rslistint['orderQty']-$inStockQty-$allocationNoData['allocateQty']-$rsExtSum['totalexport']; ?></td>
						</tr>
						<?php } ?>
                            </tr>
						  </tbody>
                        </table>
						</div>
					  </div>
					</div>
				  </div>
				 </div>
				 </div>

    </div>
    <!-- /dashboard content -->
  </div>
  <!-- /content area -->
</div>
<!-- /main content -->
</div>
<script type="text/javascript">
		$(document).ready(function(){
		// check uncheck all inclusions
		$("#materialCheckAll").click(function(){
		if(this.checked){
			$('.deletematerial').each(function(){
				this.checked = true;
			})
		}else{
			$('.deletematerial').each(function(){
				this.checked = false;
			})
		}
		});

		});
</script>

<script>
window.setInterval(function(){
      checked = $("#add_indentmpl input[type=checkbox]:checked").length;
      if(!checked) {
	  $("#deactivatebtnpurchasemerchant").hide();
      } else {
	  $("#deactivatebtnpurchasemerchant").show();
	  }
}, 100);
</script>
