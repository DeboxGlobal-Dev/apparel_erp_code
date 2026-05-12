<?php
ob_start();
include "inc.php";
$assignto='download';
$select='*';

if($_GET['styleid']!=''){
$select='*';
$where='id="'.decode($_GET['styleid']).'"';
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


header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>



                 <table class="table erptab table-hover" style="width:100%">
                     <tr style="background-color: #0288d1">
<td>S.No</td>
<td>PO Number</td>
<td>Received Date</td>
<td>PO Quantity</td>
<td>Ex-factory Start</td>
<td>Ex-factory End</td>
<td>Ship Mode</td>
<td>Delivery Term</td>
<td>Cutoff Date</td>



</tr>
		<?php
		$count=1;
		$rrrr=GetPageRecord('*','poManageMaster','1  and styleId="'.decode($_GET['styleid']).'"');
		while($operationData=mysqli_fetch_array($rrrr)){
		?>
		    <tbody>
			<tr style="margin-left:20px;">
             <td><?php echo $count; ?></td>


              <td><div id="togglepo<?php echo $count; ?>" style="color:#0000FF; cursor:pointer;"><strong><?php echo $operationData['poNumber']; ?></strong></div></td>
              <td><?php echo date('d-M-Y',strtotime($operationData['requiredDate'])); ?></td>
              <td><?php echo $operationData['poQty']; ?></td>
             <td> <?php if($operationData['factStart']!="") { echo date('d-m-Y',strtotime($operationData['factStart'])); } else{ echo "-"; } ?> </td>
              <td> <?php if($operationData['factEnd']!="") { echo date('d-m-Y',strtotime($operationData['factEnd'])); } else{ echo "-"; } ?> </td>
			  <td><?php echo $operationData['shipMode']; ?></td>
			 <td><?php echo $operationData['deliveryTerm']; ?></td>
			  <td> <?php if($operationData['cutoffDate'] !="") { echo date('d-m-Y',strtotime($operationData['cutoffDate'])); } else{ echo "-"; } ?> </td>

			</tr>



		             </tbody>
		             <tbody id="thisbodyShow<?php echo $count; ?>" style="display:none;text-align: center;">
					 <tr style="background-color:#a2a2a2; color:#FFFFFF;">
						<td>Sno.</td>
						<td colspan="2">Destination</td>
						<td colspan="2">Color</td>
						<td colspan="2">Packing Type</td>

						<td colspan="2">Size</td>
						<td colspan="2">Quantity</td>
						<td></td>
					</tr>
					<?php
					$total=1;
					$newData='';
					$newData=GetPageRecord('*','poSizeBreakupMaster','1 and parentId="'.$operationData['id'].'" and styleId="'.decode($_GET['styleid']).'"');
					while($rrData=mysqli_fetch_array($newData)){
					?>
					<tr style="background-color: #fdffe0;">
						<td><?php echo $total; ?></td>
						<td colspan="2"><?php echo $rrData['destination']; ?></td>
						<td colspan="2"><?php echo $rrData['color']; ?></td>
						<td colspan="2">

						<?php if($rrData['ptype']=="1"){ ?> Pre-Pack <?php }else if ($rrData['ptype']=="2") { ?> Bulk <?php }  else {}?>
						</td>

						<td colspan="2"><?php echo $rrData['size']; ?></td>
						<td><?php echo $rrData['quantity']; ?></td>

					</tr>
					<?php $total++; }
					if($total==1){
					?>
					<tr style="background-color: #fdffe0;">
						<td colspan="11"><div align="center">No Record Found</div></td>
					</tr>
					<?php } ?>
				</tbody>
<script>
$("#togglepo<?php echo $count; ?>").click(function(){
    $("#thisbodyShow<?php echo $count; ?>").toggle();
});
</script>
<?php $count++; } ?>
               </table>