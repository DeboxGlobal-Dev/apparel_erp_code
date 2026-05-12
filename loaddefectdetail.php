<?php
include "inc.php";
include "config/logincheck.php";
$id=$_REQUEST['id'];
?>
<script src="js/jquery-1.12.4.js"></script>
<script src="global_assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="global_assets/js/demo_pages/form_select2.js"></script>
<script>
$(document).ready(function() {
	$(".select2").select2();
});
</script>
<div class="media hidediv" style="background-color: #fbfbfb; padding: 15px; margin-top:0px; display:ndone;" id="partyAddrsId1<?php echo $id; ?>">
			<div class="media-body">
				<input type="text" name="orderWiseNo<?php echo $id; ?>" value="" placeholder="Order Wise No." >
			</div>

			<div class="media-body ">
				<input type="text" name="ticketNo<?php echo $id; ?>" value="" placeholder="Ticketing No.">
			</div>
			<div class="media-body ">
				<input type="text" name="color<?php echo $id; ?>" value="" placeholder="Color" >
			</div>

			<div class="media-body">
				<input type="text" name="size<?php echo $id; ?>" value="" placeholder="Size">
			</div>

			<div class="media-body">
			<select name="remark<?php echo $id; ?>[]" class="select2 " multiple >
				<option value="" disabled>Select</option>
				<?php
				$rsdefect = GetPageRecord('id,name','inspectionDefectMaster', '1 and defectType=6 order by name asc');
				while ($resListingdefect = mysqli_fetch_array($rsdefect)) {
				?>
				<option value="<?php echo $resListingdefect['id']; ?>"><?php echo $resListingdefect['name']; ?></option>
				<?php } ?>
			</select>
			</div>

			<div class="media-body">
			<!-- <i class="fa fa-trash" aria-hidden="true" onclick="removeAddInfo(<?php echo $id; ?>);"  style="font-size: 17px; margin-left: 10px; margin-top: 3px; cursor:pointer;"></i> -->
			</div>
		</div>
