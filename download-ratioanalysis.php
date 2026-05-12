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
                            <th><div align="center">Buyer</div></th>
                            <th><div align="center">Brand</div></th>

                            <th><div align="center">Style</div></th>

                            <th><div align="center">Sub&nbsp;Category</div></th>

                                                        <th><div align="center">Gender</div></th>

                            <th><div align="center">Value&nbsp;Addition</div></th>


                            <th><div align="center">Quantity</div></th>

                         </tr>
                      </thead>
                       <tbody id="allhotellisting">


                      <tr>


                                                <?php
$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
//$limit='20000';
$limit=clean($_GET['records']);
if($_GET['stylestatus']!=''){
$stylestatus = 'and finalstatus="'.$_GET['stylestatus'].'"';
}

if($_GET['stylestatus']=='0'){
$stylestatus = 'and stylestatus="'.$_GET['stylestatus'].'"';
}

$assignTo='';
if($_GET['assignTo']!=''){
$assignTo = 'and assignTo="'.decode($_GET['assignTo']).'"';
}

$categoryId='';
if($_GET['categoryId']!=''){
$categoryId = 'and categoryId="'.decode($_GET['categoryId']).'"';
}

if($_GET['assignToMerchant']!=''){
$assignToMerchant = 'and assignTo in (select id from userMaster where empId in (select id from employeeMaster where reportingTo in (select empId from userMaster where id="'.decode($_GET['assignToMerchant']).'")))';
}

if($_GET['a']=='1' && $loginuserprofileId==92){
$wheresearchassign = '';
}

if($_GET['tatstatus']!=''){
$tatstatusCondition = 'and styleTatStatus="'.$_GET['tatstatus'].'"';
}

if($loginuserprofileId==92){
$where='where '.$wheresearchassign.'  subject!=""   and deletestatus=0 and sampleStyle="1" order by id desc';
}else{
$where='where '.$wheresearchassign.' subject!=""  and deletestatus=0 and sampleStyle="1" order by id desc';
}

$page=$_GET['page'];


$targetpage=$fullurl.'loadstyle.php?module='.$modfile['moduleName'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';

$rs=GetRecordListJs($select,_QUERY_MASTER_,$where,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$selectimg='*';
$whereimg='parentId="'.$resultlists['id'].'" and galleryType="image_gallery" order by id asc';
$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
$imgresult=mysqli_fetch_array($rsimg);
$selectdays='*';
$wheredays='styleId="'.$resultlists['id'].'" and statusId=2';
$rsdays=GetPageRecord($selectdays,'styleAssignmentMaster',$wheredays);
$resultdays=mysqli_fetch_array($rsdays);

$rsList=GetPageRecord('name','productionStageMaster','id="'.$productionStage.'"');
$productionName=mysqli_fetch_array($rsList);

$rsList1=GetPageRecord('name','sampleTypeMaster','id="'.$resultlists['sampleType'].'"');
$smapleList=mysqli_fetch_array($rsList1);


$rsList1w=GetPageRecord('*','seasonMaster','id="'.$resultlists['seasonId'].'"');
$smapleListw=mysqli_fetch_array($rsList1w);


$rsList1we=GetPageRecord('*','subCategoryMaster','id="'.$resultlists['subCategoryId'].'"');
$smapleListwe=mysqli_fetch_array($rsList1we);

$rsList1cc=GetPageRecord('name','sampleTypeMaster','id="'.$resultlists['sampleType'].'"');
$smapleListcc=mysqli_fetch_array($rsList1cc);
$counst=0;
$rsList1ccx=GetPageRecord('*','styleColorDetailMaster','styleId="'.$resultlists['id'].'"');
$smapleListccx=mysqli_fetch_array($rsList1ccx);

$rsList1ccxss=GetPageRecord('*','embroideryTypeMaster','id="'.$smapleListccx['valueEdition'].'"');
$smapleListccxss=mysqli_fetch_array($rsList1ccxss);




$rsList1ccxz=GetPageRecord('*','colorCardMaster','id="'.$smapleListccx['colorId'].'"');
$smapleListccxz=mysqli_fetch_array($rsList1ccxz);


$rsList1ccxz1=GetPageRecord('*','categoryMaster','id="'.$resultlists['categoryId'].'"');
$smapleListccxz1=mysqli_fetch_array($rsList1ccxz1);



$selectdays='*';
$wheredayses='id="'.$resultlists['gender'].'" ';
$rsdayses=GetPageRecord($selectdays,'genderMaster',$wheredayses);
$resultdayses=mysqli_fetch_array($rsdayses);



?>


                    <tr role="row" class="odd">

                  <td><div align="center"><?php echo getBuyerName($resultlists['buyerId']); ?></div></td>
                  <td><div align="center"><?php echo getBrandName($resultlists['brandId']); ?></div></td>
                                    <td><div align="center"> <?php echo $resultlists['styleRefId'] ?></div></td>

                  <td><div align="center"> <?php echo $smapleListwe['name'] ?></div></td>

                                   <td><div align="center"><?php echo $resultdayses['name']; ?></div></td>





                  <td><div align="center"><?php if ( $smapleListccxss['name']=="None"){ echo "no"; } else { echo "yes"; } ?>  </div></td>



                  <td><div align="center">
                      <?php echo $smapleListccx['qty'] ?>
                      </div></td>

						</tr>


						<?php


						} ?>

                    </tbody>
                  </table>
