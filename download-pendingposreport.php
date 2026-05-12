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
                  <th><div align="center">Supplier&nbsp;Name</div></th>
                  <th><div align="center">Supplier&nbsp;Id</div></th>
                  <th><div align="center">Style</div></th>
                  <th><div align="center">Brand</div></th>
                  <th><div align="center">Buyer</div></th>
                  <th><div align="center">Material&nbsp;Name</div></th>
                  <th><div align="center">Material&nbsp;For</div></th>
                  <th><div align="center">Color</div></th>
                  <th><div align="center">Qty/Avg</div></th>
                  <th><div align="center">UOM</div></th>
                  <th><div align="center">Rate</div></th>
                  <th><div align="center">Value</div></th>
                  <th><div align="center">Order&nbsp;Quantity</div></th>
                  <th><div align="center">Indent&nbsp;Verified&nbsp;Date</div></th>
                              </tr>
              </thead>
<?php
$select='*';
 if($styleId!=''){
      $stylestatus = 'and styleId="'.$styleId.'"';
    }
$where='where 1 '.$stylestatus.' group By createdDate,supplierId order by createdDate desc';

$page=$_GET['page'];
$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

$rs=GetRecordList($select,'indentCreationMaster',$where,'20',$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

if($resultlists['supplierId']!=0){

$list2=GetPageRecord('*','indentCreationMaster','1 and supplierId="'.$resultlists['supplierId'].'" and createdDate="'.$resultlists['createdDate'].'" and bomPoStatus=0');
while($listdata=mysqli_fetch_array($list2)){

  $subcatdataq=GetPageRecord('*','styleSubCategoryMaster','id="'.$listdata['materialId'].'"');
        $subcatdata=mysqli_fetch_array($subcatdataq);

  $rsListbuyer=GetPageRecord('buyerId,brandId,sampleStyle','queryMaster','id="'.$listdata['styleId'].'"');
                $queryList=mysqli_fetch_array($rsListbuyer);

?>
            <tbody id="allhotellisting">
                <tr>


                  <td><div align="center"><?php echo getSupplierName($resultlists['supplierId']); ?></div></td>
                  <td><div align="center"><?php echo getSupplierCode($resultlists['supplierId']); ?></div></td>
                  <td><div align="center">#<?php echo getStyleRefId($listdata['styleId']); ?></div></td>
                  <td><div align="center"><?php echo getbrandName($queryList['brandId']); ?></div></td>
                  <td><div align="center"><?php echo getBuyerName($queryList['buyerId']); ?></div></td>
                  <td><div align="center"><?php echo $subcatdata['name']; ?></div></td>
                  <td><div align="center"><?php if($queryList['sampleStyle']=='1'){ echo "Bulk"; }else{ echo "Sample"; } ?></div></td>
                  <td><div align="center"><?php
          $colordataq=GetPageRecord('name','colorCardMaster','id="'.$listdata['color'].'"');
          $colordata=mysqli_fetch_array($colordataq);
          echo $colordata['name']; ?></div></td>
                  <td><div align="center"><?php echo $listdata['avg']; ?></div></td>
                  <td><div align="center"><?php echo $listdata['uom']; ?></div></td>
                  <td><div align="center"><?php echo $listdata['sellingRate']; ?></div></td>
                  <td><div align="center"><?php echo $listdata['sellingValue']; ?></div></td>
                  <td><div align="center"><?php echo $listdata['orderQty']; ?></div></td>
                  <td><div align="center"><?php echo date('d-M-Y',strtotime($resultlists['createdDate'])); ?></div></td>

                </tr>
                </tbody>

                <?php }
              } }
               ?>
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