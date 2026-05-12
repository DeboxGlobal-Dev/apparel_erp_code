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

							 <a href="#" onclick="opmodalpop(' Add Brand','modalpop.php?action=<?php echo $_GET['module']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>

					 </div></div>
					</div>
					<div class="card">

					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead>
							<tr role="row">
							<th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending">Sr. No#</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Name</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Description</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Buyer Name</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">CPM</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Discount</th>
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
						$where='where  name!="" order by name asc';
						$page=$_GET['page'];
						$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
						$rs=GetRecordList($select,'brandMaster',$where,$limit,$page,$targetpage);
						$totalentry=$rs[1];
						$paging=$rs[2];
						while($resultlists=mysqli_fetch_array($rs[0])){
						?>
							<tr role="row" class="odd">
								<td><?php echo $no; ?></td>
								<td tabindex="0" class="sorting_1"><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&view=yes&id=<?php echo encode($resultlists['id']); ?>&buyerId=<?php echo encode($resultlists['buyerId']); ?>"><?php echo $resultlists['name']; ?></a></td>
								<td><?php echo $resultlists['description']; ?></td>
								<td><?php echo getBuyerName($resultlists['buyerId']); ?></td>
								<td><?php echo $resultlists['cpm']; ?></td>
								<td><?php echo $resultlists['discount']; ?></td>
								<td align="center">
								<div class="btn-group"><a href="#" onclick="opmodalpop(' Edit Brand','modalpop.php?action=<?php echo $_GET['module']; ?>&id=<?php echo encode($resultlists['id']); ?>','600px','auto');" data-toggle="modal" data-target="#modalpop"  aria-expanded="false"><button type="button" class="btn btn-primary" style="padding:5px;"><i class="fa fa-pencil" aria-hidden="true" style=" color: #fffffff1;   font-size: 16px; "></i></button></a>

								<a href="showpage.crm?module=<?php echo $_GET['module']; ?>&view=yes&id=<?php echo encode($resultlists['id']); ?>&buyerId=<?php echo encode($resultlists['buyerId']); ?>" class="btn btn-primary" style="padding:5px;"><i class="fa fa-eye " aria-hidden="true" style=" color: #fffffff1; font-size: 16px; "></i></a></div>
								</td>
							</tr>

<?php $no++; } ?>
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

