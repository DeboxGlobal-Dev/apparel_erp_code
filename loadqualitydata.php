<?php
include "inc.php";
$lotId=$_REQUEST['lotId'];

if($_REQUEST['add']==1){
$namevalueadd = 'styleId="'.decode($_REQUEST['styleId']).'",costsheetVersionId=1,addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",status=1,lotNoMaster="'.$lotId.'",fabricType="'.$_REQUEST['fabricType'].'"';
addlistinggetlastid('qualitymodulemaster',$namevalueadd);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
deleteRecord('qualitymodulemaster','id="'.$_REQUEST['id'].'"');
}

$sNo2 = 0;
$select='';
$where='';
$rs='';
$select='*';
$where=' styleId="'.decode($_REQUEST['styleId']).'" and costsheetVersionId=1 and status=1 and deletestatus=0 and lotNoMaster="'.$lotId.'" order by id asc';
$rs=GetPageRecord($select,'qualitymodulemaster',$where);
while($resListing1=mysqli_fetch_array($rs)){
$sNo2++;
?>

<tr height="20">
  <td align="center"><i class="fa fa-trash" style="font-size: 20px; color:#FF0000; cursor:pointer;" onclick="deleteRow('<?php echo $resListing1['id']; ?>');"></i></td>


<td><div align="center">
<select name="lotNoMaster" id="lotNoMaster<?php echo $resListing1['id']; ?>" style="width: 65px; text-align: center; padding: 2px;" onchange="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
<?php
$lotDataq=GetPageRecord('*','lotMaster','1 and id="'.$lotId.'" order by id');
while($lotData=mysqli_fetch_array($lotDataq)){ ?>
<option value="<?php echo $lotData['id']; ?>" <?php if($lotData['id']==$resListing1['lotNoMaster']){ ?> selected="selected" <?php } ?>><?php echo $lotData['name']; ?></option>
<?php } ?>

</select>
</div></td>


<td height="20" align="right"><div align="center">
  <input name="pee_empro" type="text"  id="pee_empro<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['pee_empro']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td><div align="center">
  <input name="shadelot" type="text"  id="shadelot<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['shadelot']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>




<td align="right"><div align="center">
  <input name="on_tag" type="text"  id="on_tag<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['on_tag']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td align="right"><div align="center">
  <input name="actual" type="text"  id="actual<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['actual']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


  <td align="right"><div align="center">
   <input name="beforew" type="text"  id="beforew<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['beforew']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
   </div></td>
   <td align="right"><div align="center">
   <input name="afterw" type="text"  id="afterw<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['afterw']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
   </div></td>

<td align="right"><div align="center">
  <input name="required" type="text"  id="required<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['required']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td align="right"><div align="center">
  <input name="actuala" type="text"  id="actuala<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['actuala']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td align="right"><div align="center">
  <input name="l" type="text"  id="l<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['l']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

   <td align="right"><div align="center">
   <input name="w" type="text"  id="w<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['w']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
   </div></td>


<td width="802"><div align="center">
  <input name="ll" type="text"  id="ll<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['ll']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td width="802"><div align="center">
  <input name="ww" type="text"  id="ww<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['ww']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td width="802" style="background-color: #ffe9a0;"><div align="center">
  <input name="w03e" type="number" min="0"  id="w03e<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['w03e']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td width="802" style="background-color: #ffe9a0;"><div align="center">
  <input name="w36e" type="number" min="0" id="w36e<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['w36e']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td width="802" style="background-color: #ffe9a0;"><div align="center">
  <input name="w69e" type="number" min="0" id="w69e<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['w69e']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td width="802" style="background-color: #ffe9a0;"><div align="center">
  <input name="wabove9e" type="number" min="0" id="wabove9e<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['wabove9e']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td width="802" style="background-color: #ffe9a0;"><div align="center">
  <input name="s03t" type="number" min="0" id="s03t<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['s03t']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td width="802" style="background-color: #ffe9a0;"><div align="center">
  <input name="s36t" type="number" min="0" id="s36t<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['s36t']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td width="802" style="background-color: #ffe9a0;"><div align="center">
  <input name="s69t" type="number" min="0" id="s69t<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['s69t']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td width="802" style="background-color: #ffe9a0;"><div align="center">
  <input name="sabove9t" type="number" min="0" id="sabove9t<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['sabove9t']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td width="802" style="background-color: #ffe9a0;"><div align="center">
  <input name="s03b" type="number" min="0" id="s03b<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['s03b']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>



<td width="802" style="background-color: #ffe9a0;"><div align="center">
  <input name="s36b" type="number" min="0" id="s36b<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['s36b']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>


<td width="802" style="background-color: #ffe9a0;"><div align="center">
  <input name="fc" type="number" min="0" id="fc<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['fc']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td width="802" style="background-color: #ffe9a0;"><div align="center">
  <input name="wb" type="number" min="0" id="wb<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['wb']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td width="802" style="background-color: #ffe9a0;"><div align="center">
  <input name="patta" type="number" min="0" id="patta<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['patta']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td width="802" style="background-color: #ffe9a0;"><div align="center">
  <input name="Ho01le" type="number" min="0" id="Ho01le<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['Ho01le']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>
<td width="802" style="background-color: #ffe9a0;"><div align="center">
  <input name="Hoabovee" type="number" min="0" id="Hoabovee<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['Hoabovee']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td width="802" style="background-color: #ffe9a0;"><div align="center">
  <input name="p03d" type="number" min="0" id="p03d<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['p03d']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td width="802" style="background-color: #ffe9a0;"><div align="center">
  <input name="p36d" type="number" min="0" id="p36d<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['p36d']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>
<td width="802" style="background-color: #ffe9a0;"><div align="center">
  <input name="p69d" type="number" min="0" id="p69d<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['p69d']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td width="802" style="background-color: #ffe9a0;"><div align="center">
  <input name="paboved" type="number" min="0" id="paboved<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['paboved']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td width="42" style="background-color: #ffe9a0;"><div align="center">
  <input name="inches" type="number" min="0" id="inches<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['inches']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td width="53" align="center"><div align="center">
  <input name="bowing" type="number" min="0" id="bowing<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['bowing']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td width="53" align="center"><div align="center">
  <input name="totalpointsfound" type="number" min="0" id="totalpointsfound<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['totalpointsfound']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td width="53" align="center" style="background-color: #a4b9f5;"><div align="center">
  <input name="pperhun" type="text"  id="pperhun<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['pperhun']); ?>" autocomplete="off"  style=" width: 50px;text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>

<td width="53" align="center"><div align="center">
  <input name="remarks" type="text"  id="remarks<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['remarks']); ?>" autocomplete="off"  style="width:150px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();">
</div></td>
  </tr>

  <script>
function savemeasurmentdata<?php echo $resListing1['id']; ?>(){

var pee_empro = encodeURI($('#pee_empro<?php echo $resListing1['id']; ?>').val());
var shadelot = encodeURI($('#shadelot<?php echo $resListing1['id']; ?>').val());
var on_tag = encodeURI($('#on_tag<?php echo $resListing1['id']; ?>').val());
var actual = encodeURI($('#actual<?php echo $resListing1['id']; ?>').val());
var required = encodeURI($('#required<?php echo $resListing1['id']; ?>').val());
var actuala = encodeURI($('#actuala<?php echo $resListing1['id']; ?>').val());
var l = encodeURI($('#l<?php echo $resListing1['id']; ?>').val());
var w = encodeURI($('#w<?php echo $resListing1['id']; ?>').val());

var ll = encodeURI($('#ll<?php echo $resListing1['id']; ?>').val());
var ww = encodeURI($('#ww<?php echo $resListing1['id']; ?>').val());

var w03e = encodeURI($('#w03e<?php echo $resListing1['id']; ?>').val());
var w36e = encodeURI($('#w36e<?php echo $resListing1['id']; ?>').val());
var w69e = encodeURI($('#w69e<?php echo $resListing1['id']; ?>').val());
var wabove9e = encodeURI($('#wabove9e<?php echo $resListing1['id']; ?>').val());

var s03t = encodeURI($('#s03t<?php echo $resListing1['id']; ?>').val());
var s36t = encodeURI($('#s36t<?php echo $resListing1['id']; ?>').val());
var s69t = encodeURI($('#s69t<?php echo $resListing1['id']; ?>').val());
var sabove9t = encodeURI($('#sabove9t<?php echo $resListing1['id']; ?>').val());
var s03b = encodeURI($('#s03b<?php echo $resListing1['id']; ?>').val());
var s36b = encodeURI($('#s36b<?php echo $resListing1['id']; ?>').val());
var fc = encodeURI($('#fc<?php echo $resListing1['id']; ?>').val());

var wb = encodeURI($('#wb<?php echo $resListing1['id']; ?>').val());
var patta = encodeURI($('#patta<?php echo $resListing1['id']; ?>').val());
var Ho01le = encodeURI($('#Ho01le<?php echo $resListing1['id']; ?>').val());
var Hoabovee = encodeURI($('#Hoabovee<?php echo $resListing1['id']; ?>').val());

var p03d = encodeURI($('#p03d<?php echo $resListing1['id']; ?>').val());
var p36d = encodeURI($('#p36d<?php echo $resListing1['id']; ?>').val());
var p69d = encodeURI($('#p69d<?php echo $resListing1['id']; ?>').val());
var paboved = encodeURI($('#paboved<?php echo $resListing1['id']; ?>').val());

var inches = encodeURI($('#inches<?php echo $resListing1['id']; ?>').val());
var bowing = encodeURI($('#bowing<?php echo $resListing1['id']; ?>').val());


var beforew = encodeURI($('#beforew<?php echo $resListing1['id']; ?>').val());
var afterw = encodeURI($('#afterw<?php echo $resListing1['id']; ?>').val());

var pointsfound = Number(w03e)+Number(s03t)+Number(s03b)+Number(p03d)+Number(fc)+Number(w36e*2)+Number(s36t*2)+Number(s36b*2)+Number(Ho01le*2)+Number(p36d*2)+Number(w69e*3)+Number(s69t*3)+Number(p69d*3)+Number(wabove9e*4)+Number(sabove9t*4)+Number(wb*4)+Number(patta*4)+Number(Hoabovee*4)+Number(paboved*4);
 $('#totalpointsfound<?php echo $resListing1['id']; ?>').val(pointsfound);
var totalpointsfound = encodeURI($('#totalpointsfound<?php echo $resListing1['id']; ?>').val());

var sumTotal = Number(totalpointsfound/actual)*Number(10000/(2.54*actuala));
 $('#pperhun<?php echo $resListing1['id']; ?>').val(sumTotal);
var pperhun = encodeURI($('#pperhun<?php echo $resListing1['id']; ?>').val());

var remarks = encodeURI($('#remarks<?php echo $resListing1['id']; ?>').val());
var lotNoMaster = encodeURI($('#lotNoMaster<?php echo $resListing1['id']; ?>').val());

$('#savemeasurmentdata').load('apparelbomaction.php?action=savequalitymoduledata&id=<?php echo encode($resListing1['id']); ?>&pee_empro='+pee_empro+'&shadelot='+shadelot+'&on_tag='+on_tag+'&actual='+actual+'&required='+required+'&actuala='+actuala+'&l='+l+'&w='+w+'&ll='+ll+'&ww='+ww+'&w03e='+w03e+'&w36e='+w36e+'&w69e='+w69e+'&wabove9e='+wabove9e+'&s03t='+s03t+'&s36t='+s36t+'&s69t='+s69t+'&sabove9t='+sabove9t+'&s03b='+s03b+'&s36b='+s36b+'&fc='+fc+'&wb='+wb+'&patta='+patta+'&Ho01le='+Ho01le+'&Hoabovee='+Hoabovee+'&p03d='+p03d+'&p36d='+p36d+'&p69d='+p69d+'&paboved='+paboved+'&inches='+inches+'&bowing='+bowing+'&totalpointsfound='+totalpointsfound+'&pperhun='+pperhun+'&remarks='+remarks+'&lotNoMaster='+lotNoMaster+'&beforew='+beforew+'&afterw='+afterw);


}
</script>
  <?php } ?>
  <?php if($sNo2==0){ ?>

<tr style="padding:8px;text-align: center; width: 100%;background-color: #efefef;"><td colspan="50"><div align="center">No Record Found.</div></td></tr>
<div align="center">
  <?php } ?>
</div>
<tr id="savemeasurmentdata" style="display:none;"></tr>



