<div class="page-content">

		<!-- Main sidebar -->
		<?php include "left.php"; ?>

<div class="content-wrapper">
	<div class="content pt-0" style="margin-top:20px;">
		<div class="row">
			<div class="col-xl-12">
				<div class="card-header header-elements-inline bg-info-700">
					<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
					  <div class="col-xl-3" style="    padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">
					      <a href="showpage.crm?module=masters"  class="btn bg-teal-400" aria-expanded="false" style="background-color: gray;"><i class="fa fa-arrow-left mr-2"></i>Back</a>

					 <a href="#" onClick="opmodalpop(' Add Maintenance & General Item','modalpop.php?action=<?php echo $_GET['module']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
					 </div></div>
					</div>
					<div class="card">

					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead>
							<tr role="row">
							<th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending">Material&nbsp;Id</th>

							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Material&nbsp;Name</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Color</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Description</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Created By</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Modify By</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Status</th>
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
						$where='where 1 and material !="" order by id desc';
						$page=$_GET['page'];
						$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
						$rs=GetRecordList($select,'maintenancegeneral_Master',$where,$limit,$page,$targetpage);
						$totalentry=$rs[1];
						$paging=$rs[2];
						while($resultlists=mysqli_fetch_array($rs[0])){
						$dateAdded=clean($resultlists['dateAdded']);
						$modifyDate=clean($resultlists['modifyDate']);
						?>
							<tr role="row" class="odd">
							    								<td tabindex="0" class="sorting_1"> <a href="#" onClick="opmodalpop(' Edit HSN Code','modalpop.php?action=<?php echo $_GET['module']; ?>&id=<?php echo encode($resultlists['id']); ?>','600px','auto');" data-toggle="modal" data-target="#modalpop"><?php echo 'MGI-0000'.$resultlists['maintenanceid']; ?></a></td>

								<td tabindex="0" class="sorting_1"> <?php echo $resultlists['material']; ?></a></td>


								<td><?php echo $resultlists['color']; ?></td>
								<td><?php echo $resultlists['destination']; ?></td>
								<td>
								<?php $select2='';
								$where2='';
								$rs2='';
								$select2='firstName,lastName';
								$where2='id="'.$resultlists['addedBy'].'"';
								$rs2=GetPageRecord($select2,_USER_MASTER_,$where2);
								$userss=mysqli_fetch_array($rs2);
								echo $userss['firstName'].' '.$userss['lastName']; ?>
								 - <span style="font-size:12px; margin-top:2px; color:#999999;"><?php echo showdatetime($dateAdded,$loginusertimeFormat);?></span>								</td>
								<td>
								<?php $select2='';
								$where2='';
								$rs2='';
								$select2='firstName,lastName';
								$where2='id="'.$resultlists['modifyBy'].'"';
								$rs2=GetPageRecord($select2,_USER_MASTER_,$where2);
								$userss=mysqli_fetch_array($rs2);
								echo $userss['firstName'].' '.$userss['lastName'];
								?>
								- <span style="font-size:12px; margin-top:2px; color:#999999;"><?php echo showdatetime($modifyDate,$loginusertimeFormat);?></span>								</td>
								<td class="text-center"><?php if($resultlists['status']==1){ ?><span class="badge badge-success">Active</span><?php } ?><?php if($resultlists['status']==2){ ?><span class="badge badge-secondary">Inactive</span><?php } ?></td>
							</tr>

<?php  } ?>
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

</div>

