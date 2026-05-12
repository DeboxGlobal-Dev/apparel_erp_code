<?php
ob_start();
include "inc.php";
include "config/logincheck.php";

//upload marker status
if($_REQUEST['action']=='uploadmarkerstatus' && $_REQUEST['markeruploaded']=='markeruploaded' && $_REQUEST['editId']!='') {

$markerAddDate=time();
$markerAddedBy=$_SESSION['userid'];

$where='id="'.decode($_REQUEST['editId']).'"';
$namevalue ='markerAddDate="'.$markerAddDate.'",markerAddedBy="'.$markerAddedBy.'"';
$update = updatelisting(_QUERY_MASTER_,$namevalue,$where);

$styleassignment = 'styleId="'.decode($_REQUEST['editId']).'",statusId=6,dateAdded="'.time().'"';
addlisting('styleAssignmentMaster',$styleassignment);
}

//delete materal list top 3
if($_REQUEST['action']=='materiallistdelete' && $_REQUEST['versionId']!='' && $_REQUEST['editId']!=''){

$wheredelete=' styleId="'.decode($_REQUEST['editId']).'" and  costsheetVersionId="'.$_REQUEST['versionId'].'"';
deleteRecord('techPackDetailMaster',$wheredelete);
?>
<script>
saveallmaterial<?php echo $_REQUEST['versionId']; ?>();
</script>
<?php
} ?>


<?php
//add marker description
if($_REQUEST['action']=='uploadmarkerdescription') {
$where1='id="'.decode($_REQUEST['editId']).'"';
$namevalue1 ='markerDescription="'.$_REQUEST['markerdescription'].'"';
$update1 = updatelisting(_QUERY_MASTER_,$namevalue1,$where1);
}
?>


<?php
//add materiallist save
if($_REQUEST['action']=='materiallistsave') {
$where2='id="'.decode($_REQUEST['editId']).'"';
$namevalue2 ='analyzeMaterialListSave="'.$_REQUEST['analyzeMaterialListSave'].'"';
$update2 = updatelisting(_QUERY_MASTER_,$namevalue2,$where2);
}
?>





<?php
if($_REQUEST['action2']=='techpackversion' && $_REQUEST['versionId']!='' && $_REQUEST['cvId']==''){
$bomAvg =$_REQUEST['bomAvg'];
$bomUnit =$_REQUEST['bomUnit'];
$bomUSD =$_REQUEST['bomUSD'];
$bomINR =$_REQUEST['bomINR'];
$landingcostper =$_REQUEST['landingcostper'];
$bomRate =$_REQUEST['bomRate'];
$bomvalueonepc =$_REQUEST['bomvalueonepc'];
$bomSerialNo=$_REQUEST['bomSerialNo'];
$versionId=$_REQUEST['versionId'];
$markeruploaded=$_REQUEST['markeruploaded'];
$markerDescription=$_REQUEST['markerDescription'];
$bomWidth =$_REQUEST['bomWidth'];
$bomWidthUnit =$_REQUEST['bomWidthUnit'];
$wastagePersent =$_REQUEST['wastagePersent'];
$avgIncWastage =$_REQUEST['avgIncWastage'];
$storesupplier =$_REQUEST['storesupplier'];
$bomComment =$_REQUEST['bomComment'];
$addToCost =$_REQUEST['addToCost'];
$artworkno =$_REQUEST['artworkno'];
$stylesubtabid =$_REQUEST['stylesubtabid'];

$matPrice =$_REQUEST['matPrice'];
$matCurrency =$_REQUEST['matCurrency'];
$bomPlacement =$_REQUEST['bomPlacement'];

$qualityapproveddate =date('Y-m-d',strtotime($_REQUEST['qualityapproveddate']));
$cadgivendate =date('Y-m-d',strtotime($_REQUEST['cadgivendate']));
$labdipdate =date('Y-m-d',strtotime($_REQUEST['labdipdate']));
$labdiproundtwo =date('Y-m-d',strtotime($_REQUEST['labdiproundtwo']));

$supplierartname =$_REQUEST['supplierartname'];
$buyerNominated =$_REQUEST['buyerNominated'];
$finish =$_REQUEST['finish'];

$trimColor1 =$_REQUEST['trimColor1'];
$trimColor2 =$_REQUEST['trimColor2'];
$trimColor3 =$_REQUEST['trimColor3'];
$trimColor4 =$_REQUEST['trimColor4'];
$trimColor5 =$_REQUEST['trimColor5'];
$trimColor6 =$_REQUEST['trimColor6'];
$trimColor7 =$_REQUEST['trimColor7'];
$trimColor8 =$_REQUEST['trimColor8'];
$trimColor9 =$_REQUEST['trimColor9'];
$trimColor10 =$_REQUEST['trimColor10'];



$allvalue3 ='bomAvg="'.$bomAvg.'",bomUnit="'.$bomUnit.'",bomSerialNo="'.$bomSerialNo.'",styleId="'.decode($_REQUEST['editId']).'",costsheetVersionId="'.$versionId.'",sectionType="bom",bomUSD="'.$bomUSD.'",bomINR="'.$bomINR.'",bomRate="'.$bomRate.'",bomvalueonepc="'.$bomvalueonepc.'",bomWidth="'.$bomWidth.'",bomWidthUnit="'.$bomWidthUnit.'",wastagePersent="'.$wastagePersent.'",avgIncWastage="'.$avgIncWastage.'",storesupplier="'.$storesupplier.'",bomComment="'.$bomComment.'",addToCost="'.$addToCost.'",stylesubtabid="'.$stylesubtabid.'",matPrice="'.$matPrice.'",matCurrency="'.$matCurrency.'",bomPlacement="'.$bomPlacement.'",qualityapproveddate="'.$qualityapproveddate.'",supplierartname="'.$supplierartname.'",buyerNominated="'.$buyerNominated.'",landingcostper="'.$landingcostper.'",finish="'.$finish.'",dateAdded="'.time().'",trimColor1="'.$trimColor1.'",trimColor2="'.$trimColor2.'",trimColor3="'.$trimColor3.'",trimColor4="'.$trimColor4.'",trimColor5="'.$trimColor5.'",trimColor6="'.$trimColor6.'",trimColor7="'.$trimColor7.'",trimColor8="'.$trimColor8.'",trimColor9="'.$trimColor9.'",trimColor10="'.$trimColor10.'",artworkno="'.$artworkno.'",cadgivendate="'.$cadgivendate.'",labdipdate="'.$labdipdate.'",labdiproundtwo="'.$labdiproundtwo.'"';

$add = addlisting('techPackDetailMaster',$allvalue3);

?>
<script>
parent.document.getElementById("success").style.display = "block";
</script>
<?php  } ?>

<?php
//delete extra charges materal list last two
if($_REQUEST['action']=='materiallistdeleteextra' && $_REQUEST['versionId']!='' && $_REQUEST['editId']!=''){
$wheredelete1=' styleId="'.decode($_REQUEST['editId']).'" and  costsheetVersionId="'.$_REQUEST['versionId'].'"';
deleteRecord('extraChargesDetailMaster',$wheredelete1);
?>
<script>
saveallmaterialextra<?php echo $_REQUEST['versionId']; ?>();
</script>
<?php
} ?>

<?php
if($_REQUEST['action3']=='techpackversionextra' && $_REQUEST['versionId']!='' && $_REQUEST['cvId']==''){

$bomAvg =$_REQUEST['bomAvg'];
$bomUnit =$_REQUEST['bomUnit'];
$bomUSD =$_REQUEST['bomUSD'];
$bomINR =$_REQUEST['bomINR'];
$landingcostper =$_REQUEST['landingcostper'];
$bomRate =$_REQUEST['bomRate'];
$bomvalueonepc =$_REQUEST['bomvalueonepc'];
$bomSerialNo=$_REQUEST['bomSerialNo'];
$versionId=$_REQUEST['versionId'];
$addToCostextra=$_REQUEST['addToCostextra'];
$bomCommentextra=$_REQUEST['bomCommentextra'];

$matPriceextra=$_REQUEST['matPriceextra'];
$matCurrencyextra=$_REQUEST['matCurrencyextra'];
$overheadper=$_REQUEST['overheadper'];


$allvalue4 ='bomAvgextra="'.$bomAvg.'",bomUnitextra="'.$bomUnit.'",bomSerialNoextra="'.$bomSerialNo.'",styleId="'.decode($_REQUEST['editId']).'",costsheetVersionId="'.$versionId.'",bomUSDextra="'.$bomUSD.'",bomINRextra="'.$bomINR.'",bomRateextra="'.$bomRate.'",bomvalueonepcextra="'.$bomvalueonepc.'",addToCostextra="'.$addToCostextra.'",bomCommentextra="'.$bomCommentextra.'",matPriceextra="'.$matPriceextra.'",matCurrencyextra="'.$matCurrencyextra.'",overheadper="'.$overheadper.'"';


$add1 = addlisting('extraChargesDetailMaster',$allvalue4);
?>

<script>
parent.document.getElementById("success").style.display = "block";
</script>

<?php } ?>


<?php
//add final cost of costsheet

if($_REQUEST['action']=='toaladdfinal') {
$where11='styleId="'.decode($_REQUEST['editId']).'" and versionId="'.$_REQUEST['versionId'].'"';
echo $namevalue11 ='factoryoverheadtext="'.$_REQUEST['factoryoverheadtext'].'",c16text="'.$_REQUEST['c16text'].'",totalmrp="'.$_REQUEST['totalmrp'].'",mrptotallast="'.$_REQUEST['mrptotallast'].'",finalgrandtotalwithmrp="'.$_REQUEST['finalgrandtotalwithmrp'].'",factoryoverheadafterper="'.$_REQUEST['factoryoverheadafterper'].'",totaljobworkcharges="'.$_REQUEST['totaljobworkcharges'].'",totalwithoutc16="'.$_REQUEST['totalwithoutc16'].'",c16percent="'.$_REQUEST['c16percent'].'",totalcostfob="'.$_REQUEST['totalcostfob'].'",customermarkup="'.$_REQUEST['customermarkup'].'",customermarkupvalue="'.$_REQUEST['customermarkupvalue'].'",discountsellingprice="'.$_REQUEST['discountsellingprice'].'",discountsellingpricevalue="'.$_REQUEST['discountsellingpricevalue'].'",effectivesellingprice="'.$_REQUEST['effectivesellingprice'].'",profit="'.$_REQUEST['profit'].'",sellingprice="'.$_REQUEST['sellingprice'].'",inrvalue="'.$_REQUEST['inrvalue'].'",profitlosspercent="'.$_REQUEST['profitlosspercent'].'",bidinrvalue="'.$_REQUEST['bidinrvalue'].'",fobpricenew="'.$_REQUEST['fobpricenew'].'"';

$update11 = updatelisting('costsheetVersionMaster',$namevalue11,$where11);
}

if($_REQUEST['action']=='loadgreighwidth') {
$id = $_REQUEST['id'];
$selected = $_REQUEST['selected'];
?>
<option value="">Select</option>
	<?php
	$wherethis='fabric="'.$id.'"';
	$rss=GetPageRecord('*','shrinkageallowedmaster',$wherethis);
	while($resListing1s=mysqli_fetch_array($rss)){
	?>
<option value="<?php echo $resListing1s['greigewidth']; ?>" <?php if($resListing1s['greigewidth']==$selected){ echo "selected"; }?>><?php echo stripslashes($resListing1s['greigewidth']); ?></option>
<?php
}

}

if($_REQUEST['action']=='loadshrinkage') {
$id = $_REQUEST['id'];
$selected = $_REQUEST['selected'];
?>
<option value="">Select</option>
	<?php
	$wherethis='fabric="'.$id.'" and dwShrinkage!=""';
	$rss=GetPageRecord('*','shrinkageallowedmaster',$wherethis);
	while($resListing1s=mysqli_fetch_array($rss)){
	?>
<option value="<?php echo $resListing1s['dwShrinkage']; ?>" <?php if($resListing1s['dwShrinkage']==$selected){ echo "selected"; }?>><?php echo stripslashes($resListing1s['dwShrinkage']); ?></option>
<?php
}

}

if($_REQUEST['action']=='saveshrinkagedata'){

$where11='id="'.$_REQUEST['id'].'"';
$namevalue11 ='srinkageId="'.$_REQUEST['srinkageId'].'",construction="'.$_REQUEST['construction'].'",greWidth="'.$_REQUEST['greWidth'].'",qty="'.$_REQUEST['qty'].'",uom="'.$_REQUEST['uom'].'",processLoss="'.$_REQUEST['processLoss'].'",shrinkage="'.$_REQUEST['shrinkage'].'",finalQty="'.$_REQUEST['finalQty'].'",supplier="'.$_REQUEST['supplier'].'",price="'.$_REQUEST['price'].'",currency="'.$_REQUEST['currency'].'",processCons="'.$_REQUEST['processCons'].'",processWidth="'.$_REQUEST['processWidth'].'",tabstatus="1"';

$update11 = updatelisting('greigeRequisition',$namevalue11,$where11);
}

if($_REQUEST['action']=='saveyarnshrinkagedata'){

$where11='id="'.$_REQUEST['id'].'"';
$namevalue11 ='srinkageId="'.$_REQUEST['srinkageId'].'",count="'.$_REQUEST['count'].'",diameter="'.$_REQUEST['diameter'].'",gsm="'.$_REQUEST['gsm'].'",fabricWidth="'.$_REQUEST['fabricWidth'].'",qty_cut="'.$_REQUEST['qty_cut'].'",uom="'.$_REQUEST['uom'].'",excess="'.$_REQUEST['excess'].'",excess_qty_cut="'.$_REQUEST['excess_qty_cut'].'",smpl="'.$_REQUEST['smpl'].'",total_peice="'.$_REQUEST['total_peice'].'",avg="'.$_REQUEST['avg'].'",total_consumption="'.$_REQUEST['total_consumption'].'",yarn_req="'.$_REQUEST['yarn_req'].'",supplier="'.$_REQUEST['supplier'].'",price="'.$_REQUEST['price'].'",currency="'.$_REQUEST['currency'].'",processed_qty_sec="'.$_REQUEST['processed_qty_sec'].'",tabstatus="1"';

$update11 = updatelisting('yarnRequisition',$namevalue11,$where11);
}


if($_REQUEST['action']=='loadfromindent'){
$selectedId=stripslashes($_REQUEST['selectedId']);
$styleId=stripslashes($_REQUEST['styleId']);
?>
<?php
$select='';
$where='';
$rs='';
$select='*';
$where='styleId="'.$styleId.'" and indentNumber!=""';
$rs=GetPageRecord($select,'buyerPurchaseOrderMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['indentNumber']); ?>" <?php if($resListing['indentNumber']==$selectedId){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['indentNumber']); ?></option>
<?php } ?>
<?php
}

if($_REQUEST['action']=='loadtoindent'){
$selectedId=stripslashes($_REQUEST['selectedId']);
$styleId=stripslashes($_REQUEST['styleId']);
?>
<?php
$select='';
$where='';
$rs='';
$select='*';
$where='styleId="'.$styleId.'" and indentNumber!=""';
$rs=GetPageRecord($select,'buyerPurchaseOrderMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['indentNumber']); ?>" <?php if($resListing['indentNumber']==$selectedId){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['indentNumber']); ?></option>
<?php } ?>
<?php
}

if($_REQUEST['action']=="savestocktransferdetail"){


$fromIndentMaterailId=stripslashes($_REQUEST['fromIndentMaterailId']);
$toIndentMaterailId=stripslashes($_REQUEST['toIndentMaterailId']);
$availableQty=stripslashes($_REQUEST['availableQty']);
$transferQty=stripslashes($_REQUEST['transferQty']);

$where11='id="'.$_REQUEST['id'].'"';
$namevalue11 ='fromIndentMaterailId="'.$fromIndentMaterailId.'",toIndentMaterailId="'.$toIndentMaterailId.'",availableQty="'.$availableQty.'",transferQty="'.$transferQty.'",tabstatus="1"';
$update11 = updatelisting('stockTransfer',$namevalue11,$where11);

}

if($_REQUEST['action']=="saveallocationgreigedata"){

$id=stripslashes($_REQUEST['id']);
$requestedQty=stripslashes($_REQUEST['requestedQty']);
$styleFabric=stripslashes($_REQUEST['styleFabric']);
$greigeAvg=stripslashes($_REQUEST['greigeAvg']);
$color=$_REQUEST['color'];
$salesOrderQty=stripslashes($_REQUEST['salesOrderQty']);

$where11='id="'.$_REQUEST['id'].'"';
$namevalue11 ='requestedQty="'.$requestedQty.'",stylesubtabid="'.$styleFabric.'",greigeAvg="'.$greigeAvg.'",color="'.$color.'",salesOrderQty="'.$salesOrderQty.'",tabstatus="1"';
$update11 = updatelisting('greigeRequisition',$namevalue11,$where11);

}



if($_REQUEST['action']=="saveallocationyarndata"){

$id=stripslashes($_REQUEST['id']);
$requestedQty=stripslashes($_REQUEST['requestedQty']);
$styleFabric=stripslashes($_REQUEST['styleFabric']);
$greigeAvg=stripslashes($_REQUEST['greigeAvg']);
$color=$_REQUEST['color'];
$salesOrderQty=stripslashes($_REQUEST['salesOrderQty']);

$where11='id="'.$_REQUEST['id'].'"';
$namevalue11 ='requestedQty="'.$requestedQty.'",stylesubtabid="'.$styleFabric.'",greigeAvg="'.$greigeAvg.'",color="'.$color.'",salesOrderQty="'.$salesOrderQty.'",tabstatus="1"';
$update11 = updatelisting('yarnRequisition',$namevalue11,$where11);

}

if($_REQUEST['action']=='changeindentNumbergreige'){

$greStyleNo=$_REQUEST['greStyleNo'];
$indentNumber=$_REQUEST['selectId'];

$select='';
$where='';
$rs='';
$select='*';
$where='styleNo="'.$greStyleNo.'"';
$rs=GetPageRecord($select,'greigeRequisition',$where);
while($resListing=mysqli_fetch_array($rs)){

?>

<option value="<?php echo strip($resListing['indentNumber']); ?>" <?php if($resListing['indentNumber']==$indentNumber){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['indentNumber']); ?></option>
<?php }

}

?>

<?php

if($_REQUEST['action']=='changeindentNumber'){

$greStyleNo=$_REQUEST['greStyleNo'];
$indentNumber=$_REQUEST['selectId'];

$select='';
$where='';
$rs='';
$select='*';
$where='styleNo="'.$greStyleNo.'"';
$rs=GetPageRecord($select,'yarnRequisition',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['indentNumber']); ?>" <?php if($resListing['indentNumber']==$indentNumber){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['indentNumber']); ?></option>
<?php }

}

if($_REQUEST['action']=="loaduserList"){

$id = clean($_REQUEST['id']);
$selectedId = clean($_REQUEST['selectedId']);
$newdata = explode(',', $selectedId);
?>
		<option value="" disabled="disabled">Select</option>
		<!-- <option value="0" <?php foreach($newdata as $key => $value) { if($value == '0'){ echo 'selected="selected"'; } }?>>All</option> -->
		<?php
		$rsUser=GetPageRecord('id,firstName,lastName','userMaster',' 1  and deletestatus=0 and profileId="'.$id.'" and status=1 order by firstName asc');
		while($rsUserList=mysqli_fetch_array($rsUser)){
		?>
		<option value="<?php echo strip($rsUserList['id']); ?>" <?php foreach($newdata as $key => $value) { if($value == $rsUserList['id']){ echo 'selected="selected"'; } }?> ><?php echo clean($rsUserList['firstName']).' '.clean($rsUserList['lastName']); ?></option>
		<?php } ?>

<?php

}

if($_REQUEST['action']=="resourceallocation"){

$id = clean($_REQUEST['id']);
$assignTo = clean($_REQUEST['assignTo']);
$profileId = clean($_REQUEST['profileId']);

$namevalue1update = 'profileId="'.$profileId.'",assignTo="'.$assignTo.'"';
updatelisting('resourceAllocationBrandWise',$namevalue1update,'id="'.$id.'"');

}

if($_REQUEST['action']=="resourceapproval"){

$id = clean($_REQUEST['id']);
$assignTo = clean($_REQUEST['assignTo']);
$profileId = clean($_REQUEST['profileId']);
$pageId = clean($_REQUEST['pageId']);

$namevalue1update = 'profileId="'.$profileId.'",assignTo="'.$assignTo.'",pageId="'.$pageId.'"';
updatelisting('resourceApprovalBrandWise',$namevalue1update,'id="'.$id.'"');

}

if($_REQUEST['action']=="cancelpo"){

	$cid = clean($_REQUEST['cid']);
	$namevalue1update = 'isCancel="yes"';
	updatelisting('indentCreationMaster',$namevalue1update,'id="'.$cid.'"');
?>
<script>
parent.$('#cancelid<?php echo $cid; ?>').text("Canceled");
</script>
<?php
}
?>

