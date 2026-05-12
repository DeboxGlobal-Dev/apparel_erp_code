<?php
 if($loginuserprofileId==1){

$wheresearchassign=' 1 and ';

} else {

$wheresearchassign=' ( assignTo in (select id from '._USER_MASTER_.' where  empId in (select id from employeeMaster where id ='.$_SESSION['empid'].')) or assignTo in (select id from '._USER_MASTER_.' where  empId in (select reportingTo from employeeMaster where id="'.$_SESSION['empid'].'"))) ';

$wheresearchassign=' '.$wheresearchassign.' and ';

}?>
<div class="page-content">
<style>
.even{
background-color: #0097a71a;
}
</style>

		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<div class="content-wrapper">

		<!---Save Alert Notification---->
		<?php include "savealert.php"; ?>
	<style>
	.dataTables_length{
	    display:none!important;
	}
	.dataTables_filter{
	    display:none!important;
	}
 </style>
			<div class="content pt-0" style="margin-top:20px;">

				<div class="row">
				<div class="col-xl-12">

				<div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
						<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
						 <div class="col-xl-1" style="padding-right: 0px;">
						</div>
						 <a href="download-dhureports.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;">Download Excel</a>
					</div>

				<div class="card">
					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead style="background-color: #f5f5f5;">
							<tr role="row">
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 50px;">Date</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Factory</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Line&nbsp;No</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Total&nbsp;Number&nbsp;of&nbsp;Defects </th>
																<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Total&nbsp;Pieces&nbsp;Checked </th>

							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">DHU(%)</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" style="display:none;">&nbsp;</th>
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

if($_GET['stylestatus']!=''){
$stylestatus = 'and finalstatus="'.$_GET['stylestatus'].'"';
}

$wheres='parentId="'.$resultlists['id'].'" and galleryType="image_gallery" order by id asc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,'qualityInspectionMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){



    $a=$resultlists['numberofpassgar']+$resultlists['numberofdefgar'];



    $dhu=($resultlists['numberofdefects']/$a)*100;

$selectimg='*';
$whereimg='id="'.$resultlists['styleId'].'" ';
$rsimg=GetPageRecord($selectimg,'queryMaster',$whereimg);
$imgresult=mysqli_fetch_array($rsimg);





$selectdays='*';
$wheredays='id="'.$resultlists['line'].'" ';
$rsdays=GetPageRecord($selectdays,'factoryLineMaster',$wheredays);
$resultdays=mysqli_fetch_array($rsdays);



$selectdaysa='*';
$wheredaysa='id="'.$resultlists['factoryId'].'" ';
$rsdaysa=GetPageRecord($selectdaysa,'factoryMaster',$wheredaysa);
$resultdaysa=mysqli_fetch_array($rsdaysa);




?>

							<tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>
							<td align="center"><?php echo $resultlists['fromDate']; ?></td>

								<td>#<?php echo $imgresult['styleRefId']; ?></td>

								<td><?php echo $resultdaysa['name']; ?></td>
								                          <td> <span style="padding: 5px 10px; background-color: #0097a7; color: #fff; margin-right: 2px; font-size: 12px; margin-bottom:5px;display: inline-block;"><?php echo str_replace(' ','&nbsp;', $resultdays['lineName']);?></span></td>




							   <td><?php echo $resultlists['numberofdefects']; ?></td>

								<td><?php echo $a; ?>	</td>
																<td><?php echo round($dhu,2); ?>%</td>
								<td align="center" class="" style="display:none;">

								 <a class="btn btn-primary" style="padding:5px;" href="../21-01-2020/showpage.crm?module=stylewiselineplan&add=yes&styleid=<?php echo encode($resultlists['id']); ?>&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&factoryId=<?php echo $factotyData['id']; ?>"><i class="fa fa-eye " aria-hidden="true" style=" color: #fffffff1; font-size: 16px; "></i></a>								  </td>

								<?php if($resultdays['statusId']=='19' || $resultdays['statusId']=='20'){  ?>
								<?php }else{ ?>
								<?php } ?>
							</tr>

<?php } ?>
						</tbody>
					</table>

					</div>
					</div>

					</div>

				</div></div>

				</div>

			</div>


		</div>

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

