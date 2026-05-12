 <?php
ob_start();
include "inc.php";
?>

 <?php

 $splitNo = explode('_',$_GET['id']);
 $suppId = decode($splitNo[0]);
 $poNoId = decode($splitNo[1]);

$indentFieldsDataq=GetPageRecord('*','indentCreationMaster','1 and supplierId="'.$suppId.'" and poNumber="'.$poNoId.'"');
$indentFieldsData=mysqli_fetch_array($indentFieldsDataq);

$companyDataq=GetPageRecord('*','companyMaster','1 order by id');
$companyData=mysqli_fetch_array($companyDataq);

$addressDataq=GetPageRecord('*','addressMaster','1 and addressType="company" and addressParent="'.$companyData['id'].'" order by id');
$addressData=mysqli_fetch_array($addressDataq);

$supplierDataq=GetPageRecord('*','suppliersMaster','1 and id="'.$suppId.'"');
$supplierData=mysqli_fetch_array($supplierDataq);

$addressSupplierDataq=GetPageRecord('*','addressMaster','1 and addressType="supplier" and addressParent="'.$supplierData['id'].'" order by id');
$addressSupplierData=mysqli_fetch_array($addressSupplierDataq);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>
  <style type="text/css">
    .tableone{
border:1px solid #c1beba;
    }
    .tableone td{
border:1px solid #c1beba;
    }
  </style>
                          <table width="100%">
                       <tr>
                  <td align="center"><div align="center"><strong style="font-size:18px;">

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





                      </strong></div></td>
                </tr>
                </table>
                <br>
                <br>
              <table width="100%" class="table tableone">
                <tr>
                  <td width="20%" valign="top"><table class="header-table">
                      <tr>
                        <td><div><br><strong><?php echo $companyData['name']; ?></strong><br></div></td>
                      </tr>
                      <tr>
                        <td><div><?php echo $addressData['address']; ?> <?php echo getCityName($addressData['cityId']); ?> <?php echo getStateName($addressData['stateId']); ?> <?php echo getCountryName($addressData['countryId']); ?><br></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>State Code:</strong> <?php echo getStateName($addressData['stateId']);; ?><br></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>Pin Code:</strong> <?php echo $addressData['pinCode']; ?><br></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>GSTN:</strong> <?php echo $addressData['gstn']; ?><br></div></td>
                      </tr>
                    </table></td>
                  <td width="20%" valign="top"><table class="header-table">
                      <tr>
                        <td><div><br><strong>Bill To</strong><br></div></td>
                      </tr>
                      <tr>
                        <td><div><?php echo $companyData['name']; ?></div></td>
                      </tr>
                      <tr>
                        <td><div><?php echo $addressData['address']; ?> <?php echo getCityName($addressData['cityId']); ?> <?php echo getStateName($addressData['stateId']); ?> <?php echo getCountryName($addressData['countryId']); ?></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>State Code:</strong> <?php echo getStateName($addressData['stateId']);; ?><br></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>Pin Code:</strong> <?php echo $addressData['pinCode']; ?><br></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>GSTN:</strong> <?php echo $addressData['gstn']; ?><br></div></td>
                      </tr>
                    </table></td>
                  <td width="20%" valign="top"><table class="header-table">
                      <tr>
                        <td><div><br><strong>Supplier</strong><br></div></td>
                      </tr>
                      <tr>
                        <td><div><?php echo $supplierData['name']; ?></div></td>
                      </tr>
                      <tr>
                        <td><div><?php echo $addressSupplierData['address']; ?> <?php echo getCityName($addressSupplierData['cityId']); ?> <?php echo getStateName($addressSupplierData['stateId']); ?> <?php echo getCountryName($addressSupplierData['countryId']); ?><br></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>State Code:</strong> <?php echo getStateName($addressSupplierData['stateId']);; ?><br></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>Pin Code:</strong> <?php echo $addressSupplierData['pinCode']; ?><br></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>GSTN:</strong> <?php echo $addressSupplierData['gstn']; ?><br></div></td>
                      </tr>
                    </table></td>
                  <td width="20%" valign="top"><table class="header-table">
                      <tr>
                        <td><div><br><strong>Supplier Code:</strong> <?php echo $supplierData['supplierId']; ?><br></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>Tel No:</strong> <?php echo $supplierData['phone']; ?><br></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>Fax No:</strong> <?php echo $supplierData['phone']; ?><br></div></td>
                      </tr>
                    </table></td>
                  <td width="20%" valign="top"><table class="header-table">
                      <tr>
                        <td><div><br><strong>Purchase Order No:</strong> <?php echo $poNoId; ?> <br></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>Purchase Order Date:</strong> <?php echo date('d-M-Y',strtotime($indentFieldsData['createdDate'])); ?> <br></div></td>
                      </tr>
                      <tr>
                        <td><div style="margin-top: 5px;"><strong>PO Type:</strong>
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

                          </div></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <br>
              <br>
              <table width="100%" class="tableone">
                <tr style="color:#FFFFFF;">
                  <td width="3%" bgcolor="#333333"><div align="center"><strong>S.No.</strong></div></td>
                  <td width="8%" bgcolor="#333333"><strong>Item&nbsp;Code</strong></td>
                  <td bgcolor="#333333"><strong>Style&nbsp;No.</strong></td>
                  <td bgcolor="#333333"><strong>Po Type</strong></td>
                  <td bgcolor="#333333"><strong>Delivery&nbsp;Date</strong></td>
                  <td bgcolor="#333333"><strong>Reqmt.&nbsp;No.</strong></td>
                  <td bgcolor="#333333"><strong>HSN&nbsp;Code</strong></td>
                  <td bgcolor="#333333"><strong>Color</strong></td>
                  <td bgcolor="#333333"><strong>Qty</strong></td>
                                    <td bgcolor="#333333"><strong>Greige/Yarn sent</strong></td>

                  <td bgcolor="#333333"><strong>UOM</strong></td>
                  <td bgcolor="#333333"><strong>Price/Qty/UOM</strong></td>
                  <td bgcolor="#333333"><strong>Dis.&nbsp;Amt.</strong></td>
                  <td bgcolor="#333333"><strong>CGST&nbsp;Rate</strong></td>
                  <td bgcolor="#333333"><strong>CGST&nbsp;Amt.</strong></td>
                  <td bgcolor="#333333"><strong>SGST&nbsp;Rate</strong></td>
                  <td bgcolor="#333333"><strong>SGST&nbsp;Amt.</strong></td>
                  <td bgcolor="#333333"><strong>IGST&nbsp;Rate</strong></td>
                  <td bgcolor="#333333"><strong>IGST&nbsp;Amt.</strong></td>
                  <td bgcolor="#333333"><strong>Amount</strong></td>
                </tr>
                <?php
      $sNo=0;
		  $finaltotalqty=0;
		  $totalgrossamount=0;
		  $rsList=GetPageRecord('*','indentCreationMaster','poNumber="'.$poNoId.'"  order by materialTypeId asc');
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
                  <td ><div align="center"><?php echo ++$sNo; ?></div></td>
                  <td ><div><?php
                                            if($rsListData['oldMaterialId']!='0') {
                                                    echo getMaterialName($rsListData['oldMaterialId']);
                                            ?>
                                            <?php  echo ' <br><b>Final Item: </b>'.getMaterialName($rsListData['materialMasterId']);  ?>
                                            <?php
                                            }else{
                                                echo getMaterialName($rsListData['materialMasterId']);
                                            }
                                            ?></div></td>
                  <td >#<?php
                                        if($rsListData['GreigeYarn']!=''){
                                            echo  $rsListData['styleId'];
                                        }else{
                                                echo getStyleRefId($rsListData['styleId']); ?>-<?php if($editstyle['sampleStyle']=='1'){ echo "Bulk"; }else{ echo "Sample"; } 				      }
                                        ?></td>
                  <td ><?php

					if($indentFieldsData['final_or_died_yarn']!=2){
						$rsPo=GetPageRecord('name','poTypeMaster','id="'.$rsListData['poTypeId'].'"');
						$rsPoType=mysqli_fetch_array($rsPo);
						echo $rsPoType['name'];
					}else{
						$rsssss=GetPageRecord('name','processLossMaster','id="'.$rsListData['poTypeId'].'"');
						$restda=mysqli_fetch_array($rsssss);
						echo $restda['name'];
					}
					 ?></td>
                  <td >-</td>
                  <td >&nbsp;</td>
                  <td>-</td>
                  <td align="center"><?php
          $rs11=GetPageRecord('name','colorCardMaster','id="'.$rsListData['color'].'"');
          $resListing11=mysqli_fetch_array($rs11);
          echo $resListing11['name'];?>
                  </td>
                  <td><?php echo $rsListData['orderQty'];$finaltotalqty=$finaltotalqty+$rsListData['orderQty']; ?></td>

                  <td><?php echo $rsListData['greorder']; ?></td>
                  <td><?php echo $rsListData['uom']; ?></td>
                  <td><?php echo $rsListData['sellingRate']; ?>/1/<?php echo $rsListData['uom']; ?></td>
                  <td>&nbsp;</td>
                  <td style="text-align: center;"><?php echo $rsListData['cgst']; ?> % </td>
                  <td></td>
                  <td style="text-align: center;"><?php echo $rsListData['sgst']; ?> % </td>
                  <td></td>
                  <td style="text-align: center;"><?php echo $rsListData['gst']; ?> %</td>
                  <td style="text-align: center;"></td>
                  <td><?php echo $rsListData['sellingValue'];$totalgrossamount=$totalgrossamount+$rsListData['sellingValue']; ?></td>
                </tr>
                <?php }   ?>
                <div id="savesupplierpotaxdetail" style="display:none;"></div>
                <tr style="border: 1px solid #ccc; font-size:15px;">
                  <td colspan="4"><div align="right"><strong>Total:</strong></div></td>
                  <td colspan="5" align="center"><strong><?php echo $finaltotalqty; ?></strong></td>
                  <td style="text-align: center;">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td style="text-align: center;">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td style="text-align: center;">&nbsp;</td>
                  <td style="text-align: center;">&nbsp;</td>
                  <td>&nbsp;</td>
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
                          <td valign="top" style="border: 1px solid #ccc; vertical-align: top;"><table class="header-table">
                              <tr>
                                <td><div style="margin-bottom: 5px;"><strong style="margin-right:19px;">Packing Details :</strong>
                                    <?php  echo $indentFieldsData['packingDetailEntry'];  ?>
                                  </div><br></td>
                              </tr>
                              <tr>
                                <td><div style="margin-bottom: 5px;"><strong>Mode Of Transport :</strong>
                                    <?php  echo $indentFieldsData['trasportDetailEntry'];  ?>
                                  </div><br></td>
                              </tr>
                              <tr>
                                <td><div style="margin-bottom: 5px;"><strong style="margin-right:5px;">Terms Of Delivery :</strong>
                                    <?php  echo $indentFieldsData['termsOfDelivery'];  ?>
                                  </div><br></td>
                              </tr>
                              <tr>
                                <td><div style="margin-bottom: 5px;"><strong style="margin-right:18px;">Payment Terms  :</strong>
                                    <?php  echo $indentFieldsData['paymentTerms'];  ?>
                                  </div></td>
                              </tr>
                            </table></td>
                          <td valign="top" style="border: 1px solid #ccc; vertical-align: top;"><table class="header-table">
                              <tr>
                                <td><div><strong>Ship To</strong></div></td>
                              </tr>
                              <tr>
                                <td><div><?php
                                if(substr($indentFieldsData['shipTo'], 0, 1)=='F'){
                                  $factoryRs=GetPageRecord('id,name','factoryMaster','id="'.str_replace('F~','',$indentFieldsData['shipTo']).'"');
                                  $factoryRsData=mysqli_fetch_array($factoryRs);
                                  echo $factoryRsData['name'];
                                }else{
                                  $vendorRs=GetPageRecord('id,name','vendorMaster','id="'.str_replace('V~','',$indentFieldsData['shipTo']).'"');
                                  $vendorRsData=mysqli_fetch_array($vendorRs);
                                  $venAddrs=GetPageRecord('*',_ADDRESS_MASTER_,'1 and addressParent="'.$vendorRsData['id'].'" and addresstype="vendors"');
										              $venAddrsData=mysqli_fetch_array($venAddrs);
                                  echo $vendorRsData['name'].' ['.$venAddrsData['address'].']';
                                }

                                ?></div></td>
                              </tr>
                              <!-- <tr>
                                <td><div><?php echo $addressData['address']; ?> <?php echo getCityName($addressData['cityId']); ?> <?php echo getStateName($addressData['stateId']); ?> <?php echo getCountryName($addressData['countryId']); ?></div><br></td>
                              </tr>
                              <tr>
                                <td><div><strong>State Code:</strong> <?php echo getStateName($addressData['stateId']);; ?></div><br></td>
                              </tr>
                              <tr>
                                <td><div><strong>Pin Code:</strong> <?php echo $addressData['pinCode']; ?></div><br></td>
                              </tr>
                              <tr>
                                <td><div><strong>GSTN:</strong> <?php echo $addressData['gstn']; ?></div></td>
                              </tr> -->
                            </table></td>
                          <td style="border: 1px solid #ccc; vertical-align: top;"><table width="100%" cellpadding="5" cellspacing="0" class="spcial-class" style=" border-collapse: collapse;">
                              <tr>
                                <td><div><strong>Total&nbsp;Gross&nbsp;Amt.</strong></div></td>
                                <td><div align="right"><?php echo $totalgrossamount; ?></div></td>
                              </tr>
                              <tr>
                                <td><div><strong>Total Discount </strong></div></td>
                                <td><div align="right">0.00</div></td>
                              </tr>
                              <tr>
                                <td><div><strong>Total CGST </strong></div></td>
                                <td><div align="right">0.00</div></td>
                              </tr>
                              <tr>
                                <td><div><strong>Total SGST </strong></div></td>
                                <td><div align="right">0.00</div></td>
                              </tr>
                              <tr>
                                <td><div><strong>Total IGST </strong></div></td>
                                <td><div align="right">0.00</div></td>
                              </tr>
                              <tr>
                                <td><div><strong>Total P &amp; F Amt </strong></div></td>
                                <td><div align="right">0.00</div></td>
                              </tr>
                              <tr>
                                <td><div><strong>Total Others </strong></div></td>
                                <td><div align="right">0.00</div></td>
                              </tr>
                            </table></td>
                        </tr>
                        <tr>
                          <td colspan="3"><div style=" text-transform:uppercase;"><strong>AMOUNT IN WORDS :
                              <?php
$number =  $totalgrossamount;
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
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
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><h3 style="font-weight:bold;">Remarks:</h3></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
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
                          <td width="33%" valign="top" align="center" style="border: 1px solid #ccc; vertical-align: top;"><table class="header-table">
                              <tr>
                                <td align="center"><div style="margin-bottom: 5px;"><strong>Prepared By: </strong> </div><?php echo getUserName($approvedName['addedBy']); ?></td>
                              </tr>
                            </table></td>
                          <td width="33%" valign="top" align="center" style="border: 1px solid #ccc; vertical-align: top;"><table class="header-table">
                              <tr>
                                <td align="center"><div style="margin-bottom: 5px;"><strong>Verified By:</strong> </div><?php echo getUserName($indentFieldsData['addedBy']); ?></td>
                              </tr>
                            </table></td>
                          <td width="33%" valign="top" align="center" style="border: 1px solid #ccc; vertical-align: top;"><table class="header-table">
                              <tr>
                                <td align="center"><div style="margin-bottom: 5px;"><strong>Authorised Signatory:</strong> </div><?php echo getUserName($indentFieldsData['generatedBy']); ?></td>
                              </tr>
                            </table></td>
                        </tr>
                      </table></td>
                  </tr>
                </tbody>
              </table>
              </body>
</html>
