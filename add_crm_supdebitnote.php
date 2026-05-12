
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


if($_GET['id']==''){
$namevalue ='addedBy="'.$_SESSION['userid'].'"';
$gateLastId = addlistinggetlastid('debitNoteMaster',$namevalue);
$gateLastId= mysql_insert_id();
}
if($_GET['id']!=''){

$rs=GetPageRecord('*','debitNoteMaster','id="'.decode($_GET['id']).'"');
$editresult=mysqli_fetch_array($rs);
$gateLastId = $editresult['id'];
}

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
             $rrrl=GetPageRecord('*','debitNoteMaster','1 and id="'.decode($_GET['id']).'"');
                $operationData=mysqli_fetch_array($rrrl);
             ?>
              <div class="card-body listc">
                <div class="">
                <div align="center" style="margin: 0px 10px 30px;font-size: 16px;line-height: 27px;">DEBOX GLOBAL<br>SECTOR-2<br>NOIDA - UTTAR PRADESH, INDIA</div>
              </div>
              <hr>

  <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
          <input name="action" type="hidden" id="action" value="supplierdebitnote" />
          <input name="editId" type="hidden" id="editId" value="<?php echo encode($gateLastId); ?>">
<div class="row">
    <!--<div>Details of Supplier</div>  -->
    <!--<br> -->
<div class="row">
    <div class="col-md-4">
      <div class="row">


                    <div class="col-md-12">
            <div class="form-group">
            <label>Debit&nbsp;Note&nbsp;Number</label>
            <input type="text" name="debitnoteno" style="padding: 5px"
            value="<?php echo 'DBT/'.date('y',$operationData['dateAdded']).'/'.date('m',$operationData['dateAdded']).'/'.makeQueryId($operationData['id']) ?>"

            class="form-control" readonly="readonly">
            </div>
          </div>

                    <div class="col-md-12">
            <div class="form-group">
            <label>PO&nbsp;Number</label>
            <div id="data"></div>
            <select name="poNumber" id="supplierpo" class="form-control" onchange="addNewRow(0,this.value)">
            <option value="">Select</option>
          </select>
           <?php
// 			$url = "".$fullurl."accounts/accountGroupAPI.php";
// 			$ch = curl_init();
// 			curl_setopt($ch, CURLOPT_URL, $url);
// 			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 			$accGroup = curl_exec($ch);
// 			$accresult = json_decode($accGroup, true);
// 			curl_close($ch);
		   ?>
          <!--<select name="poNumber" class="form-control" onchange="changeAccount(this.value)">-->
             <!--<option value="">Select</option>-->
            <?php
			 // if(isset($accresult['status']))
			 // {
				// foreach($accresult['AccountGroupData'] as $result)
				// {
				?>
            <!--<option value="<?php // echo $result['GroupId']; ?>"><?php // echo $result['GroupName']; ?></option>-->
            <?php
				// }
			 // }
			  ?>
          <!--</select>-->
            </div>
          </div>



          <div class="col-md-12">
            <div class="form-group">
            <label>Bill&nbsp;Date</label>
            <input id="billdate" name="billdate" style="padding: 5px" value="<?php echo $operationData['billdate'] ?>" class="form-control">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
            <label>Bill&nbsp;Number</label>
            <input type="text" name="billno" style="padding: 5px" value="<?php echo $operationData['billNumber'] ?>" class="form-control">
            </div>
          </div>





    </div>
  </div>
    <div class="col-md-4">
      <div class="row">


          <div class="col-md-12">
            <div class="form-group">
            <label>Debit&nbsp;S&nbsp;No.</label>
            <input type="text" name="debitnoteno" style="padding: 5px"
            value=""

            class="form-control" >
            </div>
          </div>


          <div class="col-md-12">
                      <div class="form-group">
                        <label>Indent Number</label>
                        <input type="text" name="orderno" style="padding: 7px" value="<?php echo $operationData['orderno']; ?>" class="form-control">
                    </div>
                    </div>

                     <div class="col-md-12">
                      <div class="form-group">
                        <label>Department</label>
                        <input name="Department" type="text" style="padding: 7px" value="" class="form-control" >
                    </div>
                    </div>

                     <div class="col-md-12">
                      <div class="form-group">
                        <label>Supplier Gst No.</label>
                        <input name="gstn" type="text" style="padding: 7px" value="<?php echo $operationData['gstn']; ?>" class="form-control" >
                    </div>
                    </div>
    </div>
  </div>

  <script type="text/javascript">
 function changesupaddr(supplier){
  $('#supaddress').load('loadbrand.php?action=changesupaddress&supplier='+supplier);
}
changesupaddr(<?php echo $operationData['supplierId'] ?>);
 function changespo(supplier){
  $('#supplierpo').load('loadbrand.php?action=changesupplierpo&supplier='+supplier+'&poId=<?php echo $operationData['poNumber'] ?>');
}
</script>
  <div class="col-md-4">
    <div style=""class="row">

          <div class="col-md-12">
            <div class="form-group">
            <label>Date</label>
            <input type="text" style="padding: 5px" value="<?php echo date('d-m-Y h:i:s A',$operationData['dateAdded']) ?>" class="form-control" readonly="readonly">
            </div>
          </div>


          <div class="col-md-12">
                      <div class="form-group">
                        <label>Supplier </label>
                        <div id="supaddress">
                        <input name="" value="<?php echo $operationData[''] ?>" type="text" style="padding: 7px" class="form-control">
                      </div>
                    </div>
                    </div>

          <div class="col-md-12">
                      <div class="form-group">
                        <label>Supplier Address</label>
                        <div id="supaddress">
                        <input name="address" value="<?php echo $operationData[''] ?>" type="text" style="padding: 7px" class="form-control">
                      </div>
                    </div>
                    </div>

                       <div class="col-md-12">
                      <div class="form-group">
                        <label>State Code</label>
                        <input name="scode" type="text" style="padding: 7px" value="<?php echo $operationData['statecode']; ?>" class="form-control" >
                    </div>
                    </div>


          <script type="text/javascript">
            changespo(<?php echo $operationData['supplierId'] ?>);
          </script>

    </div>

        </div>
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
                <tr>
                  <th style="background-color: #9aabff;color: white" colspan="19"><div align="center">Debit&nbsp;Desc</div></th>
                </tr>
                <tr class="border-top-info" style="background-color: #9aabff;">
                  <th>&nbsp;</th>

                  <th colspan="3" align="center" style="text-align:center; color:#fff;">Paticulars</th>
                 <th style="text-align:center; color:#fff;">UOM</th>
                 <th style="text-align:center; color:#fff;">Bill&nbsp;No.</th>
                 <th style="text-align:center; color:#fff;">Qty</th>
                 <th style="text-align:center; color:#fff;">Rate</th>
                 <th style="text-align:center; color:#fff;">Amount</th>
                 <th style="text-align:center; color:#fff;">Discount&nbsp;Amt.</th>
                 <th style="text-align:center; color:#fff;">Taxable&nbsp;Value</th>
                 <th colspan="2" style="text-align:center; color:#fff;">CGST&nbsp;AMT.</th>
                 <th colspan="2" style="text-align:center; color:#fff;">SGST&nbsp;AMT.</th>
                 <th colspan="2" style="text-align:center; color:#fff;">IGST&nbsp;AMT.</th>
                 <th colspan="2" style="text-align:center; color:#fff;">UTGST&nbsp;AMT.</th>
                </tr>
                <tr class="border-top-info">
<th align="center"><div align="center"><a onClick="addNewRow(1,<?php echo $operationData['poNumber'] ?>);" style="color:#0000FF; cursor: pointer;">+Add&nbsp;New</a></div></th>
                  <th><div align="center">Item&nbsp;Code</div></th>
                  <th><div align="center">HSN&nbsp;Code</div></th>
                  <th style="width:30%;"><div align="center">Reason</div></th>
                  <th><div align="center"></div></th>
                  <th><div align="center"></div></th>
                  <th><div align="center"></div></th>
                  <th><div align="center"></div></th>
                  <th><div align="center"></div></th>
                  <th><div align="center"></div></th>
                  <th><div align="center"></div></th>
                  <th><div align="center">Rate (%)</div></th>
                  <th><div align="center">Amt.</div></th>
                  <th><div align="center">Rate (%)</div></th>
                  <th><div align="center">Amt.</div></th>
                  <th><div align="center">Rate (%)</div></th>
                  <th><div align="center">Amt.</div></th>
                  <th><div align="center">Rate (%)</div></th>
                  <th><div align="center">Amt.</div></th>



                </tr>
              </thead>

               <tbody id="addrow"></tbody>

        <script>
        function addNewRow(id,po){
        if(id==1){
        $("#addrow").load('loadsupdebitnote.php?add=1&parentId=<?php echo encode($gateLastId); ?>&po='+po);
        }else{
        $("#addrow").load('loadsupdebitnote.php?parentId=<?php echo encode($gateLastId); ?>&po='+po);
        }

        }
        addNewRow(0,<?php echo $operationData['poNumber'] ?>);

        function deleteRow(id){
        var checkyes = confirm('Are your sure you you want to delete?');
        if(checkyes==true){
        $('#addrow').load('loadsupdebitnote.php?id='+id+'&deletestatus=yes&parentId=<?php echo encode($gateLastId); ?>&po=<?php echo $operationData['poNumber'] ?>');
        }
        }
        </script>


        <tr class="border-top-info" style="font-weight: 500; font-size: 13px;">
                  <th align="center"><div align="center"></div></th>
                  <th><div align="center">Total</div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center" id="totalqty">0</div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center" id="totalamnt">0.00</div></th>
                  <th><div align="center"> </div></th>
                  <th><div align="center" id="totaltax">0.00</div></th>
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
            <div class="row">
              <div class="col-md-4">
                  <table class="table table-bordered" width="100%">

                    <tr>
                      <td align="center"><div>Delivered By</div></td>
                      <td align="center">
                          <select id="" name="delivery" class="form-control">
                          <option>Select</option>
                           <option value="1" <?php if($operationData['deliverby'] == 1) { echo "selected"; } ?>>By Hand</option>
                          <option value="2" <?php if($operationData['deliverby'] == 2) { echo "selected"; } ?>>By Courier</option>
                      </select>
                      </td>
                    </tr>
                    <tr>
                      <td align="center"><div>AWB NO</div></td>
                      <td align="center"><input value="<?php echo $operationData['awbno'] ?>" class="form-control" name="awb" type="text" ></td>
                    </tr>
                    <tr>
                      <td align="center"><div>Date</div></td>
                      <td align="center"><input class="form-control" id="newdate" value="<?php echo $operationData['deliverdate'] ?>" name="newdate"></td>
                    </tr>
                     <script>
$( function(){
  $( "#newdate").datepicker();
} );
</script>
                    <tr>
                         <td align="center"><div>Remark</div></td>
                      <td align="center"><input value="<?php echo $operationData['remarks'] ?>" class="form-control" name="remark" type="text"></td>
                    </tr>
                  </table>
                </div>
                <div class="col-md-4">


                </div>
                 <div class="col-md-4">
            <table class="table table-bordered" width="100%">
                    <tr style="background-color: #fdffe0;">
                      <td><div align="center" style="color: black;font-weight: 600">Tax&nbsp;Details</div></td>
                      <td><div align="center" style="color: black;font-weight: 600">Amount</div></td>
                    </tr>
                    <tr>
                      <td align="center"><div>CGST AMOUNT</div></td>
                      <td align="center"><div id="totalcgst1">0.00</div></td>
                    </tr>
                    <tr>
                      <td align="center"><div>SGST AMOUNT</div></td>
                      <td align="center"><div id="totalsgst1">0.00</div></td>
                    </tr>
                    <tr>
                      <td align="center"><div>IGST AMOUNT</div></td>
                      <td align="center"><div id="totaligst1">0.00</div></td>
                    </tr>
                    <tr>
                      <td align="center"><div>UTGST AMOUNT</div></td>
                      <td align="center"><div id="totalutgst1">0.00</div></td>
                    </tr>
                  </table>
                </div>
              </div>
              <br>


             <br>
            <button type="submit" class="btn btn-primary" style="float:right">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>
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