<?php
 if($loginuserprofileId==1){

$wheresearchassign=' 1 and ';

} else {

$wheresearchassign=' ( assignTo in (select id from '._USER_MASTER_.' where  empId in (select id from employeeMaster where id ='.$_SESSION['empid'].')) or assignTo in (select id from '._USER_MASTER_.' where  empId in (select reportingTo from employeeMaster where id="'.$_SESSION['empid'].'"))) ';

$wheresearchassign=' '.$wheresearchassign.' and ';

}?>

<div class="page-content">
  <style>
.even{
background-color: #0097a71a;
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
          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
            <div class="col-xl-9">
              <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>
            <div class="col-xl-3" style="    padding-right: 0px;">
              <div class="btn-group justify-content-center" style="float:right;"> </div>
            </div>
          </div>


          	<div id="collapsible-control-right-group1" class="collapse" style="display:block;">
            <div class="card-body">
              <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                <li class="nav-item"><a href="#highlighted-justified-tab1" class="nav-link active show" data-toggle="tab"><strong><?php echo $pageName; ?></strong></a></li>
                <li class="nav-item"><a href="#highlighted-justified-tab2" class="nav-link" data-toggle="tab"><strong>Yarn Indent</strong></a></li>
              </ul>
              <div class="tab-content">





                            <div class="tab-pane fade active show" id="highlighted-justified-tab1">



          <div class="card">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
              <div class="datatable-scroll">
                <table class="table table-bordered table-hover no-footer">
                  <thead style="background-color: #f5f5f5;">
                    <tr role="row">
                      <th>Requisition&nbsp;No.</th>
                      <th>Requisition&nbsp;Date</th>
                      <th>Brand</th>
                      <th>For Quarter</th>
                      <th>Indent No.</th>
                      <th>Indent&nbsp;Status</th>
                      <th></th>
                      <th style="width: 100px;">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
$no=0;
$select='*';
$where='';
$rs='';
$wheresearch='';
//$limit='20000';
$limit=clean($_GET['records']);


$where='where 1 and brandId!=0 and seasonId!=0 and status=1 order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

$rs=GetRecordList($select,'greigeRequisition',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$rrrr=GetPageRecord('name','brandMaster','id="'.$resultlists['brandId'].'"');
$brandData=mysqli_fetch_array($rrrr);

?>
                    <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>
                      <td><?php echo $resultlists['requisitionNo']; ?></td>
                      <td><?php echo date('d-M-y', strtotime($resultlists['requisitionDate'])); ?></td>
                      <td><?php echo $brandData['name']; ?></td>
                      <td><?php echo getSeasonName($resultlists['seasonId']); ?></td>
                      <td><?php echo $resultlists['indentNumber']; ?></td>
                      <td><?php if($resultlists['indentStatus']==0){ echo '<span style="background: #e71c22; outline: none; color: #fff; padding: 3px; border-radius: 2px; cursor: pointer; width: 95px; display: block;text-align: center;">Pending</span>'; }else{ echo '<span style="background: #1bc71b; outline: none; color: #fff; padding: 3px; border-radius: 2px; cursor: pointer; width: 95px; display: block;text-align: center;">Generated</span>'; } ?></td>
                      <td style=""><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&id=<?php echo encode($resultlists['id']); ?>"><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">View Indent</span></a></td>

                        <td><a href="tcpdf/examples/generategreigeindent.php?pageurl=<?php echo $fullurl; ?>download-greigeindent.php?id=<?php echo encode($resultlists['id']); ?>" target="_blank" style="background: #e71c22; outline: none; color: #fff; padding: 5px; border-radius: 2px; cursor: pointer; width: 95px; display: block;">
			    	    <i class="fa fa-download" aria-hidden="true"></i> PDF</a>
			    	    </td>

                      <td style="display:none;">Total Quantity</td>
                    </tr>
                    <?php  } ?>
                  </tbody>
                </table>
              </div>
            </div>



          </div>

          </div>


                      				<div class="tab-pane fade" id="highlighted-justified-tab2">


          <div class="card">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
              <div class="datatable-scroll">
                <table class="table table-bordered table-hover no-footer">
                  <thead style="background-color: #f5f5f5;">
                    <tr role="row">
                      <th>Requisition&nbsp;No.</th>
                      <th>Requisition&nbsp;Date</th>
                      <th>Brand</th>
                      <th>For Quarter</th>
                      <th>Indent No.</th>
                      <th>Indent&nbsp;Status</th>
                      <th></th>
                      <th style="width: 100px;">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
$no=0;
$select='*';
$where='';
$rs='';
$wheresearch='';
//$limit='20000';
$limit=clean($_GET['records']);


$where='where 1 and brandId!=0 and seasonId!=0 and status=1 order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

$rs=GetRecordList($select,'yarnRequisition',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$rrrr=GetPageRecord('name','brandMaster','id="'.$resultlists['brandId'].'"');
$brandData=mysqli_fetch_array($rrrr);

?>
                    <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>
                      <td><?php echo $resultlists['requisitionNo']; ?></td>
                      <td><?php echo date('d-M-y', strtotime($resultlists['requisitionDate'])); ?></td>
                      <td><?php echo $brandData['name']; ?></td>
                      <td><?php echo getSeasonName($resultlists['seasonId']); ?></td>
                      <td><?php echo $resultlists['indentNumber']; ?></td>
                      <td><?php if($resultlists['indentStatus']==0){ echo '<span style="background: #e71c22; outline: none; color: #fff; padding: 3px; border-radius: 2px; cursor: pointer; width: 95px; display: block;text-align: center;">Pending</span>'; }else{ echo '<span style="background: #1bc71b; outline: none; color: #fff; padding: 3px; border-radius: 2px; cursor: pointer; width: 95px; display: block;text-align: center;">Generated</span>'; } ?></td>
                      <td style=""><a href="showpage.crm?module=yarnindent&add=yes&id=<?php echo encode($resultlists['id']); ?>"><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">View Indent</span></a></td>

                        <td>
                            <a href="" target="_blank" style="background: #e71c22; outline: none; color: #fff; padding: 5px; border-radius: 2px; cursor: pointer; width: 95px; display: block;">
			    	    <i class="fa fa-download" aria-hidden="true"></i> PDF</a>
			    	    </td>

                      <td style="display:none;">Total Quantity</td>
                    </tr>
                    <?php  } ?>
                  </tbody>
                </table>
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
    <!-- /dashboard content -->
  </div>
  <!-- /content area -->
  <!-- Footer -->
  <!-- /footer -->
</div>
<!-- /main content -->
</div>
<style>
 .liststyleimg{float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}

	.badge.dropdown-toggle:after { display:none;
}


 </style>
<script>
$('#DataTables_Table_2').DataTable( {
"order": [[ 0, "desc" ]]
} );
</script>
