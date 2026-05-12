<?php
if($_GET['styleid']!=''){
$select='*';
$where='id="'.decode($_GET['styleid']).'"';
$rs=GetPageRecord($select,'queryMaster',$where);
$editresultstyle=mysqli_fetch_array($rs);

}


$rsqty=GetPageRecord('orderNo','buyerPurchaseOrderMaster','styleId="'.$editresultstyle['id'].'"');
$resultqty=mysqli_fetch_array($rsqty);


?>

<div class="page-content">
  <div class="content-wrapper">
    <div class="content pt-0" style="margin-top:20px; overflow:hidden;">
      <?php include "top-style.php"; ?>
      <div class="row" >
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-white">
              <h6 class="card-title">Fabric Inspection Report </h6>
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <style>
.inspection-report tr td {
    vertical-align: top !important;
    padding: 5px 8px;
}
.ins-summary tr td{
vertical-align:top !important;
}

</style>
                  <div class="col-md-12" style="margin-bottom:20px;">
                    <?php
$k=GetPageRecord('*','qualitymodulemaster','1 and styleId="'.$editresultstyle['id'].'" and lotNoMaster="'.decode($_REQUEST['lotId']).'"');
$lotData=mysqli_fetch_array($k);

$lotNameDataq=GetPageRecord('*','lotMaster','1 and id="'.$lotData['lotNoMaster'].'"');
$lotNameData=mysqli_fetch_array($lotNameDataq);

$lotResultq=GetPageRecord('*','lotWiseData','1 and styleId="'.$editresultstyle['id'].'" and lotId="'.$lotData['lotNoMaster'].'"');
$lotResult=mysqli_fetch_array($lotResultq);


$shrinkageCountq=GetPageRecord('id','qualitymodulemaster','1 and styleId="'.$editresultstyle['id'].'" and lotNoMaster="'.decode($_REQUEST['lotId']).'" and ll!="" and ww!="" and ll between 0 and "'.$lotResult['shrifdsfirst'].'" and ww between 0 and "'.$lotResult['shrifdssecond'].'"');
$shrinkageCount=mysqli_num_rows($shrinkageCountq);

$BowlingCountq=GetPageRecord('id','qualitymodulemaster','1 and styleId="'.$editresultstyle['id'].'" and lotNoMaster="'.decode($_REQUEST['lotId']).'" and bowing!="" and bowing between 0 and "'.$lotResult['bowlingpermill'].'"');
$BowlingCount=mysqli_num_rows($BowlingCountq);

?>
                    <table class="inspection-report" style="font-size:11px !important; width:100%;">
                      <tr>
                        <td colspan="5" style="padding: 10px !important; text-align: left; font-size: 16px; cursor: pointer; background-color: #e5fbfa; position: relative; font-weight: 500; color: #000000; width: 100%; box-sizing: border-box; border:1px solid #ccc;"><?php echo $lotNameData['name']; ?></td>
                      </tr>
                      <tr>
                        <td style="padding-left:0px; width:22%;"><table class="table table-bordered table-responsive lotsummary" style=" overflow:hidden !important;">
                            <tbody style="width: 100%;display: inline-table;">
                              <tr class="card-body">
                                <td>Supplier Name<br />
                                  (Greige)</td>
                                <td><div class="new-class">
                                    <?php
								$supplierDataq=GetPageRecord('id,name','suppliersMaster','1 and id="'.$lotResult['supplierName'].'"');
								$supplierData=mysqli_fetch_array($supplierDataq);
								echo $supplierData['name'];
								?>
                                  </div></td>
                              </tr>
                              <tr class="card-body">
                                <td width="53%">Supplier Name<br />
                                  (Finished)</td>
                                <td><div class="new-class">
                                    <?php
								$supplierfabDataq=GetPageRecord('id,name','suppliersMaster','1 and id="'.$lotResult['supplierNamefinished'].'"');
								$supplierfabData=mysqli_fetch_array($supplierfabDataq);
								echo $supplierfabData['name'];
								?>
                                  </div></td>
                              </tr>
                              <tr class="card-body">
                                <td width="53%">Buyer</td>
                                <td><div class="new-class">
                                    <?php
								$buyerDataq=GetPageRecord('id,name','buyerMaster','1 and id="'.$editresultstyle['buyerId'].'"');
								$buyerData=mysqli_fetch_array($buyerDataq);
								echo $buyerData['name'];
								?>
                                  </div></td>
                              </tr>
                              <tr class="card-body">
                                <td width="53%">Style No.</td>
                                <td><div class="new-class"><?php echo '#'.$editresultstyle['styleRefId']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td width="53%">Season</td>
                                <td><div class="new-class">
                                    <?php
								$seasonDataq=GetPageRecord('id,name','seasonMaster','1 and id="'.$editresultstyle['seasonId'].'"');
								$seasonData=mysqli_fetch_array($seasonDataq);
								echo $seasonData['name'];
								?>
                                  </div></td>
                              </tr>
                              <tr class="card-body">
                                <td>P.O No.</td>
                                <td><div class="new-class"><?php echo $resultqty['orderNo']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td width="53%">Fabric width Ordered</td>
                                <td width="47%"><div class="new-class"><?php echo $lotResult['fabricwidthOrdered']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td>Booking Consumption </td>
                                <td><div class="new-class"><?php echo $lotResult['fabricconsumption']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td>Color</td>
                                <td><div class="new-class">
                                    <?php
								$colorLotNameq=GetPageRecord('id,name','colorCardMaster','1 and id="'.$lotResult['colorLot'].'"');
								$colorLotName=mysqli_fetch_array($colorLotNameq);
								echo $colorLotName['name'];
								?>
                                  </div></td>
                              </tr>
                            </tbody>
                          </table></td>
                        <td style="width:22%;"><table class="table table-bordered table-responsive lotsummary" style=" overflow:hidden !important;">
                            <tbody style="width: 100%;display: inline-table;">
                              <tr class="card-body">
                                <td>Lot No</td>
                                <td><div class="new-class"><?php echo $lotNameData['name']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td width="56%">Lot Receiving Date</td>
                                <td width="44%"><div class="new-class">
                                    <?php if($lotResult['lotRecievedDate']!="" && $lotResult['lotRecievedDate']!="0000-00-00" && $lotResult['lotRecievedDate']!="1970-01-01"){ echo date('d-m-Y',strtotime($lotResult['lotRecievedDate'])); } ?>
                                  </div></td>
                              </tr>
                              <tr class="card-body">
                                <td width="56%">Total Fabric order qty</td>
                                <td width="44%"><div class="new-class"><?php echo $lotResult['lotfabricorderQty']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td>Received qty - for this lot</td>
                                <td><div class="new-class"><?php echo $lotResult['recievedqtyforthislot']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td width="56%">Total received till now</td>
                                <td width="44%"><div class="new-class"><?php echo $lotResult['totalreceivedtillnow']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td>Balance </td>
                                <td><div class="new-class"><?php echo $lotResult['balancelot']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td>Item code fabric</td>
                                <td><div class="new-class"><?php echo $lotResult['itemcodefabric']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td>Pcs that can be cut from this lot</td>
                                <td><div class="new-class"><?php echo $lotResult['pcscutlot']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td>Fabric usage</td>
                                <td><div class="new-class"><?php echo $lotResult['fabricusages']; ?></div></td>
                              </tr>
                            </tbody>
                          </table></td>
                        <td style="width:22%;"><table class="table table-bordered table-responsive lotsummary" style=" overflow:hidden !important;">
                            <tbody style="width: 100%;display: inline-table;">
                              <tr class="card-body">
                                <td>Total Inspected qty</td>
                                <td colspan="2"><div class="new-class"><?php echo $lotResult['totalinspectedqty']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td width="48%">Inspection date</td>
                                <td width="52%" colspan="2"><div class="new-class">
                                    <?php if($lotResult['inspectedDate']!="" && $lotResult['inspectedDate']!="0000-00-00" && $lotResult['inspectedDate']!="1970-01-01"){ echo date('d-m-Y',strtotime($lotResult['inspectedDate'])); } ?>
                                  </div></td>
                              </tr>
                              <tr class="card-body">
                                <td>No. of rolls inspected</td>
                                <td colspan="2"><div class="new-class"><?php echo $lotResult['rollsinspected']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td width="48%">Today's Inspection</td>
                                <td width="52%" colspan="2"><div class="new-class"><?php echo $lotResult['todaysinspection']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td>Balance for inspection</td>
                                <td colspan="2"><div class="new-class"><?php echo $lotResult['balanceinspection']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td>Shrinkage as per F.D.S</td>
                                <td><div class="new-class">
                                  <div align="center"><?php echo $lotResult['shrifdsfirst']; ?></div>
                                </div></td>
                                <td><div class="new-class">
                                  <div align="center"><?php echo $lotResult['shrifdssecond']; ?></div>
                                </div></td>
                              </tr>
                              <tr class="card-body">
                                <td colspan="3"><div align="center">Shrinkage Before wash marked on 50x50cm</div></td>
                              </tr>
                            </tbody>
                          </table></td>
                        <td style="width:22%;"><table class="table table-bordered table-responsive lotsummary" style=" overflow:hidden !important;">
                            <tbody style="width: 100%;display: inline-table;">
                              <tr class="card-body">
                                <td style="text-align: center; background-color: #e5fbfa; font-size: 13px; font-weight: 500;" colspan="2">Inspection Checklist</td>
                              </tr>
                              <tr class="card-body">
                                <td>F.P.T </td>
                                <td><div class="new-class"><?php echo $lotResult['fptlot']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td width="48%">Insp. report of the mill</td>
                                <td width="52%"><div class="new-class"><?php echo $lotResult['insreportmill']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td>Bowing %</td>
                                <td><div class="new-class"><?php echo $lotResult['bowlingpermill']; ?></div></td>
                              </tr>
                            </tbody>
                          </table></td>
                        <td style="padding-right:0px; width:12%;"><table class="table table-bordered table-responsive lotsummary" style=" overflow:hidden !important;">
                            <tbody style="width: 100%;display: inline-table;">
                              <tr class="card-body">
                                <td style="text-align: center; background-color: #e5fbfa; font-size: 13px; font-weight: 500;">Inspection Report</td>
                              </tr>
                              <tr class="card-body">
                                <td><div style="width: 130px; height: 200px; border: 1px solid #ccc; text-align:center; padding-top:100px;">Fabric Swatch</div></td>
                              </tr>
                            </tbody>
                          </table></td>
                      </tr>
                    </table>
                    <div style=" text-align:center;padding: 10px 15px; border: 1px solid #3fd7de; font-size: 16px; cursor: pointer; background-color: #e5fbfa; position: relative; font-weight: 500; color: #000000; width: 100%; box-sizing: border-box; margin-bottom:20px; margin-top:10px;">Inspection Summary</div>
                    <table style="font-size:11px !important;" class="ins-summary inspection-report">
                      <tr>
                        <td width="506"><table class="table table-bordered table-responsive" style=" overflow:hidden !important;">
                            <tbody style="width: 100%;display: inline-table;">
                              <tr class="card-body">
                                <td colspan="4" style="text-align: center; background-color: #e5fbfa; font-size: 13px; font-weight: 500;">"4 point inspection system acceptance criteria</td>
                              </tr>
                              <tr class="card-body">
                                <td width="88"><div align="center">Points <= 20 Accepted</div></td>
                                <td width="162"><div align="center">Points  >20 but <30  To be approved fabric quality head</div></td>
                                <td width="172"><div align="center">Points >30<40, To be approved by Fab. Manager& Q.A</div></td>
                                <td width="98"><div align="center">Points >40 To be approved by S.V.P Fabric and M.M</div></td>
                              </tr>
                              <tr class="card-body">
                                <td><div align="center">4</div></td>
                                <td><div align="center">2</div></td>
                                <td><div align="center">1</div></td>
                                <td><div align="center">1</div></td>
                              </tr>
                            </tbody>
                          </table></td>
                        <td width="513"><table class="table table-bordered table-responsive forbom ins-summary" style=" overflow:hidden !important;">
                            <tbody style="width: 100%;display: inline-table;">
                              <tr class="card-body" style="text-align: center; background-color: #e5fbfa; font-size: 13px; font-weight: 500;">
                                <td width="102"><div align="center"></div></td>
                                <td colspan="2
		"><div align="center"><strong>Range</strong></div></td>
                                <td width="168"><div align="center"><strong>Accepted&nbsp;Rolls</strong></div></td>
                              </tr>
                              <tr class="card-body">
                                <td><div align="left">Shrinkage</div></td>
                                <td width="68"><div align="center">0&nbsp;- <?php echo $lotResult['shrifdsfirst']; ?></div></td>
                                <td width="69"><div align="center">0&nbsp;- <?php echo $lotResult['shrifdssecond']; ?></div></td>
                                <td><div align="center"><?php echo $shrinkageCount; ?></div></td>
                              </tr>

                              <tr class="card-body">
                                <td><div align="left">Bowing</div></td>
                                <td colspan="2"><div align="center">0&nbsp;- <span class="new-class"><?php echo $lotResult['bowlingpermill']; ?></span></div></td>
                                <td><div align="center"><?php echo $BowlingCount; ?></div></td>
                              </tr>
                              <tr class="card-body" style="text-align: center; background-color: #e5fbfa; font-size: 13px; font-weight: 500;">
                                <td><div align="left"></div></td>
                                <td colspan="2"><div align="center"><strong>Finding</strong></div></td>
                                <td><div align="center"><strong>Accept/Reject</strong></div></td>
                              </tr>
                              <tr class="card-body">
                                <td><div align="left">Bowing</div></td>
                                <td colspan="2"><div align="center"><?php echo $lotResult['bowingRField']; ?></div></td>
                                <td><div align="center"><?php echo $lotResult['bowingAcceptReject']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td><div align="left">4 Point </div></td>
                                <td colspan="2"><div align="center"><?php echo $lotResult['pointsRField']; ?></div></td>
                                <td><div align="center"><?php echo $lotResult['pointsAcceptReject']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td><div align="left">CSV</div></td>
                                <td colspan="2"><div align="center"><?php echo $lotResult['csvRField']; ?></div></td>
                                <td><div align="center"><?php echo $lotResult['csvAcceptReject']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td><div align="left">Color match</div></td>
                                <td colspan="2"><div align="center"><?php echo $lotResult['colormatchRField']; ?></div></td>
                                <td><div align="center"><?php echo $lotResult['colormatchAcceptReject']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td><div align="left">Shade Lot</div></td>
                                <td colspan="2"><div align="center"><?php echo $lotResult['shadelotRField']; ?></div></td>
                                <td><div align="center"><?php echo $lotResult['shadelotAcceptReject']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td><div align="left">No. of shade lots</div></td>
                                <td colspan="2"><div align="center"><?php echo $lotResult['noofshadelotsRField']; ?></div></td>
                                <td><div align="center"><?php echo $lotResult['noofshadelotsAcceptReject']; ?></div></td>
                              </tr>
                            </tbody>
                          </table></td>
                        <td width="513"><table class="table table-bordered table-responsive forbom ins-summary" style=" overflow:hidden !important;">
                            <tbody style="width: 100%;display: inline-table;">
                              <tr class="card-body" style="text-align: center; background-color: #e5fbfa; font-size: 13px; font-weight: 500;">
                                <td width="141"><div align="left"><strong>Closure type</strong></div></td>
                                <td width="112"><div align="center"><strong>Quantity</strong></div></td>
                                <td width="147"><div align="left"><strong>Reason</strong></div></td>
                              </tr>
                              <tr class="card-body">
                                <td><div align="left">Accepted</div></td>
                                <td><div align="center"><?php echo $lotResult['acceptedField']; ?></div></td>
                                <td><div align="left"><?php echo $lotResult['acceptedReason']; ?> </div></td>
                              </tr>
                              <tr class="card-body">
                                <td><div align="left">Rejected</div></td>
                                <td><div align="center"><?php echo $lotResult['rejectedField']; ?></div></td>
                                <td><div align="left"><?php echo $lotResult['rejectedReason']; ?> </div></td>
                              </tr>
                              <tr class="card-body">
                                <td><div align="left">Re-processing</div></td>
                                <td><div align="center"><?php echo $lotResult['reprocessingField']; ?></div></td>
                                <td><div align="left"><?php echo $lotResult['reprocessingReason']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td><div align="left">On Hold</div></td>
                                <td><div align="center"><?php echo $lotResult['onholdField']; ?></div></td>
                                <td><div align="left"><?php echo $lotResult['onholdReason']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td><div align="left">Date</div></td>
                                <td><div align="center"><?php if($lotResult['actionDate']!="" && $lotResult['actionDate']!="0000-00-00" && $lotResult['actionDate']!="1970-01-01"){ echo date('d-m-Y',strtotime($lotResult['actionDate'])); } ?></div></td>
                              </tr>
                              <tr class="card-body" style="text-align: center; background-color: #e5fbfa; font-size: 13px; font-weight: 500;">
                                <td colspan="3" align="center"><div align="center"><strong>Closure on rejection</strong></div></td>
                              </tr>
                              <tr class="card-body">
                                <td><div align="left">Closure By </div></td>
                                <td colspan="2"><div align="left"><?php echo $lotResult['closureBy']; ?></div></td>
                              </tr>
                              <tr class="card-body">
                                <td><div align="left">Closure Date</div></td>
                                <td colspan="2"><div align="left">
                                  <?php if($lotResult['closureDate']!="" && $lotResult['closureDate']!="0000-00-00" && $lotResult['closureDate']!="1970-01-01"){ echo date('d-m-Y',strtotime($lotResult['closureDate'])); } ?>
                                </div></td>
                              </tr>
                            </tbody>
                          </table></td>
                      </tr>
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
</div>
</div>
