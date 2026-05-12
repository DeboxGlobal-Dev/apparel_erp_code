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

                  <th><div align="center">Season</div></th>


                  <th><div align="center">Style</div></th>

                  <th><div align="center">Quantity </div></th>
				  <th><div align="center">Price&nbsp;(FOB)  </div></th>
				  <th><div align="center">PO&nbsp;Number </div></th>
				   <th><div align="center">PO&nbsp;Quantity </div></th>

				    <th><div align="center">Quantity&nbsp;To&nbsp;Be&nbsp;Aired&nbsp;With&nbsp;UOM </div></th>

				   <th><div align="center">Original&nbsp;Ex-Factory </div></th>
				    <th><div align="center">Revised&nbsp;Ex-Factory </div></th>
					 <th><div align="center">Original&nbsp;Mode </div></th>
                  <th><div align="center">Revised&nbsp;Mode </div></th>
                  <th><div align="center">Delivery&nbsp;Term </div></th>

                              </tr>
              </thead>
<?php

$queryDataqa=GetPageRecord('*','airFreightMaster','1 and statusFinal="2"');
while($queryDataa=mysqli_fetch_array($queryDataqa)){


$queryDataq=GetPageRecord('*','queryMaster','1 and id="'.$queryDataa['styleId'].'"');
$queryData=mysqli_fetch_array($queryDataq);

 $queryDa=GetPageRecord('*','poManageMaster','1 and styleId="'.$queryData['id'].'" and poNumber="'.$queryDataa['buyerPo'].'"');
$quer=mysqli_fetch_array($queryDa);


 $queryDataqddd=GetPageRecord('*','seasonMaster','1 and id="'.$queryData['seasonId'].'"');
$queryDataddd=mysqli_fetch_array($queryDataqddd);


?>
            <tbody id="allhotellisting">
                <tr>


                  <td><div align="center"><?php echo getBuyerName($queryData['buyerId']); ?></div></td>
                  <td><div align="center"><?php echo getbrandName($queryData['brandId']); ?></div></td>



                  <td><div align=""><?php echo $queryDataddd['name'] ?></div></td>





                  <td><div align="center"><?php echo '#'.$queryData['styleRefId']; ?></div></td>

                  <td><div align="center">
                    <?php echo $queryData['orderQty'];   ?></div></td>


                  <td><div align="center"><?php echo $queryDataa['invoiceVal'];  ?></div></td>
                  <td><div align="center"><?php echo $queryDataa['buyerPo']  ?></div></td>






                 <td><?php echo $quer['poQty']; ?></td>
                 <td><?php echo $queryDataa['qtyuom']; ?></td>
                 <td><?php echo $queryDataa['orgfact']; ?></td>

                 <td><?php echo $queryDataa['factDate']; ?></td>
                 <td><?php echo $quer['shipMode']; ?></td>
                 <td>Air</td>
				  <td><?php if($queryDataa['shipTerm']=="1"){ echo "FOB";}elseif($queryDataa['shipTerm']=="2"){ echo "CIF"; }elseif($queryDataa['shipTerm']=="3"){ echo "CFR"; }  ?></td>
                </tr>
                </tbody>

                <?php
                 }
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