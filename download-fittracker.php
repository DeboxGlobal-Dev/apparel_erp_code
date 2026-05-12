<?php
ob_start();
include "inc.php";
$assignto="download";

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>

                    <table  border="1" cellspacing="0" style="font-size:12px;">
                      <thead>
                        <tr style="background-color: #4f55ff;color: #fff;" height="30">

                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Season</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Brand</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style#</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Color</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Quantity</th>
                          <th class="sorting" style="width: 225px;" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Order&nbsp;Confrmation&nbsp;Date</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Ex-&nbsp;Factory&nbsp;Start&nbsp;Date</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Ex-&nbsp;Factory&nbsp;End&nbsp;Date</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Planned&nbsp;PCD</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Requested&nbsp;PCD</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Drop&nbsp;Dead&nbsp;Date</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">TNA&nbsp;Date&nbsp;for&nbsp;1st&nbsp;Fit&nbsp;Submission</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Actual&nbsp;1st&nbsp;Fit&nbsp;Submission</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Planned&nbsp;Comment&nbsp;Received&nbsp;Date</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Comment&nbsp;Received&nbsp;Date</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Approved&nbsp;/Rejected</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Reason&nbsp;for&nbsp;Rejection</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">2nd&nbsp;Fit&nbsp;Submission&nbsp;Planned&nbsp;Date</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">2nd&nbsp;Fit&nbsp;Submission&nbsp;Actual&nbsp;Date</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">2Nd&nbsp;Fit&nbsp;Comments&nbsp;Planned</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Comments&nbsp;Received&nbsp;Date</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Approved/&nbsp;Rejected</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Reason&nbsp;For&nbsp;Rejection</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">3Rd&nbsp;Fit&nbsp;Submission&nbsp;Planned</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">3Rd&nbsp;Fit&nbsp;Submission&nbsp;Actual</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Plan&nbsp;Comment&nbsp;Date</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Comments&nbsp;Received&nbsp;Date</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Approved/&nbsp;Rejected</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Reason&nbsp;For&nbsp;Rejection</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">YTS&nbsp;Submission</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Actual&nbsp;PP&nbsp;Submission</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Planned&nbsp;PP&nbsp;Submission</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Actual&nbsp;PP/GT&nbsp;Approval</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Remarks&nbsp;by&nbsp;Merchant</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Remarks&nbsp;by&nbsp;Tech&nbsp;Team</th>
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

$where='where subject!="" '.$styleid.' '.$brandid.' and deletestatus=0 and sampleStyle="1" order by id desc';


$page=$_GET['page'];

//$targetpage=$fullurl.'loadstyle.php?module='.$modfile['moduleName'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';


$rs=GetRecordListJs($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){


$color=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$resultlists['id'].'"');
while($colorlist=mysqli_fetch_array($color)){


$color1=GetPageRecord('*','colorCardMaster','1 and id="'.$colorlist['colorId'].'"');
$colorlist1=mysqli_fetch_array($color1);

$selectdays='*';
$wheredayses='id="'.$resultlists['gender'].'" ';
$rsdayses=GetPageRecord($selectdays,'genderMaster',$wheredayses);
$resultdayses=mysqli_fetch_array($rsdayses);

$rsbrand=GetPageRecord('*','brandMaster','id="'.$resultlists['brandId'].'"');
$resultbrandlist=mysqli_fetch_array($rsbrand);

$rsbrand1=GetPageRecord('*','seasonMaster','id="'.$resultlists['seasonId'].'"');
$seasonlist=mysqli_fetch_array($rsbrand1);


?>
                        <tr role="row" height="30">

                          <td align="center"><?php echo $seasonlist['name']; ?></td>
                          <td align="center"><?php echo getBrandName($resultlists['brandId']); ?></td>
                          <td align="center"><?php echo $resultlists['styleRefId']; ?>

                          </td>
                          <td align="center"><?php echo $colorlist1['name'] ?></td>
                          <td  align="center"><?php echo $colorlist['qty'];  ?></td>

                         <?php
  $confirm=GetPageRecord('*','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=3)');
                              $confirmdate=mysqli_fetch_array($confirm);
?>
                          <td align="center">
                            <?php if(mysql_num_rows($confirm) > '0') { echo date('d-m-Y',strtotime($confirmdate['complitionDate'])); } ?>

                          </td>
<?php
  $exfastaDataq=GetPageRecord('*','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=47)');
                              $exfastaData=mysqli_fetch_array($exfastaDataq);
?>
                          <td align="center">
                            <?php if(mysql_num_rows($exfastaDataq) > '0') { echo date('d-m-Y',strtotime($exfastaData['complitionDate'])); } ?>

                          </td>

<?php
$ex=GetPageRecord('*','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=49)');
$exf=mysqli_fetch_array($ex);
?>

                          <td align="center"><?php if(mysql_num_rows($ex) > '0') { echo date('d-m-Y',strtotime($exf['complitionDate'])); } ?></td>

                          <td align="center"><?php if($resultlists['pcdDate']!="1970-01-01" && $resultlists['pcdDate']!="0000-00-00" && $resultlists['pcdDate']!="" ) {echo date('d-m-Y',strtotime($resultlists['pcdDate'])); } ?></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <?php
  $ex1=GetPageRecord('*','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=9)');
                              $ex11=mysqli_fetch_array($ex1);
?>
                          <td align="center">
                            <?php if(mysql_num_rows($ex1) > '0') { echo date('d-m-Y',strtotime($ex11['complitionDate'])); } ?>

                          </td>
                          <?php
  $ex2=GetPageRecord('*','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=9)');
                              $ex21=mysqli_fetch_array($ex2);
?>
                          <td align="center">
                            <?php if(mysql_num_rows($ex2) > '0') { echo date('d-m-Y',strtotime($ex21['actualDate'])); } ?>

                          </td>
                          <?php
  $ex3=GetPageRecord('*','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=10)');
                              $ex31=mysqli_fetch_array($ex3);
?>
                          <td align="center">
                            <?php if(mysql_num_rows($ex3) > '0') { echo date('d-m-Y',strtotime($ex31['complitionDate'])); } ?>

                          </td>
                          <?php
  $ex4=GetPageRecord('*','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=10)');
                              $ex41=mysqli_fetch_array($ex4);
?>
                          <td align="center">
                            <?php if(mysql_num_rows($ex4) > '0') { echo date('d-m-Y',strtotime($ex41['actualDate'])); } ?>

                          </td>

                          <td></td>
                          <td></td>
                          <?php
  $ex5=GetPageRecord('*','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=11)');
                              $ex51=mysqli_fetch_array($ex5);
?>
                          <td align="center">
                            <?php if(mysql_num_rows($ex5) > '0') { echo date('d-m-Y',strtotime($ex51['complitionDate'])); } ?>

                          </td>
                          <?php
  $ex6=GetPageRecord('*','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=11)');
                              $ex61=mysqli_fetch_array($ex6);
?>
                          <td align="center">
                            <?php if(mysql_num_rows($ex6) > '0') { echo date('d-m-Y',strtotime($ex61['actualDate'])); } ?>

                          </td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <?php
  $ex7=GetPageRecord('*','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=20)');
                              $ex71=mysqli_fetch_array($ex7);
?>
                          <td align="center">
                            <?php if(mysql_num_rows($ex7) > '0') { echo date('d-m-Y',strtotime($ex71['actualDate'])); } ?>

                          </td>

                          <?php
  $ex8=GetPageRecord('*','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=21)');
                              $ex81=mysqli_fetch_array($ex8);
?>
                          <td align="center">
                            <?php if(mysql_num_rows($ex8) > '0') { echo date('d-m-Y',strtotime($ex81['complitionDate'])); } ?>

                          </td>
                          <?php
  $ex9=GetPageRecord('*','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=21)');
                              $ex91=mysqli_fetch_array($ex9);
?>
                          <td align="center">
                            <?php if(mysql_num_rows($ex9) > '0') { echo date('d-m-Y',strtotime($ex91['actualDate'])); } ?>

                          </td>

                          <td></td>
                          <td></td>




                                              </tr>
                        <?php } $no++; } ?>
                      </tbody>
                    </table>