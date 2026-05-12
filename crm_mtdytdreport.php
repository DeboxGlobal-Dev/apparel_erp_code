<?php
 if($loginuserprofileId==1){

$wheresearchassign=' 1 and ';

} else {

$wheresearchassign=' ( assignTo in (select id from '._USER_MASTER_.' where  empId in (select id from employeeMaster where id ='.$_SESSION['empid'].')) or assignTo in (select id from '._USER_MASTER_.' where  empId in (select reportingTo from employeeMaster where id="'.$_SESSION['empid'].'"))) ';

$wheresearchassign=' '.$wheresearchassign.' and ';

}?>
<div class="page-content">
    <style>
    .even {
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
                            <div class="btn-group justify-content-center" style="float:right;">


                            </div>
                        </div>
                    </div>

                    <div class="card">

					<div class="row" style="margin-top:20px;">

              <div class="col-md-12" style=" padding:0px 25px;">

                <form action="" method="GET">



                  <div class="row">

                 <!-- <div class="col-md-2">

                      <div class="form-group">
                        <label style="visibility: hidden;">Search</label>

                         <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" style="margin-left: 0px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;"/>

                      </div>

                    </div>-->

                    <div class="col-md-2">

                      <div class="form-group">
<!--                         <label style="visibility: hidden;">Style</label> -->
<select name="type" class="form-control">

                          <option value="">Select Report Type</option>


                          <option value="day" <?php if($_GET['type']=="day"){ echo "selected"; }  ?>>DAY</option>


                          <option value="mtd" <?php if($_GET['type']=="mtd"){ echo "selected"; }  ?>>MTD</option>


                          <option value="ytd" <?php if($_GET['type']=="ytd"){ echo "selected"; }  ?>>YTD</option>





                        </select>


                      </div>

                    </div>

                    <div class="col-md-2">

                      <div class="form-group">
<!--                         <label style="visibility: hidden;">Style</label> -->
<input name="fromDate" type="date" id="" class="form-control" value="<?php echo $_GET['fromDate']; ?>" />


                      </div>

                    </div>


                    <div class="col-md-2">

                      <div class="form-group">
                        <!-- <label style="visibility: hidden;">Submit</label> -->

                        <input name="" type="submit" id="" class="form-control btn btn-primary" value="Search" />

                        <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />

                      </div>

                    </div>

                  </div>

                </form>

              </div>

            </div>
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                            <div class="datatable-scroll">
                                <table class="table table-bordered table-hover datatable-highlight dataTable no-footer"
                                    id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
                                    <thead style="background-color: #f5f5f5;">
                                        <tr role="row">
                                            <!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"-->
                                            <!--    rowspan="1" colspan="1" style="width: 50px;">Date</th>-->
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1">Style&nbsp;Ref.&nbsp;Id</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1">Operator</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1">Checker</th>
										<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1">Supervisor</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1">Total</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1">Avg. Per Day</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit='20000';

if($_GET['fromDate']!='' && $_GET['type']=='day'){
$fromDate = ' and fromDate="'.$_GET['fromDate'].'"';
}

if($_GET['fromDate']!='' && $_GET['type']=='mtd'){
$fromDate = ' and MONTH(fromDate)=MONTH("'.$_GET['fromDate'].'")';
}

if($_GET['fromDate']!='' && $_GET['type']=='ytd'){
$fromDate = ' and YEAR(fromDate)=YEAR("'.$_GET['fromDate'].'")';
}




$where='where 1 '.$fromDate.' group by styleId order by id desc';
$page=$_GET['page'];
$whereimg = '';
$rsimg='';
$imgresult='';
$totalWorker=0;
$totalChecker=0;
$totalSupervisor=0;
$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,'recorderInputMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){


if($_GET['type']=='day'){
$whereimg='styleId="'.$resultlists['styleId'].'" and fromDate="'.date('Y-m-d',strtotime($resultlists['fromDate'])).'"';
}

if($_GET['type']=='mtd'){
$whereimg='styleId="'.$resultlists['styleId'].'" and MONTH(fromDate)= MONTH("'.date('Y-m-d',strtotime($resultlists['fromDate'])).'")';
}

if($_GET['type']=='ytd'){
$whereimg='styleId="'.$resultlists['styleId'].'" and YEAR(fromDate)= YEAR("'.date('Y-m-d',strtotime($resultlists['fromDate'])).'")';
}

$rsimg=GetPageRecord("SUM(operator) as totalWorker,SUM(supervisor) as totalSupervisor,SUM(checker) as totalChecker",'recorderInputMaster',$whereimg);
$imgresult=mysqli_fetch_array($rsimg);

// $selectdays='*';
// $wheredays='styleId="'.$resultlists['id'].'" and statusId=2';
// $rsdays=GetPageRecord($selectdays,'styleAssignmentMaster',$wheredays);
// $resultdays=mysqli_fetch_array($rsdays);

// $qtyTotal =0;
// $grossTotal = 0;
// $selectqty='*';
// $whereqty='styleId="'.$resultlists['id'].'"';
// $rsqty=GetPageRecord($selectqty,'buyerPurchaseOrderMaster',$whereqty);
// $resultqty=mysqli_fetch_array($rsqty);

//if($resultqty['grossTotal']!='' && $resultqty['grossTotal']!='0'){

?>

                                        <tr role="row" class="odd">
                                            <!--<td align="center"><?php echo date('d-m-Y',strtotime($resultlists['fromDate'])); ?></td>-->

                                            <td><?php echo getStyleRefId($resultlists['styleId']); ?></td>
                                            <td><?php echo $imgresult['totalWorker'];
                                            $totalWorker+=$imgresult['totalWorker']; ?></td>

                                            <td><?php echo $imgresult['totalChecker'];
                                            $totalChecker+=$imgresult['totalChecker'];
                                            ?></td>

                                            <td>
                                            <?php echo $imgresult['totalSupervisor'];
                                            $totalSupervisor+=$imgresult['totalSupervisor'];
                                            ?></td>
                                             <td><?php echo $total = $imgresult['totalWorker']+$imgresult['totalChecker']+$imgresult['totalSupervisor']; ?></td>
                                         <td><?php echo round($total/365,2); ?> % </td>



                                        </tr>

                                        <?php //}
									 } ?>
                                    </tbody>
                                </table>
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
.liststyleimg {
    float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;
}

.badge.dropdown-toggle:after {
    display: none;
}
</style>

<script>
$('#DataTables_Table_2').DataTable({
    "order": [
        [0, "desc"]
    ]
});
</script>