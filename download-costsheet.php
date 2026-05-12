<?php
include "inc.php";
$styleId=decode($_REQUEST['styleId']);
$finalversion=decode($_REQUEST['finalversion']);

$selectq='*';
$whereq='id="'.$styleId.'"';
$rsstatus1=GetPageRecord($selectq,'queryMaster',$whereq);
$result=mysqli_fetch_array($rsstatus1);

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$result['styleRefId']."_costsheet_Version-".$finalversion."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>



<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">

  <tr height="31">
    <td colspan="9" height="31" align="center"><strong>COST ESTIMATION SHEET </strong></td>
  </tr>
  <tr height="22">
    <td height="22" colspan="2"><strong>STYLE NO : <?php echo makeQueryId($result['styleRefId']); ?></strong></td>
    <td colspan="6">&nbsp;</td>
    <td rowspan="2" valign="middle"><strong>DATE- <?php echo date('d-m-Y') ?></strong></td>
  </tr>
  <tr height="22">
    <td colspan="8" height="23"><strong>ORDER QTY.-</strong></td>
  </tr>
<?php
$selectimg='*';
$whereimg='parentId="'.$result['id'].'" and galleryType="image_gallery" order by id asc limit 1';
$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
$imgresult=mysqli_fetch_array($rsimg);
?>

  <tr>
    <td colspan="8" align="center" valign="top"><strong style="text-transform:uppercase;"><?php echo $result['subject']; ?></strong></td>

    <td valign="top" height="100" align="center"><img src="<?php echo $fullurl; ?>images/<?php echo $imgresult['attachmentImage']; ?>" width="100"/></td>
  </tr>

  <tr height="48">
    <td height="48">&nbsp;</td>
    <td width="351">&nbsp;</td>
    <td width="92">&nbsp;</td>
    <td width="92">&nbsp;</td>
    <td width="86">&nbsp;</td>
    <td width="94">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="39">
    <td height="39">S.NO.</td>
    <td>ITEM</td>
    <td>AVG.</td>
    <td>UNIT</td>
    <td align="left">USD</td>
    <td>INR-71</td>
    <td width="107">RATE</td>
    <td width="173">VALUE OF 1 PC<br>
    WITH DUTY</td>
    <td>REMARKS</td>
  </tr>
  <?php

    $sNodownload = 0;
	$selecta='id,name';
	$wherea='1 order by id asc';
	$rsa=GetPageRecord($selecta,'materialTypeMaster',$wherea);
	while($resListing=mysqli_fetch_array($rsa)){
	?>
   <tr height="21">
    <td colspan="3" height="21"><strong style="text-transform:uppercase;"><?php echo $resListing['name']; ?></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <?php
    $firsrgrandtotoal = 0;
	$selectb='*';
	$whereb='1 and materialType="'.$resListing['id'].'" and styleId="'.$styleId.'" and costsheetVersionId="'.$finalversion.'" order by sr asc';
	$rsb=GetPageRecord($selectb,'styleSubCategoryMaster',$whereb);
	$sNo=1;

	$srtype = mysql_num_rows($rsb);

	while($resListing1=mysqli_fetch_array($rsb)){

	$loopst=$srtype;
	$rowno++;
	$sNodownload=$rowno;

	$rs121=GetPageRecord('*','techPackDetailMaster','sectionType="bom" and bomSerialNo="'.$sNodownload.'" and styleId="'.$styleId.'" and costsheetVersionId="'.$finalversion.'" order by id asc');
	$resListing12=mysqli_fetch_array($rs121);


  ?>
  <tr height="21">
    <td height="21"><?php echo $sNo++; ?></td>
    <td><?php echo $resListing1['name']; ?></td>
    <td><?php echo $resListing12['bomAvg']; ?></td>
    <td style="text-transform:uppercase;"><?php echo $resListing12['bomUnit']; ?></td>
    <td><?php echo $resListing12['bomUSD']; ?></td>
    <td><?php echo $resListing12['bomINR']; ?></td>
    <td><?php echo $resListing12['bomRate']; ?></td>
    <td><?php $firsrgrandtotoal = $firsrgrandtotoal+$resListing12['bomvalueonepc']; echo $resListing12['bomvalueonepc']; ?></td>
    <td width="269">&nbsp;</td>
  </tr>
  <?php } ?>

   <tr height="26">
    <td height="26"><strong>TOTAL</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong><?php echo $firsrgrandtotoal; ?></strong></td>
    <td>&nbsp;</td>
  </tr>

  <tr height="26">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <?php } ?>



  <?php
        $sNo1adownlod=0;
		$select33a='id,name';
		$where33a='1 order by id asc';
		$rs33a=GetPageRecord($select33a,'chargesTypeMaster',$where33a);
		$countfortotalsecond=mysql_num_rows($rs33a);
		while($resListinga=mysqli_fetch_array($rs33a)){
  ?>
  <tr height="21">
    <td height="21" colspan="3"><strong style="text-transform:uppercase;"><?php echo $resListinga['name']; ?></strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <?php
  		$secondgrandtotoal = 0;
		$select22a='*';
		$where22a='chargestype="'.$resListinga['id'].'" order by id asc';
		$rs22a=GetPageRecord($select22a,'chargesMaster',$where22a);
		$srtypea = mysql_num_rows($rs22a);
		$sNoa=1;
		while($resListing1a=mysqli_fetch_array($rs22a)){
		$loopsta=$srtypea;
		$rownoa++;
		$sNo1adownlod=$rownoa;
		$rs121a=GetPageRecord('*','extraChargesDetailMaster',' bomSerialNoextra="'.$sNo1adownlod.'" and styleId="'.$styleId.'" and costsheetVersionId="'.$finalversion.'" order by id desc');
		$resListing12a=mysqli_fetch_array($rs121a);

  ?>

  <tr height="20">
    <td height="20"><?php echo $sNoa;?></td>
    <td><?php echo $resListing1a['name']; ?></td>
    <td><?php echo $resListing12a['bomAvgextra']; ?></td>
    <td style="text-transform:uppercase;"><?php echo $resListing12a['bomUnitextra']; ?></td>
    <td><?php echo $resListing12a['bomAvgextra']; ?></td>
	<td><?php echo $resListing12a['bomAvgextra']; ?></td>
	<td><?php echo $resListing12a['bomRateextra']; ?></td>
    <td><?php $secondgrandtotoal = $secondgrandtotoal+$resListing12a['bomvalueonepcextra']; echo $resListing12a['bomvalueonepcextra']; ?></td>
    <td>&nbsp;</td>
  </tr>

  <?php $sNoa++; }  ?>

  <tr height="26">
    <td height="26"><strong>TOTAL</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong><?php echo $secondgrandtotoal; ?></strong></td>
    <td>&nbsp;</td>
  </tr>

  <tr height="26">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp; </td>
    <td>&nbsp;</td>
  </tr>



  <?php } ?>


<?php
$rs1211=GetPageRecord('*','costsheetVersionMaster','styleId="'.$styleId.'" and versionId="'.$finalversion.'"');
$resListing121=mysqli_fetch_array($rs1211);
$factoryoverheadtext=$resListing121['factoryoverheadtext'];
$factoryoverheadafterper=$resListing121['factoryoverheadafterper'];
$totaljobworkcharges=$resListing121['totaljobworkcharges'];
$totalwithoutc16=$resListing121['totalwithoutc16'];
$c16percent=$resListing121['c16percent'];
$mrptotallast=$resListing121['mrptotallast'];
$totalmrp=$resListing121['totalmrp'];
$finalgrandtotalwithmrp=$resListing121['finalgrandtotalwithmrp'];
?>



  <tr height="21">
    <td height="21" colspan="3"><strong>FACTORY OVERHEAD-<?php echo $factoryoverheadtext; ?>%</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php echo $factoryoverheadafterper; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="21">
    <td height="21">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">TOTAL JOB WORK CHARGES OF FACTORY </td>
    <td><?php echo $totaljobworkcharges; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="21">
    <td height="21" width="55">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">TOTAL</td>
    <td><?php echo $totalwithoutc16; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="21">
    <td height="21">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">C-16 10%</td>
    <td><?php echo $c16percent; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="21">
    <td height="21">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">GRAND TOTAL</td>
    <td><?php echo $mrptotallast; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="21">
    <td height="21">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="22">
    <td height="22">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="21">
    <td height="21"><strong>M.R.P.</strong></td>
    <td>MARGIN&nbsp;</td>
    <td colspan="5"><strong>APPROVED BY PD HEAD</strong></td>
    <td colspan="2"><strong>AUTHORISED SIGNATORY</strong></td>
  </tr>
  <tr height="20">
    <td height="61"><?php echo $totalmrp; ?></td>
    <td><?php echo $finalgrandtotalwithmrp;?></td>
    <td colspan="5">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>

  <tr height="20">
    <td height="20">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="20">
    <td height="20">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
