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

 if($_GET['styleId']!=''){
 $styleId = decode($_GET['styleId']);
 }

 if($_GET['brandId']!=''){
$brandId = decode($_GET['brandId']);
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
          <div class="col-xl-1" style="padding-right: 0px;"> </div>

                 <a href="download-samplingwip.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;">Download Excel</a>

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
$qqq3=GetPageRecord('*','brandMaster','1');
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

                         <label>
                        <select name="styleId" class="form-control" style="width:160px;">
                          <option value="">Select Dispatch Date</option>
                          <?php
$qqq=GetPageRecord('*','queryMaster','1');
while($quarData2=mysqli_fetch_array($qqq)){
?>
                          <option value="<?php echo encode($quarData2['id']); ?>" <?php if($quarData2['id'] == $styleId){ echo "selected"; } ?>><?php echo $quarData2['expectedDate']; ?></option>
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
            <?php

if($_GET['categoryId']!=''){
$categoryid='and categoryId="'.decode($_GET['categoryId']).'"';
}
if($_GET['shipDate']!=''){
$shipDate='and shipDate between '.$_GET['shipDate'].' and '.$_GET['shipDate1'].'';
}

if($_GET['buyerId']!=''){
$buyerid='and buyerId="'.decode($_GET['buyerId']).'"';
}
if($_GET['tatstatus']!=''){
$tatstatus='and styleTatStatus="'.$_GET['tatstatus'].'"';
}

if($_GET['main']!=''){
$stylestatus='and finalstatus="'.$_GET['main'].'" and styleTypeId in (1,3)';
}

$CountQuery=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 and sampleStyle="1" '.$categoryid.' '.$tatstatus.' '.$stylestatus.' order by id desc');
$totalQuery=mysql_num_rows($CountQuery);
$NewDate1=Date('Y-m-d', strtotime('-7 days'));
$newdate2=time();
$new=strtotime(Date('Y-m-d', strtotime('-7 days')));
$disdate='and dateAdded  between "'.$new.'" and "'.$newdate2.'"';

$CountQuery1=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 and sampleStyle="1" '.$disdate.'  '.$categoryid.' '.$tatstatus.' order by id desc');
$totalQuery1=mysql_num_rows($CountQuery1);


$CountQueryahead=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 and sampleStyle="1" and styleTatStatus="Ahead"  '.$categoryid.' '.$tatstatus.' order by id desc');
$totalQueryhead=mysql_num_rows($CountQueryahead);

$CountQuerydelayed=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 and sampleStyle="1" and styleTatStatus="Delayed" '.$categoryid.'  '.$tatstatus.' order by id desc');
$totalQuerydelayed=mysql_num_rows($CountQuerydelayed);

$CountQuerycompleted=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 and sampleStyle="1" and styleTatStatus="Completed" '.$categoryid.' '.$tatstatus.' order by id desc');
$totalQuerycompleted=mysql_num_rows($CountQuerycompleted);

$CountQueryontime=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 and sampleStyle="1" and styleTatStatus="Ontime" '.$categoryid.' '.$tatstatus.' order by id desc');
$totalQueryontime=mysql_num_rows($CountQueryontime);

$Countbuyer=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 and sampleStyle="1" '.$categoryid.' '.$tatstatus.' group by buyerId');
$totalbuyers=mysql_num_rows($Countbuyer);

$Countcategories=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 and sampleStyle="1" '.$categoryid.'  '.$tatstatus.' group by categoryId');
$totalcategories=mysql_num_rows($Countcategories);

$Counthighpriority=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 and sampleStyle="1" '.$categoryid.'  '.$tatstatus.' and queryPriority=3');
$highpriority=mysql_num_rows($Counthighpriority);

$CountpoAttachment=GetPageRecord('id','queryMaster','1 and subject!="" and deletestatus=0 and sampleStyle="1" '.$categoryid.' '.$shipDate.'  '.$buyerid.' '.$tatstatus.' and poAttachment!=""');
$poAttachmentcount=mysql_num_rows($CountpoAttachment);

?>

            <form name="listform" id="listform" method="get">
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
              <div id="pageload">
                <div id="" >
                  <div class="datatable-scroll">
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
