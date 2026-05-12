<?php




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

$selectcountmaterial='*';
$wherecountmaterial='styleId="'.decode($_GET['styleid']).'"';
$rscountmaterial=GetPageRecord($selectcountmaterial,'styleSubCategoryMaster',$wherecountmaterial);
$rescountmaterial=mysql_num_rows($rscountmaterial);

if($rescountmaterial==0){
$namevalue1 ='name="MAIN FABRIC",materialid=18,materialType=1,subCategoryId="'.$editresultstyle['subCategoryId'].'",styleId="'.decode($_GET['styleid']).'",sr=1,costsheetVersionId=1';
$lastId1 = addlistinggetlastid('styleSubCategoryMaster',$namevalue1);

$namevalue2 ='name="LABELS",materialid=14,materialType=2,subCategoryId="'.$editresultstyle['subCategoryId'].'",styleId="'.decode($_GET['styleid']).'",sr=2,costsheetVersionId=1';
$lastId2 = addlistinggetlastid('styleSubCategoryMaster',$namevalue2);

$namevalue3 ='name="TAPES",materialid=47,materialType=3,subCategoryId="'.$editresultstyle['subCategoryId'].'",styleId="'.decode($_GET['styleid']).'",sr=3,costsheetVersionId=1';
$lastId3 = addlistinggetlastid('styleSubCategoryMaster',$namevalue3);
}


}

?>
	<div class="page-content">



		<!-- Main content -->
		<div class="content-wrapper">
		<!---Save Alert Notification---->
		<?php include "savealert.php"; ?>


			<!-- Content area -->
			<div class="content pt-0" style="margin-top:20px;">




				<!-- Dashboard content -->
				<!---style information section--->
				<?php include "top-style.php"; ?>
				<!---style information section end--->


			<div class="row">
				<div class="col-xl-12">
					<form action="ac.crm" method="post" class="submitstyleform" enctype="multipart/form-data" name="popid" target="acf" id="popid">
					<!--Dashboard content-->
					<div class="row">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">BRAND NAME</h6>
							</div>
							<div class="card-body">
								<div class="form-group">
									<div class="row">
										 <div class="col-md-3">
											<div class="form-group">
												<label>RD No.</label>
												<input name="rdNo" type="text" class="form-control" id="rdNo" value=""   maxlength="200">
											</div>
										</div>

										<div class="col-md-3" >
											<div class="form-group">
												<label>Agent/Mill:</label>
												<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Season</label>
												<select id="seasonId" name="seasonId" class="validate form-control" displayname="Season">
												 <option value="">Select</option>
												 <?php
												$select='';
												$where='';
												$rs='';
												$select='*';
												$where=' deletestatus=0 and status=1 order by name asc';
												$rs=GetPageRecord($select,_SEASON_MASTER_,$where);
												while($resListing=mysqli_fetch_array($rs)){
												?>
												<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['seasonId']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
												<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Fabric&nbsp;Id</label>
												<select id="categoryId" name="categoryId" class="validate form-control" displayname="Category" onchange="selectsubcategory();">
												 <option value="">Select</option>
												 <?php
												$select='';
												$where='';
												$rs='';
												$select='*';
												$where=' deletestatus=0 and status=1 order by name asc';
												$rs=GetPageRecord($select,_CATEGORY_MASTER_,$where);
												while($resListing=mysqli_fetch_array($rs)){
												?>
												<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['categoryId']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
												<?php } ?>
												</select>
											</div>
										</div>

									</div>
									<div class="row" style="margin-top:20px;">
										<div class="col-md-3">
											<div class="form-group">
												<label>Fabric&nbsp;Name</label>
												<select id="" name="" class="validate form-control" displayname="Sub Category">
													<option value="">Select</option>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Mill&nbsp;Article :</label>
												<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Cut&nbsp;Width&nbsp;/&nbsp;Calculated&nbsp;Weight</label>
												<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Country&nbsp;of&nbsp;Origin</label>
												<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>
									</div>
									<div class="row" style="margin-top:20px">
										<div class="col-md-3">
											<div class="form-group">
												<label>Finish:</label>
												<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Content:</label>
												<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Price</label>
												<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Construction&nbsp;Type</label>
												<input name="" type="number" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>
									</div>

									<div class="row" style="margin-top:20px">
										<div class="col-md-3">
											<div class="form-group">
												<label>Lead Time</label>
												<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Yarn&nbsp;Size&nbsp;&&nbsp;Density </label>
												<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Minimum&nbsp;/&nbsp;Color</label>
												<input name="" type="number" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Minimum&nbsp;/&nbsp;Order </label>
												<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>
									</div>
									<div class="row" style="margin-top:20px">
										<div class="col-md-3">
											<div class="form-group">
												<label>Capacity</label>
												<input name="" type="text" class="form-control" id="" value="">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Suggested&nbsp;Care&nbsp;Instructions</label>
												<input name="" type="number" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Comments&nbsp;/&nbsp;Testing&nbsp;Information</label>
												<input name="" type="text" class="form-control" id="" value="">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">UNWASHED FINISH SPECIFICATIONS</h6>
							</div>
							<div class="card-body">
								<div class="form-group">
									<div class="row">
										 <div class="col-md-4">
											<div class="">
											<table width="100%" border="1" cellspacing="2" cellpadding="2" style="border:1px solid #ccc;" class="table">
											  <tr style="background-color: #fffdbd;">
												<th colspan="3" style="text-align: center;">CUTTABLE WIDTH</th>
												<th>INCHES</th>
											  </tr>
											  <tr style="background-color: #dcffed;">
												<th>&nbsp;</th>
												<th>MIN</th>
												<th>MAX</th>
												<th>&nbsp;</th>
											  </tr>
											 <tr>
												<td>WEIGHT</td>
												<td>-</td>
												<td>-</td>
												<td>-</td>
											  </tr>
											  <tr>
												<td>Ends</td>
												<td>-</td>
												<td>-</td>
												<td>-</td>
											  </tr>
											  <tr>
												<td>Picks</td>
												<td>-</td>
												<td>-</td>
												<td>-</td>
											  </tr>

											</table>
											</div>
										</div>

										<div class="col-md-8">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Tear (Warp/Weft)</label>
														<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Tensile (Warp/Weft)</label>
														<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Seam Slippage</label>
														<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
													</div>
												</div>
											</div>
											<div class="row" style="margin-top:20px;">
												<div class="col-md-4">
													<div class="form-group">
														<label>Seam Strength</label>
														<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Surface Finish (YES/NO)</label>
														<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Surface Finish Type</label>
														<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
													</div>
												</div>
											</div>
											<div class="row" style="margin-top:20px;">
												<div class="col-md-4">
													<div class="form-group">
														<label>Performance Finish</label>
														<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Test&nbsp;Method&nbsp;& Anticipated&nbsp;Result</label>
														<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
													</div>
												</div>

											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">WASHED FINISH SPECIFICATIONS</h6>
							</div>
							<div class="card-body">
								<div class="form-group">
									 <div class="row">
										 <div class="col-md-4">

											<table width="100%" border="1" cellspacing="2" cellpadding="2" style="border:1px solid #ccc;" class="table">
											  <tr style="background-color: #fffdbd;">
												<th colspan="3" style="text-align: center;">CUTTABLE WIDTH</th>
												<th>INCHES</th>
											  </tr>
											  <tr style="background-color: #dcffed;">
												<th>&nbsp;</th>
												<th>MIN</th>
												<th>MAX</th>
												<th>&nbsp;</th>
											  </tr>
											 <tr>
												<td>WEIGHT</td>
												<td>-</td>
												<td>-</td>
												<td>-</td>
											  </tr>
											  <tr>
												<td>Ends</td>
												<td>-</td>
												<td>-</td>
												<td>-</td>
											  </tr>
											  <tr>
												<td>Picks</td>
												<td>-</td>
												<td>-</td>
												<td>-</td>
											  </tr>

											</table>

										</div>

										<div class="col-md-8">
											<div class="row">
												<div class="col-md-12">
													<div style="padding:6px; background-color:#fffdbd; font-weight:600; color:#151414; text-align:center; border: 1px solid #ccc;">TYPE OF WASH</div>
												</div>

											</div>
											<div class="row" style="margin-top:10px;">
												<div class="col-md-12">
													<div class="form-group">

														<textarea class="form-control" name="" rows="3"></textarea>
													</div>
												</div>
												<div class="col-md-12" style="margin-top:10px;">
													<div class="form-group">
													<label><strong>Comment:</strong></label>
														<textarea class="form-control" name="" rows="3"></textarea>
													</div>
												</div>
											</div>


										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">COSTING & LEADTIME INFORMATION</h6>
							</div>
							<div class="card-body">
								<div class="form-group">
									<div class="row">
										 <div class="col-md-12">
											<table width="100%" border="1" cellspacing="2" cellpadding="2" style="border:1px solid #ccc;" class="table">
											  <tr style="background-color: #fffdbd;">
											 	<th>&nbsp;</th>
												<th colspan="2" style="text-align: center;">Costing per yard in US$</th>
												<th colspan="2" style="text-align: center;">Minimums</th>
												<th>Capacity</th>
											  </tr>
											  <tr style="background-color: #dcffed;">
												<th>&nbsp;</th>
												<th>Base Price/YD</th>
												<th>Price Including Testing/Color Standards</th>
												<th>MOQ/MCQ</th>
												<th>MOQ notes</th>
												<th>Volume/ Month</th>
											  </tr>
											 <tr>
												<td>Solid</td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
											  </tr>
											  <tr>
												<td>Yarn Dye/ EMB</td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
											  </tr>
											  <tr>
												<td>Heather YD</td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
											  </tr>
											   <tr>
												<td>Prints</td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
											  </tr>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">BULK LEADTIME</h6>
							</div>
							<div class="card-body">
								<div class="form-group">
									<div class="row">
										 <div class="col-md-12">
											<table width="100%" border="1" cellspacing="2" cellpadding="2" style="border:1px solid #ccc;" class="table">
											  <tr style="background-color: #dcffed;">
												<th>Solid</th>
												<th>Print</th>
												<th>Heather</th>
												<th>Y/D</th>
											  </tr>
											 <tr>
												<td>Yarn Leadtime</td>
												<td><input type="search" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
											 </tr>
											  <tr>
												<td>Weaving Leadtime</td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
											 </tr>
											  <tr>
												<td>Dyeing/Finishing Leadtime</td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
											  </tr>
											  <tr>
												<td>Printing Leadtime</td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
											  </tr>
											  <tr>
												<td>Testing/&nbsp;Shipping&nbsp;(Test)&nbsp;Leadtime:</td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
											  </tr>
											  <tr>
												<td>Total&nbsp;Fabric&nbsp;Leadtime:</td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
												<td><input type="text" name="" class="form-control" /></td>
											  </tr>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">Price Info *US Dollar*</h6>
							</div>
							<div class="card-body">
								<div class="form-group">
									<div class="row">
										 <div class="col-md-3">
											<div class="form-group">
												<label>Price Per UOM FOB: (Yard,Meter)</label>
												<input name="rdNo" type="text" class="form-control" id="rdNo" value=""   maxlength="200">
											</div>
										</div>

										<div class="col-md-3" >
											<div class="form-group">
												<label>Price Per UOM FOB: (Yard,Meter)</label>
												<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label>Price Validity(Should be valid for 6 months)</label>
												<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>FOB: for solid</label>
												<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>
									</div>
									<div class="row" style="margin-top:20px;">

										<div class="col-md-3">
											<div class="form-group">
												<label>FOB: for Print</label>
												<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>CIF Asia</label>
												<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">SAMPLE YARDAGE INFO</h6>
							</div>
							<div class="card-body">
								<div class="form-group">
									<div class="row">
										 <div class="col-md-4">
											<div class="form-group">
												<label>Sample Yardage Leadtime</label>
												<input name="rdNo" type="text" class="form-control" id="rdNo" value=""   maxlength="200">
											</div>
										</div>

										<div class="col-md-4" >
											<div class="form-group">
												<label>Sample Yardage Minium</label>
												<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label>Surcharge If Required</label>
												<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">BULK FABRIC INFO</h6>
							</div>
							<div class="card-body">
								<div class="form-group">
									<div class="row">
										 <div class="col-md-4">
											<div class="form-group">
												<label>Sample Yardage Leadtime</label>
												<input name="rdNo" type="text" class="form-control" id="rdNo" value=""   maxlength="200">
											</div>
										</div>

										<div class="col-md-4" >
											<div class="form-group">
												<label>Sample Yardage Minium</label>
												<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label>Surcharge If Required</label>
												<input name="" type="text" class="form-control" id="" value=""   maxlength="200">
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
					</form>
				</div>
				<!-- /dashboard content -->
			</div>
			<!-- /content area -->



		</div>
		<!-- /main content -->

	</div>


