<?php
ob_start();
include "inc.php";
$assignto="Download";

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>
         <table class="table table-bordered table-hover no-footer table-responsive">
                      <thead style="background-color: #f5f5f5; text-align:center;">
                        <tr role="row">
                                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style</th>

              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Buyer</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Brand</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Inspection&nbsp;No</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Inspection&nbsp;Type</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Inspection&nbsp;Date</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" width="170px">Factory</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" width="170px">Line&nbsp;No</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" width="170px">Pieces&nbsp;Inspected</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" width="170px">Pieces&nbsp;Rejected</th></th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Total&nbsp;Majors</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Checked&nbsp;by</th>




                      </thead>
                       <tbody id="allhotellisting">

                             <?php
$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit=clean($_GET['records']);
$page=$_GET['page'];

$where='where 1 and styleId!=0 order by id desc';

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';


$rs=GetRecordListJs($select,'inspectioninput',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$queryDataq=GetPageRecord('*','queryMaster','1 and id="'.$resultlists['styleId'].'"');
$queryData=mysqli_fetch_array($queryDataq);


$queryDataqss=GetPageRecord('*','factoryMaster','1 and id="'.$resultlists['factoryId'].'"');
$queryDatass=mysqli_fetch_array($queryDataqss);


$queryDataqssa=GetPageRecord('*','factoryLineMaster','1 and id="'.$resultlists['lineId'].'"');
$queryDatassa=mysqli_fetch_array($queryDataqssa);

$instypeDataq=GetPageRecord('id,name','inspectiontypemaster','1 and id="'.$resultlists['inspectionType'].'" order by id');
$instypeData=mysqli_fetch_array($instypeDataq);

?>


                        <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>

                          <td><?php echo $queryData['subject']; ?></td>
                          <td><?php echo getBuyerName($queryData['buyerId']); ?></td>
                          <td><?php echo getBrandName($queryData['brandId']); ?></td>
                          <td><?php echo $resultlists['inspectionNo']; ?></td>
                          <td><?php echo $instypeData['name']; ?></td>
                          <td><?php echo $resultlists['dateField']; ?></td>
                          <td><?php echo $queryDatass['name']; ?></td>
                          <td> <span style="padding: 5px 10px; background-color: #0097a7; color: #fff; margin-right: 2px; font-size: 12px; margin-bottom:5px;display: inline-block;"><?php echo str_replace(' ','&nbsp;',$queryDatassa['lineName']);?></span></td>
                          <td><?php echo $resultlists['piecesinspected']; ?></td>
                          <td><?php echo $resultlists['piecesRejected']; ?></td>
                          <td><?php echo $resultlists['totalMajors']; ?></td>

                          <td>
                              <span style="padding: 5px 10px; background-color: #0097a7; color: #fff; margin-right: 2px; font-size: 12px; margin-bottom:5px;display: inline-block;"> <?php if($resultlists['checkedBy']=='1'){ echo 'Admin';   }else{} ?></span>


                              </td>




                                              </tr>

                                              <?php } ?>

                      </tbody>
                    </table>
                    <div class="pagingdiv" style="width: 97%;margin: 20px auto;">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                          <tr>
                            <td><table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td style="padding-right:20px;"><?php echo $no; ?> Entries</td>
                                  <td><select name="records" id="records" onchange="this.form.submit();" class="lightgrayfield" style="padding: 5px;border: 1px solid #ccc;">
                                      <option value="25" <?php if($_GET['records']=='25'){ ?> selected="selected"<?php } ?>>25 Records Per Page</option>
                                      <option value="50" <?php if($_GET['records']=='50'){ ?> selected="selected"<?php } ?>>50 Records Per Page</option>
                                      <option value="100" <?php if($_GET['records']=='100'){ ?> selected="selected"<?php } ?>>100 Records Per Page</option>
                                      <option value="200" <?php if($_GET['records']=='200'){ ?> selected="selected"<?php } ?>>200 Records Per Page</option>
                                      <option value="300" <?php if($_GET['records']=='300'){ ?> selected="selected"<?php } ?>>300 Records Per Page</option>
                                    </select></td>
                                </tr>
                              </table></td>
                            <td align="right"><div class="pagingnumbers"><?php echo $paging; ?></div></td>
                          </tr>
                        </tbody>
                      </table>