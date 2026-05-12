<?php
include "inc.php";

if($_REQUEST['add']==1){
$namevalueadd = 'addedBy="'.$_SESSION['userid'].'",parentId="'.$_REQUEST['lastId'].'",dateAdded="'.time().'",status=1';
addlistinggetlastid('debitvoucherMaster',$namevalueadd);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
deleteRecord('debitvoucherMaster','id="'.$_REQUEST['id'].'"');
}

$sNo2 = 0;
$select='';
$where='';
$rs='';
$select='*';
$where='1 and parentId="'.$_REQUEST['lastId'].'" order by id asc';
$rs=GetPageRecord($select,'debitvoucherMaster',$where);
while($resListing1=mysqli_fetch_array($rs)){
$sNo2++;
?>


<tr height="20">
  <td align="center"><i class="fa fa-trash" style="font-size: 20px; color:#FF0000; cursor:pointer;" onclick="deleteRow('<?php echo $resListing1['id']; ?>');"></i></td>
  <td height="20" align="right"><div align="center">
      <select name="accountHeadId[]" id="accountHeadId<?php echo $resListing1['id'] ?>" class="form-control" onchange="saveVourherData<?php echo $resListing1['id'] ?>();">
        <option value="">Select</option>
        <?php

if($_REQUEST['module']=='debitvoucher'){
$GroupId = "[1]";
// $querynew='and (type="suppliers" or type="vendors" or type="expenses") and companyId="'.$_REQUEST['companyid'].'"';
}
if($_REQUEST['module']=='creditvoucher'){
$GroupId = "[2]";
// $querynew='and type="buyers" and companyId="'.$_REQUEST['companyid'].'"';
}
if($_REQUEST['module']=='contravoucher'){
$GroupId = "[3,5]";
// $querynew='and (type="cashinhand" or type="bankaccounts") and companyId="'.$_REQUEST['companyid'].'"';
}
if($_REQUEST['module']=='journalvoucher'){
$GroupId = '';
// $querynew='and (type!="cashinhand" or type!="bankaccounts") and companyId="'.$_REQUEST['companyid'].'"';
}


// $rs12=GetPageRecord('*','finalheadcreationmaster','1 '.$querynew.' order by label asc');
// while($resListing12=mysqli_fetch_array($rs12)){

?>
        <!--<option value="<?php echo $resListing12['id']; ?>" <?php if($resListing12['id']==$resListing1['accountHeadId']){ ?> selected="selected" <?php } ?>><?php echo $resListing12['label']; ?></option>-->
        <?php
        // }
        ?>
        <?php
              $jsonData = '{
    "GroupId":'.$GroupId.'
}';
        $url = $fullurl."accounts/accountNameAPI.php";
        $resultData = postCurlData($url,$jsonData);
        $accountData = json_decode($resultData);
        if(isset($accountData->status)=='true'){
        if(isset($accountData->AccountData)){
        foreach($accountData->AccountData as $resultList){
          ?>
          <option value="<?php echo $resultList->Id; ?>" <?php if($resultList->Id == $resListing1['accountHeadId']){ ?> selected="selected" <?php } ?>><?php echo $resultList->AccountName; ?></option>
          <?php } } } ?>

      </select>
    </div></td>
  <!--<td height="20" align="right"><div align="center">-->
  <!--    <input name="code[]" id="code<?php echo $resListing1['id'] ?>" type="text"  value="<?php echo stripslashes($resListing1['code']); ?>" autocomplete="off" class="form-control" onkeyup="saveVourherData<?php echo $resListing1['id'] ?>();">-->
  <!--  </div></td>-->
  <?php if($_REQUEST['module']=='contravoucher' || $_REQUEST['module']=='journalvoucher'){ ?>
  <td height="20" align="right"><div align="center">
      <input name="debit[]"  id="debit<?php echo $resListing1['id'] ?>" type="text"   value="<?php echo stripslashes($resListing1['debit']); ?>" autocomplete="off" class="form-control" onkeyup="saveVourherData<?php echo $resListing1['id'] ?>();">
    </div></td>
  <td height="20" align="right"><div align="center">
      <input name="credit[]"  id="credit<?php echo $resListing1['id'] ?>" type="text"  value="<?php echo stripslashes($resListing1['credit']); ?>" autocomplete="off" class="form-control" onkeyup="saveVourherData<?php echo $resListing1['id'] ?>();">
    </div></td>
  <?php }?>
  <?php if($_REQUEST['module']!='contravoucher' && $_REQUEST['module']!='journalvoucher'){ ?>
  <td height="20" align="right"><div align="center">
      <input name="amount[]"  id="amount<?php echo $resListing1['id'] ?>" type="text"  value="<?php echo stripslashes($resListing1['amount']); ?>" autocomplete="off" class="caltotalfinal form-control" onkeyup="saveVourherData<?php echo $resListing1['id'] ?>();">
    </div></td>
  <?php }?>
</tr>




<script>

function saveVourherData<?php echo $resListing1['id'] ?>(){

	var accountHeadId = $('#accountHeadId<?php echo $resListing1['id'] ?>').val();
// 	var code = $('#code<?php echo $resListing1['id'] ?>').val();
	var debit = $('#debit<?php echo $resListing1['id'] ?>').val();
	var credit = $('#credit<?php echo $resListing1['id'] ?>').val();
	var amount = $('#amount<?php echo $resListing1['id'] ?>').val();

	if(debit > 0){
	  $('#credit<?php echo $resListing1['id'] ?>').val(0);
	  $('#debit<?php echo $resListing1['id'] ?>').val(debit);
	}
	if(credit > 0){
	  $('#credit<?php echo $resListing1['id'] ?>').val(credit);
	  $('#debit<?php echo $resListing1['id'] ?>').val(0);
	}
	var sum=0;
	$('.caltotalfinal').each(function() {
	sum += Number($(this).val());
	});
	sum= parseFloat(sum).toFixed(2);
	parent.$('#totalamount').val(sum);


	$('#savedata').load('apparelbomaction.php?action=savedebitvoucherdata&id=<?php echo encode($resListing1['id']); ?>&accountHeadId='+accountHeadId+'&debit='+debit+'&credit='+credit+'&amount='+amount);
}

saveVourherData<?php echo $resListing1['id'] ?>();

</script>




<?php } ?>
<?php if($sNo2==0){ ?>
<tr style="padding:8px;text-align: center; width: 100%;background-color: #efefef;">
  <td colspan="50"><div align="center">No Record Found.</div></td>
</tr>
<div align="center">
  <?php } ?>
</div>
<tr id="savedata" style="display:none;"></tr>
<style>
button, input, optgroup, select, textarea {
    padding: 7px 10px;
    width: 250px;
}
</style>
