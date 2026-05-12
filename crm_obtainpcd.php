<?php
if($loginuserprofileId==1 || $loginuserprofileId==93){

$wheresearchassign=' 1 and ';

} else {

if($loginuserprofileId==92){

$wheresearchassign=' 1 and finalstatus="2" and assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'" and ';
} else{

$wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))';

$wheresearchassign=' '.$wheresearchassign.' and ';

}

}

?>
<div class="page-content">
<style>
.even{
background-color: #0097a71a;
}
</style>
		<!-- Main sidebar -->

		<div class="content-wrapper">
 		<!---Save Alert Notification---->
		<?php include "savealert.php"; ?>


			<div class="content pt-0" style="margin-top:20px;">

				<div class="row">
				<div class="col-xl-12">

				<div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
						<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
						 <div class="col-xl-3" style="    padding-right: 0px;"></div>
					</div>

				<div class="card">
					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead style="background-color: #f5f5f5;">
							<tr role="row">
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 50px;">SR#</th>
								<th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Ref.&nbsp;Id</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Name</th>

								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">PCD&nbsp;Date</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Shipment&nbsp;Date</th>
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

$where='where '.$wheresearchassign.' subject!="" and sampleStyle=1 and deletestatus=0 order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){



$selectstatus='*';
$wherestatus='styleId="'.$resultlists['id'].'" and statusId!=0 order by id desc';
$rsstatus=GetPageRecord($selectstatus,'styleAssignmentMaster',$wherestatus);
$result=mysqli_fetch_array($rsstatus);


$select1='*';
$where1='id="'.$result['statusId'].'" order by id desc';
$rs1=GetPageRecord($select1,'statusMaster',$where1);
$result1=mysqli_fetch_array($rs1);
?>

<?php if($result1['id']!='1' && $result1['id']!='2' && $result1['id']!='13' && $result1['id']!='14' && $result1['id']!='15') { ?>
							<tr role="row" class="odd">
							<td align="center"><?php echo $resultlists['displayId']; ?></td>
								<td>
								<a href="showpage.crm?module=obtainpcd&add=yes&styleid=<?php echo encode($resultlists['id']); ?>"><?php echo '#'.$resultlists['styleRefId']; ?><?php if(countQueryunreadMails($resultlists['id'])!=0){ ?><div class="numberbubbol"><?php echo countQueryunreadMails($resultlists['id']); ?></div><?php } ?></a></td>
								<td><?php echo $resultlists['subject']; ?></td>

							<td><?php if($resultlists['pcdDate']=='0000-00-00'){ echo '-';  }else{ echo date('d M, Y',strtotime($resultlists['pcdDate'])); }  ?></td>
							<td><?php if($resultlists['shipDate']=='0000-00-00'){ echo '-';  }else{ echo date('d M, Y',strtotime($resultlists['shipDate'])); }  ?></td>
								<td>

								<span class="badge badge-flat" style="border:1.5px solid <?php echo $result1['statusColor']; ?>; background-color:#fff; color:black; position: relative; width: 142px; font-size: 11px; padding: 6px;">   <?php echo $result1['name']; ?></span>
								</td>

							</tr>
<?php } ?>
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

<script>
$('#DataTables_Table_2').DataTable( {
"order": [[ 0, "desc" ]]
} );
</script>

<style>
.dataTables_filter {
    margin-top: 15px;
}
.dataTables_length {
    margin-top: 15px;
	margin-right:18px;
}
.dataTables_filter input {
    margin-left:10px;
}
.dataTables_info {
    margin-top: 15px;
    margin-left: 18px !important;
}
.dataTables_paginate {
    margin-top: 15px;
    margin-right: 18px;
}
</style>