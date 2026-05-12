<?php
ob_start();
include "inc.php";
$assignto='download';
$select='*';

$where='id="'.decode($_REQUEST['styleId']).'"';
$rs=GetPageRecord($select,'queryMaster',$where);
$editresultstyle=mysqli_fetch_array($rs);

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");
?>

	<table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body" style="text-align: center; background-color: #e1f1ff;">
                                <td width="100%" style="text-align:center;"><strong style="font-size: 16px; font-weight: 500;">LEAD TIME SYNOPSIS</strong></td>

                            </tr>
                          </tbody>
                        </table>






					    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-responsive forbom summaryfinal" style="display: block; overflow: hidden; margin-bottom: 15px;">
                          <tbody style="width: 100%;display: inline-table;">


							<tr class="card-body" style="background-color: #f9f9f9;">
							  <td width="17%" align="left"><div align="center"><strong>TTL ORDER LEAD TIME </strong></div></td>
							<td width="15%" align="left"><div align="center"><strong>TTL FABRIC LEAD TIME </strong></div></td>
							<td width="17%" align="left"><div align="center"><strong>MERCHANDISING LEAD TIME </strong></div></td>
							<td width="29%" align="left"><div align="center"><strong>PRODUCTION LEAD TIME (INC. R&amp;D)</strong></div></td>
							</tr>
							<?php

///////////////////////////////////////////////////////////
$exfastaDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=47)');
$exfastaData=mysqli_fetch_array($exfastaDataq);
//////////////////////////////////////////////////////////
$ocdq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=3)');
$ocdData=mysqli_fetch_array($ocdq);
///////////////////////////////////////////////////////////
$fabricinhousstDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=22)');
$fabricinhousstData=mysqli_fetch_array($fabricinhousstDataq);
///////////////////////////////////////////////////////////
$filehanderDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=38)');
$filehanderData=mysqli_fetch_array($filehanderDataq);
///////////////////////////////////////////////////////////
$exfacendDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=49)');
$exfacendData=mysqli_fetch_array($exfacendDataq);
///////////////////////////////////////////////////////////
$cuttingstatrDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=42)');
$cuttingstatrData=mysqli_fetch_array($cuttingstatrDataq);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$ttlorderleadtime=date_diff(date_create($exfastaData['complitionDate']),date_create($ocdData['complitionDate']));
$ttfabricleadtime=date_diff(date_create($fabricinhousstData['complitionDate']),date_create($ocdData['complitionDate']));
$merhcleadtime=date_diff(date_create($filehanderData['complitionDate']),date_create($ocdData['complitionDate']));
$prodleadtime=date_diff(date_create($exfacendData['complitionDate']),date_create($cuttingstatrData['complitionDate']));

							  ?>
							<tr class="card-body" style="background-color: #f9f9f9;">
							  <td width="17%" align="left"><div align="center"><?php echo str_replace('-','',$ttlorderleadtime->format("%R%a Days")); ?></div></td>
							<td width="15%" align="center"><div align="center"><?php echo str_replace('-','',$ttfabricleadtime->format("%R%a Days")); ?></div></td>
							<td width="17%" align="center"><div align="center"><?php echo str_replace('-','',$merhcleadtime->format("%R%a Days")); ?></div></td>
							<td width="29%" align="center"><div align="center"><?php echo str_replace('-','',$prodleadtime->format("%R%a Days")); ?></div></td>
							</tr>
                          </tbody>
                        </table>





<table class="table table-bordered" style="font-size: 12px;" width="100%">
							<thead>
								<tr class="border-top-info" style="background-color: #fff7b3;text-align: left;">
								  <th width="7%" align="center"><div align="center"><strong>SR</strong></div></th>
									<th width="19%"><strong>Key&nbsp;Processes </strong></th>
									<th width="10%">Planned</th>
									<th width="20%">Critical&nbsp;Path </th>
									<th width="9%">Actual</th>
									<th width="8%"><div align="center">No of Days </div></th>
									<th width="11%">Responsibility</th>
									<th width="16%">Remark</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$snoo=0;
								//$rs=GetPageRecord('*','taskListMaster','deletestatus=0 and status=1 and tnatemplate="'.$editresultstyle['tnaTemplateId'].'" and tna=1 order by id asc');

								$rs=GetPageRecord('*','taskListMaster','1 and tnatemplate="'.$editresultstyle['tnaTemplateId'].'" order by sr asc');
								while($reslisttask=mysqli_fetch_array($rs)){

								$where1='taskListId="'.$reslisttask['id'].'" and styleId="'.$editresultstyle['id'].'" and status=1';
								$rs1=GetPageRecord('*','timeActionReport',$where1);
								$data=mysqli_fetch_array($rs1);


								?>
								<tr class="border-top-info">
								  <td align="center"><?php echo ++$snoo; ?></td>
									<td>

									<?php
$activityquery=GetPageRecord('name','tnaActivityMaster','1 and id="'.$reslisttask['name'].'"');
$activityData=mysqli_fetch_array($activityquery);
echo $activityData['name'];
?>

									 </td>
									<td style="background-color: #f9f9f9;"><?php if($data['complitionDate']!='' && $data['complitionDate']!='1970-01-01' && $data['complitionDate']!='0000-00-00'){ echo date('d-m-Y', strtotime($data['complitionDate'])); } ?></td>
									<td>

									<?php
								$rs22=GetPageRecord('name','tnaActivityMaster','1 and id="'.$reslisttask['criticalPath'].'"');
								$userss2=mysqli_fetch_array($rs22);
								echo $userss2['name'];
								?>

									</td>
									<td style="background-color: #ffecfd;"><?php if($data['actualDate']!='' && $data['actualDate']!='1970-01-01' && $data['actualDate']!='0000-00-00'){ echo date('d-m-Y', strtotime($data['actualDate'])); } ?></td>

									<td><div align="center"><?php echo $data['totaldays']; ?></div></td>

									<td><?php echo getEmployeeName($data['responsiblity']); ?></td>
									<td><input type="text" name="remark" id="remark<?php echo $data['id'];?>" value="<?php echo $data['remark']; ?>" style="width:100%;" onkeyup="addremarks<?php echo $data['id']; ?>();" /></td>
								</tr>



<script>
function addremarks<?php echo $data['id']; ?>(){
	var taskListId = '<?php echo $data['id']; ?>';
	var remark = encodeURI($('#remark<?php echo $data['id'];?>').val());
$('#hiddentasklistremarkrkr').load('loadtimeaction.php?action=timeactionremarks&styleid=<?php echo $editresultstyle['id'];?>&taskid='+taskListId+'&remark='+remark);
}
</script>
<div id="hiddentasklistremarkrkr" style=" display:none;"></div>

<?php  }  ?>
								</tbody>
						</table>




















