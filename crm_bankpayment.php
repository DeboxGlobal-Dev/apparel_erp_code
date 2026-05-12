<?php
if(isset($_GET['search'])){

  $VoucherNo = trim($_GET['VoucherNo']);
  $TransactionDate = trim($_GET['TransactionDate']);
  $Type = "BP";

  $jsonData = '{
    "VoucherNo":"'.$VoucherNo.'",
    "TransactionDate":"'.$TransactionDate.'",
    "Type":"'.$Type.'"
  }';

  $newurl = $serverurlapi."vouchers/listVoucherEntryAPI.php";
  $resultData = postCurlData($newurl,$jsonData);
  //logger('Response return from listVoucherEntryAPI: '.$resultData);
  $accountData = json_decode($resultData);

  }
?>
<div class="page-content">
    <div class="content-wrapper">
        <div class="content pt-0" style="margin-top:20px;">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
                        <div class="col-xl-9">
                            <h5 class="card-title"><?php echo $pageName; ?></h5>
                        </div>
                        <div class="col-xl-3" style="    padding-right: 0px;">
              <div class="btn-group justify-content-center" style="float:right;">
                                <a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes" class="btn bg-teal-400 addnotify" aria-expanded="false" style="    background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
                              </div>
            </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <form name"search" method="GET" action="">
                    <input type="hidden" name="module" value="<?php echo $_GET['module']; ?>" />
                    <div class="row" style="padding:20px;">
                        <div class="col-md-2">
                            <div class="">
                                <input name="VoucherNo" type="text" class="form-control" id="voucherNo"
                                    value="<?php echo $_GET['VoucherNo']; ?>" placeholder="Enter Voucher No...">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="">
                                <input name="TransactionDate" type="text" class="form-control"
                                    id="TransactionDate"
                                    value="<?php if($_GET['TransactionDate']!=''){ echo date('Y-m-d',strtotime($_GET['TransactionDate'])); } ?>"
                                    readonly="" placeholder="Voucher Date">
                            </div>
                        </div>
<script>
$('#TransactionDate').Zebra_DatePicker({
	//format: 'd-m-Y',
    show_icon: true,
});
</script>
                        <!-- <div class="col-md-2">
              <div class="">
                <select name="factoryId" id="factoryId" class="form-control" onchange="selectFactory(this.value);">
                  <option value="">Select Factory</option>
                  <?php
								$fk=GetPageRecord('*','recorderMaster','1 group by factoryId');
								while($factoryData=mysqli_fetch_array($fk)){
								$a=GetPageRecord('*','factoryMaster','id="'.$factoryData['factoryId'].'"');
								$selectdata=mysqli_fetch_array($a); ?>
                  <option value="<?php echo $factoryData['factoryId']; ?>" <?php if($factoryData['factoryId']==$_GET['factoryId']){ ?> selected="selected" <?php } ?>><?php echo $selectdata['name']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>-->

                        <!-- <div class="col-md-2">
              <div class="">
                <div id="loadrecorderinputlines">
                  <select class="form-control" name="line[]" id="line" multiple="multiple">
                    <?php
$select='*';
$where='1 and factoryId="'.$_GET['factoryId'].'" order by id asc';
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
            </div>-->
                        <!-- <script>
$(function() {
$('#line').multiselect({
includeSelectAllOption: true,
enableFiltering: true,
enableCaseInsensitiveFiltering: true,
filterPlaceholder: 'Search...'
});
});
</script> -->
                        <div class="col-md-2">
                            <div class="">
                                <input name="search" type="submit" class="btn bg-teal-400" id="search" value="Search">
                            </div>
                        </div>
                    </div>
                </form>


                <div class="col-md-12" style="margin-bottom: 20px; padding: 10PX 20PX;">
                    <table width="100%" border="1" cellpadding="5" cellspacing="0" class="table"
                        style="font-size: 12px !important; width: 100%; border: 1px solid #ccc !important;">
                        <tr
                            style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">

                            <td align="center">
                                <div align="left">Date</div>
                            </td>
                            <td align="center">
                                <div align="left">Voucher&nbsp;No</div>
                            </td>
                            <td align="center">
                                <div align="left">Account Name </div>
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
                            <!-- <td align="center"><div align="left">Action</div></td> -->
                        </tr>
                        <tbody id="tablesearch">
                            <?php
    if(isset($accountData->status)=='true'){
    if(isset($accountData->VoucherData)){
    $no=1;
	$arrData='';
	foreach($accountData->VoucherData as $resultList){
        $value =  get_object_vars($resultList->ListOfArray);
	?>
      <tr class="uyt hgte"
          style="background: #e0f5e0;font-size: 12px !important;border-bottom: 1px solid #ccc;">

          <td><?php echo date('d-M-Y',strtotime($resultList->TransactionDate)); ?></td>
          <td><?php echo $resultList->VoucherNo; ?></td>
          <td><?php echo $value['AccountName']; ?></td>
          <td>-</td>
          <td><?php echo $value['Amount']; ?></td>
          <td>-</td>
          <!--<td><a href="addBankVoucherEntry.php"><i class="fa fa-pencil" style="font-size: 18px; color:#0000FF;"></i></a> <a href="listBankVoucherEntry.php?type=<?php echo encode("delete"); ?>&did=<?php echo encode($resultList->Id); ?>&action=searchaction&branchCode=<?php echo $_GET['branchCode']; ?>&productType=<?php echo $_GET['productType']; ?>" onClick="return  confirm('are you sure you want to delete?');"><i class="fa fa-trash" style="font-size: 18px; color:#FF0000;"></i></a> </td>-->
      </tr>
      <?php
foreach($value['listOfData'] as $arrData){
?>
      <tr class="uyt hgte" style="font-size: 12px !important;border-bottom: 1px solid #ccc;">
          <td></td>
          <td></td>
          <td><?php echo $arrData->AccountName; ?></td>
          <td><a style="color:#0000FF; " href="#" data-toggle="modal" data-target="#modalpop"
          onClick="opmodalpop('Narration','modelpop.php?action=showJournalNarration&ndetail=<?php echo htmlentities($arrData->Narration); ?>','100%','auto');"><?php echo $arrData->Narration; ?></a></td>
          <td><?php echo $arrData->Debit; ?></td>
          <td><?php echo $arrData->Credit; ?></td>
      </tr>
<?php
    }
    $no++;
   }
  }
  }
  else{?>
          <tr class="uyt hgte">
              <td colspan="14">
                  <div align="center"><?php echo 'You Can Search...'; ?></div>
              </td>
          </tr>
          <?php }
    ?>
                        </tbody>
                    </table>
                </div>

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

.hwp tr {
    border-bottom: 1px solid #ccc;
}

table tr td {
    border: 1px solid #ccc;

}
</style>