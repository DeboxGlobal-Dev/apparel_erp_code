  <?php
  //$updatepage='1';
  if ($_GET['styleid'] != '' && $_GET['editid'] != '') {
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
    $chaalanLastId = decode($_GET['editid']);
  } else {

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

    $wheredelete = 'addedBy="' . $_SESSION['userid'] . '" and status=0';
    deleteRecord('chaalanMaster', $wheredelete);

    $rs1 = GetPageRecord('id', 'chaalanMaster', '1 order by id desc');
    $lastchaalanid = mysqli_fetch_array($rs1);
    $ch = $lastchaalanid['id'];

    if ($ch == '') {
      $ch = 1;
    } else {
      $ch = $ch + 1;
    }

    $chaalanno = date('Y-d') . '/' . makeQueryId(decode($_GET['styleid'])) . '/' . makeQueryId($ch);
    $namevalue = 'addedBy="' . $_SESSION['userid'] . '",chaalanNo="' . $chaalanno . '",dateAdded="' . time() . '"';
    $chaalanLastId = addlistinggetlastid('chaalanMaster', $namevalue);
  }

  ?>


  <?php
  if ($_GET['id'] != '') {
    $rs = GetPageRecord('*', 'gateentrymaster', 'id="' . decode($_GET['id']) . '"');
    $editresult = mysqli_fetch_array($rs);
    $gateLastId = $editresult['id'];
  }
  ?>

  <style>
    .erptab tr td {

      border-top: 0px solid #ccc !important;
      padding: 0.55rem !important;
    }

    .erptab2 tr td {
      border-top: 0px solid #ccc !important;
      padding: 0.75rem !important;
    }

    .erptab1 tr td {
      border-top: 0px solid #ccc !important;
      padding: 0.40rem !important;
    }

    .erptab {
      border: 1px solid #ccc !important;
    }

    b.text {
      float: revert;
      /* float: right; */
      /* padding-left: 49px; */
      /* text-align: center; */
      display: flex;
      justify-content: center;
    }

    .content-wrapper td {

      padding-right: 6px;

    }

    .erpint {
      border: 1px solid #b3acac;
      padding: 3px;
      margin-bottom: 15px;
    }
  </style>

  <div class="page-content">
    <div class="content-wrapper">

      <?php include "savealert.php"; ?>

      <div class="content pt-0" style="margin-top:20px;">

        <table class="table erptab" style="width:100%">
          <tr style="background: #0288d1;">
            <td colspan="6">
              <div style="text-transform:capitalize;color:white;font-size: 15px;">

                <?php echo $pageName; ?>

              </div>

            </td>
          </tr>

        </table>

        <div class="row">

          <div class="col-xl-12">
            <div class="card">
              <div style="padding: 25px;">

                <?php

                if ($_GET['id'] != "") {
                  $rrrr = GetPageRecord('*', 'gateentrymaster', '1 and id="' . decode($_GET['id']) . '"');
                  $operationData = mysqli_fetch_array($rrrr);
                }

                if ($_GET['opertaiono'] != "") {
                  $rrrr1 = GetPageRecord('*', 'setSizeInspection_acesrs', '1 and inspection_no="' . decode($_GET['opertaiono']) . '"');
                  $insno = mysqli_fetch_array($rrrr1);

                  $sty = $insno['styleId'];


                  //echo $nnn; die();

                }


                // $timestamp = mt_rand(1, time());
                //             $randomDate = date("d M Y", $timestamp);
                //echo $randomDate;

                ?>


                <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">

                  <input name="editId" type="hidden" id="editId" value="<?php echo encode($insno['id']); ?>">
                  <?php if ($insno['styleId'] != "") {
                  ?>
                    <select class="form-control" name="styleId" id="styleId" style="width:50%">


                      <option value="<?php //echo $insno['id'];
                                      ?> <?php echo $insno['styleId']; ?>"><?php echo substr($sty, 2, 100);  ?></option>

                    <?php } ?>

                    </select>
                    <?php if ($insno['styleId'] == "") {
                    ?>
                      <select class="form-control" name="styleId" id="styleId" style="width:50%" onChange="selectcolorcode();">
                        <option>Select style</option>
                        <?php
                        $fcref = GetPageRecord('*', 'queryMaster', ' deleteStatus=0 and subject!="" order by id desc');
                        while ($refData = mysqli_fetch_array($fcref)) { ?>
                          <option value="<?php echo $refData['id']; ?> <?php echo $refData['styleRefId']; ?>"><?php echo $refData['styleRefId']; ?></option>
                        <?php } ?>
                      <?php } ?>
                      </select>

                      </br>
                      <br>
                      <table class="table  table-hover" style="width:100%;border:1px solid #ddd;;">
                        <tr>


                          <td style="width:26%">
                            <div style="text-transform:capitalize;"><b>Inspection No.</b></div>
                          </td>
                          <td><input style="width:100%;" type="text" class="erpint <?php if ($insno['inspection_no'] != '') {
                                                                                      echo 'readonly';
                                                                                    } ?>" name="inspection_no" id="inspection_no" placeholder="SSI-ddmmyy-0000" value="<?php echo "SSI" . "-" . date("d-m-Y") . "-" . mt_rand(1000, 2000); ?>"></td>
                          <td>
                            <div style="text-transform:capitalize;"><b>Color</b></div>
                          </td>
                          <td>

                            <?php if ($insno['color'] != "") {
                            ?>
                              <select id="colorId1" name="color" class="erpint" style="width:100%;" required>


                                <option value="<?php echo $insno['color']; ?>"><?php echo $insno['color']; ?></option>
                              <?php } ?>

                              </select>

                              <?php if ($insno['color'] == "") {
                              ?>
                                <select id="sty_data" name="color" class="erpint" style="width:100%;" required>
                                  <!--      <option value="" style="height:40px;">Select</option>-->
                                  <!--<option value="Beige">Beige</option> -->
                                  <!--<option value="Cream">Cream</option>						 -->
                                  <!--<option value="Dusty Blue">Dusty Blue</option>-->
                                </select>
                              <?php } ?>
                          </td>


                        </tr>
                        <tr>
                          <td>
                            <div style="text-transform:capitalize;"><b>Size Range</b></div>
                          </td>
                          <td>
                            <?php if ($insno['size_range'] != "") {
                            ?>

                              <select id="size_range" name="size_range" class="erpint " displayname="" style="width:100%">
                                <option value="<?php echo $insno['size_range']; ?>" <?php if ($insno['size_range'] != "") { ?> selected <?php } ?>>5 : 6 : 7 : 8 : 9 : 10 : 11</option>

                              </select>

                            <?php } ?>

                            <?php if ($insno['size_range'] == "") {
                            ?>

                              <select id="size_range" name="size_range" class="erpint " displayname="" style="width:100%">

                                <option value="#">Select</option>
                                <option value="5 : 6 : 7 : 8 : 9 : 10 : 11">5 : 6 : 7 : 8 : 9 : 10 : 11</option>
                                <option value="M">M</option>
                                <option value="S : M : L : XL">S : M : L : XL</option>
                                <option value="XS : S : M : L : XL">XS : S : M : L : XL</option>
                                <option value="XXS:XS:S:M:L:XL:XXL">XXS:XS:S:M:L:XL:XXL</option>
                              </select>

                            <?php } ?>



                          </td>


                          <td>
                            <div style="text-transform:capitalize;"><b>Date</b></div>
                          </td>

                          <td>
                            <?php if ($insno['dat'] != "") {
                            ?>
                              <input style="width:100%;" type="text" class="erpint" name="dat" value="<?php echo $insno['dat'] ?>" required readonly>
                            <?php } ?>
                            <?php if ($insno['dat'] == "") {
                            ?>
                              <input style="width:100%;" type="text" class="erpint" name="dat" id="datepicker1" value="<?php echo $insno['dat'] ?>" required>
                            <?php } ?>


                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div style="text-transform:capitalize;"><b>Done By</b></div>
                          </td>
                          <td>
                            <?php if ($insno['done_by'] != "") {
                            ?>
                              <select id="done_by" name="done_by" class="erpint" style="width:100%;">


                                <option value="<?php echo $insno['done_by']; ?>"><?php echo $insno['done_by']; ?></option>
                              <?php } ?>

                              </select>
                              <?php if ($insno['done_by'] == "") {
                              ?>
                                <select id="done_by" name="done_by" class="erpint" style="width:100%;">
                                  <option value="" style="height:40px;">Select</option>
                                  <?php
                                  $where = '1';
                                  $rs = GetPageRecord($select, 'userMaster', $where);
                                  while ($operationData = mysqli_fetch_array($rs)) {
                                  ?>
                                    <option value="<?php echo $operationData['firstName']; ?>"><?php echo $operationData['firstName']; ?></option>
                                  <?php } ?>
                                <?php } ?>

                                </select>

                          </td>
                          <td style="width:26%">
                            <div style="text-transform:capitalize;"><b>Measurement Attachment</b></div>
                          </td>
                          <td><input style="width:100%;" type="file" class="erpint" name="measurement_attach" id="measurement_attach" value="<?php echo $operationData['measurement_attach'] ?>">
                            <?php if ($insno['measurement_attach'] != '') { ?>
                              <a href="images/<?php echo $insno['measurement_attach'] ?>" target="blank">&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true" style="display: inherit;margin-right: 5px;"></i>Download</a>
                            <?php } ?>
                            <!--<img src="images/<? php // echo $insno['measurement_attach']
                                                  ?>" alt="blank" width="100" height="100" style="padding:left;">-->
                          </td>

                        </tr>

                      </table>




                      <style>
                        .table {
                          border-collapse: unset;
                        }

                        .table * :after ::before {
                          box-sizzing: unset;
                        }

                        .gt *,
                        ::after,
                        ::before {
                          box-sizing: unset;
                        }
                      </style>
                      <br>
                      <table class="table erptab" style="width:100%">
                        <tr style="background: #0288d1;">
                          <td colspan="6">
                            <div style="text-transform:capitalize;color:white;font-size: 15px;">Accessories Checklist</div>

                          </td>
                        </tr>

                      </table>
                      <div class="col-md-12">

                        <table cellspacing="0" cellpadding="0" class="table  table-hover gt" style="width:100%;border:1px solid #ddd;">
                          <col width="198" />
                          <col width="152" />
                          <col width="64" span="3" />
                          <col width="141" />
                          <col width="71" />
                          <col width="67" />
                          <col width="64" span="2" />
                          <!--<tr height="21">-->
                          <!--     <td colspan="12" height="21"><center style="font-size:17px; background-color:#0288d1; height:50px; padding:14px; color:white; text-transform: capitalize; padding-right: 775px;     text-align: left;">Accessories Checklist</center></td>-->
                          <!--<td colspan="12" height="21" width="949"><center style="font-size:17px; background-color:#0288d1; height:50px; padding:5px;-->
                          <!--color:white; text-transform: capitalize; padding-right: 1045px; text-align: left;    line-height: 20px;">Accessories Checklist</center></td>-->
                          <!--  </tr>-->

                          <tr height="20">
                            <td height="20">&nbsp;</td>
                            <td style="font-weight:bold;padding-left: 32px;">Mis.</td>
                            <td style="font-weight:bold;padding-left: 32px;">Alt.</td>
                            <td style="font-weight:bold;padding-left: 32px;">Act.</td>
                            <td style="font-weight:bold;padding-left: 32px;">Plac</td>
                            <td style="font-weight:bold;padding-left: 32px;"></td>
                            <td style="font-weight:bold;padding-left: 32px;">Mis.</td>
                            <td style="font-weight:bold;padding-left: 32px;">Alt.</td>
                            <td style="font-weight:bold;padding-left: 32px;padding-left: 32px;">Act.</td>
                            <td style="font-weight:bold;padding-left: 32px;">Plac</td>
                          </tr>


                          <tr height="20">
                            <td height="20" style="padding-left: 60px;font-weight:bold;">Main Label</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="main_label1" id="main_label1" <?php if ($insno['main_label1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="main_label2" id="main_label2" <?php if ($insno['main_label2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="main_label3" id="main_label3" <?php if ($insno['main_label3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="main_label4" id="main_label4" <?php if ($insno['main_label4'] != "") { ?> checked <?php } ?>></td>

                            <td style="padding-left:20px;font-weight:bold;">Polybag</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="polybag1" id="polybag1" <?php if ($insno['polybag1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="polybag2" id="polybag2" <?php if ($insno['polybag2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="polybag3" id="polybag3" <?php if ($insno['polybag3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="polybag4" id="polybag4" <?php if ($insno['polybag4'] != "") { ?> checked <?php } ?>></td>

                          </tr>


                          <tr height="20">
                            <td height="20" style="padding-left: 60px;font-weight:bold;">Book Fold</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="book_fold1" id="clearing" <?php if ($insno['book_fold1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="book_fold2" id="clearing" <?php if ($insno['book_fold2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="book_fold3" id="clearing" <?php if ($insno['book_fold3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="book_fold4" id="clearing" <?php if ($insno['book_fold4'] != "") { ?> checked <?php } ?>></td>
                            <td style="padding-left:20px;font-weight:bold;">Poly Bag Sticker</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="poly_bag_sticker1" id="poly_bag_sticker1" <?php if ($insno['poly_bag_sticker1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="poly_bag_sticker2" id="poly_bag_sticker2" <?php if ($insno['poly_bag_sticker2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="poly_bag_sticker3" id="poly_bag_sticker3" <?php if ($insno['poly_bag_sticker3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="poly_bag_sticker4" id="poly_bag_sticker4" <?php if ($insno['poly_bag_sticker4'] != "") { ?> checked <?php } ?>></td>
                          </tr>

                          <tr height="20">
                            <td height="20" style="padding-left: 60px;font-weight:bold;">Factory Code</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="fac_code1" id="fac_code1" <?php if ($insno['fac_code1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="fac_code2" id="fac_code2" <?php if ($insno['fac_code2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="fac_code3" id="fac_code3" <?php if ($insno['fac_code3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="fac_code4" id="fac_code4" <?php if ($insno['fac_code4'] != "") { ?> checked <?php } ?>></td>
                            <td style="padding-left:20px;font-weight:bold;">Lot Sticker</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="lot_sticker1" id="lot_sticker1" <?php if ($insno['lot_sticker1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="lot_sticker2" id="lot_sticker2" <?php if ($insno['lot_sticker2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="lot_sticker3" id="lot_sticker3" <?php if ($insno['lot_sticker3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="lot_sticker4" id="lot_sticker4" <?php if ($insno['lot_sticker4'] != "") { ?> checked <?php } ?>></td>
                          </tr>
                          <tr height="20">
                            <td height="20" style="padding-left: 60px;font-weight:bold;">Hang Tag</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="hang_tag1" id="hang_tag1" <?php if ($insno['hang_tag1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="hang_tag2" id="hang_tag2" <?php if ($insno['hang_tag2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="hang_tag3" id="hang_tag3" <?php if ($insno['hang_tag3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="hang_tag4" id="hang_tag4" <?php if ($insno['hang_tag4'] != "") { ?> checked <?php } ?>></td>
                            <td style="padding-left:20px;font-weight:bold;">Pre Pack Sticker</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="pre_pack_sticker1" id="pre_pack_sticker1" <?php if ($insno['pre_pack_sticker1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="pre_pack_sticker2" id="pre_pack_sticker2" <?php if ($insno['pre_pack_sticker2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="pre_pack_sticker3" id="pre_pack_sticker3" <?php if ($insno['pre_pack_sticker3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="pre_pack_sticker4" id="pre_pack_sticker4" <?php if ($insno['pre_pack_sticker4'] != "") { ?> checked <?php } ?>></td>
                          </tr>
                          <tr height="20">
                            <td height="20" style="padding-left: 60px;font-weight:bold;">Hanger</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="hanger1" id="hanger1" <?php if ($insno['hanger1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="hanger2" id="hanger2" <?php if ($insno['hanger2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="hanger3" id="hanger3" <?php if ($insno['hanger3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="hanger4" id="hanger4" <?php if ($insno['hanger4'] != "") { ?> checked <?php } ?>></td>
                            <td style="padding-left:20px;font-weight:bold;">Carton Markings</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="carton_king1" id="carton_king1" <?php if ($insno['carton_king1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="carton_king2" id="carton_king2" <?php if ($insno['carton_king2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="carton_king3" id="carton_king3" <?php if ($insno['carton_king3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="carton_king4" id="carton_king4" <?php if ($insno['carton_king4'] != "") { ?> checked <?php } ?>></td>
                          </tr>
                          <tr height="20">
                            <td height="20" style="padding-left: 60px;font-weight:bold;">Washcare</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="washcare1" id="washcare1" <?php if ($insno['washcare1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="washcare2" id="washcare2" <?php if ($insno['washcare2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="washcare3" id="washcare3" <?php if ($insno['washcare3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="washcare4" id="washcare4" <?php if ($insno['washcare4'] != "") { ?> checked <?php } ?>></td>
                            <td style="padding-left:20px;font-weight:bold;">Placement<br />
                              Upc/P.Pack</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="placement1" id="placement1" <?php if ($insno['placement1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="placement2" id="placement2" <?php if ($insno['placement2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="placement3" id="placement3" <?php if ($insno['placement3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="placement4" id="placement4" <?php if ($insno['placement4'] != "") { ?> checked <?php } ?>></td>
                          </tr>
                          <tr height="20">
                            <td height="20" style="padding-left: 60px;font-weight:bold;">Interlining</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="interlining1" id="interlining1" <?php if ($insno['interlining1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="interlining2" id="interlining2" <?php if ($insno['interlining2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="interlining3" id="interlining3" <?php if ($insno['interlining3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="interlining4" id="interlining4" <?php if ($insno['interlining4'] != "") { ?> checked <?php } ?>></td>
                            <td style="padding-left:20px;font-weight:bold;">Folding</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="folding1" id="folding1" <?php if ($insno['folding1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="folding2" id="folding2" <?php if ($insno['folding2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="folding3" id="folding3" <?php if ($insno['folding3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="folding4" id="folding4" <?php if ($insno['folding4'] != "") { ?> checked <?php } ?>></td>
                          </tr>
                          <tr height="20">
                            <td height="20" style="padding-left: 60px;font-weight:bold;">Snap</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="snap1" id="snap1" <?php if ($insno['snap1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="snap2" id="snap2" <?php if ($insno['snap2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="snap3" id="snap3" <?php if ($insno['snap3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="snap4" id="snap4" <?php if ($insno['snap4'] != "") { ?> checked <?php } ?>></td>
                            <td style="padding-left:20px;font-weight:bold;">Spare Button Position</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="spare_but_pos1" id="spare_but_pos1" <?php if ($insno['spare_but_pos1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="spare_but_pos2" id="spare_but_pos2" <?php if ($insno['spare_but_pos2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="spare_but_pos3" id="spare_but_pos3" <?php if ($insno['spare_but_pos3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="spare_but_pos4" id="spare_but_pos4" <?php if ($insno['spare_but_pos4'] != "") { ?> checked <?php } ?>></td>
                          </tr>
                          <tr height="20">
                            <td height="20" style="padding-left: 60px;font-weight:bold;">Elastic</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="elastic1" id="elastic1" <?php if ($insno['elastic1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="elastic2" id="elastic2" <?php if ($insno['elastic2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="elastic3" id="elastic3" <?php if ($insno['elastic3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="elastic4" id="elastic4" <?php if ($insno['elastic4'] != "") { ?> checked <?php } ?>></td>
                            <td width="141" style="padding-left:20px;font-weight:bold;">Print</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="print1" id="print1" <?php if ($insno['print1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="print2" id="print2" <?php if ($insno['print2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="print3" id="print3" <?php if ($insno['print3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="print4" id="print4" <?php if ($insno['print4'] != "") { ?> checked <?php } ?>></td>
                          </tr>
                          <tr height="20">
                            <td height="20" style="padding-left: 60px;font-weight:bold;">Button</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="button1" id="button1" <?php if ($insno['button1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="button2" id="button2" <?php if ($insno['button2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="button3" id="button3" <?php if ($insno['button3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="button4" id="button4" <?php if ($insno['button4'] != "") { ?> checked <?php } ?>></td>
                            <td width="141" style="padding-left:20px;font-weight:bold;">Layout</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="layout1" id="layout1" <?php if ($insno['layout1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="layout2" id="layout2" <?php if ($insno['layout2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="layout3" id="layout3" <?php if ($insno['layout3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="layout4" id="layout4" <?php if ($insno['layout4'] != "") { ?> checked <?php } ?>></td>
                          </tr>
                          <tr height="20" style="padding-left: 60px;">
                            <td height="20" width="198" style="padding-left: 60px;font-weight:bold;">Hook Eye/Bar</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="hok_eye_bar1" id="hok_eye_bar1" <?php if ($insno['hok_eye_bar1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="hok_eye_bar2" id="hok_eye_bar2" <?php if ($insno['hok_eye_bar2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="hok_eye_bar3" id="hok_eye_bar3" <?php if ($insno['hok_eye_bar3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="hok_eye_bar4" id="hok_eye_bar4" <?php if ($insno['hok_eye_bar4'] != "") { ?> checked <?php } ?>></td>
                            <td width="141" style="padding-left:20px;font-weight:bold;">Emb. Thread Color</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="emb_thr_color1" id="emb_thr_color1" <?php if ($insno['emb_thr_color1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="emb_thr_color2" id="emb_thr_color2" <?php if ($insno['emb_thr_color2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="emb_thr_color3" id="emb_thr_color3" <?php if ($insno['emb_thr_color3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="emb_thr_color4" id="emb_thr_color4" <?php if ($insno['emb_thr_color4'] != "") { ?> checked <?php } ?>></td>
                          </tr>
                          <tr height="20">
                            <td height="20" style="padding-left: 60px;font-weight:bold;">Lace</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="lace1" id="lace1" <?php if ($insno['lace1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="lace2" id="lace2" <?php if ($insno['lace2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="lace3" id="lace3" <?php if ($insno['lace3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="lace4" id="lace4" <?php if ($insno['lace4'] != "") { ?> checked <?php } ?>></td>
                            <td width="141" style="padding-left:20px;font-weight:bold;">Placement</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="plcment1" id="plcment1" <?php if ($insno['plcment1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="plcment2" id="plcment2" <?php if ($insno['plcment2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="plcment3" id="plcment3" <?php if ($insno['plcment3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="plcment4" id="plcment4" <?php if ($insno['plcment4'] != "") { ?> checked <?php } ?>></td>
                          </tr>
                          <tr height="20">
                            <td height="20" style="padding-left: 60px;font-weight:bold;">Buckle</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="buckle1" id="buckle1" <?php if ($insno['buckle1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="buckle2" id="buckle2" <?php if ($insno['buckle2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="buckle3" id="buckle3" <?php if ($insno['buckle3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="buckle4" id="buckle4" <?php if ($insno['buckle4'] != "") { ?> checked <?php } ?>></td>
                            <td width="141" style="padding-left:20px;font-weight:bold;">Beads/Sequins</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="bead_seq1" id="bead_seq1" <?php if ($insno['bead_seq1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="bead_seq2" id="bead_seq2" <?php if ($insno['bead_seq2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="bead_seq3" id="bead_seq3" <?php if ($insno['bead_seq3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="bead_seq4" id="bead_seq4" <?php if ($insno['bead_seq4'] != "") { ?> checked <?php } ?>></td>
                          </tr>
                          <tr height="40">
                            <td height="40" style="padding-left: 60px;font-weight:bold;">Snap</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="snap1" id="snap1" <?php if ($insno['snap1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="snap2" id="snap2" <?php if ($insno['snap2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="snap3" id="snap3" <?php if ($insno['snap3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="snap4" id="snap4" <?php if ($insno['snap4'] != "") { ?> checked <?php } ?>></td>
                            <td width="141" style="padding-left:20px;font-weight:bold;">Beads/Sequins Layout</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="bead_seq_lay1" id="bead_seq_lay1" <?php if ($insno['bead_seq_lay1'] != "") { ?> checked <?php } ?>></td>

                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="bead_seq_lay2" id="bead_seq_lay2" <?php if ($insno['bead_seq_lay2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="bead_seq_lay3" id="bead_seq_lay3" <?php if ($insno['bead_seq_lay3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="bead_seq_lay4" id="bead_seq_lay4" <?php if ($insno['bead_seq_lay4'] != "") { ?> checked <?php } ?>></td>
                          </tr>
                          <tr height="20">
                            <td height="20" style="padding-left: 60px;font-weight:bold;">Thread</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="thread1" id="thread1" <?php if ($insno['thread1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="thread2" id="thread2" <?php if ($insno['thread2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="thread3" id="thread3" <?php if ($insno['thread3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="thread4" id="thread4" <?php if ($insno['thread4'] != "") { ?> checked <?php } ?>></td>
                            <td width="141" style="padding-left:20px;font-weight:bold;">After Treatment</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="aft_treatment1" id="aft_treatment1" <?php if ($insno['aft_treatment1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="aft_treatment2" id="aft_treatment2" <?php if ($insno['aft_treatment2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="aft_treatment3" id="aft_treatment3" <?php if ($insno['aft_treatment3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="aft_treatment4" id="aft_treatment4" <?php if ($insno['aft_treatment4'] != "") { ?> checked <?php } ?>></td>
                          </tr>
                          <tr height="20">
                            <td height="20" style="padding-left: 60px;font-weight:bold;">Lining</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="lining1" id="lining1" <?php if ($insno['lining1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="lining2" id="lining2" <?php if ($insno['lining2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="lining3" id="lining3" <?php if ($insno['lining3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="lining4" id="lining4" <?php if ($insno['lining4'] != "") { ?> checked <?php } ?>></td>
                            <td width="141" style="padding-left:20px;font-weight:bold;">PH</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="ph1" id="ph1" <?php if ($insno['ph1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="ph2" id="ph2" <?php if ($insno['ph2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="ph3" id="ph3" <?php if ($insno['ph3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="ph4" id="ph4" <?php if ($insno['ph4'] != "") { ?> checked <?php } ?>></td>
                          </tr>
                          <tr height="20">
                            <td height="20" style="padding-left: 60px;font-weight:bold;">Zipper</td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="zipper1" id="zipper1" <?php if ($insno['zipper1'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="zipper2" id="zipper2" <?php if ($insno['zipper2'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="zipper3" id="zipper3" <?php if ($insno['zipper3'] != "") { ?> checked <?php } ?>></td>
                            <td><input style="height: 17px;width: 50px;margin-top: 0;text-align: center;" type="checkbox" class="erpint" name="zipper4" id="zipper4" <?php if ($insno['zipper4'] != "") { ?> checked <?php } ?>></td>
                            <td width="141" style="padding-left:20px;font-weight:bold;"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr height="21">
                            <td height="21">&nbsp;</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>&nbsp;</td>
                          </tr>
                      </div>
                      <table class="table erptab" style="width:100%">
                        <tr style="background: #0288d1;">
                          <td colspan="6">
                            <div style="text-transform:capitalize;color:white;font-size: 15px;">Pattern Checklist</div>

                          </td>
                        </tr>

                      </table>

                      <table class="table  table-hover" style="width:100%;border:1px solid #ddd;;">
                        <tr>


                          <td style="width:26%">
                            <div style="text-transform:capitalize;"><b>Grain Line</b></div>
                          </td>
                          <td>
                            <?php if ($insno['grain_line'] != "") {
                            ?>
                              <select id="grain_line" name="grain_line" class="erpint" style="width:100%;">

                                <option value="<?php echo $insno['grain_line']; ?>"><?php echo $insno['grain_line']; ?></option>
                              </select>
                            <?php } ?>

                            <?php if ($insno['grain_line'] == "") {
                            ?>
                              <select id="grain_line" name="grain_line" class="erpint" style="width:100%;" required>

                                <option value="">Select</option>
                                <option value="Ok">Ok</option>
                                <option value="Not ok">Not Ok</option>
                              </select>
                            <?php } ?>
                          </td>

                          <td>
                            <div style="text-transform:capitalize;"><b>Seam Allowance</b></div>
                          </td>
                          <td>
                            <?php if ($insno['seam_allownce'] != "") {
                            ?>
                              <select id="seam_allownce" name="seam_allownce" class="erpint" style="width:100%;">
                                <option value="<?php echo $insno['seam_allownce']; ?>"><?php echo $insno['seam_allownce']; ?></option>
                              </select>
                            <?php } ?>

                            <?php if ($insno['seam_allownce'] == "") {
                            ?>
                              <select id="seam_allownce" name="seam_allownce" class="erpint" style="width:100%;" required>
                                <option value="">Select</option>
                                <option value="Ok">Ok</option>
                                <option value="Not ok">Not Ok</option>
                              </select>
                            <?php } ?>

                          </td>


                        </tr>
                        <tr>
                          <td>
                            <div style="text-transform:capitalize;"><b>Notches</b></div>
                          </td>
                          <td>
                            <?php if ($insno['notches'] != "") {
                            ?>
                              <select id="notches" name="notches" class="erpint" style="width:100%;">
                                <option value="<?php echo $insno['notches']; ?>"><?php echo $insno['notches']; ?></option>
                              </select>
                            <?php } ?>

                            <?php if ($insno['notches'] == "") {
                            ?>
                              <select id="notches" name="notches" class="erpint " displayname="" style="width:100%">

                                <option value="">Select</option>
                                <option value="Ok">Ok</option>
                                <option value="Not ok">Not Ok</option>
                              </select>
                            <?php } ?>
                          </td>


                          <td>
                            <div style="text-transform:capitalize;"><b>Cutting Check</b></div>
                          </td>
                          <td>
                            <?php if ($insno['cutting_check'] != "") {
                            ?>
                              <select id="cutting_check" name="cutting_check" class="erpint" style="width:100%;">
                                <option value="<?php echo $insno['cutting_check']; ?>"><?php echo $insno['cutting_check']; ?></option>
                              </select>
                            <?php } ?>

                            <?php if ($insno['cutting_check'] == "") {
                            ?>
                              <select id="cutting_check" name="cutting_check" class="erpint " displayname="" style="width:100%">

                                <option value="">Select</option>
                                <option value="Ok">Ok</option>
                                <option value="Not ok">Not Ok</option>
                              </select>
                            <?php } ?>

                          </td>


                        </tr>
                        <tr>
                          <td>
                            <div style="text-transform:capitalize;"><b>Grade Nest</b></div>
                          </td>
                          <td>
                            <?php if ($insno['grade_nest'] != "") {
                            ?>
                              <select id="grade_nest" name="grade_nest" class="erpint" style="width:100%;">
                                <option value="<?php echo $insno['grade_nest']; ?>"><?php echo $insno['grade_nest']; ?></option>
                              </select>

                            <?php } ?>

                            <?php if ($insno['grade_nest'] == "") {
                            ?>
                              <select id="grade_nest" name="grade_nest" class="erpint " displayname="" style="width:100%">

                                <option value="">Select</option>
                                <option value="Ok">Ok</option>
                                <option value="Not ok">Not Ok</option>
                              </select>
                            <?php } ?>
                          </td>

                          <td style="width:26%">
                            <div style="text-transform:capitalize;"><b>YY/Mini Marker</b></div>
                          </td>
                          <td>
                            <?php if ($insno['y_mini_marker'] != "") {
                            ?>
                              <select id="y_mini_marker" name="y_mini_marker" class="erpint" style="width:100%;">
                                <option value="<?php echo $insno['y_mini_marker']; ?>"><?php echo $insno['y_mini_marker']; ?></option>
                              </select>
                            <?php } ?>

                            <?php if ($insno['y_mini_marker'] == "") {
                            ?>
                              <select id="y_mini_marker" name="y_mini_marker" class="erpint " displayname="" style="width:100%">

                                <option value="">Select</option>
                                <option value="Ok" <?php if ($insno['y_mini_marker'] != "") { ?> selected <?php } ?>>Ok</option>
                                <option value="Not ok" <?php if ($insno['y_mini_marker'] != "") { ?> selected <?php } ?>>Not Ok</option>
                              </select>
                            <?php } ?>
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <div style="text-transform:capitalize;"><b>Corrections Implemented</b></div>
                          </td>
                          <td>
                            <?php if ($insno['correct_imp'] != "") {
                            ?>
                              <select id="correct_imp" name="correct_imp" class="erpint" style="width:100%;">
                                <option value="<?php echo $insno['correct_imp']; ?>"><?php echo $insno['correct_imp']; ?>
                                </option>
                              </select>
                            <?php } ?>

                            <?php if ($insno['correct_imp'] == "") {
                            ?>
                              <select id="correct_imp" name="correct_imp" class="erpint " displayname="" style="width:100%">

                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                              </select>
                            <?php } ?>

                          </td>
                          <td style="width:26%">
                            <div style="text-transform:capitalize;"><b>Measurement Spec Sheet</b></div>
                          </td>
                          <td>
                            <?php if ($insno['measr_space_sht'] != "") {
                            ?>
                              <select id="measr_space_sht" name="measr_space_sht" class="erpint" style="width:100%;">
                                <option value="<?php echo $insno['measr_space_sht']; ?>"><?php echo $insno['measr_space_sht']; ?>
                                </option>
                              </select>
                            <?php } ?>

                            <?php if ($insno['measr_space_sht'] == "") {
                            ?>
                              <select id="measr_space_sht" name="measr_space_sht" class="erpint " displayname="" style="width:100%">

                                <option value="">Select</option>
                                <option value="Pass">Pass</option>
                                <option value="Fail">Fail</option>
                              </select>
                            <?php } ?>
                          </td>
                        </tr>

                        <tr>
                          <td>
                            <div style="text-transform:capitalize;"><b>FDS Cut width</b></div>
                          </td>
                          <td>
                          <input style="width:100%;" type="text" class="erpint" name="fds_cut_width" id="fds_cut_width" value="<?php echo $insno['fds_cut_width']; ?>">
                            <!-- <?php if ($insno['fds_cut_width'] != "") {
                            ?>
                              <select id="fds_cut_width" name="fds_cut_width" class="erpint" style="width:100%;">
                                <option value="<?php echo $insno['fds_cut_width']; ?>"><?php echo $insno['fds_cut_width']; ?>
                                </option>
                              </select>
                            <?php } ?> -->

                            <!-- <?php if ($insno['fds_cut_width'] == "") {
                            ?>
                              <select id="fds_cut_width" name="fds_cut_width" class="erpint " displayname="" style="width:100%">

                                <option value="">Select</option>
                                <option value="Pass">From FDS</option>
                                <option value="Fail">From FDS</option>
                              </select>
                            <?php } ?> -->

                          </td>
                          <td style="width:26%">
                            <div style="text-transform:capitalize;"><b>FDS Full width</b></div>
                          </td>
                          <td>
                          <input style="width:100%;" type="text" class="erpint" name="fds_ful_width" id="fds_ful_width" value="<?php echo $insno['fds_ful_width']; ?>">
                            <!-- <?php if ($insno['fds_ful_width'] != "") {
                            ?>
                              <select id="fds_ful_width" name="fds_ful_width" class="erpint" style="width:100%;">
                                <option value="<?php echo $insno['fds_ful_width']; ?>"><?php echo $insno['fds_ful_width']; ?>
                                </option>
                              </select>
                            <?php } ?>

                            <?php if ($insno['fds_ful_width'] == "") {
                            ?>
                              <select id="fds_ful_width" name="fds_ful_width" class="erpint " displayname="" style="width:100%">

                                <option value="">Select</option>
                                <option value="Pass">From FDS</option>
                                <option value="Fail">From FDS</option>
                              </select>
                            <?php } ?>
                          </td> -->
                        </tr>

                        <tr>
                          <td>
                            <div style="text-transform:capitalize;"><b>Planned Size</b><b>Set Submission Date</b></div>
                          </td>


                          <td><input style="width:100%;" type="text" class="erpint" name="planned_size_date" id="planned_size_date" value="<?php echo $insno['planned_size_date']; ?>"></td>


                          <td style="width:26%">
                            <div style="text-transform:capitalize;"><b>Shrinkage</b></div>
                          </td>
                          <!--<td>-->

                          <!--       <select id="size_range" name="size_range" class="erpint " displayname="" style="width:100%">-->

                          <!--   <option value="">Select</option>-->
                          <!--   <option value="Pass">From FDS</option>-->
                          <!--   <option value="Fail">From FDS</option>-->
                          <!-- </select>-->

                          <!--  </td>-->
                        </tr>

                        <tr>
                          <td>
                            <div style="text-transform:capitalize;"><b>Actual</b> &nbsp <b>Submission Date</b></div>
                          </td>


                          <td><input style="width:100%;" type="text" class="erpint" name="actual_subm_date" id="actual_subm_date" value="<?php echo $insno['actual_subm_date'] ?>"></td>


                          <td style="width:26%">
                            <div style="text-transform:capitalize;"><b>Shell Shrinkage</b></div>
                          </td>

                          <td><input style="width:150px;" type="text" class="erpint" name="shell_shrn_len" id="shell_shrn_len" value="<?php echo $insno['shell_shrn_len'] ?>" placeholder="Lengthwise"></td>
                          <td><input style="width:150px;" type="text" class="erpint" name="shell_shrn_wid" id="shell_shrn_wid" value="<?php echo $insno['shell_shrn_wid'] ?>" placeholder="Widthwise"></td>
                        </tr>

                        <tr>
                          <td>
                            <div style="text-transform:capitalize;"><b>Cut Quantity</b></div>
                          </td>


                          <td><input style="width:100%;" type="text" class="erpint" name="cut_quantity" id="cut_quantity" value="<?php echo $insno['cut_quantity'] ?>" style="margin-top:15px;"></td>


                          <td style="width:26%">
                            <div style="text-transform:capitalize;"><b>Shell Pattern Shrinkage</b></div>
                          </td>
                          <td><input style="width:150px;" type="text" class="erpint" name="shell_patrn_len" id="shell_patrn_len" value="<?php echo $insno['shell_patrn_len'] ?>" placeholder="Lengthwise"></td>
                          <td><input style="width:150px;" type="text" class="erpint" name="shell_patrn_wid" id="shell_patrn_wid" value="<?php echo $insno['shell_patrn_wid'] ?>" placeholder="Widthwise"></td>

                        </tr>

                        <tr>
                          <td>
                            <div style="text-transform:capitalize;"><b>Corrections to be done</b></div>
                          </td>


                          <td><input style="width:100%;" type="text" class="erpint" name="corctn_done" id="corctn_done" value="<?php echo $insno['corctn_done'] ?>"></td>


                          <!--               <td style="width:26%"><div style="text-transform:capitalize;"><b>Shell Pattern Shrinkage</b></div></td>-->
                          <!--             <td><input style="width:150px;" type="text" class="erpint" name="shell_patrn_len" id="shell_patrn_len" value="<?php echo $operationData['shell_patrn_len'] ?>" placeholder="Lengthwise"></td>-->
                          <!--<td><input style="width:150px;" type="text" class="erpint" name="shell_patrn_wid" id="shell_patrn_wid" -->
                          <!--value="<?php echo $operationData['shell_patrn_wid'] ?>" placeholder="Widthwise"></td>-->

                        </tr>


                        <tr>
                          <td>
                            <div style="text-transform:capitalize;"><b>Size Set Implementation Result</b></div>
                          </td>


                          <td>
                            <?php if ($insno['size_set_implmt'] != "") {
                            ?>
                              <select id="size_set_implmt" name="size_set_implmt" class="erpint" style="width:100%;">
                                <option value="<?php echo $insno['size_set_implmt']; ?>"><?php echo $insno['size_set_implmt']; ?>
                                </option>
                              </select>
                            <?php } ?>

                            <?php if ($insno['size_set_implmt'] == "") {
                            ?>

                              <select id="size_set_implmt" name="size_set_implmt" class="erpint " displayname="" style="width:100%">

                                <option value="">Select</option>
                                <option value="Pass">Pass</option>
                                <option value="Fail">Fail</option>
                              </select>
                            <?php } ?>
                          </td>

                          <td>
                            <div style="text-transform:capitalize;"><b>Cutting Go Ahead</b></div>
                          </td>

                          <td>
                            <?php if ($insno['cutting_go_head'] != "") {
                            ?>
                              <select id="cutting_go_head" name="cutting_go_head" class="erpint" style="width:100%;">
                                <option value="<?php echo $insno['cutting_go_head']; ?>"><?php echo $insno['cutting_go_head']; ?>
                                </option>
                              </select>
                            <?php } ?>

                            <?php if ($insno['cutting_go_head'] == "") {
                            ?>
                              <select id="cutting_go_head" name="cutting_go_head" class="erpint " displayname="" style="width:100%">

                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                              </select>
                            <?php } ?>
                          </td>

                        </tr>



                      </table>
                      <input name="action" type="hidden" id="action" value="setsizeinspection" />

                      <input name="module" type="hidden" id="module" value="<?php echo $_GET['module']; ?>" />

                      <button name="Submit1" type="submit" class="btn btn-primary" style="float:right">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>

              </div>

            </div>

          </div>
          </form>

        </div>

      </div>

    </div>

  </div>

  <p>
    <style>
      .datatable-scroll {
        overflow: auto !important;
      }
    </style>
  </p>
  <p>&nbsp;</p>

  <p>&nbsp; </p>

  <script>
    function selectcolorcode() {

      var styleId = $('#styleId').val();
      //alert(styleId);
      $.ajax({
        type: 'post',
        url: 'loadcolr.php',
        data: {
          sty_id: styleId
        },
        success: function(data) {
          //$("#loader").hide();
          $("#sty_data").html(data);
        }
      });

    }


    <?php if ($_GET['id'] != '') { ?>
      selectcolorcode();
      selectline();
    <?php } ?>
  </script>

  <script>
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

    var optSimple = {
      format: 'mm-dd-yyyy',
      todayHighlight: true,
      orientation: 'bottom right',
      autoclose: true,
      container: '#sandbox'
    };

    var optComponent = {
      format: 'mm-dd-yyyy',
      container: '#datePicker',
      orientation: 'auto top',
      todayHighlight: true,
      autoclose: true
    };

    // SIMPLE
    $('#simple').datepicker(optSimple);

    // COMPONENT
    $('#datePicker').datepicker(optComponent);

    // ===================================

    $('#datepicker1').datepicker({
      format: "mm : dd : yyyy",
      todayHighlight: true,
      autoclose: true,
      container: '#box1',
      orientation: 'top right'
    });

    $('#datepicker2').datepicker({
      format: 'mm \\ dd \\ yyyy',
      todayHighlight: true,
      autoclose: true,
      container: '#box2',
      orientation: 'top right'
    });

    $('#datepicker1, #datepicker2, #simple, #datePicker').datepicker('setDate', today);
  </script>