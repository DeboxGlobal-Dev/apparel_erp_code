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
							    <th style="display: none;" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 50px;">SR#</th>
								<th class="sorting_desc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" width="140px">Style#</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Name</th>
								<th width="200px;" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">PCD&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Handover&nbsp;Date</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="display: none;">Handover&nbsp;By</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="display: none;">Handover&nbsp;To</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="display: none;">Action</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Task&nbsp;Progress</th>
								<!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Download</th>-->
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

$where='where sendppc="1" order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,'fileHandoverMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

	$rrrr=GetPageRecord('*','queryMaster','1 and id="'.$resultlists['styleId'].'"');
      $operation=mysqli_fetch_array($rrrr);
?>
							<tr role="row" class="odd">
							<td style="display: none;" align="center"><?php echo $resultlists['displayId']; ?></td>
								<td align="center">
								<a href="showpage.crm?module=<?php echo $_GET['module']; ?>&view=yes&styleid=<?php echo encode($resultlists['styleId']); ?>"><?php echo '#'.$operation['styleRefId']; ?></a></td>
								<td><?php echo $operation['subject']; ?></td>
								<td align="center">
									<?php
									 if($operation['pcdDate']!='0000-00-00'){ echo date('d-m-Y',strtotime($operation['pcdDate'])); }else{ echo '-'; }
									 ?>
									</td>
								<td align="center">-</td>
								<td style="display: none;"><?php echo getUserName($resultlists['handoverBy']); ?></td>
								<td style="display: none;">-</td>
								<td align="center" style="display: none;">
								<?php if($resultlists['handoverStatus']==0){ ?><a href="#" onclick="opmodalpop('Send To Handover ','modalpop.php?action=filehandver&module=<?php echo $_GET['module']; ?>&styleId=<?php echo encode($resultlists['id']); ?>&pcd=<?php echo date('d-m-Y',strtotime($resultlists['pcdDate'])); ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-blue-400" aria-expanded="false" style="width:130px;">Request Handover</a><?php } ?>
								<?php if($resultlists['handoverStatus']==1){ ?><a href="#" onclick="opmodalpop('Accept/Rejct','modalpop.php?action=filehandveraccept&module=<?php echo $_GET['module']; ?>&styleId=<?php echo encode($resultlists['id']); ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-orange-400" aria-expanded="false" style="width:130px;">Pending For Ack.</a><?php } ?>
								<?php if($resultlists['handoverStatus']==2){ ?><a href="#" class="btn bg-green-400" aria-expanded="false" style="width:130px;">Handover Done</a><?php } ?>
								</td>
								<td align="center">
									   <?php
                  $tdra=GetPageRecord('*','criticalPathMaster','1 and styleId="'.$resultlists['styleId'].'" limit 1');
                  if(mysql_num_rows($tdra) > "0") {
                  while($new1=mysqli_fetch_array($tdra)) {

                    if($new1['devFtp']!="" and $new1['devGtp']!="" and $new1['bulkFtp']!="" and $new1['bulkGtp']!="" and $new1['ppSample']!=""){ ?>
                    <span class="badge" style="background-color: green; color:#FFFFFF; position: relative;">Complete </span>
                  <?php  }
                  else if($new1['devFtp']!="" || $new1['devGtp']!="" || $new1['bulkFtp']!="" || $new1['bulkGtp']!="" || $new1['ppSample']!="") { ?>
                  <span class="badge" style="background-color: orange; color:#FFFFFF; position: relative;">Partial</span>
                  <?php } else{ ?>
                  <span class="badge" style="background-color:#e83333; color:#FFFFFF; position: relative;">Pending</span>
                  <?php } } }
                  else{ ?>
                  <span class="badge" style="background-color:#e83333; color:#FFFFFF; position: relative;">Pending</span>
                   <?php }


                  ?>

                   	 </td>
      <!--             	 <td>-->
						<!--	    	<div style="width:200px;">-->

						<!--<a href="download-filehandoverreport.php?styleId=<?php echo encode($resultlists['id']); ?>" -->
						<!--target="_blank" -->
						<!--style="background: #0288d1; outline: none; color: #fff; padding: 5px; border-radius: 2px; cursor: pointer; width: 95px;-->
						<!--display: block; float:left;"><i class="fa fa-download" aria-hidden="true"></i>TNA</a> -->
						<!--			</div>						</td>-->

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