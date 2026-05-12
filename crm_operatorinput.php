<div class="page-content">

  <div class="content-wrapper">

    <div class="content pt-0" style="margin-top: 20px; width: 80%; margin-left: auto; margin-right: auto;">

      <div class="row">

        <div class="col-xl-12">

          <?php if ($_GET['alt'] == 1) { ?>

            <div style='width: 100%; text-align: center; color: #00cf75; font-size: 20px; margin-bottom: 20px; font-weight: 600;' id='thanksmsg'>Updated Successfully</div>

          <?php } ?>

          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">

            <div class="col-xl-9">

              <h5 class="card-title"><?php echo $pageName; ?></h5>

            </div>

            <div class="col-xl-3" style="padding-right: 0px;">

              <div class="btn-group justify-content-center" style="float:right;"> </div>

            </div>

          </div>

          <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">

            <input name="action" type="hidden" id="action" value="saveoperatorinput" />

            <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['module']; ?>" />

            <div class="card border-left-3 border-left-danger-400 rounded-left-0" style="border: 1px solid #ccc !important;">

              <div class="card-body">

                <div class="recorder-selection">

                  <input name="fromDate" type="text" class="newDatePicker form-control" id="fromDate" value="<?php if ($editresult['fromDate'] != '') { echo date('d-m-Y', strtotime($editresult['fromDate']));  } else { echo date('d-m-Y'); } ?>">

                </div>

                <div class="recorder-selection">

                  <select class="form-control" name="factoryId" id="factoryId" onchange="selectFactory(this.value);">

                    <option value="">Select Factory</option>

                    <?php

                    /*if($_SESSION['userid']==1){

$fk=GetPageRecord('*','recorderMaster','1 group by factoryId');

}else{

$fk=GetPageRecord('*','recorderMaster','1 and userid="'.$_SESSION['userid'].'" group by factoryId');

}*/

                    $fk = GetPageRecord('*', 'factoryMaster', '1 order by name asc');

                    while ($factoryData = mysqli_fetch_array($fk)) {

                      $a = GetPageRecord('*', 'factoryMaster', 'id="' . $factoryData['id'] . '"');

                      $selectdata = mysqli_fetch_array($a); ?>

                      <option value="<?php echo $factoryData['id']; ?>"> <?php echo $selectdata['name']; ?></option>

                    <?php } ?>

                  </select>

                </div>

                <script>

                  function selectFactory(id) {

                    $('#lineselect').load('loadrecorderinputlines2.php?id=' + id +

                      '&selectId=<?php echo $editresult['line']; ?>');

                  }

                </script>

                <div class="recorder-selection">

                  <div id="loadrecorderinputlines">

                    <select class="form-control" name="line" id="lineselect" onchange="selectDataStyle(this.value);">

                      <option value="">Select Line</option>

                    </select>

                  </div>

                </div>

                <script>

                  function selectDataStyle(lineid) {

                    var factoryId = $('#factoryId').val();

                    var line = lineid;

                    var fromDate = $('#fromDate').val();



                    $('#loadrstyleinfo').load('loadstyleinfo.php?factoryId=' + factoryId + '&line=' + line + '&fromDate=' + fromDate);



                  }

                </script>

              </div>

              <div class="">

                <div class="col-xl-12" style="padding: 5px 21px;">

                  <div id="loadrstyleinfo"></div>

                </div>

              </div>

              <div class="card-body" style="border:0px !important;">

                <div class="col-xl-12">

                  <h6>Stock Movement

                    <div class="media mbdn" style="width: 20% !important; display:none;">

                      <div class="media-body">

                        <select name="stockType" class="form-control" id="stockType" required>

                          <option>Stock Type</option>

                          <option value="1">New Stock</option>

                          <option value="2">Alter Stock</option>

                        </select>

                      </div>

                    </div>

                  </h6>

                  <div class="media" style="background-color: #fbfbfb; padding: 15px; margin-top:0px;">



                    <div class="media-body"> <span class="text-muted">Stock In-hand</span><br>

                      <input class="dsInp" type="text" name="stockInHand" id="stockInHand" value=""  readonly>

                    </div>



                    <div class="media-body seq1"> <span class="text-muted">Received From</span><br>

                      <input class="dsInp" type="text" id="receivedFromName" value=""  readonly>

                      <input class="dsInp" type="hidden" name="receivedFrom" id="receivedFrom" value="">

                    </div>



                    <div class="media-body seq1"> <span class="text-muted">Received Qty.</span><br>

                      <input class="dsInp" type="text" name="receivedQty" id="receivedQty"  readonly>

                    </div>



                    <div class="media-body"> <span class="text-muted">Transfer To</span><br>

                      <input class="dsInp" type="text" id="transferToName" value=""  readonly>

                      <input type="hidden" name="transferTo" id="transferTo" value="">

                      <input type="hidden" name="sequenceNo" id="sequenceNo" value="">

                    </div>



                    <div class="media-body"> <span class="text-muted">From Serial#</span><br>

                      <input class="dsInp" type="text" name="fromSerial" id="fromSerial" >

                    </div>

                    <div class="media-body"> <span class="text-muted">To Serial#</span><br>

                      <input class="dsInp" type="text" name="toSerial" id="toSerial" >

                    </div>



                    <div class="media-body"> <span class="text-muted">Transfer Qty.</span><br>

                      <input class="dsInp" type="text" name="transferQty" id="transferQty" >

                    </div>



                    <div class="media-body"> <span class="text-muted">&nbsp;</span><br>

                      <input class="dsInp" type="button" value="Add Data" id="btnclick" style="background: #0cc21a; color: white;" onclick="saveinputdata();">

                      <input type="hidden" id="editid" />

                      <input type="hidden" name="status" id="status" value="" />

                    </div>

                  </div>



                  <script>

                    function saveinputdata() {



                      const editid = $('#editid').val();

                      const status = $('#status').val();

                      const styleId = $('#styleId').val();

                      const stockInHand = $('#stockInHand').val();

                      const receivedFrom = $('#receivedFrom').val();

                      const receivedQty = $('#receivedQty').val();

                      const transferTo = $('#transferTo').val();

                      const sequenceNo = $('#sequenceNo').val();

                      var fromSerial = $('#fromSerial').val();

                      var toSerial = $('#toSerial').val();

                      const line = $('#lineselect').val();

                      const factoryId = $('#factoryId').val();

                      const fromDate = $('#fromDate').val();



                      /////////for defect update////////////

                      const defectEditid = $('#defectEditid').val();

                      const defectStatus = $('#defectStatus').val();

                      /////////for defect update////////////



                      if (fromSerial != '' && toSerial != '') {

                        let totaltransfer = Number(toSerial - fromSerial) + 1;

                        $('#transferQty').val(totaltransfer);

                      }

                      var transferQty = $('#transferQty').val();

                      if(sequenceNo!=1){
                        if(stockInHand==0){
                          fromSerial = "";
                          toSerial = "";
                          var transferQty = "";
                          //alert("You can not transfer quantity when stock in hand is 0");
                        }
                      }

                      $("#loadinputdata").load('loadinputdata.php?action=loadinputdata&styleId=' + styleId + '&stockInHand=' + stockInHand + '&receivedFrom=' + receivedFrom + '&receivedQty=' + receivedQty + '&transferTo=' + transferTo + '&sequenceNo=' + sequenceNo + '&fromSerial=' + fromSerial + '&toSerial=' + toSerial + '&transferQty=' + transferQty + '&line=' + line + '&factoryId=' + factoryId + '&fromDate=' + fromDate + '&editid=' + editid + '&status=' + status);



                      $("#loaddefectdata").load('loadinputdata.php?action=loaddefectdata&styleId='+styleId+"&defectEditid="+defectEditid+"&defectStatus="+defectStatus);

                      $('#fromSerial').val("");
                      $('#toSerial').val("");
                      $('#transferQty').val("");


                    }



                  </script>



                  <div class="scrlData" style="background-color: #fbfbfb; margin-top:0px;">

                    <table class="stckmnt" border="1" cellpadding="5px" style=" border: 1px solid #ccc;">

                      <thead>

                        <tr style="background-color: #eded9c;">

                          <td>Seq#</td>

                          <!-- <td>Stock In-hand</td> -->

                          <td>Received From</td>

                          <td>Received Qty.</td>

                          <td>Transfer To</td>

                          <td>From Serial#</td>

                          <td>To Serial#</td>

                          <td>Transfer Qty.</td>

                          <td>Status</td>

                          <td>Date</td>

                        </tr>

                      </thead>

                      <tbody id="loadinputdata"></tbody>

                    </table>

                  </div>

                  <br/>



                  <div class="media hidediv" style="background-color: #fbfbfb; padding: 15px; margin-top:0px; display:none;">

                    <div class="media-body"> <span class="text-muted">Total Check</span><br>

                      <input type="text" name="totalCheck" id="totalCheck" value="">

                    </div>

                    <div class="media-body "> <span class="text-muted">Pass</span><br>

                      <input type="text" name="pass" id="pass" value="">

                    </div>

                    <div class="media-body "> <span class="text-muted">Fail</span><br>

                      <input type="text" name="fail" id="fail" value="">

                    </div>

                    <div class="media-body"> <span class="text-muted">Transfer To</span><br>

                      <select class="dsInp" name="transferTo2" id="transferTo2">

                        <option>Operator</option>

                        <?php

                        $rs = GetPageRecord('id,name', 'employeeMaster', '1 and status=1 and empType=2 || empType=3 || empType=1 order by name asc ');

                        while ($resListing = mysqli_fetch_array($rs)) {

                        ?>

                          <option value="<?php echo $resListing['id'] ?>" <?php if ($resListing['id'] == $rsListData['operatorId']) { echo "selected"; } ?>><?php echo strip($resListing['name']); ?></option>

                        <?php } ?>

                      </select>

                    </div>

                    <div class="media-body"> <span class="text-muted">Transfer Qty.</span><br>

                      <input type="text" name="transferQty2" id="transferQty2">

                    </div>

                  </div>

                  <br/>



                  <span>Defect Details: </span>

                  <div class="scrlData " style="background-color: #fbfbfb;margin-top:0px;">

                  <input type="hidden" id="defectStatus" value="" />

                  <input type="hidden" id="defectEditid" value="" />

                    <table class="stckmnt" border="1" cellpadding="5px" style=" border: 1px solid #ccc;">

                      <thead>

                        <tr style="background-color: #eded9c;">

                          <td>Order Wise#</td>

                          <td>Ticket#</td>

                          <td>Color</td>

                          <td>Size</td>

                          <td>Remark</td>

                          <td>Date</td>

                          <td>Action</td>

                        </tr>

                      </thead>

                      <tbody id="loaddefectdata">



                      </tbody>

                    </table>

                  </div>

                  <br/>







                  <?php $addno = 1;

                  if ($addno == 1) { ?>





                    <div class="media hidediv " style="background-color: #fbfbfb; padding: 15px; margin-top:0px; display:none;" id="partyAddrsId1">

                        <!--<div class="mobdivInp">-->

                          <div class="media-body">

                            <input type="text" name="orderWiseNo1" value="" placeholder="Order Wise No.">

                          </div>

                          <div class="media-body ">

                            <input type="text" name="ticketNo1" value="" placeholder="Ticketing No.">

                          </div>

                          <div class="media-body ">

                            <input type="text" name="color1" value="" placeholder="Color">

                          </div>

                          <div class="media-body">

                            <input type="text" name="size1" value="" placeholder="Size">

                          </div>

                        <!--</div>-->

                          <div class="media-body dsInp">

                            <select name="remark1[]" class="select2 dsInp" multiple>

                              <option value="" disabled>Select</option>

                              <?php

                              $rsdefect = GetPageRecord('id,name','inspectionDefectMaster', '1 and defectType=6 order by name asc');

                              while ($resListingdefect = mysqli_fetch_array($rsdefect)) {

                              ?>

                              <option value="<?php echo $resListingdefect['id']; ?>"><?php echo $resListingdefect['name']; ?></option>

                              <?php } ?>

                            </select>

                          </div>

                          <div class="media-body"> <i class="fa fa-plus" aria-hidden="true" onClick="addPartyAdd();" style="font-size: 17px; margin-left: 40px; margin-top: 3px; cursor:pointer;"></i> </div>

                        </div>

                  <?php } ?>

                  <input name="addcount" type="hidden" id="addcount" value="<?php if ($addno == 1) { echo '1'; } else { echo $addno; } ?>" />

                  <script>

                    function addPartyAdd() {

                      var addcount = $('#addcount').val();

                      //alert(addcount);

                      addcount = Number(addcount) + 1;

                      $.get("loaddefectdetail.php?id=" + addcount, function(data) {

                        $("#loadpartyaddress").append(data);

                      });

                      $('#addcount').val(addcount);

                      $

                    }



                    function removeAddInfo(id) {

                      $('#partyAddrsId' + id).remove();

                      var addcount = $('#addcount').val();

                      addcount = Number(addcount) - 1;

                      $('#addcount').val(addcount);

                    }

                  </script>

                  <div id="loadpartyaddress"> </div>

                </div>

              </div>

              <div class="" style="width: 100%; text-align: center; margin-top: 25px;">

                <button type="submit" class="btn btn-primary" style="margin:25px;">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>

              </div>

            </div>

          </form>

        </div>

      </div>

    </div>

  </div>

</div>

<!-- /main content -->

</div>



<style>

  .recorder-selection {

    width: 24%;

    float: left;

    margin: 0px 5px;

  }



  .recorder-input {

    width: 100%;

    margin: auto;

    border: 0px !important;

  }



  .recorder-input .media-body {

    width: 22%;

    float: left;

    margin: 0px 9px;

  }



  .recorder-input input {

    width: 100%;

  }



  .recorder-input select {

    width: 100%;

  }



  .media-new {

    width: 100%;

    text-align: left;

    margin: auto;

    display: flow-root;

    background-color: #fbfbfb;

    padding: 15px;

  }



  .styleinfo .media-body {

    border: 1px solid #ccc;

    text-align: center;

    padding: 10px 0px;



  }



  .styleinfo .media-body .text-muted {

    color: #676767 !important;

  }



  /*Mohd css started Lp*/

    .dsInp{

        width: 90px !important;"

    }

    .stckmnt{

        width: 96%!important;

    }

    .scrlData{

        padding: 15px;

    }









/*Mohd css Ended Lp*/



  @media only screen and (max-width:767px) {



      /*Mohd css started Mob*/

      .scrlData{

          overflow: auto;

          padding: 5px 0px!important;

      }

      /*.mobdivInp{*/

      /*  display: grid;*/

      /*  grid-template-columns: auto auto;*/

      /*}*/



      /*Mohd css Ended Mob*/





    .pt-0 {

      width: 100% !important;

    }



    .card-body {

      width: 100% !important;

    }



    .recorder-selection {

      width: 100% !important;

      float: left !important;

      margin: 0px !important;

      margin-bottom: 10px !important;

    }



    .media {

      all: unset !important;

    }



    .media-body input {

      width: 100%!important;

      height: 30px!important;



    }

    .dsInp{

        width: 100%!important;

        height: 30px!important;

    }

    /*.select2-container {*/

    /*    width: 100%!important;*/

    /*    height: 30px!important;*/

    /*}*/

    /*.select2-selection--multiple {*/

    /*    width: 100%!important;*/

    /*    height: 30px!important;*/

    /*}*/

    /*.select2-search{*/

    /*    width: 100%!important;*/

    /*    height: 30px!important;*/

    /*}*/

    .mbdn{

        display:none!important;

    }



    .recorder-input .media-body {

      width: 100% !important;

      float: left !important;

      margin: 0px !important;

      margin-bottom: 10px !important;

    }



    textarea {

      width: 100% !important;

    }



    .media-new {

      background-color: unset !important;

      padding: 0px !important;

    }



    h5 {

      font-size: 14px;

    }

</style>