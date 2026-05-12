<?php
ob_start();
include "inc.php";
$assignto='download';
$select='*';

if($_GET['styleid']!=''){
$select='*';

$where='id="'.decode($_GET['styleid']).'"';
$rs=GetPageRecord($select,'queryMaster',$where);
$editresultstyle=mysqli_fetch_array($rs);
$buyerId = $editresultstyle['buyerId'];
$buyerStyleRefNo = $editresultstyle['buyerStyleRefNo'];
$subject = $editresultstyle['subject'];
$displayId = $editresultstyle['displayId'];
$seasonId = $editresultstyle['seasonId'];
$categoryId = $editresultstyle['categoryId'];
$subCategoryId = $editresultstyle['subCategoryId'];
$departmentId = $editresultstyle['departmentId'];
$receivedDate = $editresultstyle['receivedDate'];
$patternDescription = $editresultstyle['patternDescription'];
$patternAttachment = $editresultstyle['patternAttachment'];
$lastId=$editresultstyle['id'];
}

if($_GET['id']==''){

$namevalue ='addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'"';
$gateLast = addlistinggetlastid('externalChallan',$namevalue);
$gateLastId= mysql_insert_id();
}
if($_GET['id']!=''){

$rs=GetPageRecord('*','externalChallan','id="'.decode($_GET['id']).'"');
$editresult=mysqli_fetch_array($rs);
$gateLastId = $editresult['id'];

//echo $gateLastId;
}




header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>

              <?php
             if($_GET['id']!=''){


                $rrrl=GetPageRecord('*','externalChallan','1 and id="'.decode($_GET['id']).'"');
                $operationData=mysqli_fetch_array($rrrl);
             }
             ?>

 <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
 <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->

<style>

.form-control {
     padding: 4px;
}
.form-group{
  margin-bottom: 0.5em!important;
}

.toggle.btn {
    min-width: 59px;
    min-height: 34px;
    width: auto !important;
    height: auto !important;
    margin: 0px !important;
}


.listc .table thead th {
    vertical-align: middle;
    border-bottom: 1px solid #b7b7b7;
    padding: 9px;
}
.listc .table-bordered td, .table-bordered th {
    border: 1px solid #ddd;
    padding: 8px;
}
.icon-calendar3{
  position: absolute;
    top: 18px;
    right: 0px;
}
.addrgrid{
  display: grid;
    grid-template-columns: auto auto;
    }
</style>


                <div class="">
                <div align="center" style="margin: 0px 10px 30px;font-size: 20px;line-height: 27px;">ABC EXPORTS PVT. LTD.<br>12-A , SURAJKUND ROAD, FARIDABAD , HARYANA-121002, Ph-0129-22299901 , E-Mail-abclogistics@deboxglobal.com<br>GSTN : 06AAACP3293P1ZZ  , State Code : HR</div>
                </div>



                 <table class="table" style="width:">

                 <tr style="background: #0288d1;">
                 <td colspan="15"><div style="text-transform:capitalize;color:white;font-size: 20px;">ISSUE CHALLAN

                         </div>
                         </td>
                     </tr>
                     </table>

   <table style="background-color: #ffffff; margin-bottom: 0; width: 100%;">
        <tr>
        <td width="33%">
       <table class="table erptab" style="width:100%">

                     <tr style="border: 1px solid black;">
                        <td><div style="text-transform:capitalize"><b>Factory&nbsp;Name</b></div></td>
                           <td id=""><?php echo $operationData['factoryname']; ?></td>


                     </tr>



                           <tr style="border: 1px solid black;">
                        <td><div style="text-transform:capitalize"><b>Address</b></div></td>
                         <td id=""><?php echo $operationData['factoryaddress']; ?></td>


                     </tr>

                      <tr>
                        <td><div style="text-transform:capitalize"><b>Phone&nbsp;Number</b></div></td>
                         <td id="phn" style="margin-left:20px;"><?php echo $operationData['factoryphone']; ?></td>


                     </tr>

                           <tr>
                        <td><div style="text-transform:capitalize"><b>GSTN</b></div></td>
                         <td id=""><?php echo $operationData['factorygstn']; ?></td>


                     </tr>
                      <tr>
                        <td><div style="text-transform:capitalize"><b>State</b></div></td>
                         <td id=""><?php echo $operationData['factorystate']; ?></td>


                      </tr>

               </table>
                  </td>

     <td width="33%">
<table class="table erptab" style="width:100%">

                     <tr>
                        <td><div style="text-transform:capitalize"><b>Supplier&nbsp;Name</b></div></td>
                         <?php
                          $fcrefd=GetPageRecord('*','suppliersMaster','1 and id="'.$operationData['supplier'].'"');

				          $refDatad=mysqli_fetch_array($fcrefd);
				        ?>

                      <td>
                      <?php echo $refDatad['name']; ?>

                      </td>


                     </tr>
                     <script>
                                function changesupplier(supplier){
  $('#addr').load('loadbrand.php?supplierid='+supplier+'&action=changesupplier');

    $('#phn').load('loadbrand.php?supplierid='+supplier+'&action=changephone');

        $('#gst').load('loadbrand.php?supplierid='+supplier+'&action=changegstn');
        $('#state').load('loadbrand.php?supplierid='+supplier+'&action=changestate');


}

</script>

</script>


                           <tr>
                        <td><div style="text-transform:capitalize"><b>Address</b></div></td>
                         <td id="addr"><?php echo $operationData['address']; ?></td>


                     </tr>
                      <tr>
                        <td><div style="text-transform:capitalize"><b>Phone&nbsp;Number</b></div></td>
                         <td id="phn" style="margin-left:20px;"><?php echo $operationData['phone']; ?></td>


                     </tr>

                           <tr>
                        <td><div style="text-transform:capitalize"><b>GSTN</b></div></td>
                         <td id="gst"><?php echo $operationData['gstn']; ?></td>


                     </tr>
                      <tr>
                        <td><div style="text-transform:capitalize"><b>State</b></div></td>
                         <td id="state"><?php echo $operationData['state']; ?></td>


                     </tr>




               </table>
               </td>

             <td width="33%">
<table class="table erptab" style="width:100%">

                     <tr>
                        <td><div style="text-transform:capitalize"><b>Style&nbsp;No</b></div></td>
                        <?php

                          $fcref=GetPageRecord('*','queryMaster','1 and subject!="" and id="'.$operationData['stylenum'].'" and deletestatus=0 order by id desc');

				          $refData=mysqli_fetch_array($fcref);
				        ?>
                         <td style="margin-left:20px;">
                     <?php echo $refData['styleRefId']; ?>

                             </td>


                     </tr>

                     <script>
                     function changestyleindent(style){
  $('#indentno').load('loadbrand.php?styleid='+style+'&action=changestyleindent');
}

</script>

                           <tr>
                        <td><div style="text-transform:capitalize"><b>Indent&nbsp;No.</b></div></td>
                         <td id="indentno"><?php echo $operationData['indentnum']; ?></td>


                     </tr>
                      <tr>
                        <td><div style="text-transform:capitalize"><b>PO&nbsp;Number</b></div></td>
                         <td id="pono"><?php echo $operationData['pono']; ?></td>


                     </tr>

                      <tr>
                        <td><div style="text-transform:capitalize" ><b>Process</b></div></td>

                         <td>
                             <?php
                             if($operationData['process']=='Dyeing')
                             {
                              echo "Dyeing";
                             }

                             ?>

                             <?php
                             if($operationData['process']=='Printing')
                             {
                              echo "Printing";
                             }

                             ?>

                             <?php
                             if($operationData['process']=='Schiffli')
                             {
                              echo "Schiffli";
                             }

                             ?>

                             <?php
                             if($operationData['process']=='Embroidery')
                             {
                              echo "Embroidery";
                             }

                             ?>

                             <?php
                             if($operationData['process']=='processing')
                             {
                              echo "Re-processing";
                             }

                             ?>


                             </td>


                     </tr>

                           <tr>
                        <td><div style="text-transform:capitalize"><b>Eway&nbsp;No.</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="vehicleno" id="vehicleno" value="<?php echo$operationData['vehicleno'] ?>"> </td>


                     </tr>
                      <tr>
                        <td><div style="text-transform:capitalize"><b>Challan&nbsp;Type</b></div></td>


<td>
                             <?php
                             if($operationData['challantype']=='Non-Returnable')
                             {
                              echo "Non-Returnable";
                             }

                             ?>

                              <?php
                             if($operationData['challantype']=='Returnable')
                             {
                              echo "Returnable";
                             }

                             ?>


                             </td>

                     </tr>

                           <tr>
                        <td><div style="text-transform:capitalize"><b>Person&nbsp;Name</b></div></td>
                         <td><?php echo $operationData['personname'] ?></td>


                     </tr>


               </table>
               </td>

               <td width="33%">
<table class="table erptab" style="width:100%">

                     <tr>
                        <td><div style="text-transform:capitalize"><b>Dispatch&nbsp;Note</b></div></td>
                         <td><?php echo $operationData['dispatch'] ?></td>


                     </tr>



                           <tr>
                        <td><div style="text-transform:capitalize"><b>Challan&nbsp;No.</b></div></td>


                         <td>
                        AUTO</td>

                     </tr>
                      <tr>
                        <td><div style="text-transform:capitalize"><b>Date</b></div></td>
                         <td><?php echo $operationData['date'] ?></td>


                     </tr>

                           <tr>
                        <td><div style="text-transform:capitalize"><b>Vehicle&nbsp;No.</b></div></td>
                         <td><?php echo $operationData['vehiclenum'] ?></td>


                     </tr>
                      <tr>
                        <td><div style="text-transform:capitalize"><b>Gate&nbsp;No.</b></div></td>
                         <td><?php echo $operationData['gatenum'] ?></td>


                     </tr>

                           <tr>
                          <td><div style="text-transform:capitalize"><b>Eway&nbsp;No.</b></div></td>
                         <td><?php echo $operationData['ewaynum'] ?></td>


                     </tr>



                </table>
               </td>
               </tr>
               </table>

               </div>

               </div>

        </br>

           <table class="table erptab" style="width:1850px">
    <thead style="background-color:black; border: 2px solid black;">
      <tr class="border-top-info">
        <th style="background-color:black; color:white;">Item</th>
        <th style="background-color:black; color:white;">HSN&nbsp;Code</th>
        <th style="background-color:black; color:white;">Remarks</th>
        <th style="background-color:black; color:white;">UOM</th>
        <th style="background-color:black; color:white;">Qty</th>
        <th style="background-color:black; color:white;">Rate</th>
        <th style="background-color:black; color:white;">Total</th>
        <th colspan="2" style="background-color:black; color:white;">Cost</th>
        <th colspan="2" style="background-color:black; color:white;">SGST</th>
        <th colspan="2" style="background-color:black; color:white;">IGST</th>
        <th colspan="2" style="background-color:black; color:white;">TCS</th>
      </tr>

         <tr class="border-top-info">
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>

                  <th>Rate</th>
                  <th>Amt.</th>
                  <th>Rate</th>
                  <th>Amt.</th>
                  <th>Rate</th>
                  <th>Amt.</th>
                  <th>Rate</th>
                  <th>Amt.</th>
      </tr>
    </thead>
    <tbody>
              <?php

             $sNo2 = 0;
$select='';
$where='';
$as='';
$rs='';
$select='*';
$where='parentId="'.$gateLastId.'"  and status=1  order by id asc';
$rs=GetPageRecord($select,'loadExternalChallanMaster',$where);
while($resListing1=mysqli_fetch_array($rs)){



$as+=$resListing1['qty'];





?>




<?php
$sNo2++;
?>

<tr style="border: 2px solid black;">

<td style="text-align:center;">
    <?php
$rss=GetPageRecord('*','indentCreationMaster','1 and id="'.$_REQUEST['po'].'"');
$ressListing1=mysqli_fetch_array($rss);

$rssp=GetPageRecord('*','indentCreationMaster','1 and poNumber="'.$ressListing1['poNumber'].'"');
$ressListing2=mysqli_fetch_array($rssp);
$rsdd=GetPageRecord($select,'styleSubCategoryMaster','1 and id="'.$resListing1['itemcode'].'" and id="'.$ressListing2['materialId'].'"');
$resddListing1=mysqli_fetch_array($rsdd);
?>

<?php echo $resddListing1['name']; ?>
</td>

<td style="text-align:center;"><?php echo stripslashes($resListing1['hsncode']); ?>
</td>


<td style="text-align:center;">
<?php echo stripslashes($resListing1['reason']); ?>
</td>




<td style="text-align:center;">
  <?php echo stripslashes($resListing1['uom']); ?>
</td>



<td style="text-align:center;"><?php echo stripslashes($resListing1['qty']); ?>
</td>


<td style="text-align:center;"><?php echo stripslashes($resListing1['rate']); ?>
</td>

<td style="text-align:center;"><?php echo stripslashes($resListing1['amnt']); ?>
</td>



<td  style="text-align:center;"><?php echo stripslashes($resListing1['cgstrate']); ?>
</td>

<td style="text-align:center;"><?php echo stripslashes($resListing1['cgstamt']); ?>
</td>

<td style="text-align:center;"><?php echo stripslashes($resListing1['sgstrate']); ?>
</td>

<td style="text-align:center;"><?php echo stripslashes($resListing1['sgstamt']); ?>
</td>

<td style="text-align:center;"><?php echo stripslashes($resListing1['igstrate']); ?>
</div></td>

<td  style="text-align:center;"><?php echo stripslashes($resListing1['igstamt']); ?>
</td>

<td style="text-align:center;"><?php echo stripslashes($resListing1['utgstrate']); ?>
</td>

<td style="text-align:center;"><?php echo stripslashes($resListing1['utgstamt']); ?>
</td>


  </tr>

    <?php } ?>
  <?php  ?>


          <?php

             $sNo2 = 0;
$select='';
$where='';
$as='';
$rs='';
$select='*';
$where='parentId="'.$gateLastId.'"  and status=1  order by id asc';
$rs=GetPageRecord($select,'loadExternalChallanMaster',$where);
while($resListing1=mysqli_fetch_array($rs)){



$as+=$resListing1['qty'];


$rateqt+=$resListing1['qty']*$resListing1['rate'];

$cgstamt+=$resListing1['cgstamt'];

$sgstamt+=$resListing1['sgstamt'];

$igstamt+=$resListing1['igstamt'];

$utgstamt+=$resListing1['utgstamt'];
}


?>


  <tr class="border-top-info" style="font-weight: 500; font-size: 13px; border: 2px solid black;">
                  <th align="center"><div align="center"></div></th>
                  <th><div align="center">Total</div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center" id="totalqty"><?php echo $as; ?> </div></th>
                  <!--<th><div align="center"> </div></th>-->
                  <th><div align="center" id="totalqty"><?php  //echo $rateqt; ?></div></th>
                  <th><div align="center" id="totalamnt"> <?php echo $rateqt; ?></div></th>
                  <th><div align="center" id="totalamnt"><?php // echo $rateqt; ?></div></th>
                  <!--<th><div align="center"> </div></th>-->
                  <!--<th><div align="center" id="totaltax"></div></th>-->

                  <th><div align="center" id="totalcgst"><?php echo $cgstamt; ?></div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center" id="totalsgst"><?php echo $sgstamt; ?></div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center" id="totaligst"><?php echo $igstamt; ?></div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center" id="totalutgst"><?php echo $utgstamt; ?></div></th>

                </tr>



  <script>
 savemeasurmentdata<?php echo $resListing1['id']; ?>();
function savemeasurmentdata<?php echo $resListing1['id']; ?>(){
var itemcode = encodeURI($('#itemcode<?php echo $resListing1['id']; ?>').val());
var hsncode= encodeURI($('#hsncode<?php echo $resListing1['id']; ?>').val());
var reason= encodeURI($('#reason<?php echo $resListing1['id']; ?>').val());
var uom= encodeURI($('#uom<?php echo $resListing1['id']; ?>').val());
var qty= encodeURI($('#qty<?php echo $resListing1['id']; ?>').val());
var rate= encodeURI($('#rate<?php echo $resListing1['id']; ?>').val());

var cgstrate= encodeURI($('#cgstrate<?php echo $resListing1['id']; ?>').val());
var sgstrate= encodeURI($('#sgstrate<?php echo $resListing1['id']; ?>').val());
var igstrate= encodeURI($('#igstrate<?php echo $resListing1['id']; ?>').val());
var utgstrate= encodeURI($('#utgstrate<?php echo $resListing1['id']; ?>').val());


var totalamnt=Number(rate*qty);
$('#amnt<?php echo $resListing1['id']; ?>').val(totalamnt);
var amnt = encodeURI($('#amnt<?php echo $resListing1['id']; ?>').val());


var cgstamt= encodeURI($('#cgstamt<?php echo $resListing1['id']; ?>').val());
var sgstamt= encodeURI($('#sgstamt<?php echo $resListing1['id']; ?>').val());
var igstamt= encodeURI($('#igstamt<?php echo $resListing1['id']; ?>').val());
var utgstamt= encodeURI($('#utgstamt<?php echo $resListing1['id']; ?>').val());


var totalcont=0;
$('.qty').each(function() {
 totalcont += Number($(this).val());
});
totalcont= parseFloat(totalcont).toFixed(2);
$('#totalqty').text(totalcont);


var totalamt=0;
$('.amnt').each(function() {
 totalamt += Number($(this).val());
});
totalamt= parseFloat(totalamt).toFixed(2);
$('#totalamnt').text(totalamt);



var totalcg=0;
$('.cgstamt').each(function() {
 totalcg += Number($(this).val());
});
totalcg= parseFloat(totalcg).toFixed(2);
$('#totalcgst').text(totalcg);
$('#totalcgst1').text(totalcg);

var totalsg=0;
$('.sgstamt').each(function() {
 totalsg += Number($(this).val());
});
totalsg= parseFloat(totalsg).toFixed(2);
$('#totalsgst').text(totalsg);
$('#totalsgst1').text(totalsg);

var totalig=0;
$('.igstamt').each(function() {
 totalig += Number($(this).val());
});
totalig= parseFloat(totalig).toFixed(2);
$('#totaligst').text(totalig);
$('#totaligst1').text(totalig);

var totalut=0;
$('.utgstamt').each(function() {
 totalut += Number($(this).val());
});
totalut= parseFloat(totalut).toFixed(2);
$('#totalutgst').text(totalut);
$('#totalutgst1').text(totalut);


// var totalcgstamnt = Number(taxvalue*(cgstrate/100));
// $('#cgstamt<?php echo $resListing1['id']; ?>').val(totalcgstamnt.toFixed(2))
// var cgstamt= encodeURI($('#taxvalue<?php echo $resListing1['id']; ?>').val());

// var totalsgstamnt = Number(taxvalue*(sgstrate/100));
// $('#sgstamt<?php echo $resListing1['id']; ?>').val(totalsgstamnt.toFixed(2))
// var sgstamt= encodeURI($('#sgstamt<?php echo $resListing1['id']; ?>').val());

// var totaligstamnt = Number(taxvalue*(igstrate/100));
// $('#igstamt<?php echo $resListing1['id']; ?>').val(totaligstamnt.toFixed(2))
// var igstamt= encodeURI($('#igstamt<?php echo $resListing1['id']; ?>').val());

// var totalutgstamnt = Number(taxvalue*(utgstrate/100));
// $('#utgstamt<?php echo $resListing1['id']; ?>').val(totalutgstamnt.toFixed(2))
// var utgstamt= encodeURI($('#utgstamt<?php echo $resListing1['id']; ?>').val());

//$('#savemeasurmentdata').load('allaction.php?action=saveexternalchallan&id=<?php echo encode($resListing1['id']); ?>&itemcode='+itemcode+'&hsncode='+hsncode+'&reason='+reason+'&uom='+uom+'&rate='+rate+'&qty='+qty+'&amnt='+amnt+'&cgstrate='+cgstrate+'&cgstamt='+cgstamt+'&sgstrate='+sgstrate+'&sgstamt='+sgstamt+'&igstamt='+igstamt+'&igstrate='+igstrate+'&utgstamt='+utgstamt+'&utgstrate='+utgstrate);


/////////////////////////////////////////////////////////////////////////////////

}



</script>


    </tbody>
  </table>



        <script>
$( function(){
  $( "#billdate").datepicker();
} );
</script>
<br>
<div style="overflow: scroll;">




 <style>
 .liststyleimg{float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}

  .badge.dropdown-toggle:after { display:none;
}

.btn-float i {
    display: block;
    top: 0;
    font-size: 20px;
}

.card-group-control-right .card-body{width:100%;}


 </style>





<tr style="padding:8px;text-align: center; width: 100%;background-color: #efefef;"><td colspan="50"><div align="center">No Record Found.</div></td></tr>




<div align="center">
  <?php  ?>
 <tr id="savemeasurmentdata" style="display:none;"></tr>