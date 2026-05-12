<?php
if ($loginuserprofileId == 1) {

  $wheresearchassign = ' 1 and ';
} else {

  $wheresearchassign = ' ( assignTo in (select id from ' . _USER_MASTER_ . ' where  empId in (select id from employeeMaster where id =' . $_SESSION['empid'] . ')) or assignTo in (select id from ' . _USER_MASTER_ . ' where  empId in (select reportingTo from employeeMaster where id="' . $_SESSION['empid'] . '"))) ';

  $wheresearchassign = ' ' . $wheresearchassign . ' and ';
} ?>
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
          </div>

          <div class="card">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
              <div class="datatable-scroll">
                <table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
                  <thead style="background-color: #f5f5f5;">
                    <tr role="row">
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Ref.&nbsp;Id</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Name</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Total Qty.</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Cutting Received</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Sewing Received</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Finished</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Dispatch</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Time Lag (Standard vs Actual)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $select = '*';
                    $where = '';
                    $rs = '';
                    $wheresearch = '';
                    $limit = '20000';

                    if ($_GET['stylestatus'] != '') {
                      $stylestatus = 'and finalstatus="' . $_GET['stylestatus'] . '"';
                    }

                    $where = 'where  subject!="" ' . $stylestatus . ' and deletestatus=0 order by id desc';
                    $page = $_GET['page'];

                    $targetpage = $fullurl . 'showpage.crm?module="' . $modfile['moduleName'] . '"&records=' . $limit . '&searchField=' . $searchField . '&assignto=' . $_GET['assignto'] . '&';
                    $rs = GetRecordList($select, _QUERY_MASTER_, $where, $limit, $page, $targetpage);
                    $totalentry = $rs[1];
                    $paging = $rs[2];
                    while ($resultlists = mysqli_fetch_array($rs[0])) {

                      $selectimg = '*';
                      $whereimg = 'parentId="' . $resultlists['id'] . '" and galleryType="image_gallery" order by id asc';
                      $rsimg = GetPageRecord($selectimg, 'imageGallery', $whereimg);
                      $imgresult = mysqli_fetch_array($rsimg);


                      $selectdays = '*';
                      $wheredays = 'styleId="' . $resultlists['id'] . '" and statusId=2';
                      $rsdays = GetPageRecord($selectdays, 'styleAssignmentMaster', $wheredays);
                      $resultdays = mysqli_fetch_array($rsdays);

                      $qtyTotal = 0;
                      $grossTotal = 0;
                      $selectqty = '*';
                      $whereqty = 'styleId="' . $resultlists['id'] . '"';
                      $rsqty = GetPageRecord($selectqty, 'buyerPurchaseOrderMaster', $whereqty);
                      $resultqty = mysqli_fetch_array($rsqty);

                      if ($resultqty['grossTotal'] != '' && $resultqty['grossTotal'] != '0') {

                    ?>

                        <tr role="row" class="odd" <?php if ($resultlists['stylestatus'] == '0') { ?> style="background-color: #ff704359;" <?php } ?>>
                         <td><a href="showpage.crm?module=stylemis&add=yes&styleid=<?php echo encode($resultlists['id']); ?>"><?php echo '#' . $resultlists['styleRefId']; ?><?php if (countQueryunreadMails($resultlists['id']) != 0) { ?><div class="numberbubbol"><?php echo countQueryunreadMails($resultlists['id']); ?></div><?php } ?></a></td>
                          <td><?php echo $resultlists['subject']; ?></td>
                          <td><?php echo $resultlists['orderQty']; ?></td>
                          <td>
                            <?php
                            $where='';
                            $resulttodaycutt='';
                            $todaycutt='';
                            $where = 'styleId="'.$resultlists['id'].'" and parentId in (select id from chaalanMaster where departmentId="13") ';
                            $todaycutt=GetPageRecord('sum(quantity) as todaysewqty,chaalanDate,quantity,receivedQty,receivedDate','chaalanMaster',$where);
                            $resulttodaycutt=mysqli_fetch_array($todaycutt);
                            echo $resulttodaycutt['todaysewqty'];
                            ?>
                          </td>
                          <td>
                          <?php
                            $where='';
                            $resulttodaycutt='';
                            $todaycutt='';
                            $where = 'styleId="'.$resultlists['id'].'" and parentId in (select id from chaalanMaster where departmentId="14") ';
                            $todaycutt=GetPageRecord('sum(quantity) as todaysewqty,chaalanDate,quantity,receivedQty,receivedDate','chaalanMaster',$where);
                            $resulttodaycutt=mysqli_fetch_array($todaycutt);
                            echo $resulttodaycutt['todaysewqty'];
                            ?>
                          </td>
                          <td>
                          <?php
                            $where='';
                            $resulttodaycutt='';
                            $todaycutt='';
                            $where = 'styleId="'.$resultlists['id'].'" and parentId in (select id from chaalanMaster where departmentId="52") ';
                            $todaycutt=GetPageRecord('sum(quantity) as todaysewqty,chaalanDate,quantity,receivedQty,receivedDate','chaalanMaster',$where);
                            $resulttodaycutt=mysqli_fetch_array($todaycutt);
                            echo $resulttodaycutt['todaysewqty'];
                            ?>
                          </td>
                          <td>
                          <?php
                            $where='';
                            $resulttodaycutt='';
                            $todaycutt='';
                            $where = 'styleId="'.$resultlists['id'].'" and parentId in (select id from chaalanMaster where departmentId="17") ';
                            $todaycutt=GetPageRecord('sum(quantity) as todaysewqty,chaalanDate,quantity,receivedQty,receivedDate','chaalanMaster',$where);
                            $resulttodaydis=mysqli_fetch_array($todaycutt);
                            echo $resulttodaydis['todaysewqty'];
                            ?>
                          </td>
                          <td>
                          <?php
                            $where11 = 'styleId="'.$resultlists['id'].'" and parentId in (select id from chaalanMaster where departmentId="14") ';
                            $todaycutt11=GetPageRecord('sum(quantity) as todaysewqty,chaalanDate,quantity,receivedQty,receivedDate','chaalanMaster',$where11);
                            $resulttodaycutt11=mysqli_fetch_array($todaycutt11);

                            $wherenn = 'styleId="'.$resultlists['id'].'" and parentId in (select id from chaalanMaster where departmentId="17") ';
                            $todaycutt222=GetPageRecord('sum(quantity) as todaysewqty,chaalanDate,quantity,receivedQty,receivedDate','chaalanMaster',$wherenn);
                            $resulttodaycutt222=mysqli_fetch_array($todaycutt222);

                            $d1 = new DateTime(date('Y-m-d', strtotime($resulttodaycutt11['receivedDate'])));
                            $d2 = new DateTime(date('Y-m-d', strtotime($resulttodaycutt222['receivedDate'])));
                            $days = $d2->diff($d1);
                            if($resulttodaydis['todaysewqty']!=''){
                              echo "$days->d"." Days";
                            }

                            ?>
                          </td>
                        </tr>

                    <?php }
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