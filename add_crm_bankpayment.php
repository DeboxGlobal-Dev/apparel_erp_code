<?php
////////////////////FETCH ACCOUNT NAME//////////////////////
$jsonData = '{
  "tableName":"all",
  "code":"",
  "Status":"1"
}';
$newurl = $fullurl."buyersupplierlist_api.php";
$resultData = postCurlData($newurl,$jsonData);
//logger('Response return from account Name API: '.$resultData);
$accountData = json_decode($resultData);
///////////////////////////////////////////


//insert bank voucher entry
if(isset($_POST['addbranchinfo'])){

  $no = 0;
  $transactionJson = '';
  foreach($_POST['accountName'] as $accountRow){
    if($_POST['accountName'][$no]!=''){
    $transactionJson.= '{
          "AccountName":"'.$_POST['accountName'][$no].'",
          "Debit":"'.$_POST['debit'][$no].'",
          "Narration":"'.$_POST['narration'][$no].'"
        },';

      }
  $no++;
  }


  $jsonData = '{
    "VoucherDate":"'.date('Y-m-d',strtotime($_POST['voucherDate'])).'",
    "EntryDate":"'.date('Y-m-d',strtotime($_POST['voucherEntryDate'])).'",
    "UserId":"'.$_POST['addedBy'].'",
    "ip":"'.$_SERVER["REMOTE_ADDR"].'",
    "BankAccount":"'.$_POST['bankAccount'].'",
    "ListOfTransaction":['.rtrim($transactionJson,',').']

  }';

  $url = $serverurlapi."vouchers/addBankPaymentAPI.php";
  $response = postCurlData($url,$jsonData);
  $res = json_decode($response,true);


  logger($InfoMessage." Saving addBankPaymentAPI.. ".$response);
  $_SESSION['error']=$response;

  }
?>
<div class="page-content">
<div class="content-wrapper">
  <div class="content pt-0" style="margin-top: 20px; width: 100%; margin-left: auto; margin-right: auto;">
    <div class="row">
      <div class="col-xl-12">
      <?php if(isset($_SESSION['error'])!=''){ ?>
              <div class="bs-example" style="padding-top: 14px;padding-left: 19px;padding-right: 19px;">
                <!-- Success Alert -->
                <div class="alert alert-dismissible fade show" style="border: solid 2px;border-block-color: green;"> <?php echo $_SESSION['error'];unset($_SESSION['error']); ?>
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
              </div>
              <?php } ?>
        <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
          <div class="col-xl-9">
            <h5 class="card-title">Add <?php echo $pageName; ?></h5>
          </div>
          <div class="col-xl-3" style="padding-right: 0px;">
            <div class="btn-group justify-content-center" style="float:right;"> </div>
          </div>
        </div>
        <form action="" method="post" enctype="multipart/form-data" name="popid" id="popid">
          <input name="action" type="hidden" id="action" value="addbranchinfo" />
          <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['module']; ?>" />
          <input type="hidden" name="addedBy"  class="inp-t newdate" value="<?php echo $_SESSION["userid"]; ?>" >
          <div class="card border-left-3 border-left-danger-400 rounded-left-0" style="border: 1px solid #ccc !important;">
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Voucher No.</label>
                    <input type="text" name="voucherNo" class="form-control" value="Auto Generated" style="background: #f7f7f7;"   readonly />
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label>Voucher Entry Date<span class="mandat">*</span></label>
                    <input name="voucherEntryDate" type="text" class="form-control newDatePicker" id="voucherEntryDate" value="<?php echo date('d-m-Y'); ?>" readonly="">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label>Voucher Date<span class="mandat">*</span></label>
                    <input name="voucherDate" type="text" class="form-control newDatePicker" id="voucherDate" value="<?php echo date('d-m-Y'); ?>" readonly="">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label>Bank Account</label>
                    <select class="form-control" name="bankAccount" id="bankAccount" required="">
                      <option value=''>Select</option>
                      <?php
                      if(isset($accountData->status)=='true'){
                      if(isset($accountData->AccountNameData)){
                      foreach($accountData->AccountNameData as $resultList){
                      ?>
                      <option value="<?php echo $resultList->AccountCode; ?>"><?php echo $resultList->AccountName; ?> [<?php echo $resultList->AccountCode; ?>]</option>
                      <?php } } }	?>
                    </select>
                  </div>
                </div>

              </div>
              <div class="row">
                <div class="col-md-12">
                  <table width="100%" border="1" cellpadding="5" cellspacing="0" class="table" style="font-size: 12px !important; width: 100%; border: 1px solid #ccc !important;">
                    <tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td><div><a style="color:#0000FF; cursor: pointer;" class="add-row">+Add&nbsp;New</a>
                        </div></td>
                      <td>Account&nbsp;Name</td>
                      <td>Debit</td>
									    <td>Narration</td>
                    </tr>
                      <?php for($w=1;$w<=3;$w++){?>
                        <tr id="row_<?php echo $w; ?>">
                        <td>
                        <?php if($w > 1){	?>
                        <i class="fa fa-trash" aria-hidden="true" style="color:#FF0000;font-size: 18px;cursor:pointer;" onclick="funDeleteRow(<?php echo $w; ?>);"></i>
                        <?php } ?>
                        </td>
                        <td>
                          <select class="form-control" name="accountName[]">
                              <option value=''>Select</option>
                          <?php
                          if(isset($accountData->status)=='true'){
                          if(isset($accountData->AccountNameData)){
                          foreach($accountData->AccountNameData as $resultList){
                          ?>
                          <option value="<?php echo $resultList->AccountCode; ?>"><?php echo $resultList->AccountName; ?> [<?php echo $resultList->AccountCode; ?>]</option>
                          <?php } } }	?>
                          </select>
			                  </td>
                        <td><input type="number" name="debit[]" onBlur="funcSumValue();" onKeyUp="funcDebitEnable(<?php echo $w; ?>);" id="debit_<?php echo $w; ?>" class="debitsum form-control" value="0" ></td>
                        <td><input type="text" name="narration[]" id="narration_<?php echo $w; ?>" class="form-control" value="" ></td>
                      </tr>
                      <?php } ?>
                      <tr id="commonrow">
                        <td colspan="5" align="center"></td>
                      </tr>
                    </tbody>

                  </table>
                  <div style="margin-top:20px; width:100%; display:block; text-align:right;">
                    <button name="addbranchinfo" type="submit" class="btn btn-primary" id="btnsubmit" style="margin:0px; width:100px;">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /main content -->
</div>
<script>

        let rowno = 6;
        $(document).ready(function () {
            $(".add-row").click(function () {
				$('#commonrow').hide();
                rows = "<tr id='row_"+rowno+"'><td><i class='fa fa-trash' aria-hidden='true' style='color:#FF0000;font-size: 18px;cursor:pointer;' onclick='funDeleteRow("+rowno+");'></i></td><td><select class='form-control' name='accountName[]' ><option value=''>Select</option><?php
				if(isset($accountData->status)=='true'){
				if(isset($accountData->AccountNameData)){
				$no=1;
				foreach($accountData->AccountNameData as $resultList){
				?><option value='<?php echo $resultList->AccountCode; ?>'><?php echo $resultList->AccountName; ?> [<?php echo $resultList->AccountCode; ?>]</option><?php } } } ?></select></td><td><input type='number' name='debit[]' id='debit_"+rowno+"'  onkeyup='funcDebitEnable("+rowno+");' onBlur='funcSumValue();' class='creditsum form-control' value='0' ></td><td><input type='text' name='narration[]' id='narration_"+rowno+"' class='v form-control'  value=''></td></tr>";
                tableBody = $("table tbody");
                tableBody.append(rows);
                rowno++;
            });
        });

		function funDeleteRow(id){
			$('#row_'+id).empty();
		}


    function funcSumValue(){
			var totalSumCredit = 0;
			var totalSumDebit = 0;
			$('.creditsum').each(function () {
				totalSumCredit += parseFloat(this.value);
			});

			$('.debitsum').each(function () {
				totalSumDebit += parseFloat(this.value);
			});

			if(totalSumCredit==totalSumDebit){
				//$('#btnsubmit').show();
			}else{
				//$('#btnsubmit').hide();
			}

		}

    </script>
