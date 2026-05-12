<?php

if($_GET['id']!=''){
$select='*';
$where='id="'.decode($_GET['id']).'"';
$rs=GetPageRecord($select,'greigeRequisition',$where);
$editresultstyle=mysqli_fetch_array($rs);
@extract($editresultstyle);
$lastId=$editresultstyle['id'];
$requisitionNo = $requisitionNo;
}

 if($_GET['module']=='grn'){

     $no = 1;
						$wherenew='parentId="'.$lastId.'" order by id asc';
						$rsnew=GetPageRecord('*','greigeRequisition',$wherenew);
						while($rslistnew=mysqli_fetch_array($rsnew)){


						$tillTotalMaterialQty=0;
						$rsindent=GetPageRecord('SUM(orderQty) as tillorderQty','indentCreationMaster','requisitionNo="'.$requisitionNo.'" and materialId="'.$rslistnew['srinkageId'].'" and bomWidth="'.$rslistnew['greWidth'].'"');
						$resListingIndent1=mysqli_fetch_array($rsindent);
						$resListingIndent1['tillorderQty'];
						$tillTotalMaterialQty= $rslistnew['finalQty']-$resListingIndent1['tillorderQty'];
						}

 }
?>

<div class="page-content">
  <!-- Main sidebar -->
  <?php include "left.php"; ?>
  <!-- /main sidebar -->
  <!-- Main content -->
  <div class="content-wrapper">
    <!-- Content area -->
    <div class="content pt-0" style="margin-top:20px;">
      <!-- Dashboard content -->
	  <div class="row">
				<div class="col-xl-12">
			 	<div class="card mb-0 rounded-bottom-0" style="padding:15px;">
				 	<div class="panel panel-flat">
					<div class="table-responsive">
			 			<table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
                              <td width="16%"></td>
							  <td width="64%" style="text-align:center;"><strong style="font-size:23px;">INDENT</strong></td>
							  <td width="16%" style="text-align:right;"><?php //echo date('d-m-Y h:i:s A'); ?></td>
                            </tr>
                          </tbody>
                        </table>
						<table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
                              <td width="25%"> <strong>Indent No: </strong><span class="badge badge-warning" style="font-size: 11px;"><?php echo $indentNumber; ?></span></td>
							  <td width="25%"><strong>Indent Date: </strong> <?php echo date('d-m-Y',strtotime($requisitionDate)); ?></td>
							  <td width="25%"><strong>Requisition No:  </strong><?php echo $requisitionNo; ?></td>
							  <td width="25%"><strong>Greige Style No:  </strong><?php echo $styleNo; ?></td>

							</tr>
                          </tbody>
     					</table>

<div class="btn-group justify-content-center" style="width: fit-content; float: left; padding: 10px 0px; margin: 0px; display: none;" id="deactivatebtnpurchasemerchant">

<a onclick="opmodalpop('Assign To Sourcing','modalpop.php?action=assigntosoursingteam&styleId=<?php echo $_GET['styleid']; ?>&costsheetVersionId=1','400px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="border-radius: 2px; background-color: #0d7544; margin: 0px !important; padding: 5px 10px; font-size: 12px; font-weight: 500;"><i class="fa fa-plus" aria-hidden="true"></i> Assign To</a>

</div>

				        <div id="add_indentmpl">
					    <table width="100%" class="table table-bordered table-responsive forbom" id="tableid11" style="display:block;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body" style="background-color: #fff7b3;;">
							<!-- <th width="15%" align="center"><strong></strong><input  name="materialCheckAll" type="checkbox" class="checkalldeletematerial" id="materialCheckAll" style="height: 17px;width: 50px;margin-top: 0;text-align: center;" /></th>-->
                              <th>Item</th>
							<th>Construction</th>
							<th>Width</th>
							<th>Qty.</th>
							<th>UOM</th>
							<th>Process Loss</th>
							<th>Shrinkage</th>
							<th>Pro. Cons.</th>
							<th>Pro. with Width</th>
							<th>Final&nbsp;Qty.</th>
							<th>Supplier</th>
							<th>Price</th>
							<th>Currency</th>
						  </tr>
						  <tr class="card-body">
							<?php
						$no = 1;
						$wherenew='parentId="'.$lastId.'" order by id asc';
						$rsnew=GetPageRecord('*','greigeRequisition',$wherenew);
						while($rslistnew=mysqli_fetch_array($rsnew)){


						$tillTotalMaterialQty=0;
						$rsindent=GetPageRecord('SUM(orderQty) as tillorderQty','indentCreationMaster','requisitionNo="'.$requisitionNo.'" and materialId="'.$rslistnew['srinkageId'].'" and bomWidth="'.$rslistnew['greWidth'].'"');
						$resListingIndent1=mysqli_fetch_array($rsindent);
						$resListingIndent1['tillorderQty'];
						$tillTotalMaterialQty= $rslistnew['finalQty']-$resListingIndent1['tillorderQty'];

						?>
                        <tr>
						<!--<td><label class="analyselistclass">
						   	<input type="checkbox" style=" opacity:1; cursor: pointer; height: 17px; width: 50px; margin-top: 3px;" value="<?php echo $rslistnew['id']; ?>" name="analysemateriallistdelete[]" class="deletematerial" />

							</label>
							</td>-->
							<td><a href ="#" onclick="opmodalpop('','modalpop.php?action=greighindentSendpo&pageeditid=<?php echo $_GET['id']; ?>&materialId=<?php echo $rslistnew['srinkageId']; ?>&onstruction=<?php echo addslashes($rslistnew['construction']) ?>&greWidth=<?php echo addslashes($rslistnew['greWidth']); ?>&qty=<?php echo addslashes($rslistnew['qty']); ?>&uom=<?php echo addslashes($rslistnew['uom']); ?>&processLoss=<?php echo addslashes($rslistnew['processLoss']); ?>&shrinkage=<?php echo addslashes($rslistnew['shrinkage']); ?>&finalQty=<?php echo addslashes($rslistnew['finalQty']); ?>&supplier=<?php echo addslashes($rslistnew['supplier']); ?>&price=<?php echo addslashes($rslistnew['price']); ?>&currency=<?php echo addslashes($rslistnew['currency']); ?>&requisitionNo=<?php echo $requisitionNo; ?>&materialQty=<?php echo addslashes($tillTotalMaterialQty); ?>&styleId=<?php echo $styleNo; ?>&materialMasterId=<?php echo $rslistnew['srinkageId']; ?>','900px','auto');" data-toggle="modal" data-target="#modalpop">
							<?php
							$wherethis='id="'.$rslistnew['srinkageId'].'"';
							$rss=GetPageRecord('name','materialMaster',$wherethis);
							$resListing1s=mysqli_fetch_array($rss);
							echo stripslashes($resListing1s['name']);
							?></a></td>
							<td><?php echo $rslistnew['construction']; ?></td>
							<td><?php echo $rslistnew['greWidth']; ?></td>
							<td><?php echo $rslistnew['qty']; ?></td>
							<td><?php echo $rslistnew['uom']; ?></td>
							<td><?php echo $rslistnew['processLoss']; ?></td>
							<td><?php echo $rslistnew['shrinkage']; ?></td>
							<td><?php echo $rslistnew['processCons']; ?></td>
							<td><?php echo $rslistnew['processWidth']; ?></td>
							<td><?php echo $rslistnew['finalQty']; ?></td>
							<td><?php echo getSupplierName($rslistnew['supplier']); ?></td>
							<td><?php echo $rslistnew['price']; ?></td>
							<td><?php echo $rslistnew['currency']; ?></td>
						</tr>
						<?php } ?>
                            </tr>
						  </tbody>
                        </table>
						</div>
					  </div>
					</div>
				  </div>



				 </div>
				 </div>



    </div>
    <!-- /dashboard content -->
  </div>
  <!-- /content area -->
</div>
<!-- /main content -->
</div>
<script type="text/javascript">
		$(document).ready(function(){
		// check uncheck all inclusions
		$("#materialCheckAll").click(function(){
		if(this.checked){
			$('.deletematerial').each(function(){
				this.checked = true;
			})
		}else{
			$('.deletematerial').each(function(){
				this.checked = false;
			})
		}
		});

		});
</script>

<script>
window.setInterval(function(){
      checked = $("#add_indentmpl input[type=checkbox]:checked").length;
      if(!checked) {
	  $("#deactivatebtnpurchasemerchant").hide();
      } else {
	  $("#deactivatebtnpurchasemerchant").show();
	  }
}, 100);
</script>
