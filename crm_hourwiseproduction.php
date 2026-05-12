<div class="page-content">
  <div class="content-wrapper">
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
            <div class="col-xl-12">
              <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>
          </div>
        </div>
      </div>
      <?php
$lineValue=$_POST['line'];
?>
      <div class="card">
        <form name"search" method="post" action="">
          <input type="hidden" name="module" value="<?php echo $_POST['module']; ?>" />
          <div class="row" style="padding:20px;">
            <div class="col-md-2" >
              <div class="">
                <input name="fromDate" type="text" class="newDatePicker form-control" id="fromDate" value="<?php if($_POST['fromDate']!=''){ echo date('d-m-Y',strtotime($_POST['fromDate'])); } else{ echo date('d-m-Y'); } ?>" readonly="">
              </div>
            </div>
            <div class="col-md-2">
              <div class="">
                <select name="factoryId" id="factoryId" class="form-control" onchange="selectFactory(this.value);">
                  <option value="">Select Factory</option>
                  <?php
								$fk=GetPageRecord('*','recorderMaster','1 group by factoryId');
								while($factoryData=mysqli_fetch_array($fk)){
								$a=GetPageRecord('*','factoryMaster','id="'.$factoryData['factoryId'].'"');
								$selectdata=mysqli_fetch_array($a); ?>
                  <option value="<?php echo $factoryData['factoryId']; ?>" <?php if($factoryData['factoryId']==$_POST['factoryId']){ ?> selected="selected" <?php } ?>><?php echo $selectdata['name']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <script>
						function selectFactory(id){
						 $('#loadrecorderinputlines').load('loadrecorderinputlineshourwise.php?id='+id+'lineValue=<?php echo $lineValue; ?>');
						}
						</script>
            <div class="col-md-2">
              <div class="">
                <div id="loadrecorderinputlines">
                  <select class="form-control" name="line[]" id="line" multiple="multiple">
                    <?php
$select='*';
$where='1 and factoryId="'.$_POST['factoryId'].'" order by id asc';
$rs=GetPageRecord($select,'recorderMaster',$where);
while($rest=mysqli_fetch_array($rs)){

$checked='';
if(in_array($rest['line'],$lineValue)){
$checked='selected';
}
$kr=GetPageRecord('*','factoryLineMaster','id="'.$rest['line'].'"');
$linename=mysqli_fetch_array($kr);

?>
                    <option value="<?php echo $rest['line']; ?>" <?php echo $checked; ?>><?php echo $linename['lineName']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <script>
$(function() {
$('#line').multiselect({
includeSelectAllOption: true,
enableFiltering: true,
enableCaseInsensitiveFiltering: true,
filterPlaceholder: 'Search...'
});
});
</script>
            <div class="col-md-2">
              <div class="">
                <input name="search" type="submit" class="btn bg-teal-400" id="search" value="Search">
              </div>
            </div>
          </div>
        </form>
        <?php

foreach($lineValue as $myLine){

$rkdm=GetPageRecord('*','recorderInputMaster','1 and factoryId="'.$_POST['factoryId'].'" and line="'.$myLine.'" and fromDate="'.date('Y-m-d',strtotime($_POST['fromDate'])).'" order by id desc');
$styleId=mysqli_fetch_array($rkdm);

?>
        <?php if($_POST['factoryId']!='' && $myLine!=''){ ?>
        <div class="col-md-12" style="margin-bottom: 20px; padding: 10PX 20PX;">
          <table width="100%" cellpadding="5" cellspacing="0" style="text-align: center; background-color: #e5fbfa; font-size: 14px;">
            <tr>
              <td style="border: 1px solid #ccc;"><strong>Date</strong></td>
              <td style="border: 1px solid #ccc;"><strong>Style</strong></td>
              <td style="border: 1px solid #ccc;"><strong>Factory</strong></td>
              <td style="border: 1px solid #ccc;"><strong>Line</strong></td>
            </tr>
            <tr style="border:1px solid #ccc;">
              <td style="border: 1px solid #ccc;"><?php echo $_POST['fromDate']; ?></td>
              <td style="border: 1px solid #ccc;"><?php
						$rkdm=GetPageRecord('*','queryMaster','1 and id="'.$styleId['styleId'].'"');
						$editresultstyle=mysqli_fetch_array($rkdm);
						echo $editresultstyle['subject'];

						?>
              </td>
              <td style="border: 1px solid #ccc;"><?php
						$a=GetPageRecord('*','factoryMaster','1 and id="'.$_POST['factoryId'].'"');
						$fname=mysqli_fetch_array($a);
						echo $fname['name'];

						?>
              </td>
              <td style="border: 1px solid #ccc;"><?php
						$b=GetPageRecord('*','factoryLineMaster','1 and id="'.$myLine.'"');
						$linename=mysqli_fetch_array($b);
						echo $linename['lineName'];

						?></td>
            </tr>
          </table>
        </div>
        <div class="col-md-12" style="padding: 0PX 20PX;">
          <table cellspacing="0" cellpadding="5" style="width:100%; margin-bottom:20px;border: 1px solid #ccc;">
            <tr style="background-color: #fff7b3; text-align:center;">
              <td width="91">&nbsp;</td>
              <td><strong>Loading</strong></td>
              <td><strong>Output</strong></td>
              <td width="91" align="left"><div align="center"><strong>Operator</strong></div></td>
              <td width="91" align="left"><div align="center"><strong>Helper</strong></div></td>
              <td width="91" align="left"><div align="center"><strong>Supervisor</strong></div></td>
              <td width="91" align="left"><div align="center"><strong>Checker</strong></div></td>
              <td width="91" align="left"><div align="center"><strong>Total Resource</strong></div></td>
              <td width="200" align="left"><strong>Remarks</strong></td>
            </tr>
            <?php
$loadingremain=0;
$outputremain=0;

$rdkm=GetPageRecord('loading,output,remarks,operator,helper,supervisor,checker,total','recorderInputMaster','1 and factoryId="'.$_POST['factoryId'].'" and line="'.$myLine.'" and fromDate="'.date('Y-m-d',strtotime($_POST['fromDate'])).'" and hours="1st Hour"');
$hourWiseReport1=mysqli_fetch_array($rdkm); ?>
            <tr>
              <td height="33" style="background-color: #e5fbfa;"><div align="center"><strong>1st Hour </strong></div></td>
              <td width="73"><div align="center"><?php echo $hourWiseReport1['loading'];  if($hourWiseReport1['loading']!='' && $hourWiseReport1['loading']>0){ $loadingremain=$loadingremain+$hourWiseReport1['loading']; } ?></div></td>
              <td width="67"><div align="center"><?php echo $hourWiseReport1['output']; if($hourWiseReport1['output']!='' && $hourWiseReport1['output']>0){ $outputremain=$outputremain+$hourWiseReport1['output'];} ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['operator']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['helper']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['supervisor']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['checker']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['total']; ?></div></td>
              <td width="200"><?php echo $hourWiseReport1['remarks']; ?></td>
            </tr>
            <?php
$rdkm=GetPageRecord('loading,output,remarks,operator,helper,supervisor,checker,total','recorderInputMaster','1 and factoryId="'.$_POST['factoryId'].'" and line="'.$myLine.'" and fromDate="'.date('Y-m-d',strtotime($_POST['fromDate'])).'" and hours="2nd Hour"');
$hourWiseReport1=mysqli_fetch_array($rdkm); ?>
            <tr>
              <td height="33" style="background-color: #e5fbfa;"><div align="center"><strong>2nd Hour</strong></div></td>
              <td width="73"><div align="center"><?php echo $hourWiseReport1['loading']; if($hourWiseReport1['loading']!='' && $hourWiseReport1['loading']>0){ $loadingremain=$loadingremain+$hourWiseReport1['loading'];} ?></div></td>
              <td width="67"><div align="center"><?php echo $hourWiseReport1['output']; if($hourWiseReport1['output']!='' && $hourWiseReport1['output']>0){ $outputremain=$outputremain+$hourWiseReport1['output'];} ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['operator']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['helper']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['supervisor']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['checker']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['total']; ?></div></td>
              <td width="200"><?php echo $hourWiseReport1['remarks']; ?></td>
            </tr>
            <?php
$rdkm=GetPageRecord('loading,output,remarks,operator,helper,supervisor,checker,total','recorderInputMaster','1 and factoryId="'.$_POST['factoryId'].'" and line="'.$myLine.'" and fromDate="'.date('Y-m-d',strtotime($_POST['fromDate'])).'" and hours="3rd Hour"');
$hourWiseReport1=mysqli_fetch_array($rdkm); ?>
            <tr>
              <td height="33" style="background-color: #e5fbfa;"><div align="center"><strong>3rd Hour</strong></div></td>
              <td width="73"><div align="center"><?php echo $hourWiseReport1['loading']; if($hourWiseReport1['loading']!='' && $hourWiseReport1['loading']>0){ $loadingremain=$loadingremain+$hourWiseReport1['loading'];} ?></div></td>
              <td width="67"><div align="center"><?php echo $hourWiseReport1['output']; if($hourWiseReport1['output']!='' && $hourWiseReport1['output']>0){ $outputremain=$outputremain+$hourWiseReport1['output'];} ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['operator']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['helper']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['supervisor']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['checker']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['total']; ?></div></td>
              <td width="200"><?php echo $hourWiseReport1['remarks']; ?></td>
            </tr>
            <?php
$rdkm=GetPageRecord('loading,output,remarks,operator,helper,supervisor,checker,total','recorderInputMaster','1 and factoryId="'.$_POST['factoryId'].'" and line="'.$myLine.'" and fromDate="'.date('Y-m-d',strtotime($_POST['fromDate'])).'" and hours="4th Hour"');
$hourWiseReport1=mysqli_fetch_array($rdkm); ?>
            <tr>
              <td height="33" style="background-color: #e5fbfa;"><div align="center"><strong>4th Hour</strong></div></td>
              <td width="73"><div align="center"><?php echo $hourWiseReport1['loading']; if($hourWiseReport1['loading']!='' && $hourWiseReport1['loading']>0){ $loadingremain=$loadingremain+$hourWiseReport1['loading'];} ?></div></td>
              <td width="67"><div align="center"><?php echo $hourWiseReport1['output']; if($hourWiseReport1['output']!='' && $hourWiseReport1['output']>0){ $outputremain=$outputremain+$hourWiseReport1['output'];} ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['operator']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['helper']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['supervisor']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['checker']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['total']; ?></div></td>
              <td width="200"><?php echo $hourWiseReport1['remarks']; ?></td>
            </tr>
            <?php
$rdkm=GetPageRecord('loading,output,remarks,operator,helper,supervisor,checker,total','recorderInputMaster','1 and factoryId="'.$_POST['factoryId'].'" and line="'.$myLine.'" and fromDate="'.date('Y-m-d',strtotime($_POST['fromDate'])).'" and hours="5th Hour"');
$hourWiseReport1=mysqli_fetch_array($rdkm); ?>
            <tr>
              <td height="33" style="background-color: #e5fbfa;"><div align="center"><strong>5th Hour</strong></div></td>
              <td width="73"><div align="center"><?php echo $hourWiseReport1['loading']; if($hourWiseReport1['loading']!='' && $hourWiseReport1['loading']>0){ $loadingremain=$loadingremain+$hourWiseReport1['loading'];} ?></div></td>
              <td width="67"><div align="center"><?php echo $hourWiseReport1['output']; if($hourWiseReport1['output']!='' && $hourWiseReport1['output']>0){ $outputremain=$outputremain+$hourWiseReport1['output'];} ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['operator']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['helper']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['supervisor']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['checker']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['total']; ?></div></td>
              <td width="200"><?php echo $hourWiseReport1['remarks']; ?></td>
            </tr>
            <?php
$rdkm=GetPageRecord('loading,output,remarks,operator,helper,supervisor,checker,total','recorderInputMaster','1 and factoryId="'.$_POST['factoryId'].'" and line="'.$myLine.'" and fromDate="'.date('Y-m-d',strtotime($_POST['fromDate'])).'" and hours="6th Hour"');
$hourWiseReport1=mysqli_fetch_array($rdkm); ?>
            <tr>
              <td height="33" style="background-color: #e5fbfa;"><div align="center"><strong>6th Hour</strong></div></td>
              <td width="73"><div align="center"><?php echo $hourWiseReport1['loading']; if($hourWiseReport1['loading']!='' && $hourWiseReport1['loading']>0){ $loadingremain=$loadingremain+$hourWiseReport1['loading'];} ?></div></td>
              <td width="67"><div align="center"><?php echo $hourWiseReport1['output']; if($hourWiseReport1['output']!='' && $hourWiseReport1['output']>0){ $outputremain=$outputremain+$hourWiseReport1['output'];} ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['operator']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['helper']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['supervisor']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['checker']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['total']; ?></div></td>
              <td width="200"><?php echo $hourWiseReport1['remarks']; ?></td>
            </tr>
            <?php
$rdkm=GetPageRecord('loading,output,remarks,operator,helper,supervisor,checker,total','recorderInputMaster','1 and factoryId="'.$_POST['factoryId'].'" and line="'.$myLine.'" and fromDate="'.date('Y-m-d',strtotime($_POST['fromDate'])).'" and hours="7th Hour"');
$hourWiseReport1=mysqli_fetch_array($rdkm); ?>
            <tr>
              <td height="33" style="background-color: #e5fbfa;"><div align="center"><strong>7th Hour</strong></div></td>
              <td width="73"><div align="center"><?php echo $hourWiseReport1['loading']; if($hourWiseReport1['loading']!='' && $hourWiseReport1['loading']>0){ $loadingremain=$loadingremain+$hourWiseReport1['loading'];} ?></div></td>
              <td width="67"><div align="center"><?php echo $hourWiseReport1['output']; if($hourWiseReport1['output']!='' && $hourWiseReport1['output']>0){ $outputremain=$outputremain+$hourWiseReport1['output'];} ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['operator']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['helper']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['supervisor']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['checker']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['total']; ?></div></td>
              <td width="200"><?php echo $hourWiseReport1['remarks']; ?></td>
            </tr>
            <?php
$rdkm=GetPageRecord('loading,output,remarks,operator,helper,supervisor,checker,total','recorderInputMaster','1 and factoryId="'.$_POST['factoryId'].'" and line="'.$myLine.'" and fromDate="'.date('Y-m-d',strtotime($_POST['fromDate'])).'" and hours="8th Hour"');
$hourWiseReport1=mysqli_fetch_array($rdkm); ?>
            <tr>
              <td height="33" style="background-color: #e5fbfa;"><div align="center"><strong>8th Hour</strong></div></td>
              <td width="73"><div align="center"><?php echo $hourWiseReport1['loading']; if($hourWiseReport1['loading']!='' && $hourWiseReport1['loading']>0){ $loadingremain=$loadingremain+$hourWiseReport1['loading'];} ?></div></td>
              <td width="67"><div align="center"><?php echo $hourWiseReport1['output']; if($hourWiseReport1['output']!='' && $hourWiseReport1['output']>0){ $outputremain=$outputremain+$hourWiseReport1['output'];} ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['operator']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['helper']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['supervisor']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['checker']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['total']; ?></div></td>
              <td width="200"><?php echo $hourWiseReport1['remarks']; ?></td>
            </tr>
            <?php
$rdkm=GetPageRecord('loading,output,remarks,operator,helper,supervisor,checker,total','recorderInputMaster','1 and factoryId="'.$_POST['factoryId'].'" and line="'.$myLine.'" and fromDate="'.date('Y-m-d',strtotime($_POST['fromDate'])).'" and hours="9th Hour"');
$hourWiseReport1=mysqli_fetch_array($rdkm); ?>
            <tr>
              <td height="33" style="background-color: #e5fbfa;"><div align="center"><strong>9th Hour</strong></div></td>
              <td width="73"><div align="center"><?php echo $hourWiseReport1['loading']; if($hourWiseReport1['loading']!='' && $hourWiseReport1['loading']>0){ $loadingremain=$loadingremain+$hourWiseReport1['loading'];} ?></div></td>
              <td width="67"><div align="center"><?php echo $hourWiseReport1['output']; if($hourWiseReport1['output']!='' && $hourWiseReport1['output']>0){ $outputremain=$outputremain+$hourWiseReport1['output'];} ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['operator']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['helper']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['supervisor']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['checker']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['total']; ?></div></td>
              <td width="200"><?php echo $hourWiseReport1['remarks']; ?></td>
            </tr>
            <?php
$rdkm=GetPageRecord('loading,output,remarks,operator,helper,supervisor,checker,total','recorderInputMaster','1 and factoryId="'.$_POST['factoryId'].'" and line="'.$myLine.'" and fromDate="'.date('Y-m-d',strtotime($_POST['fromDate'])).'" and hours="10th Hour"');
$hourWiseReport1=mysqli_fetch_array($rdkm); ?>
            <tr>
              <td height="33" style="background-color: #e5fbfa;"><div align="center"><strong>10th Hour</strong></div></td>
              <td width="73"><div align="center"><?php echo $hourWiseReport1['loading']; if($hourWiseReport1['loading']!='' && $hourWiseReport1['loading']>0){ $loadingremain=$loadingremain+$hourWiseReport1['loading'];} ?></div></td>
              <td width="67"><div align="center"><?php echo $hourWiseReport1['output']; if($hourWiseReport1['output']!='' && $hourWiseReport1['output']>0){ $outputremain=$outputremain+$hourWiseReport1['output'];} ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['operator']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['helper']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['supervisor']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['checker']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['total']; ?></div></td>
              <td width="200"><?php echo $hourWiseReport1['remarks']; ?></td>
            </tr>
            <?php
$rdkm=GetPageRecord('loading,output,remarks,operator,helper,supervisor,checker,total','recorderInputMaster','1 and factoryId="'.$_POST['factoryId'].'" and line="'.$myLine.'" and fromDate="'.date('Y-m-d',strtotime($_POST['fromDate'])).'" and hours="11th Hour"');
$hourWiseReport1=mysqli_fetch_array($rdkm); ?>
            <tr>
              <td height="33" style="background-color: #e5fbfa;"><div align="center"><strong>11th Hour</strong></div></td>
              <td width="73"><div align="center"><?php echo $hourWiseReport1['loading']; if($hourWiseReport1['loading']!='' && $hourWiseReport1['loading']>0){ $loadingremain=$loadingremain+$hourWiseReport1['loading'];} ?></div></td>
              <td width="67"><div align="center"><?php echo $hourWiseReport1['output']; if($hourWiseReport1['output']!='' && $hourWiseReport1['output']>0){ $outputremain=$outputremain+$hourWiseReport1['output'];} ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['operator']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['helper']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['supervisor']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['checker']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['total']; ?></div></td>
              <td width="200"><?php echo $hourWiseReport1['remarks']; ?></td>
            </tr>
            <?php
$rdkm=GetPageRecord('loading,output,remarks,operator,helper,supervisor,checker,total','recorderInputMaster','1 and factoryId="'.$_POST['factoryId'].'" and line="'.$myLine.'" and fromDate="'.date('Y-m-d',strtotime($_POST['fromDate'])).'" and hours="12th Hour"');
$hourWiseReport1=mysqli_fetch_array($rdkm); ?>
            <tr>
              <td height="33" style="background-color: #e5fbfa;"><div align="center"><strong>12th Hour</strong></div></td>
              <td width="73"><div align="center"><?php echo $hourWiseReport1['loading']; if($hourWiseReport1['loading']!='' && $hourWiseReport1['loading']>0){ $loadingremain=$loadingremain+$hourWiseReport1['loading'];} ?></div></td>
              <td width="67"><div align="center"><?php echo $hourWiseReport1['output']; if($hourWiseReport1['output']!='' && $hourWiseReport1['output']>0){ $outputremain=$outputremain+$hourWiseReport1['output'];} ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['operator']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['helper']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['supervisor']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['checker']; ?></div></td>
              <td width="50"><div align="center"><?php echo $hourWiseReport1['total']; ?></div></td>
              <td width="200"><?php echo $hourWiseReport1['remarks']; ?></td>
            </tr>
            <tr align="center"  style="background-color: #f1eaea; font-weight:700;">
              <td>Total</td>
              <td><?php echo $loadingremain; ?></td>
              <td><?php echo $outputremain; ?></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
        </div>
        <?php } else{ ?>
        <div class="col-md-12" style="margin-bottom: 20px; padding: 10PX 20PX; font-size: 16px; color: #0288d1; text-align: left;"><strong>Select Factory and Line</strong></div>
        <?php } }  ?>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<style>
.liststyleimg{
	float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}

.badge.dropdown-toggle:after { display:none;
}
.hwp tr{
border-bottom:1px solid #ccc;
}
table tr td{
border:1px solid #ccc;

}
</style>
