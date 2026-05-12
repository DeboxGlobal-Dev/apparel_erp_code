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
$patternAttachment = $editresultstyle['patternAttachment'];
$attachmentFile = $editresultstyle['attachmentFile'];
$techpackdescription = $editresultstyle['techpackdescription'];

$lastId=$editresultstyle['id'];

}

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>



           <table class="table erptab table-hover" style="width:100%">
           <tr style="background-color: #0288d1">
<td><div style="text-transform:capitalize;color: white"><b>S.No</b></div></td>

<td><div style="text-transform:capitalize;color: white"><b>PO Number</b></div></td>
<td><div style="text-transform:capitalize;color: white"><b>DCPO Number</b></div></td>
<td><div style="text-transform:capitalize;color: white"><b>Received Date</b></div></td>
<td><div style="text-transform:capitalize;color: white"><b>DCPO Quantity</b></div></td>
<td><div style="text-transform:capitalize;color: white"><b>Ex-factory Start</b></div></td>
<td><div style="text-transform:capitalize;color: white"><b>Ex-factory End</b></div></td>

</tr>
		<?php
		$count=1;
		$rrrr=GetPageRecord('*','dcpoManageMaster','1 and poNumber="'.decode($_GET['poId']).'"');
		while($operationData=mysqli_fetch_array($rrrr)){

		$poDataq=GetPageRecord('*','poManageMaster','1 and id="'.$operationData['poNumber'].'"');
	      $poData=mysqli_fetch_array($poDataq);
		?>
		<tbody>
			<tr style="margin-left:20px;">
             <td><?php echo $count; ?></td>


              <td><div id="togglepo<?php echo $count; ?>" style="color:#0000FF; cursor:pointer;"><strong><?php echo $poData['poNumber']; ?></strong></div></td>
              <td><?php echo $operationData['dcpoNumber']; ?></td>
              <td><?php echo date('d-M-Y',strtotime($operationData['requiredDate'])); ?></td>
              <td><?php echo $operationData['dcpoQty']; ?></td>
              <td> <?php if($operationData['factStart']!="") { echo date('d-m-Y',strtotime($operationData['factStart'])); } else{ echo "-"; } ?> </td>
              <td> <?php if($operationData['factEnd']!="") { echo date('d-m-Y',strtotime($operationData['factEnd'])); } else{ echo "-"; } ?> </td>

			</tr>
		</tbody>
		<tbody id="thisbodyShow<?php echo $count; ?>" style="display:none;text-align: center;">
					<tr style="background-color:#a2a2a2; color:#FFFFFF;">
						<td>Sno.</td>
						<td>Destination</td>
						<td>Color</td>
						<td>Packing Type</td>

						<td>Size</td>
						<td>Quantity</td>
						<td></td>
					</tr>
					<?php
					$total=1;
					$newData='';
					$newData=GetPageRecord('*','dcpoSizeBreakupMaster','1 and parentId="'.$operationData['id'].'" and styleId="'.decode($_GET['styleid']).'"');
					while($rrData=mysqli_fetch_array($newData)){
					?>
					<tr style="background-color: #fdffe0;">
						<td style="margin-left:20px;"><?php echo $total; ?></td>
						<td><?php echo $rrData['destination']; ?></td>
						<td><?php echo $rrData['color']; ?></td>
						<td>

						<?php if($rrData['ptype']=="1"){ ?> Pre-Pack <?php }else if ($rrData['ptype']=="2") { ?> Bulk <?php }  else {}?>
						</td>

						<td><?php echo $rrData['size']; ?></td>
						<td style="margin-left:20px;"><?php echo $rrData['quantity']; ?></td>
						<td><i class="fa fa-edit" onclick="opmodalpop('DCPO Breakup','modalpop.php?action=addDcpoBreakup&id=<?php echo $rrData['parentId']; ?>&styleId=<?php echo $rrData['styleId']; ?>&editId=<?php echo $rrData['id']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" style="font-size: 16px; color: #FF0000; cursor:pointer;"></i></td>
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