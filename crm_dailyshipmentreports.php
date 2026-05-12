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
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 50px;">Date</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Buyer&nbsp;Name</th>
                           <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Subgroup</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Number</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"> StyleDescription</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >PO&nbsp;No</th>
						  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Order&nbsp;Qty</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">ship&nbsp;Qty</th>
                          
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Short&nbsp;Qty</th>
                          <th class="sorting" style="width: 225px;" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Short&nbsp;%</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Excess&nbsp;Qty</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Excess&nbsp;%</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Orignal&nbsp;Mode</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Actual&nbsp;Mode </th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Brand&nbsp;SOT</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Orignal&nbsp;Ex&nbsp;-&nbsp;Factory</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Actual&nbsp;Ex&nbsp;-&nbsp;Factory</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Factory&nbsp;SOT</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Orignal&nbsp;Px</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Discount&nbsp;Px</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Discount&nbsp;%</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Discount&nbsp;Status</th>

                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">To&nbsp;Port</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Insp.Ok/Not</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1"  style="">Remark</th>

                          

                         
                        </tr>
                      </thead>
                       <tbody id="allhotellisting">

                        <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>
                           
                          <td align="center" style="display:none;"><?php echo $resultlists['displayId']; ?></td>
                          <td><?php echo getBuyerName($resultlists['buyerId']); ?></td>
                          <td><?php echo getBrandName($resultlists['brandId']); ?></td>
                          <td align="center"><?php echo $resultlists['styleRefId']; ?>
                            
                          </td>
                          <td></td>
                          <td style=""></td>




                          <td  style="text-align:center; width:130px;"><?php echo $resultdayses['name']; ?></td>

     
						  <td  style="text-align:center;width:100px;"><?php echo $operationData['poNumber']; ?></td>
                          <td><?php echo $operationData['poQty']; ?></td>

                          <td>
                          	<?php echo $exfastaData['complitionDate']; ?>

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
                          <td></td>
                                                    <td></td>

                          <td></td>

                          <td></td>

                                              </tr>
                        
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
