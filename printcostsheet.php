<?php
include "inc.php";
$a=GetPageRecord('subject,buyerId,seasonId,projecQty,styleRefId,costingQty,smv','queryMaster','id="'.decode($_REQUEST['id']).'"');
$styleData=mysqli_fetch_array($a);

$versionDataq=GetPageRecord('effectivesellingprice,totalcostfob,profit,profitlosspercent','costsheetVersionMaster','styleId="'.decode($_REQUEST['id']).'"');
$versionData=mysqli_fetch_array($versionDataq);

?>


<table width="100%" cellpadding="10" cellspacing="0" border="1" style="font-size:12px;font-family: Arial, Helvetica, sans-serif; border-collapse:collapse;">
<tr>
   <td height="60">
     <div style=" font-size:16px; text-align:center; "><strong>Cost Sheet</strong></div>
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

<table width="100%" cellpadding="10" cellspacing="0" border="0" style="font-size:11px;font-family: Arial, Helvetica, sans-serif; border-collapse:collapse; margin-top:5px;">

   <?php
   $materialtypeDataq=GetPageRecord('id,name','materialTypeMaster','1 order by id');
   while($materialtypeData=mysqli_fetch_array($materialtypeDataq)){
   $totalmaterialcost=0;
   ?>
   <tr>
  <td colspan="10" bgcolor="#cccccc"><?php echo $materialtypeData['name']; ?></td>
  </tr>
  <tr>
  <td width="16%"><div align="left"><strong>Material</strong></div></td>
  <td width="8%"><div align="center"><strong>Avg/Qty</strong></div></td>
  <td width="6%"><div align="center"><strong>UOM</strong></div></td>
   <td width="10%"><div align="center"><strong>Wastage%</strong></div></td>
    <td width="12%"><div align="center"><strong>Avg&nbsp;Inc.&nbsp;Wstg.</strong></div></td>
   <td width="7%"><div align="center"><strong>Price</strong></div></td>
   <td width="9%"><div align="center"><strong>Currency</strong></div></td>
   <td width="10%"><div align="center"><strong>Lndg&nbsp;Cost(%)</strong></div></td>
   <td width="12%"><div align="center"><strong>Landed&nbsp;Cost</strong></div></td>
   <td width="10%"><div align="center"><strong>Material&nbsp;Cost</strong></div></td>
  </tr>
<?php

$stylesubcaDataq=GetPageRecord('id,name','styleSubCategoryMaster','1 and materialType="'.$materialtypeData['id'].'" and styleId="'.decode($_REQUEST['id']).'" and costsheetVersionId="1" and parentId=0 order by id asc');

while($stylesubcaData=mysqli_fetch_array($stylesubcaDataq)){
$techPackDataq=GetPageRecord('*','techPackDetailMaster','stylesubtabid="'.$stylesubcaData['id'].'" and sectionType="bom" and costsheetVersionId="1" and styleId="'.decode($_REQUEST['id']).'" order by id asc');
$techPackData=mysqli_fetch_array($techPackDataq);

$currencyDataq=GetPageRecord('name','currencyMaster','1 and id="'.$techPackData['matCurrency'].'"');
$currencyData=mysqli_fetch_array($currencyDataq);


  ?>

   <tr>
  <td><div align="left"><?php echo $stylesubcaData['name']; ?></div></td>
  <td><div align="center"><?php echo $techPackData['bomAvg']; ?></div></td>
  <td><div align="center"><?php echo $techPackData['bomUnit']; ?></div></td>
   <td><div align="center"><?php echo $techPackData['wastagePersent']; ?></div></td>
   <td><div align="center"><?php echo $techPackData['avgIncWastage']; ?></div></td>
   <td><div align="center"><?php echo $techPackData['matPrice']; ?></div></td>
   <td><div align="center"><?php echo $currencyData['name']; ?></div></td>
   <td><div align="center"><?php echo $techPackData['landingcostper']; ?></div></td>
   <td><div align="center"><?php echo $techPackData['bomRate']; ?></div></td>
   <td><div align="center"><?php echo $techPackData['bomvalueonepc'];$totalmaterialcost=$totalmaterialcost+$techPackData['bomvalueonepc']; ?></div></td>
  </tr>
  <?php } ?>
  <tr>
  <td colspan="10" style="border:1px solid #000;" align="right"><div style="font-size:14px;">Total Cost : <strong><?php echo $totalmaterialcost; ?></strong></div></td>
  </tr>
  <tr>
  <td colspan="10"><br /></td>
  </tr>
  <?php  } ?>
</table>

<table width="100%" cellpadding="10" cellspacing="0" border="0" style="font-size:11px;font-family: Arial, Helvetica, sans-serif; border-collapse:collapse; margin-top:5px;">

   <?php
	$sNo1a = 0;
	$rownoa=0;
   $chargestypeDataq=GetPageRecord('id,name','chargesTypeMaster','1 order by id');
   while($chargestypeData=mysqli_fetch_array($chargestypeDataq)){
   $totalmaterialcostExtra=0;
   ?>
   <tr>
  <td colspan="5" bgcolor="#cccccc"><?php echo $chargestypeData['name']; ?></td>
  </tr>
  <tr>
  <td><div align="left"><strong>Name</strong></div></td>
  <?php if($chargestypeData['id']==2){ ?><td><div align="center"><strong>Overhead %</strong></div></td><?php } ?>
  <td><div align="center"><strong>Price</strong></div></td>
   <td><div align="center"><strong>Currency	</strong></div></td>
    <td><div align="center"><strong>Remarks</strong></div></td>
  </tr>
<?php
$chargedDataq=GetPageRecord('id,name','chargesMaster','1 and chargestype="'.$chargestypeData['id'].'" and status=1 order by id asc');
$srtypea = mysqli_num_rows($chargedDataq);

while($chargedData=mysqli_fetch_array($chargedDataq)){
$rownoa++;
$sNo1a=$rownoa;

$extrachargesDetailDataq=GetPageRecord('*','extraChargesDetailMaster','1 and bomSerialNoextra="'.$sNo1a.'" and costsheetVersionId="1" and styleId="'.decode($_REQUEST['id']).'" order by id desc');
$extrachargesDetailData=mysqli_fetch_array($extrachargesDetailDataq);

$currencyDataqExtra=GetPageRecord('name','currencyMaster','1 and id="'.$extrachargesDetailData['matCurrencyextra'].'"');
$currencyDataExtra=mysqli_fetch_array($currencyDataqExtra);

  ?>

   <tr>
  <td><div align="left"><?php echo $chargedData['name']; ?></div></td>
  <?php if($chargestypeData['id']==2){ ?><td><div align="center"><?php echo $extrachargesDetailData['overheadper']; ?></div></td><?php } ?>
  <td><div align="center"><?php echo $extrachargesDetailData['matPriceextra'];$totalmaterialcostExtra=$totalmaterialcostExtra+$extrachargesDetailData['matPriceextra']; ?></div></td>
   <td><div align="center"><?php echo $currencyDataExtra['name']; ?></div></td>
   <td><div align="center"><?php echo $extrachargesDetailData['bomCommentextra']; ?></div></td>
  </tr>
  <?php } ?>
  <tr>
  <td colspan="5" style="border:1px solid #000;" align="right"><div style="font-size:14px;">Total Cost : <strong><?php echo $totalmaterialcostExtra; ?></strong></div></td>
  </tr>
  <tr>
  <td colspan="11"><br /></td>
  </tr>
  <?php  } ?>
</table>

<table width="100%" cellpadding="10" cellspacing="0" border="1" style="font-size:11px;font-family: Arial, Helvetica, sans-serif; border-collapse:collapse; margin-top:5px;">
   <?php
   $bottomsuDataq=GetPageRecord('*','costsheetVersionMaster','1 and styleId="'.decode($_REQUEST['id']).'" and versionId=1 order by id');
  $bottomsuData=mysqli_fetch_array($bottomsuDataq);
   ?>
   <tr>
			<td width="64%"><div align="left">PRODUCT COST :</div></td>
			<td width="10%"><div align="center"></div></td>
			<td width="11%" align="right"><div align="center"></div></td>
			<td width="15%"><div align="right" style="font-size:14px;"><strong><?php echo $bottomsuData['totalcostfob']; ?></strong></div></td>
  </tr>
  <tr>
			<td width="64%"><div align="left">Markup :</div></td>
			<td width="10%"><div align="center"></div></td>
			<td width="11%" align="right"><div align="center"></div></td>
			<td width="15%"><div align="right" style="font-size:14px;"><strong><?php echo $bottomsuData['customermarkupvalue']; ?></strong></div></td>
  </tr>
  <tr>
			<td width="64%"><div align="left">FOB Price :</div></td>
			<td width="10%"><div align="center"><?php echo $bottomsuData['fobpricenew']; ?></div></td>
			<td width="11%" align="right"><div align="center"></div></td>
			<td width="15%"><div align="right" style="font-size:14px;"><strong><?php echo $bottomsuData['sellingprice']; ?></strong></div></td>
  </tr>
  <tr>
			<td width="64%"><div align="left">Discount on FOB Price :</div></td>
			<td width="10%"><div align="center"><?php echo $bottomsuData['discountsellingprice']; ?></div></td>
			<td width="11%" align="right"><div align="center">%</div></td>
			<td width="15%"><div align="right" style="font-size:14px;"><strong><?php echo $bottomsuData['discountsellingpricevalue']; ?></strong></div></td>
  </tr>
  <tr>
			<td width="64%"><div align="left">Effective FOB Price :</div></td>
			<td width="10%"><div align="center"></div></td>
			<td width="11%" align="right"><div align="center"></div></td>
			<td width="15%"><div align="right" style="font-size:14px;"><strong><?php echo $bottomsuData['effectivesellingprice']; ?></strong></div></td>
  </tr>
  <tr>
			<td width="64%"><div align="left">Profit/Loss :</div></td>
			<td width="10%"><div align="center"></div></td>
			<td width="11%" align="right"><div align="center"></div></td>
			<td width="15%"><div align="right" style="font-size:14px;"><strong><?php echo $bottomsuData['profit']; ?></strong></div></td>
  </tr>
  <tr>
			<td width="64%"><div align="left">Profit/Loss % :</div></td>
			<td width="10%"><div align="center"></div></td>
			<td width="11%" align="right"><div align="center"></div></td>
			<td width="15%" bgcolor="#cccccc"><div align="right" style="font-size:14px;"><strong><?php echo $bottomsuData['profitlosspercent']; ?></strong></div></td>
  </tr>
</table>