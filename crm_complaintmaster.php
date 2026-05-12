<div class="page-content">
<style>
.even{
background-color: #0097a71a;
}
</style>
		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<div class="content-wrapper">

			<div class="content pt-0" style="margin-top:20px;">

				<div class="row">
				<div class="col-xl-12">

				<div class="card-header header-elements-inline bg-info-700">
						<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
						 <div class="col-xl-3" style="    padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">
 <a href="#" onclick="opmodalpop(' Add Complaint','modalpop.php?action=<?php echo $_GET['module']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>

						</div></div>
					</div>

				<div class="card">
					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead style="background-color: #f5f5f5;">
							<tr role="row">
								<th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending">Complaint&nbsp;Id</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Subject</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Id</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Complaint&nbsp;Date</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Resolve&nbsp;Date</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Duration</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Raised&nbsp;By</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Assign&nbsp;To</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Priority</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Status</th>
								<th class="text-center sorting_disabled" rowspan="1" colspan="1" style="width: 100px;" aria-label="Actions">Feedback</th>
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

$where='where subject!="" order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,_COMPLAINT_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

?>
<tr role="row" class="odd">
								<td tabindex="0" class="sorting_1"><a href="showpage.crm?module=complaintmaster&view=yes&id=<?php echo encode($resultlists['id']); ?>"><?php echo makeQueryId($resultlists['id']); ?></a></td>
								<td><?php echo $resultlists['subject']; ?></td>
								<td><?php

								$select1='*';
								$where1='id="'.$resultlists['styleId'].'"';
								$rs1=GetPageRecord($select1,_QUERY_MASTER_,$where1);
								$editresult1=mysqli_fetch_array($rs1);
								echo makeQueryId($editresult1['displayId']);
								?></td>
								<td><?php echo date('d-m-Y', strtotime($resultlists['complaintDate'])); ?></td>
								<td><?php if($resultlists['complaintcloseDate']!='0000-00-00'){ echo date('d-m-Y', strtotime($resultlists['complaintcloseDate'])); }else{ echo '-'; }?></td>
								<td>
								<?php
								if($resultlists['complaintcloseDate']!='0000-00-00'){
								$datetime1 = date_create($resultlists['complaintDate']);
								$datetime2 = date_create($resultlists['complaintcloseDate']);
								$interval = date_diff($datetime1, $datetime2);
								$durationcount = $interval->days;
								if($durationcount>=0){ echo $durationcount." day"; } else{ echo "-"; }
								}else{ echo '-'; }
								?>
								</td>
								<td><?php echo getUserName($resultlists['addedBy']); ?></td>
								<td><?php echo getUserName($resultlists['assignTo']); ?></td>
								<td><?php if($resultlists['priority']=='2'){?><span class="badge badge-danger">High</span> <?php }else{ ?> <span class="badge badge-primary">Normal</span><?php } ?></td>
								<td><?php if($resultlists['status']=='1'){?><span class="badge bg-danger-400 badge-pill">Open</span> <?php }else{ ?> <span class="badge bg-success-400 badge-pill">Normal</span><?php } ?></td>
								<td style="text-align:center;">
								<?php if($resultlists['feedback']=='1'){ ?>
								<i class="fa fa-smile-o mr-2 text-success-400" style="font-size: 35px; text-align:center;"></i>
								<?php } ?>
								<?php if($resultlists['feedback']=='2'){ ?>
								<i class="fa fa-meh-o mr-1 text-primary-400" style="font-size: 35px; text-align:center;"></i>
								<?php } ?>
								<?php if($resultlists['feedback']=='3'){ ?>
								<i class="fa fa-frown-o mr-1 text-danger-400" style="font-size: 35px; text-align:center;"></i>
								<?php } ?>
								</td>
							</tr>

<?php } ?>
						</tbody>
					</table></div>
					</div>


					</div>


				</div></div>




				</div>
				<!-- /dashboard content -->

			</div>
			<!-- /content area -->


			<!-- Footer -->

			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>

 <style>
 .liststyleimg{float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}

	.badge.dropdown-toggle:after { display:none;
}
 </style>