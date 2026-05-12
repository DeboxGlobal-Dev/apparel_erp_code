<?php
 if($loginuserprofileId==1){

$wheresearchassign=' 1 and ';

} else {

$wheresearchassign=' ( assignTo in (select id from '._USER_MASTER_.' where  empId in (select id from employeeMaster where id ='.$_SESSION['empid'].')) or assignTo in (select id from '._USER_MASTER_.' where  empId in (select reportingTo from employeeMaster where id="'.$_SESSION['empid'].'"))) ';

$wheresearchassign=' '.$wheresearchassign.' and ';

}?>

<div class="page-content">
  <style>
.even{
background-color: #0097a71a;
}
.erpint{
  border:1px solid #928989;
  padding:2px;
}
.intable td{
  border:none!important;
}
.intable3 td{
  border:none!important;
}
.intable3{
  border:1px solid #ccc!important;
}

.intable2 td{
  border:none!important;
  padding: 12px 20px 0px;
}
.intable1 td{
  border-top:none!important;
  border-bottom:  none!important;
}
</style>

    <?php




if($_GET['id']!=''){

$rs=GetPageRecord('*','innvoiceMaster','id="'.decode($_GET['id']).'"');
$editresult=mysqli_fetch_array($rs);
$gateLastId = $editresult['id'];
}
if($_GET['pid']!=''){
$rss=GetPageRecord('*','packinglistMaster','id="'.decode($_GET['pid']).'"');
$rsListing=mysqli_fetch_array($rss);
}

    $s=decode($_REQUEST['s']);
    $k=GetPageRecord('*','queryMaster','1 and id="'.$s.'"');
    $styleData=mysqli_fetch_array($k);

    ?>
  <div class="content-wrapper">
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
            <div class="col-xl-9">
              <h5 class="card-title"><?php echo $pageName; ?></h5>

            </div>
            <div class="col-xl-3" style="padding-right: 0px;">
              <div class="btn-group justify-content-center" style="float:right;">

        <a href="showpage.crm?module=<?php echo $_GET['module']; ?>"><button type="button" class="btn bg-grey-400 btn-labeled btn-labeled-right ml-auto" style="    background-color: #afbbc2 !important;"><b style="background-color: #afbbc2; padding: 9px;"><i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 17px;"></i></b>Back</button></a>

        <?php if($rsListing['status']==1 || $rsListing['status']==2){ ?>
        <a onclick="opmodalpop('Proforma/Invoice','modalpop.php?action=proformainvoice&module=<?php echo $_GET['module']; ?>&id=<?php echo $_REQUEST['s']; ?>&pid=<?php echo $_REQUEST['pid']; ?>&inid=<?php echo $_REQUEST['id']; ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400 addnotify" style="background-color: #03d873b8; margin:0px;" target="_blank"><i class="fa fa-print" aria-hidden="true" style="margin-right:5px;" ></i>Generate&nbsp;Proforma/Invoice</a>
        <?php }else{ ?>
        <div class="btn bg-teal-400 addnotify" style="background-color: #43c86e;"><i class="fa fa-check" aria-hidden="true" style="margin-right:2px;"></i>Generated</div>
        <?php } ?>
        </div>

            </div>
          </div>
          <div class="card">

       <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
          <input name="action" type="hidden" id="action" value="innvoice" />
          <input name="editId" type="hidden" id="editId" value="<?php echo encode($gateLastId); ?>">
          <input name="packingId" type="hidden" id="packingId" value="<?php echo $_GET['pid']; ?>">
          <input name="parentId" type="hidden" id="parentId" value="<?php echo $_GET['id']; ?>">
          <input name="invoiceno" type="hidden" id="invoiceno" value="<?php echo $rsListing['invoiceNo']; ?>">


<table cellpadding="0" cellspacing="0" width="100%" class="table" style="font-size:14px;">
<tr>
<td align="center" colspan="2"><strong>EXPORT INVOICE</strong></td>
</tr>
<tr>
<td align="center" colspan="2"><strong>SUPPLY MEANT FOR EXPORT UNDER BOND WITHOUT PAYMENT OF IGST</strong></td>
</tr>
<tr>

<td align="left" valign="top" style="width: 50%;border-bottom:0px !important;line-height: 24px"><strong>Exporter Address</strong><br>

<textarea  rows="4" cols="40" style="border:1px solid #928989;" name="eaddress"><?php echo $editresult['eaddress']; ?></textarea>

</td>

<td align="left" valign="top" style="padding: 0px">

   <table width="100%">
<thead>
  <tr>
    <th style="font-weight: 400" colspan="2">GST Invoice No & Dt<br>
<input style="width:30%" type="text" name="gstno" value="<?php echo $editresult['gstno']; ?>" class="erpint"> Date - <input style="width: 22%" value="<?php echo $editresult['gstdate']; ?>"type="date" name="gstdate" class="erpint">
    </th>
  </tr>
</thead>
<tbody>
  <tr>
    <td style="border-left: none!important">Cargo Reference No<br>
<input style="width:30%" type="text" name="cargono"value="<?php echo $editresult['cargono']; ?>" class="erpint" > Date - <input style="width: 36%" type="date" value="<?php echo $editresult['cargodate']; ?>" name="cargodate" class="erpint"></td>
    <td>Exporter's Reference<br>
<input type="text" name="ereference" class="erpint" value="<?php echo $editresult['ereference']; ?>"></td>
  </tr>
  <tr>
    <?php
      $rss=GetPageRecord('*','poManageMaster','1 and id="'.$rsListing['purchaseNo'].'"');
      $ponumber=mysqli_fetch_array($rss);
?>
    <td style="border-left: none!important">Buyer Po No. - <input type="text" name="buyerpo" class="erpint" value="<?php echo $ponumber['poNumber']; ?>" readonly></td>
    <td rowspan="0" style="border-bottom: none!important"></td>
  </tr>
  <tr>
    <td style="border-left: none!important;border-bottom: none!important">Style No. -
<?php
        $rs=GetPageRecord($select,'queryMaster','1 and id="'.$rsListing['styleId'].'"');
       $resultStyle=mysqli_fetch_array($rs); ?>
<input type="text" name="styleId" class="erpint" value="<?php echo $resultStyle['styleRefId']; ?>" readonly>
</td>
  </tr>
</tbody>
</table>

</td>
</tr>
<tr>
  <td align="left" valign="top" style="border-bottom:0px !important;line-height: 24px"><strong>Manufacturer Address</strong><br />

  <textarea  rows="4" cols="40" style="border:1px solid #928989;" name="maddress"><?php echo $editresult['maddress']; ?></textarea>
  </td>

 <td align="left" valign="top" style="border-bottom:0px !important;line-height: 24px">Buyer : if other than consignee<br><strong>FOR THE ACCOUNT AND RISK OF THE </strong>
  <br />
  <textarea  rows="4" cols="40" style="border:1px solid #928989;" name="exaddress"> <?php echo $editresult['exaddress']; ?></textarea>
 </td>
</tr>

<tr>
  <td style="padding: 0px">
    <table width="100%">
      <tr>
        <td style="line-height: 24px;border-top: none!important;border-right: none!important;border-left: none!important;" colspan="2">Consignee<br>
          <textarea style="border:1px solid #928989;" rows="2" cols="40" name="consignee" readonly><?php echo $rsListing['consignee']; ?></textarea></td>
      </tr>
      <tr>
        <td style="border-left: none!important;">Pre Carriage By<br><input type="text" name="precarriage" class="erpint" value="<?php echo $editresult['precarriage']; ?>"></td>
        <td style="border-right: none!important;">Mode by Ship<br><input type="text" name="shipmode" class="erpint" value="<?php echo $editresult['shipmode']; ?>"></td>
      </tr>
      <tr>
       <td style="border-left: none!important;">Vessel/Flight No/Mode<br><input type="text" name="flightno" class="erpint" value="<?php echo $editresult['flightno']; ?>"></td>
        <td style="border-right: none!important;">Port of Landing<br><input type="text" name="portland" class="erpint" value="<?php echo $editresult['portland']; ?>"></td>
      </tr>
      <tr>
        <td style="border-bottom: none!important;border-left: none!important;">Port of Discharge<br><input type="text" name="portdischarge" class="erpint" value="<?php echo $editresult['postdischarge']; ?>"></td>
        <td style="border-right: none!important;border-bottom: none!important;">Final Destination<br><input type="text" name="fdestination" class="erpint" value="<?php echo $editresult['fdestination']; ?>"></td>
      </tr>
    </table>
  </td>

  <td style="padding: 0px">
    <table width="100%">
      <tr>
        <td valign="top" style="border-top: none!important;border-right: none!important;border-left: none!important;" colspan="2"> Other Reference : <input type="text" class="erpint" name="oreference" value="<?php echo $editresult['oreference']; ?>"></td>
      </tr>
      <tr>
        <td style="border-left: none!important;">Country of Origin of Goods <br> <input type="text" class="erpint" name="countrygoods" value="<?php echo $editresult['countrygoods']; ?>"></td>
        <td style="border-right: none!important;">Country of Final Destination/Place of supply <br> <input type="text" class="erpint" name="countryfinal" value="<?php echo $editresult['countryfinal']; ?>"></td>
      </tr>
      <tr>
        <td style="line-height: 24px;border: none!important;" colspan="2">
          Terms of Delivery and Payment<br><strong>PAYMENT TERMS - <input style="width: 15%" type="text" class="erpint" name="pterms" value="<?php echo $editresult['pterms']; ?>"></strong>
  <br /><strong>GST APPLICABLE ON REVERSE CHARGE -
    <select style="border:1px solid #928989;padding:3px;width: 13%" id="" name="reversecharge" value="<?php echo $editresult['reversecharge']; ?>">
      <option>Select</option>
      <option value="1" <?php if($editresult['reversecharge']=='1'){ echo 'selected'; } ?>>YES</option>
      <option value="2" <?php if($editresult['reversecharge']=='2'){ echo 'selected'; } ?>>NO</option>
    </select></strong><br><br><strong>
    AD CODE - <input style="width: 15%" type="text" class="erpint" name="adcode" value="<?php echo $editresult['adcode']; ?>">
  </strong>
        </td>
      </tr>
</table>
</td>
</tr>
</table>
<table cellpadding="0" cellspacing="0" width="100%" class="table intable1" style="font-size:14px;">
  <tr>
    <td style="padding: 0px;width: 70%">
      <table class="intable" width="100%">
        <tr>
          <td style="text-transform: uppercase;text-align: center;"><strong>CTN No.</strong></td>
          <td align="center" style="text-transform: uppercase;"><strong>Description</strong></td>
          <td style="text-transform: uppercase;" ><strong>Style#</strong></td>
          <td style="text-transform: uppercase;"><strong>Color</strong></td>
        </tr>
      </table>
    </td>
     <td>Quantity <br><strong>(PCS)</strong></td>
    <td>Rate<br><strong>&nbsp; </strong></td>
    <td>Amount<br><strong>&nbsp;</strong></td>
  </tr>
  <?php
  $i='0';
  $newdata = explode(',', $editresult['amount']);
$rrp=GetPageRecord('*','loadpackinglistmaster','parentId="'.decode($_GET['pid']).'"');
                while($operation1=mysqli_fetch_array($rrp)) {
?>
    <tr>
    <td style="padding: 0px;width: 70%">
      <table class="intable" width="100%">
        <tr>
        <td><input style="width: 100%;" class="erpint" value="From <?php echo $operation1['containfrom'] ?> to <?php echo $operation1['containto'] ?>" readonly></td>
       <td><input style="width: 100%;" class="erpint" value="<?php echo $resultStyle['subject']; ?>" readonly></td>
      <td><input style="width: 100%;" class="erpint" value="#<?php echo $resultStyle['styleRefId']; ?>" readonly></td>
      <td><input style="width: 100%;" class="erpint" value="<?php echo $operation1['colour'] ?>" readonly></td>
        </tr>
      </table>
    </td>
    <td><input style="width: 100%;" class="erpint" id="qty<?php echo $i; ?>" value="<?php echo $operation1['totalqty'] ?>" readonly></td>
    <td><input style="width: 100%;" id="rate<?php echo $i; ?>" class="erpint" onkeyup="changeprice<?php echo $i; ?>()" value="<?php echo $newdata[$i]; ?>" name="amount[]"></td>
    <td><input style="width: 100%;" class="price" id="price<?php echo $i; ?>" readonly></td>
  </tr>

  <script type="text/javascript">
  changeprice<?php echo $i; ?>();
   function changeprice<?php echo $i; ?>(){
  var rate = $('#rate<?php echo $i; ?>').val();
  var qty = $('#qty<?php echo $i; ?>').val();
  var price = Number(rate*qty);
  $('#price<?php echo $i; ?>').val(price);

 var lclasssum=0;
$('.price').each(function() {
        lclasssum += Number($(this).val());
});
lclasssum= parseFloat(lclasssum).toFixed(2);
$('#myprice').text(lclasssum);

  }
  </script>
<?php $i++;  } ?>
</table>
<table cellpadding="0" cellspacing="0" width="100%" class="table intable1" style="font-size:14px;">
  <tr>
    <th style="width:70%;padding: 0px;border-left: 1px solid #ccc">
      <table class="intable2" width="100%">
        <tr>
          <td style="width: 50%"><strong>State Code List <br> <input style="width: 34%" type="text" class="erpint" name="sclist" value="<?php echo $editresult['sclist'] ?>"></strong></td>
          <td><strong>HSN NO <br> <input style="width: 34%" type="text" class="erpint" name="hsnno" value="<?php echo $editresult['hsnno'] ?>"></strong></td>
        </tr>
      </table>
    </th>
    <th style="border-left:1px solid #ccc;border-right:1px solid #ccc" rowspan="5"></th>
    <th style="border-left:1px solid #ccc;border-right:1px solid #ccc" rowspan="5"></th>
    <th style="border-left:1px solid #ccc;border-right:1px solid #ccc" rowspan="5"></th>
  </tr>
  <tr>
    <td style="width: 70%;padding: 0px">
      <table class="intable2" width="100%">
        <tr>
          <td style="width: 50%"><strong>District Code List <br> <input style="width: 34%" type="text" class="erpint" name="dclist" value="<?php echo $editresult['dclist']; ?>"></strong></td>
          <td><strong>SCHEME CODE <br>  <input style="width: 34%" type="text" class="erpint" name="schemecode" value="<?php echo $editresult['schemecode']; ?>"></strong></td>
        </tr>
      </table>
    </td>
  </tr>

   <tr>
    <td style="width: 70%;padding: 0px">
      <table class="intable2" width="100%">
        <tr>
          <td style="width: 50%"><strong>SQC <br> <input style="width: 34%" type="text" class="erpint" name="sqc" value="<?php echo $editresult['sqc']; ?>"></strong></td>
          <td><strong>DBK SR. <br> <input style="width: 34%" type="text" class="erpint" name="dbk" value="<?php echo $editresult['dbk']; ?>"></strong></td>
        </tr>
      </table>
    </td>
  </tr>
   <tr>
    <td style="width: 70%;padding: 0px">
      <table class="intable2" width="100%">
        <tr>
          <td style="width: 50%"><strong>FTA/PTA CODE LIST <br> <input style="width: 34%" type="text" class="erpint" name="fta" value="<?php echo $editresult['fta']; ?>"></strong></td>
          <td><strong>END USED CODE <br> <input style="width: 34%" type="text" class="erpint" name="usedcode" value="<?php echo $editresult['usedcode']; ?>"> </strong></td>
        </tr>
      </table>
    </td>
  </tr>
   <tr>
    <td style="width: 70%;padding: 0px">
      <table class="intable2" width="100%">
        <tr>
          <td style="width: 50%;padding-bottom: 20px!important"><strong>GST CESS DETAILS <br> <input style="width: 34%" type="text" class="erpint" name="gstcess" value="<?php echo $editresult['gstcess']; ?>"></strong></td>
          <td><strong></strong></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<table cellpadding="0" cellspacing="0" width="100%" class="table" style="font-size:14px;">
  <tr>
    <th style="width:70%;padding: 0px;">
      <table width="100%">
        <tr>
        <td>Rate/PC<br><input style="width: 100%" type="text" class="erpint" name="rate" value="<?php echo $editresult['rate']; ?>"></td>
        <td>IGST @<br><input style="width: 100%" type="" class="erpint" name="igst" value="<?php echo $editresult['igst']; ?>"></td>
        <td>INV VALUE@RS.<br><input style="width: 100%" type="text" class="erpint" name="inv" value="<?php echo $editresult['inv']; ?>"></td>
        <td>IGST AMT. @ RS.<br><input style="width: 100%" type="text" class="erpint" name="igstamount" value="<?php echo $editresult['igstamount']; ?>"></td>
        <td style="border-right: none!important">TTL INV VALUE @ RS.<br><input style="width: 100%" type="text" class="erpint" name="ttlamount" value="<?php echo $editresult['ttlamount']; ?>"></td>
        </tr>
      </table>
    </th>
    <th style="border-left:1px solid #ccc;border-right:1px solid #ccc" rowspan="2"></th>
    <th style="width:10%;border-left:1px solid #ccc;border-right:1px solid #ccc;border-bottom: 1px solid #ccc" rowspan="3"></th>
    <th style="border-left:1px solid #ccc;border-right:1px solid #ccc"></th>
  </tr>
  <tr>
    <td style="width:70%;padding: 0px;">
      <table width="100%" class="intable">
        <tr>
        <td colspan="5" style="color: red" align="center"><strong>UNDER LUT</strong></td>
        </tr>
      </table>
    </td>
    <td style="border-left:1px solid #ccc;border-right:1px solid #ccc"></td>
  </tr>
  <tr>
    <td style="width:70%;padding: 0px;">
      <table width="100%" class="intable">
        <tr>
        <td colspan="3" align="left"><strong>EXCHANGE RATE @ RS : <input style="width: 17%" type="text" class="erpint" name="exrate" value="<?php echo $editresult['exrate']; ?>"></strong></td>
        <td colspan="2" align="right"><strong>TOTAL QUANTITY</strong></td>
        </tr>
      </table>
    </td>
    <td style="border-left:1px solid #ccc;border-right:1px solid #ccc;">
  <?php
$rrp=GetPageRecord('SUM(totalqty) as totalquantity,SUM(contno) as totalcontainer,SUM(gwt) as totalgwt,SUM(net_wt) as totalnetwt,SUM(nnwt) as totalnnwt','loadpackinglistmaster','parentId="'.decode($_GET['pid']).'"');
            $operation2=mysqli_fetch_array($rrp);
?>
      <input style="width: 100%" type="text" class="erpint" value="<?php echo $operation2['totalquantity'] ?>" readonly>

    </td>
    <td style="border-left:1px solid #ccc;border-right:1px solid #ccc;"><input style="width: 100%" type="text" class="erpint" name="totalamount" value="<?php echo $editresult['totalamount'] ?>" id="myprice" readonly=""></td>
  </tr>
</table>
<table width="100%" class="table intable3" style="border-bottom: none!important">
  <tr>
    <td colspan="3"><strong>TOTAL USD : </strong>
<?php
$number =  $editresult['totalamount'];
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
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
 ?>
      <input class="erpint" style="width: 50%" type="text" value="<?php echo $result . "Rupees  " . $points . " Paise"; ?>"></td>
  </tr>
  <tr>
    <td><strong>CTNS : </strong></td>
    <td><input type="text" class="erpint" style="width: 60%" name="ctns" value="<?php echo $operation2['totalcontainer']; ?>"></td>
    <td style="width: 60%"></td>
  </tr>
   <tr>
    <td><strong>GR : </strong></td>
    <td><input type="text" class="erpint" style="width: 60%" name="gr" value="<?php echo round($operation2['totalgwt'],3); ?>"></td>
    <td style="width: 60%"></td>
  </tr>
   <tr>
    <td><strong>NT WT. : </strong></td>
    <td><input type="text" class="erpint" style="width: 60%" name="netweight" value="<?php echo round($operation2['totalnetwt'],3); ?>"></td>
    <td style="width: 60%"></td>
  </tr>
   <tr>
    <td><strong>N NT WT. : </strong></td>
    <td><input type="text" class="erpint" style="width: 60%" name="nnetweight" value="<?php echo round($operation2['totalnnwt'],3); ?>"></td>
    <td style="width: 60%"></td>
  </tr>
   <tr>
    <td><strong>CBM : </strong></td>
    <td><input type="text" class="erpint" style="width: 60%" name="cbm" value="<?php echo $editresult['cbm']; ?>"></td>
    <td style="width: 60%"></td>
  </tr>
</table>
<div>
<table width="100%" class="table intable3" style="border-top: none!important;border-bottom: none!important">
  <tr>
<td><strong>DIMENSIONS</strong></td>
</tr>
<tr>
    <td>Length</td>
    <td>Width</td>
    <td>Height</td>
    <td>No. of CTN</td>
    <td style="width: 60%"></td>
    </tr>
<?php
$rrp=GetPageRecord('length,breadth,height,SUM(contNo) AS totalctn','loadpackinglistmaster','parentId="'.decode($_GET['pid']).'" group by length,breadth,height');
                while($operation=mysqli_fetch_array($rrp)) {
?>
<tr>
    <td><input type="text" class="erpint" style="width: 90%" value="<?php echo $operation['length'] ?>" readonly></td>
    <td><input type="text" class="erpint" style="width: 90%" value="<?php echo $operation['breadth'] ?>" readonly></td>
    <td><input type="text" class="erpint" style="width: 90%" value="<?php echo $operation['height'] ?>" readonly></td>
    <td><input type="text" class="erpint" style="width: 90%" value="<?php echo $operation['totalctn'] ?>" readonly></td>
    <td style="width: 60%"></td>
    </tr>
  <?php } ?>
</table>

<table width="100%" class="table intable3" style="border-top: none!important;">
   <tr>
    <td><strong>Declaration<br>We declare that this invoice shows the actual price of goods described and that all particulars are true and correct.</strong></td>
  </tr>
</table>
<br>
            <button type="submit" class="btn btn-primary" style="float:right;margin-bottom:10px;">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>
<br>
      </div>
      </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<style>
table tr td{
border:1px solid #ccc !important;
}
</style>
