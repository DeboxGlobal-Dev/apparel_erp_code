<?php
//$updatepage='1';
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

	 	<?php include "left.php"; ?>
	 	<div class="content-wrapper">



		 	<div class="content pt-0" style="margin-top:20px; overflow:hidden;">
			 	<?php include "top-style.php"; ?>

				<div class="row" >

				<div class="col-xl-12">
				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">Fabric Inspection Input </h6>
							</div>


				<div class="card-body">
				<div class="form-group">

				<div class="row" style="margin-bottom: 15px;">
					 <div class="col-md-2">
					   <div class="form-group">
							<select name="lotno" id="lotno" class="form-control">
							<option value="">Select Lot</option>
							<option value="1">Lot 1</option>
							<option value="1">Lot 2</option>
							<option value="1">Lot 3</option>
							<option value="1">Lot 4</option>
							<option value="1">Lot 5</option>
							</select>

						</div>
					</div>

					<div class="col-md-2">
				      <div class="form-group">
						   <input name="orderqty" type="text" class="validate form-control" id="orderqty" value="" placeholder="Order Qty.">
				      </div>
					</div>

					<div class="col-md-2">
				      <div class="form-group">
						   <input name="orderreceived" type="text" class="validate form-control" id="orderreceived" value="" placeholder="Order Received">
				      </div>
					</div>


				</div>


				<div class="row">








					<table width="100%" border="0" cellpadding="5" cellspacing="0" class="table table-responsive" style="font-size:11px !important;">


  <tr height="61" style="padding: 10px; font-size: 11px; font-weight: 600; background-color: #F8F8F8; margin-top: 10px; position: relative;">
    <td rowspan="2" width="46" align="center"><div align="center"><a onclick="addNewRow(1);" style="color:#0000FF; cursor: pointer;">+Add&nbsp;New</a>
          </th>
    </div></td>
    <td rowspan="2" height="109" width="46"><div align="center">Supplier&nbsp;Roll&nbsp;No</div></td>
    <td rowspan="2" width="34"><div align="center">Shade&nbsp;Lot</div></td>
    <td colspan="2" width="108" align="center"><div align="center">Meterage</div></td>
    <td colspan="2" width="81" align="center"><div align="center">Width&nbsp;(In inches)</div></td>
    <td colspan="2" width="72"><div align="center">Afterwash</div></td>
    <td colspan="2" width="56"><div align="center">Shrinkage&nbsp;A/W</div></td>
    <td colspan="21" width="802" align="center"><div align="center">Defect Type</div></td>
    <td width="42"><div align="center"></div></td>
    <td width="53"><div align="center"></div></td>
    <td rowspan="3" width="87"><div align="center">Remarks</div></td>
  </tr>

  <tr height="48" style="padding: 10px; font-size: 11px; font-weight: 600; background-color: #F8F8F8; margin-top: 10px; position: relative;">
    <td height="48"><div align="center">On&nbsp;Tag</div></td>
    <td><div align="center">Actual</div></td>
    <td width="81"><div align="center">Required</div></td>
    <td width="81"><div align="center">Actual&nbsp;(A)</div></td>
    <td width="72" align="center"><div align="center">L</div></td>
    <td width="72" align="center"><div align="center">W</div></td>
    <td align="center"><div align="center">L</div></td>
    <td width="56" align="center"><div align="center">W</div></td>
    <td colspan="4" width="802" align="center"><div align="center">Weaving</div></td>
    <td colspan="4" width="802" align="center"><div align="center">Stain</div></td>
    <td colspan="2" width="802" align="center"><div align="center">Slub</div></td>
    <td width="802" align="center"><div align="center">Fly/Cont</div></td>
    <td width="802" align="center"><div align="center">Weft&nbsp;Bar</div></td>
    <td width="802" align="center"><div align="center">Patta</div></td>
    <td colspan="2" width="802" align="center"><div align="center">Hole</div></td>
    <td colspan="4" width="802" align="center"><div align="center">Print Defect</div></td>
    <td width="802" align="center"><div align="center">Bowing&nbsp;(B)</div></td>
    <td width="802"><div align="center">Bowing&nbsp;=B/A</div></td>
    <td rowspan="2" width="42"><div align="center">Total Points Found</div></td>
    <td rowspan="2" width="53"><div align="center">Points per Hundred Square Meter</div></td>
  </tr>

   <tr height="32" style="padding: 10px; font-size: 11px; font-weight: 600; background-color: #F8F8F8; margin-top: 10px; position: relative;">
    <td> <div align="center"></div></td>
    <td height="32"><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td width="802"><div align="center">0&nbsp;-3&quot;</div></td>
    <td width="802"><div align="center">3&quot;-6&quot;</div></td>
    <td width="802"><div align="center">6&quot;-9&quot;</div></td>
    <td width="802"><div align="center">Above&nbsp;9&quot;</div></td>
    <td width="802"><div align="center">0&nbsp;-3&quot;</div></td>
    <td width="802"><div align="center">3&quot;-6&quot;</div></td>
    <td width="802"><div align="center">6&quot;-9&quot;</div></td>
    <td width="802"><div align="center">Above&nbsp;9&quot;</div></td>
    <td width="802"><div align="center">0&nbsp;-3&quot;</div></td>
    <td width="802"><div align="center">3&quot;-6&quot;</div></td>
    <td width="802"><div align="center">6&quot;-9&quot;</div></td>
    <td width="802"><div align="center"></div></td>
    <td width="802"><div align="center"></div></td>
    <td width="802"><div align="center">0&nbsp;-1&quot;</div></td>
    <td width="802"><div align="center">Above&nbsp;1&quot;</div></td>
    <td width="802"><div align="center">0&nbsp;-3&quot;</div></td>
    <td width="802"><div align="center">3&quot;-6&quot;</div></td>
    <td width="802"><div align="center">6&quot;-9&quot;</div></td>
    <td width="802"><div align="center">Above&nbsp;9&quot;</div></td>
    <td width="802"><div align="center">Inches</div></td>
    <td width="802"><div align="center">%</div></td>
  </tr>



    <tbody id="addrow"></tbody>


	 <script>
							function addNewRow(id){
							if(id==1){
							$("#addrow").load('loadqualitydata.php?add=1&styleId=<?php echo encode($lastId); ?>&costsheetVersionId=1');
							}else{
							$("#addrow").load('loadqualitydata.php?styleId=<?php echo encode($lastId); ?>');
							}

							}
							addNewRow(0);


							function deleteRow(id){
							var checkyes = confirm('Are your sure you you want to delete?');
							if(checkyes==true){
							$('#addrow').load('loadqualitydata.php?id='+id+'&deletestatus=yes&styleId=<?php echo encode($lastId); ?>');
							}
							}
							</script>
</table>
 </div>
				</div>
				</div>
				  	</div>

</div>
 </div>
 </div>
			 </div>
		 </div>

<style>
table tr td {
    border: 1px solid #ccc;
    padding: 5px 5px !important;
}
</style>


