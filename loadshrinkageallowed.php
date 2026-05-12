<?php
include "inc.php";

if($_REQUEST['add']==1){
$namevalueadd = 'addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",status=1';
addlistinggetlastid('shrinkageallowedmaster',$namevalueadd);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
deleteRecord('shrinkageallowedmaster','id="'.$_REQUEST['id'].'"');
}

$sNo2 = 0;
$select='';
$where='';
$rs='';
$select='*';
$where='1 and status=1 and deletestatus=0 order by id asc';
$rs=GetPageRecord($select,'shrinkageallowedmaster',$where);
while($resListing1=mysqli_fetch_array($rs)){
$sNo2++;
?>

<tr height="20">

  <td align="center"><i class="fa fa-trash" style="font-size: 20px; color:#FF0000; cursor:pointer;" onclick="deleteRow('<?php echo $resListing1['id']; ?>');"></i></td>

<td height="20"><div align="center"><?php echo $sNo2; ?></div></td>

<td height="20"><div align="left">
  <!--<input name="fabric" type="text"  id="fabric<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['fabric']); ?>" autocomplete="off"  style="text-align:left; width:100%;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">-->
<select name="fabric" id="fabric<?php echo $resListing1['id']; ?>" class="form-control" onchange="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
	<option value="">Select</option>
	<?php
	$wherethis='1 and materialSubTypeId=31 order by id desc';
	$rss=GetPageRecord('name,id','materialMaster',$wherethis);
	while($resListing1s=mysqli_fetch_array($rss)){
	?>
	<option value="<?php echo $resListing1s['id']; ?>" <?php if($resListing1s['id']==$resListing1['fabric']){ echo "selected"; }?>><?php echo stripslashes($resListing1s['name']); ?></option>
	<?php } ?>
</select>

</div></td>

<td height="20"><div align="left">
<select name="greigewidth" id="greigewidth<?php echo $resListing1['id']; ?>" class="form-control" onchange="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
<option value="">Select</option>
<option value="48" <?php if($resListing1['greigewidth']==48){ ?> selected="selected" <?php } ?>>48</option>
<option value="50" <?php if($resListing1['greigewidth']==50){ ?> selected="selected" <?php } ?>>50</option>
<option value="54" <?php if($resListing1['greigewidth']==54){ ?> selected="selected" <?php } ?>>54</option>
<option value="63" <?php if($resListing1['greigewidth']==63){ ?> selected="selected" <?php } ?>>63</option>
</select>
</div></td>

<td height="20" align="right"><div align="center">
  <input name="dwShrinkage" type="text"  id="dwShrinkage<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['dwShrinkage']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="dwwidthinhes" type="text"  id="dwwidthinhes<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['dwwidthinhes']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" readonly="">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="dcShrinkage" type="text"  id="dcShrinkage<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['dcShrinkage']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td height="20" align="right"><div align="center">
  <input name="dcwidthinhes" type="text"  id="dcwidthinhes<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['dcwidthinhes']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" readonly="">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="pShrinkage" type="text"  id="pShrinkage<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['pShrinkage']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td height="20" align="right"><div align="center">
  <input name="pwidthinhes" type="text"  id="pwidthinhes<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['pwidthinhes']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" readonly="">
</div></td>


<td height="20" align="right"><div align="center">
  <input name="eShrinkage" type="text"  id="eShrinkage<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['eShrinkage']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td height="20" align="right"><div align="center">
  <input name="ewidthinhes" type="text"  id="ewidthinhes<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['ewidthinhes']); ?>" autocomplete="off"  style="width:70px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" readonly="">
</div></td>

  </tr>

  <script>
function savemeasurmentdata<?php echo $resListing1['id']; ?>(){

var fabric = encodeURI($('#fabric<?php echo $resListing1['id']; ?>').val());
var greigewidth = encodeURI($('#greigewidth<?php echo $resListing1['id']; ?>').val());

if(greigewidth==48){
$('#dwwidthinhes<?php echo $resListing1['id']; ?>').val(42);
$('#dcwidthinhes<?php echo $resListing1['id']; ?>').val(41);
$('#pwidthinhes<?php echo $resListing1['id']; ?>').val(41);
$('#ewidthinhes<?php echo $resListing1['id']; ?>').val(37);
}

if(greigewidth==63){
$('#dwwidthinhes<?php echo $resListing1['id']; ?>').val(56);
$('#dcwidthinhes<?php echo $resListing1['id']; ?>').val(52);
$('#pwidthinhes<?php echo $resListing1['id']; ?>').val(52);
$('#ewidthinhes<?php echo $resListing1['id']; ?>').val(48);
}

if(greigewidth==54){
$('#dwwidthinhes<?php echo $resListing1['id']; ?>').val(48);
$('#dcwidthinhes<?php echo $resListing1['id']; ?>').val(46);
$('#pwidthinhes<?php echo $resListing1['id']; ?>').val(45);
$('#ewidthinhes<?php echo $resListing1['id']; ?>').val(42);
}

if(greigewidth==50){
$('#dwwidthinhes<?php echo $resListing1['id']; ?>').val(48);
$('#dcwidthinhes<?php echo $resListing1['id']; ?>').val(46);
$('#pwidthinhes<?php echo $resListing1['id']; ?>').val(45);
$('#ewidthinhes<?php echo $resListing1['id']; ?>').val(42);
}

var dwShrinkage = encodeURI($('#dwShrinkage<?php echo $resListing1['id']; ?>').val());
var dwwidthinhes = encodeURI($('#dwwidthinhes<?php echo $resListing1['id']; ?>').val());

var dcShrinkage = encodeURI($('#dcShrinkage<?php echo $resListing1['id']; ?>').val());
var dcwidthinhes = encodeURI($('#dcwidthinhes<?php echo $resListing1['id']; ?>').val());

var pShrinkage = encodeURI($('#pShrinkage<?php echo $resListing1['id']; ?>').val());
var pwidthinhes = encodeURI($('#pwidthinhes<?php echo $resListing1['id']; ?>').val());

var eShrinkage = encodeURI($('#eShrinkage<?php echo $resListing1['id']; ?>').val());
var ewidthinhes = encodeURI($('#ewidthinhes<?php echo $resListing1['id']; ?>').val());


$('#savemeasurmentdata').load('apparelbomaction.php?action=saveloadloadshrinkageallowed&id=<?php echo encode($resListing1['id']); ?>&fabric='+fabric+'&greigewidth='+greigewidth+'&dwShrinkage='+dwShrinkage+'&dwwidthinhes='+dwwidthinhes+'&dcShrinkage='+dcShrinkage+'&dcwidthinhes='+dcwidthinhes+'&pShrinkage='+pShrinkage+'&pwidthinhes='+pwidthinhes+'&eShrinkage='+eShrinkage+'&ewidthinhes='+ewidthinhes);
}
</script>
  <?php } ?>
  <?php if($sNo2==0){ ?>

<tr style="padding:8px;text-align: center; width: 100%;background-color: #efefef;"><td colspan="50"><div align="center">No Record Found.</div></td></tr>
<div align="center">
  <?php } ?>
</div>
<tr id="savemeasurmentdata" style="display:none;"></tr>