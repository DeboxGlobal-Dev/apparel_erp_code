<?php

$searching = '{
  "Type":"'.$_GET['Type'].'",
  "Branch":"'.$_GET['accountName'].'",
  "fromDate":"'.date('Y-m-d',strtotime($_GET['fromDate'])).'",
  "toDate":"'.date('Y-m-d',strtotime($_GET['toDate'])).'"
}';
$url = $serverurlapi."vouchers/ledgerAPI.php";
if($_GET['action']=="searchaction")
{
$result = postCurlData($url,$searching);
//logger('RESPONSE RETURN FROM LEDGER API: '.$result);
$result = json_decode($result, true);
}

//$AccountDetails = $result['AccountDetails'];
//$AccountDetailsF = $AccountDetails[0];

$LedgerData = $result['LedgerList'];
?>
<div class="page-content">
<div class="content-wrapper">
<div class="content pt-0" style="margin-top: 20px; width: 100%; margin-left: auto; margin-right: auto;">
<div class="row">
<div class="col-xl-12">
<div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
<div class="col-xl-9">
  <h5 class="card-title"><?php echo $pageName; ?></h5>
</div>
<div class="col-xl-3" style="padding-right: 0px;"> </div>
</div>
<div class="card border-left-3 border-left-danger-400 rounded-left-0"
style="border: 1px solid #ccc !important;">
<div class="card-body">
  <div class="row">
      <div class="col-md-12">
          <form name="search" method="GET" autocomplete="nope" action="" id="exportfrm">
              <input type="hidden" name="module" value="<?php echo $_GET['module']; ?>" />
              <div class="row" style="padding:15px 0px;">
                  <div class="col-md-2">
                      <div class="">
                          <input type="text" placeholder="Search:" name="filtersearch"
                              id="filtersearch" class="form-control" />
                      </div>
                  </div>

                  <!-- <div class="col-md-2"> -->
                  <!-- <div class=""> -->
                  <!-- <select class="form-control" name="companyid" id="companyid" onchange="loadaccountnname(this.value);"> -->
                  <!-- <option value="">Company</option> -->
                  <?php
// $rsk=GetPageRecord('*','companyMaster','1 order by name asc');
// while($comData=mysqli_fetch_array($rsk)){
?>
                  <!-- <option value="<?php // echo $comData['id']; ?>" <?php // if($comData['id']==$_GET['companyid']){ ?> selected="selected" <?php // } ?>><?php // echo $comData['name']; ?></option> -->
                  <?php // } ?>
                  <!-- </select> -->
                  <!-- </div> -->
                  <!-- </div> -->
                  <div class="col-md-2">
                      <div class="">
                          <select class="form-control" name="accountName" id="accountName" onChange="funcCheckBal(this.value);">
                              <option value="">Select</option>
                              <?php
                              $jsonData = '{
                                "tableName":"all",
                                "code":"",
                                "Status":"1"
                                }';
                              $newurl = $fullurl."buyersupplierlist_api.php";
                              $resultData = postCurlData($newurl,$jsonData);
                              $accountData = json_decode($resultData);
                              if(isset($accountData->status)=='true'){
                              if(isset($accountData->AccountNameData)){
                              foreach($accountData->AccountNameData as $resultList){
                              ?>
                              <option value="<?php echo $resultList->AccountCode; ?>" data-bal="<?php echo $resultList->Balance; ?>" data-acc="<?php echo $resultList->AccountName; ?>"
                                  <?php if($resultList->AccountCode==trim($_GET["accountName"])){ echo 'selected'; }?>>
                                  <?php echo $resultList->AccountName; ?> [<?php echo $resultList->AccountCode; ?>]</option>
                              <?php } } } ?>
                          </select>
                      </div>
                  </div>
                  <div class="col-md-2">
                      <div class="">
                          <input name="fromDate" type="text"
                              class="datepickercommon form-control" id="fromDate"
                              value="<?php  if($_GET['fromDate']!=''){ echo date('d-m-Y', strtotime($_GET['fromDate'])); } ?>"
                              placeholder="From Date" readonly="">
                      </div>
                  </div>
                  <div class="col-md-2">
                      <div class="">
                          <input name="toDate" type="text"
                              class="datepickercommon form-control" id="toDate"
                              value="<?php  if($_GET['toDate']!=''){ echo date('d-m-Y', strtotime($_GET['toDate'])); } ?>"
                              placeholder="To Date" readonly="">
                      </div>
                  </div>
                  <div class="col-md-2">
                      <div class="">
                          <input type="hidden" id="action" name="action" value="" />
                          <input type="button" name="search" class="btn bg-teal-400"
                              onClick="searchFunc('searchaction');" value="Search" />
                      </div>
                  </div>
              </div>
              <input type="hidden" name="balance" id="balance" value="">
              <input type="hidden" name="accName" id="accName" value="">
          </form>
      </div>
      <script>
        function funcCheckBal(id){
            var balance = $('#accountName').find(':selected').attr('data-bal');

            $('#balance').val(balance);

            var accName = $('#accountName').find(':selected').attr('data-acc');

            $("#accName").val(accName);
        }

    </script>
      <script>
      function searchFunc(data) {
          $('#action').val(data);
          $('form#exportfrm').submit();
      }
      </script>
      <div class="col-md-12" >
          <form name="listform" id="listform" method="get" >
              <input name="module" id="module" type="hidden"
                  value="<?php echo $_REQUEST['module']; ?>" />
              <?php echo $accountUpperData['label']; ?>
              <table class="table table-bordered table-hover no-footer apparelclass">

                  <tr style="background-color: #646464; color: #fff; text-align: center;">
                      <td colspan="4">Account - <span id="accName"><?php echo $_GET['accName']; ?></span>
                      </td>
                      <!-- <td colspan="3">Opening Balance - <?php
$OpeningBalance = $AccountDetailsF['OpeningBalance'] == 0?0:($AccountDetailsF['OpeningBalance'] < 0?abs($AccountDetailsF['OpeningBalance'])." (Dr)":abs($AccountDetailsF['OpeningBalance'])." (Cr)");

echo $OpeningBalance; ?></td> -->

                      <td colspan="3">Current Balance - <span id=""><?php echo $_GET['balance']; ?></span></td><?php
  //$MainBalance = $AccountDetailsF['CurrentBalance'] == 0?0:($AccountDetailsF['CurrentBalance'] < 0?abs($AccountDetailsF['CurrentBalance'])." (Dr)":abs($AccountDetailsF['CurrentBalance'])." (Cr)");

//echo $MainBalance; ?>
                  </tr>
                  <tr
                      style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center">
                          <div align="left">Voucher&nbsp;No.</div>
                      </td>
                      <td align="center">
                          <div align="left">Voucher Date</div>
                      </td>
                      <td align="center">
                          <div align="left">Account&nbsp;Name</div>
                      </td>
                      <td align="center">
                          <div align="left">Narration</div>
                      </td>
                      <td align="center">
                          <div align="left">Debit</div>
                      </td>
                      <td align="center">
                          <div align="left">Credit</div>
                      </td>
                      <td align="center">
                          <div align="left">Balance</div>
                      </td>
                  </tr>
                  <tbody id="allhotellisting">
                      <?php
                      foreach($LedgerData as $resultList){
                      ?>
                      <tr>
                          <td align="center">
                              <div align="left"><?php echo $resultList['VoucherNo']; ?></div>
                          </td>
                          <td align="center">
                              <div align="left">
                                  <?php echo date('d-m-Y',strtotime($resultList['Date'])); ?>
                              </div>
                          </td>
                          <td align="center">
                              <div align="left"><?php echo getAccountName($resultList['AccountName']); ?> [<?php echo $resultList['AccountName']; ?>]
                              </div>
                          </td>
                          <td align="center">
                              <div align="left"><?php echo $resultList['Detail']; ?></div>
                          </td>
                          <td align="center">
                              <div align="left"><?php echo $resultList['Debit']; ?></div>
                          </td>
                          <td align="center">
                              <div align="left"><?php echo $resultList['Credit']; ?></div>
                          </td>
                          <td align="center">
                              <div align="left"><?php echo $resultList['Balance']; ?></div>
                          </td>
                      </tr>
                      <?php }  ?>
                  </tbody>
              </table>

              <div class="pagingdiv" style="width: 100%;margin: 20px auto;">
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tbody>
                          <tr>
                              <td>
                                  <table border="0" cellpadding="0" cellspacing="0">
                                      <tr>
                                          <td style="padding-right:20px;">
                                              <?php echo $totalentry; ?> entries</td>
                                          <td><select name="records" id="records"
                                                  onchange="this.form.submit();"
                                                  class="lightgrayfield"
                                                  style="padding: 5px;border: 1px solid #ccc; outline:none;">
                                                  <option value="25"
                                                      <?php if($_GET['records']=='25'){ ?>
                                                      selected="selected" <?php } ?>>25
                                                      Records Per Page</option>
                                                  <option value="50"
                                                      <?php if($_GET['records']=='50'){ ?>
                                                      selected="selected" <?php } ?>>50
                                                      Records Per Page</option>
                                                  <option value="100"
                                                      <?php if($_GET['records']=='100'){ ?>
                                                      selected="selected" <?php } ?>>100
                                                      Records Per Page</option>
                                                  <option value="200"
                                                      <?php if($_GET['records']=='200'){ ?>
                                                      selected="selected" <?php } ?>>200
                                                      Records Per Page</option>
                                                  <option value="300"
                                                      <?php if($_GET['records']=='300'){ ?>
                                                      selected="selected" <?php } ?>>300
                                                      Records Per Page</option>
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
          </form>
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
<script>
// function isLedger(id, glId) {

// if (glId == '0') {
// var conf = confirm('Are you sure you want to create General Ledger?');
// if (conf == true) {
// window.location.href = '<?php echo $fullurl; ?>showpage.crm?module=headcreation&id=' + id + '&glId=1';
// }
// } else {
// var conf = confirm('Are you sure you want to remove from General Ledger?');
// if (conf == true) {
// window.location.href = '<?php echo $fullurl; ?>showpage.crm?module=headcreation&id=' + id + '&glId=0';
// }
// }
// }


// function deleteHead(delId) {
// var conf = confirm('Are you sure you want delete?');
// if (conf == true) {
// window.location.href = '<?php echo $fullurl; ?>showpage.crm?module=headcreation&delId=' + delId;
// }
// }
</script>
<style>
.apparelclass tr td {
border-top: 0px solid #ccc !important;
border: 1px solid #ccc !important;
vertical-align: middle !important;
}
</style>
<script>
$(function() {
$(".datepickercommon").datepicker();
});
</script>
<!-- <script>
function loadaccountnname() {
var companyid = $('#companyid').val();
$('#accountName').load('loadaccountname.php?accountname=<?php echo $_GET['accountName']; ?>&id=' + companyid);
}
<?php if($_GET['companyid']!=""){ ?>
loadaccountnname();
<?php } ?>
</script> -->