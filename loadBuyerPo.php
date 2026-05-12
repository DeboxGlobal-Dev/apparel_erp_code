<?php
include('inc.php');
if($_REQUEST['styleId']!=''){
$a=GetPageRecord('*','queryMaster','id="'.$_REQUEST['styleId'].'"');
$styleData=mysqli_fetch_array($a);
$sizeratio = getSizeRatio($styleData['sizeratio']);
$totalsizeratio = explode(':',$sizeratio);
$ratioSum = array_sum($totalsizeratio);

$b=GetPageRecord('*','buyerMaster','id='.$styleData['buyerId'].'');
$buyerData=mysqli_fetch_array($b);

$c=GetPageRecord('*','buyerPurchaseOrderMaster','styleId="'.$styleData['id'].'"');
$purchaseData=mysqli_fetch_array($c);
$buyerPurchaseId = $purchaseData['id'];

if($purchaseData['id']==''){
$dateAdded=date('Y-m-d h:i:s');
$namevalue ='buyerId="'.$buyerData['id'].'",styleId="'.$styleData['id'].'",addedBy='.$_SESSION['userid'].'';
$lastId = addlistinggetlastid('buyerPurchaseOrderMaster',$namevalue);
$buyerPurchaseId = $lastId;


$rsimgss=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$styleData['id'].'"');
while($imgresult=mysqli_fetch_array($rsimgss)){
	$namevalue22 ='purchaseOrderId="'.$lastId.'",styleId="'.$styleData['id'].'"';
	$lastIdthis = addlistinggetlastid('purchaseOrderStyleMaster',$namevalue22);

	$rssize=GetPageRecord('size','sizerangeMaster','id="'.$styleData['sizerange'].'"');
	$rssizelist=mysqli_fetch_array($rssize);
	$totalsize = explode(':',$rssizelist['size']);

  ///// fetch size ratio

  $no = 0;
	foreach($totalsize as $newtotalsize){
    ///formula for order qty from size ratio
    $ratioorderqty = round(($totalsizeratio[$no]/$ratioSum)*$imgresult['qty']);

		$namevalue ='parentId="'.$lastIdthis.'",styleId="'.$styleData['id'].'",size="'.$newtotalsize.'",color="'.$imgresult['colorId'].'",gdQty="'.$ratioorderqty.'",sectionType=1,finish=""';
		addlistinggetlastid('purchaseOrderStyleMaster',$namevalue);

  $no++;
	}
}

}

if($_REQUEST['addsize']==1 && $_REQUEST['colorid']!=''){
	$namevalue ='parentId="'.$_REQUEST['colorid'].'",styleId="'.$styleData['id'].'",sectionType=1,provision="'.$_REQUEST['pid'].'"';
	addlistinggetlastid('purchaseOrderStyleMaster',$namevalue);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['colorid']!=''){
	deleteRecord('purchaseOrderStyleMaster','id="'.$_REQUEST['colorid'].'"');
}

}
?>
<script>
function savebuyerpo(){

var orderNo = encodeURI($('#orderNo').val());
var orderDate = encodeURI($('#orderDate').val());
var orderTime = encodeURI($('#orderTime').val());
var department = encodeURI($('#department').val());
var purchaseOrderNo = encodeURI($('#purchaseOrderNo').val());
var purchaseOrderDate = encodeURI($('#purchaseOrderDate').val());
var deliveryDate = encodeURI($('#deliveryDate').val());
var docType = encodeURI($('#docType').val());
var docDescription = encodeURI($('#docDescription').val());
var discount = Number($('#discount').val());
var totalEd = Number($('#totalEd').val());
var totalVat = Number($('#totalVat').val());
var grossTotal = Number($('#grossTotal').val());
var styleId = encodeURI($('#styleId').val());
var buyerPurchaseId = encodeURI($('#buyerPurchaseId').val());
var buyerId = encodeURI($('#buyerId').val());
var amtTotal = Number($('#amtTotal').val());
var remark = encodeURI($('#remark').val());
var qtyTotal = encodeURI($('#qtyTotal').val());
calculateDiscount();

$('#poAction').load('allaction.php?styleId='+styleId+'&buyerId='+buyerId+'&buyerPurchaseId='+buyerPurchaseId+'&orderNo='+orderNo+'&orderDate='+orderDate+'&department='+department+'&purchaseOrderNo='+purchaseOrderNo+'&purchaseOrderDate='+purchaseOrderDate+'&deliveryDate='+deliveryDate+'&docType='+docType+'&docDescription='+docDescription+'&discount='+discount+'&totalEd='+totalEd+'&totalVat='+totalVat+'&grossTotal='+grossTotal+'&amtTotal='+amtTotal+'&remark='+remark+'&orderTime='+orderTime+'&qtyTotal='+qtyTotal);
}


function reload_page(){
parent.setupbox('showpage.crm?module=buyerpo&add=yes&styleid=<?php echo encode($_GET['styleId']); ?>');
}

</script>

<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" style="font-size:10px;">
  <tr>
    <td colspan="16" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:10px;">
  <tr>
    <td colspan="4" align="left" valign="top" scope="col"><strong>Company Name :</strong><?php echo $buyerData['name']; ?><br />
      <strong>Dispatch From:</strong>C-16, Phase-2 Ph-II, Noida,<br />
Noida (4000) - 201305<br />
Uttar Pradesh India<br />
<strong>Dispatch To:</strong>Aero Club - 3951<br />
<strong>Address:</strong> New Delhi    110061 Delhi India</td>
    <td width="50%" align="left" valign="top" scope="col" widtd="50%"><table border="0" align="right" cellpadding="4" cellspacing="0" widtd="100%" style="font-size:10px;">
      <tr>
        <td colspan="4" align="left" valign="middle" scope="col">Sales Order No.</td>
        <td widtd="50%" align="left" valign="top"  ><input name="orderNo" type="text" id="orderNo" style="padding:2px; border:1px solid #ccc; width:120px; box-sizing:border-box;" onkeyup="savebuyerpo();" value="<?php if($purchaseData['orderNo']!=''){ echo strip($purchaseData['orderNo']); }else{ echo 'SO-'.getStyleRefId($_GET['styleId']); } ?>"/></td>
      </tr>
      <tr>
        <td colspan="4" align="left" valign="middle" scope="col">Sales Order Date</td>
        <td align="left" valign="top" scope="col"><input name="orderDate" type="date" id="orderDate" style="padding:2px; border:1px solid #ccc; width:120px; box-sizing:border-box;"onkeyup="savebuyerpo();" value="<?php echo strip($purchaseData['orderDate']); ?>" /></td>
      </tr>
     <tr>
        <td colspan="4" align="left" valign="middle" scope="col">Sales Order Time</td>
        <td align="left" valign="top" scope="col"><input type="text" name="orderTime" id="orderTime" style="padding:2px; border:1px solid #ccc; width:120px; box-sizing:border-box;" onkeyup="savebuyerpo();" value="<?php echo strip($purchaseData['orderTime']); ?>" /></td>
      </tr>
      <tr>
        <td colspan="4" align="left" valign="middle" scope="col">Department</td>
        <td align="left" valign="top" scope="col">
		<select name="department" onchange="savebuyerpo();" style="padding:2px; border:1px solid #ccc; width:120px; box-sizing:border-box;">
			<option value="">Select</option>
			<option value="PD Merchandising" <?php if($purchaseData['department']=="PD Merchandising"){ echo 'selected';  }?>>PD Merchandising</option>
			<option value="Prod. Merchandising" <?php if($purchaseData['department']=="Prod. Merchandising"){ echo 'selected';  }?>>Prod. Merchandising</option>
		</select>
		</td>
      </tr>
      <tr>
        <td colspan="4" align="left" valign="middle" scope="col">Purchase Order No</td>
        <td align="left" valign="top" scope="col"><input name="purchaseOrderNo" type="text" id="purchaseOrderNo" style="padding:2px; border:1px solid #ccc; width:120px; box-sizing:border-box;" onkeyup="savebuyerpo();" value="<?php echo strip($purchaseData['purchaseOrderNo']); ?>" /></td>
      </tr>
      <tr>
        <td colspan="4" align="left" valign="middle" scope="col">Purchase Order Date</td>
        <td align="left" valign="top" scope="col"><input name="purchaseOrderDate" type="date" id="purchaseOrderDate" style="padding:2px; border:1px solid #ccc; width:120px; box-sizing:border-box;" onkeyup="savebuyerpo();"  value="<?php echo strip($purchaseData['purchaseOrderDate']); ?>" /></td>
      </tr>
      <tr>
        <td colspan="4" align="left" valign="middle" scope="col">Delivery Date</td>
        <td align="left" valign="top" scope="col"><input name="deliveryDate" type="date" id="deliveryDate" style="padding:2px; border:1px solid #ccc; width:120px; box-sizing:border-box;" onkeyup="savebuyerpo();" value="<?php echo strip($purchaseData['deliveryDate']); ?>" /></td>
      </tr>
      <tr>
        <td colspan="4" align="left" valign="middle" scope="col">Doc Type</td>
        <td align="left" valign="top" scope="col"><input name="docType" type="text" id="docType" style="padding:2px; border:1px solid #ccc; width:120px; box-sizing:border-box;" onkeyup="savebuyerpo();" value="<?php echo strip($purchaseData['docType']); ?>" /></td>
      </tr>
      <tr>
        <td colspan="4" align="left" valign="middle" scope="col">Doc Description</td>
        <td align="left" valign="top" scope="col"><input name="docDescription" type="text" id="docDescription" style="padding:2px; border:1px solid #ccc; width:120px; box-sizing:border-box;" onkeyup="savebuyerpo();" value="<?php echo strip($purchaseData['docDescription']); ?>" />

		<input type="hidden"  name="" id="buyerPurchaseId" value="<?php echo $buyerPurchaseId; ?>">
		<input type="hidden"  name="" id="styleId" value="<?php echo $styleData['id']; ?>">
		<input type="hidden"  name="" id="buyerId" value="<?php echo $buyerData['id']; ?>">		</td>
      </tr>
    </table></td>
  </tr>

</table></td>
  </tr>
  <tr>
    <td align="center" valign="top" width="738"><strong>S&nbsp;No.</strong></td>
    <td width="738" valign="top"><strong>Style&nbsp;No.</strong></td>
    <td width="738" valign="top" colspan="2"><strong>Description</strong></td>
    <td width="738" valign="top" align="center"><strong>Placement&nbsp;Qty</strong></td>
    <!--<td width="738" valign="top" align="center"><strong>UOM</strong></td>-->
    <td width="738" valign="top" align="center"><strong>Discount</strong></td>
    <td width="738" valign="top" align="center"><strong>ED</strong></td>
    <td width="738" valign="top" align="center"><strong>VAT&nbsp;/&nbsp;CST</strong></td>
    <td width="738" align="center" valign="top"><strong>Price</strong></td>
    <td width="738" align="center" valign="top"><strong>MRP</strong></td>
    <td width="738" align="center" valign="top"><strong>Amt</strong></td>
  </tr>
<?php
$totalfobothcolor = '';
$no = 1;
$imgresult='';
$selectimg='*';
$whereimg='1 and sectionType=0 and styleId="'.$styleData['id'].'"';
$rsimg=GetPageRecord($selectimg,'purchaseOrderStyleMaster',$whereimg);
while($imgresult=mysqli_fetch_array($rsimg)){
if($no==1){
?>

  <tr>
   <td width="738" align="center" valign="top"><?php echo $no; ?></td>
    <td width="738" valign="top"><input name="articleNo" type="text" id="articleNo<?php echo $imgresult['id']; ?>" style="padding:2px; border:1px solid #ccc; width:100px; box-sizing:border-box;" onkeyup="saveBuyerPoDetail<?php echo $imgresult['id']; ?>();" value="<?php echo $styleData['styleRefId']; ?>" /></td>
    <td width="738" valign="top" colspan="2"><input name="description" type="text" id="description<?php echo $imgresult['id']; ?>" style="padding:2px; border:1px solid #ccc; width:100px; box-sizing:border-box;" onkeyup="saveBuyerPoDetail<?php echo $imgresult['id']; ?>();"  value="<?php echo $imgresult['description']; ?>"/></td>
    <td width="738" valign="top" align="center"><input name="qty" type="text" id="qty<?php echo $imgresult['id']; ?>" style="padding:2px; border:1px solid #ccc; width:65px; box-sizing:border-box;" onkeyup="saveBuyerPoDetail<?php echo $imgresult['id']; ?>();" value="<?php echo $styleData['orderQty']; ?>" class="qtyclass"/></td>
   <!-- <td width="738" valign="top" align="center"><input name="uom" type="text" id="uom<?php echo $imgresult['id']; ?>" style="padding:2px; border:1px solid #ccc; width:40px; box-sizing:border-box;" onkeyup="saveBuyerPoDetail<?php echo $imgresult['id']; ?>();" value="<?php echo $imgresult['uom']; ?>" /></td>-->
    <td width="738" valign="top" align="center"><input name="discount" type="text" id="discount<?php echo $imgresult['id']; ?>" style="padding:2px; border:1px solid #ccc; width:35px; box-sizing:border-box;" onkeyup="saveBuyerPoDetail<?php echo $imgresult['id']; ?>();" value="<?php echo $imgresult['discount']; ?>" /></td>
    <td width="738" valign="top" align="center"><input name="ed" type="text" id="ed<?php echo $imgresult['id']; ?>" style="padding:2px; border:1px solid #ccc; width:35px;; box-sizing:border-box;" onkeyup="saveBuyerPoDetail<?php echo $imgresult['id']; ?>();" value="<?php echo $imgresult['ed']; ?>" /></td>
    <td width="738" valign="top" align="center"><input name="vat" type="text" id="vat<?php echo $imgresult['id']; ?>" style="padding:2px; border:1px solid #ccc; width:50px; box-sizing:border-box;" onkeyup="saveBuyerPoDetail<?php echo $imgresult['id']; ?>();" value="<?php echo $imgresult['vat']; ?>" /></td>
    <td width="738" align="center" valign="top"><input name="price" type="text" id="price<?php echo $imgresult['id']; ?>" style="padding:2px; border:1px solid #ccc; width:60px; box-sizing:border-box;" onkeyup="saveBuyerPoDetail<?php echo $imgresult['id']; ?>();" value="<?php echo $imgresult['price']; ?>" /></td>
    <td width="738" align="center" valign="top"><input name="mrp" type="text" id="mrp<?php echo $imgresult['id']; ?>" style="padding:2px; border:1px solid #ccc; width:60px; box-sizing:border-box;" onkeyup="saveBuyerPoDetail<?php echo $imgresult['id']; ?>();" value="<?php echo $imgresult['mrp']; ?>" /></td>
    <td width="738" align="center" valign="top"><input name="amt" type="text" id="amt<?php echo $imgresult['id']; ?>" style="padding:2px; border:1px solid #ccc; width:60px;; box-sizing:border-box;" onkeyup="saveBuyerPoDetail<?php echo $imgresult['id']; ?>();" value="<?php echo $imgresult['amt']; ?>" class="totalamt" readonly="readonly"/>
	<input type="hidden" id="orderStyleId<?php echo $imgresult['id']; ?>" value="<?php echo $imgresult['id']; ?>">	</td>
  </tr>

 <?php } ?>
  <tr>
    <td width="738" valign="top"><p>&nbsp;</p></td>
    <td colspan="7" valign="top">
	<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC">
      <tr>
        <td><strong>Destination</strong></td>
        <td><strong>Color</strong></td>
        <td><strong>Size</strong></td>
        <td><strong>Qty </strong></td>
        <td align="center"><div align="center"><strong><a href="JavaScript:Void(0);" onclick="addnewsize<?php echo $imgresult['id']; ?>(0);">Add</a></strong></div></td>
		<?php if($_REQUEST['module']=="buyerpo"){ ?><td align="center"><strong><a href="JavaScript:Void(0);" onclick="$('.showamend<?php echo $no; ?>').toggle();">Show&nbsp;Amend</a></strong></td><?php } ?>
		<td align="center"><div align="center"><strong><a href="JavaScript:Void(0);" onclick="addnewsize<?php echo $imgresult['id']; ?>(1);">Add&nbsp;Provision</a></strong></div></td>
		<script>
		function addnewsize<?php echo $imgresult['id']; ?>(pid){
		$('#loadBuyerPo').load('loadBuyerPo.php?styleId=<?php echo $styleData['id']; ?>&addsize=1&colorid=<?php echo $imgresult['id']; ?>&pid='+pid);
		}
		</script>


      </tr>
   <?php
$selectnew='*';
$totalorQty=0;
$wherenew='1 and sectionType=1 and styleId="'.$styleData['id'].'" and parentId="'.$imgresult['id'].'" order by id asc';
$rsnew=GetPageRecord($selectnew,'purchaseOrderStyleMaster',$wherenew);
while($rslistnew=mysqli_fetch_array($rsnew)){
?>
	  <tr>
        <td><input name="finish" type="text" id="finish<?php echo $rslistnew['id']; ?>" style="padding:2px; border:1px solid #ccc; width:90px; box-sizing:border-box;" onkeyup="addcolordetail<?php echo $rslistnew['id']; ?>();" value="<?php echo $rslistnew['finish']; ?>" /></td>
		<td>
		<select id="color<?php echo $rslistnew['id']; ?>" name="color" onchange="addcolordetail<?php echo $rslistnew['id']; ?>();" style="padding:2px; border:1px solid #ccc; width:90px; box-sizing:border-box;">
			<option value="">Select</option>
			<?php
			$select='';
			$where='';
			$rs='';
			$select='*';
			$where='1 and deletestatus=0 and status=1 and brandId="'.$styleData['brandId'].'" order by name asc';
			$rs11=GetPageRecord('name,id','colorCardMaster',$where);
			while($resListing11=mysqli_fetch_array($rs11)){
			?>
			<option value="<?php echo strip($resListing11['id']); ?>" <?php if($rslistnew['color']==$resListing11['id']){ echo 'selected';  }?>><?php echo strip($resListing11['name']); ?></option>
			<?php } ?>
		</select>
		</td>
        <td><input name="size" type="text" id="size<?php echo $rslistnew['id']; ?>" style="padding:2px; border:1px solid #ccc; width:30px; box-sizing:border-box;" onkeyup="addcolordetail<?php echo $rslistnew['id']; ?>();" value="<?php echo $rslistnew['size']; ?>" /></td>
        <td><input name="gdQty" type="text" id="gdQty<?php echo $rslistnew['id']; ?>" style="padding:2px; border:1px solid #ccc; width:100%; box-sizing:border-box;" onkeyup="addcolordetail<?php echo $rslistnew['id']; ?>();" value="<?php echo $rslistnew['gdQty']; ?>" /></td>
        <td align="center"><div align="center"><a  onclick="deleterow<?php echo $rslistnew['id']; ?>();"><i class="icon-trash" style="font-size:13px;cursor:pointer; color:#FF0000;" ></i></a></div></td>
		<?php if($_REQUEST['module']=="buyerpo"){ ?><td align="center"><div class="showamend<?php echo $no; ?>" style="display:none;"> <a href="JavaScript:Void(0);" onclick="opmodalpop('Amendment Style# <?php echo getStyleRefId($styleData['id']); ?>','newpop.php?action=salesorderamedaction&styleId=<?php echo encode($styleData['id']); ?>&id=<?php echo $rslistnew['id']; ?>&finish=<?php echo $rslistnew['finish']; ?>&color=<?php echo $rslistnew['color']; ?>&size=<?php echo $rslistnew['size']; ?>&gdQty=<?php echo $rslistnew['gdQty']; ?>','700px','auto');" data-toggle="modal" data-target="#modalpop">Amend</a> </div></td> <?php } ?>
		<td align="center"><div align="center"><?php if($rslistnew['provision']==1){ echo 'Provision'; }?></div></td>
		<script>
		function deleterow<?php echo $rslistnew['id']; ?>(){
			$('#loadBuyerPo').load('loadBuyerPo.php?styleId=<?php echo $styleData['id']; ?>&deletestatus=yes&colorid=<?php echo $rslistnew['id']; ?>');
		}
		</script>
      </tr>

<script>
function addcolordetail<?php echo $rslistnew['id']; ?>(){
var finish = encodeURI($('#finish<?php echo $rslistnew['id']; ?>').val());
var color = $('#color<?php echo $rslistnew['id']; ?>').val();
var size = encodeURI($('#size<?php echo $rslistnew['id']; ?>').val());
var gdQty = Number($('#gdQty<?php echo $rslistnew['id']; ?>').val());

$('#addcolordetail<?php echo $rslistnew['id']; ?>').load('allaction.php?finish='+finish+'&color='+color+'&size='+size+'&gdQty='+gdQty+'&action=savecolordetail&parentid=<?php echo $rslistnew['id']; ?>');

}

</script>
<div id="addcolordetail<?php echo $rslistnew['id']; ?>" style="display:none;"></div>
<?php $totalorQty = $totalorQty+$rslistnew['gdQty'];

} ?>


    </table>
	</td>
    <td width="738" colspan="8" valign="top"><p>&nbsp;</p></td>
  </tr>





<script>

function saveBuyerPoDetail<?php echo $imgresult['id']; ?>(){
var sum = 0;
var qtyTotal = 0;
var styleId = encodeURI($('#styleId').val());
var articleNo = encodeURI($('#articleNo<?php echo $imgresult['id']; ?>').val());
var description = encodeURI($('#description<?php echo $imgresult['id']; ?>').val());
var qty = Number($('#qty<?php echo $imgresult['id']; ?>').val());
var uom = encodeURI($('#uom<?php echo $imgresult['id']; ?>').val());
var discount = Number($('#discount<?php echo $imgresult['id']; ?>').val());
var ed = Number($('#ed<?php echo $imgresult['id']; ?>').val());
var vat = Number($('#vat<?php echo $imgresult['id']; ?>').val());
var price = Number($('#price<?php echo $imgresult['id']; ?>').val());
var mrp = Number($('#mrp<?php echo $imgresult['id']; ?>').val());

var totalprice = Number(qty*price);
$('#amt<?php echo $imgresult['id']; ?>').val(totalprice)

var amt = totalprice;
var buyerPurchaseId = Number($('#buyerPurchaseId').val());
var orderStyleId = Number($('#orderStyleId<?php echo $imgresult['id']; ?>').val());

$('.qtyclass').each(function() {
	qtyTotal += Number($(this).val());
});

	$('#qtyTotal').val(qtyTotal);

$('.totalamt').each(function() {
	sum += Number($(this).val());
});
	sum= parseFloat(sum).toFixed(2);
	$('#amtTotal').val(sum);

$('#saveBuyerPoDetail<?php echo $imgresult['id']; ?>').load('allaction.php?styleId='+styleId+'&articleNo='+articleNo+'&buyerPurchaseId='+buyerPurchaseId+'&description='+description+'&qty='+qty+'&uom='+uom+'&discount='+discount+'&ed='+ed+'&vat='+vat+'&price='+price+'&mrp='+mrp+'&amt='+amt+'&orderStyleId='+orderStyleId+'&action=savebuyerorderdetail');

}

</script>
   <div id="saveBuyerPoDetail<?php echo $imgresult['id']; ?>" style="display:none;"></div>
<?php $no++;
$totalfobothcolor = $totalfobothcolor+$totalorQty;
} ?>


  <tr>
    <td  colspan="4" valign="top" align="right"><p><strong></strong>Total: </p></td>
    <td width="738" valign="top" align="center" colspan="1"><p><strong><input name="qtyTotal" type="number" id="qtyTotal" style="padding:2px; border:1px solid #ccc; width:50px; box-sizing:border-box;" onkeyup="savebuyerpo();" value="<?php echo strip($totalfobothcolor); ?>" readonly="readonly"/></strong></p></td>
    <td width="738" valign="top" colspan="7" align="right">
        <p align="right"><input name="amtTotal" type="number" id="amtTotal" style="padding:2px; border:1px solid #ccc; width:100px; box-sizing:border-box;" onkeyup="savebuyerpo();" value="<?php echo strip($purchaseData['amtTotal']); ?>" readonly="readonly"/>
        </p>	</td>
  </tr>


  <tr>
    <td colspan="16" align="right" valign="top"><table width="326" border="0" cellpadding="4" cellspacing="0" style="font-size:10px;">
      <tr>
    <td align="right" valign="top"><p><strong>TOTAL&nbsp;DISCOUNT</strong></p></td>
    <td valign="top"><p align="right"><strong>
	<script>
	function calculateDiscount(){
	var discount = Number($('#discount').val());
	var totalEd = Number($('#totalEd').val());
	var totalVat = Number($('#totalVat').val());
	var amtTotal = Number($('#amtTotal').val());

	var grossTotal = Number(amtTotal-discount);
	grossTotal = Number(grossTotal+totalEd);
	grossTotal = Number(grossTotal+totalVat);

	$('#grossTotal').val(grossTotal);
	}
	</script>
      <input name="discount" type="number" id="discount" style="padding:2px; border:1px solid #ccc; width:100px; box-sizing:border-box;" onkeyup="savebuyerpo();" value="<?php echo strip($purchaseData['discount']); ?>" />
     </strong></p></td>
  </tr>

  <tr>
    <td align="right" valign="top"><p><strong>TOTAL&nbsp;ED</strong></p></td>
    <td valign="top"><p align="right"><input name="totalEd" type="number" id="totalEd" style="padding:2px; border:1px solid #ccc; width:100px; box-sizing:border-box;" onkeyup="savebuyerpo();" value="<?php echo strip($purchaseData['totalEd']); ?>" />
    </p></td>
  </tr>
  <tr>

    <td align="right" valign="top"><p><strong>TOTAL&nbsp;VAT</strong></p></td>
    <td valign="top"><p align="right"><strong><input name="totalVat" type="number" id="totalVat" style="padding:2px; border:1px solid #ccc; width:100px; box-sizing:border-box;" onkeyup="savebuyerpo();" value="<?php echo strip($purchaseData['totalVat']); ?>" />
    </strong></p></td>
  </tr>
  <tr>
    <td align="right" valign="top"><p><strong>GROSS&nbsp;TOTAL</strong></p></td>
    <td valign="top" align="right"><p align="right"><strong align="right"><input name="grossTotal" type="number" id="grossTotal" style="padding:2px; border:1px solid #ccc; width:100px; box-sizing:border-box;" onkeyup="savebuyerpo();" value="<?php echo strip($purchaseData['grossTotal']); ?>" readonly="readonly" />
    </strong></p></td>
  </tr>

    </table></td>
    </tr>

  <tr>
    <td width="738" colspan="16" valign="top"><p><strong>Remarks:</strong> <input name="remark" type="text" id="remark" style="padding:2px; border:1px solid #ccc; width:100%; box-sizing:border-box;" onkeyup="savebuyerpo();"  value="<?php echo strip($purchaseData['remark']); ?>" />
    </p></td>
  </tr>
</table>


<div style="margin-top:20px;text-align:right;"><button type="button" class="btn bg-success" onclick="generateIndent('<?php echo $styleData['id'] ?>');"><i class="fa fa-empire" aria-hidden="true"></i> Generate Indent</button>  <button type="button" class="btn bg-info" onClick="savebuyerpo();reload_page();">Save</button></div>
<p id="generatepo" style="display:none; color: #00CC00; font-weight: 700; text-align: right; padding: 5px;">Indent Generated Successfully. Indent No:</p>
<script>
function generateIndent(styleid){
	var conf = confirm("Are you sure you want to generate Indent.");
	if(conf==true){
		$('#generatepo').load('allaction.php?action=generateindent&styleid='+styleid);
	}
}
</script>