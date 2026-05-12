<?php
include "inc.php";
$lotId=$_REQUEST['lotId'];
$color=str_replace("_"," ",$_REQUEST['color']);
if($_REQUEST['add']==1){
$namevalueadd = 'styleId="'.decode($_REQUEST['styleId']).'",costsheetVersionId=1,addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",status=1,lotNoMaster="'.$lotId.'"';
addlistinggetlastid('cutplanmaster',$namevalueadd);
}
if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
deleteRecord('cutplanmaster','id="'.$_REQUEST['id'].'"');
}
$sNo2 = 0;
$select='';
$where='';
$rs='';
$select='*';
$where=' styleId="'.decode($_REQUEST['styleId']).'" and costsheetVersionId=1 and status=1 and deletestatus=0 and lotNoMaster="'.$lotId.'" order by id asc';
$rs=GetPageRecord($select,'cutplanmaster',$where);
while($resListing1=mysqli_fetch_array($rs)){
$sNo2++;
?>

<tr height="20">
  <td align="center"><i class="fa fa-trash" style="font-size: 20px; color:#FF0000; cursor:pointer;" onclick="deleteRow('<?php echo $resListing1['id']; ?>');"></i></td>


<td><div align="center">
<select name="lotNoMaster" id="lotNoMaster<?php echo $resListing1['id']; ?>" style="width: 65px; text-align: center; padding: 2px;">
<?php
$lotDataq=GetPageRecord('*','cutlotMaster','1 and id="'.$lotId.'" order by id');
while($lotData=mysqli_fetch_array($lotDataq)){ ?>
<option value="<?php echo $lotData['id']; ?>" <?php if($lotData['id']==$resListing1['lotNoMaster']){ ?> selected="selected" <?php } ?>><?php echo $lotData['name']; ?></option>
<?php } ?>

</select>
</div></td>


<td height="20"><div align="center">
  <input name="cutdate" type="text" class="cutdateDate"  id="cutdate<?php echo $resListing1['id']; ?>" <?php if($resListing1['cutdate']!="0000-00-00"){ ?> value="<?php echo stripslashes(date('d-m-Y',strtotime($resListing1['cutdate']))); ?>" <?php } ?> autocomplete="off"  style="width:95px; text-align:center;" onchange="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<style>
.ui-datepicker-calendar tr td{
padding:0px !important;

}
</style>

<script>
$(function(){
$( ".cutdateDate" ).datepicker();
});
</script>



<td height="20"><div align="center">
  <input name="colorlay" type="text"  id="colorlay<?php echo $resListing1['id']; ?>" value="<?php echo $color.'/'.$sNo2; ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>



<td height="20"><div align="center">
  <input name="pieceslay" class="pieceslayclass" type="text"  id="pieceslay<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['pieceslay']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td height="20"><div align="center">
  <input name="fabricreq" type="text" class="fabricreqclass" id="fabricreq<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['fabricreq']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>



<td height="20"><div align="center">
  <input name="fabricrec" type="text"  id="fabricrec<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['fabricrec']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>



<td height="20"><div align="center">
  <input name="markerratio" type="text"  id="markerratio<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['markerratio']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>




<td height="20"><div align="center">
  <input name="noofpcs" type="text"  id="noofpcs<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['noofpcs']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td height="20"><div align="center">
  <input name="markerlength" type="text"  id="markerlength<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['markerlength']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>



<td height="20"><div align="center">
  <input name="noodpiles" type="text"  id="noodpiles<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['noodpiles']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td height="20"><div align="center">
  <input name="fabricused" type="text"  id="fabricused<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['fabricused']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20"><div align="center">
  <input name="wastage" type="text"  id="wastage<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['wastage']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>



<td height="20"><div align="center">
  <input name="endbits" type="text"  id="endbits<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['endbits']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>



<td height="20"><div align="center">
  <input name="totalfabused" type="text"  id="totalfabused<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['totalfabused']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td height="20"><div align="center">
  <input name="fabricexceed" type="text"  id="fabricexceed<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['fabricexceed']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>



<td height="20"><div align="center">
  <input name="fabriccompunded" type="text"  id="fabriccompunded<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['fabriccompunded']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>



<td height="20"><div align="center">
  <input name="totalfabricorder" type="text"  id="totalfabricorder<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['totalfabricorder']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20"><div align="center">
  <input name="totalfabricafterinspection" type="text"  id="totalfabricafterinspection<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['totalfabricafterinspection']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td height="20"><div align="center">
  <input name="totalfabricbal" type="text"  id="totalfabricbal<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['totalfabricbal']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td height="20"><div align="center">
  <input name="fabricinhand" type="text"  id="fabricinhand<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['fabricinhand']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>



<td height="20"><div align="center">
  <input name="endbittotal" type="text"  id="endbittotal<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['endbittotal']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


  </tr>

  <script>

function savemeasurmentdata<?php echo $resListing1['id']; ?>(){
 var sumfirst = 0;
var sumsecond = 0;

var colorlay = encodeURI($('#colorlay<?php echo $resListing1['id']; ?>').val());
var pieceslay = encodeURI($('#pieceslay<?php echo $resListing1['id']; ?>').val());
var fabricreq = encodeURI($('#fabricreq<?php echo $resListing1['id']; ?>').val());
var fabricrec = encodeURI($('#fabricrec<?php echo $resListing1['id']; ?>').val());
var markerratio = encodeURI($('#markerratio<?php echo $resListing1['id']; ?>').val());
var noofpcs = encodeURI($('#noofpcs<?php echo $resListing1['id']; ?>').val());
var markerlength = encodeURI($('#markerlength<?php echo $resListing1['id']; ?>').val());
var noodpiles = encodeURI($('#noodpiles<?php echo $resListing1['id']; ?>').val());
var fabricused = encodeURI($('#fabricused<?php echo $resListing1['id']; ?>').val());
var wastage = encodeURI($('#wastage<?php echo $resListing1['id']; ?>').val());

var endbits = encodeURI($('#endbits<?php echo $resListing1['id']; ?>').val());
var totalfabused = encodeURI($('#totalfabused<?php echo $resListing1['id']; ?>').val());
var fabricexceed = encodeURI($('#fabricexceed<?php echo $resListing1['id']; ?>').val());
var fabriccompunded = encodeURI($('#fabriccompunded<?php echo $resListing1['id']; ?>').val());
var totalfabricorder = encodeURI($('#totalfabricorder<?php echo $resListing1['id']; ?>').val());
var totalfabricafterinspection = encodeURI($('#totalfabricafterinspection<?php echo $resListing1['id']; ?>').val());
var totalfabricbal = encodeURI($('#totalfabricbal<?php echo $resListing1['id']; ?>').val());
var fabricinhand = encodeURI($('#fabricinhand<?php echo $resListing1['id']; ?>').val());
var endbittotal = encodeURI($('#endbittotal<?php echo $resListing1['id']; ?>').val());
var cutdate = encodeURI($('#cutdate<?php echo $resListing1['id']; ?>').val());
var lotNoMaster = encodeURI($('#lotNoMaster<?php echo $resListing1['id']; ?>').val());



//===================================================
$('.pieceslayclass').each(function() {
sumfirst += Number($(this).val());
});
sumfirst= parseFloat(sumfirst).toFixed(2);


//===================================================
$('.fabricreqclass').each(function() {
sumsecond += Number($(this).val());
});
sumsecond= parseFloat(sumsecond).toFixed(2);

$('#savemeasurmentdata').load('apparelbomaction.php?action=savecutplan&id=<?php echo encode($resListing1['id']); ?>&styleId=<?php echo decode($_REQUEST['styleId']); ?>&colorlay='+colorlay+'&pieceslay='+pieceslay+'&fabricreq='+fabricreq+'&fabricrec='+fabricrec+'&markerratio='+markerratio+'&noofpcs='+noofpcs+'&markerlength='+markerlength+'&noodpiles='+noodpiles+'&fabricused='+fabricused+'&wastage='+wastage+'&endbits='+endbits+'&totalfabused='+totalfabused+'&fabricexceed='+fabricexceed+'&fabriccompunded='+fabriccompunded+'&totalfabricorder='+totalfabricorder+'&totalfabricafterinspection='+totalfabricafterinspection+'&totalfabricbal='+totalfabricbal+'&fabricinhand='+fabricinhand+'&endbittotal='+endbittotal+'&cutdate='+cutdate+'&noofpiecestotal='+sumfirst+'&fabricreqtotal='+sumsecond+'&lotNoMaster='+lotNoMaster);

}
</script>
  <?php } ?>
  <?php if($sNo2==0){ ?>

<tr style="padding:8px;text-align: center; width: 100%;background-color: #efefef;"><td colspan="50"><div align="center">No Record Found.</div></td></tr>
<div align="center">
  <?php } ?>
</div>
<tr id="savemeasurmentdata" style="display:none;"></tr>