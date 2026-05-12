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



			<div class="content pt-0" style="margin-top:20px;">

				<div class="row">
				<div class="col-xl-12">

				<div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
						<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
						 <div class="col-xl-3" style="    padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">


						</div></div>
					</div>

				<div class="card">
					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead style="background-color: #f5f5f5;">
							<tr role="row">
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 50px;">SR#</th>

								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Ref.&nbsp;Id</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Name</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Category</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Total&nbsp;Quantity</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Factory</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Lines</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" style="width: 50px;">StyleColor</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" style="width: 50px;">Date</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">&nbsp;</th>
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

$where='where '.$wheresearchassign.' styleStatus!=0 and sampleStyle=1 and subject!="" '.$stylestatus.' and poAttachment!="" order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$selectimg='*';
$whereimg='parentId="'.$resultlists['id'].'" and galleryType="image_gallery" order by id asc';
$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
$imgresult=mysqli_fetch_array($rsimg);


$selectdays='*';
$wheredays='styleId="'.$resultlists['id'].'" and statusId in (19,20) order by id desc';
$rsdays=GetPageRecord($selectdays,'styleAssignmentMaster',$wheredays);
$resultdays=mysqli_fetch_array($rsdays);


$rkdm=GetPageRecord('min(uploadInputDate) as minDate, max(uploadInputDate) as maxDate','linePlanMaster','1 and styleId="'.$resultlists['id'].'"');
$dateWise=mysqli_fetch_array($rkdm);

$startDate=	date('d-m-Y',strtotime($dateWise['minDate']));
$endDate=date('d-m-Y',strtotime($dateWise['maxDate']));


$kr=GetPageRecord('*','linePlanMaster','1 and styleId="'.$resultlists['id'].'"');
$lineData=mysqli_fetch_array($kr);

$km=GetPageRecord('*','factoryMaster','id="'.$lineData['factoryId'].'"');
$factotyData=mysqli_fetch_array($km);




?>

							<tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>
							<td align="center"><?php echo $resultlists['displayId']; ?></td>

								<td> <a href="showpage.crm?module=stylewiselineplan&add=yes&styleid=<?php echo encode($resultlists['id']); ?>&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&factoryId=<?php echo $factotyData['id']; ?>"><?php echo '#'.$resultlists['styleRefId']; ?></a></td>




								<td><?php echo $resultlists['subject']; ?></td>

								<td><?php echo getCategoryName($resultlists['categoryId']).' - '.getSubCategoryName($resultlists['subCategoryId']); ?></td>

								<?php
							    $qtyTotal =0;
								$grossTotal = 0;
							  	$selectqty='*';
								$whereqty='styleId="'.$resultlists['id'].'"';
								$rsqty=GetPageRecord($selectqty,'buyerPurchaseOrderMaster',$whereqty);
								$resultqty=mysqli_fetch_array($rsqty);
								?>
							   <td><?php echo $resultqty['qtyTotal']; ?></td>
								<td>
								<?php


								echo $factotyData['name'];

								?>								</td>

								<td>

								<?php

							 	$kk=GetPageRecord('*','linePlanMaster','1 and styleId="'.$resultlists['id'].'" and factoryId="'.$lineData['factoryId'].'" group by lineId desc');
								while($lineDataa=mysqli_fetch_array($kk)){
							    $lineDataa['lineId'];


								$lo=GetPageRecord('*','factoryLineMaster','id="'.$lineDataa['lineId'].'"');
								$lineName=mysqli_fetch_array($lo);

								?>
		<span style="padding: 5px 10px; background-color: #0097a7; color: #fff; margin-right: 2px; font-size: 12px; margin-bottom:5px;display: inline-block;"><?php echo str_replace(' ','&nbsp;',$lineName['lineName']);?></span>

								<?php


								}


								?>								</td>
								<?php if($resultdays['statusId']=='19' || $resultdays['statusId']=='20'){  ?>
								<?php }else{ ?>
								<?php } ?>

								<td align="center"><div style=" color:#fff;background-color:<?php echo $resultlists['styleColor']; ?>;"><?php echo $resultlists['styleColor']; ?></div></td>


							    <td align="left" style="width: 200px;">

								<?php

	if($dateWise['minDate']!='' && $dateWise['maxDate']!=''){
	echo date('d-m-Y',strtotime($dateWise['minDate'])).' TO '.date('d-m-Y',strtotime($dateWise['maxDate']));
	}
								?>


								</td>

								<td align="center" class="">

								 <a class="btn btn-primary" style="padding:5px;" href="showpage.crm?module=stylewiselineplan&add=yes&styleid=<?php echo encode($resultlists['id']); ?>&startDate=<?php echo $startDate; ?>&endDate=<?php echo $endDate; ?>&factoryId=<?php echo $factotyData['id']; ?>"><i class="fa fa-eye " aria-hidden="true" style=" color: #fffffff1; font-size: 16px; "></i></a>

								  </td>


							</tr>

<?php } ?>
						</tbody>
					</table>
					</div>
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

