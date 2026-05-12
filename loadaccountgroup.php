
<?php
include('inc.php');

if($_REQUEST['srno']!=''){
	$url = $serverurlapi."masters/accountGroupAPI.php";

	$jsonPost = '{
			"accountGroup":"'.$_REQUEST['srno'].'"
	}';

	$resultData = postCurlData($url,$jsonPost);
	$accountGroupData = json_decode($resultData);

?>
<div id="<?php echo $_REQUEST['type']; ?>" class="tab-pane1">
<table id="datatable" class="table" style="width:100%">
	<thead>
		<tr class="hgt">
			<th colspan="3">Ledger Name : <?php if($_REQUEST['srno']==1){ echo "Assets"; } if($_REQUEST['srno']==2){ echo "Liability"; } if($_REQUEST['srno']==3){ echo "Equity"; } if($_REQUEST['srno']==4){ echo "Income"; } if($_REQUEST['srno']==5){ echo "Expense"; } ?> <a  onclick="opmodalpop(' Add Account Group','modalpop.php?action=accountgroup&groupid=<?php echo $_REQUEST['srno']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" style="color:#ffff; cursor:pointer;" class="btn-button">Add Group</a> </th>

		</tr>
	</thead>
	<tbody id="tablesearch">
	<?php
	if(isset($accountGroupData->status)=='true'){
		if(isset($accountGroupData->AccountGroupData)){
		$no=1;
		foreach($accountGroupData->AccountGroupData as $resultList){
	?>
		<tr class="uyt hgte">
			<td>
				<i onClick="showgroup(<?php echo $resultList->Id; ?>);" class="fa fa-plus iconPlus sgroup<?php echo $resultList->Id; ?>"></i>
				<i style="display: none;" onclick="hidegroup(<?php echo $resultList->Id; ?>);" class="fa fa-minus iconPlus hgroup<?php echo  $resultList->Id; ?>"></i>
				<a onclick="opmodalpop(' Add Account Sub Group','modalpop.php?action=accountsubgroup&groupId=<?php echo $resultList->Id; ?>&groupName=<?php echo $resultList->Name; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" style="cursor:pointer;color:#2196f3;"><?php echo $resultList->Name; ?></a>
			</td>
		</tr>
		<?php
		$subGroupId = $resultList->Id;
		$jsonData = '{
		"accountGroup":"'.$subGroupId.'"
		}';
		$url = $serverurlapi."masters/accountSubGroupAPI.php";
		$resultData = postCurlData($url,$jsonData);
		$accountData = json_decode($resultData);
		if(isset($accountData->status)=='true'){
		if(isset($accountData->AccountSubGroupData)){
		foreach($accountData->AccountSubGroupData as $resultLists){
		?>
		<tr style="background: aliceblue;display: none;" class="subgroup<?php echo $resultList->Id; ?>">
			<td style="padding-left: 65px!important;">
				<i onclick="showaccount('<?php echo $resultLists->Id; ?>');" class="fa fa-plus iconPlus"></i>
				<!-- <a onclick="opmodalpop(' Add Account Name','modalpop.php?action=accountnamemaster&groupId=<?php echo $resultLists->Id; ?>&groupName=<?php echo $resultLists->Name; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" style="cursor:pointer;color:#2196f3;"><?php echo $resultLists->Name; ?></a> -->
				<a style="cursor:pointer;color:#2196f3;"><?php echo $resultLists->Name; ?></a>
			</td>
		</tr>

		<?php
		if($resultLists->Id=="LB0003"){
			$rs=GetPageRecord('name,ledgerId',"buyerMaster",'1 and ledgerId!="" and status=1 order by name asc');
			while($datalist=mysqli_fetch_array($rs)){
		?>
			<tr style="background: beige;display: none;" class="account<?php echo $resultLists->Id; ?> mgroup<?php echo $resultList->Id ?>">
			<td style="padding-left: 115px!important;"><?php echo $datalist['name']; ?></td>
		</tr>

		<?php
			}
		}else if($resultLists->Id=="LB0006"){
			$rs=GetPageRecord('name,ledgerId',"suppliersMaster",'1 and ledgerId!="" and status=1 order by name asc');
			while($datalist=mysqli_fetch_array($rs)){
		?>
			<tr style="background: beige;display: none;" class="account<?php echo $resultLists->Id; ?> mgroup<?php echo $resultList->Id ?>">
			<td style="padding-left: 115px!important;"><?php echo $datalist['name']; ?></td>
		</tr>

		<?php
			}
		}else if($resultLists->Id=="LB0002"){
			$rs=GetPageRecord('bankName,ledgerId',"bankDetailsMaster",'1 and ledgerId!="" and status=1 and type="company" order by bankName asc');
			while($datalist=mysqli_fetch_array($rs)){
		?>
			<tr style="background: beige;display: none;" class="account<?php echo $resultLists->Id; ?> mgroup<?php echo $resultList->Id ?>">
			<td style="padding-left: 115px!important;"><?php echo $datalist['bankName']; ?></td>
		</tr>

		<?php
			}
		}else{

		// $Id = $resultLists->Id;
		// $jsonData = '{
		// "GroupId":"'.$Id.'"
		// }';
		// $url = $serverurlapi."masters/accountNameAPI.php";
		// $resultData = postCurlData($url,$jsonData);
		// $accountData = json_decode($resultData);
		// if(isset($accountData->status)=='true'){
		// if(isset($accountData->AccountNameData)){
		// foreach($accountData->AccountNameData as $accountList){
		?>
		<!-- <tr style="background: beige;display: none;" class="account<?php echo $resultLists->Id; ?> mgroup<?php echo $resultList->Id ?>">
			<td style="padding-left: 115px!important;"><?php echo $accountList->AccountName; ?></td>
		</tr> -->
		<?php //} } }
		}
		?>

	<?php } } }

		}
		}
	}
	?>
	</tbody>
</table>
<script>
function showgroup(id) {
    $(".subgroup" + id).show();
    $(".hgroup" + id).show();
    $(".sgroup" + id).hide();
}

function hidegroup(id) {
   $(".subgroup" + id).hide();
   $(".hgroup" + id).hide();
   $(".sgroup" + id).show();
   $(".mgroup" + id).hide();
}

function showaccount(id) {
    $(".account" + id).toggle();
}

// function showSubGroupName(subgroupId){
//     $("#subgroupname").load('loadaccountsubgroup.php?subgroupId='subgroupId)
// }
</script>
</div>
<?php } ?>