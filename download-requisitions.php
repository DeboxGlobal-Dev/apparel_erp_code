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

         <th><div align="center">Requisition&nbsp;No</div></th>
                  <th><div align="center">Style</div></th>
                  <th><div align="center">Requisition&nbsp;Type</div></th>
                  <th><div align="center">Material&nbsp;Name</div></th>
                  <th><div align="center">Requested&nbsp;Date</div></th>
                  <th><div align="center">Due&nbsp;Date</div></th>
                  <th><div align="center">Quantity&nbsp;Requested</div></th>
                  <th><div align="center">Quantity&nbsp;Issued</div></th>
                  <th><div align="center">Issued&nbsp;Date</div></th>
                  <th><div align="center">Department</div></th>
                                    <th><div align="center">Requested&nbsp;From</div></th>

                  <th><div align="center">Requested&nbsp;By</div></th>




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


$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

$rs=GetRecordList($select,'requisitionmaster','where viewlist=1 and department="production" || department="sewing" order by id desc',$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$rrrrw=GetPageRecord('*','queryMaster','id="'.$resultlists['styleId'].'"');
$styleDataw=mysqli_fetch_array($rrrrw);
$i=0;
$rrrrwss=GetPageRecord('*','userMaster','id="'.$resultlists['requested'].'"');
$styleDatawss=mysqli_fetch_array($rrrrwss);
$rrrrwssq=GetPageRecord('*','loadRequisitionMaster','parentId="'.$resultlists['id'].'"');
while($styleDatawssq=mysqli_fetch_array($rrrrwssq)){



    $rrrrwssw=GetPageRecord('*','styleSubCategoryMaster','id="'.$styleDatawssq['materialId'].'"');
$styleDatawssw=mysqli_fetch_array($rrrrwssw);


$rrrrwsswg=GetPageRecord('*','issuanceMaster','requisitionId="'.$resultlists['id'].'"');
$styleDatawsswg=mysqli_fetch_array($rrrrwsswg);
$a=$styleDatawsswg['issueqty'];
    $e = explode(",", $a);

    // foreach($e as $testdesc){

?>





                        <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>

                          <td><?php echo 'REQ-'.makeQueryId($resultlists['id']); ?></td>
                          <td><?php echo $styleDataw['styleRefId']; ?></td>
                          <td> <?php if($resultlists['requisitiontype'] == "1") { echo "Fabric"; } else if($resultlists['requisitiontype'] == "2") { echo "Trims"; } else if($resultlists['requisitiontype'] == "3") { echo "Packaging"; } else { echo ""; } ?>  </td>

                          <td><?php echo $styleDatawssw['name']; ?></td>


                          <td><?php echo date('d-m-Y',$resultlists['dateAdded']); ?></td>
                          <td><?php echo date('d-m-Y',strtotime($resultlists['duedate'])); ?></td>


                          <td><?php echo $styleDatawssq['quantity']; ?> </td>



                          <td><?php    echo $e[$i];    ?></td>


                          <td><?php echo date("d-m-Y",($styleDatawsswg['dateCreated']))?></td>

                          <td><?php echo $resultlists['department']; ?></td>

                          <td>
<?php echo $resultlists['requestedfrom']; ?>

                              </td>



                 <td><?php echo $styleDatawss['firstName']; ?>&nbsp;<?php echo $styleDatawss['lastName']; ?></td>


                                              </tr>

                                              <?php $i++; }  }   ?>

                      </tbody>
                    </table>
