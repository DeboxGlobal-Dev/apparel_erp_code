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
if($_GET['id']==''){

deleteRecord('requisitionmaster','styleId="0"');


$namevalue ='addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'"';
$gateLast = addlistinggetlastid('requisitionmaster',$namevalue);
$gateLastId= mysql_insert_id();


}
if($_GET['id']!=''){

$rs=GetPageRecord('*','requisitionmaster','id="'.decode($_GET['id']).'"');
$editresult=mysqli_fetch_array($rs);
$gateLastId = $editresult['id'];

//echo $gateLastId;

}

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
</style>
	<div class="page-content">

		<div class="content-wrapper">
		 <?php include "savealert.php"; ?>

 	<div class="content pt-0" style="margin-top:20px;">

			<div class="row" style="margin-bottom:10px; ">
						<div class="col-xl-12">
						    <!--  <div class="card-header header-elements-inline bg-blue-700 filterable" style="padding: 10px;">
            <div class="col-xl-12">
              <h5 class="card-title" style="text-align:center">De-Box  EXPORTS PVT. LTD.</h5>
            </div>
          </div> -->
							<div class="card mb-0 rounded-bottom-0" style="padding:15px;">
								<div class="col-xl-12">
									<div class="panel panel-flat">
<!--                                       <div style="text-align:center;font-weight:bold;">201, Noida Road,					</div>
 -->
                                 <div style="text-align:center;font-weight:bold;">Item Requisition Plan 						</div>

									</div>
								</div>
								</div>
							</div>
						</div>

			<script>
			function selectStyle(){
			var styleId = $('#styleId').val()
				if(styleId!=''){
					 window.location.href = '<?php echo $fullurl; ?>showpage.crm?module=requisitionform&add=yes&styleid='+styleId;
				}
			}
			</script>

			<?php
			if($_GET['styleid']!=''){
				include "top-style.php";
			}
			?>


				<div class="row">

				<div class="col-xl-12">
				<div class="card">
				    <div style="padding: 25px;">


				<?php
				$rrrr=GetPageRecord('*','requisitionmaster','1 and id="'.decode($_GET['id']).'"');
				$operationData=mysqli_fetch_array($rrrr);

				?>

				<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
					<input name="action" type="hidden" id="action" value="requisition" />
					<input type="hidden" name="styleid" id="styleid" value="<?php echo $_GET['styleid']; ?>" />
					<input name="editId" type="hidden" id="editId" value="<?php echo encode($gateLastId); ?>">

               <table class="table erptab table-hover" style="width:100%">
                     <tr>
                    <td style="width:18%"><div style="text-transform:capitalize;"><b>Requisition No</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="requisitionno" id=""  <?php if($operationData['id'] !="") { ?> value="<?php echo 'REQ-'.date('d',$operationData['dateCreated']).date('m',$operationData['dateCreated']).date('y',$operationData['dateCreated']).'-'.$operationData['id']; ?>"  <?php } else {?> value=""  <?php } ?> readonly>

                         </td>
                          <td style="width:26%"><div style="text-transform:capitalize;text-align:end"><b>Requisition Date</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="requisitiondate" <?php if($operationData['id'] !="") { ?> value="<?php echo date('d-m-Y',$operationData['dateAdded']); ?>"  <?php } else {?> value=""  <?php } ?> readonly></td>

                         </tr>

                       <tr>


                         <td style="width:26%"><div style="text-transform:capitalize;"><b>Style No<?php //echo $gateLastId; ?></b></div></td>
                         <td>
                         <select name="styleno" id="buyer" class="erpint" style="width:100%;" onchange="changeBuyer(this.value);changeBrand(this.value);addnewline(1);" <?php if($operationData['status'] == '1') { ?> disabled <?php } ?>>
                         <option value="">Select</option>
                         <?php

			            	$fcref=GetPageRecord('*','queryMaster','1 and subject!="" and deletestatus=0 order by id desc');
				                      while($refData=mysqli_fetch_array($fcref)){ ?>
                      <option value="<?php echo $refData['id']; ?>" <?php if($operationData['styleId'] == $refData['id']) { ?> selected <?php } ?>>#<?php echo $refData['styleRefId']; ?></option>
                      <?php }   ?>
                    </select>
                  </td>
                  <td><div style="text-transform:capitalize;text-align: right;"> <b>Indent No</b> </div></td>

                         <td id="brand">
                          <input style="width:100%;" type="text" class="erpint" name="indentno" value="<?php echo $operationData['indentno'] ?>" <?php if($operationData['status'] == '1') { ?> disabled <?php } ?>>
                         </td>

                     </tr>

                     <tr>



                         <td><div style="text-transform:capitalize;"><b>Due Date</b></div></td>
                         <td><input style="width:100%;" type="date" class="erpint" name="duedate" id="phone"  value="<?php echo $operationData['duedate']; ?>" <?php if($operationData['status'] == '1') { ?> disabled <?php } ?>></td>
                          <td><div style="text-transform:capitalize;text-align: right;"><b>Order Qty</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="orderqty" id=""  value="<?php echo $operationData['orderqty']; ?>" <?php if($operationData['status'] == '1') { ?> disabled <?php } ?>></td>

                     </tr>
                      <script>
function changeBuyer(style){
  $('#brand').load('loadbrand.php?buyer='+style+'&action=changeindent');
}
function changeBrand(style){
  $('#brandId').load('loadbrand.php?style='+style+'&action=changebrandreq');
}
</script>
          <tr>

         			<td style="width:%"><div style="text-transform:capitalize;"><b>Brand</b></div></td>
                         <td id="brandId" >
                    <input style="width:100%;" type="text" class="erpint" name="brand" value="<?php echo $operationData['brandId'] ?>" readonly>
                        </td>
                        <td><div style="text-transform:capitalize;text-align: right;"><b>Lot</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="lot" id=""  value="<?php echo $operationData['lot']; ?>" <?php if($operationData['status'] == '1') { ?> disabled <?php } ?>></td>

                     </tr>
                     <tr>


                         <td><div style="text-transform:capitalize;"><b>Requested By</b></div></td>
                         <td>
                   <select name="requested" id="requested" class="erpint" style="width:100%;" <?php if($operationData['status'] == '1') { ?> disabled <?php } ?>>
                            <option value="">Select</option>
                      <?php

                  $fcref=GetPageRecord('*','userMaster','1 and (profileId="85" || profileId="92" || profileId="160")') ;
                              while($refData=mysqli_fetch_array($fcref)) {
                              ?>
          <option value="<?php echo $refData['id']; ?>" <?php if($operationData['requested'] == $refData['id']) { ?> selected <?php } ?>><?php echo $refData['firstName']; ?>&nbsp;<?php echo $refData['lastName']; ?></option>
                      <?php }   ?>
                    </select>
                        </td>
                        <td><div style="text-transform:capitalize;text-align: right;"><b>Department</b></div></td>
                         <td>
                         <input style="width:100%;" type="text" class="erpint" name="department" id="lemail"  value="<?php echo $operationData['department']; ?>" <?php if($operationData['status'] == '1') { ?> disabled <?php } ?>>
                         </td>
                     </tr>

                      <tr>


                        <td><div style="text-transform:capitalize;"><b>Requested From</b></div></td>
                         <td>
                         <input style="width:100%;" type="text" class="erpint" name="requestedfrom" id="lemail"  value="<?php echo $operationData['requestedfrom']; ?>" <?php if($operationData['status'] == '1') { ?> disabled <?php } ?>>
                         </td>
                         <td></td>
                         <td></td>
                     </tr>

                     </table>
               <div>
         <br>
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
              <?php
               // if($_GET['id']!="") {
                ?>
              <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">

                <table width="100%">
                  <tr>
                  <td style="padding: 10px;width: 10%"><div style="text-transform:capitalize;"><b>Requisition Type</b></div></td>
                </tr>
                <tr>
                  <td style="padding: 0px 10px;">
                          <select name="requisitiontype" id="requisitiontype" class="erpint" style="width:15%;padding: 5px;border-radius: 4px; " onchange="addnewline(1);" <?php if($operationData['status'] == '1') { ?> disabled <?php } ?>>
                            <option value="">Select</option>

                      <option value="1"  <?php if($operationData['requisitiontype'] == "1") { ?> selected <?php } ?>>Fabric</option>
                    <option value="2" <?php if($operationData['requisitiontype'] == "2") { ?> selected <?php } ?>>Trims</option>
                    <option value="3" <?php if($operationData['requisitiontype'] == "3") { ?> selected <?php } ?>>Packaging</option>
                    </select>
                  </td>
                </tr>
                </table>
                <br>
                <div class="datatable-scroll">
                  <table class="table table-bordered table-hover no-footer">
                    <thead style="background-color: #f5f5f5;">
                      <tr role="row">
                        <th></th>
                        <th width="15%" style="text-align: center;">Item</th>
					              <th style="text-align: center;">Color</th>
                        <th style="text-align: center;">Marker Reference No</th>
                        <th style="text-align: center;">Size </th>
                        <th style="text-align: center;">Average	</th>
						            <th style="text-align: center;">No of Pcs.	</th>
						            <th style="text-align: center;">Quantity</th>
						            <th style="text-align: center;">Available Quantity</th>

                      </tr>
                    </thead>
                    <tbody id="loadtabledata"></tbody>
                 <script>
                function addnewline(did){
                  var lastid = '<?php echo encode($gateLastId); ?>';
                  var reqtype = $('#requisitiontype').val();
                  var style = $('#buyer').val();
                  $('#loadtabledata').load('loadrequisition.php?action=addnewrow&addsize='+did+'&id='+lastid+'&reqtype='+reqtype+'&style='+style+'&costsheet=1');
                }
                addnewline(0);
                </script>
                <script>
                function deleterow(deleteid){
                  var reqtype = $('#requisitiontype').val();
                  var style = $('#buyer').val();
                  $('#loadtabledata').load('loadrequisition.php?deletestatus=yes&id=<?php echo encode($gateLastId); ?>&rowid='+deleteid+'&reqtype='+reqtype+'&style='+style);
                }
                </script>

                  <div id="savedata" style="display: none;"></div>
                  </table>

                </div>

              </div>
      <?php
       // }
        ?>
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