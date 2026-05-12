<?php
include "inc.php"; 
include "config/logincheck.php";  
$id=$_REQUEST['id'];
$rsid=$_REQUEST['rsid'];
?>
<div class="" id="rowid<?php echo $id; ?>" style="width:100%;display:block">
<div class="col-md-3">
	<div class="form-group">
		<label>&nbsp;</label>
		<input type="text" name="finish<?php echo $rsid; ?>" id="finish<?php echo $rsid; ?>" class="form-control" value=""/>
	</div>
</div>
<div class="col-md-3">
	<div class="form-group">
		<label>&nbsp;</label>
		<select name="sampleSize<?php echo $rsid; ?>" id="sampleSize<?php echo $rsid; ?>" class="form-control">
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
		<label>&nbsp;</label>
		<input type="number" name="sampleQty<?php echo $rsid; ?>" id="sampleQty<?php echo $rsid; ?>" class="form-control" value=""/>
	</div>
</div>
<div class="col-md-2">
	<div class="form-group">
		<label>&nbsp;</label>
		<select name="sampleStatus<?php echo $rsid; ?>" id="sampleStatus<?php echo $rsid; ?>" class="form-control">
			<option value="">Select</option>
			<option value="1">Approve</option>
			<option value="2">Cancel</option>
		</select>
	</div> 
</div>
<div class="col-md-1">
	<div class="form-group">
		<label>&nbsp;</label>
		<div style="padding: 7px;"><i class="icon-trash" style="font-size:25px;cursor:pointer;" onclick=removefabrics<?php echo $id; ?>('<?php echo $id; ?>');></i></div>
	</div>
</div>

</div>
<script>
function removefabrics<?php echo $id; ?>(id){
	$('#rowid'+id).remove();
	var rowCount = $('#rowCount<?php echo $id; ?>').val();
	rowCount=Number(rowCount)-1;  
	$('#rowCount<?php echo $id; ?>').val(rowCount);
}

</script>

<style>
.col-md-3{
float:left;
}
.col-md-2{
float:left;
}
.col-md-1{
float:left;
}
</style>