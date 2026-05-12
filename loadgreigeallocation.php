<?php
include('inc.php');


if($_REQUEST['action']=='loadindenttabledata'){

if($_REQUEST['did']!=0){
	deleteRecord('greigeRequisition','id="'.$_REQUEST['did'].'"');
}

if($_REQUEST['allocationRowAddId']!=0){
	$rs=GetPageRecord('*','greigeRequisition','id="'.$_REQUEST['allocationRowAddId'].'"');
	$rslistnew=mysqli_fetch_array($rs);

	$namevalue ='srinkageId="'.$rslistnew['srinkageId'].'",construction="'.$rslistnew['construction'].'",greWidth="'.$rslistnew['greWidth'].'",qty="'.$rslistnew['qty'].'",uom="'.$rslistnew['uom'].'",processLoss="'.$rslistnew['processLoss'].'",shrinkage="'.$rslistnew['shrinkage'].'",finalQty="'.$rslistnew['finalQty'].'",supplier="'.$rslistnew['supplier'].'",price="'.$rslistnew['price'].'",currency="'.$rslistnew['currency'].'",processCons="'.$rslistnew['processCons'].'",processWidth="'.$rslistnew['processWidth'].'",tabstatus="0",parentId="'.$rslistnew['parentId'].'",addFrom="allocation",allocationNo="'.$_REQUEST['allocationNo'].'",addAllocation="manual"';
	addlistinggetlastid('greigeRequisition',$namevalue);

}

$whereCheck='allocationNo="'.$_REQUEST['allocationNo'].'" and addFrom="allocation"';
$checkCode = checkduplicate('greigeRequisition',$whereCheck);

if($checkCode=="no"){

	$where='1 and styleId="'.$_REQUEST["greStyleNo"].'" and isFinal="yes" order by id asc';
	$rss=GetPageRecord('*','indentCreationMaster',$where);
	while($rslistnewss=mysqli_fetch_array($rss)){

	$where='1 and parentId in ( select id from greigeRequisition where indentNumber="'.$_REQUEST['indentid'].'") and addFrom="requisition" order by id asc';
	$rs=GetPageRecord('*','greigeRequisition',$where);
	$rslistnew=mysqli_fetch_array($rs);

	$namevalue ='srinkageId="'.$rslistnewss['materialId'].'",construction="'.$rslistnew['construction'].'",greWidth="'.$rslistnew['greWidth'].'",qty="'.$rslistnew['qty'].'",uom="'.$rslistnew['uom'].'",processLoss="'.$rslistnew['processLoss'].'",shrinkage="'.$rslistnew['shrinkage'].'",finalQty="'.$rslistnew['finalQty'].'",supplier="'.$rslistnew['supplier'].'",price="'.$rslistnew['price'].'",currency="'.$rslistnew['currency'].'",processCons="'.$rslistnew['processCons'].'",processWidth="'.$rslistnew['processWidth'].'",tabstatus="1",parentId="'.$rslistnew['parentId'].'",addFrom="allocation",allocationNo="'.$_REQUEST['allocationNo'].'"';
	addlistinggetlastid('greigeRequisition',$namevalue);
	}
}


$no = 0;
$htmlVar = '';
$requestedQtyTotal = 0;
$styleId = $_REQUEST['styleId'];
$where='1 and parentId in ( select id from greigeRequisition where indentNumber="'.$_REQUEST['indentid'].'") and allocationNo="'.$_REQUEST['allocationNo'].'" and addFrom="allocation" order by id asc';
$rs=GetPageRecord('*','greigeRequisition',$where);
while($rslistnew=mysqli_fetch_array($rs)){

/*$rsstyleuse112=GetPageRecord('*','greigeRequisition','parentId="'.$rslistnew['parentId'].'" and srinkageId="'.$rslistnew['srinkageId'].'" and addFrom="allocation" and greigeAvg!="" and color!="" and salesOrderQty!="" and allocationNo="'.$rslistnew['allocationNo'].'" group by srinkageId order by id asc');
$rsstyleuseList12=mysqli_fetch_array($rsstyleuse112);
//$requestedQtyTotal = $requestedQtyTotal + $rsstyleuseList12['requestedQty'];


$htmlVar.= '<span style="background: #dbdbdb; padding: 5px;">Available '.getMaterialName($rslistnew['srinkageId']).' :'.$requestedQtyTotal.'</span>';
*/
?>
<tr>
  <td><?php if($rslistnew['addAllocation']=="default"){ ?>
    <a href="JavaScript:Void(0);" onclick="funCallParentFunc(<?php echo $styleId; ?>,<?php echo $rslistnew['id']; ?>,0);">+Add&nbsp;New</a>
    <?php }else{ ?>
    <i class="fa fa-trash" style="font-size: 20px; color:#FF0000; cursor:pointer;" onclick="funCallParentFunc(<?php echo $styleId; ?>,<?php echo $rslistnew['id']; ?>,<?php echo $rslistnew['id']; ?>);" ></i>
    <?php } ?></td>
  <td style="width:206px;"><?php echo getMaterialName($rslistnew['srinkageId']); ?></td>
  <td><?php echo $rslistnew['greWidth']; ?></td>
  <td><?php echo $rslistnew['processWidth']; ?></td>
  <td><?php echo $rslistnew['construction']; ?></td>
  <td><?php echo $rslistnew['processCons']; ?></td>
  <td><select class="form-control" name="styleFabric" id="styleFabric<?php echo $rslistnew['id']; ?>" style="width:206px;" onchange="getFabricAvg<?php echo $rslistnew['id']; ?>();">
      <option value="">Select</option>
      <?php
		$greigeAvg ='';
$rs1=GetPageRecord('name,id,styleId','styleSubCategoryMaster','styleId="'.$styleId.'" and costsheetVersionId="1" and materialType="1" and parentId=0 order by sr asc');
while($resListing1=mysqli_fetch_array($rs1)){

$wheretech = 'stylesubtabid="'.$resListing1['id'].'" and sectionType="bom" and styleId="'.$resListing1['styleId'].'" and costsheetVersionId="1"';
$rs121=GetPageRecord('*','techPackDetailMaster',$wheretech);
$resListing12=mysqli_fetch_array($rs121);

$greigeAvg = $resListing12['avgIncWastage'];
		?>
      <option data-value2="<?php echo $greigeAvg; ?>" value="<?php echo $resListing1['id']; ?>" <?php if($rslistnew['stylesubtabid']==$resListing1['id']){ echo 'selected';} ?>><?php echo $resListing1['name']; ?></option>
      <?php } ?>
    </select>
  </td>
  <td><span id="greigeavgspan<?php echo $rslistnew['id']; ?>"></span></td>
  <script>
function getFabricAvg<?php echo $rslistnew['id']; ?>(){
	$('#styleFabric<?php echo $rslistnew['id']; ?> :selected').each(function(){
        var avg = $(this).data('value2');
		$('#greigeavgspan<?php echo $rslistnew['id']; ?>').text(avg);
    });


}
getFabricAvg<?php echo $rslistnew['id']; ?>();
</script>
  <td><input type="text" name="greigeAvg" id="greigeAvg<?php echo $rslistnew['id']; ?>" style="width:86px;" value="<?php echo $rslistnew['greigeAvg']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();"  ></td>
  <td><select class="form-control" name="color" id="color<?php echo $rslistnew['id']; ?>" style="width:86px;" onchange="getFabriOrderQty<?php echo $rslistnew['id']; ?>();savedata<?php echo $rslistnew['id']; ?>();">
      <option value="">Select</option>
      <?php
		$rsPurchase=GetPageRecord('*','purchaseOrderStyleMaster','styleId="'.$styleId.'" and sectionType=0 order by id asc');
		while($rsPurchaseList=mysqli_fetch_array($rsPurchase)){


		$embroidery = 0;
		$garmentDyeing = 0;
		$printing = 0;
		$rfd = 0;
		$solid = 0;
		$rsorder=GetPageRecord('*','purchaseOrderStyleMaster','parentId="'.$rsPurchaseList['id'].'" group by color');
		while($resultorder=mysqli_fetch_array($rsorder)){

		$rsColor=GetPageRecord('*','colorCardMaster','id="'.$resultorder['color'].'"');
		$resListColor=mysqli_fetch_array($rsColor);

		$rsQty=GetPageRecord('sum(gdQty) as totalorderQty','purchaseOrderStyleMaster','parentId="'.$rsPurchaseList['id'].'" group by color');
		$resListQty=mysqli_fetch_array($rsQty);

		$totalallowance=0;
		$rspro=GetPageRecord('*','rejectioninproductionmaster','1 and qty>'.$resListQty['totalorderQty'].'');
		$resultpro=mysqli_fetch_array($rspro);
		$totalallowance = $resultpro['totalallwance'];
		$salesOrderQty = round($resListQty['totalorderQty']+(($resListQty['totalorderQty']*$totalallowance)/100));


		$rsColorDetail=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$styleId.'" and colorId="'.$resultorder['color'].'"');
		$rsColorDetailList=mysqli_fetch_array($rsColorDetail);
		$valEditiArr = explode(',',$rsColorDetailList['valueEdition']);
		if (in_array(10, $valEditiArr))
		{
			$embroidery = $resultpro['extraforemb'];
		}
		if (in_array(11, $valEditiArr))
		{
			$garmentDyeing = $resultpro['extraforgarment'];
		}
		if (in_array(12, $valEditiArr))
		{
			$printing = $resultpro['extraforprinting'];
		}
		if (in_array(26, $valEditiArr))
		{
			$rfd = $resultpro['extraforRfd'];
		}
		if (in_array(27, $valEditiArr))
		{
			$solid = $resultpro['extraforsolid'];
		}


							$total=0;
							$sizeqty=0;
							$rsssqty='';
							$rsssqtylist='';
							$rsssqty=GetPageRecord('*','purchaseOrderStyleMaster','1 and parentId="'.$rsPurchaseList['id'].'" and color="'.$resultorder['color'].'" and finish="'.$resultorder['finish'].'"');
						while($rsssqtylist=mysqli_fetch_array($rsssqty)){


							$rsssqtyzx=GetPageRecord('SUM(gdQty) as trsum','purchaseOrderStyleMaster','1 and parentId="'.$rsPurchaseList['id'].'" and color="'.$resultorder['color'].'" and finish="'.$resultorder['finish'].'"');
	$rsssqtylistzx=mysqli_fetch_array($rsssqtyzx);


							if($rsssqtylist['gdQty'] > 0){

							$totalallowance=0;
						  	$totalallow = 0;
						  	$rspro=GetPageRecord('*','rejectioninproductionmaster','1 and qty>'.$rsssqtylistzx['trsum'].'');
						  	$resultpro=mysqli_fetch_array($rspro);

						  	$totalallowance = $resultpro['allowedper']+$embroidery+$garmentDyeing+$printing+$rfd+$solid;
						   // $totalallowance = $resultpro['totalallwance'];

																	}

							$calc=$rsssqtylist['gdQty'] * $totalallowance;
							$fcalc=$calc/100;

							 $fca=ceil($sizeqty = $rsssqtylist['gdQty'] + $fcalc);


							$total = $total+$fca;

						}


		?>
      <option data-value2="<?php echo $total; ?>" style="width:86px;" value="<?php echo $resultorder['color']; ?>" <?php if($resultorder['color']==$rslistnew['color']){ echo 'selected';} ?>><?php echo $resListColor['name']; ?></option>
      <?php } } ?>
    </select>
  </td>
  <script>
function getFabriOrderQty<?php echo $rslistnew['id']; ?>(){
	$('#color<?php echo $rslistnew['id']; ?> :selected').each(function(){
        var qty = $(this).data('value2');
		$('#salesOrderQty<?php echo $rslistnew['id']; ?>').val(qty);
    });


}
getFabriOrderQty<?php echo $rslistnew['id']; ?>();

</script>
  <td><input type="text" name="salesOrderQty" id="salesOrderQty<?php echo $rslistnew['id']; ?>" style="width:86px;" value="<?php echo $rslistnew['salesOrderQty']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();"  readonly="readonly"></td>
  <td><span id="greigeAvailableQty<?php echo $rslistnew['id']; ?>">
	<?php
	$whIns = 'styleId="'.$rslistnew['parentId'].'" and materialId="'.$rslistnew['srinkageId'].'"';
	$rsins=GetPageRecord('acceptedField','lotWiseData',$whIns);
	$resListingIns=mysqli_fetch_array($rsins);

	$requestedQtyTotal = $requestedQtyTotal+$rslistnew['requestedQty'];
	if($rslistnew['addAllocation']=="default"){
		echo $resListingIns['acceptedField'];
	}else{
		 $requestedQtyTotal = $resListingIns['acceptedField']-$requestedQtyTotal;
		 echo $requestedQtyTotal+$rslistnew['requestedQty'];
	}
	?>
		</span>
  </td>
  <td style="display:none;"><input type="text" name="finalQty" id="finalQty<?php echo $rslistnew['id']; ?>" style="width:86px;width: 100%; border: 1px solid #fff;" value="<?php echo $rslistnew['finalQty']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();" readonly="readonly"></td>
  <td><input type="text" name="requestedQty" id="requestedQty<?php echo $rslistnew['id']; ?>" style="width:86px;width: 100%;" value="<?php echo $rslistnew['requestedQty']; ?>" onkeyup="savedata<?php echo $rslistnew['id']; ?>();" readonly="readonly"></td>
  <td><?php echo $rslistnew['uom']; ?></td>
</tr>

<?php //echo $htmlVar; ?>
<script>


function savedata<?php echo $rslistnew['id']; ?>(){


	var finalQty = encodeURI($('#finalQty<?php echo $rslistnew['id']; ?>').val());
	var styleFabric = encodeURI($('#styleFabric<?php echo $rslistnew['id']; ?>').val());
	var greigeAvg = encodeURI($('#greigeAvg<?php echo $rslistnew['id']; ?>').val());
	var color = $('#color<?php echo $rslistnew['id']; ?>').val();
	var salesOrderQty = encodeURI($('#salesOrderQty<?php echo $rslistnew['id']; ?>').val());

	var requestedQtyPut = Number(Math.ceil(salesOrderQty*greigeAvg));
	var greigeAvailableQty = Number(Math.ceil($('#greigeAvailableQty<?php echo $rslistnew['id']; ?>').text()));




	$('#requestedQty<?php echo $rslistnew['id']; ?>').val(requestedQtyPut);
	var requestedQty = encodeURI($('#requestedQty<?php echo $rslistnew['id']; ?>').val());

	if(requestedQtyPut>greigeAvailableQty){
		//alert("You can not transfer quantity more than available greige!");
		//$('#greigeAvg<?php echo $rslistnew['id']; ?>').val("");
 	    //$('#requestedQty<?php echo $rslistnew['id']; ?>').val("0");
	}


		$('#savemeasurmentdata').load('newaction.php?action=saveallocationgreigedata&id=<?php echo $rslistnew['id']; ?>&requestedQty='+requestedQty+'&styleFabric='+styleFabric+'&greigeAvg='+greigeAvg+'&color='+color+'&salesOrderQty='+salesOrderQty);



}
</script>
<tr id="savemeasurmentdata" style="display:nodne;"></tr>
<?php $no++; }
?>
<script>
function funCallParentFunc(styleId,rowid,did){
	parent.loadindentdata(styleId,rowid,did);
}
</script>
<?php }

if($_REQUEST['action']=='addmaterialtoindent'){

$checkid=GetPageRecord('*','greigeAllocation','id="'.$_REQUEST['id'].'"');
$checkidlist=mysqli_fetch_array($checkid);

$checkid2=GetPageRecord('*','greigeRequisition','styleNo="'.$checkidlist['greigeStyleNo'].'"');
$checkidlist2x=mysqli_fetch_array($checkid2);

$srNo=100;
$checkid2=GetPageRecord('*','greigeRequisition','parentId="'.$checkidlist2x['id'].'" and addFrom="allocation" and greigeAvg!="" and color!="" and salesOrderQty!="" and allocationNo="'.$checkidlist['allocationNo'].'" group by srinkageId order by id asc ');
while($checkidlist2=mysqli_fetch_array($checkid2)){

if($checkidlist2['addedToIndent']==0){
$wherethis='id="'.$checkidlist2['srinkageId'].'"';
$rss=GetPageRecord('name','materialMaster',$wherethis);
$resListing1s=mysqli_fetch_array($rss);
$materialname = stripslashes($resListing1s['name']).' - '.$checkidlist2['processCons'];

$query=GetPageRecord('subCategoryId','queryMaster','id="'.$checkidlist['styleId'].'"');
$querydata=mysqli_fetch_array($query);

deleteRecord('styleSubCategoryMaster','styleId="'.$checkidlist['styleId'].'" and materialType=1 and materialMasterId="'.$checkidlist2['srinkageId'].'"');

$namevalue2='styleId="'.$checkidlist['styleId'].'",materialType=1,name="'.$materialname.'",materialId="'.$checkidlist2['srinkageId'].'",costsheetVersionId=1,subCategoryId="'.$querydata['subCategoryId'].'",sr="'.$srNo.'",addMaterialFrom="greige",allocationNo="'.$checkidlist['allocationNo'].'",materialMasterId="'.$checkidlist2['srinkageId'].'"';
$lastid = addlistinggetlastid('styleSubCategoryMaster',$namevalue2);

$namevalue3='styleId="'.$checkidlist['styleId'].'",bomSerialNo="'.$srNo.'",sectionType="bom",costsheetVersionId=1,bomWidth="'.$checkidlist2['processWidth'].'",bomUnit="'.$checkidlist2['uom'].'",bomAvg="'.$checkidlist2['greigeAvg'].'",bomRate="'.$checkidlist2['price'].'",matPrice="'.$checkidlist2['price'].'",storesupplier="'.$checkidlist2['supplier'].'",stylesubtabid="'.$lastid.'",buyerNominated="1",avgIncWastage="'.$checkidlist2['greigeAvg'].'"';
$adds = addlistinggetlastid('techPackDetailMaster',$namevalue3);

$updateAllTable = updatelisting('greigeRequisition','addedToIndent=1','parentId="'.$checkidlist2x['id'].'"  and color!="" and allocationNo!=""');
}
$srNo++; }


$namevalue='status=1';
$where='id="'.$_REQUEST['id'].'"';
$update = updatelisting('greigeAllocation',$namevalue,$where);

?>
<script>
parent.setupbox('showpage.crm?module=greigeallocation');
</script>
<?php

}

if($_REQUEST['action']=='loadstylefabric'){
$styleId = $_REQUEST['styleId'];
$rs1=GetPageRecord('*','styleSubCategoryMaster','styleId="'.$styleId.'" and costsheetVersionId="1" and materialType="1" and parentId=0 order by sr asc');
while($resListing1=mysqli_fetch_array($rs1)){

$wherethis='id="'.$resListing1['materialid'].'"';
$rss=GetPageRecord('*','materialMaster',$wherethis);
$resListing1s=mysqli_fetch_array($rss);

$rs121=GetPageRecord('*','techPackDetailMaster',' stylesubtabid="'.$resListing1['id'].'" and sectionType="bom" and styleId="'.$resListing1['styleId'].'" and costsheetVersionId="1" order by id asc');
$resListing12=mysqli_fetch_array($rs121);
?>
<tr>
  <td><?php echo $resListing1s['materialUniqueId']; ?></td>
  <td><?php echo $resListing1['name']; ?></td>
  <td><?php echo $resListing1['name']; ?></td>
  <td>-</td>
  <td><?php echo $resListing12['bomWidth']; ?></td>
  <td><?php echo $resListing12['bomAvg']; ?></td>
  <td><?php echo $resListing12['bomUnit']; ?></td>
  <td>-</td>
  <td>-</td>
</tr>
<?php
}
}
?>
<?php
if($_REQUEST['action']=='addmaterialtoindent'){

$checkid=GetPageRecord('*','greigeAllocation','id="'.$_REQUEST['id'].'"');
$checkidlist=mysqli_fetch_array($checkid);

$checkid2=GetPageRecord('*','greigeRequisition','styleNo="'.$checkidlist['greigeStyleNo'].'"');
$checkidlist2=mysqli_fetch_array($checkid2);

$srNo=100;
$checkid2=GetPageRecord('*','greigeRequisition','parentId="'.$checkidlist2['id'].'" and addFrom="allocation" and greigeAvg!="" and color!="" and salesOrderQty!="" and allocationNo="'.$checkidlist['allocationNo'].'" group by srinkageId order by id asc');
while($checkidlist2=mysqli_fetch_array($checkid2)){

$wherethis='id="'.$checkidlist2['srinkageId'].'"';
$rss=GetPageRecord('name','materialMaster',$wherethis);
$resListing1s=mysqli_fetch_array($rss);
$materialname = stripslashes($resListing1s['name']).' - '.$checkidlist2['processCons'];

$query=GetPageRecord('subCategoryId','queryMaster','id="'.$checkidlist['styleId'].'"');
$querydata=mysqli_fetch_array($query);

deleteRecord('styleSubCategoryMaster','styleId="'.$checkidlist['styleId'].'" and materialType=1 and materialMasterId="'.$checkidlist2['srinkageId'].'"');

$namevalue2='styleId="'.$checkidlist['styleId'].'",materialType=1,name="'.$materialname.'",materialId="'.$checkidlist2['srinkageId'].'",costsheetVersionId=1,subCategoryId="'.$querydata['subCategoryId'].'",sr="'.$srNo.'",addMaterialFrom="greige",allocationNo="'.$checkidlist['allocationNo'].'",materialMasterId="'.$checkidlist2['srinkageId'].'"';
$lastid = addlistinggetlastid('styleSubCategoryMaster',$namevalue2);

$namevalue3='styleId="'.$checkidlist['styleId'].'",bomSerialNo="'.$srNo.'",sectionType="bom",costsheetVersionId=1,bomWidth="'.$checkidlist2['processWidth'].'",bomUnit="'.$checkidlist2['uom'].'",bomAvg="'.$checkidlist2['greigeAvg'].'",matPrice="'.$checkidlist2['price'].'",storesupplier="'.$checkidlist2['supplier'].'",stylesubtabid="'.$lastid.'",buyerNominated="1",avgIncWastage="'.$checkidlist2['greigeAvg'].'"';
$adds = addlistinggetlastid('techPackDetailMaster',$namevalue3);

$updateAllTable = updatelisting('greigeRequisition','addedToIndent=1','id="'.$checkidlist2['id'].'"');

$srNo++; }

$namevalue='status=1';
$where='id="'.$_REQUEST['id'].'"';
$update = updatelisting('greigeAllocation',$namevalue,$where);

?>
<script>
parent.setupbox('showpage.crm?module=greigeallocation');
</script>
<?php

}
?>
