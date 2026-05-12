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
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Buyer</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Brand</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Season</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Sub&nbsp;-&nbsp;Category</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Style&nbsp;Name</th>
						  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Style&nbsp;Number</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Sample&nbsp;Type</th>

                          <th class="sorting" style="width: 225px;" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Requested&nbsp;Date</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Target&nbsp;Date</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Color</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Quantity</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Pattern&nbsp;Ready&nbsp;Date</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">In&nbsp;Cutting&nbsp;Date</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">In&nbsp;Cutting&nbsp;Dispatched</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">On&nbsp;-&nbsp;M/C&nbsp;Date</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">On&nbsp;-&nbsp;M/C&nbsp;Dispatched</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">M/C&nbsp;No</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">In&nbsp;Washing&nbsp;Date</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">In&nbsp;Washing&nbsp;Dispatched</th>



                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">In&nbsp;Finishing&nbsp;Date </th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">In&nbsp;Finishing&nbsp;Dispatched </th>

                                                     <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">QC&nbsp;Date</th>

                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">QC&nbsp;Dispatched </th>

                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Handover&nbsp;Date </th>



                        </tr>
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
$where='where '.$wheresearchassign.'  subject!=""  '.$stylestatus.' '.$assignTo .' '.$assignToMerchant.' '.$categoryId.' '.$tatstatusCondition.' and deletestatus=0 and sampleStyle="2" order by id desc';
}else{
$where='where '.$wheresearchassign.' subject!="" '.$stylestatus.' '.$assignTo .' '.$categoryId.' '.$tatstatusCondition.' and deletestatus=0 and sampleStyle="2" order by id desc';
}

$page=$_GET['page'];


$targetpage=$fullurl.'loadstyle.php?module='.$modfile['moduleName'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';

$rs=GetRecordListJs($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
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

$rsList1ccx=GetPageRecord('*','styleColorDetailMaster','styleId="'.$resultlists['id'].'"');
$smapleListccx=mysqli_fetch_array($rsList1ccx);


$rsList1ccxz=GetPageRecord('*','colorCardMaster','id="'.$smapleListccx['colorId'].'"');
$smapleListccxz=mysqli_fetch_array($rsList1ccxz);


$rsList1ccxz1=GetPageRecord('*','categoryMaster','id="'.$resultlists['categoryId'].'"');
$smapleListccxz1=mysqli_fetch_array($rsList1ccxz1);

?>

                        <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="" <?php } ?>>

                <td><div align="center"><?php echo getBrandName($resultlists['brandId']); ?></div></td>
                  <td><div align="center"><?php echo getBuyerName($resultlists['buyerId']); ?></div></td>
                  <td><div align="center"><?php echo $smapleListw['name'] ?></div></td>
                  <td><div align="center"> <?php echo $smapleListwe['name'] ?></div></td>
                  <td><div align="center"> <?php echo $resultlists['subject'] ?></div></td>
                  <td><div align="center"> <?php echo $resultlists['styleRefId'] ?></div></td>
                  <td><div align="center"> <?php echo $smapleListcc['name'] ?></div></td>

						  <td  style="text-align:center;width:100px;"><?php echo $resultlists['requestedDate']; ?></td>
                          <td><?php echo  date('d-m-Y',strtotime($resultlists['expectedDate'])); ?></td>

                          <td>
                          <?php echo $smapleListccxz['name'] ?>

                          </td>


                          <td style=""><?php echo $smapleListccx['qty'] ?></td>
<?php
$ex=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=61)');
$exf=mysqli_fetch_array($ex);
?>

                          <td><?php echo $exf['complitionDate']; ?></td>


                          <td><?php echo $resultlists['shipDate']; ?></td>
                          <td style=""></td>
                          <td style=""></td>

<?php
$exz=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=48)');
$exfz=mysqli_fetch_array($exz);
?>

                          <td><?php echo $exfz['complitionDate']; ?></td>
                          <td></td>
                          <td></td>
                          <td></td>
   <?php

		$costsheetVersionId='0';
		$selectversion='*';
		$whereversion='styleId="'.$resultlists['id'].'" and buyerCostStatus=0 order by id desc';
		$rsversion=GetPageRecord($selectversion,'costsheetVersionMaster',$whereversion);
		$resListingVer=mysqli_fetch_array($rsversion);
		$costsheetVersionId = $resListingVer['versionId'];

		$rs31=GetPageRecord('*','costsheetVersionMaster','styleId="'.$resultlists['id'].'" and versionId="'.$costsheetVersionId.'"');
$resListing31=mysqli_fetch_array($rs31);

		?>


                          <td><?php echo $resListing31['effectivesellingprice']; ?></td>

                          <?php

                          $a= $operationData['poQty'];
                          $b=$resListing31['effectivesellingprice'];
                          $sum=$a*$b;
                          ?>
                          <td><?php echo $sum; ?></td>


                          <td></td>
                          <td></td>
                          <td></td>
                                              </tr>
                        <?php } ?>
                      </tbody>
                    </table>