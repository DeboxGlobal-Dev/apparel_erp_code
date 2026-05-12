  <div class="page-content">
 	<div class="content-wrapper">
 	<div class="content pt-0" style="margin-top:20px;">
 	<div class="row">
			 	 <div class="col-xl-12">
				<div class="card" >
					 <div class="card-header header-elements-inline bg-info-700">
						<div class="col-xl-12"><h5 class="card-title"><?php echo $modfile['moduleName']; ?></h5></div>

					</div>

					<div>
					<div>
					<table width="100%" class="table table-bordered table-hover">
						<thead>
							<tr role="row">

							  <th colspan="1" rowspan="1" align="left" class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_2" aria-sort="ascending" aria-label="First Name: activate to sort column descending">Category</th>

							  <th colspan="1" rowspan="1" align="left" class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_2" aria-sort="ascending" aria-label="First Name: activate to sort column descending">Fabric</th>

								  <th colspan="1" rowspan="1" align="left" class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_2" aria-sort="ascending" aria-label="First Name: activate to sort column descending">Trim</th>

							   <th colspan="1" rowspan="1" align="left" class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_2" aria-sort="ascending" aria-label="First Name: activate to sort column descending">Packaging Trims</th>


						  </tr>
						</thead>
						<tbody>

						<?php
						$rk=GetPageRecord('*','categoryMaster','1 order by name asc');
						while($catname=mysqli_fetch_array($rk)){

						$rs2=GetPageRecord('*','materialConfigurationMaster','1 and categoryId="'.$catname['id'].'"');
						$materialData=mysqli_fetch_array($rs2);

						?>

					 <tr role="row" class="odd">
								<td align="left" class="sorting_1" tabindex="0"><?php echo $catname['name']; ?></td>
								<td align="left" class="sorting_1" tabindex="0"><input type="text" name="fabric" id="fabric<?php echo $catname['id']; ?>" value="<?php echo $materialData['fabric']; ?>" onkeyup="submitValue<?php echo $catname['id']; ?>();" style="width:100%; padding:2px 5px;"></td>
								<td align="left" class="sorting_1" tabindex="0"><input type="text" name="trim" id="trim<?php echo $catname['id']; ?>" value="<?php echo $materialData['trim']; ?>" onkeyup="submitValue<?php echo $catname['id']; ?>();" style="width:100%; padding:2px 5px;"></td>
								<td align="left" class="sorting_1" tabindex="0"><input type="text" name="packaging" id="packaging<?php echo $catname['id']; ?>" value="<?php echo $materialData['packaging']; ?>" onkeyup="submitValue<?php echo $catname['id']; ?>();" style="width:100%; padding:2px 5px;"></td>
						</tr>


<script>
function submitValue<?php echo $catname['id']; ?>(){

var categoryid = '<?php echo $catname['id']; ?>';
var fabric = encodeURI($('#fabric<?php echo $catname['id']; ?>').val());
var trim = encodeURI($('#trim<?php echo $catname['id']; ?>').val());
var packaging = encodeURI($('#packaging<?php echo $catname['id']; ?>').val());

$('#submitlinedetail').load('allaction.php?action=savematerialconfiguration&categoryid='+categoryid+'&fabric='+fabric+'&trim='+trim+'&packaging='+packaging);

}
</script>


						<?php } ?>
<div id="submitlinedetail"></div>


					  </tbody>
					</table>
					</div></div>
				</div>


					</div>


				</div>
				<!-- /dashboard content -->

			</div>
			<!-- /content area -->


			<!-- Footer -->

			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
		<!-- /main content -->

	</div>

<style>
.table-bordered td, .table-bordered th {
    border: 1px solid #ddd !important;
    outline: none !important;
}
</style>
