<?php
include "inc.php";
$lotId=$_REQUEST['lotId'];
$materialid=decode($_REQUEST['materialid']);
$colorid=decode($_REQUEST['colorid']);
$poid=decode($_REQUEST['poid']);
$grnid=decode($_REQUEST['grnid']);

    $select='*';
$where=' styleId="'.decode($_REQUEST['styleId']).'" and costsheetVersionId=1 and status=1 and deletestatus=0 and lotNoMaster="'.$lotId.'" order by id asc';
$rsrr=GetPageRecord($select,'trimdatamaster',$where);
$resListing1r=mysqli_fetch_array($rsrr);

if($_REQUEST['add']==1){

$namevalueadd = 'styleId="'.decode($_REQUEST['styleId']).'",costsheetVersionId=1,addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",status=1,lotNoMaster="'.$lotId.'",vendor_name="'.$resListing1r['vendor_name'].'",lotno="'.$resListing1r['lotno'].'",inspectiondate="'.$resListing1r['inspectiondate'].'",remarks="'.$resListing1r['remarks'].'"';
addlistinggetlastid('trimdatamaster',$namevalueadd);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
deleteRecord('trimdatamaster','id="'.$_REQUEST['id'].'"');
}

$sNo2 = 0;
$select='';
$where='';
$rs='';
$select='*';
$where=' styleId="'.decode($_REQUEST['styleId']).'" and costsheetVersionId=1 and status=1 and deletestatus=0 and lotNoMaster="'.$lotId.'" order by id asc';
$rs=GetPageRecord($select,'trimdatamaster',$where);
while($resListing1=mysqli_fetch_array($rs)){
$sNo2++;
?>

<tr height="20">
  <td align="center"><i class="fa fa-trash" style="font-size: 20px; color:#FF0000; cursor:pointer;" onclick="deleteRow('<?php echo $resListing1['id']; ?>');"></i></td>

  <td><div align="center">
<select name="lotNoMaster" id="lotNoMaster<?php echo $resListing1['id']; ?>" style="width: 65px; text-align: center; padding: 2px;">
<?php
$lotDataq=GetPageRecord('*','lotMaster','1 and id="'.$lotId.'" order by id');
while($lotData=mysqli_fetch_array($lotDataq)){ ?>
<option value="<?php echo $lotData['id']; ?>" <?php if($lotData['id']==$resListing1['lotNoMaster']){ ?> selected="selected" <?php } ?>><?php echo $lotData['name']; ?></option>
<?php } ?>

</select>
</div></td>

<td height="20" align="right"><div align="center">
<?php
  $materialDataq=GetPageRecord('*','styleSubCategoryMaster','id="'.$materialid.'"');
            $materialData=mysqli_fetch_array($materialDataq);
  ?>
  <input name="item_trims" type="text"  id="item_trims<?php echo $resListing1['id']; ?>" value="<?php echo $materialData['name'] ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" readonly="readonly">
</div></td>

<td height="20" align="right"><div align="center">
  <?php
$unq=GetPageRecord('materialUniqueId','materialMaster','1 and name="'.$materialData['name'].'"');
        $uniData=mysqli_fetch_array($unq);
   ?>
  <input name="item_code" type="text"  id="item_code<?php echo $resListing1['id']; ?>" value="<?php echo $uniData['materialUniqueId'] ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();"  readonly="readonly">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="vendor_name" type="text"  id="vendor_name<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['vendor_name']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();"  readonly="readonly">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="pono" type="text"  id="pono<?php echo $resListing1['id']; ?>" value="<?php echo $poid; ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();"  readonly="readonly">
</div></td>

<td height="20" align="right"><div align="center">
  <?php
$rsListitemq=GetPageRecord('*','indentCreationMaster','styleId="'.decode($_REQUEST['styleId']).'" and materialId="'.$materialid.'" and color="'.$colorid.'"');
        $rsListitem=mysqli_fetch_array($rsListitemq);
  ?>
  <input name="receivedqty" type="text"  id="receivedqty<?php echo $resListing1['id']; ?>" value="<?php echo $rsListitem['poQty']*$rsListitem['avg']; ?>" autocomplete="off" style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();"  readonly="readonly">
</div></td>

<td height="20" align="right"><div align="center">
  <?php
$rsgrnrec=GetPageRecord('sum(netReceived) as netReceivedTill','grnMaster','styleId="'.decode($_REQUEST['styleId']).'" and materialId="'.$materialid.'" and color="'.$colorid.'"');
        $rsgrnrecTill=mysqli_fetch_array($rsgrnrec);
  ?>
  <input name="totalorderqty" type="text"  id="totalorderqty<?php echo $resListing1['id']; ?>" value="<?php echo round($rsgrnrecTill['netReceivedTill'],2); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();"  readonly="readonly">
</div></td>


<td height="20" align="right" style="display:none;"><div align="center">
  <input name="lotno" type="text"  id="lotno<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['lotno']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();"  readonly="readonly">
</div></td>

<td height="20" align="right"><div align="center">
<?php
  $grnDataq=GetPageRecord('*','grnMaster','id="'.$grnid.'"');
            $editresult=mysqli_fetch_array($grnDataq);
  ?>
  <input name="lotreceiveddate" type="text" readonly=""  id="lotreceiveddate<?php echo $resListing1['id']; ?>" value="<?php if($editresult['docDate']=='0000-00-00' || $editresult['docDate']==''){ echo date('d-m-Y'); }else{  echo date('d-m-Y', strtotime($editresult['docDate'])); } ?>" autocomplete="off"  style="width:95px; text-align:center;" onchange="savemeasurmentdata<?php echo $resListing1['id']; ?>();"  readonly="readonly">
</div></td>

// <script>
// $( function(){
// 	$( "#lotreceiveddate<?php echo $resListing1['id']; ?>" ).datepicker();
// } );

// </script>

<td height="20" align="right"><div align="center">
  <?php
  $gateDataq=GetPageRecord('*','gateentrymaster','parentId="'.$editresult['gateEntryNo'].'" and materialId="'.$materialid.'" and color="'.$colorid.'"');
            $gateData=mysqli_fetch_array($gateDataq);
  ?>
  <input name="recievedutytlot" type="text"  id="recievedutytlot<?php echo $resListing1['id']; ?>" value="<?php echo $gateData['qty']; ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();"  readonly="readonly">
</div></td>


<td height="20" align="right"><div align="center">
  <input name="recievedutytillnow" type="text"  id="recievedutytillnow<?php echo $resListing1['id']; ?>" value="<?php echo round($rsgrnrecTill['netReceivedTill'],2); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" readonly="readonly">
</div></td>


<td height="20" align="right"><div align="center">
  <input name="balancetoreceive" type="text"  id="balancetoreceive<?php echo $resListing1['id']; ?>" value="<?php echo round($rsgrnrecTill['netReceivedTill'],2) - round($rsgrnrecTill['netReceivedTill'],2); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" readonly="readonly">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="inspectiondate"  type="date"  id="inspectiondate<?php echo $resListing1['id']; ?>" value="<?php if($resListing1['inspectiondate']!='0000-00-00'){ echo $resListing1['inspectiondate']; } ?>" autocomplete="off"  style="width:95px; text-align:center;" onchange="savemeasurmentdata<?php echo $resListing1['id']; ?>();"  >
</div></td>

<td height="20" align="right"><div align="center">
  <input name="inspectionqty"  type="text"  id="inspectionqty<?php echo $resListing1['id']; ?>" autocomplete="off"  style="width:95px; text-align:center;" value="<?php echo $resListing1['inspectionqty']; ?>" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" >
</div></td>

// <script>
// $( function(){
// 	$( "#inspectiondate<?php echo $resListing1['id']; ?>" ).datepicker();
// } );

// </script>

<td height="20" align="right"><div align="center">
  <input name="okayqty" class="okayqty" type="text"  id="okayqty<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['okayqty']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" >
</div></td>


<td height="20" align="right"><div align="center">
  <input name="rejectedqty" class="rejectedqty" type="text"  id="rejectedqty<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['rejectedqty']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" >
</div></td>


<td height="20" align="right"><div align="center">
  <input name="disputedqty" class="disputedqty" type="text"  id="disputedqty<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['disputedqty']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" >
</div></td>


<td width="53" align="center"><div align="center">
  <input name="remarks" type="text"  id="remarks<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['remarks']); ?>" autocomplete="off"  style="width:150px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" >



</div></td>
  </tr>

  <script>
function savemeasurmentdata<?php echo $resListing1['id']; ?>(){

var item_trims = encodeURI($('#item_trims<?php echo $resListing1['id']; ?>').val());
var item_code = encodeURI($('#item_code<?php echo $resListing1['id']; ?>').val());
var vendor_name = encodeURI($('#vendor_name<?php echo $resListing1['id']; ?>').val());
var pono = encodeURI($('#pono<?php echo $resListing1['id']; ?>').val());
var receivedqty = encodeURI($('#receivedqty<?php echo $resListing1['id']; ?>').val());
var totalorderqty = encodeURI($('#totalorderqty<?php echo $resListing1['id']; ?>').val());
var lotno = encodeURI($('#lotno<?php echo $resListing1['id']; ?>').val());
var lotreceiveddate = encodeURI($('#lotreceiveddate<?php echo $resListing1['id']; ?>').val());
var recievedutytlot = encodeURI($('#recievedutytlot<?php echo $resListing1['id']; ?>').val());
var recievedutytillnow = encodeURI($('#recievedutytillnow<?php echo $resListing1['id']; ?>').val());
var balancetoreceive = encodeURI($('#balancetoreceive<?php echo $resListing1['id']; ?>').val());
var inspectiondate = encodeURI($('#inspectiondate<?php echo $resListing1['id']; ?>').val());
var inspectionqty = encodeURI($('#inspectionqty<?php echo $resListing1['id']; ?>').val());
var okayqty = encodeURI($('#okayqty<?php echo $resListing1['id']; ?>').val());
var rejectedqty = encodeURI($('#rejectedqty<?php echo $resListing1['id']; ?>').val());
var disputedqty = encodeURI($('#disputedqty<?php echo $resListing1['id']; ?>').val());
var remarks = encodeURI($('#remarks<?php echo $resListing1['id']; ?>').val());



var receivedqty = $('#receivedqty<?php echo $resListing1['id']; ?>').val();
var inspec=  $('#inspectionqty<?php echo $resListing1['id']; ?>').val();

if(inspec > recievedutytillnow){
  alert('Inspected Qty Should not be greater than Receive Qty');
  $('#inspectionqty<?php echo $resListing1['id']; ?>').val('');

}

$('#savemeasurmentdata').load('apparelbomaction.php?action=savetrimdatamaster&id=<?php echo encode($resListing1['id']); ?>&item_trims='+item_trims+'&item_code='+item_code+'&vendor_name='+vendor_name+'&pono='+pono+'&receivedqty='+receivedqty+'&totalorderqty='+totalorderqty+'&lotno='+lotno+'&lotreceiveddate='+lotreceiveddate+'&recievedutytlot='+recievedutytlot+'&recievedutytillnow='+recievedutytillnow+'&balancetoreceive='+balancetoreceive+'&inspectiondate='+inspectiondate+'&okayqty='+okayqty+'&rejectedqty='+rejectedqty+'&disputedqty='+disputedqty+'&remarks='+remarks+'&inspectionqty='+inspectionqty);


var okayquantity=0;
$('.okayqty').each(function() {
        okayquantity += Number($(this).val());
});
okayquantity= parseFloat(okayquantity).toFixed(2);
$('#accepted').val(okayquantity);

var rejectedquantity=0;
$('.rejectedqty').each(function() {
  rejectedquantity += Number($(this).val());
});
rejectedquantity= parseFloat(rejectedquantity).toFixed(2);
$('#rejectedreplaced').val(rejectedquantity);

var holdquantity=0;
$('.disputedqty').each(function() {
  holdquantity += Number($(this).val());
});
holdquantity= parseFloat(holdquantity).toFixed(2);
$('#reprocessing').val(holdquantity);
$('#onhold').val(holdquantity);



}
</script>
  <?php } ?>
  <?php if($sNo2==0){ ?>

<tr style="padding:8px;text-align: center; width: 100%;background-color: #efefef;"><td colspan="50"><div align="center">No Record Found.</div></td></tr>
<div align="center">
  <?php } ?>
</div>
<tr id="savemeasurmentdata" style="display:none;"></tr>
