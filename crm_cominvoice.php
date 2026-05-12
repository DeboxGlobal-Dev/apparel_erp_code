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
    padding: 3px;
}
.abc{
display: grid;
    grid-template-columns: 190px 190px 190px;
    grid-column-gap: 3px;
    cursor:pointer;
    margin-left:10px;
 }
 .abcd{
display: grid;
    grid-template-columns: 190px 190px 190px 190px 190px ;
    grid-column-gap: 3px;
    cursor:pointer;
 }
  .abc div, .abcd div{
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

           <div style="border: 1px solid #bbb2b2;">
               <table width="100%">
                   <tr>
                       <td style="padding:10px"><div style="text-transform:capitalize;font-size: 15px;">ASN Pending for Inovices
                       <button style="float:right;border: 0px;background:white"><i class="fa fa-step-backward"></i> Export</button>
                       <button style="float:right;border: 0px;background:white"><i class="fa fa-file-o"></i> Create Invoice</button>
                       </div></td>
                   </tr>
               </table>
               <div class="abc">
                     <div target="1" id="ha1" class="fisrt_branch">Trade Shipment</div>
                      <div target="2" id="ha2" class="fisrt_branch">Commission Shipment</div>
                      <div target="3" id="ha3" class="fisrt_branch">Sample Shipment</div>
               </div>
               <div class="targetDiv"  id="div1">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="10"><div style="text-transform:capitalize;color:white;font-size: 15px;">Trade Shipment</div></td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Buyer Invoicing Company</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Buyer</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Suplier</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Payment Terms</div></td>
					  <td align="center"><div style="text-transform:capitalize;">PWN</div></td>
					  <td align="center"><div style="text-transform:capitalize;">PO No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Article</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Shipment No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Shipment Date</div></td>
                    </tr>

							<tr>
							<td> <div align="center"><input type="checkbox" id="" name=""></div></td>
							<td> <div align="center">Tailor Sourcing</div></td>
							<td> <div align="center">MAc Design</div></td>
							<td> <div align="center">Classic Shippers</div></td>
							<td> <div align="center">30% Advance</div></td>
							<td> <div align="center">521/TRD/12</div></td>
							<td> <div align="center">PO125</div></td>
							<td> <div align="center"></div></td>
							<td> <div align="center">521/TRD/12</div></td>
							<td> <div align="center">29 Aug 2016</div></td>
							</tr>
								<tr>
							 <td> <div align="center"><input type="checkbox" id="" name=""></div></td>
							<td> <div align="center">Matfine Sourcing</div></td>
							<td> <div align="center">MAtf Design</div></td>
							<td> <div align="center">Classic Shippers</div></td>
							<td> <div align="center">30% Advance</div></td>
							<td> <div align="center">512/TRD/12</div></td>
							<td> <div align="center">PO126</div></td>
							<td> <div align="center"></div></td>
							<td> <div align="center">512/TRD/12</div></td>
							<td> <div align="center">19 Dec 2016</div></td>
							</tr>
								<tr>
							 <td> <div align="center"><input type="checkbox" id="" name=""></div></td>
							<td> <div align="center">Tailor Sourcing</div></td>
							<td> <div align="center">MAc Design</div></td>
							<td> <div align="center">Classic Shippers</div></td>
							<td> <div align="center">30% Advance</div></td>
							<td> <div align="center">521/TRD/12</div></td>
							<td> <div align="center">PO125</div></td>
							<td> <div align="center"></div></td>
							<td> <div align="center">521/TRD/12</div></td>
							<td> <div align="center">29 Aug 2016</div></td>
							</tr>

					 </table>
					 <!--</div>-->
              </div>
              <div class="targetDiv"  id="div2">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="13"><div style="text-transform:capitalize;color:white;font-size: 15px;">Commission Shipment</div></td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Buyer Invoicing Company</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Buyer</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Suplier</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Payment Terms</div></td>
					  <td align="center"><div style="text-transform:capitalize;">PWN</div></td>
					  <td align="center"><div style="text-transform:capitalize;">PO No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Article</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Shipment No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Shipment Date</div></td>
                    </tr>

							<tr>
							 <td> <div align="center"><input type="checkbox" id="" name=""></div></td>
							<td> <div align="center">Tailor Sourcing</div></td>
							<td> <div align="center">MAc Design</div></td>
							<td> <div align="center">Classic Shippers</div></td>
							<td> <div align="center">30% Advance</div></td>
							<td> <div align="center">521/TRD/12</div></td>
							<td> <div align="center">PO125</div></td>
							<td> <div align="center"></div></td>
							<td> <div align="center">521/TRD/12</div></td>
							<td> <div align="center">29 Aug 2016</div></td>
							</tr>


					 </table>
					 <!--</div>-->
              </div>
              <div class="targetDiv"  id="div3">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                    <tr style="background: #0288d1;">
                         <td colspan="13"><div style="text-transform:capitalize;color:white;font-size: 15px;">Sample Shipment</div></td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Buyer Invoicing Company</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Buyer</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Suplier</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Payment Terms</div></td>
					  <td align="center"><div style="text-transform:capitalize;">PWN</div></td>
					  <td align="center"><div style="text-transform:capitalize;">PO No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Article</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Shipment No.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Shipment Date</div></td>
                    </tr>

							<tr>
							 <td> <div align="center"><input type="checkbox" id="" name=""></div></td>
							<td> <div align="center">Tailor Sourcing</div></td>
							<td> <div align="center">MAc Design</div></td>
							<td> <div align="center">Classic Shippers</div></td>
							<td> <div align="center">30% Advance</div></td>
							<td> <div align="center">521/TRD/12</div></td>
							<td> <div align="center">PO125</div></td>
							<td> <div align="center"></div></td>
							<td> <div align="center">521/TRD/12</div></td>
							<td> <div align="center">29 Aug 2016</div></td>
							</tr>

					 </table>
					 <!--</div>-->
              </div>
              </div>
              <br>
              <br>
               <table class="table erptab" width="100%">

                    <tr style="background: #0288d1;">
                         <td colspan="5"><div style="text-transform:capitalize;color:white;font-size: 15px;">Buyer Trade Invoice - New
                         </div>
                         </td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:capitalize;"><b>Buyer</b></div></td>
                         <td><input style="width:75%;" type="text" class="erpint" name="" id=""></td>
                         <td><div style="text-transform:capitalize;"><b>Invoice No.</b></div></td>
                         <td><input style="width:75%;" type="text" class="erpint" name="" id=""></td>
                     </tr>
                                          <tr>
                         <td><div style="text-transform:capitalize"><b>Invoice Creation Date</b></div></td>
                         <td><input style="width:75%;" type="date" class="erpint" name="" id=""></td>
                         <td><div style="text-transform:capitalize;"><b>Invoice Date</b></div></td>
                         <td><input type="date" style="width:75%;" class="erpint" name="" id=""></td>
                     </tr>
                     <tr>

                         <td><div style="text-transform:capitalize"><b>Invoice to</b></div></td>
                         <td>
                              <select style="width:75%;" class="erpint" name="" id="">
                                 <option value="">Select</option>
                             </select>
                        </td>
                        <td><div style="text-transform:capitalize;"><b>Beneficiary Bank</b></div></td>
                         <td>
                             <select style="width:75%;" class="erpint" name="" id="">
                                 <option value="">HDFC Bank</option>
                             </select>
                         </td>
                     </tr>
                     <tr>

                         <td><div style="text-transform:capitalize"><b>Payment Terms</b></div></td>
                         <td>
                              <select style="width:75%;" class="erpint" name="" id="">
                                 <option value="">30% Advance on Receipt</option>
                             </select>
                        </td>
                        <td><div style="text-transform:capitalize;"><b>Currency</b></div></td>
                         <td><input type="text" style="width:75%;" class="erpint" name="" id="" value="USD"></td>
                     </tr>
               </table>
               <br>
               <br>
               <div class="abcd">
                     <div target="1" id="hah1" class="fisrt_brnch">PWN Info</div>
                      <div target="2" id="hah2" class="fisrt_brnch">Logistics Info</div>
                      <div target="3" id="hah3" class="fisrt_brnch">Adjustments</div>
                      <div target="4" id="hah4" class="fisrt_brnch">Other Additiion & Deduction</div>
                      <div target="5" id="hah5" class="fisrt_brnch">CI Additional Info</div>
               </div>
               <div class="tarDiv"  id="diiv1">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="6"><div style="text-transform:capitalize;color:white;font-size: 15px;">PWN Info</div></td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Additional Charges</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Basis</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Value</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Comments</div></td>
					</tr>

							<tr>
							<td> <div align="center"><input type="checkbox" id="" name=""></div></td>
							<td> <div align="center">
							    <select class="erpint" name="" id="">
                                 <option value="">Bank Charges</option>
                             </select>
							</div></td>
							<td> <div align="center">
							    <select class="erpint" name="" id="">
                                 <option value="">Basis</option>
                             </select>
							</div></td>
							<td> <div align="center"><input type="text" style="width:75%;" class="erpint" name="" id="" value="10"></div></td>
							<td> <div align="center">5200.00</div></td>
							<td> <div align="center"><input type="text" style="width:75%;" class="erpint" name="" id="" value="Bank Charges"></div></td>
							</tr>
						<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #eefafd; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
				      <td align="center"><div style="text-transform:capitalize;">Total</div></td>
					  <td align="center"><div style="text-transform:capitalize;">5200.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
                    </tr>


					 </table>
					 <!--</div>-->
              </div>
               <div class="tarDiv"  id="diiv2">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="6"><div style="text-transform:capitalize;color:white;font-size: 15px;">Logistics Info</div></td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Additional Charges</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Basis</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Value</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Comments</div></td>
					</tr>

							<tr>
							<td> <div align="center"><input type="checkbox" id="" name=""></div></td>
							<td> <div align="center">
							    <select class="erpint" name="" id="">
                                 <option value="">Bank Charges</option>
                             </select>
							</div></td>
							<td> <div align="center">
							    <select class="erpint" name="" id="">
                                 <option value="">Basis</option>
                             </select>
							</div></td>
							<td> <div align="center"><input type="text" style="width:75%;" class="erpint" name="" id="" value="10"></div></td>
							<td> <div align="center">5200.00</div></td>
							<td> <div align="center"><input type="text" style="width:75%;" class="erpint" name="" id="" value="Bank Charges"></div></td>
							</tr>
						<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #eefafd; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
				      <td align="center"><div style="text-transform:capitalize;">Total</div></td>
					  <td align="center"><div style="text-transform:capitalize;">5200.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
                    </tr>


					 </table>
					 <!--</div>-->
              </div>
               <div class="tarDiv"  id="diiv3">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="6"><div style="text-transform:capitalize;color:white;font-size: 15px;">Adjustments</div></td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Additional Charges</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Basis</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Value</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Comments</div></td>
					</tr>

							<tr>
							<td> <div align="center"><input type="checkbox" id="" name=""></div></td>
							<td> <div align="center">
							    <select class="erpint" name="" id="">
                                 <option value="">Bank Charges</option>
                             </select>
							</div></td>
							<td> <div align="center">
							    <select class="erpint" name="" id="">
                                 <option value="">Basis</option>
                             </select>
							</div></td>
							<td> <div align="center"><input type="text" style="width:75%;" class="erpint" name="" id="" value="10"></div></td>
							<td> <div align="center">5200.00</div></td>
							<td> <div align="center"><input type="text" style="width:75%;" class="erpint" name="" id="" value="Bank Charges"></div></td>
							</tr>
						<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #eefafd; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
				      <td align="center"><div style="text-transform:capitalize;">Total</div></td>
					  <td align="center"><div style="text-transform:capitalize;">5200.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
                    </tr>


					 </table>
					 <!--</div>-->
              </div>
               <div class="tarDiv"  id="diiv4">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="6"><div style="text-transform:capitalize;color:white;font-size: 15px;">Amount Addition & Deduction</div></td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Additional Charges</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Basis</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Value</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Comments</div></td>
					</tr>

							<tr>
							<td> <div align="center"><input type="checkbox" id="" name=""></div></td>
							<td> <div align="center">
							    <select class="erpint" name="" id="">
                                 <option value="">Bank Charges</option>
                             </select>
							</div></td>
							<td> <div align="center">
							    <select class="erpint" name="" id="">
                                 <option value="">Basis</option>
                             </select>
							</div></td>
							<td> <div align="center"><input type="text" style="width:75%;" class="erpint" name="" id="" value="10"></div></td>
							<td> <div align="center">5200.00</div></td>
							<td> <div align="center"><input type="text" style="width:75%;" class="erpint" name="" id="" value="Bank Charges"></div></td>
							</tr>
						<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #eefafd; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
				      <td align="center"><div style="text-transform:capitalize;">Total</div></td>
					  <td align="center"><div style="text-transform:capitalize;">5200.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
                    </tr>


					 </table>
					 <!--</div>-->
              </div>
               <div class="tarDiv"  id="diiv5">
               <!--<div style="height:383px;overflow-y:scroll">-->
			      <table class="table table-hover no-footer apparelclass" width="100%">

                     <tr style="background: #0288d1;">
                         <td colspan="6"><div style="text-transform:capitalize;color:white;font-size: 15px;">CI Additional Info</div></td>
                     </tr>

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;">Additional Charges</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Basis</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Value</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Amount</div></td>
					  <td align="center"><div style="text-transform:capitalize;">Comments</div></td>
					</tr>

							<tr>
							<td> <div align="center"><input type="checkbox" id="" name=""></div></td>
							<td> <div align="center">
							    <select class="erpint" name="" id="">
                                 <option value="">Bank Charges</option>
                             </select>
							</div></td>
							<td> <div align="center">
							    <select class="erpint" name="" id="">
                                 <option value="">Basis</option>
                             </select>
							</div></td>
							<td> <div align="center"><input type="text" style="width:75%;" class="erpint" name="" id="" value="10"></div></td>
							<td> <div align="center">5200.00</div></td>
							<td> <div align="center"><input type="text" style="width:75%;" class="erpint" name="" id="" value="Bank Charges"></div></td>
							</tr>
						<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #eefafd; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
                      <td align="center"><div style="text-transform:capitalize;"></div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
				      <td align="center"><div style="text-transform:capitalize;">Total</div></td>
					  <td align="center"><div style="text-transform:capitalize;">5200.00</div></td>
					  <td align="center"><div style="text-transform:capitalize;"></div></td>
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

<script>
jQuery(function() {
  jQuery('.fisrt_brnch').click(function() {
    jQuery('.tarDiv').hide();
    jQuery('#diiv' + $(this).attr('target')).show();
    $('.fisrt_brnch') .attr('style', 'background-color: white');
    $('.fisrt_brnch') .attr('style', 'color: #4a4646');
    $('#hah' + $(this).attr('target')) .attr('style', 'background-color: #0288d1');
  });
});
</script>
<script>
$(document).ready(function(){
  $('#hah4').trigger('click');
});
</script>