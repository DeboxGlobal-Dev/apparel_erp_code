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


					 </div></div>
					</div>
					<div class="card">

					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead>
							<tr role="row">
							<th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending">Name</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">No of Line</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Avg. Opeters/Line</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Avg. Shift Hrs.</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Min. Capacity</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Avg&nbsp;SAM</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Avg&nbsp;Eff.</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Season Allocation</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">No Of Style</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Avg. Qty</th>
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
						$rs=GetRecordList($select,'factoryMaster',$where,$limit,$page,$targetpage);
						$totalentry=$rs[1];
						$paging=$rs[2];
						while($resultlists=mysqli_fetch_array($rs[0])){

						$where2='factoryId="'.$resultlists['id'].'"';
						$rs2=GetPageRecord('*','factoryLineMaster',$where2);
						$userss=mysqli_fetch_array($rs2);

						$where21='factoryId="'.$resultlists['id'].'"';
						$rs21=GetPageRecord('*','capacityMaster',$where21);
						$factory=mysqli_fetch_array($rs21);


						?>
							<tr role="row" class="odd">
								<td tabindex="0" class="sorting_1"> <a href="#" onclick="opmodalpop(' Add Capacity','modalpop.php?action=<?php echo $_GET['module']; ?>&id=<?php echo encode($resultlists['id']); ?>','600px','auto');" data-toggle="modal" data-target="#modalpop"><?php echo $resultlists['name']; ?></a></td>
								<td><?php echo $resultlists['line']; ?></td>
								<td><?php echo $userss['workers']; ?></td>
								<td><?php echo $userss['hours']; ?></td>
								<td><?php echo $resultlists['line']*$userss['workers']*$userss['hours']*60; ?></td>
								<td><?php echo $factory['avgSam']; ?></td>
								<td><?php echo $factory['avgEfficiency']; ?></td>
								<td><?php echo $factory['seasonAllocation']; ?></td>
								<td><?php echo $factory['numberOfStyle']; ?></td>
								<td><?php echo $factory['avgQty']; ?></td>
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

