<?php
if($loginuserprofileId==1){

$wheresearchassign=' 1 and ';

} else {

// if($loginuserprofileId==92){

// $wheresearchassign=' 1 and finalstatus="2" and assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where (reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'") and ';
// } else{

// $wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))';
// $wheresearchassign=' '.$wheresearchassign.' and ';
// }

$wheresearchassign='  brandId in (SELECT brandId FROM `resourceAllocationBrandWise` WHERE profileId="'.$loginuserprofileId.'" and FIND_IN_SET("'.$_SESSION['userid'].'",assignTo)) and ';

}

if($loginuserprofileId==93){
$wheresearchassign='1 and finalstatus=2 and addedBy="'.$_SESSION['userid'].'" and ';
}

?>

<div class="page-content">
  <style>
.even{
background-color: #0097a71a;
}
</style>
  <!-- Main sidebar -->
  <div class="content-wrapper">
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
            <div class="col-xl-9">
              <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>
            <div class="col-xl-3" style="    padding-right: 0px;"></div>
          </div>
          <div class="card">
            <div id="DataTables_Table_2_filter" class="dataTables_filter">
              <div class="row specialclass">
                <form action="" method="get">
                  <div class="col-md-12" style="padding:0px;">
                    <label>
                    <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" style="margin-left: 0px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;"/>
                    </label>
                    <label>
                    <select name="stylerefid" id="stylerefid" class="select2" style="margin-left: 10px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;">
                      <option value="">Select Style</option>
                      <?php
				$fcref=GetPageRecord('*','queryMaster',''.$wheresearchassign.' deleteStatus=0 and subject!="" order by id desc');
				while($refData=mysqli_fetch_array($fcref)){ ?>
                      <option value="<?php echo encode($refData['id']); ?>" <?php if(decode($_GET['stylerefid'])==$refData['id']){ ?> selected="selected" <?php } ?>><?php echo $refData['styleRefId']; ?></option>
                      <?php } ?>
                    </select>
                    </label>
                    <label>
                    <input name="" type="submit" id="" class="" value="search" style="text-transform: uppercase; background-color: #03c28d; color: #fff; width: 200px; cursor:pointer; margin:0px !important;;"/>
                    </label>
                    <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
                  </div>
                </form>
              </div>
            </div>
            <form name="listform" id="listform" method="get">
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
              <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                <div class="datatable-scroll">
                 <table class="table table-bordered table-hover no-footer">
                    <thead style="background-color: #f5f5f5;">
                      <tr role="row">
                        <th>Style#</th>
                        <th>Style&nbsp;Name</th>
                        <th>Category</th>
                        <th>Assign&nbsp;To</th>
                        <th>Status</th>
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

if($_GET['stylerefid']!=''){
$stylerefCondition = 'and id="'.decode($_GET['stylerefid']).'"';
}

$where='where '.$wheresearchassign.' subject!="" '.$stylerefCondition.' and sampleStyle="1" and deletestatus=0 order by id desc';

$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

$rs=GetRecordList($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$selectstatus='*';
$wherestatus='styleId="'.$resultlists['id'].'" and statusId!=0 order by id desc';
$rsstatus=GetPageRecord($selectstatus,'styleAssignmentMaster',$wherestatus);
$result=mysqli_fetch_array($rsstatus);


$select1='*';
$where1='id="'.$result['statusId'].'" order by id desc';
$rs1=GetPageRecord($select1,'statusMaster',$where1);
$result1=mysqli_fetch_array($rs1);
?>

                      <tr role="row" class="odd">
                        <td><a href="showpage.crm?module=prototypesample&add=yes&styleid=<?php echo encode($resultlists['id']); ?>"><?php echo '#'.$resultlists['styleRefId']; ?>



                          </a></td>
                        <td><?php echo $resultlists['subject']; ?></td>
                        <td><?php echo getCategoryName($resultlists['categoryId']).' - '.getSubCategoryName($resultlists['subCategoryId']); ?></td>
                        <td><?php if($loginuserprofileId==90){ echo getUserName($resultlists['assignToVendor']); }else{ echo getUserName($resultlists['assignTo']); }?></td>
                        <td><span class="badge badge-flat" style="border:1.5px solid <?php echo $result1['statusColor']; ?>; background-color:#fff; color:black; position: relative; width: 142px; font-size: 11px; padding: 6px;"> <?php echo $result1['name']; ?></span> </td>
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
    <!-- /dashboard content -->
  </div>
  <!-- /content area -->
  <!-- Footer -->
  <!-- /footer -->
</div>
<!-- /main content -->
</div>
<style>
.dataTables_info,.dataTables_paginate,.dataTables_length {
	display:none !important;
 }
 .specialclass label{
margin:0px !important;
margin-left:5px !important;
}
.select2-container {
    width: 190px !important;
}
.select2-search--dropdown .select2-search__field {
    width: 160px !important;
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
