<?php
ob_start();
include "inc.php";
$assignto="Download";

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>
       <table class="table table-bordered capacity-class" style="width:100%;">

            <thead>

                <tr style="background-color: #e9fff8;">
                  <th><div align="center">Buyer</div></th>
                  <th><div align="center">Brand</div></th>
                  <th><div align="center">Style</div></th>
                  <!--<th><div align="center">Color</div></th>-->
                  <th><div align="center">Order&nbsp;Quantity</div></th>
                  <th><div align="center">Planned&nbsp;Quantity</div></th>
                  <th><div align="center">Factory</div></th>
                  <th><div align="center">Line</div></th>
                  <th><div align="center">Line&nbsp;Start&nbsp;Date</div></th>
                 <th><div align="center">Line&nbsp;End&nbsp;Date</div></th>

                  </tr>

              </thead>

<?php

$select='*';

 if($styleId!=''){

      $stylestatus = 'and styleId="'.$styleId.'"';

    }

$where='where 1 '.$stylestatus.' order by id asc ';

$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';


$rs=GetRecordList($select,'buyerPurchaseOrderMaster',$where,'20',$page,$targetpage);

$totalentry=$rs[1];

$paging=$rs[2];

while($resultlists=mysqli_fetch_array($rs[0])){

 $querydataq=GetPageRecord('*','queryMaster','1 and id="'.$resultlists['styleId'].'"');

        $querydata=mysqli_fetch_array($querydataq);


  if(mysql_num_rows($querydataq) > '0') {

	$kr=GetPageRecord('*','linePlanMaster','1 and styleId="'.$querydata['id'].'"');
								$lineData=mysqli_fetch_array($kr);
	$kk=GetPageRecord('*','linePlanMaster','1 and styleId="'.$querydata['id'].'" and factoryId="'.$lineData['factoryId'].'" group by lineId desc');
			while($lineDataa=mysqli_fetch_array($kk)){

			    $lo=GetPageRecord('*','factoryLineMaster','id="'.$lineDataa['lineId'].'"');
								$lineName=mysqli_fetch_array($lo);



 $rsSize=GetPageRecord('*','purchaseOrderStyleMaster','parentId="'.$purchaseOrderdata['id'].'" group by color');
          while($rsSizeList=mysqli_fetch_array($rsSize)){

$wherenew = 'styleId="'.$rsSizeList['styleId'].'" and color="'.$rsSizeList['color'].'" and parentId="'.$rsSizeList['parentId'].'"';

            $rsSizeTotal=GetPageRecord('SUM(gdQty) as totalQty','purchaseOrderStyleMaster',$wherenew);
          $rsSizeListTotal=mysqli_fetch_array($rsSizeTotal);



?>

            <tbody id="allhotellisting">

                <tr>
                  <td><div align="center"><?php echo getBuyerName($querydata['buyerId']); ?></div></td>

                  <td><div align="center"><?php echo getbrandName($querydata['brandId']); ?></div></td>

                  <td><div align="center">#<?php echo getStyleRefId($resultlists['styleId']); ?></div></td>



                  <td><div align="center"><?php echo $querydata['orderQty']; ?></div></td>

                  <?php

                  	$kks=GetPageRecord('SUM(dateWiseLineInput) as totalQtys','linePlanMaster','1 and styleId="'.$querydata['id'].'" and factoryId="'.$lineData['factoryId'].'" group by lineId desc');
			                    $lineDataas=mysqli_fetch_array($kks)
                  ?>

                  <td><div align="center"><?php echo $lineDataas['totalQtys'];  ?>   </div></td>

                  <td><div align="center">
                      <?php
                      	$km=GetPageRecord('*','factoryMaster','id="'.$lineData['factoryId'].'"');
								$factotyData=mysqli_fetch_array($km);

								echo $factotyData['name'];
								?>
                  </div></td>

                  <td><div align="center">
                                                                   <span style="padding: 5px 10px; background-color: #0097a7; color: #fff; margin-right: 2px; font-size: 12px; margin-bottom:5px;display: inline-block;"><?php echo str_replace(' ','&nbsp;',$lineName['lineName']);?></span>

                  </div></td>

                  <td><div align="center"><?php echo  $lineDataa['uploadInputDate']; ?></div></td>

                  <?php
                  $krs=GetPageRecord('*','linePlanMaster','1 and styleId="'.$querydata['id'].'" order by uploadInputDate desc');
								$lineDatas=mysqli_fetch_array($krs);
                  ?>
                <td><div align="center"><?php echo  $lineDatas['uploadInputDate']; ?></div></td>



                </tr>

                </tbody>

                <?php } } }
                 }

               ?>

              </table>