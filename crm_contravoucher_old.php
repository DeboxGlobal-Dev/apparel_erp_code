<?php
deleteRecord('accountsMaster','module="'.$_GET['module'].'" and addedBy="'.$_SESSION['userid'].'" and accountDate="0000-00-00"');
deleteRecord('debitvoucherMaster','addedBy="'.$_SESSION['userid'].'" and accountHeadId=0');

$where='1 and module="'.$_GET['module'].'" and accountDate!="0000-00-00" order by id desc';
$rs=GetPageRecord('*','accountsMaster',$where);
$accountData=mysqli_fetch_array($rs);

$autiid = explode('-',$accountData['displayId']);
$autoId = $autiid[1]+1;
$finalDisplayId='CO-000'.$autoId;

$namevalue ='module="'.$_GET['module'].'",dateAdded="'.time().'",addedBy="'.$_SESSION['userid'].'",displayId="'.$finalDisplayId.'"';
$lasttid=addlistinggetlastid('accountsMaster',$namevalue);

$rkdm=GetPageRecord('*','accountsMaster','1 and id="'.$lasttid.'"');
$editResult=mysqli_fetch_array($rkdm);


//==============================edit debit voucher=========================================================================

if($_REQUEST['id']!=''){
$select1='*';
$where1='id="'.decode($_GET['id']).'"';
$rs1=GetPageRecord($select1,'accountsMaster',$where1);
$editAccountData=mysqli_fetch_array($rs1);
}

if($editAccountData['id']!='' && $editAccountData['id']!=0){
$lasttid=$editAccountData['id'];
}

//=========================================================================================================================

//=====================================================================================DELETE DEBIT VOUCHER===============
if($_REQUEST['d']!=''){
//delete debit voucher

deleteRecord('accountsMaster','id="'.decode($_GET['d']).'"');
deleteRecord('debitvoucherMaster','parentId="'.decode($_GET['d']).'"');

?>
<script>window.location.href = 'showpage.crm?module=<?php echo $_GET['module']; ?>';</script>
<?php
}

//===========================================================================================================================

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
            <div class="btn-group justify-content-center" style="float:right;"> </div>
          </div>
        </div>
        <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
          <input type="hidden" name="totalamount" id="totalamount" value="0" />
          <input name="action" type="hidden" id="action" value="savedebitvoucher" />
          <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['module']; ?>" />
          <input name="editId" type="hidden" id="editId" value="<?php echo encode($lasttid); ?>" />
          <div class="card border-left-3 border-left-danger-400 rounded-left-0" style="border: 1px solid #ccc !important;">
            <div class="card-body">
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Company</label>
                    <select class="form-control" name="companyid" id="companyid" onchange="loadheadcreation(this.value);">
                      <?php
								$rsk=GetPageRecord('*','companyMaster','1 order by name asc');
								while($comData=mysqli_fetch_array($rsk)){
								?>
                      <option value="<?php echo $comData['id']; ?>" <?php if($comData['id']==$editAccountData['companyid']){ ?> selected="selected" <?php } ?>><?php echo $comData['name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
				<script>
				function loadheadcreation(){
				var companyid = $('#companyid').val();
				$("#addrow").load('loaddebitvoucher.php?module=<?php echo $_GET['module']; ?>&lastId=<?php echo $lasttid; ?>&companyid='+companyid);
				}
				</script>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Voucher No.</label>
                    <input name="voucherNo" type="text" class="form-control" id="voucherNo" value="<?php if($editAccountData['displayId']!=''){ echo $editAccountData['displayId']; }else{ echo $editResult['displayId'];} ?>" readonly="">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Date</label>
                    <input name="fromDate" type="text" class="form-control" id="fromDate" value="<?php if($editAccountData['accountDate']!=''){ echo date('d-m-Y', strtotime($editAccountData['accountDate'])); }else{ echo date('d-m-Y'); } ?>" readonly="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Narration</label>
                    <input name="description" type="text" class="form-control" id="description" value="<?php echo $editAccountData['remark']; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <table width="100%" border="1" cellpadding="5" cellspacing="0" class="table" style="font-size: 12px !important; width: 100%; border: 1px solid #ccc !important;">
                    <tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td rowspan="2" width="46"><div><a onClick="addNewRow(1);" style="color:#0000FF; cursor: pointer;">+Add&nbsp;New</a>
                          </th>
                        </div></td>
                      <td align="center"><div align="center">Account&nbsp;Name</div></td>
                      <!-- <td align="center"><div align="center">Code</div></td> -->
                      <td align="center"><div align="center">Debit</div></td>
									<td align="center"><div align="center">Credit</div></td>
                    </tr>
                    <tbody id="addrow">
                    </tbody>
                    <script>

									function addNewRow(id){
									var companyid=$('#companyid').val();
									if(id==1){
									$("#addrow").load('loaddebitvoucher.php?add=1&module=<?php echo $_GET['module']; ?>&lastId=<?php echo $lasttid; ?>&companyid='+companyid);
									}else{
									$("#addrow").load('loaddebitvoucher.php?module=<?php echo $_GET['module']; ?>&lastId=<?php echo $lasttid; ?>&companyid='+companyid);
									}

									}
									addNewRow(0);

									function deleteRow(id){
									var checkyes = confirm('Are your sure you you want to delete?');
									if(checkyes==true){
									$('#addrow').load('loaddebitvoucher.php?deletestatus=yes&module=<?php echo $_GET['module']; ?>&id='+id+'&lastId=<?php echo $lasttid; ?>');
									}
									}
									</script>
                  </table>
                  <div style="margin-top:20px; width:100%; display:block; text-align:right;">
                    <button type="submit" class="btn btn-primary" style="margin:0px; width:100px;">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;" onclick="saveALL();"></i></button>
                  </div>
                </div>
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
                    <td align="center"><div align="left">Date</div></td>
                    <td align="center"><div align="left">Company</div></td>
                    <td align="center"><div align="left">Voucher&nbsp;No</div></td>
                    <td align="center"><div align="left">Account Name </div></td>
                    <td align="center">Code</td>
                    <td align="center"><div align="left">Narration</div></td>
                    <td align="center"><div align="left">Debit</div></td>
                    <td align="center"><div align="left">Credit</div></td>
                    <td align="center"><div align="left">Action</div></td>
                  </tr>
                  <?php
				   $sNo=0;
									$rs=GetPageRecord('*','accountsMaster','1 and module="'.$_GET['module'].'" and accountDate!="0000-00-00" order by dateAdded desc');
									while($VoucherAppData=mysqli_fetch_array($rs)){

									$kkrs=GetPageRecord('name','companyMaster','1 and id="'.$VoucherAppData['companyid'].'"');
									$comName=mysqli_fetch_array($kkrs);

									//========upper account name==========
									$uaq=GetPageRecord('label','finalheadcreationmaster','1 and id="'.$VoucherAppData['creditaccounthead'].'"');
									$upperAccName=mysqli_fetch_array($uaq);

									?>
                  <tr style="background-color:#eefafd;">
                    <td align="center"><?php echo  ++$sNo; ?></td>
                    <td align="center"><div align="left"><?php echo date('d-m-Y',strtotime($VoucherAppData['accountDate'])); ?></div></td>
                    <td align="center"><div align="left"><?php echo $comName['name']; ?></div></td>
                    <td align="center"><div align="left"><?php echo $VoucherAppData['displayId']; ?></div></td>
                    <td align="center"><div align="left"><?php echo $upperAccName['label']; ?></div></td>
                    <td align="center">&nbsp;</td>
                    <td align="center"><div align="left"><?php echo $VoucherAppData['remark']; ?></div></td>
                    <td align="center"><div align="left"> </div></td>
                    <td align="center"><div align="left"> </div></td>
                    <td align="left"><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&id=<?php echo encode($VoucherAppData['id']); ?>" class="btn btn-primary" style="padding:5px;"><i class="fa fa-pencil" aria-hidden="true" style=" color: #fffffff1; font-size: 16px; "></i></a><a href="#" onclick="deleteAccountDebit('<?php echo encode($VoucherAppData['id']); ?>');" class="btn btn-danger" style="padding:5px;"><i class="fa fa-trash" aria-hidden="true" style=" color: #fffffff1; font-size: 12px; "></i></a></td>
                  </tr>
                  <?php
									$rskk=GetPageRecord('*','debitvoucherMaster','1 and parentId="'.$VoucherAppData['id'].'" order by dateAdded desc');
									while($subVoucherAppData=mysqli_fetch_array($rskk)){

									//========upper account name==========
									$laq=GetPageRecord('label','finalheadcreationmaster','1 and id="'.$subVoucherAppData['accountHeadId'].'"');
									$lowerAccName=mysqli_fetch_array($laq);

									?>
                  <tr>
                    <td align="center">&nbsp;</td>
                    <td align="center"><div align="left"> </div></td>
                    <td align="center"><div align="left"> </div></td>
                    <td align="center"><div align="left"> </div></td>
                    <td align="center"><div align="left"><?php echo $lowerAccName['label']; ?></div></td>
                    <td align="center"><?php echo $subVoucherAppData['code']; ?></td>
                    <td align="center"><div align="left"></div></td>
                    <td align="center"><div align="left"><?php echo $subVoucherAppData['debit']; ?></div></td>
                    <td align="center"><div align="left"><?php echo $subVoucherAppData['credit']; ?> </div></td>
                    <td align="center"><div align="left"></div></td>
                  </tr>
                  <?php } } ?>
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
$(function(){
$( "#fromDate" ).datepicker();
});
</script>
<script>
function deleteAccountDebit(id){
var delStyle = confirm('Are you sure you want to delete this style?');
if(delStyle==true){
window.location.href = 'showpage.crm?module=<?php echo $_GET['module']; ?>&d='+id; //delete style
}
}
</script>
