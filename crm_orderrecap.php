<?php
if($loginuserprofileId==1 || $loginuserprofileId==91){
$wheresearchassign=' 1 and ';
} else {
if($loginuserprofileId==92){
$wheresearchassign=' 1 and finalstatus="2" and sampleStyle="1" and (assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'" or ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))) and ';
} else{

if($loginuserprofileId==93){

$wheresearchassign='1';
$wheresearchassign=' '.$wheresearchassign.' and addedBy="'.$_SESSION['userid'].'" and sampleStyle="1" and ';
}

else{
$wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))';
$wheresearchassign=' '.$wheresearchassign.' and ';
}
}
}

  if($_GET['d']!=''){
 $namevalue1 = 'deletestatus=1';
 $whereval='id="'.decode($_GET['d']).'"';
 updatelisting('queryMaster',$namevalue1,$whereval);
}
?>

 <style>
.specialclass label {
    margin: 0px !important;
    margin-left: 5px !important;
}
</style>

<div class="page-content">
  <div class="content-wrapper">
    <?php include "savealert.php"; ?>
    <div class="content pt-0 filterable" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
            <div class="col-xl-9">
              <h5 class="card-title" ><?php echo $pageName; ?></h5>
            </div>
          <div class="col-xl-1" style="padding-right: 0px;"></div>

          <a href="download-orderrecap.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;">Download Excel</a>

          </div>

          <div class="card">

                <div id="DataTables_Table_2_filter" class="dataTables_filter" style="margin: 0px; margin-top: 15px;">
              <div class="row" id="searchfilters">
                <!-- <div class="col-md-2">
                  <label>
              <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" onkeyup="filtersearch();"/>
                  </label>
                </div> -->
                <div class="col-md-12" style="margin: 10px">
                  <form action="" method="get">
                      <label>
                        <select name="styleId" class="form-control" style="width:160px;">
                          <option value="">Buyer</option>
                          <?php
$qqq=GetPageRecord('*','seasonMaster','1');
while($quarData2=mysqli_fetch_array($qqq)){
?>
                          <option value="<?php echo encode($quarData2['id']); ?>" <?php if($quarData2['id'] == $styleId){ echo "selected"; } ?>><?php echo $quarData2['name']; ?></option>
                          <?php } ?>
                        </select>
                        </label>

                      <label>
                        <select name="styleId" class="form-control" style="width:160px;">
                          <option value="">Brand</option>
                          <?php
$qqq3=GetPageRecord('*','subCategoryMaster','1');
while($quarData3=mysqli_fetch_array($qqq3)){
?>
                          <option value="<?php echo encode($quarData3['id']); ?>" <?php if($quarData3['id'] == $styleId){ echo "selected"; } ?>><?php echo $quarData3['name']; ?></option>
                          <?php } ?>
                        </select>
                        </label>

                        <label>
                        <select name="styleId" class="form-control" style="width:160px;">
                          <option value="">Select Season</option>
                          <?php
$qqq=GetPageRecord('*','seasonMaster','1');
while($quarData2=mysqli_fetch_array($qqq)){
?>
                          <option value="<?php echo encode($quarData2['id']); ?>" <?php if($quarData2['id'] == $styleId){ echo "selected"; } ?>><?php echo $quarData2['name']; ?></option>
                          <?php } ?>
                        </select>
                        </label>




                     <label>&nbsp;&nbsp;
                    <input name="" type="submit" id="" class="" value="search" style="text-transform: uppercase; background-color: #03c28d; color: #fff; width: 200px; cursor:pointer;"/>
                    </label>
                    <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
                  </form>
                </div>
              </div>
            </div>

            <form name="listform" id="listform" method="get">
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
              <div id="pageload">
                <div id="" >
                  <div class="datatable-scroll">
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
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<style>
 .liststyleimg{float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}

	.badge.dropdown-toggle:after { display:none;
}
.pagingnumbers {
    border: 1px #EAEAEA solid;
    border-radius: 2px;
    overflow: hidden;
    float: right;
}
.pagingnumbers a {
    display: inline-block;
    padding: 8px 15px;
    min-width: 12px;
    text-align: center;
    color: #2c2c2c;
    text-decoration: none;
    border-right: #EAEAEA solid 1px;
    font-size: 12px;
    padding-top: 9px;
}
.pagingnumbers .disabled {
    display: inline-block;
    padding: 7px 8px;
    color: #CECECE;
}
.pagingnumbers .current {
    display: inline-block;
    padding: 8px 8px;
}
.pagingnumbers .current {
    background-color: #2ca1cc;
    color: #FFFFFF;
}
.dataTables_info,.dataTables_paginate,.dataTables_length {
	display:none !important;
 }

 </style>
<script>
function deletestyle(id){
var delStyle = confirm('Are you sure you want to delete this style?');
if(delStyle==true){
window.location.href = 'showpage.crm?module=style&d='+id; //delete style
}
}
</script>
<script>
$('#DataTables_Table_2').DataTable( {
"order": [[ 0, "desc" ]]
} );
</script>
<script>
$(document).ready(function(){
$("#filtersearch").on("keyup", function() {
var value = $(this).val().toLowerCase();
$("#allhotellisting tr").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
});
</script>



<style>
.color-box{
width:132px;
}
</style>
