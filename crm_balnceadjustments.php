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
                         <td colspan="4"><div style="text-transform:capitalize;color:white;font-size: 15px;">Balance Adjustments
                         <button style="float:right;border: 0px;background: #0288d1;color:white"> Clear/Adjust</button>
                         </div>
                         </td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:capitalize;"><b>Advance Type</b></div></td>
                         <td><input style="width:45%" type="text" class="erpint" name="advance" id=""></td>
                         <td><div style="text-transform:"><b>GL Date</b></div></td>
                         <td><input style="width:45%" type="date" class="erpint" name="" id=""></td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:"><b>Supplier</b></div></td>
                         <td><select style="width:45%" name="" id="" class="erpint"><option value="">ABC Supplier</option></select></td>
                         <td><div style="text-transform:"><b>Advance Amount</b></div></td>
                         <td><select style="width:45%" name="" id="" class="erpint"><option value="">Party Adjustments</option></select></td>
                     </tr>



               </table>
               <br>
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="13"><div style="text-transform:capitalize;color:white;font-size: 15px;">credit documents</div></td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">doc type</div></td>
                      <td align="center"><div style="text-transform:capitalize;">doc no.</div></td>
                      <td align="center"><div style="text-transform:capitalize;">doc date</div></td>
                      <td align="center"><div style="text-transform:capitalize;">voucher no.</div></td>
                      <td align="center"><div style="text-transform:capitalize;">doc currency</div></td>
                      <td align="center"><div style="text-transform:capitalize;">doc amount</div></td>
                      <td align="center"><div style="text-transform:capitalize;">company currency</div></td>
                      <td align="center"><div style="text-transform:capitalize;">ex rt</div></td>
                      <td align="center"><div style="text-transform:capitalize;">doc amount in company currency</div></td>
                      <td align="center"><div style="text-transform:capitalize;">unadjusted amount in company currency</div></td>
                      <td align="center"><div style="text-transform:capitalize;">current adjustments</div></td>
                      <td align="center"><div style="text-transform:capitalize;">PO wise adjustments</div></td>

                    </tr>

							<tr>
							 <td> <div align="center"><input type="checkbox" id="" name="orderlist"></div></td>
							<td> <div align="center">Credit Note</div></td>
							<td> <div align="center">254622</div></td>
							<td> <div align="center">12/05/2016</div></td>
							<td> <div align="center">DB/21/487</div></td>
							<td> <div align="center">USD</div></td>
							<td> <div align="center">2500.00</div></td>
							<td> <div align="center">INR</div></td>
							<td> <div align="center">42.00</div></td>
							<td> <div align="center">105000.00</div></td>
							<td> <div align="center">85000.00</div></td>
							<td> <div align="center">20000.00</div></td>
							<td> <div align="center"><i class="fa fa-angle-double-right"></i></div></td>
							</tr>
							<tr>
							 <td> <div align="center"><input type="checkbox" id="" name="orderlist"></div></td>
							<td> <div align="center">Supplier Invoice</div></td>
							<td> <div align="center">254678</div></td>
							<td> <div align="center">26/03/2016</div></td>
							<td> <div align="center">DB/21/489</div></td>
							<td> <div align="center">USD</div></td>
							<td> <div align="center">2000.00</div></td>
							<td> <div align="center">INR</div></td>
							<td> <div align="center">40.00</div></td>
							<td> <div align="center">80000.00</div></td>
							<td> <div align="center">60000.00</div></td>
							<td> <div align="center">20000.00</div></td>
							<td> <div align="center"><i class="fa fa-angle-double-right"></i></div></td>
							</tr>

					<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #eefafd; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">145000.00</div></td>
                      <td align="center"><div style="text-transform:capitalize;">40000.00</div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>

                    </tr>


					 </table>
					 <!--</div>-->
					 <br>
					 <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="13"><div style="text-transform:capitalize;color:white;font-size: 15px;">debit documents</div></td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">doc type</div></td>
                      <td align="center"><div style="text-transform:capitalize;">doc no.</div></td>
                      <td align="center"><div style="text-transform:capitalize;">doc date</div></td>
                      <td align="center"><div style="text-transform:capitalize;">voucher no.</div></td>
                      <td align="center"><div style="text-transform:capitalize;">doc currency</div></td>
                      <td align="center"><div style="text-transform:capitalize;">doc amount</div></td>
                      <td align="center"><div style="text-transform:capitalize;">company currency</div></td>
                      <td align="center"><div style="text-transform:capitalize;">ex rt</div></td>
                      <td align="center"><div style="text-transform:capitalize;">doc amount in company currency</div></td>
                      <td align="center"><div style="text-transform:capitalize;">unadjusted amount in company currency</div></td>
                      <td align="center"><div style="text-transform:capitalize;">current adjustments</div></td>
                      <td align="center"><div style="text-transform:capitalize;">PO wise adjustments</div></td>

                    </tr>

							<tr>
							 <td> <div align="center"><input type="checkbox" id="" name="orderlist"></div></td>
							<td> <div align="center">Credit Note</div></td>
							<td> <div align="center">254622</div></td>
							<td> <div align="center">12/05/2016</div></td>
							<td> <div align="center">DB/21/487</div></td>
							<td> <div align="center">USD</div></td>
							<td> <div align="center">2500.00</div></td>
							<td> <div align="center">INR</div></td>
							<td> <div align="center">42.00</div></td>
							<td> <div align="center">105000.00</div></td>
							<td> <div align="center">85000.00</div></td>
							<td> <div align="center">20000.00</div></td>
							<td> <div align="center"><i class="fa fa-angle-double-right"></i></div></td>
							</tr>
							<tr>
							 <td> <div align="center"><input type="checkbox" id="" name="orderlist"></div></td>
							<td> <div align="center">Supplier Invoice</div></td>
							<td> <div align="center">254678</div></td>
							<td> <div align="center">26/03/2016</div></td>
							<td> <div align="center">DB/21/489</div></td>
							<td> <div align="center">USD</div></td>
							<td> <div align="center">2000.00</div></td>
							<td> <div align="center">INR</div></td>
							<td> <div align="center">40.00</div></td>
							<td> <div align="center">80000.00</div></td>
							<td> <div align="center">60000.00</div></td>
							<td> <div align="center">20000.00</div></td>
							<td> <div align="center"><i class="fa fa-angle-double-right"></i></div></td>
							</tr>

					<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #eefafd; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">145000.00</div></td>
                      <td align="center"><div style="text-transform:capitalize;">40000.00</div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>

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