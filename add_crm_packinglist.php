<?php
if ($_GET['styleid'] != '') {
  $select = '*';
  $where = 'id="' . decode($_GET['styleid']) . '"';
  $rs = GetPageRecord($select, 'queryMaster', $where);
  $editresultstyle = mysqli_fetch_array($rs);
  $buyerId = $editresultstyle['buyerId'];
  $buyerStyleRefNo = $editresultstyle['buyerStyleRefNo'];
  $subject = $editresultstyle['subject'];
  $displayId = $editresultstyle['displayId'];
  $seasonId = $editresultstyle['seasonId'];
  $categoryId = $editresultstyle['categoryId'];
  $subCategoryId = $editresultstyle['subCategoryId'];
  $departmentId = $editresultstyle['departmentId'];
  $receivedDate = $editresultstyle['receivedDate'];
  $patternDescription = $editresultstyle['patternDescription'];
  $patternAttachment = $editresultstyle['patternAttachment'];
  $lastId = $editresultstyle['id'];
}

if ($_GET['id'] == '') {

  deleteRecord('packinglistMaster', 'styleId="0"');

  $namevalue = 'addedBy="' . $_SESSION['userid'] . '"';
  $gateLastId = addlistinggetlastid('packinglistMaster', $namevalue);
  $gateLastId = mysql_insert_id();
}
if ($_GET['id'] != '') {

  $rs = GetPageRecord('*', 'packinglistMaster', 'id="' . decode($_GET['id']) . '"');
  $editresult = mysqli_fetch_array($rs);
  $gateLastId = $editresult['id'];
}
if ($_GET['edit'] == '1') {
  $update = updatelisting('packinglistMaster', 'status=1', 'id="' . decode($_GET['id']) . '"');
  $update = updatelisting('loadpackinglistmaster', 'status=1', 'parentId="' . decode($_GET['id']) . '"');
}
?>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<style>
  .form-control {
    padding: 4px;
  }

  .form-group {
    margin-bottom: 0.5em !important;
  }

  .toggle.btn {
    min-width: 59px;
    min-height: 34px;
    width: auto !important;
    height: auto !important;
    margin: 0px !important;
  }

  .listc .table thead th {
    vertical-align: middle;
    border-bottom: 1px solid #b7b7b7;
    padding: 9px;
  }

  .listc .table-bordered td,
  .table-bordered th {
    border: 1px solid #ddd;
    padding: 8px;
  }

  .icon-calendar3 {
    position: absolute;
    top: 18px;
    right: 0px;
  }
</style>
<div class="page-content">

  <div class="content-wrapper">

    <div class="content pt-0" style="margin-top:20px;">
      <?php
      if ($_GET['styleid'] != "") {
        include "top-style.php";
      }
      ?>

      <div class="col-xl-12" style="padding:0px;">
        <div class="card">
          <div class="card-body navbar-green" style="padding:7px !important;">
            <div class="media">
              <div class="col-xl-6">
                <h6 class="media-title font-weight-semibold" style="margin-top: 8px;">Packing List </h6>
              </div>
              <div class="col-xl-6" style="text-align:right;">
                <div class="d-flex align-items-center" style="float:right; ">

                  <div class="d-flex align-items-center" style="float:right;margin-right:0px;">
                    <a href="showpage.crm?module=<?php echo $_GET['module']; ?>"><button type="button" class="btn bg-grey-400 btn-labeled btn-labeled-right ml-auto"><b><i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 17px;"></i></b>Back</button></a>
                    <a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&styleid=<?php echo $_GET['styleid']; ?>&id=<?php echo $_GET['id']; ?>&edit=1">
                      <div style="background: #484898;padding: 8px 15px;border-radius: 4px;color: white;"><b><i class="fa fa-pencil" aria-hidden="true" style="font-size: 14px;"></i></b>&nbsp;&nbsp;&nbsp;Edit</div>
                    </a>
                  </div>

                </div>

              </div>

            </div>
          </div>
          <?php
          $rrrl = GetPageRecord('*', 'packinglistMaster', '1 and id="' . decode($_GET['id']) . '"');
          $operationData = mysqli_fetch_array($rrrl);
          ?>
          <div class="card-body listc">
            <div align="center" style="margin: 0px 10px 30px;font-size: 16px;line-height: 27px;">Shiv DVN Garments LLP.</div>

            <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
              <input name="action" type="hidden" id="action" value="packinglistaddnew" />
              <input name="editId" type="hidden" id="editId" value="<?php echo encode($gateLastId); ?>">
              <input name="editpack" type="hidden" id="editpack" value="<?php echo encode($_GET['edit']) ?>">
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Style&nbsp;Number</label>
                    <select id="" name="styleId" class="form-control" onchange="changeStyle(this.value);changepo(this.value);" <?php if ($operationData['status'] == '2') { ?> disabled <?php } ?>>
                      <option value="">Select</option>
                      <?php
                      $rs = GetPageRecord('*', 'queryMaster', '1 and deletestatus=0 and subject!="" and sampleStyle=1 order by id asc');
                      while ($resultStyle = mysqli_fetch_array($rs)) {
                      ?>
                        <option value="<?php echo $resultStyle['id']; ?>" <?php if ($operationData['styleId'] == $resultStyle['id']) {
                                                                            echo "selected";
                                                                          } ?>><?php echo '#' . $resultStyle['styleRefId']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Description</label>
                    <div id="description">
                      <input type="text" style="padding: 7px" class="form-control" readonly="readonly">
                    </div>
                  </div>
                </div>
                <script type="text/javascript">
                  function changeStyle(style) {
                    $('#description').load('loadbrand.php?action=changepackinglistdesc&styleId=' + style);
                  }
                  changeStyle(<?php echo $operationData['styleId'] ?>);

                  function changepo(po) {
                    $('#purchase').load('loadbrand.php?action=changepackinglistpo&styleId=' + po);
                  }
                </script>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Purchase&nbsp;Order</label>
                    <select id="purchase" name="purchaseNo" class="form-control" onchange="changepurchase(this.value);changeexfactory(this.value);" <?php if ($operationData['status'] == '2') { ?> disabled <?php } ?>>
                      <option value="">Select</option>
                      <?php
                      $rss = GetPageRecord('*', 'poManageMaster', '1 and styleId!=""');
                      while ($result = mysqli_fetch_array($rss)) {
                      ?>
                        <option value="<?php echo $result['id']; ?>" <?php if ($operationData['purchaseNo'] == $result['id']) {
                                                                        echo "selected";
                                                                      } ?>><?php echo '#' . $result['poNumber']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>



                <div class="col-md-2">
                  <div class="form-group">
                    <label>PO&nbsp;Quantity</label>
                    <div id="poqty">
                      <input name="poqty" value="<?php echo $operationData['poqty'] ?>" type="text" style="padding: 7px" class="form-control" readonly>
                    </div>
                  </div>
                </div>



                <!--<div class="col-md-2">-->
                <!--  <div class="form-group">-->
                <!--    <label>Invoice&nbsp;No</label>-->
                <!--    <input name="invoiceNo" value="<?php echo $operationData['invoiceNo'] ?>" type="text" style="padding: 7px" class="form-control" <?php if ($operationData['status'] == '2') { ?> readonly <?php } ?>>-->
                <!--</div>-->
                <!--</div>-->



                <!-- <div class="col-md-2">
                  <div class="form-group">
                    <label>Date</label>
                    <input type="text" style="padding: 7px" value="<?php echo date('d-m-Y', strtotime($operationData['dateAdded'])); ?>" class="form-control" readonly="readonly">
                  </div>
                </div> -->
              </div>
              <br>
              <div class="row">
                <div class="col-md-4">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Consignee</label>
                      <textarea type="text" name="consignee" rows="7" cols="10" style="padding: 7px" class="form-control" <?php if ($operationData['status'] == '2') { ?> readonly <?php } ?>><?php echo $operationData['consignee'] ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Shipment&nbsp;From</label>
                        <input type="text" name="shipmentfrom" style="padding: 5px" value="<?php echo $operationData['shipmentfrom'] ?>" class="form-control" <?php if ($operationData['status'] == '2') { ?> readonly <?php } ?>>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Shipment&nbsp;To</label>
                        <input type="text" name="shipmentto" style="padding: 5px" value="<?php echo $operationData['shipmentto'] ?>" class="form-control" <?php if ($operationData['status'] == '2') { ?> readonly <?php } ?>>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Payment&nbsp;Terms</label>
                        <input type="text" name="paymentterm" style="padding: 5px" value="<?php echo $operationData['paymentterm'] ?>" class="form-control" <?php if ($operationData['status'] == '2') { ?> readonly <?php } ?>>
                      </div>
                    </div>
                    <!--<div class="col-md-4">-->
                    <!--  <div class="form-group">-->
                    <!--  <label>Vessel/Airlines</label>-->
                    <!--  <input type="text" name="vessel" style="padding: 5px" value="<?php echo $operationData['vessel'] ?>" class="form-control" <?php if ($operationData['status'] == '2') { ?> readonly <?php } ?>>-->
                    <!--  </div>-->
                    <!--</div>-->
                    <!--<div class="col-md-4">-->
                    <!--  <div class="form-group">-->
                    <!--  <label>Voyage/Flight</label>-->
                    <!--  <input type="text" name="voyage" style="padding: 5px" value="<?php echo $operationData['voyage'] ?>" class="form-control" <?php if ($operationData['status'] == '2') { ?> readonly <?php } ?>>-->
                    <!--  </div>-->
                    <!--</div>-->
                    <!--<div class="col-md-4">-->
                    <!--  <div class="form-group">-->
                    <!--  <label>Date&nbsp;of&nbsp;Export</label>-->
                    <!--  <input type="text" id="exdate" name="exdate" style="padding: 5px" value="<?php echo $operationData['exdate'] ?>" class="form-control" <?php if ($operationData['status'] == '2') { ?> readonly <?php } ?>>-->
                    <!--  </div>-->
                    <!--</div>-->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>B/L&nbsp;or&nbsp;AWB&nbsp;#</label>
                        <input type="text" name="bill" style="padding: 5px" value="<?php echo $operationData['bill'] ?>" class="form-control" <?php if ($operationData['status'] == '2') { ?> readonly <?php } ?>>
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="form-group">
                        <label>To&nbsp;Port</label>

                        <select name="port" id="port" class="form-control">

                          <option value="1" <?php if ($operationData['toport'] == '1') { ?> selected <?php } ?>>By Air</option>
                          <option value="2" <?php if ($operationData['toport'] == '2') { ?> selected <?php } ?>>By Road</option>

                          <option value="3" <?php if ($operationData['toport'] == '3') { ?> selected <?php } ?>>By Train</option>

                        </select>
                      </div>
                    </div>




                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Orignal&nbsp;Ex-Factory</label>
                        <div id="orignalexfactory">
                          <input type="text" name="orgexfactory" style="padding: 5px" value="<?php echo $operationData['orignalexfactory'] ?>" class="form-control" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Actual&nbsp;Ex-Factory</label>
                        <input type="date" name="actualexfactory" style="padding: 5px" value="<?php echo $operationData['actualexfactory'] ?>" class="form-control" <?php if ($operationData['status'] == '2') { ?> readonly <?php } ?>>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Orignal&nbsp;Shipmode</label>
                        <div id="shipmode">
                          <input type="text" id="orgshipmode" name="orgshipmode" style="padding: 5px" value="<?php echo $operationData['orignalshipmode'] ?>" class="form-control" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Actual&nbsp;Shipmode</label>
                        <select name="actualshipmode" id="actualshipmode" class="form-control">

                          <option value="Sea" <?php if ($operationData['actualshipmode'] == 'Sea') { ?> selected <?php } ?>>Sea</option>
                          <option value="Air" <?php if ($operationData['actualshipmode'] == 'Air') { ?> selected <?php } ?>>Air</option>
                          <option value="Road" <?php if ($operationData['actualshipmode'] == 'Road') { ?> selected <?php } ?>>Road</option>

                        </select>
                      </div>
                    </div>



                  </div>
                </div>
              </div>
              <script>
                $(function() {
                  $("#exdate").datepicker();
                });
              </script>
              <br>
              <table class="table table-responsive table-bordered" style="font-size: 12px;">
                <thead style="background-color: #f9f8f8;">
                  <tr class="border-top-info" style="background-color: #9aabff;">
                    <th>&nbsp;</th>
                    <th style="text-align:center; color:#fff;padding:5px 45px;">CTN&nbsp;No</th>
                    <th style="text-align:center; color:#fff;padding: 5px 30px;">Carton&nbsp;ID</th>
                    <th style="text-align:center; color:#fff;">Color&nbsp;Code</th>
                    <th style="text-align:center; color:#fff;">Color</th>
                    <th colspan="8" align="center" style="text-align:center; color:#fff;">Size</th>
                    <th style="text-align:center; color:#fff;">Qty/CTN</th>
                    <th style="text-align:center; color:#fff;">No.&nbsp;of&nbsp;CTNS</th>
                    <th style="text-align:center; color:#fff;">Total&nbsp;Qty</th>
                    <th style="text-align:center; color:#fff;">CTN&nbsp;Wt.</th>
                    <th style="text-align:center; color:#fff;padding: 5px 30px;">CTN&nbsp;Dimensions</th>
                    <th style="text-align:center; color:#fff;">Box&nbsp;Wt.</th>
                    <th style="text-align:center; color:#fff;">Net&nbsp;Wt.</th>
                    <th style="text-align:center; color:#fff;">G.&nbsp;Wt.</th>
                    <th style="text-align:center; color:#fff;">N.&nbsp;N.&nbsp;Wt.</th>
                    <th style="text-align:center; color:#fff;">NET&nbsp;NET&nbsp;Wt.</th>
                    <th style="text-align:center; color:#fff;">SIZE&nbsp;ONE</th>
                  </tr>
                  <tr class="border-top-info">
                    <th align="center">
                      <div align="center"><a onClick="addNewRow(1);" style="color:#0000FF; cursor: pointer;">+Add&nbsp;New</a></div>
                    </th>
                    <th>
                      <div align="center">From&nbsp;-&nbsp;To</div>
                    </th>
                    <th>
                      <div align="center">From&nbsp;-&nbsp;To</div>
                    </th>
                    <th>
                      <div align="center">&nbsp;</div>
                    </th>
                    <th>
                      <div align="center">&nbsp;</div>
                    </th>
                    <th>
                      <div align="center">XXS</div>
                    </th>
                    <th>
                      <div align="center">XS</div>
                    </th>
                    <th>
                      <div align="center">S</div>
                    </th>
                    <th>
                      <div align="center">M</div>
                    </th>
                    <th>
                      <div align="center">L</div>
                    </th>
                    <th>
                      <div align="center">XL</div>
                    </th>
                    <th>
                      <div align="center">XXL</div>
                    </th>
                    <th>
                      <div align="center">XXXL</div>
                    </th>
                    <th>
                      <div align="center"></div>
                    </th>
                    <th>
                      <div align="center"></div>
                    </th>
                    <th>
                      <div align="center"></div>
                    </th>
                    <th>
                      <div align="center">Kgs</div>
                    </th>
                    <th>
                      <div align="center">L * W * H
                        <select name="uom" <?php if ($operationData['status'] == '2') { ?> disabled <?php } ?>>
                          <option value="1" <?php if ($operationData['uom'] == '1') {
                                              echo "selected";
                                            } ?>>cms</option>
                          <option value="2" <?php if ($operationData['uom'] == '2') {
                                              echo "selected";
                                            } ?>>inches</option>
                        </select>
                      </div>
                    </th>
                    <th>
                      <div align="center">Kgs</div>
                    </th>
                    <th>
                      <div align="center">Kgs</div>
                    </th>
                    <th>
                      <div align="center">Kgs</div>
                    </th>
                    <th>
                      <div align="center">Kgs</div>
                    </th>
                    <th>
                      <div align="center">per&nbsp;pcs</div>
                    </th>
                    <th>
                      <div align="center">per&nbsp;pcs</div>
                    </th>

                  </tr>
                </thead>
                <script>
                  var comsepval = '';
                </script>

                <tbody id="addrow"></tbody>

                <script>
                  function addNewRow(id) {
                    if (id == 1) {
                      $("#addrow").load('loadpackinglist.php?add=1&parentId=<?php echo encode($gateLastId); ?>&costsheetVersionId=1');
                    } else {
                      $("#addrow").load('loadpackinglist.php?parentId=<?php echo encode($gateLastId); ?>');
                    }

                  }
                  addNewRow(0);

                  function deleteRow(id) {
                    var checkyes = confirm('Are your sure you you want to delete?');
                    if (checkyes == true) {
                      $('#addrow').load('loadpackinglist.php?id=' + id + '&deletestatus=yes&parentId=<?php echo encode($gateLastId); ?>');
                    }
                  }
                </script>


                <tr class="border-top-info" style="font-weight: 500; font-size: 13px;">
                  <th align="center">
                    <div align="center"></div>
                  </th>
                  <th>
                    <div align="center"> </div>
                  </th>
                  <th>
                    <div align="center"> </div>
                  </th>
                  <th>
                    <div align="center"> </div>
                  </th>
                  <th>
                    <div align="center"> </div>
                  </th>
                  <th>
                    <div align="center" id="xxsmall">0</div>
                  </th>
                  <th>
                    <div align="center" id="extrasmall">0</div>
                  </th>
                  <th>
                    <div align="center" id="small">0</div>
                  </th>
                  <th>
                    <div align="center" id="medium">0</div>
                  </th>
                  <th>
                    <div align="center" id="large">0</div>
                  </th>
                  <th>
                    <div align="center" id="extralarge">0</div>
                  </th>
                  <th>
                    <div align="center" id="extraextralarge">0</div>
                  </th>
                  <th>
                    <div align="center" id="extraextralarge3xl">0</div>
                  </th>
                  <th>
                    <div align="center"></div>
                  </th>
                  <th>
                    <div align="center" id="totalcontainer"></div>
                  </th>
                  <th>
                    <div align="center" id="totalqtyid">0</div>
                  </th>
                  <th>
                    <div align="center" id="netwt"></div>
                  </th>
                  <th>
                    <div align="center"></div>
                  </th>
                  <th>
                    <div align="center"></div>
                  </th>
                  <th>
                    <div align="center" id="netweight"></div>
                  </th>
                  <th>
                    <div align="center" id="gweight"></div>
                  </th>
                  <th>
                    <div align="center" id="nnweight"></div>
                  </th>
                  <th>
                    <div align="center"></div>
                  </th>
                  <th>
                    <div align="center"></div>
                  </th>
                </tr>

              </table>
              <br>
              <button type="submit" class="btn btn-primary" style="float:right">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>
            </form>
            <br>
            <br>
            <br>
            <div class="row">
              <div class="col-md-6">
                <table class="table table-bordered" width="100%">
                  <tr style="background-color: #fdffe0;">
                    <th>
                      <div align="center">Length</div>
                    </th>
                    <th>
                      <div align="center">Width</div>
                    </th>
                    <th>
                      <div align="center">Height</div>
                    </th>
                    <th>
                      <div align="center">No.&nbsp;of&nbsp;CTN</div>
                    </th>
                    <th>
                      <div align="center">CBM</div>
                    </th>
                    <th>
                      <div align="center">Vol.</div>
                    </th>
                  </tr>
                  <?php
                  $rrp = GetPageRecord('length,breadth,height,SUM(contNo) AS totalctn', 'loadpackinglistmaster', 'parentId="' . decode($_GET['id']) . '" group by length,breadth,height');
                  while ($operation = mysqli_fetch_array($rrp)) {
                  ?>
                    <tr>
                      <td>
                        <div align="center"><?php echo $operation['length'] ?></div>
                      </td>
                      <td>
                        <div align="center"><?php echo $operation['breadth'] ?></div>
                      </td>
                      <td>
                        <div align="center"><?php echo $operation['height'] ?></div>
                      </td>
                      <td>
                        <div align="center"><?php
                                            echo $operation['totalctn'];
                                            ?></div>
                      </td>
                      <td>
                        <div align="center">
                          <?php
                          if ($operationData['uom'] == '1') {
                            $totalcbm = ($operation['length'] * $operation['breadth'] * $operation['height'] * $operation['totalctn']) / 6000;
                          } else {
                            $totalcbm = ($operation['length'] * $operation['breadth'] * $operation['height'] * $operation['totalctn']) / 366;
                          }
                          echo round($totalcbm, 2);
                          ?>
                        </div>
                      </td>
                      <td>
                        <div align="center">
                          <?php
                          $totalcbm = ($operation['length'] * $operation['breadth'] * $operation['height'] * $operation['totalctn']) / 6000;
                          echo round($totalcbm, 2);
                          ?>
                        </div>
                      </td>

                    </tr>
                  <?php } ?>

                </table>
              </div>
              <div class="col-md-6">
                <table class="table table-bordered" width="100%">
                  <tr style="background-color: #fdffe0;">
                    <td colspan="2">
                      <div align="center" style="color: black;font-weight: 600">Summary</div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div>Total Qty Units </div>
                    </td>
                    <td>
                      <div id="totalqtyid1"></div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div>Total Gross Wt.(kgs) </div>
                    </td>
                    <td>
                      <div id="gweight1"></div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div>Total Net Wt.(kgs) </div>
                    </td>
                    <td>
                      <div id="netweight1"></div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div>Total Net Net wt.(kgs) </div>
                    </td>
                    <td>
                      <div id="nnweight1"></div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div>Total Cartons</div>
                    </td>
                    <td>
                      <div id="totalcontainer1"></div>
                    </td>
                  </tr>

                </table>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-12">
                <div id="purchaselist"></div>
              </div>
            </div>


            <script>
              function changepurchase(purchase) {
                $('#purchaselist').load('loadbrand.php?purchase=' + purchase + '&action=changepurchase');

              }
              changepurchase(<?php echo $operationData['purchaseNo']; ?>);
            </script>




            <script>
              function changeexfactory(purchases) {




                $('#orignalexfactory').load('loadbrand.php?purchaseex=' + purchases + '&action=orignalexfactory');


                $('#poqty').load('loadbrand.php?poqty=' + purchases + '&action=poqtys');



                $('#shipmode').load('loadbrand.php?shipmode=' + purchases + '&action=shipmodes');



              }
            </script>


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

  .btn-float i {
    display: block;
    top: 0;
    font-size: 20px;
  }

  .card-group-control-right .card-body {
    width: 100%;
  }
</style>