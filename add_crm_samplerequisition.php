<?php

if($_GET['id']!=''){
$select='*';
$where='id="'.decode($_GET['id']).'"';
$rs=GetPageRecord($select,'samplingRequisitionMaster',$where);
$editresult=mysqli_fetch_array($rs);
$lastId=$editresult['id'];
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
								<h6 class="card-title">Sample Requistion</h6>
							</div>

			<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
				<div class="card-body">
				<div class="form-group">
				<div class="row">

					<div class="col-md-3">
						<div class="form-group">
						<label>Sample For</label>
							<select id="sampleFor" name="sampleFor" class="form-control" onchange="funcStyleType(this.value);">
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
							<select id="productionStage" name="productionStage" class="form-control" onchange="loadSampleType(this.value);funcGetVal();">
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
							<select id="sampleType" name="sampleType" class="form-control" onchange="funcGetVal();">

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
							<select id="styleId" name="styleId" class="form-control" onchange="styleData(this.value);funcGetVal();">
								<option value="">Select</option>
								<?php
								$rs=GetPageRecord('*','queryMaster','1 and subject!="" and deletestatus=0 order by id desc');
								while($resListing=mysqli_fetch_array($rs)){
								?>
								<option value="<?php echo strip($resListing['id']); ?>" <?php if($editresult['styleId']==$resListing['id']){ ?> selected <?php }?> ><?php echo '#'.strip($resListing['styleRefId']); ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				<script>
				function funcGetVal(){
					var prodStage = $('#productionStage').val();
					var sampleType = $('#sampleType').val();
					var styleId = $('#styleId').val();
					$('#showDiv').load('loadaction.php?action=loadsamplehidediv&prodStage='+prodStage+'&sampleType='+sampleType+'&styleId='+styleId);
				}
				</script>
					<div class="col-md-12" id="loaddiv">

					</div>

				</div>
<script>
<?php if($_GET['id']!=''){  ?>

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
	$( "#dispatchDate" ).datepicker();
	$( "#commentExDate" ).datepicker();
	$( "#commentReceiveDate" ).datepicker();
	$( "#pattenDate" ).datepicker();
	$( "#packageCompDate" ).datepicker();
} );
</script>
				<table width="100%" border="1" cellspacing="2" cellpadding="5" style="border:2px solid #ccc;margin-top:10px; padding:15px;">
  <tr style=" font-weight:700; text-align:left; background-color: #f5f9bb; font-size: 15px;">
    <td colspan="50">Line Level Info</td>
   </tr>
   <tr style="font-weight:700; text-align:left; background-color:#fafbfb;">
    <td>Request Date</td>
    <td>Expected Date</td>
    <td>Received Date</td>
	<td>Dispatch Date</td>
    <td>Dispatch Details</td>
   </tr>
   <tr>
    <td><input type="text" name="requestedDate" id="requestedDate" class="form-control" value="<?php if($editresult['requestedDate']!='' && $editresult['requestedDate']!='1970-01-01'){ echo date('d-m-Y', strtotime($editresult['requestedDate'])); } ?>" readonly /></td>
    <td><input type="text" name="expectedDate" id="expectedDate" class="form-control" value="<?php if($editresult['expectedDate']!='' && $editresult['expectedDate']!='1970-01-01'){ echo date('d-m-Y', strtotime($editresult['expectedDate'])); } ?>" readonly /></td>
    <td><input type="text" name="receivedDate" id="receivedDate" class="form-control" value="" readonly /></td>
	<td><input type="text" name="dispatchDate" id="dispatchDate" class="form-control" value="" readonly /></td>
    <td>-</td>
   </tr>
</table>


				</div>

				<div class="row">
					<div class="col-md-2">
						<div class="form-group">
						<label>Comments&nbsp;Expected&nbsp;Date</label>
							<input type="text" name="commentExDate" id="commentExDate" class="form-control">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
						<label>Comments&nbsp;Received&nbsp;Date</label>
							<input type="text" name="commentReceiveDate" id="commentReceiveDate" class="form-control">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
						<label>Pattern&nbsp;Date</label>
							<input type="text" name="pattenDate" id="pattenDate" class="form-control">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
						<label>Package&nbsp;Handover</label>
							<input type="text" name="packageHandover" class="form-control">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
						<label>Package&nbsp;Completion&nbsp;Date</label>
							<input type="text" name="packageCompDate" id="packageCompDate" class="form-control">
						</div>
					</div>

				</div>


				<div id="showDiv"> </div>


				<input type="hidden" name="editId" value="<?php echo encode($lastId); ?>">
				<input type="hidden" name="action" value="addmaterialrequisition">
				<input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">

				<div class="text-right" style="margin-top:10px;">
					<button type="submit" style="margin:0px;" class="btn btn-primary">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>
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

