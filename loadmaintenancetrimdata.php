<?php
include "inc.php";
$gateid=$_REQUEST['gateentryid'];



    //                     $materialDataq=GetPageRecord('*','loadmaintenanceinspectioninput','id="'.$_REQUEST['mat'].'"');
				// 		$materialData=mysqli_fetch_array($materialDataq);
				// 		$mat=$materialData['name'];

// $select='*';
// $where=' styleId="'.decode($_REQUEST['styleId']).'" and costsheetVersionId=1 and status=1 and deletestatus=0 and lotNoMaster="'.$lotId.'" order by id asc';
// $rsr=GetPageRecord($select,'loadmaintenanceinspectioninput',$where);
// $resListing1r=mysqli_fetch_array($rsr);

$rs1=GetPageRecord('*','maintenancegateentrymaster','1  and id="'.$_REQUEST['gateentryid'].'"');
                  $resListing1=mysqli_fetch_array($rs1);

                  $rs14=GetPageRecord('*','suppliersMaster','1  and id="'.$resListing1['supplier'].'"');
$resListing14=mysqli_fetch_array($rs14);


	$wherenew='id="'.$resListing1['ponumber'].'"';
	$rsnew=GetPageRecord('*','requisitionIndentMaster',$wherenew);
$rslistneww=mysqli_fetch_array($rsnew);


$qu=GetPageRecord('SUM(orderQty) as totalorder','requisitionIndentMaster','1 and mainid="'.$rslistneww['mainid'].'"');
$quer=mysqli_fetch_array($qu);

	$wherenewd='id="'.$rslistneww['mainid'].'"';
	$rsnewd=GetPageRecord('*','loadmaintenance',$wherenewd);
$rslistnewd=mysqli_fetch_array($rsnewd);

$wherenewde='id="'.$rslistnewd['item'].'"';
	$rsnewde=GetPageRecord('*','maintenancegeneral_Master',$wherenewde);
$rslistnewde=mysqli_fetch_array($rsnewde);


/////////////


$rsLi=GetPageRecord('*','requisitionIndentMaster','id="'.$resListing1['ponumber'].'"');
				$queryLi=mysqli_fetch_array($rsLi);

				      $rssrt=GetPageRecord('*','loadmaintenance','1 and id="'.$queryLi['mainid'].'"');
		   $rrrrt=mysqli_fetch_array($rssrt);


				     $rssrtv=GetPageRecord('*','maintenancegi_Master','1 and id="'.$rrrrt['parentId'].'"');
		   $rrrrtv=mysqli_fetch_array($rssrtv);

                          if($rrrrtv['requisitiontype']==1) {
                                    $po='GI-'. date('dmy',$rrrrtv['dateAdded']).'-'.$queryLi['id'];
                                }else{
                                        $po='MN-'. date('dmy',$rrrrtv['dateAdded']).'-'.$queryLi['id'];
                                }



if($_REQUEST['add']==1){
$namevalueadd = 'gateentryId="'.$_REQUEST['gateentryid'].'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",status=1,item_trims="'.$rslistnewde['material'].'",item_code="'.'MGI-0000-'.$rslistnewde['maintenanceid'].'",vendor_name="'.$resListing14['name'].'",pono="'.$po.'",receivedqty="'.$rslistnewd['requestedquantity'].'",totalorderqty="'.$quer['totalorder'].'"';
addlistinggetlastid('loadmaintenanceinspectioninput',$namevalueadd);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
deleteRecord('loadmaintenanceinspectioninput','id="'.$_REQUEST['id'].'"');
}

$sNo2 = 0;
$select='';
$where='';
$rs='';
$select='*';
$where=' gateentryId="'.$_REQUEST['gateentryid'].'" order by id asc';
$rs=GetPageRecord($select,'loadmaintenanceinspectioninput',$where);
while($resListing1=mysqli_fetch_array($rs)){
$sNo2++;
?>

<tr height="20">
  <td align="center"><i class="fa fa-trash" style="font-size: 20px; color:#FF0000; cursor:pointer;" onclick="deleteRow('<?php echo $resListing1['id']; ?>');"></i></td>

  <td style="display:none;"><div align="center" >
<select name="lotNoMaster" id="lotNoMaster<?php echo $resListing1['id']; ?>" style="width: 65px; text-align: center; padding: 2px;">
<?php
$lotDataq=GetPageRecord('*','lotMaster','1 and id="'.$lotId.'" order by id');
while($lotData=mysqli_fetch_array($lotDataq)){ ?>
<option value="<?php echo $lotData['id']; ?>" <?php if($lotData['id']==$resListing1['lotNoMaster']){ ?> selected="selected" <?php } ?>><?php echo $lotData['name']; ?></option>
<?php } ?>

</select>
</div></td>

<td height="20" align="right"><div align="center">
  <input name="item_trims" type="text"  id="item_trims<?php echo $resListing1['id']; ?>" value="<?php echo $resListing1['item_trims']; ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" readonly="readonly">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="item_code" type="text"  id="item_code<?php echo $resListing1['id']; ?>" value="<?php echo $resListing1['item_code']; ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" readonly="readonly">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="vendor_name" type="text"  id="vendor_name<?php echo $resListing1['id']; ?>" value="<?php echo $resListing1['vendor_name']; ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" readonly="readonly">
</div></td>


<td height="20" align="right"><div align="center">
  <input name="pono" type="text"  id="pono<?php echo $resListing1['id']; ?>" value="<?php echo $resListing1['pono']; ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" readonly="readonly">
</div></td>



<td height="20" align="right"><div align="center">
  <input name="receivedqty" type="text"  id="receivedqty<?php echo $resListing1['id']; ?>" value="<?php echo $resListing1['receivedqty']; ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" readonly="readonly">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="totalorderqty" type="text"  id="totalorderqty<?php echo $resListing1['id']; ?>" value="<?php echo $resListing1['totalorderqty']; ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" readonly="readonly">
</div></td>
<?php

$totalw=GetPageRecord('*','grnMaster','id="'.$_REQUEST['lotrec'].'"');
						$totalsw=mysqli_fetch_array($totalw);

?>

<td height="20" align="right" style="display:none;"><div align="center">
  <input name="lotno" type="text"  id="lotno<?php echo $resListing1['id']; ?>" value="" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" readonly="readonly">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="lotreceiveddate" type="date"   id="lotreceiveddate<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['lotreceiveddate']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onchange="savemeasurmentdata<?php echo $resListing1['id']; ?>();" >
</div></td>

// <script>
// $( function(){
// 	$( "#lotreceiveddate<?php echo $resListing1['id']; ?>" ).datepicker();
// } );

// </script>

<td height="20" align="right"><div align="center">
  <input name="recievedutytlot" type="text"  id="recievedutytlot<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['recievedutytlot']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" >
</div></td>


<td height="20" align="right"><div align="center">
  <input name="recievedutytillnow" type="text"  id="recievedutytillnow<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['recievedutytillnow']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" >
</div></td>


<td height="20" align="right"><div align="center">
  <input name="balancetoreceive" type="text"  id="balancetoreceive<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['balancetoreceive']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" >
</div></td>

<td height="20" align="right"><div align="center">
  <input name="inspectiondate" type="date"  id="inspectiondate<?php echo $resListing1['id']; ?>" value="<?php echo $resListing1['inspectiondate'];  ?>" autocomplete="off"  style="width:95px; text-align:center;" onchange="savemeasurmentdata<?php echo $resListing1['id']; ?>();" >
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
var okayqty = encodeURI($('#okayqty<?php echo $resListing1['id']; ?>').val());
var inspectionqty = encodeURI($('#inspectionqty<?php echo $resListing1['id']; ?>').val());
var rejectedqty = encodeURI($('#rejectedqty<?php echo $resListing1['id']; ?>').val());
var disputedqty = encodeURI($('#disputedqty<?php echo $resListing1['id']; ?>').val());
var remarks = encodeURI($('#remarks<?php echo $resListing1['id']; ?>').val());

$('#savemeasurmentdata').load('apparelbomaction.php?action=savemaintenanceinspectioninput&id=<?php echo encode($resListing1['id']); ?>&item_trims='+item_trims+'&item_code='+item_code+'&vendor_name='+vendor_name+'&pono='+pono+'&receivedqty='+receivedqty+'&totalorderqty='+totalorderqty+'&lotreceiveddate='+lotreceiveddate+'&recievedutytlot='+recievedutytlot+'&recievedutytillnow='+recievedutytillnow+'&balancetoreceive='+balancetoreceive+'&inspectiondate='+inspectiondate+'&okayqty='+okayqty+'&rejectedqty='+rejectedqty+'&disputedqty='+disputedqty+'&remarks='+remarks+'&inspectionqty='+inspectionqty);

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
