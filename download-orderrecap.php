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
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 50px; display:none;">SR#</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Buyer</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Season</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style#</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Development&nbsp;Style</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Repeat&nbsp;Order</th>


                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Description</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Category</th>
						  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Gender</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">PO&nbsp;Number</th>

                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Qty/Pcs</th>
                          <th class="sorting" style="width: 225px;" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Fabric&nbsp;-&nbsp;in&nbsp;House</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">PP&nbsp;Sample&nbsp;Approval</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Ex&nbsp;-&nbsp;Factory&nbsp;Date</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Ship&nbsp;Cancel&nbsp;Date</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Destination</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Factory</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Mode</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">FOB Price</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Value</th>


                          <?php if($loginuserprofileId==92){ ?>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Closure&nbsp;Date </th>
                          <?php } ?>
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

// if($_GET['main']!=''){
// $stylestatus = 'and finalstatus="'.$_GET['main'].'" and styleTypeId in (1,3)';
// }




if($loginuserprofileId==92){
$where='where '.$wheresearchassign.'  subject!="" '.$riskPriority.' '.$confirmStyle.'  '.$stylestatus.' '.$assignTo .' '.$assignToMerchant.' '.$categoryId.' '.$shipDate.'   '.$buyerId.' '.$tatstatusCondition.' '.$stylerefCondition.' and deletestatus=0 and sampleStyle="1" order by id desc';
}else{
$where='where '.$wheresearchassign.' subject!="" '.$riskPriority.' '.$confirmStyle.' '.$stylestatus.' '.$assignTo .' '.$categoryId.' '.$shipDate.'   '.$buyerid.' '.$tatstatusCondition.' '.$stylerefCondition.' and deletestatus=0 and sampleStyle="1" order by id desc';
}

$page=$_GET['page'];

//$targetpage=$fullurl.'loadstyle.php?module='.$modfile['moduleName'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';


$rs=GetRecordListJs($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$exfastaDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=22)');
$exfastaData=mysqli_fetch_array($exfastaDataq);



$selectimg='*';
$whereimg='parentId="'.$resultlists['id'].'" and galleryType="image_gallery" order by id asc';
$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
$imgresult=mysqli_fetch_array($rsimg);
$selectdays='*';
$wheredays='styleId="'.$resultlists['id'].'" and statusId=2';
$rsdays=GetPageRecord($selectdays,'styleAssignmentMaster',$wheredays);
$resultdays=mysqli_fetch_array($rsdays);



$selectdays='*';
$wheredayse='id="'.$resultlists['merchant'].'" ';
$rsdayse=GetPageRecord($selectdays,'userMaster',$wheredayse);
$resultdayse=mysqli_fetch_array($rsdayse);


$selectdays='*';
$wheredayses='id="'.$resultlists['gender'].'" ';
$rsdayses=GetPageRecord($selectdays,'genderMaster',$wheredayses);
$resultdayses=mysqli_fetch_array($rsdayses);

$rsbrand=GetPageRecord('*','brandMaster','id="'.$resultlists['brandId'].'"');
$resultbrandlist=mysqli_fetch_array($rsbrand);


?>

<?php
      $rrrr=GetPageRecord('*','poManageMaster','1  and styleId="'.$resultlists['id'].'"');
				while($operationData=mysqli_fetch_array($rrrr)){


				?>

                        <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>

                          <td align="center" style="display:none;"><?php echo $resultlists['displayId']; ?></td>
                          <td><?php echo getBuyerName($resultlists['buyerId']); ?></td>
                          <td><?php echo getBrandName($resultlists['brandId']); ?></td>
                          <td align="center"><?php echo $resultlists['styleRefId']; ?>

                          </td>
                          <td><?php echo $resultlists['masterStyleNo']; ?></td>
                                                    <td><?php if ($resultlists['repeatOrder']=="1") { echo "Yes";} else {  echo "No"; } ?></td>

                          <td><?php echo $resultlists['subject']; ?></td>
                          <td style=""><?php echo getCategoryName($resultlists['categoryId']).' - '.getSubCategoryName($resultlists['subCategoryId']); ?></td>




                          <td  style="text-align:center; width:130px;"><?php echo $resultdayses['name']; ?></td>


						  <td  style="text-align:center;width:100px;"><?php echo $operationData['poNumber']; ?></td>
                          <td><?php echo $operationData['poQty']; ?></td>

                          <td>
                          	<?php echo $exfastaData['complitionDate']; ?>

                          </td>
<?php
$ex=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$resultlists['id'].'" and temid="'.$resultlists['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=61)');
$exf=mysqli_fetch_array($ex);
?>

                          <td><?php echo $exf['complitionDate']; ?></td>


                          <td><?php echo $resultlists['shipDate']; ?></td>


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
                                              </tr>
                        <?php } }?>
                      </tbody>
                    </table>
                    <div class="pagingdiv" style="width: 97%;margin: 20px auto;">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                          <tr>
                            <td><table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td style="padding-right:20px;"><?php echo $totalentry; ?> entries</td>
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