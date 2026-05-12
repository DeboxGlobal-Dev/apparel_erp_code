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
                <div class="col-xl-12">
                    <div class="card mb-0 rounded-bottom-0" style="padding:15px;">
                        <div class="panel panel-flat">
                            <div class="table-responsive">
                                <table width="100%" class="table table-bordered table-responsive"
                                    style="margin-bottom:5px;">
                                    <tbody style="width: 100%;display: inline-table;">
                                        <tr class="card-body">
                                            <td width="16%"></td>
                                            <td width="64%" style="text-align:center;"><strong
                                                    style="font-size:23px;">INDENT</strong></td>
                                            <td width="16%" style="text-align:right;">
                                                <?php echo date('d-m-Y h:i:s A'); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="100%" class="table table-bordered table-responsive"
                                    style="margin-bottom:5px;">
                                    <tbody style="width: 100%;display: inline-table;">
                                        <tr class="card-body">
                                            <td width="31%"> <strong>Indent No:
                                                    <?php echo $editresultstyle['sample_indent']; ?></strong></td>
                                            <td width="20%"><strong>Indent Date: </strong></td>
                                            <td width="22%"><strong>Order No: </strong><?php echo $result['orderNo']; ?>
                                            </td>
                                            <td width="27%"><strong>Order Month / Year:
                                                </strong><?php echo date('d-m-Y'); ?></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <style>
                                .buyer-address td {
                                    border: 0px solid;
                                    padding: 0px;
                                }
                                </style>

                                <div class="btn-group justify-content-center"
                                    style="width: fit-content; float: left; padding: 10px 0px; margin: 0px; display: none;"
                                    id="deactivatebtnpurchasemerchant">

                                    <a onclick="opmodalpop('Assign To Sourcing','modalpop.php?action=assigntosoursingteam&styleId=<?php echo $_GET['styleid']; ?>&costsheetVersionId=1','400px','auto');"
                                        data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400"
                                        aria-expanded="false"
                                        style="border-radius: 2px; background-color: #0d7544; margin: 0px !important; padding: 5px 10px; font-size: 12px; font-weight: 500;"><i
                                            class="fa fa-plus" aria-hidden="true"></i> Assign To</a>&nbsp;&nbsp;


                                    <?php

								 	$checkapproved=GetPageRecord('approved','styleSubCategoryMaster','styleId="'.decode($_GET['styleid']).'" and costSheetVersionId="'.$editresultstyle['defaultcostsheetVersionId'].'" and approved=1');
									 $checkapprovedCount=mysql_num_rows($checkapproved);
									 if($checkapprovedCount>0){
								   ?>
                                    <a onclick="opmodalpop('Approval Status','modalpop.php?action=approveindent&styleId=<?php echo $_GET['styleid']; ?>','400px','auto');"
                                        data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400"
                                        aria-expanded="false"
                                        style="border-radius: 2px; background-color: #428bca; margin: 0px !important; padding: 5px 10px; font-size: 12px; font-weight: 500;"><i
                                            class="fa fa-check-square-o" aria-hidden="true"></i> Approve</a>
                                    <?php } ?>

                                </div>

                                <div id="add_indentmpl">
                                    <table width="100%" class="table table-bordered table-responsive forbom"
                                        id="tableid11" style="display:block;">
                                        <tbody style="width: 100%;display: inline-table;">
                                            <tr class="card-body" style="background-color: #fff7b3;;">
                                                <td width="15%" align="center"><strong></strong><input
                                                        name="materialCheckAll" type="checkbox"
                                                        class="checkalldeletematerial" id="materialCheckAll"
                                                        style="height: 17px;width: 50px;margin-top: 0;text-align: center;" />
                                                </td>
                                                <td width="15%" align="center"><strong>Material&nbsp;Id</strong></td>
                                                <td width="12%" align="center"><strong>Material&nbsp;Desc.</strong></td>
                                                <td width="12%" align="center"><strong>Width</strong></td>
                                                <td width="12%" align="center"><strong>Qty/Avg</strong></td>
                                                <td width="12%" align="center"><strong>UOM</strong></td>
                                                <!--<td width="12%" align="center"><strong>Supplier&nbsp;Id</strong></td>
                              <td width="12%" align="center"><strong>Supplier&nbsp;Name</strong></td>-->
                                                <td width="12%" align="center"><strong>Rate</strong></td>
                                                <td width="12%" align="center">
                                                    <strong>Value&nbsp;Of&nbsp;1&nbsp;Piece</strong></td>
                                                <td width="12%" align="center"><strong>Color</strong></td>
                                                <td width="12%" align="center"><strong>Size</strong></td>
                                                <td width="12%" align="center"><strong>PO&nbsp;Qty</strong></td>
                                                <td width="12%" align="center"><strong>Material&nbsp;Qty</strong></td>
                                                <td width="12%" align="center"><strong>Material&nbsp;Value</strong></td>
                                                <td width="12%" align="center"><strong>Stock&nbsp;In&nbsp;Store</strong>
                                                </td>
                                                <td width="12%" align="center"><strong>Total&nbsp;allowance(%)</strong>
                                                </td>
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
                                                <td width="100%" align="left" colspan="20"
                                                    style="background-color: #e5fbfa;text-transform: uppercase;font-size: 14px;">
                                                    <strong><?php echo $resListingtype['name']; ?></strong></td>
                                            </tr>
                                            <?php
							 $rs1=GetPageRecord('*','styleSubCategoryMaster','styleId="'.decode($_GET['styleid']).'" and costsheetVersionId="'.$editresultstyle['defaultcostsheetVersionId'].'" and materialType="'.$resListingtype['id'].'" and parentId=0 order by sr asc');
							while($resListing1=mysqli_fetch_array($rs1)){

							$rowno++;
							$sNo1=$rowno;

							$colorno=1;
							$rs12=GetPageRecord('*','styleColorDetailMaster','styleId="'.decode($_GET['styleid']).'"');
							while($result1=mysqli_fetch_array($rs12)){
							$color='';
							$orderQty='';
							$size='';
							$totalMaterialQty = '0';

							$orderQty+=$result1['qty'];
							$color = $result1['colorId'];

							/*$rs2=GetPageRecord('*','purchaseOrderStyleMaster','parentId="'.$result1['id'].'"');
							while($result2=mysqli_fetch_array($rs2)){
								$size.=$result2['size'].',';
								$orderQty+=$result2['gdQty'];
								$color = $result2['color'];
							}*/

							$rs121=GetPageRecord('*','techPackDetailMaster',' stylesubtabid="'.$resListing1['id'].'" and sectionType="bom" and styleId="'.$resListing1['styleId'].'" and costsheetVersionId="'.$editresultstyle['defaultcostsheetVersionId'].'" order by id asc');
							$resListing12=mysqli_fetch_array($rs121);

							$totalMaterialQty =  $orderQty*$resListing12['avgIncWastage'];
							$totalMaterialValue = $totalMaterialQty*$resListing12['bomRate'];

						?>

                                            <?php
						 $tillTotalMaterialQty=0;
						 if($resListing1['sizeSeparate']==0){
						$tillTotalMaterialQty=0;
						$rsindent=GetPageRecord('SUM(orderQty) as tillorderQty','indentCreationMaster','styleId="'.$resListing1['styleId'].'" and techpackdetailId="'.$resListing12['id'].'" and styleSubCatTableId="'.$resListing1['id'].'" and color="'.$color.'" and size="'.$size.'"');
						$resListingIndent1=mysqli_fetch_array($rsindent);

						$tillTotalMaterialQty= $totalMaterialQty-$resListingIndent1['tillorderQtysize'];

						?>
                                            <tr class="card-body">
                                                <td><label class="analyselistclass">
                                                        <input type="checkbox"
                                                            style=" opacity:1; cursor: pointer; height: 17px; width: 50px; margin-top: 3px;"
                                                            value="<?php echo $resListing12['id']; ?>"
                                                            name="analysemateriallistdelete[]" class="deletematerial" />

                                                    </label>
                                                </td>
                                                <td width="15%" align="center">
                                                    <?php if($resListing1['approved']==1){ ?>
															<span><?php echo $resListing1['name']; ?></span>
													<?php }else{  ?><a href="#"
                                                        onclick="opmodalpop('','modalpop.php?action=indentSendtoBom&techpackdetailId=<?php echo addslashes($resListing12['id']); ?>&styleSubCateId=<?php echo addslashes($resListing1['id']) ?>&styleId=<?php echo addslashes(decode($_GET['styleid'])); ?>&materialId=<?php echo addslashes($resListing1['id']); ?>&materialTypeId=<?php echo addslashes($resListing1['materialType']); ?>&supplierId=<?php echo addslashes($resListing12['storesupplier']); ?>&avg=<?php echo addslashes($resListing12['avgIncWastage']); ?>&uom=<?php echo addslashes($resListing12['bomUnit']); ?>&rate=<?php echo addslashes($resListing12['bomRate']); ?>&valueonepiece=<?php echo addslashes($resListing12['bomvalueonepc']); ?>&color=<?php echo addslashes($color); ?>&size=<?php echo addslashes($size); ?>&poQty=<?php echo addslashes($orderQty); ?>&materialQty=<?php echo addslashes($tillTotalMaterialQty); ?>&totalMaterialValue=<?php echo addslashes($totalMaterialValue); ?>&bomWidth=<?php echo $resListing12['bomWidth']; ?>&materialMasterId=<?php echo $resListing1['materialMasterId']; ?>','900px','auto');"
                                                        data-toggle="modal"
                                                        data-target="#modalpop"><?php echo $resListing1['name']; ?></a>
													<?php } ?>
                                                </td>
                                                <td width="12%" align="center"><?php
							 $rsMaterial=GetPageRecord('*','materialMaster','name="'.$resListing1['name'].'"');
							$rsMaterialList=mysqli_fetch_array($rsMaterial);

							$rstype11=GetPageRecord('*','materialDescriptionMaster','materialId="'.$rsMaterialList['id'].'"');
							$resListingtype11=mysqli_fetch_array($rstype11);
							echo $resListingtype11['shortDescription'];
							 ?></td>
                                                <td width="12%" align="center">
                                                    <?php if($resListingtype['id']==1){ echo $resListing12['bomWidth']; } ?>
                                                </td>
                                                <td width="12%" align="center">
                                                    <?php  echo $resListing12['avgIncWastage']; ?></td>
                                                <td width="12%" align="center"><?php  echo $resListing12['bomUnit']; ?>
                                                </td>
                                                <!--<td width="20%" align="center"><?php  echo getSupplierCode($resListing12['storesupplier']); ?></td>
                              <td width="12%" align="center"><?php  echo getSupplierName($resListing12['storesupplier']); ?></td>-->
                                                <td width="12%" align="center"><?php  echo $resListing12['bomRate']; ?>
                                                </td>
                                                <td width="12%" align="center">
                                                    <?php   echo $resListing12['bomvalueonepc']; ?></td>
                                                <td width="12%" align="center">
                                                    <?php
							if($resListingtype['id']==1 || $resListingtype['id']==3){
							$rs11=GetPageRecord('name','colorCardMaster','id="'.$color.'"');
							$resListing11=mysqli_fetch_array($rs11);
							echo $resListing11['name'];
							}
							?>
                                                </td>
                                                <td width="12%" align="center"><?php  echo $size; ?></td>
                                                <td width="12%" align="center"><?php  echo $orderQty; ?></td>
                                                <td width="12%" align="center"><?php   echo $totalMaterialQty; ?></td>
                                                <td width="12%" align="center">
                                                    <?php echo round($totalMaterialValue,2); ?></td>
                                                <td width="12%" align="center"><span
                                                        style="color:#FF0000; font-weight:600;">No</span></td>
                                                <td width="12%" align="center">
                                                    <!--<?php
							  $totalMaterialQty = round($totalMaterialQty);
							  $perqty = 0;
							  $rspro=GetPageRecord('*','rejectioninproductionmaster','1 order by id asc');
							  while($resultpro=mysqli_fetch_array($rspro)){
								 if($totalMaterialQty>$resultpro['qty']){
									echo $resultpro['totalallwance'];
									$perqty = $resultpro['totalallwance'];
								}
							  }
							  $perqty = $resultpro['qty']*$perqty/100;
							  ?>-->
                                                </td>
                                                <td width="12%" align="center">
                                                    <?php echo $resListingIndent1['tillorderQty']; ?></td>
                                                <td width="12%" align="center"><?php echo $tillTotalMaterialQty1; ?>
                                                </td>
                                                <td width="12%" align="center">
                                                    <?php if($resListingIndent1['sendToBom']=='1'){ ?> <a href="#"><span
                                                            class="badge"
                                                            style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">Assigned</span></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php  } ?>
                                            <?php
							$rs1111=GetPageRecord('*','styleSubCategoryMaster','parentId="'.$resListing1['id'].'"');
							while($resListing1111=mysqli_fetch_array($rs1111)){
							$newsize = $resListing1111['sizeName'];

							$rsindent2=GetPageRecord('SUM(orderQty) as tillorderQtysize','indentCreationMaster','styleId="'.$resListing1['styleId'].'" and techpackdetailId="'.$resListing12['id'].'" and styleSubCatTableId="'.$resListing1['id'].'" and color="'.$color.'"  and size="'.$newsize.'"');
							$resListingIndent2=mysqli_fetch_array($rsindent2);
							$tillTotalMaterialQty2 = $totalMaterialQty-$resListingIndent2['tillorderQtysize'];
							?>
                                            <tr class="card-body" style="">
                                                <td><label class="analyselistclass">
                                                        <input type="checkbox"
                                                            style=" opacity:1; cursor: pointer; height: 17px; width: 50px; margin-top: 3px;"
                                                            value="<?php echo $resListing12['id']; ?>"
                                                            name="analysemateriallistdelete[]" class="deletematerial" />
                                                    </label>
                                                </td>
                                                <td width="15%" align="center">
                                                    <a href="#"
                                                        onclick="opmodalpop('','modalpop.php?action=indentSendtoBom&techpackdetailId=<?php echo addslashes($resListing12['id']); ?>&styleSubCateId=<?php echo addslashes($resListing1['id']) ?>&styleId=<?php echo addslashes(decode($_GET['styleid'])); ?>&materialId=<?php echo addslashes($resListing1['id']); ?>&materialTypeId=<?php echo addslashes($resListing1['materialType']); ?>&supplierId=<?php echo addslashes($resListing12['storesupplier']); ?>&avg=<?php echo addslashes($resListing12['avgIncWastage']); ?>&uom=<?php echo addslashes($resListing12['bomUnit']); ?>&rate=<?php echo addslashes($resListing12['bomRate']); ?>&valueonepiece=<?php echo addslashes($resListing12['bomvalueonepc']); ?>&color=<?php echo addslashes($color); ?>&size=<?php echo addslashes($newsize); ?>&poQty=<?php echo addslashes($orderQty); ?>&materialQty=<?php echo addslashes($tillTotalMaterialQty2); ?>&totalMaterialValue=<?php echo addslashes($totalMaterialValue); ?>&bomWidth=<?php echo $resListing12['bomWidth']; ?>','900px','auto');"
                                                        data-toggle="modal" data-target="#modalpop">
                                                        <?php echo $resListing1['name']; ?> </a>
                                                </td>
                                                <td width="12%" align="center"><?php
							 $rsMaterial2=GetPageRecord('*','materialMaster','name="'.$resListing1['name'].'"');
							$rsMaterialList2=mysqli_fetch_array($rsMaterial2);

							$rstype112=GetPageRecord('*','materialDescriptionMaster','materialId="'.$rsMaterialList2['id'].'"');
							$resListingtype112=mysqli_fetch_array($rstype112);
							echo $resListingtype112['shortDescription'];
							 ?></td>
                                                <td width="12%" align="center">
                                                    <?php if($resListingtype['id']==1){ echo $resListing12['bomWidth']; } ?>
                                                </td>
                                                <td width="12%" align="center">
                                                    <?php echo $resListing12['avgIncWastage']; ?></td>
                                                <td width="12%" align="center"><?php echo $resListing12['bomUnit']; ?>
                                                </td>
                                                <td width="12%" align="center"><?php echo $resListing12['bomRate']; ?>
                                                </td>
                                                <td width="12%" align="center">
                                                    <?php echo $resListing12['bomvalueonepc']; ?></td>
                                                <td width="12%" align="center">
                                                    <?php
							if($resListingtype['id']==2){
								echo $resListing12['trimColor'.$colorno];
							}
							?>
                                                </td>
                                                <td width="12%" align="center"><?php echo $newsize; ?></td>
                                                <td width="12%" align="center"><?php echo $orderQty; ?></td>
                                                <td width="12%" align="center"><?php  echo $totalMaterialQty; ?></td>
                                                <td width="12%" align="center"><?php echo $totalMaterialValue; ?></td>
                                                <td width="12%" align="center"><span
                                                        style="color:#FF0000; font-weight:600;">No</span></td>
                                                <td width="12%" align="center">
                                                    <?php echo $resListingIndent2['tillorderQtysize']; ?></td>
                                                <td width="12%" align="center"><?php echo $tillTotalMaterialQty2; ?>
                                                </td>
                                                <td width="12%" align="center">
                                                    <?php if($resListingIndent1['sendToBom']=='1'){ ?> <a href="#"><span
                                                            class="badge"
                                                            style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">Assigned</span></a><?php } ?>
                                                </td>

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
        </div>

    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    // check uncheck all inclusions
    $("#materialCheckAll").click(function() {
        if (this.checked) {
            $('.deletematerial').each(function() {
                this.checked = true;
            })
        } else {
            $('.deletematerial').each(function() {
                this.checked = false;
            })
        }
    });

});
</script>

<script>
window.setInterval(function() {
    checked = $("#add_indentmpl input[type=checkbox]:checked").length;
    if (!checked) {
        $("#deactivatebtnpurchasemerchant").hide();
    } else {
        $("#deactivatebtnpurchasemerchant").show();
    }
}, 100);
</script>