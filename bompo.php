<link rel="stylesheet" href="js/jquery-ui.css">
<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery-ui.js"></script>
<div class="row">
<?php
include('inc.php');


$rsList121=GetPageRecord('*','indentCreationMaster','1 order by id asc');
$rsListData121=mysqli_fetch_array($rsList121);

print_r($rsListData121); die;

?>

<table width="100%" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#000000" style="border:1px #ccc;">
  <tbody><tr>
    <td align="center"><div style="font-size:16px; font-weight:bold; ">Supplier Purchase Order</div></td>
  </tr>

  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tbody><tr>

        <td width="30%" align="left" valign="top">
		<span style="font-size:16px;"> Debox Global IT Solutions</span><br>
		<span style="font-size:10px;">C-75, Sector 2 Noida (U.P.)</br>
          Tel: +91 9910910910<br>
          Email: info@deboxglobal.com<br />
		</span>
		</td>
		<td width="30%" align="left" valign="top">
		<span style="font-size:16px;">Priya Global</span><br>
		<span style="font-size:10px;">C-75, Sector 2 Noida (U.P.)</br>
          Tel: +91 9910910910<br>
          Email: info@priyaglobal.com<br />
		</span>
		</td>

		<td width="40%" align="left" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">

  <tbody>


</tbody></table>
</td>
      </tr>
    </tbody></table></td>
  </tr>

  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tbody><tr>

        <td width="100%" align="center" valign="top">
		<span style="font-size:16px;"> <strong>Attention:</strong></span>
		</td>
		</tr>
    </tbody></table></td>
  </tr>

  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tbody><tr>

        <td width="30%" align="left" valign="top">
		<span style="font-size:16px;"> PO Company:</span><br>
		<span style="font-size:16px;"> Status:</span><br>
		<span style="font-size:16px;"> Delivery Start Date:</span><br>
		<span style="font-size:16px;"> Tax Template:</span><br>
		<span style="font-size:16px;"> Date In House:</span><br>
		<span style="font-size:16px;"> Season:</span><br>
		<span style="font-size:16px;"> PO Number:</span><br>
		</td>
		<td width="30%" align="left" valign="top">
		<span style="font-size:16px;"> PO Division:</span><br>
		<span style="font-size:16px;"> PO Type:</span><br>
		<span style="font-size:16px;"> Utilization:</span><br>

		</td>

		<td width="40%" align="left" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">

  <tbody>


</tbody></table>
</td>
      </tr>
    </tbody></table></td>
  </tr>


  <tr>
    <td>
	<div style="overflow:hidden;">
	<div id="savedetails"></div><table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#000000" class="table table-responsive">
      <tbody><tr style="color:#FFFFFF;">
		<td bgcolor="#333333"><strong>Material</strong></td>
        <td bgcolor="#333333"><strong>HSN&nbsp;Code</strong></td>
		<td bgcolor="#333333"><strong>Color</strong></td>
		<td bgcolor="#333333"><strong>Size</strong></td>
        <td bgcolor="#333333"><strong>Size/Width</strong></td>
		<td bgcolor="#333333"><strong>No.&nbsp;Unit</strong></td>
		<td bgcolor="#333333"><strong>UOM</strong></td>
		<td bgcolor="#333333"><strong>Unit&nbsp;Price</strong></td>
		<td bgcolor="#333333"><strong>Total&nbsp;Value(INR)</strong></td>
		<td bgcolor="#333333"><strong>IGST&nbsp;Input</strong></td>
		<td bgcolor="#333333"><strong>IGST&nbsp;Input&nbsp;Value</strong></td>
		<td bgcolor="#333333"><strong>Total&nbsp;Value&nbsp;INR</strong></td>
  		</tr>
		<?php
		  $rsList=GetPageRecord('*','indentCreationMaster','1 order by id asc');
		  while($rsListData=mysqli_fetch_array($rsList)){

		  $rs1=GetPageRecord('*','styleSubCategoryMaster','id="'.$rsListData['materialId'].'"');
		  $resListing1=mysqli_fetch_array($rs1);
		?>
		<tr style="border: 1px solid #ccc;">
			<td><?php echo $resListing1['name']; ?></td>
			<td></td>
			<td><?php echo $rsListData['color']; ?></td>
			<td><?php echo $rsListData['size']; ?></td>
			<td><?php if($rsListData['materialTypeId']=='1'){ echo $rsListData['bomWidth']; } ?></td>
			<td><?php echo $rsListData['orderQty']; ?></td>
			<td><?php echo $rsListData['uom']; ?></td>
			<td><?php echo $rsListData['sellingRate']; ?></td>
			<td><?php echo $rsListData['sellingValue']; ?></td>
			<td style="text-align: center;">
			<input type="text" name="gstrate" value="5" id="gstrate<?php echo $rsListData['id']; ?>" style="width: 40px; text-align:center;" onkeyup="calculateGst<?php echo $rsListData['id']; ?>();"/>%
			</td>
			<td style="text-align: center;"><input type="text" name="gstvalue" value=""  id="gstvalue<?php echo $rsListData['id']; ?>" style="width: 120px;"/></td>
			<td><input type="text" name="totalvalue"  id="totalvalue<?php echo $rsListData['id']; ?>" style="width: 120px;"/></td>
		</tr>
		<script>
		function calculateGst<?php echo $rsListData['id']; ?>(){
			var sellingValue = Number('<?php echo $rsListData['sellingValue']; ?>');
			var gstrate = $('#gstrate<?php echo $rsListData['id']; ?>').val();
			gstrate = Number((sellingValue*gstrate)/100);
			gstrate2 = parseFloat(gstrate).toFixed(2);
			//alert(gstrate2);

			$('#gstvalue<?php echo $rsListData['id']; ?>').val(gstrate2);
			var totalvalue = Number(gstrate+sellingValue);
			totalvalue = parseFloat(totalvalue).toFixed(2);
			$('#totalvalue<?php echo $rsListData['id']; ?>').val(totalvalue);

		}
		calculateGst<?php echo $rsListData['id']; ?>();
		</script>

		<?php } ?>
	  <tr style="color:#FFFFFF;">
        <td bgcolor="#333333" colspan="50">&nbsp;</td>
       </tr>
    </tbody></table>
	</div>
	</td>
  </tr>



   <tr>
    <td style="border-bottom:1px solid #000;">&nbsp;</td>
  </tr>

   <tr>
    <td style="border-bottom:1px solid #000;"><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tbody><tr>
        <td><strong>Entered By:</strong></td>
        <td><strong>Created By: </strong></td>
        <td><strong>Authorised By:</strong></td>
        <td><strong>Received By: </strong></td>
      </tr>
    </tbody></table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</tbody></table>
				</div>