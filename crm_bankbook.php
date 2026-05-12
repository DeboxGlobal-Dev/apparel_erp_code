<div class="page-content">
<div class="content-wrapper">
  <div class="content pt-0" style="margin-top: 20px; width: 100%; margin-left: auto; margin-right: auto;">
    <div class="row">
      <div class="col-xl-12">
        <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
          <div class="col-xl-9">
            <h5 class="card-title"><?php echo $pageName; ?></h5>
          </div>
          <div class="col-xl-3" style="padding-right: 0px;">

          </div>
        </div>
        <div class="card border-left-3 border-left-danger-400 rounded-left-0" style="border: 1px solid #ccc !important;">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form name"search" method="GET" action="">
                  <input type="hidden"  name="module" value="<?php echo $_GET['module']; ?>"/>
                  <div class="row" style="padding:15px 0px;">
                    <div class="col-md-2">
                      <div class="">
                        <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" class="form-control" />
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="">
                        <input name="fromDate" type="text" class="datepickercommon form-control" id="fromDate" value="<?php if($_GET['fromDate']!=''){ echo date('d-m-Y', strtotime($_GET['fromDate'])); } ?>" placeholder="From Date" readonly="">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="">
                        <input name="toDate" type="text" class="datepickercommon form-control" id="toDate" value="<?php if($_GET['toDate']!=''){ echo date('d-m-Y', strtotime($_GET['toDate'])); } ?>" placeholder="To Date" readonly="">
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
                        <select class="form-control" name="accountName" id="accountName">
                          <option value="">Account Name</option>
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
                  <table class="table table-bordered table-hover no-footer">

				  <?php if($_GET['companyid']!="" && $_GET['accountName']!="" && $_GET['fromDate']!="" && $_GET['toDate']!=""){

$upperbq=GetPageRecord('*','balancesMaster','1 and companyid="'.$_GET['companyid'].'" and financialYear in (select id from financialYearMaster where  fromDate<="'.date('Y-m-d',strtotime($_GET['fromDate'])).'" and toDate>="'.date('Y-m-d',strtotime($_GET['toDate'])).'")');

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
				  <td colspan="3">Account - <?php echo $upperaccountUpperData['label']; ?></td>
				  <td colspan="3">Financial Year - <?php echo $upperfincName['name']; ?></td>
				  </tr>
                  <?php } ?>


				    <tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div align="left">Date</div></td>
                      <td align="center"><div align="left">Account&nbsp;Name</div></td>
                      <td align="center"><div align="left">Narration</div></td>
                      <td align="center"><div align="left">Voucher&nbsp;No.</div></td>
                      <td align="center"><div align="left">Debit</div></td>
                      <td align="center"><div align="left">Credit</div></td>
                      <td align="center"><div align="left">Balance</div></td>
                      <td align="center"><div align="left">Debit/Credit</div></td>
                    </tr>
                    <tbody id="allhotellisting">
			<?php
			$cacl=0;
			$debitfirstCost=0;
$creditfirstCost=0;
$upperstatus='';
			?>
                      <?php if($_GET['companyid']!="" && $_GET['accountName']!="" && $_GET['fromDate']!="" && $_GET['toDate']!=""){

$bq=GetPageRecord('*','balancesMaster','1 and companyid="'.$_GET['companyid'].'" and accountName="'.$_GET['accountName'].'" and financialYear in (select id from financialYearMaster where  fromDate<="'.date('Y-m-d',strtotime($_GET['fromDate'])).'" and toDate>="'.date('Y-m-d',strtotime($_GET['toDate'])).'")');

$balData=mysqli_fetch_array($bq);

$countcompany=mysql_num_rows($bq);

$cq=GetPageRecord('name','companyMaster','1 and id="'.$balData['companyid'].'"');
$comName=mysqli_fetch_array($cq);

if($countcompany>0){
?>
                      <tr style="background-color: #eefafd;">
                        <td><div align="left"></div></td>
                        <td><div align="left"><?php echo $comName['name']; ?></div></td>
                        <td><div align="left">Opening Balance </div></td>
                        <td><div align="left"><a href="showpage.crm?module=<?php echo $resultlists['module']; ?>&id=<?php echo encode($resultlists['id']); ?>" target="_blank"></a></div></td>
                        <td>
                          <div align="left">
                            <?php if($balData['debitcredit']==1){ echo $balData['amount'];$debitfirstCost=$debitfirstCost+$balData['amount']; }else{echo '-'; } ?>
                            </div></td>
                        <td>
                          <div align="left">
                            <?php if($balData['debitcredit']==2){ echo $balData['amount'];$creditfirstCost=$creditfirstCost+$balData['amount']; } else{echo '-'; } ?>
                            </div></td>
                        <td><div align="left"><?php echo $balData['amount'];$cacl=$balData['amount']; ?></div></td>
                        <td>
                          <div align="left">
                            <?php if($balData['debitcredit']==1){ echo 'Debit'; } if($balData['debitcredit']==2){ echo 'Credit'; } ?>
                            </div></td>
                      </tr>
					  <?php } else{ ?>
					   <tr style="background-color: #feaaaa;">

                        <td><div align="left"></div></td>
                        <td><div align="left"> </div></td>
                        <td><div align="left">Opening Balance </div></td>
                        <td><div align="left"><a href="showpage.crm?module=<?php echo $resultlists['module']; ?>&id=<?php echo encode($resultlists['id']); ?>" target="_blank"></a></div></td>
                        <td><div align="left">

                          </div></td>
                        <td><div align="left">

                          </div></td>
                        <td><div align="left"> 0.00</div></td>
                        <td><div align="left"></div></td>
                      </tr>


					  <?php } ?>

                      <?php } ?>
                      <?php
$sNo=1;
if($_REQUEST['fromDate']!='' && $_REQUEST['toDate']!=''){
$dateQ='and accountDate>="'.date('Y-m-d',strtotime($_REQUEST['fromDate'])).'" and accountDate<="'.date('Y-m-d',strtotime($_REQUEST['toDate'])).'"';
}

if($_REQUEST['accountName']!=''){
$accountQ='and creditaccounthead="'.$_GET['accountName'].'"';
}

$page=$_GET['page'];
$limit=clean($_GET['records']);

$where='where 1 and accountDate!="" and module!="invoice" '.$dateQ.' '.$accountQ.' and accountDate!="0000-00-00" or id in (select parentId from debitvoucherMaster where accountHeadId="'.$_GET['accountName'].'") order by id asc';

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&companyId='.$_GET['companyId'].'&';

$rs=GetRecordList($select,'accountsMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){
$dateAdded=clean($resultlists['dateAdded']);
$modifyDate=clean($resultlists['modifyDate']);

//account name data
$adq=GetPageRecord('label','finalheadcreationmaster','1 and id="'.$resultlists['creditaccounthead'].'"');
$accountUpperData=mysqli_fetch_array($adq);

									?>

                       <?php if($_GET['companyid']!="" && $_GET['accountName']!="" && $_GET['fromDate']!="" && $_GET['toDate']!=""){ ?>

					  <?php if($resultlists['creditaccounthead']!=0 && $resultlists['creditaccounthead']==$_GET['accountName']){ ?>
					  <tr>
					    <td><div align="left"><?php echo date('d-m-Y',strtotime($resultlists['accountDate'])); ?></div></td>
                        <td><div align="left"><?php echo $accountUpperData['label']; ?></div></td>
                        <td><div align="left"><?php echo $resultlists['remark']; ?></div></td>
                        <td><div align="left"><a href="showpage.crm?module=<?php echo $resultlists['module']; ?>&id=<?php echo encode($resultlists['id']); ?>" target="_blank"><?php echo $resultlists['displayId']; ?></a></div></td>
                        <td>
                          <div align="left">
                            <?php if($resultlists['module']=='creditvoucher'){ echo $resultlists['totalamount'];$debitfirstCost=$debitfirstCost+$resultlists['totalamount']; } ?>
                            </div></td>
                        <td>
                          <div align="left">
                            <?php if($resultlists['module']=='debitvoucher'){ echo $resultlists['totalamount'];$creditfirstCost=$creditfirstCost+$resultlists['totalamount']; } ?>
                            </div></td>
                        <td><div align="left">
                          <?php if($resultlists['module']=='creditvoucher' && $resultlists['totalamount']!='' && $resultlists['totalamount']!=0){  echo $cacl= $cacl+$resultlists['totalamount'];$upperstatus='Debit'; } ?>
                          <?php if($resultlists['module']=='debitvoucher' && $resultlists['totalamount']!='' && $resultlists['totalamount']!=0){  echo $cacl=$cacl-$resultlists['totalamount'];$upperstatus='Credit'; } ?>
                        </div></td>
                        <td><div align="left"><?php echo $upperstatus; ?></div></td>
                      </tr>
					  <?php } ?>
                      <?php

					$lowerstatus='';
					$rskk=GetPageRecord('*','debitvoucherMaster','1 and parentId="'.$resultlists['id'].'" and accountHeadId="'.$_GET['accountName'].'" order by dateAdded asc');
					while($subVoucherAppData=mysqli_fetch_array($rskk)){

					//========upper account name==========
					$laq=GetPageRecord('label','finalheadcreationmaster','1 and id="'.$subVoucherAppData['accountHeadId'].'"');
					$lowerAccName=mysqli_fetch_array($laq);
					?>
                      <tr>
                        <td align="left"><?php echo date('d-m-Y',strtotime($resultlists['accountDate'])); ?> </td>
                        <td align="left">
                          <div align="left"><?php echo $lowerAccName['label']; ?></div>

                          <div align="left"> </div></td>
                        <td align="center"><div align="left" style="display:none;">
                            <div align="left"><?php echo $resultlists['remark']; ?> </div>
                        </div></td>
                        <td align="left"><a href="showpage.crm?module=<?php echo $resultlists['module']; ?>&amp;id=<?php echo encode($resultlists['id']); ?>" target="_blank"><?php echo $resultlists['displayId']; ?></a></td>

<td align="left"><div align="left">
  <?php  if($resultlists['module']=='debitvoucher'){ echo $subVoucherAppData['amount'];$debitfirstCost=$debitfirstCost+$subVoucherAppData['amount']; } ?>
  <?php  if($resultlists['module']=='contravoucher' || $resultlists['module']=='journalvoucher'){ echo $subVoucherAppData['debit'];$debitfirstCost=$debitfirstCost+$subVoucherAppData['debit']; } ?></div></td>

<td align="left"><div align="left"><?php  if($resultlists['module']=='creditvoucher' && $subVoucherAppData['amount']!='' && $subVoucherAppData['amount']!=0){ echo $subVoucherAppData['amount'];$creditfirstCost=$creditfirstCost+$subVoucherAppData['amount']; } ?>
<?php  if($resultlists['module']=='contravoucher' || $resultlists['module']=='journalvoucher'){ echo $subVoucherAppData['credit'];$creditfirstCost=$creditfirstCost+$subVoucherAppData['credit']; } ?>
</div></td>
                        <td align="left"><?php  if($resultlists['module']=='debitvoucher' && $subVoucherAppData['amount']!='' && $subVoucherAppData['amount']!=0){ echo $cacl= $cacl+$subVoucherAppData['amount'];$lowerstatus="Credit"; } ?>
                          <?php  if($resultlists['module']=='creditvoucher'){ echo $cacl= $cacl-$subVoucherAppData['amount'];$lowerstatus="Debit"; } ?>
                        <?php  if(($resultlists['module']=='contravoucher' || $resultlists['module']=='journalvoucher') && $subVoucherAppData['debit']!=0){ echo $cacl= $cacl+$subVoucherAppData['debit'];$lowerstatus="Debit"; } ?><?php  if(($resultlists['module']=='contravoucher' || $resultlists['module']=='journalvoucher') && $subVoucherAppData['credit']){ echo $cacl= $cacl-$subVoucherAppData['credit'];$lowerstatus="Credit"; } ?>                        </td>
                        <td align="left"><?php echo $lowerstatus; ?></td>
                      </tr>

                      <?php }  } ?>


                      <?php } ?>

					  <tr style="background-color:#f7ffa7;">
                        <td align="left" colspan="2"><strong>Closing Balance</strong></td>
                        <td align="left">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="left"><strong><?php echo $debitfirstCost; ?></strong></td>
                        <td align="left"><strong><?php echo $creditfirstCost; ?></strong></td>
                        <td align="left"><?php echo $cacl; ?></td>
                        <td align="left"><strong><?php if($cacl>0){ echo 'Debit'; } else{ echo 'Credit'; } ?> </strong></td>
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
<script>
function loadaccountnname(){
var companyid = $('#companyid').val();
$('#accountName').load('loadaccountname.php?type=bankbook&accountname=<?php echo $_GET['accountName']; ?>&id='+companyid);
}
<?php if($_GET['companyid']!=""){ ?>
loadaccountnname();
<?php } ?>
</script>
