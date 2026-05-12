<?php
include "inc.php"; 
include "config/logincheck.php";  
$id=$_REQUEST['id'];
?>
 
<tr id="productcostid<?php echo $id; ?>">
<td align="center" id="">&nbsp;</i></td>	
<td><i class="icon-trash" style="font-size:20px;cursor:pointer;" onclick="removeproductcosts(<?php echo $id; ?>);"></i></td>
										<td><input type="text" class="" name="bodytype" id="bodytype" /></td>
										<td><input type="text" class="" name="uom" id="uom" /></td>
										<td><input type="text" class="" name="conqty" id="conqty" /></td>
										<td><input type="text" class="" name="wastage" id="wastage" /></td>
										<td><input type="text" class="" name="consqty" id="consqty" /></td>
										<td><input type="text" class="" name="storesupplier2" id="storesupplier2" /></td>
										<td><input type="text" class="" name="currency" id="currency" /></td>
										<td><input type="text" class="" name="value" id="value" /></td>
										<td><input type="text" class="" name="remarks" id="remarks" /></td>
										<td align="center"><input type="checkbox" class="styled" name="addtocostcheck" checked="checked"></td>
									</tr>

<script>
function removeproductcosts(id){
	$('#productcostid'+id).remove();
	var contactpproductcount = $('#contactpproductcount').val();
	contactpproductcount=Number(contactpproductcount)-1;  
	$('#contactpproductcount').val(contactpproductcount);
}
</script>
