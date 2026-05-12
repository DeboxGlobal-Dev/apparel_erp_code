<?php

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
$colorId=str_replace(" ","_",$_REQUEST['color']);

?>

<div class="page-content">
  <div class="content-wrapper">
    <div class="content pt-0" style="margin-top:20px; overflow:hidden;">
      <?php include "top-style.php"; ?>
      <div class="row" >
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-white">
              <h6 class="card-title">Cut Plan</h6>
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <table width="100%" border="0" cellpadding="5" cellspacing="0" class="table table-responsive" style="font-size:11px !important;border-top: 1px solid #ccc !important;">
                    <tr height="61" style="padding: 10px; font-size: 11px; font-weight: 600; background-color: #F8F8F8; margin-top: 10px; position: relative;">
                      <td width="46" align="center"><div align="center"><a onClick="addNewRow(1);" style="color:#0000FF; cursor: pointer;">+Add&nbsp;New</a>
                          </th>
                        </div></td>
                      <td>CP</td>
                      <td>Date</td>
                      <td><div align="center">Color/Lay&nbsp;No.</div></td>
                      <td><div align="center">Lay&nbsp;Quantity</div></td>
                      <td><div align="center">Fabric Req.</div></td>
                      <td><div align="center">Fabric Rec.</div></td>
                      <td><div align="center">Marker Ratio </div></td>
                      <td><div align="center">No.&nbsp;of Pcs</div></td>
                      <td><div align="center">Marker length</div></td>
                      <td><div align="center">No. of Ply</div></td>
                      <td><div align="center">Fabric&nbsp;used in lay</div></td>
                      <td><div align="center">Wastage </div></td>
                      <td><div align="center">End bits</div></td>
                      <td><div align="center">Total&nbsp;fab&nbsp;used in&nbsp;lay</div></td>
                      <td><div align="center">Fabric Excess/Short</div></td>
                      <td><div align="center">Fabric&nbsp;Compunded Value</div></td>
                      <td><div align="center">Total&nbsp;Fabric Order</div></td>
                      <td><div align="center">Total&nbsp;fabric after&nbsp;inspection</div></td>
                      <td><div align="center">Total&nbsp;Fabric Bal.</div></td>
                      <td><div align="center">Fabric&nbsp;In-Hand</div></td>
                      <td><div align="center"> End&nbsp;bit total</div></td>
                    </tr>
                    <tbody id="addrow">
                    </tbody>
                    <?php
$rs=GetPageRecord('*','cutplanmastersum','1 and styleId="'.decode($_REQUEST['styleid']).'" and lotNoMaster="'.decode($_REQUEST['lotId']).'"');
$sumData=mysqli_fetch_array($rs);
?>
                    <tr height="61" style="padding: 10px; font-size: 11px; font-weight: 600; background-color: #F8F8F8; margin-top: 10px; position: relative;">
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"> </div></td>
                      <td><div align="center" id="noofpiecestotal"><?php echo $sumData['noofpiecestotal']; ?></div></td>
                      <td><div align="center" id="fabricreqtotal"><?php echo $sumData['fabricreqtotal']; ?></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"> </div></td>
                      <td><div align="center"> </div></td>
                      <td><div align="center"> </div></td>
                      <td><div align="center"> </div></td>
                      <td><div align="center"> </div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"></div></td>
                      <td><div align="center"> </div></td>
                      <td><div align="center"> </div></td>
					  <td><div align="center"> </div></td>
                    </tr>
                    <script>

				function addNewRow(id){
				if(id==1){
				$("#addrow").load('loadcutplan.php?add=1&styleId=<?php echo encode($lastId); ?>&costsheetVersionId=1&lotId=<?php echo decode($_REQUEST['lotId']); ?>&color=<?php echo $colorId; ?>');
				}else{
				$("#addrow").load('loadcutplan.php?styleId=<?php echo encode($lastId); ?>&lotId=<?php echo decode($_REQUEST['lotId']); ?>&color=<?php echo $colorId; ?>');
				}

				}
				addNewRow(0);

				function deleteRow(id){
				var checkyes = confirm('Are your sure you you want to delete?');
				if(checkyes==true){
				$('#addrow').load('loadcutplan.php?id='+id+'&deletestatus=yes&styleId=<?php echo encode($lastId); ?>&lotId=<?php echo decode($_REQUEST['lotId']); ?>&color=<?php echo $colorId; ?>');
				}
				}
				</script>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <div class="" style="padding: 10px; width: 100%; font-size: 20px; font-weight: 600; background-color: #F8F8F8; margin-top: 10px; position: relative; text-align: center; border: 1px solid #ccc;">Summary</div>
                  <table width="100%" border="0" cellpadding="5" cellspacing="0" class="table" style="font-size:12px !important;">
                    <tbody>
                      <tr height="35">
                        <td width="6%"><div align="left"><strong>Date</strong></div></td>
                        <td width="6%"><div align="left"><strong>Color/Lay&nbsp;No.</strong></div></td>
                        <td width="11%"><div align="left"><strong>Total Fabric used </strong></div></td>
                        <td width="12%"><div align="left"><strong>No. of pcs cut</strong></div></td>
                        <td width="13%"><div align="left"><strong>Running consumption</strong></div></td>
                        <td width="19%"><div align="left"><strong>Pcs that can be cut on inspected fabric</strong></div></td>
                        <td width="16%"><div align="left"><strong>Pcs can be cut on fab ordered</strong></div></td>
                        <td width="17%"><div align="left"><strong>Ex/Short (On Ex. Ord. Qty.)</strong></div></td>
                      </tr>
                      <?php
$cutplanReportDataq=GetPageRecord('*','cutplanmaster','1 and styleId="'.decode($_REQUEST['styleid']).'" and lotNoMaster="'.decode($_REQUEST['lotId']).'" order by id');
while($cutplanReportData=mysqli_fetch_array($cutplanReportDataq)){
?>
                      <tr height="20">
                        <td><div>
                            <div align="left" style="width:120px;"><?php echo date('d-F-Y',strtotime($cutplanReportData['cutdate'])); ?></div>
                          </div></td>
                        <td><div>
                            <div align="left"><?php echo $cutplanReportData['colorlay']; ?></div>
                          </div></td>
                        <td><div>
                            <div align="left"><?php echo $cutplanReportData['fabricused']; ?></div>
                          </div></td>
                        <td><div>
                            <div align="left"><?php echo $cutplanReportData['pieceslay']; ?></div>
                          </div></td>
                        <td><div>
                            <div align="left"><?php echo $runningConsumption=round($cutplanReportData['fabricused']/$cutplanReportData['pieceslay'],2); ?></div>
                          </div></td>
                        <td><div>
                            <div align="left"><?php echo $pcsthatcancutinspectedfabric=round($cutplanReportData['totalfabricafterinspection']/$runningConsumption,2); ?></div>
                          </div></td>
                        <td><div align="left">-</div></td>
                        <td><div align="left">-</div></td>
                      </tr>
                      <?php } ?>
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
</div>
<style>
table tr td {
    border: 1px solid #ccc !important;
    padding: 5px 5px !important;
}
</style>
