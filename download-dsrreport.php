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
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Date</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Buyer&nbsp;Name</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Subgroup</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Number</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Description</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">PO&nbsp;Number</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" width="170px">PO&nbsp;Qty</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" width="170px">Ship&nbsp;Qty</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" width="170px">Short&nbsp;Qty</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" width="170px">Short&nbsp;%</th></th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Excess&nbsp;Qty</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Excess&nbsp;%</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Original&nbsp;Mode</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Actual&nbsp;Mode</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Brand&nbsp;SOT</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Original&nbsp;Ex-Factory</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Actual&nbsp;Ex-Factory</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Factory&nbsp;SOT</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Original&nbsp;Px</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Discount&nbsp;Px</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Discount&nbsp;%</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Discount&nbsp;Status</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">To&nbsp;Port</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Insp.&nbsp;OK</th>
              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Remarks</th>



                      </thead>
                       <tbody id="allhotellisting">





                           						<?php
$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit='20000';

$where='where status != "0" ';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,'packinglistMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

	$rss=GetPageRecord('*','queryMaster','1 and id="'.$resultlists['styleId'].'"');
           $result=mysqli_fetch_array($rss);

           $rsss=GetPageRecord('*','poManageMaster','1 and id="'.$resultlists['purchaseNo'].'"');
           $results=mysqli_fetch_array($rsss);

           $rsssp=GetPageRecord('*','innvoiceMaster','1 and packingId="'.$resultlists['id'].'"');
           $resultss=mysqli_fetch_array($rsssp);


$rsssd=GetPageRecord('SUM(totalqty) as totalq', 'loadpackinglistmaster','1 and parentId="'.$resultlists['id'].'"');
           $resultsd=mysqli_fetch_array($rsssd);

?>

                        <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>

                          <td><?php echo date('d-m-Y',$result['dateAdded']) ?></td>
                          <?php
                          $select2='*';
								$where2='id="'.$result['buyerId'].'"';
								$rs2=GetPageRecord($select2,_BUYER_MASTER_,$where2);
								$editresultstyle2=mysqli_fetch_array($rs2);
								?>
                          <td><?php
										echo $editresultstyle2['name']
										?>
										</td>



										<?php
                         $rsssps=GetPageRecord('*','brandMaster','1 and id="'.$result['brandId'].'"');
           $resultsss=mysqli_fetch_array($rsssps);
								?>
                          <td><?php
										echo $resultsss['name']
										?></td>
                          <td><?php
										echo '#'.$result['styleRefId'];
										?></td>
                          <td><?php
										echo $result['subject'];
										?></td>
                          <td><?php

								 echo $results['poNumber']

								 ?></td>
                          <td><?php

								 echo $results['poQty']

								 ?></td>
                          <td><?php echo $resultsd['totalq']   ?></td>



                          <?php

                          $a=$results['poQty'] ;
                          $b= $resultsd['totalq'] ;

                          ?>
                          <td><?php if($a<$b){ echo '0- Pcs'; }else{ echo ($a-$b).'-Pcs' ;} ?></td>
                          <?php
                          $diffr=$a-$b;
                           $diff=$b-$a;
                          ?>

                          <td> <?php  if ($a<$b){  echo 0/$a *100;  } else { echo  $diffr/$a*100; } ?></td>
                          <td>

                              <?php if($a<$b){ echo ($b-$a).'-Pcs';}else { echo '0 -Pcs' ;} ?>

                          </td>
                         <td><?php  if ($a<$b){ echo  round(($diff/$a)*100,2);   } else {   echo round(0/$a *100,2); } ?></td>
                         <td>  <?php echo $resultlists['orignalshipmode']; ?>     </td>
                         <td> <?php echo $resultlists['actualshipmode']; ?>  </td>
                          <?php
                         $ax=$resultlists['orignalshipmode'];
                         $bx= $resultlists['actualshipmode'];

                         ?>
                         <td><?php if($ax==$bx){ echo 'On Time'; } elseif($ax=='') { echo  ''; } elseif($bx==''){ echo '';} else{ echo 'Delayed';}?></td>
                         <td> <?php echo $resultlists['orignalexfactory']; ?>  </td>
                         <td> <?php echo $resultlists['actualexfactory']; ?>  </td>

                        <?php
                        $cc=$resultlists['orignalexfactory'];
                        $vv=$resultlists['actualexfactory'];
                        ?>

                         <td>
                            <?php if($ax!=$bx){ echo 'Delayed'; } elseif ($cc==$vv){ echo 'Ontime';}else{ echo 'Delayed'; }?>
                         </td>
                         <td></td>
                         <td></td>
                          <td></td>
                          <td></td>
                          <td>
                               <?php if($resultlists['toport']=='1'){ echo 'By Air'; }elseif($resultlists['toport']=='2'){ echo 'By Road'; } elseif($resultlists['toport']=='3'){ echo 'By Train';}else{}?>

                          </td>
                          <td></td>

<td></td>


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
                                  <td style="padding-right:20px;"><?php echo $no; ?> entries</td>
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