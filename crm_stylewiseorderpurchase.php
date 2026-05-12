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


?>

<div class="page-content">
  <div class="content-wrapper">
    <?php include "savealert.php"; ?>
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700 filterable" style="padding: 10px;">
            <div class="col-xl-9">
              <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>
            <div class="col-xl-1" style="padding-right: 0px;"> </div>

         <!--   <a href="download-materialoutward.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="    background-color: #03d873b8;"> Download Excel</a>
-->
          </div>
          <div class="card">
            <div id="DataTables_Table_2_filter" class="dataTables_filter">
              <div class="row specialclass">
                <form action="" method="GET">
                  <div class="col-md-12" style="padding:0px;">
				  <label>
                    <select name="styleid" id="styleid" class="select2" style="margin-left: 0px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;">
						<option>Select</option>

						 <?php
                $fcref=GetPageRecord('*','queryMaster','1 and deleteStatus=0 and subject!="" and sampleStyle="1" order by id desc');
                while($refData=mysqli_fetch_array($fcref)){ ?>
                <option value="<?php echo $refData['id']; ?>" <?php if($_GET['styleid']==$refData['id']){ ?> selected="selected" <?php } ?>><?php echo $refData['styleRefId']; ?></option>
                <?php } ?>

					</select>
                    </label>
                    <label>
                  <!-- <input type="text" class="datepick" placeholder="GRN Date" name="fromDate" id="fromDate" value="<?php if($_GET['fromDate']!=''){ echo date('d-m-Y',strtotime($_GET['fromDate'])); } ?>" style="margin-left: 0px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;" readonly />
                    </label>-->
					<label>
                    <input name="submit" type="submit" id="" class="" value="search" style="text-transform: uppercase; background-color: #03c28d; color: #fff; width: 200px; cursor:pointer; margin:0px !important;;"/>
                    </label>
                    <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
                  </div>
                </form>
              </div>
            </div>
            <form name="listform" id="listform" method="get">
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
              <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                <div class="datatable-scroll">
                 <table width="100%" class="table table-bordered table-responsive forbom" id="tableid11" style="display:block;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body" style="background-color: #fff7b3;;">

                              <td width="15%" align="center"><strong>Material/Item&nbsp;Name</strong></td>
                              <!-- <td width="12%" align="center"><strong>Description</strong></td>
							 <td width="12%" align="center"><strong>Width</strong></td>
                              <td width="12%" align="center"><strong>Qty/Avg</strong></td>
                              <td width="12%" align="center"><strong>UOM</strong></td>-->
                              <!--<td width="12%" align="center"><strong>Supplier&nbsp;Id</strong></td>
                              <td width="12%" align="center"><strong>Supplier&nbsp;Name</strong></td>
                              <td width="12%" align="center"><strong>Rate</strong></td>
							  <td width="12%" align="center" style="display:none;"><strong>Value&nbsp;Of&nbsp;1&nbsp;Piece</strong></td>-->
                        	<td width="12%" align="center"><strong>Color</strong></td>
                             <!-- <td width="12%" align="center"><strong>Size</strong></td>
                             <!--  <td width="12%" align="center"><strong>PO&nbsp;Qty&nbsp;(Excess)</strong></td>
							  <td width="12%" align="center"><strong>Material&nbsp;Qty</strong></td>-->
							  <!-- <td width="12%" align="center"><strong>Material&nbsp;Value</strong></td>-->
							<!--  <td width="12%" align="center"><strong>Stock&nbsp;In&nbsp;Store</strong></td>-->
							 <!-- <td width="12%" align="center"><strong>Total&nbsp;allowance(%)</strong></td>-->
							  <td width="12%" align="center"><strong>Qty&nbsp;Required</strong></td>
							  <td width="12%" align="center"><strong>Qty&nbsp;Ordered</strong></td>
							  <td width="12%" align="center"><strong>Qty.&nbsp;Remaining</strong></td>
							   <td width="12%" align="center"><strong>PO.&nbsp;Number</strong></td>
							  <!-- <td width="12%" align="center"><strong>Status</strong></td>-->
							</tr>

							<?php
							$sNo1=0;
							$rowno=0;
							$rstype=GetPageRecord('*','materialTypeMaster','1 order by id asc');
							while($resListingtype=mysqli_fetch_array($rstype)){
							?>
							<!--<tr class="card-body">
								<td width="100%" align="left" colspan="20" style="background-color: #e5fbfa;text-transform: uppercase;font-size: 14px;"><strong><?php echo $resListingtype['name']; ?></strong></td>
							</tr>-->
							<?php
							 $rs1=GetPageRecord('*','styleSubCategoryMaster','styleId="'.$_GET['styleid'].'" and costsheetVersionId="1" and materialType="'.$resListingtype['id'].'" and parentId=0 order by sr asc');


							 //$rs1=GetPageRecord('*','styleSubCategoryMaster','styleId="'.$_GET['styleid'].'" and costsheetVersionId="'.$editresultstyle['defaultcostsheetVersionId'].'" and materialType="'.$resListingtype['id'].'" and parentId=0 and sr<100 order by sr asc');
							while($resListing1=mysqli_fetch_array($rs1)){
							$color='';
							$rowno++;
							$sNo1=$rowno;

							$colorno=1;
							$rs12=GetPageRecord('*','purchaseOrderStyleMaster','styleId="'.$_GET['styleid'].'" and sectionType=0 order by id asc');
							while($result1=mysqli_fetch_array($rs12)){


							$orderQty='';
							$size='';
							$totalMaterialQty = '0';
							$embroidery = 0;
							$garmentDyeing = 0;
							$printing = 0;
							$rs2=GetPageRecord('*','purchaseOrderStyleMaster','parentId="'.$result1['id'].'"');
							while($result2=mysqli_fetch_array($rs2)){
								$size.=$result2['size'].',';
								$orderQty+=$result2['gdQty'];
								$orderQty = round($orderQty);
								$color = $result2['color'];

								$fnsh=$result2['finish'];

							}



							$rs121=GetPageRecord('*','techPackDetailMaster',' stylesubtabid="'.$resListing1['id'].'" and sectionType="bom" and styleId="'.$resListing1['styleId'].'" and costsheetVersionId="1" order by id asc');
							$resListing12=mysqli_fetch_array($rs121);

							$totalallowance=0;
							$totalallow = 0;
							$rspro=GetPageRecord('*','rejectioninproductionmaster','1 and qty>'.$orderQty.'');
							$resultpro=mysqli_fetch_array($rspro);

							//Matching color from style
							//echo '1 and styleId="'.$editresultstyle['id'].'" and colorId="'.$color.'"';
							$rsColorDetail=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$_GET['styleid'].'" and colorId="'.$color.'"');
							$rsColorDetailList=mysqli_fetch_array($rsColorDetail);
							$valEditiArr = explode(',',$rsColorDetailList['valueEdition']);
							if (in_array(10, $valEditiArr))
							{
								$embroidery = $resultpro['extraforemb'];
							}
							if (in_array(11, $valEditiArr))
							{
								$garmentDyeing = $resultpro['extraforgarment'];
							}
							if (in_array(12, $valEditiArr))
							{
								$printing = $resultpro['extraforprinting'];
							}

							$totalallowance = $resultpro['allowedper']+$embroidery+$garmentDyeing+$printing;



							$orderQty = round($orderQty+(($orderQty*$totalallowance)/100));

							//$totalMaterialQty =  round($orderQty*$resListing12['avgIncWastage'],3);





							$total=0;


							$sizeqty=0;
							$rsssqty='';
							$rsssqtylist='';
							$rsssqty=GetPageRecord('*','purchaseOrderStyleMaster','1 and parentId="'.$result1['id'].'" and color="'.$color.'" and finish="'.$fnsh.'"');
							while($rsssqtylist=mysqli_fetch_array($rsssqty)){
						    $rsssqtyzx=GetPageRecord('SUM(gdQty) as trsum','purchaseOrderStyleMaster','1 and parentId="'.$result1['id'].'" and color="'.$color.'" and finish="'.$fnsh.'"');
							$rsssqtylistzx=mysqli_fetch_array($rsssqtyzx);


							if($rsssqtylist['gdQty'] > 0){
								$totalallowance=0;
								$totalallow = 0;
								$rspro=GetPageRecord('*','rejectioninproductionmaster','1 and qty>'.$rsssqtylistzx['trsum'].'');
								$resultpro=mysqli_fetch_array($rspro);
								$totalallowance = $resultpro['allowedper']+$embroidery+$garmentDyeing+$printing;
						 	}

							$calc=$rsssqtylist['gdQty'] * $totalallowance;
							$fcalc=$calc/100;

							$fca=ceil($sizeqty = $rsssqtylist['gdQty'] + $fcalc);
							$total = $total+$fca;

						}

						$totalMaterialQty =  round($total*$resListing12['avgIncWastage'],3);

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

						<?php
						if($resListing1['addMaterialFrom']=='greige'){
							$isGrigeClass = '';
							$rsgreige=GetPageRecord('*','greigeRequisition','1 and srinkageId="'.$resListing1['materialid'].'" and color="'.$color.'" and parentId in ( select id from greigeRequisition where styleNo in (select greigeStyleNo from greigeAllocation where styleId="'.$_GET['styleid'].'")) order by id asc');
							$resultgreige=mysqli_fetch_array($rsgreige);
								if($resultgreige['color']==$color){
									$isGrigeClass = 'inGreige';
								}else{
									$isGrigeClass = 'notInGreige';
								}
						}

						if($resListing1['addMaterialFrom']=='yarn'){
							$isGrigeClass = '';
							$rsgreige=GetPageRecord('*','yarnRequisition','1 and srinkageId="'.$resListing1['materialid'].'" and color="'.$color.'" and parentId in ( select id from yarnRequisition where styleNo in (select greigeStyleNo from yarnAllocation where styleId="'.$_GET['styleid'].'")) order by id asc');
							$resultgreige=mysqli_fetch_array($rsgreige);
								if($resultgreige['color']==$color){
									$isGrigeClass = 'inGreige';
								}else{
									$isGrigeClass = 'notInGreige';
								}
						}
						?>
                          <tr class="card-body <?php if($resListingtype['name']=="Fabric"){ echo $isGrigeClass; } ?>">
						   	<td width="15%" align="center">
							 <div  data-toggle="modal" data-target=""><?php echo  $resListing1['name']; ?></div>
							</td>
                              <!-- <td width="12%" align="center"><?php echo $resListing1['name']; //getDescriptionName($resListing1['materialdescriptionid']); ?></td>
							 <td width="12%" align="center"><?php if($resListingtype['id']==1){ echo $resListing12['bomWidth']; } ?></td>
                              <td width="12%" align="center"><?php  echo $resListing12['avgIncWastage']; ?></td>
                              <td width="12%" align="center"><?php  echo $resListing12['bomUnit']; ?></td>-->
                              <!--<td width="20%" align="center"><?php  echo getSupplierCode($resListing12['storesupplier']); ?></td>
                              <td width="12%" align="center"><?php  echo getSupplierName($resListing12['storesupplier']); ?></td>-->
                           <!--   <td width="12%" align="center"><?php  echo $resListing12['bomRate']; ?></td>
							  <td width="12%" align="center" style="display:none;"><?php   echo $resListing12['bomvalueonepc']; ?></td>-->
							  <td width="12%" align="center">
							  <?php if($resListingtype['id']==1 || $resListingtype['id']==3 || $resListingtype['id']==2){
								$rs11=GetPageRecord('name','colorCardMaster','id="'.$color.'"');
								$resListing11=mysqli_fetch_array($rs11);
									$colorarr = rtrim($resListing11['name'],',');
								}
								 echo $colorarr; ?>
							 </td>
							  <!--<td width="12%" align="center"><?php  echo $size; ?></td>-->
							  <!--<td width="12%" align="center"><?php 	echo $orderQty;   ?></td>-->

							<td width="12%" align="center"><?php 	echo $total;   ?></td>

							<!--<td width="12%" align="center"><?php   echo $totalMaterialQty; ?></td>-->
							   <!--<td width="12%" align="center"><?php echo $totalMaterialValue; ?></td>-->
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
							  </td>
							 <!-- <td width="12%" align="center"><?php echo $resListingIndent1['tillorderQty']; ?></td>-->
							  <td width="12%" align="center"><?php echo $total-$tillTotalMaterialQty; ?></td>
							  <td width="12%" align="center"><?php echo $tillTotalMaterialQty; ?></td>
							  <td width="12%" align="center"><?php
							  	$wherepo = 'styleId="'.$resListing1['styleId'].'" and techpackdetailId="'.$resListing12['id'].'" and styleSubCatTableId="'.$resListing1['id'].'" and color="'.$color.'"';
								$rsp=GetPageRecord('poNumber','indentCreationMaster',$wherepo);
								$rspNumber=mysqli_fetch_array($rsp);
							  echo $rspNumber['poNumber'];

							  ?></td>
							 <!-- <td width="12%" align="center">
							 <?php if($resListingIndent1['sendToBom']=='1'){ ?> <a href="#"><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">Assigned</span></a> <?php } ?>
							  </td>-->
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

							<?php $colorno++;




						}	} } ?>
                          </tbody>
                        </table>
                  <div class="pagingdiv" style="width: 97%;margin: 20px auto;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tbody>
                        <tr>
                          <td><table border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <td style="padding-right:20px;"><?php echo $totalentry; ?> entries</td>
                                <td><select name="records" id="records" onchange="this.form.submit();" class="lightgrayfield" style="padding: 5px;border: 1px solid #ccc; outline:none;">
                                    <option value="25" <?php if($_GET['records']=='25'){ ?> selected="selected"<?php } ?>>25 Records Per Page</option>
                                    <option value="50" <?php if($_GET['records']=='50'){ ?> selected="selected"<?php } ?>>50 Records Per Page</option>
                                    <option value="100" <?php if($_GET['records']=='100'){ ?> selected="selected"<?php } ?>>100 Records Per Page</option>
                                    <option value="200" <?php if($_GET['records']=='200'){ ?> selected="selected"<?php } ?>>200 Records Per Page</option>
                                    <option value="300" <?php if($_GET['records']=='300'){ ?> selected="selected"<?php } ?>>300 Records Per Page</option>
                                  </select></td>
                              </tr>
                            </table></td>
                          <td align="right"><div class="pagingnumbers"><?php echo $paging; ?></div></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<style>
.dataTables_info,.dataTables_paginate,.dataTables_length {
	display:none !important;
 }
</style>
<script>
$(document).ready(function(){
$("#styleid").on("keyup", function() {
var value = $(this).val().toLowerCase();
$("#allhotellisting tr").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
});
</script>
