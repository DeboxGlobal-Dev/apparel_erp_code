<?php
include "inc.php";

if($_REQUEST['add']==1){
$namevalueadd = 'addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",status=1';
addlistinggetlastid('wastageallowedincuttingmaster',$namevalueadd);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
deleteRecord('wastageallowedincuttingmaster','id="'.$_REQUEST['id'].'"');
}

$sNo2 = 0;
$select='';
$where='';
$rs='';
$select='*';
$where='1 and status=1 and deletestatus=0 order by id asc';
$rs=GetPageRecord($select,'wastageallowedincuttingmaster',$where);
while($resListing1=mysqli_fetch_array($rs)){
$sNo2++;
?>

<tr height="20">
  <td align="center"><i class="fa fa-trash" style="font-size: 20px; color:#FF0000; cursor:pointer;" onclick="deleteRow('<?php echo $resListing1['id']; ?>');"></i></td>

<td height="20"><div align="center"><?php echo $sNo2; ?></div></td>

<td height="20"><div align="left">
  <input name="fabric" type="text"  id="fabric<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['fabric']); ?>" autocomplete="off"  style="text-align:left; width:100%;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="diwhite" type="text"  id="diwhite<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['diwhite']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="dicolor" type="text"  id="dicolor<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['dicolor']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td height="20" align="right"><div align="center">
  <input name="dawhite" type="text"  id="dawhite<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['dawhite']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td height="20" align="right"><div align="center">
  <input name="dacolor" type="text"  id="dacolor<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['dacolor']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td height="20" align="right"><div align="center">
  <input name="pinfant" type="text"  id="pinfant<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['pinfant']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="padult" type="text"  id="padult<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['padult']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td height="20" align="right"><div align="center">
  <input name="eminfant" type="text"  id="eminfant<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['eminfant']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td height="20" align="right"><div align="center">
  <input name="emadult" type="text"  id="emadult<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['emadult']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>



<td height="20" align="right"><div align="center">
  <input name="mininfant" type="text"  id="mininfant<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['mininfant']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>



<td height="20" align="right"><div align="center">
  <input name="minadult" type="text"  id="minadult<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['minadult']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

</div></td>
  </tr>

  <script>
function savemeasurmentdata<?php echo $resListing1['id']; ?>(){

var fabric = encodeURI($('#fabric<?php echo $resListing1['id']; ?>').val());
var diwhite = encodeURI($('#diwhite<?php echo $resListing1['id']; ?>').val());
var dicolor = encodeURI($('#dicolor<?php echo $resListing1['id']; ?>').val());
var dawhite = encodeURI($('#dawhite<?php echo $resListing1['id']; ?>').val());
var dacolor = encodeURI($('#dacolor<?php echo $resListing1['id']; ?>').val());
var pinfant = encodeURI($('#pinfant<?php echo $resListing1['id']; ?>').val());
var padult = encodeURI($('#padult<?php echo $resListing1['id']; ?>').val());
var eminfant = encodeURI($('#eminfant<?php echo $resListing1['id']; ?>').val());
var emadult = encodeURI($('#emadult<?php echo $resListing1['id']; ?>').val());
var mininfant = encodeURI($('#mininfant<?php echo $resListing1['id']; ?>').val());
var minadult = encodeURI($('#minadult<?php echo $resListing1['id']; ?>').val());


$('#savemeasurmentdata').load('apparelbomaction.php?action=saveloadwastageallowedincutting&id=<?php echo encode($resListing1['id']); ?>&fabric='+fabric+'&diwhite='+diwhite+'&dicolor='+dicolor+'&dawhite='+dawhite+'&dacolor='+dacolor+'&pinfant='+pinfant+'&padult='+padult+'&eminfant='+eminfant+'&emadult='+emadult+'&mininfant='+mininfant+'&minadult='+minadult);

}
</script>
  <?php } ?>
  <?php if($sNo2==0){ ?>

<tr style="padding:8px;text-align: center; width: 100%;background-color: #efefef;"><td colspan="50"><div align="center">No Record Found.</div></td></tr>
<div align="center">
  <?php } ?>
</div>
<tr id="savemeasurmentdata" style="display:none;"></tr>
