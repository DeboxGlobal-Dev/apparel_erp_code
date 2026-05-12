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
                          <th class="sorting" style="width: 225px;" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">GE&nbsp;-&nbsp;GRN&nbsp;Number</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >GRN/Rceived</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Stock&nbsp;Transfer</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Transfer&nbsp;Requisition&nbsp;Number</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Issued&nbsp;Till&nbsp;Date</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">In&nbsp;Hand</th>

                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Transact</th>



                      </thead>
                       <tbody id="allhotellisting">
                        <?php
$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
//$limit='20000';
$limit=clean($_GET['records']);


 if($_GET['styleId']!=''){
$styleid = 'and id="'.decode($_GET['styleId']).'"';
}
if($_GET['brandId']!=''){
$brandid = 'and brandId="'.decode($_GET['brandId']).'"';
}

$where='where subject!="" '.$styleid.' '.$brandid.' and deletestatus=0 and sampleStyle="2" order by id desc';


$page=$_GET['page'];

//$targetpage=$fullurl.'loadstyle.php?module='.$modfile['moduleName'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';


$rs=GetRecordListJs($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){


$color=GetPageRecord('*','styleSubCategoryMaster','1 and styleId="'.$resultlists['id'].'"');
while($colorlist=mysqli_fetch_array($color)){


$color1=GetPageRecord('*','materialTypeMaster','1 and id="'.$colorlist['materialType'].'"');
$colorlist1=mysqli_fetch_array($color1);




							$rs12=GetPageRecord('*','styleColorDetailMaster','styleId="'.$resultlists['id'].'"');
							$result1=mysqli_fetch_array($rs12);

							$orderQty='';
							$size='';
							$totalMaterialQty = '0';

							$orderQty+=$result1['qty'];

				// 		$rs1=GetPageRecord('*','styleSubCategoryMaster','styleId="'.$resultlists['id'].'" and costsheetVersionId="'.$resultlists['defaultcostsheetVersionId'].'" and materialType="'.$colorlist1['id'].'" and parentId=0 ');
				// 			$resListing1=mysqli_fetch_array($rs1);

							$rs121=GetPageRecord('*','techPackDetailMaster',' stylesubtabid="'.$colorlist['id'].'" and sectionType="bom" and styleId="'.$colorlist['styleId'].'" and costsheetVersionId="'.$resultlists['defaultcostsheetVersionId'].'" ');
							$resListing12=mysqli_fetch_array($rs121);

							$totalMaterialQty =  $orderQty*$resListing12['avgIncWastage'];
                              $totalMaterialValue = $totalMaterialQty*$resListing12['bomRate'];

?>
                        <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>

                          <td align="center"><?php echo '#'. $resultlists['styleRefId']; ?>
                            </td>
                          <td align="center"><?php echo $colorlist['name']; ?></td>
                          <td align="center">
                              <?php echo $colorlist1['name']; ?>
                          </td>
                          <td align="center"><?php echo $totalMaterialQty; ?></td>
                          <td  align="center"><?php echo round($totalMaterialValue,2); ?></td>


                          <td align="center">

                          </td>

                          <td align="center">

                          </td>



                          <td align="center"></td>

                          <td align="center"></td>
                          <td align="center"></td>
                                                   <td align="center"></td>
                          <td align="center"></td>




                                              </tr>
                        <?php } $no++; } ?>
                      </tbody>
                    </table>