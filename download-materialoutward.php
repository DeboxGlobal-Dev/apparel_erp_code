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
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Brand</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">PO Number</th>
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Indent Number</th>

							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Style# </th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Item</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Item Qty.</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Supplier </th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Challan No </th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Challan Type </th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Sent For </th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Price</th>
                         </tr>
                      </thead>
                       <tbody id="allhotellisting">
                <?php
$no=0;
$select='*';
$where='';
$rs='';
$wheresearch='';
// $limit='20000';
$limit=clean($_GET['records']);



$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';
 $where='';
$rs=GetRecordList($select,'externalChallan',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){
if($resultlists['indentnum']!=''){
$rsssezh=GetPageRecord('*','queryMaster','1 and id="'.$resultlists['stylenum'].'"');
$resListingssezh=mysqli_fetch_array($rsssezh);



?>

                      <tr>

                    <tr role="row" class="odd">
							<td><?php echo getBrandName($resListingssezh['brandId']); ?></td>
							<td><?php echo $resultlists['ponumber']; ?></td>
							<td><?php echo $resultlists['indentnum']; ?></td>
							<td>
							     <?php



								    echo '#'. $resListingssezh['styleRefId']; ?>

							</td>
						 	<td></td>
							<td></td>
							<td>
							       <?php

$rsssez=GetPageRecord('*','suppliersMaster','1 and id="'.$resultlists['supplier'].'"');
$resListingssez=mysqli_fetch_array($rsssez);

								    echo $resListingssez['name']; ?>
							</td>




                                <td>

                                <?php

                                if($resultlists['challantype']=='Returnable'){

                                echo 'ER-R-0000'.$resultlists['id'];
                                }
                                elseif($resultlists['challantype']=='Non-Returnable'){
                                echo 'ER-NR-0000'.$resultlists['id'];  }
                                else{
                                echo 'ER-0000'.$resultlists['id'];

                                }

                                ?>							</td>
							<td><?php echo $resultlists['challantype']; ?></td>
							<td><?php echo $resultlists['process']; ?></td>
							<td></td>
						</tr>
                         <?php } } ?>
                    </tbody>
                  </table>
                  <div class="pagingdiv" style="width: 97%;margin: 20px auto;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tbody>
                        <tr>
                          <td><table border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <td style="padding-right:20px;"><?php echo $totalentry; ?> entries</td>
                                <td><select name="records" id="records" onchange="this.form.submit();" class="lightgrayfield" style="padding: 5px;border: 1px solid #ccc; outline:none;">
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