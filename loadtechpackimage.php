<?php
include "inc.php"; 

$id=$_REQUEST['id'];
?>

<div class="row" id="techpackimageid<?php echo $id; ?>">
	<div class="col-md-4">
		<div class="form-group">
			<label>Image Name: </label>
			<input type="text" name="imageName<?php echo $id; ?>" id="imageName<?php echo $id; ?>" class="form-control" placeholder="">
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
		<label>Attach File</label>
			<div class="uniform-uploader">
			<input type="file" name="techPackImage<?php echo $id; ?>" id="techPackImage<?php echo $id; ?>" class="form-input-styled" data-fouc="">
			<span class="filename" style="user-select: none;">No file selected</span>
			<span class="action btn bg-pink-400" style="user-select: none;"><i class="icon-plus2"></i></span>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<label>&nbsp;</label>
			<div><i class="icon-trash "style="font-size:25px;cursor:pointer;" onclick="removeimage(<?php echo $id; ?>);"></i></div>
		</div>
	</div>
	<input name="imageCount" type="hidden" id="imageCount" value="<?php echo $id; ?>">

</div>

<script>
function removeimage(id){
	$('#techpackimageid'+id).remove();
	var imageCount = $('#imageCount').val();
	imageCount=Number(imageCount)-1;  
	$('#imageCount').val(imageCount);
}
</script>