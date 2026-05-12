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
				<?php include "top-style.php" ?>
				<!---style information section end--->



				<div class="row">

				<div class="col-xl-12">

				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">Grading</h6>
				  </div>

  	<div class="card-body">


								<div class="row">
										<table width="100%" class="table table-bordered table-responsive">
											<thead style="background-color: #e5fbfa;">
												<tr class="border-top-info">
												    <th width=""><a onclick="addNewRow(1);" style="color:#0000FF; cursor: pointer;">+Add&nbsp;New</a></th>
													<th width="3%">SNO.</th>
													<th >Specifications</th>
													<th width="">XS</th>
													<th width="">Small</th>
													<th width="">Medium</th>
													<th width="">Large</th>
													<th width="">XL</th>
													<th width="">XXL</th>
													<th width="">TOL (+/-)</th>

												</tr>
											</thead>
											<tbody id="addrow">
											</tbody>

											<script>
											function addNewRow(id){
												if(id==1){
													$("#addrow").load('loadmeasurementtable.php?add=1&styleId=<?php echo encode($lastId); ?>&costsheetVersionId=1');
												}else{
													$("#addrow").load('loadmeasurementtable.php?styleId=<?php echo encode($lastId); ?>')
												}
											}
											addNewRow(0);


											function deleteRow(id){
											var checkyes = confirm('Are your sure you you want to delete?');
												if(checkyes==true){
													$('#addrow').load('loadmeasurementtable.php?id='+id+'&deletestatus=yes&styleId=<?php echo encode($lastId); ?>');
												}
											}
											</script>
										</table>

									</div>

				  </div>


				</div>


				  </div>




</div>


					</div>

			</div>

			</div>

		</div>

	</div>
<script src="http://deboxcrm.com/woodland2/global_assets/js/plugins/uploaders/dropzone.min.js"></script>
<script src="http://deboxcrm.com/woodland2/global_assets/js/demo_pages/uploader_dropzone.js"></script>
<style>
.card-header header-elements-inline{
	    margin-bottom: 15px !important;
}
</style>
