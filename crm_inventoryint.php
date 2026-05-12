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


               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="3"><div style="text-transform:capitalize;color:white;font-size: 15px;">Transaction Mapping With General Ledger</div>
                         </td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;">ERP Transaction Type</div></td>
                      <td align="center"><div style="text-transform:capitalize;">FA - Debit Ledger</div></td>
					  <td align="center"><div style="text-transform:capitalize;">FA - Credit Ledger</div></td>
                    </tr>
<tr>
<td><div>ASN From Supplier Imported</div></td>
<td><div>Inventory</div></td>
<td><div>33521</div></td>
<tr>
</tr>
<td><div>Production Process Order Output Own Factory </div></td>
<td><div>Inventory</div></td>
 <td><div>Raw Material Costs,33551</div> </td>
<tr>
</tr>
<td><div>Production Process Order Output Other Factory</div></td>
 <td><div>Inventory</div></td>
 <td><div>Other Receivables,33551</div></td>

<tr>
    </tr>
<td><div>Production Process Order Output Outsourced</div></td>
 <td><div>Inventory</div></td>
 <td><div>Other Receivables,33551</div></td>
<tr>
    </tr>
<td><div> Process Order Output</div></td>
 <td><div>Inventory</div> </td>
<td><div>Other Receivables,33541</div></td>
<tr>
    </tr>
<td><div>Process Order Input Returns</div> </td>
<td><div>Inventory </div></td>
<td><div>Other Receivables</div></td>
<tr>
    </tr>
<td><div> Production Process Order Input Returns Own Factory</div></td>
 <td><div>Inventory</div></td>
 <td><div>Raw Material Costs</div></td>
<tr>
    </tr>
<td><div>Production Process Order Input Returns Other Factory</div></td>
 <td><div>Inventory</div></td>
 <td><div>Other Receivables</div></td>
<tr>
    </tr>
<td><div>Production Process Order Input Returns Outsourced </div></td>
<td><div>Inventory </div></td>
<td><div>Other Receivables</div></td>
<tr>
</tr>
<td><div>Transfer From Site</div></td>
<td><div>Inventory</div></td>
 <td><div>1511</div></td>
</tr>
<tr>
<td><div>Returnable - Transfer Out Of System</div></td>
<td><div>1591 </div></td>
<td><div>Inventory</div></td>
</tr>
<tr>
<td><div> Returnable - Transfer Out Of System Fixed Asset </div></td>
<td><div>62721 </div></td>
<td><div>Inventory</div></td>
</tr>
<tr>
 <td><div>Production Process Order Input Own Factory</div></td>
<td><div>Raw Material Costs</div></td>
<td><div> Inventory</div></td>
 </tr>
 <tr>
<td><div>Production Process Order Input Other Factory</div></td>
<td><div>Other Receivables</div></td>
<td><div> Inventory</div></td>
 </tr>
<tr>
<td><div>Production Process Order Input Outsourced </div></td>
<td><div>Other Receivables </div></td>
<td><div>Inventory</div></td>
</tr>
<tr>
<td><div> Process Order Input</div></td>
 <td><div>Other Receivables </div></td>
<td><div>Inventory</div></td>
</tr>
<tr>
 <td><div>Transfer to Site </div></td>
<td><div>1511</div></td>
 <td><div>Inventory</div></td>
</tr>
<tr>
 <td><div>Direct Sales Dispatch</div></td>
 <td><div>COST OF GOODS SOLD - MERCHANDISE</div></td>
 <td><div>Inventory</div></td>
</tr>
<tr>
 <td><div> Buyer Order Dispatch</div></td>
 <td><div>COST OF GOODS SOLD PRODUCTS </div></td>
 <td><div>Inventory</div></td>
</tr>
<tr>
 <td><div>Purchase Order Returns Local </div></td>
 <td><div>33511 </div></td>
 <td><div>Inventory</div></td>
</tr>
<tr>
 <td><div>Purchase Order Returns Imported</div></td>
 <td><div>33521 </div></td>
 <td><div>Inventory</div></td>
</tr>
<tr>
  <td><div>Process Order Output Returns</div></td>
  <td><div>Other Receivables,33541 </div></td>
 <td><div>Inventory</div></td>
</tr>
<tr>
  <td><div>Transfer out of System</div></td>
 <td><div>PROV FOR OBSOLETE STOCK </div></td>
 <td><div>Inventory</div></td>
</tr>
<tr>
  <td><div>Transfer out of System Fixed Asset</div></td>
 <td><div>62721</div></td>
  <td><div>Inventory</div></td>
 </tr>
<tr>
 <td><div>PO Revision Local</div></td>
  <td><div>Inventory </div></td>
 <td><div>33511 </div></td>
</tr>
<tr>
 <td><div>PO Revision Imported</div></td>
  <td><div>Inventory </div></td>
 <td><div>33521 </div></td>
</tr>
<tr>
 <td><div>FPPO Revision v
 <td><div>Inventory</div></td>
 <td><div> 33551</div></td>
 </tr>
<tr>
 <td><div>PRPO Revision </div></td>
 <td><div>Inventory </div></td>
 <td><div>33541</div></td>
<tr>
  <td><div>StockCorrection New</div></td>
 <td><div>Inventory</div></td>
  <td><div>4121</div></td>
 </tr>
<tr>
  <td><div>StockCorrection Edit</div></td>
  <td><div>Inventory</div></td>
  <td><div>4121 </div></td>
 </tr>
<tr>
 <td><div>StockCorrection Scrap</div></td>
  <td><div>Inventory </div></td>
 <td><div>4121 </div></td>
</tr>
<tr>
 <td><div>StockCorrection UnScrap </div></td>
 <td><div>Inventory </div></td>
 <td><div>4121 </div></td>
</tr>
<tr>
 <td><div>StockCorrection EquivalentArticle</div></td>
 <td><div>Inventory </div></td>
 <td><div>4121 </div></td>
</tr>
<tr>
 <td><div>StockCorrection Revaluation</div></td>
  <td><div>Inventory</div></td>
  <td><div>4121</div></td>
 </tr>
<tr>
 <td><div>Landed Cost Local</div></td>
 <td><div>Inventory </div></td>
 <td><div>33511 </div></td>
</tr>
<tr>
 <td><div>Landed Cost Imported </div></td>
 <td><div>Inventory </div></td>
 <td><div>33521</div></td>
</tr>
<tr>
 <td><div>Landed Cost PRPO</div></td>
 <td><div>Inventory</div></td>
  <td><div>33541 </div></td>
</tr>
</table>
<br>
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="8"><div style="text-transform:capitalize;color:white;font-size: 15px;">inventory Transaction
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-plus-circle"></i> Add</button>
                         </div>
                         </td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;">Transaction Date</div></td>
                      <td align="center"><div style="text-transform:capitalize;">Journal Type</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Currency</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Stock Value</div></td>
					  <td align="center"><divstyle="text-transform:capitalize;">Status</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Pending for Validate</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Mapping Validated</div></td>
					  <td align="center"><div style="text-transform:capitalize;">View Unposted Voucher</div></td>
                    </tr>

							<tr>
							<td> <div align="center">14 June 2016</div></td>
							<td> <div align="center">Transfer from Site</div></td>
							<td> <div align="center">INR</div></td>
							<td> <div align="center">25000.00</div></td>
							<td> <div align="center">Pending</div></td>
							<td> <div align="center"><i class="fa fa-angle-double-right"></i></div></td>
							<td> <div align="center"><i class="fa fa-angle-double-right"></i></div></td>
							<td> <div align="center"><i class="fa fa-angle-double-right"></i></div></td>
							</tr>
							<tr>
							<td> <div align="center">14 June 2016</div></td>
							<td> <div align="center">Stock Correction New</div></td>
							<td> <div align="center">INR</div></td>
							<td> <div align="center">36000.00</div></td>
							<td> <div align="center">Pending</div></td>
							<td> <div align="center"><i class="fa fa-angle-double-right"></i></div></td>
							<td> <div align="center"><i class="fa fa-angle-double-right"></i></div></td>
							<td> <div align="center"><i class="fa fa-angle-double-right"></i></div></td>
							</tr>
							<tr>
							<td> <div align="center">14 June 2016</div></td>
							<td> <div align="center">XYZ Supplier</div></td>
							<td> <div align="center">INR</div></td>
							<td> <div align="center">Process Order Output</div></td>
							<td> <div align="center">Pending</div></td>
							<td> <div align="center"><i class="fa fa-angle-double-right"></i></div></td>
							<td> <div align="center"><i class="fa fa-angle-double-right"></i></div></td>
							<td> <div align="center"><i class="fa fa-angle-double-right"></i></div></td>
							</tr>

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