<?php
include "inc.php";
?>




<?php
if($_REQUEST['add']==1){
$namevalueadd = 'parentId="'.decode($_REQUEST['parentId']).'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",status=1';
addlistinggetlastid('loadmaintenance',$namevalueadd);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
deleteRecord('loadmaintenance','id="'.$_REQUEST['id'].'"');
}
$sNo2 = 0;
$select='';
$where='';
$rs='';
$select='*';
$where='parentId="'.decode($_REQUEST['parentId']).'"  and status=1  order by id asc';
$rs=GetPageRecord($select,'loadmaintenance',$where);
while($resListing1=mysqli_fetch_array($rs)){ ?>

<?php
$sNo2++;

$select='*';
$wherex='id="'.decode($_REQUEST['parentId']).'"';
$rsx=GetPageRecord($select,'maintenancegi_Master',$wherex);
$resListing1x=mysqli_fetch_array($rsx);
?>

<tr height="20">
  <td align="center"><i class="fa fa-trash" style="font-size: 20px; color:#FF0000; cursor:pointer;" onclick="deleteRow('<?php echo $resListing1['id']; ?>');"></i></td>
<td height="20" align="right"><div align="center">
  <select name="itemcode" id="itemcode<?php echo $resListing1['id']; ?>" <?php if($resListing1x['approvedstatus']=='1'){ ?> disabled <?php } ?> style="width:95px; text-align:center;" onchange="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
    <option value="">Select</option>
    <?php
$select='*';
$where='1  order by id asc';
$rss=GetPageRecord($select,'maintenancegeneral_Master',$where);
while($resListing1s=mysqli_fetch_array($rss)){ ?>
  ?>

    <option <?php if($resListing1['item']==$resListing1s['id']){ ?>selected <?php } ?>value="<?php echo $resListing1s['id']; ?>"><?php echo $resListing1s['material']; ?> -<?php echo $resListing1s['color']; ?></option>
<?php } ?>

  </select>
</div></td>

<td height="20" align="right"><div align="center">
  <input name="hsncode" type="text"  id="hsncode<?php echo $resListing1['id']; ?>" <?php if($resListing1x['approvedstatus']=='1'){ ?> readonly <?php } ?> value="<?php echo stripslashes($resListing1['size']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>








<td height="20" align="right"><div align="center">
  <input name="reason" type="text" id="reason<?php echo $resListing1['id']; ?>"  <?php if($resListing1x['approvedstatus']=='1'){ ?> readonly <?php } ?> value="<?php echo stripslashes($resListing1['requestedquantity']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>




<td height="20" align="right"><div align="center">
  <input name="uom" type="text" id="uom<?php echo $resListing1['id']; ?>"  <?php if($resListing1x['approvedstatus']=='1'){ ?> readonly <?php } ?> value="<?php echo stripslashes($resListing1['uom']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>



<td height="20" align="right"><div align="center">
  <input name="qty" type="text" class="qty" id="qty<?php echo $resListing1['id']; ?>"  <?php if($resListing1x['approvedstatus']=='1'){ ?> readonly <?php } ?> value="<?php echo stripslashes($resListing1['purpose']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">


    <select name="rate" id="rate<?php echo $resListing1['id']; ?>" <?php if($resListing1x['approvedstatus']=='1'){ ?> disabled <?php } ?> style="width:95px; text-align:center;" onchange="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
    <option value="">Select</option>
    <?php
$select='*';
$wherea='1  order by id asc';
$rssa=GetPageRecord($select,'suppliersMaster',$wherea);
while($resListing1sa=mysqli_fetch_array($rssa)){ ?>
  ?>

    <option <?php if($resListing1['supplier']==$resListing1sa['id']){ ?>selected <?php } ?>value="<?php echo $resListing1sa['id']; ?>"><?php echo $resListing1sa['name']; ?> </option>
<?php } ?>

  </select>


<!--  <input name="rate" type="text" id="rate<?php echo $resListing1['id']; ?>"  <?php if($resListing1x['approvedstatus']=='1'){ ?> readonly <?php } ?> value="<?php echo stripslashes($resListing1['supplier']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">-->
<!--</div></td>-->

<td height="20" align="right"><div align="center">
  <input name="amnt" type="text" class="amnt" id="amnt<?php echo $resListing1['id']; ?>"  <?php if($resListing1x['approvedstatus']=='1'){ ?> readonly <?php } ?>value="<?php echo stripslashes($resListing1['price']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>



<td height="20" align="right"><div align="center">
  <input name="cgstrate" type="text" id="cgstrate<?php echo $resListing1['id']; ?>"  readonly  <?php if($resListing1x['approvedstatus']=='1'){ ?> readonly <?php } ?>value="<?php echo stripslashes($resListing1['amount']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>



<td height="20" align="right"><div align="center">

    <select name="itemcode" id="cgstamt<?php echo $resListing1['id']; ?>" <?php if($resListing1x['approvedstatus']=='1'){ ?> disabled <?php } ?> style="width:95px; text-align:center;" onchange="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
    <option value="">Select</option>


    <option <?php if($resListing1['currency']=='1'){ ?>selected <?php } ?>value="1">USD</option>
        <option <?php if($resListing1['currency']=='2'){ ?>selected <?php } ?>value="2">INR</option>



  </select>


  </td>

<td height="20" align="right"><div align="center">
  <input name="sgstrate" type="text" id="sgstrate<?php echo $resListing1['id']; ?>"  <?php if($resListing1x['approvedstatus']=='1'){ ?> readonly <?php } ?> value="<?php echo stripslashes($resListing1['remark']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


  </tr>

<script>
 savemeasurmentdata<?php echo $resListing1['id']; ?>();
function savemeasurmentdata<?php echo $resListing1['id']; ?>(){
var itemcode = encodeURI($('#itemcode<?php echo $resListing1['id']; ?>').val());
var size= encodeURI($('#hsncode<?php echo $resListing1['id']; ?>').val());
var requestedquantity= encodeURI($('#reason<?php echo $resListing1['id']; ?>').val());
var uom= encodeURI($('#uom<?php echo $resListing1['id']; ?>').val());
var purpose= encodeURI($('#qty<?php echo $resListing1['id']; ?>').val());
var supplier= encodeURI($('#rate<?php echo $resListing1['id']; ?>').val());

var price= encodeURI($('#amnt<?php echo $resListing1['id']; ?>').val());


var currency= encodeURI($('#cgstamt<?php echo $resListing1['id']; ?>').val());
var remark= encodeURI($('#sgstrate<?php echo $resListing1['id']; ?>').val());

var calc=requestedquantity*price;
var amount= encodeURI($('#cgstrate<?php echo $resListing1['id']; ?>').val(calc));

$('#savemeasurmentdata').load('allaction.php?action=savemaintenancegi&id=<?php echo encode($resListing1['id']); ?>&itemcode='+itemcode+'&size='+size+'&requestedquantity='+requestedquantity+'&uom='+uom+'&supplier='+supplier+'&purpose='+purpose+'&price='+price+'&amount='+amount+'&currency='+currency+'&remark='+remark);

}
/////////////////////////////////////////////////////////////////////////////////



</script>
  <?php } ?>
  <?php if($sNo2==0){ ?>

<tr style="padding:8px;text-align: center; width: 100%;background-color: #efefef;"><td colspan="50"><div align="center">No Record Found.</div></td></tr>




<div align="center">
  <?php } ?>
</div>
<tr id="savemeasurmentdata" style="display:none;"></tr>
