<?php
include "inc.php";
$a=GetPageRecord('*','queryMaster','id="'.decode($_REQUEST['id']).'"');
$styleData=mysqli_fetch_array($a);

$versionDataq=GetPageRecord('effectivesellingprice,totalcostfob,profit,profitlosspercent','costsheetVersionMaster','styleId="'.decode($_REQUEST['id']).'"');
$versionData=mysqli_fetch_array($versionDataq);





if($_GET['id']!=''){
$select='*';
$where='id="'.decode($_GET['id']).'"';
$rs=GetPageRecord($select,'queryMaster',$where);
$editresultstyle=mysqli_fetch_array($rs);
$buyerId = $editresultstyle['buyerId'];
$buyerStyleRefNo = $editresultstyle['buyerStyleRefNo'];
$subject = $editresultstyle['subject'];
$displayId = $editresultstyle['displayId'];
$seasonId = $editresultstyle['seasonId'];
$categoryId = $editresultstyle['categoryId'];
$subCategoryId = $editresultstyle['subCategoryId'];
$departmentId = $editresultstyle['departmentId'];
$receivedDate = $editresultstyle['receivedDate'];
$patternDescription = $editresultstyle['patternDescription'];
$patternAttachment = $editresultstyle['patternAttachment'];

$lastId=$editresultstyle['id'];

}
$i=1;
while($i<6){

$select='*';
$id=clean(decode($_GET['id']));
$where='id='.$id.'';
$rs=GetPageRecord($select,_QUERY_MASTER_,$where);
$resultpage=mysqli_fetch_array($rs);


$i++;
}



?>


<table width="100%" cellpadding="10" cellspacing="0" border="1" style="font-size:12px;font-family: Arial, Helvetica, sans-serif; border-collapse:collapse;">
<tr>
   <td height="60">
     <div style=" font-size:16px; text-align:center; "><strong>TNA(Time & Action)</strong></div>
     <div><?php echo date('d-m-Y'); ?> - <?php echo $styleData['subject']; ?></div>
    </td>
  </tr>
</table>





<p style="line-height:2px;">&nbsp;</p>

<table width="100%" cellpadding="10" cellspacing="0" border="1" style="font-size:12px;font-family: Arial, Helvetica, sans-serif; border-collapse:collapse; margin-top:5px;">
  <tbody>
    <tr>
     <td align="left" width="40%">
		<table cellpadding="2" cellspacing="0" style="font-size:11px; width:100%;">
		<tr>
		<td width="29%"><strong>Buyer</strong></td>
		<td width="7%" align="center">:</td>
		<td width="64%"><?php echo getBuyerName($styleData['buyerId']); ?></td>
		</tr>
		<tr>
		<td width="29%"><strong>Season</strong></td>
		<td width="7%" align="center">:</td>
		<td width="64%"><?php echo stripslashes(getSeasonName($styleData['seasonId'])); ?></td>
		</tr>
		<tr>
		<td width="29%"><strong>Style (Buyer Style Ref.)</strong></td>
		<td width="7%" align="center">:</td>
		<td width="64%"><?php echo $styleData['styleRefId']; ?></td>
		</tr>
		<tr>
		<td width="29%"><strong>Style Name </strong></td>
		<td width="7%" align="center">:</td>
		<td width="64%"><?php echo $styleData['subject']; ?></td>
		</tr>
		<tr>
		<td width="29%"><strong>Total Quantity</strong></td>
		<td width="7%" align="center">:</td>
		<td width="64%"><?php echo $styleData['projecQty']; ?> PCS</td>
		</tr>
		<tr>
		<td width="29%"><strong>Costing Quantity</strong></td>
		<td width="7%" align="center">:</td>
		<td width="64%"><?php echo $styleData['costingQty']; ?> PCS </td>
		</tr>
		</table>

      </td>

        <td align="left" width="30%" valign="middle">
		<table cellpadding="2" cellspacing="0" style="font-size:11px; width:100%;">
		<tr>
		<td width="35%"><strong>Currency</strong></td>
		<td width="12%" align="center">:</td>
		<td width="53%">USD</td>
		</tr>
		<tr>
		<td width="35%"><strong>Rate of Exchange</strong></td>
		<td width="12%" align="center">:</td>
		<td width="53%">75.62</td>
		</tr>
		<tr>
		<td width="35%"><strong>As On</strong></td>
		<td width="12%" align="center">:</td>
		<td width="53%"><?php echo date('d F Y'); ?></td>
		</tr>
		<tr>
		<td width="35%"><strong>SAM</strong></td>
		<td width="12%" align="center">:</td>
		<td width="53%"><?php echo $styleData['smv']; ?></td>
		</tr>
		</table>

      </td>
   <td align="left" width="30%" valign="middle">
		<table cellpadding="2" cellspacing="0" style="font-size:11px; width:100%;">
		<tr>
		<td width="43%"><strong>Effective FOB Price</strong></td>
		<td width="8%" align="center">:</td>
		<td width="49%"><?php echo $versionData['effectivesellingprice']; ?></td>
		</tr>
		<tr>
		<td width="43%"><strong>Product Cost</strong></td>
		<td width="8%" align="center">:</td>
		<td width="49%"><?php echo $versionData['totalcostfob']; ?></td>
		</tr>
		<tr>
		<td width="43%"><strong>Profit/Loss</strong></td>
		<td width="8%" align="center">:</td>
		<td width="49%"><?php echo $versionData['profit']; ?> (<?php echo $versionData['profitlosspercent']; ?>%)</td>
		</tr>
		</table>

      </td>
    </tr>
  </tbody>
</table>

<p style="line-height:2px;">&nbsp;</p>


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

<table width="100%" cellpadding="10" cellspacing="0" border="1" style="font-size:12px;font-family: Arial, Helvetica, sans-serif; border-collapse:collapse;">
<tr>
   <td height="60">
     <div style=" font-size:16px; text-align:center; "><strong>LEAD TIME SYNOPSIS</strong></div>
    </td>
  </tr>
</table>


<table width="100%" cellpadding="10" cellspacing="0" border="1" style="font-size:12px;font-family: Arial, Helvetica, sans-serif; border-collapse:collapse; margin-top:5px;">
  <tbody>
    <tr>
     <td align="left" width="25%">
		<table cellpadding="2" cellspacing="0" style="font-size:11px; width:100%;">
		<tr>
		<td width="59%"><strong>TTL&nbsp;ORDER&nbsp;LEAD&nbsp;TIME</strong></td>
		<td width="7%" align="center">:</td>
		<td width="44%"><?php echo str_replace('-','',$ttlorderleadtime->format("%R%a Days")); ?></td>
		</tr>

		</table>

      </td>

        <td align="left" width="25%" valign="middle">
		<table cellpadding="2" cellspacing="0" style="font-size:11px; width:100%;">
		<tr>
		<td width="59%"><strong>TTL FABRIC LEAD TIME</strong></td>
		<td width="7%" align="center">:</td>
		<td width="44%"><?php echo str_replace('-','',$ttfabricleadtime->format("%R%a Days")); ?></td>
		</tr>

		</table>

      </td>
   <td align="left" width="25%" valign="middle">
		<table cellpadding="2" cellspacing="0" style="font-size:11px; width:100%;">
		<tr>
		<td width="75%"><strong>MERCHANDISING LEAD TIME </strong></td>
		<td width="7%" align="center">:</td>
		<td width="28%"><?php echo str_replace('-','',$merhcleadtime->format("%R%a Days")); ?></td>
		</tr>

		</table>

      </td>

      <td align="left" width="25%" valign="middle">
		<table cellpadding="2" cellspacing="0" style="font-size:11px; width:100%;">
		<tr>
		<td width="78%"><strong>PRODUCTION LEAD TIME (INC. R&D) </strong></td>
		<td width="5%" align="center">:</td>
		<td width="28%"><?php echo str_replace('-','',$prodleadtime->format("%R%a Days")); ?></td>
		</tr>

		</table>

      </td>
    </tr>
  </tbody>
</table>

<p style="line-height:2px;">&nbsp;</p>



<table width="100%" cellpadding="10" cellspacing="0" border="1" style="font-size:11px;font-family: Arial, Helvetica, sans-serif; border-collapse:collapse; margin-top:5px;">
    <tr>
    <td width="5%"><div align="left"><strong>SR</strong></div></td>
        <td width="20%"><div align="left"><strong>Key Processes	</strong></div></td>
    <td width="10%"><div align="left"><strong>Planned	</strong></div></td>

    <td width="20%"><div align="left"><strong>Critical Path	</strong></div></td>

    <td width="10%"><div align="left"><strong>Actual</strong></div></td>

    <td width="10%"><div align="left"><strong>No of Days</strong></div></td>

    <td width="10%"><div align="left"><strong>Responsibility</strong></div></td>

    <td width="15%"><div align="left"><strong>Remark</strong></div></td>
</tr>

									<?php
								$snoo=0;
								//$rs=GetPageRecord('*','taskListMaster','deletestatus=0 and status=1 and tnatemplate="'.$editresultstyle['tnaTemplateId'].'" and tna=1 order by id asc');

								$rs=GetPageRecord('*','taskListMaster','1 and tnatemplate="'.$editresultstyle['tnaTemplateId'].'" order by sr asc');
								while($reslisttask=mysqli_fetch_array($rs)){

								$where1='taskListId="'.$reslisttask['id'].'" and styleId="'.$resultpage['id'].'" and status=1';
								$rs1=GetPageRecord('*','timeActionReport',$where1);
								$data=mysqli_fetch_array($rs1);


								?>
   <tr>
			<td width="5%"><div align="left"><?php echo ++$snoo; ?></div></td>
											<?php
$activityquery=GetPageRecord('name','tnaActivityMaster','1 and id="'.$reslisttask['name'].'"');
$activityData=mysqli_fetch_array($activityquery);

?>
			<td width="20%"><div align="center">
			    <?php echo $activityData['name'];	?>

			</div></td>
			<td width="10%" align="right"><div align="center"><?php if($data['complitionDate']!='' && $data['complitionDate']!='1970-01-01' && $data['complitionDate']!='0000-00-00'){ echo date('d-m-Y', strtotime($data['complitionDate'])); } ?></div></td>
			<td width="20%"><div align="right" style="font-size:14px;">
			    	<?php
								$rs22=GetPageRecord('name','tnaActivityMaster','1 and id="'.$reslisttask['criticalPath'].'"');
								$userss2=mysqli_fetch_array($rs22);
								echo $userss2['name'];
								?>

			</div></td>
			<td width="10%"><div align="left"><?php if($data['actualDate']!='' && $data['actualDate']!='1970-01-01' && $data['actualDate']!='0000-00-00'){ echo date('d-m-Y', strtotime($data['actualDate'])); } ?></div></td>
			<td width="10%"><div align="center"><?php echo $data['totaldays']; ?></div></td>
			<td width="10%" align="right"><div align="center"><?php echo getEmployeeName($data['responsiblity']); ?></div></td>
			<td width="15%"><div align="right" style="font-size:14px;"><?php echo $data['remark']; ?></div></td>
  </tr>
 <?php } ?>
</table>