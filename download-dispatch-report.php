<?php
ob_start();
include "inc.php";
$assignto='download';

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");
?>
<table  border="1" cellspacing="0" style="font-size:12px;">
                      <thead>
                        <tr style="background-color: #4f55ff;color: #fff;" height="30">

              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Buyer</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Brand</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Season</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Sub-&nbsp;Category</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style#</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Sampling&nbsp;Style#</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" width="170px">Sample&nbsp;Type
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" width="170px">CDN&nbsp;No</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" width="170px">Carrier</th></th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Carrier&nbsp;Name</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">AWB&nbsp;Number</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">No.&nbsp;of&nbsp;Pieces</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Value</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Sender's&nbsp;Name</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Factory</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
$no=1;
$select='*';
$where='';
$rs='';
$limit=clean($_GET['records']);



$where='where brandId!="" and cdntype="2"  order by id desc';

$page=$_GET['page'];


$targetpage=$fullurl.'loadstyle.php?module='.$modfile['moduleName'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';

$rs=GetRecordListJs($select,'cdnMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

  $rsample=GetPageRecord('*','cdnStyleMaster','1 and parentId="'.$resultlists['id'].'"');
                while($smapleList = mysqli_fetch_array($rsample)) {





                  $nuCount=GetPageRecord('*','queryMaster','1 and id="'.$smapleList['sampleReq'].'"');
            $countFactory=mysqli_fetch_array($nuCount);

                  $nuCount1=GetPageRecord('*','queryMaster','1 and id="'.$smapleList['styleId'].'" ');
            $countFactory1=mysqli_fetch_array($nuCount1);

                 $nuCount2=GetPageRecord('*','seasonMaster','1 and id="'.$countFactory1['seasonId'].'"');
            $countFactory2=mysqli_fetch_array($nuCount2);

            $nuCount3=GetPageRecord('*','subCategoryMaster','1 and id="'.$countFactory1['subCategoryId'].'"');
            $countFactory3=mysqli_fetch_array($nuCount3);

            $nuCount4=GetPageRecord('*','sampleTypeMaster','1 and id="'.$countFactory['sampleType'].'"');
            $countFactory4=mysqli_fetch_array($nuCount4);



?>
            <tr role="row" height="30">
             <td align="center"><?php echo getBuyerName($countFactory1['buyerId']); ?></td>
             <td align="center"><?php echo getBrandName($countFactory1['brandId']); ?></td>
              <td align="center"><?php echo $countFactory2['name']; ?></td>
              <td align="center"><?php echo $countFactory3['name']; ?></td>
              <td align="center"><?php echo '#'.$countFactory1['styleRefId']; ?></td>
              <td align="center"><?php echo '#'.$countFactory['styleRefId']; ?></td>
              <td align="center"><?php echo $countFactory4['name']; ?></td>
              <td align="center"><?php echo makeQueryId($resultlists['id']); ?></td>
              <td align="center"><?php echo $resultlists['carrier'] ?></td>
              <td align="center"><?php echo $resultlists['carrierName'] ?></td>
              <td align="center"><?php echo $resultlists['awbNo'] ?></td>
              <td align="center"><?php echo $smapleList['qty'] ?></td>
              <td align="center"><?php echo $smapleList['value'] ?></td>
              <td align="center"><?php echo $resultlists['sName'] ?></td>
              <td align="center"><?php echo $resultlists['factorylocation'] ?></td>

                        </tr>
                        <?php } } ?>
                      </tbody>
                    </table>