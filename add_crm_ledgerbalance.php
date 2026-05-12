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
  logger($InfoMessage." Data Save .." );

  $filename = $_FILES['attachment']['name'];
  $file_tmp_name = $_FILES['attachment']['tmp_name'];

  $path = "uploads/";
  //$url = "".$serverurlapi."FronEnd/";
  logger("****** upload path ****** :".$path);
  $path = $path.basename( $_FILES['attachment']['name']);
  move_uploaded_file($file_tmp_name, $path);

  $jsonData = array(
       "branchAc" => trim($_POST['branchAc']),
       "paymentType" => trim($_POST['paymentType']),
       "bankAc" => trim($_POST['bankAc']),
       "credit" => trim($_POST['credit']),
       "chequeNo" => trim($_POST['chequeNo']),
       "chequeDate" => date('Y-m-d',strtotime($_POST['chequeDate'])),
       "bankName" => trim($_POST['bankName']),
       "narration" => trim($_POST['narration']),
       "religareBankName" => trim($_POST['religareBankName']),
       "status" => trim($_POST['status']),
       "attachment" => trim($filename),
       // "productType" => trim($_POST['productType']),
       "addedBy" => trim($_POST['addedBy'])
     );

  $insertData = http_build_query($jsonData);

  $url = $serverurlapi."vouchers/addBranchRechargeAPI.php";
  $ch = curl_init();
  logger($InfoMessage." Saving Data URL  .. ".$url );
  logger($InfoMessage." Saving Data as  .. ".$insertData );
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $insertData);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  $resultData = curl_exec($ch);
  logger($InfoMessage." Saving Data API Call Result  .. ".$resultData );
  curl_close($ch);

  logger($InfoMessage." Saving addBranchRechargeAPI.. ".$resultData );
  $_SESSION['error']=$resultData;

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
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Ledger A/c<span class="mandat">*</span></label>
                    <select class="form-control" name="branchAc" id="branchAc" required="">
                    <option value=''>Select</option>
                    <?php
                    if(isset($accountData->status)=='true'){
                    if(isset($accountData->AccountNameData)){
                    foreach($accountData->AccountNameData as $resultList){
                      if($resultList->AccountCode!='CP001'){
                    ?>
                    <option value="<?php echo $resultList->AccountCode; ?>"><?php echo $resultList->AccountName; ?> [<?php echo $resultList->AccountCode; ?>]</option>
                    <?php } } } }	?>
                  </select>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <label>Payment&nbsp;Type<span class="mandat">*</span></label>
                    <select class="form-control" name="paymentType" id="paymentType" >
                      <option value="">Select</option>
                      <option value="Cheque" >Cheque</option>
                      <option value="Online" >Online</option>
                      <option value="Direct" >Direct</option>
                      <option value="Cash" >Cash</option>
            </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Bank&nbsp;A/c<span class="mandat">*</span></label>
                    <input name="bankAc" type="text" class="form-control" id="bankAc">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Bank&nbsp;Name</label>
                    <input name="bankName" type="text" class="form-control" id="bankName">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Cheque&nbsp;Number</label>
                    <input name="chequeNo" type="text" class="form-control" id="chequeNo">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Cheque&nbsp;Date</label>
                    <input name="chequeDate" type="text" class="form-control newDatePicker" id="chequeDate">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Amount<span class="mandat">*</span></label>
                    <input name="credit" type="text" class="form-control" id="credit">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Company&nbsp;Bank&nbsp;Name<span class="mandat">*</span></label>
                    <select class="form-control" name="religareBankName" id="religareBankName" required>
                      <option value="">Select</option>
                      <?php
                      ////////////////////FETCH ACCOUNT NAME//////////////////////
                      $jsonData2 = '{
                        "tableName":"companyMaster",
                        "code":"",
                        "Status":"1"
                      }';
                      $newurl2 = $fullurl."buyersupplierlist_api.php";
                      $resultData2 = postCurlData($newurl2,$jsonData2);
                      //logger('Response return from account Name API: '.$resultData);
                      $accountNameData = json_decode($resultData2);
                      ///////////////////////////////////////////
                      if(isset($accountNameData->status)=='true'){
                        if(isset($accountNameData->AccountNameData)){
                        foreach($accountNameData->AccountNameData as $resultList){

                      ?>
                            <option value="<?php echo $resultList->AccountCode; ?>" <?php if($resultList->AccountCode==$editresult['religareBankName']){ echo "selected"; }?>><?php echo $resultList->AccountName; ?> [<?php echo $resultList->AccountCode; ?>]</option>
                      <?php } } } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Attachement</label>
                    <input name="attachment" type="file" class="form-control" id="attachment">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Narration<span class="mandat">*</span></label>
                    <textarea name="narration" id="narration"  class="form-control" rows="3"></textarea>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Status<span class="mandat">*</span></label>
                    <select class="form-control" name="status" id="status" >
                      <option value="0">Active</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
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

