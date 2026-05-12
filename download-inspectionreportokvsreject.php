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
                  <th><div align="center">Inspection&nbsp;Type</div></th>
                  <th><div align="center">GRN Number</div></th>
                  <th><div align="center">Supplier&nbsp;PO&nbsp;Number</div></th>
                  <th><div align="center">Supplier&nbsp;Name</div></th>
                  <th><div align="center">Material&nbsp;Name</div></th>
                  <th><div align="center">Color</div></th>
                  <th><div align="center">Lot&nbsp;No</div></th>
                  <th><div align="center">Lot&nbsp;Quantity</div></th>
                  <th><div align="center">Inspected&nbsp;Quantity</div></th>
                  <th><div align="center">Accepted</div></th>
                  <th><div align="center">Rejected</div></th>
                  <th><div align="center">Re-Processing</div></th>
                  <th><div align="center">OnHold</div></th>
                  <th><div align="center">Inspection&nbsp;Date</div></th>


                              </tr>
              </thead>
<?php

$grnDataq=GetPageRecord('*','grnMaster','1 and parentId in (select id from grnMaster where grnNo!="") and materialId in (select id from styleSubCategoryMaster where materialType=1) order by id');
$lotNo=mysql_num_rows($grnDataq);

$grnDataq1=GetPageRecord('*','grnMaster','1 and parentId in (select id from grnMaster where grnNo!="") and materialId in (select id from styleSubCategoryMaster where materialType=2) order by id');
$lotNo1=mysql_num_rows($grnDataq1);

$grnDataq2=GetPageRecord('*','grnMaster','1 and parentId in (select id from grnMaster where grnNo!="") and materialId in (select id from styleSubCategoryMaster where materialType=3) order by id');
$lotNo2=mysql_num_rows($grnDataq2);

$select='*';
 if($styleId!=''){
      $stylestatus = 'and styleId="'.$styleId.'"';
    }

     if($materialType!=''){
      $material = 'and materialId in (select id from styleSubCategoryMaster where materialType="'.$materialType.'")';
    }

$where='where 1 and parentId in (select id from grnMaster where grnNo!="") and materialId in (select id from styleSubCategoryMaster where materialType=1 or materialType=2 or materialType=3) '.$material.' '.$stylestatus.' order by id desc';

$page=$_GET['page'];
$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

$rs=GetRecordList($select,'grnMaster',$where,'13',$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($grnData=mysqli_fetch_array($rs[0])) {

            $grnParentDataq=GetPageRecord('*','grnMaster','1 and id="'.$grnData['parentId'].'"');
            $grnParentData=mysqli_fetch_array($grnParentDataq);

            $materialDataq=GetPageRecord('*','styleSubCategoryMaster','id="'.$grnData['materialId'].'"');
            $materialData=mysqli_fetch_array($materialDataq);

            $queryDataq=GetPageRecord('*','queryMaster','id="'.$grnData['styleId'].'"');
            $queryData=mysqli_fetch_array($queryDataq);


if($materialData['materialType'] == 1){
  $lot=$lotNo;
   $rsgrnSupplier=GetPageRecord('sum(received) as totalReceived,orderQty,sum(netReceived) as totalnetReceived','grnMaster','styleId="'.$grnData['styleId'].'" and parentId="'.$grnParentData['id'].'" and materialId="'.$grnData['materialId'].'" and color="'.$grnData['color'].'"');
    $rsgrnSupplierName=mysqli_fetch_array($rsgrnSupplier);

    $k=GetPageRecord('*','qualitymodulemaster','1 and styleId="'.$grnData['styleId'].'" and lotNoMaster="'.$lot.'"');
$lotData=mysqli_fetch_array($k);

$lotNameDataq=GetPageRecord('*','lotMaster','1 and id="'.$lotData['lotNoMaster'].'"');
$lotNameData=mysqli_fetch_array($lotNameDataq);

$lotResultq=GetPageRecord('*','lotWiseData','1 and styleId="'.$grnData['styleId'].'" and lotId="'.$lotData['lotNoMaster'].'"');
$lotResult=mysqli_fetch_array($lotResultq);
}
if($materialData['materialType'] == 2){
  $lot1=$lotNo1;
   $rsgrnSupplier=GetPageRecord('sum(received) as totalReceived,orderQty,sum(netReceived) as totalnetReceived','grnMaster','styleId="'.$grnData['styleId'].'" and parentId="'.$grnParentData['id'].'" and materialId="'.$grnData['materialId'].'" and color="'.$grnData['color'].'"');
    $rsgrnSupplierName=mysqli_fetch_array($rsgrnSupplier);

     $trimDataq=GetPageRecord('sum(inspectionqty) as totalinspection,sum(okayqty) as totalokayqty,sum(rejectedqty) as totalrejectedqty,sum(disputedqty) as totaldisputeqty','trimdatamaster','1 and styleId="'.$grnData['styleId'].'" and costsheetVersionId=1 and status=1 and deletestatus=0 and lotNoMaster="'.$lot1.'"');
$trimDataqq=mysqli_fetch_array($trimDataq);

$rl=GetPageRecord('*','qualityreportmaster','1 and styleId="'.$grnData['styleId'].'" and type="triminspectioninput" and lotId="'.$lot1.'"');
$lotData=mysqli_fetch_array($rl);


}
if($materialData['materialType'] == 3){
  $lot2=$lotNo2;
   $rsgrnSupplier=GetPageRecord('sum(received) as totalReceived,orderQty,sum(netReceived) as totalnetReceived','grnMaster','styleId="'.$grnData['styleId'].'" and parentId="'.$grnParentData['id'].'" and materialId="'.$grnData['materialId'].'" and color="'.$grnData['color'].'"');
    $rsgrnSupplierName=mysqli_fetch_array($rsgrnSupplier);


$packagingDataq=GetPageRecord('sum(inspectionqty) as totalinspection,sum(okayqty) as totalokayqty,sum(rejectedqty) as totalrejectedqty,sum(disputedqty) as totaldisputeqty','packagaingtrimdatamaster','1 and styleId="'.$grnData['styleId'].'" and costsheetVersionId=1 and status=1 and deletestatus=0 and lotNoMaster="'.$lot2.'"');
$packagingDataqq=mysqli_fetch_array($packagingDataq);

$rl=GetPageRecord('*','packagingqualityreportmaster','1 and styleId="'.$grnData['styleId'].'" and type="packagingtriminspectioninput" and lotId="'.$lot2.'"');
$trimData=mysqli_fetch_array($rl);

}

?>
            <tbody id="allhotellisting">
                <tr>


                  <td><div align="center"><?php echo getBuyerName($queryData['buyerId']); ?></div></td>
                  <td><div align="center"><?php echo getbrandName($queryData['brandId']); ?></div></td>
                  <td><div align="center">#<?php echo getStyleRefId($grnData['styleId']); ?></div></td>
                  <td><div align="center">
                    <?php
                    if($materialData['materialType'] == 1){ echo "Fabric"; }
                    if($materialData['materialType'] == 2){ echo "Trims"; }
                    if($materialData['materialType'] == 3){ echo "Packaging"; }
                     ?>
                  </div></td>
                  <td><div align="center"><?php echo $grnParentData['grnNo']; ?></div></td>
                  <td><div align="center"><?php echo $grnData['supplierPurchaseOrderId']; ?></div></td>
                  <td><div align="center"><?php echo getSupplierName($grnParentData['supplierId']); ?></div></td>
                  <td><div align="center"><?php echo $materialData['name']; ?></div></td>
                  <td><div align="center"><?php
            $rs112=GetPageRecord('name','colorCardMaster','id="'.$grnData['color'].'"');
            $resListing112=mysqli_fetch_array($rs112);
            echo $resListing112['name'];
            ?></div></td>
                  <td><div align="center">
                    <?php if($materialData['materialType'] == 1){ echo 'Lot '.$lot; } ?>
                    <?php if($materialData['materialType'] == 2){ echo 'Lot '.$lot1; } ?>
                    <?php if($materialData['materialType'] == 3){ echo 'Lot '.$lot2; } ?>
                  </div></td>
                  <td><div align="center"><?php echo $rsgrnSupplierName['totalnetReceived']; ?></div></td>
                  <td><div align="center">
            <?php if($materialData['materialType'] == 1){ echo $lotResult['totalinspectedqty']; } ?>
             <?php if($materialData['materialType'] == 2){ echo $trimDataqq['totalinspection']; } ?>
             <?php if($materialData['materialType'] == 3){ echo $packagingDataqq['totalinspection']; } ?>
              </div></td>
                  <td><div align="center">
                    <?php if($materialData['materialType'] == 1){ echo $lotResult['acceptedField']; }  ?>
                    <?php if($materialData['materialType'] == 2){ echo $trimDataqq['totalokayqty']; } ?>
                    <?php if($materialData['materialType'] == 3){ echo $packagingDataqq['totalokayqty']; } ?>

                    </div></td>
                  <td><div align="center">
                    <?php if($materialData['materialType'] == 1){ echo $lotResult['rejectedField']; } ?>
                    <?php if($materialData['materialType'] == 2){ echo $trimDataqq['totalrejectedqty']; } ?>
                    <?php if($materialData['materialType'] == 3){ echo $packagingDataqq['totalrejectedqty']; } ?>
                    </div></td>
                  <td><div align="center">
                    <?php if($materialData['materialType'] == 1){ echo $lotResult['reprocessingField']; } ?>
                    <?php if($materialData['materialType'] == 2){ echo $trimDataqq['totaldisputeqty']; } ?>
                    <?php if($materialData['materialType'] == 3){ echo $packagingDataqq['totaldisputeqty']; } ?>
                    </div></td>
                  <td><div align="center">
                    <?php if($materialData['materialType'] == 1){ echo $lotResult['onholdField']; } ?>
                    <?php if($materialData['materialType'] == 2){ echo $trimDataqq['totaldisputeqty']; } ?>
                    <?php if($materialData['materialType'] == 3){ echo $packagingDataqq['totaldisputeqty']; } ?>

                    </div></td>
                  <td><div align="center"><?php if($lotResult['inspectedDate']!="" && $lotResult['inspectedDate']!="0000-00-00" && $lotResult['inspectedDate']!="1970-01-01" && $materialData['materialType'] == 1){ echo date('d-m-Y',strtotime($lotResult['inspectedDate'])); } ?>
                    <?php if($lotData['closurDate']!="" && $lotData['closurDate']!="0000-00-00" && $lotData['closurDate']!="1970-01-01" && $materialData['materialType'] == 2){ echo date('d-m-Y',strtotime($lotData['closurDate'])); } ?>
                    <?php if($trimData['closurDate']!="" && $trimData['closurDate']!="0000-00-00" && $trimData['closurDate']!="1970-01-01" && $materialData['materialType'] == 3){ echo date('d-m-Y',strtotime($trimData['closurDate'])); } ?>
                  </div></td>


                </tr>
                </tbody>

                <?php
               if($materialData['materialType'] == 1){ $lotNo--; }
                if($materialData['materialType'] == 2){ $lotNo1--; }
                if($materialData['materialType'] == 3){ $lotNo2--; }
                 } ?>
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

