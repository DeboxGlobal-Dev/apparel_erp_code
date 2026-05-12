<?php
if ($_GET['styleid'] != '') {
	$select = '*';
	$where = 'id="' . decode($_GET['styleid']) . '"';
	$rs = GetPageRecord($select, 'queryMaster', $where);
	$editresultstyle = mysqli_fetch_array($rs);
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

	$lastId = $editresultstyle['id'];
}

//================================================================================NEW CODE ===============================================================================

$j = GetPageRecord('*', 'materialCostChatMaster', 'styleId="' . decode($_GET['styleid']) . '"');
while ($chatData = mysqli_fetch_array($j)) {

	$checkCoderef = checkduplicate('styleSubCategoryMaster', 'id="' . $chatData['materialId'] . '" and styleId="' . decode($_GET['styleid']) . '"');
	if ($checkCoderef == "no") {
		deleteRecord('materialCostChatMaster', 'materialId="' . $chatData['materialId'] . '" and styleId="' . decode($_GET['styleid']) . '"');
	}
}

?>
<div class="page-content">


	<?php include "left.php"; ?>

	<div class="content-wrapper">

		<div class="content pt-0" style="margin-top:20px;">

			<?php include "top-style.php" ?>

			<div class="row">

				<div class="col-xl-12">

					<?php
					$i = 0;
					$costsheetVersionId = '0';
					$selectversion = '*';
					$whereversion = 'styleId="' . decode($_GET['styleid']) . '" and versionId in(select defaultcostsheetVersionId from queryMaster where defaultcostsheetVersionId>0 and id="' . decode($_GET['styleid']) . '") order by id desc';
					$rsversion = GetPageRecord($selectversion, 'costsheetVersionMaster', $whereversion);
					while ($resListingVer = mysqli_fetch_array($rsversion)) {
						$costsheetVersionId = $resListingVer['versionId'];
						$i++;
					?>
						<div id="accordion-group<?php echo $resListingVer['id']; ?>" style="margin-bottom: 10px;">


							<div class="card mb-0 rounded-bottom-0">

								<style>
									.abcspecial-class:hover {
										cursor: pointer;
										background-color: #d8ff001f !important;
									}
								</style>
								<div onclick="showfobbydefault<?php echo $costsheetVersionId; ?>();" class="abcspecial-class card-header collapsed" data-toggle="collapse" href="#accordion-item-group<?php echo $resListingVer['id']; ?>" style="background-color:#d8ff001f !important;">
									<h6 class="card-title ">
										<a class="text-default" style="color:#000000;margin-bottom: 10px;">Sourcing Kit</a>

										<a class="text-default collapsed" data-toggle="collapse" href="#accordion-item-group<?php echo $resListingVer['id']; ?>" aria-expanded="false" style="text-align: left; color: #000; font-size: 13px; width: 100%;">-&nbsp;<?php echo date('d M, Y - h:ia', $resListingVer['dateAdded']); ?></a>

										<div id="savecostsheetversion<?php echo $costsheetVersionId; ?>" name="savecostsheetversion<?php echo $costsheetVersionId; ?>" style="display:none;"></div>

										<script>
											function submitcostsheetver<?php echo $costsheetVersionId; ?>(vid) {

												var x = confirm("Are you sure you want to set as default?");
												if (x == true) {
													$('#savecostsheetversion<?php echo $costsheetVersionId; ?>').load("load_costsheet_version.php?styleId=<?php echo $editresultstyle['id']; ?>&costsheetVersionId=<?php echo $costsheetVersionId; ?>&action=setdefault");
												} else {

												}
												location.reload();
											}
										</script>


									</h6>

								</div>

								<div id="accordion-item-group<?php echo $resListingVer['id']; ?>" class="collapse" data-parent="#accordion-group<?php echo $resListingVer['id']; ?>">


									<div class="card-body" style="padding:0px;">
										<div id="collapsible-control-right-group<?php echo $i; ?>" class="collapse" style="display:block;">
											<div class="card-body">



												<div class="tab-content">
													<fieldset class="card-body" style="padding: 10px;">

														<form action="ac.crm" method="post" class="submitstyleform" enctype="multipart/form-data" name="techPackFormV<?php echo $i; ?>" target="techpackiframe<?php echo $i; ?>" id="techPackFormV<?php echo $i; ?>">
															<input type="hidden" name="action2" value="techpackversion" />
															<input type="hidden" name="versionId" value="<?php echo encode($resListingVer['versionId']); ?>" />
															<input type="hidden" name="editId" value="<?php echo encode($lastId); ?>">
															<input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">


															<div class="row" id="load_bom_list<?php echo $costsheetVersionId; ?>"> </div>


															<div class="text-right" style="width: 100%;display: block;margin-top: 25px;">

																<button type="button" onclick="delete_material<?php echo $costsheetVersionId; ?>();delete_material_extra<?php echo $costsheetVersionId; ?>();addfinaldata<?php echo $costsheetVersionId; ?>();" class="btn btn-primary" style="margin:0px;">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>


															</div>



														</form>


														<script>
															function duplicateCostsheet<?php echo $costsheetVersionId; ?>() {
																var r = confirm("Are you sure you want to create duplicate?");
																if (r == true) {
																	$('#cvId').val(1);
																	$("#techPackFormV<?php echo $i; ?>").submit();
																}
															}
														</script>

														<script>
															function load_bom_list_fun<?php echo $costsheetVersionId; ?>() {
																$('#load_bom_list<?php echo $costsheetVersionId; ?>').load("load_bom_list.php?styleId=<?php echo $editresultstyle['id']; ?>&subCategoryId=<?php echo $editresultstyle['subCategoryId']; ?>&page=prototypesample&costsheetVersionId=<?php echo $costsheetVersionId; ?>&loginuserprofileId=<?php echo $loginuserprofileId; ?>");
															}

															load_bom_list_fun<?php echo $costsheetVersionId; ?>();
														</script>
													</fieldset>
												</div>
											</div>


										</div>
									</div>
								</div>
							</div>



						</div>

					<?php } ?>
				</div>



				<div class="col-md-12">
					<div class="card">
						<div class="card-header header-elements-inline">
							<h5 class="card-title">Image Gallery</h5>
							<div class="header-elements">
								<div class="list-icons">
									<button type="button" class="btn btn-primary" onclick="opmodalpop(' Add Image Gallery','modalpop.php?action=protoimagegallery&id=<?php echo encode($lastId); ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" aria-expanded="false" style="margin:0px;"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add&nbsp;Image&nbsp;Gallery</button>
								</div>
							</div>
						</div>



						<?php

						$selectimg = '*';
						$whereimg = 'parentId="' . $lastId . '" and name!="" and galleryType="protoImageGallery"  order by id desc';
						$rsimg = GetPageRecord($selectimg, 'imageGallery', $whereimg);
						$count = mysql_num_rows($rsimg);
						while ($imgresult = mysqli_fetch_array($rsimg)) {
						?>
							<div class="card-body">
								<p class="font-weight-semibold" style="margin-left: 3px; font-size: 16px;"><?php echo $imgresult['name']; ?></p>

								<div style="overflow:hidden; ">
									<?php
									$selectimg1 = '*';
									$whereimg1 = 'galleryParentId="' . $imgresult['id'] . '" and galleryType="protoImageGallery"  order by id desc';
									$rsimg1 = GetPageRecord($selectimg1, 'imageGallery', $whereimg1);
									while ($imgresult1 = mysqli_fetch_array($rsimg1)) {
									?>
										<div class="dz-preview dz-processing dz-error dz-complete dz-image-preview" style="    border: 1px solid #f3f3f3;
    margin: 10px;
    float: left; width: 150px;
    height: 152px;
    box-shadow: 0px 0px 4px #efefef; overflow:hidden;">
											<div class="dz-image" style="position:relative;">
												<img data-dz-thumbnail="" alt="frontladisjacket.jpg" src="images/imageGallary/<?php echo $imgresult1['attachmentImage']; ?>" style="width: 100%; min-height: 150px; max-height: 150px;">

												<style>
													.delete-icon {
														top: 0px;
														width: 100%;
														height: 100%;
														position: absolute;
														background: #0000007a;
														display: none;
													}

													.delete-icon .fa-trash {
														font-size: 20px;
														top: 37%;
														position: absolute;
														left: 36%;
														color: #fff;
														border-radius: 50%;
														border: 1px solid #ccc;
														width: 35px;
														height: 33px;
														padding: 5px 8px;
														cursor: pointer;
													}

													.dz-image:hover .delete-icon {
														display: block;
													}
												</style>

												<script>
													function delete_proto_image(id) {
														var id = id;
														var r = confirm("Are you sure you want to delete this record?");
														if (r == true) {
															$('#deleteprototype').load("deleteprototypeimage.php?id=" + id + "&styleid='<?php echo $imgresult['parentId']; ?>'");
														}
													}
												</script>

												<div id="deleteprototype" style="display:none;"></div>

												<div class="delete-icon">
													<div><i class="fa fa-trash" aria-hidden="true" onclick="delete_proto_image(<?php echo $imgresult1['id']; ?>);"></i></div>
												</div>

											</div>
										</div>
									<?php } ?>

									<div class="dz-preview dz-processing dz-error dz-complete dz-image-preview" style="border: 1px solid #f3f3f3; margin: 10px; float: left; box-shadow: 0px 0px 4px #efefef; border: 1px dashed #08d664;
    ">
										<div class="dz-image" style="width: 148px; height: 150px; text-align: center; font-size: 11px; text-transform: uppercase; color: #17ce1e; font-weight: 600;
">
											<form action="uploadgallery.php" id="dropzone_multiple<?php echo $imgresult['id']; ?>" enctype="multipart/form-data" method="post" style="position:relative; width:150px; height:148px;">
												<input type="hidden" name="parentId" value="<?php echo $imgresult['parentId']; ?>" />
												<input type="hidden" name="galleryParentId" value="<?php echo $imgresult['id']; ?>" />
												<input type="file" name="attachmentImage" style="position:absolute; left:0px; top:0px; width:100%; height:100%; z-index:999;  cursor:pointer;opacity: 0;" onchange="$('#dropzone_multiple<?php echo $imgresult['id']; ?>').submit();" />

												<div style="font-size:38px; text-align:center; padding-top:50px;"><i class="fa fa-plus" aria-hidden="true"></i></div>Add New

											</form>
										</div>

									</div>






								</div>
							</div>



						<?php } ?>

						<?php if ($count == 0) { ?>
							<div style="text-align: center; padding: 10px; font-weight: 500; background-color: #ffffff; text-transform: uppercase; margin-bottom:15px;"><span>No gallery found.</span></div>
						<?php } ?>

					</div>
				</div>

			</div>

			<div class="row">
				<div class="col-xl-12">



					<div class="card">
						<div class="card-header bg-white">
							<h6 class="card-title">Dispatch Detail</h6>
						</div>
						<?php
						if ($_GET['styleid'] != '') {
							//'1 and styleid="' . decode($_GET['styleid']) . '" and module="' . $_GET['module'] . '" and  order by id desc'
							$kk = GetPageRecord('*', 'sampleDispatchMaster', 'id="'.decode($_GET['editId']).'"');
							$sampleDetails = mysqli_fetch_array($kk);
						}
						?>

						<div class="card-body">
							<div class="form-group">
								<form action="ac.crm" method="post" class="submitstyleform" enctype="multipart/form-data" name="popid" target="acf" id="popid">

									<div class="row">
										<div class="col-md-2">
											<div class="form-group">
												<label>Sample Type </label>
												<input name="sampletype" type="text" class="validate form-control" id="sampletype" value="<?php echo $sampleDetails['sampletype']; ?>" />
											</div>
										</div>

										<div class="col-md-1">
											<div class="form-group">
												<label>Color</label>
												<input name="color" type="text" class="validate form-control" id="color" value="<?php echo $sampleDetails['color']; ?>" />
											</div>
										</div>

										<div class="col-md-1">
											<div class="form-group">
												<label>Size</label>
												<input name="size" type="text" class="validate form-control" id="size" value="<?php echo $sampleDetails['size']; ?>" />
											</div>
										</div>

										<div class="col-md-1">
											<div class="form-group">
												<label>Quantity</label>
												<input name="quantity" type="number" class="validate form-control" id="quantity" value="<?php echo $sampleDetails['quantity']; ?>" />
											</div>
										</div>

										<div class="" style="width:8%">
											<div class="form-group">
												<label>Dispatch Date</label>
												<input name="dispatchDate" type="text" class="form-control" id="dispatchDate" value="<?php if ($sampleDetails['dispatchDate'] != '') {
																																			echo date('d-m-Y', strtotime($sampleDetails['dispatchDate']));
																																		} else {
																																			echo date('d-m-Y');
																																		} ?>">
											</div>
										</div>

										<script>
											$(function() {
												$("#dispatchDate").datepicker();
											});
										</script>

										<div class="col-md-1">
											<div class="form-group">
												<label>POD No</label>
												<input name="pod" type="text" class="validate form-control" id="pod" value="<?php echo $sampleDetails['pod']; ?>" />
											</div>
										</div>

										<div class="col-md-1">
											<div class="form-group">
												<label>POD Upload</label>
												<div class="btn-group">
													<input type="file" name="podattachment" id="podattachment" value="" style="display:none;" />
													<input type="hidden" name="podattachmentEdit" id="podattachmentEdit" value="<?php echo $sampleDetails['podattachment']; ?>" />
													<a onclick="focusinputbox();" class="btn btn-primary" style="margin-top: 0px;"><i class="fa fa-upload" aria-hidden="true" style=" color: #fffffff1; font-size: 18px;"></i></a>
													<?php if ($sampleDetails['podattachment'] != '') { ?>
														<a href="<?php echo 'images/' . $sampleDetails['podattachment']; ?>" class="btn btn-warning" target="_blank"><i class="fa fa-download" aria-hidden="true" style=" color: #fffffff1;   font-size: 18px;"></i></a>
													<?php } ?>
												</div>

											</div>
										</div>

										<script>
											function focusinputbox() {
												$('#podattachment').click();
											}
										</script>

										<div class="col-md-4">
											<div class="form-group">
												<label>Remarks</label>
												<input name="remarks" type="text" class="validate form-control" id="remarks" value="<?php echo $sampleDetails['remarks']; ?>" />
											</div>
										</div>

										<input type="hidden" name="styleId" value="<?php echo $_GET['styleid']; ?>" />
										<input type="hidden" name="module" value="<?php echo $_GET['module']; ?>" />
										<input type="hidden" name="action" value="dispatchdetailsave" />
										<input type="hidden" name="editId" value="<?php echo $_GET['editId']; ?>" />
										<div class="text-right" style="width: 100%; float: right; padding: 15px;">
											<button type="submit" class="btn btn-primary" style="margin:0px;">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>
										</div>


									</div>

								</form>


							</div>
						</div>



						<div class="col-md-12">
							<div class="row" style=" width:100%; margin:0px; padding:0px;">
								<style>
									.wip1 tr td {
										padding: 7px;
										border: 1px solid #ccc;
									}

									.wip2 tr td {
										padding: 7px;
										border-top: 0px;
										border: 1px solid #ccc;
									}
								</style>
								<div style="width:100% ;display:block;">
									<div class="first-div" style="width:100% ;display:block; float:left;">
										<table class="table erptab table-hover" style="width:100%">
											<tbody>
												<tr style="background-color:#ffffcc;">
													<td>
														<div style="text-transform:capitalize;"><b>Sr#</b></div>
													</td>
													<td>
														<div style="text-transform:capitalize;"><b>Sample Type</b></div>
													</td>
													<td>
														<div style="text-transform:capitalize;"><b>Color</b></div>
													</td>
													<td>
														<div style="text-transform:capitalize;"><b>Size</b></div>
													</td>
													<td>
														<div style="text-transform:capitalize;"><b>Quantity</b></div>
													</td>
													<td>
														<div style="text-transform:capitalize;"><b>Dispatch Date</b></div>
													</td>
													<td>
														<div style="text-transform:capitalize;"><b>POD No.</b></div>
													</td>
													<td>
														<div style="text-transform:capitalize;"><b>POD Upload</b></div>
													</td>
													<td>
														<div style="text-transform:capitalize;"><b>Remark</b></div>
													</td>
													<td>
														<div style="text-transform:capitalize;"><b>Added Date</b></div>
													</td>
													<td>
														<div style="text-transform:capitalize;"><b>Action</b></div>
													</td>
												</tr>
												<?php
												$sr=1;
												$kk2 = GetPageRecord('*', 'sampleDispatchMaster', '1 and styleid="' . decode($_GET['styleid']) . '" and module="' . $_GET['module'] . '" order by id desc');
												while($sampleDetails2 = mysqli_fetch_array($kk2)){
												?>
												<tr>
													<td><?php echo $sr; ?></td>
													<td><?php echo $sampleDetails2['sampletype']; ?></td>
													<td><?php echo $sampleDetails2['color']; ?></td>
													<td><?php echo $sampleDetails2['size']; ?></td>
													<td><?php echo $sampleDetails2['quantity']; ?></td>
													<td><?php echo date('d-m-Y',strtotime($sampleDetails2['dispatchDate'])); ?></td>
													<td><?php echo $sampleDetails2['pod']; ?></td>
													<td><?php if ($sampleDetails2['podattachment'] != '') { ?>
														<a href="<?php echo 'images/' . $sampleDetails2['podattachment']; ?>" class="btn btn-warning" target="_blank"><i class="fa fa-download" aria-hidden="true" style=" color: #fffffff1;   font-size: 18px;"></i></a>
													<?php } ?></td>
													<td><?php echo $sampleDetails2['remarks']; ?></td>
													<td><?php echo date('d-m-Y h:i:sa',$sampleDetails2['dateAdded']); ?></td>
													<td align="center" class="">
														<div class="btn-group">
															<a href="showpage.crm?module=prototypesample&add=yes&styleid=<?php echo $_GET['styleid']; ?>&editId=<?php echo encode($sampleDetails2['id']); ?>" class="btn btn-primary" style="padding:5px;"><i class="fa fa-pencil" aria-hidden="true" style=" color: #fffffff1;   font-size: 16px; "></i>
															</a>
														</div>
													</td>
												</tr>
												<?php $sr++; } ?>
											</tbody>
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
</div>
</div>
<style>
	.card-header header-elements-inline {
		margin-bottom: 15px !important;
	}
</style>