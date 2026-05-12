<div class="page-content">

		<!-- Main sidebar -->
		<?php include "left.php"; ?>

<div class="content-wrapper">
	<div class="content pt-0" style="margin-top:20px;">
		<div class="row">
			<div class="col-xl-12">
				<div class="card-header header-elements-inline bg-info-700">
					<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
					  <div class="col-xl-3" style="padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">
					  	  <a href="showpage.crm?module=masters"  class="btn bg-teal-400" aria-expanded="false" style="background-color: gray;"><i class="fa fa-arrow-left mr-2"></i>Back</a>

							<!-- <a href="#" onclick="opmodalpop(' Add Embroidery','modalpop.php?action=<?php echo $_GET['module']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a> -->


					 </div></div>
					</div>
					<div class="card">

					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead>
							<tr role="row">
							<th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending">Name</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Persantage</th>
						 	<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Status</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">-</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="display:none;"></th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="display:none;"></th>
							</tr>
						</thead>
						<tbody>
<?php
$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit=clean($_GET['records']);

$where='where name!="" and deletestatus=0 order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module='.$_GET['module'].'&records='.$limit.'&';
$rs=GetRecordList($select,'processLossMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){
$dateAdded=clean($resultlists['dateAdded']);
$modifyDate=clean($resultlists['modifyDate']);
?>
							<tr role="row" class="odd">
								<!--<td tabindex="0" class="sorting_1"><a href="#" onclick="opmodalpop(' Edit Embroidery','modalpop.php?action=<?php echo $_GET['module']; ?>&id=<?php echo encode($resultlists['id']); ?>','600px','auto');" data-toggle="modal" data-target="#modalpop"><?php echo $resultlists['name']; ?></a></td>-->
								<td tabindex="0" class="sorting_1"><a href="#"><?php echo $resultlists['name']; ?></a></td>
								<td><?php echo $resultlists['persantage']; ?></td>
								<td><?php if($resultlists['status']==1){ ?><span class="badge badge-success">Active</span><?php } ?><?php if($resultlists['status']==2){ ?><span class="badge badge-secondary">Inactive</span><?php } ?></td>
								<td  style="">-</td>
								<td  style="display:none;"></td>
								<td  style="display:none;"></td>
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

