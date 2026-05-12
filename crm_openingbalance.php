<?php
if($_REQUEST['id']!=''){
$select1='*';
$where1='id="'.decode($_GET['id']).'"';
$rs1=GetPageRecord($select1,'balancesMaster',$where1);
$editAccountData=mysqli_fetch_array($rs1);
}

//delete balance
if($_REQUEST['d']!=''){

deleteRecord('balancesMaster','id="'.decode($_GET['d']).'"');

?>
<script>window.location.href = 'showpage.crm?module=<?php echo $_GET['module']; ?>';</script>
<?php
}
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
          <div class="col-xl-3" style="padding-right: 0px;">
            <div class="btn-group justify-content-center" style="float:right;">
            	 <a href="showpage.crm?module=masters"  class="btn bg-teal-400" aria-expanded="false" style="background-color: gray;"><i class="fa fa-arrow-left mr-2"></i>Back</a>

                 </div>
          </div>
        </div>
        <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
          <input name="action" type="hidden" id="action" value="saveopeningbalance" />
          <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['module']; ?>" />
          <input name="editId" type="hidden" id="editId" value="<?php echo encode($editAccountData['id']); ?>" />
          <div class="card border-left-3 border-left-danger-400 rounded-left-0" style="border: 1px solid #ccc !important;">
            <div class="card-body">
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Financial Year</label>
                    <select name="financialYear" id="financialYear" class="form-control">
                      <?php
								$rkrkrk=GetPageRecord('*','financialYearMaster','1 order by fromDate asc');
								while($financialData=mysqli_fetch_array($rkrkrk)){
								?>
                      <option value="<?php echo $financialData['id']; ?>" <?php if($financialData['id']==$editAccountData['financialYear']){ ?> selected="selected" <?php } ?>><?php echo $financialData['name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Company</label>
                    <select class="form-control" name="companyid" id="companyid" onchange="loadaccountnname(this.value);">
                      <option value="">Select</option>
                      <?php
								$rsk=GetPageRecord('*','companyMaster','1 order by name asc');
								while($comData=mysqli_fetch_array($rsk)){
								?>
                      <option value="<?php echo $comData['id']; ?>" <?php if($comData['id']==$editAccountData['companyid']){ ?> selected="selected" <?php } ?>><?php echo $comData['name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Account Name</label>
                    <select class="form-control" name="accountName" id="accountName">
                      <option value="">Select</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Account No.</label>
                    <input type="text" name="accountno" id="accountno" class="form-control" value="<?php echo $editAccountData['accountno']; ?>">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Amount</label>
                    <input type="text" name="amount" id="amount" class="form-control" value="<?php echo $editAccountData['amount']; ?>">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Debit/Credit</label>
                    <select name="debitcredit" id="debitcredit" class="form-control">
                      <option value="0">Select</option>
                      <option value="1" <?php if($editAccountData['debitcredit']==1){ ?> selected="selected" <?php } ?>>Debit</option>
                      <option value="2" <?php if($editAccountData['debitcredit']==2){ ?> selected="selected" <?php } ?>>Credit</option>
                    </select>
                  </div>
                </div>
                <script>
				function loadaccountnname(){
				var companyid = $('#companyid').val();
				$('#accountName').load('loadaccountname.php?accountname=<?php echo $editAccountData['accountName']; ?>&id='+companyid);
				}
				<?php if($_GET['id']!=""){ ?>
				loadaccountnname();
				<?php } ?>
				</script>
              </div>
              <div style="width:100%; display:block; text-align:right;">
                <button type="submit" class="btn btn-primary" style="margin:0px; width:100px;">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;" onclick="saveALL();"></i></button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="col-xl-12">
        <div class="card border-left-3 border-left-danger-400 rounded-left-0" style="border: 1px solid #ccc !important;">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <table width="100%" border="1" cellpadding="5" cellspacing="0" class="table" style="font-size: 12px !important; width: 100%; border: 1px solid #ccc !important;">
                  <tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                    <td align="center">SR</td>
                    <td align="center"><div align="left">Financial&nbsp;Year </div></td>
                    <td align="center"><div align="left">Company</div></td>
                    <td align="center"><div align="left">Account&nbsp;Name</div></td>
                    <td align="center"><div align="left">Account&nbsp;No. </div></td>
                    <td align="center">Amount</td>
                    <td align="center"><div align="left">Type</div></td>
                    <td align="center"><div align="left">Action</div></td>
                  </tr>
                  <?php
					$sNo=0;
					$rs=GetPageRecord('*','balancesMaster','1 order by  id desc');
					while($balancesData=mysqli_fetch_array($rs)){
					//===financial year
					$fe=GetPageRecord('name','financialYearMaster','1 and id="'.$balancesData['financialYear'].'"');
				    $financialData=mysqli_fetch_array($fe);
					//==add company data
					$cq=GetPageRecord('name','companyMaster','1 and id="'.$balancesData['companyid'].'"');
				    $comData=mysqli_fetch_array($cq);
					//======add account name
					$aq=GetPageRecord('label','finalheadcreationmaster','1 and id="'.$balancesData['accountName'].'"');
				    $accountData=mysqli_fetch_array($aq);
									?>
                  <tr style="background-color:#eefafd;">
                    <td align="center"><?php echo ++$sNo; ?></td>
                    <td align="center"><div align="left"><?php echo $financialData['name']; ?></div></td>
                    <td align="center"><div align="left"><?php echo $comData['name']; ?></div></td>
                    <td align="center"><div align="left"><?php echo $accountData['label']; ?></div></td>
                    <td align="center"><div align="left"><?php echo $balancesData['accountno']; ?></div></td>
                    <td align="center"><?php echo $balancesData['amount']; ?></td>
                    <td align="center"><div align="left"><?php if($balancesData['debitcredit']==1){ echo 'Debit'; } else{ echo 'Credit'; } ?></div></td>
                    <td align="left"><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&id=<?php echo encode($balancesData['id']); ?>" class="btn btn-primary" style="padding:5px;"><i class="fa fa-pencil" aria-hidden="true" style=" color: #fffffff1; font-size: 16px; "></i></a><a href="#" onclick="deleteAccountDebit('<?php echo encode($balancesData['id']); ?>');" class="btn btn-danger" style="padding:5px;"><i class="fa fa-trash" aria-hidden="true" style=" color: #fffffff1; font-size: 12px; "></i></a></td>
                  </tr>
                  <?php }  ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /main content -->
</div>
<script>
function deleteAccountDebit(id){
var delStyle = confirm('Are you sure you want to delete this Balance?');
if(delStyle==true){
window.location.href = 'showpage.crm?module=<?php echo $_GET['module']; ?>&d='+id; //delete style
}
}
</script>
