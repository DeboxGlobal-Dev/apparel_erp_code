<?php

$indentFieldsDataq=GetPageRecord('*','indentCreationMaster','1 and supplierId="'.decode($_GET['id']).'" and poNumber="'.$_GET['po'].'"');
$indentFieldsData=mysqli_fetch_array($indentFieldsDataq);

?>

<div class="page-content">
    <div class="content-wrapper">
        <div class="content pt-0" style="margin-top:20px;">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
                        <div class="col-xl-9">
                            <h5 class="card-title"><?php echo $pageName; ?></h5>
                        </div>
                        <div class="col-xl-3" style="padding-right: 0px;">
                            <div class="d-flex align-items-center" style="float:right;margin-right:0px;"> <a class="btn"
                                    href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $_GET['module']; ?>"
                                    style="background-color: #949494; color: #fff;">Back <i class="fa fa-backward"
                                        aria-hidden="true"></i> </a> </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="card mb-0 rounded-bottom-0" style="padding:15px;">
                            <style>
                            .header-table tr td {
                                border: 0px solid #ccc !important;
                                padding: 0px !important;
                            }

                            .upper-1-table tr td {
                                vertical-align: top !important;
                            }
                            </style>
                            <?php
$companyDataq=GetPageRecord('*','companyMaster','1 order by id');
$companyData=mysqli_fetch_array($companyDataq);

$addressDataq=GetPageRecord('*','addressMaster','1 and addressType="company" and addressParent="'.$companyData['id'].'" order by id');
$addressData=mysqli_fetch_array($addressDataq);

$supplierDataq=GetPageRecord('*','suppliersMaster','1 and id="'.decode($_GET['id']).'"');
$supplierData=mysqli_fetch_array($supplierDataq);

$addressSupplierDataq=GetPageRecord('*','addressMaster','1 and addressType="supplier" and addressParent="'.$supplierData['id'].'" order by id');
$addressSupplierData=mysqli_fetch_array($addressSupplierDataq);

?>
                            <table width="100%" class="table table-bordered upper-1-table">
                                <tr>
                                    <td align="center" colspan="5">
                                        <div align="center"><strong style="font-size:18px;">

                                                <?php/*


                            if($indentFieldsData['poTypeId']==1){

                            $select='';
                            $where='';
                            $rs='';
                            $select='*';
                            $where='1  order by name asc';
                            $rs=GetPageRecord($select,'poTypeMaster',$where);
                            while($rest=mysqli_fetch_array($rs)){

                            if($indentFieldsData['poSubTypeId']==$rest['id']){
                            echo $rest['name'];

                            }
                            }


                            }else{
                                 echo 'Purchase Order';
                            }*/
?>
                                                Purchase Order [<?php
            if($indentFieldsData['final_or_died_yarn']=='2'){
							$rsssss=GetPageRecord('name','processLossMaster','id="'.$indentFieldsData['poTypeId'].'"');
							$restda=mysqli_fetch_array($rsssss);
							echo $restda['name'];
						}else{
              $where='';
              $rs='';
              $where='id="'.$indentFieldsData['poTypeId'].'"';
						  $rs=GetPageRecord('name','poTypeMaster',$where);
						  $rest=mysqli_fetch_array($rs);
							echo $rest['name'];
						}
                        ?>]
                                            </strong></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="17%" valign="top">
                                        <table class="header-table">
                                            <tr>
                                                <td>
                                                    <div><strong><?php echo $companyData['name']; ?></strong></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><?php echo $addressData['address']; ?>
                                                        <?php echo getCityName($addressData['cityId']); ?>
                                                        <?php echo getStateName($addressData['stateId']); ?>
                                                        <?php echo getCountryName($addressData['countryId']); ?></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>State Code:</strong>
                                                        <?php echo getStateName($addressData['stateId']);; ?></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Pin Code:</strong>
                                                        <?php echo $addressData['pinCode']; ?></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>GSTN:</strong> <?php echo $addressData['gstn']; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="20%" valign="top">
                                        <table class="header-table">
                                            <tr>
                                                <td>
                                                    <div><strong>Bill To</strong></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><?php echo $companyData['name']; ?></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><?php echo $addressData['address']; ?>
                                                        <?php echo getCityName($addressData['cityId']); ?>
                                                        <?php echo getStateName($addressData['stateId']); ?>
                                                        <?php echo getCountryName($addressData['countryId']); ?></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>State Code:</strong>
                                                        <?php echo getStateName($addressData['stateId']);; ?></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Pin Code:</strong>
                                                        <?php echo $addressData['pinCode']; ?></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>GSTN:</strong> <?php echo $addressData['gstn']; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="23%" valign="top">
                                        <table class="header-table">
                                            <tr>
                                                <td>
                                                    <div><strong>Supplier</strong></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><?php echo $supplierData['name']; ?></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><?php echo $addressSupplierData['address']; ?>
                                                        <?php echo getCityName($addressSupplierData['cityId']); ?>
                                                        <?php echo getStateName($addressSupplierData['stateId']); ?>
                                                        <?php echo getCountryName($addressSupplierData['countryId']); ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>State Code:</strong>
                                                        <?php echo getStateName($addressSupplierData['stateId']);; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Pin Code:</strong>
                                                        <?php echo $addressSupplierData['pinCode']; ?></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>GSTN:</strong>
                                                        <?php echo $addressSupplierData['gstn']; ?></div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="17%" valign="top">
                                        <table class="header-table">
                                            <tr>
                                                <td>
                                                    <div><strong>Supplier Code:</strong>
                                                        <?php echo $supplierData['supplierId']; ?></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Tel No:</strong> <?php echo $supplierData['phone']; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Fax No:</strong> <?php echo $supplierData['phone']; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="23%" valign="top">
                                        <table class="header-table">
                                            <tr>
                                                <td>
                                                    <div><strong>Purchase Order No:</strong> <?php echo $_GET['po']; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div><strong>Purchase Order Date:</strong>
                                                        <?php echo date('d-M-Y',strtotime($indentFieldsData['createdDate'])); ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div style="margin-top: 5px;"><strong>PO Type:</strong>

                                                        <?php
            if($indentFieldsData['final_or_died_yarn']=='2'){
							$rsssss=GetPageRecord('name','processLossMaster','id="'.$indentFieldsData['poTypeId'].'"');
							$restda=mysqli_fetch_array($rsssss);
							echo $restda['name'];
						}else{
              $where='';
              $rs='';
              $where='id="'.$indentFieldsData['poTypeId'].'"';
						  $rs=GetPageRecord('name','poTypeMaster',$where);
						  $rest=mysqli_fetch_array($rs);
							echo $rest['name'];
            }
                        ?>



                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%" class="table table-bordered table-responsive">
                                <tr style="color:#FFFFFF;">
                                    <td bgcolor="#333333">
                                        <div align="center"><strong>S.No.</strong></div>
                                    </td>
                                    <td bgcolor="#333333"><strong>Item&nbsp;Code/&nbsp;Item&nbsp;Description </strong>
                                    </td>
                                    <td bgcolor="#333333"><strong>Style</strong></td>
                                    <td bgcolor="#333333"><strong>PO&nbsp;Type</strong></td>
                                    <td bgcolor="#333333" class="po1"><strong>Ready&nbsp;Fabric</strong></td>
                                    <td bgcolor="#333333" class="po1"><strong>Ready&nbsp;Width</strong></td>
                                    <td bgcolor="#333333" class="showdiv"><strong>Delivery&nbsp;Date</strong></td>
                                    <td bgcolor="#333333" class="showdiv"><strong>Reqmt.&nbsp;No.</strong></td>
                                    <td width="9%" bgcolor="#333333" class="showdiv"><strong>HSN&nbsp;Code</strong></td>
                                    <td width="9%" bgcolor="#333333" class=""><strong>Color</strong></td>
                                    <td bgcolor="#333333" class="po1"><strong>Ready&nbsp;Qty.</strong></td>
                                    <td width="4%" bgcolor="#333333" class=""><strong> Order Qty</strong></td>
                                    <td bgcolor="#333333" align="center"><strong>Greige/Yarn sent</strong></td>
                                    <td bgcolor="#333333" align="center"><strong>PL(%)</strong></td>
                                    <td width="15%" bgcolor="#333333" class=""><strong>UOM</strong></td>
                                    <td width="8%" bgcolor="#333333" class=""><strong>Price/Qty/UOM</strong></td>
                                    <td width="8%" bgcolor="#333333" class="showdiv"><strong>Dis.&nbsp;Amount </strong>
                                    </td>
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
        $getappdata=GetPageRecord('addedBy','styleSubCategoryMaster','id="'.$rsListData['materialId'].'" and styleId="'.$rsListData['styleId'].'"');
        $approvedName=mysqli_fetch_array($getappdata);


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


			$rsListreadyqty=GetPageRecord('*','indentCreationMaster','materialId="'.$rsReqParentList['stylesubtabid'].'" and styleId="'.$rsListData['styleId'].'"');
			$rsListDatareadyqty=mysqli_fetch_array($rsListreadyqty);

			}
		  if($rsListData['requisitionNo']==''){
        $style = '#'.getStyleRefId($rsListData['styleId']);
		  }else{
        $style = $rsListData['requisitionNo'];

        if($rsListData['poTypeId']==4){
          $mid = $rsListData['oldMaterialId'];
        }
		  }


      $rsstyle=GetPageRecord('styleRefId,sampleStyle','queryMaster','id="'.$rsListData['styleId'].'"');
      $editstyle=mysqli_fetch_array($rsstyle);
		?>
                                <tr style="border: 1px solid #ccc;">
                                    <td>
                                        <div align="center"><?php echo ++$sNo; ?></div>
                                    </td>
                                    <td>
                                        <div style="width:120px;">

                                            <?php
                                            if($rsListData['oldMaterialId']!='0') {
                                                    echo getMaterialName($rsListData['oldMaterialId']);
                                            ?>
                                            <?php  echo ' <br><b>Final Item: </b>'.getMaterialName($rsListData['materialMasterId']);  ?>
                                            <?php
                                            }else{
                                                echo getMaterialName($rsListData['materialMasterId']);
                                            }
                                            ?>

                                            <!-----For cancel tag-------->
                                            <?php if($rsListData['isCancel']=='yes'){ ?>
                                              <br>
                                              <span class="badge"
                                                style="cursor:pointer;background-color:red; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">
                                                Canceled</span>
                                            <?php } ?>
                                            <!-----For cancel tag end-------->
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        if($rsListData['GreigeYarn']!=''){
                                            echo  $rsListData['styleId'];
                                        }else{
                                                echo getStyleRefId($rsListData['styleId']); ?>-<?php if($editstyle['sampleStyle']=='1'){ echo "Bulk"; }else{ echo "Sample"; } 				      }
                                        ?>


                                    </td>
                                    <td>
                                        <?php

					if($indentFieldsData['final_or_died_yarn']!=2){
						$rsPo=GetPageRecord('name','poTypeMaster','id="'.$rsListData['poTypeId'].'"');
						$rsPoType=mysqli_fetch_array($rsPo);
						echo $rsPoType['name'];
					}else{
						$rsssss=GetPageRecord('name','processLossMaster','id="'.$rsListData['poTypeId'].'"');
						$restda=mysqli_fetch_array($rsssss);
						echo $restda['name'];
					}
					 ?>

                                    </td>
                                    <td class="po1"><?php echo $rsstylesubname['name']; ?></td>
                                    <td class="po1"><?php echo $rsstylesubtechData['bomWidth']; ?></td>
                                    <td class="showdiv"></td>
                                    <td class="showdiv">&nbsp;</td>
                                    <td class="showdiv">-</td>
                                    <td align="center" class=""><?php
					$rs11=GetPageRecord('name','colorCardMaster','id="'.$rsListData['color'].'"');
					$resListing11=mysqli_fetch_array($rs11);
					echo $resListing11['name'];?>
                                    </td>
                                    <td class="po1"><?php echo $rsListDatareadyqty['orderQty']; ?></td>



                                    <td class="">
                                        <?php echo $rsListData['orderQty'];$finaltotalqty=$finaltotalqty+$rsListData['orderQty']; ?>
                                    </td>

                                    <td class="">
                                        <?php  if($rsListData['final_or_died_yarn']==2){ echo $rsListData['materialQty']; }else{ echo $rsListData['greorder']; } ?>
                                    </td>
                                    <td class=""><?php
						$rsssss=GetPageRecord('persantage','processLossMaster','id="'.$rsListData['poTypeId'].'"');
						$restda=mysqli_fetch_array($rsssss);
						echo $restda['persantage']; ?>
                                    </td>
                                    <td class=""><?php echo $rsListData['uom']; ?></td>
                                    <td class="">
                                        <?php echo $rsListData['sellingRate']; ?>/1/<?php echo $rsListData['uom']; ?>
                                    </td>
                                    <td class="showdiv">&nbsp;</td>
                                    <td style="text-align: center;"><?php echo $rsListData['cgst']; ?> % </td>
                                    <td></td>
                                    <td style="text-align: center;"><?php echo $rsListData['sgst']; ?> % </td>
                                    <td></td>
                                    <td style="text-align: center;"><?php echo $rsListData['gst']; ?> %</td>
                                    <td style="text-align: center;"></td>
                                    <td><?php echo $rsListData['sellingValue'];$totalgrossamount=$totalgrossamount+$rsListData['sellingValue']; ?>
                                    </td>
                                </tr>
                                <?php }

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

                                <?php }  ?>
                                <div id="savesupplierpotaxdetail" style="display:none;"></div>
                                <tr style="border: 1px solid #ccc; font-size:15px;">
                                    <td colspan="4">
                                        <div align="right"><strong>Total:</strong></div>
                                    </td>
                                    <td colspan="2" align="center"><strong><?php echo $finaltotalqty; ?></strong></td>
                                    <td colspan="25">&nbsp;</td>
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
                                        <td>
                                            <table class="" cellpadding="10" cellspacing="0" width="100%"
                                                style="border:1px solid #ccc;">
                                                <tr>
                                                    <td width="17%" valign="top"
                                                        style="border: 1px solid #ccc; vertical-align: top;">
                                                        <table class="header-table">
                                                            <tr>
                                                                <td>
                                                                    <div style="margin-bottom: 5px;"><strong
                                                                            style="margin-right:19px;">Packing Details
                                                                            :</strong>
                                                                        <?php  echo $indentFieldsData['packingDetailEntry'];  ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div style="margin-bottom: 5px;"><strong>Mode Of
                                                                            Transport :</strong>
                                                                        <?php  echo $indentFieldsData['trasportDetailEntry'];  ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div style="margin-bottom: 5px;"><strong
                                                                            style="margin-right:5px;">Terms Of Delivery
                                                                            :</strong>
                                                                        <?php  echo $indentFieldsData['termsOfDelivery'];  ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div style="margin-bottom: 5px;"><strong
                                                                            style="margin-right:18px;">Payment Terms
                                                                            :</strong>
                                                                        <?php  echo $indentFieldsData['paymentTerms'];  ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="20%" valign="top"
                                                        style="border: 1px solid #ccc; vertical-align: top;">
                                                        <table class="header-table">
                                                            <tr>
                                                                <td>
                                                                    <div><strong>Ship To</strong></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div>
                                                                        <select name="shipTo" id="shipTo"
                                                                            class="form-control"
                                                                            onchange="savePOData();">
                                                                            <option value="">Select</option>
                                                                            <?php
									$factoryRs=GetPageRecord('id,name','factoryMaster','1 order by name asc');
									while($factoryRsData=mysqli_fetch_array($factoryRs)){
									?>
                                                                            <option
                                                                                value="<?php echo 'F~'.$factoryRsData['id']; ?>"
                                                                                <?php if($indentFieldsData['shipTo']=='F~'.$factoryRsData['id']){ echo 'selected'; }?>>
                                                                                Factory -
                                                                                <?php echo $factoryRsData['name']; ?>
                                                                            </option>
                                                                            <?php } ?>
                                                                            <?php
									$vendorRs=GetPageRecord('id,name','vendorMaster','1 order by name asc');
									while($vendorRsData=mysqli_fetch_array($vendorRs)){
										$venAddrs=GetPageRecord('*',_ADDRESS_MASTER_,'1 and addressParent="'.$vendorRsData['id'].'" and addresstype="vendors"');
										$venAddrsData=mysqli_fetch_array($venAddrs);
									?>
                                                                            <option
                                                                                value="<?php echo 'V~'.$vendorRsData['id'];  ?>"
                                                                                <?php if($indentFieldsData['shipTo']=='V~'.$vendorRsData['id']){ echo 'selected'; }?>>
                                                                                <?php echo $vendorRsData['name'].' ['.$venAddrsData['address'].']';  ?>
                                                                            </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </td>
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
                                                        </table>
                                                    </td>
                                                    <td width="20%"
                                                        style="border: 1px solid #ccc; vertical-align: top;">
                                                        <table width="100%" cellpadding="5" cellspacing="0"
                                                            class="spcial-class" style=" border-collapse: collapse;">
                                                            <tr>
                                                                <td>
                                                                    <div align="right"><strong>Total Gross
                                                                            Amount</strong></div>
                                                                </td>
                                                                <td>
                                                                    <div align="right"><?php echo $totalgrossamount; ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div align="right"><strong>Total Discount </strong>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div align="right">0.00</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div align="right"><strong>Total CGST </strong>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div align="right">0.00</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div align="right"><strong>Total SGST </strong>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div align="right">0.00</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div align="right"><strong>Total IGST </strong>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div align="right">0.00</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div align="right"><strong>Total P &amp; F Amount
                                                                        </strong></div>
                                                                </td>
                                                                <td>
                                                                    <div align="right">0.00</div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div align="right"><strong>Total Others </strong>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div align="right">0.00</div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <div style=" text-transform:uppercase;"><strong>AMOUNT IN WORDS
                                                                :
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
                                                            </strong></div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 style="font-weight:bold;">Remarks:</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>

                                    <tr>
                                        <td>
                                            <table class="" cellpadding="10" cellspacing="0" width="100%"
                                                style="border:1px solid #ccc;">
                                                <tr>
                                                    <td width="33%" valign="top" align="center"
                                                        style="border: 1px solid #ccc; vertical-align: top;">
                                                        <table class="header-table">
                                                            <tr>
                                                                <td align="center">
                                                                    <div style="margin-bottom: 5px;"><strong>Prepared
                                                                            By:</strong><br />
                                                                    </div>
                                                                    <?php echo getUserName($approvedName['addedBy']); ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="33%" valign="top" align="center"
                                                        style="border: 1px solid #ccc; vertical-align: top;">
                                                        <table class="header-table">
                                                            <tr>
                                                                <td align="center">
                                                                    <div style="margin-bottom: 5px;"><strong>Verified
                                                                            By:</strong> </div>
                                                                    <?php echo getUserName($indentFieldsData['addedBy']); ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="33%" valign="top" align="center"
                                                        style="border: 1px solid #ccc; vertical-align: top;">
                                                        <table class="header-table">
                                                            <tr>
                                                                <td align="center">
                                                                    <div style="margin-bottom: 5px;"><strong>Authorised
                                                                            Signatory:</strong> </div>
                                                                    <?php echo getUserName($indentFieldsData['generatedBy']); ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /dashboard content -->
    </div>
    <!-- /content area -->
    <!-- Footer -->
    <!-- /footer -->
</div>
<!-- /main content -->
</div>
<script>
function savePOData() {
    var shipTo = encodeURI($('#shipTo').val());

    $('#saveindentinspectiondata').load(
        'apparelbomaction.php?action=saveindentinspectiondataShipTo&poNumber=<?php echo $_GET['po']; ?>&shipTo=' +
        shipTo);
}
</script>
<div id="saveindentinspectiondata" style="display:none;"></div>
<style>
.liststyleimg {
    float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;
}

.badge.dropdown-toggle:after {
    display: none;
}

.purchase-class tr td {
    border: 1px solid #ccc;

}
</style>
<script>
$(function() {
    $("#appdate").datepicker();
});
</script>