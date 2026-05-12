<?php
include "inc.php";
?>




<?php
if($_REQUEST['add']==1){
$namevalueadd = 'parentId="'.decode($_REQUEST['parentId']).'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",status=1';
addlistinggetlastid('loadDebitnoteMaster',$namevalueadd);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
deleteRecord('loadDebitnoteMaster','id="'.$_REQUEST['id'].'"');
}
$sNo2 = 0;
$select='';
$where='';
$rs='';
$select='*';
$where='parentId="'.decode($_REQUEST['parentId']).'"  and status=1  order by id asc';
$rs=GetPageRecord($select,'loadDebitnoteMaster',$where);
while($resListing1=mysqli_fetch_array($rs)){ ?>

<?php
$sNo2++;
?>

<tr height="20">
  <td align="center"><i class="fa fa-trash" style="font-size: 20px; color:#FF0000; cursor:pointer;" onclick="deleteRow('<?php echo $resListing1['id']; ?>');"></i></td>
<td height="20" align="right"><div align="center">
  <select name="itemcode" id="itemcode<?php echo $resListing1['id']; ?>" style="width:95px; text-align:center;" onchange="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
    <option value="">Select</option>
<?php
$rss=GetPageRecord('*','indentCreationMaster','1 and id="'.$_REQUEST['po'].'"');
$ressListing1=mysqli_fetch_array($rss);

$rssp=GetPageRecord('*','indentCreationMaster','1 and poNumber="'.$ressListing1['poNumber'].'"');
while($ressListing2=mysqli_fetch_array($rssp)){
$rsdd=GetPageRecord($select,'styleSubCategoryMaster','1 and id="'.$ressListing2['materialId'].'"');
$resddListing1=mysqli_fetch_array($rsdd);
?>

    <option value="<?php echo $resddListing1['id']; ?>" <?php if($resddListing1['id'] == $resListing1['itemcode']){?> selected <?php } ?>><?php echo $resddListing1['name']; ?></option>
  <?php } ?>
  </select>
</div></td>

<td height="20" align="right"><div align="center">
  <input name="hsncode" type="text"  id="hsncode<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['hsncode']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <select name="reason"  id="reason<?php echo $resListing1['id']; ?>"    style="width:105px; text-align:center;" onchange="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
<option value="1" <?php if($resListing1['reason'] == "1"){?> selected <?php } ?> >Excess Supply</option>
<option value="2" <?php if($resListing1['reason'] == "2"){?> selected <?php } ?>>Short Received</option>
<option value="3" <?php if($resListing1['reason'] == "3"){?> selected <?php } ?>>Rate Difference</option>
<option value="4" <?php if($resListing1['reason'] == "4"){?> selected <?php } ?>>Calculation Error</option>
<option value="5" <?php if($resListing1['reason'] == "5"){?> selected <?php } ?>>Different Material</option>


</select>


</div></td>



<!--<td height="20" align="right"><div align="center">-->
<!--  <input name="reason" type="text" id="reason<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['reason']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">-->
<!--</div></td>-->




<td height="20" align="right"><div align="center">
  <input name="uom" type="text" id="uom<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['uom']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="billno" type="text" id="billno<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['billno']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="qty" type="text" class="qty" id="qty<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['qty']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="rate" type="text" id="rate<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['rate']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="amnt" type="text" class="amnt" id="amnt<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['amnt']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="discamt" type="text"  id="discamt<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['discamt']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="taxvalue" type="text" class="taxvalue" id="taxvalue<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['taxvalue']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td height="20" align="right"><div align="center">
  <input name="cgstrate" type="text" id="cgstrate<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['cgstrate']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="cgstamt" type="text" class="cgstamt" id="cgstamt<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['cgstamt']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="sgstrate" type="text" id="sgstrate<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['sgstrate']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="sgstamt" type="text" class="sgstamt" id="sgstamt<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['sgstamt']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="igstrate" type="text" id="igstrate<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['igstrate']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="igstamt" type="text" class="igstamt" id="igstamt<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['igstamt']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="utgstrate" type="text" id="utgstrate<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['utgstrate']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="utgstamt" type="text" class="utgstamt" id="utgstamt<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['utgstamt']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


  </tr>

<script>
 savemeasurmentdata<?php echo $resListing1['id']; ?>();
function savemeasurmentdata<?php echo $resListing1['id']; ?>(){
var itemcode = encodeURI($('#itemcode<?php echo $resListing1['id']; ?>').val());
var hsncode= encodeURI($('#hsncode<?php echo $resListing1['id']; ?>').val());
var reason= encodeURI($('#reason<?php echo $resListing1['id']; ?>').val());
var uom= encodeURI($('#uom<?php echo $resListing1['id']; ?>').val());
var qty= encodeURI($('#qty<?php echo $resListing1['id']; ?>').val());
var rate= encodeURI($('#rate<?php echo $resListing1['id']; ?>').val());
var billno= encodeURI($('#billno<?php echo $resListing1['id']; ?>').val());
var discamt= encodeURI($('#discamt<?php echo $resListing1['id']; ?>').val());
var cgstrate= encodeURI($('#cgstrate<?php echo $resListing1['id']; ?>').val());
var sgstrate= encodeURI($('#sgstrate<?php echo $resListing1['id']; ?>').val());
var igstrate= encodeURI($('#igstrate<?php echo $resListing1['id']; ?>').val());
var utgstrate= encodeURI($('#utgstrate<?php echo $resListing1['id']; ?>').val());


var totalamnt=Number(rate*qty);
$('#amnt<?php echo $resListing1['id']; ?>').val(totalamnt);
var amnt = encodeURI($('#amnt<?php echo $resListing1['id']; ?>').val());

var totaltaxvalue = Number(totalamnt)+Number(discamt);
$('#taxvalue<?php echo $resListing1['id']; ?>').val(totaltaxvalue)
var taxvalue= encodeURI($('#taxvalue<?php echo $resListing1['id']; ?>').val());

var totalcgstamnt = Number(taxvalue*(cgstrate/100));
$('#cgstamt<?php echo $resListing1['id']; ?>').val(totalcgstamnt.toFixed(2))
var cgstamt= encodeURI($('#taxvalue<?php echo $resListing1['id']; ?>').val());

var totalsgstamnt = Number(taxvalue*(sgstrate/100));
$('#sgstamt<?php echo $resListing1['id']; ?>').val(totalsgstamnt.toFixed(2))
var sgstamt= encodeURI($('#sgstamt<?php echo $resListing1['id']; ?>').val());

var totaligstamnt = Number(taxvalue*(igstrate/100));
$('#igstamt<?php echo $resListing1['id']; ?>').val(totaligstamnt.toFixed(2))
var igstamt= encodeURI($('#igstamt<?php echo $resListing1['id']; ?>').val());

var totalutgstamnt = Number(taxvalue*(utgstrate/100));
$('#utgstamt<?php echo $resListing1['id']; ?>').val(totalutgstamnt.toFixed(2))
var utgstamt= encodeURI($('#utgstamt<?php echo $resListing1['id']; ?>').val());

$('#savemeasurmentdata').load('allaction.php?action=savesupplierdebitnote&id=<?php echo encode($resListing1['id']); ?>&itemcode='+itemcode+'&hsncode='+hsncode+'&reason='+reason+'&uom='+uom+'&rate='+rate+'&qty='+qty+'&amnt='+amnt+'&billno='+billno+'&discamt='+discamt+'&taxvalue='+taxvalue+'&cgstrate='+cgstrate+'&cgstamt='+cgstamt+'&sgstrate='+sgstrate+'&sgstamt='+sgstamt+'&igstamt='+igstamt+'&igstrate='+igstrate+'&utgstamt='+utgstamt+'&utgstrate='+utgstrate);


/////////////////////////////////////////////////////////////////////////////////
var totalcont=0;
$('.qty').each(function() {
 totalcont += Number($(this).val());
});
totalcont= parseFloat(totalcont).toFixed(2);
$('#totalqty').text(totalcont);


var totalamt=0;
$('.amnt').each(function() {
 totalamt += Number($(this).val());
});
totalamt= parseFloat(totalamt).toFixed(2);
$('#totalamnt').text(totalamt);

var totaltax=0;
$('.taxvalue').each(function() {
 totaltax += Number($(this).val());
});
totaltax= parseFloat(totaltax).toFixed(2);
$('#totaltax').text(totaltax);

var totalcg=0;
$('.cgstamt').each(function() {
 totalcg += Number($(this).val());
});
totalcg= parseFloat(totalcg).toFixed(2);
$('#totalcgst').text(totalcg);
$('#totalcgst1').text(totalcg);

var totalsg=0;
$('.sgstamt').each(function() {
 totalsg += Number($(this).val());
});
totalsg= parseFloat(totalsg).toFixed(2);
$('#totalsgst').text(totalsg);
$('#totalsgst1').text(totalsg);

var totalig=0;
$('.igstamt').each(function() {
 totalig += Number($(this).val());
});
totalig= parseFloat(totalig).toFixed(2);
$('#totaligst').text(totalig);
$('#totaligst1').text(totalig);

var totalut=0;
$('.utgstamt').each(function() {
 totalut += Number($(this).val());
});
totalut= parseFloat(totalut).toFixed(2);
$('#totalutgst').text(totalut);
$('#totalutgst1').text(totalut);

}



</script>
  <?php } ?>
  <?php if($sNo2==0){ ?>

<tr style="padding:8px;text-align: center; width: 100%;background-color: #efefef;"><td colspan="50"><div align="center">No Record Found.</div></td></tr>




<div align="center">
  <?php } ?>
</div>
<tr id="savemeasurmentdata" style="display:none;"></tr>
