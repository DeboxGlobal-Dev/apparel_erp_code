<?php
include('inc.php');
$lastId=decode($_REQUEST['lastid']);
$editId=$_REQUEST['editId'];
if($_REQUEST['action']=="addnewrow" && $_REQUEST['addsize']=='1'){
	$namevalue ='parentId="'.$lastId.'"';
	addlistinggetlastid('greigeRequisition',$namevalue);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['delrowid']!=''){
deleteRecord('greigeRequisition','id="'.$_REQUEST['delrowid'].'"');
}

$no = 1;
$wherenew='parentId="'.$lastId.'" and addFrom="requisition" order by id asc';
$rsnew=GetPageRecord('*','greigeRequisition',$wherenew);
while($rslistnew=mysqli_fetch_array($rsnew)){
?>
<tr>
	<td ><select id="srinkageId<?php echo $rslistnew['id']; ?>" name="srinkageId" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" onchange="changeWidth<?php echo $rslistnew['id']; ?>(this.value);savedata<?php echo $rslistnew['id']; ?>();" style="width:206px;">
	  <option value="">Select</option>
	<?php
	$wherethis='1 and materialSubTypeId=31 order by id desc';
	$rss=GetPageRecord('name,id','materialMaster',$wherethis);
	while($resListing1s=mysqli_fetch_array($rss)){
	?>
	<option value="<?php echo $resListing1s['id']; ?>" <?php if($resListing1s['id']==$rslistnew['srinkageId']){ echo "selected"; }?>><?php echo stripslashes($resListing1s['name']); ?></option>
	  <?php } ?>
	</select>
	</td>
	<td><input type="text" name="construction" id="construction<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" value="<?php echo $rslistnew['construction']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();"/></td>
	<!--<td >-->
	<!--<select id="greWidth<?php echo $rslistnew['id']; ?>" name="greWidth" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" onchange="savedata<?php echo $rslistnew['id']; ?>();">-->

	<!--</select>-->
		<!--</td>-->
	<td><input type="text" name="greWidth" id="greWidth<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" value="<?php echo $rslistnew['greWidth']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();"/></td>



	<td><input type="text" name="qty" id="qty<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" value="<?php echo $rslistnew['qty']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();" /></td>
	<td><select name="uom" id="uom<?php echo $rslistnew['id']; ?>" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" style="width:86px;" onchange="savedata<?php echo $rslistnew['id']; ?>();">
	  	<option value="meter" <?php if($rslistnew['id']=="meter"){ echo 'selected';} ?>>Meter</option>
		<option value="yard" <?php if($rslistnew['id']=="yard"){ echo 'selected';} ?>>Yard</option>
	</select>
	</td>

	<td><input type="text" name="processLoss" id="processLoss<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" value="<?php echo $rslistnew['processLoss']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();" /></td>

	<!--<td><select id="shrinkage<?php echo $rslistnew['id']; ?>" name="shrinkage" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" onchange="savedata<?php echo $rslistnew['id']; ?>();"></select></td>-->

	<td><input type="text" name="shrinkage"  id="shrinkage<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" value="<?php echo $rslistnew['shrinkage']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();" /></td>


	<td><input type="text" name="processCons"  id="processCons<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" value="<?php echo $rslistnew['processCons']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();" /></td>
	<td><input type="text" name="processWidth"  id="processWidth<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" value="<?php echo $rslistnew['processWidth']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();" /></td>


	<td><input type="text" name="finalQty" id="finalQty<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" value="<?php echo $rslistnew['finalQty']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();" readonly="readonly" /></td>


	<td><select name="supplier" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" style="width:86px;" id="supplier<?php echo $rslistnew['id']; ?>" onchange="savedata<?php echo $rslistnew['id']; ?>();">
        <option>Select</option>
        <?php
	$rssupplier=GetPageRecord('*','suppliersMaster','1 and deletestatus=0 order by name asc');
	while($rssupplierList=mysqli_fetch_array($rssupplier)){
	?>
        <option value="<?php echo $rssupplierList['id']; ?>" <?php if($rssupplierList['id']==$rslistnew['supplier']){ ?> selected <?php } ?>><?php echo $rssupplierList['name']; ?></option>
        <?php } ?>
      </select>
	</td>
	<td><input type="text" name="price" id="price<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" value="<?php echo $rslistnew['price']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();" /></td>

	<td><select id="currency<?php echo $rslistnew['id']; ?>" name="currency" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" displayname="Currency" onkeyup="savedata<?php echo $rslistnew['id']; ?>();" >
	 <option value="">Select</option>
	<?php
	$select='';
	$where='';
	$rs='';
	$select='*';
	$where=' 1 and status=1 order by name asc';
	$rs=GetPageRecord($select,'currencyMaster',$where);
	while($resListing=mysqli_fetch_array($rs)){
	?>
	<option value="<?php echo strip($resListing['name']); ?>" <?php if($resListing['name']==$rslistnew['currency']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
	<?php } ?>
	</select></td>
	<td align="center"><i class="fa fa-trash" style="font-size: 20px; color:#FF0000; cursor:pointer;" onclick="deleterow('<?php echo $rslistnew['id']; ?>');" ></i></td>
	<?php if($editId!=''){ ?><td align="center"><a href="#" onclick="opmodalpop('Amendment','newpop.php?action=amendactiongreige&requisitionId=<?php echo encode($lastId); ?>&materialType=1&materialId=<?php echo $rslistnew['srinkageId']; ?>&finalQty=<?php echo $rslistnew['finalQty']; ?>','700px','auto');" data-toggle="modal" data-target="#modalpop">Amend</a></td><?php } ?>
</tr>
<script>
function changeWidth<?php echo $rslistnew['id']; ?>(id){
	$('#greWidth<?php echo $rslistnew['id']; ?>').load('newaction.php?action=loadgreighwidth&id='+id+'&selected=<?php echo $rslistnew['greWidth']; ?>');
	$('#shrinkage<?php echo $rslistnew['id']; ?>').load('newaction.php?action=loadshrinkage&id='+id+'&selected=<?php echo $rslistnew['shrinkage']; ?>');
}

changeWidth<?php echo $rslistnew['id']; ?>('<?php echo $rslistnew['srinkageId']; ?>');

function savedata<?php echo $rslistnew['id']; ?>(){
var fnlqty =0;
var srinkageId = encodeURI($('#srinkageId<?php echo $rslistnew['id']; ?>').val());
var construction = encodeURI($('#construction<?php echo $rslistnew['id']; ?>').val());
var greWidth = encodeURI($('#greWidth<?php echo $rslistnew['id']; ?>').val());
var qty = encodeURI($('#qty<?php echo $rslistnew['id']; ?>').val());
var uom = encodeURI($('#uom<?php echo $rslistnew['id']; ?>').val());
var processLoss = encodeURI($('#processLoss<?php echo $rslistnew['id']; ?>').val());
var processCons = encodeURI($('#processCons<?php echo $rslistnew['id']; ?>').val());
var processWidth = encodeURI($('#processWidth<?php echo $rslistnew['id']; ?>').val());
var shrinkage = encodeURI($('#shrinkage<?php echo $rslistnew['id']; ?>').val());

if(qty!=''){
// 	fnlqty = Number(qty*processLoss)/100;

// 	fnlqty = Number(fnlqty)+Number(qty);

// 		fnlqtyasd = Number(fnlqty*shrinkage)/100;

// 	fnlqty=Number(fnlqtyasd + fnlqty);

fnlqty= ((qty/(100-processLoss)*100)/(100-shrinkage))*100;
fnlqty=Number(fnlqty);

fnlqty=Math.ceil(fnlqty);



}
var finalQty = document.getElementById('finalQty<?php echo $rslistnew['id']; ?>').value=fnlqty;

var supplier = encodeURI($('#supplier<?php echo $rslistnew['id']; ?>').val());
var price = encodeURI($('#price<?php echo $rslistnew['id']; ?>').val());
var currency = encodeURI($('#currency<?php echo $rslistnew['id']; ?>').val());

$('#savemeasurmentdata').load('newaction.php?action=saveshrinkagedata&id=<?php echo $rslistnew['id']; ?>&srinkageId='+srinkageId+'&construction='+construction+'&greWidth='+greWidth+'&qty='+qty+'&uom='+uom+'&processLoss='+processLoss+'&shrinkage='+shrinkage+'&finalQty='+finalQty+'&supplier='+supplier+'&price='+price+'&currency='+currency+'&processCons='+processCons+'&processWidth='+processWidth);

}
</script>
<?php
$no++;
}
if($no==1){
?>
<tr><td colspan="15" align="center">No Record Found.</td></tr>
<?php
}

?>
<tr id="savemeasurmentdata" style="display:none;"></tr>



