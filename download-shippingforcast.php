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
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Buyer</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Brand</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style#</th>
						  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Name</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Season</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Order&nbsp;Quantity</th>
						  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">PO&nbsp;Number</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">PO&nbsp;Quantity</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Ex&nbsp;Factory&nbsp;Start</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Ex&nbsp;Factory&nbsp;End</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  >Cut&nbsp;off&nbsp;Date</th>
                         </tr>
                      </thead>
                       <tbody id="allhotellisting">
                   <?php
					$no=0;
$select='*';
$where='';
$rs='';
$wheresearch='';
//$limit='20000';
$limit=clean($_GET['records']);



if($_GET['fromDate']!=''){
$fromDate=date('Y-m-d',strtotime($_GET['fromDate']));
$fromDate = " and factStart='".$fromDate."'";
}

if($_GET['toDate']!=''){
$toDate=date('Y-m-d',strtotime($_GET['toDate']));

$toDate = " and factEnd='".$toDate."'";
}

$where='where 1 '.$fromDate.' '.$toDate.' order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

$rs=GetRecordList($select,'poManageMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultas=mysqli_fetch_array($rs[0])){

$whereas='id="'.$resultas['styleId'].'"';
$rsstatusas=GetPageRecord('*',_QUERY_MASTER_,$whereas);
$resultlists=mysqli_fetch_array($rsstatusas);

$rsstatusa=GetPageRecord('name','seasonMaster','id="'.$resultlists['seasonId'].'"');
$resulta=mysqli_fetch_array($rsstatusa);
?>

                      <tr>

                     <td><?php echo getBuyerName($resultlists['buyerId']); ?></td>
                          <td><?php echo getBrandName($resultlists['brandId']); ?></td>
                          <td><?php echo $resultlists['styleRefId']; ?></td>
						  <td><?php echo $resultlists['subject']; ?></td>
                          <td><?php echo $resulta['name'];?></td>
							<?php
							$rsqty=GetPageRecord('qtyTotal','buyerPurchaseOrderMaster','styleId="'.$resultlists['id'].'"');
							$resultqty=mysqli_fetch_array($rsqty);
							?>
						  <td><?php echo $resultqty['qtyTotal']; ?></td>
                          <td><?php echo $resultas['poNumber']; ?></td>
						  <td><?php echo $resultas['poQty']; ?></td>
						  <td><?php echo date('d-M-Y',strtotime($resultas['factStart'])); ?></td>
                          <td><?php echo date('d-M-Y',strtotime($resultas['factEnd'])); ?></td>
						  <td><?php if($resultas['cutoffDate']!=""){ echo date('d-M-Y',strtotime($resultas['cutoffDate'])); }else{ echo '-'; } ?></td>
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