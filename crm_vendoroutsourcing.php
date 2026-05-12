<?php
if($loginuserprofileId==1 || $loginuserprofileId==93){

$wheresearchassign=' 1 and ';

} else {

if($loginuserprofileId==92){

$wheresearchassign=' 1 and finalstatus="2" and assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'" and ';
} else{

$wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0 and statusId in (19,21)))';

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
		<?php include "left.php"; ?>
		<div class="content-wrapper">

		<!---Save Alert Notification---->
		<?php include "savealert.php"; ?>



			<div class="content pt-0" style="margin-top:20px;">

				<div class="row">
				<div class="col-xl-12">

				<div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
						<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
						 <div class="col-xl-3" style="padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">
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
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Gross&nbsp;Total</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Assign&nbsp;To</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Action</th>
								<th class="text-center sorting_disabled" rowspan="1" colspan="1" style="width: 100px; display:none;" aria-label="Actions">Actions</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Vendors</th>
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

$where='where '.$wheresearchassign.' styleStatus!=0 and subject!="" '.$stylestatus.' order by id desc';
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
$wheredays='styleId="'.$resultlists['id'].'" and statusId=21 and styleAssignTo=0 order by id desc';
$rsdays=GetPageRecord($selectdays,'styleAssignmentMaster',$wheredays);
$resultdays=mysqli_fetch_array($rsdays);

?>

							<tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>
							<td align="center"><?php echo $resultlists['displayId']; ?></td>

								<td><a href="showpage.crm?module=vendoroutsourcing&view=yes&styleid=<?php echo encode($resultlists['id']); ?>&costsheetVersionId=<?php echo $resultlists['defaultcostsheetVersionId'] ?>"><?php echo '#'.$resultlists['styleRefId']; ?><?php if(countQueryunreadMails($resultlists['id'])!=0){ ?><div class="numberbubbol"><?php echo countQueryunreadMails($resultlists['id']); ?></div><?php } ?></a></td>

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
								<td><?php echo $resultqty['grossTotal']; ?></td>
								<td><?php if($resultdays['assignTo']!=''){  echo getUserName($resultdays['assignTo']); }else{ echo '-'; } ?></td>
								<td style=""><?php if($loginuserprofileId==90){ ?><?php if($resultqty['grossTotal']!='' && $resultqty['grossTotal']!='0'){ ?><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;"  onclick="opmodalpop('Send To Merchant','modalpop.php?action=sendtooutsourcemerchant&styleId=<?php echo encode($resultlists['id']); ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" ><?php if($resultdays['assignTo']==''){ ?>Send To Merchant<?php }else{  echo 'Outsource Merchant'; } ?></span><?php } ?><?php } ?>

								<?php if($loginuserprofileId==156){ ?>
								<span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;"  onclick="opmodalpop('Send To Vendor','modalpop.php?action=sendtovendor&styleId=<?php echo encode($resultlists['id']); ?>&defaultcostsheetVersionId=<?php echo $resultlists['defaultcostsheetVersionId']; ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" >Send To Vendor</span>
								<?php } ?>
								</td>
								<td style=" display:none;"> </td>
								<td>

								<?php

								$selectf='*';
								$wheref='styleId="'.$resultlists['id'].'" group by vendorId desc';
								$rsf=GetPageRecord($selectf,'materialSendToVendor',$wheref);
								while($resultvendor=mysqli_fetch_array($rsf)){

								$selectg='*';
								$whereg='id="'.$resultvendor['vendorId'].'"';
								$rsg=GetPageRecord($selectg,'vendorMaster',$whereg);
								$vendorname=mysqli_fetch_array($rsg);
								?>

								<span style="color: #fff; background-color: #239a62; padding: 4px 10px; border-radius: 3px; font-size: 11px;"><?php echo $vendorname['name']; ?></span>

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
.liststyleimg{
	float: left;
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

