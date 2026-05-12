<div class="page-content">

		<!-- Main sidebar -->
		<?php include "left.php"; ?>

<div class="content-wrapper">
	<div class="content pt-0" style="margin-top:20px;">
		<div class="row">
			<div class="col-xl-12">
				<div class="card-header header-elements-inline bg-blue-700" style="padding:10px;">
					<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
					  <div class="col-xl-3" style="    padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">
					  		<a href="showpage.crm?module=masters"  class="btn bg-teal-400" aria-expanded="false" style="background-color: gray;"><i class="fa fa-arrow-left mr-2"></i>Back</a>

							 <a href="#" onClick="opmodalpop(' Add Employee','modalpop.php?action=<?php echo $_GET['module']; ?>','1000px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>

					 </div></div>
					</div>
					<div class="card">

					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead>
							<tr role="row">
							<th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending">Employee&nbsp;Name</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Employee&nbsp;Id</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Employee&nbsp;Category</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Email</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Phone</th>
	<!--						<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Work&nbsp;Location</th>-->
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Reporting&nbsp;Manager</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Status</th>
							<th class="text-center sorting_disabled" rowspan="1" colspan="1" style="width: 100px;" aria-label="Actions">Actions</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$no=1;
						$select='*';
						$where='';
						$rs='';
						$wheresearch='';
						$limit='20000';
						$where='where  name!="" order by id desc';
						$page=$_GET['page'];
						$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
						$rs=GetRecordList($select,_EMPLOYEE_MASTER_,$where,$limit,$page,$targetpage);
						$totalentry=$rs[1];
						$paging=$rs[2];
						while($resultlists=mysqli_fetch_array($rs[0])){
						?>
							<tr role="row" class="odd">
								<td tabindex="0" class="sorting_1"><a href="#" onClick="opmodalpop(' Edit Employee','modalpop.php?action=<?php echo $_GET['module']; ?>&id=<?php echo encode($resultlists['id']); ?>','1000px','auto');" data-toggle="modal" data-target="#modalpop"><?php echo $resultlists['name']; ?></a></td>

								<td><?php echo $resultlists['empCode']; ?></td>
								<td><?php
								$selectl='*';
								$wherel='id="'.$resultlists['empType'].'"';
								$rsl=GetPageRecord($selectl,_EMPLOYEE_TYPE_,$wherel);
								$resListingl=mysqli_fetch_array($rsl);
								echo $resListingl['name'];
								?>
								</td>
								<td><?php echo $resultlists['email']; ?></td>
								<td><?php echo $resultlists['phone']; ?></td>
								<!--<td><?php echo $resultlists['workLocation']; ?></td>-->
								<td><?php
								$selectl='*';
								$wherel='id="'.$resultlists['reportingTo'].'"';
								$rsl=GetPageRecord($selectl,_EMPLOYEE_MASTER_,$wherel);
								$resListingl=mysqli_fetch_array($rsl);
								echo $resListingl['name'];
								?></td>
								<td><?php if($resultlists['status']==1){ ?><span class="badge badge-success">Active</span><?php } ?><?php if($resultlists['status']==2){ ?><span class="badge badge-secondary">Inactive</span><?php } ?></td>

								<td style="">
								<div class="btn-group">
								<?php
								$whereCheck='empId="'.$resultlists['id'].'"';
								$checkCode = checkduplicate('userMaster',$whereCheck);
								if($checkCode=='no'){ ?>
								  <a href="#"   class="btn btn-primary" aria-expanded="false"  data-toggle="modal" data-target="#modalpop" onclick="opmodalpop(' Add  User','modalpop.php?action=adduser&empid=<?php echo $resultlists['id']; ?>','600px','auto');"> Create User</a>
								  <?php }else{ ?>
								  <a href="#"   class="btn btn-success"> Created</a>

								 <?php } ?>
								</div>
								</td>
							</tr>

<?php } ?>
						</tbody>
					</table></div>
					</div>


					</div>


				</div>
			</div>
		</div>
	</div>
</div>

</div>

