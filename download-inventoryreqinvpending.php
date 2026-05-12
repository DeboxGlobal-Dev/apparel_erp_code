<?php
ob_start();
include "inc.php";
$assignto="Download";

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>
      <table class="table table-bordered table-responsive capacity-class" style="width:100%;">
            <thead>
                <tr style="background-color: #e9fff8;">



                  <th><div align="center">Buyer</div></th>
                  <th><div align="center">Brand</div></th>
                  <th><div align="center">Style</div></th>
                  <th><div align="center">Material&nbsp;Type</div></th>
                  <th><div align="center">Material&nbsp;Name</div></th>
                  <th><div align="center">Color</div></th>
                  <th><div align="center">Supplier</div></th>
                  <th><div align="center">Material&nbsp;Required</div></th>
                  <th><div align="center">Material&nbsp;Booked</div></th>
                  <th><div align="center">GRN/Received</div></th>
                  <th><div align="center">Inspected</div></th>
                  <th><div align="center">Balance</div></th>


                              </tr>
              </thead>
<?php

$queryDataq=GetPageRecord('*','queryMaster','1 and subject!="" and deletestatus=0 order by id desc');
while($queryData=mysqli_fetch_array($queryDataq)){
  $costversion = $queryData['defaultcostsheetVersionId'];


$select='*';
 if($styleId!=''){
      $stylestatus = 'and styleId="'.$styleId.'"';
    }

    if($materialType!=''){
      $material = 'and materialType="'.$materialType.'"';
    }

$where='where 1 and costsheetVersionId="'.$costversion.'" and styleId="'.$queryData['id'].'" and parentId=0 '.$stylestatus.' '.$material.' order by sr asc';
$page=$_GET['page'];
$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

$rs=GetRecordList($select,'styleSubCategoryMaster',$where,'10',$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($subcatData=mysqli_fetch_array($rs[0])) {



  $rs12=GetPageRecord('*','purchaseOrderStyleMaster','styleId="'.$subcatData['styleId'].'" and sectionType=0 order by id asc');
              while($result1=mysqli_fetch_array($rs12)){

                $orderQty='';
              $totalMaterialQty = '0';


                $purchaseDataq=GetPageRecord('*','purchaseOrderStyleMaster','parentId="'.$result1['id'].'"');
              while($purchaseData=mysqli_fetch_array($purchaseDataq)){
                $color = $purchaseData['color'];
                $orderQty+=$purchaseData['gdQty'];
                $orderQty = round($orderQty);
              }
               $materialtypeq=GetPageRecord('*','materialTypeMaster','1 and id="'.$subcatData['materialType'].'"');
               $materialtype=mysqli_fetch_array($materialtypeq);

              $grnDataq=GetPageRecord('sum(netReceived) as netReceivedTill,parentId','grnMaster',' materialId="'.$subcatData['id'].'" and styleId="'.$subcatData['styleId'].'" and color="'.$color.'"');
              $grnData=mysqli_fetch_array($grnDataq);
              $grndatacount=mysql_num_rows($grnDataq);


              $grnDataqq=GetPageRecord('*','grnMaster','id="'.$grnData['parentId'].'"');
              $grnDataq=mysqli_fetch_array($grnDataqq);
              $grncount=mysql_num_rows($grnDataqq);

              if($subcatData['materialType']==1){
$lotWiseDataFabricq=GetPageRecord('sum(acceptedField) as totalacceptedField','lotWiseData','1 and styleId="'.$subcatData['styleId'].'" and materialid="'.$subcatData['id'].'" and colorid="'.$color.'"');
$lotWiseDataFabric=mysqli_fetch_array($lotWiseDataFabricq);
$inspectedQty=$lotWiseDataFabric['totalacceptedField'];
        }
        if($subcatData['materialType']==2){
$qualityreportmasterDataq=GetPageRecord('sum(accepted) as totalaccepted','qualityreportmaster','1 and styleId="'.$subcatData['styleId'].'" and type="triminspectioninput" and materialid="'.$subcatData['id'].'" and colorid="'.$color.'"');
$qualityreportmasterData=mysqli_fetch_array($qualityreportmasterDataq);
$inspectedQty=$qualityreportmasterData['totalaccepted'];
        }
        if($subcatData['materialType']==3){

$packagingqualityreportmasterDataq=GetPageRecord('sum(accepted) as totalaccepted','packagingqualityreportmaster','1 and styleId="'.$subcatData['styleId'].'" and type="packagingtriminspectioninput" and materialid="'.$subcatData['id'].'" and colorid="'.$color.'"');
$packagingqualityreportmasterData=mysqli_fetch_array($packagingqualityreportmasterDataq);
$inspectedQty=$packagingqualityreportmasterData['totalaccepted'];

        }

              $techPackDataq=GetPageRecord('*','techPackDetailMaster',' stylesubtabid="'.$subcatData['id'].'" and sectionType="bom" and styleId="'.$subcatData['styleId'].'" and costsheetVersionId="'.$costversion.'" order by id asc');
              $techPackData=mysqli_fetch_array($techPackDataq);

              $totalallowance=0;
              $rspro=GetPageRecord('*','rejectioninproductionmaster','1 and qty>'.$orderQty.'');
              $resultpro=mysqli_fetch_array($rspro);
              $totalallowance = $resultpro['totalallwance'];
              $orderQty = round($orderQty+(($orderQty*$totalallowance)/100));

              $totalMaterialQty =  round($orderQty*$techPackData['avgIncWastage'],3);


                if($subcatData['sizeSeparate']==0){



?>
            <tbody id="allhotellisting">
                <tr>


                  <td><div align="center"><?php echo getBuyerName($queryData['buyerId']); ?></div></td>
                  <td><div align="center"><?php echo getbrandName($queryData['brandId']); ?></div></td>
                  <td><div align="center">#<?php echo getStyleRefId($subcatData['styleId']); ?></div></td>
                  <td><div align="center"><?php echo $materialtype['name'] ?></div></td>
                  <td><div align="center"><?php echo $subcatData['name'] ?></div></td>
                  <td><div align="center"><?php
                  $rs11=GetPageRecord('name','colorCardMaster','id="'.$color.'"');
                $resListing11=mysqli_fetch_array($rs11);
                  echo $colorarr = rtrim($resListing11['name'],',');
                   ?></div></td>
                  <td><div align="center"><?php if($grncount > 0){ echo getSupplierName($grnDataq['supplierId']); } else { echo '-'; } ?></div></td>
                  <td><div align="center">
                    <?php if($totalMaterialQty != ""){ echo $a = $totalMaterialQty; } else { echo "-"; } ?></div></td>
                  <td><div align="center"><?php if($grndatacount > 0){ echo round($grnData['netReceivedTill'],3); } else { echo '-'; } ?></div></td>
                  <td><div align="center"><?php if($grndatacount > 0){ echo round($grnData['netReceivedTill'],3); } else { echo '-'; } ?></div></td>
                  <td><div align="center"><?php if($inspectedQty != ""){ echo $b = $inspectedQty; } else { echo "-"; } ?></div></td>
                  <td><div align="center"><?php if($totalMaterialQty != "-"){ echo round($a-$b) ; } else { echo "-"; } ?></div></td>



                </tr>
                </tbody>

                <?php
                 }
               }
               }
                  }  ?>
              </table>

              <!-- <code -->
                <div class="pagingdiv" style="width: 97%;margin: 20px auto;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tbody>
                        <tr>
                          <td align="right"><div class="pagingnumbers"><?php echo $paging; ?></div></td>
                        </tr>
                      </tbody>
                    </table>

