<?php
ob_start();
include "inc.php";
$assignto="Download";

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>
<?php
if($loginuserprofileId==1 || $loginuserprofileId==91){
$wheresearchassign=' 1 and ';
} else {
if($loginuserprofileId==92){
$wheresearchassign=' 1 and finalstatus="2" and sampleStyle="2" and (assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'" or ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))) and ';
} else{


if($loginuserprofileId==93){

$wheresearchassign='1';
$wheresearchassign=' '.$wheresearchassign.' and addedBy="'.$_SESSION['userid'].'" and sampleStyle="2" and ';
}

else{
$wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))';
$wheresearchassign=' '.$wheresearchassign.' and ';
}
}
}


if($_GET['styleId']!=''){
$styleId = decode($_GET['styleId']);
}
if($_GET['sampleId']!=''){
$sampleId = decode($_GET['sampleId']);
}
if($_GET['brandId']!=''){
$brandId = decode($_GET['brandId']);
}
if($_GET['requestdate']!=''){
$rdate = $_GET['requestdate'];
}
if($_GET['targetdate']!=''){
$tdate = $_GET['targetdate'];
}
?>


 <table class="table table-bordered table-hover no-footer table-responsive">
                      <thead style="background-color: #f5f5f5;">
                        <tr role="row">
                                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">SR No.</th>

              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Number</th>

			<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Master&nbsp;Style&nbsp;Number</th>

              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Quantity</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Average</th>

              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Value</th>

              <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Quantity%</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Value%</th>



                        </tr>
                      </thead>

                      <tbody>
                             <?php
$no=1;
$select='*';
$where='';
$rs='';
$limit=clean($_GET['records']);




$where='where subject!=""  '.$styleid.' '.$sampleid.' '.$brandid.' '.$rdate.' '.$tdate.' and deletestatus=0 and sampleStyle="1" order by id desc';


$page=$_GET['page'];


$targetpage=$fullurl.'loadstyle.php?module='.$modfile['moduleName'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';

$rs=GetRecordListJs($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$no=1;
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

  $rsample=GetPageRecord('*','sampleTypeMaster','1 and id="'.$resultlists['sampleType'].'"');
                $smapleList = mysqli_fetch_array($rsample);



$costsheetVersionId='0';
 $selectversion='*';
$whereversion='styleId="'.$resultlists['id'].'" and buyerCostStatus=0 order by id desc';
$rsversion=GetPageRecord($selectversion,'costsheetVersionMaster',$whereversion);
$resListingVer=mysqli_fetch_array($rsversion);
$costsheetVersionId = $resListingVer['versionId'];

$rs31=GetPageRecord('*','costsheetVersionMaster','styleId="'.$resultlists['id'].'" and versionId="'.$costsheetVersionId.'"');
$resListing31=mysqli_fetch_array($rs31);


$rrrr=GetPageRecord('*','poManageMaster','1  and styleId="'.$resultlists['id'].'"');
while($operationData=mysqli_fetch_array($rrrr)){
$pahadi='0';
$a= $operationData['poQty'];
$b=$resListing31['effectivesellingprice'];
$sum=$a*$b;

$pahadi+=$sum;




$avg=$sum/$a;

}
}
?>





                        <?php
$no=1;
$select='*';
$where='';
$rs='';
$limit=clean($_GET['records']);




$where='where subject!=""  '.$styleid.' '.$sampleid.' '.$brandid.' '.$rdate.' '.$tdate.' and deletestatus=0 and sampleStyle="1" order by id desc';


$page=$_GET['page'];


$targetpage=$fullurl.'loadstyle.php?module='.$modfile['moduleName'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';

$rs=GetRecordListJs($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

  $rsample=GetPageRecord('*','sampleTypeMaster','1 and id="'.$resultlists['sampleType'].'"');
                $smapleList = mysqli_fetch_array($rsample);



$costsheetVersionId='0';
 $selectversion='*';
$whereversion='styleId="'.$resultlists['id'].'" and buyerCostStatus=0 order by id desc';
$rsversion=GetPageRecord($selectversion,'costsheetVersionMaster',$whereversion);
$resListingVer=mysqli_fetch_array($rsversion);
$costsheetVersionId = $resListingVer['versionId'];

$rs31=GetPageRecord('*','costsheetVersionMaster','styleId="'.$resultlists['id'].'" and versionId="'.$costsheetVersionId.'"');
$resListing31=mysqli_fetch_array($rs31);


$rrrr=GetPageRecord('*','poManageMaster','1  and styleId="'.$resultlists['id'].'"');
while($operationData=mysqli_fetch_array($rrrr)){

$a= $operationData['poQty'];
$b=$resListing31['effectivesellingprice'];
$sum=$a*$b;

$avg=$sum/$a;



?>
            <tr role="row" class="odd">
                             <td><?php echo $no++ ?></td>

             <td><?php echo $resultlists['styleRefId']; ?></td>

              <td><?php echo $resultlists['masterStyleNo']; ?></td>

              <td align="left"><?php echo $operationData['poQty']; ?></td>





             <td align="left"><?php echo $avg; ?></td>

              <td align="left"><?php echo $sum; ?></td>
 <?php
              $total='0';
               $rrrrs=GetPageRecord('*','poManageMaster','1 and styleId="'.$resultlists['id'].'"');
			while($operationDatas=mysqli_fetch_array($rrrrs)){
			    $total+=$operationDatas['poQty'];

			}
			$po=$operationData['poQty'];
              $final=($po/$total)*100 ;
              ?>

              <td align="left"><?php echo  round($final,2) ?></td>


<?php
$grand=($sum/$pahadi)*100;

?>

              <td align="left"><?php echo round($grand,2) ?></td>




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