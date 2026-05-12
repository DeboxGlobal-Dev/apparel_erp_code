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

$namevalue ='addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'"';
$gateLast = addlistinggetlastid('externalChallan',$namevalue);
$gateLastId= mysql_insert_id();
}
if($_GET['id']!=''){

$rs=GetPageRecord('*','externalChallan','id="'.decode($_GET['id']).'"');
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
             if($_GET['id']!=''){


             $rrrl=GetPageRecord('*','externalChallan','1 and id="'.decode($_GET['id']).'"');
                $operationData=mysqli_fetch_array($rrrl);
             }
             ?>
          <div class="card-body listc">
            <div class="">
              <div align="center" style="margin: 0px 10px 30px;font-size: 16px;line-height: 27px;">Apparel ERP</div>
            </div>
            <!--<hr>-->
            <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
              <input name="action" type="hidden" id="action" value="externalchallan" />
              <input name="editId" type="hidden" id="editId" value="<?php echo $gateLastId;  ?>">
              <div class="row">
                <table class="table erptab" style="width:100%">
                  <tr style="background: #0288d1;">
                    <td colspan="6"><div style="text-transform:capitalize;color:white;font-size: 15px;">ISSUE CHALLAN </div></td>
                  </tr>
                </table>
                <div class="col-sm-3">
                  <table class="table erptab" style="width:100%">
                    <tr>
                      <td><div style="text-transform:capitalize"><b>Factory&nbsp;Name</b></div></td>
                      <td id=""><input style="width:100%;" type="text" class="erpint" name="factoryname" id="factoryname" value="<?php echo $operationData['factoryname']; ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td><div style="text-transform:capitalize"><b>Address</b></div></td>
                      <td id=""><input style="width:100%;" type="text" class="erpint" name="factoryaddress" id="factoryaddress" value="<?php echo $operationData['factoryaddress']; ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td><div style="text-transform:capitalize"><b>Phone&nbsp;Number</b></div></td>
                      <td id=""><input style="width:100%;" type="text" class="erpint" name="factoryphone" id="factoryphone" value="<?php echo $operationData['factoryphone']; ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td><div style="text-transform:capitalize"><b>GSTN</b></div></td>
                      <td id=""><input style="width:100%;" type="text" class="erpint" name="factorygstn" id="factorygstn" value="<?php echo $operationData['factorygstn']; ?>" >
                      </td>
                    </tr>
                    <tr>
                      <td><div style="text-transform:capitalize"><b>State</b></div></td>
                      <td id=""><input style="width:100%;" type="text" class="erpint" name="factorystate" id="factorystate" value="<?php echo $operationData['factorystate']; ?>"  >
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="col-sm-3">
                  <table class="table erptab" style="width:100%">
                    <tr>
                      <td><div style="text-transform:capitalize"><b>Supplier&nbsp;Name</b></div></td>
                      <td><select name="supplier" id="supplier" class="erpint" style="width:100%;" onchange="changesupplier(this.value);" >
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
                      <td><div style="text-transform:capitalize"><b>Address</b></div></td>
                      <td id="addr"><input style="width:100%;" type="text" class="erpint" name="" id="" value="<?php echo $operationData['address']; ?>" readonly>
                      </td>
                    </tr>
                    <tr>
                      <td><div style="text-transform:capitalize"><b>Phone&nbsp;Number</b></div></td>
                      <td id="phn"><input style="width:100%;" type="text" class="erpint" name="" id="" value="<?php echo $operationData['phone']; ?>" readonly>
                      </td>
                    </tr>
                    <tr>
                      <td><div style="text-transform:capitalize"><b>GSTN</b></div></td>
                      <td id="gst"><input style="width:100%;" type="text" class="erpint" name="" id="" value="<?php echo $operationData['gstn']; ?>" readonly>
                      </td>
                    </tr>
                    <tr>
                      <td><div style="text-transform:capitalize"><b>State</b></div></td>
                      <td id="state"><input style="width:100%;" type="text" class="erpint" name="" id="" value="<?php echo $operationData['state']; ?>" readonly >
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="col-sm-3">
                  <table class="table erptab" style="width:100%">
                    <tr>
                      <td><div style="text-transform:capitalize"><b>Style&nbsp;No</b></div></td>
                      <td><select name="stylenum" id="stylenum" class="erpint" style="width:100%;" onchange="changestyleindent(this.value);changestylestyle_u(this.value);" >
                          <option value="">Select</option>
                          <?php

								$fcref=GetPageRecord('*','queryMaster','1 and subject!="" and deletestatus=0 order by id desc');
								while($refData=mysqli_fetch_array($fcref)){ ?>
                          <option value="<?php echo $refData['id']; ?>" style-type="<?php echo $refData['sampleStyle']; ?>" <?php if($refData['id']==$operationData['stylenum']){ ?> selected <?php } ?>>#<?php echo $refData['styleRefId']; ?></option>
                          <?php }   ?>

						  <?php

								$fcrefReq=GetPageRecord('*','yarnRequisition','1 and requisitionNo!=""  order by id desc');
								while($refDataReq=mysqli_fetch_array($fcrefReq)){ ?>
                          <option value="<?php echo $refDataReq['requisitionNo']; ?>" style-type="yarn" <?php if($refDataReq['requisitionNo']==$operationData['stylenum']){ ?> selected <?php } ?>>#<?php echo $refDataReq['requisitionNo']; ?></option>
                          <?php }   ?>

						  <?php

								$fcrefReqGr=GetPageRecord('*','greigeRequisition','1 and requisitionNo!=""  order by id desc');
								while($refDataReqGr=mysqli_fetch_array($fcrefReqGr)){ ?>
                          <option value="<?php echo $refDataReqGr['requisitionNo']; ?>" style-type="greige" <?php if($refDataReqGr['requisitionNo']==$operationData['stylenum']){ ?> selected <?php } ?>>#<?php echo $refDataReqGr['requisitionNo']; ?></option>
                          <?php }   ?>

                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td><div style="text-transform:capitalize"><b>Indent&nbsp;No.</b></div></td>
                      <td id="indentno"><input style="width:100%;" type="text" class="erpint" name="indentnum" id="indentnum" value="<?php echo $operationData['indentnum']; ?>" readonly>
                      </td>
                    </tr>
                    <tr>
                      <td><div style="text-transform:capitalize"><b>PO&nbsp;Number</b></div></td>
                      <td id=""><!--<input style="width:100%;" type="text" class="erpint" name="pono" id="pono" value="<?php echo $operationData['pono']; ?>" >-->
                        <select name="pono" id="pono" class="erpint" style="width:100%;" >
                          <option value="">Select</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td><div style="text-transform:capitalize" ><b>Process</b></div></td>
                      <td><select name="process" id="process" class="erpint"style="width:100%;">
                          <option value="">Select</option>
							<?php
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where=' 1 and deletestatus=0 order by id asc';
							$rspl=GetPageRecord($select,'processLossMaster',$where);
							while($rsplList=mysqli_fetch_array($rspl)){
							?>
							<option value="<?php echo $rsplList['name']; ?>"  <?php if($operationData['process']==$rsplList['name']){ ?> selected <?php } ?>><?php echo $rsplList['name']; ?></option>
							<?php } ?>

                        </select>
                      </td>
                    </tr>
                    <!--      <tr>-->
                    <!--   <td><div style="text-transform:capitalize"><b>Eway&nbsp;No.</b></div></td>-->
                    <!--    <td><input style="width:100%;" type="text" class="erpint" name="vehicleno" id="vehicleno" value="<?php echo$operationData['vehicleno'] ?>"> </td>-->
                    <!--</tr>-->
                    <tr>
                      <td><div style="text-transform:capitalize"><b>Challan&nbsp;Type</b></div></td>
                      <td><select name="challantype" id="challantype" class="erpint" style="width:100%;" required>
                          <option>Select</option>
                          <option value="Non-Returnable" <?php if($operationData['challantype']=='Non-Returnable'){ ?> selected <?php } ?>>Non-Returnable</option>
                          <option value="Returnable" <?php if($operationData['challantype']=='Returnable'){ ?> selected <?php } ?>>Returnable</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td><div style="text-transform:capitalize"><b>Person&nbsp;Name</b></div></td>
                      <td><input style="width:100%;" type="text" class="erpint" name="personname" id="personname" value="<?php echo $operationData['personname'] ?>">
                      </td>
                    </tr>
                    <?php
                    if($_GET['id']!=''){

                    ?>
                    <tr>
                      <td><div style="text-transform:capitalize"><b>Department</b></div></td>
                      <td>
                      <select name="departmentId" id="departmentId" class="erpint"style="width:100%;">
                          <option value="">Select</option>
                      <?php
                      $rsDepartment=GetPageRecord('id,name','departmentMaster','1 and id in (13,21,20,14,15,17) order by field(id, 13,21,20,14,15,17)');
                      while($rsDepartmentList=mysqli_fetch_array($rsDepartment)){
                      ?>
                      <option value="<?php echo $rsDepartmentList['id']; ?>"  <?php if($operationData['departmentId']==$rsDepartmentList['id']){ ?> selected <?php } ?>><?php echo $rsDepartmentList['name']; ?></option>
                      <?php } ?>
                      </select>
                      </td>
                    </tr>
                    <?php } ?>
                  </table>
                </div>
                <div class="col-sm-3">
                  <table class="table erptab" style="width:100%">
                    <tr>
                      <td><div style="text-transform:capitalize"><b>Dispatch&nbsp;Note</b></div></td>
                      <td><input style="width:100%;" type="text" class="erpint" name="dispatch" id="dispatch" value="<?php echo $operationData['dispatch'] ?>">
                      </td>
                    </tr>
                    <tr>
                      <td><div style="text-transform:capitalize"><b>Challan&nbsp;No.</b></div></td>
                      <td><input style="width:100%;" type="text" class="erpint" name="" id="" value="" readonly placeholder="AUTO">
                      </td>
                    </tr>
                    <tr>
                      <td><div style="text-transform:capitalize"><b>Date</b></div></td>
                      <td><input style="width:100%;" type="date" class="erpint" name="date" id="date" value="<?php echo $operationData['date'] ?>" <?php if($_GET['id']!=''){ ?>  readonly  <?php }  ?>>
                      </td>
                    </tr>
                    <tr>
                      <td><div style="text-transform:capitalize"><b>Vehicle&nbsp;No.</b></div></td>
                      <td><input style="width:100%;" type="text" class="erpint" name="vehiclenum" id="vehiclenum" value="<?php echo $operationData['vehiclenum'] ?>">
                      </td>
                    </tr>
                    <tr>
                      <td><div style="text-transform:capitalize"><b>Gate&nbsp;No.</b></div></td>
                      <td><input style="width:100%;" type="text" class="erpint" name="gatenum" id="gatenum" value="<?php echo $operationData['gatenum'] ?>">
                      </td>
                    </tr>
                    <tr>
                      <td><div style="text-transform:capitalize"><b>Eway&nbsp;No.</b></div></td>
                      <td><input style="width:100%;" type="text" class="erpint" name="ewaynum" id="ewaynum" value="<?php echo $operationData['ewaynum'] ?>">
                      </td>
                    </tr>
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

                      <th style="text-align:center; color:white; <?php if($_GET['id']==''){ ?> display:none; <?php } ?>">Qty&nbsp;Issued</th>
                      <th style="text-align:center; color:white; <?php if($_GET['id']==''){ ?> display:none; <?php } ?>">Qty&nbsp;Received</th>
                      <th style="text-align:center; color:white; <?php if($_GET['id']==''){ ?> display:none; <?php } ?>">Qty&nbsp;Remain</th>
                      <!--<th style="text-align:center; color:#fff;">Discount&nbsp;Amt.</th>-->
                      <!--<th style="text-align:center; color:#fff;">Taxable&nbsp;Value</th>-->



                      <th colspan="2" style="text-align:center; color:white;">Cost</th>
                      <th colspan="2" style="text-align:center; color:white;">SGST</th>
                      <th colspan="2" style="text-align:center; color:white;">IGST</th>
                      <th colspan="2" style="text-align:center; color:white;">TCS</th>
                    </tr>
                    <tr class="border-top-info">
                      <th align="center"><div align="center"><a onClick="addNewRow(1,$('#pono').val());" style="color:#0000FF; cursor: pointer;">+Add&nbsp;New</a></div></th>
                      <th><div align="center"></div></th>
                      <th><div align="center"></div></th>
                      <th style="width:30%;"><div align="center"></div></th>
                      <th><div align="center"></div></th>
                      <!--<th><div align="center"></div></th>-->
                      <th><div align="center"></div></th>
                      <th><div align="center"></div></th>
                      <th><div align="center"></div></th>

                      <th><div align="center" style="<?php if($_GET['id']==''){ ?> display:none; <?php } ?>"></div></th>
                      <th><div align="center" style="<?php if($_GET['id']==''){ ?> display:none; <?php } ?>"></div></th>
                      <th><div align="center" style="<?php if($_GET['id']==''){ ?> display:none; <?php } ?>"></div></th>

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
                  <tbody id="addrow">
                  </tbody>
                  <script>
        function addNewRow(id,po){
        if(id==1){
        $("#addrow").load('loadexternalchallan.php?add=1&parentId=<?php echo encode($gateLastId); ?>&po='+po);
        }else{
        $("#addrow").load('loadexternalchallan.php?parentId=<?php echo encode($gateLastId); ?>&po='+po);
        }

        }
        addNewRow(0,'<?php echo $operationData['pono'] ?>');

        function deleteRow(id){
        var checkyes = confirm('Are your sure you you want to delete?');
        if(checkyes==true){
        $('#addrow').load('loadexternalchallan.php?id='+id+'&deletestatus=yes&parentId=<?php echo encode($gateLastId); ?>&po=<?php echo $operationData['pono'] ?>');
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
</div>
</div>
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
<script>
function changestyleindent(style){
	var styleType = $('#stylenum').find('option:selected').attr('style-type');
	$('#indentno').load('loadbrand.php?styleid='+style+'&styleType='+styleType+'&action=changestyleindent');


}

function changestylestyle_u(style){
	var styleType = $('#stylenum').find('option:selected').attr('style-type');
	$('#pono').load('loadbrand.php?styleid='+style+'&styleType='+styleType+'&action=changestylepoumber_data&data_id=<?php echo decode($_GET['id']); ?>');

}

</script>
<?php
 if($_GET['id']!=''){
     ?>
<script>
         changestylestyle_u('<?php echo $operationData['stylenum']; ?>');
         </script>
<?php

 }

 ?>
