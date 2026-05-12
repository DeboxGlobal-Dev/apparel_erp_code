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
                  <th width="100px;"><div align="center">Style&nbsp;No</div></th>
                  <th><div align="center">Buyer</div></th>
                  <th><div align="center">Season</div></th>
                  <th><div align="center">Category</div></th>
                  <th><div align="center">Sub-&nbsp;Category</div></th>
                  <th><div align="center">Gender</div></th>
                  <th><div align="center">Activity&nbsp;Name</div></th>
                  <th><div align="center">Planned&nbsp;Date</div></th>
                  <th><div align="center">Actual&nbsp;Date</div></th>
                  <th><div align="center">Difference</div></th>
                  <th width="100px;"><div align="center">Status</div></th>
                </tr>
              </thead>
<?php
$select='*';
 if($styleId!=''){
      $stylestatus = 'and styleId="'.$styleId.'"';
              }
$where='where taskListId !="" '.$stylestatus.'';
$limit=clean($_GET['records']);
$page=$_GET['page'];
$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

$rs=GetRecordList($select,'timeActionReport',$where,'20',$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($quarData1=mysqli_fetch_array($rs[0])){

$qqp=GetPageRecord('*','taskListMaster','1 and id="'.$quarData1['taskListId'].'"');
          $quarDatap=mysqli_fetch_array($qqp);


            $qq=GetPageRecord('*','tnaActivityMaster','1 and id="'.$quarDatap['name'].'"');
            $quarData=mysqli_fetch_array($qq);
            if(in_array($quarData['id'],$quarterIdvalue) || $quarterIdvalue==""){




            $bd=GetPageRecord('*','queryMaster','1 and id="'.$quarData1['styleId'].'" and subject!="" and sampleStyle=1 and deletestatus=0');
            $countstyle=mysql_num_rows($bd);
            $brandData=mysqli_fetch_array($bd);

            $nuCount=GetPageRecord('*','buyerMaster','1 and id="'.$brandData['buyerId'].'"');
            $countFactory=mysqli_fetch_array($nuCount);

            $nuCount1=GetPageRecord('*','seasonMaster','1 and id="'.$brandData['seasonId'].'"');
            $countFactory1=mysqli_fetch_array($nuCount1);

            $nuCount2=GetPageRecord('*','categoryMaster','1 and id="'.$brandData['categoryId'].'"');
            $countFactory2=mysqli_fetch_array($nuCount2);

            $nuCount3=GetPageRecord('*','genderMaster','1 and id="'.$brandData['gender'].'"');
            $countFactory3=mysqli_fetch_array($nuCount3);

            $nuCount4=GetPageRecord('*','subCategoryMaster','1 and id="'.$brandData['subCategoryId'].'"');
            $countFactory4=mysqli_fetch_array($nuCount4);


            $nuCount5=GetPageRecord('*','taskListMaster','1 and name="'.$quarData['id'].'" and tnatemplate="'.$brandData['tnaTemplateId'].'"');
            $countFactory5=mysqli_fetch_array($nuCount5);

            $nuCount6=GetPageRecord('*','timeActionReport','1 and taskListId="'.$countFactory5['id'].'"');
            $countFactory6=mysqli_fetch_array($nuCount6);

            ?>
            <tbody id="allhotellisting">
                <tr height="30">


                  <td><div align="center"><?php echo '#'.$brandData['styleRefId']; ?></div></td>
                  <td><div align="center"><?php echo $countFactory['name']; ?></div></td>
                  <td><div align="center"><?php echo $countFactory1['name']; ?></div></td>
                  <td><div align="center" ><?php echo $countFactory2['name']; ?></div></td>
                  <td><div align="center" ><?php echo $countFactory4['name']; ?></div></td>
                  <td><div align="center" ><?php echo $countFactory3['name']; ?></div></td>
                  <td><div align="center"><?php echo $quarData['name']; ?></div></td>
                  <td><div align="center"><?php if($quarData1['complitionDate']!='' && $quarData1['complitionDate']!='1970-01-01' && $quarData1['complitionDate']!='0000-00-00'){ echo date('d-m-Y', strtotime($quarData1['complitionDate'])); } else { echo "-";} ?></div></td>
                  <td><div align="center"><?php if($quarData1['actualDate']!='' && $quarData1['actualDate']!='1970-01-01' && $quarData1['actualDate']!='0000-00-00'){ echo date('d-m-Y', strtotime($quarData1['actualDate'])); } else { echo "-";} ?></div></td>
                  <td><div align="center" >
                       <?php
                       if($quarData1['complitionDate']!='' && $quarData1['complitionDate']!='1970-01-01' && $quarData1['complitionDate']!='0000-00-00' && $quarData1['actualDate']!='' && $quarData1['actualDate']!='1970-01-01' && $quarData1['actualDate']!='0000-00-00'){
                   $plandate=date('d-m-Y', strtotime($quarData1['complitionDate']));
                   $start_date = strtotime($plandate);
                    $currentdate= date('d-m-Y', strtotime($quarData1['actualDate']));
                     $end_date = strtotime($currentdate);
                     $difference =  ($start_date - $end_date)/60/60/24;
                     echo $difference;
                  } else { echo "-"; }
                    ?>

                  </div></td>
                  <td><div align="center" >
                    <?php
                    if($quarData1['complitionDate']=='' || $quarData1['complitionDate']=='1970-01-01' || $quarData1['complitionDate']=='0000-00-00' || $quarData1['actualDate']=='' || $quarData1['actualDate']=='1970-01-01' || $quarData1['actualDate']=='0000-00-00'){
                      ?><span style="color: red;"><?php echo "Pending"; ?></span><?php  } else if($difference > "0"){ ?><span style="color: green;">Early</span><?php } else if($difference < "0"){?><span style="color: orange;">Delayed</span><?php } else { ?><span style="color: #0288d1;">On Time</span><?php } ?>
                  </div></td>

                </tr>
                </tbody>

                <?php }
              }
               ?>
              </table>
