<?php
if($loginuserprofileId==1 || $loginuserprofileId==93){

$wheresearchassign=' 1 and ';

} else {

if($loginuserprofileId==92){

$wheresearchassign=' 1 and finalstatus="2" and assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'" and ';
} else{

$wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))';

$wheresearchassign=' '.$wheresearchassign.' and ';

}

}

?>

   <div class="page-content">
   <div class="content-wrapper">
    <?php include "savealert.php"; ?>
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700 filterable" style="padding: 10px;">
            <div class="col-xl-9">
              <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>
            <div class="col-xl-1" style="padding-right: 0px;"></div>

             <a href="download-sampledeveloped.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;">Download Excel</a>

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
                        <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" class="form-control">
                        </label>


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
                          <option value="">Select Style Number</option>
                          <?php
$qqq=GetPageRecord('*','queryMaster','1');
while($quarData2=mysqli_fetch_array($qqq)){
?>
                          <option value="<?php echo encode($quarData2['id']); ?>" <?php if($quarData2['id'] == $styleId){ echo "selected"; } ?>><?php echo $quarData2['styleRefId']; ?></option>
                          <?php } ?>
                        </select>
                        </label>


                        <label>
                        <select name="styleId" class="form-control" style="width:160px;">
                          <option value="">Select Sample Stage</option>
                          <?php
$qqq=GetPageRecord('*','productionStageMaster','1');
while($quarData2=mysqli_fetch_array($qqq)){
?>
                          <option value="<?php echo encode($quarData2['id']); ?>" <?php if($quarData2['id'] == $styleId){ echo "selected"; } ?>><?php echo $quarData2['name']; ?></option>
                          <?php } ?>
                        </select>
                        </label>


                        <label>
                        <select name="styleId" class="form-control" style="width:160px;">
                          <option value="">Select Sample Type</option>
                          <?php
$qqq=GetPageRecord('*','sampleTypeMaster','1');
while($quarData2=mysqli_fetch_array($qqq)){
?>
                          <option value="<?php echo encode($quarData2['id']); ?>" <?php if($quarData2['id'] == $styleId){ echo "selected"; } ?>><?php echo $quarData2['name']; ?></option>
                          <?php } ?>
                        </select>
                        </label>

                           <label>
                         <select name="styleId" class="form-control" style="width:160px;">
                          <option value="">Select Requested Date</option>
                          <?php
$qqq=GetPageRecord('*','queryMaster','1');
while($quarData2=mysqli_fetch_array($qqq)){
?>
                          <option value="<?php echo encode($quarData2['id']); ?>" <?php if($quarData2['id'] == $styleId){ echo "selected"; } ?>><?php echo $quarData2['requestedDate']; ?></option>
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
               <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
               <div class="datatable-scroll">
                         <table class="table table-bordered capacity-class" style="width:100%;">
         			     <thead>
                         <tr style="background-color: #e9fff8;">
							 <th><div align="center">Buyer</div></th>
                  <th><div align="center">Brand</div></th>
                  <th><div align="center">Season</div></th>
                  <th><div align="center">Sub&nbsp;Category</div></th>
                  <th><div align="center">Style&nbsp;Name</div></th>
                  <th><div align="center">Style&nbsp;Number</div></th>
            <th><div align="center">Sample&nbsp;For</div></th>
            <th><div align="center">Sample&nbsp;Stage</div></th>

                      <th><div align="center">Sample&nbsp;Type</div></th>
                     <th><div align="center">Color</div></th>
                     <th><div align="center">Quantity</div></th>
                     <th><div align="center">Requested&nbsp;Date</div></th>
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


                    <tr role="row" class="odd">

                  <td><div align="center"><?php echo getBrandName($resultlists['brandId']); ?></div></td>
                  <td><div align="center"><?php echo getBuyerName($resultlists['buyerId']); ?></div></td>
                  <td><div align="center"><?php echo $smapleListw['name'] ?></div></td>
                  <td><div align="center"> <?php echo $smapleListwe['name'] ?></div></td>
                  <td><div align="center"> <?php echo $resultlists['subject'] ?></div></td>
                  <td><div align="center"> <?php echo $resultlists['styleRefId'] ?></div></td>
                  <td><div align="center"><?php if($resultlists['sampleFor']==100){ echo 'Self'; }else{ echo 'Buyer Inspiration'; }?></div></td>
                  <?php

                  	$rsList=GetPageRecord('id,name','productionStageMaster','1 and deletestatus=0 and id="'.$resultlists['productionStage'].'"');

								$productionName=mysqli_fetch_array($rsList);

                  ?>
                  <td ><div align="center"> <?php echo $productionName['name'] ?></div></td>
                  <td><div align="center"> <?php echo $smapleListcc['name'] ?></div></td>
                  <td><div align="center"><?php echo $smapleListccxz['name'] ?></div></td>
                  <td><div align="center"><?php echo $smapleListccx['qty'] ?></div></td>
                  <td><div align="center"><?php echo $resultlists['requestedDate']; ?></div></td>
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
.dataTables_info,.dataTables_paginate,.dataTables_length {
	display:none !important;
 }
</style>
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
