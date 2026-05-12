<?php
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

$styleId=decode($_GET['styleid']);

$lastId=$editresultstyle['id'];

$rsqty=GetPageRecord('indentNumber','buyerPurchaseOrderMaster','styleId="'.$styleId.'"');
$resultqty=mysqli_fetch_array($rsqty);

$rspersent=GetPageRecord('profit','costsheetVersionMaster','styleId="'.$styleId.'" and versionId=1');
$rspersentlist=mysqli_fetch_array($rspersent);

}


?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<style>



.form-control {

     padding: 4px;

}



.toggle.btn {

    min-width: 59px;

    min-height: 34px;

    width: auto !important;

    height: auto !important;

    margin: 0px !important;

}





.listc .table thead th {

    vertical-align: middle;

    border-bottom: 1px solid #b7b7b7;

    padding: 9px;

}

.listc .table-bordered td, .table-bordered th {

    border: 1px solid #ddd;

    padding: 8px;

}

.icon-calendar3{

	position: absolute;

    top: 18px;

    right: 0px;

}

</style>
<div class="page-content">
  <div class="content-wrapper">
    <div class="content pt-0" style="margin-top:20px;">
      <?php include "top-style.php"; ?>
      <div class="col-xl-12" style="padding:0px;">
        <div class="card">
          <div class="card-body navbar-green"  style="padding:7px !important;" >
            <div class="media">
              <div class="col-xl-12">
                <h6 class="media-title font-weight-semibold"  style="    margin-top: 8px;"><?php echo $pageName; ?></h6>
              </div>
            </div>
          </div>
          <div class="card-body">
		  <table cellspacing="0" cellpadding="10" border="1"  class="table table-responsive">
  <tr height="20" style="background:#fbffbd; font-weight:700;">
    <td colspan="5" height="20" width="301">Initial</td>
    <td width="79"></td>
    <td colspan="5" width="320">Budgeted</td>
    <td width="62"></td>
    <td colspan="5" width="337">Actual</td>
	<td width="62"></td>
  </tr>
  <tr height="20">
    <td colspan="5" height="20">F.O.B. (USD)</td>
    <td><input type="text" name="fob" /></td>
    <td colspan="5">F.O.B.    (USD) </td>
    <td><input type="text" name="fob" /></td>
    <td colspan="5">Rate    (USD) </td>
	 <td><input type="text" name="fob" /></td>
  </tr>
  <tr height="20">
    <td colspan="5" height="20">Brand Commission % 5.00</td>
     <td><input type="text" name="fob" /></td>
    <td colspan="5">Brand    Comm.%  </td>
     <td><input type="text" name="fob" /></td>
    <td colspan="5">Brand    Comm.% </td>
	 <td><input type="text" name="fob" /></td>
  </tr>
  <tr height="20">
    <td colspan="5" height="20">Finance/Overhead/Discount% 20</td>
     <td><input type="text" name="fob" /></td>
    <td colspan="5">Fin/Ovh/Disc% </td>
     <td><input type="text" name="fob" /></td>
    <td colspan="5">Fin/Ovh/Disc% </td>
	 <td><input type="text" name="fob" /></td>
  </tr>
  <tr height="20">
    <td colspan="5" height="20">Exchange Rate  </td>
     <td><input type="text" name="fob" /></td>
    <td colspan="5">XR  </td>
     <td><input type="text" name="fob" /></td>
    <td colspan="5">XR  </td>
	 <td><input type="text" name="fob" /></td>
  </tr>
  <tr height="20">
    <td colspan="5" height="20">Total Dollar Value  </td>
     <td><input type="text" name="fob" /></td>
    <td colspan="5">Total Dollar    Value   </td>
     <td><input type="text" name="fob" /></td>
    <td colspan="5">Total Dollar    Value  </td>
	 <td><input type="text" name="fob" /></td>
  </tr>
  <tr height="20">
    <td colspan="5" height="20">Total INR Value  </td>
     <td><input type="text" name="fob" /></td>
    <td colspan="5">Total INR    Value </td>
     <td><input type="text" name="fob" /></td>
    <td colspan="5">Total INR    Value  </td>
	 <td><input type="text" name="fob" /></td>
  </tr>
</table>


		  <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
              <div class="card-body">
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Indent No</label>
                        <input type="text" name="indentNumber" id="indentNumber" class="form-control readonly" value="<?php echo $resultqty['indentNumber']; ?>"  />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Shipped Quantity</label>
                        <input type="text" name="shippedQty" id="shippedQty" class="form-control readonly" value="<?php echo $editresultstyle['costingQty']; ?>" />
                      </div>
                    </div>
					<div class="col-md-4">
                      <div class="form-group">
                        <label>Pre Order Margin %</label>
                         <input type="text" name="preOrderMargin" id="preOrderMargin" class="form-control readonly" value="<?php echo $rspersentlist['profit']; ?>" />
                      </div>
                    </div>


                  </div>

                  <div class="row" style="margin-top:10px;">
				  <div class="col-md-4">
                      <div class="form-group">
                        <label>Budgeted Margin %</label>
                      <input type="text" name="budgetMargin" id="budgetMargin" class="form-control " value="" />
                      </div>
                    </div>

				  <div class="col-md-4">
                      <div class="form-group">
                        <label>Post Order Margin %</label>
                       <input type="text" name="allocationDate" id="allocationDate" class="form-control " value="" />
                      </div>
                    </div>


				  </div>


                </div>
                <input type="hidden" name="editId" value="<?php echo encode($lastId); ?>">
                <input type="hidden" name="action" value="greigeallocation">
                <input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">
                <div class="text-right" style="display:none;">
                  <button type="submit" style="margin:0px;" class="btn btn-primary">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>
                  <label> </label>
                </div>
              </div>
            </form>

            <div class="table-responsive">
				<div id="add_indentmpl">
					    <table width="100%" class="table table-bordered table-responsive forbom" id="tableid11" style="display:block;">
                          <tbody style="width: 100%; display: inline-table;">
                            <?php
							$sNo1=0;
							$rowno=0;
							$rstype=GetPageRecord('*','materialTypeMaster','1 order by id asc');
							while($resListingtype=mysqli_fetch_array($rstype)){
							?>
							<tr class="card-body">
								<td width="100%" align="left" colspan="20" style="background-color: #e5fbfa;text-transform: uppercase;font-size: 14px;"><strong><?php echo $resListingtype['name']; ?></strong></td>
							</tr>
							<tr class="card-body" style="background-color: #fff7b3;;">
							  <td width="25%" align="center"><strong>Item&nbsp;Description</strong></td>
                              <td width="25%" align="center"><strong>Pre&nbsp;Order</strong></td>
							  <td width="25%" align="center"><strong>Budget</strong></td>
							  <td width="25%" align="center"><strong>Post&nbsp;Order</strong></td>
                            </tr>
							<tr class="card-body">
							  <td width="25%" align="center"></td>
                              <td width="25%" align="center" style="padding: 0px; border:0px solid !important;">
								  <table width="100%">
									  <tbody>
									  <tr>
										  <td><div style=" width:50px; text-align:center;"><strong>Qty.</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>Rate</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>Amount</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>%</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>Remark</strong></div></td>
										</tr>
									</tbody>
							    </table>
						      </td>
							  <td width="25%" align="center" style="padding: 0px; border:0px solid !important;">
								  <table width="100%">
									  <tbody>
									  <tr>
										  <td><div style=" width:50px; text-align:center;"><strong>Qty.</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>Rate</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>Amount</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>%</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>Remark</strong></div></td>
										</tr>
									</tbody>
							    </table>
						      </td>
							  <td width="25%" align="center" style="padding: 0px; border:0px solid !important;">
								  <table width="100%">
									  <tbody>
									  <tr>
										  <td><div style=" width:50px; text-align:center;"><strong>Qty.</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>Rate</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>Amount</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>%</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>Remark</strong></div></td>
										</tr>
									</tbody>
							    </table>
						      </td>
                            </tr>
							<?php
							$whereb='1 and materialType="'.$resListingtype['id'].'" and styleId="'.$styleId.'" and costsheetVersionId="1" order by sr asc';
							$rsb=GetPageRecord('*','styleSubCategoryMaster',$whereb);
							while($resListing1=mysqli_fetch_array($rsb)){

$rs121=GetPageRecord('*','techPackDetailMaster','sectionType="bom" and styleId="'.$styleId.'" and costsheetVersionId="1" and stylesubtabid="'.$resListing1['id'].'"');
$resListing12=mysqli_fetch_array($rs121);


							?>
							<tr class="card-body">
							  <td width="25%" align="center"><span style="font-weight:500;"><?php echo $resListing1['name']; ?></span></td>
                              <td width="25%" align="center" style="padding: 0px; border:0px solid !important;">
								  <table width="100%">
									  <tbody>
									  <tr>
										  <td><div style=" width:50px; text-align:center;"><?php
											$totalallowance=0;
											$totalallow = 0;
											$orderQty=$editresultstyle['costingQty'];
											$wh='1 and qty>'.$orderQty.'';
											$rspross=GetPageRecord('*','rejectioninproductionmaster',$wh);
											$resultpross=mysqli_fetch_array($rspross);
											$totalallowance = $resultpross['totalallwance'];
											$orderQty = round($orderQty+(($orderQty*$totalallowance)/100));
											echo $orderQty*$resListing12['avgIncWastage'];
										  ?></div></td>
										  <td><div style=" width:50px; text-align:center;"><?php echo $resListing12['bomRate']; ?></div></td>
										  <td><div style=" width:50px; text-align:center;"><?php echo $amount =  $orderQty*$resListing12['bomRate']; ?></div></td>
										  <td><div style=" width:50px; text-align:center;"><?php echo $amount/100; ?></div></td>
										  <td><div style=" width:50px; text-align:center;"><input type="text" name="preRemark" style="width: 100%;" /></div></td>
										</tr>
									</tbody>
							    </table>
						      </td>
							  <td width="25%" align="center" style="padding: 0px; border:0px solid !important;">
								  <table width="100%">
									  <tbody>
									  <tr>
										  <td><div style=" width:50px; text-align:center;"><?php
											$totalallowance=0;
											$totalallow = 0;
											$orderQty=$editresultstyle['costingQty'];
											$wh='1 and qty>'.$orderQty.'';
											$rspross=GetPageRecord('*','rejectioninproductionmaster',$wh);
											$resultpross=mysqli_fetch_array($rspross);
											$totalallowance = $resultpross['totalallwance'];
											$orderQty = round($orderQty+(($orderQty*$totalallowance)/100));
											echo $orderQty*$resListing12['avgIncWastage'];
										  ?></div></td>
										  <td><div style=" width:50px; text-align:center;"><?php echo $resListing12['bomRate']; ?></div></td>
										  <td><div style=" width:50px; text-align:center;"><?php echo $budamount =  $orderQty*$resListing12['bomRate']; ?></div></td>
										  <td><div style=" width:50px; text-align:center;"><?php echo $budamount/100; ?></div></td>
										  <td><div style=" width:50px; text-align:center;"><input type="text" name="budRemark" style="width: 100%;" /></div></td>
										</tr>
									</tbody>
							    </table>
						      </td>
							  <td width="25%" align="center" style="padding: 0px; border:0px solid !important;">
								  <table width="100%">
									  <tbody>
									  <tr>
										  <td><div style=" width:50px; text-align:center;"><?php echo $orderQty*$resListing12['avgIncWastage']; ?></div></td>
										  <td><div style=" width:50px; text-align:center;"><?php echo $resListing12['bomRate']; ?></div></td>
										  <td><div style=" width:50px; text-align:center;"><?php echo $budamount =  $orderQty*$resListing12['bomRate']; ?></div></td>
										  <td><div style=" width:50px; text-align:center;"><?php echo $budamount/100; ?></div></td>
										  <td><div style=" width:50px; text-align:center;"><input type="text" name="preRemark" style="width: 100%;" /></div></td>
										</tr>
									</tbody>
							    </table>
						      </td>
                            </tr>
							<?php } } ?>

                          </tbody>
                        </table>
						<table width="100%" class="table table-bordered table-responsive forbom" id="tableid11" style="display:block;">
                          <tbody style="width: 100%; display: inline-table;">
                            <?php
							$sNo1adownlod=0;
							$select33a='id,name';
							$where33a='1 order by id asc';
							$rs33a=GetPageRecord($select33a,'chargesTypeMaster',$where33a);
							$countfortotalsecond=mysql_num_rows($rs33a);
							while($resListinga=mysqli_fetch_array($rs33a)){



							?>
							<tr class="card-body">
								<td width="100%" align="left" colspan="20" style="background-color: #e5fbfa;text-transform: uppercase;font-size: 14px;"><strong><?php echo $resListinga['name']; ?></strong></td>
							</tr>
							<tr class="card-body" style="background-color: #fff7b3;;">
							  <td width="25%" align="center"><strong>Item&nbsp;Description</strong></td>
                              <td width="25%" align="center"><strong>Pre&nbsp;Order</strong></td>
							  <td width="25%" align="center"><strong>Budget</strong></td>
							  <td width="25%" align="center"><strong>Post&nbsp;Order</strong></td>
                            </tr>
							<tr class="card-body">
							  <td width="25%" align="center"></td>
                              <td width="25%" align="center" style="padding: 0px; border:0px solid !important;">
								  <table width="100%">
									  <tbody>
									  <tr>
										  <td><div style=" width:50px; text-align:center;"><strong>Qty.</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>Rate</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>Amount</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>%</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>Remark</strong></div></td>
										</tr>
									</tbody>
							    </table>
						      </td>
							  <td width="25%" align="center" style="padding: 0px; border:0px solid !important;">
								  <table width="100%">
									  <tbody>
									  <tr>
										  <td><div style=" width:50px; text-align:center;"><strong>Qty.</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>Rate</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>Amount</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>%</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>Remark</strong></div></td>
										</tr>
									</tbody>
							    </table>
						      </td>
							  <td width="25%" align="center" style="padding: 0px; border:0px solid !important;">
								  <table width="100%">
									  <tbody>
									  <tr>
										  <td><div style=" width:50px; text-align:center;"><strong>Qty.</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>Rate</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>Amount</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>%</strong></div></td>
										  <td><div style=" width:50px; text-align:center;"><strong>Remark</strong></div></td>
										</tr>
									</tbody>
							    </table>
						      </td>
                            </tr>
							<?php
							$secondgrandtotoal = 0;
							$select22a='*';
							$where22a='chargestype="'.$resListinga['id'].'" order by id asc';
							$rs22a=GetPageRecord($select22a,'chargesMaster',$where22a);
							$srtypea = mysql_num_rows($rs22a);
							$sNoa=1;
							while($resListing1a=mysqli_fetch_array($rs22a)){
							$loopsta=$srtypea;
							$rownoa++;
							$sNo1adownlod=$rownoa;
							$rs121a=GetPageRecord('*','extraChargesDetailMaster',' bomSerialNoextra="'.$sNo1adownlod.'" and styleId="'.$styleId.'" and costsheetVersionId="'.$finalversion.'" order by id desc');
							$resListing12a=mysqli_fetch_array($rs121a);
							?>
							<tr class="card-body">
							  <td width="25%" align="center"><span style="font-weight:500;"><?php echo $resListing1a['name']; ?></span></td>
                              <td width="25%" align="center" style="padding: 0px; border:0px solid !important;">
								  <table width="100%">
									  <tbody>
									  <tr>
										  <td><div style=" width:50px; text-align:center;"><?php
											$totalallowance=0;
											$totalallow = 0;
											$orderQtych=$editresultstyle['costingQty'];
											$wh2='1 and qty>'.$orderQtych.'';
											$rspross2=GetPageRecord('*','rejectioninproductionmaster',$wh2);
											$resultpross2=mysqli_fetch_array($rspross2);
											$totalallowance2 = $resultpross2['totalallwance'];
											echo $orderQtych = round($orderQtych+(($orderQtych*$totalallowance2)/100));
											echo $orderQtych*$resListing12a['bomAvgextra'];
										  ?></div></td>
										  <td><div style=" width:50px; text-align:center;"><?php echo $resListing12a['matPriceextra']; ?></div></td>
										  <td><div style=" width:50px; text-align:center;"><?php echo $orderQtych*$resListing12a['bomAvgextra']; ?></div></td>
										  <td><div style=" width:50px; text-align:center;">-</div></td>
										  <td><div style=" width:50px; text-align:center;">-</div></td>
										</tr>
									</tbody>
							    </table>
						      </td>
							  <td width="25%" align="center" style="padding: 0px; border:0px solid !important;">
								  <table width="100%">
									  <tbody>
									  <tr>
										  <td><div style=" width:50px; text-align:center;"><?php echo $orderQtych; ?></div></td>
										  <td><div style=" width:50px; text-align:center;"><?php echo $resListing12a['matPriceextra']; ?></div></td>
										  <td><div style=" width:50px; text-align:center;"><?php echo $orderQtych*$resListing12a['bomAvgextra']; ?></div></td>
										  <td><div style=" width:50px; text-align:center;">-</div></td>
										  <td><div style=" width:50px; text-align:center;">-</div></td>
										</tr>
									</tbody>
							    </table>
						      </td>
							  <td width="25%" align="center" style="padding: 0px; border:0px solid !important;">
								  <table width="100%">
									  <tbody>
									  <tr>
										   <td><div style=" width:50px; text-align:center;"><?php echo $orderQtych; ?></div></td>
										  <td><div style=" width:50px; text-align:center;"><?php echo $resListing12a['bomRate']; ?></div></td>
										  <td><div style=" width:50px; text-align:center;"><?php echo $orderQtych*$resListing12a['bomAvg']; ?></div></td>
										  <td><div style=" width:50px; text-align:center;">-</div></td>
										  <td><div style=" width:50px; text-align:center;">-</div></td>
										</tr>
									</tbody>
							    </table>
						      </td>
                            </tr>
							<?php } } ?>

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
<style>

 .liststyleimg{float: left;

    width: 70px;

    margin-right: 15px;

    padding: 5px;

    border: 2px solid #e6e6e6;}



	.badge.dropdown-toggle:after { display:none;

}



.btn-float i {

    display: block;

    top: 0;

    font-size: 20px;

}



.card-group-control-right .card-body{width:100%;}



.table td, .table th {

    vertical-align: middle !important;

}



.form-control {

    display: block;

    width: 100%;

    font-size: .8125rem;

    line-height: 1.5385;

    color: #5d5d5d;

    background-color: #fff;

    background-clip: padding-box;

    border: 1px solid #d8d8d8;

    border-radius: 2px;

    box-shadow: 0 0 0 0 transparent;

    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;

}

.listc .table-bordered td, .table-bordered th {

    border: 1px solid #ddd !important;

    padding: 8px;

}





 </style>
