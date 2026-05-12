<?php
include "inc.php";

if ($_REQUEST['factoryId'] != '' && $_REQUEST['factoryId'] > 0 && $_REQUEST['styleid'] != '') {
  deleteRecord('linePlanMaster', 'styleId="' . $_REQUEST['styleid'] . '"');
}

$effvalue = 0;
$efficiencyno = 0;
$abcd = 0;
$totalcountinsert = 0;
$select = '*';
$where = 'id="' . ($_GET['styleid']) . '"';
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

$rsqty = GetPageRecord('*', 'buyerPurchaseOrderMaster', 'styleId="' . $editresultstyle['id'] . '"');
$resultqty = mysqli_fetch_array($rsqty);
$totalstylequantity = $resultqty['qtyTotal'];

$f = GetPageRecord('*', 'factoryMaster', ' id="' . $_REQUEST['id'] . '" order by id asc');

$no = 1;
$mainvaluedaywise = 0;

$finalavg = 0;
$countforavg = 0;

while ($factoryData = mysqli_fetch_array($f)) {

  $finalvalue = 0;

  $abcfinalcheck = 0;

?>

  <tr>
    <td colspan="5" style="padding:0px; border-top: 0px solid #ddd;">
      <div style="padding:10px; font-size:16px; font-weight:600; background-color:#F8F8F8; margin-top:10px; position: relative;">
        <?php

        $totaldays = (strtotime($_GET['endDate']) - strtotime($_GET['startDate'])) / 60 / 60 / 24;


        if ($totaldays == 1) {
          $totaldays = $totaldays;
        } else {
          $totaldays = $totaldays + 1;
        }

        $rk = GetPageRecord('*', 'factoryLineMaster', '1 and factoryId="' . $factoryData['id'] . '" order by id asc');
        while ($lineData = mysqli_fetch_array($rk)) {
          ${"line" . $lineData['id']} = '0';
        }

        $sortingline = '';
        $kk = 'select count(id) as totalline,lineId from linePlanMaster where lineId in (select id from factoryLineMaster where factoryId="' . $factoryData['id'] . '")  and uploadInputDate between "' . date('Y-m-d', strtotime($_GET['startDate'])) . '" and "' . date('Y-m-d', strtotime($_GET['endDate'])) . '" and factoryId="' . $factoryData['id'] . '"  group by lineId order by totalline asc';

        $km = mysql_query($kk);

        while ($tlinek = mysqli_fetch_array($km)) {

          ${"line" . $tlinek['lineId']} = $totaldays - $tlinek['totalline'];
          $sortingline .= '"' . $tlinek['lineId'] . '",';
        }

        $sorting = rtrim($sortingline, ',');

        if ($sorting == '') {
          $sorting = 1;
        }

        echo $factoryData['name'];

        //===================================================================================================================
$weekend='';
$kr='';
$holidayData='';
$krkr='';
$holidayDataa='';
$holidays='';
$totalholidays='';
$countallsunday='';

$kr=GetPageRecord('*','holidayMaster','1 and factoryId="'.$factoryData['id'].'" order by id desc');
while($holidayData=mysqli_fetch_array($kr)){
  if($holidayData['holidayType']==1){
    $weekend=$holidayData['days'];
  }
}

$krkr=GetPageRecord('*','holidayMaster','1 and factoryId="'.$factoryData['id'].'" and startDate>="'.date('Y-m-d',strtotime($_REQUEST['startDate'])).'" and endDate<="'.date('Y-m-d',strtotime($_REQUEST['endDate'] . ' +1 day')).'"  and holidayType=2');
while($holidayDataa=mysqli_fetch_array($krkr)){

$begin = new DateTime($holidayDataa['startDate']);

$end = new DateTime($holidayDataa['endDate']);
$end = $end->modify( '+1 day' );

$interval = new DateInterval('P1D');

$daterange = new DatePeriod($begin, $interval ,$end);

foreach($daterange as $date){
    $holidays.=$date->format("Y-m-d").",";
}

}

$start_date=strtotime(date('Y-m-d',strtotime($_REQUEST['startDate'])));
$end_date=strtotime(date('Y-m-d',strtotime($_REQUEST['endDate'] . ' +1 day')));

while(1){
  $start_date=strtotime('next '.$weekend.'', $start_date);
  if($start_date>$end_date)
    break;
   $countallsunday.=date("Y-m-d",$start_date).', ';
}

$totalholidays=$countallsunday.$holidays;

//============================================================================================================================
        ?>

        <div style="position: relative; display: inline-block; background-color: #ffe599; padding: 5px 15px; font-size: 13px; margin-left: 15px; border: 1px solid #fff;">Avg. PC/Day - <span id="avgid<?php echo $factoryData['id']; ?>"></span></div>

        <span style="position: absolute; right: 6px;">

          <a onclick="makeFinalCost<?php echo $factoryData['id']; ?>();" class="btn bg-teal-400 addnotify" style="background-color: #ff585d; margin: 0px; cursor:pointer;">Make Final</a>
          <span id="save<?php echo $factoryData['id']; ?>"></span>
        </span>

        <script>
          function makeFinalCost<?php echo $factoryData['id']; ?>() {

            var r = confirm("Are you sure you want to make it final?");
            if (r == true) {
             parent.window.location.href = 'showpage.crm?module=projectionplan';
             //parent.window.location.href = 'showpage.crm?module=lineallotmentplan&add=yes&styleid=<?php echo encode($_REQUEST['styleid']); ?>&startDate=<?php echo $_REQUEST['startDate']; ?>&endDate=<?php echo $_REQUEST['endDate']; ?>&search=Search&factoryId=<?php echo $_REQUEST['id']; ?>';

            }
          }
        </script>

      </div>

    </td>

  </tr>

  <tr>
    <td style="width:100%; padding:0px;    border-top:0px solid #ddd;">
      <div style="max-width:1260px; overflow:hidden;">
        <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" class="table-responsive" style="font-size:11px !important;">

          <tr height="17" style="background-color:#ece9e9; font-weight:500; text-align:center;">
            <?php
            $capacity = 0;
            $effe = 0;
            $l = GetPageRecord('*', 'factoryLineMaster', '1 and factoryId="' . $factoryData['id'] . '"  ORDER BY FIELD(id, ' . $sorting . ')');
            while ($lineData = mysqli_fetch_array($l)) {
              $capacity = $lineData['minuteCapacity'] / $editresultstyle['smv'];
              $effe = ($editresultstyle['efficiency'] * $capacity) / 100;

              $ll = GetPageRecord('*', 'smvMaster', '1 and fromsmv<="' . $editresultstyle['smv'] . '" and  tosmv>="' . $editresultstyle['smv'] . '"');
              $smvData = mysqli_fetch_array($ll);

              $mm = GetPageRecord('*', 'slabMaster', '1 and id="' . $smvData['slabId'] . '"');
              $smvname = mysqli_fetch_array($mm);

            ?>
              <td colspan="4">
                <div style="padding:5px;"><?php echo $lineData['lineName']; ?></div>
              </td>
            <?php } ?>
          </tr>
          <tr>
            <?php
            $l = GetPageRecord('*', 'factoryLineMaster', '1 and factoryId="' . $factoryData['id'] . '"  ORDER BY FIELD(id, ' . $sorting . ')');
            while ($lineData = mysqli_fetch_array($l)) {
            ?>
              <td style="width:89px;text-align:center;">
                <div style="padding:7px 0px">Date</div>
              </td>
              <td style="width:131px;text-align:center;">
                <div style="padding:7px 0px">Brand</div>
              </td>
              <td style="width:64px;text-align:center;">
                <div style="padding:7px 0px">Day</div>
              </td>
              <td style="width:69px;text-align:center;">
                <div style="padding:7px 0px">Till Date</div>
              </td>
            <?php } ?>
          </tr>

          <tr height="17">

            <?php

            $countremain = 0;
            $total = 0;
            $countdays = 0;
            $setstyledata = 0;
            $capacity = 0;
            $effe = 0;
            $slab = 0;
            $daterango = 0;
            $lineData = '';
            $l = '';
            $l = GetPageRecord('*', 'factoryLineMaster', '1 and factoryId="' . $factoryData['id'] . '"  ORDER BY FIELD(id, ' . $sorting . ')');
            while ($lineData = mysqli_fetch_array($l)) {
            ?>

              <td align="center" valign="middle" colspan="4">

                <table width="100%" class="table-responsive" style="font-size:11px !important;">
                  <?php
                  $startDate = date('Y-m-d', strtotime($_REQUEST['startDate']));
                  $endDate = date('Y-m-d', strtotime($_REQUEST['endDate'] . ' +1 day'));

                  $begin = new DateTime($startDate);
                  $end = new DateTime($endDate);

                  $interval = DateInterval::createFromDateString('1 day');
                  $period = new DatePeriod($begin, $interval, $end);

                  $sr = 0;
                  foreach ($period as $dt) {

                    $dateValue = $dt->format("d-m-Y");

                    $currdataVal = date('Y-m-d', strtotime($dateValue));

                    if (strpos($totalholidays, $currdataVal) === false) {

                      $abc = $startDate;

                      $k = GetPageRecord('*', 'linePlanMaster', '1 and factoryId="' . $factoryData['id'] . '" and lineId="' . $lineData['id'] . '" and uploadInputDate="' . $abc . '"');

                      $showstylecolor = mysqli_fetch_array($k);

                      $kkkkkkk = GetPageRecord('*', 'queryMaster', '1 and id="' . $showstylecolor['styleId'] . '"');
                      $queryData = mysqli_fetch_array($kkkkkkk);

                      $countrow = mysqli_num_rows($k);

                      $km = GetPageRecord('*', 'linePlanMaster', '1 and factoryId="' . $factoryData['id'] . '" and lineId="' . $lineData['id'] . '" order by uploadInputDate desc');
                      $getlinedate = mysqli_fetch_array($km);

                      if ($getlinedate != '') {
                        //echo $abccccc = date('Y-m-d', strtotime("+1 day", strtotime($getlinedate['uploadInputDate']))).'++++';
                        $abccccc = date('Y-m-d', strtotime($_GET['startDate']));
                      } else {
                        $abccccc = date('Y-m-d', strtotime($_GET['startDate']));
                      }

                      if ($setstyledata == 0) {
                        $setstyledata = $lineData['id'];
                        $countdays++;
                      }

                      $lastdate = date('Y-m-d', strtotime($_GET['endDate']));

                      $countremain = (strtotime($lastdate) - strtotime($abccccc)) / 60 / 60 / 24;

                      /*
                      $capacity = $lineData['minuteCapacity'] / $editresultstyle['smv'];
                      $effe = ($editresultstyle['efficiency'] * $capacity) / 100;

                      $ll = GetPageRecord('*', 'smvMaster', '1 and fromsmv<="' . $editresultstyle['smv'] . '" and  tosmv>="' . $editresultstyle['smv'] . '"');
                      $smvData = mysqli_fetch_array($ll);

                      //echo '1 and id="'.$smvData['slabId'].'"';
                      $mm = GetPageRecord('*', 'slabMaster', '1 and id="' . $smvData['slabId'] . '"');
                      $smvname = mysqli_fetch_array($mm);

                      if ($abccccc == $abc) {
                        $efficiencyno = 1;
                      }
                      if ($efficiencyno <= $countremain + 1) {
                        if ($efficiencyno != 0) {

                          $effvalue = $efficiencyno++;
                          //echo '1 and parentId="'.$smvname['id'].'" and days="'.$effvalue.'"';
                          $rr = GetPageRecord('*', 'slabMaster', '1 and parentId="' . $smvname['id'] . '" and days="' . $effvalue . '"');
                          $smvdayefficiency = mysqli_fetch_array($rr);

                          if ($smvdayefficiency != '') {
                            $mainvaluedaywise = ($capacity * $smvdayefficiency['efficiency']) / 100;
                          } else {
                            $mainvaluedaywise = $capacity;
                          }

                          $finalvalue = $finalvalue + $mainvaluedaywise;

                          $totalstylequantity = $totalstylequantity - $mainvaluedaywise;


                          if ($totalstylequantity < 0) {
                            ++$abcfinalcheck;
                          }
                        }
                      }*/
                    }


                    $whereN='styleId="'.$_REQUEST['styleid'].'" and uploadInputDate="'.$currdataVal.'" and factoryId="'.$factoryData['id'].'" and lineId="'.$lineData['id'].'"';
                    $rsd=GetPageRecord('*','linePlanMaster',$whereN);
                    $rsList=mysqli_fetch_array($rsd);
                  ?>
                    <tr>


                      <?php if ($countrow == 0) {

                        if ($totalstylequantity > 0 || $abcfinalcheck == 1) {

                          $uploadInputDate = date('Y-m-d', strtotime($dt->format("d-m-Y")));


                          if (strpos($totalholidays, $currdataVal) === false) {

                            // if (trim($editresultstyle['subject']) != '' && $_REQUEST['factoryId'] != '' && $_REQUEST['factoryId'] > 0 && $_REQUEST['styleid'] != '') {
                            //   ${"line" . $lineData['id']} .= '@@@ insert into linePlanMaster set styleId="' . $_GET['styleid'] . '",uploadInputDate="' . $uploadInputDate . '",factoryId="' . $_REQUEST['factoryId'] . '",lineId="' . $lineData['id'] . '",dateWiseLineInput="' . $mainvaluedaywise . '",linewiseefficiency="' . $finalvalue . '"';
                            // }
                          }
                        }
                      }

                      ?>

                      <td <?php if (strpos($totalholidays, $currdataVal) !== false) { ?> style="background-color: #d6e7ff; color: #000;" <?php }  ?>>
                        <div style="min-height:49px;vertical-align: middle;padding-top: 18px; width:70px;"><?php echo $dt->format("d-m-Y");  ?>
                        <input type="hidden" name="uploadDate_<?php echo $_REQUEST['id']; ?>_<?php echo $lineData['id']; ?>" id="uploadDate_<?php echo $_REQUEST['id']; ?>_<?php echo $lineData['id']; ?>_<?php echo $sr; ?>" value="<?php echo $dt->format("d-m-Y");  ?>" />
                      </div>
                      </td>
                      <td width="10%" style="color:#FFFFFF;<?php if ($countrow != 0) {
                                                              if (strpos($totalholidays, $currdataVal) === false) { ?>border:2px solid #ff0000;<?php }
                                                                                                                                            } ?><?php if (strpos($totalholidays, $currdataVal) !== false) {    ?>background-color: #d6e7ff; color: #000; <?php }  ?>" bgcolor="<?php if ($countrow == 0) {
                                                                                                                                                                                                                                                                                  if ($totalstylequantity > 0 || $abcfinalcheck == 1) {

                                                                                                                                                                                                                                                                                    echo $editresultstyle['styleColor'];
                                                                                                                                                                                                                                                                                  } else { ?>#F8FFC1<?php }
                                                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                                                      echo $queryData['styleColor'];
                                                                                                                                                                                                                                                                                                                    }  ?>">
                        <div style="width:120px;">
                          <?php
                          $fcref = GetPageRecord('*', 'brandMaster', 'id="' . $_REQUEST['brandId'] . '"');
                          $refData = mysqli_fetch_array($fcref);
                          echo $refData['name'];
                          if ($countrow != 0) {
                            if (strpos($totalholidays, $currdataVal) === false) {
                              echo $queryData['subject'];
                            }
                          } else {
                            if ($totalstylequantity > 0 || $abcfinalcheck == 1) {

                              if (strpos($totalholidays, $currdataVal) === false) {
                                echo $editresultstyle['subject'];
                              }

                              if (strpos($totalholidays, $currdataVal) === false) {
                                $finalavg = ++$countforavg;
                              }
                            }
                          }
                          ?>
                        </div>
                      </td>
                      <td align="center" style="border: 1px solid #ece9e9;<?php if (strpos($totalholidays, $currdataVal) !== false) { ?>background-color: #d6e7ff; color: #000; <?php }  ?>">

                        <div style="width:50px !important;">
                          <?php
                        //if ($countrow == 0) {

                          //if (strpos($totalholidays, $currdataVal) === false) {

                              //echo round($mainvaluedaywise);
                            ?>
                            <input type="text" name="uploadInput<?php echo $_REQUEST['id']; ?>_<?php echo $lineData['id']; ?>[]" onchange="funcUploadInput(<?php echo $_REQUEST['id']; ?>,<?php echo $lineData['id']; ?>,<?php echo $sr; ?>);" id="uploadInput_<?php echo $_REQUEST['id']; ?>_<?php echo $lineData['id']; ?>_<?php echo $sr; ?>" value="<?php if($rsList['dateWiseLineInput']!=''){ echo $rsList['dateWiseLineInput']; }else{ echo '0'; } ?>" style="width: 50px !important; text-align:center;" />
                            <?php
                            //}
                         //}
                          ?>
                        </div>
                      </td>
                      <td align="center" style="border: 1px solid #ece9e9;<?php if (strpos($totalholidays, $currdataVal) !== false) {    ?>background-color: #d6e7ff; color: #000; <?php }  ?>">
                        <div style="width:50px;">
                        <?php

                          //if ($countrow == 0) {
                            //if (strpos($totalholidays, $currdataVal) === false) {
                             // echo round($finalvalue);
                             ?>
                              <input type="text" name="uploadInputTotal<?php echo $_REQUEST['id']; ?>_<?php echo $lineData['id']; ?>[]" onchange="funcUploadInput(<?php echo $_REQUEST['id']; ?>,<?php echo $lineData['id']; ?>,<?php echo $sr; ?>);" id="uploadInputTotal_<?php echo $_REQUEST['id']; ?>_<?php echo $lineData['id']; ?>_<?php echo $sr; ?>" value="<?php if($rsList['linewiseefficiency']!=''){ echo $rsList['linewiseefficiency']; }else{ echo '0'; } ?>" style="width: 50px !important; text-align:center;"  />
                              <input type="hidden" name="styleId" id="styleIdnew" value="<?php echo $_REQUEST['styleid']; ?>" />
                             <?php
                            //}
                          //}
                        ?>

                        </div>
                      </td>
                      <script>
                        function funcUploadInput(factoryId,lineId,srNo){

                          const styleId = $('#styleIdnew').val();
                          let uploadDate = $('#uploadDate_'+factoryId+'_'+lineId+'_'+srNo).val();
                          let uploadInput = $('#uploadInput_'+factoryId+'_'+lineId+'_'+srNo).val();
                          var uploadInputTotal = $('#uploadInputTotal_'+factoryId+'_'+lineId+'_'+srNo).val();

                          if(srNo==0){
                             //$('#uploadInputTotal_'+factoryId+'_'+lineId+'_'+srNo).val(uploadInput);
                             //uploadInputTotal = $('#uploadInputTotal_'+factoryId+'_'+lineId+'_'+srNo).val();
                          }else{

                            var lastInputTotal = srNo-1;

                            // var lastInputTotal=0;
                            // if(lastInputTotal==NaN){
                            //   lastInputTotal = srNo-2;
                            // }else{
                            //   lastInputTotal = srNo-1;
                            // }
                            // alert(lastInputTotal);

                            //let totalofLast = $('#uploadInputTotal_'+factoryId+'_'+lineId+'_'+lastInputTotal).val();
                            //totalofLast = Number(totalofLast)+Number(uploadInput);
                            //$('#uploadInputTotal_'+factoryId+'_'+lineId+'_'+srNo).val(totalofLast);
                           // uploadInputTotal = $('#uploadInputTotal_'+factoryId+'_'+lineId+'_'+srNo).val();
                          }

                          $('#save<?php echo $factoryData['id']; ?>').load('savelinedata.php?styleId='+styleId+"&uploadInput="+uploadInput+"&uploadInputTotal="+uploadInputTotal+"&factoryId="+factoryId+"&lineId="+lineId+"&uploadDate="+uploadDate);
                        }
                      </script>
                    <?php $startDate++;
$sr++;
                  }

                  ?>
                    </tr>
                </table>
              </td>
            <?php $daterango++;
            }

            $ap = GetPageRecord('*', 'factoryLineMaster', '1 and factoryId="' . $_REQUEST['id'] . '" order by id asc');
            while ($lineeData = mysqli_fetch_array($ap)) {
              $array =  explode('@@@', ${"line" . $lineeData['id']});
              foreach ($array as $item) {
                mysql_query($item);
              }
            }
            ?>
          </tr>
          <script>
            var totalstylequantity = '<?php echo $resultqty['qtyTotal']; ?>';
            var finalavg = '<?php echo $finalavg; ?>';
            //alert(finalavg);
            var remtotal = Number(totalstylequantity / finalavg);
            remtotal = parseFloat(remtotal).toFixed(2);
            $('#avgid<?php echo $factoryData['id']; ?>').text(remtotal);
          </script>
        </table>

        <?php if ($totalstylequantity > 0) { ?>
          <script>
            $('#factorylineplan<?php echo $_GET['id']; ?>').hide();
          </script>
        <?php } ?>
      </div>
    </td>
  </tr>
<?php } ?>
<script>
  <?php if ($_REQUEST['factoryId'] != '') { ?>
    parent.window.location.href = 'showpage.crm?module=lineallotmentplan';
  <?php } ?>
</script>