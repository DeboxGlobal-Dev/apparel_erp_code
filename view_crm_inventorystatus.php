<?php
$id=decode($_GET['id']);

$materialType=decode($_GET['materialType']);

$styleDataq=GetPageRecord('styleRefId,sampleStyle','queryMaster','1 and id="'.$id.'"');
$styleData=mysqli_fetch_array($styleDataq);

$matListDataq=GetPageRecord('name','materialTypeMaster','1 and id="'.$materialType.'"');
$matListData=mysqli_fetch_array($matListDataq);

?>

<div class="page-content">
  <div class="content-wrapper">
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-white">
              <h6 class="card-title"> Inventory </h6>
              <div class="text-left" style="position: absolute; top: 8px; right: 20px;"> <a class="btn"
          href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $_GET['module']; ?>"
          style="background-color: #949494; color: #fff; margin-right:0px;">Back <i
              class="fa fa-backward" aria-hidden="true"></i> </a> </div>
              <div class="text-right" style="position: absolute; top: 8px;  left: 114px;width: 20%;">
                <input id="myInput" type="text" placeholder="Search.." class="form-control">
              </div>
            </div>
            <div class="card-body listc">
              <table class="table table-bordered table-responsive">
                <thead style="background: #00b5ea; font-weight: 700; color: #ffff;">
                  <tr>
                    <td colspan="25"><?php echo $matListData['name']; ?> - <?php echo 'Style '.'#'.$styleData['styleRefId']; ?></td>
                  </tr>
                </thead>
                <thead>
                  <tr class="border-top-info">
                    <th> <div align="center">SNo.</div></th>
                    <th>Order&nbsp;/&nbsp;Indent&nbsp;No.</th>
                    <th>Material&nbsp;Name</th>
                    <th>Color</th>
                    <th>Placement</th>
                    <th> <div style="width: 145px;">Supplier</div></th>
                    <th>Material&nbsp;Id</th>
                    <th>Avg.</th>
                    <th>PO&nbsp;Qty (Excess)</th>
                    <th>UOM</th>
                    <th>Material&nbsp;Qty</th>
                    <th>Item&nbsp;Booked</th>
                    <th>Received/GRN</th>
                    <th>Type</th>
                    <th style="text-align:center;">G.E.&nbsp;No&nbsp;-&nbsp;GRN&nbsp;No</th>
                    <th>Inspected&nbsp;Qty.</th>
                    <th>Received&nbsp;Stock Transfer</th>
                    <th style="text-align:center;">&nbsp;</th>
                    <th>Issued&nbsp;Till&nbsp;Date</th>
                    <th>Balance</th>
                    <!--<th>Transact</th>-->
                  </tr>
                </thead>
                <?php
$sr=1;
$gateEntryno='';
$rsListDatassq=GetPageRecord('*','grnMaster','1 and styleId="'.$id.'" and materialid in ( select id from styleSubCategoryMaster where materialType="'.$materialType.'") group by color,materialId');
while($rsListDatass=mysqli_fetch_array($rsListDatassq)){

$i=0;$totalissuetilldate=0;
$issuance=GetPageRecord('issueqty','issuanceMaster','1 and styleId="'.$id.'" and color="'.$rsListDatass['color'].'" and materialId="'.$rsListDatass['materialId'].'"');
while($dataissue=mysqli_fetch_array($issuance)){
$totalissuetilldate+=$dataissue['issueqty'];
//$newdata = explode(',', $dataissue['materialId']);
//$newdata1 = explode(',', $dataissue['color']);
//$newdata2 = explode(',', $dataissue['issueqty']);
//for($i=0;$i < count($newdata);$i++){

// echo $newdata[$i].'<br>';
//if($newdata[$i] == $rsListDatass['materialId'] && $newdata1[$i] == $rsListDatass['color']) {
//$totalissuetilldate+=$newdata2[$i];



//}



//}


}



$inspectedQty=0;
if($materialType==1){
$where2 = '1 and styleId="'.$id.'" and materialid="'.$rsListDatass['materialId'].'" and colorid="'.$rsListDatass['color'].'"';
$lotWiseDataFabricq=GetPageRecord('sum(acceptedField) as totalacceptedField','lotWiseData',$where2);
$lotWiseDataFabric=mysqli_fetch_array($lotWiseDataFabricq);
$inspectedQty=$lotWiseDataFabric['totalacceptedField'];

}
if($materialType==2){
$qualityreportmasterDataq=GetPageRecord('sum(accepted) as totalaccepted','qualityreportmaster','1 and styleId="'.$id.'" and type="triminspectioninput" and materialid="'.$rsListDatass['materialId'].'" and colorid="'.$rsListDatass['color'].'"');
$qualityreportmasterData=mysqli_fetch_array($qualityreportmasterDataq);
$inspectedQty=$qualityreportmasterData['totalaccepted'];
}
if($materialType==3){

$packagingqualityreportmasterDataq=GetPageRecord('sum(accepted) as totalaccepted','packagingqualityreportmaster','1 and styleId="'.$id.'" and type="packagingtriminspectioninput" and materialid="'.$rsListDatass['materialId'].'" and colorid="'.$rsListDatass['color'].'"');
$packagingqualityreportmasterData=mysqli_fetch_array($packagingqualityreportmasterDataq);
$inspectedQty=$packagingqualityreportmasterData['totalaccepted'];

}
$where2='styleId="'.$id.'" and materialType="'.$materialType.'" and id="'.$rsListDatass['materialId'].'"';
$rs2=GetPageRecord('*','styleSubCategoryMaster',$where2);
$matData=mysqli_fetch_array($rs2);

$tsq=GetPageRecord('bomPlacement,storesupplier,supplierartname,bomAvg','techPackDetailMaster','1 and stylesubtabid='.$matData['id'].' order by id asc');
$techShellData=mysqli_fetch_array($tsq);

$unq=GetPageRecord('materialUniqueId,balance','materialMaster','name="'.$matData['name'].'"');
$uniData=mysqli_fetch_array($unq);

$rsqty=GetPageRecord('qtyTotal,orderNo,indentNumber','buyerPurchaseOrderMaster','styleId="'.$id.'"');
$resultqty=mysqli_fetch_array($rsqty);

$rsListitemq=GetPageRecord('*','indentCreationMaster','styleId="'.$id.'" and materialTypeId="'.$materialType.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
$rsListitem=mysqli_fetch_array($rsListitemq);

$rsgrnno=GetPageRecord('grnNo,id','grnMaster','id="'.$rsListDatass['parentId'].'" and grnNo!=""');
$rsgrnnolist=mysqli_fetch_array($rsgrnno);

$rsgrnrec=GetPageRecord('sum(received) as netReceivedTill,color,parentId','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
$rsgrnrecTill=mysqli_fetch_array($rsgrnrec);


$query_styl=GetPageRecord('*','queryMaster','id="'.$id.'"');
$query_styles=mysqli_fetch_array($query_styl);


?>
                <tbody id="myTable">
                  <tr class="border-top-info">
                    <td><div align="center"><?php echo $sr.'//'.$id; ?></div></td>
                    <td><?php if($query_styles['sampleStyle']==2){  echo $query_styles['sample_indent']; } else{ echo $resultqty['indentNumber']; }?>                    </td>
                    <td><?php echo $matData['name']; ?></td>
                    <td><?php
$rs112=GetPageRecord('name','colorCardMaster','id="'.$rsListDatass['color'].'"');
$resListing112=mysqli_fetch_array($rs112);
echo $resListing112['name'];
?>                    </td>
                    <td><?php echo $techShellData['bomPlacement']; ?></td>
                    <td><div style="width:145px"> <?php echo getsupplierCompany($techShellData['storesupplier']); ?></div></td>
                    <td><?php echo $uniData['materialUniqueId']; ?></td>
                    <!-- <td><?php echo $resultqty['qtyTotal']; ?></td>-->
                    <td><?php echo $rsListitem['avg']; ?></td>
                    <td><?php echo $rsListitem['poQty']; ?></td>
                    <td><?php echo $rsListitem['uom']; ?></td>
                    <td><?php echo $rsListitem['poQty']*$rsListitem['avg']; ?></td>
                    <td><?php echo round($rsgrnrecTill['netReceivedTill'],2); ?></td>
                    <td><?php echo round($rsgrnrecTill['netReceivedTill'],2); ?></td>
                    <td><?php  if($styleData['sampleStyle']=='1'){ echo "Bulk"; }else{ echo "Sample"; } ?>                    </td>
                    <td><?php
$rsgrndata=GetPageRecord('*','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
while($rsgrndatalist=mysqli_fetch_array($rsgrndata)){
$rsgrnno=GetPageRecord('gateEntryNo,grnNo','grnMaster','id="'.$rsgrndatalist['parentId'].'"');
$rsgrnnolist=mysqli_fetch_array($rsgrnno);
?>
                      <span
                      style="font-weight:600; color:#00CC33;"><?php echo makeQueryId($rsgrnnolist['gateEntryNo']); ?></span>&nbsp;-&nbsp;<span
                      style="font-weight:600; color: #0033FF;"><?php echo $rsgrnnolist['grnNo']; ?></span>
                      <?php } ?>                    </td>
                    <td><?php if($query_styles['sampleStyle']==2){ echo round($rsgrnrecTill['netReceivedTill'],2); }else {if($inspectedQty!=''){ echo $inspectedQty; }else{ echo '-'; } } ?>                    </td>
                    <td></td>
                    <td></td>
                    <td><?php
//echo '1 and itemCode="'.$rsListDatass['materialId'].'" where parentId in (select id from externalChallan where stylenum="'.decode($_GET['id']).'")';
$rsExt=GetPageRecord('SUM(qty) AS totalexport','loadExternalChallanMaster','1 and itemCode="'.$rsListDatass['materialId'].'" and parentId in (select id from externalChallan where stylenum="'.decode($_GET['id']).'")');
$rsExtSum=mysqli_fetch_array($rsExt);

?><?php echo $totalissuetilldate+$rsExtSum['totalexport']; ?></td>
                    <td><?php
$whCount = 'styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'"';
$rsmatC=GetPageRecord('SUM(quantity) as QtyTotal','loadRequisitionMaster',$whCount);
$rsmatCount=mysqli_fetch_array($rsmatC);

?>
                      <?php if($query_styles['sampleStyle']==2){ echo round($rsgrnrecTill['netReceivedTill'],2)- $totalissuetilldate;}else { echo $inspectedQty - $totalissuetilldate-$rsExtSum['totalexport']; } ?>                    </td>
                    <!--<td><?php
$c=0;
$issuancedataq=GetPageRecord('*','issuanceMaster','1 and styleId="'.$id.'"');
while($issuancedata=mysqli_fetch_array($issuancedataq)){

$issuedata = explode(',', $issuancedata['materialId']);
$issuedata1 = explode(',', $issuancedata['color']);

// for($i=0;$i < count($issuedata);$i++){

while($c < count($issuedata)){
if($issuedata[$c] == $rsListDatass['materialId'] && $issuedata1[$c] == $rsListDatass['color']) {
echo 'REQ-'.makeQueryId($issuancedata['requisitionId']).'<br>';
}
$c++;


}
}
?>                    </td>-->
                  </tr>
                </tbody>
                <?php $sr++; }
?>
                <tbody>
                  <?php

$checkid=GetPageRecord('*','greigeAllocation','styleId="'.$id.'"');
$checkidlist=mysqli_fetch_array($checkid);

$checkid2x=GetPageRecord('*','greigeRequisition','styleNo="'.$checkidlist['greigeStyleNo'].'"');
$checkidlist2x=mysqli_fetch_array($checkid2x);

$checkid2=GetPageRecord('*','greigeRequisition','parentId="'.$checkidlist2x['id'].'" and addFrom="allocation" and greigeAvg!="" and color!="" and salesOrderQty!="" and allocationNo="'.$checkidlist['allocationNo'].'" group by color order by id asc ');
while($checkidlist2=mysqli_fetch_array($checkid2)){

$whereGreige='styleId="'.$id.'" and materialType="1" and allocationNo!="" order by id desc';
$rsGreige=GetPageRecord('*','styleSubCategoryMaster',$whereGreige);
$matDataGreige=mysqli_fetch_array($rsGreige);


if($matDataGreige['addMaterialFrom']=="greige"){
$rsReq=GetPageRecord('*','greigeRequisition','allocationNo="'.$matDataGreige['allocationNo'].'" and srinkageId="'.$matDataGreige['materialid'].'"');
$rsReqData=mysqli_fetch_array($rsReq);
}
if($matDataGreige['addMaterialFrom']=="yarn"){
$rsReq=GetPageRecord('*','yarnRequisition','allocationNo="'.$matDataGreige['allocationNo'].'" and srinkageId="'.$matDataGreige['materialid'].'"');
$rsReqData=mysqli_fetch_array($rsReq);
}


//$rs112cc=GetPageRecord('name','colorCardMaster','id="'.$rsReqData['color'].'"');
//$resListing112cc=mysqli_fetch_array($rs112cc);

$rsListDatassq=GetPageRecord('*','grnMaster','1 and styleId="'.$id.'" and materialid in ( select id from styleSubCategoryMaster where materialType="1") group by color,materialId');
$rsListDatassqDa=mysqli_fetch_array($rsListDatassq);

if($matDataGreige['addMaterialFrom']=="greige"){
$rsReqStyle=GetPageRecord('id,styleNo,indentNumber','greigeRequisition','id="'.$rsReqData['parentId'].'"');
$rsReqStyleNo=mysqli_fetch_array($rsReqStyle);
}
if($matDataGreige['addMaterialFrom']=="yarn"){
$rsReqStyle=GetPageRecord('id,styleNo,indentNumber','yarnRequisition','id="'.$rsReqData['parentId'].'"');
$rsReqStyleNo=mysqli_fetch_array($rsReqStyle);
}



$rsIndent=GetPageRecord('*','indentCreationMaster','styleId="'.$rsReqStyleNo['styleNo'].'" and materialId="'.$rsReqData['srinkageId'].'"');
$rsIndentData=mysqli_fetch_array($rsIndent);

$unqG=GetPageRecord('materialUniqueId,balance','materialMaster','name="'.$matDataGreige['name'].'"');
$uniDataG=mysqli_fetch_array($unqG);

$rsgrnnoG=GetPageRecord('grnNo,id','grnMaster','id="'.$rsListDatass['parentId'].'" and grnNo!=""');
$rsgrnnolistG=mysqli_fetch_array($rsgrnnoG);

$rsgrnrecG=GetPageRecord('sum(received) as netReceivedTill,color,parentId','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
$rsgrnrecTillG=mysqli_fetch_array($rsgrnrecG);

$inspectedQtyg=0;
//echo $where2 = 'styleId="'.$id.'" and materialid="'.$matDataGreige['materialid'].'" and colorid="'.$rsReqData['color'].'"';
$where2 = 'styleId="'.$rsReqStyleNo['id'].'" and materialid="'.$matDataGreige['materialid'].'"  and colorid="'.$rsReqData['color'].'"';

$lotWiseDataFabricq=GetPageRecord('sum(acceptedField) as totalacceptedField','lotWiseData',$where2);
$lotWiseDataFabric=mysqli_fetch_array($lotWiseDataFabricq);
$inspectedQtyg=$lotWiseDataFabric['totalacceptedField'];

    ///in stoc qty after allocate from allocation
   $allocationNo=GetPageRecord('SUM(requestedQty) AS allocateQty','greigeRequisition',' parentId in (select id from greigeRequisition where requisitionNo="'.$checkidlist2x['requisitionNo'].'") and srinkageId="'.$checkidlist2['srinkageId'].'"  and color="'.$checkidlist2['color'].'" and addedToIndent=1');
    $allocationNoData=mysqli_fetch_array($allocationNo);

    $gateNo=GetPageRecord('id,entrydate','gateentrymaster','id="'.$grnNoList['gateEntryNo'].'"');
    $gateNoList=mysqli_fetch_array($gateNo);

    //$inStock=GetPageRecord('SUM(materialQty) as inStockQty','indentCreationMaster','parentId="'.$resListingIndent1['id'].'"');
    //$inStockData=mysqli_fetch_array($inStock);
    //$parentId = $resListingIndent1['id'];
    //$inStockQty = $inStockData['inStockQty'];
    $finalAllQty = $allocationNoData['allocateQty'];
    /*if($resListingIndent1['isFinal']=="no"){
      $inStockQty = $inStockQty;
      $finalAllQty = $inStockQty;
    }else{
      $finalAllQty = $inStockQty+$allocationNoData['allocateQty'];
    } */

?>
                  <tr>
                    <td><?php echo $sr.'//'.$id; ?></td>
                    <td><?php echo $rsReqStyleNo['indentNumber']; ?></td>
                    <td><?php echo $matDataGreige['name']; ?></td>
                    <td><?php echo getColorName($checkidlist2['color']);	?></td>
                    <td></td>
                    <td><?php echo getSupplierName($rsIndentData['supplierId']); ?></td>
                    <td><?php echo $uniDataG['materialUniqueId']; ?></td>
                    <td><?php echo $rsReqData['greigeAvg']; ?></td>
                    <td><?php echo $rsReqData['excess_qty_cut']; ?></td>
                    <td><?php echo $rsReqData['uom']; ?></td>
                    <td><?php //echo $rsReqData['excess_qty_cut']*$rsReqData['greigeAvg']; ?>
                      <?php
$rsgrndataGrQ=GetPageRecord('received','grnMaster','supplierPurchaseOrderId="'.$rsIndentData['poNumber'].'" and materialId="'.$matDataGreige['materialid'].'"'); 					$rsgrndatalistGrQ=mysqli_fetch_array($rsgrndataGrQ);
//echo $rsgrndatalistGrQ['received']; ?>
                      <?php echo $finalAllQty; ?> </td>
                    <td></td>
                    <td><?php //echo $rsgrndatalistGrQ['received']; ?>
                      <?php echo $finalAllQty; ?></td>
                    <td>Bulk</td>
                    <td><?php
$rsgrndataGr=GetPageRecord('*','grnMaster','supplierPurchaseOrderId="'.$rsIndentData['poNumber'].'" and materialId="'.$matDataGreige['materialid'].'"');
while($rsgrndatalistGr=mysqli_fetch_array($rsgrndataGr)){
$rsgrnnoGr=GetPageRecord('gateEntryNo,grnNo','grnMaster','id="'.$rsgrndatalistGr['parentId'].'"');
$rsgrnnolistGr=mysqli_fetch_array($rsgrnnoGr);
?>
                      <span
                      style="font-weight:600; color:#00CC33;"><?php echo makeQueryId($rsgrnnolistGr['gateEntryNo']); ?></span>&nbsp;-&nbsp;<span
                      style="font-weight:600; color: #0033FF;"><?php echo $rsgrnnolistGr['grnNo']; ?></span>
                      <?php } ?>                    </td>
                    <td><?php echo $inspectedQtyg; ?></td>
                    <td></td>
                    <td>&nbsp;</td>
                    <td><?php echo $finalAllQty; ?></td>
                    <td><?php
/*if($inspectedQtyg!=0){
echo $inspectedQtyg;
}else{
$inhand = $rsReqData['excess_qty_cut']*$rsReqData['greigeAvg'];
echo  round($inhand-$rsgrndatalistGrQ['received'],2);
}*/
echo $inspectedQtyg-$finalAllQty;
?></td>
                    <!--<td>-</td>-->
                  </tr>
                  <?php $sr++;  } ?>
                </tbody>
                <tbody>
                  <?php

$checkid=GetPageRecord('*','yarnAllocation','styleId="'.$id.'"');
$checkidlist=mysqli_fetch_array($checkid);

$checkid2x=GetPageRecord('*','yarnRequisition','styleNo="'.$checkidlist['greigeStyleNo'].'"');
$checkidlist2x=mysqli_fetch_array($checkid2x);

$checkid2=GetPageRecord('*','yarnRequisition','parentId="'.$checkidlist2x['id'].'" and addFrom="allocation" and greigeAvg!="" and color!="" and salesOrderQty!="" and allocationNo="'.$checkidlist['allocationNo'].'" group by color order by id asc ');
while($checkidlist2=mysqli_fetch_array($checkid2)){

$whereGreige='styleId="'.$id.'" and materialType="1" and allocationNo!="" order by id desc';
$rsGreige=GetPageRecord('*','styleSubCategoryMaster',$whereGreige);
$matDataGreige=mysqli_fetch_array($rsGreige);


if($matDataGreige['addMaterialFrom']=="greige"){
$rsReq=GetPageRecord('*','yarnRequisition','allocationNo="'.$matDataGreige['allocationNo'].'" and srinkageId="'.$matDataGreige['materialid'].'"');
$rsReqData=mysqli_fetch_array($rsReq);
}
if($matDataGreige['addMaterialFrom']=="yarn"){
$rsReq=GetPageRecord('*','yarnRequisition','allocationNo="'.$matDataGreige['allocationNo'].'" and srinkageId="'.$matDataGreige['materialid'].'"');
$rsReqData=mysqli_fetch_array($rsReq);
}


//$rs112cc=GetPageRecord('name','colorCardMaster','id="'.$rsReqData['color'].'"');
//$resListing112cc=mysqli_fetch_array($rs112cc);

$rsListDatassq=GetPageRecord('*','grnMaster','1 and styleId="'.$id.'" and materialid in ( select id from styleSubCategoryMaster where materialType="1") group by color,materialId');
$rsListDatassqDa=mysqli_fetch_array($rsListDatassq);

if($matDataGreige['addMaterialFrom']=="greige"){
$rsReqStyle=GetPageRecord('id,styleNo,indentNumber','greigeRequisition','id="'.$rsReqData['parentId'].'"');
$rsReqStyleNo=mysqli_fetch_array($rsReqStyle);
}
if($matDataGreige['addMaterialFrom']=="yarn"){
$rsReqStyle=GetPageRecord('id,styleNo,indentNumber','yarnRequisition','id="'.$rsReqData['parentId'].'"');
$rsReqStyleNo=mysqli_fetch_array($rsReqStyle);
}



$rsIndent=GetPageRecord('*','indentCreationMaster','styleId="'.$rsReqStyleNo['styleNo'].'" and materialId="'.$rsReqData['srinkageId'].'"');
$rsIndentData=mysqli_fetch_array($rsIndent);

$unqG=GetPageRecord('materialUniqueId,balance','materialMaster','name="'.$matDataGreige['name'].'"');
$uniDataG=mysqli_fetch_array($unqG);

$rsgrnnoG=GetPageRecord('grnNo,id','grnMaster','id="'.$rsListDatass['parentId'].'" and grnNo!=""');
$rsgrnnolistG=mysqli_fetch_array($rsgrnnoG);

$rsgrnrecG=GetPageRecord('sum(received) as netReceivedTill,color,parentId','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
$rsgrnrecTillG=mysqli_fetch_array($rsgrnrecG);

$inspectedQtyg=0;
//echo $where2 = 'styleId="'.$id.'" and materialid="'.$matDataGreige['materialid'].'" and colorid="'.$rsReqData['color'].'"';
$where2 = 'styleId="'.$rsReqStyleNo['id'].'" and materialid="'.$matDataGreige['materialid'].'"  and colorid="'.$rsReqData['color'].'"';

$lotWiseDataFabricq=GetPageRecord('sum(acceptedField) as totalacceptedField','lotWiseData',$where2);
$lotWiseDataFabric=mysqli_fetch_array($lotWiseDataFabricq);
$inspectedQtyg=$lotWiseDataFabric['totalacceptedField'];

    ///in stoc qty after allocate from allocation
   $allocationNo=GetPageRecord('SUM(requestedQty) AS allocateQty','yarnRequisition',' parentId in (select id from yarnRequisition where requisitionNo="'.$checkidlist2x['requisitionNo'].'") and srinkageId="'.$checkidlist2['srinkageId'].'"  and color="'.$checkidlist2['color'].'" and addedToIndent=1');
    $allocationNoData=mysqli_fetch_array($allocationNo);

    $gateNo=GetPageRecord('id,entrydate','gateentrymaster','id="'.$grnNoList['gateEntryNo'].'"');
    $gateNoList=mysqli_fetch_array($gateNo);

    //$inStock=GetPageRecord('SUM(materialQty) as inStockQty','indentCreationMaster','parentId="'.$resListingIndent1['id'].'"');
    //$inStockData=mysqli_fetch_array($inStock);
    //$parentId = $resListingIndent1['id'];
    //$inStockQty = $inStockData['inStockQty'];
    $finalAllQty = $allocationNoData['allocateQty'];
    /*if($resListingIndent1['isFinal']=="no"){
      $inStockQty = $inStockQty;
      $finalAllQty = $inStockQty;
    }else{
      $finalAllQty = $inStockQty+$allocationNoData['allocateQty'];
    } */

?>
                  <tr>
                    <td><?php echo $sr.'//'.$id; ?></td>
                    <td><?php echo $rsReqStyleNo['indentNumber']; ?></td>
                    <td><?php echo $matDataGreige['name']; ?></td>
                    <td><?php echo getColorName($checkidlist2['color']);	?></td>
                    <td></td>
                    <td><?php echo getSupplierName($rsIndentData['supplierId']); ?></td>
                    <td><?php echo $uniDataG['materialUniqueId']; ?></td>
                    <td><?php echo $rsReqData['greigeAvg']; ?></td>
                    <td><?php echo $rsReqData['excess_qty_cut']; ?></td>
                    <td><?php echo $rsReqData['uom']; ?></td>
                    <td><?php //echo $rsReqData['excess_qty_cut']*$rsReqData['greigeAvg']; ?>
                      <?php
$rsgrndataGrQ=GetPageRecord('received','grnMaster','supplierPurchaseOrderId="'.$rsIndentData['poNumber'].'" and materialId="'.$matDataGreige['materialid'].'"'); 					$rsgrndatalistGrQ=mysqli_fetch_array($rsgrndataGrQ);
//echo $rsgrndatalistGrQ['received']; ?>
                      <?php echo $finalAllQty; ?> </td>
                    <td></td>
                    <td><?php //echo $rsgrndatalistGrQ['received']; ?>
                      <?php echo $finalAllQty; ?></td>
                    <td>Bulk</td>
                    <td><?php
$rsgrndataGr=GetPageRecord('*','grnMaster','supplierPurchaseOrderId="'.$rsIndentData['poNumber'].'" and materialId="'.$matDataGreige['materialid'].'"');
while($rsgrndatalistGr=mysqli_fetch_array($rsgrndataGr)){
$rsgrnnoGr=GetPageRecord('gateEntryNo,grnNo','grnMaster','id="'.$rsgrndatalistGr['parentId'].'"');
$rsgrnnolistGr=mysqli_fetch_array($rsgrnnoGr);
?>
                      <span
                      style="font-weight:600; color:#00CC33;"><?php echo makeQueryId($rsgrnnolistGr['gateEntryNo']); ?></span>&nbsp;-&nbsp;<span
                      style="font-weight:600; color: #0033FF;"><?php echo $rsgrnnolistGr['grnNo']; ?></span>
                      <?php } ?>                    </td>
                    <td><?php echo $inspectedQtyg; ?></td>
                    <td></td>
                    <td>&nbsp;</td>
                    <td><?php //echo $finalAllQty; ?></td>
                    <td><?php
/*if($inspectedQtyg!=0){
echo $inspectedQtyg;
}else{
$inhand = $rsReqData['excess_qty_cut']*$rsReqData['greigeAvg'];
echo  round($inhand-$rsgrndatalistGrQ['received'],2);
}*/
echo $finalAllQty;
?></td>
                    <!--<td>-</td>-->
                  </tr>
                  <?php $sr++;  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script>
$(document).ready(function() {
$("#myInput").on("keyup", function() {
var value = $(this).val().toLowerCase();
$("#myTable tr").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
});
</script>
