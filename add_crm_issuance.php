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
?>

<?php

// if($_GET['pid'] != "") {
// $namevalue ='addedBy="'.$_SESSION['userid'].'",dateCreated="'.time().'",requisitionId="'.decode($_GET['pid']).'"';
//   $gateLast = addlistinggetlastid('issuanceMaster',$namevalue);
// $gateLastId= mysql_insert_id();

// $yr=GetPageRecord('*','requisitionmaster','1 and parentId="'.decode($_GET['pid']).'"');
//         while($req=mysqli_fetch_array($yr)){

// $namevalue ='parentId="'.$gateLastId.'",materialId="'.$req['materialId'].'",techpackId="'.$req['techpackId'].'",color="'.$req['color'].'",styleId="'.$req['styleId'].'",requisitionId="'.decode($_GET['pid']).'"';

//       addlistinggetlastid('issuanceMaster',$namevalue);
//         }
// }

?>

<style>
    .erptab tr td{
border-top:0px solid #ccc!important;
padding:0.55rem!important;
}
.erptab1 tr td{
border-top:0px solid #ccc!important;
padding:0.40rem!important;
}
.erptab{
border:1px solid #ccc!important;
}
.erptab1{
border:1px solid black !important;
}
.erpint{
    border: 1px solid #b3acac;
    padding: 3px;
}
.datatable-scroll{overflow:auto !important;}
</style>
  <div class="page-content">

    <div class="content-wrapper">
     <?php include "savealert.php"; ?>

  <div class="content pt-0" style="margin-top:20px;">

      <div class="row" style="margin-bottom:10px; ">
            <div class="col-xl-12">
<!--                  <div class="card-header header-elements-inline bg-blue-700 filterable" style="padding: 10px;">
 -->            <!-- <div class="col-xl-12">
              <h5 class="card-title" style="text-align:center">De-Box  EXPORTS PVT. LTD.</h5>
            </div> -->
<!--           </div>
 -->              <div class="card mb-0 rounded-bottom-0" style="padding:15px;">
                <div class="col-xl-12">
                  <div class="panel panel-flat">
<!--                                       <div style="text-align:center;font-weight:bold;">201, Noida Road,         </div>
 -->
                                 <div style="text-align:center;font-weight:bold;">Item Issuance Plan   </div>

                  </div>
                </div>
                </div>
              </div>
            </div>

        <div class="row">

        <div class="col-xl-12">
        <div class="card">
            <div style="padding: 25px;">


                <?php
        $rrrl=GetPageRecord('*','issuanceMaster','1 and id="'.decode($_GET['id']).'"');
        $operationDat=mysqli_fetch_array($rrrl);

        $rrrr=GetPageRecord('*','requisitionmaster','1 and id="'.$operationDat['requisitionId'].'"');
        $operationData=mysqli_fetch_array($rrrr);



        ?>
        <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
          <input name="action" type="hidden" id="action" value="issuance" />
          <input name="editId" type="hidden" id="editId" value="<?php echo encode($operationDat['id']); ?>">
          <input name="requisition" type="hidden" id="requisition" value="<?php echo decode($_GET['pid']); ?>">
          <table class="table erptab table-hover" style="width:100%">
                     <tr>
                         <td width="12%"><div style="text-transform:capitalize;"><b>Requisition&nbsp;Number</b></div></td>
                         <td width="20%">
                          <input style="width:100%;" type="text" class="erpint" name="" value="<?php echo
                          'REQ-'.makeQueryId(decode($_GET['pid'])); ?>" readonly>
                         </td>
                         <!-- 'REQ-'.date('d',$operationData['dateCreated']).date('m',$operationData['dateCreated']).date('y',$operationData['dateCreated']).'-'.decode($_GET['pid']) -->

                          <td width="12%"><div style="text-transform:capitalize;"><b>Issuance&nbsp;Number</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="issuanceno" id="issuanceno"  <?php if($operationData['id'] !="") { ?> value="<?php echo 'ISS-'.date('d',$operationDat['dateCreated']).date('m',$operationDat['dateCreated']).date('y',$operationDat['dateCreated']).'-'.$operationDat['id'] ?>"  <?php } else {?> value=""  <?php } ?> readonly>

                         </td>

                          <td width="12%"><div style="text-transform:capitalize;text-align:end"><b>Issuance&nbsp;Date</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="issuancedate" <?php if($operationData['id'] !="") { ?> value="<?php echo date('d-m-Y',$operationData['dateAdded']); ?>"  <?php } else {?> value=""  <?php } ?> readonly ></td>

                     </tr>
                   </table>


                      <br>
                      <div id="loadissuance">


               <table class="table erptab table-hover" style="width:100%">
                     <tr>
                         <td><div style="text-transform:capitalize;"><b>Requisition&nbsp;Type</b></div></td>
                         <td>
       <input style="width:100%;" type="text" class="erpint" name="requisitiontype" id="requisitiontype" <?php if($operationData['requisitiontype'] == "1") { ?> value="Fabric" <?php }
         if($operationData['requisitiontype'] == "2") {  ?> value="Trims" <?php }
         if($operationData['requisitiontype'] == "3") { ?> value="Packaging" <?php } ?> readonly>

                         </td>
                          <td style="width:26%"><div style="text-transform:capitalize;text-align:end"><b>Requisition Date</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="requisitiondate" value="<?php echo date('d-m-Y',$operationData['dateAdded']); ?>" readonly></td>

                     </tr>

                          <tr>


                         <td style="width:26%"><div style="text-transform:capitalize;"><b>Style No<?php echo $operationData['styleId']; ?></b></div></td>
                         <td>
                          <?php
                    $fcref=GetPageRecord('*','queryMaster','1 and id="'.$operationData['styleId'].'"');
                             $refData=mysqli_fetch_array($fcref); ?>
                          <input style="width:100%;" type="text" class="erpint"  name="styleno" id="buyer" value="<?php echo $refData['styleRefId']  ?>" readonly>
                  </td>
                  <td><div style="text-transform:capitalize;text-align: right;"> <b>Indent No</b> </div></td>

                         <td id="brand">
                          <input style="width:100%;" type="text" class="erpint" name="indentno" value="<?php echo $operationData['indentno'] ?>" readonly>
                         </td>

                     </tr>

                     <tr>



                         <td><div style="text-transform:capitalize;"><b>Due Date</b></div></td>
                         <td><input style="width:100%;" type="date" class="erpint" name="duedate" id="phone"  value="<?php echo $operationData['duedate']; ?>" readonly></td>
                          <td><div style="text-transform:capitalize;text-align: right;"><b>Order Qty</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="orderqty" id="orderqty"  value="<?php echo $operationData['orderqty']; ?>" readonly></td>

                     </tr>

          <tr>

              <td style="width:%"><div style="text-transform:capitalize;"><b>Brand</b></div></td>
                         <td id="brandId" >
                    <input style="width:100%;" type="text" class="erpint" name="brand" value="<?php echo $operationData['brandId'] ?>" readonly>
                        </td>
                        <td><div style="text-transform:capitalize;text-align: right;"><b>Lot</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="lot" id="lot"  value="<?php echo $operationData['lot']; ?>" readonly></td>

                     </tr>
                     <tr>


                         <td><div style="text-transform:capitalize;"><b>Requested By</b></div></td>
                         <td>
                      <?php
                  $fcref=GetPageRecord('*','userMaster','1 and id="'.$operationData['requested'].'"') ;
                      $refData=mysqli_fetch_array($fcref);
                              ?>
                              <input style="width:100%;" type="text" class="erpint" name="equested" id="requested"  value="<?php echo $refData['firstName']; ?>&nbsp;<?php echo $refData['lastName']; ?>" readonly>


                        </td>
                        <td><div style="text-transform:capitalize;text-align: right;"><b>Department</b></div></td>
                         <td>
                         <input style="width:100%;" type="text" class="erpint" name="department" id="lemail"  value="<?php echo $operationData['department']; ?>" readonly>
                         </td>
                     </tr>

                     </table>
                   </div>
               <div>
         <br>
                  <script>



(function () {
   $('#loadissuance').load('loadbrand.php?issuance=<?php echo decode($_GET['pid']); ?>&action=requisition');

})()
</script>
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
              <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">

                <div class="datatable-scroll">
                  <table class="table table-bordered table-hover no-footer">
                    <thead style="background-color: #f5f5f5;">
                      <tr role="row">
                        <th>S.&nbsp;No</th>
                        <th width="15%" style="text-align: center;">Item</th>
                        <th style="text-align: center;">Color</th>
                        <th style="text-align: center;">UOM</th>
                        <th style="text-align: center;">Quantity&nbsp;Requested</th>
                        <th style="text-align: center;">Quantity&nbsp;Issued</th>
                        <th style="text-align: center;">Quantity&nbsp;Balance</th>
                        <th style="text-align: center;">Marker&nbsp;Reference&nbsp;No</th>
                        <th style="text-align: center;">Size</th>
                        <th style="text-align: center;">Average</th>
                        <th style="text-align: center;">No&nbsp;of&nbsp;Pcs.</th>

                      </tr>
                    </thead>
                    <tbody>
            <?php
                 $no = 1; $i=0;
                   //$newdata = explode(',', $operationDat['issueqty']);
                  // $newdata1 = explode(',', $operationDat['balance']);

          $wherenew='parentId="'.decode($_GET['pid']).'" and parentId!= "0" order by id asc';

          $rsnew=GetPageRecord('*','loadRequisitionMaster',$wherenew);

          while($rslistnew=mysqli_fetch_array($rsnew)){

                $rs1113=GetPageRecord('*','techPackDetailMaster','id="'.$rslistnew['techpackId'].'"');
                       $resListing1113=mysqli_fetch_array($rs1113);

                $rs1112=GetPageRecord('*','styleSubCategoryMaster','id="'.$rslistnew['materialId'].'"');
                       $resListing1112=mysqli_fetch_array($rs1112);

                      $rs1113=GetPageRecord('*','colorCardMaster','name="'.$rslistnew['color'].'"');
                       $resListing11134=mysqli_fetch_array($rs1113);

                       //echo 'styleId="'.$rslistnew['styleId'].'" and materialId="'.$rslistnew['materialId'].'" and requisitionId="'.$rslistnew['parentId'].'" and color="'.$rslistnew['colorId'].'"';

                       $rs1116=GetPageRecord('*','issuanceMaster','styleId="'.$rslistnew['styleId'].'" and materialId="'.$rslistnew['materialId'].'" and requisitionId="'.$rslistnew['parentId'].'" and color="'.$rslistnew['colorId'].'"');
                       $resListing11136=mysqli_fetch_array($rs1116);

          ?>


                  <tr>
                    <td><strong><?php echo $no; ?>.</strong></td>

                    <td style="text-align: center;"><?php echo $resListing1112['name'];?></td>

                   <td align="center"><?php echo $rslistnew['color']; ?></td>

                   <td align="center"><?php echo $resListing1113['bomUnit']; ?></td>

                    <td style="text-align: center;"><input type="text" id="quantity<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['quantity']; ?>" style="width:80px;" readonly></td>

                    <td style="text-align: center;"><input type="text" name="issueqty[]" id="issueqty<?php echo $rslistnew['id']; ?>" value="<?php echo $resListing11136['issueqty']; ?>" onBlur="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;"></td>

                    <td style="text-align: center;"><input type="text" name="balance[]" id="balance<?php echo $rslistnew['id']; ?>" value="<?php echo $resListing11136['balance']; ?>" style="width:80px;" readonly>
                    <input type="hidden"  name="materialId[]" value="<?php echo $rslistnew['materialId'];  ?>">

                    <input type="hidden" name="editrowid[]" value="<?php echo $resListing11136['id'];  ?>">
                    <input type="hidden" name="colorId[]" value="<?php echo $rslistnew['colorId'];  ?>">
                  </td>

                    <td style="text-align: center;"><?php echo $rslistnew['marker']; ?></td>

                    <td style="text-align: center;"><?php echo $rslistnew['size']; ?></td>

                    <td style="text-align: center;"><?php echo $resListing1113['avgIncWastage']; ?></td>

                    <td style="text-align: center;"><?php echo $rslistnew['pcs']; ?></td>



                  </tr>


                    <script>
                      // savelinedetail<?php echo $rslistnew['id']; ?>();
                    function savelinedetail<?php echo $rslistnew['id']; ?>(){

        var issueqty = Number($('#issueqty<?php echo $rslistnew['id']; ?>').val());

        var quantity = Number($('#quantity<?php echo $rslistnew['id']; ?>').val());

        var amount1 = Number(quantity-issueqty);

        $('#balance<?php echo $rslistnew['id']; ?>').val(amount1.toFixed(3));

        var balance = $('#balance<?php echo $rslistnew['id']; ?>').val();

         if(issueqty > quantity){
          alert('Issue Quantity should not be greater than Quantity');
            $('#issueqty<?php echo $rslistnew['id']; ?>').val(0);
             $('#balance<?php echo $rslistnew['id']; ?>').val(0);
        }
      }
                </script>
                    <?php $no++; $i++; } ?>
                    </tbody>
                  </table>

                </div>

              </div>

           <br>
            <button type="submit" class="btn btn-primary" style="float:right">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>
            </form>
            </div>

               <br>
               <div class="pagingdiv" style="width: 97%;margin: 20px auto;display: none;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tbody>
                        <tr>
                          <td><table border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <td style="padding-right:20px;"><?php echo $totalentry; ?> entries</td>
                                <td><select name="records" id="records" onchange="this.form.submit();" class="lightgrayfield" style="padding: 5px;border: 1px solid #ccc; outline:none;">
                                    <option value="25" <?php if($_GET['records']=='25'){ ?> selected="selected"<?php } ?>>25 Records Per Page</option>
                                    <option value="50" <?php if($_GET['records']=='50'){ ?> selected="selected"<?php } ?>>50 Records Per Page</option>
                                    <option value="100" <?php if($_GET['records']=='100'){ ?> selected="selected"<?php } ?>>100 Records Per Page</option>
                                    <option value="200" <?php if($_GET['records']=='200'){ ?> selected="selected"<?php } ?>>200 Records Per Page</option>
                                    <option value="300" <?php if($_GET['records']=='300'){ ?> selected="selected"<?php } ?>>300 Records Per Page</option>
                                  </select></td>
                              </tr>
                            </table></td>
                          <td align="right"><div class="pagingnumbers"><?php echo $paging; ?></div></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>


        </div>


        </div>

</div>

      </div>

    </div>

  </div>

</div>