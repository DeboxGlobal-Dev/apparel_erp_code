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



			<!-- Content area -->
			<div class="content pt-0" style="margin-top:20px;">




				<!-- Dashboard content -->

				<!---style information section--->
				<?php include "top-style.php" ?>
				<!---style information section end--->



				<div class="row">

				<div class="col-xl-12">

				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">Dispatch Detail</h6>
				  </div>


				<?php
if($_GET['styleid']!=''){
$kk=GetPageRecord('*','sampleDispatchMaster','1 and styleid="'.decode($_GET['styleid']).'" and module="'.$_GET['module'].'" order by id desc');
$sampleDetails=mysqli_fetch_array($kk);
}
?>

				<div class="card-body">
								<div class="form-group">
			<form action="ac.crm" method="post" class="submitstyleform" enctype="multipart/form-data" name="popid" target="acf" id="popid">

			<div class="row">
					 <div class="col-md-2">
					   <div class="form-group">
							<label>Sample Type </label>
							<input name="sampletype" type="text" class="validate form-control" id="sampletype" value="<?php echo $sampleDetails['sampletype']; ?>" />
						</div>
					</div>

					<div class="col-md-1">
				      <div class="form-group">
							<label>Color</label>
					        <input name="color" type="text" class="validate form-control" id="color"   value="<?php echo $sampleDetails['color']; ?>" />
				      </div>
					</div>

					<div class="col-md-1">
					   <div class="form-group">
							<label>Size</label>
							<input name="size" type="text" class="validate form-control" id="size"  value="<?php echo $sampleDetails['size']; ?>" />
						</div>
					</div>

					<div class="col-md-1">
					   <div class="form-group">
							<label>Quantity</label>
							<input name="quantity" type="number" class="validate form-control"  id="quantity" value="<?php echo $sampleDetails['quantity']; ?>"  />
						</div>
					</div>

					<div class="" style="width:8%">
				      <div class="form-group">
							<label>Dispatch Date</label>
							<input name="dispatchDate" type="text" class="form-control" id="dispatchDate" value="<?php if($sampleDetails['dispatchDate']!=''){ echo date('d-m-Y', strtotime($sampleDetails['dispatchDate'])); }else{ echo date('d-m-Y'); } ?>">
				      </div>
					</div>

					<script>
				   	$( function(){
					$( "#dispatchDate" ).datepicker();
					} );
					</script>

					<div class="col-md-1">
					   <div class="form-group">
							<label>POD No</label>
							<input name="pod" type="text" class="validate form-control" id="pod" value="<?php echo $sampleDetails['pod']; ?>"  />
						</div>
					</div>

					<div class="col-md-1">
					   <div class="form-group">
							<label>POD Upload</label>
							<div class="btn-group">
								  <input type="file" name="podattachment" id="podattachment" value="" style="display:none;" />
								  <input type="hidden" name="podattachmentEdit" id="podattachmentEdit" value="<?php echo $sampleDetails['podattachment']; ?>" />
 <a onclick="focusinputbox();" class="btn btn-primary" style="margin-top: 0px;"><i class="fa fa-upload" aria-hidden="true" style=" color: #fffffff1; font-size: 18px;"></i></a>
								<?php if($sampleDetails['podattachment']!=''){ ?>
								  <a href="<?php echo 'images/'.$sampleDetails['podattachment']; ?>" class="btn btn-warning" target="_blank"><i class="fa fa-download" aria-hidden="true" style=" color: #fffffff1;   font-size: 18px;"></i></a>
								 <?php } ?>
								</div>

						</div>
					</div>

<script>
function focusinputbox(){
  $('#podattachment').click();
}
</script>

					 <div class="col-md-4">
					   <div class="form-group">
							<label>Remarks</label>
							<input name="remarks" type="text" class="validate form-control" id="remarks" value="<?php echo $sampleDetails['remarks']; ?>"  />
						</div>
					</div>

			<input type="hidden" name="styleId" value="<?php echo $_GET['styleid']; ?>" />
			<input type="hidden" name="module" value="<?php echo $_GET['module']; ?>" />
			<input type="hidden" name="action" value="dispatchdetailsave" />

			<div class="text-right" style="width: 100%; float: right; padding: 15px;">
			<button type="submit" class="btn btn-primary" style="margin:0px;">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>
			</div>


				</div>

			</form>


				</div>
				  </div>


				</div>


				  </div>




</div>



				<div class="col-md-12" style="padding:0px;">
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Image Gallery</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		<button type="button" class="btn btn-primary" onclick="opmodalpop(' Add Image Gallery','modalpop.php?action=protoimagegallery&id=<?php echo encode($lastId); ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" aria-expanded="false" style="margin:0px;"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add&nbsp;Image&nbsp;Gallery</button>
		                	</div>
	                	</div>
					</div>



					<?php

$selectimg='*';
$whereimg='parentId="'.$lastId.'" and name!="" and galleryType="protoImageGallery"  order by id desc';
$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
$count = mysqli_num_rows($rsimg);
while($imgresult=mysqli_fetch_array($rsimg)){
?>
<div class="card-body">
<p class="font-weight-semibold" style="margin-left: 3px; font-size: 16px;"><?php echo $imgresult['name']; ?></p>

<div style="overflow:hidden; ">
<?php
$selectimg1='*';
$whereimg1='galleryParentId="'.$imgresult['id'].'" and galleryType="protoImageGallery"  order by id desc';
$rsimg1=GetPageRecord($selectimg1,'imageGallery',$whereimg1);
while($imgresult1=mysqli_fetch_array($rsimg1)){
?>
<div class="dz-preview dz-processing dz-error dz-complete dz-image-preview" style="    border: 1px solid #f3f3f3;
    margin: 10px;
    float: left; width: 150px;
    height: 152px;
    box-shadow: 0px 0px 4px #efefef; overflow:hidden;">
	<div class="dz-image" style="position:relative;">
	<img data-dz-thumbnail="" alt="frontladisjacket.jpg" src="images/imageGallary/<?php echo $imgresult1['attachmentImage']; ?>" style="width: 100%; min-height: 150px; max-height: 150px;">

<style>
.delete-icon{
top: 0px;
width: 100%;
height: 100%;
position: absolute;
background: #0000007a;
display:none;
}
.delete-icon .fa-trash{font-size: 20px; top: 37%; position: absolute; left: 36%; color: #fff; border-radius: 50%; border: 1px solid #ccc; width: 35px; height: 33px; padding: 5px 8px;cursor:pointer;
}
.dz-image:hover .delete-icon{
	display:block;
}
</style>

<script>
function delete_proto_image(id){
var id=id;
var r = confirm("Are you sure you want to delete this record?");
if (r == true) {
$('#deleteprototype').load("deleteprototypeimage.php?id="+id+"&styleid='<?php echo $imgresult['parentId']; ?>'");
}
}
</script>

<div id="deleteprototype" style="display:none;"></div>

<div class="delete-icon"><div><i class="fa fa-trash" aria-hidden="true" onclick="delete_proto_image(<?php echo $imgresult1['id']; ?>);"></i></div></div>

</div>
</div>
<?php } ?>

<div class="dz-preview dz-processing dz-error dz-complete dz-image-preview" style="border: 1px solid #f3f3f3; margin: 10px; float: left; box-shadow: 0px 0px 4px #efefef; border: 1px dashed #08d664;
    ">
<div class="dz-image" style="width: 148px; height: 150px; text-align: center; font-size: 11px; text-transform: uppercase; color: #17ce1e; font-weight: 600;
">
	<form action="uploadgallery.php"   id="dropzone_multiple<?php echo $imgresult['id']; ?>" enctype="multipart/form-data" method="post" style="position:relative; width:150px; height:148px;">
<input type="hidden"  name="parentId" value="<?php echo $imgresult['parentId']; ?>"/>
<input type="hidden"  name="galleryParentId" value="<?php echo $imgresult['id']; ?>"/>
<input type="file" name="attachmentImage" style="position:absolute; left:0px; top:0px; width:100%; height:100%; z-index:999;  cursor:pointer;opacity: 0;" onchange="$('#dropzone_multiple<?php echo $imgresult['id']; ?>').submit();" />

<div style="font-size:38px; text-align:center; padding-top:50px;"><i class="fa fa-plus" aria-hidden="true"></i></div>Add New

	</form>
	</div>

</div>






</div>
</div>



<?php } ?>

<?php if($count==0){ ?>
<div style="text-align: center; padding: 10px; font-weight: 500; background-color: #ffffff; text-transform: uppercase; margin-bottom:15px;"><span>No gallery found.</span></div>
 <?php } ?>

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
<script src="http://deboxcrm.com/woodland2/global_assets/js/plugins/uploaders/dropzone.min.js"></script>
<script src="http://deboxcrm.com/woodland2/global_assets/js/demo_pages/uploader_dropzone.js"></script>
<style>
.card-header header-elements-inline{
	    margin-bottom: 15px !important;
}
</style>
