<?php include "inc.php";
if($_REQUEST['userid']!=''){
	$sessionuserId = $_REQUEST['userid'];
}else{
	$sessionuserId = $_SESSION['userid'];
}
?>


<div style="height: 335px; overflow: scroll;">

<table width="100%" class="table">
									<thead>
										<tr>
										  <th width="30%" align="left" ><div align="left">Style&nbsp;ID </div></th>
											 <th width="10%" align="left" ><div align="left">&nbsp;</div></th>
											<th width="60%" align="left"><div align="left">Task Progress(%)</div></th>
										</tr>
									</thead>
									<tbody>
									<?php
									$select='';
									$where='';
									$rs='';
									$select='*';
									if($loginuserprofileId=='1'){
									$where='1 and subject!="" and styleStatus!=0 and deletestatus=0 order by id desc';
									}else{
									$where='1 and subject!="" and deletestatus=0 and assignTo="'.$sessionuserId.'" or assignTo in (select id from userMaster where empId in (select id from employeeMaster where reportingTo in (select empId from userMaster where id="'.$sessionuserId.'")) ) order by id desc';
						 			}
									$rs=GetPageRecord($select,_QUERY_MASTER_,$where);
									$rsCount = mysqli_num_rows($rs);
									while($result=mysqli_fetch_array($rs)){

								$selectstatus='*';
								$wherestatus='styleId="'.$result['id'].'" and statusId!=0 order by id desc';
								$rsstatus=GetPageRecord($selectstatus,'styleAssignmentMaster',$wherestatus);
								$result1=mysqli_fetch_array($rsstatus);

								$select1='*';
								$where1='id="'.$result1['statusId'].'" order by id desc';
								$rs1=GetPageRecord($select1,'statusMaster',$where1);
								$result1=mysqli_fetch_array($rs1);

								$selecttotaltask='*';
								$wheretotaltask='styleId="'.$result['id'].'"';
								$rstotal=GetPageRecord($selecttotaltask,'styleSubCategoryMaster',$wheretotaltask);

								$selectqty='*';
								$whereqty='styleId="'.$result['id'].'" and qtyStatus=1';
								$rsqty=GetPageRecord($selectqty,'styleSubCategoryMaster',$whereqty);
								$totalqty = mysqli_num_rows($rsqty);

								$selectprice='*';
								$whereprice='styleId="'.$result['id'].'" and priceStatus=1';
								$rsprice=GetPageRecord($selectprice,'styleSubCategoryMaster',$whereprice);
								$totalprice = mysqli_num_rows($rsprice);

								$selectvendor='*';
								$wherevendor='styleId="'.$result['id'].'" and vendorStatus=1';
								$rsvendor=GetPageRecord($selectvendor,'styleSubCategoryMaster',$wherevendor);
								$totalvendor = mysqli_num_rows($rsvendor);

								//$totalTask = mysqli_num_rows($rstotal);




								$totalTask = $totalqty+$totalprice+$totalvendor;

								$selecttaskComplet='*';
								$wheretaskComplet='styleId="'.$result['id'].'" and approvedStatus=1';
								$rswheretaskComplet=GetPageRecord($selecttaskComplet,'materialCostChatMaster',$wheretaskComplet);
								$completed = mysqli_num_rows($rswheretaskComplet);



								$persent = round($completed*100/$totalTask);

								$selectfurther='*';
								$wherefurther='styleId="'.$result['id'].'" and approvedStatus=2 and materialFinalStatus=1';
								$rsfurther=GetPageRecord($selectfurther,'materialCostChatMaster',$wherefurther);
								$furtherassign = mysqli_num_rows($rsfurther);

								$selectwaiting='*';
								$wherewaiting='styleId="'.$result['id'].'" and approvedStatus=3 and materialFinalStatus=1';
								$rswaiting=GetPageRecord($selectwaiting,'materialCostChatMaster',$wherewaiting);
								$waiting = mysqli_num_rows($rswaiting);

								$selectreject='*';
								$wherereject='styleId="'.$result['id'].'" and approvedStatus=4 and materialFinalStatus=1';
								$rsreject=GetPageRecord($selectreject,'materialCostChatMaster',$wherereject);
								$reject = mysqli_num_rows($rsreject);


								$pending = $completed+$furtherassign+$waiting+$reject;
								?>

									<tr>
										  <td align="left">

										    <div align="left"><a href="showpage.crm?module=style&view=yes&id=<?php echo encode($result['id']); ?>">
											<?php echo '#'.$result['styleRefId']; ?></a> </div></td>
										 <td align="left"></td>
											<td align="left" id="progressbarhover">
											<div class="progress">
	<div class="progress-bar bg-primary" style="width: <?php echo $persent; ?>%">
		<span style="padding: 10px; font-weight: 800;"><?php echo round($persent); ?>%</span>
	</div>
</div>
<?php if($result['analyzeMaterialListSave']==1){ ?>
<div class="card card-body text-center tblcontent" id="statusreport">
  <h6 class="font-weight-semibold mb-0 mt-1" style="width: 100%; text-align: center; font-weight: 600; font-size: 11px; margin-bottom: 10px !important;">Total Task (<?php echo $totalTask; ?>)</h6>

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
  width: 420px; position: absolute; right: 37px; padding-bottom: 25px; border-radius: 0px; background: #fff; display: none; z-index: 9;
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
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>

	 <?php if($rsCount=='0'){?>
<div style="padding: 10px;color: gray;">No record found.</div>
<?php } ?>

</div>


<div style="position: absolute; bottom: 1pc; background: #1cad56; color: #fff; width: 390px; font-size: 12px; display: flex; text-align: center;">
<div style="width: 35%; float: left; display: block;     padding: 5px 8px; text-align: left; border: 1px solid #ccc;">Total Assigned Style:</div>
<div style="width: 35%; float: left; display: block;     padding: 5px 8px; text-align: center; border: 1px solid #ccc;" ><?php echo $rsCount; ?></div>
<div style="width: 30%; float: left; display: block;    padding: 5px 8px; text-align: center; border: 1px solid #ccc;"><?php if($_REQUEST['userid']!=''){ ?><a href="showpage.crm?module=style&assignTo=<?php echo encode($sessionuserId); ?>&a=1" target="BLANK"><?php }else{ ?> <a href="showpage.crm?module=style" target="BLANK"> <?php } ?>
<span class="badge" style="background-color: #fff; color: #000; padding: 4px 10px;">View Style</span>
</a>
</div>
</div>