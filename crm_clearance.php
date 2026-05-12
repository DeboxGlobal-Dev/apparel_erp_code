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
padding:0.5rem!important;
}
.erptab1{
border:1px solid #ccc !important;
}

.erpint{
    border: 1px solid #b3acac;
    padding: 3px;
}
.abc{
display: grid;
    grid-template-columns: 200px 200px 200px 200px 200px;
    grid-column-gap: 3px;
    cursor:pointer;
 }
 .abcd{
display: grid;
    grid-template-columns:175px 175px 175px 175px 175px 175px;
    grid-column-gap: 3px;
    cursor:pointer;
    border: 1px solid #d2c9c9;
    padding: 4px 4px 0;
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
    .abcd div{
    font-weight: 500;
    padding: 6px;
    border-radius: 3px;
    text-align: center;
    color: white;
    border: 1px solid #b3acac;
    font-size: 13px;
}
</style>
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

 <script>
jQuery(function() {
  jQuery('.fisrt_brnch').click(function() {
    jQuery('.tarDiv').hide();
    jQuery('#divv' + $(this).attr('target')).show();
    $('.fisrt_brnch') .attr('style', 'background-color: white');
    $('.fisrt_brnch') .attr('style', 'color: #4a4646');
    $('#hah' + $(this).attr('target')) .attr('style', 'background-color: #0288d1');
  });
});
</script>
<script>
$(document).ready(function(){
  $('#hah1').trigger('click');
});
</script>
<script>
jQuery(function() {
  jQuery('.first_branch').click(function() {
    jQuery('.targDiv').hide();
    jQuery('#diiv' + $(this).attr('target')).show();
    $('.first_branch') .attr('style', 'background-color: white');
    $('.first_branch') .attr('style', 'color: #4a4646');
    $('#ca' + $(this).attr('target')) .attr('style', 'background-color: #37a3de');
  });
});
</script>
<script>
$(document).ready(function(){
  $('#ca5').trigger('click');
});
</script>
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
               <div class="abc">
                     <div target="1" id="ha1" class="fisrt_branch">Supplier Invoice</div>
                      <div target="2" id="ha2" class="fisrt_branch">Advance Payment</div>
                      <div target="3" id="ha3" class="fisrt_branch">Credit Note</div>
                      <div target="4" id="ha4" class="fisrt_branch">Debit Note</div>
                      <div target="5" id="ha5" class="fisrt_branch">Pending Supplier Invoice</div>

               </div>
               <div class="targetDiv"  id="div1">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="13"><div style="text-transform:capitalize;color:white;font-size: 15px;">Supplier Invoice
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
					  <td align="center"><div style="text-transform:capitalize;">UOM</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Gros Order Value</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Additional Charges</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Net Order Value</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Debit Note</div></td>
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
                                 <option value="">LIT</option>
                             </select>
							</div></td>
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

					 </table>
					 <!--</div>-->
              </div>
              <div class="targetDiv"  id="div2">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="12"><div style="text-transform:capitalize;color:white;font-size: 15px;">Advance Payment
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
              </div>
              <div class="targetDiv"  id="div3">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="12"><div style="text-transform:capitalize;color:white;font-size: 15px;">Credit Note
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
              </div>
              <div class="targetDiv"  id="div4">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="12"><div style="text-transform:capitalize;color:white;font-size: 15px;">Debit Note
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
              </div>
              <div class="targetDiv"  id="div5">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="12"><div style="text-transform:capitalize;color:white;font-size: 15px;">Pending Supplier Invoice
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
              </div>
              <br>
              <br>
              <div class="abc">
                     <div target="1" id="hah1" class="fisrt_brnch">3 Way Matching</div>
                      <div target="2" id="hah2" class="fisrt_brnch">Online/Offline Payment</div>
                      <div target="3" id="hah3" class="fisrt_brnch">Auto Dr./Cr. Notes</div>

               </div>
               <div class="tarDiv"  id="divv1" style="border: 1px solid #bfbfbd;">
               <!--code starts-->
               <br>
               <div style="width: 99%;margin: auto;">
                        <div class="abcd">
                      <div target="1" id="ca1" class="first_branch">Supplier Invoice</div>
                      <div target="2" id="ca2" class="first_branch">Advance Payment</div>
                      <div target="3" id="ca3" class="first_branch">Credit Note</div>
                      <div target="4" id="ca4" class="first_branch">Debit Note</div>
                      <div target="5" id="ca5" class="first_branch">Pending Supplier Invoice</div>
                      <div target="6" id="ca6" class="first_branch">Landed Cost</div>

               </div>
               <div class="targDiv"  id="diiv1">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #37a3de;">
                         <td colspan="13"><div style="text-transform:capitalize;color:white;font-size: 15px;">Supplier Invoice
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-trash"></i> Delete</button>
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-plus-circle"></i> Add</button>
                         </div>
                         </td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Order No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Style</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Quantity</div></td>
					  <td align="center"><div style="text-transform:capitalize;">UOM</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Gros Order Value</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Additional Charges</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Net Order Value</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Debit Note</div></td>
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
                                 <option value="">LIT</option>
                             </select>
							</div></td>
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


					 </table>
					 <!--</div>-->
              </div>
              <div class="targDiv"  id="diiv2">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #37a3de;">
                         <td colspan="12"><div style="text-transform:capitalize;color:white;font-size: 15px;">Advance Payment
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-trash"></i> Delete</button>
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-plus-circle"></i> Add</button>
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
              </div>
              <div class="targDiv"  id="diiv3">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #37a3de;">
                         <td colspan="12"><div style="text-transform:capitalize;color:white;font-size: 15px;">Credit Note
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-trash"></i> Delete</button>
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-plus-circle"></i> Add</button>
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
              </div>
              <div class="targDiv"  id="diiv4">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #37a3de;">
                         <td colspan="12"><div style="text-transform:capitalize;color:white;font-size: 15px;">Debit Note
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-trash"></i> Delete</button>
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-plus-circle"></i> Add</button>
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
              </div>
              <div class="targDiv"  id="diiv5">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer erptab" width="100%">

                     <tr style="background: #37a3de;">
                         <td colspan="15"><div style="text-transform:capitalize;color:white;font-size: 15px;">Pending Supplier Invoice
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-trash"></i> Delete</button>
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-plus-circle"></i> Add</button>
                         </div>
                         </td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">HK Invoice No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Supplier Code</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Invoice No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Invoice Date</div></td>
					  <td align="center"><div style="text-transform:capitalize;">GL Date</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Gross Shipment</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Currency</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Additional Charge</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Net Shipment</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Invoice Amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Variable Amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Raise DN</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Exchange Rate</div></td>
                    </tr>

							<tr>
							 <td> <div align="center"><input type="checkbox" id="" name=""></div></td>
							<td><div align="center">12154</div></td>
							<td> <div align="center"><select name="" class="erpint" id=""><option value="">XYZ Design</option></select></div></td>
							<td> <div align="center"><input type="text" name="" id="" class="erpint"></div></td>
							<td> <div align="center"><input type="date" name="" id="" class="erpint"></div></td>
							<td> <div align="center"><input type="text" name="" id="" class="erpint" value="25 Aug 2016"></div></td>
							<td> <div align="center">5012.00</div></td>
							<td> <div align="center">DYT</div></td>
							<td> <div align="center"></div></td>
							<td> <div align="center">2105.00</div></td>
							<td> <div align="center"><input type="text" name="" id="" class="erpint" value="2500.00"></div></td>
							<td> <div align="center">0.00</div></td>
							<td> <div align="center"><input type="checkbox" id="" name=""></div></td>
							<td> <div align="center">1000.00</div></td>
							</tr>

							<tr>
							 <td> <div align="center"><input type="checkbox" id="" name=""></div></td>
							<td><div align="center">12154</div></td>
							<td> <div align="center"><select name="" class="erpint" id=""><option value="">XYZ Design</option></select></div></td>
							<td> <div align="center"><input type="text" name="" id="" class="erpint"></div></td>
							<td> <div align="center"><input type="date" name="" id="" class="erpint"></div></td>
							<td> <div align="center"><input type="text" name="" id="" class="erpint" value="25 Aug 2016"></div></td>
							<td> <div align="center">5012.00</div></td>
							<td> <div align="center">DYT</div></td>
							<td> <div align="center"></div></td>
							<td> <div align="center">2105.00</div></td>
							<td> <div align="center"><input type="text" name="" id="" class="erpint" value="2500.00"></div></td>
							<td> <div align="center">0.00</div></td>
							<td> <div align="center"><input type="checkbox" id="" name=""></div></td>
							<td> <div align="center">1000.00</div></td>
							</tr>
					 </table>
					 <!--</div>-->
              </div>
              <div class="targDiv"  id="diiv6">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #37a3de;">
                         <td colspan="12"><div style="text-transform:capitalize;color:white;font-size: 15px;">Landed Cost
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-trash"></i> Delete</button>
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-plus-circle"></i> Add</button>
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
              </div>
               <!--code end-->
              </div>
              </div>
              <div class="tarDiv"  id="divv2" style="border: 1px solid #bfbfbd;">
                 <br>
               <div style="width: 99%;margin: auto;">
               <!--<div style="height:383px;overflow-y:scroll">-->
               <table class="table" width="100%">

                     <tr style="background:#37a3de;">
                         <td colspan="12"><div style="text-transform:capitalize;color:white;font-size: 15px;">Supplier Payment - New
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-window-close"></i> Close</button>
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-check-square-o"></i> Confirm</button>
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-download"></i> Save</button>
                         </div>
                         </td>
                     </tr>
                     </table>
                     <div style="    border: 1px solid #ccc;display:grid;grid-template-columns:auto auto auto;padding: 10px;grid-column-gap: 10px;">
                         <table class="table erptab1" width="100%">
                     <tr>
                         <td><div style="text-transform:capitalize;"><b>Supplier</b></div></td>
                         <td><div style="text-transform:capitalize;">XYZ Supplier</div></td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:capitalize;"><b>Payment amount</b></div></td>
                         <td><div style="text-transform:capitalize;">25400.00</div></td>
                     </tr>
                      <tr>
                         <td><div style="text-transform:capitalize;"><b>GL Date</b></div></td>
                         <td><div style="text-transform:capitalize;">25 Aug 2016</div></td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:capitalize;"><b>Exchange Rate</b></div></td>
                         <td><div style="text-transform:capitalize;">1.000</div></td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:capitalize;"><b>Bank Account</b></div></td>
                         <td><div><select name="" class="erpint"id=""><option value="">HSBC Bank</option></select></div></td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:capitalize;"><b>Net Bank Balance</b></div></td>
                         <td><div style="text-transform:capitalize;">-121254.00</div></td>
                     </tr>


               </table>

                <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background:#37a3de;">
                         <td colspan="5"><div style="text-transform:capitalize;color:white;font-size: 15px;">Supplier Invoice
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-trash"></i> Delete</button>
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-plus-circle"></i> Add</button>
                         </div>
                         </td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Beneficiary Name</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Payment Mode</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Instrument No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Amount</div></td>
                    </tr>

							<tr>
							 <td><div align="center"><input type="checkbox" id="" name="orderlist"></div></td>
							<td><div align="center"><input name="" type="text" id="" class="erpint" value="XYZ Suplier"></div></td>
							<td> <div align="center"><select name="" id="" class="erpint"><option value="">Cheque</option></select></div></td>
							<td> <div align="center"><input name="" type="text" id="" class="erpint" value="12548"></div></td>
							<td> <div align="center"><input name="" type="text" id="" class="erpint" value="2500.00"></div></td>
							</tr>
							</table>
							 <table class="table erptab1" width="100%">

						<tr style="background: #37a3de;">
                         <td colspan="2"><div style="text-transform:capitalize;color:white;font-size: 15px;">Supplier Payment Summary</div></td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:capitalize;"><b>Net Payable Supplier Invoice</b></div></td>
                         <td><div style="text-transform:capitalize;">5000.00</div></td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:capitalize;"><b>Net Payable Advance Request</b></div></td>
                         <td><div style="text-transform:capitalize;">00.00</div></td>
                     </tr>
                      <tr>
                         <td><div style="text-transform:capitalize;"><b>Net Payable Credit Notes</b></div></td>
                         <td><div style="text-transform:capitalize;">00.00</div></td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:capitalize;"><b>Total Payable Amount</b></div></td>
                         <td><div style="text-transform:capitalize;">5000.00</div></td>
                     </tr>
               </table>
               </div>
                     </div>
                     <br>
			      <table class="table table-hover no-footer apparelclass" style="width: 99%;margin: auto;">

                     <tr style="background: #37a3de;">
                         <td colspan="10"><div style="text-transform:capitalize;color:white;font-size: 15px;">Account Payable - Supplier Payments
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-money"></i> Pay</button>
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-chain-broken"></i> Delink</button>
                         </div>
                         </td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Party Name</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Doc Type</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Due Date</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Doc No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Doc Date</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Doc GL Date</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Doc Currency</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Doc Amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Outstanding Amount</div></td>
                    </tr>

							<tr>
							 <td> <div align="center"><input type="checkbox" id="" name="orderlist"></div></td>
							<td><div align="center">XYZ Supplier</div></td>
							<td> <div align="center">Advance</div></td>
							<td> <div align="center">12 Mar 2016</div></td>
							<td> <div align="center">DGR/DBX/1254</div></td>
							<td> <div align="center">12 Mar 2016</div></td>
							<td> <div align="center">12 Mar 2016</div></td>
							<td> <div align="center">USD</div></td>
							<td> <div align="center">700.00</div></td>
							<td> <div align="center">700.00</div></td>
							</tr>


					 </table>
					 <!--</div>-->
              </div>
              <div class="tarDiv"  id="divv3" style="border: 1px solid #bfbfbd;">
                  <br>
                  <div style="width:99%;margin:auto">
                      <table class="table erptab1" width="100%">

                    <tr style="background: #37a3de;">
                         <td colspan="2"><div style="text-transform:capitalize;color:white;font-size: 15px;">Debit Note - View
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-window-close"></i> Cancel</button>
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-check-circle"></i> Confirm</button>
                         </div>
                         </td>
                     </tr>

                     <tr>
                         <td style="width:15%"><div style="text-transform:capitalize;"><b>Supplier</b></div></td>
                         <td><div style="text-transform:capitalize;">XYZ Supplier</div></td>

                     </tr>
                     <tr>
                         <td ><div style="text-transform:capitalize;"><b>Currency</b></div></td>
                         <td><div style="text-transform:capitalize;">USD</div></td>

                     </tr>
                     <tr>
                         <td ><div style="text-transform:capitalize;"><b>Note Type</b></div></td>
                         <td><div style="text-transform:capitalize;">Against GMPO</div></td>

                     </tr>
                     <tr>
                         <td ><div style="text-transform:capitalize;"><b>Total Amount</b></div></td>
                         <td><div style="text-transform:capitalize;">1000.00</div></td>

                     </tr>



               </table>
               <br>
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%" >

                     <tr style="background: #37a3de;">
                         <td colspan="12"><div style="text-transform:capitalize;color:white;font-size: 15px;">Order List
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-trash"></i> Delete</button>
                         <button style="float:right;border: 0px;background: #37a3de;color:white"><i class="fa fa-plus-circle"></i> Add</button>
                         </div>
                         </td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;">Order No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Style</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Quantity</div></td>
					  <td align="center"><div style="text-transform:capitalize;">UMO</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Gross Order Value</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Additional Charges</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Net Order Value</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Debit Note</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Credit Note</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Invoices</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Request Amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Reason</div></td>
                    </tr>

							<tr>
							 <td><div align="center">10214</div></td>
							<td><div align="center">XYZ Supplier</div></td>
							<td> <div align="center">2000</div></td>
							<td> <div align="center">PCS</div></td>
							<td> <div align="center">500.00</div></td>
							<td> <div align="center">0.00</div></td>
							<td> <div align="center">500.00</div></td>
							<td> <div align="center">2.00</div></td>
							<td> <div align="center">0.00</div></td>
							<td> <div align="center">00.00</div></td>
							<td> <div align="center">1.00</div></td>
							<td> <div align="center">Commission</div></td>
							</tr>

					 </table>
					 <!--</div>-->
              </div>
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
