<?php
if ($loginuserprofileId == 1 || $loginuserprofileId == 93) {

	$wheresearchassign = ' 1 and ';
} else {

	if ($loginuserprofileId == 92) {

		$wheresearchassign = ' 1 and finalstatus="2" and assignTo in (select id from ' . _USER_MASTER_ . ' where empId in (select id from employeeMaster where reportingTo=' . $_SESSION['empid'] . ')) or assignTo="' . $_SESSION['userid'] . '" and ';
	} else {

		$wheresearchassign = ' ( id in (select styleId from styleAssignmentMaster where assignTo="' . $_SESSION['userid'] . '" and styleAssignTo=0))';

		$wheresearchassign = ' ' . $wheresearchassign . ' and ';
	}
}
if ($_GET['styleid'] != '') {
	$select = "*";
	$where = 'styleId="' . decode($_GET['styleid']) . '"';
	$rs = GetPageRecord($select, 'buyerPurchaseOrderMaster', $where);
	$result = mysqli_fetch_array($rs);
}

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
?>
<div class="page-content">
	<div class="content-wrapper">
		<div class="content pt-0" style="margin-top:20px;">
			<?php include "top-style.php" ?>
			<div class="row">
				<div class="col-xl-12">
					<div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
						<div class="col-xl-9">
							<h5 class="card-title"><?php echo $pageName; ?></h5>
						</div>
						<div class="col-xl-3" style="padding-right: 0px;">
							<div class="btn-group justify-content-center" style="float:right;"> </div>
						</div>
					</div>
					<div class="card">

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
											<tr style="background-color:#ffffcc;">
												<td>
													<div style="text-transform:capitalize;"><b>Sr#</b></div>
												</td>
												<td>
													<div style="text-transform:capitalize;"><b>Total Check</b></div>
												</td>
												<td>
													<div style="text-transform:capitalize;"><b>Pass</b></div>
												</td>
												<td>
													<div style="text-transform:capitalize;"><b>Fail</b></div>
												</td>
												<td>
													<div style="text-transform:capitalize;"><b>Transfer To</b></div>
												</td>
												<td>
													<div style="text-transform:capitalize;"><b>Transfer Quantity</b></div>
												</td>
												<td>
													<div style="text-transform:capitalize;"><b>Alter(%)</b></div>
												</td>
												<td>
													<div style="text-transform:capitalize;"><b>Factory</b></div>
												</td>
												<td>
													<div style="text-transform:capitalize;"><b>Line</b></div>
												</td>
												<td>
													<div style="text-transform:capitalize;"><b>Date</b></div>
												</td>
											</tr>
											<?php
											$count = 1;
											$rrrr = GetPageRecord('*', 'operatorInputCheck', '1  and styleId="' . decode($_GET['styleid']) . '"');
											while ($operationData = mysqli_fetch_array($rrrr)) {
											?>
												<tbody>
													<tr>
														<td><?php echo $count; ?></td>
														<td>
															<div id="togglepo<?php echo $count; ?>" style="color:#0000FF; cursor:pointer;"><strong><?php echo $operationData['totalCheck']; ?></strong></div>
														</td>
														<td><?php echo $operationData['pass']; ?></td>
														<td><?php echo $operationData['fail']; ?></td>
														<td><?php echo getEmployeeName($operationData['transferTo']); ?></td>
														<td><?php echo $operationData['transferQty']; ?></td>
														<td><?php echo $altPer = round($operationData['fail']/$operationData['totalCheck']*100,2); ?></td>
														<td><?php
															$km = GetPageRecord('*', 'factoryMaster', 'id="' . $operationData['factoryId'] . '"');
															$factotyData = mysqli_fetch_array($km);
															echo $factotyData['name']; ?></td>
														<td><?php
															$lo = GetPageRecord('*', 'factoryLineMaster', 'id="' . $operationData['line'] . '"');
															$lineName = mysqli_fetch_array($lo);

															echo $lineName['lineName']; ?></td>
														<td><?php echo date('d-M-Y', $operationData['dateAdded']); ?><br><?php echo date('h:i:sA', $operationData['dateAdded']); ?></td>
													</tr>
												</tbody>
												<tbody id="thisbodyShow<?php echo $count; ?>" style="display:none;text-align: center;">
													<tr style="background-color:#a2a2a2; color:#FFFFFF;">
														<td colspan="2">Order Wise NO</td>
														<td colspan="2">Ticketing No</td>
														<td colspan="2">Color</td>
														<td colspan="2">Size</td>
														<td>Remark</td>
													</tr>
													<?php
													$total = 1;
													$newData = '';
													$newData = GetPageRecord('*', 'defectDetails', '1 and operatorInputId="' . $operationData['id'] . '" and styleId="' . decode($_GET['styleid']) . '"');
													while ($rrData = mysqli_fetch_array($newData)) {
													?>
														<tr style="background-color: #fdffe0;">
															<td colspan="2"><?php echo $rrData['orderWiseNo']; ?></td>
															<td colspan="2"><?php echo $rrData['ticketNo']; ?></td>
															<td colspan="2"><?php echo $rrData['color']; ?></td>
															<td colspan="2"><?php echo $rrData['size']; ?></td>
															<td style="font-weight:700">
																<?php
																$defect = explode(',', $rrData['remark']);
																$defectData = "";
																foreach ($defect as $defectid) {
																	$defectData .= getColumnName("inspectionDefectMaster", $defectid) . ',';
																}
																echo rtrim($defectData, ',');
																?>
															</td>
														</tr>
													<?php $total++;
													}
													if ($total == 1) {
													?>
														<tr style="background-color: #fdffe0;">
															<td colspan="11">
																<div align="center">No Record Found</div>
															</td>
														</tr>
													<?php } ?>
												</tbody>
												<script>
													$("#togglepo<?php echo $count; ?>").click(function() {
														$("#thisbodyShow<?php echo $count; ?>").toggle();
													});
												</script>
											<?php $count++;
											} ?>
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