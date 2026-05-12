<?php
if($loginuserprofileId==1 || $loginuserprofileId==93){

$wheresearchassign=' 1 and ';

} else {

if($loginuserprofileId==92){

$wheresearchassign=' 1 and finalstatus="2" and assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'" and ';
} else{

$wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))';

$wheresearchassign=' '.$wheresearchassign.' and ';

}

}

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
<div class="page-content">

		 <div class="content-wrapper">

			<div class="content pt-0" style="margin-top:20px;">

				<div class="row" style="margin-bottom:10px;">
					<div class="col-xl-12">
						<div class="card mb-0 rounded-bottom-0" style="padding:15px;">
							<div class="col-xl-3">
								<div class="panel panel-flat">
							       <select id="styleId" name="styleId" class="form-control" onChange="selectStyle();">
										<option value="">Select Style</option>
										<?php
										$styleId = decode($_GET['styleid']);
										$rs=GetPageRecord($select,'queryMaster','1 and deletestatus=0 and subject!="" order by id asc');
										while($resultStyle=mysqli_fetch_array($rs)){
										?>
										<option value="<?php echo encode($resultStyle['id']); ?>" <?php if($styleId==$resultStyle['id']){ echo 'selected'; } ?>><?php echo '#'.$resultStyle['styleRefId']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
		     				</div>
						</div>
					</div>
				<script>
				function selectStyle(){
				var styleId = $('#styleId').val()
					if(styleId!=''){
						 window.location.href = '<?php echo $fullurl; ?>showpage.crm?module=materialrequisition&add=yes&styleid='+styleId;
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
			 	<div class="card mb-0 rounded-bottom-0" style="padding:15px;">
				 	<div class="panel panel-flat">
					<div class="table-responsive">
			 			<table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
                              <td width="16%"></td>
							  <td width="64%" style="text-align:center;"><strong style="font-size:23px;">Material Requisition Cum Issue  List</strong></td>
							  <td width="16%" style="text-align:right;"></td>
                            </tr>
                          </tbody>
                        </table>
						<table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
                              <td width="50%"> <strong>Requisition No: </strong>DB8RHTF4GFFFG</td>
							  <td width="50%"><strong>Requisition Date: </strong><?php echo date('d-m-Y h:i:s A'); ?></td>
							</tr>
                          </tbody>
     					</table>

<style>
.buyer-address td{
border:0px solid;
padding:0px;
}
</style>

<div class="btn-group justify-content-center" style="width: fit-content; float: left; padding: 10px 0px; margin: 0px; display: none;" id="deactivatebtnpurchasemerchant">



</div>

				        <div id="add_indentmpl">
					    <table width="100%" class="table table-bordered table-responsive forbom" id="tableid11" style="display:block;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body" style="background-color: #fff7b3;;">
							 <td width="15%" align="center"><strong></strong><input  name="materialCheckAll" type="checkbox" class="checkalldeletematerial" id="materialCheckAll" style="height: 17px;width: 50px;margin-top: 0;text-align: center;" /></td>
                              <td width="" align="center"><strong>Material&nbsp;Id</strong></td>
                              <td width="12%" align="center"><strong>Material&nbsp;Desc.</strong></td>
							  <td width="12%" align="center"><strong>UOM</strong></td>
							  <td width="12%" align="center"><strong>Color</strong></td>
							  <td width="12%" align="center"><strong>Size</strong></td>
							  <td width="12%" align="center"><strong>Qty.&nbsp;Requested</strong></td>
							  <td width="12%" align="center"><strong>Qty.&nbsp;Issued</strong></td>
                              <td width="12%" align="center"><strong>Stock&nbsp;In&nbsp;Store</strong></td>
							  <td width="12%" align="center"><strong>Remark</strong></td>
                            </tr>
							<?php
							$rstype=GetPageRecord('*','materialTypeMaster','1 order by id asc');
							while($resListingtype=mysqli_fetch_array($rstype)){

							$rsindentsss=GetPageRecord('*','indentCreationMaster','materialTypeId="'.$resListingtype['id'].'"');
							$resListingIndentsss=mysql_num_rows($rsindentsss);
							if($resListingIndentsss>0){

							?>
							<tr class="card-body">
								<td width="100%" align="left" colspan="21" style="background-color: #e5fbfa;text-transform: uppercase;font-size: 14px;"><strong><?php echo $resListingtype['name']; ?></strong></td>
							</tr>
							<?php
							}
							$rsindent=GetPageRecord('*','indentCreationMaster','materialTypeId="'.$resListingtype['id'].'"');
							while($resListingIndent1=mysqli_fetch_array($rsindent)){
							$rs1=GetPageRecord('*','styleSubCategoryMaster','id="'.$resListingIndent1['materialId'].'"');
							$resListing1=mysqli_fetch_array($rs1);
							?>
                          <tr class="card-body">
						   	<td>
							<label class="analyselistclass">
						   <input type="checkbox" style="opacity:1; cursor: pointer; height: 17px; width: 50px; margin-top: 3px;" value="<?php echo $resListing12['id']; ?>" name="analysemateriallistdelete[]" class="deletematerial" id="deletematerial<?php echo $resListingIndent1['id']; ?>" onclick="checkSingle<?php echo $resListingIndent1['id']; ?>();" />
							</label>
							</td>
                            <td width="15%" align="center">
							 <a href="#" onclick="event.preventDefault();"><?php echo $resListing1['name']; ?></a>
							</td>
                              <td width="25%" align="center"><?php echo getDescriptionName($resListing1['materialdescriptionid']); ?></td>
                              <td width="12%" align="center"><?php  echo $resListingIndent1['uom']; ?></td>
							   <td width="12%" align="center"><?php  echo $resListingIndent1['color']; ?></td>
							    <td width="12%" align="center"><?php  echo $resListingIndent1['size']; ?></td>
                              <td width="12%" align="center"><input type="text" name="requestedQty" id="requestedQty<?php echo $resListingIndent1['id']; ?>"  style="width: 120px;" disabled="disabled" class="inputchk" onblur="funcRequestedQty<?php echo $resListingIndent1['id']; ?>();" value="<?php echo $resListingIndent1['requestedQty']; ?>"></td>
							  <td width="12%" align="center"><input type="text" name="issuedQty" id="issuedQty<?php echo $resListingIndent1['id']; ?>" style="width:120px; " <?php if($loginuserprofileId==1){ ?> disabled="disabled" <?php } ?> value="<?php echo $resListingIndent1['issuedQty']; ?>" onblur="funcRequestedQty<?php echo $resListingIndent1['id']; ?>();"></td>
							  <td width="12%" align="center"><span style="color:#FF0000; font-weight:600;">No</span></td>
							  <td width="30%" align="center"><input type="text" name="requisitionRemark" style="width: 150px;" id="requisitionRemark<?php echo $resListingIndent1['id']; ?>" class="inputchk"  disabled="disabled"  onblur="funcRequestedQty<?php echo $resListingIndent1['id']; ?>();" value="<?php echo $resListingIndent1['requisitionRemark']; ?>"></td>
                            </tr>
 <script>
 function checkSingle<?php echo $resListingIndent1['id']; ?>(){
	var isCheck = $('#deletematerial<?php echo $resListingIndent1['id']; ?>').is(':checked');
		 if(isCheck==true){
			$("#requestedQty<?php echo $resListingIndent1['id']; ?>").attr("disabled", false);
			$("#requisitionRemark<?php echo $resListingIndent1['id']; ?>").attr("disabled", false);
		 }else{
			$("#requestedQty<?php echo $resListingIndent1['id']; ?>").attr("disabled", true);
			$("#requisitionRemark<?php echo $resListingIndent1['id']; ?>").attr("disabled", true);
		 }

 }
 function funcRequestedQty<?php echo $resListingIndent1['id']; ?>(){
 		var id = '<?php echo $resListingIndent1['id']; ?>';
		var requestedQty = $('#requestedQty<?php echo $resListingIndent1['id']; ?>').val();
		var issuedQty = $('#issuedQty<?php echo $resListingIndent1['id']; ?>').val();
		var requisitionRemark = encodeURI($('#requisitionRemark<?php echo $resListingIndent1['id']; ?>').val());
		$('#saveReqData').load('saverequisition.php?action=saverequisition&id='+id+'&requestedQty='+requestedQty+'&issuedQty='+issuedQty+'&requisitionRemark='+requisitionRemark);
 }
 </script>
							<?php } } ?>
	<div id="saveReqData" style="display:none;"></div>

                          </tbody>
                        </table>

						<div class="text-right" style="width: 100%;display: block;margin-top: 25px;">

<button type="button" class="btn btn-primary" style="margin:0px;" onclick="window.location.reload();">Send<i class="ml-2" aria-hidden="true" style="margin:0px;" ></i></button>


			</div>
						</div>
					  </div>
					</div>
				  </div>
				 </div>
				 </div>

                     </div>

			</div> </div>

<script type="text/javascript">
$(document).ready(function(){
	$("#materialCheckAll").click(function(){
		if(this.checked){
			$('.deletematerial').each(function(){
				this.checked = true;
				$(".inputchk").attr("disabled", false);
			})
		}else{
			$('.deletematerial').each(function(){
				this.checked = false;
				$(".inputchk").attr("disabled", true);
			})
		}
	});
});
</script>

