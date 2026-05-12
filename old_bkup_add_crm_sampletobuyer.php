<?php
//$updatepage='1';

if($_GET['id']==''){
$where=' subject="" and  addedBy='.$_SESSION['userid'].'';
deleteRecord('queryMaster',$where);

$dateAdded=time();
$namevalue ='subject="",addedBy='.$_SESSION['userid'].',dateAdded='.$dateAdded.'';
$lastId = addlistinggetlastid('queryMaster',$namevalue);
}

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
	<div class="page-content">

		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">



			<!-- Content area -->
			<div class="content pt-0" style="margin-top:20px;">




				<!-- Dashboard content -->

				<!---style information section--->
				<?php include "top-style.php"; ?>
				<!---style information section end--->

				<!--COST SHEET DETAIL-->
				<div class="row">
				 <div class="col-md-12">
				   <div class="card">
					 <div class="card-header header-elements-inline">
						<h5 class="card-title">Cost Detail</h5>
					 </div>

					 <div class="specialclassforsheetsecond" id="showfobdefault<?php echo $costsheetVersionId;?>" style="display: block; margin-top: 0; padding: 18px; padding-top: 0px;">

<table width="100%" class="table table-bordered table-responsive forbom" style="">
<tbody style="width: 100%;display: inline-table;">
		<tr class="card-body" style="background: #e5fbfa;font-size: 15px;font-weight:600;">
		<td align="center">M.R.P</td>
		<td align="center">F.O.B</td>
		<td align="center">Margin</td>
		</tr>

		<tr class="card-body" style="background: #f7f7f7;font-size: 15px;font-weight: 500;">

		<?php
        $costsheetVersionId='0';
		$selectversion='*';
		$whereversion='styleId="'.$lastId.'" order by id desc';
		$rsversion=GetPageRecord($selectversion,'costsheetVersionMaster',$whereversion);
		$resListingVer=mysqli_fetch_array($rsversion);
		$costsheetVersionId = $resListingVer['versionId'];

		$rs31=GetPageRecord('*','costsheetVersionMaster','styleId="'.$lastId.'" and versionId="'.$costsheetVersionId.'"');
		$resListing31=mysqli_fetch_array($rs31);
		$totalmrp=$resListing31['totalmrp'];
		$mrptotallast=$resListing31['mrptotallast'];
		$finalgrandtotalwithmrp =$resListing31['finalgrandtotalwithmrp'];
?>


		<td align="center">
        <span class=""><?php echo $totalmrp; ?></span>
		 </td>

		<td align="center">
		<span class=""><?php echo $mrptotallast; ?></span>
		</td>

		<td align="center">
		<span class=""><?php echo $finalgrandtotalwithmrp; ?></span>
		</td>
		</tr>


</tbody>
</table>

</div>

				   </div>
			      </div>
                 </div>
				<!--END OF DETAIL-->


				<div class="row">

				<div class="col-md-12">
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Sample to Buyer</h5>
					</div>



					<?php

$selectimg='*';
$whereimg='parentId="'.$lastId.'" and name!="" and galleryType="protoImageGallery"  order by id desc';
$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
$count = mysqli_num_rows($rsimg);
while($imgresult=mysqli_fetch_array($rsimg)){
?>

<div id="marketingteam" class="card-body" style="width: 100%; display: block; position: relative;">
<p class="font-weight-semibold" style="margin-left: 3px; font-size: 16px;"><?php echo $imgresult['name']; ?></p>

<div style="width: 20%; float: left; display: block;" class="buyerslider owl-carousel">
<?php
$selectimg1='*';
$whereimg1='galleryParentId="'.$imgresult['id'].'" and galleryType="protoImageGallery"  order by id desc';
$rsimg1=GetPageRecord($selectimg1,'imageGallery',$whereimg1);
while($imgresult1=mysqli_fetch_array($rsimg1)){
?>
<div class="dz-preview dz-processing dz-error dz-complete dz-image-preview" style="border: 1px solid #f3f3f3; margin: 10px; float: left; width: 200px; height: 200px; box-shadow: 0px 0px 4px #efefef; overflow: hidden;">
	<img data-dz-thumbnail="" alt="frontladisjacket.jpg" src="images/imageGallary/<?php echo $imgresult1['attachmentImage']; ?>" style="width: 165px; margin: auto;">
</div>
 <?php } ?>
</div>


<div class="buyerCal" style="width: 80%;float: right;">

<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid" style="padding: 10px 20px; width: 100%; display: block;">
				<div class="card-body" style="padding:4px;">
				<div class="form-group">
				<div class="row">
				<div class="col-md-3">
						<div class="form-group">
							<label>Finish</label>
							<input type="text" name="sampleQty<?php echo $imgresult['id']; ?>" id="sampleQty<?php echo $imgresult['id']; ?>" class="form-control" value=""/>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Size</label>
							<select name="sampleSize<?php echo $imgresult['id']; ?>" id="sampleSize<?php echo $imgresult['id']; ?>" class="form-control">
								<option value="">Select</option>
								<option value="1">XS</option>
								<option value="2">S</option>
								<option value="3">M</option>
								<option value="4">L</option>
								<option value="5">XL</option>
								<option value="6">XXL</option>
							</select>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label>Qty.</label>
							<input type="number" name="sampleQty<?php echo $imgresult['id']; ?>" id="sampleQty<?php echo $imgresult['id']; ?>" class="form-control" value=""/>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label>Status</label>
							<select name="sampleStatus<?php echo $imgresult['id']; ?>" id="sampleStatus<?php echo $imgresult['id']; ?>" class="form-control">
								<option value="">Select</option>
								<option value="1">Approve</option>
								<option value="2">Cancel</option>
							</select>
						</div>
					</div>
					<div class="col-md-1">
						<div class="form-group">
							<label>&nbsp;</label>
							<div style="padding: 7px;"><i class="icon-add" style="font-size:25px;cursor:pointer;" onclick=addnewrow<?php echo $imgresult['id']; ?>();></i></div>
						</div>
					</div>

					<input name="rowCount" type="hidden" id="rowCount<?php echo $imgresult['id']; ?>" value="1">

				</div>

				<div class="row" id="loadnewrow<?php echo $imgresult['id']; ?>"></div>

				<script>
				function addnewrow<?php echo $imgresult['id']; ?>(){
				var rowCount = $('#rowCount<?php echo $imgresult['id']; ?>').val();
				rowCount=Number(rowCount)+1;

				$.get("loadnewrow.php?id="+rowCount+'&rsid='+<?php echo $imgresult['id']; ?>, function (data) {
				$("#loadnewrow<?php echo $imgresult['id']; ?>").append(data);
				});
				 $('#rowCount<?php echo $imgresult['id']; ?>').val(rowCount);
				$
				}


				</script>




				</div>
				<input type="hidden" name="patternploaded" value="patternploaded" />
				<input type="hidden" name="editId" value="<?php echo $_GET['styleid']; ?>">
				<input type="hidden" name="action" value="addpattern">
				<input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">


				</div>

				</form>
</div>
</div>
<?php } ?>

				<!--<div class="text-right">
						<button type="submit" style="margin:0px;" class="btn btn-primary">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>
					</div>-->
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

