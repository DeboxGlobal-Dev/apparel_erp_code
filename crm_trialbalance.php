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
        <div class="card border-left-3 border-left-danger-400 rounded-left-0" style="border: 1px solid #ccc !important;">
          <div class="card-body">
            <div class="row">
			<div class="col-md-12">
                <form name="search" method="GET" action="">
                  <input type="hidden"  name="module" value="<?php echo $_GET['module']; ?>"/>
                  <div class="row" style="padding:15px 0px;">
                    <div class="col-md-2">
                      <div class="">
                        <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" class="form-control" />
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="">
                        <select class="form-control" name="companyid" id="companyid" onchange="loadaccountnname(this.value);">
                          <option value="">Company</option>
                          <?php
								$rsk=GetPageRecord('*','companyMaster','1 order by name asc');
								while($comData=mysqli_fetch_array($rsk)){
								?>
                          <option value="<?php echo $comData['id']; ?>" <?php if($comData['id']==$_GET['companyid']){ ?> selected="selected" <?php } ?>><?php echo $comData['name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="">
                        <input name="search" type="submit" class="btn bg-teal-400" id="search" value="Search">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-md-12">
                <form name="listform" id="listform" method="get">
                  <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
                  <?php echo $accountUpperData['label']; ?>
                  <table class="table table-bordered table-hover no-footer apparelclass" width="100%">


				   <?php if($_GET['companyid']!=""){

$upperbq=GetPageRecord('*','balancesMaster','1 and companyid="'.$_GET['companyid'].'" and financialYear in (select id from financialYearMaster where  fromDate<="'.date('Y-m-d').'" and toDate>="'.date('Y-m-d').'")');

$upperbalData=mysqli_fetch_array($upperbq);

$uppercq=GetPageRecord('name','companyMaster','1 and id="'.$upperbalData['companyid'].'"');
$uppercomName=mysqli_fetch_array($uppercq);

$fqcq=GetPageRecord('name','financialYearMaster','1 and id="'.$upperbalData['financialYear'].'"');
$upperfincName=mysqli_fetch_array($fqcq);


$upperadq=GetPageRecord('label','finalheadcreationmaster','1 and id="'.$_GET['accountName'].'"');
$upperaccountUpperData=mysqli_fetch_array($upperadq);

				  ?>
                    <tr style="background-color: #646464; color: #fff; text-align: center;">
                      <td colspan="2">Company - <?php echo $uppercomName['name']; ?></td>
                      <td colspan="2">Financial Year - <?php echo $upperfincName['name']; ?></td>
                    </tr>
                    <?php } ?>


                    <tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td width="4%" align="center">&nbsp;</td>
                      <td width="48%" align="center">&nbsp;</td>
                      <td align="center" colspan="2">Amount(INR)</td>
                    </tr>
                    <tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div align="center">SR</div></td>
                      <td align="center"><div align="left">Head&nbsp;&nbsp;Name</div></td>
                      <td width="24%" align="center"><div align="left">Dr.</div></td>
                      <td width="24%" align="center"><div align="left">Cr.</div></td>
                    </tr>
                    <tbody id="allhotellisting">
                      <?php
              $jsonData = "";
              $no = 1;
        $url = $fullurl."accounts/trialbalanceAPI.php";
        $resultData = postCurlData($url,$jsonData);
        $accountData = json_decode($resultData);
        if(isset($accountData->LedgerList)){
        foreach($accountData->LedgerList as $resultList){
          ?>
         <tr>
                        <td><div align="center"><?php echo $no; ?></div></td>
                        <td><div align="left"><?php echo $resultList->AccountName;  ?></div></td>
                        <td><div align="left"><?php echo $resultList->Debit;  ?></div></td>
                        <td><div align="left"><?php echo $resultList->Credit;  ?></div></td>
                      </tr>
          <?php $no++; } } ?>


                      <?php

// =============================by prasang========================
// $sNo=0;
// $maindebit=0;
// $maincredit=0;

// $page=$_GET['page'];
// $limit=clean($_GET['records']);

// if($_REQUEST['companyid']!=''){
// $companyQ='and companyId="'.$_GET['companyid'].'"';
// }


// $where='where 1 '.$companyQ.' and trialbalance=1 order by id asc';

// $targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&companyId='.$_GET['companyId'].'&';

// $rs=GetRecordList($select,'finalheadcreationmaster',$where,$limit,$page,$targetpage);
// $totalentry=$rs[1];
// $paging=$rs[2];
// while($resultlists=mysqli_fetch_array($rs[0])){

// //===============fetch data using accountsmaster and debit voucher master====================================

// $totalDebitamount=0;
// $totalCreditamount=0;



// $lq=GetPageRecord('*','finalheadcreationmaster','1 and trialparent="'.$resultlists['id'].'"');
// while($trialData=mysqli_fetch_array($lq)){


// //echo $trialData['label'].'*****'.$trialData['id'];
// //echo "<br>====<br>";

// //echo '1 and accountDate!="" and module!="invoice" and accountDate!="0000-00-00" and creditaccounthead="'.$trialData['id'].'" or id in (select parentId from debitvoucherMaster where accountHeadId="'.$trialData['id'].'") order by id asc';
// //echo "+++++++++++++++++++";

// $wherechk = '1 and accountDate!="" and module!="invoice" and accountDate!="0000-00-00" and creditaccounthead="'.$trialData['id'].'" or id in (select parentId from debitvoucherMaster where accountHeadId="'.$trialData['id'].'") order by id asc';

// $ahqq=GetPageRecord('*','accountsMaster',$wherechk);
// while($accountHeadData=mysqli_fetch_array($ahqq)){


// //echo "**********1";



// /////////////////////////////////////////==========================/////////////////////////////////////////

// $rskk=GetPageRecord('*','debitvoucherMaster','1 and accountHeadId="'.$trialData['id'].'" and parentId="'.$accountHeadData['id'].'" order by dateAdded asc');

// $countfiiiirow=mysql_num_rows($rskk);


// if($countfiiiirow>0){

// while($subVoucherAppData=mysqli_fetch_array($rskk)){

// if($accountHeadData['module']=='debitvoucher'){ $totalDebitamount=$totalDebitamount+$subVoucherAppData['amount']; }

// if($accountHeadData['module']=='creditvoucher'){ $totalCreditamount=$totalCreditamount+$subVoucherAppData['amount']; }

// if($accountHeadData['module']=='contravoucher' || $accountHeadData['module']=='journalvoucher'){ $totalDebitamount=$totalDebitamount+$subVoucherAppData['debit']; }

// if($accountHeadData['module']=='contravoucher' || $accountHeadData['module']=='journalvoucher'){ $totalCreditamount=$totalCreditamount+$subVoucherAppData['credit']; }

// }

// }else{

// if($accountHeadData['module']=='debitvoucher'){  $totalCreditamount=$totalCreditamount+$accountHeadData['totalamount']; }

// if($accountHeadData['module']=='creditvoucher'){ $totalDebitamount=$totalDebitamount+$accountHeadData['totalamount']; }


// }



// }

// }

//====================by prasang=============================================================================

									?>
                      <?php // if($_GET['companyid']!=""){ ?>

                      <!-- <tr> -->
                        <!-- <td><div align="center"><?php echo ++$sNo; ?></div></td> -->
                        <!-- <td><div align="left"><?php echo $resultlists['label']; ?></div></td> -->
                        <!-- <td><div align="left"><?php  echo $totalDebitamount;$maindebit=$maindebit+$totalDebitamount; ?></div></td> -->
                        <!-- <td><div align="left"><?php  echo $totalCreditamount;$maincredit=$maincredit+$totalCreditamount;  ?></div></td> -->
                      <!-- </tr>  -->
                      <?php
                    // }
                    // }
                     ?>



                      <tr style="background-color:#f7ffa7;">
                        <td align="left" colspan="2"><strong>Total</strong></td>
                        <td align="left"><strong><?php echo $accountData->TotalDebit; ?></strong></td>
                        <td align="left"><strong><?php echo $accountData->TotalCredit; ?></strong></td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="pagingdiv" style="width: 100%;margin: 20px auto;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tbody>
                        <tr>
                          <td><table border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <td style="padding-right:20px;"><?php echo $totalentry; ?> entries</td>
                                <td><select name="records" id="records" onchange="this.form.submit();" class="lightgrayfield" style="padding: 5px;border: 1px solid #ccc; outline:none;">
                                    <option value="25" <?php if($_GET['records']=='25'){ ?> selected="selected"<?php } ?>>25 Records Per Page</option>
                                    <option value="50" <?php if($_GET['records']=='50'){ ?> selected="selected"<?php } ?>>50 Records Per Page</option>
                                    <option value="100" <?php if($_GET['records']=='100'){ ?> selected="selected"<?php } ?>>100 Records Per Page</option>
                                    <option value="200" <?php if($_GET['records']=='200'){ ?> selected="selected"<?php } ?>>200 Records Per Page</option>
                                    <option value="300" <?php if($_GET['records']=='300'){ ?> selected="selected"<?php } ?>>300 Records Per Page</option>
                                  </select></td>
                              </tr>
                            </table></td>
                          <td align="right"><div class="pagingnumbers"><?php echo $paging; ?></div></td>
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
$(document).ready(function(){
$("#filtersearch").on("keyup", function() {
var value = $(this).val().toLowerCase();
$("#allhotellisting tr").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
});
</script>
<script>
 function isLedger(id,glId){

	if(glId=='0'){
		var conf = confirm('Are you sure you want to create General Ledger?');
		if(conf==true){
			window.location.href ='<?php echo $fullurl; ?>showpage.crm?module=headcreation&id='+id+'&glId=1';
		}
	}else{
		var conf = confirm('Are you sure you want to remove from General Ledger?');
		if(conf==true){
		window.location.href ='<?php echo $fullurl; ?>showpage.crm?module=headcreation&id='+id+'&glId=0';
		}
	}
 }


 function deleteHead(delId){
 	var conf = confirm('Are you sure you want delete?');
	if(conf==true){
		window.location.href ='<?php echo $fullurl; ?>showpage.crm?module=headcreation&delId='+delId;
	}
 }
 </script>
<style>
.apparelclass tr td{
border-top:0px solid #ccc !important;
border:1px solid #ccc !important;
vertical-align:middle !important;
}
</style>
<script>
$(function(){
$(".datepickercommon").datepicker();
});
</script>
