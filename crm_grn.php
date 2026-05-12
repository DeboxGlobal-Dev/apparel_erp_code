<div class="page-content">
  <div class="content-wrapper">
    <?php include "savealert.php"; ?>
    <div class="content pt-0 filterable" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
            <div class="col-xl-12">
              <h5 class="card-title" ><?php echo $pageName; ?></h5>
            </div>

          </div>

          <div class="card">
            <div class="row" style="margin-top:20px;">
              <div class="col-md-12" style=" padding:0px 25px;">
                <!--<form action="" method="get">-->
                <!--  <div class="row">-->
                <!--    <div class="col-md-2">-->
                <!--      <div class="form-group">-->
                <!--        <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" class="form-control"/>-->
                <!--      </div>-->
                <!--    </div>-->
                <!--    <div class="col-md-2">-->
                <!--      <div class="form-group">-->
                <!--        <input name="" type="submit" id="" class=" btn btn-primary" value="Search" />-->
                <!--        <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />-->
                <!--      </div>-->
                <!--    </div>-->
                <!--  </div>-->
                <!--</form>-->
              </div>
            </div>
			<div id="collapsible-control-right-group1" class="collapse" style="display:block;">
            <div class="card-body">
              <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                <li class="nav-item"><a href="#highlighted-justified-tab1" class="nav-link active show" data-toggle="tab"><strong>Fabric/Trim/Packaging</strong></a></li>
                <li class="nav-item"><a href="#highlighted-justified-tab2" class="nav-link" data-toggle="tab"><strong>Maintenance & G.I</strong></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade active show" id="highlighted-justified-tab1">

<div class="page-content">
<style>
.even{
background-color: #0097a71a;
}
.iconlistset {
width: 34px;
background-color: #000099;
padding: 5px 5px;
overflow: hidden;
float: left;
border-radius: 50px;
height: 34px;
margin: 0px 3px;
cursor: pointer;
}
.iconlistset img {
width: 16px;
margin-top: 6px;
mage-rendering: auto;
image-rendering: crisp-edges;
image-rendering: pixelated;
}
</style>
  <!-- Main sidebar -->
  <?php include "left.php"; ?>
  <div class="content-wrapper">
    <!---Save Alert Notification---->
    <?php include "savealert.php"; ?>
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <!--<div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">-->
          <!--  <div class="col-xl-9">-->
          <!--    <h5 class="card-title"><?php echo $pageName; ?></h5>-->
          <!--  </div>-->
          <!--  <div class="col-xl-3" style="    padding-right: 0px;">-->
          <!--    <div class="btn-group justify-content-center" style="float:right;"> </div>-->
          <!--  </div>-->
          <!--</div>-->
          <!--<div class="card">-->


<!--<div id="DataTables_Table_2_filter" class="dataTables_filter">-->
<!--              <div class="row specialclass">-->
<!--                <form action="" method="get">-->
<!--                  <div class="col-md-12" style="padding:0px;">-->
<!--                    <label>-->
<!--                    <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" style="margin-left: 0px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;"/>-->
<!--                    </label>-->
<!--                    <label>-->
<!--                    <label>-->
<!--                    <input name="" type="submit" id="" class="" value="search" style="text-transform: uppercase; background-color: #03c28d; color: #fff; width: 200px; cursor:pointer; margin:0px !important;;"/>-->
<!--                    </label>-->
<!--                    <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />-->
<!--                  </div>-->
<!--                </form>-->
<!--              </div>-->
<!--            </div>-->


            <form name="listform" id="listform" method="get">
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
              <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                <div class="datatable-scroll">
                  <table class="table table-bordered table-hover no-footer">
                    <thead style="background-color: #f5f5f5;">
                      <tr role="row">
                        <th style="width: 15%">Gate Entry Number</th>
						 <th style="width: 15%">PO</th>
                        <th style="width: 15%">Supplier</th>
                        <th style="width: 15%">Entry Date</th>
						<th style="width: 15%">GRN&nbsp;No.</th>
						<th style="width: 15%">GRN&nbsp;Date.</th>
						<th style="width: 15%; text-align:center;">GRN&nbsp;Status</th>
						<th style="width: 25%">Action</th>
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


if($_GET['stylerefid']!=''){
$stylerefCondition = 'and id="'.decode($_GET['stylerefid']).'"';
}
if($_REQUEST['module'] == 'cdn'){
$where='where cdntype=1 order by id desc';
}else{
  $where='';
}

$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

$rs=GetRecordList($select,'gateentrymaster','where status="2" order by entrydate desc',$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$rs1=GetPageRecord($select,'suppliersMaster','1  and id="'.$resultlists['supplier'].'"');
$resListing1=mysqli_fetch_array($rs1);

$rsgrn=GetPageRecord('*','grnMaster','gateEntryNo="'.$resultlists['id'].'" and parentId=0');
$resListingGrn=mysqli_fetch_array($rsgrn);


$gateEntryNo = 'GE-'.date('dmy',strtotime($resultlists['entrydate'])).'-'.$resultlists['id'];
?>

                        <tr>

                       <td><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&gateentryid=<?php echo encode($resultlists['id']); ?>&id=<?php echo encode($resListingGrn['id']); ?>"><?php echo  $gateEntryNo; ?></a></td>
                       <td><?php echo $resultlists['ponumber']; ?></td>
                       <td><?php echo $resListing1['name']; ?></td>
                        <td><?php echo date('d-m-Y',strtotime($resultlists['entrydate'])); ?></td>
						<td><?php if($resListingGrn['grnNo']!=''){ echo $resListingGrn['grnNo']; }else{ echo '-'; } ?></td>
						<td><?php if($resListingGrn['grnNo']!=''){ echo date('d-m-Y',strtotime($resListingGrn['docDate'])); }else{ echo '-'; } ?></td>
						<td align="center">
						<?php if($resultlists['grnStatus']!=0){ ?>
						<span class="badge" style="cursor:pointer;background-color:#05a90a; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">Completed</span>
						<?php }else{ ?>
						<span class="badge" style="cursor:pointer;background-color:#e6530d; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">Pending</span>
						<?php } ?>
						</td>
						  <td><a href="tcpdf/examples/generategrnpdf.php?pageurl=<?php echo $fullurl; ?>download-grnpdf.php?gateentryid=<?php echo encode($resultlists['id']); ?>&id=<?php echo encode($resListingGrn['id']); ?>" target="_blank" style="background: #e71c22; outline: none; color: #fff; padding: 5px; border-radius: 2px; cursor: pointer; width: 95px; display: block; float:right; margin-left:5px; text-align:center;"><i class="fa fa-download" aria-hidden="true"></i> PDF</a>	</td>
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
          <!--</div>-->
        </div>
      </div>
    </div>
    <!-- /dashboard content -->
  </div>
  <!-- /content area -->
  <!-- Footer -->
  <!-- /footer -->
</div>
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
				<div class="tab-pane fade" id="highlighted-justified-tab2">
                   <form name="listform" id="listform" method="get">
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
              <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                <div class="datatable-scroll">
                  <table class="table table-bordered table-hover no-footer">
                    <thead style="background-color: #f5f5f5;">
                      <tr role="row">
                        <th style="width: 15%">Gate Entry Number</th>
						 <th style="width: 15%">PO</th>
                        <th style="width: 15%">Supplier</th>
                        <th style="width: 15%">Entry Date</th>
						<th style="width: 15%">GRN&nbsp;No.</th>
						<th style="width: 15%">GRN&nbsp;Date.</th>
						<th style="width: 15%; text-align:center;">GRN&nbsp;Status</th>
						<th style="width: 15%">Action</th>
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


if($_GET['stylerefid']!=''){
$stylerefCondition = 'and id="'.decode($_GET['stylerefid']).'"';
}
if($_REQUEST['module'] == 'cdn'){
$where='where cdntype=1 order by id desc';
}else{
  $where='';
}

$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

$rs=GetRecordList($select,'maintenancegateentrymaster','where status="2"',$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$rs1=GetPageRecord($select,'suppliersMaster','1  and id="'.$resultlists['supplier'].'"');
$resListing1=mysqli_fetch_array($rs1);

$rsgrn=GetPageRecord('*','maintenancegrnMaster','gateEntryNo="'.$resultlists['id'].'" and parentId=0');
$resListingGrn=mysqli_fetch_array($rsgrn);


$gateEntryNo = 'GE-'.date('dmy',strtotime($resultlists['entrydate'])).'-'.$resultlists['id'];
?>

                      <tr>

                      <td><a href="showpage.crm?module=maintenancegrn&add=yes&gateentryid=<?php echo encode($resultlists['id']); ?>&id=<?php // echo encode($resListingGrn['id']); ?>"><?php echo  $gateEntryNo; ?></a></td>
                       <td>
                           <?php
                         	$rsLi=GetPageRecord('*','requisitionIndentMaster','id="'.$resultlists['ponumber'].'"');
				$queryLi=mysqli_fetch_array($rsLi);

				      $rssrt=GetPageRecord('*','loadmaintenance','1 and id="'.$queryLi['mainid'].'"');
		   $rrrrt=mysqli_fetch_array($rssrt);


				     $rssrtv=GetPageRecord('*','maintenancegi_Master','1 and id="'.$rrrrt['parentId'].'"');
		   $rrrrtv=mysqli_fetch_array($rssrtv);

                          if($rrrrtv['requisitiontype']==1) {
                                    echo 'GI-'. date('dmy',$rrrrtv['dateAdded']).'-'.$queryLi['id'];
                                }else{
                                    echo 'MN-'. date('dmy',$rrrrtv['dateAdded']).'-'.$queryLi['id'];
                                }
                         ?>

                       </td>
                        <td><?php echo $resListing1['name']; ?></td>
                        <td><?php echo date('d-m-Y',strtotime($resultlists['entrydate'])); ?></td>
						<td><?php if($resListingGrn['grnNo']!=''){ echo $resListingGrn['grnNo']; }else{ echo '-'; } ?></td>
						<td><?php if($resListingGrn['grnNo']!=''){ echo date('d-m-Y',strtotime($resListingGrn['docDate'])); }else{ echo '-'; } ?></td>
						<td align="center">
						<?php if($resultlists['grnStatus']!=0){ ?>
						<span class="badge" style="cursor:pointer;background-color:#05a90a; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">Completed</span>
						<?php }else{ ?>
						<span class="badge" style="cursor:pointer;background-color:#e6530d; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">Pending</span>
						<?php } ?>
						</td>
						  <td><a href="tcpdf/examples/generatemgi.php?pageurl=<?php echo $fullurl; ?>download-grngipdf.php?gateentryid=<?php echo encode($resultlists['id']); ?>&id=<?php echo encode($resListingGrn['id']); ?>" target="_blank" style="background: #e71c22; outline: none; color: #fff; padding: 5px; border-radius: 2px; cursor: pointer; width: 95px; display: block; float:right; margin-left:5px; text-align:center;"><i class="fa fa-download" aria-hidden="true"></i> PDF</a>	</td>
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
    </div>
  </div>
</div>
</div>
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
