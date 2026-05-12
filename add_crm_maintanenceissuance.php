<?php
if($_GET['styleid']!=''){
$select='*';
$where='id="'.decode($_GET['styleid']).'"';
$rs=GetPageRecord($select,'issuance',$where);
$operationData=mysqli_fetch_array($rs);

$requisition_no = $operationData['requisition_no'];
 $lastId=$operationData['id'];

}

?>

                         <style>
                     .erptab tr td{

                    border-top:0px solid #ccc!important;
                    padding:0.55rem!important;
                    }
                    .erptab2 tr td{
                    border-top:0px solid #ccc!important;
                    padding:0.75rem!important;
                    }
                    .erptab1 tr td{
                    border-top:0px solid #ccc!important;
                    padding:0.40rem!important;
                    }
                    .erptab{
                    border:1px solid #ccc!important;
                    }
                    b.text {
                    float: revert;
                    /* float: right; */
                    /* padding-left: 49px; */
                    /* text-align: center; */
                    display: flex;
                    justify-content: center;
                    }
                    .content-wrapper td{
                    padding-right: 6px;

                     }

                    .erpint{
                    border: 1px solid #b3acac;
                    padding: 3px;
                    margin-bottom: 15px;
                    }
                    </style>

                    <div class="page-content">
                    <div class="content-wrapper">

                    <?php include "savealert.php"; ?>

                    <div class="content pt-0" style="margin-top:20px;">
                    <table class="table erptab" style="width:100%">
                    <tr style="background: #0288d1;">
                    <td colspan="6"><div style="text-transform:capitalize;color:white;font-size: 15px;">

                    <?php echo $pageName; ?>


                    </div>

                    </td>
                    </tr>

                    </table>

                    <div class="row">

                    <div class="col-xl-12">
                    <div class="card">
                    <div style="padding: 25px;">


                <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">

                <input name="editId" type="hidden" id="editId" value="<?php echo encode($gateLastId); ?>">


                     <br>

              <table class="table erptab table-hover" style="width:100%; margin-top: 15px;">

              <tr>

                    <?php
                    if($_GET['styleid']!=''){
                    include "top-style.php";
                    }
                    ?>


                    <td><div style="text-transform:capitalize;"><b>Requisition No.</b></div></td>
                    <td><input style="width:200px; height:40px;" type="text" class="erpint" name="requisition_no" id="ewbn"  value="<?php echo $operationData['requisition_no'] ?>"></td>

                    <td><div style="text-transform:capitalize"><b class="text">Issuance No.</b></div></td>

                    <td><input style="width:200px; height:40px;" type="text" class="erpint" name="issuance_no" id="isno"  value="<?php echo $operationData['issuance_no'] ?>"></td>

                    <td><div style="text-transform:capitalize;"><b class="text">Issuance Date</b></div></td>
                    <td><input style="width:200px; height:40px;" type="text" class="erpint" name="Issuance_date" id="datepicker1" value="<?php echo $operationData['Issuance_date'] ?>"></td>

                    </tr>

                    <tr>
                    <td><div style="text-transform:capitalize"><b>Issued By</b></div></td>
                    <td><input style="width:200px; height:40px;" type="text" class="erpint" name="issued_by" id="ewbn"  value="<?php echo $operationData['issued_by'] ?>"></td>

                    <td><div style="text-transform:capitalize;"><b class="text">Requisition Type</b></div></td>
                    <td><input style="width:200px; height:40px;" type="text" class="erpint" name="requisition_type" id="ewbn" value="<?php echo $operationData['requisition_type'] ?>"></td>

                    <td><div style="text-transform:capitalize"><b>Requisition Date</b></div></td>
                    <td><input style="width:200px; height:40px;" type="text" class="erpint" name="requisition_date" id="lrd" value="<?php echo $operationData['requisition_date'] ?>"></td>


                     </tr>
                    <tr>



                    <td><div style="text-transform:capitalize"><b>Requsted By</b></div></td>

                    <td><input style="width:200px; height:40px;" type="text" class="erpint" name="requsted_by" id="lrd" value="<?php echo $operationData['requsted_by'] ?>"></td>


                    <td><div style="text-transform:capitalize"><b class="text">Requested From</b></div></td>

                    <td><input style="width:200px; height:40px;" type="text" class="erpint" name="requested_from" id="lrd" value="<?php echo $operationData['requested_from'] ?>"></td>

                    <td><div style="text-transform:capitalize"><b>Due Date</b></div></td>

                    <td><input style="width:200px; height:40px;" type="text" class="erpint" name="due_date" id="lrd" value="<?php echo $operationData['due_date'] ?>"></td>


                       </tr>


                    <script>
                    function showsupplierdetail(id){
                    $('#supplierId').load('loadotherdetails.php?action=supplierdetail&id='+id);
                    }
                    showsupplierdetail('<?php echo $operationData['ponumber']; ?>');
                    </script>
                    </tr>

                    <table class="table table-bordered">
                    <thead bgcolor="#333333" style="color:white;">
                    <tr>
                    <th>Item Name</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Requested Quantity</th>
                    <th>Quantity Available</th>
                    <th>Quantity Issued</th>
                    <th>Remarks</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>

                    </tbody>
                    </table>
                    </br>


                    </tr>


                    </table>


                    </table>

                    <input name="action" type="hidden" id="action" value="issuancemaintenance"/>

                    <input type="hidden" name="editId" value="<?php echo $operationData['id']; ?>">

                    <input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">



                    <button name="Submit1" type="submit" class="btn btn-primary" style="float:right">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>

                     </div>

                    </div>

                    </div>
                    </form>
                    </div>

                    </div>

                    </div>

                    </div>

                    <p>

                    <style>
                    .datatable-scroll
                    {
                    overflow:auto!important;
                    }
                    </style>
                    </p>

                    <p>&nbsp;</p>

                    <p>&nbsp; </p>

                    <script>

       var date = new Date();
       var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

   var optSimple = {
  format: 'mm-dd-yyyy',
  todayHighlight: true,
  orientation: 'bottom right',
  autoclose: true,
  container: '#sandbox'
};

var optComponent = {
  format: 'mm-dd-yyyy',
  container: '#datePicker',
  orientation: 'auto top',
  todayHighlight: true,
  autoclose: true
};

// SIMPLE
$( '#simple' ).datepicker( optSimple );

// COMPONENT
$( '#datePicker' ).datepicker( optComponent );

// ===================================

$( '#datepicker1' ).datepicker({
  format: "mm : dd : yyyy",
  todayHighlight: true,
  autoclose: true,
  container: '#box1',
  orientation: 'top right'
});

$( '#datepicker2' ).datepicker({
  format: 'mm \\ dd \\ yyyy',
  todayHighlight: true,
  autoclose: true,
  container: '#box2',
  orientation: 'top right'
});

$( '#datepicker1, #datepicker2, #simple, #datePicker' ).datepicker( 'setDate', today );
    </script>