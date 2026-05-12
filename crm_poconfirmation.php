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
          <div class="col-xl-1" style="padding-right: 0px;"> </div>

                 <a href="download-orderrecap.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;">Download Excel</a>

          </div>
          <div class="card">

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
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 50px; display:none;">SR#</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Buyer</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Brand</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style#</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Season</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Order&nbsp;Quantity</th>

                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">PO&nbsp;Number</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >PO&nbsp;Quantity</th>
						  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Ex&nbsp;-&nbsp;Factory&nbsp;Start</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Revised&nbsp;Ex-&nbsp;Factory&nbsp;Start</th>

                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Ex&nbsp;-&nbsp;Factory&nbsp;End</th>
                          <th class="sorting" style="width: 225px;" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Revised&nbsp;Ex&nbsp;-&nbsp;Factory&nbsp;End</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Shipmode</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Revised&nbsp;-&nbsp;Shipmode</th>

                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Status</th>



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

$rsbrandcc=GetPageRecord('*','seasonMaster','id="'.$resultlists['seasonId'].'"');
$resultbrandlistcc=mysqli_fetch_array($rsbrandcc);



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
                          <td><?php echo $resultbrandlistcc['name']; ?></td>
                                                    <td><?php echo $resultlists['orderQty']; ?></td>

                          <td><?php echo $operationData['poNumber']; ?></td>
                          <td style=""><?php echo $operationData['poQty']; ?></td>

<?php

$rsbrandccv=GetPageRecord('*','buyerpoConfirmationMaster','poId="'.$operationData['id'].'" ');
$resultbrandlistccv=mysqli_fetch_array($rsbrandccv);


?>
                          <td  style="text-align:center; width:130px;">

                              <?php echo $operationData['factStart']; ?>

                              </td>


						  <td  style="text-align:center;width:100px;">
						       <?php
                              if($resultbrandlistccv['poId']==$operationData['id']){
                                  //echo $resultbrandlistccv['revisedexfactorystart'];  ?>



                                   <?php if($resultbrandlistccv['revisedexfactorystart']!='1970-01-01') { ?><?php } ?>
                    <input type="date" onchange="savemeasurmentdata<?php echo $operationData['id']; ?>();" name="revisedstart<?php echo $operationData['id']; ?>" id="revisedstart<?php echo $operationData['id']; ?>" value="<?php echo $resultbrandlistccv['revisedexfactorystart'];  ?>" <?php if($resultbrandlistccv['status']=='1') { ?> readonly style="border:none;"<?php } ?>>

<?php
                              }else{ ?>

						      <input type="date" onchange="savemeasurmentdata<?php echo $operationData['id']; ?>();" name="revisedstart<?php echo $operationData['id']; ?>" id="revisedstart<?php echo $operationData['id']; ?>" value="<?php echo $resultbrandlistccv['revisedexfactorystart'];  ?>" >

						      <?php } ?>
						      </td>




                          <td><?php echo $operationData['factEnd']; ?></td>

                          <td>
                          	 <?php
                              if($resultbrandlistccv['poId']==$operationData['id']){
                                  //echo $resultbrandlistccv['revisedexfactoryend']; ?>


                      <input type="date" onchange="savemeasurmentdata<?php echo $operationData['id']; ?>();" name="revisedend<?php echo $operationData['id']; ?>" id="revisedend<?php echo $operationData['id']; ?>" value="<?php echo  $resultbrandlistccv['revisedexfactoryend']; ?>" <?php if($resultbrandlistccv['status']=='1') { ?> readonly style="border:none;" <?php } ?>>

<?php
                              }else{ ?>
                      <input type="date" onchange="savemeasurmentdata<?php echo $operationData['id']; ?>();" name="revisedend<?php echo $operationData['id']; ?>" id="revisedend<?php echo $operationData['id']; ?>" >
                         						      <?php } ?>


                          </td>


                          <td><?php echo $operationData['shipMode']; ?></td>


                          <td>
                               <?php
                              if($resultbrandlistccv['poId']==$operationData['id']){
                                  //echo $resultbrandlistccv['revisedshipmode']; ?>


                                  <select <?php if($resultbrandlistccv['status']=='1') { ?> disabled style="border:none;color:black;" <?php } ?> onchange="savemeasurmentdata<?php echo $operationData['id']; ?>();" name="shipmode<?php echo $operationData['id']; ?>" id="shipmode<?php echo $operationData['id']; ?>" >

                              <option>Select</option>
                              <option <?php if($resultbrandlistccv['revisedshipmode']=='Sea'){ ?> selected <?php } ?> value="Sea">Sea</option>
                             <option <?php if($resultbrandlistccv['revisedshipmode']=='Air'){ ?> selected <?php } ?> value="Air">Air</option>

                              <option <?php if($resultbrandlistccv['revisedshipmode']=='NoChange'){ ?> selected <?php } ?> value="NoChange">No Change</option>

                          </select>
                          <?php


                              }else{ ?>
                              <select  onchange="savemeasurmentdata<?php echo $operationData['id']; ?>();" name="shipmode<?php echo $operationData['id']; ?>" id="shipmode<?php echo $operationData['id']; ?>" >

                              <option value="Select">Select</option>
                              <option value="Sea">Sea</option>
                             <option value="Air">Air</option>

                              <option value="NoChange">No Change</option>

                          </select>
                          <?php } ?>
                          </td>


<td>

     <?php
     $rsbrandccvf=GetPageRecord('*','buyerpoConfirmationMaster','poId="'.$operationData['id'].'" and status="1"');
$resultbrandlistccvf=mysqli_fetch_array($rsbrandccvf);
                              if($resultbrandlistccvf['poId']==$operationData['id']) { ?>
                                  <span class="badge" style="background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">Confirmed</span>

                                  <?php
                              }else{


                              ?>




    <input type="checkbox" onchange="validcheck<?php echo $operationData['id']; ?>();" name="status<?php echo $operationData['id']; ?>" id="status<?php echo $operationData['id']; ?>"  value="0">

<?php } ?>
</td>


                                              </tr>

                                              <script>
function savemeasurmentdata<?php echo $operationData['id']; ?>(){


var revisedstart = $('#revisedstart<?php echo $operationData['id']; ?>').val();
var revisedend = $('#revisedend<?php echo $operationData['id']; ?>').val();

var shipmode = $('#shipmode<?php echo $operationData['id']; ?>').val();

$('#savemeasurmentdata').load('apparelbomaction.php?action=savepoprohandovers&poid=<?php echo $operationData['id']; ?>&styleid=<?php echo $resultlists['id']; ?>&startdate='+revisedstart+'&enddate='+revisedend+'&revisedshipmode='+shipmode);



}

function validcheck<?php echo $operationData['id']; ?>(){


var revisedstart = $('#revisedstart<?php echo $operationData['id']; ?>').val();
var revisedend = $('#revisedend<?php echo $operationData['id']; ?>').val();

var shipmode = $('#shipmode<?php echo $operationData['id']; ?>').val();




 if($('#status<?php echo $operationData['id']; ?>').prop("checked") == true){


 var status = "1";
}
else{
    var status="0";
}

if(revisedstart != "" && revisedend != "" && shipmode != "Select"){

$('#savemeasurmentdata').load('apparelbomaction.php?action=savepoprohandovers&poid=<?php echo $operationData['id']; ?>&styleid=<?php echo $resultlists['id']; ?>&startdate='+revisedstart+'&enddate='+revisedend+'&revisedshipmode='+shipmode+'&revstatus='+status);

}
else{
    $('#status<?php echo $operationData['id']; ?>').prop('checked', false);
    alert('Please fill complete data');

}

}






</script>

<tr id="savemeasurmentdata" style="display:none;"></tr>




                        <?php } }?>
                      </tbody>
                    </table>
                    <div class="text-right" style="padding-top: 10px;margin-right:15px;">
	<button type="submit" style="margin:0px;" class="btn btn-primary" onClick="window.location.reload();">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>
</div>
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
