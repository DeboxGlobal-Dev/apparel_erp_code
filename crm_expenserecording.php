<style>
.apparelclass tr td{
border-top:0px solid #ccc !important;
border:1px solid #ccc !important;
vertical-align:middle !important;
padding:10px!important;
}
.erptab tr td{
border-top:0px solid #ccc !important;
border:1px solid #ccc !important;
vertical-align:middle !important;
padding:5px!important;
}
.erptab1 tr td{
border-top:0px solid #ccc !important;
padding:0.85rem!important;
}
.erptab1{
border:1px solid #ccc !important;
}

.erpint{
    border: 1px solid #b3acac;
    padding: 3px;
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
              <br>
               <div style="width: 99%;margin: auto;">
               <!--<div style="height:383px;overflow-y:scroll">-->
               <table class="table" width="100%">

                     <tr style="background:#0288d1;">
                         <td colspan="12"><div style="text-transform:capitalize;color:white;font-size: 15px;">Indirect Expense Invoicing
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-share-square-o"></i> Exit</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-window-close"></i> Delete</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-check-square-o"></i> Confirm & New</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-check-square-o"></i> Confirm</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-download"></i> Save</button>
                         </div>
                         </td>
                     </tr>
                     </table>
                     <div style="border: 1px solid #ccc;display:grid;grid-template-columns:auto auto;padding: 10px;grid-gap: 10px;">
                <table class="table erptab1" width="100%">

                     <tr style="background:#0288d1;">
                         <td colspan="6" style="padding: 0.5em!important"><div style="text-transform:capitalize;color:white;font-size: 15px;">Invoice Details</div></td>
                     </tr>

							<tr>
							<td><div align="center">Supplier</div></td>
							<td> <div align="center"><select style="width:100%" name="" id="" class="erpint"><option value="Netwell Apparel">Netwell Apparel</option></select></div></td>
							<td> <div align="center">Invoice Date</div></td>
							<td> <div align="center"><input style="width:100%" name="" type="date" id="" class="erpint"></div></td>
							<td><div align="center">Invoicing Currency</div></td>
							<td> <div align="center"><select style="width:100%"  name="" id="" class="erpint"><option value="">USD</option></select></div></td>
							</tr>

							<tr>
							<td><div align="center">Basis</div></td>
							<td> <div align="center"><select style="width:100%"  name="" id="" class="erpint"><option value="">Service PO</option></select></div></td>
							<td> <div align="center">Reference</div></td>
							<td> <div align="center"><i class="fa fa-angle-double-right"></i></div></td>
							<td><div align="center">Due Date</div></td>
							<td> <div align="center"><input style="width:100%"  name="" type="date" id="" class="erpint"></div></td>
							</tr>
							</table>



						 <table class="table erptab1" width="100%">

						<tr style="background: #0288d1;">
                         <td colspan="2" style="padding: 0.5em!important"><div style="text-transform:capitalize;color:white;font-size: 15px;">Invoice Details</div></td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:capitalize;"><b>Base Invoice Value</b></div></td>
                         <td><div style="text-transform:capitalize;">12500.00 USD</div></td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:capitalize;"><b>Add/Less - Additional Charges</b></div></td>
                         <td><div style="text-transform:capitalize;">30.00 USD</div></td>
                     </tr>
                      <tr>
                         <td><div style="text-transform:capitalize;"><b>Net Invoice Value</b></div></td>
                         <td><div style="text-transform:capitalize;">12530.00 USD</div></td>
                     </tr>
               </table>
               <table class="table table-hover no-footer apparelclass" style="grid-column:1/3" width="100%">

                     <tr style="background:#0288d1;">
                         <td colspan="7" style="padding: 0.5em!important"><div style="text-transform:capitalize;color:white;font-size: 15px;">additional charges
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-trash"></i> Delete</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-plus-circle"></i> Add</button>
                         </div>
                         </td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Additional charges</div></td>
					  <td align="center"><div style="text-transform:capitalize;">basis</div></td>
					  <td align="center"><div style="text-transform:capitalize;">value</div></td>
					  <td align="center"><div style="text-transform:capitalize;">amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">cost cenre</div></td>
					  <td align="center"><div style="text-transform:capitalize;">buyer order profitability</div></td>
                    </tr>

							<tr>
							<td> <div align="center"><input type="checkbox" id="" name="orderlist"></div></td>
							<td> <div align="center"><input name="" type="text" id="" class="erpint" value="Bank Charges"></div></td>
							<td> <div align="center"><select name="" id="" class="erpint"><option value="">Amount</option></select></div></td>
							<td> <div align="center"><input name="" type="text" id="" class="erpint" value="30.0"></div></td>
							<td> <div align="center"><input name="" type="text" id="" class="erpint" value="30.00"></div></td>
							<td> <div align="center"><i class="fa fa-angle-double-right"></i></div></td>
							<td> <div align="center"><i class="fa fa-angle-double-right"></i></div></td>

							</tr>

								<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #eefafd; margin-top: 0; position: relative;">

					  <td colspan="4" align="center"><div style="text-transform:capitalize;">Total</div></td>
				      <td align="center"><div style="text-transform:capitalize;">30.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
                    </tr>
							</table>
               </div>
                     </div>
                     <br>
			      <table class="table table-hover no-footer apparelclass" style="width: 99%;margin: auto;">

                     <tr style="background: #0288d1;">
                         <td colspan="11" style="padding: 0.5em!important"><div style="text-transform:capitalize;color:white;font-size: 15px;">PO - Invoice details
                        <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-trash"></i> Delete</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-plus-circle"></i> Add</button>
                         </div>
                         </td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">PO no.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">article item</div></td>
					  <td align="center"><div style="text-transform:capitalize;">expense ledger</div></td>
					  <td align="center"><div style="text-transform:capitalize;">UOM</div></td>
					  <td align="center"><div style="text-transform:capitalize;">PO Qty.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Inv Quantity</div></td>
					  <td align="center"><div style="text-transform:capitalize;">PO Rate</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Inv Amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Pending PO Qty</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Pending PO Amount</div></td>
                    </tr>

							<tr>
							 <td> <div align="center"><input type="checkbox" id="" name="orderlist"></div></td>
							<td><div align="center">PO1287</div></td>
							<td><div align="center">Consumables (Color)</div></td>
							<td><div align="center"><input name="" type="text" id="" class="erpint" value="008-Color Exp"></div></td>
							<td><div align="center">PCS</div></td>
							<td><div align="center">20</div></td>
							<td><div align="center"><input name="" type="text" id="" class="erpint" value="10.00"></div></td>
							<td><div align="center">56</div></td>
							<td><div align="center"><input name="" type="text" id="" class="erpint" value="560.00"></div></td>
							<td><div align="center">10.00</div></td>
							<td><div align="center">560.00</div></td>
							</tr>
							<tr>
							 <td> <div align="center"><input type="checkbox" id="" name="orderlist"></div></td>
							<td><div align="center">PO1235</div></td>
							<td><div align="center">Consumables (Color)</div></td>
							<td><div align="center"><input name="" type="text" id="" class="erpint" value="008-Color Exp"></div></td>
							<td><div align="center">PCS</div></td>
							<td><div align="center">20</div></td>
							<td><div align="center"><input name="" type="text" id="" class="erpint" value="40.00"></div></td>
							<td><div align="center">40</div></td>
							<td><div align="center"><input name="" type="text" id="" class="erpint" value="240.00"></div></td>
							<td><div align="center">10.00</div></td>
							<td><div align="center">240.00</div></td>
							</tr>
							<tr>
							 <td> <div align="center"><input type="checkbox" id="" name="orderlist"></div></td>
							<td><div align="center">PO1785</div></td>
							<td><div align="center">Consumables (Acid)</div></td>
							<td><div align="center"><input name="" type="text" id="" class="erpint" value="008-Acid Exp"></div></td>
							<td><div align="center">PCS</div></td>
							<td><div align="center">10</div></td>
							<td><div align="center"><input name="" type="text" id="" class="erpint" value="15.00"></div></td>
							<td><div align="center">100</div></td>
							<td><div align="center"><input name="" type="text" id="" class="erpint" value="1500.00"></div></td>
							<td><div align="center">12.00</div></td>
							<td><div align="center">1500.00</div></td>
							</tr>


					 </table>
					 <!--</div>-->

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