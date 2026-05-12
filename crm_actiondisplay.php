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
						      <a href="showpage.crm?module=masters"  class="btn bg-teal-400" aria-expanded="false" style="background-color: gray;"><i class="fa fa-arrow-left mr-2"></i>Back</a>

						        </div>


					</div>

					<div>
					<div>
					<table width="100%" class="table table-bordered table-hover">
						<thead>
							<tr role="row">

							  <th width="25%" colspan="1" rowspan="1" align="left" class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_2" aria-sort="ascending" aria-label="First Name: activate to sort column descending">Stage</th>

							  <th width="75%" colspan="1" rowspan="1" align="left" class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_2" aria-sort="ascending" aria-label="First Name: activate to sort column descending">Action Menu </th>
					      </tr>
						</thead>
						<tbody>


						<?php
						$depid = 0;
						$rk=GetPageRecord('*','departmentMaster','1 order by name asc');
						while($deptName=mysqli_fetch_array($rk)){
						   $depid = $deptName['id'];
						?>

					 <tr role="row" class="odd">
								<td align="left" class="sorting_1" tabindex="0" style="background-color: #e8fdff; border-bottom: 2px solid #0097a7 !important;"><?php echo $deptName['name']; ?></td>
								<td align="left" class="sorting_1" tabindex="0">
								<table width="100%">
								<tr>
								<td width="3%"></td>
								<td width="97%">Module</td>
								</tr>


								<?php
								$rrk=GetPageRecord('*','moduleMaster','1 and actionStatus=1 order by parentId,sr asc');
								while($modname=mysqli_fetch_array($rrk)){

								$km=GetPageRecord('*','actionDisplayMaster','1 and deptid="'.$deptName['id'].'" and moduleid="'.$modname['id'].'"');
								$actionData=mysqli_fetch_array($km);

								?>

								<tr>

<td><input type="checkbox" name="checkuncheck" id="checkuncheck<?php echo $modname['id']; ?>" value="<?php echo $modname['id']; ?>" onclick="saveData<?php echo $deptName['id']; ?>(this.value);" <?php if($modname['id']==$actionData['moduleid']){ ?> checked="checked" <?php } ?>></td>

<td><?php echo $modname['moduleName']; ?></td>

								</tr>

<script>
function saveData<?php echo $deptName['id']; ?>(id){

var deptid='<?php echo $depid; ?>';

$('#submitlinedetail').load('allaction.php?action=saveactionmaster&id='+id+'&deptid='+deptid);

}
</script>

								<?php } ?>

								</table>
								</td>
					 </tr>


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