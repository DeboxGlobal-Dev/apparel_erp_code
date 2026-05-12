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
		<!---Save Alert Notification---->
		<?php include "savealert.php"; ?>


			<!-- Content area -->
			<div class="content pt-0" style="margin-top:20px;">




				<!-- Dashboard content -->
				<!---style information section--->
				<?php include "top-style.php"; ?>
				<!---style information section end--->


				<div class="row">

				<div class="col-xl-12">




		<?php
		$i = 0;
		$costsheetVersionId='0';
		$selectversion='*';
		$whereversion='styleId="'.decode($_GET['styleid']).'" and buyerCostStatus=0 order by id desc';
		$rsversion=GetPageRecord($selectversion,'costsheetVersionMaster',$whereversion);
		while($resListingVer=mysqli_fetch_array($rsversion)){
		$costsheetVersionId = $resListingVer['versionId'];
		$i++;
		?>


		<div id="accordion-group<?php echo $resListingVer['id']; ?>" style="margin-bottom: 10px;">


		<div class="card mb-0 rounded-bottom-0">

<style>

.abcspecial-class:hover{
cursor:pointer;
background-color: #d8ff001f !important;
}
</style>
		<div class="abcspecial-class card-header collapsed" data-toggle="collapse" href="#accordion-item-group<?php echo $resListingVer['id']; ?>">
			<h6 class="card-title " style="width:60%;float:left;">
				<a data-toggle="collapse" class="text-default collapsed" href="#accordion-item-group<?php echo $resListingVer['id']; ?>" style="color:#000000;">Material Cost - <strong><?php echo $resListingVer['versionName']; ?></strong></a>

				<a class="text-default collapsed" data-toggle="collapse" href="#accordion-item-group<?php echo $resListingVer['id']; ?>" aria-expanded="false" style="text-align: left; color: #000; font-size: 13px; width: 100%;">-&nbsp;<?php echo date('d M, Y - h:ia',$resListingVer['dateAdded']); ?></a>

			</h6>


<?php if($loginuserprofileId=='154' || $loginuserprofileId=='155') { ?>
<div style="width: 40%; float: right; text-align: right; display: block;">
<div class="btn-group justify-content-center">

<a onclick="opmodalpop('Select Supplier','modalpop.php?action=materialSendToSupplier&styleId=<?php echo $_GET['styleid']; ?>&costsheetVersionId=<?php echo $costsheetVersionId; ?>&assignTo=<?php echo $_SESSION['userid']; ?>','900px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="border-radius: 2px; background-color: #0d7544; margin: 0px !important; padding: 5px 10px; font-size: 12px; font-weight: 500;"><i class="fa fa-paper-plane" aria-hidden="true" style="margin-right:5px;"></i> Send to Supplier</a>

</div>

<div class="btn-group justify-content-center">

<a href="showpage.crm?module=comparesuppliercost&view=yes&styleid=<?php echo encode($editresultstyle['id']); ?>&costsheetVersionId=<?php echo $costsheetVersionId; ?>" target="_blank" class="btn bg-teal-400" style="border-radius: 2px; background-color: #0d7544; margin: 0px !important; padding: 5px 10px; font-size: 12px; font-weight: 500;"><i class="fa fa-balance-scale" aria-hidden="true" style="margin-right:5px;"></i> Compare Cost</a>


</div>
</div>
<?php } ?>




		</div>


		<input type="hidden" id="materialcosttype" name="materialcosttype" value=""/>
		<input type="hidden" id="materialcosttypepurchasemerchant" name="materialcosttypepurchasemerchant" value=""/>


<div class="btn-group justify-content-center" style="width: fit-content; float: left; padding: 0px 15px; display: none; margin:0px;" id="deactivatebtn<?php echo $costsheetVersionId; ?>">

<a onclick="opmodalpop('Assign To Purchase','modalpop.php?action=assigntopurchase&styleId=<?php echo $_GET['styleid']; ?>&costsheetVersionId=<?php echo $costsheetVersionId; ?>&assignTo=<?php echo $_SESSION['userid']; ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="border-radius: 2px; background-color: #0d7544; margin: 0px !important; padding: 5px 10px; font-size: 12px; font-weight: 500;"><i class="fa fa-plus" aria-hidden="true"></i> Assign To</a>

</div>


<div class="btn-group justify-content-center" style="width: fit-content; float: left; padding: 0px 15px; display: none; margin:0px;" id="deactivatebtnpurchasemerchant<?php echo $costsheetVersionId; ?>">

<a onclick="opmodalpop('Assign To Purchase Merchant','modalpop.php?action=assigntopurchasemerchant&styleId=<?php echo $_GET['styleid']; ?>&costsheetVersionId=<?php echo $costsheetVersionId; ?>&assignTo=<?php echo $_SESSION['userid']; ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="border-radius: 2px; background-color: #0d7544; margin: 0px !important; padding: 5px 10px; font-size: 12px; font-weight: 500;"><i class="fa fa-plus" aria-hidden="true"></i> Assign To Merchant</a>

</div>



		<div id="accordion-item-group<?php echo $resListingVer['id']; ?>" class="collapse" data-parent="#accordion-group<?php echo $resListingVer['id']; ?>">


			<div class="card-body" style="padding:0px;">
		<div id="collapsible-control-right-group<?php echo $i; ?>" class="collapse" style="display:block;">
				<div class="card-body">



				<div class="tab-content">
						<fieldset class="card-body" style="padding: 10px;">

<form action="ac.crm" method="post" class="submitstyleform" enctype="multipart/form-data" name="techPackFormV<?php echo $i; ?>" target="techpackiframe<?php echo $i; ?>" id="techPackFormV<?php echo $i; ?>">
<input type="hidden" name="action2" value="techpackversion" />
<input type="hidden" name="versionId" value="<?php echo encode($resListingVer['versionId']); ?>" />
<input type="hidden" name="editId" value="<?php echo encode($lastId); ?>">
<input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">


<div class="row" id="load_bom_list<?php echo $costsheetVersionId; ?>">  </div>


			<div class="text-right" style="width: 100%;display: block;margin-top: 25px;">



		<button type="button" onclick="delete_material<?php echo $costsheetVersionId; ?>();delete_material_extra<?php echo $costsheetVersionId; ?>();addfinaldata<?php echo $costsheetVersionId; ?>();" class="btn btn-primary" style="margin:0px;">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>

			</div>


</form>

<script>

function duplicateCostsheet<?php echo $costsheetVersionId; ?>(){
var r = confirm("Are you sure you want to create duplicate?");
if (r == true) {
$('#cvId').val(1);
$( "#techPackFormV<?php echo $i; ?>" ).submit();
}
}
</script>
<script>
function load_bom_list_fun<?php echo $costsheetVersionId; ?>(){
$('#load_bom_list<?php echo $costsheetVersionId; ?>').load("load_bom_list.php?styleId=<?php echo $editresultstyle['id'];?>&subCategoryId=<?php echo $editresultstyle['subCategoryId'];?>&page=materiallist&costsheetVersionId=<?php echo $costsheetVersionId; ?>&loginuserprofileId=<?php echo $loginuserprofileId; ?>");
}

load_bom_list_fun<?php echo $costsheetVersionId; ?>();

 </script>


								</fieldset>
					</div>



			    </div>


</div>







			</div>
		</div>
	</div>



</div>

		<?php } ?>







</div>


					</div>

			</div>
				<!-- /dashboard content -->

			</div>
			<!-- /content area -->



		</div>
		<!-- /main content -->

	</div>


