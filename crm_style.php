<?php
if ($loginuserprofileId == 1) {
  $wheresearchassign = ' 1 and ';
} else {
  /*if($loginuserprofileId==92){
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
}*/

  //$wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))';
  //$wheresearchassign=' '.$wheresearchassign.' and ';

  //echo $whereFind = ' profileId="'.$loginuserprofileId.'" and FIND_IN_SET('.$_SESSION['userid'].',assignTo)';
  //$rsFindBrand=GetPageRecord('*','resourceAllocationBrandWise',$whereFind);
  //$resulttat=mysqli_fetch_array($rsFindBrand);/

  $wheresearchassign = '  brandId in (SELECT brandId FROM `resourceAllocationBrandWise` WHERE profileId="' . $loginuserprofileId . '" and FIND_IN_SET("' . $_SESSION['userid'] . '",assignTo)) and ';
}

if ($_GET['did'] != '') {
  $namevalue1 = 'deletestatus=1';
  $whereval = 'id="' . decode($_GET['did']) . '"';
  updatelisting('queryMaster', $namevalue1, $whereval);
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
              <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>
            <div class="col-xl-3" style="    padding-right: 0px;">
              <div class="btn-group justify-content-center" style="float:right;">
                <?php if ($addpermission == 1) { ?>
                  <a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes" class="btn bg-teal-400 addnotify" aria-expanded="false" style="    background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="card">
            <div id="DataTables_Table_2_filter" class="dataTables_filter">
              <div class="row specialclass">
                <form action="" method="get">
                  <div class="col-md-12" style="padding:0px;">
                    <label>
                      <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" style="margin-left: 0px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;" />
                    </label>
                    <label>
                      <select name="stylerefid" id="stylerefid" class="select2" style="margin-left: 10px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;">
                        <option value="">Select Style</option>
                        <?php
                        $fcref = GetPageRecord('*', 'queryMaster', '' . $wheresearchassign . ' deleteStatus=0 and subject!="" and sampleStyle=1 order by id desc');
                        while ($refData = mysqli_fetch_array($fcref)) { ?>
                          <option value="<?php echo encode($refData['id']); ?>" <?php if (decode($_GET['stylerefid']) == $refData['id']) { ?> selected="selected" <?php } ?>><?php echo $refData['styleRefId']; ?></option>
                        <?php } ?>
                      </select>
                    </label>
                    <label>
                      <select name="buyerId" id="buyerId" class="select2" style="margin-left: 10px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;">
                        <option value="">Buyer</option>
                        <?php
                        $select = '';
                        $where = '';
                        $rs = '';
                        $select = '*';
                        $where = ' deletestatus=0 and status=1 order by name asc';
                        $rs = GetPageRecord($select, _BUYER_MASTER_, $where);
                        while ($resListing = mysqli_fetch_array($rs)) {
                        ?>
                          <option value="<?php echo encode($resListing['id']); ?>"> <?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                      </select>
                    </label>
                    <label>
                      <select name="categoryId" id="categoryId" class="select2" style="margin-left: 10px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;">
                        <option value="">Category</option>
                        <?php
                        $fc = GetPageRecord('*', 'categoryMaster', '1 and status=1 and deleteStatus=0 order by name asc');
                        while ($catData = mysqli_fetch_array($fc)) { ?>
                          <option value="<?php echo encode($catData['id']); ?>" <?php if (decode($_GET['categoryId']) == $catData['id']) { ?> selected="selected" <?php } ?>><?php echo $catData['name']; ?></option>
                        <?php } ?>
                      </select>
                    </label>

                    <label>
                      <div>
                        <input name="shipDate" id="shipdate" type="text" style="margin-left: 0px; width: 150px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;" readonly="" placeholder="From Date">
                      </div>
                    </label>
                    <label>
                      <input name="shipDate1" id="shipdate1" type="text" style="margin-left: 0px; width: 150px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;" readonly="" placeholder="To Date">
                    </label>
                    <script>
                      $(function() {
                        $("#shipdate").datepicker();
                      });

                      $(function() {
                        $("#shipdate1").datepicker();
                      });
                    </script>
                    <label>
                      <input name="" type="submit" id="" class="" value="search" style="text-transform: uppercase; background-color: #03c28d; color: #fff; width: 150px; cursor:pointer;" />
                    </label>
                    <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
                  </div>
                  <div class="col-md-12" style="padding-top:10px;padding:0px;">
                    <label>
                      <select name="addedBy" id="addedBy" class="select2" style="margin-left: 10px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;">
                        <option value="">Merchant</option>
                        <?php
                        //and profileId in (85,160,161,169)
                        $fc11 = GetPageRecord('*', 'userMaster', '1 and status=1 and deleteStatus=0  order by firstName asc');
                        while ($catData11 = mysqli_fetch_array($fc11)) { ?>
                          <option value="<?php echo $catData11['id']; ?>" <?php if (decode($_GET['addedBy']) == $catData11['id']) { ?> selected="selected" <?php } ?>><?php echo $catData11['firstName'] . ' ' . $catData11['lastName']; ?></option>
                        <?php } ?>
                      </select>
                    </label>

                  </div>
                </form>
              </div>
            </div>
            <?php

            // if ($_GET['categoryId'] != '') {
            //   $categoryid = 'and categoryId="' . decode($_GET['categoryId']) . '"';
            // }
            // if ($_GET['shipDate'] != '') {
            //   $shipDate = 'and shipDate between ' . $_GET['shipDate'] . ' and ' . $_GET['shipDate1'] . '';
            // }

            // if ($_GET['buyerId'] != '') {
            //   $buyerid = 'and buyerId="' . decode($_GET['buyerId']) . '"';
            // }
            // if ($_GET['tatstatus'] != '') {
            //   $tatstatus = 'and styleTatStatus="' . $_GET['tatstatus'] . '"';
            // }

            // if ($_GET['main'] != '') {
            //   $stylestatus = 'and finalstatus="' . $_GET['main'] . '" and styleTypeId in (1,3)';
            // }

            // $CountQuery = GetPageRecord('id', 'queryMaster', '1 and subject!=""  and deletestatus=0 and ' . $wheresearchassign . ' sampleStyle="1" ' . $categoryid . ' ' . $tatstatus . ' ' . $stylestatus . ' order by id desc');
            // $totalQuery = mysql_num_rows($CountQuery);
            // $NewDate1 = Date('Y-m-d', strtotime('-7 days'));
            // $newdate2 = time();
            // $new = strtotime(Date('Y-m-d', strtotime('-7 days')));
            // $disdate = 'and dateAdded  between "' . $new . '" and "' . $newdate2 . '"';

            // $CountQuery1 = GetPageRecord('id', 'queryMaster', '1 and subject!="" and deletestatus=0 and ' . $wheresearchassign . ' sampleStyle="1" ' . $disdate . '  ' . $categoryid . ' ' . $tatstatus . ' order by id desc');
            // $totalQuery1 = mysql_num_rows($CountQuery1);


            // $CountQueryahead = GetPageRecord('id', 'queryMaster', '1 and subject!="" and deletestatus=0 and sampleStyle="1" and styleTatStatus="Ahead"  ' . $categoryid . ' ' . $tatstatus . ' order by id desc');
            // $totalQueryhead = mysql_num_rows($CountQueryahead);

            // $CountQuerydelayed = GetPageRecord('id', 'queryMaster', '1 and subject!="" and deletestatus=0 and sampleStyle="1" and styleTatStatus="Delayed" ' . $categoryid . '  ' . $tatstatus . ' order by id desc');
            // $totalQuerydelayed = mysql_num_rows($CountQuerydelayed);

            // $CountQuerycompleted = GetPageRecord('id', 'queryMaster', '1 and subject!="" and deletestatus=0 and sampleStyle="1" and styleTatStatus="Completed" ' . $categoryid . ' ' . $tatstatus . ' order by id desc');
            // $totalQuerycompleted = mysql_num_rows($CountQuerycompleted);

            // $CountQueryontime = GetPageRecord('id', 'queryMaster', '1 and subject!="" and deletestatus=0 and sampleStyle="1" and styleTatStatus="Ontime" ' . $categoryid . ' ' . $tatstatus . ' order by id desc');
            // $totalQueryontime = mysql_num_rows($CountQueryontime);

            // $Countbuyer = GetPageRecord('id', 'queryMaster', '1 and subject!="" and deletestatus=0 and sampleStyle="1" ' . $categoryid . ' ' . $tatstatus . ' group by buyerId');
            // $totalbuyers = mysql_num_rows($Countbuyer);

            // $Countcategories = GetPageRecord('id', 'queryMaster', '1 and subject!="" and deletestatus=0 and sampleStyle="1" ' . $categoryid . '  ' . $tatstatus . ' group by categoryId');
            // $totalcategories = mysql_num_rows($Countcategories);

            // $Counthighpriority = GetPageRecord('id', 'queryMaster', '1 and subject!="" and deletestatus=0 and sampleStyle="1" ' . $categoryid . '  ' . $tatstatus . ' and queryPriority=3');
            // $highpriority = mysql_num_rows($Counthighpriority);

            // $CountpoAttachment = GetPageRecord('id', 'queryMaster', '1 and subject!="" and deletestatus=0 and sampleStyle="1" ' . $categoryid . ' ' . $shipDate . '  ' . $buyerid . ' ' . $tatstatus . ' and poAttachment!=""');
            // $poAttachmentcount = mysql_num_rows($CountpoAttachment);

            ?>
            <!-- <div class="col-md-12">
              <div style="margin:5px 0px;">
                <table width="100%" border="0" cellpadding="5" cellspacing="0" class="table table-responsive">
                  <tbody>
                    <tr>
                      <td width="10%" align="left" valign="top" style="padding: 4px; padding-left: 0px;">
                        <div class="color-box" style="padding:10px; color:#fff; font-size:12px; background-color:#26A69A;border-left: 4px solid #000;border-radius: 4px; overflow: hidden;">
                          <div style="font-size:20px; font-weight:600;">
                            <div align="center"><?php echo $totalQuery; ?></div>
                          </div>
                          <div style="font-size:12px; font-weight:500;">
                            <div align="center">Total Styles</div>
                          </div>
                        </div>
                      </td>
                      <td width="10%" align="left" valign="top" style="padding:4px;">
                        <div class="color-box" style="padding:10px; color:#fff; font-size:12px; background-color:#2ca1cc;border-left: 4px solid #000;border-radius: 4px; overflow: hidden;">
                          <div style="font-size:20px; font-weight:600;">
                            <div align="center"><?php echo $totalQuery1; ?></div>
                          </div>
                          <div style="font-size:12px; font-weight:500;">
                            <div align="center">New Style</div>
                          </div>
                        </div>
                      </td>
                      <td width="10%" align="left" valign="top" style="padding:4px;">
                        <div class="color-box" style="padding:10px; color:#fff; font-size:12px; background-color:#9466be;border-left: 4px solid #000;border-radius: 4px; overflow: hidden;">
                          <div style="font-size:20px; font-weight:600;">
                            <div align="center"><?php echo $totalcategories; ?></div>
                          </div>
                          <div style="font-size:12px; font-weight:500;width:inherit">
                            <div align="center;text-align:inherit;">Design & Innovation</div>
                          </div>
                        </div>
                      </td>
                      <?php
                      // $rspd = GetPageRecord('*', _QUERY_MASTER_, 'stylestatus=1 and finalstatus=2 and subject!=""  and deletestatus=0 and styleTypeId in (1,3)');
                      // $resultpd = mysql_num_rows($rspd);

                      ?>
                      <td width="10%" align="left" valign="top" style="padding:4px;">
                        <div class="color-box" style="padding:10px; color:#fff; font-size:12px; background-color:#82b767;border-left: 4px solid #000;border-radius: 4px; overflow: hidden;">
                          <div style="font-size:20px; font-weight:600;">
                            <div align="center">
                              <?php echo $resultpd; ?>
                            </div>
                          </div>
                          <div style="font-size:12px; font-weight:500;width:inherit">
                            <div align="center; text-align:inherit;">Product&nbsp;Developm.</div>
                          </div>
                        </div>
                      </td>
                      <?php
                      // $rspdes = GetPageRecord('*', _QUERY_MASTER_, '  subject!=""  and deletestatus=0 and projecQty!=""  ');
                      // $resultpdes = mysql_num_rows($rspdes);

                      ?>
                      <td width="10%" align="left" valign="top" style="padding:4px;">
                        <div class="color-box" style="padding:10px; color:#fff; font-size:12px; background-color:#2ca1cc;border-left: 4px solid #000;border-radius: 4px; overflow: hidden;">
                          <div style="font-size:20px; font-weight:600;">
                            <div align="center"><?php echo $resultpdes ?></div>
                          </div>
                          <div style="font-size:12px; font-weight:500;">
                            <div align="center">Projection</div>
                          </div>
                        </div>
                      </td>
                      <?php
                      // $rspda = GetPageRecord('*', _QUERY_MASTER_, '  orderQty!="0" and subject!=""  and deletestatus=0 ');
                      // $resultpda = mysql_num_rows($rspda);

                      ?>
                      <td width="10%" align="left" valign="top" style="padding:4px;">
                        <div class="color-box" style="padding:10px; color:#fff; font-size:12px; background-color:#FF6600;border-left: 4px solid #000;border-radius: 4px; overflow: hidden;">
                          <div style="font-size:20px; font-weight:600;">
                            <div align="center"><?php echo $resultpda; ?></div>
                          </div>
                          <div style="font-size:12px; font-weight:500;">
                            <div align="center">On-Order</div>
                          </div>
                        </div>
                      </td>
                      <?php
                      // $rspde = GetPageRecord('*', _QUERY_MASTER_, '  subject!=""  and deletestatus=0 and sampleStyle=1  and queryPriority in (2,3)');
                      // $resultpde = mysql_num_rows($rspde);

                      ?>
                      <td width="10%" align="left" valign="top" style="padding:4px;">
                        <div class="color-box" style="padding:10px; color:#fff; font-size:12px; background-color:#03c28d;border-left: 4px solid #000;border-radius: 4px; overflow: hidden;">
                          <div style="font-size:20px; font-weight:600;">
                            <div align="center"><?php echo $resultpde; ?></div>
                          </div>
                          <div style="font-size:12px; font-weight:500;">
                            <div align="center">Key Styles</div>
                          </div>
                        </div>
                      </td>
                      <?php
                      // $list2 = GetPageRecord('*', 'indentCreationMaster', '1 and supplierId!="0"  and bomPoStatus=0');
                      // $countPending = mysql_num_rows($list2);

                      ?>
                      <td width="10%" align="left" valign="top" style="padding:4px;">
                        <div class="color-box" style="padding:10px; color:#fff; font-size:12px; background-color:#a92525;border-left: 4px solid #000;border-radius: 4px; overflow: hidden;">
                          <div style="font-size:20px; font-weight:600;">
                            <div align="center"><?php echo $countPending; ?></div>
                          </div>
                          <div style="font-size:12px; font-weight:500;">
                            <div align="center">Pending Po's </div>
                          </div>
                        </div>
                      </td>
                      <td width="10%" align="left" valign="top" style="padding:4px;">
                        <div class="color-box" style="padding:10px; color:#fff; font-size:12px; background-color:#333333;border-left: 4px solid #000;border-radius: 4px; overflow: hidden;">
                          <div style="font-size:20px; font-weight:600;">
                            <div align="center"><?php echo $poAttachmentcount; ?></div>
                          </div>
                          <div style="font-size:12px; font-weight:500;">
                            <div align="center">Un-Shipped </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div> -->
            <form name="listform" id="listform" method="get">
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
              <div id="pageload">
                <div id="">
                  <div class="datatable-scroll">
                    <table class="table  table-bordered table-hover no-footer " width="100%">
                      <thead style="background-color: #f5f5f5; text-align:center;">
                        <tr role="row">
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 50px; display:none;">SR#</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style#</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Name</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">PD&nbsp;Merchant</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Prod.&nbsp;Merchant</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Creation&nbsp;Date</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="display: none;">Assign&nbsp;To</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Risk&nbsp;Priority</th>
                          <th class="sorting" style="width: 225px;" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">TNA&nbsp;Progress&nbsp;(%)</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Status</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="display:none;">Accept/Reject</th>
                          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="display:none;">Actions</th>
                          <?php if ($loginuserprofileId == 92) { ?>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">&nbsp; </th>
                          <?php } ?>
                        </tr>
                      </thead>
                      <tbody id="allhotellisting">
                        <?php
                        $no = 1;
                        $select = '*';
                        $where = '';
                        $rs = '';
                        $wheresearch = '';
                        //$limit='20000';
                        $limit = clean($_GET['records']);

                        // if($_GET['main']!=''){
                        // $stylestatus = 'and finalstatus="'.$_GET['main'].'" and styleTypeId in (1,3)';
                        // }

                        if ($_GET['stylestatus'] != '') {
                          $stylestatus = 'and finalstatus="' . $_GET['stylestatus'] . '"';
                        }

                        if ($_GET['addedBy'] != '') {
                          $addedBy = 'and addedBy="' . $_GET['addedBy'] . '"';
                        }

                        if ($_GET['stylestatus'] == '0') {
                          $stylestatus = 'and stylestatus="' . $_GET['stylestatus'] . '"';
                        }

                        $assignTo = '';
                        if ($_GET['assignTo'] != '') {
                          $assignTo = 'and assignTo="' . decode($_GET['assignTo']) . '"';
                        }

                        $confirmStyle = '';
                        if ($_GET['confirmStyle'] != '') {
                          $confirmStyle = 'and poAttachment!=""';
                        }

                        $riskPriority = '';
                        if ($_GET['riskPriority'] == 'yes') {
                          $riskPriority = 'and queryPriority in (2,3)';
                        }

                        $categoryId = '';
                        if ($_GET['categoryId'] != '') {
                          $categoryId = 'and categoryId="' . decode($_GET['categoryId']) . '"';
                        }
                        if ($_GET['shipDate'] != '') {
                          $x = date('Y-m-d', strtotime($_GET['shipDate']));
                          $y = date('Y-m-d', strtotime($_GET['shipDate1']));
                          $shipDate = 'and shipDate  between "' . $x . '" and "' . $y . '"';
                        }

                        $buyerId = '';
                        if ($_GET['buyerId'] != '') {
                          $buyerId = 'and buyerId="' . decode($_GET['buyerId']) . '"';
                        }


                        if ($_GET['assignToMerchant'] != '') {
                          $assignToMerchant = ' and assignTo in (select id from userMaster where empId in (select id from employeeMaster where reportingTo in (select empId from userMaster where id="' . decode($_GET['assignToMerchant']) . '")))';
                        }

                        if ($_GET['a'] == '1' && $loginuserprofileId == 92) {
                          //$wheresearchassign = '';
                        }

                        if ($_GET['tatstatus'] != '') {
                          $tatstatusCondition = ' and styleTatStatus="' . $_GET['tatstatus'] . '"';
                        }

                        if ($_GET['stylerefid'] != '') {
                          $stylerefCondition = ' and id="' . decode($_GET['stylerefid']) . '"';
                        }


                        //if($loginuserprofileId==92){
                        $where = 'where ' . $wheresearchassign . '  subject!="" ' . $riskPriority . ' ' . $confirmStyle . '  ' . $stylestatus . ' ' . $assignTo . ' ' . $assignToMerchant . ' ' . $categoryId . ' ' . $shipDate . '   ' . $buyerId . ' ' . $tatstatusCondition . ' ' . $stylerefCondition . ' ' . $addedBy . ' and deletestatus=0 and sampleStyle="1" order by id desc';
                        //}else{
                        //$where='where '.$wheresearchassign.' subject!="" '.$riskPriority.' '.$confirmStyle.' '.$stylestatus.' '.$assignTo .' '.$categoryId.' '.$shipDate.'   '.$buyerid.' '.$tatstatusCondition.' '.$stylerefCondition.' and deletestatus=0 and sampleStyle="1" order by id desc';
                        //}

                        $page = $_GET['page'];

                        //$targetpage=$fullurl.'loadstyle.php?module='.$modfile['moduleName'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';

                        $targetpage = $fullurl . 'showpage.crm?module=' . $modfile['url'] . '&records=' . $limit . '&searchField=' . $searchField . '&assignto=' . $_GET['assignto'] . '&loginuserprofileId=' . $loginuserprofileId . '&categoryId=' . $_GET['categoryId'] . '&';


                        $rs = GetRecordListJs($select, _QUERY_MASTER_, $where, $limit, $page, $targetpage);
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



                          $selectdays = '*';
                          $wheredayse = 'id="' . $resultlists['merchant'] . '" ';
                          $rsdayse = GetPageRecord($selectdays, 'userMaster', $wheredayse);
                          $resultdayse = mysqli_fetch_array($rsdayse);

                          $rsbrand = GetPageRecord('*', 'brandMaster', 'id="' . $resultlists['brandId'] . '"');
                          $resultbrandlist = mysqli_fetch_array($rsbrand);


                          $whereRes = ' buyerId="' . $resultlists['buyerId'] . '" and brandId="' . $resultlists['brandId'] . '" and profileId="' . $loginuserprofileId . '" order by id asc';
                          $rsRes = GetPageRecord('*', 'resourceAllocationBrandWise', $whereRes);
                          $resListing = mysqli_fetch_array($rsRes);
                          $assignedUserArray = explode(',', $resListing['assignTo']);

                          /*if($resListing['assignTo']=='0' || $resListing['assignTo']==''){
	$addClass = 'show';
}else{
	if(in_array($_SESSION['userid'], $assignedUserArray)){
		$addClass = 'show';
	}else{
		$addClass = 'hide';
	}
}*/

                        ?>

                          <tr role="row" class="odd <?php echo $addClass; ?>" <?php if ($resultlists['stylestatus'] == '0') { ?> style="background-color: #ff704359;" <?php } ?>>
                            <td align="center" style="display:none;"><?php echo $resultlists['displayId']; ?></td>
                            <td>
                              <div class="liststyleimg" style="width: 94px !important;"><a href="showpage.crm?module=style&view=yes&id=<?php echo encode($resultlists['id']); ?>"> <img src="images/<?php if ($imgresult['attachmentImage'] != '') { ?><?php echo $imgresult['attachmentImage']; ?><?php } else { ?>noimage.png<?php } ?>" style="height: 80px; width:80px;"></a></div>
                            </td>
                            <td align="center" width="10%"><a href="showpage.crm?module=style&view=yes&id=<?php echo encode($resultlists['id']); ?>"><?php echo '#' . $resultlists['styleRefId']; ?>
                                <?php if (countQueryunreadMails($resultlists['id']) != 0) { ?>
                                  <div class="numberbubbol"><?php echo countQueryunreadMails($resultlists['id']); ?></div>
                                <?php } ?>
                              </a>
                              <?php if ($loginuserprofileId == 92 || $loginuserprofileId == '1') {  ?>
                                <?php if ($resultlists['styleTypeId'] == '1') { ?>
                                  <span class="badge badge-success" style="width: auto; display: block;">Inhouse</span>
                                <?php } ?>
                                <?php if ($resultlists['styleTypeId'] == '2') { ?>
                                  <span class="badge badge-warning" style="width: auto; display: block;">Outsource</span>
                                <?php } ?>
                                <?php if ($resultlists['styleTypeId'] == '3') { ?>
                                  <span class="badge badge-primary" style="width: auto; display: block;">Inhouse & Outsource</span>
                                <?php } ?>
                              <?php } ?>
                              <?php if ($resultlists['attachmentNewMail'] != '') { ?>
                                <strong><span style="font-size: 13px; width: 25px; height: 25px; background-color: #f44336; color: #fff; border-radius: 50%; padding: 3px; margin-top: 5px; display: inline-block; border: 1px solid #f44336;">T</span></strong>
                              <?php } ?>
                              <?php if ($resultlists['poAttachment'] != '') { ?>
                                <strong><span style="font-size: 13px; width: 25px; height: 25px; background-color: #4caf50; color: #fff; border-radius: 50%; padding: 3px; margin-top: 5px; display: inline-block; border: 1px solid #4caf50; margin-left: 5px;">P</span></strong>
                              <?php } ?>
                            </td>
                            <td><?php echo $resultlists['subject']; ?> <span class="badge badge-success" style="display: block; background-color: #2ca1cc; text-align: center; width: 80%;"><?php echo getBuyerName($resultlists['buyerId']); ?></span> </td>
                            <td style="display: none;"><?php echo getCategoryName($resultlists['categoryId']) . ' - ' . getSubCategoryName($resultlists['subCategoryId']); ?></td>
                            <td style="text-align:center; width:130px;"><?php echo getUserName($resultlists['addedBy']); ?></td>
                            <td style="text-align:center;width:100px;"><?php
                                                                        $rsmcheck = GetPageRecord('profileId', 'userMaster', 'id="' . $resultlists['addedBy'] . '"');
                                                                        $rsmcheckdata = mysqli_fetch_array($rsmcheck);
                                                                        if ($rsmcheckdata['profileId'] == '161') {
                                                                          echo getUserName($resultlists['addedBy']);
                                                                        } else {
                                                                          echo getUserName($resultbrandlist['productionmerchant']);
                                                                        } ?>
                            </td>
                            <td><?php echo date('d-M-Y', $resultlists['dateAdded']); ?><br><span style="font-weight:700;">PCD: </span><?php if ($resultlists['pcdDate'] == "1970-01-01" || $resultlists['pcdDate'] == '') {
                                                                                                                                        echo 'N/A';
                                                                                                                                      } else {
                                                                                                                                        echo date('d-M-Y', strtotime($resultlists['pcdDate']));
                                                                                                                                      } ?></td>
                            <td style="display: none;" id="TATprogressbarhover"><?php

                                                                                $assignDate = date('Y-m-d', $resultdays['dateAdded']);
                                                                                $currDate = date('Y-m-d');
                                                                                $datetime1 = date_create($assignDate);
                                                                                $datetime2 = date_create($currDate);
                                                                                $interval = date_diff($datetime1, $datetime2);
                                                                                $durationcount = $interval->days;

                                                                                $rsstatusk = GetPageRecord('*', 'departmentTimelineMaster', '1 and categoryId="' . $resultlists['categoryId'] . '" and subCategoryId="' . $resultlists['subCategoryId'] . '" order by id desc');

                                                                                $countdeptimeline = mysql_num_rows($rsstatusk);

                                                                                $departmentTimeline = mysqli_fetch_array($rsstatusk);

                                                                                $departmentDurationpersent = round($durationcount * 100 / $departmentTimeline['duration']);

                                                                                $selectstatus = '*';
                                                                                $wherestatus = 'styleId="' . $resultlists['id'] . '" and statusId!=0 order by id desc';
                                                                                $rsstatus = GetPageRecord($selectstatus, 'styleAssignmentMaster', $wherestatus);
                                                                                $result = mysqli_fetch_array($rsstatus);


                                                                                $select1 = '*';
                                                                                $where1 = 'id="' . $result['statusId'] . '" order by id desc';
                                                                                $rs1 = GetPageRecord($select1, 'statusMaster', $where1);
                                                                                $result1 = mysqli_fetch_array($rs1);

                                                                                $selecttotaltask = '*';
                                                                                $wheretotaltask = 'styleId="' . $resultlists['id'] . '"';
                                                                                $rstotal = GetPageRecord($selecttotaltask, 'styleSubCategoryMaster', $wheretotaltask);

                                                                                $selectqty = '*';
                                                                                $whereqty = 'styleId="' . $resultlists['id'] . '" and qtyStatus=1';
                                                                                $rsqty = GetPageRecord($selectqty, 'styleSubCategoryMaster', $whereqty);
                                                                                $totalqty = mysql_num_rows($rsqty);

                                                                                $selectprice = '*';
                                                                                $whereprice = 'styleId="' . $resultlists['id'] . '" and priceStatus=1';
                                                                                $rsprice = GetPageRecord($selectprice, 'styleSubCategoryMaster', $whereprice);
                                                                                $totalprice = mysql_num_rows($rsprice);

                                                                                $selectvendor = '*';
                                                                                $wherevendor = 'styleId="' . $resultlists['id'] . '" and vendorStatus=1';
                                                                                $rsvendor = GetPageRecord($selectvendor, 'styleSubCategoryMaster', $wherevendor);
                                                                                $totalvendor = mysql_num_rows($rsvendor);

                                                                                $totalTask = $totalqty + $totalprice + $totalvendor;

                                                                                $selecttaskComplet = '*';
                                                                                $wheretaskComplet = 'styleId="' . $resultlists['id'] . '" and approvedStatus=1';
                                                                                $rswheretaskComplet = GetPageRecord($selecttaskComplet, 'materialCostChatMaster', $wheretaskComplet);
                                                                                $completed = mysql_num_rows($rswheretaskComplet);



                                                                                $persent = round($completed * 100 / $totalTask);


                                                                                $selectfurther = '*';
                                                                                $wherefurther = 'styleId="' . $resultlists['id'] . '" and approvedStatus=2 and materialFinalStatus=1';
                                                                                $rsfurther = GetPageRecord($selectfurther, 'materialCostChatMaster', $wherefurther);
                                                                                $furtherassign = mysql_num_rows($rsfurther);

                                                                                $selectwaiting = '*';
                                                                                $wherewaiting = 'styleId="' . $resultlists['id'] . '" and approvedStatus=3 and materialFinalStatus=1';
                                                                                $rswaiting = GetPageRecord($selectwaiting, 'materialCostChatMaster', $wherewaiting);
                                                                                $waiting = mysql_num_rows($rswaiting);

                                                                                $selectreject = '*';
                                                                                $wherereject = 'styleId="' . $resultlists['id'] . '" and approvedStatus=4 and materialFinalStatus=1';
                                                                                $rsreject = GetPageRecord($selectreject, 'materialCostChatMaster', $wherereject);
                                                                                $reject = mysql_num_rows($rsreject);


                                                                                $pending = $completed + $furtherassign + $waiting + $reject;
                                                                                ?>
                              <?php if ($countdeptimeline == 1 && $assignDate != '1970-01-01') { ?>
                                <div class="progress">
                                  <div class="progress-bar bg-primary" style="width: <?php echo $departmentDurationpersent; ?>%"> <span style="padding: 10px; font-weight: 800;"><?php echo round($departmentDurationpersent); ?>%</span> </div>
                                </div>
                                <div style="text-align: center;margin-top: 4px;">
                                  <?php
                                  if ($departmentDurationpersent > $persent) { ?>
                                    <span id="tatstatusssss<?php echo $resultlists['id']; ?>" style="color: #ff0000;font-size: 13px;"><?php echo "Delayed"; ?> </span>
                                  <?php
                                  }

                                  if ($departmentDurationpersent < $persent && $persent != 100) { ?>
                                    <span id="tatstatusssss<?php echo $resultlists['id']; ?>" style="color: #4caf50;  font-size: 13px;"><?php echo "Ahead"; ?> </span>
                                  <?php }
                                  if ($departmentDurationpersent == $persent) { ?>
                                    <span id="tatstatusssss<?php echo $resultlists['id']; ?>" style="color: #2196f3;  font-size: 13px; "><?php echo "Ontime"; ?> </span>
                                  <?php }

                                  if ($persent == 100) { ?>
                                    <span id="tatstatusssss<?php echo $resultlists['id']; ?>" style="font-size: 13px; color: #fff; font-weight: 400; padding: 3px 10px; background-color: #4caf50;"><?php echo "Completed"; ?> </span>
                                  <?php }

                                  ?>
                                </div>
                                <?php

                                if ($departmentDurationpersent > $persent) {
                                  $styleTatStatus = 'Delayed';
                                }
                                if ($departmentDurationpersent < $persent && $persent != 100) {
                                  $styleTatStatus = 'Ahead';
                                }
                                if ($departmentDurationpersent == $persent) {
                                  $styleTatStatus = 'Ontime';
                                }
                                if ($departmentDurationpersent > $persent) {
                                  $styleTatStatus = 'Delayed';
                                }
                                if ($persent == 100) {
                                  $styleTatStatus = 'Completed';
                                }

                                $update = updatelisting('queryMaster', 'styleTatStatus="' . $styleTatStatus . '"', 'id="' . $resultlists['id'] . '"');


                                ?>
                              <?php } ?>
                              <?php if ($countdeptimeline == 1 && $assignDate != '1970-01-01') { ?>
                                <div class="card card-body text-center tblcontent" id="TATstatusreport">
                                  <h6 class="font-weight-semibold mb-0 mt-1" style="width: 100%; text-align: center; font-weight: 600; font-size: 11px; margin-bottom: 10px !important;">Total Days (<?php echo $departmentTimeline['duration']; ?>)</h6>
                                  <table width="100%" border="1" cellspacing="0" cellpadding="5">
                                    <tr>
                                      <td align="left">Total Days</td>
                                      <td align="left">Lapsed</td>
                                      <td align="left">Days Left</td>
                                    </tr>
                                    <tr>
                                      <td align="left"><?php echo $departmentTimeline['duration']; ?></td>
                                      <td align="left"><?php echo $durationcount; ?></td>
                                      <td align="left"><?php echo $departmentTimeline['duration'] - $durationcount; ?></td>
                                    </tr>
                                  </table>
                                </div>
                              <?php } ?>
                              <style>
                                #TATprogressbarhover {
                                  cursor: pointer;
                                }

                                #TATstatusreport {
                                  width: 290px;
                                  position: absolute;
                                  right: 534px;
                                  padding-bottom: 25px;
                                  border-radius: 0px;
                                  background: #fff;
                                  display: table-row;
                                  z-index: 9;
                                  display: none;
                                }

                                #TATprogressbarhover:hover #TATstatusreport {
                                  display: block;
                                }

                                #TATstatusreport table tr td {
                                  font-weight: 500;
                                  font-size: 10px;
                                  padding: 2px;
                                  width: 50px;
                                  text-align: center;
                                }
                              </style>
                            </td>
                            <td style="display: none;"><?php if ($loginuserprofileId == 90) {
                                                          echo getUserName($resultlists['assignToVendor']);
                                                        } else {
                                                          echo getUserName($resultlists['assignTo']);
                                                        } ?></td>
                            <td align="center"><?php if ($resultlists['queryPriority'] == '1') { ?>
                                <span class="badge badge-secondary" style="width: 47px;">Low</span>
                              <?php }
                                                if ($resultlists['queryPriority'] == '2') { ?>
                                <span class="badge badge-primary" style="width: 47px;">Medium</span>
                              <?php }
                                                if ($resultlists['queryPriority'] == '3') { ?>
                                <span class="badge badge-danger" style="width: 47px;">High</span>
                              <?php } ?>
                            </td>
                            <!--<td>
								<?php
                          if ($resultlists['styleType'] == 1) {
                            echo 'Inhouse';
                          }
                          if ($resultlists['styleType'] == 2) {
                            echo 'Outsource';
                          }
                          if ($resultlists['styleType'] == 3) {
                            echo 'Partial Outsource';
                          }
                          if ($resultlists['styleType'] == '0') {
                            echo '-';
                          }
                ?>
								</td>-->
                            <td id="progressbarhover" style="display: none;"><?php
                                                                              $selectstatus = '*';
                                                                              $wherestatus = 'styleId="' . $resultlists['id'] . '" and statusId!=0 order by id desc';
                                                                              $rsstatus = GetPageRecord($selectstatus, 'styleAssignmentMaster', $wherestatus);
                                                                              $result = mysqli_fetch_array($rsstatus);

                                                                              $select1 = '*';
                                                                              $where1 = 'id="' . $result['statusId'] . '" order by id desc';
                                                                              $rs1 = GetPageRecord($select1, 'statusMaster', $where1);
                                                                              $result1 = mysqli_fetch_array($rs1);

                                                                              $selecttotaltask = '*';
                                                                              $wheretotaltask = 'styleId="' . $resultlists['id'] . '"';
                                                                              $rstotal = GetPageRecord($selecttotaltask, 'styleSubCategoryMaster', $wheretotaltask);

                                                                              $selectqty = '*';
                                                                              $whereqty = 'styleId="' . $resultlists['id'] . '" and qtyStatus=1';
                                                                              $rsqty = GetPageRecord($selectqty, 'styleSubCategoryMaster', $whereqty);
                                                                              $totalqty = mysql_num_rows($rsqty);

                                                                              $selectprice = '*';
                                                                              $whereprice = 'styleId="' . $resultlists['id'] . '" and priceStatus=1';
                                                                              $rsprice = GetPageRecord($selectprice, 'styleSubCategoryMaster', $whereprice);
                                                                              $totalprice = mysql_num_rows($rsprice);

                                                                              $selectvendor = '*';
                                                                              $wherevendor = 'styleId="' . $resultlists['id'] . '" and vendorStatus=1';
                                                                              $rsvendor = GetPageRecord($selectvendor, 'styleSubCategoryMaster', $wherevendor);
                                                                              $totalvendor = mysql_num_rows($rsvendor);

                                                                              //$totalTask = mysql_num_rows($rstotal);




                                                                              $totalTask = $totalqty + $totalprice + $totalvendor;

                                                                              $selecttaskComplet = '*';
                                                                              $wheretaskComplet = 'styleId="' . $resultlists['id'] . '" and approvedStatus=1';
                                                                              $rswheretaskComplet = GetPageRecord($selecttaskComplet, 'materialCostChatMaster', $wheretaskComplet);
                                                                              $completed = mysql_num_rows($rswheretaskComplet);



                                                                              $persent = round($completed * 100 / $totalTask);

                                                                              $selectfurther = '*';
                                                                              $wherefurther = 'styleId="' . $resultlists['id'] . '" and approvedStatus=2 and materialFinalStatus=1';
                                                                              $rsfurther = GetPageRecord($selectfurther, 'materialCostChatMaster', $wherefurther);
                                                                              $furtherassign = mysql_num_rows($rsfurther);

                                                                              $selectwaiting = '*';
                                                                              $wherewaiting = 'styleId="' . $resultlists['id'] . '" and approvedStatus=3 and materialFinalStatus=1';
                                                                              $rswaiting = GetPageRecord($selectwaiting, 'materialCostChatMaster', $wherewaiting);
                                                                              $waiting = mysql_num_rows($rswaiting);

                                                                              $selectreject = '*';
                                                                              $wherereject = 'styleId="' . $resultlists['id'] . '" and approvedStatus=4 and materialFinalStatus=1';
                                                                              $rsreject = GetPageRecord($selectreject, 'materialCostChatMaster', $wherereject);
                                                                              $reject = mysql_num_rows($rsreject);


                                                                              $pending = $completed + $furtherassign + $waiting + $reject;
                                                                              ?>
                              <div class="progress">
                                <div class="progress-bar bg-primary" style="width: <?php echo $persent; ?>%"> <span style="padding: 10px; font-weight: 800;"><?php echo round($persent); ?>%</span> </div>
                              </div>
                              <div style="text-align: center;margin-top: 4px;"><?php echo round($persent); ?>%</div>
                              <?php if ($resultlists['analyzeMaterialListSave'] == 1) { ?>
                                <div class="card card-body text-center tblcontent" id="statusreport">
                                  <h6 class="font-weight-semibold mb-0 mt-1" style="width: 100%; text-align: center; font-weight: 600; font-size: 11px; margin-bottom: 10px !important;">Total Tasks (<?php echo $totalTask; ?>)</h6>
                                  <table width="100%" border="1" cellspacing="0" cellpadding="5">
                                    <tr>
                                      <td align="left">Approved</td>
                                      <td align="left">Pending</td>
                                      <td align="left">Waiting&nbsp;For&nbsp;Approval</td>
                                      <td align="left">Further&nbsp;Assigned</td>
                                      <td align="left">Rejected</td>
                                    </tr>
                                    <tr>
                                      <td align="left"><?php echo $completed; ?></td>
                                      <td align="left"><?php echo $totalTask - $pending; ?></td>
                                      <td align="left"><?php echo $waiting; ?></td>
                                      <td align="left"><?php echo $furtherassign; ?></td>
                                      <td align="left"><?php echo $reject; ?></td>
                                    </tr>
                                  </table>
                                </div>
                              <?php } ?>
                              <style>
                                #progressbarhover {
                                  cursor: pointer;
                                }

                                #statusreport {
                                  width: 420px;
                                  position: absolute;
                                  right: 204px;
                                  padding-bottom: 25px;
                                  border-radius: 0px;
                                  background: #fff;
                                  display: none;
                                  z-index: 9;
                                }

                                #progressbarhover:hover #statusreport {
                                  display: block;
                                }

                                #statusreport table tr td {
                                  font-weight: 500;
                                  font-size: 10px;
                                  padding: 2px;
                                  width: 50px;
                                  text-align: center;
                                }
                              </style>
                              <?php
                              $selecttat = '*';
                              $wheretat = 'departmentId=2 and categoryId="' . $resultlists['categoryId'] . '" and subCategoryId="' . $resultlists['subCategoryId'] . '"';
                              $rstat = GetPageRecord($selecttat, 'departmentTimelineMaster', $wheretat);
                              $resulttat = mysqli_fetch_array($rstat);
                              $tatDays = $resulttat['duration'];

                              //echo $assignDays = $tatDays-$durationcount.' Days Left';
                              ?>
                            </td>
                            <!-- code starts -->
                            <td id="progressbarhover"><?php



                                                      $selectqty = '*';
                                                      $whereqty = 'styleId="' . $resultlists['id'] . '" and complitionDate != "1970-01-01" and complitionDate != "" and complitionDate !="0000-00-00" and status=1';
                                                      $rsqty = GetPageRecord($selectqty, ' timeActionReport', $whereqty);
                                                      $totalTask = mysql_num_rows($rsqty);

                                                      $selectqty1 = '*';
                                                      $whereqty1 = 'styleId="' . $resultlists['id'] . '" and actualDate != "1970-01-01" and actualDate != "" and actualDate !="0000-00-00" and status=1';
                                                      $rsqty1 = GetPageRecord($selectqty1, ' timeActionReport', $whereqty1);
                                                      $completed = mysql_num_rows($rsqty1);


                                                      $persent = round($completed * 100 / $totalTask);

                                                      ?>
                              <a href="showpage.crm?module=timeandaction&add=yes&styleid=<?php echo encode($resultlists['id']); ?>">
                                <div class="progress">
                                  <div class="progress-bar bg-primary" style="width: <?php echo $persent; ?>%"> <span style="padding: 10px; font-weight: 800;"><?php echo $persent; ?>%</span> </div>
                                </div>
                                <div style="text-align: center;margin-top: 4px;"><?php echo round($persent); ?>%</div>
                                <?php if ($resultlists['analyzeMaterialListSave'] == 1) { ?>
                                  <div class="card card-body text-center tblcontent" id="statusreport">
                                    <h6 class="font-weight-semibold mb-0 mt-1" style="width: 100%; text-align: center; font-weight: 600; font-size: 11px; margin-bottom: 10px !important;">TNA Processes</h6>
                                    <table width="100%" border="1" cellspacing="0" cellpadding="5">
                                      <tr>
                                        <td align="left">Planned</td>
                                        <td align="left">Completed</td>
                                        <!-- <td align="left">Waiting&nbsp;For&nbsp;Approval</td>
                                  <td align="left">Further&nbsp;Assigned</td>
                                  <td align="left">Rejected</td> -->
                                      </tr>
                                      <tr>
                                        <td align="left"><?php echo $totalTask; ?></td>
                                        <td align="left"><?php echo $completed; ?></td>
                                        <!-- <td align="left"><?php echo $waiting; ?></td>
                                  <td align="left"><?php echo $furtherassign; ?></td>
                                  <td align="left"><?php echo $reject; ?></td> -->
                                      </tr>
                                    </table>
                                  </div>
                                <?php } ?>
                              </a>
                              <style>
                                #progressbarhover {
                                  cursor: pointer;
                                }

                                #statusreport {
                                  width: 300px;
                                  position: absolute;
                                  right: 204px;
                                  padding-bottom: 10px;
                                  padding-top: 5px;
                                  border-radius: 0px;
                                  background: #fff;
                                  display: none;
                                  z-index: 9;
                                }

                                #progressbarhover:hover #statusreport {
                                  display: block;
                                }

                                #statusreport table tr td {
                                  font-weight: 500;
                                  font-size: 10px;
                                  padding: 2px;
                                  width: 50px;
                                  text-align: center;
                                }
                              </style>
                              <?php
                              $selecttat = '*';
                              $wheretat = 'departmentId=2 and categoryId="' . $resultlists['categoryId'] . '" and subCategoryId="' . $resultlists['subCategoryId'] . '"';
                              $rstat = GetPageRecord($selecttat, 'departmentTimelineMaster', $wheretat);
                              $resulttat = mysqli_fetch_array($rstat);
                              $tatDays = $resulttat['duration'];

                              //echo $assignDays = $tatDays-$durationcount.' Days Left';
                              ?>
                            </td>
                            <!-- code ends -->
                            <td style="display: none" align="left"><?php if ($resultlists['stylestatus'] != '0') { ?>
                                <?php if ($resultlists['stylestatus'] != '0' && $resultlists['finalstatus'] != '2') { ?>
                                  <span class="badge" style="cursor:pointer;background-color:<?php echo $result1['statusColor']; ?>; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;" <?php if ($resultlists['stylestatus'] != '0' && $resultlists['finalstatus'] != '2') { ?> onclick="opmodalpop('Change Status','modalpop.php?action=acceptreject&styleId=<?php echo encode($resultlists['id']); ?>&styleTypeId=<?php echo $resultlists['styleTypeId']; ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" <?php } ?>><?php echo $result1['name']; ?></span>
                                <?php } else {  ?>
                                  <span class="badge badge-flat" style="border:1.5px solid <?php echo $result1['statusColor']; ?>; background-color:#fff; color:black; position: relative;width: 142px; font-size: 11px; padding: 6px;"><?php echo $result1['name']; ?></span>
                                <?php } ?>
                              <?php } ?>
                              <?php if ($resultlists['stylestatus'] == '0') { ?>
                                <span class="badge badge-flat" style="border-color:#ff0000;; color:#ff0000; position: relative; width:108px;width: 142px; font-size: 11px; padding: 6px;">Rejected</span>
                              <?php } ?>
                              <br>
                            </td>
                            <!-- code start -->
                            <td align="left"><?php

                                              $date = date('Y-m-d');
                                              $selectqty = '*';
                                              $whereqty = 'styleId="' . $resultlists['id'] . '" and actualDate <= "' . $date . '" and actualDate != "0000-00-00" and actualDate != "1970-01-01" and status=1 order by actualDate desc';
                                              $status = GetPageRecord($selectqty, ' timeActionReport', $whereqty);
                                              $resultstat = mysqli_fetch_array($status);
                                              if (mysql_num_rows($status) > "0") {
                                                $whereqty1 = 'id="' . $resultstat['taskListId'] . '"';
                                                $status1 = GetPageRecord($selectqty, 'taskListMaster', $whereqty1);
                                                $resultstat1 = mysqli_fetch_array($status1);

                                                $whereqty2 = 'id="' . $resultstat1['name'] . '"';
                                                $status2 = GetPageRecord($selectqty, 'tnaActivityMaster', $whereqty2);
                                                $resultstat2 = mysqli_fetch_array($status2);
                                              ?>
                                <div style="color: green"><?php echo $resultstat2['name']; ?></div>
                              <?php } else { ?>
                                <div style="color: red;text-align: center;">Pending</div>
                              <?php } ?>
                            </td>
                            <!-- code end -->
                            <td align="center" style="display:none;"><?php if ($resultlists['stylestatus'] != '0' && $resultlists['finalstatus'] != '2') { ?>
                                <span class="badge list-group-item list-group-item-action" style="background-color: #33cc33;color: #FFFFFF; position: relative;padding: 7px; font-size: 11px;background: #ff7043;cursor:pointer;" onclick="opmodalpop('Change Status','modalpop.php?action=acceptreject&styleId=<?php echo encode($resultlists['id']); ?>','400px','auto');" data-toggle="modal" data-target="#modalpop">Accept/Reject</span>
                              <?php } ?>
                              <?php if ($resultlists['stylestatus'] == '0' && $resultlists['stylestatus'] != '2') { ?>
                                <span class="badge badge-flat" style="border-color: #ff7043;color: #ff7043; position: relative;padding: 7px; font-size: 11px;">Rejected</span>
                              <?php } ?>
                              <?php if ($resultlists['stylestatus'] == '1' && $resultlists['finalstatus'] == '2') { ?>
                                <span class="badge badge-flat" style="border-color: #02c681; color: #02c681; position: relative;padding: 7px; font-size: 11px;">Accepted</span>
                              <?php } ?>
                            </td>
                            <td style="display:none;"></td>
                            <!--<?php if ($deletepermission == 1) { ?><td style="">
								<div class="btn-group">
								<a href="#" onclick="deletestyle('<?php echo encode($resultlists['id']);; ?>');"><button type="button" class="btn btn-warning" style="padding:5px;"><i class="fa fa-trash" aria-hidden="true" style=" color: #fffffff1;   font-size: 16px; "></i></button></a>
								</div>
								</td>
								<?php } ?>-->
                            <?php if ($loginuserprofileId == 92) { ?>
                              <td><span style="width: 90px; display: block; background-color: #0288d1; color: #fff; text-align: center; padding: 4px; cursor:pointer;" onClick="opmodalpop('Action','modalpop.php?action=changestyletype&id=<?php echo encode($resultlists['id']); ?>','500px','auto');" data-toggle="modal" data-target="#modalpop">Change Type</span></td>
                            <?php } ?>
                          </tr>
                        <?php //}
                        } ?>
                      </tbody>
                    </table>
                    <script>
                      $('.hide').css('display', 'none');
                    </script>
                    <div class="pagingdiv" style="width: 97%;margin: 20px auto;">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                          <tr>
                            <td>
                              <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td style="padding-right:20px;"><?php echo $totalentry; ?> entries</td>
                                  <td><select name="records" id="records" onchange="this.form.submit();" class="lightgrayfield" style="padding: 5px;border: 1px solid #ccc;">
                                      <option value="25" <?php if ($_GET['records'] == '25') { ?> selected="selected" <?php } ?>>25 Records Per Page</option>
                                      <option value="50" <?php if ($_GET['records'] == '50') { ?> selected="selected" <?php } ?>>50 Records Per Page</option>
                                      <option value="100" <?php if ($_GET['records'] == '100') { ?> selected="selected" <?php } ?>>100 Records Per Page</option>
                                      <option value="200" <?php if ($_GET['records'] == '200') { ?> selected="selected" <?php } ?>>200 Records Per Page</option>
                                      <option value="300" <?php if ($_GET['records'] == '300') { ?> selected="selected" <?php } ?>>300 Records Per Page</option>
                                    </select></td>
                                </tr>
                              </table>
                            </td>
                            <td align="right">
                              <div class="pagingnumbers"><?php echo $paging; ?></div>
                            </td>
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

  .dataTables_info,
  .dataTables_paginate,
  .dataTables_length {
    display: none !important;
  }
</style>
<script>
  function deletestyle(id) {
    var delStyle = confirm('Are you sure you want to delete this style?');
    if (delStyle == true) {
      window.location.href = 'showpage.crm?module=style&d=' + id; //delete style
    }
  }
</script>
<script>
  $('#DataTables_Table_2').DataTable({
    "order": [
      [0, "desc"]
    ]
  });
</script>
<script>
  $(document).ready(function() {
    $("#filtersearch").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#allhotellisting tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
<style>
  .color-box {
    width: 132px;
  }
</style>