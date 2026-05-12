<?php
ob_start();
include "inc.php";
$assignto=getUserName(decode($_GET['assignTo']));

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>

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
<table border="1" cellpadding="15" cellspacing="0" style="font-size:12px;">
						 	<tr style="background-color: #4f55ff;color: #fff;" height="30">
							    <th align="left">&nbsp; </th>
								<th align="left">&nbsp; </th>
								<th align="left">&nbsp; </th>
								<th align="left">&nbsp; </th>
								<th align="center">&nbsp; </th>
								<th align="center" colspan="3">Days Left </th>
								<th align="center" colspan="3">Task&nbsp;Status</th>
								<th align="center">&nbsp; </th>

								<th align="center">&nbsp; </th>
								<th align="center">&nbsp; </th>
							 </tr>
                            <tr style="background-color: #4f55ff;color: #fff;" height="30">
						    	 <th align="left">Sr.No.</th>
							    <th align="left">Category</th>
								<th align="left">Sub Category </th>
								<th align="left">Ref.&nbsp;No.</th>
								<th align="center">Picture</th>
								<th align="center"  width="80">Total</th>
								<th align="center"  width="80">Lapsed</th>
								<th align="center"  width="80">Left</th>

								<th align="center">Total</th>
								<th align="center">Approved</th>
								<th align="center">Pending</th>

								<th align="left">Current Status </th>
								<th align="left">Assign To </th>
								<th align="left">Assign On </th>
							 </tr>

						<?php
$serial=0;
$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit='2000000000';

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
							<tr height="45">
							    <td align="left" valign="top" width="100"><?php echo ++$serial; ?></td>
								<td align="left" valign="top" width="120"><?php echo getCategoryName($resultlists['categoryId']); ?></td>
								<td align="left" valign="top"  width="120"><?php echo getSubCategoryName($resultlists['subCategoryId']); ?></td>
								<td align="left" valign="top"  width="120"><?php echo '#'.$resultlists['styleRefId']; ?></td>
							 	<td align="center" valign="top"  width="100"><img src="<?php echo $fullurl; ?>images/<?php if($imgresult['attachmentImage']!=''){?><?php echo $imgresult['attachmentImage']; ?><?php }else{ ?>noimage.png<?php } ?>" height="60"></td>

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

						<td align="center" valign="top"><?php echo $departmentTimeline['duration']; ?></td>
						<td align="center" valign="top"><?php echo $durationcount; ?></td>
						<td align="center" valign="top"><?php echo $departmentTimeline['duration']-$durationcount; ?></td>



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



								<?php
								$selecttat='*';
								$wheretat='departmentId=2 and categoryId="'.$resultlists['categoryId'].'" and subCategoryId="'.$resultlists['subCategoryId'].'"';
								$rstat=GetPageRecord($selecttat,'departmentTimelineMaster',$wheretat);
								$resulttat=mysqli_fetch_array($rstat);
								$tatDays = $resulttat['duration'];


								?>

								<td align="center" valign="top"  width="80"><?php echo $totalTask; ?></td>
								<td align="center" valign="top"  width="80"><?php echo $completed; ?></td>
								<td align="center" valign="top"  width="80"><?php echo $totalTask-$pending; ?></td>



								<td align="left" valign="top" width="150">

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
							   <td align="left" valign="top"  width="100"><?php echo getUserName($resultlists['assignTo']); ?></td>
							   <td align="left" valign="top"  width="100"><?php if($resultdays['dateAdded']!=''){ echo date('d M, Y - h:i A',$resultdays['dateAdded']); }  ?></td>
							</tr>

<?php } ?>
					</table>



