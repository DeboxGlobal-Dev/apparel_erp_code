  <div class="page-content">
 	<div class="content-wrapper">
 	<div class="content pt-0" style="margin-top:20px;">
 	<div class="row">
			 	 <div class="col-xl-12">
				<div class="card" >
					 <div class="card-header header-elements-inline bg-info-700">
						<div class="col-xl-11">
						    <h5 class="card-title"><?php echo $modfile['moduleName']; ?></h5>
						</div>
						  <div class="col-xl-1">
							 <a href="showpage.crm?module=masters"  class="btn bg-teal-400" aria-expanded="false" style="background-color: #03d873b8;">Back</a>
						</div>

					</div>

					<div>
					<div>
					<table class="table table-bordered table-hover" width="100%">
						<thead>
							<tr role="row">
							  <th width="5%" align="center" class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_2" aria-sort="ascending" aria-label="First Name: activate to sort column descending">SR</th>

							  <th width="78%" align="left" class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_2" aria-sort="ascending" aria-label="First Name: activate to sort column descending">Status</th>

							  <th width="17%" align="left" class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_2" aria-sort="ascending" aria-label="First Name: activate to sort column descending">Department Name</th>
						   </tr>
						</thead>
						<tbody>

						<?php
						$sNo=1;
						$rk=GetPageRecord('*','statusMaster','1 order by id asc');
						while($statusName=mysqli_fetch_array($rk)){
						 ?>
				 	 <tr role="row" class="odd">
					   <td align="left" class="sorting_1" tabindex="0"><div style="width:50px;"><?php echo $sNo; ?></div></td>
								<td align="left" class="sorting_1" tabindex="0"><div style="width:150px;"><?php echo $statusName['name']; ?></div></td>
								<td align="left" class="sorting_1" tabindex="0">
								<select name="department<?php echo $statusName['id']; ?>" id="department<?php echo $statusName['id']; ?>" class="form-control" onchange="submitValue<?php echo $statusName['id']; ?>();" style="width:200px;">
								<option value="">Select Department</option>
							    <?php
								$km=GetPageRecord('*','departmentMaster','1 and status=1 and deletestatus=0 order by name asc');
								while($departmentName=mysqli_fetch_array($km)){ ?>
<option value="<?php echo $departmentName['id']; ?>" <?php if($statusName['departmentId']==$departmentName['id']){ ?> selected="selected" <?php } ?>><?php echo $departmentName['name']; ?></option>
						      	<?php } ?>
								</select>								</td>
						</tr>

<script>
function submitValue<?php echo $statusName['id']; ?>(){
var statusid = '<?php echo $statusName['id']; ?>';
var departmentName = encodeURI($('#department<?php echo $statusName['id']; ?>').val());

$('#submitlinedetail').load('allaction.php?action=savestatuswisedepartment&statusid='+statusid+'&departmentName='+departmentName);
}
</script>
  <?php $sNo++; } ?>

<div id="submitlinedetail"></div>


					  <tr>
					    <td>
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

