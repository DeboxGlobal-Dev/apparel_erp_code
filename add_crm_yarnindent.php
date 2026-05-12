<?php

if($_GET['id']!=''){
$select='*';
$where='id="'.decode($_GET['id']).'"';
$rs=GetPageRecord($select,'yarnRequisition',$where);
$editresultstyle=mysqli_fetch_array($rs);
@extract($editresultstyle);
$lastId=$editresultstyle['id'];
$requisitionNo = $requisitionNo;
}

 if($_GET['module']=='grn'){

     $no = 1;
						$wherenew='parentId="'.$lastId.'" order by id asc';
						$rsnew=GetPageRecord('*','yarnRequisition',$wherenew);
						while($rslistnew=mysqli_fetch_array($rsnew)){


						$tillTotalMaterialQty=0;
						$rsindent=GetPageRecord('SUM(orderQty) as tillorderQty','indentCreationMaster','requisitionNo="'.$requisitionNo.'" and materialId="'.$rslistnew['srinkageId'].'"');
						$resListingIndent1=mysqli_fetch_array($rsindent);
						$resListingIndent1['tillorderQty'];
						$tillTotalMaterialQty= $rslistnew['yarn_req']-$resListingIndent1['tillorderQty'];
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
                        <th>Count</th>
                        <th>Diameter</th>
                        <th>GSM</th>
                        <th>Qty/Cut</th>
                        <th>UOM</th>
                        <th>Excess %</th>
                        <th>Excess Qty Cut</th>
                        <th>SMPL</th>
                        <th>Total Pieces</th>


                        <th>Avg</th>
                        <th>Total Consumption</th>
                        <th>Process Loss(Packing)</th>
                        <th>Processed Qty</th>


                        <th>Process Loss (Washing)</th>

                        <th>Processed Qty</th>

                        <th>Process Loss (Dyeing)</th>
                        <th>Process (Knitting)</th>




                        <th>Process&nbsp;Loss</th>


						<th>Yarn Requisition</th>

                        <th>Supplier</th>
                        <th>Price</th>
                        <th>Currency</th>
						  </tr>
						  <tr class="card-body">
							<?php
						$no = 1;
						$wherenew='parentId="'.$lastId.'" order by id asc';
						$rsnew=GetPageRecord('*','yarnRequisition',$wherenew);
						while($rslistnew=mysqli_fetch_array($rsnew)){


						$tillTotalMaterialQty=0;
						$rsindent=GetPageRecord('SUM(orderQty) as tillorderQty','indentCreationMaster','requisitionNo="'.$requisitionNo.'" and materialId="'.$rslistnew['srinkageId'].'"');
						$resListingIndent1=mysqli_fetch_array($rsindent);
						$resListingIndent1['tillorderQty'];
						$tillTotalMaterialQty= round($rslistnew['yarn_req']-$resListingIndent1['tillorderQty'],2);

						?>
                        <tr>
						<!--<td><label class="analyselistclass">
						   	<input type="checkbox" style=" opacity:1; cursor: pointer; height: 17px; width: 50px; margin-top: 3px;" value="<?php echo $rslistnew['id']; ?>" name="analysemateriallistdelete[]" class="deletematerial" />

							</label>
							</td>-->
							<td><a href ="#" onclick="opmodalpop('','modalpop.php?action=yarnindentSendpo&pageeditid=<?php echo $_GET['id']; ?>&materialId=<?php echo $rslistnew['srinkageId']; ?>&finalQty=<?php echo addslashes($rslistnew['yarn_req']); ?>&uom=<?php echo addslashes($rslistnew['uom']); ?>&supplier=<?php echo addslashes($rslistnew['supplier']); ?>&price=<?php echo addslashes($rslistnew['price']); ?>&currency=<?php echo addslashes($rslistnew['currency']); ?>&requisitionNo=<?php echo $requisitionNo; ?>&materialQty=<?php echo addslashes($tillTotalMaterialQty); ?>&styleId=<?php echo $styleNo; ?>&materialMasterId=<?php echo $rslistnew['srinkageId']; ?>','900px','auto');" data-toggle="modal" data-target="#modalpop">
							<?php
							$wherethis='id="'.$rslistnew['srinkageId'].'"';
							$rss=GetPageRecord('name','materialMaster',$wherethis);
							$resListing1s=mysqli_fetch_array($rss);
							echo stripslashes($resListing1s['name']);
							?></a></td>
							<td><?php echo $rslistnew['count']; ?></td>
							<td><?php echo $rslistnew['diameter']; ?></td>
							<td><?php echo $rslistnew['gsm']; ?></td>
							<td><?php echo $rslistnew['qty_cut']; ?></td>
							<td><?php echo $rslistnew['uom']; ?></td>
							<td><?php echo $rslistnew['excess']; ?></td>
							<td><?php echo $rslistnew['excess_qty_cut']; ?></td>
							<td><?php echo $rslistnew['smpl']; ?></td>
							<td><?php echo $rslistnew['total_peice']; ?></td>
							<td><?php echo round($rslistnew['avg'],3); ?></td>
							<td><?php echo round($rslistnew['total_consumption'],3); ?></td>
							<td><?php echo round($rslistnew['pro_loss_pack'],3); ?></td>
							<td><?php echo round($rslistnew['processed_qty'],3); ?></td>
							<td><?php echo round($rslistnew['pro_loss_wash'],3); ?></td>
							<td><?php echo round($rslistnew['processed_qty_sec'],3); ?></td>
							<td><?php echo round($rslistnew['pro_loss_dyeing'],3); ?></td>
							<td><?php echo round($rslistnew['pro_knit'],3); ?></td>
							<td><?php echo round($rslistnew['processLoss'],3); ?></td>
							<td><?php echo round($rslistnew['yarn_req'],3); ?></td>
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
