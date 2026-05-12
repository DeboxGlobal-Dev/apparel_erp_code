<div class="page-content">
  <div class="content-wrapper">
    <?php include "savealert.php"; ?>
    <div class="content pt-0 filterable" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
            <div class="col-xl-12">
              <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>

          </div>

          <div class="card">

            <div id="collapsible-control-right-group1" class="collapse" style="display:block;">
              <div class="">


                <div class="page-content">
                  <style>
                    .even {
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

                    <div class="row">
                      <div class="col-xl-12">
                        <div class="card">


                          <form name="listform" id="listform" method="get">
                            <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                              <div class="datatable-scroll">
                                <table class="table table-bordered table-hover no-footer">
                                  <thead style="background-color: #f5f5f5;">
                                    <tr role="row">
                                      <th>PO&nbsp;Number</th>
                                      <th>Receipt Payment</th>
                                      <th>Payment Received</th>
                                      <th>Dispatch Qty.</th>
                                      <!-- <th>Bill Amount</th>
                                      <th>Paid Amount</th> -->
                                      <th>Variable Cost Paid</th>
                                      <th>Time Lag (Standard vs Actual)</th>
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

                                    $where = 'where 1 and bomPoStatus=1 group By poNumber order by id desc';

                                    $page = $_GET['page'];

                                    $targetpage = $fullurl . 'showpage.crm?module="' . $modfile['url'] . '"&records=' . $limit . '&searchField=' . $searchField . '&assignto=' . $_GET['assignto'] . '&';

                                    $rs = GetRecordList($select, 'indentCreationMaster', $where, $limit, $page, $targetpage);
                                    $totalentry = $rs[1];
                                    if ($totalentry = 1) {
                                      $totalentry = 2;
                                    }
                                    $paging = $rs[2];
                                    while ($resultlists = mysqli_fetch_array($rs[0])) {




                                    ?>
                                    <?php
		  $sNo=0;
		  $finaltotalqty=0;
		  $totalgrossamount=0;
		  $rsList=GetPageRecord('*','indentCreationMaster','poNumber="'.$resultlists['poNumber'].'"  order by materialTypeId asc');
		  while($rsListData=mysqli_fetch_array($rsList)){
        $getappdata=GetPageRecord('addedBy','styleSubCategoryMaster','id="'.$rsListData['materialId'].'" and styleId="'.$rsListData['styleId'].'"');
        $approvedName=mysqli_fetch_array($getappdata);


			if($rsListData['poTypeId']=='1'){

				$rsInG=GetPageRecord('greigeStyleNo','greigeAllocation','styleId="'.$rsListData['styleId'].'"');
				$rsInGList=mysqli_fetch_array($rsInG);

				$rsReq=GetPageRecord('id','greigeRequisition','styleNo="'.$rsInGList['greigeStyleNo'].'"');
				$rsReqList=mysqli_fetch_array($rsReq);

				$rsReqParent=GetPageRecord('*','greigeRequisition','parentId="'.$rsReqList['id'].'" and color="'.$rsListData['color'].'"');
				$rsReqParentList=mysqli_fetch_array($rsReqParent);

				$rsstylesub=GetPageRecord('name','styleSubCategoryMaster','id="'.$rsReqParentList['stylesubtabid'].'"');
				$rsstylesubname=mysqli_fetch_array($rsstylesub);

				$rsstylesubtech=GetPageRecord('*','techPackDetailMaster','stylesubtabid="'.$rsReqParentList['stylesubtabid'].'"');
				$rsstylesubtechData=mysqli_fetch_array($rsstylesubtech);


			$rsListreadyqty=GetPageRecord('*','indentCreationMaster','materialId="'.$rsReqParentList['stylesubtabid'].'" and styleId="'.$rsListData['styleId'].'"');
			$rsListDatareadyqty=mysqli_fetch_array($rsListreadyqty);

			}
		  if($rsListData['requisitionNo']==''){
        $style = '#'.getStyleRefId($rsListData['styleId']);
		  }else{
        $style = $rsListData['requisitionNo'];

        if($rsListData['poTypeId']==4){
          $mid = $rsListData['oldMaterialId'];
        }
		  }


      $rsstyle=GetPageRecord('styleRefId,sampleStyle','queryMaster','id="'.$rsListData['styleId'].'"');
      $editstyle=mysqli_fetch_array($rsstyle);
      $finaltotalqty=$finaltotalqty+$rsListData['orderQty'];

      $totalgrossamount=$totalgrossamount+$rsListData['sellingValue'];
    }
		?>
                                      <tr role="row">
                                        <td><a href="#"><?php echo $resultlists['poNumber']; ?></a> </td>
                                        <td><?php echo $finaltotalqty; ?></td>
                                        <td><?php echo $totalgrossamount; ?></td>
                                        <td>
                                        <?php
                                        $billAmount=GetPageRecord('SUM(paymentAmount) as totalPaidAmount','billMovementMaster','supplierPurchaseOrderId="'.$resultlists['poNumber'].'"');
                                        $billamountdata=mysqli_fetch_array($billAmount);

                                        if($billamountdata['totalPaidAmount']!=''){
                                          echo $billamountdata['totalPaidAmount'];
                                        }
                                        ?>
                                        </td>
                                        <td>
                                          <?php
                                          if($billamountdata['totalPaidAmount']!=''){
                                            echo $totalgrossamount-$billamountdata['totalPaidAmount'];
                                          }

                                          ?>
                                        </td>
                                        <td>
                                        <?php
                                        $timelag=GetPageRecord('eWayBillDate,grnDate','billMovementMaster','supplierPurchaseOrderId="'.$resultlists['poNumber'].'" and parentId="0" order by id desc');
                                        $timelagdate=mysqli_fetch_array($timelag);

                                        $d1 = new DateTime(date('Y-m-d', strtotime($timelagdate['grnDate'])));
                                        $d2 = new DateTime(date('Y-m-d', strtotime($timelagdate['eWayBillDate'])));
                                        $days = $d2->diff($d1);

                                        echo ($billamountdata['totalPaidAmount']!='') ? "$days->d"." Days" : '-';

                                        ?>
                                        </td>
                                      </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
                                <div class="pagingdiv" style="width: 97%;margin: 20px auto;">
                                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                      <tr>
                                        <td>
                                          <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                              <td style="padding-right:20px;"><?php echo $totalentry - 1; ?> entries</td>
                                              <td><select name="records" id="records" onchange="this.form.submit();" class="lightgrayfield" style="padding: 5px;border: 1px solid #ccc; outline:none;">
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

                  <style>
                    .dataTables_info,
                    .dataTables_paginate,
                    .dataTables_length {
                      display: none !important;
                    }

                    .specialclass label {
                      margin: 0px !important;
                      margin-left: 5px !important;
                    }

                    .select2-container {
                      width: 190px !important;
                    }

                    .select2-search--dropdown .select2-search__field {
                      width: 160px !important;
                    }
                  </style>
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
  $(document).ready(function() {
    $("#filtersearch").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#allhotellisting tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>