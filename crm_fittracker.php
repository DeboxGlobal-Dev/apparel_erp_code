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
                 <a href="download-fittracker.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;">Download Excel</a>

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
                        <select name="styleId" class="form-control">
                          <option value="">Select Style</option>
                          <?php
$qqq=GetPageRecord('*','queryMaster','1 and subject!="" and sampleStyle=1 and deletestatus=0 order by id desc');
while($quarData2=mysqli_fetch_array($qqq)){
?>
                          <option value="<?php echo encode($quarData2['id']); ?>" <?php if($quarData2['id'] == $styleId){ echo "selected"; } ?>><?php echo $quarData2['styleRefId']; ?></option>
                          <?php } ?>
                        </select>
                        </label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>
                        <select name="brandId" class="form-control">
                          <option value="">Select Brand</option>
                          <?php
$qqqr=GetPageRecord('*','brandMaster','1');
while($quarData1=mysqli_fetch_array($qqqr)){
?>
                          <option value="<?php echo encode($quarData1['id']); ?>" <?php if($quarData1['id'] == $brandId){ echo "selected"; } ?>><?php echo $quarData1['name']; ?></option>
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
                        <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>

                          <td align="center" style="display:none;"><?php echo $resultlists['displayId']; ?></td>
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
                    <div class="pagingdiv" style="width: 97%;margin: 20px auto;">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                          <tr>
                            <td><table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td style="padding-right:20px;"><?php echo $no; ?> entries</td>
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
