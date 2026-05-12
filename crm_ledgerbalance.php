<?php

if($_POST['action']=='approveall'){
    $ackJson = '';
   foreach($_POST['acknowledgmentchecksingle'] as $voucherNumber){
       $ackJson.= '{
               "voucherNumber":"'.$voucherNumber.'"
           },';
   }

   $jsonPost = '{
       "userId": "'.$_SESSION['userid'].'",
   "ip":"'.$_SERVER["REMOTE_ADDR"].'",
       "ListOfVoucher":['.rtrim($ackJson,',').']
   }';

   $url =  $serverurlapi."vouchers/updateRechargeAPI.php";
   $response = postCurlData($url,$jsonPost);
   //logger("RESPONCE RETURN from Recharge approve API: ". $response);
   $responseData = json_decode($response);
   $Message = $responseData->Message;
   $Status = $responseData->Status;
   if($Status == 0){
       $_SESSION['error'] = 'Record Approved Successfully.';
   }else{
       $_SESSION['error'] = 'Error in Approve.';
   }


}


if($_GET['did']!=""){
$jsondelete = '{
	"editId":"'.decode($_GET['did']).'",
	"type":"'.decode($_GET['type']).'"
}';

$branchCode = trim($_GET['branchCode']);
$voucherNo = trim($_GET['voucherNo']);
// $productType = trim($_GET['productType']);

$url = $serverurlapi."vouchers/editDeleteRechargeAPI.php";
$resultData = postCurlData($url,$jsondelete);
//logger('Response return from listBranchRechargeAPI: '.$resultData);
}


if($_GET['action']=="searchaction"){
logger('------------------------------INSIDE SEARCH ACTION-------------------------');
$branchCode = trim($_POST['branchCode']);
$voucherNo = trim($_POST['voucherNo']);
$fromDate = date('Y-m-d',strtotime($_POST['fromDate']));
$toDate = date('Y-m-d',strtotime($_POST['toDate']));
// $productType = trim($_GET['productType']);

$jsonData = '{
  	"branchCode":"'.$branchCode.'",
    "voucherNo":"'.$voucherNo.'",
    "fromDate":"'.$fromDate.'",
    "toDate":"'.$toDate.'"
}';

$url = $serverurlapi."vouchers/listBranchRechargeAPI.php";
$resultData = postCurlData($url,$jsonData);
//logger('Response return from listBranchRechargeAPI: '.$resultData);
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
                                <input name="fromDate" type="text" class="form-control newDatePicker"
                                    id="fromDate"
                                    value="<?php if($_GET['fromDate']!=''){ echo date('Y-m-d',strtotime($_GET['fromDate'])); } ?>"
                                    readonly="" placeholder="From Date">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="">
                                <input name="toDate" type="text" class="form-control newDatePicker"
                                    id="toDate"
                                    value="<?php if($_GET['toDate']!=''){ echo date('Y-m-d',strtotime($_GET['toDate'])); } ?>"
                                    readonly="" placeholder="To Date">
                            </div>
                        </div>
<script>
//$('#TransactionDate').Zebra_DatePicker({
	//format: 'd-m-Y',
    //show_icon: true,
//});
</script>

                        <div class="col-md-2">
                            <div class="">
                            <input type="hidden" id="action" name="action" value="searchaction" />
                                <input name="search" type="submit" class="btn bg-teal-400" id="search" value="Search">
                            </div>
                        </div>
                    </div>
                </form>
                <form method="post" id="appfrom">


                <div class="col-md-12 tabledata" style="margin-bottom: 20px; padding: 10PX 20PX;">
                <div id="approvebutton" style="display:none; float:left;">
                        <button type="button" class="btn btn-success" style="font-size: 13px; font-weight: 700;" onClick="confirmsubmit();" >Approve</button>
                    </div>
                    <input type="hidden" name="action" value="approveall">
                <?php  if(isset($_SESSION['error'])!=''){ ?>
                    <div class="bs-example" id="messageDiv">
                    <!-- Success Alert -->
                        <div class="alert alert-dismissible fade show" style="border: solid 2px; border-block-color: green; font-weight: 800; font-size: 17px; color: green;">
                            <?php echo $_SESSION['error'];unset($_SESSION['error']); ?>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    </div>
                <?php } ?>
                    <table width="100%" border="1" cellpadding="5" cellspacing="0" class="table"
                        style="font-size: 12px !important; width: 100%; border: 1px solid #ccc !important;">
                        <tr style="">
                            <td><input  name="ackknowledmentCheckAll" type="checkbox" class="" id="ackknowledmentCheckAll" style="height: 17px;width: 50px;margin-top: 0;text-align: center;" /></td>
                            <td>Voucher&nbsp;No</td>
                            <td>Ledger Account
                            <td>Voucher Date</td>
                            <td>Amount</td>
                            <td>Cheque No.</td>
                            <td>Check&nbsp;Date</td>
                            <td>Bank Name</td>
                            <td>Company Account</td>
                            <td>Added&nbsp;By</td>
                            <td>Document</td>
                            <td>Narration</td>
                            <th>Status</th>
			                <!-- <th>Action</th> -->
                        </tr>
                        <tbody id="tablesearch">
    <?php
    if(isset($accountData->status)=='true'){
        if(isset($accountData->WalletData)){
        $no=1;
        foreach($accountData->WalletData as $resultList){
	?>
      <tr class="uyt hgte"
          style="background: #e0f5e0;font-size: 12px !important;border-bottom: 1px solid #ccc;">
         <td><input type="checkbox" style=" opacity:1; cursor: pointer; height: 17px; width: 50px; margin-top: 3px;" value="<?php echo $resultList->VoucherNo; ?>" name="acknowledgmentchecksingle[]"  class="deleteack"/></td>
        <td><?php echo $resultList->VoucherNo; ?></td>
        <td><?php echo $resultList->BranchCode; ?></td>
        <td><?php echo dateFormatAll($resultList->VoucherDate); ?></td>
        <td><?php echo $resultList->Credit; ?></td>
        <td><?php echo $resultList->Cheque; ?></td>
        <td><?php echo dateFormatAll($resultList->ChequeDate); ?></td>
        <td><?php echo $resultList->BankName; ?></td>
        <td><?php echo $resultList->ReligareBankName; ?></td>
        <td title="<?php echo $resultList->AddedBy.' '.date("d-M-Y h:ia",strtotime($resultList->AddedDate)); ?>"><?php if($resultList->AddedBy!="Not Found"){ echo substr($resultList->AddedBy,0,5).'..'; } ?></td>
        <td><strong><a href="uploads/<?php echo $resultList->Attachment; ?>" target="_blank">View</a></strong></td>
        <td><a  style="color:#0000FF; " href="#" data-toggle="modal" data-target="#modalpop" onClick="opmodalpop('Narration','modelpop.php?action=showNarration&ndetail=<?php echo htmlentities($resultList->Narration); ?>','100%','auto');"><?php echo substr($resultList->Narration,0,10); ?>...</a></td>
        <td>Pending</td>
        <!-- <td>
			  <a href="addBankVoucherEntry.php"><i class="fa fa-pencil" style="font-size: 18px; color:#0000FF;"></i></a>
			  <a href="listBankVoucherEntry.php?type=<?php echo encode("delete"); ?>&did=<?php echo encode($resultList->Id); ?>&action=searchaction&branchCode=<?php echo $_GET['branchCode']; ?>&productType=<?php echo $_GET['productType']; ?>" onClick="return  confirm('are you sure you want to delete?');"><i class="fa fa-trash" style="font-size: 18px; color:#FF0000;"></i></a>
			  </td> -->
      </tr>
      <?php
    $no++;
  }
}
  }
  else{?>
    <tr class="uyt hgte">
<td colspan="14"><div align="center"><?php echo 'You Can Search...'; ?></div></td>
    </tr>
    <?php }
    ?>
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
<script>
  function confirmsubmit(){
  	var confirmfrom = confirm("Are you sure you want to approve?");
	if(confirmfrom==true){
		$('#appfrom').submit();
	}else{
		//$('#processBar').hide();
	}
  }
</script>
<script type="text/javascript">
$(document).ready(function(){
    // check uncheck all inclusions
    $("#ackknowledmentCheckAll").click(function(){
    if(this.checked){
      $('.deleteack').each(function(){
        this.checked = true;
      })
    }else{
      $('.deleteack').each(function(){
        this.checked = false;
      })
    }
    });

    });

    window.setInterval(function(){
      checked = $(".tabledata input[type=checkbox]:checked").length;
      if(!checked) {
        $("#approvebutton").hide();
      } else {
        $("#approvebutton").show();
      }
    }, 1000);
</script>
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