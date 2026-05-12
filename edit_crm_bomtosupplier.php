<?php
if($loginuserprofileId==1 || $loginuserprofileId==91){
$wheresearchassign=' 1 and ';
} else {
if($loginuserprofileId==92){
$wheresearchassign=' 1 and finalstatus="2" and sampleStyle="1" and (assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'" or ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))) and ';
} else{

if($loginuserprofileId==93){

$wheresearchassign='1';
$wheresearchassign=' '.$wheresearchassign.' and addedBy="'.$_SESSION['userid'].'" and sampleStyle="1" and ';
}

else{
$wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))';
$wheresearchassign=' '.$wheresearchassign.' and ';
}
}
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
$styleid=decode($_GET['styleid']);
}

$indentFieldsDataq=GetPageRecord('*','indentCreationMaster','1 and supplierId="'.decode($_GET['supplierId']).'" and poNumber="'.$_GET['po'].'"');
$indentFieldsData=mysqli_fetch_array($indentFieldsDataq);

$list2=GetPageRecord('*','indentCreationMaster','1 and supplierId="'.decode($_GET['supplierId']).'" and createdDate="'.$_GET['createdDate'].'" and bomPoStatus=0');
$countPending=mysql_num_rows($list2);



?>

<div class="page-content">
  <?php include "left.php"; ?>
  <div class="content-wrapper">
    <?php include "savealert.php"; ?>
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card mb-0 rounded-bottom-0" style="margin-bottom: 10px !important; padding: 10px 5px; width: 100%; text-align: right; float: right; display: block;"> <a class="btn" href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $_GET['module']; ?>" style="background-color: #949494; color: #fff;">Back <i class="fa fa-backward" aria-hidden="true"></i> </a> </div>
          <div class="card mb-0 rounded-bottom-0" style="padding:15px;">
            <div class="panel panel-flat">
              <div class="table-responsive">
                <table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">
                  <tbody style="width: 100%;display: inline-table;">
                    <tr class="card-body">
                      <td width="16%"><strong>Supplier:</strong> <?php echo getSupplierName(decode($_GET['supplierId'])); ?></td>
                      <td width="64%" style="text-align:center;"><strong style="font-size:23px;"> <span style="font-weight:300; font-size: 22px;">-</span></strong></td>
                    </tr>
                  </tbody>
                </table>
                <div class="btn-group justify-content-center" style="width: fit-content; float: left; padding: 10px 0px; margin: 0px; display: none;" id="deactivatebtnpurchasemerchant"> <a onclick="opmodalpop('Generate PO','modalpop.php?action=bomsuppliersentyes&supplierId=<?php echo $_GET['supplierId']; ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="border-radius: 2px; background-color: #08ca94; margin: 0px !important; padding: 5px 10px; font-size: 12px; font-weight: 500;">Generate PO</a> </div>
                <div id="add_indentmpl">
                	<table width="100%" class="table table-bordered table-responsive" style="background-color:#fff;">
				<tbody style="width: 100%;display: inline-table;">
				<tr class="card-body">
				  <td align="center"><input  name="materialCheckAll" type="checkbox" class="checkalldeletematerial" id="materialCheckAll" style="height: 17px;width: 50px;margin-top: 0;text-align: center;" /></td>
				  <td align="center"><strong>Material&nbsp;Id</strong></td>
				  <td align="center"><strong>Material&nbsp;Desc.</strong></td>
				  <td align="center"><strong>Style#</strong></td>
				  <td align="center"><strong>Width</strong></td>
				  <td align="center"><strong>Qty/Avg</strong></td>
				  <td align="center"><strong>UOM</strong></td>
				  <td align="center"><strong>Rate</strong></td>
				  <td align="center"><strong>Value</strong></td>
				  <td align="center"><strong>Color</strong></td>
				  <td align="center"><strong>Size</strong></td>
				  <td align="center"><strong>order&nbsp;Qty</strong></td>
				  				  <td align="center"><strong>Greige/Yarn sent</strong></td>

				  <td align="center"><strong>Status</strong></td>
				</tr>

				<?php
				$rstype=GetPageRecord('*','materialTypeMaster','1 order by id asc');
				while($resListingtype=mysqli_fetch_array($rstype)){

				$rsindentsss=GetPageRecord('*','indentCreationMaster','materialTypeId="'.$resListingtype['id'].'" and supplierId="'.decode($_GET['supplierId']).'" and createdDate="'.$_GET['createdDate'].'"');
				$resListingIndentsss=mysql_num_rows($rsindentsss);
				if($resListingIndentsss>0){

				?>
				<tr class="card-body">
					<td width="100%" align="left" colspan="21" style="background-color: #e5fbfa;text-transform: uppercase;font-size: 14px;"><strong><?php echo $resListingtype['name']; ?></strong></td>
				</tr>
				<?php
				}
				$rsindent=GetPageRecord('*','indentCreationMaster','materialTypeId="'.$resListingtype['id'].'" and supplierId="'.decode($_GET['supplierId']).'" and createdDate="'.$_GET['createdDate'].'"');
				while($resListingIndent1=mysqli_fetch_array($rsindent)){
				$rs1=GetPageRecord('*','styleSubCategoryMaster','id="'.$resListingIndent1['materialId'].'"');
				$resListing1=mysqli_fetch_array($rs1);

        if($resListingIndent1['requisitionNo']==''){
          $poName = substr(getPoTypeName($resListingIndent1['poTypeId']), 0, 3);
        }else{
          $poName = substr(getProcessLossName($resListingIndent1['poTypeId']), 0, 3);
        }


				?>
				 <tr class="card-body">
				   <td align="center"><span class="analyselistclass">
				  <?php if($resListingIndent1['bomPoStatus']==0){ ?>  <input type="checkbox" style=" opacity:1; cursor: pointer; height: 17px; width: 50px; margin-top: 3px;" value="<?php echo $resListingIndent1['id']; ?>" name="analysemateriallistdelete[]" class="deletematerial" /> <?php } ?>
				   </span>
          <input type="hidden" name="poTypeId" id="poTypeId" value="<?php echo strtoupper($poName); ?>" >
          </td>
				  <td align="center"><div style="width: 90px;">
				      <?php

				      if($resListingIndent1['GreigeYarn']!=''){
                if($resListingIndent1['poTypeId']==4){
                  echo getMaterialName($resListingIndent1['oldMaterialId']);
                }else{
                  echo getMaterialName($resListingIndent1['materialId']);
                }

				      }else{
				              echo $resListing1['name'];
				      }


				      ?>


				      </div></td>
				  <td align="center"><?php echo getDescriptionName($resListing1['materialdescriptionid']); ?></td>
				  <td align="center">
				      <?php
				          if($resListingIndent1['GreigeYarn']!=''){
				         echo  $resListingIndent1['styleId'];

				      }else{
				          				      echo '#'.getStyleRefId($resListingIndent1['styleId']);


				      }



				      ?>

				      </td>
				  <td align="center"><?php if($resListingtype['id']=='1'){ echo $resListingIndent1['bomWidth']; } ?></td>
				  <td align="center"><?php echo $resListingIndent1['avg']; ?></td>
				  <td align="center"><?php echo $resListingIndent1['uom']; ?></td>
				  <td align="center"><?php echo $resListingIndent1['sellingRate']; ?></td>
				  <td align="center"><?php echo $resListingIndent1['sellingValue']; ?></td>
				  <?php


$list233=GetPageRecord('*','colorCardMaster','1 and id="'.$resListingIndent1['color'].'"');
$countPending33=mysqli_fetch_array($list233);
				  ?>

				  <td align="center"><?php echo $countPending33['name']; ?></td>
				  <td align="center"><?php echo $resListingIndent1['size']; ?></td>
				  <td align="center"><?php echo $resListingIndent1['orderQty']; ?></td>

				   <td align="center"><?php echo $resListingIndent1['greorder']; ?></td>

				  <td align="center"><?php if($resListingIndent1['bomPoStatus']=='1'){  ?> <a href="#"><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;"> PO Generated</span></a> <?php } ?></td>
				</tr>
				<?php  } } ?>
				</tbody>
				</table>
                </div>
              </div>
              <br>
              <div>
                <style>
.header-table tr td{
border:0px solid #ccc !important;
padding:0px !important;
}
.upper-1-table tr td{
vertical-align:top !important;
}
</style>
                <?php
$companyDataq=GetPageRecord('*','companyMaster','1 order by id');
$companyData=mysqli_fetch_array($companyDataq);

$addressDataq=GetPageRecord('*','addressMaster','1 and addressType="company" and addressParent="'.$companyData['id'].'" order by id');
$addressData=mysqli_fetch_array($addressDataq);

$supplierDataq=GetPageRecord('*','suppliersMaster','1 and id="'.decode($_GET['supplierId']).'"');
$supplierData=mysqli_fetch_array($supplierDataq);

$addressSupplierDataq=GetPageRecord('*','addressMaster','1 and addressType="supplier" and addressParent="'.$supplierData['id'].'" order by id');
$addressSupplierData=mysqli_fetch_array($addressSupplierDataq);

?>
                <table width="100%" class="table table-bordered upper-1-table">
                  <tr>
                    <td align="center" colspan="5"><div align="center"><strong style="font-size:18px;">Purchase Order [<?php
                      	if($indentFieldsData['final_or_died_yarn']=='2'){
							$rsssss=GetPageRecord('name','processLossMaster','id="'.$indentFieldsData['poTypeId'].'"');
							$restda=mysqli_fetch_array($rsssss);
							echo $restda['name'];
						}else{


                        $select='';

						$where='';

						$rs='';

						$select='*';

						$where='1  order by name asc';

						$rs=GetPageRecord($select,'poTypeMaster',$where);

						while($rest=mysqli_fetch_array($rs)){



							if($indentFieldsData['poTypeId']==$rest['id']){
								echo $rest['name'];

							}

							//  if($indentFieldsData['poSubTypeId']==$rest['id']){
							//     echo $rest['name'].'-';

							// }



						}
}
                        ?>]</strong></div></td>
                  </tr>
                  <tr>
                    <td width="17%" valign="top"><table class="header-table">
                        <tr>
                          <td><div><strong><?php echo $companyData['name']; ?></strong></div></td>
                        </tr>
                        <tr>
                          <td><div><?php echo $addressData['address']; ?> <?php echo getCityName($addressData['cityId']); ?> <?php echo getStateName($addressData['stateId']); ?> <?php echo getCountryName($addressData['countryId']); ?></div></td>
                        </tr>
                        <tr>
                          <td><div><strong>State Code:</strong> <?php echo getStateName($addressData['stateId']);; ?></div></td>
                        </tr>
                        <tr>
                          <td><div><strong>Pin Code:</strong> <?php echo $addressData['pinCode']; ?></div></td>
                        </tr>
                        <tr>
                          <td><div><strong>GSTN:</strong> <?php echo $addressData['gstn']; ?></div></td>
                        </tr>
                      </table></td>
                    <td width="20%" valign="top"><table class="header-table">
                        <tr>
                          <td><div><strong>Bill To</strong></div></td>
                        </tr>
                        <tr>
                          <td><div><?php echo $companyData['name']; ?></div></td>
                        </tr>
                        <tr>
                          <td><div><?php echo $addressData['address']; ?> <?php echo getCityName($addressData['cityId']); ?> <?php echo getStateName($addressData['stateId']); ?> <?php echo getCountryName($addressData['countryId']); ?></div></td>
                        </tr>
                        <tr>
                          <td><div><strong>State Code:</strong> <?php echo getStateName($addressData['stateId']);; ?></div></td>
                        </tr>
                        <tr>
                          <td><div><strong>Pin Code:</strong> <?php echo $addressData['pinCode']; ?></div></td>
                        </tr>
                        <tr>
                          <td><div><strong>GSTN:</strong> <?php echo $addressData['gstn']; ?></div></td>
                        </tr>
                      </table></td>
                    <td width="23%" valign="top"><table class="header-table">
                        <tr>
                          <td><div><strong>Supplier</strong></div></td>
                        </tr>
                        <tr>
                          <td><div><?php echo $supplierData['name']; ?></div></td>
                        </tr>
                        <tr>
                          <td><div><?php echo $addressSupplierData['address']; ?> <?php echo getCityName($addressSupplierData['cityId']); ?> <?php echo getStateName($addressSupplierData['stateId']); ?> <?php echo getCountryName($addressSupplierData['countryId']); ?></div></td>
                        </tr>
                        <tr>
                          <td><div><strong>State Code:</strong> <?php echo getStateName($addressSupplierData['stateId']);; ?></div></td>
                        </tr>
                        <tr>
                          <td><div><strong>Pin Code:</strong> <?php echo $addressSupplierData['pinCode']; ?></div></td>
                        </tr>
                        <tr>
                          <td><div><strong>GSTN:</strong> <?php echo $addressSupplierData['gstn']; ?></div></td>
                        </tr>
                      </table></td>
                    <td width="17%" valign="top"><table class="header-table">
                        <tr>
                          <td><div><strong>Supplier Code:</strong> <?php echo $supplierData['supplierId']; ?></div></td>
                        </tr>
                        <tr>
                          <td><div><strong>Tel No:</strong> <?php echo $supplierData['phone']; ?></div></td>
                        </tr>
                        <tr>
                          <td><div><strong>Fax No:</strong> <?php echo $supplierData['phone']; ?></div></td>
                        </tr>
                      </table></td>
                    <td width="23%" valign="top"><table class="header-table">
                        <tr>
                          <td><div><strong>Purchase Order No:</strong> <?php echo $_GET['po']; ?> </div></td>
                        </tr>
                        <tr>
                          <td><div><strong>Purchase Order Date:</strong> <?php echo date('d-M-Y',strtotime($_GET['createdDate'])); ?> </div></td>
                        </tr>
                        <tr>
                          <!--<td><div style="margin-top: 5px;"><strong>PO Type:</strong>
                              <?php if($countPending!=0){ ?>
							  <select name="poTypeEntry" id="" style="padding:5px;" onchange="savePOData();">
                                <option value="">Select</option>
                                <option value="Jobwork" <?php if($indentFieldsData['poTypeEntry']=="Jobwork"){ ?> selected="selected" <?php } ?>>Jobwork</option>
                                <option value="Service" <?php if($indentFieldsData['poTypeEntry']=="Service"){ ?> selected="selected" <?php } ?>>Service</option>
                                <option value="Procurement" <?php if($indentFieldsData['poTypeEntry']=="Procurement"){ ?> selected="selected" <?php } ?>>Procurement</option>
                              </select>
							  <?php } else{
							  echo $indentFieldsData['poTypeEntry'];
							  } ?>
							  <span id="potype"></span>
                            </div></td>-->
                        </tr>
                      </table></td>
                  </tr>
                </table>
				<table width="100%" class="table table-bordered table-responsive">
                          <tr style="color:#FFFFFF;">
                            <td bgcolor="#333333"><div align="center"><strong>S.No.</strong></div></td>
                            <td bgcolor="#333333"><strong>Item&nbsp;Code/&nbsp;Item&nbsp;Description </strong></td>
                            <td bgcolor="#333333"><strong>Style</strong></td>
                            <td bgcolor="#333333" style="display:none;"><strong>PO&nbsp;Type</strong></td>
							<td bgcolor="#333333" class="po1"><strong>Greige&nbsp;Fabric/Width</strong></td>
							<td width="4%" bgcolor="#333333" class="" id><strong><span id="qtysupplier">Qty&nbsp;Sent&nbsp;To&nbsp;Supplier</strong></span></td>
							<td bgcolor="#333333" class="showdiv"><strong>Delivery&nbsp;Date</strong></td>
                            <td bgcolor="#333333" class="showdiv"><strong>Reqmt.&nbsp;No.</strong></td>
                            <td width="9%" bgcolor="#333333" class="showdiv"><strong>HSN&nbsp;Code</strong></td>
							<td bgcolor="#333333" class="po1"><strong>Ready&nbsp;Width</strong></td>
                            <td width="9%" bgcolor="#333333" class=""><strong>Color</strong></td>
							<td bgcolor="#333333" class="po1"><strong>Ready&nbsp;Qty.</strong></td>
                            <td width="15%" bgcolor="#333333" class=""><strong>UOM</strong></td>
                            <td width="8%" bgcolor="#333333" class=""><strong>Price/Qty/UOM</strong></td>
                            <td width="8%" bgcolor="#333333" class="showdiv"><strong>Dis.&nbsp;Amount </strong></td>
                            <td width="9%" bgcolor="#333333"><strong>CGST&nbsp;Rate</strong></td>
                            <td width="14%" bgcolor="#333333"><strong>CGST&nbsp;Amount</strong></td>
                            <td width="9%" bgcolor="#333333"><strong>SGST&nbsp;Rate</strong></td>
                            <td width="14%" bgcolor="#333333"><strong>SGST&nbsp;Amount</strong></td>
                            <td width="9%" bgcolor="#333333"><strong>IGST&nbsp;Rate</strong></td>
                            <td width="14%" bgcolor="#333333"><strong>IGST&nbsp;Amount</strong></td>
                            <td width="14%" bgcolor="#333333"><strong>Amount</strong></td>
                          </tr>
						<?php
						$sNo=0;
						$finaltotalqty=0;
						$totalgrossamount=0;
						$rsList=GetPageRecord('*','indentCreationMaster','poNumber="'.$_GET['po'].'"  order by materialTypeId asc');
						while($rsListData=mysqli_fetch_array($rsList)){
						$rs1=GetPageRecord('*','styleSubCategoryMaster','id="'.$rsListData['materialId'].'"');
						$resListing1=mysqli_fetch_array($rs1);

						$rsstyle=GetPageRecord('sampleStyle','queryMaster','id="'.$rsListData['styleId'].'"');
						$editstyle=mysqli_fetch_array($rsstyle);

						if($rsListData['poTypeId']=='1'){
						$rsInG=GetPageRecord('greigeStyleNo','greigeAllocation','styleId="'.$rsListData['styleId'].'"');
						$rsInGList=mysqli_fetch_array($rsInG);

						$rsReq=GetPageRecord('id','greigeRequisition','styleNo="'.$rsInGList['greigeStyleNo'].'"');
						$rsReqList=mysqli_fetch_array($rsReq);

						$rsReqParent=GetPageRecord('*','greigeRequisition','parentId="'.$rsReqList['id'].'" and color="'.$rsListData['color'].'"');
						$rsReqParentList=mysqli_fetch_array($rsReqParent);

						$rsstylesub=GetPageRecord('name','styleSubCategoryMaster','id="'.$rsReqParentList['stylesubtabid'].'"');
						$rsstylesubname=mysqli_fetch_array($rsstylesub);

						$rsstylesubtech=GetPageRecord('*','techPackDetailMaster','stylesubtabid="'.$rsReqParentList['stylesubtabid'].'"');
						$rsstylesubtechData=mysqli_fetch_array($rsstylesubtech);

						$rsstylesubtech1=GetPageRecord('*','techPackDetailMaster','id="'.$rsReqParentList['stylesubtabid'].'"');
						$rsstylesubtechData1=mysqli_fetch_array($rsstylesubtech1);


		$rsListreadyqty=GetPageRecord('*','indentCreationMaster','materialId="'.$rsReqParentList['stylesubtabid'].'" and styleId="'.$rsListData['styleId'].'"');
		$rsListDatareadyqty=mysqli_fetch_array($rsListreadyqty);
						?>
						<script>
							$('#qtysupplier').text('Greige Qty');
						</script>
						<?php
						}
						?>
                          <tr style="border: 1px solid #ccc;">
                            <td ><div align="center"><?php echo ++$sNo; ?></div></td>
                            <td ><div style="width:120px;"><?php echo $rsstylesubname['name']; ?></div></td>
                            <td><?php if($rsListData['poTypeId']=='1'){ echo $rsInGList['greigeStyleNo']; }?><?php echo getStyleRefId($rsListData['styleId']); ?>-<?php if($editstyle['sampleStyle']=='1'){ echo "Bulk"; }else{ echo "Sample"; } ?></td>
                            <td style="display:none;"><?php
							$rsPo=GetPageRecord('name','poTypeMaster','id="'.$rsListData['poTypeId'].'"');
							$rsPoType=mysqli_fetch_array($rsPo);
							echo $rsPoType['name']; ?>
							<script>
								$('#potype').text('<?php echo $rsPoType['name']; ?>');
							</script></td>
							<td class="po1"><?php echo $resListing1['name']; ?><?php //echo $rsstylesubname['name']; ?>/<?php echo $rsstylesubtechData['bomWidth']; ?></td>

							<td class=""><?php echo $rsListData['orderQty']; $finaltotalqty=$finaltotalqty+$rsListData['orderQty']; ?></td>
							<td class="showdiv"></td>
                            <td class="showdiv">&nbsp;</td>
                            <td class="showdiv">-</td>
                            <td align="center" class=""><?php
					$rs11=GetPageRecord('name','colorCardMaster','id="'.$rsListData['color'].'"');
					$resListing11=mysqli_fetch_array($rs11);
					echo $resListing11['name'];?>
                            </td>
							<td class="po1"><?php echo $rsstylesubtechData['bomWidth']; ?></td>
							<td class="po1"><?php echo $rsListDatareadyqty['orderQty']; ?></td>

                            <td class=""><?php echo $rsListData['uom']; ?></td>
                            <td class=""><?php echo $rsListData['sellingRate']; ?>/1/<?php echo $rsListData['uom']; ?></td>
                            <td class="showdiv">&nbsp;</td>
                            <td style="text-align: center;"><input type="text" name="cgstvalue" value="<?php echo $rsListData['cgst']; ?>"  id="cgstvalue<?php echo $rsListData['id']; ?>" style="width: 40px; text-align:center;" onkeyup="calculateGst<?php echo $rsListData['id']; ?>();" />
                              % </td>
                            <td><input type="text" name="cgstvaluetotalvalue" value=""  id="cgstvaluetotalvalue<?php echo $rsListData['id']; ?>" style="width: 120px; text-align:center;" readonly /></td>
                            <td style="text-align: center;"><input type="text" name="sgstvalue" value="<?php echo $rsListData['sgst']; ?>"  id="sgstvalue<?php echo $rsListData['id']; ?>" style="width: 40px; text-align:center;" onkeyup="calculateGst<?php echo $rsListData['id']; ?>();"  />
                              % </td>
                            <td><input type="text" name="sgsttotalvalue" value=""  id="sgsttotalvalue<?php echo $rsListData['id']; ?>" style="width: 120px; text-align:center;"  readonly /></td>
                            <td style="text-align: center;"><input type="text" name="gstrate" value="<?php echo $rsListData['gst']; ?>" id="gstrate<?php echo $rsListData['id']; ?>" style="width: 40px; text-align:center;" onkeyup="calculateGst<?php echo $rsListData['id']; ?>();"/>
                              % </td>
                            <td style="text-align: center;"><input type="text" name="gstvalue" value=""  id="gstvalue<?php echo $rsListData['id']; ?>" style="width: 120px; text-align:center;" readonly /></td>
                            <td><?php echo $rsListData['sellingValue'];$totalgrossamount=$totalgrossamount+$rsListData['sellingValue']; ?></td>
                          </tr>
                          <script>
		function calculateGst<?php echo $rsListData['id']; ?>(){
			var sellingValue = Number('<?php echo $rsListData['sellingValue']; ?>');
			var gstrateval = $('#gstrate<?php echo $rsListData['id']; ?>').val();
			var cgstvalueval = $('#cgstvalue<?php echo $rsListData['id']; ?>').val();
			var sgstvalueval = $('#sgstvalue<?php echo $rsListData['id']; ?>').val();

			gstrate = Number((sellingValue*gstrateval)/100);
			gstrate2 = parseFloat(gstrate).toFixed(2);
			$('#gstvalue<?php echo $rsListData['id']; ?>').val(gstrate2);

			cgstvalue = Number((sellingValue*cgstvalueval)/100);
			cgstvalue2 = parseFloat(cgstvalue).toFixed(2);
			$('#cgstvaluetotalvalue<?php echo $rsListData['id']; ?>').val(cgstvalue2);

			sgstvalue = Number((sellingValue*sgstvalueval)/100);
			sgstvalue2 = parseFloat(sgstvalue).toFixed(2);
			$('#sgsttotalvalue<?php echo $rsListData['id']; ?>').val(sgstvalue2);
			//var totalvalue = Number(gstrate+sellingValue);
			//totalvalue = parseFloat(totalvalue).toFixed(2);
			//$('#totalvalue<?php echo $rsListData['id']; ?>').val(totalvalue);

			$('#savesupplierpotaxdetail').load('allaction.php?action=savesupplierpotaxdetail&id=<?php  echo $rsListData['id']; ?>&gst='+gstrateval+'&cgst='+cgstvalueval+'&sgst='+sgstvalueval);
		}
		calculateGst<?php echo $rsListData['id']; ?>();


		</script>
        <?php
		if($rsListData['poTypeId']=='1'){
		?>
		<script>
		$('.showdiv').hide();
		$('.po1').show();
		</script>
		<?php
		}else{ ?>
		<script>
		$('.showdiv').show();
		$('.po1').hide();
		</script>

		<?php } } ?>
                          <div id="savesupplierpotaxdetail" style="display:none;"></div>
                          <tr style="border: 1px solid #ccc; font-size:15px;display:none;">
                            <td ></td>
                            <td  align="center"><div align="right"><strong>Total:</strong></div></td>
                            <td colspan="25"><strong><?php echo $finaltotalqty; ?></strong></td>


                          </tr>
                        </table>

                <table width="100%" class=" ">
                  <tbody>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><table class="" cellpadding="10" cellspacing="0" width="100%" style="border:1px solid #ccc;">
                          <tr>
                            <td width="17%" valign="top" style="border: 1px solid #ccc; vertical-align: top;"><table class="header-table">
                                <tr>
                                  <td><div style="margin-bottom: 5px;"><strong style="margin-right:19px;">Packing Details :</strong>
                                       <?php if($countPending!=0){ ?>
									  <select name="packingDetailEntry" id="packingDetailEntry" style="padding:5px;" onchange="savePOData();">
                                        <option value="">Select</option>
                                        <option value="Extra" <?php if($indentFieldsData['packingDetailEntry']=="Extra"){ ?> selected="selected" <?php } ?>>Extra</option>
                                        <option value="Nill" <?php if($indentFieldsData['packingDetailEntry']=="Nill"){ ?> selected="selected" <?php } ?>>Nill</option>
                                      </select>
									  <?php } else{
									  echo $indentFieldsData['packingDetailEntry'];
									  } ?>
                                    </div></td>
                                </tr>
                                <tr>
                                  <td><div style="margin-bottom: 5px;"><strong>Mode Of Transport :</strong>
								    <?php if($countPending!=0){ ?>
                                      <select name="trasportDetailEntry" id="trasportDetailEntry" style="padding:5px;" onchange="savePOData();">
                                        <option value="">Select</option>
                                        <option value="By Road" <?php if($indentFieldsData['trasportDetailEntry']=="By Road"){ ?> selected="selected" <?php } ?>>By Road</option>
                                        <option value="By Train" <?php if($indentFieldsData['trasportDetailEntry']=="By Train"){ ?> selected="selected" <?php } ?>>By Train</option>
                                        <option value="By Air" <?php if($indentFieldsData['trasportDetailEntry']=="By Air"){ ?> selected="selected" <?php } ?>>By Air</option>
                                      </select>
									   <?php } else{
									  echo $indentFieldsData['trasportDetailEntry'];
									  } ?>
                                    </div></td>
                                </tr>
                                <tr>
                                  <td><div style="margin-bottom: 5px;"><strong style="margin-right:5px;">Terms Of Delivery :</strong>
                                       <?php if($countPending!=0){ ?>
									  <input type="text" name="termsOfDelivery" id="termsOfDelivery" style="padding:5px;" onkeyup="savePOData();" value="<?php echo $indentFieldsData['termsOfDelivery']; ?>" />
									   <?php } else{
									  echo $indentFieldsData['termsOfDelivery'];
									  } ?>
                                    </div></td>
                                </tr>
                                <tr>
                                  <td><div style="margin-bottom: 5px;"><strong style="margin-right:18px;">Payment Terms  :</strong>
                                      <?php if($countPending!=0){ ?>
									  <input type="text" name="paymentTerms" id="paymentTerms" style="padding:5px;" onkeyup="savePOData();" value="<?php echo $indentFieldsData['paymentTerms']; ?>" />
									   <?php } else{
									  echo $indentFieldsData['paymentTerms'];
									  } ?>
                                    </div></td>
                                </tr>
                              </table></td>
                            <td width="20%" valign="top" style="border: 1px solid #ccc; vertical-align: top;"><table class="header-table">
                                <tr>
                                  <td><div><strong>Ship To</strong></div></td>
                                </tr>
                                <!--<tr>
                                  <td><div><?php echo $companyData['name']; ?></div></td>
                                </tr>
                                <tr>
                                  <td><div><?php echo $addressData['address']; ?> <?php echo getCityName($addressData['cityId']); ?> <?php echo getStateName($addressData['stateId']); ?> <?php echo getCountryName($addressData['countryId']); ?></div></td>
                                </tr>
                                <tr>
                                  <td><div><strong>State Code:</strong> <?php echo getStateName($addressData['stateId']);; ?></div></td>
                                </tr>
                                <tr>
                                  <td><div><strong>Pin Code:</strong> <?php echo $addressData['pinCode']; ?></div></td>
                                </tr>
                                <tr>
                                  <td><div><strong>GSTN:</strong> <?php echo $addressData['gstn']; ?></div></td>
                                </tr>-->
                              </table></td>
                            <td width="20%" style="border: 1px solid #ccc; vertical-align: top;"><table width="100%" cellpadding="5" cellspacing="0" class="spcial-class" style=" border-collapse: collapse;">
                                <tr>
                                  <td><div align="right"><strong>Total Gross Amount</strong></div></td>
                                  <td><div align="right"><?php echo $totalgrossamount; ?></div></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><strong>Total Discount </strong></div></td>
                                  <td><div align="right">0.00</div></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><strong>Total CGST </strong></div></td>
                                  <td><div align="right">0.00</div></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><strong>Total SGST </strong></div></td>
                                  <td><div align="right">0.00</div></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><strong>Total IGST </strong></div></td>
                                  <td><div align="right">0.00</div></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><strong>Total P &amp; F Amount </strong></div></td>
                                  <td><div align="right">0.00</div></td>
                                </tr>
                                <tr>
                                  <td><div align="right"><strong>Total Others </strong></div></td>
                                  <td><div align="right">0.00</div></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td colspan="3"><div style=" text-transform:uppercase;"><strong>AMOUNT IN WORDS :
                                <?php
  /**
   * Created by PhpStorm.
   * User: sakthikarthi
   * Date: 9/22/14
   * Time: 11:26 AM
   * Converting Currency Numbers to words currency format
   */
$number =  $totalgrossamount;
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " .
          $words[$point = $point % 10] : '';
  echo $result . "Rupees  " . $points . " Paise";
 ?>
                                </strong></div></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><table class="" cellpadding="10" cellspacing="0" width="100%" style="border:1px solid #ccc;">
                          <tr>
                            <td width="25%" valign="top" align="center" style="border: 1px solid #ccc; vertical-align: top;"><table class="header-table">
                                <tr>
                                  <td align="center"><div style="margin-bottom: 5px;"><strong>Accepted By:</strong><br />
                                      <br />
                                    </div></td>
                                </tr>
                              </table></td>
                            <td width="25%" valign="top" align="center" style="border: 1px solid #ccc; vertical-align: top;"><table class="header-table">
                                <tr>
                                  <td align="center"><div style="margin-bottom: 5px;"><strong>Prepared By: </strong> </div></td>
                                </tr>
                              </table></td>
                            <td width="25%" valign="top" align="center" style="border: 1px solid #ccc; vertical-align: top;"><table class="header-table">
                                <tr>
                                  <td align="center"><div style="margin-bottom: 5px;"><strong>Verified By:</strong> </div></td>
                                </tr>
                              </table></td>
                            <td width="25%" valign="top" align="center" style="border: 1px solid #ccc; vertical-align: top;"><table class="header-table">
                                <tr>
                                  <td align="center"><div style="margin-bottom: 5px;"><strong>Authorised Signatory:</strong> </div></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
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
</div>
</div>
</div>
<script type="text/javascript">
		$(document).ready(function(){
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
<script>
function savePOData(){
var poTypeEntry = encodeURI($('#poTypeEntry').val());
var packingDetailEntry = encodeURI($('#packingDetailEntry').val());
var trasportDetailEntry = encodeURI($('#trasportDetailEntry').val());
var termsOfDelivery = encodeURI($('#termsOfDelivery').val());
var paymentTerms = encodeURI($('#paymentTerms').val());

$('#saveindentinspectiondata').load('apparelbomaction.php?action=saveindentinspectiondata&poNumber=<?php echo $_GET['po']; ?>&supplierId=<?php echo decode($_GET['supplierId']); ?>&poTypeEntry='+poTypeEntry+'&packingDetailEntry='+packingDetailEntry+'&trasportDetailEntry='+trasportDetailEntry+'&termsOfDelivery='+termsOfDelivery+'&paymentTerms='+paymentTerms);
}

</script>
<div id="saveindentinspectiondata" style="display:none;"></div>
