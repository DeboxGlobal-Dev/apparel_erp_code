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
                 <a href="download-issuancestatus.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;">Download Excel</a>

          </div>
          <div class="card">

            <form name="listform" id="listform" method="get">
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
              <div id="pageload">
                <div id="" >
                  <div class="datatable-scroll">
                    <table class="table table-bordered table-hover no-footer table-responsive">
                      <thead style="background-color: #f5f5f5; text-align:center;">
                        <tr role="row">

                  <th><div align="center">Requisition&nbsp;No</div></th>
                  <th><div align="center">Style</div></th>
                  <th><div align="center">Requisition&nbsp;Type</div></th>
                  <th><div align="center">Material&nbsp;Name</div></th>
                  <th><div align="center">Requested&nbsp;Date</div></th>
                  <th><div align="center">Due&nbsp;Date</div></th>
                  <th><div align="center">Quantity&nbsp;Requested</div></th>
                  <th><div align="center">Quantity&nbsp;Issued</div></th>
                  <th><div align="center">Issued&nbsp;Date</div></th>
                                    <th><div align="center">Issuance&nbsp;No</div></th>

                  <th><div align="center">Department</div></th>
                                    <th><div align="center">Requested&nbsp;From</div></th>

                  <th><div align="center">Requested&nbsp;By</div></th>




                      </thead>
                       <tbody id="allhotellisting">



                                                   <?php
$no=0;
$select='*';
$where='';
$rs='';
$wheresearch='';
//$limit='20000';
$limit=clean($_GET['records']);


$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

$rs=GetRecordList($select,'requisitionmaster','where viewlist=1 and status="1" order by id desc',$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$rrrrw=GetPageRecord('*','queryMaster','id="'.$resultlists['styleId'].'"');
$styleDataw=mysqli_fetch_array($rrrrw);
$i=0;
$rrrrwss=GetPageRecord('*','userMaster','id="'.$resultlists['requested'].'"');
$styleDatawss=mysqli_fetch_array($rrrrwss);
$rrrrwssq=GetPageRecord('*','loadRequisitionMaster','parentId="'.$resultlists['id'].'"');
while($styleDatawssq=mysqli_fetch_array($rrrrwssq)){



    $rrrrwssw=GetPageRecord('*','styleSubCategoryMaster','id="'.$styleDatawssq['materialId'].'"');
$styleDatawssw=mysqli_fetch_array($rrrrwssw);


$rrrrwsswg=GetPageRecord('*','issuanceMaster','requisitionId="'.$resultlists['id'].'"');
$styleDatawsswg=mysqli_fetch_array($rrrrwsswg);
$a=$styleDatawsswg['issueqty'];
    $e = explode(",", $a);

    // foreach($e as $testdesc){

?>





                        <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>

                          <td><?php echo 'REQ-'.makeQueryId($resultlists['id']); ?></td>
                          <td><?php echo $styleDataw['styleRefId']; ?></td>
                          <td> <?php if($resultlists['requisitiontype'] == "1") { echo "Fabric"; } else if($resultlists['requisitiontype'] == "2") { echo "Trims"; } else if($resultlists['requisitiontype'] == "3") { echo "Packaging"; } else { echo ""; } ?>  </td>

                          <td><?php echo $styleDatawssw['name']; ?></td>


                          <td><?php echo date('d-m-Y',$resultlists['dateAdded']); ?></td>
                          <td><?php echo date('d-m-Y',strtotime($resultlists['duedate'])); ?></td>


                          <td><?php echo $styleDatawssq['quantity']; ?> </td>



                          <td><?php    echo $e[$i];    ?></td>

                          <td><?php echo date("d-m-Y",($styleDatawsswg['dateCreated']))?></td>
                          <td><?php echo 'ISS-'.date('d',$styleDatawsswg['dateCreated']).date('m',$styleDatawsswg['dateCreated']).date('y',$styleDatawsswg['dateCreated']).'-'.$styleDatawsswg['id'] ?></td>
                          <td><?php echo $resultlists['department']; ?></td>
                          <td>
<?php echo $resultlists['requestedfrom']; ?>

                              </td>



                 <td><?php echo $styleDatawss['firstName']; ?>&nbsp;<?php echo $styleDatawss['lastName']; ?></td>


                                              </tr>

                                              <?php $i++; }  }   ?>

                      </tbody>
                    </table>
                    <div class="pagingdiv" style="width: 97%;margin: 20px auto;">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                          <tr>
                            <td><table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td style="padding-right:20px;"><?php echo $no; ?> Entries</td>
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
