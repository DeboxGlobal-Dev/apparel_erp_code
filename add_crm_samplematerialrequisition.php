<?php
//$updatepage='1';

if($_GET['id']!=''){
$select='*';
$where='id="'.decode($_GET['id']).'"';
$rs=GetPageRecord($select,'samplingRequisitionMaster',$where);
$editresult=mysqli_fetch_array($rs);
$lastId=$editresult['id'];
}

if($_GET['id']==''){
$where=' sampleFor="0" and productionStage=0 and addedBy='.$_SESSION['userid'].'';
deleteRecord('samplingRequisitionMaster',$where);

deleteRecord('samplingMaterialRequisition','colorId="0" and samplingY=0 and addedBy='.$_SESSION['userid'].'');

$dateAdded=time();
$namevalue ='sampleFor="0",addedBy='.$_SESSION['userid'].',dateAdded='.$dateAdded.'';
$lastId = addlistinggetlastid('samplingRequisitionMaster',$namevalue);

}

?>
	<div class="page-content">


		<!-- Main content -->
		<div class="content-wrapper">



			<!-- Content area -->
			<div class="content pt-0" style="margin-top:20px;">




				<!-- Dashboard content -->

				<div class="row">

				<div class="col-xl-12">
				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">Sampling Material Requistion</h6>
							</div>

			<form action="ac.crm" method="post" class="submitstyleform" enctype="multipart/form-data" name="popid"  target="acf" id="popid">
				<div class="card-body">
				<div class="form-group">
				<div class="row">

					<div class="col-md-3">
						<div class="form-group">
						<label>Sample For</label>
							<select id="sampleFor" name="sampleFor" class="form-control validate " onchange="funcStyleType(this.value);">
								<option value="">Select</option>
								<option value="100" <?php if($editresult['sampleFor']=="100"){ ?>selected<?php } ?>>Self</option>
								<option value="2" <?php if($editresult['sampleFor']=="2"){ ?>selected<?php } ?>>Buyer Inspiration</option>
							</select>
						</div>
					</div>
<script>

$(document).ready(function() {
$(".select2").select2();
});

</script>

					<div class="col-md-3">
						<div class="form-group">
							<label>Production Stage</label>
							<select id="productionStage" name="productionStage" class="form-control validate " onchange="loadSampleType(this.value);">
								<option value="">Select</option>
								<?php
								$rsList=GetPageRecord('id,name','productionStageMaster','1 and deletestatus=0 order by id asc');
								while($productionName=mysqli_fetch_array($rsList)){
								?>
								<option value="<?php echo $productionName['id']; ?>" <?php if($productionName['id']==$editresult['productionStage']){ echo 'selected'; }?>><?php echo $productionName['name']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label>Sample Type</label>
							<select id="sampleType" name="sampleType" class="form-control validate ">

							</select>
						</div>
					</div>
					<script>
					function loadSampleType(id){
						$('#sampleType').load('loadaction.php?action=sampletypeaction&id='+id+'&sampleType=<?php echo $editresult['sampleType']; ?>');
					}
					function styleData(id){
						$('#loaddiv').load('loadaction.php?action=getmaterialrequisition&styleId='+id);
					}

					</script>
					<div class="col-md-3">
						<div class="form-group">
							<label>Style</label>
							<select id="styleId" name="styleId" class="form-control " onchange="styleData(this.value);">

							</select>
						</div>
					</div>
				<script>
				function funcStyleType(id){
					$('#styleId').load('loadbuyerselfstyle.php?action=selectstyletype&id='+id+'&sId=<?php echo encode($editresult['styleId']); ?>');
				}
				</script>
					<div class="col-md-12" id="loaddiv">

					</div>

				</div>
<script>
<?php if($_GET['id']!=''){  ?>
funcStyleType('<?php echo $editresult['sampleFor']; ?>');
loadSampleType('<?php echo $editresult['productionStage']; ?>');
styleData(<?php echo $editresult['styleId']; ?>);
<?php } ?>
$( function(){
	$( "#requestedDate" ).datepicker({
		dateFormat: 'mm-dd-yy',
		minDate: new Date(),
		onSelect: function (selected) {
			var dt = new Date(selected);
			dt.setDate(dt.getDate() + 1);
			$("#expectedDate").datepicker("option", "minDate", dt);
			$("#receivedDate").datepicker("option", "minDate", dt);
		}
	});

	$( "#expectedDate" ).datepicker({
		dateFormat: 'mm-dd-yy',
		onSelect: function (selected) {
			var dt = new Date(selected);
			dt.setDate(dt.getDate() - 1);
			$("#requestedDate").datepicker("option", "maxDate", dt);
		}
	});

	$( "#receivedDate" ).datepicker({
		dateFormat: 'mm-dd-yy',
		onSelect: function (selected) {
			var dt = new Date(selected);
			dt.setDate(dt.getDate() - 1);
			$("#requestedDate").datepicker("option", "maxDate", dt);
		}
	});
	//$( "#receivedDate" ).datepicker();
	$( "#dispatchDate" ).datepicker();
} );
</script>
				<table width="100%" border="1" cellspacing="2" cellpadding="5" style="border:2px solid #ccc;margin-top:10px; padding:15px;">
  <tr style=" font-weight:700; text-align:left; background-color: #f5f9bb; font-size: 15px;">
    <td colspan="50">Line Level Info</td>
   </tr>
   <tr style="font-weight:700; text-align:left; background-color:#fafbfb;">
    <td>Request Date</td>
    <td>Expected Date</td>
    <td>Received Date (GRN)</td>
	<td>Dispatch Date</td>
    <td>Dispatch Details</td>
   </tr>
   <tr>
  <td><input type="text" name="requestedDate" id="requestedDate" class="form-control" value="<?php if($editresult['requestedDate']=='0000-00-00' || $editresult['requestedDate']="1970-01-01"){ echo date('d-m-Y'); }else{ echo date('d-m-Y', strtotime($editresult['requestedDate'])); } ?>" readonly /></td>
    <td><input type="text" name="expectedDate" id="expectedDate" class="form-control" value="<?php if($editresult['expectedDate']!='' && $editresult['expectedDate']!='1970-01-01'){ echo date('d-m-Y', strtotime($editresult['expectedDate'])); } ?>" readonly /></td>
    <td><input type="text" name="receivedDate" id="receivedDate" class="form-control" value="<?php if($editresult['receivedDate']!='' && $editresult['receivedDate']!='1970-01-01'){ echo date('d-m-Y', strtotime($editresult['receivedDate'])); } ?>" readonly /></td>
	<td><input type="text" name="dispatchDate" id="dispatchDate" class="form-control" value="" readonly /></td>
    <td>-</td>
   </tr>
</table>

<!--<h6 class="card-title">Supplier </h6>
			<table width="100%" border="1" cellspacing="2" cellpadding="5" style="border:2px solid #ccc;margin-top:10px; padding:10px;">
  <tr style=" font-weight:700; text-align:left; background-color:#ecf1f0;">
    <td>&nbsp;</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td style="text-align:center;"><span style="background-color: #42a745f0; padding: 3px 8px; border: 1px solid #dedede; color: #ffff; font-size: 12px; font-weight: 400; border-radius: 3px; cursor:pointer;" onclick="addshellrow(1);">+Add</span></td>
  </tr>
  <tbody id="loadshell"></tbody>
  <script>
  function addshellrow(id){
	if(id==1){
	$("#loadshell").load('loadaction.php?add=1&action=loadshell&lastid=<?php echo $lastId; ?>');
	}else{
	$('#loadshell').load('loadaction.php?action=loadshell&lastid=<?php echo $lastId; ?>');
	}
  }
  addshellrow(0);
	function deleteRow(id){
	var checkyes = confirm('Are your sure you you want to delete?');
		if(checkyes==true){
			$('#loadshell').load('loadaction.php?id='+id+'&deletestatus=yes&action=loadshell&lastid=<?php echo $lastId; ?>');
		}
	}
  </script>
 	<div id="savedata" style="display:none;"></div>
 <tr style="font-weight:700; text-align:left; background-color:#e8e8e8;">
    <td></td>
	 <td>&nbsp;</td>
    <td></td>
    <td></td>
	<td></td>

    <td></td>
	<td></td>
  </tr>
</table>
				-->
				<table width="100%" border="1" cellspacing="2" cellpadding="5" style="border:2px solid #ccc;margin-top:10px; padding:10px;">
  <tr style=" font-weight:700; text-align:left; background-color:#e8fff9;">
    <td>Shell&nbsp;Color</td>
	<td>Size/Sizes</td>
    <td>Qty.</td>
	<td>Store/Supplier</td>
	<td>Nominated&nbsp;By</td>
    <td>Sampling ShellYY</td>
	<td>Shell</td>
	<td>Estimated Price/Meter</td>
	<td>Estimated Value</td>
	<td>Amount</td>
	<td>Bill&nbsp;Details</td>
	<td style="text-align:center;"><span style="background-color: #42a745f0; padding: 3px 8px; border: 1px solid #dedede; color: #ffff; font-size: 12px; font-weight: 400; border-radius: 3px; cursor:pointer;" onclick="addshellrow(1);">+Add</span></td>
  </tr>
  <tbody id="loadshell"></tbody>
  <script>
  function addshellrow(id){
	if(id==1){
		$("#loadshell").load('loadaction.php?add=1&action=loadshell&lastid=<?php echo $lastId; ?>');
	}else{
		$('#loadshell').load('loadaction.php?action=loadshell&lastid=<?php echo $lastId; ?>');
	}
  }
  addshellrow(0);
	function deleteRow(id){
	var checkyes = confirm('Are your sure you you want to delete?');
		if(checkyes==true){
			$('#loadshell').load('loadaction.php?id='+id+'&deletestatus=yes&action=loadshell&lastid=<?php echo $lastId; ?>');
		}
	}
  </script>
 	<div id="savedata" style="display:none;"></div>
 <tr style="font-weight:700; text-align:left; background-color:#e8e8e8;">
    <td></td>
	 <td>Total</td>
    <td><span id="shellTotal"></span></td>
	<td></td>
    <td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
  </tr>
</table>

				<table width="100%" border="1" cellspacing="2" cellpadding="5" style="border:2px solid #ccc;margin-top:10px; padding:10px;">
  <tr style="font-weight:700; text-align:left; background-color:#e8fff9;">
    <td>Lining&nbsp;Color</td>
	<td>Size/Sizes</td>
    <td>Qty.</td>
	<td>Store/Supplier</td>
	<td>Nominated&nbsp;By</td>
    <td>Sampling Lining YY</td>
	<td>Lining</td>
    <td>Estimated Price/Meter</td>
	<td>Estimated Value</td>
	<td>Amount</td>
	<td>Bill&nbsp;Details</td>
	<td style="text-align:center;"><span style="background-color: #42a745f0; padding: 3px 8px; border: 1px solid #dedede; color: #ffff; font-size: 12px; font-weight: 400; border-radius: 3px;cursor:pointer;" onclick="addliningrow(1);">+Add</span></td>
  </tr>
  <tbody id="loadlining"></tbody>
  <script>
  function addliningrow(id){
	if(id==1){
	$("#loadlining").load('loadaction.php?add=1&action=loadlining&lastid=<?php echo $lastId; ?>');
	}else{
	$('#loadlining').load('loadaction.php?action=loadlining&lastid=<?php echo $lastId; ?>');
	}
  }
  addliningrow(0);
	function deleteliningRow(id){
	var checkyes = confirm('Are your sure you you want to delete?');
		if(checkyes==true){
			$('#loadlining').load('loadaction.php?id='+id+'&deletestatus=yes&action=loadlining&lastid=<?php echo $lastId; ?>');
		}
	}
  </script>


  <tr style="font-weight:700; text-align:left; background-color:#e8e8e8;">
    <td></td>
	 <td>Total</td>
    <td></td>
	<td></td>
    <td></td>
	<td></td>
    <td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
  </tr>
</table>

<!--	<table width="100%" border="1" cellspacing="2" cellpadding="5" style="border:2px solid #ccc;margin-top:10px; padding:15px;">
  <tr style=" font-weight:700; text-align:left; background-color: #f1f3f2; font-size: 15px;">
    <td colspan="50">Supplier 1</td>
   </tr>
   <tr style="font-weight:700; text-align:left; background-color:#fafbfb;">
    <td>Supplier</td>
    <td>Nominated&nbsp;By</td>
    <td>Amount</td>
	<td>Details</td>
   </tr>
   <tr>
    <td><select name="supplierStore" id="supplierStore" class="form-control" >
			<option value="">Select</option>
			<?php
			$rs=GetPageRecord('id,name','suppliersMaster','1 and deletestatus=0 order by name asc');
			while($resListing=mysqli_fetch_array($rs)){
			?>
			<option value="<?php echo $resListing['id']?>" <?php if($resListing['id']==$rsListData['supplierStore']){ echo "selected"; }?>><?php echo $resListing['name']?></option>
			<?php } ?>
		</select></td>
    <td>
	<select id="nominatedBy" name="nominatedBy" class="form-control">
      <option value="">Select</option>
      <option value="1">Buyer Nominated</option>
      <option value="2">Management Nominated</option>
    </select>
	</td>
    <td> <input type="text" name="amount" value=" " id="amount" class="form-control" /></td>
	<td><input type="text" name="detaild" value=" " id="detaild" class="form-control" /></td>
   </tr>
</table>

<table width="100%" border="1" cellspacing="2" cellpadding="5" style="border:2px solid #ccc;margin-top:10px; padding:15px;">
  <tr style=" font-weight:700; text-align:left; background-color: #f1f3f2; font-size: 15px;">
    <td colspan="50">Supplier 2</td>
   </tr>
   <tr style="font-weight:700; text-align:left; background-color:#fafbfb;">
    <td>Supplier</td>
    <td>Nominated&nbsp;By</td>
    <td>Amount</td>
	<td>Details</td>
   </tr>
   <tr>
    <td><select name="supplierStore" id="supplierStore" class="form-control" >
			<option value="">Select</option>
			<?php
			$rs=GetPageRecord('id,name','suppliersMaster','1 and deletestatus=0 order by name asc');
			while($resListing=mysqli_fetch_array($rs)){
			?>
			<option value="<?php echo $resListing['id']?>" <?php if($resListing['id']==$rsListData['supplierStore']){ echo "selected"; }?>><?php echo $resListing['name']?></option>
			<?php } ?>
		</select></td>
    <td>
	<select id="nominatedBy" name="nominatedBy" class="form-control">
      <option value="">Select</option>
      <option value="1">Buyer Nominated</option>
      <option value="2">Management Nominated</option>
    </select>
	</td>
    <td> <input type="text" name="amount" value=" " id="amount" class="form-control" /></td>
	<td><input type="text" name="detaild" value=" " id="detaild" class="form-control" /></td>
   </tr>
</table>-->
				</div>


				<input type="hidden" name="editId" value="<?php echo encode($lastId); ?>">
				<input type="hidden" name="action" value="addmaterialrequisition">
				<input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">

				<div class="text-right">
					<button type="submit" style="margin:0px;" class="btn btn-primary">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>


				    <label>

				    </label>
				</div>
				</div>

				</form>
						</div>

</div>


					</div>

			</div>
				<!-- /dashboard content -->

			</div>
			<!-- /content area -->



		</div>
		<!-- /main content -->

	</div>

 <style>
.select2-form-group .select2-container {
    width: 305px !important;
}
</style>