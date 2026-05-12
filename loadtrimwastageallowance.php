<?php
include "inc.php";

if($_REQUEST['add']==1){
$namevalueadd = 'addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",status=1';
addlistinggetlastid('trimwastageallowancemaster',$namevalueadd);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
deleteRecord('trimwastageallowancemaster','id="'.$_REQUEST['id'].'"');
}

$sNo2 = 0;
$select='';
$where='';
$rs='';
$select='*';
$where='1 and status=1 and deletestatus=0 order by id asc';
$rs=GetPageRecord($select,'trimwastageallowancemaster',$where);
while($resListing1=mysqli_fetch_array($rs)){
$sNo2++;
?>

<tr height="20">
  <td align="center"><i class="fa fa-trash" style="font-size: 20px; color:#FF0000; cursor:pointer;" onclick="deleteRow('<?php echo $resListing1['id']; ?>');"></i></td>

<td height="20"><div align="center"><?php echo $sNo2; ?></div></td>

<td height="20"><div align="left">
  <input name="itemhead" type="text"  id="itemhead<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['itemhead']); ?>" autocomplete="off"  style="text-align:left; width:100%;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="fextracutinintent" type="text"  id="fextracutinintent<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['fextracutinintent']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="faddextra" type="text"  id="faddextra<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['faddextra']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td height="20" align="right"><div align="center">
  <input name="ftotalallowed" type="text"  id="ftotalallowed<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['ftotalallowed']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" readonly="">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="sextracutinintent" type="text"  id="sextracutinintent<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['sextracutinintent']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="saddextra" type="text"  id="saddextra<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['saddextra']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td height="20" align="right"><div align="center">
  <input name="stotalallowed" type="text"  id="stotalallowed<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['stotalallowed']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" readonly="">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="textracutinintent" type="text"  id="textracutinintent<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['textracutinintent']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="taddextra" type="text"  id="taddextra<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['taddextra']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td height="20" align="right"><div align="center">
  <input name="ttotalallowed" type="text"  id="ttotalallowed<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['ttotalallowed']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" readonly="">
</div></td>


  </tr>

  <script>
function savemeasurmentdata<?php echo $resListing1['id']; ?>(){
var ftotalallowed=0;
var stotalallowed=0;
var ttotalallowed=0;

var itemhead = encodeURI($('#itemhead<?php echo $resListing1['id']; ?>').val());

var fextracutinintent = encodeURI($('#fextracutinintent<?php echo $resListing1['id']; ?>').val());
var faddextra = encodeURI($('#faddextra<?php echo $resListing1['id']; ?>').val());
ftotalallowed=Number(fextracutinintent)+Number(faddextra);
$('#ftotalallowed<?php echo $resListing1['id']; ?>').val(ftotalallowed);

var sextracutinintent = encodeURI($('#sextracutinintent<?php echo $resListing1['id']; ?>').val());
var saddextra = encodeURI($('#saddextra<?php echo $resListing1['id']; ?>').val());
stotalallowed=Number(sextracutinintent)+Number(saddextra);
$('#stotalallowed<?php echo $resListing1['id']; ?>').val(stotalallowed);

var textracutinintent = encodeURI($('#textracutinintent<?php echo $resListing1['id']; ?>').val());
var taddextra = encodeURI($('#taddextra<?php echo $resListing1['id']; ?>').val());
ttotalallowed=Number(textracutinintent)+Number(taddextra);
$('#ttotalallowed<?php echo $resListing1['id']; ?>').val(ttotalallowed);

$('#savemeasurmentdata').load('apparelbomaction.php?action=loadtrimwastageallowance&id=<?php echo encode($resListing1['id']); ?>&itemhead='+itemhead+'&fextracutinintent='+fextracutinintent+'&faddextra='+faddextra+'&ftotalallowed='+ftotalallowed+'&sextracutinintent='+sextracutinintent+'&saddextra='+saddextra+'&stotalallowed='+stotalallowed+'&textracutinintent='+textracutinintent+'&taddextra='+taddextra+'&ttotalallowed='+ttotalallowed);

}
</script>
  <?php } ?>
  <?php if($sNo2==0){ ?>

<tr style="padding:8px;text-align: center; width: 100%;background-color: #efefef;"><td colspan="50"><div align="center">No Record Found.</div></td></tr>
<div align="center">
  <?php } ?>
</div>
<tr id="savemeasurmentdata" style="display:none;"></tr>
