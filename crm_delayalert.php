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
						<div class="col-xl-3" style="    padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;"> </div>

						</div>











					</div>





				<div class="card">


				<div id="DataTables_Table_2_filter" class="dataTables_filter" style="margin: 0px; margin-top: 15px;">
				<div class="row" id="searchfilters">

				<div class="col-md-12">

				 <form name"search" method="get">

				<input type="hidden" name="module" value="<?php echo $_GET['module']; ?>" />

			  <div class="row" style="padding:20px;">

<div class="col-md-2">
<div class="">
<select name="assignTo" id="assignTo" class="form-control">
<option value="">Select Merchant</option>
<?php
$fu=GetPageRecord('*','userMaster','1 and profileId="85" order by firstName asc');
while($userData=mysqli_fetch_array($fu)){ ?>
<option value="<?php echo encode($userData['id']); ?>" <?php if($_GET['assignTo']==encode($userData['id'])){ ?> selected="selected" <?php } ?>><?php echo $userData['firstName'].' '.$userData['lastName']; ?></option>
<?php } ?>
</select>
</div>
</div>


	              <div style="width: 60px; margin-right: 10px;">
					<div class="">
								<button name="search" type="submit" class="btn bg-success-400" id="search">Search</button>
							</div>
						</div>
						<?php if($_GET['assignTo']!=''){ ?>
						<div class="col-md-2">
					<div class="">
								 <a href="download-delay-alert.php?assignTo=<?php echo $_GET['assignTo']; ?>" class="btn bg-primary-400" target="_blank"><i class="fa fa-download" aria-hidden="true" style="margin-right:5px;"></i>Download Excel</a>
							</div>
						</div>

						<?php } ?>

				  </div>
				</form>

				</div>

				</div>

				</div>

<?php

if($_GET['categoryId']!=''){
$categoryid='and categoryId="'.decode($_GET['categoryId']).'"';
}

if($_GET['tatstatus']!=''){
$tatstatus='and styleTatStatus="'.$_GET['tatstatus'].'"';
}


$CountQuery=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 '.$categoryid.' '.$tatstatus.' order by id desc');
$totalQuery=mysql_num_rows($CountQuery);

$CountQueryahead=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 and styleTatStatus="Ahead" '.$categoryid.' '.$tatstatus.' order by id desc');
$totalQueryhead=mysql_num_rows($CountQueryahead);

$CountQuerydelayed=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 and styleTatStatus="Delayed" '.$categoryid.' '.$tatstatus.' order by id desc');
$totalQuerydelayed=mysql_num_rows($CountQuerydelayed);

$CountQuerycompleted=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 and styleTatStatus="Completed" '.$categoryid.' '.$tatstatus.' order by id desc');
$totalQuerycompleted=mysql_num_rows($CountQuerycompleted);

$CountQueryontime=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 and styleTatStatus="Ontime" '.$categoryid.' '.$tatstatus.' order by id desc');
$totalQueryontime=mysql_num_rows($CountQueryontime);

$Countbuyer=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 '.$categoryid.' '.$tatstatus.' group by buyerId');
$totalbuyers=mysql_num_rows($Countbuyer);

$Countcategories=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 '.$categoryid.' '.$tatstatus.' group by categoryId');
$totalcategories=mysql_num_rows($Countcategories);

$Counthighpriority=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 '.$categoryid.' '.$tatstatus.' and queryPriority=3');
$highpriority=mysql_num_rows($Counthighpriority);

$CountpoAttachment=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 '.$categoryid.' '.$tatstatus.' and poAttachment!=""');
$poAttachmentcount=mysql_num_rows($CountpoAttachment);



?>



					<form name="listform" id="listform" method="get">
					<input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
					<div id="pageload">

					 		<div id="" > <div class="datatable-scroll">
					<table class="table table-bordered table-hover no-footer table-responsive">
						<thead style="background-color: #f5f5f5;">

							<tr role="row">
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 50px;">CATEGORY</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">SUB&nbsp;CATEGORY</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">REF.&nbsp;NO.</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">PICTURE</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">TASK&nbsp;STATUS</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">DAYS&nbsp;LEFT</th>

								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">CURRENT&nbsp;STATUS</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">ASSIGN&nbsp;TO</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">ASSIGN ON</th>

							</tr>
						</thead>
						<tbody>
						<?php


$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit='25';

$assignTo='';
if($_GET['assignTo']!=''){
$assignTo = 'and assignTo="'.decode($_GET['assignTo']).'"';
}


$where='where '.$wheresearchassign.' subject!="" and deletestatus=0 '.$assignTo.' order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module=delayalert&records='.$limit.'&searchField='.$searchField.'&assignTo='.$_GET['assignTo'].'&';
$rs=GetRecordList($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
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


								<td align="center"><?php echo getCategoryName($resultlists['categoryId']); ?></td>
								<td align="center"><?php echo getSubCategoryName($resultlists['subCategoryId']); ?></td>
								<td><?php echo '#'.$resultlists['styleRefId']; ?></td>
							 	<td> <div class="liststyleimg" style="width: 94px !important;"><img src="images/<?php if($imgresult['attachmentImage']!=''){?><?php echo $imgresult['attachmentImage']; ?><?php }else{ ?>noimage.png<?php } ?>" style="height: 80px; width:80px;" ></div></td>

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
<div class="showeddiv">
<table width="100%" cellspacing="0" cellpadding="0" style="border: 1px solid #ccc;">
<tr>
<td align="center" >Total</td>
<td align="center" >Lapsed</td>
<td align="center" >Left</td>
</tr>
<tr>
<td align="center"><?php echo $departmentTimeline['duration']; ?></td>
<td align="center"><?php echo $durationcount; ?></td>
<td align="center"><?php echo $departmentTimeline['duration']-$durationcount; ?></td>
</tr>
</table>
</div>
<?php } ?>





<style>
.showeddiv {
    max-width: 163px;
    overflow: hidden;
    margin-bottom: 8px;
}
.showeddiv table tr td {
    padding: 5px;
    font-size: 10px;
}
</style>


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


<?php if($resultlists['analyzeMaterialListSave']==1){ ?>
<div class="showeddiv">
<table width="100%" cellspacing="0" cellpadding="0" style="border: 1px solid #ccc;">
	<tr>
	<td align="center" >Total</td>
	<td align="center" >Approved</td>
	<td align="center" >Pending</td>
	</tr>
	<tr>
	<td align="center" ><?php echo $totalTask; ?></td>
	<td align="center" ><?php echo $completed; ?></td>
	<td align="center" ><?php echo $totalTask-$pending; ?></td>
	 </tr>
	</table>
</div>
<?php } ?>




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
								<span class="badge" style="border: 1.5px solid #e3ed51; background-color: #fff; color: black; position: relative; width: 142px; font-size: 11px; padding: 6px;"><?php echo $result1['name']; ?></span>
								<?php } else {  ?>

								<span class="badge badge-flat" style="border:1.5px solid <?php echo $result1['statusColor']; ?>; background-color:#fff; color:black; position: relative;width: 142px; font-size: 11px; padding: 6px;"><?php echo $result1['name']; ?></span>
								<?php } ?>

								<?php } ?>

								<?php if($resultlists['stylestatus']=='0'){ ?>
								<span class="badge badge-flat" style="border-color:#ff0000;; color:#ff0000; position: relative; width:108px;width: 142px; font-size: 11px; padding: 6px;" >Rejected</span>




								<?php } ?>
								<br>								</td>
							   <td><?php echo getUserName($resultlists['assignTo']); ?></td>
							   <td><div style="width:150px;"><?php if($resultdays['dateAdded']!=''){ echo date('d M, Y - h:i A',$resultdays['dateAdded']); }  ?></div></td>

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
<td><select name="records" id="records" onchange="this.form.submit();" class="lightgrayfield" style="padding: 5px;border: 1px solid #ccc;">
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


				</div>







				</div>


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


<style>
.color-box{
width:122px;
}
</style>
