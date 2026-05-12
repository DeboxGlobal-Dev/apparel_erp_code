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
            <div class="col-xl-3" style="    padding-right: 0px;">
              <div class="btn-group justify-content-center" style="float:right;">
							 <a href="showpage.crm?module=masters"  class="btn bg-teal-400" aria-expanded="false" style="background-color: gray;"><i class="fa fa-arrow-left mr-2"></i>Back</a>

                <a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;"  ><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
              </div>
            </div>
          </div>
          <div class="card">
            <div id="DataTables_Table_2_filter" class="dataTables_filter">
              <div class="row specialclass">
                <form action="" method="get">
                  <div class="col-md-12" style="padding:0px;">
                    <label>
                    <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" style="margin-left: 0px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;"/>
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
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"><div align="center">SR</div></th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Mill&nbsp;Article&nbsp;No.</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Mfg Name</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Fabric Name</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">FDS Creation Date</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Country&nbsp;Of&nbsp;Origin</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Last&nbsp;Updated </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Action</th>
                      </tr>
                    </thead>
                    <tbody id="allhotellisting">
                      <?php
$no=0;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit=clean($_GET['records']);

$where='where 1 order by id desc';

$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';
$rs=GetRecordList($select,'fabricDetailSheetMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

?>
                      <tr role="row">
                        <td align="center"><?php echo ++$no; ?></td>
                        <td><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&id=<?php echo encode($resultlists['id']); ?>"><?php echo $resultlists['millArticleNo']; ?>
                          </a></td>
                        <td>
						<?php
						$a=GetPageRecord('*','suppliersMaster','id="'.$resultlists['mfgName'].'"');
						$currenname=mysqli_fetch_array($a);
						echo $currenname['name']; ?>
						</td>
                        <td><?php
						$a=GetPageRecord('*','materialMaster','id="'.$resultlists['fabricName'].'"');
						$currenname=mysqli_fetch_array($a);
						echo $currenname['name']; ?>
						 </td>
                        <td><?php echo date('d-m-Y',strtotime($resultlists['fdsCreationDate'])); ?></td>
                        <td><?php echo $resultlists['countryOfOrigin']; ?></td>
                        <td><?php echo date('d-m-Y h:i A',$resultlists['dateAdded']); ?></td>
                        <td><div class="btn-group">
<a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&id=<?php echo encode($resultlists['id']); ?>" class="btn btn-primary" style="padding:8px;"><i class="fa fa-pencil" aria-hidden="true" style=" color: #fffffff1;"></i></a>

</div><div class="btn-group" style="display:none;">
<a onclick="deleteFabricDetail();" class="btn btn-danger" style="padding:8px; cursor:pointer;margin:0px;"><i class="fa fa-trash" aria-hidden="true" style="color: #fffffff1; font-size: 12px !important;"></i></a>
</div>								</td>
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
