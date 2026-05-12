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


               <table class="table erptab" width="100%">

                    <tr style="background: #0288d1;">
                         <td colspan="5"><div style="text-transform:capitalize;color:white;font-size: 15px;">Order List
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-step-backward"></i> Exit</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-check-circle"></i> Confirm & New</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-check-circle"></i> Confirm</button>
                         </div>
                         </td>
                     </tr>

                     <tr>
                         <td style="width:12%"><div style="text-transform:capitalize;"><b>Advance Type</b></div></td>
                         <td><input type="text" class="erpint" name="advance" id=""></td>
                         <td></td>
                         <td colspan="2" style="background: #eefafd;"><b>Account Summary (USD)</b></td>

                     </tr>
                                          <tr>
                         <td><div style="text-transform:"><b>Supplier</b></div></td>
                         <td><input type="text" class="erpint" name="supplier" id=""></td>
                         <td></td>
                         <td style="background: #eefafd;">Ledger Balance</td>
                         <td style="background: #eefafd;">-45000.75/-</td>

                     </tr>
                                          <tr>
                         <td><div style="text-transform:"><b>Advance Amount</b></div></td>
                         <td><input type="text" style="width:10%" class="erpint" name="advanceamountpercent" id=""> % or  <input type="text" class="erpint" name="advanceamount" id=""> Allocate</td>
                         <td></td>
                         <td style="background: #eefafd;">Unposted Invoices + CN - DN</td>
                         <td style="background: #eefafd;">20000.25/-</td>

                     </tr>
                     <tr>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td style="background: #eefafd;">Unpaid Advanced Request</td>
                         <td style="background: #eefafd;">32500.00/-</td>

                     </tr>
                       <tr>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td style="background: #eefafd;"><b>Net Balance</b></td>
                         <td style="background: #eefafd;"><b>7499.50/-</b></td>

                     </tr>


               </table>
               <br>
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="12"><div style="text-transform:capitalize;color:white;font-size: 15px;">Order List
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
					  <td align="center"><div style="text-transform:capitalize;">Unpaid Advance Payment</div></td>
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


					 </table>
					 <!--</div>-->
					 <br>
					 <!--<div style="height:383px;overflow-y:scroll">-->
					 <table class="table table-hover no-footer apparelclass" width="100%">

					 <tr style="background: #0288d1;">
                         <td colspan="12"><div style="text-transform:capitalize;color:white;font-size: 15px;">Advance Payment Requests
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-file-text"></i> Log</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-download"></i> Save</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-trash"></i> Cancel</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-trash"></i> Delete</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-share-square-o"></i> Reopen</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-window-close"></i> Close</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-external-link"></i> Revise</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-file"></i> New</button>
                         </div>
                         </td>
                     </tr>

					<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Status</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Supplier</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Advance request No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Advance Type</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Currency</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Style</div></td>
					  <td align="center"><div style="text-transform:capitalize;">OC NO.(Buyer order ref no.)</div></td>
					  <td align="center"><div style="text-transform:capitalize;">User Group</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Created By</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Created On</div></td>
                    </tr>

							<tr>
							 <td> <div align="center"><input type="checkbox" id="" name="paymentrequest"></div></td>
							<td><div align="center">Confirmed</div></td>
							<td> <div align="center">XYZ Supplier</div></td>
							<td> <div align="center">APR/GBX/25/999</div></td>
							<td> <div align="center">On Account</div></td>
							<td> <div align="center">15150.00</div></td>
							<td> <div align="center">USD</div></td>
							<td> <div align="center">RTY989876E</div></td>
							<td> <div align="center">2122,2981,5248,1196</div></td>
							<td> <div align="center">
							    <select>
							        <option value="">Select</option>
							    </select>
							</div></td>
							<td> <div align="center">ABC</div></td>
							<td> <div align="center">21 April 2016</div></td>
							</tr>
								<tr>
							 <td> <div align="center"><input type="checkbox" id="" name="paymentrequest"></div></td>
							<td><div align="center">Confirmed</div></td>
							<td> <div align="center">Test Supplier</div></td>
							<td> <div align="center">APR/GBX/25/548</div></td>
							<td> <div align="center">On Account</div></td>
							<td> <div align="center">29350.00</div></td>
							<td> <div align="center">USD</div></td>
							<td> <div align="center">PNY822876E</div></td>
							<td> <div align="center">2982,3248,1556</div></td>
							<td> <div align="center">
							    <select>
							        <option value="">Select</option>
							    </select>
							</div></td>
							<td> <div align="center">ABC</div></td>
							<td> <div align="center">21 Dec 2016</div></td>
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
<style>
.apparelclass tr td{
border-top:0px solid #ccc !important;
border:1px solid #ccc !important;
vertical-align:middle !important;
padding:10px!important;
}
.erptab tr td{
border-top:0px solid #ccc !important;
padding:0.5rem!important;
}
.erptab{
border:1px solid #ccc !important;
}
.erpint{
    border: 1px solid #b3acac;
    padding: 3px;
}
</style>