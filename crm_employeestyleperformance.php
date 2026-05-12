<?php
if($loginuserprofileId==1 || $loginuserprofileId==91){
$wheresearchassign=' 1 and ';
} else {
if($loginuserprofileId==92){
$wheresearchassign=' 1 and finalstatus="2" and (assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'" or ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))) and ';
} else{


if($loginuserprofileId==93){

$wheresearchassign='1';
$wheresearchassign=' '.$wheresearchassign.' and addedBy="'.$_SESSION['userid'].'" and ';
}

else{
$wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))';
$wheresearchassign=' '.$wheresearchassign.' and ';
}
}
}

if($_GET['d']!=''){
//delete style
$namevalue1 = 'deletestatus=1';
$whereval='id="'.decode($_GET['d']).'"';
updatelisting('queryMaster',$namevalue1,$whereval);
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

	 	<div class="content pt-0 filterable" style="margin-top:20px;">

				<div class="row">
				<div class="col-xl-12">

				<div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
						<div class="col-xl-9"><h5 class="card-title" ><?php echo $pageName; ?></h5></div>

					</div>

				<div class="card">


				<div id="DataTables_Table_2_filter" class="dataTables_filter">
				<div class="row">


				<div class="col-md-12">

<?php
$userId=$_POST['userId'];
?>


				<form action="" method="post">

				<label>
				<select name="userId[]" id="userId" multiple="multiple" style="margin-left: 10px; width: 300px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;">

					<?php
					$userId=$_POST['userId'];

					$fc=GetPageRecord('*','userMaster','1 and status=1 and deleteStatus=0 and id!=1 order by firstName asc');
					while($userData=mysqli_fetch_array($fc)){

					$abcrk='';
					if(in_array($userData['id'],$userId)){
					$abcrk='selected';
					}


					$krkr=GetPageRecord('*','profileMaster','1 and id="'.$userData['profileId'].'"');
					$profileData=mysqli_fetch_array($krkr);
					?>

                  <option value="<?php echo $userData['id']; ?>" <?php echo $abcrk; ?>><?php echo $userData['firstName'].' '.$userData['lastName'].' - '.$profileData['profileName']; ?></option>
                  <?php } ?>
                </select>
				</label>

<style>
.multiselect-native-select .multiselect{
width: 300px !important;
}
</style>


<script>
$(function() {
$('#userId').multiselect({
includeSelectAllOption: true,
enableFiltering: true,
enableCaseInsensitiveFiltering: true,
filterPlaceholder: 'Search...'
});
});
</script>


				<label>&nbsp;&nbsp;<input name="" type="submit" id="" class="" value="search" style="text-transform: uppercase; background-color: #03c28d; color: #fff; width: 200px; cursor:pointer;"/></label>
				<input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
				</form>

			 </div>

				</div>


				</div>

					<form name="listform" id="listform" method="get">
					<input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
					<div id="pageload">

					 		<div id="" > <div class="datatable-scroll">
					<table class="table table-bordered table-hover no-footer">
						<thead style="background-color: #f5f5f5;">

							<tr role="row">
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Employee</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Ref.&nbsp;Id</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Name</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Category</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width:150px;">Days</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Priority</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Task&nbsp;Progress(%)</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Status</th>
							 	<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="display:none;">Accept/Reject</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="display:none;">Actions</th>
								<?php if($loginuserprofileId==92){ ?>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">&nbsp; </th>
								<?php } ?>
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


$userId=$_POST['userId'];

$List = implode(', ', $userId);

if($userId!=''){
$Listabc ='and id in (select styleId from styleAssignmentMaster where assignTo in('.$List.'))';
}

$where='where '.$wheresearchassign.' subject!="" and deletestatus=0 '.$Listabc.' order by id desc';


$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';




$rs=GetRecordListJs($select,'queryMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$selectimg='*';
$whereimg='parentId="'.$resultlists['id'].'" and galleryType="image_gallery" order by id asc';
$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
$imgresult=mysqli_fetch_array($rsimg);
$selectdays='*';
$wheredays='styleId="'.$resultlists['id'].'" and statusId=2';
$rsdays=GetPageRecord($selectdays,'styleAssignmentMaster',$wheredays);
$resultdays=mysqli_fetch_array($rsdays);

?>
							<tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>
								<td align="center"><?php if($_GET['userId']!=''){ echo getUserName(decode($_GET['userId'])); }else{ echo getUserName($resultlists['assignTo']); } ?></td>
								<td><div class="liststyleimg" style="width: 94px !important;"><a href="#" onClick="opmodalpop(' Image Gallery','modalpop.php?action=imagegalleryview&id=<?php echo encode($resultlists['id']); ?>','800px','auto');" data-toggle="modal" data-target="#modalpop">
								<img src="images/<?php if($imgresult['attachmentImage']!=''){?><?php echo $imgresult['attachmentImage']; ?><?php }else{ ?>noimage.png<?php } ?>" style="height: 80px; width:80px;" ></a></div></td>
								<td><a href="showpage.crm?module=style&view=yes&id=<?php echo encode($resultlists['id']); ?>"><?php echo '#'.$resultlists['styleRefId']; ?><?php if(countQueryunreadMails($resultlists['id'])!=0){ ?><div class="numberbubbol"><?php echo countQueryunreadMails($resultlists['id']); ?></div><?php } ?></a>
									<?php if($loginuserprofileId==92 || $loginuserprofileId=='1'){	?>

									<?php if($resultlists['styleTypeId']=='1'){ ?>
									<span class="badge badge-success" style="width: auto; display: block;">Inhouse</span>
									<?php } ?>

									<?php if($resultlists['styleTypeId']=='2'){ ?>
									<span class="badge badge-warning" style="width: auto; display: block;">Outsource</span>
									<?php } ?>
									<?php if($resultlists['styleTypeId']=='3'){ ?>
									<span class="badge badge-primary" style="width: auto; display: block;">Inhouse & Outsource</span>
									<?php } ?>
									<?php } ?>								</td>
							    <td><?php echo $resultlists['subject']; ?></td>
								<td><?php echo getCategoryName($resultlists['categoryId']).' - '.getSubCategoryName($resultlists['subCategoryId']); ?></td>



								<td id="TATprogressbarhover">

								<?php

								$assignDate = date('Y-m-d',$resultdays['dateAdded']);
								$currDate =date('Y-m-d');
								$datetime1 = date_create($assignDate);
								$datetime2 = date_create($currDate);
								$interval = date_diff($datetime1, $datetime2);
								$durationcount = $interval->days;

							    $rsstatusk=GetPageRecord('*','departmentTimelineMaster','1 and categoryId="'.$resultlists['categoryId'].'" and subCategoryId="'.$resultlists['subCategoryId'].'" order by id desc');

								$countdeptimeline=mysql_num_rows($rsstatusk);

							 	$departmentTimeline=mysqli_fetch_array($rsstatusk);

							    $departmentDurationpersent = round($durationcount*100/$departmentTimeline['duration']);

								$selectstatus='*';
								$wherestatus='styleId="'.$resultlists['id'].'" and statusId!=0 order by id desc';
								$rsstatus=GetPageRecord($selectstatus,'styleAssignmentMaster',$wherestatus);
								$result=mysqli_fetch_array($rsstatus);


								$select1='*';
								$where1='id="'.$result['statusId'].'" order by id desc';
								$rs1=GetPageRecord($select1,'statusMaster',$where1);
								$result1=mysqli_fetch_array($rs1);

								$selecttotaltask='*';
								$wheretotaltask='styleId="'.$resultlists['id'].'"';
								$rstotal=GetPageRecord($selecttotaltask,'styleSubCategoryMaster',$wheretotaltask);

								$selectqty='*';
								$whereqty='styleId="'.$resultlists['id'].'" and qtyStatus=1';
								$rsqty=GetPageRecord($selectqty,'styleSubCategoryMaster',$whereqty);
								$totalqty = mysql_num_rows($rsqty);

								$selectprice='*';
								$whereprice='styleId="'.$resultlists['id'].'" and priceStatus=1';
								$rsprice=GetPageRecord($selectprice,'styleSubCategoryMaster',$whereprice);
								$totalprice = mysql_num_rows($rsprice);

								$selectvendor='*';
								$wherevendor='styleId="'.$resultlists['id'].'" and vendorStatus=1';
								$rsvendor=GetPageRecord($selectvendor,'styleSubCategoryMaster',$wherevendor);
								$totalvendor = mysql_num_rows($rsvendor);

								$totalTask = $totalqty+$totalprice+$totalvendor;

								$selecttaskComplet='*';
								$wheretaskComplet='styleId="'.$resultlists['id'].'" and approvedStatus=1';
								$rswheretaskComplet=GetPageRecord($selecttaskComplet,'materialCostChatMaster',$wheretaskComplet);
								$completed = mysql_num_rows($rswheretaskComplet);



								$persent = round($completed*100/$totalTask);


								$selectfurther='*';
								$wherefurther='styleId="'.$resultlists['id'].'" and approvedStatus=2 and materialFinalStatus=1';
								$rsfurther=GetPageRecord($selectfurther,'materialCostChatMaster',$wherefurther);
								$furtherassign = mysql_num_rows($rsfurther);

								$selectwaiting='*';
								$wherewaiting='styleId="'.$resultlists['id'].'" and approvedStatus=3 and materialFinalStatus=1';
								$rswaiting=GetPageRecord($selectwaiting,'materialCostChatMaster',$wherewaiting);
								$waiting = mysql_num_rows($rswaiting);

								$selectreject='*';
								$wherereject='styleId="'.$resultlists['id'].'" and approvedStatus=4 and materialFinalStatus=1';
								$rsreject=GetPageRecord($selectreject,'materialCostChatMaster',$wherereject);
								$reject = mysql_num_rows($rsreject);


								$pending = $completed+$furtherassign+$waiting+$reject;
								?>

							<?php if($countdeptimeline==1 && $assignDate!='1970-01-01'){ ?>
							<div class="progress">
							<div class="progress-bar bg-primary" style="width: <?php echo $departmentDurationpersent; ?>%">
							<span style="padding: 10px; font-weight: 800;"><?php echo round($departmentDurationpersent); ?>%</span>							</div>
							</div>

							<div style="text-align: center;margin-top: 4px;">

							<?php
							if($departmentDurationpersent>$persent){ ?>
							<span id="tatstatusssss<?php echo $resultlists['id']; ?>" style="color: #ff0000;font-size: 13px;"><?php echo "Delayed";?> </span>
							<?php
							}

							if($departmentDurationpersent<$persent && $persent!=100){ ?>

							<span id="tatstatusssss<?php echo $resultlists['id']; ?>" style="color: #4caf50;  font-size: 13px;"><?php echo "Ahead"; ?> </span>
							<?php }
							if($departmentDurationpersent==$persent){ ?>

							<span id="tatstatusssss<?php echo $resultlists['id']; ?>" style="color: #2196f3;  font-size: 13px; "><?php echo "Ontime"; ?> </span>
							<?php }

							if($persent==100){ ?>

							<span id="tatstatusssss<?php echo $resultlists['id']; ?>" style="font-size: 13px; color: #fff; font-weight: 400; padding: 3px 10px; background-color: #4caf50;"><?php echo "Completed"; ?> </span>
							<?php }

							 ?>
							</div>

							<?php

							if($departmentDurationpersent>$persent){
							$styleTatStatus='Delayed';
							}
							if($departmentDurationpersent<$persent && $persent!=100){
							$styleTatStatus='Ahead';
							}
							if($departmentDurationpersent==$persent){
							$styleTatStatus='Ontime';
							}
							if($departmentDurationpersent>$persent){
							$styleTatStatus='Delayed';
							}
							if($persent==100){
							$styleTatStatus='Completed';
							}

						   $update = updatelisting('queryMaster','styleTatStatus="'.$styleTatStatus.'"','id="'.$resultlists['id'].'"');


							?>




 							 <?php } ?>





<?php if($countdeptimeline==1 && $assignDate!='1970-01-01'){ ?>
<div class="card card-body text-center tblcontent" id="TATstatusreport">
    <h6 class="font-weight-semibold mb-0 mt-1" style="width: 100%; text-align: center; font-weight: 600; font-size: 11px; margin-bottom: 10px !important;">Total Days (<?php echo $departmentTimeline['duration']; ?>)</h6>

	<table width="100%" border="1" cellspacing="0" cellpadding="5">
	<tr>
	<td align="left">Total Days</td>
	<td align="left">Lapsed</td>
	<td align="left">Days Left</td>
	 </tr>
	<tr>
	<td align="left"><?php echo $departmentTimeline['duration']; ?></td>
	<td align="left"><?php echo $durationcount; ?></td>
	<td align="left"><?php echo $departmentTimeline['duration']-$durationcount; ?></td>
 	</tr>
	</table>
						</div>
<?php } ?>
<style>
#TATprogressbarhover{
cursor:pointer;
}
#TATstatusreport {
    width: 290px;
    position: absolute;
    right: 534px;
    padding-bottom: 25px;
    border-radius: 0px;
    background: #fff;
    display: table-row;
    z-index: 9;
	display:none;
}
#TATprogressbarhover:hover #TATstatusreport{
display:block;
}
#TATstatusreport table tr td {
    font-weight: 500;
    font-size: 10px;
    padding: 2px;
    width: 50px;
    text-align: center;
}
</style></td>

								<td><?php if($resultlists['queryPriority']=='1'){ ?><span class="badge badge-secondary" style="width: 47px;">Low</span><?php } if($resultlists['queryPriority']=='2'){ ?><span class="badge badge-primary" style="width: 47px;">Medium</span><?php } if($resultlists['queryPriority']=='3'){ ?><span class="badge badge-danger" style="width: 47px;">High</span><?php }?></td>


								<!--<td>
								<?php
								if($resultlists['styleType']==1){ echo 'Inhouse';}if($resultlists['styleType']==2){ echo 'Outsource';}if($resultlists['styleType']==3){ echo 'Partial Outsource';}if($resultlists['styleType']=='0'){ echo '-';}
								 ?>
								</td>-->

								<td id="progressbarhover">
								<?php
								$selectstatus='*';
								$wherestatus='styleId="'.$resultlists['id'].'" and statusId!=0 order by id desc';
								$rsstatus=GetPageRecord($selectstatus,'styleAssignmentMaster',$wherestatus);
								$result=mysqli_fetch_array($rsstatus);

								$select1='*';
								$where1='id="'.$result['statusId'].'" order by id desc';
								$rs1=GetPageRecord($select1,'statusMaster',$where1);
								$result1=mysqli_fetch_array($rs1);

								$selecttotaltask='*';
								$wheretotaltask='styleId="'.$resultlists['id'].'"';
								$rstotal=GetPageRecord($selecttotaltask,'styleSubCategoryMaster',$wheretotaltask);

								$selectqty='*';
								$whereqty='styleId="'.$resultlists['id'].'" and qtyStatus=1';
								$rsqty=GetPageRecord($selectqty,'styleSubCategoryMaster',$whereqty);
								$totalqty = mysql_num_rows($rsqty);

								$selectprice='*';
								$whereprice='styleId="'.$resultlists['id'].'" and priceStatus=1';
								$rsprice=GetPageRecord($selectprice,'styleSubCategoryMaster',$whereprice);
								$totalprice = mysql_num_rows($rsprice);

								$selectvendor='*';
								$wherevendor='styleId="'.$resultlists['id'].'" and vendorStatus=1';
								$rsvendor=GetPageRecord($selectvendor,'styleSubCategoryMaster',$wherevendor);
								$totalvendor = mysql_num_rows($rsvendor);

								//$totalTask = mysql_num_rows($rstotal);




								$totalTask = $totalqty+$totalprice+$totalvendor;

								$selecttaskComplet='*';
								$wheretaskComplet='styleId="'.$resultlists['id'].'" and approvedStatus=1';
								$rswheretaskComplet=GetPageRecord($selecttaskComplet,'materialCostChatMaster',$wheretaskComplet);
								$completed = mysql_num_rows($rswheretaskComplet);



								$persent = round($completed*100/$totalTask);

								$selectfurther='*';
								$wherefurther='styleId="'.$resultlists['id'].'" and approvedStatus=2 and materialFinalStatus=1';
								$rsfurther=GetPageRecord($selectfurther,'materialCostChatMaster',$wherefurther);
								$furtherassign = mysql_num_rows($rsfurther);

								$selectwaiting='*';
								$wherewaiting='styleId="'.$resultlists['id'].'" and approvedStatus=3 and materialFinalStatus=1';
								$rswaiting=GetPageRecord($selectwaiting,'materialCostChatMaster',$wherewaiting);
								$waiting = mysql_num_rows($rswaiting);

								$selectreject='*';
								$wherereject='styleId="'.$resultlists['id'].'" and approvedStatus=4 and materialFinalStatus=1';
								$rsreject=GetPageRecord($selectreject,'materialCostChatMaster',$wherereject);
								$reject = mysql_num_rows($rsreject);


								$pending = $completed+$furtherassign+$waiting+$reject;
								?>

<div class="progress">
	<div class="progress-bar bg-primary" style="width: <?php echo $persent; ?>%">
		<span style="padding: 10px; font-weight: 800;"><?php echo round($persent); ?>%</span>	</div>
</div>


<div style="text-align: center;margin-top: 4px;"><?php echo round($persent); ?>%</div>


<?php if($resultlists['analyzeMaterialListSave']==1){ ?>
<div class="card card-body text-center tblcontent" id="statusreport">
  <h6 class="font-weight-semibold mb-0 mt-1" style="width: 100%; text-align: center; font-weight: 600; font-size: 11px; margin-bottom: 10px !important;">Total Tasks (<?php echo $totalTask; ?>)</h6>

	<table width="100%" border="1" cellspacing="0" cellpadding="5">
	<tr>
	<td align="left">Approved</td>
	<td align="left">Pending</td>
	<td align="left">Waiting&nbsp;For&nbsp;Approval</td>
	<td align="left">Further&nbsp;Assigned</td>
	<td align="left">Rejected</td>
	</tr>
	<tr>
	<td align="left"><?php echo $completed; ?></td>
	<td align="left"><?php echo $totalTask-$pending; ?></td>
	<td align="left"><?php echo $waiting; ?></td>
	<td align="left"><?php echo $furtherassign; ?></td>
	<td align="left"><?php echo $reject; ?></td>
	</tr>
	</table>
						</div>
<?php } ?>
<style>
#progressbarhover{
cursor:pointer;
}
#statusreport {
    width: 420px;
    position: absolute;
    right: 204px;
    padding-bottom: 25px;
     border-radius: 0px;
    background: #fff;
    display: none;
	z-index: 9;
}
#progressbarhover:hover #statusreport{
display:block;
}
#statusreport table tr td {
    font-weight: 500;
    font-size: 10px;
    padding: 2px;
    width: 50px;
    text-align: center;
}
</style>

								<?php
								$selecttat='*';
								$wheretat='departmentId=2 and categoryId="'.$resultlists['categoryId'].'" and subCategoryId="'.$resultlists['subCategoryId'].'"';
								$rstat=GetPageRecord($selecttat,'departmentTimelineMaster',$wheretat);
								$resulttat=mysqli_fetch_array($rstat);
								$tatDays = $resulttat['duration'];

								//echo $assignDays = $tatDays-$durationcount.' Days Left';
								?>								</td>

								<td align="left">

						<?php if($resultlists['stylestatus']!='0'){ ?>


								<?php if($resultlists['stylestatus']!='0' && $resultlists['finalstatus']!='2'){ ?>
								<span class="badge" style="cursor:pointer;background-color:<?php echo $result1['statusColor']; ?>; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;" <?php if($resultlists['stylestatus']!='0' && $resultlists['finalstatus']!='2'){ ?> onClick="opmodalpop('Change Status','modalpop.php?action=acceptreject&styleId=<?php echo encode($resultlists['id']); ?>&styleTypeId=<?php echo $resultlists['styleTypeId']; ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" <?php } ?>><?php echo $result1['name']; ?></span>
								<?php } else {  ?>


								<span class="badge badge-flat" style="border:1.5px solid <?php echo $result1['statusColor']; ?>; background-color:#fff; color:black; position: relative;width: 142px; font-size: 11px; padding: 6px;"><?php echo $result1['name']; ?></span>
								<?php } ?>

								<?php } ?>

								<?php if($resultlists['stylestatus']=='0'){ ?>
								<span class="badge badge-flat" style="border-color:#ff0000;; color:#ff0000; position: relative; width:108px;width: 142px; font-size: 11px; padding: 6px;" >Rejected</span>




								<?php } ?>
								<br>								</td>



								<td align="center" style="display:none;">

								<?php if($resultlists['stylestatus']!='0' && $resultlists['finalstatus']!='2'){ ?>
									<span class="badge list-group-item list-group-item-action" style="background-color: #33cc33;color: #FFFFFF; position: relative;padding: 7px; font-size: 11px;background: #ff7043;cursor:pointer;" onClick="opmodalpop('Change Status','modalpop.php?action=acceptreject&styleId=<?php echo encode($resultlists['id']); ?>','400px','auto');" data-toggle="modal" data-target="#modalpop">Accept/Reject</span>
								<?php } ?>

									<?php if($resultlists['stylestatus']=='0' && $resultlists['stylestatus']!='2'){ ?>
		<span class="badge badge-flat" style="border-color: #ff7043;color: #ff7043; position: relative;padding: 7px; font-size: 11px;">Rejected</span>
									<?php } ?>


									<?php if($resultlists['stylestatus']=='1' && $resultlists['finalstatus']=='2'){ ?>
		<span class="badge badge-flat" style="border-color: #02c681; color: #02c681; position: relative;padding: 7px; font-size: 11px;">Accepted</span>
									<?php } ?>								</td>

								<td style="display:none;"></td>
								<!--<?php if($deletepermission==1){ ?><td style="">
								<div class="btn-group">
								<a href="#" onclick="deletestyle('<?php echo encode($resultlists['id']);; ?>');"><button type="button" class="btn btn-warning" style="padding:5px;"><i class="fa fa-trash" aria-hidden="true" style=" color: #fffffff1;   font-size: 16px; "></i></button></a>
								</div>
								</td>
								<?php } ?>-->
							<?php if($loginuserprofileId==92){ ?>
							<td><span style="width: 90px; display: block; background-color: #0288d1; color: #fff; text-align: center; padding: 4px; cursor:pointer;" onClick="opmodalpop('Action','modalpop.php?action=changestyletype&id=<?php echo encode($resultlists['id']); ?>','500px','auto');" data-toggle="modal" data-target="#modalpop">Change Type</span></td>
							<?php } ?>
							</tr>

<?php } ?>
						</tbody>
					</table>
						<div class="pagingdiv" style="width: 97%;margin: 20px auto;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody><tr>
<td><table border="0" cellpadding="0" cellspacing="0">
<tr>
<td style="padding-right:20px;"><?php echo $totalentry; ?> entries</td>
<td><select name="records" id="records" onChange="this.form.submit();" class="lightgrayfield" style="padding: 5px;border: 1px solid #ccc;">
<option value="25" <?php if($_GET['records']=='25'){ ?> selected="selected"<?php } ?>>25 Records Per Page</option>
<option value="50" <?php if($_GET['records']=='50'){ ?> selected="selected"<?php } ?>>50 Records Per Page</option>
<option value="100" <?php if($_GET['records']=='100'){ ?> selected="selected"<?php } ?>>100 Records Per Page</option>
<option value="200" <?php if($_GET['records']=='200'){ ?> selected="selected"<?php } ?>>200 Records Per Page</option>
<option value="300" <?php if($_GET['records']=='300'){ ?> selected="selected"<?php } ?>>300 Records Per Page</option>
</select></td>
</tr>
</table></td>
<td align="right"><div class="pagingnumbers"><?php echo $paging; ?></div></td>
</tr>
</tbody></table>
</div>
					</div>


					</div>


					</div>


			</form>


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
.pagingnumbers {
    border: 1px #EAEAEA solid;
    border-radius: 2px;
    overflow: hidden;
    float: right;
}
.pagingnumbers a {
    display: inline-block;
    padding: 8px 15px;
    min-width: 12px;
    text-align: center;
    color: #2c2c2c;
    text-decoration: none;
    border-right: #EAEAEA solid 1px;
    font-size: 12px;
    padding-top: 9px;
}
.pagingnumbers .disabled {
    display: inline-block;
    padding: 7px 8px;
    color: #CECECE;
}
.pagingnumbers .current {
    display: inline-block;
    padding: 8px 8px;
}
.pagingnumbers .current {
    background-color: #2ca1cc;
    color: #FFFFFF;
}
.dataTables_info,.dataTables_paginate,.dataTables_length {
	display:none !important;
 }

 </style>

<script>
$('#DataTables_Table_2').DataTable( {
"order": [[ 0, "desc" ]]
} );
</script>
