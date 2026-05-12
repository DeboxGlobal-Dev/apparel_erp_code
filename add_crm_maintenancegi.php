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

$namevalue ='addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'"';
$gateLast = addlistinggetlastid('maintenancegi_Master',$namevalue);
$gateLastId= mysql_insert_id();
}
if($_GET['id']!=''){

$rs=GetPageRecord('*','maintenancegi_Master','id="'.decode($_GET['id']).'"');
$editresult=mysqli_fetch_array($rs);
$gateLastId = $editresult['id'];

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



			<script>
// 			function selectStyle(){
// 			var styleId = $('#styleId').val()
// 				if(styleId!=''){
// 					 window.location.href = '<?php echo $fullurl; ?>showpage.crm?module=requisitionform&add=yes&styleid='+styleId;
// 				}
// 			}
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
				$rrrr=GetPageRecord('*','maintenancegi_Master','1 and id="'.decode($_GET['id']).'"');
				$operationData=mysqli_fetch_array($rrrr);

				?>
				<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
					<input name="action" type="hidden" id="action" value="maintenancegi" />
					<!--<input type="hidden" name="styleid" id="styleid" value="<?php echo $_GET['styleid']; ?>" />-->
					<input name="editId" type="hidden" id="editId" value="<?php echo encode($gateLastId); ?>">

               <table class="table erptab table-hover" style="width:100%">
                     <tr>
                         <td style="width:18%"><div style="text-transform:capitalize;"><b>Requisition No</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint"  name="requisitionno" id="" <?php if($_GET['id']!='') { ?> value="<?php echo $operationData['requisitionno']; ?>" <?php } else{ ?> value="<?php echo 'RQ-MGI-0000'.$gateLastId; ?>" <?php } ?> readonly>

                         </td>
                          <td style="width:26%"><div style="text-transform:capitalize;text-align:end"><b>Requisition Date</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="requisitiondate" value="<?php echo date('d-m-Y');?>"  readonly></td>

                     </tr>

                          <tr>

                          <td style="padding: 10px;width: 10%"><div style="text-transform:capitalize;"><b></b></div></td>
                </tr>


                         <td style="width:26%"><div style="text-transform:capitalize;"><b>Requisition Type</b></div></td>
                         <td>
                          <select name="requisitiontype" id="" class="erpint" style="width:100%;" <?php if($operationData['approvedstatus']=='1'){ ?> disabled <?php } ?>>
                            <option value="">Select</option>
                     <option value="1"  <?php if($operationData['requisitiontype'] == "1") { ?> selected <?php } ?>>Maintenance</option>
                    <option value="2" <?php if($operationData['requisitiontype'] == "2") { ?> selected <?php } ?>>General Item</option>

                    </select>
                  </td>
                 <td><div style="text-transform:capitalize;text-align:right;"><b>Requested By</b></div></td>
                         <td>
                   <select name="requestedby" id="requestedby" class="erpint" style="width:100%;" <?php if($operationData['approvedstatus']=='1'){ ?> disabled <?php } ?> >
                            <option value="">Select</option>
                      <?php

                  $fcref=GetPageRecord('*','userMaster','1 and (profileId="85" || profileId="92" || profileId="160")') ;
                              while($refData=mysqli_fetch_array($fcref)) {
                              ?>
          <option value="<?php echo $refData['id']; ?>" <?php if($operationData['requestedby'] == $refData['id']) { ?> selected <?php } ?>><?php echo $refData['firstName']; ?>&nbsp;<?php echo $refData['lastName']; ?></option>
                      <?php }   ?>
                    </select>
                        </td>

                     </tr>

                     <tr>


                        <td><div style="text-transform:capitalize;"><b>Requested Department</b></div></td>
                         <td>

                                                <select name="department" id="" class="erpint" style="width:100%;"  <?php if($operationData['approvedstatus']=='1'){ ?> disabled <?php } ?>>
                            <option value="">Select</option>
                      <?php

                  $fcrefd=GetPageRecord('*','departmentMaster','1 and deletestatus="0"') ;
                              while($refDatad=mysqli_fetch_array($fcrefd)) {
                              ?>
          <option value="<?php echo $refDatad['id']; ?>" <?php if($operationData['requesteddepartment'] == $refDatad['id']) { ?> selected <?php } ?>><?php echo $refDatad['name']; ?></option>
                      <?php }   ?>
                    </select>
                         <!--<input style="width:100%;" type="text" class="erpint" name="department" id=""  value="<?php echo $operationData['department']; ?>" >   -->
                         </td>

                         <td><div style="text-transform:capitalize;text-align:right;"><b>Requested From</b></div></td>
                         <td>


                                                   <select name="requestedfrom" id="" class="erpint" style="width:100%;" <?php if($operationData['approvedstatus']=='1'){ ?> disabled <?php } ?>>
                            <option value="">Select</option>
                      <?php

                  $fcrefdx=GetPageRecord('*','departmentMaster','1 and deletestatus="0"') ;
                              while($refDatadx=mysqli_fetch_array($fcrefdx)) {
                              ?>
          <option value="<?php echo $refDatadx['id']; ?>" <?php if($operationData['requestedform'] == $refDatadx['id']) { ?> selected <?php } ?>><?php echo $refDatadx['name']; ?></option>
                      <?php }   ?>
                    </select>
                         <!--<input style="width:100%;" type="text" class="erpint" name="requestedfrom" id=""  value="<?php echo $operationData['requestedfrom']; ?>" >   -->
                         </td>
                     </tr>

          <tr>


                         <td><div style="text-transform:capitalize;"><b>Due Date</b></div></td>
                         <td><input style="width:100%;" type="date" class="erpint" name="duedate" id=""  value="<?php echo $operationData['duedate']; ?>" <?php if($operationData['approvedstatus']=='1'){ ?> readonly <?php } ?>></td>

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
            <div style="overflow: scroll;">
                <table class="table table-bordered" style="font-size: 12px;">
              <thead style="background-color: #f9f8f8;">

                <tr class="border-top-info" style="background-color: black;">
                  <th><div align="center"><a onClick="addNewRow(1,2);" style="color:white; cursor: pointer;">+Add&nbsp;New</a></div></th>

                  <th colspan="" align="center" style="text-align:center; color:white;">Item&nbsp;Name</th>
                                    <th colspan="" align="center" style="text-align:center; color:white;">Size</th>

                  <th colspan="" align="center" style="text-align:center; color:white;">Requested&nbsp;Quantity</th>

                 <th style="text-align:center; color:white;">UOM</th>
                 <th style="text-align:center; color:white;">Purpose</th>
                 <th style="text-align:center; color:white;">Supplier</th>
                 <th style="text-align:center; color:white;">Price</th>

                 <th colspan="" style="text-align:center; color:white;">Amount</th>
                 <th colspan="" style="text-align:center; color:white;">Currency</th>
                 <th colspan="" style="text-align:center; color:white;">Remark</th>
                </tr>
              </thead>

               <tbody id="addrow"></tbody>

        <script>
        function addNewRow(id,po){
        if(id==1){
        $("#addrow").load('loadmaintenance.php?add=1&parentId=<?php echo encode($gateLastId); ?>&po='+po);
        }else{
        $("#addrow").load('loadmaintenance.php?parentId=<?php echo encode($gateLastId); ?>&po='+po);
        }

        }
        addNewRow(0,<?php echo $operationData['poNumber'] ?>);

        function deleteRow(id){
        var checkyes = confirm('Are your sure you you want to delete?');
        if(checkyes==true){
        $('#addrow').load('loadmaintenance.php?id='+id+'&deletestatus=yes&parentId=<?php echo encode($gateLastId); ?>&po=<?php echo $operationData['poNumber'] ?>');
        }
        }
        </script>



            </table>
          </div>
      <?php
       // }
        ?>
           <br>


            <?php
            if($_GET['id']!==''){


                if($operationData['approvedstatus']!=='1'){
                ?>
                            <button type="submit" class="btn btn-primary" style="float:right">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>

                    <button type="" name="approve"class="btn btn-primary" style="float:right">Approve<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>
<?php } }?>
                       <!--<div class="btn btn-primary" style="float:right"><a  style="color:white;"href="showpage.crm?module=requisitionindent&add=yes&id=<?php echo encode($operationData['id']); ?>">Generate Indent</a><i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></div>-->

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