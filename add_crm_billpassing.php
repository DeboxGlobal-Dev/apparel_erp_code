
<?php
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

// if($_GET['id']==''){

// $namevalue ='addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'"';
// $gateLast = addlistinggetlastid('externalChallan',$namevalue);
// $gateLastId= mysql_insert_id();
// }
// if($_GET['id']!=''){

// $rs=GetPageRecord('*','externalChallan','id="'.decode($_GET['id']).'"');
// $editresult=mysqli_fetch_array($rs);
// $gateLastId = $editresult['id'];

// }


?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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
<div class="page-content">

    <div class="content-wrapper">

      <div class="content pt-0" style="margin-top:20px;">
            <?php
            if($_GET['styleid']!= ""){
             include "top-style.php";
               }
             ?>

          <div class="col-xl-12" style="padding:0px;">
         <div class="card">

             <?php
             if($_GET['id']!=''){


             $rrrl=GetPageRecord('*','externalChallan','1 and id="'.decode($_GET['id']).'"');
                $operationData=mysqli_fetch_array($rrrl);
             }
             ?>
              <div class="card-body listc">

              <!--<hr>-->

  <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
          <input name="action" type="hidden" id="action" value="externalchallan" />
          <input name="editId" type="hidden" id="editId" value="<?php echo $gateLastId;  ?>">
<div class="row">
     <table class="table erptab" style="width:100%">

    <tr style="background: #0288d1;">
                         <td colspan="6"><div style="text-transform:capitalize;color:white;font-size: 15px;">Bill Passing & Movement

                         </div>
                         </td>
                     </tr>
                     </table>
    <div class="col-sm-3">






        <table class="table erptab" style="width:100%">

                     <tr>
                        <td><div style="text-transform:capitalize"><b>GRN&nbsp;No</b></div></td>
                           <td id=""><input style="width:100%;" type="text" class="erpint" name="factoryname" id="factoryname" value="<?php echo $operationData['factoryname']; ?>" > </td>


                     </tr>



                           <tr>
                        <td><div style="text-transform:capitalize"><b>GRN&nbsp;Date</b></div></td>
                         <td id=""><input style="width:100%;" type="text" class="erpint" name="factoryaddress" id="factoryaddress" value="<?php echo $operationData['factoryaddress']; ?>" > </td>


                     </tr>
                      <tr>
                        <td><div style="text-transform:capitalize"><b>PO&nbsp;Number</b></div></td>
                         <td id=""><input style="width:100%;" type="text" class="erpint" name="factoryphone" id="factoryphone" value="<?php echo $operationData['factoryphone']; ?>" > </td>


                     </tr>

                           <tr>
                        <td><div style="text-transform:capitalize"><b>GE&nbsp;Number</b></div></td>
                         <td id=""><input style="width:100%;" type="text" class="erpint" name="factorygstn" id="factorygstn" value="<?php echo $operationData['factorygstn']; ?>" > </td>


                     <!--</tr>-->
                     <!-- <tr>-->
                     <!--   <td><div style="text-transform:capitalize"><b>State</b></div></td>-->
                     <!--    <td id=""><input style="width:100%;" type="text" class="erpint" name="factorystate" id="factorystate" value="<?php echo $operationData['factorystate']; ?>"  > </td>-->


                     <!--</tr>-->




               </table>





    </div>
<div class="col-sm-3">
 <table class="table erptab" style="width:100%">

                     <tr>
                        <td><div style="text-transform:capitalize"><b>Challan&nbsp;No</b></div></td>
  <td>


<select name="supplier" id="supplier" class="erpint" style="width:100%;" onchange="changesupplier(this.value);" >
                            <option value="">Select</option>





                      <?php



			            	$fcrefd=GetPageRecord('*','suppliersMaster','1');
				                      while($refDatad=mysqli_fetch_array($fcrefd)){ ?>
                      <option value="<?php echo $refDatad['id']; ?>"<?php if($refDatad['id']==$operationData['supplier']){ ?> selected <?php } ?> ><?php echo $refDatad['name']; ?></option>
                      <?php }   ?>
                    </select>
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
                        <td><div style="text-transform:capitalize"><b>E&nbsp;way&nbsp;Bill&nbsp;No/&nbsp;Bill&nbsp;No</b></div></td>
                         <td id="addr"><input style="width:100%;" type="text" class="erpint" name="" id="" value="<?php echo $operationData['address']; ?>" readonly> </td>


                     </tr>
                      <tr>
                        <td><div style="text-transform:capitalize"><b>Party&nbsp;Challan No</b></div></td>
                         <td id="phn"><input style="width:100%;" type="text" class="erpint" name="" id="" value="<?php echo $operationData['phone']; ?>" readonly> </td>


                     </tr>

                           <tr>
                        <td><div style="text-transform:capitalize"><b>GE&nbsp;Date</b></div></td>
                         <td id="gst"><input style="width:100%;" type="text" class="erpint" name="" id="" value="<?php echo $operationData['gstn']; ?>" readonly> </td>


                     <!--</tr>-->
                     <!-- <tr>-->
                     <!--   <td><div style="text-transform:capitalize"><b>State</b></div></td>-->
                     <!--    <td id="state"><input style="width:100%;" type="text" class="erpint" name="" id="" value="<?php echo $operationData['state']; ?>" readonly > </td>-->


                     <!--</tr>-->




               </table>
               </div>








               <div class="col-sm-3">
 <table class="table erptab" style="width:100%">

                     <tr>
                        <td><div style="text-transform:capitalize"><b>Bill&nbsp;Date</b></div></td>
                         <td>


<select name="stylenum" id="stylenum" class="erpint" style="width:100%;" onchange="changestyleindent(this.value);" >
                            <option value="">Select</option>
                      <?php

			            	$fcref=GetPageRecord('*','queryMaster','1 and subject!="" and deletestatus=0 order by id desc');
				                      while($refData=mysqli_fetch_array($fcref)){ ?>
                      <option value="<?php echo $refData['id']; ?>" <?php if($refData['id']==$operationData['stylenum']){ ?> selected <?php } ?>>#<?php echo $refData['styleRefId']; ?></option>
                      <?php }   ?>
                    </select>
                             </td>


                     </tr>

                     <script>
                     function changestyleindent(style){
  $('#indentno').load('loadbrand.php?styleid='+style+'&action=changestyleindent');
}

</script>

                           <tr>
                        <td><div style="text-transform:capitalize"><b>Supplier </b></div></td>
                         <td id="indentno"><input style="width:100%;" type="text" class="erpint" name="indentnum" id="indentnum" value="<?php echo $operationData['indentnum']; ?>" readonly> </td>


                     </tr>
                      <tr>
                        <td><div style="text-transform:capitalize"><b>Supplier&nbsp;GST&nbsp;No.</b></div></td>
                         <td id="pono"><input style="width:100%;" type="text" class="erpint" name="pono" id="pono" value="<?php echo $operationData['pono']; ?>" > </td>


                     </tr>

                      <tr>
                        <td><div style="text-transform:capitalize" ><b>Bill&nbsp;Attach</b></div></td>
                         <td>


                             <select name="process" id="process" class="erpint"style="width:100%;">

                            <option>Select</option>

                                 <option value="Dyeing"<?php if($operationData['process']=='Dyeing'){ ?> selected <?php } ?>>Dyeing</option>
                                <option value="Printing"  <?php if($operationData['process']=='Printing'){ ?> selected <?php } ?>>Printing</option>
                                 <option value="Schiffli" <?php if($operationData['process']=='Schiffli'){ ?> selected <?php } ?>>Schiffli</option>

                                 <option value="Embroidery" <?php if($operationData['process']=='Embroidery'){ ?> selected <?php } ?>>Embroidery</option>
                                 <option value="Re-processing" <?php if($operationData['process']=='processing'){ ?> selected <?php } ?>>Re-processing</option>

                             </select>
                             </td>


                     </tr>

                     <!--      <tr>-->
                     <!--   <td><div style="text-transform:capitalize"><b>Eway&nbsp;No.</b></div></td>-->
                     <!--    <td><input style="width:100%;" type="text" class="erpint" name="vehicleno" id="vehicleno" value="<?php echo$operationData['vehicleno'] ?>"> </td>-->


                     <!--</tr>-->
<!--                      <tr>-->
<!--                        <td><div style="text-transform:capitalize"><b>Challan&nbsp;Type</b></div></td>-->


<!--<td>-->


<!--                             <select name="challantype" id="challantype" class="erpint" style="width:100%;" required>-->
<!--                                 <option>Select</option>-->
<!--                                 <option value="Non-Returnable" <?php if($operationData['challantype']=='Non-Returnable'){ ?> selected <?php } ?>>Non-Returnable</option>-->
<!--                                <option value="Returnable" <?php if($operationData['challantype']=='Returnable'){ ?> selected <?php } ?>>Returnable</option>-->


<!--                             </select>-->
<!--                             </td>-->

                     <!--</tr>-->

                     <!--      <tr>-->
                     <!--   <td><div style="text-transform:capitalize"><b>Person&nbsp;Name</b></div></td>-->
                     <!--    <td><input style="width:100%;" type="text" class="erpint" name="personname" id="personname" value="<?php echo $operationData['personname'] ?>"> </td>-->


                     <!--</tr>-->


               </table>
               </div>





               <div class="col-sm-3">
 <table class="table erptab" style="width:100%">

                     <tr>
                        <td><div style="text-transform:capitalize"><b>Department&nbsp;Name</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="dispatch" id="dispatch" value="<?php echo $operationData['dispatch'] ?>"> </td>


                     </tr>



                           <tr>
                        <td><div style="text-transform:capitalize"><b>Cost&nbsp;Center</b></div></td>


                         <td>





                             <input style="width:100%;" type="text" class="erpint" name="" id="" value="" readonly placeholder="AUTO"> </td>




                     </tr>
                      <tr>
                        <td><div style="text-transform:capitalize"><b>Payment&nbsp;Advise&nbsp;No.</b></div></td>
                         <td><input style="width:100%;" type="date" class="erpint" name="date" id="date" value="<?php echo $operationData['date'] ?>" readonly> </td>


                     </tr>

                           <tr>
                        <td><div style="text-transform:capitalize"><b>Performa&nbsp;Invoice</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="vehiclenum" id="vehiclenum" value="<?php echo $operationData['vehiclenum'] ?>"> </td>


                     </tr>
                     <!-- <tr>-->
                     <!--   <td><div style="text-transform:capitalize"><b>Gate&nbsp;No.</b></div></td>-->
                     <!--    <td><input style="width:100%;" type="text" class="erpint" name="gatenum" id="gatenum" value="<?php echo $operationData['gatenum'] ?>"> </td>-->


                     <!--</tr>-->

                     <!--      <tr>-->
                     <!--   <td><div style="text-transform:capitalize"><b>Eway&nbsp;No.</b></div></td>-->
                     <!--    <td><input style="width:100%;" type="text" class="erpint" name="ewaynum" id="ewaynum" value="<?php echo $operationData['ewaynum'] ?>"> </td>-->


                     <!--</tr>-->


               </table>
               </div>




      </div>

        <script>
$( function(){
  $( "#billdate").datepicker();
} );
</script>
<br>
<div style="overflow: scroll;">
                <table class="table table-bordered" style="font-size: 12px;">
              <thead style="background-color: #f9f8f8;">

                <tr class="border-top-info" style="background-color: black;">
                  <th>&nbsp;</th>

                  <th colspan="" align="center" style="text-align:center; color:white;">Item</th>
                                    <th colspan="" align="center" style="text-align:center; color:white;">HSN&nbsp;Code</th>

                  <th colspan="" align="center" style="text-align:center; color:white;">Remarks</th>

                 <th style="text-align:center; color:white;">UOM</th>
                 <!--<th style="text-align:center; color:#fff;">Bill&nbsp;No.</th>-->
                 <th style="text-align:center; color:white;">Qty</th>
                 <th style="text-align:center; color:white;">Rate</th>
                 <th style="text-align:center; color:white;">Total</th>
                 <!--<th style="text-align:center; color:#fff;">Discount&nbsp;Amt.</th>-->
                 <!--<th style="text-align:center; color:#fff;">Taxable&nbsp;Value</th>-->
                 <th colspan="2" style="text-align:center; color:white;">Cost</th>
                 <th colspan="2" style="text-align:center; color:white;">SGST</th>
                 <th colspan="2" style="text-align:center; color:white;">IGST</th>
                 <th colspan="2" style="text-align:center; color:white;">TCS</th>
                </tr>
                <tr class="border-top-info">
<th align="center"><div align="center"><a onClick="addNewRow(1,2);" style="color:#0000FF; cursor: pointer;">+Add&nbsp;New</a></div></th>
                  <th><div align="center"></div></th>
                  <th><div align="center"></div></th>
                  <th style="width:30%;"><div align="center"></div></th>
                  <th><div align="center"></div></th>
                  <!--<th><div align="center"></div></th>-->
                  <th><div align="center"></div></th>
                  <th><div align="center"></div></th>
                  <th><div align="center"></div></th>
                  <!--<th><div align="center"></div></th>-->
                  <!--<th><div align="center"></div></th>-->
                  <th><div align="center">Rate</div></th>
                  <th><div align="center">Amt.</div></th>
                  <th><div align="center">Rate</div></th>
                  <th><div align="center">Amt.</div></th>
                  <th><div align="center">Rate </div></th>
                  <th><div align="center">Amt.</div></th>
                  <th><div align="center">Rate</div></th>
                  <th><div align="center">Amt.</div></th>



                </tr>
              </thead>

               <tbody id="addrow"></tbody>

        <script>
        function addNewRow(id,po){
        if(id==1){
        $("#addrow").load('loadexternalch.php?add=1&parentId=<?php echo encode($gateLastId); ?>&po='+po);
        }else{
        $("#addrow").load('loadexternalch.php?parentId=<?php echo encode($gateLastId); ?>&po='+po);
        }

        }
        addNewRow(0,<?php echo $operationData['poNumber'] ?>);

        function deleteRow(id){
        var checkyes = confirm('Are your sure you you want to delete?');
        if(checkyes==true){
        $('#addrow').load('loadexternalch.php?id='+id+'&deletestatus=yes&parentId=<?php echo encode($gateLastId); ?>&po=<?php echo $operationData['poNumber'] ?>');
        }
        }
        </script>


        <tr class="border-top-info" style="font-weight: 500; font-size: 13px;">
                  <th align="center"><div align="center"></div></th>
                  <th><div align="center">Total</div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center"> </div></th>
                  <!--<th><div align="center"> </div></th>-->
                  <th><div align="center" id="totalqty">0</div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center" id="totalamnt">0.00</div></th>
                  <!--<th><div align="center"> </div></th>-->
                  <!--<th><div align="center" id="totaltax">0.00</div></th>-->
                  <th><div align="center"> </div></th>
                  <th><div align="center" id="totalcgst">0.00</div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center" id="totalsgst">0.00</div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center" id="totaligst">0.00</div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center" id="totalutgst">0.00</div></th>

                </tr>

            </table>
          </div>

            <br>


              <br>


             <br>
            <button type="submit" name="submit"class="btn btn-primary" style="float:right">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>
            </form>
              </div>
     </div>
         </div>

        </div>

      </div>
      </div>

    </div>  </div>

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






