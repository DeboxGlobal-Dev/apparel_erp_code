<?php
include "inc.php";
$selectimg='*';
$styleId= decode($_REQUEST['id']);
$whereimg='parentId="'.$styleId.'" and galleryType="image_gallery" order by id asc';
$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
$count = mysqli_num_rows($rsimg);

//delete style images

if($_REQUEST['imageId']!=''){
deleteRecord('imageGallery','id='.$_REQUEST['imageId'].'');
?>
<script>
	loadimagefunc();
</script>
<?php
}


while($imgresult=mysqli_fetch_array($rsimg)){
?>
<div class="col-sm-6 col-lg-2" style="float:left;">
	<div class="card">
		<div class="card-img-actions m-1">
			<img class="card-img img-fluid" style="max-height: 185px;min-height: 185px;width: 100%;" src="<?php echo $fullurl; ?>images/<?php echo $imgresult['attachmentImage']; ?>" alt="<?php echo $imgresult['name']; ?>">
			<div align="center"><h6><?php echo $imgresult['name']; ?></h6></div>
			<div class="card-img-actions-overlay card-img">
				<a class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round legitRipple" data-popup="lightbox" rel="group">
					<i class="fa fa-trash-o" aria-hidden="true" onclick="delete_style_image(<?php echo $imgresult['id']; ?>);"></i>
				</a>

			</div>
		</div>
	</div>
</div>
<?php } ?>

<?php if($count<1){ ?>
<div style="text-align:center;padding:10px;font-weight: 500;background-color: #ffffff;text-transform: uppercase;">No Image available </div>
 <?php } ?>


<script>
function delete_style_image(id){
var id=id;
var r = confirm("Are you sure you want to delete this record?");
if (r == true) {
$('#deletestyleimage').load("loadimage.php?imageId="+id+"&styleid='<?php echo $styleId; ?>'");
}
}
</script>

<div id="deletestyleimage" style="display:block;"></div>
