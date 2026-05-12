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


</div>

<?php
$select='*';
$where='styleId="'.decode($_GET['styleid']).'" and costsheetVersionId="'.$_GET['costsheetVersionId'].'" group by vendorId asc';
$rs=GetPageRecord($select,'materialSendToVendor',$where);
while($resListing=mysqli_fetch_array($rs)){

$select12='*';
$where12='id="'.$resListing['vendorId'].'"';
$rs12=GetPageRecord($select12,'vendorMaster',$where12);
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
										<div id="loadvendorcommunication<?php echo $resListing['id']; ?>"></div>
									</div>
								</div>
							</div>
						</div>
				 </div>
<script>
 function loadvendorcommunication<?php echo $resListing['id']; ?>(){
 $('#loadvendorcommunication<?php echo $resListing['id']; ?>').load('loadvendorcommunication.php?id=<?php echo decode($_GET['styleid']); ?>&vendorId=<?php echo $resListing12['id']; ?>');
 }
 loadvendorcommunication<?php echo $resListing['id']; ?>();

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


