<style>
.apparelclass tr td{
border-top:0px solid #ccc !important;
border:1px solid #ccc !important;
vertical-align:middle !important;
padding:10px!important;
}
.erptab tr td{
border-top:0px solid #ccc !important;
padding:0.55rem!important;
}
.erptab{
border:1px solid #ccc !important;
}
.erpint{
    border: 1px solid #b3acac;
    padding: 4px;
}
.abc{
display: grid;
    grid-template-columns: 190px 190px;
    grid-column-gap: 3px;
    cursor:pointer;
    margin-left:10px;
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


                  <br>
                   <table class="table erptab" width="100%">

                    <tr style="background: #0288d1;">
                         <td colspan="6"><div style="text-transform:capitalize;color:white;font-size: 15px;">buyer claim / credit note - new
                          <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-share-square-o"></i> Exit</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-check-square-o"></i> Confirm</button>
                          <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-download"></i> Save</button>
                         </div>
                         </td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:capitalize;"><b>buyer</b></div></td>
                         <td><input style="width:75%;" type="text" class="erpint" name="" id="" value="New Look Designers"></td>
                         <td><div style="text-transform:capitalize;"><b>receipt Date</b></div></td>
                         <td><input style="width:75%;" type="date" class="erpint" name="" id=""></td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:capitalize"><b>receipt amount</b></div></td>
                         <td><input style="width:75%;" type="text" class="erpint" name="" id="" value="15000.00"> Allocate</td>
                         <td><div style="text-transform:capitalize;"><b>receiving currency</b></div></td>
                         <td><input style="width:75%;" type="text" class="erpint" name="" id="" value="USD"></td>
                     </tr>
                     <tr>

                         <td><div style="text-transform:capitalize"><b>charges applied</b></div></td>
                         <td><input style="width:75%;" type="text" class="erpint" name="" id="" value="0.00"></td>
                        <td><div style="text-transform:capitalize;"><b>net receipt value</b></div></td>
                         <td><input style="width:75%;" type="text" class="erpint" name="" id="" value="15000.00"></td>
                     </tr>
                     <tr>

                         <td><div style="text-transform:capitalize"><b>bank account </b></div></td>
                         <td>
                              <select style="width:75%;" class="erpint" name="" id="">
                                 <option value="">HSBC</option>
                             </select>
                        </td>
                        <td><div style="text-transform:capitalize;"><b></b></div></td>
                         <td><input style="width:75%;" type="text" class="erpint" name="" id=""></td>
                     </tr>
                      <tr>
                         <td><div style="text-transform:capitalize;"><b>exchange rate</b></div></td>
                         <td><input style="width:75%;" type="text" class="erpint" name="" id="" value="1.00000"></td>
                         <td></td>
                         <td></td>
                     </tr>


               </table>
          <br>
          <br>

               <div class="abc">
                     <div target="1" id="ha1" class="fisrt_branch">Sales Invoice</div>
                      <div target="2" id="ha2" class="fisrt_branch">Other Charges</div>
               </div>

              <div class="targetDiv"  id="div1">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="10"><div style="text-transform:capitalize;color:white;font-size: 15px;">Selected Document list
                          <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-trash"></i> Delete</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-plus-circle"></i> Add</button>
                         </div></td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">buyer</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Doc type</div></td>
					  <td align="center"><div style="text-transform:capitalize;">dov no.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">doc date</div></td>
					  <td align="center"><div style="text-transform:capitalize;">doc gL date</div></td>
					  <td align="center"><div style="text-transform:capitalize;">doc amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">outstanding amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">doc currency</div></td>
					  <td align="center"><div style="text-transform:capitalize;">receiving value</div></td>
                    </tr>

							<tr>
							<td> <div align="center"><input type="checkbox" id="" name=""></div></td>
							<td> <div align="center">New Look Designers</div></td>
							<td> <div align="center">Invoice</div></td>
							<td> <div align="center">110054</div></td>
							<td> <div align="center">25 Jan 2016</div></td>
							<td> <div align="center">15 Jan 2016</div></td>
							<td> <div align="center">4500.00</div></td>
							<td> <div align="center">4500.00</div></td>
							<td> <div align="center">USD</div></td>
							<td> <div align="center"><input style="width:75%;" type="text" class="erpint" name="" id="" value="4500.00"></div></td>
							</tr>

					 </table>
					 <!--</div>-->
              </div>
              <div class="targetDiv"  id="div2">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="10"><div style="text-transform:capitalize;color:white;font-size: 15px;">Selected Document list
                          <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-trash"></i> Delete</button>
                         <button style="float:right;border: 0px;background: #0288d1;color:white"><i class="fa fa-plus-circle"></i> Add</button>
                         </div></td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">buyer</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Doc type</div></td>
					  <td align="center"><div style="text-transform:capitalize;">dov no.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">doc date</div></td>
					  <td align="center"><div style="text-transform:capitalize;">doc gL date</div></td>
					  <td align="center"><div style="text-transform:capitalize;">doc amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">outstanding amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">doc currency</div></td>
					  <td align="center"><div style="text-transform:capitalize;">receiving value</div></td>
                    </tr>

							<tr>
							<td> <div align="center"><input type="checkbox" id="" name=""></div></td>
							<td> <div align="center">New Look Designers</div></td>
							<td> <div align="center">Invoice</div></td>
							<td> <div align="center">110054</div></td>
							<td> <div align="center">25 Jan 2016</div></td>
							<td> <div align="center">15 Jan 2016</div></td>
							<td> <div align="center">4500.00</div></td>
							<td> <div align="center">4500.00</div></td>
							<td> <div align="center">USD</div></td>
							<td> <div align="center"><input style="width:75%;" type="text" class="erpint" name="" id="" value="4500.00"></div></td>
							</tr>

					 </table>
					 <!--</div>-->
              </div>
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