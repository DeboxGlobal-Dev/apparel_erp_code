<?php
ob_start();
include "inc.php";
$assignto='download';
$select='*';

if($_GET['gateentryid']!=''){

$checkDupli= checkduplicate('grnMaster','gateEntryNo="'.decode($_GET['gateentryid']).'" and parentId=0');
	if($checkDupli=="no"){
		$namevalue ='addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",gateEntryNo="'.decode($_GET['gateentryid']).'"';
		$grnLastId = addlistinggetlastid('grnMaster',$namevalue);
	}else{
		$rs=GetPageRecord('*','grnMaster','gateEntryNo="'.decode($_GET['gateentryid']).'" and parentId=0');
		$editresult=mysqli_fetch_array($rs);
		$grnLastId = $editresult['id'];

	}
}


$rsgate=GetPageRecord('*','gateentrymaster','id="'.decode($_GET['gateentryid']).'"');
$editresultgate=mysqli_fetch_array($rsgate);
$supplierId = $editresult['editresultgate'];

?>


     <table width="100%" border="0" cellspacing="0" cellpadding="5" style="border: 1px solid #868686;" >
                        <tr style="background: #e6e6e6;">
                          <td align="center"><div style="font-size:16px; font-weight:bold; ">Goods Receipt Note No. <?php echo $editresult['grnNo']; ?></div></td>
                        </tr>
                        <tr>
                          <td>
                              <table width="100%" border="1" cellspacing="0" cellpadding="5" class="table1" style="">
                                <tr>
                                <td width="30%" height="164" align="left" valign="top" style="" >

									<label>Received&nbsp;At:</label>

                                    <?php
									$select='';
									$where='';
									$rs='';
									$select='*';
									$where='1 and status=1 order by name asc';
									$rs=GetPageRecord($select,'workplaceMaster',$where);
									$resListing=mysqli_fetch_array($rs);
									?>
									<?php echo ($resListing['name']); ?>
                             </td>
                  <td width="45%" align="left" valign="top"><label>Supplier:</label>

                                    <?php
									$select='';
									$where='';
									$rs='';
									$select='*';
									$where='id="'.$editresultgate['supplier'].'"';
									$rs=GetPageRecord($select,'suppliersMaster',$where);
									$resListing=mysqli_fetch_array($rs);
									?>

                                  <?php echo strip($resListing['name']); ?>

                                 <div style="text-align: justify;">
                                 Auro Textiles
                                 Email: aurotextile@gmail.com
                                 Phone: 912345678
                                 Address: Sai Road Baddi Tehsil Nalagarh,Solan, Baddi, Himachal Pardesh (India)
                                 GSTIN:
                                 </div>

                                </td>
                                <td width="25%" align="left" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
								<tr>
									<td>Gate&nbsp;Entry&nbsp;No:</td>
									<td>
									<?php
									$select='';
									$where='';
									$rs='';
									$select='*';
									$where='id="'.$editresultgate['id'].'"';
									$rs=GetPageRecord($select,'gateentrymaster',$where);
									$resListing=mysqli_fetch_array($rs);
									$gateEntryNo = 'GE-'.date('dmy',strtotime($resListing['entrydate'])).'-'.$resListing['id'];
									?>
									<?php echo  $gateEntryNo; ?>
								 </td>
                                    </tr>
								 <tr>
                                      <td>Purchase&nbsp;Order&nbsp;No:</td>
                                      <td><?php echo $editresultgate['ponumber']; ?></td>
                                    </tr>
                                    <!--<tr>
                                      <td>GRN.&nbsp;No:</td>
                                      <td><input type="text" name="docNo" id="docNo"  class="form-control" value="<?php echo $editresult['grnNo']; ?>"/></td>
                                    </tr>-->

                                    <tr>
                                      <td>GRN.&nbsp;Date:</td>
                                      <td><?php if($editresult['docDate']=='0000-00-00' || $editresult['docDate']==''){ echo date('d-m-Y'); }else{  echo date('d-m-Y', strtotime($editresult['docDate'])); } ?></td>
                                    </tr>
                                    <tr>
                                      <td>Party&nbsp;Challan&nbsp;No:</td>
                                      <td><?php  echo $editresult['docNo']; ?></td>
                                    </tr>
                                    <!--<tr>
                                    <td>QC&nbsp;Status: </td>
                                    <td><input type="text" name="qcStatus" id="qcStatus" value="<?php echo $editresult['qcStatus']; ?>"/></td>
                                  </tr>-->
                                    <tr>
                                      <td>E-Way&nbsp;Bill&nbsp;No: </td>
                                      <td><?php echo $editresult['eWayBill']; ?></td>
                                    </tr>
                                    <tr>
                                      <td>Party&nbsp;Bill&nbsp;No:</td>
                                      <td><?php  echo $editresult['qcStatus']; ?></td>
                                    </tr>

                                  </table></td>
                              </tr>
                            </table></td>
                        </tr>
						<tr style="background: #f9f7b7c7;">
							<td align="center"><strong>Material Information</strong></td>
						</tr>
                        <tr>
                          <td>
                              <table width="100%" border="1" cellpadding="10" cellspacing="0" bordercolor="#000000" class="">
                                <tr style="color:#FFFFFF;">
									<!--<td bgcolor="#333333"></td>-->
									<td bgcolor="#333333" align="center"><strong>Style</strong></td>
									<td bgcolor="#333333" align="center" style=""><strong>Material</strong></td>
									<td bgcolor="#333333" align="center"><strong>HSN&nbsp;Code</strong></td>
									<td bgcolor="#333333" align="center"><strong>Color</strong></td>
									<td bgcolor="#333333" align="center"><strong>Order&nbsp;Qty</strong></td>
									<td bgcolor="#333333" align="center"><strong>Received</strong></td>
									<td bgcolor="#333333" align="center"><strong>Net&nbsp;Received</strong></td>
									<td bgcolor="#333333" align="center"><strong>UOM</strong></td>
									<td bgcolor="#333333" align="center"><strong>Balance(Qty)</strong></td>
									<td bgcolor="#333333" align="center"><strong>Rate(INR)</strong></td>
									<td bgcolor="#333333" align="center"><strong>Value(INR)</strong></td>
                                </tr>
                                	<?php
					$no = 1;
					$wherenew='parentId="'.$grnLastId.'" order by id asc';
					$rsnew=GetPageRecord('*','grnMaster',$wherenew);
					while($rslistnew=mysqli_fetch_array($rsnew)){


					$rs11=GetPageRecord('name','colorCardMaster','id="'.$rslistnew['color'].'"');
					$resListing11=mysqli_fetch_array($rs11);
				//	echo $resListing11['name'];
					?>
                  <tr>

					 <td>
					 <?php
					if($rslistnew['styleId']!='0'){
						echo '#'.getStyleRefId($rslistnew['styleId']);
					}else{
						$rsgre=GetPageRecord('styleNo','greigeRequisition','requisitionNo="'.$rslistnew['requisitionNo'].'"');
						$rslistgre=mysqli_fetch_array($rsgre);
						echo $rslistgre['styleNo'];
					}
					 ?>
					 </td>
                    <td>

                    <?php
						$rs=GetPageRecord('*','styleSubCategoryMaster','id="'.$rslistnew['materialId'].'"');
						$resListing=mysqli_fetch_array($rs);
						if($resListing['name']!=""){
						echo $resListing['name'];
						}else{
						$rslss=GetPageRecord('name','materialMaster','id="'.$rslistnew['materialId'].'"');
						$resListingss=mysqli_fetch_array($rslss);
						echo stripslashes($resListingss['name']);
						}
					?></td>
                    <td align="center">-</td>

                    <td align="center"><?php $rs11=GetPageRecord('name','colorCardMaster','id="'.$rslistnew['color'].'"');
							$resListing11=mysqli_fetch_array($rs11);
							echo $resListing11['name'];
							 ?></td>
                    <td align="center"><?php echo $rslistnew['orderQty']; ?></td>
                    <td><?php echo $rslistnew['received']; ?></td>
                   <!-- <td><input type="text" name="qcShortage" id="qcShortage<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['qcShortage']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" /></td>-->
                    <td><?php echo $rslistnew['netReceived']; ?></td>

                    <td><?php echo $rslistnew['uom']; ?></td>
					<td><input type="text" name="balQty" id="balQty<?php echo $rslistnew['id']; ?>" value="" style="width:80px;text-align: center;" readonly /></td>
                    <td><?php echo $rslistnew['rate']; ?></td>
                    <td>428.55</td>
                 <!--   <td><input type="text" name="excess" id="excess<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['excess']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" /></td>-->
                  </tr>
                  <?php }?>

        <!--                        <script>-->
								<!--function deleterow(deleteid){-->
								<!--	$('#loadtabledata').load('loadgrn.php?deletestatus=yes&id=<?php echo encode($grnLastId); ?>&rowid='+deleteid);-->
								<!--}-->
								<!--</script>-->

                                <tr style="color:#FFFFFF;">
                                  <td bgcolor="#333333" colspan="50">&nbsp;</td>
                                </tr>
                              </table>
                            </td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                        </tr>




                      <div class="" style=" margin-top:150px;">
                      <table style="">
                          <tr>
                               <td width="20%">

                                    <table width="100%" style="font-size:12px;">
                                       <tr>
                                      <td>Gate&nbsp;Entry&nbsp;Date:</td>
                                      <td style="border: 1px solid black;"><?php echo date('d-m-Y', strtotime($editresultgate['entrydate'])); ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Vehicle&nbsp;No:</td>
                                      <td style="border: 1px solid black;"><?php echo $editresultgate['vehicleNo']; ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Road&nbsp;Permit&nbsp;Detail:</td>
                                      <td style="border: 1px solid black;"><?php echo $editresult['eSungamNo']; ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Form&nbsp;38&nbsp;No:</td>
                                      <td style="border: 1px solid black;"><?php echo $editresult['formNo']; ?>
                                      </td>
                                    </tr>
                                 </table>
                                  </td>

                                  <td width="20%">

                                    <table width="100%" border="0" cellspacing="1" cellpadding="1" style="font-size:12px;">
                                      <tr>
                                      <td>Transport:</td>
                                      <td style="border: 1px solid black;"><?php echo $editresult['transporter']; ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Billiti&nbsp;No:</td>
                                      <td style="border: 1px solid black;"><?php echo $editresult['billitiNo']; ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Bill&nbsp;Date:</td>
                                      <td style="border: 1px solid black;"><?php if($editresult['eWayBillDate']=='0000-00-00' || $editresult['ginDate']==''){ echo date('d-m-Y'); }else{  echo date('d-m-Y', strtotime($editresult['eWayBillDate'])); } ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>EWAY&nbsp;No:</td>
                                      <td style="border: 1px solid black;"><?php echo $editresult['eWay']; ?>
                                      </td>
                                    </tr>
                                 </table>
                                  </td>

                                    <td width="20%">

                                    <table width="" border="0" cellspacing="1" cellpadding="1" style="font-size:12px;">
                                      <tr>
                                      <td>Delivery&nbsp;Address:</td>
                                      <td style="border: 1px solid black;"><?php echo $editresult['address']; ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>STATE&nbsp;CODE:</td>
                                      <td style="border: 1px solid black;"><?php echo $editresult['stateCode']; ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>IE&nbsp;CODE:</td>
                                      <td style="border: 1px solid black;"><?php echo $editresult['ieCode']; ?>
                                      </td>
                                    </tr>

                                 </table>
                                  </td>

                                    <td width="20%">

                                    <table width="100%" border="0" cellspacing="1" cellpadding="1" style="font-size:12px;">
                                     <tr>
                                      <td  colspan="2"><strong>Other Details:</strong></td>
                                    </tr>
                                    <tr>
                                      <td>HSN</td>
                                      <td style="border: 1px solid black;"><?php echo $editresult['hsn']; ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>AMOUNT</td>
                                      <td style="border: 1px solid black;"><?php echo $editresult['amount']; ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>CGST</td>
                                      <td style="border: 1px solid black;"><?php echo $editresult['cgst']; ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>SGST</td>
                                      <td style="border: 1px solid black;"><?php echo $editresult['sgst']; ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>IGST</td>
                                      <td style="border: 1px solid black;"><?php echo $editresult['igst']; ?>
                                      </td>
                                    </tr>
                                  </table>
                                  </td>

                                   <td width="20%">

                                    <table width="" border="0" cellspacing="1" cellpadding="1" style="font-size:12px;">
                                     <tr>
                                      <td><strong>TAX Details:</strong></td>

                                    </tr>
                                    <tr>
                                      <td>CGST&nbsp;AMT:</td>
                                      <td style="border: 1px solid black;"><?php echo $editresult['cgst1']; ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>SGST&nbsp;AMT:</td>
                                      <td style="border: 1px solid black;"><?php echo $editresult['sgst1']; ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>IGST&nbsp;AMT:</td>
                                      <td style="border: 1px solid black;"><?php echo $editresult['igst1']; ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>UTGST&nbsp;AMT:</td>
                                      <td style="border: 1px solid black;"><?php echo $editresult['utgst1']; ?>
                                      </td>
                                    </tr>

                                 </table>
                                  </td>

                                 </tr>

                                </table>

                        </table>

                                </div>

                                <table class="table table-bordered">
    <thead>
      <tr style="background-color:black; color:white; height:40px; font-size:12px; text-align:center;">
        <th>Remark</th>
        <th>Accepted By</th>
        <th>Prepared By</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="border: 1px solid black; text-align:center;"><?php echo $editresult['chargesDetail']; ?></td>
        <td style="border: 1px solid black; text-align:center;"><?php echo $editresult['acceptBy']; ?></td>
        <td style="border: 1px solid black; text-align:center;"><?php echo $editresult['preparedBy']; ?></td>
        <td style="border: 1px solid black; text-align:center;"><?php echo $editresult['prepareDate']; ?></td>
      </tr>

    </tbody>
  </table>
