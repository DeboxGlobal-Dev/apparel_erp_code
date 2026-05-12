<?php
ob_start();
include "inc.php";
$assignto='download';
$select='*';

if($_GET['styleid']!=''){
$select="*";
$where='styleId="'.decode($_GET['styleid']).'"';
$rs=GetPageRecord($select,'buyerPurchaseOrderMaster',$where);
$result=mysqli_fetch_array($rs);

}

if($_GET['styleid']!=''){
$select='*';
$where='id="'.decode($_GET['styleid']).'"';
$rs=GetPageRecord($select,'queryMaster',$where);
$editresultstyle=mysqli_fetch_array($rs);
$buyerId = $editresultstyle['buyerId'];
$buyerStyleRefNo = $editresultstyle['buyerStyleRefNo'];
$subject = $editresultstyle['subject'];
$displayId = $editresultstyle['displayId'];
$seasonId = $editresultstyle['seasonId'];
$categoryId = $editresultstyle['categoryId'];
$subCategoryId = $editresultstyle['subCategoryId'];
$departmentId = $editresultstyle['departmentId'];
$receivedDate = $editresultstyle['receivedDate'];
$patternDescription = $editresultstyle['patternDescription'];
$patternAttachment = $editresultstyle['patternAttachment'];

$lastId=$editresultstyle['id'];

}


header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>




                      <table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
                              <td width="16%"></td>
							  <td width="64%" style="text-align:center;"><center><strong style="font-size:23px;">INDENT</strong></center></td>
							  <td width="16%" style="text-align:right;"><?php echo date('d-m-Y h:i:s A'); ?></td>
                            </tr>
                          </tbody>
                        </table>
						<table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
                              <td width="31%"> <strong>Indent No: </strong><span class="badge badge-warning" style="font-size: 11px;"><?php echo decode($_REQUEST['indentno']); ?></span></td>
							  <td width="20%"><strong>Indent Date: </strong></td>
							  <td width="22%"><strong>Order No:  </strong><?php echo $result['orderNo']; ?></td>
							  <td width="27%"><strong>Order Month / Year: </strong><?php echo date('d-m-Y'); ?></td>
							</tr>
                          </tbody>
     					</table>
						<table width="100%" border="1" cellspacing="2" cellpadding="2" style="border: 1px solid #ccc;">
						  <tr style="font-size: 15px; background-color: #fff7b3; font-weight: 700;">
							<td colspan="11">Order Quantity Details:</td>
						  </tr>
						  <tr>
							<th>Destination</th>
							<th>Color</th>
							<th>XXS</th>
							<th>XS</th>
							<th>S</th>
							<th>M</th>
							<th>L</th>
							<th>XL</th>
							<th>XXL</th>
							<th>TBC</th>
							<th>Total</th>
						</tr>
						<?php

						$fianlTotal=0;
						$wherecolor='1 and sectionType=0 and styleId="'.$result['styleId'].'"';
						$rscolor=GetPageRecord('*','purchaseOrderStyleMaster',$wherecolor);
						while($resultcolor=mysqli_fetch_array($rscolor)){
						$total=0;
						$wheredest='parentId="'.$resultcolor['id'].'"  and provision=0 group by finish';
						$rsdest=GetPageRecord('*','purchaseOrderStyleMaster',$wheredest);
						while($resultdest=mysqli_fetch_array($rsdest)){
						$total=0;
						?>
						  <tr>
							<tr>
							<td><?php echo $resultdest['finish']; ?></td>
							<td><?php
							$rsc=GetPageRecord('name','colorCardMaster','id="'.$resultdest['color'].'"');
						  	$resultclist=mysqli_fetch_array($rsc);
							echo $resultclist['name']; ?>
							</td>
							<td>
							<?php


							$rsssqty='';
							$rsssqtylist='';
							$rsssqty=GetPageRecord('*','purchaseOrderStyleMaster','1 and parentId="'.$resultcolor['id'].'" and color="'.$resultdest['color'].'" and finish="'.$resultdest['finish'].'" and size="xxs"');
							$rsssqtylist=mysqli_fetch_array($rsssqty);
							echo $rsssqtylist['gdQty']; $total = $total+$rsssqtylist['gdQty'];
							?>
							</td>
							<td>
							<?php
							$rsssqty='';
							$rsssqtylist='';
							$rsssqty=GetPageRecord('*','purchaseOrderStyleMaster','1 and parentId="'.$resultcolor['id'].'" and color="'.$resultdest['color'].'" and finish="'.$resultdest['finish'].'" and size="xs"');
							$rsssqtylist=mysqli_fetch_array($rsssqty);
							echo $rsssqtylist['gdQty']; $total = $total+$rsssqtylist['gdQty'];
							?>
							</td>
							<td>
							<?php
							$rsssqty='';
							$rsssqtylist='';
							$rsssqty=GetPageRecord('*','purchaseOrderStyleMaster','1 and parentId="'.$resultcolor['id'].'" and color="'.$resultdest['color'].'" and finish="'.$resultdest['finish'].'" and size="s"');
							$rsssqtylist=mysqli_fetch_array($rsssqty);
							echo $rsssqtylist['gdQty']; $total = $total+$rsssqtylist['gdQty'];
							?>
							</td>
							<td>
							<?php
							$rsssqty='';
							$rsssqtylist='';
							$rsssqty=GetPageRecord('*','purchaseOrderStyleMaster','1 and parentId="'.$resultcolor['id'].'" and color="'.$resultdest['color'].'" and finish="'.$resultdest['finish'].'" and size="m"');
							$rsssqtylist=mysqli_fetch_array($rsssqty);
							echo $rsssqtylist['gdQty']; $total = $total+$rsssqtylist['gdQty'];
							?>
							</td>
							<td>
							<?php
							$rsssqty='';
							$rsssqtylist='';
							$rsssqty=GetPageRecord('*','purchaseOrderStyleMaster','1 and parentId="'.$resultcolor['id'].'" and color="'.$resultdest['color'].'" and finish="'.$resultdest['finish'].'" and size="L"');
							$rsssqtylist=mysqli_fetch_array($rsssqty);
							echo $rsssqtylist['gdQty']; $total = $total+$rsssqtylist['gdQty'];
							?>
							</td>
							<td>
							<?php
							$rsssqty='';
							$rsssqtylist='';
							$rsssqty=GetPageRecord('*','purchaseOrderStyleMaster','1 and parentId="'.$resultcolor['id'].'" and color="'.$resultdest['color'].'" and finish="'.$resultdest['finish'].'" and size="XL"');
							$rsssqtylist=mysqli_fetch_array($rsssqty);
							echo $rsssqtylist['gdQty']; $total = $total+$rsssqtylist['gdQty'];
							?>
							</td>
							<td>
							<?php
							$rsssqty='';
							$rsssqtylist='';
							$rsssqty=GetPageRecord('*','purchaseOrderStyleMaster','1 and parentId="'.$resultcolor['id'].'" and color="'.$resultdest['color'].'" and finish="'.$resultdest['finish'].'" and size="XXL"');
							$rsssqtylist=mysqli_fetch_array($rsssqty);
							echo $rsssqtylist['gdQty']; $total = $total+$rsssqtylist['gdQty'];
							?>
							</td>
							<td>-</td>
							<td><?php echo $total; $fianlTotal = $fianlTotal+$total; ?></td>
						  </tr>
						<?php } } ?>
						<tr style="font-size: 15px; background-color: #f7f7f7; font-weight: 700;">
							<td colspan="9">&nbsp;</td>
							<td>Total</td>
							<td><?php echo $fianlTotal; ?></td>
						  </tr>
						</table>
						<br />
						<table width="100%" border="1" cellspacing="2" cellpadding="2" style="border: 1px solid #ccc;">
						  <tr style="font-size: 15px; background-color: #fff7b3; font-weight: 700;">
							<td colspan="11">Excess Quantity Details</td>
						  </tr>
						  <tr>
							<th>Destination</th>
							<th>Color</th>
							<th>XXS</th>
							<th>XS</th>
							<th>S</th>
							<th>M</th>
							<th>L</th>
							<th>XL</th>
							<th>XXL</th>
							<th>TBC</th>
							<th>Total</th>
						</tr>
						<?php
						$fianlTotal=0;
						$wherecolor='1 and sectionType=0 and styleId="'.$result['styleId'].'" and provision=0';
						$rscolor=GetPageRecord('*','purchaseOrderStyleMaster',$wherecolor);
						while($resultcolor=mysqli_fetch_array($rscolor)){
						$total=0;
						$wheredest='parentId="'.$resultcolor['id'].'" and provision=0 group by finish';
						$rsdest=GetPageRecord('*','purchaseOrderStyleMaster',$wheredest);
						while($resultdest=mysqli_fetch_array($rsdest)){
						$total=0;


						?>

							<tr>
							<td><?php echo $resultdest['finish']; ?></td>
							<td><?php
							$rsc=GetPageRecord('name','colorCardMaster','id="'.$resultdest['color'].'"');
						  	$resultclist=mysqli_fetch_array($rsc);
							echo $resultclist['name'];

							?>
							</td>
							<td>
							<?php
							$sizeqty=0;
							$rsssqty='';
							$rsssqtylist='';
							$rsssqty=GetPageRecord('*','purchaseOrderStyleMaster','1 and parentId="'.$resultcolor['id'].'" and color="'.$resultdest['color'].'" and finish="'.$resultdest['finish'].'" and size="xxs"');
							$rsssqtylist=mysqli_fetch_array($rsssqty);
							echo $sizeqty = $rsssqtylist['gdQty'];
							$total = $total+$sizeqty;
							?>
							</td>
							<td>
							<?php
							$rsssqty='';
							$rsssqtylist='';
							$rsssqty=GetPageRecord('*','purchaseOrderStyleMaster','1 and parentId="'.$resultcolor['id'].'" and color="'.$resultdest['color'].'" and finish="'.$resultdest['finish'].'" and size="xs"');
							$rsssqtylist=mysqli_fetch_array($rsssqty);
							echo $sizeqty = $rsssqtylist['gdQty'];
							  $total = $total+$sizeqty;

							?>
							</td>
							<td>
							<?php
							$rsssqty='';
							$rsssqtylist='';
							$rsssqty=GetPageRecord('*','purchaseOrderStyleMaster','1 and parentId="'.$resultcolor['id'].'" and color="'.$resultdest['color'].'" and finish="'.$resultdest['finish'].'" and size="s"');
							$rsssqtylist=mysqli_fetch_array($rsssqty);
							echo $sizeqty = $rsssqtylist['gdQty'];
							 $total = $total+$sizeqty;
							?>
							</td>
							<td>
							<?php
							$rsssqty='';
							$rsssqtylist='';
							$rsssqty=GetPageRecord('*','purchaseOrderStyleMaster','1 and parentId="'.$resultcolor['id'].'" and color="'.$resultdest['color'].'" and finish="'.$resultdest['finish'].'" and size="m"');
							$rsssqtylist=mysqli_fetch_array($rsssqty);
							echo $sizeqty = $rsssqtylist['gdQty'];
							 $total = $total+$sizeqty;
							?>
							</td>
							<td>
							<?php
							$rsssqty='';
							$rsssqtylist='';
							$rsssqty=GetPageRecord('*','purchaseOrderStyleMaster','1 and parentId="'.$resultcolor['id'].'" and color="'.$resultdest['color'].'" and finish="'.$resultdest['finish'].'" and size="L"');
							$rsssqtylist=mysqli_fetch_array($rsssqty);
							echo $sizeqty = $rsssqtylist['gdQty'];
							 $total = $total+$sizeqty;
							?>
							</td>
							<td>
							<?php
							$rsssqty='';
							$rsssqtylist='';
							$rsssqty=GetPageRecord('*','purchaseOrderStyleMaster','1 and parentId="'.$resultcolor['id'].'" and color="'.$resultdest['color'].'" and finish="'.$resultdest['finish'].'" and size="XL"');
							$rsssqtylist=mysqli_fetch_array($rsssqty);
							echo $sizeqty = $rsssqtylist['gdQty'];
							 $total = $total+$sizeqty;
							?>
							</td>
							<td>
							<?php
							$rsssqty='';
							$rsssqtylist='';
							$rsssqty=GetPageRecord('*','purchaseOrderStyleMaster','1 and parentId="'.$resultcolor['id'].'" and color="'.$resultdest['color'].'" and finish="'.$resultdest['finish'].'" and size="XXL"');
							$rsssqtylist=mysqli_fetch_array($rsssqty);
							echo $sizeqty = $rsssqtylist['gdQty'];

						  	$total = $total+$sizeqty;

							if($_REQUEST['action']=='savedata3'){
							$rsssqty='';
							$rsssqtylist='';
							$rsssqty=GetPageRecord('*','purchaseOrderStyleMaster','1 and parentId="'.$resultcolor['id'].'" and color="'.$resultdest['color'].'" and finish="'.$resultdest['finish'].'" and size="XXL"');
							$rsssqtylist=mysqli_fetch_array($rsssqty);
							echo $rsssqtylist['gdQty']; $total = $total+$rsssqtylist['gdQty'];
							}
							?>
							</td>
							<td>-</td>
							<td><?php
							$totalallowance=0;
						  	$totalallow = 0;
						  	$rspro=GetPageRecord('*','rejectioninproductionmaster','1 and qty>'.$total.'');
						  	$resultpro=mysqli_fetch_array($rspro);
						  	$totalallowance = $resultpro['totalallwance'];
						  	$total = round($total+(($total*$totalallowance)/100));
							echo $total; $fianlTotal = $fianlTotal+$total;  ?></td>
						  </tr>
						  <?php }  } ?>
						  <tr style="font-size: 15px; background-color: #f7f7f7; font-weight: 700;">
							<td colspan="9">&nbsp;</td>
							<td>Total</td>
							<td><?php echo $fianlTotal; ?></td>
						  </tr>
						</table>
<br />
<div class="btn-group justify-content-center" style="width: fit-content; float: left; padding: 10px 0px; margin: 0px; display: none;" id="deactivatebtnpurchasemerchant">

<!--<a onclick="opmodalpop('Assign To Sourcing','modalpop.php?action=assigntosoursingteam&styleId=<?php echo $_GET['styleid']; ?>&costsheetVersionId=1','400px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="border-radius: 2px; background-color: #0d7544; margin: 0px !important; padding: 5px 10px; font-size: 12px; font-weight: 500;"><i class="fa fa-plus" aria-hidden="true"></i> Assign To</a>-->
<!--&nbsp;&nbsp;-->
<!--<a onclick="opmodalpop('Approval Status','modalpop.php?action=approveindent&styleId=<?php echo $_GET['styleid']; ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="border-radius: 2px; background-color: #428bca; margin: 0px !important; padding: 5px 10px; font-size: 12px; font-weight: 500;"><i class="fa fa-check-square-o" aria-hidden="true"></i> Approve</a>-->

</div>

				        <div id="add_indentmpl">
					    <table width="100%" class="table table-bordered table-responsive forbom" id="tableid11" style="display:block;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body" style="background-color: #fff7b3;;">
							 <td width="15%" align="center"><strong></strong><input  name="materialCheckAll" type="checkbox" class="checkalldeletematerial" id="materialCheckAll" style="height: 17px;width: 50px;margin-top: 0;text-align: center;" /></td>
                              <td width="15%" align="center"><strong>Material/Item&nbsp;Name</strong></td>
                              <td width="12%" align="center"><strong>Description</strong></td>
							  <td width="12%" align="center"><strong>Width</strong></td>
                              <td width="12%" align="center"><strong>Qty/Avg</strong></td>
                              <td width="12%" align="center"><strong>UOM</strong></td>
                              <!--<td width="12%" align="center"><strong>Supplier&nbsp;Id</strong></td>
                              <td width="12%" align="center"><strong>Supplier&nbsp;Name</strong></td>-->
                              <td width="12%" align="center"><strong>Rate</strong></td>
							  <td width="12%" align="center" style="display:none;"><strong>Value&nbsp;Of&nbsp;1&nbsp;Piece</strong></td>
                        	  <td width="12%" align="center"><strong>Color</strong></td>
                             <!-- <td width="12%" align="center"><strong>Size</strong></td>-->
                              <td width="12%" align="center"><strong>PO&nbsp;Qty&nbsp;(Excess)
</strong></td>
							  <td width="12%" align="center"><strong>Material&nbsp;Qty</strong></td>
							  <td width="12%" align="center"><strong>Material&nbsp;Value</strong></td>
							<!--  <td width="12%" align="center"><strong>Stock&nbsp;In&nbsp;Store</strong></td>-->
							 <!-- <td width="12%" align="center"><strong>Total&nbsp;allowance(%)</strong></td>-->
							  <td width="12%" align="center"><strong>Order&nbsp;Qty</strong></td>
							  <td width="12%" align="center"><strong>Pending&nbsp;Qty.</strong></td>
							  <td width="12%" align="center"><strong>Status</strong></td>
							</tr>
							<?php
							$sNo1=0;
							$rowno=0;
							$rstype=GetPageRecord('*','materialTypeMaster','1 order by id asc');
							while($resListingtype=mysqli_fetch_array($rstype)){
							?>
							<tr class="card-body">
								<td width="100%" align="left" colspan="20" style="background-color: #e5fbfa;text-transform: uppercase;font-size: 14px;"><strong><?php echo $resListingtype['name']; ?></strong></td>
							</tr>
							<?php
							 $rs1=GetPageRecord('*','styleSubCategoryMaster','styleId="'.decode($_GET['styleid']).'" and costsheetVersionId="'.$editresultstyle['defaultcostsheetVersionId'].'" and materialType="'.$resListingtype['id'].'" and parentId=0 and sr<100 order by sr asc');
							while($resListing1=mysqli_fetch_array($rs1)){
							$color='';
							$rowno++;
							$sNo1=$rowno;

							$colorno=1;
							$rs12=GetPageRecord('*','purchaseOrderStyleMaster','styleId="'.decode($_GET['styleid']).'" and sectionType=0 order by id asc');
							while($result1=mysqli_fetch_array($rs12)){

							$orderQty='';
							$size='';
							$totalMaterialQty = '0';

							$rs2=GetPageRecord('*','purchaseOrderStyleMaster','parentId="'.$result1['id'].'"');
							while($result2=mysqli_fetch_array($rs2)){
								$size.=$result2['size'].',';
								$orderQty+=$result2['gdQty'];
								$orderQty = round($orderQty);
								$color = $result2['color'];

							}


							$rs121=GetPageRecord('*','techPackDetailMaster',' stylesubtabid="'.$resListing1['id'].'" and sectionType="bom" and styleId="'.$resListing1['styleId'].'" and costsheetVersionId="'.$editresultstyle['defaultcostsheetVersionId'].'" order by id asc');
							$resListing12=mysqli_fetch_array($rs121);

							$totalallowance=0;
							$totalallow = 0;
							$rspro=GetPageRecord('*','rejectioninproductionmaster','1 and qty>'.$orderQty.'');
							$resultpro=mysqli_fetch_array($rspro);
							$totalallowance = $resultpro['totalallwance'];
							$orderQty = round($orderQty+(($orderQty*$totalallowance)/100));

							$totalMaterialQty =  round($orderQty*$resListing12['avgIncWastage'],3);

							$totalMaterialValue = round($totalMaterialQty*$resListing12['bomRate'],3);

							?>

						<?php
						 $tillTotalMaterialQty=0;
						 if($resListing1['sizeSeparate']==0){
						$tillTotalMaterialQty=0;
						$rsindent=GetPageRecord('SUM(orderQty) as tillorderQty','indentCreationMaster','styleId="'.$resListing1['styleId'].'" and techpackdetailId="'.$resListing12['id'].'" and styleSubCatTableId="'.$resListing1['id'].'" and color="'.$color.'" and size="'.$size.'"');
						$resListingIndent1=mysqli_fetch_array($rsindent);

						 $tillTotalMaterialQty= $totalMaterialQty-$resListingIndent1['tillorderQty'];

						?>

                          <tr class="card-body">
						   	<td><label class="analyselistclass">
						   	<!--<input type="checkbox" style=" opacity:1; cursor: pointer; height: 17px; width: 50px; margin-top: 3px;" value="<?php //echo $resListing12['id']; ?>" name="analysemateriallistdelete[]" class="deletematerial" />-->
							</label>
							</td>
                            <td width="15%" align="center">
							 <div  data-toggle="modal" data-target=""><?php echo  $resListing1['name']; ?></div>
							</td>
                              <td width="12%" align="center"><?php echo $resListing1['name']; //getDescriptionName($resListing1['materialdescriptionid']); ?></td>
							  <td width="12%" align="center"><?php if($resListingtype['id']==1){ echo $resListing12['bomWidth']; } ?></td>
                              <td width="12%" align="center"><?php  echo $resListing12['avgIncWastage']; ?></td>
                              <td width="12%" align="center"><?php  echo $resListing12['bomUnit']; ?></td>
                              <!--<td width="20%" align="center"><?php  echo getSupplierCode($resListing12['storesupplier']); ?></td>
                              <td width="12%" align="center"><?php  echo getSupplierName($resListing12['storesupplier']); ?></td>-->
                              <td width="12%" align="center"><?php  echo $resListing12['bomRate']; ?></td>
							  <td width="12%" align="center" style="display:none;"><?php   echo $resListing12['bomvalueonepc']; ?></td>
							  <td width="12%" align="center">
								<?php
								if($resListingtype['id']==1 || $resListingtype['id']==3 || $resListingtype['id']==2){
								$rs11=GetPageRecord('name','colorCardMaster','id="'.$color.'"');
								$resListing11=mysqli_fetch_array($rs11);
									echo $colorarr = rtrim($resListing11['name'],',');
								}
								?>
							 </td>
							  <!--<td width="12%" align="center"><?php  echo $size; ?></td>-->
							  <td width="12%" align="center"><?php 	echo $orderQty;   ?></td>
							  <td width="12%" align="center"><?php   echo $totalMaterialQty; ?></td>
							  <td width="12%" align="center"><?php echo $totalMaterialValue; ?></td>
							  <!--<td width="12%" align="center"><span style="color:#FF0000; font-weight:600;">No</span></td>-->
							 <!-- <td width="12%" align="center">
							  <?php
							  $perqty=0;
							  $totalMaterialQty = round($totalMaterialQty);
							  $totalallow = 0;
							  $rspro=GetPageRecord('*','rejectioninproductionmaster','1 and qty>'.$totalMaterialQty.'');
							  $resultpro=mysqli_fetch_array($rspro);
							  echo $perqty = $resultpro['totalallwance'];

							  //$perqty = $resultpro['qty']*$perqty/100;
							  ?>
							  </td>-->
							  <td width="12%" align="center"><?php echo $resListingIndent1['tillorderQty']; ?></td>
							  <td width="12%" align="center"><?php echo $tillTotalMaterialQty; ?></td>
							  <td width="12%" align="center">
							 <?php if($resListingIndent1['sendToBom']=='1'){ ?> <a href="#"><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">Assigned</span></a> <?php } ?>
							  </td>
                            </tr>
							<?php  } ?>
							<?php
							$tillTotalMaterialQty2=0;
							$rs1111=GetPageRecord('*','styleSubCategoryMaster','parentId="'.$resListing1['id'].'"');
							while($resListing1111=mysqli_fetch_array($rs1111)){
							$newsize = $resListing1111['sizeName'];

							$rsindent2=GetPageRecord('SUM(orderQty) as tillorderQtysize','indentCreationMaster','styleId="'.$resListing1['styleId'].'" and techpackdetailId="'.$resListing12['id'].'" and styleSubCatTableId="'.$resListing1['id'].'" and color="'.$color.'"  and size="'.$newsize.'"');
							$resListingIndent2=mysqli_fetch_array($rsindent2);

							$tillTotalMaterialQty2 = $totalMaterialQty-$resListingIndent2['tillorderQtysize'];
							?>
							<tr class="card-body" style="">
							<td><label class="analyselistclass">
							<input type="checkbox" style=" opacity:1; cursor: pointer; height: 17px; width: 50px; margin-top: 3px;" value="<?php echo $resListing1111['id']; ?>" name="analysemateriallistdelete[]" class="deletematerial" />
							</label>
							</td>
						   <td width="15%" align="center">
						   <?php echo $resListing1['name']; ?>
							  </td>
                              <td width="12%" align="center"><?php echo $resListing1['name']; //getDescriptionName($resListing1['materialdescriptionid']); ?></td>
							  <td width="12%" align="center"><?php if($resListingtype['id']==1){ echo $resListing12['bomWidth']; } ?></td>
                              <td width="12%" align="center"><?php echo $resListing12['avgIncWastage']; ?></td>
                              <td width="12%" align="center"><?php echo $resListing12['bomUnit']; ?></td>
                          	  <td width="12%" align="center"><?php echo $resListing12['bomRate']; ?></td>
							  <td width="12%" align="center"><?php echo $resListing12['bomvalueonepc']; ?></td>
							  <td width="12%" align="center">
							<?php
							if($resListingtype['id']==2){
								echo $resListing12['trimColor'.$colorno];
							}
							?>
							  </td>
							 <!-- <td width="12%" align="center"><?php echo $newsize; ?></td>-->
							  <td width="12%" align="center"><?php echo $orderQty;  ?></td>
							  <td width="12%" align="center"><?php  echo round($totalMaterialQty); ?></td>
							  <td width="12%" align="center"><?php echo $totalMaterialValue; ?></td>
							  <td width="12%" align="center"><span style="color:#FF0000; font-weight:600;">No</span></td>
							  <!--<td width="12%" align="center">
							  <?php
							  $perqty=0;
							  $totalallow = 0;
							  $rspro=GetPageRecord('*','rejectioninproductionmaster','1 and qty>'.$totalMaterialQty.'');
							  $resultpro=mysqli_fetch_array($rspro);
							  echo $perqty = $resultpro['totalallwance'];
							  $perqty = $resultpro['qty']*$perqty/100;
							  ?>
							  </td>-->
							  <td width="12%" align="center"><?php echo $resListingIndent2['tillorderQtysize']; ?></td>
							  <td width="12%" align="center"><?php echo round($tillTotalMaterialQty2)+$perqty; ?></td>
							  <td width="12%" align="center">
							  <?php if($resListingIndent1['sendToBom']=='1'){ ?> <a href="#"><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">Assigned</span></a><?php } ?>
							  </td>

                            </tr>
							<?php }?>

							<?php $colorno++; } } } ?>
                          </tbody>
                        </table>