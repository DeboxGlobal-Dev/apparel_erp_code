<?php
include "inc.php";

if($_REQUEST['add']==1){
$namevalueadd = 'addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",status=1';
addlistinggetlastid('rejectioninproductionmaster',$namevalueadd);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
deleteRecord('rejectioninproductionmaster','id="'.$_REQUEST['id'].'"');
}

$sNo2 = 0;
$select='';
$where='';
$rs='';
$select='*';
$where='1 and status=1 and deletestatus=0 order by id asc';
$rs=GetPageRecord($select,'rejectioninproductionmaster',$where);
while($resListing1=mysqli_fetch_array($rs)){
$sNo2++;
?>

<tr height="20">
  <td align="center"><i class="fa fa-trash" style="font-size: 20px; color:#FF0000; cursor:pointer;" onclick="deleteRow('<?php echo $resListing1['id']; ?>');"></i></td>

<td height="20"><div align="center"><?php echo $sNo2; ?></div></td>

<td height="20"><div align="left">
  <input name="orderqtypcolor" type="text"  id="orderqtypcolor<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['orderqtypcolor']); ?>" autocomplete="off"  style="text-align:left;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="allowedper" type="text"  id="allowedper<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['allowedper']); ?>" autocomplete="off"  style="width:95px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="extraforemb" type="text"  id="extraforemb<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['extraforemb']); ?>" autocomplete="off"  style="width:95px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="extraforgarment" type="text"  id="extraforgarment<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['extraforgarment']); ?>" autocomplete="off"  style="width:95px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="extraforprinting" type="text"  id="extraforprinting<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['extraforprinting']); ?>" autocomplete="off"  style="width:95px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="extraforRfd" type="text"  id="extraforRfd<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['extraforRfd']); ?>" autocomplete="off"  style="width:95px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="extraforsolid" type="text"  id="extraforsolid<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['extraforsolid']); ?>" autocomplete="off"  style="width:95px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="totalallwance" type="text"  id="totalallwance<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['totalallwance']); ?>" autocomplete="off"  style="width:95px; text-align:center;" class="form-control" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" readonly="">
</div></td>

</div></td>
  </tr>

  <script>
function savemeasurmentdata<?php echo $resListing1['id']; ?>(){
var totalallwance=0;
var orderqtypcolor = encodeURI($('#orderqtypcolor<?php echo $resListing1['id']; ?>').val());
var allowedper = encodeURI($('#allowedper<?php echo $resListing1['id']; ?>').val());
var extraforemb = encodeURI($('#extraforemb<?php echo $resListing1['id']; ?>').val());
var extraforgarment = encodeURI($('#extraforgarment<?php echo $resListing1['id']; ?>').val());
var extraforprinting = encodeURI($('#extraforprinting<?php echo $resListing1['id']; ?>').val());
var extraforRfd = encodeURI($('#extraforRfd<?php echo $resListing1['id']; ?>').val());
var extraforsolid = encodeURI($('#extraforsolid<?php echo $resListing1['id']; ?>').val());

var totalallwance=Number(allowedper)+Number(extraforemb)+Number(extraforgarment)+Number(extraforprinting)+Number(extraforRfd)+Number(extraforsolid);
$('#totalallwance<?php echo $resListing1['id']; ?>').val(totalallwance);
$('#savemeasurmentdata').load('apparelbomaction.php?action=saveloadrejectioninproduction&id=<?php echo encode($resListing1['id']); ?>&orderqtypcolor='+orderqtypcolor+'&allowedper='+allowedper+'&extraforemb='+extraforemb+'&totalallwance='+totalallwance+'&extraforgarment='+extraforgarment+'&extraforprinting='+extraforprinting+'&extraforRfd='+extraforRfd+'&extraforsolid='+extraforsolid);

}
</script>
  <?php } ?>
  <?php if($sNo2==0){ ?>

<tr style="padding:8px;text-align: center; width: 100%;background-color: #efefef;"><td colspan="50"><div align="center">No Record Found.</div></td></tr>
<div align="center">
  <?php } ?>
</div>
<tr id="savemeasurmentdata" style="display:none;"></tr>
