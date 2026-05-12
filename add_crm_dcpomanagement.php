<?php

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

?>
<style>
    .erptab tr td{
border:1px solid #ccc!important;
padding:0.55rem!important;
}
 .erptab1 tr td{
border:0px solid #ccc!important;
padding:0.55rem!important;
}
 .erptab1{
border:1px solid #ccc!important;
}
.erpint{
    border: 1px solid #b3acac;
    padding: 3px;
}
</style>
	<div class="page-content">
 	<?php include "left.php"; ?>
	 <div class="content-wrapper">

		  <div class="content pt-0" style="margin-top:20px;">
 	<?php include "top-style.php"; ?>
			 	<div class="row">

				<div class="col-md-12">
				<div class="card">
<div style="padding: 25px;">

               <table class="table erptab table-hover" style="width:100%">
                     <tr style="background-color: #0288d1">
<td><div style="text-transform:capitalize;color: white"><b>S.No</b></div></td>
<td><div style="text-transform:capitalize;color: white"><b>Edit</b></div></td>
<td><div style="text-transform:capitalize;color: white"><b>PO Number</b></div></td>
<td><div style="text-transform:capitalize;color: white"><b>DCPO Number</b></div></td>
<td><div style="text-transform:capitalize;color: white"><b>Received Date</b></div></td>
<td><div style="text-transform:capitalize;color: white"><b>DCPO Quantity</b></div></td>
<td><div style="text-transform:capitalize;color: white"><b>Ex-factory Start</b></div></td>
<td><div style="text-transform:capitalize;color: white"><b>Ex-factory End</b></div></td>
<td><div style="text-transform:capitalize;color: white;text-align: center;"><b>View PO</b></div></td>
<td><div style="text-transform:capitalize;color: white;text-align: center;"><b>Action</b></div></td>
</tr>
		<?php
		$count=1;
		$rrrr=GetPageRecord('*','dcpoManageMaster','1 and poNumber="'.decode($_GET['poId']).'"');
		while($operationData=mysqli_fetch_array($rrrr)){

		$poDataq=GetPageRecord('*','poManageMaster','1 and id="'.$operationData['poNumber'].'"');
	      $poData=mysqli_fetch_array($poDataq);
		?>
		<tbody>
			<tr>
             <td><?php echo $count; ?></td>
            <td><i class="fa fa-pencil"  style="cursor:pointer;" onclick="opmodalpop('DCPO Management','modalpop.php?action=dcpoManageedit&styleId=<?php echo encode($operationData['styleId']); ?>&dcpoid=<?php echo encode($operationData['id']); ?>','600px','auto');" data-toggle="modal" data-target="#modalpop"></i></td>

              <td><div id="togglepo<?php echo $count; ?>" style="color:#0000FF; cursor:pointer;"><strong><?php echo $poData['poNumber']; ?></strong></div></td>
              <td><?php echo $operationData['dcpoNumber']; ?></td>
              <td><?php echo date('d-M-Y',strtotime($operationData['requiredDate'])); ?></td>
              <td><?php echo $operationData['dcpoQty']; ?></td>
              <td> <?php if($operationData['factStart']!="") { echo date('d-m-Y',strtotime($operationData['factStart'])); } else{ echo "-"; } ?> </td>
              <td> <?php if($operationData['factEnd']!="") { echo date('d-m-Y',strtotime($operationData['factEnd'])); } else{ echo "-"; } ?> </td>
				<td style="text-align: center;">
				<a href="attachment/<?php echo $operationData['attachFile'] ?>" target="_blank" >
				<span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px;padding: 6px;"><i class="fa fa-search-plus mr-2" aria-hidden="true" style="margin:0px;"></i>View</span>
				</a>
				</td>
				<td><div style="text-align:center;"><a href="#" onclick="opmodalpop('DCPO Breakup','modalpop.php?action=addDcpoBreakup&id=<?php echo $operationData['id']; ?>&styleId=<?php echo $operationData['styleId']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop">+Add Break Up</a></div></td>
			</tr>
		</tbody>
		<tbody id="thisbodyShow<?php echo $count; ?>" style="display:none;text-align: center;">
					<tr style="background-color:#a2a2a2; color:#FFFFFF;">
						<td>Sno.</td>
						<td colspan="2">Destination</td>
						<td colspan="2">Color</td>
						<td>Packing Type</td>

						<td>Size</td>
						<td colspan="2">Quantity</td>
						<td></td>
					</tr>
					<?php
					$total=1;
					$newData='';
					$newData=GetPageRecord('*','dcpoSizeBreakupMaster','1 and parentId="'.$operationData['id'].'" and styleId="'.decode($_GET['styleid']).'"');
					while($rrData=mysqli_fetch_array($newData)){
					?>
					<tr style="background-color: #fdffe0;">
						<td><?php echo $total; ?></td>
						<td colspan="2"><?php echo $rrData['destination']; ?></td>
						<td colspan="2"><?php echo $rrData['color']; ?></td>
						<td>

						<?php if($rrData['ptype']=="1"){ ?> Pre-Pack <?php }else if ($rrData['ptype']=="2") { ?> Bulk <?php }  else {}?>
						</td>

						<td><?php echo $rrData['size']; ?></td>
						<td colspan="2"><?php echo $rrData['quantity']; ?></td>
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

               <br>
           </div>


           <div class="card-header header-elements-inline">
						<h5 class="card-title">Buyer Purchase Order </h5>
						<div class="header-elements">
							<div class="list-icons">

		                	</div>
	                	</div>
					</div>


<div class="buyer-to-po" style="padding:15px 20px;">
					<div class="pdf-checker" style="width:44%; float: left; display: block; height:820px; padding: 0px;">
					<?php if($editresultstyle['poAttachment']!='') { ?>
							<object data="<?php echo $fullurl; ?>attachment/<?php echo $editresultstyle['poAttachment']; ?>" type="application/pdf" style="height: 100%;width: 100%;display: block;">
							</object>
					<?php } else { ?>
					<div>No Purchase order found</div>
					<?php } ?>
					</div>

					<div class="pdf-manual" style="width:55%;float:right; overflow:auto;" id="loadBuyerPo">


					</div>
					<script>
					$('#loadBuyerPo').load('loadBuyerPo.php?styleId=<?php echo decode($_REQUEST['styleid']); ?>');
					</script>

					<div id="poAction" style="display:none;"></div>

					</div>


				</div>
			</div>


					</div>

			</div>
				 </div>
		 </div>
		 </div>


<style>
#marketingteam .owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev, .owl-carousel button.owl-dot {
	position: absolute;
	top: 40% !important;
	right: 19% !important;
	font-size: 40px !important;
	outline: none !important;
	text-decoration: none !important;
}

#marketingteam .owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev, .owl-carousel button.owl-dot {
    position: absolute;
    top: 40%;
    right: 19% !important;
    font-size: 40px !important;
    outline: none !important;
    text-decoration: none !important;
}

</style>

