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
 $materialDataq=GetPageRecord('*','styleSubCategoryMaster','id="'.decode($_GET['materialid']).'"');
						$materialData=mysqli_fetch_array($materialDataq);
						$materialname=$materialData['name'];

						$materialDataqss=GetPageRecord('*','materialMaster','id="'.decode($_GET['materialid']).'"');
						$materialDatass=mysqli_fetch_array($materialDataqss);




							$rsListDatassq=GetPageRecord('*','grnMaster','1 and styleId="'.decode($_GET['styleid']).'" and materialid in ( select id from styleSubCategoryMaster where materialType="3") group by color,materialId');
				$rsListDatass=mysqli_fetch_array($rsListDatassq);


							$rsListitemq=GetPageRecord('*','indentCreationMaster','styleId="'.decode($_GET['styleid']).'" and materialTypeId="3" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
				$rsListitem=mysqli_fetch_array($rsListitemq);

				$rsgrnrec=GetPageRecord('sum(netReceived) as netReceivedTill,color,parentId','grnMaster','styleId="'.decode($_GET['styleid']).'" and materialId="'.decode($_GET['materialid']).'" and color="'.decode($_GET['colorid']).'"');
				$rsgrnrecTill=mysqli_fetch_array($rsgrnrec);

				$total=round($rsgrnrecTill['netReceivedTill'],2);

				$rsListDatassqa=GetPageRecord('*','grnMaster','1 and id="'.decode($_GET['grnid']).'"');
				$rsListDatassa=mysqli_fetch_array($rsListDatassqa);

}

?>

<div class="page-content">
  <div class="content-wrapper">
    <div class="content pt-0" style="margin-top:20px; overflow:hidden;">
      <?php include "top-style.php"; ?>
      <div class="row" >
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-white">
              <h6 class="card-title">Packaging Inspection Input</h6>
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <table width="100%" border="0" cellpadding="5" cellspacing="0" class="table table-bordered table-responsive input-table" style="font-size:11px !important;">
                    <tr height="60" style="padding: 10px; font-size: 11px; font-weight: 600; background-color: #F8F8F8; margin-top: 10px; position: relative;">
                      <td rowspan="2" width="46" align="center"><div align="center"><a onClick="addNewRow(1);" style="color:#0000FF; cursor: pointer;">+Add&nbsp;New</a> </div></td>
                      <td rowspan="2" height="109" width="37"><div align="center">Lot</div></td>
                      <td rowspan="2" width="46"><div align="center">Item/Trim</div></td>
                      <td rowspan="2" width="34"><div align="center">Item&nbsp;Code</div></td>
                      <td width="108" align="center"><div align="center">Vendor name</div></td>
                      <td width="81" align="center"><div align="center">P.O No.</div></td>
                      <td width="72"><div align="center">Required&nbsp;Qty.</div></td>
                      <td width="56"><div align="center">Total&nbsp;order&nbsp;qty</div></td>
                      <td width="72" align="center" style="display:none;"><div align="center">Lot No</div></td>
                      <td width="42"><div align="center">Lot&nbsp;receiving&nbsp;date</div></td>
                      <td width="53"><div align="center">Rcvd&nbsp;qty&nbsp;for&nbsp;this&nbsp;lot</div></td>
                      <td rowspan="3" width="87"><div align="center">Total rcvd till now</div></td>
                      <td rowspan="3" width="87"><div align="center">Balance to receive</div></td>
                      <td rowspan="3" width="87"><div align="center">Inspection date </div></td>
                      <td rowspan="3" width="87"><div align="center">Inspection&nbsp;Qty</div></td>
                      <td rowspan="3" width="87"><div align="center">Okay Qty.</div></td>
                      <td rowspan="3" width="87"><div align="center">Rejected Qty.</div></td>
                      <td rowspan="3" width="87"><div align="center">Disputed Qty</div></td>
                      <td rowspan="3" width="87"><div align="center">Remarks</div></td>
                    </tr>
                    <tbody id="addrow">
                    </tbody>
                    <script>

				function addNewRow(id){

				if(id==1){
				$("#addrow").load('loadpackagingtrimdata.php?add=1&styleId=<?php echo encode($lastId); ?>&costsheetVersionId=1&lotId=<?php echo decode($_REQUEST['lotId']); ?>&mat=<?php echo $materialData['id']; ?>&grnids=<?php echo decode($_GET['grnids']); ?>&required=<?php echo $rsListitem['id']; ?>&total=<?php echo $total; ?>&lotrec=<?php echo $rsListDatassa['id']; ?>&poid=<?php echo $_GET['poid']; ?>&colorid=<?php echo $_GET['colorid']; ?>&materialid=<?php echo $_GET['materialid']; ?>&grnid=<?php echo $_GET['grnid']; ?>');
				}else{
				$("#addrow").load('loadpackagingtrimdata.php?styleId=<?php echo encode($lastId); ?>&lotId=<?php echo decode($_REQUEST['lotId']); ?>&mat=<?php echo $materialData['id']; ?>&grnids=<?php echo decode($_GET['grnids']); ?>&required=<?php echo $rsListitem['id']; ?>&total=<?php echo $total; ?>&lotrec=<?php echo $rsListDatassa['id']; ?>&poid=<?php echo $_GET['poid']; ?>&colorid=<?php echo $_GET['colorid']; ?>&materialid=<?php echo $_GET['materialid']; ?>&materialid=<?php echo $_GET['materialid']; ?>&grnid=<?php echo $_GET['grnid']; ?>');
				}

				}
				addNewRow(0);

				function deleteRow(id){
				var checkyes = confirm('Are your sure you you want to delete?');

				if(checkyes==true){
				$('#addrow').load('loadpackagingtrimdata.php?id='+id+'&deletestatus=yes&styleId=<?php echo encode($lastId); ?>&lotId=<?php echo decode($_REQUEST['lotId']); ?>&mat=<?php echo $materialData['id']; ?>&grnids=<?php echo decode($_GET['grnids']); ?>&required=<?php echo $rsListitem['id']; ?>&total=<?php echo $total; ?>&lotrec=<?php echo $rsListDatassa['id']; ?>&poid=<?php echo $_GET['poid']; ?>&colorid=<?php echo $_GET['colorid']; ?>&grnid=<?php echo $_GET['grnid']; ?>');
				}
				}
				</script>
                  </table>
                </div>
                <div class="row" style="margin-top: 20px;">
                  <?php
      $rl=GetPageRecord('*','packagingqualityreportmaster','1 and styleId="'.decode($_REQUEST['styleid']).'" and type="packagingtriminspectioninput" and lotId="'.decode($_REQUEST['lotId']).'"');
      $trimData=mysqli_fetch_array($rl);

      $packagingDataq=GetPageRecord('sum(okayqty) as totalokayqty,sum(rejectedqty) as totalrejectedqty,sum(disputedqty) as totaldisputeqty','packagaingtrimdatamaster','1 and styleId="'.decode($_REQUEST['styleid']).'" and costsheetVersionId=1 and status=1 and deletestatus=0 and lotNoMaster="'.decode($_REQUEST['lotId']).'"');
      $packagingDataqq=mysqli_fetch_array($packagingDataq);

      ?>
                     <table cellpadding="5" cellspacing="0" style="width:100%;">
                     <tr>
                     <td colspan="6" style="padding:0px !important;"><div style="padding: 10px 15px; border: 1px solid #ccc; font-size: 16px; cursor: pointer; background-color: #f8f8f8; position: relative; font-weight: 500; color: #000000; width: 100%; box-sizing: border-box;">Closure Type</div></td>
                     </tr>
                     <tr>
                      <td width="13%"><div align="center">Accepted</div></td>
                      <td width="18%"><div align="center">Re-processing</div></td>
                      <td width="19%"><div align="center">Rejected /Replaced </div></td>
                      <td width="17%"><div align="center">On Hold</div></td>
                      <td width="17%"><div align="center">Date</div></td>
                      <td width="16%"><div align="center">Closure By</div></td>
                    </tr>
                    <tr height="30">
                      <td><div align="center">
                          <input name="accepted" type="text"  id="accepted" value="<?php echo $packagingDataqq['totalokayqty'] ?>" autocomplete="off" style="width: 150px; text-align: center; border: 1px solid #bebebe; background-color: #fdfdfd;"  onkeyup="savequalityreport();" readonly="readonly">
                        </div></td>
                      <td><div align="center">
                          <input name="reprocessing" type="text"  id="reprocessing" value="<?php echo $packagingDataqq['totaldisputeqty'] ?>" autocomplete="off" style="width: 150px; text-align: center; border: 1px solid #bebebe; background-color: #fdfdfd;" onkeyup="savequalityreport();" readonly="readonly">
                        </div></td>
                      <td><div align="center">
                          <input name="rejectedreplaced" type="text"  id="rejectedreplaced" value="<?php echo $packagingDataqq['totalrejectedqty'] ?>" autocomplete="off" style="width: 150px; text-align: center; border: 1px solid #bebebe; background-color: #fdfdfd;" onkeyup="savequalityreport();" readonly="readonly">
                        </div></td>
                      <td><div align="center">
                          <input name="onhold" type="text"  id="onhold" value="<?php echo $packagingDataqq['totaldisputeqty'] ?>" autocomplete="off" style="width: 150px; text-align: center; border: 1px solid #bebebe; background-color: #fdfdfd;" onkeyup="savequalityreport();" readonly="readonly">
                        </div></td>
                      <td height="20" align="right"><div align="center">

                         <!--<input name="closurDate" type="text" class="newDatePickers" id="closurDate" value="<?php if($trimData['closurDate']!="" && $trimData['closurDate']!="0000-00-00" && $trimData['closurDate']!="1970-01-01"){ echo date('d-m-Y',strtotime($trimData['closurDate'])); } ?>" autocomplete="off" style="width: 150px; text-align: center; border: 1px solid #bebebe; background-color: #fdfdfd;" onchange="savequalityreport();">-->


                          <input name="closurDate" type="date" class="newDatePickers" id="closurDate" value="<?php if($trimData['closurDate']!="" && $trimData['closurDate']!="0000-00-00" && $trimData['closurDate']!="1970-01-01"){ echo $trimData['closurDate']; } ?>" autocomplete="off" style="width: 150px; text-align: center; border: 1px solid #bebebe; background-color: #fdfdfd;" onchange="savequalityreport();">
                        </div></td>
                      <td><div align="center">
                          <input name="closureby" type="text"  id="closureby" value="<?php echo stripslashes($trimData['closureby']); ?>" autocomplete="off" style="width: 150px; text-align: center; border: 1px solid #bebebe; background-color: #fdfdfd;" onkeyup="savequalityreport();" >
                          <input type="hidden" id="materialMasterId" value="<?php echo $_REQUEST['msid']; ?>" />
                        </div></td>
                    </tr>
                  </table>
                </div>
                <script>
function savequalityreport(){
var accepted = encodeURI($('#accepted').val());
var reprocessing = encodeURI($('#reprocessing').val());
var rejectedreplaced = encodeURI($('#rejectedreplaced').val());
var onhold = encodeURI($('#onhold').val());
var closurDate = encodeURI($('#closurDate').val());
var closureby = encodeURI($('#closureby').val());
var materialMasterId = encodeURI($('#materialMasterId').val());

$('#savequaalityinputreport').load('apparelbomaction.php?action=savepackagingquaalityinputreport&styleid=<?php echo $_REQUEST['styleid']; ?>&accepted='+accepted+'&reprocessing='+reprocessing+'&rejectedreplaced='+rejectedreplaced+'&onhold='+onhold+'&closurDate='+closurDate+'&closureby='+closureby+'&materialMasterId='+materialMasterId+'&lotId=<?php echo decode($_REQUEST['lotId']); ?>&materialid=<?php echo decode($_REQUEST['materialid']); ?>&colorid=<?php echo decode($_REQUEST['colorid']); ?>');

}
</script>
                <div id="savequaalityinputreport" style="display: none;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
.input-table tr td, .input-table tr th {
    padding: 5px !important;
}



</style>
