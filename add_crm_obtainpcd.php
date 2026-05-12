<?php
//$updatepage='1';

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

		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">



			<!-- Content area -->
			<div class="content pt-0" style="margin-top:20px;">




				<!-- Dashboard content -->

				<!---style information section--->
				<?php include "top-style.php"; ?>
				<!---style information section end--->


				<div class="row">

				<div class="col-xl-12">
				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">Planned Cut Date</h6>
							</div>

			<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
				<div class="card-body">
				<div class="form-group">
				<div class="row">
<script>
$( function(){
	$( "#pcdDate" ).datepicker();
	$( "#shipDate" ).datepicker();
} );
</script>
				<div class="col-md-3">
						<div class="form-group">
							<label>Planned Cut Date</label>
							<input type="text" name="pcdDate" id="pcdDate" class="form-control" value="<?php if($editresultstyle['pcdDate']!=''){ echo date('d-m-Y', strtotime($editresultstyle['pcdDate'])); } ?>"/>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label>Shipment Date</label>
							<input type="text" name="shipDate" id="shipDate" class="form-control" value="<?php if($editresultstyle['shipDate']!=''){ echo date('d-m-Y', strtotime($editresultstyle['shipDate'])); } ?>"/>
						</div>
					</div>
					<div class="col-md-6">
						<!--<div class="form-group">
						<label>Attach File</label>
						<div class="uniform-uploader">
						<input type="file" name="patternAttachment" id="patternAttachment" class="form-input-styled" data-fouc="">

						<span class="filename" style="user-select: none;">No file selected</span>
						<span class="action btn btn-secondary" style="user-select: none;"><i class="fa fa-upload"></i></span>


						<script>
							$('#patternAttachment').on('change',function(){
							//get the file name
							var fileName = $(this).val();
							//replace the "Choose a file" label
							$(this).next('.filename').html(fileName);
							})
						</script>


						<input type="hidden" name="patternAttachmentEdit" id="patternAttachmentEdit" value="<?php echo $patternAttachment; ?>"/>
						</div>
						<?php if($patternAttachment!=''){?>
						<div style="display:block;margin-top:10px;"><a href="images/<?php echo $patternAttachment; ?>" target="blank"><i class="fa fa-download" aria-hidden="true"></i> Attachment</a></div>
						<?php } ?>
						</div>-->
					</div>




				</div>


				</div>

				<input type="hidden" name="editId" value="<?php echo $_GET['styleid']; ?>">
				<input type="hidden" name="action" value="addpcd">
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

