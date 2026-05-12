<?php
include('inc.php');
$lastId=decode($_REQUEST['lastid']);
$editId=$_REQUEST['editId'];
if($_REQUEST['action']=="addnewrow" && $_REQUEST['addsize']=='1'){
	$namevalue ='parentId="'.$lastId.'"';
	addlistinggetlastid('yarnRequisition',$namevalue);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['delrowid']!=''){
deleteRecord('yarnRequisition','id="'.$_REQUEST['delrowid'].'"');
}

$no = 1;
$wherenew='parentId="'.$lastId.'" and addFrom="requisition" order by id asc';
$rsnew=GetPageRecord('*','yarnRequisition',$wherenew);
while($rslistnew=mysqli_fetch_array($rsnew)){
?>

<tr>
  <td align="center"><i class="fa fa-trash" style="font-size: 20px; color:#FF0000; cursor:pointer;" onclick="deleterow('<?php echo $rslistnew['id']; ?>');" ></i></td>
  <td ><select id="srinkageId<?php echo $rslistnew['id']; ?>" name="srinkageId" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" onchange="changeWidth<?php echo $rslistnew['id']; ?>(this.value);savedata<?php echo $rslistnew['id']; ?>();" style="width:206px;">
      <option value="">Select</option>
      <?php
	$wherethis='1 and materialSubTypeId=32 order by id desc';
	$rss=GetPageRecord('name,id','materialMaster',$wherethis);
	while($resListing1s=mysqli_fetch_array($rss)){
	?>
      <option value="<?php echo $resListing1s['id']; ?>" <?php if($resListing1s['id']==$rslistnew['srinkageId']){ echo "selected"; }?>><?php echo stripslashes($resListing1s['name']); ?></option>
      <?php } ?>
    </select>
  </td>
  <td><input type="text" name="count" id="count<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" value="<?php echo $rslistnew['count']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();"/></td>
  <td><input type="text" name="diameter" id="diameter<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" value="<?php echo $rslistnew['diameter']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();"/></td>

  <td <?php if($_REQUEST['caseid']==2){ ?> style="display:none;"<?php } ?>><input type="text" name="gsm" id="gsm<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" value="<?php echo $rslistnew['gsm']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();"/></td>
  <td  <?php if($_REQUEST['caseid']==2){ ?> style="display:none;"<?php } ?>><input type="text" name="fabricWidth" id="fabricWidth<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" value="<?php echo $rslistnew['fabricWidth']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();"/></td>

  <td><input type="text" name="qty_cut" id="qty_cut<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" value="<?php echo $rslistnew['qty_cut']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();"/></td>
  <td><select name="uom" id="uom<?php echo $rslistnew['id']; ?>" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" style="width:86px;" onchange="savedata<?php echo $rslistnew['id']; ?>();">
      <option value="meter" <?php if($rslistnew['uom']=="meter"){ echo 'selected';} ?>>Meter</option>
      <option value="yard" <?php if($rslistnew['uom']=="yard"){ echo 'selected';} ?>>Yard</option>
      <option value="kg" <?php if($rslistnew['uom']=="kg"){ echo 'selected';} ?>>KG</option>
    </select></td>
  <td><input type="text" name="excess" id="excess<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" value="<?php echo $rslistnew['excess']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();"/></td>
  <td><input type="text" name="excess_qty_cut" id="excess_qty_cut<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control readonly"  value="<?php echo $rslistnew['excess_qty_cut']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();"/></td>
  <td><input type="text" name="smpl" id="smpl<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" value="<?php echo $rslistnew['smpl']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();"/></td>
  <td><input type="text" name="total_peice" id="total_peice<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control readonly"  value="<?php echo $rslistnew['total_peice']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();"/></td>
  <td><input type="text" name="avg" id="avg<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" value="<?php echo $rslistnew['avg']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();"/></td>
  <td><input type="text" name="total_consumption" id="total_consumption<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control readonly" value="<?php echo $rslistnew['total_consumption']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();"/></td>

  <?php
	$select='';
	$where='';
	$rs='';
	$select='*';
	$where=' 1 and deletestatus=0 order by id asc';
	$rspl=GetPageRecord($select,'processLossMaster',$where);
	while($rsplList=mysqli_fetch_array($rspl)){
	?>
  <td><input type="text" name="processLoss<?php echo $rslistnew['id']; ?>[]" id="processLoss<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" value="<?php echo $rsplList['persantage']; ?>"/>
  </td>
  <?php } ?>


  <td><input type="text" name="price" id="price<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control <?php if($editId!=''){ echo ''; } ?>" value="<?php echo $rslistnew['price']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();" /></td>
  <td><input type="text" name="yarn_req"  id="yarn_req<?php echo $rslistnew['id']; ?>" style="width:86px;" class="form-control <?php if($editId!=''){ echo ''; } ?>" value="<?php echo $rslistnew['yarn_req']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();" /></td>
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
  <td style="display:none;"><select id="currency<?php echo $rslistnew['id']; ?>" name="currency" style="width:86px;" class="form-control <?php if($editId!=''){ echo 'readonly'; } ?>" displayname="Currency" onblur="savedata<?php echo $rslistnew['id']; ?>();">
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
  <!--<?php if($editId!=''){ ?><td align="center"><a href="#" onclick="opmodalpop('Amendment','newpop.php?action=amendactiongreige&requisitionId=<?php echo encode($lastId); ?>&materialType=1&materialId=<?php echo $rslistnew['srinkageId']; ?>&finalQty=<?php echo $rslistnew['finalQty']; ?>','700px','auto');" data-toggle="modal" data-target="#modalpop">Amend</a></td><?php } ?>-->
</tr>
<script>
// function changeWidth<?php echo $rslistnew['id']; ?>(id){
// 	$('#greWidth<?php echo $rslistnew['id']; ?>').load('newaction.php?action=loadgreighwidth&id='+id+'&selected=<?php echo $rslistnew['greWidth']; ?>');
// 	$('#shrinkage<?php echo $rslistnew['id']; ?>').load('newaction.php?action=loadshrinkage&id='+id+'&selected=<?php echo $rslistnew['shrinkage']; ?>');
// }

// changeWidth<?php echo $rslistnew['id']; ?>('<?php echo $rslistnew['srinkageId']; ?>');

function savedata<?php echo $rslistnew['id']; ?>(){

var srinkageId = encodeURI($('#srinkageId<?php echo $rslistnew['id']; ?>').val());
var count = encodeURI($('#count<?php echo $rslistnew['id']; ?>').val());
var diameter = encodeURI($('#diameter<?php echo $rslistnew['id']; ?>').val());
var gsm = encodeURI($('#gsm<?php echo $rslistnew['id']; ?>').val());
var fabricWidth = encodeURI($('#fabricWidth<?php echo $rslistnew['id']; ?>').val());
var qty_cut = encodeURI($('#qty_cut<?php echo $rslistnew['id']; ?>').val());
var uom = encodeURI($('#uom<?php echo $rslistnew['id']; ?>').val());
var excess = encodeURI($('#excess<?php echo $rslistnew['id']; ?>').val());
var smpl = encodeURI($('#smpl<?php echo $rslistnew['id']; ?>').val());
var total_peice = encodeURI($('#total_peice<?php echo $rslistnew['id']; ?>').val());
var avg = encodeURI($('#avg<?php echo $rslistnew['id']; ?>').val());

var supplier = encodeURI($('#supplier<?php echo $rslistnew['id']; ?>').val());
var price = encodeURI($('#price<?php echo $rslistnew['id']; ?>').val());
var currency = encodeURI($('#currency<?php echo $rslistnew['id']; ?>').val());

//ex_cut_q count
var tt=Number(qty_cut) * Number(excess)/100;
var ty=Number(tt)+Number(qty_cut);
var ex_cut_q= encodeURI($('#excess_qty_cut<?php echo $rslistnew['id']; ?>').val(Number(ty)));
////////////////

var excess_qty_cut =Number(ty);

//total piece count
var t_peice = encodeURI($('#total_peice<?php echo $rslistnew['id']; ?>').val(Number(smpl) + Number(excess_qty_cut)));
var total_peice=Number(smpl) + Number(excess_qty_cut);
//////////////////

var t_consumption = encodeURI($('#total_consumption<?php echo $rslistnew['id']; ?>').val(Number(total_peice) * Number(avg)));
var total_consumption=Number(total_peice) * Number(avg);

var inps = document.getElementsByName('processLoss<?php echo $rslistnew['id']; ?>[]');
var calc1234 = 0;
var sr = 0;
var last_total_consumption = 0;
for(var i = 0; i <inps.length; i++) {

	var inp=inps[i];
	if(inp.value!=0){
		if(sr==0){
			last_total_consumption = Number(total_peice) * Number(avg);
		}
		var calc=last_total_consumption/(100-Number(inp.value));
		var calc1=Number(calc*100);
		calc1234 = calc1;
		last_total_consumption = calc1;
	sr++;
	}

}

var y_req = encodeURI($('#yarn_req<?php echo $rslistnew['id']; ?>').val(calc1234));
var yarn_req =Number(calc1234);



$('#savemeasurmentdata').load('newaction.php?action=saveyarnshrinkagedata&id=<?php echo $rslistnew['id']; ?>&srinkageId='+srinkageId+'&count='+count+'&diameter='+diameter+'&gsm='+gsm+'&fabricWidth='+fabricWidth+'&qty_cut='+qty_cut+'&uom='+uom+'&excess='+excess+'&excess_qty_cut='+excess_qty_cut+'&smpl='+smpl+'&total_peice='+total_peice+'&avg='+avg+'&total_consumption='+total_consumption+'&yarn_req='+yarn_req+'&supplier='+supplier+'&price='+price+'&currency='+currency);

}
</script>
<?php
$no++;
}
if($no==1){
?>
<tr>
  <td colspan="15" align="center">No Record Found.</td>
</tr>
<?php
}

?>
<tr id="savemeasurmentdata" style="display:none;"></tr>
