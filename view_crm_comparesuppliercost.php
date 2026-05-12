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

$lastId=$editresultstyle['id'];

}


?>
	<div class="page-content">

		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<div class="content pt-0" style="margin-top:20px;">


                 <?php include "top-style.php"; ?>


				<div class="row">

				<div class="col-xl-12">





<div class="card mb-0 rounded-bottom-0" style="padding:15px;">
				 	<div class="panel panel-flat">
					 <div class="table-responsive">
					    <table width="100%" class="table table-bordered table-responsive forbom" style="display:block;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
							 <td width="12%" align="left"><strong>Material</strong></td>
                              <td width="12%" align="left"><strong>Description</strong></td>
                              <?php
							$select='*';
							$where='styleId="'.decode($_GET['styleid']).'" and costsheetVersionId="'.$_GET['costsheetVersionId'].'" group by supplierId asc';
							$rs=GetPageRecord($select,'materialSendToSupplier',$where);
							while($resListing=mysqli_fetch_array($rs)){

							$select12='*';
							$where12='id="'.$resListing['supplierId'].'"';
							$rs12=GetPageRecord($select12,'suppliersMaster',$where12);
							$resListing12=mysqli_fetch_array($rs12);
							?>
                              <td width="13%" align="left"><strong><?php echo $resListing12['name']; ?></strong></td>
							  <?php } ?>
							  <td width="13%" align="left"><strong>&nbsp;</strong></td>
                            </tr>
							<?php
							$select='*';
							$where='styleId="'.decode($_GET['styleid']).'" and costsheetVersionId="'.$_GET['costsheetVersionId'].'" group by materialTypeId asc';
							$rs=GetPageRecord($select,'materialSendToSupplier',$where);
							while($resListing=mysqli_fetch_array($rs)){

							$selectmtype='*';
							$wheremtype='id="'.$resListing['materialTypeId'].'"';
							$rstype=GetPageRecord($selectmtype,'materialTypeMaster',$wheremtype);
							$resListingtype=mysqli_fetch_array($rstype);

							?>
							<tr class="card-body">
							<td width="100%" align="left" colspan="20" style="background-color: #e5fbfa;text-transform: uppercase;font-size: 14px;"><strong><?php echo $resListingtype['name']; ?></strong></td>
							</tr>

							<?php
							$selectmid='*';
							$wheremid='styleId="'.decode($_GET['styleid']).'" and costsheetVersionId="'.$_GET['costsheetVersionId'].'" and materialTypeId="'.$resListing['materialTypeId'].'" group by materialId asc';
							$rsmid=GetPageRecord($selectmid,'materialSendToSupplier',$wheremid);
							while($resListingmid=mysqli_fetch_array($rsmid)){

							$select1='*';
							$where1='id="'.$resListingmid['materialId'].'"';
							$rs1=GetPageRecord($select1,'styleSubCategoryMaster',$where1);
							$resListing1=mysqli_fetch_array($rs1);
							?>
                            <tr class="card-body">
								<td align="left"><?php echo $resListing1['name']; ?></td>
								<td align="left"><?php echo getDescriptionName($resListing1['materialdescriptionid']); ?></td>
								<?php

								$select11='*';
								$where11='styleId="'.decode($_GET['styleid']).'" and costsheetVersionId="'.$_GET['costsheetVersionId'].'" and materialId="'.$resListingmid['materialId'].'" group by supplierId asc';
								$rs11=GetPageRecord($select11,'materialSendToSupplier',$where11);
								while($resListing11=mysqli_fetch_array($rs11)){
								?>
								<td align="left"><?php echo $resListing11['valueOnePiece']; ?> <?php if($resListing11['defaultSupplier']==$resListing11['supplierId']){ ?><span><i class="fa fa-check" aria-hidden="true" style="font-size: 20px; color: #0e7645; float:right;"></i></span><?php } ?></td>


								<div id="updateSupplier<?php echo $resListing11['id']; ?>"></div>
							 	<script>
								function selectSupplier<?php echo $resListingmid['id']; ?>(id){
								var r = confirm("Are you sure you want to select cost of this supplier ?");
									if (r == true) {
									$('#updateSupplier<?php echo $resListing11['id']; ?>').load("allaction.php?styleId=<?php echo decode($_GET['styleid']); ?>&costsheetVersionId=<?php echo $_GET['costsheetVersionId']; ?>&materialId=<?php echo $resListingmid['materialId']; ?>&bomsrno=<?php echo $resListing1['sr']; ?>&valueOnePiece=<?php echo $resListing11['valueOnePiece']; ?>&supplierid=<?php echo $resListing11['supplierId']; ?>&action=savesppliercost&updateId="+id);
									}
								}
								</script>
								<?php } ?>
								<td align="left">
								<select name="supplierId" id="supplierId" style="padding: 5px;width: 150px;" onchange="selectSupplier<?php echo $resListingmid['id']; ?>(this.value);">
								<option value="">Select</option>
								<?php
								$select111='*';
								$where111='styleId="'.decode($_GET['styleid']).'" and costsheetVersionId="'.$_GET['costsheetVersionId'].'" and materialId="'.$resListingmid['materialId'].'" group by supplierId asc';
								$rs111=GetPageRecord($select111,'materialSendToSupplier',$where111);
								while($resListing111=mysqli_fetch_array($rs111)){

								$select12='*';
								$where12='id="'.$resListing111['supplierId'].'"';
								$rs12=GetPageRecord($select12,'suppliersMaster',$where12);
								$resListing12=mysqli_fetch_array($rs12);

								?>
								<option value="<?php echo $resListing12['id']; ?>" <?php if($resListing111['defaultSupplier']==$resListing12['id']){ echo "selected"; }?>><?php echo $resListing12['name']; ?></option>
								<?php } ?>
								</select>
								</td>
			                 </tr>

							<?php } } ?>
                          </tbody>

                        </table>
					  </div>
					</div>
</div>










</div>

<?php
$select='*';
$where='styleId="'.decode($_GET['styleid']).'" and costsheetVersionId="'.$_GET['costsheetVersionId'].'" group by supplierId asc';
$rs=GetPageRecord($select,'materialSendToSupplier',$where);
while($resListing=mysqli_fetch_array($rs)){

$select12='*';
$where12='id="'.$resListing['supplierId'].'"';
$rs12=GetPageRecord($select12,'suppliersMaster',$where12);
$resListing12=mysqli_fetch_array($rs12);
?>

<div class="col-xl-6" style="margin-top:20px;">
				 <div class="card">
							 <div class="card-body navbar-green"   >
							<div class="media">
									 <div class="col-xl-6" style="padding:0px;">
									<h6 class="media-title font-weight-semibold">
<i class="fa fa-user" aria-hidden="true" style="position: relative;float: left;margin-right: 9px;font-size: 19px;color: #0d7544;"></i>
<div style="font-size: 15px;color: #0d7545;font-weight: 600;text-transform: uppercase;"><?php echo $resListing12['name']; ?></div>




									</h6>
									</div>
							 </div>
						</div>

							<div class="card-body">


								<div class="tab-content">

									<div class="tab-pane active show" id="solid-rounded-justified-tab1" >
										<div id="loadsuppliercommunication<?php echo $resListing['id']; ?>"></div>
									</div>
								</div>
							</div>
						</div>
				 </div>
<script>
 function loadsuppliercommunicationpurchase<?php echo $resListing['id']; ?>(){
 $('#loadsuppliercommunication<?php echo $resListing['id']; ?>').load('loadsuppliercommunicationpurchase.php?id=<?php echo decode($_GET['styleid']); ?>&supplierId=<?php echo $resListing12['id']; ?>&module=<?php echo $_GET['module']; ?>');
 }
 loadsuppliercommunicationpurchase<?php echo $resListing['id']; ?>();

</script>
<?php } ?>

<script>
function showView(){
$(".showhide").text("View Cost");
}
</script>


					</div>
                </div>
			 </div>
			 </div>
		 </div>


