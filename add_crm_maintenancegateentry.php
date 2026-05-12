<?php

if($_GET['id']==''){

deleteRecord('maintenancegateentrymaster','1 and parentId=0 and gateno="" and registerno="" and potype=""');
deleteRecord('maintenancegateentrymaster','1 and supplierPurchaseOrderId!="" and qty=""');


$namevalue ='addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'"';
$gateLastId = addlistinggetlastid('maintenancegateentrymaster',$namevalue);
$gateEntryNo = 'GE-'.date('dmy').'-'.$gateLastId;
}

if($_GET['id']!=''){

$rs=GetPageRecord('*','maintenancegateentrymaster','id="'.decode($_GET['id']).'"');
$editresult=mysqli_fetch_array($rs);
$gateLastId = $editresult['id'];
$gateEntryNo = 'GE-'.date('dmy',strtotime($editresult['entrydate'])).'-'.$gateLastId;

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
.erpint{
    border: 1px solid #b3acac;
    padding: 3px;
}
</style>
	<div class="page-content">

		<div class="content-wrapper">
		 <?php include "savealert.php"; ?>

 	<div class="content pt-0" style="margin-top:20px;">
 	     <table class="table erptab" style="width:100%">
                   <tr style="background: #0288d1;">
                         <td colspan="6"><div style="text-transform:capitalize;color:white;font-size: 15px;">
                         Gate Entry

                         </div>
                         </td>
                     </tr>
                     </table>
 				<div class="row">

				<div class="col-xl-12">
				<div class="card">
				    <div style="padding: 25px;">
				<?php

				if($_GET['id']!=""){
				 $rrrr=GetPageRecord('*','maintenancegateentrymaster','1 and id="'.decode($_GET['id']).'"');
				$operationData=mysqli_fetch_array($rrrr);
				}
				?>
				<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">

					<input name="editId" type="hidden" id="editId" value="<?php echo encode($gateLastId); ?>">


               <br>

               <table class="table erptab table-hover" style="width:100%">
                     <tr>
                          <td style="width:26%"><div style="text-transform:capitalize;"><b>Gate Entry No</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint readonly" name="gateentryno" id="curr" value="<?php echo $gateEntryNo; ?>" readonly="readonly"></td>
                          <td><div style="text-transform:capitalize"><b>Entry Date</b></div></td>
                         <td>
                            <input style="width:100%;" type="date" class="erpint readonly" name="entrydate" id="delivery" value="<?php if($operationData['entrydate']!=''){ echo $operationData['entrydate']; }else{ echo date("Y-m-d"); } ?>"></td>


                     </tr>
                          <tr>
                              <td><div style="text-transform:capitalize;"><b>Entry Time</b></div></td>
                         <td><input style="width:100%;" type="time" class="erpint " name="entrytime" id="ewbd" value="<?php if($operationData['entrytime']!=''){ echo $operationData['entrytime']; }else{ echo date("h:i A"); } ?>"></td>
                                <td><div style="text-transform:capitalize"><b>Gate No.</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="gateno" id="lrd" value="<?php echo $operationData['gateno'] ?>"></td>


                     </tr>
                     <tr>
                        <td><div style="text-transform:capitalize;"><b>Register No.</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="registerno" id="ewbn" value="<?php echo $operationData['registerno'] ?>"></td>
                         <td style="width:26%"><div style="text-transform:capitalize"><b>PO Type</b></div></td>
                         <td>
                          <select name="potype" style="width: 100%" class="erpint">
                            <option value="">Select</option>
        <option value="1"  <?php if($operationData['potype'] == "1") { ?> selected <?php } ?>  >Procurement</option>
        <option value="2" <?php if($operationData['potype'] == "2") { ?> selected <?php } ?>>Job Work</option>
       <option value="3" <?php if($operationData['potype'] == "3") { ?> selected <?php } ?> >Service</option>
                          </select>

                          </td>
                     </tr>

                          <td style="width:18%;"><div style="text-transform:capitalize;"><b>PO Number</b></div></td>
                         <td>
                             <?php
                             $rf=GetPageRecord('*','maintenancegateentrymaster','1 and parentId="'.$operationData['id'].'"');
		                   $rc=mysqli_fetch_array($rf);

		                   ?>
						 <select name="ponumber" id="ponumber" class="erpint " style="border: 1px solid;width:100%;" onchange="addnewline(1);showsupplierdetail(this.value);disable();"<?php if($operationData['id']==$rc['parentId']){ ?> disabled <?php } ?> >



							 <option value="">Select</option>
							<?php

							$rsLi=GetPageRecord('*','requisitionIndentMaster','releasedpo="1"');
				while($queryLi=mysqli_fetch_array($rsLi)){


							?>


                              <option value="<?php echo $queryLi['id']; ?>" <?php if($operationData['ponumber']==$queryLi['id']) { ?> selected <?php } ?>>
                                   <?php
                                    $rssrt=GetPageRecord('*','loadmaintenance','1 and id="'.$queryLi['mainid'].'"');
		   $rrrrt=mysqli_fetch_array($rssrt);


				     $rssrtv=GetPageRecord('*','maintenancegi_Master','1 and id="'.$rrrrt['parentId'].'"');
		   $rrrrtv=mysqli_fetch_array($rssrtv);

                                if($rrrrtv['requisitiontype']==1) {
                                    echo 'GI-'. date('dmy',$rrrrtv['dateAdded']).'-'.$queryLi['id'];
                                }else{
                                    echo 'MN-'. date('dmy',$rrrrtv['dateAdded']).'-'.$queryLi['id'];
                                }


                                ?>
                              </option>
                              <?php } ?>

                             </select>
                             </td>

                         <td><div style="text-transform:capitalize"><b>Supplier</b></div></td>
                         <td>
						 <input style="width:100%;" type="text" class="erpint readonly" name="supplierName" id="supplierName" value="">
						 <input type="hidden" name="supplier" id="supplierId" value="" >
                             <!--<select id="supplierId" name="supplier" class="erpint readonly" style="width:100%;"  >
                                  <option value="">Select</option>
                                 	 <?php
									$select='';
									$where='';
									$rs='';
									$select='*';
									$where='1 and deletestatus=0 order by name asc';
									$rs=GetPageRecord($select,'suppliersMaster',$where);
									while($resListing=mysqli_fetch_array($rs)){
									?>
                                  <option value="<?php echo strip($resListing['id']); ?>" <?php if($operationData['supplier']==$resListing['id']){ ?> selected <?php }?>><?php echo strip($resListing['name']); ?></option>
                                  <?php } ?>
                                </select>-->
<script>
function showsupplierdetail(id){
	$('#supplierId').load('loadotherdetails.php?action=maintenancesupplierdetail&id='+id);


//	$('#ponumber').attr("disabled", true)
}
showsupplierdetail('<?php echo $operationData['ponumber']; ?>');

 function disable(){

	var v = document.getElementById("ponumber");
            v.className += "readonly";
// 	$('#ponumber').attr("disabled", true)
 }
</script>
                     </tr>
                      <tr>

                         <td><div style="text-transform:capitalize"><b>Bill Date</b></div></td>
                         <td><input style="width:100%;" type="date" class="erpint" name="billdate" id="gate" value="<?php echo $operationData['billdate'] ?>"></td>
                         <td style="width:26%"><div style="text-transform:capitalize"><b>Bill No.</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="billno" id="clearing" value="<?php echo $operationData['billno'] ?>" > </td>
                     </tr>
                      <tr>

                         <td><div style="text-transform:capitalize"><b>Vehicle In Time</b></div></td>
                         <td><input style="width:100%;" type="time" class="erpint" name="vehiclein" id="gate" value="<?php echo $operationData['vehiclein'] ?>"></td>
                         <td style="width:26%"><div style="text-transform:capitalize"><b>Vehicle Out Time</b></div></td>
                         <td><input style="width:100%;" type="time" class="erpint" name="vehicleout" id="clearing" value="<?php echo $operationData['vehicleout'] ?>" > </td>
                     </tr>
                      <tr>

                         <td><div style="text-transform:capitalize"><b>Driver Name</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="drivername" id="gate" value="<?php echo $operationData['drivername'] ?>"></td>
                         <td style="width:26%"><div style="text-transform:capitalize"><b>Driver Number</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="drivernumber" id="clearing" value="<?php echo $operationData['drivernumber'] ?>" > </td>
                     </tr>
                      <tr>

                         <td><div style="text-transform:capitalize"><b>Challan No.</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="challanno" id="gate" value="<?php echo $operationData['challanno'] ?>"></td>
                         <td style="width:26%"><div style="text-transform:capitalize"><b>Movement</b></div></td>
                         <td>

                              <select name="movement" style="width: 100%" class="erpint">
                            <option value="">Select</option>
        <option value="Inward"  <?php if($operationData['movement'] == "Inward") { ?> selected <?php } ?>  >Inward</option>
        <option value="Outward" <?php if($operationData['movement'] == "Outward") { ?> selected <?php } ?>>Outward</option>
                          </select>



                     </tr>
					 <tr>

                         <td><div style="text-transform:capitalize"><b>Factory</b></div></td>
                         <td>
						  <select name="factoryId" style="width: 100%" class="erpint">
                            <option value="">Select</option>
        					 <?php
							$select='';
							$where='';
							$rs='';
							$select='*';
							$where='1 and deletestatus=0 order by name asc';
							$rs=GetPageRecord($select,'factoryMaster',$where);
							while($resListing=mysqli_fetch_array($rs)){
							?>
							<option value="<?php echo strip($resListing['id']); ?>" <?php if($operationData['factoryId']==$resListing['id']){ ?> selected <?php }?>><?php echo strip($resListing['name']); ?></option>
							<?php } ?>
                          </select>
						 </td>
                         <td style="width:26%"><div style="text-transform:capitalize"><b>Vehicle No.</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="vehicleNo" id="vehicleNo" value="<?php echo $operationData['vehicleNo'] ?>"></td>
                     </tr>
               </table>
					<input name="action" type="hidden" id="action" value="maintenancegateentrymaster" />

                   <br>
                   <table class="table table-bordered table-hover no-footer">
                    <thead style="background-color: #f5f5f5;">
                      <tr role="row">
                        <th></th>
                        <th>Material</th>
						 <th>Color</th>
                        <th>PO&nbsp;Quantity</th>
                        <th>Quantity&nbsp;Received</th>
						<th>Net&nbsp;Received</th>
                        <th>UOM</th>
						<th>Rate(INR)</th>
                        <th>No.&nbsp;of&nbsp;Packages</th>
                        <th>Value(INR)</th>
                        <th>Dispatch No.</th>

                      </tr>
                    </thead>
                   <tbody id="loadtabledata">

                </tbody>
                <script>
                function addnewline(did){
                  var lastid = '<?php echo encode($gateLastId); ?>';
                  var supplierPurchaseOrderId = $('#ponumber').val();

                  $('#loadtabledata').load('loadmaintenancegateentry.php?action=addnewrow&addsize='+did+'&id='+lastid+'&poid='+supplierPurchaseOrderId);
                }
                addnewline(0);
                </script>
                <script>
                function deleterow(deleteid){
                  $('#loadtabledata').load('loadmaintenancegateentry.php?deletestatus=yes&id=<?php echo encode($gateLastId); ?>&rowid='+deleteid);
                }
                </script>
                 <div id="savedata"></div>
                  </table>
                  <br>
    				              <button name="Submit1" type="submit" class="btn btn-primary" style="float:right">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>




				</div>


 	</div>





</div>
			</form>
			</div>

		</div>

	</div>

</div>

<style>
    .datatable-scroll
    {
        overflow:auto!important;
    }
</style>