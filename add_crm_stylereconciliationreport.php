<?php
if($loginuserprofileId==1 || $loginuserprofileId==93){

$wheresearchassign=' 1 and ';

} else {

if($loginuserprofileId==92){

$wheresearchassign=' 1 and finalstatus="2" and assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'" and ';
} else{

$wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))';

$wheresearchassign=' '.$wheresearchassign.' and ';

}

}
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
?>
<div class="page-content">

		 <div class="content-wrapper">

			<div class="content pt-0" style="margin-top:20px;">

				<?php include "top-style.php" ?>

				<div class="row">
							<div class="col-xl-12" style="height:auto; margin-bottom:0px;">
								<div class="card border-left-3 border-left-danger-400 rounded-left-0" style="height: auto;border: 1px solid #e3e3e3 !important;  margin-bottom: 0px !important;">

									<div class="card-body">

										<div class="col-xl-12">

										<div class="media">

										<div class="media-body" style="flex:auto !important; width:1% !important;">
											<span class="text-muted">Booking Size Range</span>
											<?php
											$rsResult=GetPageRecord('name','sizerangeMaster','id="'.$editresultstyle['sizerange'].'"');
											$rsResultList=mysqli_fetch_array($rsResult)
											?>
											<div class="media-title font-weight-semibold" ><?php echo $rsResultList['name']; ?></div>
										</div>

										<div class="media-body" style="flex:auto !important; width:1% !important;">
											<span class="text-muted">Bulk Size Range</span>
											<div class="media-title font-weight-semibold"><?php echo $rsResultList['name']; ?></div>

										</div>

										<div class="media-body">Order Quantity
										  <div class="media-title font-weight-semibold">
											<?php echo $editresultstyle['orderQty']; ?>
										  </div>
										</div>

										<div class="media-body" style="flex:auto !important; width:1% !important;">
											<span class="text-muted">Order No. </span>
											<div class="media-title font-weight-semibold"><?php
											$c=GetPageRecord('orderNo','buyerPurchaseOrderMaster','styleId="'.decode($_GET['styleid']).'"');
											$purchaseData=mysqli_fetch_array($c);
											 echo $purchaseData['orderNo']; ?></div>

										</div>



										<div class="media-body" style="flex:auto !important; width:1% !important;">
										<span class="text-muted">Shipped Quantity</span>
											<div class="media-title font-weight-semibold">1562</div>

										</div>


									</div>
										<div class="media">

										<div class="media-body" style="flex:auto !important; width:1% !important;">
										<span class="text-muted">Excess/Short Shipped</span>
											<div class="media-title font-weight-semibold">
											<?php echo $editresultstyle['orderQty']-1562; ?>
											</div>
										</div>

										<div class="media-body" style="flex:auto !important; width:1% !important;">
										<span class="text-muted">Production Month</span>
											<div class="media-title font-weight-semibold">
<?php
$rkdm=GetPageRecord('min(uploadInputDate) as minDate, max(uploadInputDate) as maxDate','linePlanMaster','styleId="'.decode($_GET['styleid']).'"');
$dateWise=mysqli_fetch_array($rkdm);
echo date('d-M-Y',strtotime($dateWise['minDate'])).' TO '.date('d-m-Y',strtotime($dateWise['maxDate']));;
?>
											</div>
										</div>


										<div class="media-body" style="flex:auto !important; width:1% !important;">
										<span class="text-muted">Shipping Month</span>
											<div class="media-title font-weight-semibold">
											<?php echo date('d-M-Y', strtotime($editresultstyle['shipDate'])); ?>
											</div>
										</div>

										<div class="media-body" style="flex:auto !important; width:1% !important;">
										<span class="text-muted">Delivery Type</span>
											<div class="media-title font-weight-semibold">
											<?php
		$rrrr=GetPageRecord('*','poManageMaster','1 and poType="1" and styleId="'.decode($_GET['styleid']).'"');
		$operationData=mysqli_fetch_array($rrrr);
		echo $operationData['deliveryTerm'];
											?>

											</div>
										</div>

										<div class="media-body" style="flex:auto !important; width:1% !important;">
										<span class="text-muted">&nbsp;</span>
											<div class="media-title font-weight-semibold">
											&nbsp;
											</div>
										</div>

										</div>

										</div>

									</div>


								</div>
							</div>

			</div>

				 <div class="row" style="margin-top:20px;">
				<div class="col-xl-12">
			 	<div class="card mb-0 rounded-bottom-0" style="padding:15px;">
				 	<div class="panel panel-flat">
					<div class="table-responsive">
			 			<table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
                              <td width="16%"></td>
							  <td width="64%" style="text-align:center;"><strong style="font-size:23px;">INVENTORY RECONCILIATION SUMMARY</strong></td>
							  <td width="16%" style="padding: 19px 10px;; text-align: center; color: #000 !important; font-weight: 400; font-size: 13px;">Date - <?php echo date('d-m-Y h:i:s A'); ?></td>
                            </tr>
                          </tbody>
                        </table>
						<style>
.buyer-address td{
border:0px solid;
padding:0px;
}
</style>

<div class="btn-group justify-content-center" style="width: fit-content; float: left; padding: 10px 0px; margin: 0px; display: none;" id="deactivatebtnpurchasemerchant">

<a onclick="opmodalpop('Assign To Sourcing','modalpop.php?action=assigntosoursingteam&styleId=<?php echo $_GET['styleid']; ?>&costsheetVersionId=1','400px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="border-radius: 2px; background-color: #0d7544; margin: 0px !important; padding: 5px 10px; font-size: 12px; font-weight: 500;"><i class="fa fa-plus" aria-hidden="true"></i> Assign To</a>

</div>

				        <div id="add_indentmpl">
					    <table width="100%" class="table table-bordered table-responsive forbom" id="tableid11" style="display:block;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body" style="background-color: #fff7b3;;">
							 <td width="100%" align="left"><strong>Item</strong></td>
                              <!--<td width="12%" align="center"><strong>Supplier&nbsp;Id</strong></td>
                              <td width="12%" align="center"><strong>Supplier&nbsp;Name</strong></td>-->
                              <td width="100%" align="center"><strong>Size</strong></td>
							  <td width="100%" align="center"><strong>Color</strong></td>

                              <td width="100%" align="center"><strong>Item Code </strong></td>
							  <td width="100%" align="center"><strong>Received Quantity </strong></td>
							  <td width="100%" align="center"><strong>Issued Quantity </strong></td>
							  <td width="100%" align="center"><strong>Balanced Quantity</strong></td>
							  <td width="100%" align="center"><strong>UOM</strong></td>
							  <td width="100%" align="center"><strong>Rate</strong></td>
							  <td width="100%" align="center"><strong>Total Value </strong></td>
                              <td width="100%" align="center"><strong>Left&nbsp;Over Value</strong></td>
                              <td width="100%" align="center"><strong>Remarks</strong></td>
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
							 $rs1=GetPageRecord('*','styleSubCategoryMaster','styleId="'.decode($_GET['styleid']).'" and costsheetVersionId="'.$editresultstyle['defaultcostsheetVersionId'].'" and materialType="'.$resListingtype['id'].'" and parentId=0 order by sr asc');
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

                            <td width="15%" align="center">
							 <a><?php echo $resListing1['name']; ?></a>
							</td>
                            <td width="12%" align="center"><?php  echo $size; ?></td>
							<td width="12%" align="center">
								<?php
								if($resListingtype['id']==1 || $resListingtype['id']==3 || $resListingtype['id']==2){
								$rs11=GetPageRecord('name','colorCardMaster','id="'.$color.'"');
								$resListing11=mysqli_fetch_array($rs11);
									echo $colorarr = rtrim($resListing11['name'],',');
								}
								?>
						    </td>
							  <td width="12%" align="center">-</td>
                              <td width="12%" align="center"><?php echo  $totalMaterialQty; ?></td>
                              <td width="12%" align="center"><?php echo  $totalMaterialQty; ?></td>
                              <!--<td width="20%" align="center"><?php  echo getSupplierCode($resListing12['storesupplier']); ?></td>
                              <td width="12%" align="center"><?php  echo getSupplierName($resListing12['storesupplier']); ?></td>-->
                              <td width="12%" align="center"><?php 	echo $orderQty-$totalMaterialQty;   ?></td>
							<!--  <td width="12%" align="center"><?php   echo $resListing12['bomvalueonepc']; ?></td>-->

							  <!--<td width="12%" align="center"><?php  echo $size; ?></td>-->
							  <td width="12%" align="center"><?php  echo $resListing12['bomUnit']; ?></td>
							  <td width="12%" align="center"><?php  echo $resListing12['bomRate']; ?></td>
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

							 // $perqty = $resultpro['qty']*$perqty/100;
							  ?>
							  </td>-->
							  <td width="12%" align="center"><?php //echo $resListingIndent1['tillorderQty']; ?><?php echo $tillTotalMaterialQty; ?></td>
							  <td width="12%" align="center"></td>

							<?php  } ?>
                            </tr>
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

                               <td width="15%" align="center">
							   <a> <?php echo $resListing1['name']; ?> </a></td>
                              <td width="12%" align="center"><?php echo $newsize; ?></td>
							   <td width="12%" align="center">
							<?php
							if($resListingtype['id']==2){
								echo $resListing12['trimColor'.$colorno];
							}
							?>
							  </td>
							  <td width="12%" align="center">-</td>
                              <td width="12%" align="center"><?php echo  $totalMaterialQty; ?></td>
                              <td width="12%" align="center"><?php echo  $totalMaterialQty; ?></td>
                          	  <td width="12%" align="center"><?php  echo $orderQty-$totalMaterialQty; ?></td>
							 <!-- <td width="12%" align="center"><?php echo $resListing12['bomvalueonepc']; ?></td>-->

							 <!-- -->
							  <td width="12%" align="center"><?php echo $resListing12['bomUnit']; ?></td>
							  <td width="12%" align="center"><?php echo $resListing12['bomRate']; ?></td>
							  <td width="12%" align="center"><?php echo $totalMaterialValue; ?></td>
							  <td width="12%" align="center"><span style="color:#FF0000; font-weight:600;"></span></td>
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
							  <td width="12%" align="center"><?php //echo $resListingIndent2['tillorderQtysize']; ?><?php echo round($tillTotalMaterialQty2)+$perqty; ?></td>
							  <td width="12%" align="center"></td>


                            </tr>
							<?php }?>

							<?php $colorno++; } } } ?>

                          </tbody>
                        </table>
						</div>
					  </div>
					</div>
				  </div>



				 </div>
				 </div>


				 <div class="row" style="margin-top:20px;">
				<div class="col-xl-12">
			 	<div class="card mb-0 rounded-bottom-0" style="padding:15px;">
				 	<div class="panel panel-flat">
					<div class="table-responsive">
			 			<table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
                                <td width="100%" style="text-align:center;"><strong style="font-size:23px;">STYLE SUMMARY</strong></td>

                            </tr>
                          </tbody>
                        </table>
						<style>
.buyer-address td{
border:0px solid;
padding:0px;
}
</style>

<div class="btn-group justify-content-center" style="width: fit-content; float: left; padding: 10px 0px; margin: 0px; display: none;" id="deactivatebtnpurchasemerchant">

<a onclick="opmodalpop('Assign To Sourcing','modalpop.php?action=assigntosoursingteam&styleId=<?php echo $_GET['styleid']; ?>&costsheetVersionId=1','400px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="border-radius: 2px; background-color: #0d7544; margin: 0px !important; padding: 5px 10px; font-size: 12px; font-weight: 500;"><i class="fa fa-plus" aria-hidden="true"></i> Assign To</a>

</div>

				        <div id="add_indentmpl">
					    <table width="100%" class="table table-bordered table-responsive forbom" id="tableid11" style="display:block;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body" style="background-color: #fff7b3;;">
							 <td width="24%" align="left"><strong> </strong></td>
                              <td width="12%" align="center"><strong>Total&nbsp;Quantity&nbsp;in&nbsp;Pcs</strong></td>
							  <td width="12%" align="center"><strong>Percentage&nbsp;%</strong></td>
                              <td width="13%" align="center"><strong>F.O.B.&nbsp;Price</strong></td>
							  <td width="13%" align="center"><strong>F.O.B.&nbsp;Value</strong></td>
							  <td width="12%" align="center"><strong>L/Over&nbsp;Value</strong></td>
							  <td width="14%" align="center"><strong>Percentage&nbsp;%</strong></td>
						    </tr>

                          <tr class="card-body">
						   	<td width="24%" align="left">Order Quantity</td>

							  <td width="12%" align="center">81800 </td>
						      <td width="12%" align="center">10 </td>
							  <td width="13%" align="center">1285 </td>
							  <td width="13%" align="center">1285.77</td>
							  <td width="12%" align="center">0</td>
							  <td width="14%" align="center">10</td>
						    </tr>
                          <tr class="card-body">
                            <td align="left">Cut Quantity </td>
                             <td width="12%" align="center">81800 </td>
						      <td width="12%" align="center">10 </td>
							  <td width="13%" align="center">1285 </td>
							  <td width="13%" align="center">1285.77</td>
							  <td width="12%" align="center">0</td>
							  <td width="14%" align="center">10</td>
                          </tr>
                          <tr class="card-body">
                            <td align="left">Shipped Quantity </td>
                             <td width="12%" align="center">81800 </td>
						      <td width="12%" align="center">10 </td>
							  <td width="13%" align="center">1285 </td>
							  <td width="13%" align="center">1285.77</td>
							  <td width="12%" align="center">0</td>
							  <td width="14%" align="center">10</td>
                          </tr>
                          <tr class="card-body">
                            <td align="left">Excess/Short Shipped Quantity</td>
                            <td width="12%" align="center">81800 </td>
						      <td width="12%" align="center">10 </td>
							  <td width="13%" align="center">1285 </td>
							  <td width="13%" align="center">1285.77</td>
							  <td width="12%" align="center">0</td>
							  <td width="14%" align="center">10</td>
                          </tr>
                          <tr class="card-body">
                            <td align="left">Good Garments Quantity L/Over </td>
                            <td width="12%" align="center">81800 </td>
						      <td width="12%" align="center">10 </td>
							  <td width="13%" align="center">1285 </td>
							  <td width="13%" align="center">1285.77</td>
							  <td width="12%" align="center">0</td>
							  <td width="14%" align="center">10</td>
                          </tr>
                          <tr class="card-body">
                            <td align="left">Rejected Garments Quantity L/Over</td>
                            <td width="12%" align="center">81800 </td>
						      <td width="12%" align="center">10 </td>
							  <td width="13%" align="center">1285 </td>
							  <td width="13%" align="center">1285.77</td>
							  <td width="12%" align="center">0</td>
							  <td width="14%" align="center">10</td>
                          </tr>
                          <tr class="card-body">
                            <td align="left">Total Garments Quantity L/Over</td>
                             <td width="12%" align="center">81800 </td>
						      <td width="12%" align="center">10 </td>
							  <td width="13%" align="center">1285 </td>
							  <td width="13%" align="center">1285.77</td>
							  <td width="12%" align="center">0</td>
							  <td width="14%" align="center">10</td>
                          </tr>
                          <tr class="card-body">
                            <td align="left">Sewing Kill</td>
                            <td width="12%" align="center">81800 </td>
						      <td width="12%" align="center">10 </td>
							  <td width="13%" align="center">1285 </td>
							  <td width="13%" align="center">1285.77</td>
							  <td width="12%" align="center">0</td>
							  <td width="14%" align="center">10</td>
                          </tr>
                          <tr class="card-body">
                            <td align="left">Pannel Change</td>
                             <td width="12%" align="center">81800 </td>
						      <td width="12%" align="center">10 </td>
							  <td width="13%" align="center">1285 </td>
							  <td width="13%" align="center">1285.77</td>
							  <td width="12%" align="center">0</td>
							  <td width="14%" align="center">10</td>
                          </tr>
                          <tr class="card-body">
                            <td align="left">Shipment Sample Quantity</td>
                             <td width="12%" align="center">81800 </td>
						      <td width="12%" align="center">10 </td>
							  <td width="13%" align="center">1285 </td>
							  <td width="13%" align="center">1285.77</td>
							  <td width="12%" align="center">0</td>
							  <td width="14%" align="center">10</td>
                          </tr>
                          <tr class="card-body">
                            <td align="left">Missing Garment Quantity If L/Over</td>
                           <td width="12%" align="center">81800 </td>
						      <td width="12%" align="center">10 </td>
							  <td width="13%" align="center">1285 </td>
							  <td width="13%" align="center">1285.77</td>
							  <td width="12%" align="center">0</td>
							  <td width="14%" align="center">10</td>
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

  </div> </div>
