
<?php
include('inc.php');

if($_REQUEST['subgroupId']!=''){

		$subGroupId = $_REQUEST['subgroupId'];
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
				<a href="addAccountName.php"><?php echo $resultLists->Name; ?></a>
			</td>
		</tr>

	<?php } } } ?>
<script>
	function showaccount(id) {
		$(".account" + id).toggle();
	}
</script>
<?php } ?>