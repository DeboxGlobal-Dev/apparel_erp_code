<?php
if($_GET['styleid']!=''){
$select='*';
$where='id="'.decode($_GET['styleid']).'"';
$rs=GetPageRecord($select,'queryMaster',$where);
$editresultstyle=mysqli_fetch_array($rs);


$selectcountmaterial='*';
$wherecountmaterial='styleId="'.decode($_GET['styleid']).'"';
$rscountmaterial=GetPageRecord($selectcountmaterial,'styleSubCategoryMaster',$wherecountmaterial);
$rescountmaterial=mysql_num_rows($rscountmaterial);

if($rescountmaterial==0){
////////fabric//////////
$namevalue1 ='name="'.getMaterialName(18).'",materialid=18,materialType=1,subCategoryId="'.$editresultstyle['subCategoryId'].'",styleId="'.decode($_GET['styleid']).'",sr=1,costsheetVersionId=1,materialMasterId=18';
$lastId1 = addlistinggetlastid('styleSubCategoryMaster',$namevalue1);

////////trims//////////
$namevalue2 ='name="'.getMaterialName(14).'",materialid=14,materialType=2,subCategoryId="'.$editresultstyle['subCategoryId'].'",styleId="'.decode($_GET['styleid']).'",sr=2,costsheetVersionId=1,materialMasterId=14';
$lastId2 = addlistinggetlastid('styleSubCategoryMaster',$namevalue2);

////////packaging//////////
$namevalue3 ='name="'.getMaterialName(47).'",materialid=47,materialType=3,subCategoryId="'.$editresultstyle['subCategoryId'].'",styleId="'.decode($_GET['styleid']).'",sr=3,costsheetVersionId=1,materialMasterId=47';
$lastId3 = addlistinggetlastid('styleSubCategoryMaster',$namevalue3);

}






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
			<h6 class="card-title ">

				<a data-toggle="collapse" class="text-default collapsed" href="#accordion-item-group<?php echo $resListingVer['id']; ?>" style="color:#000000;">Material List - <strong><?php echo $resListingVer['versionName']; ?></strong></a>

				<a class="text-default collapsed" data-toggle="collapse" href="#accordion-item-group<?php echo $resListingVer['id']; ?>" aria-expanded="false" style="text-align: left; color: #000; font-size: 13px; width: 100%;"> -&nbsp;<?php echo date('d M, Y - h:ia',$resListingVer['dateAdded']); ?></a></h6>

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
<input type="hidden" name="analyzeMaterialListSave" value="1" id="analyzeMaterialListSave">


<div class="row" id="load_bom_list<?php echo $costsheetVersionId; ?>">  </div>


			<div class="text-right" style="width: 100%;display: block;margin-top: 25px;">

			<button type="button" onclick="delete_material<?php echo $costsheetVersionId; ?>();delete_material_extra<?php echo $costsheetVersionId; ?>();addfinaldata<?php echo $costsheetVersionId; ?>();materiallistsave<?php echo $costsheetVersionId; ?>();" class="btn btn-primary" style="margin:0px;">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>

			</div>


</form>
<div id="analyzeMaterialListSave" style="display:none;"></div>

<script>
function materiallistsave<?php echo $costsheetVersionId; ?>(){
var analyzeMaterialListSave=$('#analyzeMaterialListSave').val();
$('#analyzeMaterialListSave').load("newaction.php?action=materiallistsave&analyzeMaterialListSave="+analyzeMaterialListSave+"&editId=<?php echo encode($lastId); ?>");
}
</script>


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
$('#load_bom_list<?php echo $costsheetVersionId; ?>').load("load_bom_list.php?styleId=<?php echo $editresultstyle['id'];?>&subCategoryId=<?php echo $editresultstyle['subCategoryId'];?>&page=analysemateriallist&costsheetVersionId=<?php echo $costsheetVersionId; ?>");
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

	</div>


