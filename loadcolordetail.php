<?php
include "inc.php";
include "config/logincheck.php";
$id=$_REQUEST['id'];
$brandId=$_REQUEST['brandId'];
?>
<script src="js/jquery-1.12.4.js"></script>
<script src="global_assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="global_assets/js/demo_pages/form_select2.js"></script>
<script>
$(document).ready(function() {
	$(".select2").select2();
});
</script>
<div  class="row" style="margin-top:20px;" id="partyAddrsId<?php echo $id; ?>">
  <div class="col-md-3">
    <div class="form-group">
      <select id="colorId<?php echo $id; ?>" name="colorId<?php echo $id; ?>" class=" form-control" displayname="">
		  <option value="">Select</option>
		   <?php
			$select='';
			$where='';
			$rs='';
			$select='*';
			echo $where='1 and deletestatus=0 and status=1 and brandId='.$brandId.' order by name asc';
			$rs11=GetPageRecord('name,id','colorCardMaster',$where);
			while($resListing11=mysqli_fetch_array($rs11)){
			?>
		  <option value="<?php echo strip($resListing11['id']); ?>" ><?php echo strip($resListing11['name']); ?></option>
		  <?php } ?>
		</select>
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group">
      <input name="qty<?php echo $id; ?>" type="number" class="form-control" min="0" id="qty<?php echo $id; ?>" value="" >
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
     <select id="valueEdition<?php echo $id; ?>" name="valueEdition<?php echo $id; ?>[]" class=" form-control select2" multiple="multiple">
	  <option value="">Select</option>
	   <?php
		$select='';
		$where='';
		$rs='';
		$select='*';
		$where='1 and deletestatus=0 and status=1 order by name asc';
		$rs12=GetPageRecord($select,'embroideryTypeMaster',$where);
		while($resListing12=mysqli_fetch_array($rs12)){
		?>
	  <option value="<?php echo strip($resListing12['id']); ?>" ><?php echo strip($resListing12['name']); ?></option>
	  <?php } ?>
	</select>
    </div>
  </div>
  <div class="col-md-3">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="80%" align="left" style=""><div class="form-group">
            <select id="lining<?php echo $id; ?>" name="lining<?php echo $id; ?>" class=" form-control" displayname="">
			  <option value="Yes" <?php if($editresult['lining']=='Yes'){ ?>selected="selected"<?php } ?>>Yes</option>
			  <option value="No" <?php if($editresult['lining']=='No'){ ?>selected="selected"<?php } ?>>No</option>
			</select>
          </div></td>
        <td width="10%" align="left" style=""><div class="form-group"> </div></td>
        <td width="10%" align="left" style=""><div class="form-group"> <img src="images/deleteicon.png" width="12" height="16" onClick="removeAddInfo(<?php echo $id; ?>);" style="cursor:pointer;"/> </div></td>
      </tr>

    </table>

  </div>
                  <input name="date<?php echo $id; ?>" type="hidden" class="form-control" id="date<?php echo $id; ?>" value="<?php echo time(); ?>" >

</div>
