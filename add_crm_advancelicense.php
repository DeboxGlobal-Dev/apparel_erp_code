<?php
//$updatepage='1';

if($_GET['styleid']!='' && $_GET['editid']!=''){

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

$chaalanLastId = decode($_GET['editid']);

}else{

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

$wheredelete='addedBy="'.$_SESSION['userid'].'" and status=0';
deleteRecord('chaalanMaster',$wheredelete);

$rs1=GetPageRecord('id','chaalanMaster','1 order by id desc');
$lastchaalanid=mysqli_fetch_array($rs1);
$ch=$lastchaalanid['id'];

if($ch==''){
$ch=1;
} else {
$ch=$ch+1;
}

$chaalanno=date('Y-d').'/'.makeQueryId(decode($_GET['styleid'])).'/'.makeQueryId($ch);

$namevalue ='addedBy="'.$_SESSION['userid'].'",chaalanNo="'.$chaalanno.'",dateAdded="'.time().'"';
$chaalanLastId = addlistinggetlastid('chaalanMaster',$namevalue);

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

			<div class="row" style="margin-bottom:10px;">
					<div class="col-xl-12">
						<div class="card mb-0 rounded-bottom-0" style="padding:15px;">
							<div class="col-xl-3">
								<div class="panel panel-flat">
							       <select id="styleId" name="styleId" class="form-control" onChange="selectStyle();">
										<option value="">Select Style</option>
										<?php
										$styleId = decode($_GET['styleid']);
										$rs=GetPageRecord($select,'queryMaster','1 and deletestatus=0 and subject!="" order by id asc');
										while($resultStyle=mysqli_fetch_array($rs)){
										?>
										<option value="<?php echo encode($resultStyle['id']); ?>" <?php if($styleId==$resultStyle['id']){ echo 'selected'; } ?>><?php echo '#'.$resultStyle['styleRefId']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
		     				</div>
						</div>
					</div>
				<script>
				function selectStyle(){
				var styleId = $('#styleId').val()
					if(styleId!=''){
						 window.location.href = '<?php echo $fullurl; ?>showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&styleid='+styleId;
					}
				}
				</script>

				<?php
				if($_GET['styleid']!=''){
					include "top-style.php";
				}
				?>


				<div class="row">
				<div class="col-xl-12">
				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title" style="text-align:center;font-weight:bold;">Information Related to Imported Fabrics</h6>
							</div>

						</div>

</div>



					</div>



						<div id="DataTables_Table_0_wrapper" class=" no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover   no-footer" id="" role="grid" aria-describedby="">
						<thead>
							<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1">Fabric Description</th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
														<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">Total Fabrics being used in the style</th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
														<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">Fabric Composition</th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
														<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending" width="60%">If two fabrics having 100% yarn content of one item ( e.g. 100% Cotton & 100% Polyester) are being used to make the final garment, then the % consumption need to be given ( e.g. 4500 sqmtrs of 100% Cotton Fabric & 5500 sqmtrs of 100% Poly Fabric - so, 45% of 100% Cotton Fabric & 55% of 100% Poly fabric)</th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
														<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">Fabric GSM ( Mention all incase of multiple fabric)</th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
														<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">Quantity of fabric  - in Square Meters. - Sq. Mtrs are calculated by multiplying length with width. There can be a difference between actual width and cuttable width. Quantity of each fabric/s is required</th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
														<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">Weight of all fabric/s  to be used in ONE Garment</th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
														<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">Weight of fabric - TOTAL</th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
													<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">CIF Value of all fabric/s  - per square meter</th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
													<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">ITC Hs Code of fabric/s</th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
													<tr role="row">
							<th class="" aria-sort="">Port of Import</th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>

						</thead>
						<tbody>

							<!--<tr role="row" class="odd">-->
							<!--	<td tabindex="0" class="sorting_1"></td>-->

							<!--	<td></td>-->

							<!--</tr>-->

						</tbody>
					</table></div>
					</div>





						<br>


				<div class="row">
				<div class="col-xl-12">
				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title" style="text-align:center;font-weight:bold;">Information Related to Export Item</h6>
							</div>

						</div>

</div>



					</div>



						<div id="DataTables_Table_0_wrapper" class=" no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover   no-footer" id="" role="grid" aria-describedby="">
						<thead>
							<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1"> Item of Export</th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
														<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">Proposed weight </th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
														<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">Is the weight of Export Item less than 90% of the weight of the fabric used in the garment arrived in 4 above</th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
														<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending" width="60%">Fabric consumption per piece  - in Sq.Mtrs.</th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
														<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">No. of type of Fabrics being used - Is it more than 1</th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
														<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">Compare the Total fabric consumption with Norms Book of Min of Commerce </th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>

											<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending"> Quantity of export item</th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
													<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">FOB Value per Piece - in USD </th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>

						</thead>
						<tbody>

							<!--<tr role="row" class="odd">-->
							<!--	<td tabindex="0" class="sorting_1"></td>-->

							<!--	<td></td>-->

							<!--</tr>-->

						</tbody>
					</table></div>
					</div>



						<br>


							<div class="row">
				<div class="col-xl-12">
				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title" style="text-align:center;font-weight:bold;">Assessment of Benefits - Adv. Authorisation, Special AA, Norms, No Norms			</h6>
							</div>

						</div>

</div>



					</div>



						<div id="DataTables_Table_0_wrapper" class=" no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover   no-footer" id="" role="grid" aria-describedby="">
						<thead>
							<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1"> Description of Item of Export</th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
														<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">Is the item covered under Norm Book of Min of Commerce </th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
														<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">If yes, then imports can be made under Special Adv. Auth Scheme </th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
														<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending" width="60%">If No, then imports can be made under Adv. Auth Scheme</th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
														<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">Compare the Total fabric consumption with Norms Book of Min of Commerce </th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>
														<tr role="row">
							<th class="" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">Time required for Processing Adv. Auth Application- including documentation and Min of Commerce follow up</th>
							<th class="" tabindex="0" aria-controls="DataTables_Table_0"><input style="width:100%" type="text"></th>

							</tr>



						</thead>
						<tbody>

							<!--<tr role="row" class="odd">-->
							<!--	<td tabindex="0" class="sorting_1"></td>-->

							<!--	<td></td>-->

							<!--</tr>-->

						</tbody>
					</table></div>
					</div>

























					           <div class="text-right" style="padding-top: 10px;margin-right:15px;">
	<button type="submit" style="margin:0px;" class="btn btn-primary" onClick="window.location.reload();">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>
</div>















			</div>










				<!-- /dashboard content -->

			</div>
			<!-- /content area -->


		</div>
		<!-- /main content -->

	</div>

