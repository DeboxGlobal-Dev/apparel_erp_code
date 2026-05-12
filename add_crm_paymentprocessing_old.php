<?php
if($_GET['id']==''){

$namevalue ='addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'"';
$gateLast = addlistinggetlastid('paymentProcessingMaster',$namevalue);
$grnLastId= mysql_insert_id();
}
if($_GET['id']!=''){

$rs=GetPageRecord('*','paymentProcessingMaster','id="'.decode($_GET['id']).'"');
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
              <!--<div class="card-header bg-white">-->
              <!--  <h6 class="card-title">Bill Processing Movement</h6>-->
              <!--</div>-->

              <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
                <div class="card-body">
                  <div class="form-group">
                    <div class="row">

                              <table width="100%" border="" cellspacing="0" cellpadding="" class="table table-responsive table-bordered" style="width:99%" width="99%">
                              <tr>
								<td width="20%" align="left" valign="top"><table width="99%" border="0" cellspacing="" cellpadding="">
								<tr>
								<td>GRN&nbsp;No:</td>
								<td><select id="grnNo" name="grnNo" class="form-control" onchange="addnewline(1);">
								<option value="">Select</option>
								<?php
								$select='';
								$where='';
								$rs='';
								$select='*';
								$where='1 and grnNo!="" order by id desc';
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
								<td><input type="text" name="grnDate" id="grnDate" class="form-control" value="<?php if($editresult['grnDate']=='0000-00-00' || $editresult['grnDate']==''){ echo date('d-m-Y'); }else{  echo date('d-m-Y', strtotime($editresult['grnDate'])); } ?>"/></td>
								</tr>
								<tr>
								<td>PO&nbsp;No:</td>
								<td><input type="text" name="supplierPurchaseOrderId" id="supplierPurchaseOrderId" class="form-control" value="<?php  echo $editresult['supplierPurchaseOrderId']; ?>"/></td>
								</tr>
								<tr>

								 </table></td>
								<td width="20%" align="left" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
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

								</table></td>
								<td width="20%" align="left" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
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


								</table></td>
								<td width="20%" align="left" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
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
                            </table>


      <br>
      <br>
      <br>


                             <div style="overflow: scroll;">

                <table class="table table-responsive table-bordered" style="font-size: 12px;">



              <thead style="background-color: #f9f8f8;">

                   <tr>
				<div class="card-header header-elements-inline bg-info-700">
					<div class="col-xl-9"><h5 class="card-title">Item Details</h5></div>

					</div>
					</tr>

                <tr class="border-top-info" style="background-color: black;">
                  <th>&nbsp;</th>

                  <th colspan="" align="center" style="text-align:center; color:white;">Item&nbsp;Description</th>
                                    <th colspan="" align="center" style="text-align:center; color:white;">HSN</th>

                  <th colspan="" align="center" style="text-align:center; color:white;">Order&nbsp;Qty</th>

                 <th style="text-align:center; color:white;">UOM</th>
                 <!--<th style="text-align:center; color:#fff;">Bill&nbsp;No.</th>-->
                 <th style="text-align:center; color:white;">Qty&nbsp;Received</th>
                 <th style="text-align:center; color:white;">Taxable&nbsp;Amount</th>
                 <th style="text-align:center; color:white;">SGST</th>
                 <!--<th style="text-align:center; color:#fff;">Discount&nbsp;Amt.</th>-->
                 <!--<th style="text-align:center; color:#fff;">Taxable&nbsp;Value</th>-->
                 <th colspan="" style="text-align:center; color:white;">CGST</th>
                 <th colspan="" style="text-align:center; color:white;">IGST</th>
                 <th colspan="" style="text-align:center; color:white;">Bill&nbsp;Amount</th>
                 <th colspan="" style="text-align:center; color:white;">Payment&nbsp;Amount</th>
                  <th style="text-align:center; color:#fff;">Credit&nbsp;Terms</th>
                 <th style="text-align:center; color:#fff;">Payment&nbsp;Due&nbsp;Terms</th>
                </tr>
                <tr class="border-top-info">
<th align="center"><div align="center"><a onClick="addNewRow(1,2);" style="color:#0000FF; cursor: pointer;">+Add&nbsp;New</a></div></th>
                  <th><div align="center"></div></th>
                  <th><div align="center"></div></th>
                  <th style="width:30%;"><div align="center"></div></th>
                  <th><div align="center"></div></th>
                  <!--<th><div align="center"></div></th>-->
                  <th><div align="center"></div></th>
                  <th><div align="center"></div></th>
                  <th><div align="center"></div></th>
                  <!--<th><div align="center"></div></th>-->
                  <!--<th><div align="center"></div></th>-->
                  <th><div align="center"></div></th>
                  <th><div align="center"></div></th>
                  <th><div align="center"></div></th>
                  <th><div align="center"></div></th>

                  <th><div align="center"></div></th>
                  <th><div align="center"></div></th>


                </tr>
              </thead>

               <tbody id="addrow"></tbody>

        <script>
        function addNewRow(id,po){
        if(id==1){
        $("#addrow").load('loadpaymentprocessing.php?add=1&parentId=<?php echo encode($grnLastId); ?>&po='+po);
        }else{
        $("#addrow").load('loadpaymentprocessing.php?parentId=<?php echo encode($grnLastId); ?>&po='+po);
        }

        }
        addNewRow(0,<?php echo $operationData['poNumber'] ?>);

        function deleteRow(id){
        var checkyes = confirm('Are your sure you you want to delete?');
        if(checkyes==true){
        $('#addrow').load('loadpaymentprocessing.php?id='+id+'&deletestatus=yes&parentId=<?php echo encode($grnLastId); ?>&po=<?php echo $operationData['poNumber'] ?>');
        }
        }
        </script>


        <tr class="border-top-info" style="font-weight: 500; font-size: 13px;">
                  <th align="center"><div align="center"></div></th>
                  <th><div align="center">Total</div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center"> </div></th>
                  <!--<th><div align="center"> </div></th>-->
                  <th><div align="center" id="totalqty">0</div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center" id="totalamnt">0.00</div></th>
                  <!--<th><div align="center"> </div></th>-->
                  <!--<th><div align="center" id="totaltax">0.00</div></th>-->
                  <th><div align="center"> </div></th>
                  <th><div align="center" id="totalcgst">0.00</div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center" id="totalsgst">0.00</div></th>
                  <th><div align="center"></div></th>
                  <th><div align="center"></div></th>


                </tr>

            </table>
          </div>


                    </div>
                  </div>
                  <input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">
                  <input type="hidden" name="action" value="editpaymentprocessing">
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
