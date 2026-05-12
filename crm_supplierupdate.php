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

               <table class="table erptab" width="100%">

                    <tr style="background: #0288d1;">
                         <td colspan="6"><div style="text-transform:capitalize;color:white;font-size: 15px;">Supplier LC Update
                         </div>
                         </td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:capitalize;"><b>Buyer</b></div></td>
                         <td>
                             <select style="width:100%;" class="erpint" name="" id="">
                                 <option value="">ABC Buyer</option>
                             </select>
                         </td>
                         <td><div style="text-transform:capitalize;"><b>Date</b></div></td>
                         <td><input style="width:100%;" type="date" class="erpint" name="lcdate" id=""></td>
                         <td><div style="text-transform:capitalize;"><b>Select PI</b></div></td>
                         <td>
                             <select style="width:100%;" class="erpint" name="" id="">
                              <option value="">Select</option>
                             </select>
                         </td>
                     </tr>
                                          <tr>
                         <td><div style="text-transform:capitalize"><b>Supplier</b></div></td>
                         <td>
                             <select style="width:100%;" class="erpint" name="" id="">
                              <option value="">XYZ Suppier</option>
                             </select>
                             </td>
                         <td><div style="text-transform:capitalize;"><b>LC Type</b></div></td>
                         <td>
                             <select style="width:100%;" class="erpint" name="" id="">
                                 <option value="">Import LC</option>
                             </select>
                         </td>
                         <td><div style="text-transform:capitalize;"><b>Amendment No.</b></div></td>
                         <td>
                             <input style="width:100%;" class="erpint" name="" id="">
                         </td>
                     </tr>
                     <tr>

                         <td><div style="text-transform:capitalize"><b>LC Application No.</b></div></td>
                         <td>
                             <input style="width:100%;" class="erpint" name="" id="">
                        </td>
                        <td><div style="text-transform:capitalize;"><b>Payment Term</b></div></td>
                         <td>
                             <select style="width:100%;" class="erpint" name="paymenttermcred" id="">
                                 <option value="">Select</option>
                             </select>
                         </td>
                         <td></td>
                         <td></td>
                     </tr>
               </table>
               <br>
					 <!--<div style="height:383px;overflow-y:scroll">-->
					 <table class="table table-hover no-footer apparelclass" style="width:60%">

					 <tr style="background: #0288d1;">
                         <td colspan="3" style="padding:10px"><div style="text-transform:capitalize;color:white;font-size: 15px;">Master LC Information</div>
                         </td>
                     </tr>

					<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center" style="width:30%"><div style="text-transform:capitalize;"></div></td>
					  <td align="center" style="width:30%"><div style="text-transform:capitalize;">Buyer LC</div></td>
					  <td align="center" style="width:30%"><div style="text-transform:capitalize;">Supplier LC</div></td>
                    </tr>

							<tr>
							<td><div align="left">LC No.</div></td>
							<td> <div align="left"><input type="text" style="width:100%;" class="erpint" name="" id="" value="ICH547/22"></div></td>
							<td> <div align="left"><input type="text" style="width:100%;" class="erpint" name="" id="" value="542511TR"></div></td>
							</tr>
							<tr>
							<td><div align="left">Issuing Bank</div></td>
							<td> <div align="left"><input type="text" style="width:100%;" class="erpint" name="" id="" value="Axis Bank"></div></td>
							<td> <div align="left">
							     <select name="" class="erpint" name="" style="width:100%;" id="" >
							    <option value="">Axis Bank</option>
							</select>
							</div></td>
							</tr>
							<tr>
							<td><div align="left">Beneficiary Advising Bank</div></td>
							<td><div align="left"><input type="text" style="width:100%;" class="erpint" name="" id="" value="HDFC Bank"></div></td>
							<td><div align="left">
							     <select name="" class="erpint" name="" id="" style="width:100%;">
							    <option value="">HDFC Bank</option>
							</select>
							</div></td>
							</tr>
							<tr>
							<td><div align="left">LC Terms</div></td>
							<td> <div align="left"><input type="text" style="width:100%;" class="erpint" name="" id="" value="LC 90 Days"></div></td>
							<td> <div align="left">
							    <select name="" class="erpint" name="" id="" style="width:100%;">
							    <option value="">LC 60 days</option>
							</select>
							</div></td>
							</tr>
							<tr>
							<td><div align="left">LC Amount</div></td>
							<td> <div align="left"><input type="text" style="width:59%;" class="erpint" name="" id="" value="4500.00"> <input type="text" style="width:39%;" class="erpint" name="" id="" value="USD"></div></td>
							<td> <div align="left">
							    <input type="text" style="width:59%;" class="erpint" name="" id="" value="4500.00">
							<select name="" style="width:39%;" class="erpint" name="" id="" >
							    <option value="USD">USD</option>
							</select>
							</div></td>
							</tr>
							<tr>
							<td><div align="left">Balance LC Amount</div></td>
							<td> <div align="left"><input type="text" style="width:100%;" class="erpint" name="" id="" value="4500.00"></div></td>
							<td> <div align="left"><input type="text" style="width:100%;" class="erpint" name="" id="" value=""></div></td>
							</tr>
							<tr>
							<td><div align="left">Latest Shipment Date</div></td>
							<td> <div align="left"><input type="text" style="width:100%;" class="erpint" name="" id="" value="21st Jan 2018"></div></td>
							<td> <div align="left"><input type="text" style="width:100%;" class="erpint" name="" id="" value="05th Mar 2016 "></div></td>
							</tr>
							<tr>
							<td><div align="left">Presentation Days from BL/AWB</div></td>
							<td> <div align="left"><input type="text" style="width:100%;" class="erpint" name="" id="" value="20"></div></td>
							<td> <div align="left"><input type="text" style="width:100%;" class="erpint" name="" id="" value="25"></div></td>
							</tr>
							<tr>
							<td><div align="left">LC Expiry Date</div></td>
							<td> <div align="left"><input type="text" style="width:100%;" class="erpint" name="" id="" value="21st Jan 2018"></div></td>
							<td> <div align="left"><input type="date" style="width:100%;" class="erpint" name="" id="" value="21st Dec 2011"></div></td>
							</tr>
							<tr>
							<td><div align="left">LC Tolerance</div></td>
							<td> <div align="left"> - <input type="text" style="width:45%;" class="erpint" name="" id="" value="2000.00"> + <input type="text" style="width:45%;" class="erpint" name="" id="" value="2000.00"></div></td>
							<td> <div align="left"> - <input type="text" style="width:45%;" class="erpint" name="" id="" value="2000.00"> + <input type="text" style="width:45%;" class="erpint" name="" id="" value="2000.00"></div></td>
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