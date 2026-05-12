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
                         <td colspan="14"><div style="text-transform:capitalize;color:white;font-size: 15px;">Pending Supplier Invoice
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-check-circle"></i> Confirm</button>
                         </div>
                         </td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Status</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Supplier</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Buyer</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Invoice No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Invoice Name</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Currency</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Gross Shipment</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Net Shipment</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Invoice Amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Variable Amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Raise DN</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Discounting</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Exchange Rate</div></td>
                    </tr>

							<tr>
							 <td> <div align="center"><input type="checkbox" id="" name="pendinginvoice"></div></td>
							<td><div align="center">Saved</div></td>
							<td> <div align="center">XYZ </div></td>
							<td> <div align="center">ABC</div></td>
							<td> <div align="center">DBG5214NI</div></td>
							<td> <div align="center">5 Oct 2016</div></td>
							<td> <div align="center">USD</div></td>
							<td> <div align="center">1500.00</div></td>
							<td> <div align="center">1500.00</div></td>
							<td> <div align="center">1500.00</div></td>
							<td> <div align="center">0.00</div></td>
							<td> <div align="center"><input type="checkbox" id="" name="raisedn"></div></td>
							<td> <div align="center">
							    <select name="discount" id="">
							    <option value="Yes">Yes</option>
							    <option value="No">No</option>
							    </select>
							    </div></td>
							<td> <div align="center"></div></td>
							</tr>


					 </table>
					 <!--</div>-->
					<br>
					 <!--<div style="height:383px;overflow-y:scroll">-->
				<table class="table table-hover no-footer apparelclass" width="100%">
					 <tr style="background: #0288d1;">
                         <td colspan="17"><div style="text-transform:capitalize;color:white;font-size: 15px;">Supplier invoices
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-file-text"></i> Log</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-trash"></i> Cancel</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-download"></i> Save</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-file"></i> New</button>
                         </div>
                         </td>
                     </tr>

					<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Status</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Supplier</div></td>
					  <td align="center"><div style="text-transform:capitalize;">HK Inventive</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Invoice No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Invoice Date</div></td>
					  <td align="center"><div style="text-transform:capitalize;">GL Date</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Net Value</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Currency</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Exchange</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Net Value</div></td>
					  <td align="center"><div style="text-transform:capitalize;">PO No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Style</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Invoice</div></td>
					  <td align="center"><div style="text-transform:capitalize;">PO Type</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Purchase</div></td>
					  <td align="center"><div style="text-transform:capitalize;">ASN/GRN No.</div></td>
                    </tr>

							<tr>
							    <td> <div align="center"><input type="checkbox" id="" name="supplierinvoice"></div></td>
							<td><div align="center">Confirmed</div></td>
							<td> <div align="center">XYZ </div></td>
							<td> <div align="center"></div></td>
							<td> <div align="center">DBG437TI77</div></td>
							<td> <div align="center">14 June 2016</div></td>
							<td> <div align="center">21 Feb 2016</div></td>
							<td> <div align="center">14523.00</div></td>
							<td> <div align="center">USD</div></td>
							<td> <div align="center">1.000</div></td>
							<td> <div align="center">14523.00</div></td>
							<td> <div align="center">201545F</div></td>
							<td> <div align="center">212458RT</div></td>
							<td> <div align="center"></div></td>
							<td> <div align="center">GMPO</div></td>
							<td> <div align="center">
							    <select name="purchase" id="">
							    <option value="Local">Local</option>
							    <!--<option value=""></option>-->
							    </select>
							</div></td>
							<td> <div align="center">DBG437TI77</div></td>
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
</style>