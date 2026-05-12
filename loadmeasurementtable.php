<?php
include "inc.php";

if($_REQUEST['add']==1){
$namevalueadd = 'styleId="'.decode($_REQUEST['styleId']).'",costsheetVersionId=1,addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",status=1';
addlistinggetlastid('measurementchartmaster',$namevalueadd);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
deleteRecord('measurementchartmaster','id="'.$_REQUEST['id'].'"');
}

$sNo2 = 0;
$select='';
$where='';
$rs='';
$select='*';
$where=' styleId="'.decode($_REQUEST['styleId']).'" and costsheetVersionId=1 and status=1 and deletestatus=0 order by id asc';
$rs=GetPageRecord($select,_MEASUREMENT_CHART_MASTER_,$where);
while($resListing1=mysqli_fetch_array($rs)){

/*$select12='*';
$where12='measureId="'.$resListing1['id'].'" and styleTechPackId="'.$resListing22['id'].'" and sectionType="measurement" order by id desc';
$rs12=GetPageRecord($select12,'techPackDetailMaster',$where12);
$resListing12=mysqli_fetch_array($rs12);
*/

$sNo2++;
?>
<tr class="border-top-info">
    <td align="center"><i class="fa fa-trash" style="font-size: 20px; color:#FF0000;" onclick="deleteRow('<?php echo $resListing1['id']; ?>');"></i></td>
	<td><?php echo $sNo2; ?></td>
	<input type="hidden" name="measureId"  value="<?php echo $resListing1['id']; ?>" />
	<td width="30%"><input name="name" type="text"  id="name<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['name']); ?>" autocomplete="off"  style="width:100%;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();"></td>
	<td align="center"><input name="measureXS" type="text"  id="measureXS<?php echo $resListing1['id']; ?>" value="<?php echo $resListing1['xs']; ?>" autocomplete="off"  maxlength="200" style="width:80px;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();"></td>
	<td align="center"><input name="measureSmall" type="text"  id="measureSmall<?php echo $resListing1['id']; ?>" value="<?php echo $resListing1['small']; ?>" autocomplete="off"  maxlength="200" style="width:80px;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();"></td>
	<td align="center"><input name="measureMedium" type="text"  id="measureMedium<?php echo $resListing1['id']; ?>" value="<?php echo $resListing1['medium']; ?>" autocomplete="off"  maxlength="200"  style="width:80px;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();"></td>
	<td align="center"><input name="measureLarge" type="text"  id="measureLarge<?php echo $resListing1['id']; ?>" value="<?php echo $resListing1['large']; ?>" autocomplete="off"  maxlength="200"  style="width:80px;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();"></td>
	<td align="center"><input name="measureXL" type="text"  id="measureXL<?php echo $resListing1['id']; ?>" value="<?php echo $resListing1['xl']; ?>" autocomplete="off"  maxlength="200"  style="width:80px;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();"></td>
	<td align="center"><input name="measureXXL" type="text"  id="measureXXL<?php echo $resListing1['id']; ?>" value="<?php echo $resListing1['xxl']; ?>" autocomplete="off"  maxlength="200"  style="width:80px;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();"></td>
	<td align="center"><input name="measureTOL" type="text"  id="measureTOL<?php echo $resListing1['id']; ?>" value="<?php echo $resListing1['tol']; ?>" autocomplete="off"  maxlength="200"  style="width:80px;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();"></td>
</tr>

<script>
function savemeasurmentdata<?php echo $resListing1['id']; ?>(){

var name = encodeURI($('#name<?php echo $resListing1['id']; ?>').val());
var measureSmall = encodeURI($('#measureSmall<?php echo $resListing1['id']; ?>').val());
var measureXS = encodeURI($('#measureXS<?php echo $resListing1['id']; ?>').val());
var measureMedium = encodeURI($('#measureMedium<?php echo $resListing1['id']; ?>').val());
var measureLarge = encodeURI($('#measureLarge<?php echo $resListing1['id']; ?>').val());
var measureXL = encodeURI($('#measureXL<?php echo $resListing1['id']; ?>').val());
var measureXXL = encodeURI($('#measureXXL<?php echo $resListing1['id']; ?>').val());
var measureTOL = encodeURI($('#measureTOL<?php echo $resListing1['id']; ?>').val());

$('#savemeasurmentdata').load('apparelbomaction.php?action=savemeasurmentdata&id=<?php echo encode($resListing1['id']); ?>&name='+name+'&measureSmall='+measureSmall+'&measureMedium='+measureMedium+'&measureLarge='+measureLarge+'&measureXL='+measureXL+'&measureXXL='+measureXXL+'&measureTOL='+measureTOL+'&measureXS='+measureXS);

}


</script>

<?php } ?>
<?php if($sNo2==0){ ?>
<tr style="padding:8px;text-align: center; width: 100%;background-color: #efefef;"><td colspan="50">No Record Found.</td></tr>
<?php } ?>
<!--<input type="hidden" name="measurementCount" value="<?php echo $sNo2; ?>" />-->
<tr id="savemeasurmentdata" style="display:none;"></tr>