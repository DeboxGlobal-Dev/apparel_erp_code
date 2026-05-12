<table width="100%" border="1" cellspacing="2" cellpadding="2" style="border: 1px solid #ccc;">
    <tr style="font-size: 15px; background-color: #fff7b3; font-weight: 700;">
        <td colspan="11">Order Quantity Details:</td>
    </tr>
    <tr>
        <th>Destination</th>
        <th>Color</th>
		<?php
		$sizeranze = getSizeRange($editresultstyle['sizerange']);
		$ArrSizeRange = explode(':',$sizeranze);
		foreach($ArrSizeRange as $sizesName){
		?>
		<th><?php echo $sizesName; ?></th>
		<?php } ?>
		<th>Total</th>
    </tr>
	<?php
	$fianlTotal=0;
	$wherecolor='1 and sectionType=0 and styleId="'.$result['styleId'].'"';
	$rscolor=GetPageRecord('*','purchaseOrderStyleMaster',$wherecolor);
	while($resultcolor=mysqli_fetch_array($rscolor)){
	$total=0;
	$wheredest='parentId="'.$resultcolor['id'].'" group by color';
	$rsdest=GetPageRecord('*','purchaseOrderStyleMaster',$wheredest);
	while($resultdest=mysqli_fetch_array($rsdest)){
	$total=0;
	?>
	<tr>
        <td><?php echo $resultdest['finish']; ?></td>
        <td><?php echo getColorName($resultdest['color']); ?></td>
		<?php
		$sr=1;
		$total=0;
		foreach($ArrSizeRange as $sizesName){
		?>
		<td>
		<?php
		$rsssqty='';
		$rsssqtylist='';
		$rsssqty=GetPageRecord('gdQty','purchaseOrderStyleMaster','parentId="'.$resultcolor['id'].'" and color="'.$resultdest['color'].'" and size="'.trim($sizesName).'"');
		$rsssqtylist=mysqli_fetch_array($rsssqty);
		echo $rsssqtylist['gdQty']; $total = $total+$rsssqtylist['gdQty'];
		?>
		</td>
		<?php $sr++; } ?>
		<td><?php echo $total; $fianlTotal = $fianlTotal+$total; ?></td>
    </tr>

<?php } } ?>
<tr style="font-size: 15px; background-color: #f7f7f7; font-weight: 700;">

		<td colspan="<?php echo $sr; ?>">&nbsp;</td>
		<td>Total</td>
		<td><?php echo $fianlTotal; ?></td>
	</tr>
</table>
<br />

<!---------------For excess color qty----------------->
<table width="100%" border="1" cellspacing="2" cellpadding="2" style="border: 1px solid #ccc;">
    <tr style="font-size: 15px; background-color: #fff7b3; font-weight: 700;">
        <td colspan="11">Excess Quantity Details</td>
    </tr>
    <tr>
		<th>Destination</th>
        <th>Color</th>
		<?php
		foreach($ArrSizeRange as $sizesName){
		?>
		<th><?php echo $sizesName; ?></th>
		<?php } ?>
		<th>Total</th>
    </tr>
	<?php
	$wherecolor='';
	$rscolor='';
	$totalallowance=0;
	$fianlTotal=0;
	$wherecolor='1 and sectionType=0 and styleId="'.$result['styleId'].'" and provision=0';
	$rscolor=GetPageRecord('*','purchaseOrderStyleMaster',$wherecolor);
	while($resultcolor=mysqli_fetch_array($rscolor)){

	$totalallowance=0;
	$embroidery = 0;
	$garmentDyeing = 0;
	$printing =0;
	$rfd = 0;
	$solid =0;
	$total=0;
	$fca=0;
	$wheredest='';
	$rsdest='';
	$wheredest='parentId="'.$resultcolor['id'].'" and provision=0 group by color';
	$rsdest=GetPageRecord('*','purchaseOrderStyleMaster',$wheredest);
	while($resultdest=mysqli_fetch_array($rsdest)){
	$total=0;

	$rsColorDetail22=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$editresultstyle['id'].'" and colorId="'.$resultdest['color'].'"');
	$rsColorDetailList22=mysqli_fetch_array($rsColorDetail22);
	$valEditiArr22 = explode(',',$rsColorDetailList22['valueEdition']);


	////for total the qty color wise
	$rsssqtyzx=GetPageRecord('SUM(gdQty) as trsum','purchaseOrderStyleMaster','1 and parentId="'.$resultcolor['id'].'" and color="'.$resultdest['color'].'"');
	$rsssqtylistzx=mysqli_fetch_array($rsssqtyzx);
	?>

	<tr>
        <td><?php echo $resultdest['finish']; ?></td>
        <td><?php echo getColorName($resultdest['color']); ?></td>
		<?php
		$sizeqty=0;
		$sr=1;
		$total=0;
		foreach($ArrSizeRange as $sizesName){
		?>
		<td>
		<?php
		$rsssqty='';
		$rsssqtylist='';
		$rsssqty=GetPageRecord('*','purchaseOrderStyleMaster','1 and parentId="'.$resultcolor['id'].'" and color="'.$resultdest['color'].'"  and size="'.trim($sizesName).'"');
		$rsssqtylist=mysqli_fetch_array($rsssqty);
			$pper=$pper+$rsssqtylist['gdQty'];
			if($rsssqtylist['gdQty'] > 0){
				$totalallowance=0;
				$totalallow = 0;
				$rspro=GetPageRecord('*','rejectioninproductionmaster','1 and qty>'.$rsssqtylistzx['trsum'].'');
				$resultpro=mysqli_fetch_array($rspro);
				if (in_array(10, $valEditiArr22))
				{
					$embroidery = $resultpro['extraforemb'];
				}
				if (in_array(11, $valEditiArr22))
				{
					$garmentDyeing = $resultpro['extraforgarment'];
				}
				if (in_array(12, $valEditiArr22))
				{
					$printing = $resultpro['extraforprinting'];
				}
				if (in_array(26, $valEditiArr22))
				{
					$rfd = $resultpro['extraforRfd'];
				}
				if (in_array(27, $valEditiArr22))
				{
					$solid = $resultpro['extraforsolid'];
				}

				$totalallowance = $resultpro['allowedper']+$embroidery+$garmentDyeing+$printing+$rfd+$solid;

			}

			$calc4=$rsssqtylist['gdQty'] * $totalallowance;
			$fcalc4=$calc4/100;

			echo $fca=ceil($sizeqty = $rsssqtylist['gdQty'] + $fcalc4);
			//echo $sizeqty = $rsssqtylist['gdQty'];
			$total = $total+$fca;
		?>
		</td>
		<?php $sr++; } ?>
		<td><?php echo $total; $fianlTotal = $fianlTotal+$total; ?></td>
    </tr>
	<? } } ?>
    <tr style="font-size: 15px; background-color: #f7f7f7; font-weight: 700;">
        <td colspan="<?php echo $sr; ?>">&nbsp;</td>
        <td>Total</td>
        <td><?php echo $fianlTotal; ?></td>
    </tr>
</table>