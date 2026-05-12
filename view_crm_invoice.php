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

        <?php if($styleData['invoiceType']==0){ ?>
        <a onclick="opmodalpop('Proforma/Invoice','modalpop.php?action=proformainvoice&module=<?php echo $_GET['module']; ?>&id=<?php echo $_REQUEST['s']; ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400 addnotify" style="background-color: #03d873b8; margin:0px;" target="_blank"><i class="fa fa-print" aria-hidden="true" style="margin-right:5px;" ></i>Generate&nbsp;Proforma/Invoice</a>
        <?php }else{ ?>
        <div class="btn bg-teal-400 addnotify" style="background-color: #43c86e;"><i class="fa fa-check" aria-hidden="true" style="margin-right:2px;"></i>Generated</div>
        <?php } ?>
        </div>

            </div>
          </div>
          <div class="card">


<table cellpadding="0" cellspacing="0" width="100%" class="table" style="font-size:14px;">
<tr>
<td align="center" colspan="2"><strong>EXPORT INVOICE</strong></td>
</tr>
<tr>
<td align="center" colspan="2"><strong>SUPPLY MEANT FOR EXPORT UNDER BOND WITHOUT PAYMENT OF IGST</strong></td>
</tr>
<tr>

<td align="left" valign="top" style="width: 50%;border-bottom:0px !important;line-height: 24px"><strong>Exporter Address</strong><br>
  <select style="border:1px solid #928989;padding:4px;width: 40%" id="factoryId" name="factoryId">
                      <option value="">Select Factory</option>
                      <?php
                      $rs=GetPageRecord($select,'factoryMaster','1 and deletestatus=0 order by id asc');
                      while($resultStyle=mysqli_fetch_array($rs)){
                      ?>
                      <option value="<?php echo encode($resultStyle['id']); ?>"><?php echo $resultStyle['name']; ?></option>
                      <?php } ?>
                    </select>
</td>

<td align="left" valign="top" style="padding: 0px">

   <table width="100%">
<thead>
  <tr>
    <th style="font-weight: 400" colspan="2">GST Invoice No & Dt<br>
<input style="width:30%" type="text" name="" class="erpint"> Date - <input style="width: 22%" type="date" name="" class="erpint">
    </th>
  </tr>
</thead>
<tbody>
  <tr>
    <td style="border-left: none!important">Cargo Reference No<br>
<input style="width:30%" type="text" name="" class="erpint"> Date - <input style="width: 36%" type="date" name="" class="erpint"></td>
    <td>Exporter's Reference<br>
<input type="text" name="" class="erpint"></td>
  </tr>
  <tr>
    <td style="border-left: none!important">Buyer Po No. - <input type="text" name="" class="erpint"></td>
    <td rowspan="0" style="border-bottom: none!important"></td>
  </tr>
  <tr>
    <td style="border-left: none!important;border-bottom: none!important">Style No. - <select style="border:1px solid #928989;padding:4px;width: 40%" id="styleId" name="styleId">
                      <option value="">Select Style</option>
                      <?php
                      $styleId = decode($_GET['styleid']);
                      $rs=GetPageRecord($select,'queryMaster','1 and deletestatus=0 and subject!="" order by id asc');
                      while($resultStyle=mysqli_fetch_array($rs)){
                      ?>
                      <option value="<?php echo encode($resultStyle['id']); ?>" <?php if($styleId==$resultStyle['id']){ echo 'selected'; } ?>><?php echo '#'.$resultStyle['styleRefId']; ?></option>
                      <?php } ?>
                    </select></td>
  </tr>
</tbody>
</table>

</td>
</tr>
<tr>
  <td align="left" valign="top" style="border-bottom:0px !important;line-height: 24px"><strong>Manufacturer Address</strong><br />
<select style="border:1px solid #928989;padding:4px;width: 40%" id="factoryId1" name="factoryId1">
                      <option value="">Select Factory</option>
                      <?php
                      $rs=GetPageRecord($select,'factoryMaster','1 and deletestatus=0 order by id asc');
                      while($resultStyle=mysqli_fetch_array($rs)){
                      ?>
                      <option value="<?php echo encode($resultStyle['id']); ?>"><?php echo $resultStyle['name']; ?></option>
                      <?php } ?>
                    </select></td>
 <td align="left" valign="top" style="border-bottom:0px !important;line-height: 24px">Buyer : if other than consignee<br><strong>FOR THE ACCOUNT AND RISK OF THE </strong>
  <br /><textarea  rows="4" cols="40" style="border:1px solid #928989;"> </textarea></td>
</tr>

<tr>
  <td style="padding: 0px">
    <table width="100%">
      <tr>
        <td style="line-height: 24px;border-top: none!important;border-right: none!important;border-left: none!important;" colspan="2">Consignee<br><textarea style="border:1px solid #928989;"  rows="2" cols="40"></textarea></td>
      </tr>
      <tr>
        <td style="border-left: none!important;">Pre Carriage By<br><input type="text" name="" class="erpint"></td>
        <td style="border-right: none!important;">Mode by Ship<br><input type="text" name="" class="erpint"></td>
      </tr>
      <tr>
       <td style="border-left: none!important;">Vessel/Flight No/Mode<br><input type="text" name="" class="erpint"></td>
        <td style="border-right: none!important;">Port of Landing<br><input type="text" name="" class="erpint"></td>
      </tr>
      <tr>
        <td style="border-bottom: none!important;border-left: none!important;">Port of Discharge<br><input type="text" name="" class="erpint"></td>
        <td style="border-right: none!important;border-bottom: none!important;">Final Destination<br><input type="text" name="" class="erpint"></td>
      </tr>
    </table>
  </td>

  <td style="padding: 0px">
    <table width="100%">
      <tr>
        <td valign="top" style="border-top: none!important;border-right: none!important;border-left: none!important;" colspan="2"> Other Reference : <input type="text" class="erpint" name=""></td>
      </tr>
      <tr>
        <td style="border-left: none!important;">Country of Origin of Goods <br> <input type="text" class="erpint" name=""></td>
        <td style="border-right: none!important;">Country of Final Destination/Place of supply <br> <input type="text" class="erpint" name=""></td>
      </tr>
      <tr>
        <td style="line-height: 24px;border: none!important;" colspan="2">
          Terms of Delivery and Payment<br><strong>PAYMENT TERMS - <input style="width: 15%" type="text" class="erpint" name=""></strong>
  <br /><strong>GST APPLICABLE ON REVERSE CHARGE -
    <select style="border:1px solid #928989;padding:3px;width: 13%" id="" name="">
      <option>Select</option>
      <option value="1">YES</option>
      <option value="2">NO</option>
    </select></strong><br><br><strong>
    AD CODE - <input style="width: 15%" type="text" class="erpint" name="">
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
          <td style="text-transform: uppercase;text-align: center;"><strong>Mark & no.</strong></td>
          <td style="text-transform: uppercase;width: 21%" ><strong>kind of pckgs</strong></td>
          <td style="text-transform: uppercase;width: 22%"><strong>Description</strong></td>
          <td style="text-transform: uppercase;" ><strong>Style#</strong></td>
          <td  style="text-transform: uppercase;"><strong>Color</strong></td>
        </tr>
      </table>
    </td>
     <td>Quantity <br><strong>(PCS)</strong></td>
    <td>Rate<br><strong>FCS USD</strong></td>
    <td>Amount<br><strong>FCS USD </strong></td>
  </tr>
   <?php
          $addno=1;
          $addno1=1;
          ?>
            <tr id="partyAddrsId<?php echo $addno; ?>">
    <td style="padding: 0px;width: 70%">
      <table class="intable" width="100%">
        <tr>
          <td><?php if($addno==1){ ?>
                <i class="fa fa-plus" onclick="addPartyAdd();" style="cursor: pointer;border: 1px solid black;border-radius: 44%;padding: 3px;"></i>
                <?php } else { ?>
                <i class="fa fa-trash" onclick="removeAddInfo(<?php echo $addno; ?>);" style="cursor: pointer;border: 1px solid black;border-radius: 44%;padding: 3px;"></i>
                <?php } ?>&nbsp;&nbsp;<input style="width:66%" type="text" class="erpint" name=""></td>
          <td><input style="width:100%" type="text" class="erpint" name=""></td>
          <td><input style="width:100%" type="text" class="erpint" name=""></td>
          <td><input style="width:100%" type="text" class="erpint" name=""></td>
          <td><input style="width:100%" type="text" class="erpint" name=""></td>
        </tr>
      </table>
    </td>
    <td><input style="width: 100%" type="number" class="erpint" name=""></td>
    <td><input style="width: 100%" type="number" class="erpint" name=""></td>
    <td><input style="width: 100%" type="number" class="erpint" name=""></td>
  </tr>
<tr id="loadpartyaddress">

</tr>
</table>
<table cellpadding="0" cellspacing="0" width="100%" class="table intable1" style="font-size:14px;">
  <tr>
    <th style="width:70%;padding: 0px;border-left: 1px solid #ccc">
      <table class="intable2" width="100%">
        <tr>
          <td style="width: 50%"><strong>State Code List <br> <input style="width: 34%" type="text" class="erpint" name=""></strong></td>
          <td><strong>HSN NO <br> <input style="width: 34%" type="text" class="erpint" name=""></strong></td>
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
          <td style="width: 50%"><strong>District Code List <br> <input style="width: 34%" type="text" class="erpint" name=""></strong></td>
          <td><strong>SCHEME CODE <br>  <input style="width: 34%" type="text" class="erpint" name=""></strong></td>
        </tr>
      </table>
    </td>
  </tr>

   <tr>
    <td style="width: 70%;padding: 0px">
      <table class="intable2" width="100%">
        <tr>
          <td style="width: 50%"><strong>SQC <br> <input style="width: 34%" type="text" class="erpint" name=""></strong></td>
          <td><strong>DBK SR. <br> <input style="width: 34%" type="text" class="erpint" name=""></strong></td>
        </tr>
      </table>
    </td>
  </tr>
   <tr>
    <td style="width: 70%;padding: 0px">
      <table class="intable2" width="100%">
        <tr>
          <td style="width: 50%"><strong>FTA/PTA CODE LIST <br> <input style="width: 34%" type="text" class="erpint" name=""></strong></td>
          <td><strong>END USED CODE <br> <input style="width: 34%" type="text" class="erpint" name=""> </strong></td>
        </tr>
      </table>
    </td>
  </tr>
   <tr>
    <td style="width: 70%;padding: 0px">
      <table class="intable2" width="100%">
        <tr>
          <td style="width: 50%;padding-bottom: 20px!important"><strong>GST CESS DETAILS <br> <input style="width: 34%" type="text" class="erpint" name=""></strong></td>
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
        <td>Rate/PC<br><input style="width: 100%" type="text" class="erpint" name=""></td>
        <td>IGST @<br><input style="width: 100%" type="" class="erpint" name="text"></td>
        <td>INV VALUE@RS.<br><input style="width: 100%" type="text" class="erpint" name=""></td>
        <td>IGST AMT. @ RS.<br><input style="width: 100%" type="text" class="erpint" name=""></td>
        <td style="border-right: none!important">TTL INV VALUE @ RS.<br><input style="width: 100%" type="text" class="erpint" name=""></td>
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
        <td colspan="3" align="left"><strong>EXCHANGE RATE @ RS : <input style="width: 17%" type="text" class="erpint" name=""></strong></td>
        <td colspan="2" align="right"><strong>TOTAL QUANTITY</strong></td>
        </tr>
      </table>
    </td>
    <td style="border-left:1px solid #ccc;border-right:1px solid #ccc;"><input style="width: 100%" type="text" class="erpint" name=""></td>
    <td style="border-left:1px solid #ccc;border-right:1px solid #ccc;"><input style="width: 100%" type="text" class="erpint" name=""></td>
  </tr>
</table>
<table width="100%" class="table intable3" style="border-bottom: none!important">
  <tr>
    <td colspan="3"><strong>TOTAL USD : </strong><input class="erpint" style="width: 50%" type="text" name=""></td>
  </tr>
  <tr>
    <td><strong>CTNS : </strong></td>
    <td><input type="text" class="erpint" style="width: 60%" name=""></td>
    <td style="width: 60%"></td>
  </tr>
   <tr>
    <td><strong>GR : </strong></td>
    <td><input type="text" class="erpint" style="width: 60%" name=""></td>
    <td style="width: 60%"></td>
  </tr>
   <tr>
    <td><strong>NT WT. : </strong></td>
    <td><input type="text" class="erpint" style="width: 60%" name=""></td>
    <td style="width: 60%"></td>
  </tr>
   <tr>
    <td><strong>N NT WT. : </strong></td>
    <td><input type="text" class="erpint" style="width: 60%" name=""></td>
    <td style="width: 60%"></td>
  </tr>
   <tr>
    <td><strong>CBM : </strong></td>
    <td><input type="text" class="erpint" style="width: 60%" name=""></td>
    <td style="width: 60%"></td>
  </tr>
</table>
<div>
<table width="100%" class="table intable3" style="border-top: none!important;border-bottom: none!important">
  <tr id="partyAddrsId1<?php echo $addno; ?>">
<td><strong>DIMENSIONS</strong></td>
    <td><?php if($addno1==1){ ?>
  <i class="fa fa-plus" onclick="addPartyAdd1();" style="cursor: pointer;border: 1px solid black;border-radius: 44%;padding: 3px;"></i><?php } else { ?><i class="fa fa-trash" onclick="removeAddInfo1(<?php echo $addno; ?>);" style="cursor: pointer;border: 1px solid black;border-radius: 44%;padding: 3px;"></i><?php } ?></td>
    <td><input type="text" class="erpint" style="width: 90%" name=""></td>
    <td><input type="text" class="erpint" style="width: 90%" name=""></td>
    <td><input type="text" class="erpint" style="width: 90%" name=""></td>
    <td><input type="text" class="erpint" style="width: 90%"  name=""></td>
    <td style="width: 50%"></td>
    </tr>
</table>
</div>
<div id="loadpartyaddress1">
</div>
<table width="100%" class="table intable3" style="border-top: none!important;">
   <tr>
    <td><strong>Declaration<br>We declare that this invoice shows the actual price of goods described and that all particulars are true and correct.</strong></td>
  </tr>
</table>
<!-- code -->

<input name="addcount" type="hidden" id="addcount" value="<?php if($addno==1){ echo '1'; } else { echo $addno; } ?>" />
<input name="addcount1" type="hidden" id="addcount1" value="<?php if($addno1==1){ echo '1'; } else { echo $addno1; } ?>" />
           <script>
           function addPartyAdd(){
           var addcount = $('#addcount').val();
           //alert(empcount);
           addcount=Number(addcount)+1;
           $.get("loadinvoice.php?id="+addcount+"&action=style", function (data) {
          $("#loadpartyaddress").append(data);
          });
            $('#addcount').val(addcount);
           $
           }

           function removeAddInfo(id){
           $('#partyAddrsId'+id).remove();
           var addcount = $('#addcount').val();
           addcount=Number(addcount)-1;
           $('#addcount').val(addcount);
           }
           </script>

            <script>
           function addPartyAdd1(){
           var addcount1 = $('#addcount1').val();
           //alert(empcount);
           addcount1=Number(addcount1)+1;
           $.get("loadinvoice.php?id="+addcount1+"&action=dimension", function (data) {
          $("#loadpartyaddress1").append(data);
          });
            $('#addcount1').val(addcount1);
           $
           }

           function removeAddInfo1(id){
           $('#partyAddrsId1'+id).remove();
           var addcount1 = $('#addcount1').val();
           addcount1=Number(addcount1)-1;
           $('#addcount1').val(addcount1);
           }
           </script>

<!-- code -->



      </div>
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
