<style>
.apparelclass tr td{
border-top:0px solid #ccc !important;
border:1px solid #ccc !important;
vertical-align:middle !important;
padding:10px!important;
}
.erptab tr td{
border-top:0px solid #ccc !important;
padding:0.65rem!important;
}
.erptab{
border:1px solid #ccc !important;
}
.erpint{
    border: 1px solid #b3acac;
    padding: 3px;
}
.abc{
display: grid;
    grid-template-columns: 150px 150px 150px;
    grid-column-gap: 3px;
    cursor:pointer;
 }
  .abc div{
    font-weight: 500;
    padding: 7px;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    text-align: center;
    color: white;
    border: 1px solid #b3acac;
    font-size: 14px;
}
</style>
<div class="page-content">
<div class="content-wrapper">
  <div class="content pt-0" style="margin-top: 20px; width: 100%; margin-left: auto; margin-right: auto;">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
          <div class="col-xl-9">
            <h5 class="card-title">
                <?php echo $pageName; ?>
            </h5>
          </div>
          <div class="col-xl-3" style="padding-right: 0px;"> </div>
        </div>
        <div class="card border-left-3 border-left-danger-400 rounded-left-0" style="border: 1px solid #ccc !important;">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form name"search" method="GET" action="">
                  <input type="hidden"  name="module" value="<?php echo $_GET['module']; ?>"/>
                  <div class="row" style="padding:15px 0px;">
                    <div class="col-md-2">
                      <div class="">
                        <input name="fromDate" type="text" class="datepickercommon form-control" id="fromDate" value="<?php if($_GET['fromDate']!=''){ echo date('d-m-Y', strtotime($_GET['fromDate'])); } ?>" placeholder="From Date" readonly="">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="">
                        <input name="toDate" type="text" class="datepickercommon form-control" id="toDate" value="<?php if($_GET['toDate']!=''){ echo date('d-m-Y', strtotime($_GET['toDate'])); } ?>" placeholder="To Date" readonly="">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="">
                        <select class="form-control" name="companyid" id="companyid">
                          <option value="">Company</option>
                          <?php
								$rsk=GetPageRecord('*','companyMaster','1 order by name asc');
								while($comData=mysqli_fetch_array($rsk)){
								?>
                          <option value="<?php echo $comData['id']; ?>" <?php if($comData['id']==$_GET['companyid']){ ?> selected="selected" <?php } ?>><?php echo $comData['name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="">
                        <input name="search" type="submit" class="btn bg-teal-400" id="search" value="Search">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-md-12">
                <form name="listform" id="listform" method="get">
                  <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />

                  <table class="table" width="100%">

					 <tr style="background: #0288d1;">
                    <td colspan="4"><div style="text-transform:capitalize;color:white;font-size: 15px;">Supplier Debit Note</div></td>
                     </tr>

					<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;">Supplier</div></td>
                      <td align="center"><div style="text-transform:capitalize;"><input type="text" class="erpint" name="supplier" id=""></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Date</div></td>
                      <td align="center"><div style="text-transform:capitalize;"><input type="date" class="erpint" name="debitdate" id=""></div></td>
                    </tr>
                  </table>

                  <br>
               <table class="table erptab" width="100%">

                    <tr style="background: #0288d1;">
                         <td colspan="5"><div style="text-transform:capitalize;color:white;font-size: 15px;">Debit Note Info
                         </div>
                         </td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:capitalize;"><b>Debit Note Type</b></div></td>
                         <td>
                             <select style="width:75%;" class="erpint" name="debittype" id="">
                                 <option value="gmpo">Against GMPO</option>
                             </select>
                         </td>
                         <td><div style="text-transform:capitalize;"><b>Reason</b></div></td>
                         <td>
                             <select style="width:50%;" class="erpint" name="reason" id="">
                                 <option value="frightcharge">Fright Charges - Allocated</option>
                             </select>
                         </td>
                         <td style="width:25%"></td>
                     </tr>
                                          <tr>
                         <td><div style="text-transform:capitalize"><b>Debit Note No.</b></div></td>
                         <td><input style="width:75%;" type="text" class="erpint" name="debitnumber" id=""></td>
                         <td><div style="text-transform:capitalize;"><b>Total DN Amount</b></div></td>
                         <td>
                             <input style="width:10%;" class="erpint" name="dnamountpercent" id=""> % OR
                             <input style="width:21%;" class="erpint" name="dnamount" id="">
                             <select class="erpint" name="currency" id="">
                                 <option value="usd">USD</option>
                             </select>
                             Allocate
                         </td>
                         <td></td>
                     </tr>
                     <tr>

                         <td><div style="text-transform:capitalize"><b>Beneficiary Bank</b></div></td>
                         <td>
                              <select style="width:75%;" class="erpint" name="beneficiarybank" id="">
                                 <option value="">Select</option>
                             </select>
                        </td>
                        <td><div style="text-transform:capitalize;"><b>Payment Term</b></div></td>
                         <td>
                             <select style="width:50%;" class="erpint" name="paymentterm" id="">
                                 <option value="">Select</option>
                             </select>
                         </td>
                         <td></td>
                     </tr>
               </table>
               <br>
               <br>
               <div class="abc">
                     <div target="1" id="ha1" class="fisrt_branch">Order List</div>
                      <div target="2" id="ha2" class="fisrt_branch">Additional Charges</div>
                      <div target="3" id="ha3" class="fisrt_branch">Attachments</div>
               </div>
               <div class="targetDiv"  id="div1">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="13"><div style="text-transform:capitalize;color:white;font-size: 15px;">Order List
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-trash"></i> Delete</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-plus-circle"></i> Add</button>
                         </div>
                         </td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Order No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Style</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Quantity</div></td>
					  <td align="center"><divstyle="text-transform:capitalize;">UOM</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Gros Order Value</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Additional Charges</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Net Order Value</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Debit ote</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Credit Note</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Invoices</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Request Amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Reason</div></td>
                    </tr>

							<tr>
							 <td> <div align="center"><input type="checkbox" id="" name="orderlist"></div></td>
							<td><div align="center">12154</div></td>
							<td> <div align="center">New Arrivals</div></td>
							<td> <div align="center">20.00</div></td>
							<td> <div align="center">PCS</div></td>
							<td> <div align="center">380.00</div></td>
							<td> <div align="center">0.00</div></td>
							<td> <div align="center">380.00</div></td>
							<td> <div align="center">0.00</div></td>
							<td> <div align="center">0.00</div></td>
							<td> <div align="center">380.00</div></td>
							<td> <div align="center">60.00</div></td>
							<td> <div align="center">
							    <select class="erpint" name="orderreason" id="">
                                 <option value="">Freight Charges</option>
                             </select>
							</div></td>
							</tr>
							</tr>

					<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #eefafd; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
				      <td align="center"><div style="text-transform:capitalize;"></div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
					  <td align="center"><div style="text-transform:capitalize;">380.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
					  <td align="center"><div style="text-transform:capitalize;">380.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
					  <td align="center"><div style="text-transform:capitalize;">60.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
                    </tr>


					</tr>
					 </table>
					 <!--</div>-->
              </div>
              <div class="targetDiv"  id="div2">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="12"><div style="text-transform:capitalize;color:white;font-size: 15px;">Additional Charges
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-trash"></i> Delete</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-plus-circle"></i> Add</button>
                         </div>
                         </td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Order No.</div></td>
					  <td align="center" style="width: 14%;"><div style="text-transform:capitalize;">Delivery Status</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Order Value</div></td>
					  <td align="center"><divstyle="text-transform:capitalize;">Unpaid Advance Payment</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Unadjusted Advance</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Invoice + CN - DN</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Balance Payment</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Advance Amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">% Allocation</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Gross Profit Margin</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Comments</div></td>
                    </tr>

							<tr>
							 <td> <div align="center"><input type="checkbox" id="" name="orderlist"></div></td>
							<td><div align="center">12154</div></td>
							<td> <div align="center">21st November 2016</div></td>
							<td> <div align="center">1200.00</div></td>
							<td> <div align="center">0.00</div></td>
							<td> <div align="center">0.00</div></td>
							<td> <div align="center">0.00</div></td>
							<td> <div align="center">500.00</div></td>
							<td> <div align="center">700.00</div></td>
							<td> <div align="center">14.00</div></td>
							<td> <div align="center">20.598</div></td>
							<td> <div align="center"></div></td>
							</tr>
							</tr>

					<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #eefafd; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
					  <td align="center"><div style="text-transform:capitalize;">Total</div></td>
				      <td align="center"><div style="text-transform:capitalize;">1200.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;">0.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;">0.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;">0.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;">500.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;">700.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;">14.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;">20.598</div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
                    </tr>


					</tr>
					 </table>
					 <!--</div>-->
              </div>
              <div class="targetDiv"  id="div3">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="12"><div style="text-transform:capitalize;color:white;font-size: 15px;">Attachment
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-trash"></i> Delete</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-plus-circle"></i> Add</button>
                         </div>
                         </td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Order No.</div></td>
					  <td align="center" style="width: 14%;"><div style="text-transform:capitalize;">Delivery Status</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Order Value</div></td>
					  <td align="center"><divstyle="text-transform:capitalize;">Unpaid Advance Payment</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Unadjusted Advance</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Invoice + CN - DN</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Balance Payment</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Advance Amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">% Allocation</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Gross Profit Margin</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Comments</div></td>
                    </tr>

							<tr>
							 <td> <div align="center"><input type="checkbox" id="" name="orderlist"></div></td>
							<td><div align="center">12154</div></td>
							<td> <div align="center">21st November 2016</div></td>
							<td> <div align="center">1200.00</div></td>
							<td> <div align="center">0.00</div></td>
							<td> <div align="center">0.00</div></td>
							<td> <div align="center">0.00</div></td>
							<td> <div align="center">500.00</div></td>
							<td> <div align="center">700.00</div></td>
							<td> <div align="center">14.00</div></td>
							<td> <div align="center">20.598</div></td>
							<td> <div align="center"></div></td>
							</tr>
							</tr>

					<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #eefafd; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
					  <td align="center"><div style="text-transform:capitalize;">Total</div></td>
				      <td align="center"><div style="text-transform:capitalize;">1200.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;">0.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;">0.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;">0.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;">500.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;">700.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;">14.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;">20.598</div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
                    </tr>


					</tr>
					 </table>
					 <!--</div>-->
              </div>

					 <br>
					 <!--<div style="height:383px;overflow-y:scroll">-->
					 <table class="table table-hover no-footer apparelclass" width="100%">

					 <tr style="background: #0288d1;">
                         <td colspan="14" style="padding:10px"><div style="text-transform:capitalize;color:white;font-size: 15px;">Debit Notes
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-share-square-o"></i> Export</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-file-text"></i> Log</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-trash"></i> Cancel</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-external-link"></i> Revise</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-file"></i> New</button>
                         </div>
                         </td>
                     </tr>

					<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Status</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Supplier</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Debit Note Type</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Debit Note No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Amount Payable</div></td>
					  <td align="center"><div style="text-transform:capitalize;">GRN/GDN No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Invoice No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Invoice Date</div></td>
					  <td align="center"><div style="text-transform:capitalize;">GL Date</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Buyer Order Ref</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Order No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Style</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Remarks</div></td>
                    </tr>

							<tr>
							 <td> <div align="center"><input type="checkbox" id="" name="debitnotes"></div></td>
							<td><div align="center">Confirmed</div></td>
							<td> <div align="center">XYZ Supplier</div></td>
							<td> <div align="center">299</div></td>
							<td> <div align="center">Against GMPO</div></td>
							<td> <div align="center">50.00</div></td>
							<td> <div align="center"></div></td>
							<td> <div align="center"></div></td>
							<td> <div align="center"></div></td>
						    <td> <div align="center">12 Mar 2016</div></td>
							<td> <div align="center">223658</div></td>
							<td> <div align="center">21016</div></td>
							<td> <div align="center">Deluxe Star</div></td>
							<td> <div align="center"></div></td>
							</tr>


                  </table>
                  <!--<div>-->
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
$("#filtersearch").on("keyup", function() {
var value = $(this).val().toLowerCase();
$("#allhotellisting tr").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
});
</script>
<script>
 function isLedger(id,glId){

	if(glId=='0'){
		var conf = confirm('Are you sure you want to create General Ledger?');
		if(conf==true){
			window.location.href ='<?php echo $fullurl; ?>showpage.crm?module=headcreation&id='+id+'&glId=1';
		}
	}else{
		var conf = confirm('Are you sure you want to remove from General Ledger?');
		if(conf==true){
		window.location.href ='<?php echo $fullurl; ?>showpage.crm?module=headcreation&id='+id+'&glId=0';
		}
	}
 }


 function deleteHead(delId){
 	var conf = confirm('Are you sure you want delete?');
	if(conf==true){
		window.location.href ='<?php echo $fullurl; ?>showpage.crm?module=headcreation&delId='+delId;
	}
 }
 </script>
 <script>
jQuery(function() {
  jQuery('.fisrt_branch').click(function() {
    jQuery('.targetDiv').hide();
    jQuery('#div' + $(this).attr('target')).show();
    $('.fisrt_branch') .attr('style', 'background-color: white');
    $('.fisrt_branch') .attr('style', 'color: #4a4646');
    $('#ha' + $(this).attr('target')) .attr('style', 'background-color: #0288d1');
  });
});
</script>
<script>
$(document).ready(function(){
  $('#ha1').trigger('click');
});
</script>