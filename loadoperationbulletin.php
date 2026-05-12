<?php
include "inc.php";

 $costsheetVersionId=$_REQUEST['costsheetVersionId'];


 if($_REQUEST['add']==1){
$namevalueadd = 'styleId="'.decode($_REQUEST['styleId']).'",costsheetVersionId="'.$costsheetVersionId.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",status=1';
addlistinggetlastid('operationbulletinamaster',$namevalueadd);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
deleteRecord('operationbulletinamaster','id="'.$_REQUEST['id'].'" and costsheetVersionId="'.$costsheetVersionId.'"');
}


$sNo2 = 0;
$totalsam=0;
$totaloprreq=0;
$select='';
$where='';
$rs='';
$select='*';
$where=' styleId="'.decode($_REQUEST['styleId']).'" and costsheetVersionId="'.$costsheetVersionId.'" and status=1 and deletestatus=0 order by id asc';
$rs=GetPageRecord($select,'operationbulletinamaster',$where);
$counttotal = mysqli_num_rows($rs);
while($resListing1=mysqli_fetch_array($rs)){

$sNo2++;
$totalsam=$totalsam+$resListing1['sam'];
$totaloprreq=$totaloprreq+$resListing1['oprreq'];
$totalroundoff=$totalroundoff+$resListing1['roundoff'];

?>


       <tr class="card-body">
		<td align="center"><i class="fa fa-trash" style="font-size: 20px; color:#FF0000; cursor:pointer;" onclick="deleteRow<?php echo $costsheetVersionId; ?>('<?php echo $resListing1['id']; ?>');"></i></td>

		<td width="2%" align="center"><?php echo $sNo2; ?></td>

		<td width="19%" align="center">
		<select name="particular" id="particular<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>" style="width:250px; text-align:left;padding: 3px;" onchange="loadmachineData<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>();savemeasurmentdata<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>();">
		<option value="">Select</option>
		<?php
		$kk=GetPageRecord('*','assemblyoperationsMaster','1 order by name asc');
		while($assemData=mysqli_fetch_array($kk)){ ?>
		<option value="<?php echo $assemData['id']; ?>" <?php if($resListing1['particular']==$assemData['id']){ ?> selected="selected" <?php } ?>><?php echo $assemData['name']; ?></option>
		<?php } ?>
		</select>
		</td>

		<td width="19%" align="center"><input name="sam" class="samclass" type="text" id="sam<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['sam']); ?>" autocomplete="off" style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>();"></td>

		<td width="19%" align="center"><input name="prodhrs" type="text" id="prodhrs<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['prodhrs']); ?>" autocomplete="off" style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>();" ></td>

		<td width="19%" align="center">

		<select name="machinetype" id="machinetype<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>" style="width:95px; text-align:left;padding: 3px;" onchange="savemeasurmentdata<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>();"></select>

		<script>
				function loadmachineData<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>(){

				var particular = $('#particular<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>').val();
				$('#machinetype<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>').load('loadmachine.php?id='+particular+'&selectId=<?php echo $resListing1['machinetype']; ?>');
				}
				var particular = $('#particular<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>').val();
				if(particular!=''){
				loadmachineData<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>();
				}
		</script>

		</td>

		<td width="19%" align="center"><input name="workads" type="text" id="workads<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['workads']); ?>" autocomplete="off" style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>();"></td>

		<td width="19%" align="center"><input name="oprreq" class="oprreqclass" type="text" id="oprreq<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['oprreq']); ?>" autocomplete="off" style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>();" readonly></td>

		<td width="19%" align="center"><input name="roundoff" class="roundoffclass" type="text" id="roundoff<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['roundoff']); ?>" autocomplete="off" style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>();" readonly></td>

  </tr>

<script>

function savemeasurmentdata<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>(){

var particular = encodeURI($('#particular<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>').val());
var sam = encodeURI($('#sam<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>').val());

// var changes =Number(60/sam);
// encodeURI($('#prodhrs<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>').val(changes.toFixed(2)));
var targets="<?php echo $_REQUEST['target']; ?>";
var clocktime="<?php echo $_REQUEST['clocktime']; ?>";
var calcus=Number((targets*sam)/clocktime);

encodeURI($('#oprreq<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>').val(calcus.toFixed(2)));
var prodhrs = encodeURI($('#prodhrs<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>').val());
var machinetype = $('#machinetype<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>').val();
var workads = encodeURI($('#workads<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>').val());
var oprreq = encodeURI($('#oprreq<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>').val());

 var round = Math.round(oprreq*2)/2;
  encodeURI($('#roundoff<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>').val(round));
var roundoff = encodeURI($('#roundoff<?php echo $costsheetVersionId; ?><?php echo $resListing1['id']; ?>').val());
$('#savemeasurmentdata<?php echo $costsheetVersionId; ?>').load('apparelbomaction.php?action=saveoperationbuldata&costsheetVersionId=<?php echo $costsheetVersionId; ?>&id=<?php echo encode($resListing1['id']); ?>&particular='+particular+'&sam='+sam+'&prodhrs='+prodhrs+'&machinetype='+machinetype+'&workads='+workads+'&oprreq='+oprreq+'&roundoff='+roundoff);

// var sum =0;
// var oprreqni=0;
// var roundoffclasshdhs=0;

// $('.samclass').each(function() {
// sum += Number($(this).val());
// });
// sum= parseFloat(sum).toFixed(2);
// document.getElementById("totalsamfinal<?php echo $costsheetVersionId; ?>").innerHTML = sum;
//  $('#totalsam').val(sum);


// $('.oprreqclass').each(function() {
// oprreqni += Number($(this).val());
// });
// oprreqni= parseFloat(oprreqni).toFixed(2);
// document.getElementById("totaloprreqfinal<?php echo $costsheetVersionId; ?>").innerHTML = oprreqni;

// $('.roundoffclass').each(function() {
// roundoffclasshdhs += Number($(this).val());
// });
// roundoffclasshdhs= parseFloat(roundoffclasshdhs).toFixed(2);
// document.getElementById("totalroundofffinal<?php echo $costsheetVersionId; ?>").innerHTML = roundoffclasshdhs;
//   $('#workplaces').val(roundoffclasshdhs);

// var sewing = "<?php echo $counttotal ?>";
// $('#sewingmc').val(sewing);


}



</script>


  <?php } ?>
<tr class="border-top-info" style="font-weight: 500; font-size: 13px; background-color: #9aabff; color:#fff;">
							<th><div align="center"></div></th>
							<th><div align="center"> </div></th>
							<th><div align="center">TOTAL </div></th>
							<th><div align="center" id="totalsamfinal<?php echo $costsheetVersionId; ?>"><?php echo $totalsam; ?></div></th>
							<th><div align="center" > </div></th>
							<th><div align="center" > </div></th>
							<th><div align="center"></div></th>
							<th><div align="center" id="totaloprreqfinal<?php echo $costsheetVersionId; ?>"><?php echo $totaloprreq; ?></div></th>
							<th><div align="center" id="totalroundofffinal<?php echo $costsheetVersionId; ?>"><?php echo $totalroundoff; ?></div></th>
						  </tr>
  <?php if($sNo2==0){ ?>

<tr style="padding:8px;text-align: center; width: 100%;background-color: #efefef;"><td colspan="50"><div align="center">No Record Found.</div></td></tr>
<div align="center">
  <?php } ?>
</div>
<tr id="savemeasurmentdata<?php echo $costsheetVersionId; ?>" style="display:none;"></tr>