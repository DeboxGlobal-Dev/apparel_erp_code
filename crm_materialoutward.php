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
            <div class="col-xl-1" style="padding-right: 0px;"> </div>

            <a href="download-materialoutward.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="    background-color: #03d873b8;"> Download Excel</a>

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
                   <!-- <input type="text" class="datepick" placeholder="GRN Date" name="fromDate" id="fromDate" value="<?php if($_GET['fromDate']!=''){ echo date('d-m-Y',strtotime($_GET['fromDate'])); } ?>" style="margin-left: 0px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;" readonly />
                    </label>
					<label>
                    <input type="text" class="datepick" placeholder="GE Date" name="toDate" id="toDate" value="<?php if($_GET['toDate']!=''){ echo date('d-m-Y',strtotime($_GET['toDate'])); } ?>" style="margin-left: 0px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;" readonly="readonly" />-->
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
                 <table class="table table-bordered capacity-class" style="width:100%;">
         			   <thead>
                        <tr style="background-color: #e9fff8;">
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Brand</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">PO Number</th>
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Indent Number</th>

							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" >Style# </th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Item</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Item Qty.</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Supplier </th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Challan No </th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Challan Type </th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Sent For </th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Price</th>
                         </tr>
                      </thead>
                       <tbody id="allhotellisting">
                <?php
$no=0;
$select='*';
$where='';
$rs='';
$wheresearch='';
// $limit='20000';
$limit=clean($_GET['records']);



$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';
 $where='';
$rs=GetRecordList($select,'externalChallan',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

if($resultlists['indentnum']!=''){
$rsssezh=GetPageRecord('*','queryMaster','1 and id="'.$resultlists['stylenum'].'"');
$resListingssezh=mysqli_fetch_array($rsssezh);



?>

                      <tr>

                    <tr role="row" class="odd">
							<td><?php echo getBrandName($resListingssezh['brandId']); ?></td>
							<td><?php echo $resultlists['ponumber']; ?></td>
							<td><?php echo $resultlists['indentnum']; ?></td>
							<td>
							     <?php



								    echo '#'. $resListingssezh['styleRefId']; ?>

							</td>
						 	<td></td>
							<td></td>
							<td>
							       <?php

$rsssez=GetPageRecord('*','suppliersMaster','1 and id="'.$resultlists['supplier'].'"');
$resListingssez=mysqli_fetch_array($rsssez);

								    echo $resListingssez['name']; ?>
							</td>




                                <td>

                                <?php

                                if($resultlists['challantype']=='Returnable'){

                                echo 'ER-R-0000'.$resultlists['id'];
                                }
                                elseif($resultlists['challantype']=='Non-Returnable'){
                                echo 'ER-NR-0000'.$resultlists['id'];  }
                                else{
                                echo 'ER-0000'.$resultlists['id'];

                                }

                                ?>							</td>
							<td><?php echo $resultlists['challantype']; ?></td>
							<td><?php echo $resultlists['process']; ?></td>
							<td></td>
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
