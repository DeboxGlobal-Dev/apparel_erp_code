<?php
include "inc.php"; 
include "config/logincheck.php";  
$id=$_REQUEST['id'];
?>
 
<tr id="sewingsid<?php echo $id; ?>">
<td align="center" id="">&nbsp;</i></td>	
<td><i class="icon-trash" style="font-size:20px;cursor:pointer;" onclick="removesewings(<?php echo $id; ?>);"></i></td>
<td><input type="text" class="" name="article2" id="article2" /></td>
<td><input type="text" class="" name="bodytype" id="bodytype" /></td>
<td><input type="text" class="" name="uom" id="uom" /></td>
<td><input type="text" class="" name="conqty" id="conqty" /></td>
<td><input type="text" class="" name="wastage" id="wastage" /></td>
<td><input type="text" class="" name="consqty" id="consqty" /></td>
<td><input type="text" class="" name="storesupplier" id="storesupplier" /></td>
<td><input type="text" class="" name="currency" id="currency" /></td>
<td><input type="text" class="" name="value" id="value" /></td>
<td><input type="text" class="" name="rateofexchange" id="rateofexchange" /></td>
<td><input type="text" class="" name="valueinusd" id="valueinusd" /></td>
<td align="center"><input type="checkbox" class="styled" name="addtocostcheck" checked="checked"></td>
<td><input type="text" class="" name="shippingmode" id="shippingmode" /></td>
<td><input type="text" class="" name="shippingtype" id="shippingtype" /></td>
<td><input type="text" class="" name="refno" id="refno" /></td>
</tr>

<script>
function removesewings(id){
	$('#sewingsid'+id).remove();
	var contactpCountsewings = $('#contactpCountsewings').val();
	contactpCountsewings=Number(contactpCountsewings)-1;  
	$('#contactpCountsewings').val(contactpCountsewings);
}

</script>