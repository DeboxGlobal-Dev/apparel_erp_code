<?php
if($_GET['id']==''){
	deleteRecord('billMovementMaster','styleId="0"');

	deleteRecord('billMovementMaster','parentId="0" and grnId=0');

	$namevalue ='addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'"';
	$grnLastId = addlistinggetlastid('billMovementMaster',$namevalue);
}else{
	$rs=GetPageRecord('*','billMovementMaster','id="'.decode($_GET['id']).'"');
	$editresult=mysqli_fetch_array($rs);
	$grnLastId = $editresult['id'];
}


?>
<div class="container-fluid">
  <div class="page-content">
    <!-- Main sidebar -->
    <?php include "left.php"; ?>
    <!-- /main sidebar -->
    <!-- Main content -->
    <div class="content-wrapper">
      <!-- Content area -->
      <div class="content pt-0" style="margin-top:20px;">
        <!-- Dashboard content -->
        <!---style information section--->
        <!---style information section end--->
        <div class="row">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-header bg-white">
                <h6 class="card-title">Payment Processing</h6>
              </div>

              <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
                <div class="card-body">
                  <div class="form-group">
                    <div class="row">
                      <!--<table width="50%" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#000000" style="border:1px #ccc;">-->
                      <table width="100%" border="0" cellspacing="0" cellpadding="5" style="border: 1px solid #868686;" >
                        <tr style="background: #e6e6e6;">
                          <td align="center"><div style="font-size:16px; font-weight:bold; ">Bill Status</div></td>
                        </tr>
                        <tr>
                          <td><table width="100%" border="1" cellspacing="0" cellpadding="5" class="table1" style="border: 1px solid #868686;">
                              <tr>
								<td width="25%" align="left" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
								<tr>
								<td>GRN&nbsp;No:</td>
								<td><select id="grnNo" name="grnNo" class="form-control" onchange="addnewline(1);getPoNumber(this.value);">
								<?php
								$select='';
								$where='';
								$rs='';
								$select='*';
								$where='id="'.$editresult['grnId'].'"';
								$rs=GetPageRecord($select,'grnMaster',$where);
								while($resListing=mysqli_fetch_array($rs)){
								?>
								<option value="<?php echo $resListing['id']; ?>" <?php if($editresult['grnNo']==$resListing['grnNo']){ ?> selected <?php }?>><?php echo $resListing['grnNo']; ?></option>
								<?php } ?>
								</select></td>
								</tr>
								<script>
								$(function(){
								$("#grnDate").datepicker();
								$("#eWayBillDate").datepicker();
								});


								</script>

								<tr>
								<td>GRN.&nbsp;Date:</td>
								<td><!--<input type="text" name="grnDate" id="grnDate" class="form-control" value="<?php if($editresult['grnDate']=='0000-00-00' || $editresult['grnDate']==''){ echo date('d-m-Y'); }else{  echo date('d-m-Y', strtotime($editresult['grnDate'])); } ?>"/>-->
								<input type="text" name="grnDate" id="grnDate" class="form-control" value="<?php echo $editresult['grnDate']; ?>"/>
								</td>
								</tr>
								<tr>
								<td>PO&nbsp;No:</td>
								<td><input type="text" name="supplierPurchaseOrderId" id="supplierPurchaseOrderId" class="form-control" value=""/></td>
								</tr>
								<tr>
								<td>GE&nbsp;No:</td>
								<td>
								<span id="dummy" style='display:none;'></span>
								<select id="gateEntryNo" name="gateEntryNo" class="form-control">
									<option value="">Select</option>
									<?php
									$select='';
									$where='';
									$rs='';
									$select='*';
									$where='1 and status="2" order by id desc';
									$rs=GetPageRecord($select,'gateentrymaster',$where);
									while($resListing=mysqli_fetch_array($rs)){
									$gateEntryNo = 'GE-'.date('dmy',strtotime($resListing['entrydate'])).'-'.$resListing['id'];
									?>
									<option value="<?php echo $resListing['id']; ?>" <?php if($editresult['gateEntryNo']==$resListing['id']){ ?> selected <?php }?>><?php echo  $gateEntryNo; ?></option>
									<?php } ?>
									</select>
									<script>
									function getPoNumber(grnId){
										$('#dummy').load('loadgetponumber.php?grnId='+grnId);
									}
									getPoNumber("<?php echo $editresult['grnId']; ?>");
									</script>
								</td>
								</tr>
								 </table></td>
								<td width="25%" align="left" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
								 <tr>
								  <td>Challan&nbsp;No: </td>
								  <td><input type="text" name="challanNo" id="challanNo" class="form-control"  value="<?php echo $editresult['challanNo']; ?>" /></td>
								</tr>
								 <tr>
								  <td>E-Way&nbsp;Bill&nbsp;No: </td>
								  <td><input type="text" name="eWayBill" id="eWayBill" class="form-control"  value="<?php echo $editresult['eWayBill']; ?>" /></td>
								</tr>
								 <tr>
								  <td>Party&nbsp;Challan&nbsp;No:</td>
								  <td><input type="text" name="docNo" id="docNo" class="form-control" value="<?php  echo $editresult['docNo']; ?>"/></td>
								</tr>
								<tr>
								<td>Bill&nbsp;Attach:</td>
								<td><input type="file" name="attachment"  class="form-control" value=""/></td>
								</tr>
								</table></td>
								<td width="25%" align="left" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
								<tr>
								<td>Bill&nbsp;Date:</td>
								<td><input type="text" name="eWayBillDate" id="eWayBillDate" class="form-control" value="<?php if($editresult['eWayBillDate']=='0000-00-00' || $editresult['eWayBillDate']==''){ echo date('d-m-Y'); }else{  echo date('d-m-Y', strtotime($editresult['eWayBillDate'])); } ?>"/></td>
								</tr>
								<tr>
								<td>Supplier</td>
								<td>
								<select id="supplierId" name="supplierId" class="form-control">
                                    <option value="">Select</option>
                                    <?php
									$select='';
									$where='';
									$rs='';
									$select='*';
									$where='1 order by name asc';
									$rs=GetPageRecord($select,'suppliersMaster',$where);
									while($resListing=mysqli_fetch_array($rs)){
									?>
                                    <option value="<?php echo strip($resListing['id']); ?>" <?php if($editresult['supplierId']==$resListing['id']){ ?> selected <?php }?>><?php echo strip($resListing['name']); ?></option>
                                    <?php } ?>
                                  </select>
								</td>
								</tr>
								<tr>
								<td>Supplier&nbsp;GST#</td>
								<td><input type="text" name="supplierGst" id="supplierGst" class="form-control"  value="<?php echo $editresult['supplierGst']; ?>" /></td>
								</tr>
								<tr>
								<td>Performa&nbsp;Invoice:</td>
								<td><input type="text" name="perfInvoice" id="perfInvoice" class="form-control"  value="<?php echo $editresult['perfInvoice']; ?>" /></td>
								</tr>

								</table></td>
								<td width="25%" align="left" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
								<tr>
								<td>Department&nbsp;Name</td>
								<td><select id="departmentId" name="departmentId" class="form-control">
								<option value="">Select</option>
								<?php
								$select='';
								$where='';
								$rs='';
								$select='*';
								$where='1 order by name asc';
								$rs=GetPageRecord($select,'departmentMaster',$where);
								while($resListing=mysqli_fetch_array($rs)){
								?>
								<option value="<?php echo $resListing['id']; ?>" <?php if($editresult['departmentId']==$resListing['id']){ ?> selected <?php }?>><?php echo $resListing['name']; ?></option>
								<?php } ?>
								</select></td>
								</tr>
								<tr>
								<td>Cost&nbsp;Center</td>
								<td><input type="text" name="costCenter" value="<?php echo $editresult['costCenter']; ?>" class="form-control" /></td>
								</tr>
								<tr>
								<td>Payment&nbsp;Advice&nbsp;No:</td>
								<td><input type="text" name="paymentNo" id="paymentNo" class="form-control" value="<?php  echo $editresult['paymentNo']; ?>"/></td>
								</tr>


								</table></td>
                              </tr>
                            </table></td>
                        </tr>
						<tr style="background: #f9f7b7c7;">
							<td align="center"><strong>Item Details</strong></td>
						</tr>
                        <tr>
                          <td>
                              <table width="100%" border="1" cellpadding="10" cellspacing="0" bordercolor="#000000" class="">
                                <tr style="color:#FFFFFF;">
									<!-- <td bgcolor="#333333"></td> -->
									<td bgcolor="#333333" align="center" style="width: 50%;"><strong>Item Description</strong></td>
									<td bgcolor="#333333" align="center"><strong>Order&nbsp;Qty</strong></td>
									<td bgcolor="#333333" align="center"><strong>PO&nbsp;Qty</strong></td>
									<td bgcolor="#333333" align="center"><strong>Received&nbsp;Qty</strong></td>
									<td bgcolor="#333333" align="center"><strong>Inspected&nbsp;Qty</strong></td>
									<td bgcolor="#333333" align="center"><strong>UOM</strong></td>
									<td bgcolor="#333333" align="center"><strong>Taxable&nbsp;amount</strong></td>
									<td bgcolor="#333333" align="center"><strong>SGST</strong></td>
									<td bgcolor="#333333" align="center"><strong>CGST</strong></td>
									<td bgcolor="#333333" align="center"><strong>IGST</strong></td>
									<td bgcolor="#333333" align="center"><strong>Bill&nbsp;Amt</strong></td>
									<td bgcolor="#333333" align="center"><strong>Payment&nbsp;Amt</strong></td>
									<td bgcolor="#333333" align="center"><strong>Credit&nbsp;Terms</strong></td>
									<td bgcolor="#333333" align="center"><strong>Due&nbsp;Term</strong></td>
                                </tr>
                                <tbody id="loadtabledata">
                                </tbody>
                                <script>
								function addnewline(did){
									var lastid = '<?php echo encode($grnLastId); ?>';
									var grnNo = $('#grnNo').val();
									$('#loadtabledata').load('loadpaymentprocessing.php?action=addnewrow&addsize='+did+'&id='+lastid+'&grnNo='+grnNo);
								}
								<?php if($_GET['id']!=''){ ?>
								addnewline(0);
								<?php } ?>
								</script>
                                <script>
								function deleterow(deleteid){
									$('#loadtabledata').load('loadpaymentprocessing.php?deletestatus=yes&id=<?php echo encode($grnLastId); ?>&rowid='+deleteid);
								}
								</script>

                                <tr style="color:#FFFFFF;">
                                  <td bgcolor="#333333" colspan="50">&nbsp;</td>
                                </tr>
                              </table>
                            </td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                        <!--<tr>
                          <td style="border-bottom:1px solid #000;"><strong>Additional Charges Details:</strong>
                            <input type="text" name="chargesDetail"  id="chargesDetail" value="<?php echo $editresult['chargesDetail']; ?>"/></td>
                        </tr>-->
                        <!--<tr>
                          <td style="border-bottom:1px solid #000;">
						  <table width="100%" border="1" cellspacing="0" cellpadding="5" class="table1" style="border: 1px solid #868686;">
                              <tr>
                                <td width="25%" align="left" valign="top" style="border:0px;">
								<table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td>Gate&nbsp;Entry&nbsp;Date:</td>
                                      <td>
									  <input type="text" name="ginDate" id="ginDate" class="form-control" value="<?php echo date('d-m-Y', strtotime($editresultgate['entrydate'])); ?>" readonly="readonly" />
                                      </td>
                                    </tr>
									<tr>
                                      <td>Vehicle&nbsp;No:</td>
                                      <td>
									  <input type="text" name="ginNo" id="ginNo" class="form-control" value="<?php echo $editresult['ginNo']; ?>"/>
                                      </td>
                                    </tr>
									<tr>
                                      <td>Road&nbsp;Permit&nbsp;Detail:</td>
                                      <td>
									  <input type="text" name="eSungamNo" id="eSungamNo" class="form-control" value="<?php echo $editresult['eSungamNo']; ?>"/>
                                      </td>
                                    </tr>
									<tr>
                                      <td>Form&nbsp;38&nbsp;No:</td>
                                      <td>
									  <input type="text" name="formNo" id="formNo" class="form-control" value="<?php echo $editresult['formNo']; ?>"/>
                                      </td>
                                    </tr>
                                  </table>
								</td>

                                <td width="18%" align="left" valign="top">
								<table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td>Transport:</td>
                                      <td>
									  <input type="text" name="transporter" id="transporter" class="form-control" value="<?php echo $editresult['transporter']; ?>"/>
                                      </td>
                                    </tr>
                                     <tr>
                                      <td>Billiti&nbsp;No:</td>
                                      <td>
									  <input type="text" name="billitiNo" id="billitiNo" class="form-control" value="<?php echo $editresult['billitiNo']; ?>"/>
                                      </td>
                                    </tr>
									<tr>
                                      <td>Bill&nbsp;Date:</td>
                                      <td>
									  <input type="text" name="eWayBillDate" id="eWayBillDate" class="form-control" value="<?php if($editresult['eWayBillDate']=='0000-00-00' || $editresult['ginDate']==''){ echo date('d-m-Y'); }else{  echo date('d-m-Y', strtotime($editresult['eWayBillDate'])); } ?>" />
                                      </td>
                                    </tr>
									<tr>
                                      <td>EWAY&nbsp;No:</td>
                                      <td>
									  <input type="text" name="eWay" id="eWay" class="form-control" value="<?php echo $editresult['eWay']; ?>"/>
                                      </td>
                                    </tr>
                                  </table>
								</td>
                                <td width="24%" align="left" valign="top">
                                	<table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td colspan="4" align="center" style="padding-bottom: 7px"><strong>Delivery&nbsp;Address</strong></td>
                                    </tr>
                                     <tr>
                                      <td colspan="4"><input type="text" name="address" id="address" class="form-control" value="<?php echo $editresult['address']; ?>"/></td>
                                    </tr>
                                    <tr>
                                    	<td colspan="4">&nbsp;</td>
                                    </tr>
                                    <td>STATE&nbsp;CODE</td>
                                      <td>
									  <input type="text" name="stateCode" id="stateCode" class="form-control" value="<?php echo $editresult['stateCode']; ?>"/>
                                      </td>
                                      <td>IE&nbsp;CODE</td>
                                      <td>
									  <input type="text" name="ieCode" id="ieCode" class="form-control" value="<?php echo $editresult['ieCode']; ?>"/>
                                      </td>
                                    </tr>
                                    </table>
                                </td>
								<td width="16%" align="left" valign="top">
								<table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td  colspan="2"><strong>Other Details:</strong></td>
                                    </tr>
                                     <tr>
                                      <td>HSN</td>
                                      <td>
									  <input type="text" name="hsn" id="hsn" class="form-control" value="<?php echo $editresult['hsn']; ?>"/>
                                      </td>
                                    </tr>
									<tr>
                                      <td>AMOUNT</td>
                                      <td>
									  <input type="text" name="amount" id="amount" class="form-control" value="<?php echo $editresult['amount']; ?>"/>
                                      </td>
                                    </tr>
									<tr>
                                      <td>CGST</td>
                                      <td>
									  <input type="text" name="cgst" id="cgst" class="form-control" value="<?php echo $editresult['cgst']; ?>"/>
                                      </td>
                                    </tr>
									<tr>
                                      <td>SGST</td>
                                      <td>
									  <input type="text" name="sgst" id="sgst" class="form-control" value="<?php echo $editresult['sgst']; ?>"/>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>IGST</td>
                                      <td>
									  <input type="text" name="igst" id="gst" class="form-control" value="<?php echo $editresult['igst']; ?>"/>
                                      </td>
                                    </tr>
                                  </table>
								</td>
								<td width="17%" align="left" valign="top">
								<table width="100%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                      <td><strong>TAX Details:</strong></td>
                                      <td>&nbsp;</td>
                                    </tr>
                                     <tr>
                                      <td>CGST&nbsp;AMT:</td>
                                      <td>
									  <input type="text" name="cgst1" id="cgst1" class="form-control" value="<?php echo $editresult['cgst1']; ?>"/>
                                      </td>
                                    </tr>
									<tr>
                                      <td>SGST&nbsp;AMT:</td>
                                      <td>
									  <input type="text" name="sgst1" id="sgst1" class="form-control" value="<?php echo $editresult['sgst1']; ?>"/>
                                      </td>
                                    </tr>
									<tr>
                                      <td>IGST&nbsp;AMT:</td>
                                      <td>
									  <input type="text" name="igst1" id="igst1" class="form-control" value="<?php echo $editresult['igst1']; ?>"/>
                                      </td>
                                    </tr>
									<tr>
                                      <td>UTGST&nbsp;AMT:</td>
                                      <td>
									  <input type="text" name="utgst1" id="utgst1" class="form-control" value="<?php echo $editresult['utgst1']; ?>"/>
                                      </td>
                                    </tr>
                                  </table>
								</td>
                              </tr>-->
                            </table>

						  </td>
                        </tr>
                       <!-- <tr>
                          <td style="border-bottom:1px solid #000;"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                              <tr>
							  	<td style="width: 25%;"><strong>Remark:</strong> </td>
                                <td style="width: 25%;"><strong>Accepted By:</strong></td>
                                <td style="width: 25%;"><strong>Prepared By: </strong></td>
								<td style="width: 25%;"><strong>Date: </strong></td>
                              </tr>
                            </table></td>
                        </tr>
						<tr>
                          <td style="border-bottom:1px solid #000;"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                              <tr>
							  <td style="width: 25%;"><input type="text" name="chargesDetail"  id="chargesDetail" value="<?php echo $editresult['chargesDetail']; ?>" style="width: 100%" /></td>
                                <td style="width: 25%;"><input type="text" name="acceptedBy"  id="acceptedBy" value="<?php echo $editresult['acceptBy']; ?>" style="width: 100%" /></td>
                                <td style="width: 25%;"><input type="text" name="preparedBy"  id="preparedBy" value="<?php echo $editresult['preparedBy']; ?>" style="width: 100%" /></td>
								<td style="width: 25%;"><input type="date" name="preparedDate"  id="preparedDate" value="<?php echo $editresult['prepareDate']; ?>" style="width: 100%" /></td>
                              </tr>
                            </table></td>
                        </tr>-->
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                      </table>

                    </div>
                  </div>
                  <input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">
                  <input type="hidden" name="action" value="editbillmovement">
                  <input type="hidden" name="editId" value="<?php echo encode($grnLastId); ?>">
                  <div class="text-right">
                    <button type="buttton" style="margin:0px;" class="btn btn-primary">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>
                    <label> </label>
                  </div>
                </div>
				<div id="savedata"></div>
              </form>
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
