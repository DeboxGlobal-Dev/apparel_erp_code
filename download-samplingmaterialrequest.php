<?php
ob_start();
include "inc.php";
$assignto="download";


header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>


                       <table class="table table-bordered table-hover no-footer table-responsive">
                       <thead style="background-color: #f5f5f5; text-align:center;">
                       <tr role="row">
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;No</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Material&nbsp;Name</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Material&nbsp;Type</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Material&nbsp;Quantity</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Material&nbsp;Value</th>
                          <th class="sorting" style="width: 225px;" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Artwork&nbsp;Number</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >CAD&nbsp;Given&nbsp;Date</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">CAD&nbsp;Approval&nbsp;Date</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Color&nbsp;Standard&nbsp;Approval</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Lab&nbsp;Dip/Strike&nbsp;off&nbsp;Submission</th>

                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Lab&nbsp;Dip/Strike&nbsp;off&nbsp;Final&nbsp;Approval</th>


                       </thead>
                       <tbody id="">
<?php

//$limit=clean($_GET['records']);
$where='where  deletestatus=0 and sampleStyle="2" order by id desc';


 //$page=$_GET['page'];

//$targetpage=$fullurl.'loadstyle.php?module='.$modfile['moduleName'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';

 //$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';


$where='1 and deletestatus=0 and sampleStyle="2" order by id desc';
    $rs=GetPageRecord('*','queryMaster',$where);
    while($resultlists=mysqli_fetch_array($rs)){

//$rs=GetRecordListJs($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
//$totalentry=$rs[1];
//$paging=$rs[2];
//while($resultlists=mysqli_fetch_array($rs[0])){


        $wherecountmaterial='styleId="'.$resultlists['id'].'" ';

    $rsb=GetPageRecord('*','techPackDetailMaster',$wherecountmaterial);

       while($resultlistss=mysqli_fetch_array($rsb)){




    $wherecountmaterials='id="'.$resultlistss['styleId'].'" ';
    $rscountmaterialcc=GetPageRecord('*','queryMaster',$wherecountmaterials);
    $rescountmaterialcc=mysqli_fetch_array($rscountmaterialcc);


$wherecountmaterials2='id="'.$resultlistss['stylesubtabid'].'" ';
$rscountmaterialcc2=GetPageRecord('*','styleSubCategoryMaster',$wherecountmaterials2);
$rescountmaterialcc2=mysqli_fetch_array($rscountmaterialcc2);


$wherecou='id="'.$rescountmaterialcc2['materialType'].'" ';
$rscou=GetPageRecord('*','materialTypeMaster',$wherecou);
$rescount=mysqli_fetch_array($rscou);


$wherecouc='styleId="'.$resultlists['id'].'" ';
$rscouc=GetPageRecord('*','styleColorDetailMaster',$wherecouc);
$rescountc=mysqli_fetch_array($rscouc);

$orderQty='';
							$size='';
							$totalMaterialQty = '0';

							$orderQty+=$rescountc['qty'];


							$totalMaterialQty =  $orderQty*$resultlistss['avgIncWastage'];
 $totalMaterialValue = $totalMaterialQty*$resultlistss['bomRate'];

?>

                           <tr>
                           <td><?php echo '#'. $rescountmaterialcc['styleRefId']; ?></td>
                           <td><?php echo $rescountmaterialcc2['name']; ?></td>
                           <td><?php echo $rescount['name']; ?></td>
                           <td><?php echo $totalMaterialQty; ?></td>
                           <td><?php echo round($totalMaterialValue,2); ?></td>
                           <td><?php echo $resultlistss['artworkno']; ?></td>
                           <td><?php echo $resultlistss['cadgivendate']; ?></td>
                           <td></td>
                           <td><?php echo $resultlistss['qualityapproveddate']; ?></td>

                           <td><?php echo $resultlistss['labdipdate']; ?></td>
                           <td><?php echo $resultlistss['labdiproundtwo']; ?></td>


                           </tr>
                           <?php } } ?>
                                           </tbody>
                    </table>