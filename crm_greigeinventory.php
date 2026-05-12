                <?php
if ($loginuserprofileId == 1) {

    $wheresearchassign = ' 1 and ';

} else {

    $wheresearchassign = ' ( assignTo in (select id from ' . _USER_MASTER_ . ' where  empId in (select id from employeeMaster where id =' . $_SESSION['empid'] . ')) or assignTo in (select id from ' . _USER_MASTER_ . ' where  empId in (select reportingTo from employeeMaster where id="' . $_SESSION['empid'] . '"))) ';

    $wheresearchassign = ' ' . $wheresearchassign . ' and ';

}?>
                <div class="page-content">
                    <style>
                    .even {
                        background-color: #0097a71a;
                    }
                    </style>

                    <!-- Main sidebar -->
                    <?php include "left.php";?>
                    <div class="content-wrapper">
                        <!---Save Alert Notification---->
                        <?php include "savealert.php";?>

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
                                    <div id="collapsible-control-right-group1" class="collapse" style="display:block;">
                                        <div class="card-body">
                                            <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                                                <li class="nav-item"><a href="#highlighted-justified-tab1"
                                                        class="nav-link active show"
                                                        data-toggle="tab"><strong><?php echo $pageName; ?></strong></a>
                                                </li>
                                                <li class="nav-item"><a href="#highlighted-justified-tab2"
                                                        class="nav-link" data-toggle="tab"><strong>Yarn
                                                            Inventory</strong></a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade active show" id="highlighted-justified-tab1">
                                                    <div class="card">
                                                        <div id="DataTables_Table_0_wrapper"
                                                            class="dataTables_wrapper no-footer">
                                                            <div class="datatable-scroll">
                                                                <table
                                                                    class="table table-bordered table-hover datatable-highlight dataTable no-footer"
                                                                    id="DataTables_Table_2" role="grid"
                                                                    aria-describedby="DataTables_Table_2_info">
                                                                    <thead style="background-color: #f5f5f5;">
                                                                        <tr role="row">
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="DataTables_Table_0"
                                                                                rowspan="1" colspan="1">
                                                                                Requisition&nbsp;No.</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="DataTables_Table_0"
                                                                                rowspan="1" colspan="1">
                                                                                Requisition&nbsp;Date</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="DataTables_Table_0"
                                                                                rowspan="1" colspan="1">Brand</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="DataTables_Table_0"
                                                                                rowspan="1" colspan="1">For Quarter</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="DataTables_Table_0"
                                                                                rowspan="1" colspan="1">Indent No.</th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="DataTables_Table_0"
                                                                                rowspan="1" colspan="1"></th>
                                                                            <th class="sorting" tabindex="0"
                                                                                aria-controls="DataTables_Table_0"
                                                                                rowspan="1" colspan="1" style=""></th>
                                                                            <th class="text-center sorting_disabled"
                                                                                rowspan="1" colspan="1"
                                                                                style="width: 100px; display:none;"
                                                                                aria-label="Actions">Actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
$no = 0;
$select = '*';
$where = '';
$rs = '';
$wheresearch = '';
//$limit='20000';
$limit = clean($_GET['records']);

$where = 'where 1 and brandId!=0 and seasonId!=0 and status=1 order by id desc';
$page = $_GET['page'];

$targetpage = $fullurl . 'showpage.crm?module=' . $modfile['url'] . '&records=' . $limit . '&searchField=' . $searchField . '&assignto=' . $_GET['assignto'] . '&stylerefid=' . $_GET['stylerefid'] . '&';

$rs = GetRecordList($select, 'greigeRequisition', $where, $limit, $page, $targetpage);
$totalentry = $rs[1];
$paging = $rs[2];
while ($resultlists = mysqli_fetch_array($rs[0])) {

    $rrrr = GetPageRecord('name', 'brandMaster', 'id="' . $resultlists['brandId'] . '"');
    $brandData = mysqli_fetch_array($rrrr);

    ?>
                                                                        <tr role="row" class="odd"
                                                                            <?php if ($resultlists['stylestatus'] == '0') {?>
                                                                            style="background-color: #ff704359;"
                                                                            <?php }?>>

                                                                            <td>
                                                                                <div style="display:none;">
                                                                                    <?php echo $resultlists['id']; ?>
                                                                                </div><a
                                                                                    href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&id=<?php echo encode($resultlists['id']); ?>&greReq=<?php echo encode($resultlists['requisitionNo']); ?>"><?php echo $resultlists['requisitionNo']; ?></a>
                                                                            </td>
                                                                            <td><?php echo date('d-M-y', strtotime($resultlists['requisitionDate'])); ?>
                                                                            </td>
                                                                            <td><?php echo $brandData['name']; ?></td>
                                                                            <td><?php echo getSeasonName($resultlists['seasonId']); ?>
                                                                            </td>
                                                                            <td><?php echo $resultlists['indentNumber']; ?>
                                                                            </td>
                                                                            <td>-</td>
                                                                            <td>-</td>
                                                                            <td style="display:none;">Total Quantity
                                                                            </td>
                                                                        </tr>

                                                                        <?php }?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>


                                                <div class="tab-pane fade" id="highlighted-justified-tab2">

                                                    <div class="card">
                                                        <div id="" class="">
                                                            <div class="">
                                                                <table class="table table-bordered  dataTable no-footer"
                                                                    id="DataTables_Table_3" role="grid"
                                                                    style="    width: 100%;!important">
                                                                    <thead style="background-color: #f5f5f5;">
                                                                        <tr role="row">
                                                                            <th>
                                                                                Requisition&nbsp;No.</th>
                                                                            <th>
                                                                                Requisition&nbsp;Date</th>
                                                                            <th>Brand</th>
                                                                            <th>For Quarter</th>
                                                                            <th>Indent No.</th>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th style="width: 100px; display:none;">
                                                                                Actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
$no = 0;
$select = '*';
$where = '';
$rs = '';
$wheresearch = '';
//$limit='20000';
$limit = clean($_GET['records']);

$where = 'where 1 and brandId!=0 and seasonId!=0 and status=1 order by id desc';
$page = $_GET['page'];

$targetpage = $fullurl . 'showpage.crm?module=' . $modfile['url'] . '&records=' . $limit . '&searchField=' . $searchField . '&assignto=' . $_GET['assignto'] . '&stylerefid=' . $_GET['stylerefid'] . '&';

$rs = GetRecordList($select, 'yarnRequisition', $where, $limit, $page, $targetpage);
$totalentry = $rs[1];
$paging = $rs[2];
while ($resultlists = mysqli_fetch_array($rs[0])) {

    $rrrr = GetPageRecord('name', 'brandMaster', 'id="' . $resultlists['brandId'] . '"');
    $brandData = mysqli_fetch_array($rrrr);

    ?>
                                                                        <tr role="row" class="odd"
                                                                            <?php if ($resultlists['stylestatus'] == '0') {?>
                                                                            style="background-color: #ff704359;"
                                                                            <?php }?>>

                                                                            <td>
                                                                                <div style="display:none;">
                                                                                    <?php echo $resultlists['id']; ?>
                                                                                </div><a
                                                                                    href="showpage.crm?module=yarninventory&add=yes&id=<?php echo encode($resultlists['id']); ?>&greReq=<?php echo encode($resultlists['requisitionNo']); ?>"><?php echo $resultlists['requisitionNo']; ?></a>
                                                                            </td>
                                                                            <td><?php echo date('d-M-y', strtotime($resultlists['requisitionDate'])); ?>
                                                                            </td>
                                                                            <td><?php echo $brandData['name']; ?></td>
                                                                            <td><?php echo getSeasonName($resultlists['seasonId']); ?>
                                                                            </td>
                                                                            <td><?php echo $resultlists['indentNumber']; ?>
                                                                            </td>
                                                                            <td>-</td>
                                                                            <td>-</td>
                                                                            <td style="display:none;">Total Quantity
                                                                            </td>
                                                                        </tr>

                                                                        <?php }?>
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
$('#DataTables_Table_3').DataTable({
    "order": [
        [0, "desc"]
    ]
});
                </script>