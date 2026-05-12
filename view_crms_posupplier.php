
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
              <div class="d-flex align-items-center" style="float:right;margin-right:0px;">
				<a href="showpage.crm?module=<?php echo $_GET['module']; ?>"><button type="button" class="btn bg-grey-400 btn-labeled btn-labeled-right ml-auto" style="margin-right: 0px;
				padding: 2px 36px 2px 10px;"><b><i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 8px;
				padding: 0px;
				line-height: 6px;"></i></b>Back</button></a>
				</div>
            </div>
          </div>
          <div class="col-xs-12">




            <div class="card">

              <div class="" style="background-color: #fff; margin-top: 40px;">
                <table width="50%" align="center" cellpadding="0" cellspacing="0">
                  <tbody>
                    <tr>
                      <td><table width="100%" cellspacing="0" cellpadding="10" style="border:1px solid #ccc; border-bottom:0px; border-collapse:collapse;background-color: #f9f9f9;">
                          <tr>
                            <td align="left" width="18%" style="padding:0px;"><img src="<?php echo $fullurl; ?>global_assets/images/aero-club.png" style="border: 1px solid #ccc;border-right: 2px solid #ccc;" /></td>
                            <td align="center" width="64%"><div align="center"><strong style="font-size:18px;">PURCHASE ORDER </strong></div></td>
                            <td align="left" width="18%"><table width="100%" align="right">
                                <tr>
                                  <td width="61%"><div align="left"><strong>P.O.&nbsp;No.</strong> </div></td>
                                  <td width="39%"><div align="left"><?php echo $_REQUEST['po']; ?></div></td>
                                </tr>
                                <tr>
                                  <td><div align="left"><strong>P.O.&nbsp;Date</strong> </div></td>
                                  <td><div align="left"></div></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%" cellspacing="0" cellpadding="15" style="border:1px solid #ccc;border-collapse:collapse;">
                          <tbody>
                            <tr>
                              <td width="33%" align="left" valign="top"><label for="supplierId" style="margin-bottom:2px;"><strong>Plant Details : (Code - 3922)</strong></label>
                                <select name="buyerId" class="form-control" style="width: 190px; border: 1px solid #ccc;">
                                  <?php
					$rs=GetPageRecord('*','buyerMaster','1 and status=1 order by name asc');
					while($resListing=mysqli_fetch_array($rs)){
					?>
                                  <option value="<?php echo strip($resListing['id']); ?>"  ><?php echo strip($resListing['name']); ?></option>
                                  <?php } ?>
                                </select>
                                <div id="showbuyerdetail2" style="font-size:12px !important;"></div></td>
                              <td width="33%" align="left" valign="top"><label for="supplierId" style="margin-bottom:2px;"><strong>Delivery Address</strong> </label>
                                <select name="buyerId" class="form-control" onchange="showbuyerdetail(this.value);" style="width: 190px; border: 1px solid #ccc;">
                                  <?php
					$buyerId = '';
					$rs=GetPageRecord('*','buyerMaster','1 and status=1 order by name asc');
					while($resListing=mysqli_fetch_array($rs)){
					$buyerId = $resListing['id'];
					?>
                                  <option value="<?php echo strip($resListing['id']); ?>"  ><?php echo strip($resListing['name']); ?></option>
                                  <?php } ?>
                                </select>
                                <div id="showbuyerdetail" style="font-size:12px !important;"></div>
                                <script>
				function showbuyerdetail(id){
					$('#showbuyerdetail').load('apparelbomaction.php?action=showbuyerdetail&id='+id);
					$('#showbuyerdetail2').load('apparelbomaction.php?action=showbuyerdetail&id='+id);
				}

				showbuyerdetail('<?php echo $buyerId; ?>');
				</script>
                              </td>
                              <td width="33%" align="left" valign="top"><label for="supplierId" style="margin-bottom:2px;"><strong>Supplier</strong></label>
                                <select name="supplierId" class="form-control" onchange="showsupplierdetail(this.value);" style="width: 190px; border: 1px solid #ccc;">
                                  <?php
		$select='';
		$where='';
		$rs='';
		$select='*';
		$where='id="'.decode($_REQUEST['id']).'"';
		$rs=GetPageRecord($select,'suppliersMaster',$where);
		while($resListing=mysqli_fetch_array($rs)){
		?>
                                  <option value="<?php echo strip($resListing['id']); ?>" <?php if(decode($_REQUEST['id'])==$resListing['id']){ ?> selected <?php }?>><?php echo strip($resListing['name']); ?></option>
                                  <?php } ?>
                                </select>
                                <div id="showsupplierdetail" style="font-size:12px !important;"></div>
                                <script>
		function showsupplierdetail(id){
			$('#showsupplierdetail').load('apparelbomaction.php?action=showsupplierdetail&id='+id);
		}

		showsupplierdetail('<?php echo decode($_REQUEST['id']); ?>');
		</script>
                              </td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                    <tr>
                      <td><div style="overflow:hidden;">
                          <div id="savedetails"></div>
                          <table width="100%" cellpadding="5" cellspacing="0" class="table table-responsive" style="border:1px solid #ccc;border-collapse:collapse; border-top:0px;">
                            <tbody>
                              <tr>
                                <td width="19%"><strong>Currency</strong>
                                  <input type="text" name="currencyname" style="width: 100px; margin-left:10px;"></td>
                                <td width="19%"><strong>PO&nbsp;Status</strong>
                                  <input type="text" name="postatus" style="width: 100px; margin-left:10px;" /></td>
                                <td width="20%"><strong>App&nbsp;Date</strong>
                                  <input type="text" name="appdate" id="appdate" style="width: 100px; margin-left:10px;"></td>
                                <td width="42%"><strong>Div.&nbsp;Period</strong>
                                  <input type="text" name="divperiod" style="width: 100px; margin-left:10px;"></td>
                              </tr>
                            </tbody>
                          </table>
                        </div></td>
                    </tr>
                    <tr>
                      <td><table width="100%" cellpadding="5" cellspacing="0" class="table table-responsive purchase-class" style=" border-collapse: collapse; border-top: 0px; width: 1265px; overflow: auto;">
                          <tr style="color:#FFFFFF;">
                            <td bgcolor="#333333"><div align="center"><strong>S.No.</strong></div></td>
                            <td bgcolor="#333333"><strong>Item&nbsp;Code/&nbsp;Item&nbsp;Description </strong></td>
							<td bgcolor="#333333"><strong>For</strong></td>
                            <td bgcolor="#333333"><strong>Reqmt.&nbsp;No.</strong></td>
                            <td width="9%" bgcolor="#333333"><strong>HSN&nbsp;Code</strong></td>
							 <td width="9%" bgcolor="#333333"><strong>Color</strong></td>
                            <td width="4%" bgcolor="#333333"><strong>Qty</strong></td>
                            <td width="15%" bgcolor="#333333"><strong>UOM</strong></td>
                            <td width="8%" bgcolor="#333333"><strong>Price/Qty/UOM</strong></td>
                            <td width="8%" bgcolor="#333333"><strong>Dis.&nbsp;Amount </strong></td>
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
		?>
                          <tr style="border: 1px solid #ccc;">
                            <td ><div align="center"><?php echo ++$sNo; ?></div></td>
                            <td ><div style="width:120px;"><?php echo $resListing1['name']; ?></div></td>
							<td ><?php if($editstyle['sampleStyle']=='1'){ echo "Bulk"; }else{ echo "Sample"; } ?></td>
                            <td >&nbsp;</td>
                            <td>-</td>
							 <td align="center"><?php
					$rs11=GetPageRecord('name','colorCardMaster','id="'.$rsListData['color'].'"');
					$resListing11=mysqli_fetch_array($rs11);
					echo $resListing11['name'];?>
					</td>
							 <td><?php echo $rsListData['orderQty'];$finaltotalqty=$finaltotalqty+$rsListData['orderQty']; ?></td>
                            <td><?php echo $rsListData['uom']; ?></td>
                            <td><?php echo $rsListData['sellingRate']; ?>/1/<?php echo $rsListData['uom']; ?></td>
                            <td>&nbsp;</td>
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
                          <?php }   ?>
						  <div id="savesupplierpotaxdetail" style="display:none;"></div>
                          <tr style="border: 1px solid #ccc; font-size:15px;">
                            <td colspan="4"><div align="right"><strong>Total:</strong></div></td>
                            <td colspan="2" align="center"><strong><?php echo $finaltotalqty; ?></strong></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td style="text-align: center;">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td style="text-align: center;">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td style="text-align: center;">&nbsp;</td>
                            <td style="text-align: center;">&nbsp;</td>
                            <td>&nbsp;</td>
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
                            <td width="80%" style="border: 1px solid #ccc; vertical-align: top; padding:0px;"><table width="100%" cellpadding="5" cellspacing="0" class="spcial-class" style=" border-collapse: collapse;">
                                <tr>
                                  <td><strong>CGST in words:</strong> Nil only</td>
                                </tr>
                                <tr>
                                  <td><strong>SGST in words:</strong> Nil only</td>
                                </tr>
                                <tr>
                                  <td><strong>IGST in words:</strong> Fifty Seven Thousand Six Hundred Rupees Only.</td>
                                </tr>
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
                            <td><strong>Grand Total in words:</strong> Twelve Lakh Nine Thousand Six Hundred Rupees Only</td>
                            <td align="right"><strong>Grand Total: 1,209,600,00</strong></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </tbody>
                </table>
              </div>
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
<style>
 .liststyleimg{float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}

	.badge.dropdown-toggle:after { display:none;
}
.purchase-class tr td{
border:1px solid #ccc;

}


 </style>
<script>
$( function(){
	$("#appdate").datepicker();
} );
</script>
