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


                <table class="table erptab" width="100%">

                    <tr style="background: #0288d1;">
                         <td colspan="5"><div style="text-transform:capitalize;color:white;font-size: 15px;">Buyer Advance / LC Request - Revise
                         </div>
                         </td>
                     </tr>
                     <tr>
                         <td style="width: 20%;"><div style="text-transform:capitalize;"><b>Advance Receipt Request No.</b></div></td>
                         <td style="width: 20%;">
                            <input style="width:100%;" class="erpint" type="text" name="" id="" value="10210.00">
                         </td>
                         <td style="width: 20%;"><div style="text-transform:capitalize;"><b>Request Type</b></div></td>
                         <td style="width: 20%;">
                             <select style="width:100%;" class="erpint" name="" id="">
                                 <option value="">Invoice</option>
                             </select>
                         </td>
                         <td style="width: 20%;"></td>
                     </tr>
                                          <tr>
                         <td><div style="text-transform:capitalize"><b>Buyer</b></div></td>
                         <td>
                            <select style="width:100%;" class="erpint" name="" id="">
                            <option value="">Wholesale</option>
                             </select>
                             </td>

                         <td><div style="text-transform:capitalize;"><b>Beneficiary Bank</b></div></td>
                         <td>
                              <select style="width:100%;" class="erpint" name="" id="">
                                 <option value="">HDFC Bank</option>
                             </select>
                         </td>
                         <td></td>
                     </tr>
                     <tr>

                         <td><div style="text-transform:capitalize"><b>Request Mode</b></div></td>
                         <td>
                              <select style="width:100%;" class="erpint" name="" id="">
                                 <option value="">T/T</option>
                             </select>
                        </td>
                        <td><div style="text-transform:capitalize;"><b>PI Type</b></div></td>
                         <td>
                             <select style="width:100%;" class="erpint" name="" id="">
                                 <option value="">PWN</option>
                             </select>
                         </td>
                         <td></td>
                     </tr>
                     <tr>

                         <td><div style="text-transform:capitalize"><b>Total Advanced Request Amount</b></div></td>
                         <td>
                              <input style="width:30%;" class="erpint" type="text" name="" id=""> % or <input style="width:35%;" class="erpint" type="text" name="" id="" value="10.00"> Allocate
                        </td>
                        <td><div style="text-transform:capitalize;"><b>Curency</b></div></td>
                         <td>
                             <select style="width:100%;" class="erpint" name="" id="">
                                 <option value="">US Dollar</option>
                             </select>
                         </td>
                         <td></td>
                     </tr>
                     <tr>

                         <td><div style="text-transform:capitalize"><b>Reason for Revision</b></div></td>
                         <td>
                              <select style="width:100%;" class="erpint" name="" id="">
                                 <option value="">Select</option>
                             </select>
                        </td>
                         <td></td>
                         <td></td>
                         <td></td>
                     </tr>
               </table>
               <br>
					 <!--<div style="height:383px;overflow-y:scroll">-->
					 <table class="table table-hover no-footer apparelclass" width="100%">

					 <tr style="background: #0288d1;">
                         <td colspan="11" style="padding:10px"><div style="text-transform:capitalize;color:white;font-size: 15px;">Invoice List
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-trash"></i> Delete</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-file"></i> Add</button>
                         </div>
                         </td>
                     </tr>

					<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Invoice</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Season</div></td>
					  <td align="center"><div style="text-transform:capitalize;">PWN No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Article No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">PO No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Payment Terms</div></td>
					  <td align="center"><div style="text-transform:capitalize;">PO Value</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Balance Advanced Request Amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Advanced Request Amount<div></td>
					  <td align="center"><div style="text-transform:capitalize;">% Allocation</div></td>
                    </tr>

							<tr>
							 <td> <div align="center"><input type="checkbox" id="" name=""></div></td>
							<td><div align="center">15/JH/125</div></td>
							<td> <div align="center">Holiday</div></td>
							<td> <div align="center">15/JH/125</div></td>
							<td> <div align="center">MKT</div></td>
							<td> <div align="center">30% Advance</div></td>
							<td> <div align="center">100.00</div></td>
							<td> <div align="center">52.00</div></td>
							<td> <div align="center">210.00</div></td>
						    <td> <div align="center">100.00</div></td>
							<td> <div align="center">20.00</div></td>
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