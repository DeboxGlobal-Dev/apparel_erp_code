                    <?php
                    if($_GET['id']!=''){
                    $select1='*';
                    $where1='id="'.decode($_GET['id']).'"';
                    $rs1=GetPageRecord($select1,'fabricDetailSheetMaster',$where1);
                    $editresult=mysqli_fetch_array($rs1);
                    $editId=clean($editresult['id']);
                    $lastId=$editresult['id'];
                    }

                    if($_GET['status']=='1'){
                    ?>
                    <script>
                    $(document).ready(function(){
                    $("#popid :input").prop("disabled", true).css({"background-color": "rgb(245, 255, 245)"});
                    });
                    </script>
                    <?php
                    }
                    ?>
                    <div class="page-content">
                    <!-- Main content -->
                    <div class="content-wrapper">
                    <!-- Content area -->
                    <div class="content pt-0" style="margin-top:20px;">
                    <form action="ac.crm" method="post" class="submitstyleform" enctype="multipart/form-data" name="popid" target="acf" id="popid">
                    <!-- Dashboard content -->
                    <div class="row">
                    <div class="col-xl-12">
                    <div class="card">
                    <div class="card-header bg-white">
                    <h6 class="card-title">Fabric Detail Sheet</h6>

                    <?php
                    if($_GET['status']==''){
                    ?>
                    <div class="d-flex align-items-center" style="position: absolute; right: 11px; top: 10px;">
                    <a href="showpage.crm?module=<?php echo $_GET['module']; ?>"><button type="button" class="btn bg-grey-400 btn-labeled btn-labeled-right ml-auto"><b><i class="fa fa-arrow-left" aria-hidden="true" style="    font-size: 17px;"></i></b>Back</button></a>
                    </div>
                    <?php } ?>


                    </div>


                    <div class="card-body">

                    <table cellspacing="0" cellpadding="0" class="table">

                    <tr height="23" style="background-color: #324148; color: #fff;">
                    <td colspan="6" height="23">INFORMATION &amp; TERMS</td>
                    </tr>

                    <tr height="23">
                    <td width="357" height="23">Mill Article    No :</td>
                    <td width="95"><input type="text" name="millArticleNo" id="millArticleNo" class="myclass" value="<?php echo $editresult['millArticleNo']; ?>"></td>
                    <td width="93">&nbsp;</td>
                    <td width="315">Fabric&nbsp;Name:</td>
                    <td>
                    <select name="fabricName" id="fabricName" class="myclass">
                    <option value="">Select</option>
                    <?php
                    $a=GetPageRecord('*','materialMaster','1 and materialType=1 order by name asc');
                    while($currenname=mysqli_fetch_array($a)){
                    ?>
                    <option value="<?php echo $currenname['id']; ?>" <?php if($editresult['fabricName']==$currenname['id']){ echo 'selected'; } ?>><?php echo $currenname['name']; ?></option>
                    <?php } ?>
                    </select>


                    </td>
                    <td width="56">&nbsp;</td>
                    </tr>
                    <tr height="23">
                    <td height="23">Mfg Name:</td>
                    <td>
                    <select name="mfgName" id="mfgName" class="myclass">
                    <option value="">Select</option>
                    <?php
                    $b=GetPageRecord('*','suppliersMaster','1 order by name asc');
                    while($fabricData=mysqli_fetch_array($b)){ ?>
                    <option value="<?php echo $fabricData['id']; ?>" <?php if($fabricData['id']==$editresult['mfgName']){ ?> selected="selected" <?php } ?>><?php echo $fabricData['name']; ?></option>
                    <?php } ?>
                    </select>
                    </td>
                    <td>&nbsp;</td>
                    <td>Finish :</td>
                    <td><input type="text" name="finishText" id="finishText" class="myclass" value="<?php echo $editresult['finishText']; ?>"></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr height="23">
                    <td height="23">FDS Creation    Date:</td>
                    <td><input type="text" name="fdsCreationDate" class="newdatepicker myclass" id="fdsCreationDate" <?php if($editresult['fdsCreationDate']!="" && $editresult['fdsCreationDate']!="1970-01-01" && $editresult['fdsCreationDate']!="0000-00-00"){ ?> value="<?php echo date('d-m-Y',strtotime($editresult['fdsCreationDate'])); ?>" <?php } ?> placeholder="Select Date" readonly=""></td>
                    <td>&nbsp;</td>
                    <td>Full&nbsp;Width&nbsp;(Inches):</td>
                    <td><input type="text" name="fullwidthInches" id="fullwidthInches" class="myclass" value="<?php echo $editresult['fullwidthInches']; ?>" onkeyup="tries()" ></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr height="23">
                    <td height="23">Country of    Origin :</td>
                    <td><input type="text" name="countryOfOrigin" id="countryOfOrigin" class="myclass" value="<?php echo $editresult['countryOfOrigin']; ?>"></td>
                    <td>&nbsp;</td>
                    <td>Cuttable&nbsp;Width(Inches) :</td>
                    <td><input type="text" name="cuttablewidthinches" id="cuttablewidthinches" class="myclass" value="<?php echo $editresult['cuttablewidthinches']; ?>"   ></td>
                    <td>&nbsp;</td>
                    </tr>
                    <tr height="23">
                    <td height="23">Content :</td>
                    <td><input type="text" name="contentstext" id="contentstext" class="myclass" value="<?php echo $editresult['contentstext']; ?>"></td>
                    <td>&nbsp;</td>
                    <td>Fabric Type:</td>
                    <td>
                    <select name="fabricType" id="fabricType" class="myclass">
                    <option value="">Fabric Type</option>
                    <?php
                    $b=GetPageRecord('*','fabrictypeMaster','1 order by name asc');
                    while($fabricData=mysqli_fetch_array($b)){ ?>
                    <option value="<?php echo $fabricData['id']; ?>" <?php if($fabricData['id']==$editresult['fabricType']){ ?> selected="selected" <?php } ?>><?php echo $fabricData['name']; ?></option>
                    <?php } ?>
                    </select>	</td>
                    <td>&nbsp; </td>
                    </tr>


                    <tr height="23">
                    <td height="23">GSM :</td>
                    <td><input type="text" name="gsm" id="gsm" class="myclass" value="<?php echo $editresult['gsm']; ?>" onkeyup="tries()" ></td>
                    <td>&nbsp;</td>
                    <td>Price / Kg :</td>
                    <td><input type="text" name="price_kg" id="price_kg" class="myclass" value="<?php echo $editresult['price_kg']; ?>" onkeyup="tries()" ></td>

                    <!--<td>&nbsp; </td>-->

                    <td><select name="curr_ist" id="curr_ist" class="myclass">
                    <option value="">Currency</option>
                    <?php
                    $c=GetPageRecord('*','currencyMaster','1 order by name asc');
                    while($curData=mysqli_fetch_array($c)){ ?>
                    <option value="<?php echo $curData['id']; ?>" <?php if($curData['id']==$editresult['curr_ist']){ ?> selected="selected" <?php } ?>><?php echo $curData['name']; ?></option>
                    <?php } ?>
                    </select></td>
                    </tr>






                    <tr height="23">
                    <td height="23">Meters in Kg</td>
                    <td><input type="text" name="mtr_kg" id="mtr_kg" class="myclass" readonly="readonly" value="<?php echo $editresult['mtr_kg']; ?>"></td>
                    <td>&nbsp;</td>
                    <td>Yards in Kg :</td>
                    <td><input type="text" name="yrd_kg" id="yrd_kg" class="myclass" readonly="readonly"  value="<?php echo $editresult['yrd_kg']; ?>"></td>

                    <td>&nbsp; </td>
                    </tr>





                    <tr height="23">
                    <td height="23">Minimum /    Color Order :</td>
                    <td><input type="text" name="minimumColorOrder" id="minimumColorOrder" class="myclass" value="<?php echo $editresult['minimumColorOrder']; ?>">	 </td>
                    <td><select name="uomminimumColorOrder" id="uomminimumColorOrder" class="myclass">
                    <option value="">UOM</option>
                    <?php
                    $a=GetPageRecord('*','unitMaster','1 order by name asc');
                    while($unitData=mysqli_fetch_array($a)){ ?>
                    <option value="<?php echo $unitData['id']; ?>" <?php if($unitData['id']==$editresult['uomminimumColorOrder']){ ?> selected="selected" <?php } ?>><?php echo $unitData['name']; ?></option>
                    <?php } ?>
                    </select></td>
                    <td>Price / Yd:</td>
                    <td><input type="text" name="price" id="price" class="myclass" value="<?php echo $editresult['price']; ?>"  ></td>
                    <td><select name="priceCurrency" id="priceCurrency" class="myclass">
                    <option value="">Currency</option>
                    <?php
                    $c=GetPageRecord('*','currencyMaster','1 order by name asc');
                    while($curData=mysqli_fetch_array($c)){ ?>
                    <option value="<?php echo $curData['id']; ?>" <?php if($curData['id']==$editresult['priceCurrency']){ ?> selected="selected" <?php } ?>><?php echo $curData['name']; ?></option>
                    <?php } ?>
                    </select></td>
                    </tr>
                    <tr height="23">
                    <td height="23">Minimum /    Total Order :</td>
                    <td><input type="text" name="minimumTotalOrder" id="minimumTotalOrder" class="myclass" value="<?php echo $editresult['minimumTotalOrder']; ?>"></td>
                    <td><select name="uomminimumTotalOrder" id="uomminimumTotalOrder" class="myclass">
                    <option value="">UOM</option>
                    <?php
                    $a=GetPageRecord('*','unitMaster','1 order by name asc');
                    while($unitData=mysqli_fetch_array($a)){ ?>
                    <option value="<?php echo $unitData['id']; ?>" <?php if($unitData['id']==$editresult['uomminimumTotalOrder']){ ?> selected="selected" <?php } ?>><?php echo $unitData['name']; ?></option>
                    <?php } ?>
                    </select></td>
                    <td>Valiadty Till :</td>
                    <td><input type="text" name="validityTill" class="newdatepicker myclass" id="validityTill" <?php if($editresult['validityTill']!="" && $editresult['validityTill']!="1970-01-01" && $editresult['validityTill']!="0000-00-00"){ ?> value="<?php echo date('d-m-Y',strtotime($editresult['validityTill'])); ?>" <?php } ?> placeholder="Select Date" readonly=""></td>
                    <td>&nbsp; </td>
                    </tr>
                    <tr height="23">
                    <td height="23">Capacity :</td>
                    <td><input type="text" name="capacitytext" id="capacitytext" class="myclass" value="<?php echo $editresult['capacitytext']; ?>"></td>
                    <td><select name="uomcapacitytext" id="uomcapacitytext" class="myclass">
                    <option value="">UOM</option>
                    <?php
                    $a=GetPageRecord('*','unitMaster','1 order by name asc');
                    while($unitData=mysqli_fetch_array($a)){ ?>
                    <option value="<?php echo $unitData['id']; ?>" <?php if($unitData['id']==$editresult['uomcapacitytext']){ ?> selected="selected" <?php } ?>><?php echo $unitData['name']; ?></option>
                    <?php } ?>
                    </select></td>
                    <td>Re-validated Till :</td>
                    <td><input type="text" name="revalidityTill" class="newdatepicker myclass" id="revalidityTill" <?php if($editresult['revalidityTill']!="" && $editresult['revalidityTill']!="1970-01-01" && $editresult['revalidityTill']!="0000-00-00"){ ?> value="<?php echo date('d-m-Y',strtotime($editresult['revalidityTill'])); ?>" <?php } ?> placeholder="Select Date" readonly=""></td>
                    <td>&nbsp; </td>
                    </tr>
                    <tr height="23">
                    <td height="23">Suggested    Care Instructions :</td>
                    <td><input type="text" name="suggestioninstruction" id="suggestioninstruction" class="myclass" value="<?php echo $editresult['suggestioninstruction']; ?>"></td>
                    <td>&nbsp;</td>
                    <td>Bulk Lead Time :</td>
                    <td><input type="text" name="bultleadTime" id="bultleadTime" class="myclass" value="<?php echo $editresult['bultleadTime']; ?>"></td>
                    <td>&nbsp; </td>
                    </tr>
                    <tr height="23">
                    <td height="23">Comments /    Testing Information:</td>
                    <td><input type="text" name="commenttestinginfo" id="commenttestinginfo" class="myclass" value="<?php echo $editresult['commenttestinginfo']; ?>"></td>
                    <td>&nbsp;</td>
                    <td>Sample Yardag Lead    Time :</td>
                    <td width="88"> <input type="text" name="sampleyardingleadtime" id="sampleyardingleadtime" class="myclass" value="<?php echo $editresult['sampleyardingleadtime']; ?>">
                    </td>
                    <td>&nbsp; </td>
                    </tr>
                    <tr height="23">
                    <td height="23">Remark	</td>
                    <td colspan="5" height="23">
                    <input type="text" name="remarks" id="remarks" class="myclass" value="<?php echo $editresult['remarks']; ?>"></td>
                    </tr>
                    <tr height="23">
                    <td colspan="6" height="23"><strong>Please advise the    bulk shrinkage in case of this is garment washing style.Please advise the    number of colors that can be accomodated in the screen/pattern.</strong></td>
                    </tr>
                    <tr height="23">
                    <td height="23" colspan="6"><strong>&nbsp;Please advise if any test issue for bulk    quality is there . Mill must communicate if fabric will not meet end use and    performance expectations.&nbsp;</strong></td>
                    </tr>
                    </table>
                    <div class="datatable-scroll" style="overflow:auto !important;">

                    <table cellspacing="0" cellpadding="0" class="table" style="margin-top:20px;">
                    <tr height="23" style="background-color: #324148; color: #fff;">
                    <td colspan="9" height="23">UNWASHED FINISH SPECIFICATIONS</td>
                    </tr>
                    <tr height="23">
                    <td height="23">&nbsp;</td>
                    <td>
                    <!--<strong>Warp</strong>-->
                    </td>
                    <td>
                    <!--<strong>Weft</strong>-->
                    </td>
                    <td>&nbsp;</td>

                    <td></td>
                    <td></td>

                    <td>TEAR (Warp/Weft):</td>
                    <td><input type="text" name="tearwarp" id="tearwarp" class="myclass" value="<?php echo $editresult['tearwarp']; ?>"></td>
                    <td><input type="text" name="tearlbs" id="tearlbs" class="myclass" value="<?php echo $editresult['tearlbs']; ?>"></td>
                    </tr>
                    <tr height="23">
                    <td height="23">Yarn Count</td>
                    <td><input type="text" name="countwarp" id="countwarp" class="myclass" value="<?php echo $editresult['countwarp']; ?>"></td>
                    <td><input type="text" name="countweft" id="countweft" class="myclass" value="<?php echo $editresult['countweft']; ?>"></td>
                    <td><input type="text" name="count_th" id="count_th" class="myclass" value="<?php echo $editresult['count_th']; ?>"></td>
                    <td><input type="text" name="count_four" id="count_four" class="myclass" value="<?php echo $editresult['count_four']; ?>"></td>
                    <td><input type="text" name="count_five" id="count_five" class="myclass" value="<?php echo $editresult['count_five']; ?>"></td>
                    <!--<td>&nbsp;</td>-->
                    <td>TENSILE (Warp/Weft):</td>
                    <td><input type="text" name="testilewarp" id="testilewarp" class="myclass" value="<?php echo $editresult['testilewarp']; ?>"></td>
                    <td><input type="text" name="testilelbs" id="testilelbs" class="myclass" value="<?php echo $editresult['testilelbs']; ?>"></td>
                    </tr>
                    <tr height="23">
                    <td height="23">Construction</td>
                    <td><input type="text" name="constructionwarp" id="constructionwarp" class="myclass" value="<?php echo $editresult['constructionwarp']; ?>"></td>
                    <td><input type="text" name="constructionweft" id="constructionweft" class="myclass" value="<?php echo $editresult['constructionweft']; ?>"></td>

                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>SEAM SLIPPAGE):</td>
                    <td><input type="text" name="seamslippage" id="seamslippage" class="myclass" value="<?php echo $editresult['seamslippage']; ?>"></td>
                    <td><input type="text" name="seamslippagelbs" id="seamslippagelbs" class="myclass" value="<?php echo $editresult['seamslippagelbs']; ?>"></td>
                    </tr>
                    <tr height="23">
                    <td height="23">Shrinkage</td>
                    <td><input type="text" name="shrinkagewarp" id="shrinkagewarp" class="myclass" value="<?php echo $editresult['shrinkagewarp']; ?>"></td>
                    <td><input type="text" name="shrinkageweft" id="shrinkageweft" class="myclass" value="<?php echo $editresult['shrinkageweft']; ?>"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>SEAM STRENGTH):</td>
                    <td><input type="text" name="seamstrength" id="seamstrength" class="myclass" value="<?php echo $editresult['seamstrength']; ?>"></td>
                    <td><input type="text" name="seamstrengthlbs" id="seamstrengthlbs" class="myclass" value="<?php echo $editresult['seamstrengthlbs']; ?>"></td>
                    </tr>
                    <tr height="23">
                    <td height="23">Stretch &amp;    Recovery</td>
                    <td><input type="text" name="stretchwarp" id="stretchwarp" class="myclass" value="<?php echo $editresult['stretchwarp']; ?>"></td>
                    <td><input type="text" name="stretchweft" id="stretchweft" class="myclass" value="<?php echo $editresult['stretchweft']; ?>"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>Surface Finish</td>
                    <td>
                    <select name="surfaceFinish" id="surfaceFinish" class="myclass">
                    <option value="YES" <?php if($editresult['surfaceFinish']=='YES'){ ?> selected="selected" <?php } ?>>YES</option>
                    <option value="NO" <?php if($editresult['surfaceFinish']=='NO'){ ?> selected="selected" <?php } ?>>NO</option>
                    </select>	 </td>
                    <td><input type="text" name="surfacefinishsecond" id="surfacefinishsecond" class="myclass" value="<?php echo $editresult['surfacefinishsecond']; ?>"></td>
                    </tr>
                    <tr height="23">
                    <td height="23">&nbsp;</td>
                    <td><strong>Min.</strong></td>
                    <td><strong>Max.</strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>Surface&nbsp;Finish&nbsp;Type</td>
                    <td><input type="text" name="sufacefinishtype" id="sufacefinishtype" class="myclass" value="<?php echo $editresult['sufacefinishtype']; ?>"></td>
                    <td><input type="text" name="sufacefinishlbl" id="sufacefinishlbl" class="myclass" value="<?php echo $editresult['sufacefinishlbl']; ?>"></td></tr>
                    <tr height="23">
                    <td height="23">Weight / GSM Before    Wash :</td>
                    <td><input type="text" name="minweightbeore" id="minweightbeore" class="myclass" value="<?php echo $editresult['minweightbeore']; ?>"></td>
                    <td><input type="text" name="maxweightbeore" id="maxweightbeore" class="myclass" value="<?php echo $editresult['maxweightbeore']; ?>"></td>
                    <td><input type="text" name="minweightbeorefirst" id="minweightbeorefirst" class="myclass" value="<?php echo $editresult['minweightbeorefirst']; ?>"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>Performance Finish</td>
                    <td><input type="text" name="performacefinish" id="performacefinish" class="myclass" value="<?php echo $editresult['performacefinish']; ?>"></td>
                    <td><input type="text" name="performancefinishlabel" id="performancefinishlabel" class="myclass" value="<?php echo $editresult['performancefinishlabel']; ?>"></td>
                    </tr>
                    <tr height="23">
                    <td height="23">Weight / GSM After    Wash :</td>
                    <td><input type="text" name="minweightafter" id="minweightafter" class="myclass" value="<?php echo $editresult['minweightafter']; ?>"></td>
                    <td><input type="text" name="maxweightafter" id="maxweightafter" class="myclass" value="<?php echo $editresult['maxweightafter']; ?>"></td>
                    <td><input type="text" name="minweightbeoresecond" id="minweightbeoresecond" class="myclass" value="<?php echo $editresult['minweightbeoresecond']; ?>"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>High Elongation</td>
                    <td><select name="highelongation" id="highelongation" class="myclass">
                    <option value="YES" <?php if($editresult['highelongation']=='YES'){ ?> selected="selected" <?php } ?>>YES</option>
                    <option value="NO" <?php if($editresult['highelongation']=='NO'){ ?> selected="selected" <?php } ?>>NO</option>
                    </select></td>
                    <td><input type="text" name="highelongationlbl" id="highelongationlbl" class="myclass" value="<?php echo $editresult['highelongationlbl']; ?>"></td>
                    </tr>
                    <tr height="23">
                    <td height="23">Torque&nbsp;/&nbsp;Bow&nbsp;/&nbsp;Skew</td>
                    <td><input type="text" name="mintorque" id="mintorque" class="myclass" value="<?php echo $editresult['mintorque']; ?>"></td>
                    <td><input type="text" name="maxtorque" id="maxtorque" class="myclass" value="<?php echo $editresult['maxtorque']; ?>"></td>
                    <td><input type="text" name="minweightbeorethird" id="minweightbeorethird" class="myclass" value="<?php echo $editresult['minweightbeorethird']; ?>"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>Type of Wash&nbsp;</td>
                    <td><input type="text" name="typeofwash" id="typeofwash" class="myclass" value="<?php echo $editresult['typeofwash']; ?>"></td>
                    <td><input type="text" name="typeofwashlbl" id="typeofwashlbl" class="myclass" value="<?php echo $editresult['typeofwashlbl']; ?>"></td>
                    </tr>
                    </table>
                    </div>
                    <div class="datatable-scroll" style="overflow:auto !important;">

                    <table cellspacing="0" cellpadding="0" class="table" style="margin-top:20px;">
                    <tr height="23" style="background-color: #324148; color: #fff;">
                    <td colspan="9" height="23">WASHED FINISH SPECIFICATIONS</td>
                    </tr>
                    <tr height="23">
                    <td height="23">&nbsp;</td>
                    <td>
                    <!--<strong>Warp</strong>-->
                    </td>
                    <td>
                    <!--<strong>Weft</strong>-->
                    </td>
                    <td>&nbsp;</td>
                    <td ></td>

                    <td ></td>
                    <td>TEAR (Warp/Weft):</td>
                    <td><input type="text" name="wtearwarp" id="wtearwarp" class="myclass" value="<?php echo $editresult['wtearwarp']; ?>"></td>
                    <td><input type="text" name="wtearlbs" id="wtearlbs" class="myclass" value="<?php echo $editresult['wtearlbs']; ?>"></td>

                    </tr>
                    <tr height="23">
                    <td height="23">Yarn Count </td>
                    <td><input type="text" name="wcountwarp" id="wcountwarp" class="myclass" value="<?php echo $editresult['wcountwarp']; ?>"></td>
                    <td><input type="text" name="wcountweft" id="wcountweft" class="myclass" value="<?php echo $editresult['wcountweft']; ?>"></td>
                    <td><input type="text" name="wcount_th" id="wcount_th" class="myclass" value="<?php echo $editresult['wcount_th']; ?>"></td>
                    <td><input type="text" name="wcount_four" id="wcount_four" class="myclass" value="<?php echo $editresult['wcount_four']; ?>"></td>

                    <td><input type="text" name="wcount_five" id="wcount_five" class="myclass" value="<?php echo $editresult['wcount_five']; ?>"></td>


                    <!--<td>&nbsp;</td>-->
                    <td>TENSILE (Warp/Weft):</td>
                    <td><input type="text" name="wtestilewarp" id="wtestilewarp" class="myclass" value="<?php echo $editresult['wtestilewarp']; ?>"></td>
                    <td><input type="text" name="wtestilelbs" id="wtestilelbs" class="myclass" value="<?php echo $editresult['wtestilelbs']; ?>"></td>
                    </tr>
                    <tr height="23">
                    <td height="23">Construction</td>
                    <td><input type="text" name="wconstructionwarp" id="wconstructionwarp" class="myclass" value="<?php echo $editresult['wconstructionwarp']; ?>"></td>
                    <td><input type="text" name="wconstructionweft" id="wconstructionweft" class="myclass" value="<?php echo $editresult['wconstructionweft']; ?>"></td>
                    <!--<td>&nbsp;</td>-->
                    <td colspan="1"></td>
                    <td colspan="1"></td>

                    <td colspan="1"> </td>


                    <td>SEAM SLIPPAGE):</td>
                    <td><input type="text" name="wseamslippage" id="wseamslippage" class="myclass" value="<?php echo $editresult['wseamslippage']; ?>"></td>
                    <td><input type="text" name="wseamslippagelbs" id="wseamslippagelbs" class="myclass" value="<?php echo $editresult['wseamslippagelbs']; ?>"></td>
                    </tr>
                    <tr height="23">
                    <td height="23">Shrinkage</td>
                    <td><input type="text" name="wshrinkagewarp" id="wshrinkagewarp" class="myclass" value="<?php echo $editresult['wshrinkagewarp']; ?>"></td>
                    <td><input type="text" name="wshrinkageweft" id="wshrinkageweft" class="myclass" value="<?php echo $editresult['wshrinkageweft']; ?>"></td>
                    <!--<td>&nbsp;</td>-->
                    <td colspan="1"></td>
                    <td colspan="1"></td>

                    <td colspan="1"></td>


                    <td>SEAM STRENGTH):</td>
                    <td><input type="text" name="wseamstrength" id="wseamstrength" class="myclass" value="<?php echo $editresult['wseamstrength']; ?>"></td>
                    <td><input type="text" name="wseamstrengthlbs" id="wseamstrengthlbs" class="myclass" value="<?php echo $editresult['wseamstrengthlbs']; ?>"></td>
                    </tr>
                    <tr height="23">
                    <td height="23">Stretch &amp;    Recovery</td>
                    <td><input type="text" name="wstretchwarp" id="wstretchwarp" class="myclass" value="<?php echo $editresult['wstretchwarp']; ?>"></td>
                    <td><input type="text" name="wstretchweft" id="wstretchweft" class="myclass" value="<?php echo $editresult['wstretchweft']; ?>"></td>
                    <!--<td>&nbsp;</td>-->
                    <td colspan="1"></td>
                    <td colspan="1"></td>

                    <td colspan="1"></td>


                    <td>Surface Finish</td>
                    <td>
                    <select name="wsurfaceFinish" id="wsurfaceFinish" class="myclass">
                    <option value="YES" <?php if($editresult['wsurfaceFinish']=='YES'){ ?> selected="selected" <?php } ?>>YES</option>
                    <option value="NO" <?php if($editresult['wsurfaceFinish']=='NO'){ ?> selected="selected" <?php } ?>>NO</option>
                    </select>	 </td>
                    <td><input type="text" name="wsurfacefinishsecond" id="wsurfacefinishsecond" class="myclass" value="<?php echo $editresult['wsurfacefinishsecond']; ?>"></td>
                    </tr>
                    <tr height="23">
                    <td height="23">&nbsp;</td>
                    <td><strong>Min.</strong></td>
                    <td><strong>Max.</strong></td>
                    <td>&nbsp;</td>
                    <td ></td>

                    <td ></td>

                    <td>Surface&nbsp;Finish&nbsp;Type</td>
                    <td><input type="text" name="wsufacefinishtype" id="wsufacefinishtype" class="myclass" value="<?php echo $editresult['wsufacefinishtype']; ?>"></td>
                    <td><input type="text" name="wsufacefinishlbl" id="wsufacefinishlbl" class="myclass" value="<?php echo $editresult['wsufacefinishlbl']; ?>"></td></tr>
                    <tr height="23">
                    <td height="23">Weight / GSM Before    Wash :</td>
                    <td><input type="text" name="wminweightbeore" id="wminweightbeore" class="myclass" value="<?php echo $editresult['wminweightbeore']; ?>"></td>
                    <td><input type="text" name="wmaxweightbeore" id="wmaxweightbeore" class="myclass" value="<?php echo $editresult['wmaxweightbeore']; ?>"></td>
                    <td><input type="text" name="wminweightbeorefirst" id="wminweightbeorefirst" class="myclass" value="<?php echo $editresult['wminweightbeorefirst']; ?>"></td>
                    <td ></td>

                    <td ></td>
                    <td>Performance Finish</td>
                    <td><input type="text" name="wperformacefinish" id="wperformacefinish" class="myclass" value="<?php echo $editresult['wperformacefinish']; ?>"></td>
                    <td><input type="text" name="wperformancefinishlabel" id="wperformancefinishlabel" class="myclass" value="<?php echo $editresult['wperformancefinishlabel']; ?>"></td>
                    </tr>
                    <tr height="23">
                    <td height="23">Weight / GSM After    Wash :</td>
                    <td><input type="text" name="wminweightafter" id="wminweightafter" class="myclass" value="<?php echo $editresult['wminweightafter']; ?>"></td>
                    <td><input type="text" name="wmaxweightafter" id="wmaxweightafter" class="myclass" value="<?php echo $editresult['wmaxweightafter']; ?>"></td>
                    <td><input type="text" name="wminweightbeoresecond" id="wminweightbeoresecond" class="myclass" value="<?php echo $editresult['wminweightbeoresecond']; ?>"></td>
                    <td ></td>

                    <td ></td>
                    <td>High Elongation</td>
                    <td><select name="whighelongation" id="whighelongation" class="myclass">
                    <option value="YES" <?php if($editresult['whighelongation']=='YES'){ ?> selected="selected" <?php } ?>>YES</option>
                    <option value="NO" <?php if($editresult['whighelongation']=='NO'){ ?> selected="selected" <?php } ?>>NO</option>
                    </select></td>
                    <td><input type="text" name="whighelongationlbl" id="whighelongationlbl" class="myclass" value="<?php echo $editresult['whighelongationlbl']; ?>"></td>
                    </tr>
                    <tr height="23">
                    <td height="23">Torque&nbsp;/&nbsp;Bow&nbsp;/&nbsp;Skew</td>
                    <td><input type="text" name="wmintorque" id="wmintorque" class="myclass" value="<?php echo $editresult['wmintorque']; ?>"></td>
                    <td><input type="text" name="wmaxtorque" id="wmaxtorque" class="myclass" value="<?php echo $editresult['wmaxtorque']; ?>"></td>
                    <td><input type="text" name="wminweightbeorethird" id="wminweightbeorethird" class="myclass" value="<?php echo $editresult['wminweightbeorethird']; ?>"></td>
                    <!--<td>Type of Wash&nbsp;</td>-->
                    <td ></td>

                    <td ></td>
                    <td><input type="text" name="wtypeofwash" id="wtypeofwash" class="myclass" value="<?php echo $editresult['wtypeofwash']; ?>"></td>
                    <td><input type="text" name="wtypeofwashlbl" id="wtypeofwashlbl" class="myclass" value="<?php echo $editresult['wtypeofwashlbl']; ?>"></td>
                    </tr>
                    </table>
                    </div>
                    <div class="datatable-scroll" style="overflow:auto !important;">
                    <table class="table table-bordered table-hover no-footer" style="width:100%;"cellspacing="0" cellpadding="0" class="table" style="margin-top:20px;">
                    <tr height="23" style="background-color: #324148; color: #fff;">
                    <td colspan="10" height="23">PROCESS&nbsp;LEAD&nbsp;TIMES</td>
                    </tr>
                    <tr height="23">
                    <td height="23">&nbsp;</td>
                    <td><strong>MOQ</strong></td>
                    <td><strong>Price/Kg</strong></td>

                    <td><strong>  PRICE/YD</strong></td>

                    <td><strong>Solid</strong></td>
                    <td><strong>Print</strong></td>
                    <td><strong>Yarn Dyed</strong></td>
                    <td><strong>Heather</strong> </td>

                    <td><strong>Feeder Stripe</strong> </td>
                    <td><strong>Auto Stripe</strong> </td>


                    </tr>
                    <tr height="15">
                    <td height="15">PFD&nbsp;Lead&nbsp;Time</td>

                    <td><input type="text" name="yarnleadtimes_moq" id="yarnleadtimes_moq" class="myclass" value="<?php echo $editresult['yarnleadtimes_moq']; ?>"></td>
                    <td><input type="text" name="yarnleadtimesprice_kg" id="yarnleadtimesprice_kg" class="myclass" value="<?php echo $editresult['yarnleadtimesprice_kg']; ?>"></td>

                    <td><input type="text" name="yarnleadtimesprice_yd" id="yarnleadtimesprice_yd" class="myclass" value="<?php echo $editresult['yarnleadtimesprice_yd']; ?>"></td>


                    <td><input type="text" name="yarnleadtimesolid" id="yarnleadtimesolid" class="myclass" value="<?php echo $editresult['yarnleadtimesolid']; ?>"></td>
                    <td><input type="text" name="yarnleadtimeprint" id="yarnleadtimeprint" class="myclass" value="<?php echo $editresult['yarnleadtimeprint']; ?>"></td>
                    <td><input type="text" name="yarnleadtimeyarn" id="yarnleadtimeyarn" class="myclass" value="<?php echo $editresult['yarnleadtimeyarn']; ?>"></td>
                    <td><input type="text" name="yarnleadtimeheather" id="yarnleadtimeheather" class="myclass" value="<?php echo $editresult['yarnleadtimeheather']; ?>"></td>


                    <td><input type="text" name="yarnleadtimes_feeder" id="yarnleadtimes_feeder" class="myclass" value="<?php echo $editresult['yarnleadtimes_feeder']; ?>"></td>
                    <td><input type="text" name="yarnleadtimes_auto" id="yarnleadtimes_auto" class="myclass" value="<?php echo $editresult['yarnleadtimes_auto']; ?>"></td>


                    </tr>
                    <tr height="23">
                    <td height="23">Knitting/&nbsp;weaving&nbsp;lead&nbsp;time</td>
                    <td><input type="text" name="weavingleadtime_moq" id="weavingleadtime_moq" class="myclass" value="<?php echo $editresult['weavingleadtime_moq']; ?>"></td>
                    <td><input type="text" name="weavingleadtimeprice_kg" id="weavingleadtimeprice_kg" class="myclass" value="<?php echo $editresult['weavingleadtimeprice_kg']; ?>"></td>

                    <td><input type="text" name="weavingleadtimeprice_yd" id="weavingleadtimeprice_yd" class="myclass" value="<?php echo $editresult['weavingleadtimeprice_yd']; ?>"></td>


                    <td><input type="text" name="weavingleadtimesolid" id="weavingleadtimesolid" class="myclass" value="<?php echo $editresult['weavingleadtimesolid']; ?>"></td>
                    <td><input type="text" name="weavingleadtimeprint" id="weavingleadtimeprint" class="myclass" value="<?php echo $editresult['weavingleadtimeprint']; ?>"></td>
                    <td><input type="text" name="weavingleadtimeyarn" id="weavingleadtimeyarn" class="myclass" value="<?php echo $editresult['weavingleadtimeyarn']; ?>"></td>
                    <td><input type="text" name="weavingleadtimeheather" id="weavingleadtimeheather" class="myclass" value="<?php echo $editresult['weavingleadtimeheather']; ?>"></td>

                    <td><input type="text" name="weavingleadtime_feeder" id="weavingleadtime_feeder" class="myclass" value="<?php echo $editresult['weavingleadtime_feeder']; ?>"></td>
                    <td><input type="text" name="weavingleadtime_auto" id="weavingleadtime_auto" class="myclass" value="<?php echo $editresult['weavingleadtime_auto']; ?>"></td>


                    </tr>











                    <tr height="23">
                    <td height="23">Print Lead Time</td>
                    <td><input type="text" name="printleadtime_moq" id="printleadtime_moq" class="myclass" value="<?php echo $editresult['printleadtime_moq']; ?>"></td>
                    <td><input type="text" name="printleadtimeprice_kg" id="printleadtimeprice_kg" class="myclass" value="<?php echo $editresult['printleadtimeprice_kg']; ?>"></td>

                    <td><input type="text" name="printleadtimeyard_yd" id="printleadtimeyard_yd" class="myclass" value="<?php echo $editresult['printleadtimeyard_yd']; ?>"></td>



                    <td><input type="text" name="printleadtimesolid" id="printleadtimesolid" class="myclass" value="<?php echo $editresult['printleadtimesolid']; ?>"></td>
                    <td><input type="text" name="printleadtimeprint" id="printleadtimeprint" class="myclass" value="<?php echo $editresult['printleadtimeprint']; ?>"></td>
                    <td><input type="text" name="printleadtimeyarn" id="printleadtimeyarn" class="myclass" value="<?php echo $editresult['printleadtimeyarn']; ?>"></td>
                    <td><input type="text" name="printleadtimeheather" id="printleadtimeheather" class="myclass" value="<?php echo $editresult['printleadtimeheather']; ?>"></td>

                    <td><input type="text" name="printleadtime_feeder" id="printleadtime_feeder" class="myclass" value="<?php echo $editresult['printleadtime_feeder']; ?>"></td>
                    <td><input type="text" name="printleadtime_auto" id="printleadtime_auto" class="myclass" value="<?php echo $editresult['printleadtime_auto']; ?>"></td>


                    </tr>







                    <tr height="23">
                    <td height="23">Lead Time</td>
                    <td><input type="text" name="le_leadtime_moq" id="le_leadtime_moq" class="myclass" value="<?php echo $editresult['le_leadtime_moq']; ?>"></td>
                    <td><input type="text" name="le_leadtimeprice_kg" id="le_leadtimeprice_kg" class="myclass" value="<?php echo $editresult['le_leadtimeprice_kg']; ?>"></td>
                    <td><input type="text" name="le_leadtimeyard_yd" id="le_leadtimeyard_yd" class="myclass" value="<?php echo $editresult['le_leadtimeyard_yd']; ?>"></td>




                    <td><input type="text" name="le_leadtimesolid" id="le_leadtimesolid" class="myclass" value="<?php echo $editresult['le_leadtimesolid']; ?>"></td>
                    <td><input type="text" name="le_leadtimeprint" id="le_leadtimeprint" class="myclass" value="<?php echo $editresult['le_leadtimeprint']; ?>"></td>
                    <td><input type="text" name="le_leadtimeyarn" id="le_leadtimeyarn" class="myclass" value="<?php echo $editresult['le_leadtimeyarn']; ?>"></td>
                    <td><input type="text" name="le_leadtimeheather" id="le_leadtimeheather" class="myclass" value="<?php echo $editresult['le_leadtimeheather']; ?>"></td>

                    <td><input type="text" name="le_leadtime_feeder" id="le_leadtime_feeder" class="myclass" value="<?php echo $editresult['le_leadtime_feeder']; ?>"></td>
                    <td><input type="text" name="le_leadtime_auto" id="le_leadtime_auto" class="myclass" value="<?php echo $editresult['le_leadtime_auto']; ?>"></td>


                    </tr>




                    <tr height="23">
                    <td height="23">Dyed Lead Time</td>


                    <td><input type="text" name="dyeingleadtime_moq" id="dyeingleadtime_moq" class="myclass" value="<?php echo $editresult['dyeingleadtime_moq']; ?>"></td>
                    <td><input type="text" name="dyeingleadtimeprice_kg" id="dyeingleadtimeprice_kg" class="myclass" value="<?php echo $editresult['dyeingleadtimeprice_kg']; ?>"></td>

                    <td><input type="text" name="dyeingleadtimeyard_yd" id="dyeingleadtimeyard_yd" class="myclass" value="<?php echo $editresult['dyeingleadtimeyard_yd']; ?>"></td>


                    <td><input type="text" name="dyeingsolid" id="dyeingsolid" class="myclass" value="<?php echo $editresult['dyeingsolid']; ?>"></td>
                    <td><input type="text" name="dyeingprint" id="dyeingprint" class="myclass" value="<?php echo $editresult['dyeingprint']; ?>"></td>
                    <td><input type="text" name="dyeingyarn" id="dyeingyarn" class="myclass" value="<?php echo $editresult['dyeingyarn']; ?>"></td>
                    <td><input type="text" name="dyeingheather" id="dyeingheather" class="myclass" value="<?php echo $editresult['dyeingheather']; ?>"></td>
                    <td><input type="text" name="dyeingleadtime_feeder" id="dyeingleadtime_feeder" class="myclass" value="<?php echo $editresult['dyeingleadtime_feeder']; ?>"></td>
                    <td><input type="text" name="dyeingleadtime_auto" id="dyeingleadtime_auto" class="myclass" value="<?php echo $editresult['dyeingleadtime_auto']; ?>"></td>



                    </tr>
                    <tr height="23">
                    <td height="23">Testing/    Shipping (est) leadtime:</td>
                    <td><input type="text" name="testingleadtime_moq" id="testingleadtime_moq" class="myclass" value="<?php echo $editresult['testingleadtime_moq']; ?>"></td>
                    <td><input type="text" name="testingleadtimeprice_kg" id="testingleadtimeprice_kg" class="myclass" value="<?php echo $editresult['testingleadtimeprice_kg']; ?>"></td>

                    <td><input type="text" name="testingleadtimeyard_yd" id="testingleadtimeyard_yd" class="myclass" value="<?php echo $editresult['testingleadtimeyard_yd']; ?>"></td>


                    <td><input type="text" name="testingsolid" id="testingsolid" class="myclass" value="<?php echo $editresult['testingsolid']; ?>"></td>
                    <td><input type="text" name="testingprint" id="testingprint" class="myclass" value="<?php echo $editresult['testingprint']; ?>"></td>
                    <td><input type="text" name="testingyarn" id="testingyarn" class="myclass" value="<?php echo $editresult['testingyarn']; ?>"></td>
                    <td><input type="text" name="testingheather" id="testingheather" class="myclass" value="<?php echo $editresult['testingheather']; ?>"></td>

                    <td><input type="text" name="testingleadtime_feeder" id="testingleadtime_feeder" class="myclass" value="<?php echo $editresult['testingleadtime_feeder']; ?>"></td>
                    <td><input type="text" name="testingleadtime_auto" id="testingleadtime_auto" class="myclass" value="<?php echo $editresult['testingleadtime_auto']; ?>"></td>


                    </tr>
                    <tr height="23">
                    <td height="23">Total fabric    leadtime:</td>
                    <td><input type="text" name="totalleadtime_moq" id="totalleadtime_moq" class="myclass" value="<?php echo $editresult['totalleadtime_moq']; ?>"></td>
                    <td><input type="text" name="totalleadtimeprice_kg" id="totalleadtimeprice_kg" class="myclass" value="<?php echo $editresult['totalleadtimeprice_kg']; ?>"></td>

                    <td><input type="text" name="totalleadtimeyard_yd" id="totalleadtimeyard_yd" class="myclass" value="<?php echo $editresult['totalleadtimeyard_yd']; ?>"></td>

                    <td><input type="text" name="totalsolid" id="totalsolid" class="myclass" value="<?php echo $editresult['totalsolid']; ?>"></td>
                    <td><input type="text" name="totalprint" id="totalprint" class="myclass" value="<?php echo $editresult['totalprint']; ?>"></td>
                    <td><input type="text" name="totalyarn" id="totalyarn" class="myclass" value="<?php echo $editresult['totalyarn']; ?>"></td>
                    <td><input type="text" name="totalheather" id="totalheather" class="myclass" value="<?php echo $editresult['totalheather']; ?>"></td>


                    <td><input type="text" name="totalleadtime_feeder" id="totalleadtime_feeder" class="myclass" value="<?php echo $editresult['totalleadtime_feeder']; ?>"></td>
                    <td><input type="text" name="totalleadtime_auto" id="totalleadtime_auto" class="myclass" value="<?php echo $editresult['totalleadtime_auto']; ?>"></td>


                    </tr>
                    </table>

                    </div>
                    <table cellspacing="0" cellpadding="0" class="table" style="margin-top:20px;">
                    <tr height="23" style="background-color: #324148; color: #fff;">
                    <td colspan="2" height="23">ANY SPECIAL CALL OUT'S AND ALERTS</td>
                    </tr>
                    <tr height="23">
                    <td height="23">1</td>
                    <td><input type="text" name="specialcall1" id="specialcall1" class="myclass" value="<?php echo $editresult['specialcall1']; ?>"></td>
                    </tr>
                    <tr height="23">
                    <td height="23">2</td>
                    <td><input type="text" name="specialcall2" id="specialcall2" class="myclass" value="<?php echo $editresult['specialcall2']; ?>" /></td>
                    </tr>
                    <tr height="23">
                    <td height="23">3</td>
                    <td><input type="text" name="specialcall3" id="specialcall3" class="myclass" value="<?php echo $editresult['specialcall3']; ?>" /></td>
                    </tr>
                    <tr height="23">
                    <td height="23">4</td>
                    <td><input type="text" name="specialcall4" id="specialcall4" class="myclass" value="<?php echo $editresult['specialcall4']; ?>" /></td>
                    </tr>
                    <tr height="23">
                    <td height="23">5</td>
                    <td><input type="text" name="specialcall5" id="specialcall5" class="myclass" value="<?php echo $editresult['specialcall5']; ?>" /></td>
                    </tr>
                    </table>
                    <?php
                    if($_GET['status']==''){
                    ?>
                    <div class="text-right" style=" margin: 30px 0px;">
                    <button type="submit" class="btn btn-primary" style="margin:0px;" >Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>
                    <input type="hidden" name="action" id="action" value="<?php echo $_GET['module']; ?>">
                    <input type="hidden" name="editId" id="editId" value="<?php echo encode($lastId); ?>">
                    </div>
                    <?php } ?>


                    </div>




                    </div>
                    </div>

                    </div>
                    </form>
                    </div>
                    </div>

                    </div>

                    <style>
                    table tr td{
                    border:1px solid #ccc;
                    }
                    .table td, .table th {
                    padding: 5px 5px;
                    }
                    .myclass {
                    height: auto;
                    padding: 5px 10px;
                    padding-left: 5px;
                    width: -webkit-fill-available;
                    background-color: #f9f9f9;
                    border: 1px solid #dcdcdc;
                    outline: none !important;
                    }
                    .Zebra_DatePicker_Icon_Wrapper{
                    width: -webkit-fill-available !important;
                    }
                    </style>

                    <script>
                    $('.newdatepicker').Zebra_DatePicker({
                    format: 'd-m-Y',
                    });
                     function tries(){

                         var fwid= $("#fullwidthInches").val();
                    var gsm=$("#gsm").val();
                    var tr=1000;
                    var yy=fwid*gsm*0.0254;
                    var calc=tr/yy;
                    var fcalc=calc/0.914;
                     var vt=fcalc.toFixed(2)
                    $('#mtr_kg').val(calc.toFixed(2));

                    $('#yrd_kg').val(vt);

                        //  var wer=   $('#yrd_kg').val();

                        //  var werq= $('#price_kg').val();

                        //  var resuyu = Number(werq)/Number(wer);


                        // $('#price').val(resuyu.toFixed(2));






                     }

                    </script>

