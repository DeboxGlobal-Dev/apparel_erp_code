<?php
include "inc.php";
include "config/logincheck.php";


$factoryId = $_REQUEST['factoryId'];
$line = $_REQUEST['line'];
$fromDate = date('Y-m-d', strtotime($_REQUEST['fromDate']));

$rkdm = GetPageRecord('*', 'linePlanMaster', '1 and factoryId="' . $factoryId . '" and lineId="' . $line . '" and uploadInputDate="' . $fromDate . '" order by id desc');
$styleId = mysqli_fetch_array($rkdm);
$countresult = mysqli_num_rows($rkdm);


$krdm = GetPageRecord('*', 'queryMaster', '1 and id="' . $styleId['styleId'] . '" order by id desc');
$editresultstyle = mysqli_fetch_array($krdm);


$select2 = '*';
$where2 = 'id="' . $editresultstyle['buyerId'] . '"';
$rs2 = GetPageRecord($select2, _BUYER_MASTER_, $where2);
$editresultstyle2 = mysqli_fetch_array($rs2);


?>
<?php if ($countresult > 0) { ?>

	<input name="styleId" type="hidden" id="styleId" value="<?php echo encode($styleId['styleId']); ?>" />


	<div class="card border-left-3 border-left-danger-400 rounded-left-0" style="height: auto; border:0px;">

		<div class="card-body" style="border: 1px solid #ccc; background-color: #f8ffc1;">

			<div class="col-xl-12">

				<h5>Style - <?php echo $editresultstyle['subject']; ?></h5>


				<div class="media styleinfo">

					<div class="media-body">
						<span class="text-muted">Style&nbsp;No.</span>
						<div class="media-title font-weight-semibold"><?php echo '#' . $editresultstyle['styleRefId']; ?></div>
					</div>




					<div class="media-body">
						<span class="text-muted">Season</span>
						<div class="media-title font-weight-semibold"><?php
																		$select1 = 'name,seasonYear';
																		$where1 = 'id="' . $editresultstyle['seasonId'] . '"';
																		$rs1 = GetPageRecord($select1, _SEASON_MASTER_, $where1);
																		$resultlist1 = mysqli_fetch_array($rs1);
																		echo $resultlist1['name'] . '' . $resultlist1['seasonYear'];
																		?></div>

					</div>


					<div class="media-body">
						<span class="text-muted">Received Date</span>
						<div class="media-title font-weight-semibold"><?php echo date('d-m-Y', strtotime($editresultstyle['receivedDate'])); ?></div>

					</div>

					<div class="media-body">
						<span class="text-muted">Buyer</span>
						<div class="media-title font-weight-semibold"><span style="color:#0223c1"><?php echo $editresultstyle2['name']; ?></span></div>
					</div>

					<div class="media-body">
						<span class="text-muted">Short Name </span>
						<div class="media-title font-weight-semibold"><?php echo $editresultstyle2['buyerShortName']; ?></div>
					</div>
					<div class="media-body">
						<span class="text-muted">Buyer Id</span>
						<div class="media-title font-weight-semibold"><?php echo $editresultstyle2['buyerId']; ?></div>

					</div>
					<?php
					$whereline = 'styleId="' . $styleId['styleId'] . '" and factoryId="' . $factoryId . '" and lineId="' . $line . '" and uploadInputDate="' . $fromDate . '"';
					$rsLine = GetPageRecord('*', 'linePlanMaster', $whereline);
					$resultLine = mysqli_fetch_array($rsLine);
					?>
					<div class="media-body">
						<span class="text-muted">Today Planned</span>
						<div class="media-title font-weight-semibold"><?php echo $resultLine['dateWiseLineInput']; ?></div>

					</div>
					<div class="media-body">
						<span class="text-muted">Till Date Planned</span>
						<div class="media-title font-weight-semibold"><?php echo round($resultLine['linewiseefficiency']); ?></div>

					</div>
				</div>

			</div>

		</div>


	</div>
	<?php
	///////////USER MATCH WITH USER SESSION AND MATCHED WITH STYLE WORKFLOW///////////
	$styleFlow=GetPageRecord('*','styleWorkFlowMaster','styleId="'.$styleId['styleId'].'" and userId="'.$_SESSION['userid'].'"');
	$styleFlowData=mysqli_fetch_array($styleFlow);
	$lastSequence = $styleFlowData['sequenceNo']-1;
	$forwardSequence = $styleFlowData['sequenceNo']+1;

	///////////////CHECK USER 1 LESS TO INDENTIFIED RECEIVED FROM//////////////////
	$lastStyleFlow=GetPageRecord('userId,operatorId','styleWorkFlowMaster','styleId="'.$styleId['styleId'].'" and sequenceNo="'.$lastSequence.'"');
	$latStyleFlowData=mysqli_fetch_array($lastStyleFlow);

	///////////////CHECK USER 1 PLUS TO INDENTIFIED TRANSFER TO//////////////////
	$forwardStyleFlow=GetPageRecord('userId,operatorId','styleWorkFlowMaster','styleId="'.$styleId['styleId'].'" and sequenceNo="'.$forwardSequence.'"');
	$forwardStyleFlowData=mysqli_fetch_array($forwardStyleFlow);

	?>
	<script>
		//alert(<?php echo $styleFlowData['checkVal']; ?>);
		<?php if ($styleFlowData['checkVal'] == 1 || $styleFlowData['checkVal'] == "true") { ?>
			parent.$('.hidediv').show();
		<?php }else{ ?>
			parent.$('.hidediv').hide();
		<?php } ?>
	</script>

	<?php

	///////////////CHECK FROM INPUTDATA HOW MUCH LAST SEQUENCE//////////////////
	$where = 'styleId="' . $styleId['styleId'] . '" and factoryId="'.$factoryId.'" and line="'.$line.'"and fromDate="'.$fromDate.'" and sequenceNo="'.$lastSequence.'" order by id desc';
	$resQuerySeq = GetPageRecord('id,SUM(transferQty) AS inStockTill', 'operatorInput', $where);
	$resQuerySeqData = mysqli_fetch_array($resQuerySeq);

	$wherenew = 'styleId="' . $styleId['styleId'] . '" and factoryId="'.$factoryId.'" and line="'.$line.'"and fromDate="'.$fromDate.'" and addedBy="'.$_SESSION['userid'].'" order by id desc';
	$resQuerySeqnew = GetPageRecord('id,SUM(transferQty) AS inStockTill', 'operatorInput', $wherenew);
	$resQuerySeqDatanew = mysqli_fetch_array($resQuerySeqnew);

	///////////////CHECK FROM INPUTDATA HOW MUCH QUANTITY RECEIVE AND TRANSFER through last sequence data//////////////////
	$where2 = 'id="'.$resQuerySeqData['id'].'"';
	$resQuery22 = GetPageRecord('*', 'operatorInput', $where2);
	$resQueryData22 = mysqli_fetch_array($resQuery22);

	?>
	<script>
		const receiveId = "<?php echo $latStyleFlowData['operatorId']; ?>";
		if(receiveId!=''){
			parent.$('.seq1').show();
		}else{
			parent.$('.seq1').hide();
		}

		parent.$('#receivedFromName').val("<?php echo getEmployeeName($latStyleFlowData['operatorId']); ?>");
		parent.$('#receivedFrom').val("<?php echo $latStyleFlowData['operatorId']; ?>");
		parent.$('#transferToName').val("<?php echo getEmployeeName($forwardStyleFlowData['operatorId']); ?>");
		parent.$('#transferTo').val("<?php echo $forwardStyleFlowData['operatorId']; ?>");
		parent.$('#receivedQty').val("<?php echo $resQueryData22['transferQty']; ?>");

		parent.$('#sequenceNo').val("<?php echo $styleFlowData['sequenceNo']; ?>");

		parent.$('#stockInHand').val("<?php if($styleFlowData['sequenceNo']!=1){ echo round($resQuerySeqData['inStockTill'])-$resQuerySeqDatanew['inStockTill']; }else{ echo round($resQuerySeqData['inStockTill']); } ?>");
	</script>
<?php
} else { ?>
	<div style="width: 100%; text-align: center; color: #ff0000; font-size: 20px;"> No Data Available</div>
<?php } ?>