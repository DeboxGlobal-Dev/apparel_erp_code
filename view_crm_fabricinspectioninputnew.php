<?php
if($_GET['greige']!="yes"){

if($_GET['styleid']!=''){
$select='*';
$where='id="'.decode($_GET['styleid']).'"';
$rs=GetPageRecord($select,'queryMaster',$where);
$editresultstyle=mysqli_fetch_array($rs);
$buyerId = $editresultstyle['buyerId'];
$buyerStyleRefNo = $editresultstyle['buyerStyleRefNo'];
$subject = $editresultstyle['subject'];
$displayId = $editresultstyle['displayId'];
$seasonId = $editresultstyle['seasonId'];
$categoryId = $editresultstyle['categoryId'];
$subCategoryId = $editresultstyle['subCategoryId'];
$departmentId = $editresultstyle['departmentId'];
$receivedDate = $editresultstyle['receivedDate'];
$patternDescription = $editresultstyle['patternDescription'];
$patternAttachment = $editresultstyle['patternAttachment'];

$lastId=$editresultstyle['id'];

}
$newTotal=0;
$rsqty=GetPageRecord('sum(materialQty) as totalFabricQuantiy','indentCreationMaster','styleId="'.$editresultstyle['id'].'" and materialTypeId=1');
$resultqty=mysqli_fetch_array($rsqty);
$totalstylequantity=$resultqty['totalFabricQuantiy'];
$newTotal = $totalstylequantity;
if($newTotal==$resultqty['totalFabricQuantiy']){
  $checkTotal = '';
}


$rsqty=GetPageRecord('orderNo','buyerPurchaseOrderMaster','styleId="'.$editresultstyle['id'].'"');
$resultqty=mysqli_fetch_array($rsqty);

}else{

$newTotal=0;
$rsqty=GetPageRecord('sum(materialQty) as totalFabricQuantiy','indentCreationMaster','requisitionNo="'.decode($_REQUEST['requisitionNo']).'" and materialTypeId=1');
$resultqty=mysqli_fetch_array($rsqty);
$totalstylequantity=$resultqty['totalFabricQuantiy'];
$newTotal = $totalstylequantity;
if($newTotal==$resultqty['totalFabricQuantiy']){
  $checkTotal = '';
}

}

?>

<div class="page-content">

  <?php include "left.php"; ?>
  <div class="content-wrapper">
    <div class="content pt-0" style="margin-top:20px; overflow:hidden;">
	<?php if($_GET['greige']!="yes"){ ?>
      <?php include "top-style.php"; ?>
	  <?php } ?>
      <div class="row" >
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-white">
              <h6 class="card-title">Fabric Inspection Input </h6>
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <style>
.inspection-report tr td {
    vertical-align: top !important;
    padding: 5px 8px;
}
.lotsummary input {
    width: 100% !important;
    padding: 4px 5px !important;
}
.Zebra_DatePicker_Icon_Wrapper{
width:100%; !important;

}

.lotsummary select {
    width: 100% !important;
    padding: 5px !important;
}


.lotsummary tr td{
 vertical-align: middle !important;
}

.input-table tr td,.input-table tr th{
padding: 5px !important;
}
</style>
                  <div class="col-md-12" style="margin-bottom:20px;">
                    <?php
if($_GET['greige']!="yes"){
$k=GetPageRecord('*','qualitymodulemaster','1 and styleId="'.$editresultstyle['id'].'" and lotNoMaster="'.decode($_REQUEST['lotId']).'"');
$lotData=mysqli_fetch_array($k);

$countLotData=mysqli_num_rows($k);
if($countLotData>0){

$lotNameDataq=GetPageRecord('*','lotMaster','1 and id="'.$lotData['lotNoMaster'].'"');
$lotNameData=mysqli_fetch_array($lotNameDataq);

$lotResultq=GetPageRecord('*','lotWiseData','1 and styleId="'.$editresultstyle['id'].'" and lotId="'.$lotData['lotNoMaster'].'"');
$lotResult=mysqli_fetch_array($lotResultq);

$rsSupplier=GetPageRecord('supplierId','indentCreationMaster','styleId="'.$editresultstyle['id'].'" and materialId="'.decode($_GET['materialid']).'"');
$rsSupplierName=mysqli_fetch_array($rsSupplier);

if($lotResult['supplierName']!=''){
$supplierId=$lotResult['supplierName'];
}else{
$supplierId=$rsSupplierName['supplierId'];
}

if($lotResult['supplierNamefinished']!=''){
$supplierIdFinish=$lotResult['supplierNamefinished'];
}else{
$supplierIdFinish=$rsSupplierName['supplierId'];
}


$kkk=GetPageRecord('prepareDate','grnMaster','1 and id="'.decode($_GET['grnid']).'"');
$grnData=mysqli_fetch_array($kkk);

$rsgrnSupplier=GetPageRecord('sum(received) as totalReceived,orderQty,netReceived','grnMaster','styleId="'.$editresultstyle['id'].'" and parentId="'.decode($_GET['grnid']).'" and materialId="'.decode($_GET['materialid']).'" and color="'.decode($_GET['colorid']).'"');
$rsgrnSupplierName=mysqli_fetch_array($rsgrnSupplier);


$rsgrnM=GetPageRecord('name,id','styleSubCategoryMaster','id="'.decode($_GET['materialid']).'"');
$rsgrnMName=mysqli_fetch_array($rsgrnM);

$rsgrnMee=GetPageRecord('materialUniqueId','materialMaster','name="'.$rsgrnMName['name'].'"');
$rsgrnMNameee=mysqli_fetch_array($rsgrnMee);

$tsq=GetPageRecord('bomPlacement,bomAvg,bomWidth','techPackDetailMaster','1 and stylesubtabid='.$rsgrnMName['id'].'  order by id asc');
$techShellData=mysqli_fetch_array($tsq);

}else{

}
?>
                    <form action="ac.crm" method="post" enctype="multipart/form-data" name="popidfirst<?php echo $lotNameData['id']; ?>" target="acf" id="popidfirst<?php echo $lotNameData['id']; ?>">
                      <input type="hidden" name="lotIdlink" id="lotIdlink" value="<?php echo $_REQUEST['lotId']; ?>" />
                      <input type="hidden" name="spo" id="spo" value="<?php echo $_REQUEST['spo']; ?>" />
                      <input type="hidden" name="grnIdlink" id="grnIdlink" value="<?php echo $_REQUEST['grnid']; ?>" />
                      <input type="hidden" name="materialid" id="materialid" value="<?php echo $_REQUEST['materialid']; ?>" />
					  <input type="hidden" name="colorid" id="colorid" value="<?php echo $_REQUEST['colorid']; ?>" />
                      <input type="hidden" name="action" id="action" value="savelotdata" />
                      <input type="hidden" name="lotIdupper" id="lotIdupper" value="<?php echo encode($lotData['lotNoMaster']); ?>" />
                      <input type="hidden" name="styleId" id="styleId" value="<?php echo encode($editresultstyle['id']); ?>" />
                      <input type="hidden" name="editId" id="editId" value="<?php echo encode($lotResult['id']); ?>" />
                      <table class="inspection-report" style="font-size:12px !important; width:100%;">
                        <tr>
                          <td colspan="3" style="padding: 10px !important; text-align: left; font-size: 16px; cursor: pointer; background-color: #e5fbfa; position: relative; font-weight: 500; color: #000000; width: 100%; box-sizing: border-box; border:1px solid #ccc;"><?php echo $lotNameData['name']; ?></td>
                        </tr>
                        <tr>
                          <td style="padding-left:0px; width:33%;"><table class="table table-bordered table-responsive lotsummary" style=" overflow:hidden !important;">
                              <tbody style="width: 100%;display: inline-table;">
                                <tr class="card-body">
                                  <td>Supplier Name&nbsp;(Greige)</td>
                                  <td><div align="center">
                                      <select name="supplierName" id="supplierName">

                                        <?php
								$supplierDataq=GetPageRecord('id,name','suppliersMaster','id="'.$supplierId.'"');
								while($supplierData=mysqli_fetch_array($supplierDataq)){ ?>
                                        <option value="<?php echo $supplierData['id']; ?>" <?php if($supplierId==$supplierData['id']){ ?> selected="selected" <?php } ?>><?php echo $supplierData['name']; ?></option>
                                        <?php } ?>
                                      </select>
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td width="53%">Supplier Name&nbsp;(Finished)</td>
                                  <td><div align="center">
                                      <select name="supplierNamefinished" id="supplierNamefinished">

                                        <?php
								$supplierfabDataq=GetPageRecord('id,name','suppliersMaster','id="'.$supplierIdFinish.'"');
								while($supplierfabData=mysqli_fetch_array($supplierfabDataq)){ ?>
                                        <option value="<?php echo $supplierfabData['id']; ?>" <?php if($supplierIdFinish==$supplierfabData['id']){ ?> selected="selected" <?php } ?>><?php echo $supplierfabData['name']; ?></option>
                                        <?php } ?>
                                      </select>
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td width="53%">Buyer</td>
                                  <td><div align="center">
                                      <select name="buyerLot" id="buyerLot" style="background-color: #eee;">
                                        <?php
								$buyerDataq=GetPageRecord('id,name','buyerMaster','1 and id="'.$editresultstyle['buyerId'].'"');
								while($buyerData=mysqli_fetch_array($buyerDataq)){ ?>
                                        <option value="<?php echo $buyerData['id']; ?>"><?php echo $buyerData['name']; ?></option>
                                        <?php } ?>
                                      </select>
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td width="53%">Style No.</td>
                                  <td><div align="center">
                                      <input type="text" name="styleNoLot" id="styleNoLot" value="<?php echo '#'.$editresultstyle['styleRefId']; ?>" style="background-color: #eee;" readonly="" />
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td width="53%">Season</td>
                                  <td><div align="center">
                                      <select name="seasonLot" id="seasonLot" style="background-color: #eee;">
                                        <?php
								$seasonDataq=GetPageRecord('id,name','seasonMaster','1 and id="'.$editresultstyle['seasonId'].'"');
								while($seasonData=mysqli_fetch_array($seasonDataq)){ ?>
                                        <option value="<?php echo $seasonData['id']; ?>"><?php echo stripslashes($seasonData['name']); ?></option>
                                        <?php } ?>
                                      </select>
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td>P.O No.</td>
                                  <td><div align="center">
                                      <input type="text" name="poNoLot" id="poNoLot" value="<?php echo $resultqty['orderNo']; ?>" style="background-color: #eee;" readonly="" />
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td width="53%">Fabric width Ordered</td>
                                  <td width="47%"><div align="center">
                                      <input type="text" name="fabricwidthOrdered" id="fabricwidthOrdered" value="<?php echo $techShellData['bomWidth']; ?>" readonly />
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td>Booking Consumption </td>
                                  <td><div align="center">
                                      <input type="text" name="fabricconsumption" id="fabricconsumption" value="<?php echo $techShellData['bomAvg']; ?>" readonly />
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td>Color</td>
                                  <td><div align="center">
                                      <select name="colorLot" id="colorLot">
                                        <?php
			//$styleColorDetailMasterq=GetPageRecord('colorId','styleColorDetailMaster','1 and styleId="'.$editresultstyle['id'].'" group by colorId');
			//while($styleColorDetailMasterData=mysqli_fetch_array($styleColorDetailMasterq)){

			$colorLotNameq=GetPageRecord('id,name','colorCardMaster','id="'.decode($_GET['colorid']).'"');
			while($colorLotName=mysqli_fetch_array($colorLotNameq)){

			?>
                                        <option value="<?php echo $colorLotName['id']; ?>" <?php if(decode($_GET['colorid'])==$colorLotName['id']){ ?> selected="selected" <?php } ?>><?php echo $colorLotName['name']; ?></option>
                                        <?php } ?>
                                      </select>
                                    </div></td>
                                </tr>
                              </tbody>
                            </table></td>
                          <td style="width:33%;"><table class="table table-bordered table-responsive lotsummary" style=" overflow:hidden !important;">
                              <tbody style="width: 100%;display: inline-table;">
                                <tr class="card-body">
                                  <td>Lot No</td>
                                  <td><div align="center">
                                      <input type="text" name="lotNoShow" id="lotNoShow" value="<?php echo $lotNameData['name']; ?>" style="background-color: #eee;" readonly="" />
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td width="56%">Lot Receiving Date</td>
                                  <td width="44%"><div align="center">
                                      <input type="text" name="lotRecievedDate" id="lotRecievedDate" value="<?php if($grnData['prepareDate']!="" && $grnData['prepareDate']!="0000-00-00" && $grnData['prepareDate']!="1970-01-01"){ echo date('d-m-Y',strtotime($grnData['prepareDate'])); } ?>" class="newDatePicker" readonly />
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td width="56%">Total Fabric order qty</td>
                                  <td width="44%"><div align="center">
                                      <input type="text" name="lotfabricorderQty" id="lotfabricorderQty" value="<?php echo $rsgrnSupplierName['orderQty']; ?>" readonly />
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td>Received qty - for this lot</td>
                                  <td><div align="center">
                                      <input type="text" name="recievedqtyforthislot" id="recievedqtyforthislot" value="<?php echo $rsgrnSupplierName['netReceived']; ?>" readonly >
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td width="56%">Total received till now</td>
                                  <td width="44%"><div align="center">
                                      <input type="text" name="totalreceivedtillnow" id="totalreceivedtillnow" value="<?php echo $rsgrnSupplierName['totalReceived']; ?>" readonly >
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td>Balance </td>
                                  <td><div align="center">
                                      <input type="text" name="balancelot" id="balancelot" readonly value="<?php echo $rsgrnSupplierName['orderQty']-$rsgrnSupplierName['totalReceived']; ?>">
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td>Item code fabric</td>
                                  <td><div align="center">
                                      <input type="text" name="itemcodefabric" id="itemcodefabric" value="<?php echo $rsgrnMNameee['materialUniqueId']; ?>" readonly >
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td>Pcs that can be cut from this lot</td>
                                  <td><div align="center">
                                      <input type="text" name="pcscutlot" id="pcscutlot" value="<?php echo round($rsgrnSupplierName['netReceived']/$techShellData['bomAvg']); ?>" readonly >
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td height="24">Fabric usage</td>
                                  <td><div align="center">
                                      <input type="text" name="fabricusages" id="fabricusages" value="<?php echo $techShellData['bomPlacement']; ?>" readonly >
                                    </div></td>
                                </tr>
                              </tbody>
                            </table></td>
                          <td style="width:33%;"><table class="table table-bordered table-responsive lotsummary" style=" overflow:hidden !important;">
                              <tbody style="width: 100%;display: inline-table;">
                                <tr class="card-body">
                                  <td>Total Inspected qty</td>
                                  <td colspan="2"><div align="center">
                                      <input type="text" name="totalinspectedqty" id="totalinspectedqty" value="<?php echo $lotResult['totalinspectedqty']; ?>" readonly >
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td width="48%">Inspection date</td>
                                  <td width="52%" colspan="2"><div align="center">
                                      <input type="text" name="inspectedDate" id="inspectedDate" value="<?php if($lotResult['inspectedDate']!="" && $lotResult['inspectedDate']!="0000-00-00" && $lotResult['inspectedDate']!="1970-01-01"){ echo date('d-m-Y',strtotime($lotResult['inspectedDate'])); } ?>" class="newDatePicker" readonly />
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td>No. of rolls inspected</td>
                                  <td colspan="2"><div align="center">
                                      <input type="text" name="rollsinspected" id="rollsinspected" value="<?php echo $lotResult['rollsinspected']; ?>">
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td width="48%">Today's Inspection</td>
                                  <td width="52%" colspan="2"><div align="center">
                                      <input type="text" name="todaysinspection" id="todaysinspection" value="<?php echo $lotResult['todaysinspection']; ?>">
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td>Balance for inspection</td>
                                  <td colspan="2"><div align="center">
                                      <input type="text" name="balanceinspection" id="balanceinspection" value="<?php echo $lotResult['balanceinspection']; ?>">
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td>Shrinkage as per F.D.S</td>
                                  <td><div align="center">
                                      <input type="text" name="shrifdsfirst" id="shrifdsfirst" value="<?php echo $lotResult['shrifdsfirst']; ?>" style=" width: 35px !important;">
                                    </div></td>
                                  <td><div align="center">
                                      <input type="text" name="shrifdssecond" id="shrifdssecond" value="<?php echo $lotResult['shrifdssecond']; ?>" style=" width: 35px !important;">
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td colspan="3" style="font-size:11px;"><div align="center"><strong>Shrinkage Before wash marked on 50x50cm</strong></div></td>
                                </tr>
                              </tbody>
                            </table>
                            <table class="table table-bordered table-responsive lotsummary" style=" overflow:hidden !important; margin-top:5px;">
                              <tbody style="width: 100%;display: inline-table;">
                                <tr class="card-body">
                                  <td style="text-align: center; background-color: #e5fbfa; font-size: 12px; font-weight: 500;" colspan="3">Inspection Checklist</td>
                                </tr>
                                <tr class="card-body">
                                  <td><div align="left">F.P.T </div>
                                    <input type="text" name="fptlot" id="fptlot" value="<?php echo $lotResult['fptlot']; ?>" style="padding:2px !important;" /></td>
                                  <td><div align="left">Insp. report of the mill </div>
                                    <input type="text" name="insreportmill" id="insreportmill" value="<?php echo $lotResult['insreportmill']; ?>" style="padding:2px !important;" /></td>
                                  <td><div align="left">Bowing % </div>
                                    <input type="text" name="bowlingpermill" id="bowlingpermill" value="<?php echo $lotResult['bowlingpermill']; ?>" style="padding:2px !important;" /></td>
                                </tr>
                              </tbody>
                            </table></td>
                        </tr>
                        <tr>
                          <td style="width:33%;padding-left: 0px !important;"><table class="table table-bordered table-responsive lotsummary" style=" overflow:hidden !important;">
                              <tbody style="width: 100%;display: inline-table;">
                                <tr class="card-body" style="text-align: center; background-color: #e5fbfa; font-size: 13px; font-weight: 500;">
                                  <td width="141"><div align="left">Closure&nbsp;Type</div></td>
                                  <td width="112"><div align="center">Quantity</div></td>
                                  <td width="147"><div align="left">Reason</div></td>
                                </tr>
                                <tr class="card-body">
                                  <td><div align="left">Accepted</div></td>
                                  <td><div align="center">
                                      <input type="text" name="acceptedField" id="acceptedField" value="<?php echo $lotResult['acceptedField']; ?>" placeholder="Quantity" />
                                    </div></td>
                                  <td><div align="center">
                                      <input type="text" name="acceptedReason" id="acceptedReason" value="<?php echo $lotResult['acceptedReason']; ?>" placeholder="Reason" />
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td><div align="left">Rejected</div></td>
                                  <td><div align="center">
                                      <input type="text" name="rejectedField" id="rejectedField" value="<?php echo $lotResult['rejectedField']; ?>" placeholder="Quantity" />
                                    </div></td>
                                  <td><div align="center">
                                      <input type="text" name="rejectedReason" id="rejectedReason" value="<?php echo $lotResult['rejectedReason']; ?>" placeholder="Reason" />
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td><div align="left">Re-processing</div></td>
                                  <td><div align="center">
                                      <input type="text" name="reprocessingField" id="reprocessingField" value="<?php echo $lotResult['reprocessingField']; ?>" placeholder="Quantity" />
                                    </div></td>
                                  <td><div align="center">
                                      <input type="text" name="reprocessingReason" id="reprocessingReason" value="<?php echo $lotResult['reprocessingReason']; ?>" placeholder="Reason" />
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td><div align="left">On Hold</div></td>
                                  <td><div align="center">
                                      <input type="text" name="onholdField" id="onholdField" value="<?php echo $lotResult['onholdField']; ?>" placeholder="Quantity" />
                                    </div></td>
                                  <td><div align="center">
                                      <input type="text" name="onholdReason" id="onholdReason" value="<?php echo $lotResult['onholdReason']; ?>" placeholder="Reason" />
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td><div align="left">Date</div></td>
                                  <td colspan="2"><div align="left">
                                      <input type="text" name="actionDate" id="actionDate" class="newDatePicker" value="<?php if($lotResult['actionDate']!="" && $lotResult['actionDate']!="0000-00-00" && $lotResult['actionDate']!="1970-01-01"){ echo date('d-m-Y',strtotime($lotResult['actionDate'])); } else{ echo date('d-m-Y'); } ?>" placeholder="Quantity" />
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td style="text-align: center; background-color: #e5fbfa; font-size: 13px; font-weight: 500;" colspan="3">Closure on rejection</td>
                                </tr>
                                <tr class="card-body">
                                  <td><div align="left">Closure By</div></td>
                                  <td colspan="2"><div align="left">
                                      <input type="text" name="closureBy" id="closureBy" value="<?php echo $lotResult['closureBy']; ?>" />
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td><div align="left">Closure Date</div></td>
                                  <td colspan="2"><div align="left">
                                      <input type="text" name="closureDate" id="closureDate" class="newDatePicker" value="<?php if($lotResult['closureDate']!="" && $lotResult['closureDate']!="0000-00-00" && $lotResult['closureDate']!="1970-01-01"){ echo date('d-m-Y',strtotime($lotResult['closureDate'])); } else{ echo date('d-m-Y'); } ?>" placeholder="Quantity" />
                                    </div></td>
                                </tr>
                              </tbody>
                            </table></td>
                          <td style="width:33%;"><table class="table table-bordered table-responsive lotsummary" style=" overflow:hidden !important;">
                              <tbody style="width: 100%;display: inline-table;">
                                <tr class="card-body" style="text-align: center; background-color: #e5fbfa; font-size: 13px; font-weight: 500;">
                                  <td width="141"><div align="left">&nbsp;</div></td>
                                  <td width="112"><div align="center">Finding</div></td>
                                  <td width="147"><div align="left">Accept/Reject</div></td>
                                </tr>
                                <tr class="card-body">
                                  <td><div align="left">Bowing</div></td>
                                  <td><div align="center">
                                      <input type="text" name="bowingRField" id="bowingRField" value="<?php echo $lotResult['bowingRField']; ?>" />
                                    </div></td>
                                  <td><div align="center">
                                      <input type="text" name="bowingAcceptReject" id="bowingAcceptReject" value="<?php echo $lotResult['bowingAcceptReject']; ?>"/>
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td><div align="left">4 Point</div></td>
                                  <td><div align="center">
                                      <input type="text" name="pointsRField" id="pointsRField" value="<?php echo $lotResult['pointsRField']; ?>" />
                                    </div></td>
                                  <td><div align="center">
                                      <input type="text" name="pointsAcceptReject" id="pointsAcceptReject" value="<?php echo $lotResult['pointsAcceptReject']; ?>"/>
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td><div align="left">CSV</div></td>
                                  <td><div align="center">
                                      <input type="text" name="csvRField" id="csvRField" value="<?php echo $lotResult['csvRField']; ?>" />
                                    </div></td>
                                  <td><div align="center">
                                      <input type="text" name="csvAcceptReject" id="csvAcceptReject" value="<?php echo $lotResult['csvAcceptReject']; ?>"/>
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td><div align="left">Color match</div></td>
                                  <td><div align="center">
                                      <input type="text" name="colormatchRField" id="colormatchRField" value="<?php echo $lotResult['colormatchRField']; ?>" />
                                    </div></td>
                                  <td><div align="center">
                                      <input type="text" name="colormatchAcceptReject" id="colormatchAcceptReject" value="<?php echo $lotResult['colormatchAcceptReject']; ?>"/>
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td><div align="left">Shade Lot</div></td>
                                  <td><div align="center">
                                      <input type="text" name="shadelotRField" id="shadelotRField" value="<?php echo $lotResult['shadelotRField']; ?>" />
                                    </div></td>
                                  <td><div align="center">
                                      <input type="text" name="shadelotAcceptReject" id="shadelotAcceptReject" value="<?php echo $lotResult['shadelotAcceptReject']; ?>"/>
                                    </div></td>
                                </tr>
                                <tr class="card-body">
                                  <td><div align="left">No. of shade lots</div></td>
                                  <td><div align="center">
                                      <input type="text" name="noofshadelotsRField" id="noofshadelotsRField" value="<?php echo $lotResult['noofshadelotsRField']; ?>" />
                                    </div></td>
                                  <td><div align="center">
                                      <input type="text" name="noofshadelotsAcceptReject" id="noofshadelotsAcceptReject" value="<?php echo $lotResult['noofshadelotsAcceptReject']; ?>"/>
                                    </div></td>
                                </tr>
                              </tbody>
                            </table></td>
                        </tr>
                      </table>
                      <div class="text-right" style="margin:20px 0px;">
                        <input type="submit" name="submitbtn<?php echo $lotNameData['id']; ?>" id="submitbtn<?php echo $lotNameData['id']; ?>" value="Save" class="btn btn-primary" />
                      </div>
                    </form>
                    <?php } ?>
                  </div>
                  <div class="col-md-12">
                    <table width="100%" class="table table-bordered table-responsive input-table" style="font-size:11px !important;">
                      <tr height="61" style="padding: 10px; font-weight: 600; background-color: #F8F8F8; margin-top: 10px; position: relative;">
                        <td rowspan="2" width="51" align="center"><div align="center"><a onClick="addNewRow(1);" style="color:#0000FF; cursor: pointer;">+Add&nbsp;New</a> </div></td>
                        <td rowspan="2" height="109" width="37"><div align="center">Lot</div></td>
                        <td rowspan="2" height="109" width="87"><div align="center">Supplier&nbsp;Roll&nbsp;No</div></td>
                        <td rowspan="2" width="52"><div align="center">Shade&nbsp;Lot</div></td>
                        <td colspan="2" align="center"><div align="center">Meterage</div></td>
                        <td colspan="2" align="center"><div align="center">Width&nbsp;(In inches)</div></td>
                        <td colspan="2"><div align="center">Afterwash</div></td>
                        <td colspan="2"><div align="center">Shrinkage&nbsp;A/W</div></td>
                        <td colspan="21" align="center"><div align="center">Defect Type</div></td>
                        <td width="36"><div align="center"></div></td>
                        <td width="49"><div align="center"></div></td>
                        <td rowspan="3" width="49"><div align="center">Remarks</div></td>
                      </tr>
                      <tr height="48" style="padding: 10px; font-size: 11px; font-weight: 600; background-color: #F8F8F8; margin-top: 10px; position: relative;">
                        <td width="38" height="48"><div align="center">On&nbsp;Tag</div></td>
                        <td width="34"><div align="center">Actual</div></td>
                        <td width="48"><div align="center">Required</div></td>
                        <td width="53"><div align="center">Actual&nbsp;(A)</div></td>
                        <td width="36" align="center"><div align="center">L</div></td>
                        <td width="35" align="center"><div align="center">W</div></td>
                        <td width="38" align="center"><div align="center">L</div></td>
                        <td width="45" align="center"><div align="center">W</div></td>
                        <td colspan="4" align="center"><div align="center">Weaving</div></td>
                        <td colspan="4" align="center"><div align="center">Stain</div></td>
                        <td colspan="2" align="center"><div align="center">Slub</div></td>
                        <td width="45" align="center"><div align="center">Fly/Cont</div></td>
                        <td width="48" align="center"><div align="center">Weft&nbsp;Bar</div></td>
                        <td width="27" align="center"><div align="center">Patta</div></td>
                        <td colspan="2" align="center"><div align="center">Hole</div></td>
                        <td colspan="4" align="center"><div align="center">Print Defect</div></td>
                        <td width="58" align="center"><div align="center">Bowing&nbsp;(B)</div></td>
                        <td width="67"><div align="center">Bowing&nbsp;=B/A</div></td>
                        <td rowspan="2" width="36"><div align="center">Total Points Found</div></td>
                        <td rowspan="2" width="49"><div align="center">Points per Hundred Square Meter</div></td>
                      </tr>
                      <tr height="32" style="padding: 10px; font-size: 11px; font-weight: 600; background-color: #F8F8F8; margin-top: 10px; position: relative;">
                        <td><div align="center"></div></td>
                        <td height="32"><div align="center"></div></td>
                        <td><div align="center"></div></td>
                        <td><div align="center"></div></td>
                        <td><div align="center"></div></td>
                        <td><div align="center"></div></td>
                        <td><div align="center"></div></td>
                        <td><div align="center"></div></td>
                        <td><div align="center"></div></td>
                        <td><div align="center"></div></td>
                        <td><div align="center"></div></td>
                        <td width="45"><div align="center"></div></td>
                        <td width="25"><div align="center">0&nbsp;-3&quot;</div></td>
                        <td width="28"><div align="center">3&quot;-6&quot;</div></td>
                        <td width="28"><div align="center">6&quot;-9&quot;</div></td>
                        <td width="46"><div align="center">Above&nbsp;9&quot;</div></td>
                        <td width="28"><div align="center">0&nbsp;-3&quot;</div></td>
                        <td width="28"><div align="center">3&quot;-6&quot;</div></td>
                        <td width="46"><div align="center">6&quot;-9&quot;</div></td>
                        <td width="46"><div align="center">Above&nbsp;9&quot;</div></td>
                        <td width="28"><div align="center">0&quot;-&quot;3"</div></td>
                        <td width="28"><div align="center">3&quot;-6&quot;</div></td>
                        <td width="45"><div align="center">6&quot;-9&quot;</div></td>
                        <td width="48"><div align="center"></div></td>
                        <td width="27"><div align="center"></div></td>
                        <td width="46"><div align="center">0&nbsp;-1&quot;</div></td>
                        <td width="25"><div align="center">Above&nbsp;1&quot;</div></td>
                        <td width="28"><div align="center">0&quot;-3&quot;</div></td>
                        <td width="28"><div align="center">3&quot;-6&quot;</div></td>
                        <td width="46"><div align="center">6&quot;-9&quot;</div></td>
                        <td width="46"><div align="center">Above&nbsp;9&quot;</div></td>
                        <td width="58"><div align="center">Inches</div></td>
                        <td width="67"><div align="center">%</div></td>
                      </tr>
                      <tbody id="addrow">
                      </tbody>
                      <script>

				function addNewRow(id){
				if(id==1){
				$("#addrow").load('loadqualitydata.php?add=1&styleId=<?php echo encode($lastId); ?>&costsheetVersionId=1&lotId=<?php echo decode($_REQUEST['lotId']); ?>');
				}else{
				$("#addrow").load('loadqualitydata.php?styleId=<?php echo encode($lastId); ?>&lotId=<?php echo decode($_REQUEST['lotId']); ?>');
				}

				}
				addNewRow(0);

				function deleteRow(id){
				var checkyes = confirm('Are your sure you you want to delete?');
				if(checkyes==true){
				$('#addrow').load('loadqualitydata.php?id='+id+'&deletestatus=yes&styleId=<?php echo encode($lastId); ?>&lotId=<?php echo decode($_REQUEST['lotId']); ?>');
				}
				}
				</script>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
