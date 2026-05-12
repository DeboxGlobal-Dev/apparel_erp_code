<?php
$indentFieldsDataq=GetPageRecord('*','indentCreationMaster','1 and supplierId="'.decode($_GET['id']).'" and poNumber="'.$_GET['po'].'"');
$indentFieldsData=mysqli_fetch_array($indentFieldsDataq);

?>

<div class="page-content">
  <div class="content-wrapper">
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
            <div class="col-xl-9">
              <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>
            <div class="col-xl-3" style="padding-right: 0px;display:none;">
              <div class="d-flex align-items-center" style="float:right;margin-right:0px;"> <a class="btn" href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $_GET['module']; ?>" style="background-color: #949494; color: #fff;">Generate PO </a> </div>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="card mb-0 rounded-bottom-0" style="padding:15px;">
              <style>
.header-table tr td{
border:0px solid #ccc !important;
padding:0px !important;
}
.upper-1-table tr td{
vertical-align:top !important;
}
</style>
              <?php
$companyDataq=GetPageRecord('*','companyMaster','1 order by id');
$companyData=mysqli_fetch_array($companyDataq);

$addressDataq=GetPageRecord('*','addressMaster','1 and addressType="company" and addressParent="'.$companyData['id'].'" order by id');
$addressData=mysqli_fetch_array($addressDataq);

$supplierDataq=GetPageRecord('*','suppliersMaster','1 and id="'.decode($_GET['id']).'"');
$supplierData=mysqli_fetch_array($supplierDataq);

$addressSupplierDataq=GetPageRecord('*','addressMaster','1 and addressType="supplier" and addressParent="'.$supplierData['id'].'" order by id');
$addressSupplierData=mysqli_fetch_array($addressSupplierDataq);

?>
              <table width="100%" class="table table-bordered upper-1-table">
                <tr>
                  <td align="center" colspan="5"><div align="center"><strong style="font-size:18px;">Purchase Order</strong></div></td>
                </tr>
                <tr>
                  <td width="17%" valign="top"><table class="header-table">
                      <tr>
                        <td><div><strong><?php echo $companyData['name']; ?></strong></div></td>
                      </tr>
                      <tr>
                        <td><div><?php echo $addressData['address']; ?> <?php echo getCityName($addressData['cityId']); ?> <?php echo getStateName($addressData['stateId']); ?> <?php echo getCountryName($addressData['countryId']); ?></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>State Code:</strong> <?php echo getStateName($addressData['stateId']);; ?></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>Pin Code:</strong> <?php echo $addressData['pinCode']; ?></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>GSTN:</strong> <?php echo $addressData['gstn']; ?></div></td>
                      </tr>
                    </table></td>
                  <td width="20%" valign="top"><table class="header-table">
                      <tr>
                        <td><div><strong>Bill To</strong></div></td>
                      </tr>
                      <tr>
                        <td><div><?php echo $companyData['name']; ?></div></td>
                      </tr>
                      <tr>
                        <td><div><?php echo $addressData['address']; ?> <?php echo getCityName($addressData['cityId']); ?> <?php echo getStateName($addressData['stateId']); ?> <?php echo getCountryName($addressData['countryId']); ?></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>State Code:</strong> <?php echo getStateName($addressData['stateId']);; ?></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>Pin Code:</strong> <?php echo $addressData['pinCode']; ?></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>GSTN:</strong> <?php echo $addressData['gstn']; ?></div></td>
                      </tr>
                    </table></td>
                  <td width="23%" valign="top"><table class="header-table">
                      <tr>
                        <td><div><strong>Supplier</strong></div></td>
                      </tr>
                      <tr>
                        <td><div><?php echo $supplierData['name']; ?></div></td>
                      </tr>
                      <tr>
                        <td><div><?php echo $addressSupplierData['address']; ?> <?php echo getCityName($addressSupplierData['cityId']); ?> <?php echo getStateName($addressSupplierData['stateId']); ?> <?php echo getCountryName($addressSupplierData['countryId']); ?></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>State Code:</strong> <?php echo getStateName($addressSupplierData['stateId']);; ?></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>Pin Code:</strong> <?php echo $addressSupplierData['pinCode']; ?></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>GSTN:</strong> <?php echo $addressSupplierData['gstn']; ?></div></td>
                      </tr>
                    </table></td>
                  <td width="17%" valign="top"><table class="header-table">
                      <tr>
                        <td><div><strong>Supplier Code:</strong> <?php echo $supplierData['supplierId']; ?></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>Tel No:</strong> <?php echo $supplierData['phone']; ?></div></td>
                      </tr>
                      <tr>
                        <td><div><strong>Fax No:</strong> <?php echo $supplierData['phone']; ?></div></td>
                      </tr>
                    </table></td>
                  <td width="23%" valign="top"><table class="header-table">
                      <tr>
                        <td><div><strong>Purchase Order No:</strong> <?php echo $_GET['po']; ?> </div></td>
                      </tr>
                      <tr>
                        <td><div><strong>Purchase Order Date:</strong> <?php echo date('d-M-Y',strtotime($indentFieldsData['createdDate'])); ?> </div></td>
                      </tr>
                      <tr>
                        <td ><div style="margin-top: 5px;display:none;"><strong>PO Type:</strong>
                            <?php  echo $indentFieldsData['poTypeEntry'];  ?>
                          </div></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
<div class="btn-group justify-content-center" style="width: fit-content; float: left; padding: 10px 0px; margin: 0px; display: none;" id="deactivatebtnpurchasemerchant"> <a onclick="opmodalpop('Generate PO','modalpop.php?action=releasedpo&supplierId=<?php echo $_GET['supplierId']; ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="border-radius: 2px; background-color: #08ca94; margin: 0px !important; padding: 5px 10px; font-size: 12px; font-weight: 500;">Generate PO</a> </div>
                <div id="add_indentmpl">

              <table width="100%" class="table table-bordered table-responsive">
                <tr style="color:#FFFFFF;">
                        <td align="center"><input  name="materialCheckAll" type="checkbox" class="checkalldeletematerial" id="materialCheckAll" style="height: 17px;width: 50px;margin-top: 0;text-align: center;" /></td>
					<!--<td bgcolor="#333333"><div align="center"><strong>PO&nbsp;No</strong></div></td>-->

					<td bgcolor="#333333"><div align="center"><strong>Requisition&nbsp;No</strong></div></td>
					<td bgcolor="#333333"><div align="center"><strong>PO&nbsp;Type</strong></div></td>

					<td bgcolor="#333333"><strong>Material&nbsp;Name </strong></td>
					<td bgcolor="#333333"><strong>Requisition&nbsp;Type</strong></td>
					<td bgcolor="#333333" class="po1"><strong>Color</strong></td>
					<td bgcolor="#333333" class="po1"><strong>Size</strong></td>
					<td bgcolor="#333333" class="showdiv"><strong>Quantity</strong></td>
					<td bgcolor="#333333" class="showdiv"><strong>UOM</strong></td>
					<td width="9%" bgcolor="#333333" class="showdiv"><strong>Rate</strong></td>
					<td width="9%" bgcolor="#333333" class=""><strong>Value</strong></td>
					<td bgcolor="#333333" class="po1"><strong>Discount</strong></td>
					<td bgcolor="#333333" class="po1"><strong>CGST&nbsp;Rate</strong></td>
					<td bgcolor="#333333" class="po1"><strong>CGST&nbsp;Amount</strong></td>
					<td bgcolor="#333333" class="po1"><strong>SGST&nbsp;Rate</strong></td>
					<td bgcolor="#333333" class="po1"><strong>SGST&nbsp;Amount</strong></td>
					<td bgcolor="#333333" class="po1"><strong>IGST&nbsp;Rate</strong></td>
					<td bgcolor="#333333" class="po1"><strong>IGST&nbsp;Amount</strong></td>


                </tr>
                <?php
		  $sNo=0;
		  $finaltotalqty=0;
		  $totalgrossamount=0;
		   $rsListd=GetPageRecord('*',' loadmaintenance','1 and supplier="'.decode($_GET['supplier']).'"');
		  while($rsListDatad=mysqli_fetch_array($rsListd)){


		  $rsList=GetPageRecord('*',' maintenancegi_Master','1 and id="'.$rsListDatad['parentId'].'"');
		  $rsListData=mysqli_fetch_array($rsList);

		  $rsListee=GetPageRecord('*',' maintenancegeneral_Master','1 and id="'.$rsListDatad['item'].'"');
		  $rsListDataee=mysqli_fetch_array($rsListee);

		   $rss=GetPageRecord('*',' requisitionIndentMaster','1 and mainid="'.$rsListDatad['id'].'" and releasedpo!="1"');
		   while($rrr=mysqli_fetch_array($rss)){




		?>
                                            <tr style="border: 1px solid #ccc;">
                           <td align="center"><span class="analyselistclass">
                          <?php if($rrr['releasedpo']==''){ ?>
                          <input type="checkbox" style=" opacity:1; cursor: pointer; height: 17px; width: 50px; margin-top: 3px;" value="<?php echo $rrr['id']; ?>" name="analysemateriallistdelete[]" class="deletematerial" />
                          <?php } ?>
                          </span></td>
                                                                          <!--<td><?php echo $rrr['id']; ?>-->
                                                                          </td>

                          <td ><div align="center"><?php echo $rsListData['requisitionno']; ?></div></td>


                                            <td><?php echo $rrr['potype']; ?></td>

                                            <td ><div style=""><?php echo $rsListDataee['material']; ?></div></td>
                                            <td><?php if($rsListDatad['requisitiontype']==1){  echo 'Maintenance'; } else { echo 'General Iteam';  } ?>
                                            </td>
                                            <td class=""><?php echo $rsListDataee['color']; ?></td>
                                            <td class=""><?php echo $rsListDatad['size']; ?> </td>

                                            <?php

                                            ?>

                                            <td class=""><?php echo  $rrr['orderQty']; ?></td>
                                            <?php  ?>
                                            <td class=""><?php echo $rsListDatad['uom']; ?></td>
                                            <td class="">


                                            <?php
                                            $rsListeet=GetPageRecord('*',' requisitionIndentMaster','1 and mainid="'.$rsListDatad['id'].'"');
                                            $rsListDataeet=mysqli_fetch_array($rsListeet);


                                            echo  $rsListDataeet['sellingRate'];
                                            ?>
                                            </td>


                                            <td align="" class="">

                                            <?php
                                            $aa=$rrr['orderQty'];
                                            $bb=$rsListDataeet['sellingRate'];
                                            $calc=$aa*$bb;
                                            echo $calc;
                                            ?>
                                            </td>



                                            <td class=""></td>
                                            <td class=""></td>

                                            <td class=""></td>

                                            <td class=""></td>

                                            <td class=""></td>

                                            <td class=""></td>

                                            <td class=""></td>

                                            </tr>


		<?php }  } ?>

              </table>


             <script type="text/javascript">
		$(document).ready(function(){
		$("#materialCheckAll").click(function(){
		if(this.checked){
			$('.deletematerial').each(function(){
				this.checked = true;
			})
		}else{
			$('.deletematerial').each(function(){
				this.checked = false;
			})
		}
		});

		});
</script>

                  <script>
window.setInterval(function(){
      checked = $("#add_indentmpl input[type=checkbox]:checked").length;
      if(!checked) {
	  $("#deactivatebtnpurchasemerchant").hide();
      } else {
	  $("#deactivatebtnpurchasemerchant").show();
	  }
}, 100);
</script>
              <table width="100%" class=" ">
                <tbody>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table class="" cellpadding="10" cellspacing="0" width="100%" style="border:1px solid #ccc;">
                        <tr>
                          <td width="17%" valign="top" style="border: 1px solid #ccc; vertical-align: top;"><table class="header-table">
                              <tr>
                                <td><div style="margin-bottom: 5px;"><strong style="margin-right:19px;">Packing Details :</strong>
                                    <?php  echo $indentFieldsData['packingDetailEntry'];  ?>
                                  </div></td>
                              </tr>
                              <tr>
                                <td><div style="margin-bottom: 5px;"><strong>Mode Of Transport :</strong>
                                    <?php  echo $indentFieldsData['trasportDetailEntry'];  ?>
                                  </div></td>
                              </tr>
                              <tr>
                                <td><div style="margin-bottom: 5px;"><strong style="margin-right:5px;">Terms Of Delivery :</strong>
                                    <?php  echo $indentFieldsData['termsOfDelivery'];  ?>
                                  </div></td>
                              </tr>
                              <tr>
                                <td><div style="margin-bottom: 5px;"><strong style="margin-right:18px;">Payment Terms  :</strong>
                                    <?php  echo $indentFieldsData['paymentTerms'];  ?>
                                  </div></td>
                              </tr>
                            </table></td>
                          <td width="20%" valign="top" style="border: 1px solid #ccc; vertical-align: top;"><table class="header-table">
                              <tr>
                                <td><div><strong>Ship To</strong></div></td>
                              </tr>
                              <tr>
                                <td><div><?php echo $companyData['name']; ?></div></td>
                              </tr>
                              <tr>
                                <td><div><?php echo $addressData['address']; ?> <?php echo getCityName($addressData['cityId']); ?> <?php echo getStateName($addressData['stateId']); ?> <?php echo getCountryName($addressData['countryId']); ?></div></td>
                              </tr>
                              <tr>
                                <td><div><strong>State Code:</strong> <?php echo getStateName($addressData['stateId']);; ?></div></td>
                              </tr>
                              <tr>
                                <td><div><strong>Pin Code:</strong> <?php echo $addressData['pinCode']; ?></div></td>
                              </tr>
                              <tr>
                                <td><div><strong>GSTN:</strong> <?php echo $addressData['gstn']; ?></div></td>
                              </tr>
                            </table></td>
                          <td width="20%" style="border: 1px solid #ccc; vertical-align: top;"><table width="100%" cellpadding="5" cellspacing="0" class="spcial-class" style=" border-collapse: collapse;">
                              <tr>
                                <td><div align="right"><strong>Total Gross Amount</strong></div></td>
                                <td><div align="right"><?php echo $totalgrossamount; ?></div></td>
                              </tr>
                              <tr>
                                <td><div align="right"><strong>Total Discount </strong></div></td>
                                <td><div align="right">0.00</div></td>
                              </tr>
                              <tr>
                                <td><div align="right"><strong>Total CGST </strong></div></td>
                                <td><div align="right">0.00</div></td>
                              </tr>
                              <tr>
                                <td><div align="right"><strong>Total SGST </strong></div></td>
                                <td><div align="right">0.00</div></td>
                              </tr>
                              <tr>
                                <td><div align="right"><strong>Total IGST </strong></div></td>
                                <td><div align="right">0.00</div></td>
                              </tr>
                              <tr>
                                <td><div align="right"><strong>Total P &amp; F Amount </strong></div></td>
                                <td><div align="right">0.00</div></td>
                              </tr>
                              <tr>
                                <td><div align="right"><strong>Total Others </strong></div></td>
                                <td><div align="right">0.00</div></td>
                              </tr>
                            </table></td>
                        </tr>
                        <tr>
                          <td colspan="3"><div style=" text-transform:uppercase;"><strong>AMOUNT IN WORDS :
                              <?php
  /**
   * Created by PhpStorm.
   * User: sakthikarthi
   * Date: 9/22/14
   * Time: 11:26 AM
   * Converting Currency Numbers to words currency format
   */
$number =  $totalgrossamount;
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " .
          $words[$point = $point % 10] : '';
  echo $result . "Rupees  " . $points . " Paise";
 ?>
                              </strong></div></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table class="" cellpadding="10" cellspacing="0" width="100%" style="border:1px solid #ccc;">
                        <tr>
                          <td width="25%" valign="top" align="center" style="border: 1px solid #ccc; vertical-align: top;"><table class="header-table">
                              <tr>
                                <td align="center"><div style="margin-bottom: 5px;"><strong>Accepted By:</strong><br />
                                    <br />
                                  </div></td>
                              </tr>
                            </table></td>
                          <td width="25%" valign="top" align="center" style="border: 1px solid #ccc; vertical-align: top;"><table class="header-table">
                              <tr>
                                <td align="center"><div style="margin-bottom: 5px;"><strong>Prepared By: </strong> </div></td>
                              </tr>
                            </table></td>
                          <td width="25%" valign="top" align="center" style="border: 1px solid #ccc; vertical-align: top;"><table class="header-table">
                              <tr>
                                <td align="center"><div style="margin-bottom: 5px;"><strong>Verified By:</strong> </div></td>
                              </tr>
                            </table></td>
                          <td width="25%" valign="top" align="center" style="border: 1px solid #ccc; vertical-align: top;"><table class="header-table">
                              <tr>
                                <td align="center"><div style="margin-bottom: 5px;"><strong>Authorised Signatory:</strong> </div></td>
                              </tr>
                            </table></td>
                        </tr>
                      </table></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /dashboard content -->
  </div>
  <!-- /content area -->
  <!-- Footer -->
  <!-- /footer -->
</div>
<!-- /main content -->
</div>
<style>
 .liststyleimg{float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}

	.badge.dropdown-toggle:after { display:none;
}
.purchase-class tr td{
border:1px solid #ccc;

}


 </style>
<script>
$( function(){
	$("#appdate").datepicker();
} );
</script>
