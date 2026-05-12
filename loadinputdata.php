
<?php
include "inc.php";
include "config/logincheck.php";

if($_REQUEST['action']=="loadinputdata"){
	$styleId=decode($_REQUEST['styleId']);
	$fromDate=date('Y-m-d',strtotime($_REQUEST['fromDate']));
	$factoryId=$_REQUEST['factoryId'];
	$line=$_REQUEST['line'];
	$editid=$_REQUEST['editid'];
	$status=$_REQUEST['status'];

	$stockInHand=$_REQUEST['stockInHand'];
	$receivedFrom=$_REQUEST['receivedFrom'];
	$receivedQty=$_REQUEST['receivedQty'];
	$transferTo=$_REQUEST['transferTo'];
	$sequenceNo=$_REQUEST['sequenceNo'];
	$fromSerial=$_REQUEST['fromSerial'];
	$toSerial=$_REQUEST['toSerial'];
	$transferQty=$_REQUEST['transferQty'];

	///////////USER MATCH WITH USER SESSION AND MATCHED WITH STYLE WORKFLOW///////////
	$styleFlow=GetPageRecord('*','styleWorkFlowMaster','styleId="'.$styleId.'" and userId="'.$_SESSION['userid'].'"');
	$styleFlowData=mysqli_fetch_array($styleFlow);
	$lastSequence = $styleFlowData['sequenceNo']-1;
	$forwardSequence = $styleFlowData['sequenceNo']+1;


	if($editid!=''){
		$namevalue ='status="'.$status.'"';
		$where='id="'.$editid.'"';
		$update = updatelisting('operatorInput',$namevalue,$where);
	}else{
		$namevalue ='fromDate="'.$fromDate.'",factoryId="'.$factoryId.'",line="'.$line.'",stockInHand="'.$stockInHand.'",receivedFrom="'.$receivedFrom.'",receivedQty="'.$receivedQty.'",transferTo="'.$transferTo.'",fromSerial="'.$fromSerial.'",toSerial="'.$toSerial.'",transferQty="'.$transferQty.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",styleId="'.$styleId.'",sequenceNo="'.$sequenceNo.'"';
		if($styleId!='' && $stockInHand!='' && $transferQty!='' && $transferTo!=''){
			$lastid = addlistinggetlastid('operatorInput',$namevalue);

			//////Less sent quantity from stock in hand//////////
			$wherez = 'styleId="' . $styleId . '" and factoryId="'.$factoryId.'" and line="'.$line.'"and fromDate="'.$fromDate.'" and sequenceNo="'.$styleFlowData['sequenceNo'].'" order by id desc';
			$resQuerySeq = GetPageRecord('id,SUM(transferQty) AS sentStock', 'operatorInput', $wherez);
			$resQuerySeqData = mysqli_fetch_array($resQuerySeq);
			$inS = $stockInHand-$resQuerySeqData['sentStock'];
			////update in stock
			$namevalue ='stockInHand="'.$inS.'"';
			$where='id="'.$lastid.'"';
			//$update = updatelisting('operatorInput',$namevalue,$where);

		}
	}


$wherekrdm = '1 and styleId="'.$styleId.'" and factoryId="'.$factoryId.'" and line="'.$line.'"and fromDate="'.$fromDate.'" and (addedBy="'.$_SESSION['userid'].'" OR addedBy in (select id from userMaster where empId="'.$receivedFrom.'")) order by id desc';
$krdm=GetPageRecord('*','operatorInput',$wherekrdm);
while($getdatalist=mysqli_fetch_array($krdm)){
	?>
	<tr>
		<td><?php echo $getdatalist['sequenceNo']; ?></td>
		<!-- <td><?php echo $getdatalist['stockInHand']; ?></td> -->
		<td><?php echo getEmployeeName($getdatalist['receivedFrom']); ?></td>
		<td><?php echo $getdatalist['receivedQty']; ?></td>
		<td><?php echo getEmployeeName($getdatalist['transferTo']); ?></td>
		<td><?php echo $getdatalist['fromSerial']; ?></td>
		<td><?php echo $getdatalist['toSerial']; ?></td>
		<td><?php echo $getdatalist['transferQty']; ?></td>
		<td>
			<?php if($getdatalist['addedBy']==$_SESSION['userid']){ ?>
				<?php echo ($getdatalist['status']=='0') ? "Pending" : "Sent(Accepted)"; ?>
			<?php }else{ ?>
				<?php if($getdatalist['status']=='0'){ ?>
				<input type="button" id="accBtn" value="Accept" onclick="updatesaveinput('<?php echo $getdatalist['id']; ?>');" />
				<!-- <input type="button" id="modifyBtn" value="Modify"  onclick="updatemodifyinput('<?php echo $getdatalist['id']; ?>');" /> -->
				<?php }else{ echo "Accepted"; } ?>
			<?php } ?>
		</td>
		<td><?php echo date("d-M-Y",$getdatalist['dateAdded']); ?><br/><?php echo date("h:i:sa",$getdatalist['dateAdded']); ?></td>
	</tr>
<?php
}

///////////////CHECK FROM INPUTDATA HOW MUCH LAST SEQUENCE//////////////////
$where = 'styleId="' . $styleId . '" and factoryId="'.$factoryId.'" and line="'.$line.'"and fromDate="'.$fromDate.'" and sequenceNo="'.$lastSequence.'" order by id desc';
$resQuerySeq = GetPageRecord('id,SUM(transferQty) AS inStockTill', 'operatorInput', $where);
$resQuerySeqData = mysqli_fetch_array($resQuerySeq);

$wherenew = 'styleId="' . $styleId . '" and factoryId="'.$factoryId.'" and line="'.$line.'"and fromDate="'.$fromDate.'" and addedBy="'.$_SESSION['userid'].'" order by id desc';
$resQuerySeqnew = GetPageRecord('id,SUM(transferQty) AS inStockTill', 'operatorInput', $wherenew);
$resQuerySeqDatanew = mysqli_fetch_array($resQuerySeqnew);
if($styleFlowData['sequenceNo']!=1){
	$stock = round($resQuerySeqData['inStockTill'])-$resQuerySeqDatanew['inStockTill'];
}else{
	$stock = round($resQuerySeqData['inStockTill']);
}
?>
<script>
parent.$('#stockInHand').val("<?php echo $stock; ?>");

function updatesaveinput(id){
	$("#accBtn").val('Wait..');
	//let message  = confirm("Are you sure you want to approve");
	parent.$("#status").val(1);
	parent.$("#editid").val(id);
	parent.$("#btnclick").click();
}

function updatemodifyinput(id){
	$("#modifyBtn").val('Wait..');

	parent.$("#status").val(0);
	parent.$("#editid").val(id);
	parent.$("#btnclick").click();
}

</script>
<?php
}

if($_REQUEST['action']=="loaddefectdata"){

$styleId=decode($_REQUEST['styleId']);
$defectEditid=$_REQUEST['defectEditid'];
$defectStatus=$_REQUEST['defectStatus'];

if($defectEditid!='' && $defectStatus!=''){
	$defectnamevalue ='status="'.$defectStatus.'"';
	$defectwhere='id="'.$defectEditid.'"';
	updatelisting('defectDetails',$defectnamevalue,$defectwhere);
}


$dNo=1;
$wherekrdm2 = ' styleId="'.$styleId.'" and (status=0 or status=1) and (operatorId in (select empId from userMaster where id="'.$_SESSION['userid'].'") or addedBy="'.$_SESSION['userid'].'")';
$krdm2=GetPageRecord('*','defectDetails',$wherekrdm2);
while($getdatalist2=mysqli_fetch_array($krdm2)){
?>
<tr>
	<td><?php echo $getdatalist2['orderWiseNo']; ?></td>
	<td><?php echo $getdatalist2['ticketNo']; ?></td>
	<td><?php echo $getdatalist2['color']; ?></td>
	<td><?php echo $getdatalist2['size']; ?></td>
	<td style="font-weight:700">

	<?php
	$defect = explode(',',$getdatalist2['remark']);
	$defectData = "";
	foreach($defect as $defectid){
		$defectData.= getColumnName("inspectionDefectMaster",$defectid).',';
	}
	echo rtrim($defectData,',');
	?>
	</td>
	<td><?php echo date("d-M-Y",$getdatalist2['dateAdded']); ?> <?php echo date("h:i:sa",$getdatalist2['dateAdded']); ?></td>
	<td><?php if($getdatalist2['status']==0){ ?><input type="button" id="alterBtn" value="Alter" onclick="updatedefectdata('<?php echo $getdatalist2['id']; ?>');" /><?php }else{ ?>Altered<?php } ?></td>
</tr>
<?php $dNo++; }
if($dNo==1){
?>
<tr>
	<td colspan="7" align="center">No Defect Data</td>
</tr>
<?php } ?>
<script>
function updatedefectdata(id){
	$("#alterBtn").val('Wait..');

	parent.$("#defectStatus").val(1);
	parent.$("#defectEditid").val(id);
	parent.$("#btnclick").click();
}
</script>
<?php
}
?>



