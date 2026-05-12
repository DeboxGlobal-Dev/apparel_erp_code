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
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Name</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Style#</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" width="170px">Sample&nbsp;Type
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" width="170px">Requested&nbsp;Date</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" width="170px">Target&nbsp;Date</th></th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Color</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Quantity</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php
$no=1;
$select='*';
$where='';
$rs='';
$limit=clean($_GET['records']);

   if($_GET['styleId']!=''){
$styleid = 'and id="'.decode($_GET['styleId']).'"';
}
 if($_GET['sampleId']!=''){
$sampleid = 'and sampleType="'.decode($_GET['sampleId']).'"';
}
if($_GET['brandId']!=''){
$brandid = 'and brandId="'.decode($_GET['brandId']).'"';
}
if($_GET['requestdate']!=''){
$rdate = 'and requestedDate="'.$_GET['requestdate'].'"';
}
if($_GET['targetdate']!=''){
$tdate = 'and expectedDate="'.$_GET['targetdate'].'"';
}


$where='where subject!=""  '.$styleid.' '.$sampleid.' '.$brandid.' '.$rdate.' '.$tdate.' and deletestatus=0 and sampleStyle="2" order by id desc';


$page=$_GET['page'];


$targetpage=$fullurl.'loadstyle.php?module='.$modfile['moduleName'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';

$rs=GetRecordListJs($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

    $rsqtys=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$resultlists['id'].'"');
    while($totalqtys = mysqli_fetch_array($rsqtys)){

       $rsqtysa=GetPageRecord('*','colorCardMaster','1 and id="'.$totalqtys['colorId'].'"');
       $totalqtysa =mysqli_fetch_array($rsqtysa);

  $rsample=GetPageRecord('*','sampleTypeMaster','1 and id="'.$resultlists['sampleType'].'"');
                $smapleList = mysqli_fetch_array($rsample);

                 $nuCount1=GetPageRecord('*','seasonMaster','1 and id="'.$resultlists['seasonId'].'"');
            $countFactory1=mysqli_fetch_array($nuCount1);

            $nuCount4=GetPageRecord('*','subCategoryMaster','1 and id="'.$resultlists['subCategoryId'].'"');
            $countFactory4=mysqli_fetch_array($nuCount4);

?>
            <tr role="row" height="30">
             <td><?php echo getBuyerName($resultlists['buyerId']); ?></td>
             <td><?php echo getBrandName($resultlists['brandId']); ?></td>
              <td><?php echo $countFactory1['name']; ?></td>
              <td><?php echo $countFactory4['name']; ?></td>
              <td><?php echo $resultlists['subject']; ?></td>
              <td><?php echo '#'.$resultlists['styleRefId']; ?></td>
              <td><?php echo $smapleList['name']; ?></td>
              <td><?php echo date('d-m-Y',strtotime($resultlists['requestedDate'])); ?></td>
              <td><?php echo  date('d-m-Y',strtotime($resultlists['expectedDate'])); ?></td>

            <td style=""><?php echo $totalqtysa['name']; ?></td>
              <td align="left"><?php echo $totalqtys['qty']; ?>
                          </td>
                        </tr>
                        <?php } } ?>
                      </tbody>
                    </table>