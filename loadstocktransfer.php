<?php
include('inc.php');

if($_REQUEST['id']!=''){

$lastId = decode($_REQUEST['id']);
$fromStyle = $_REQUEST['fromStyle'];
$toStyle = $_REQUEST['toStyle'];
$materialTypeId = $_REQUEST['categoryId'];

if($_REQUEST['addsize']==1 && $_REQUEST['id']!='' && $_REQUEST['action']=='addnewrow'){
	$namevalue ='parentId="'.$lastId.'"';
	addlistinggetlastid('stockTransfer',$namevalue);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['rowid']!=''){
	deleteRecord('stockTransfer','id="'.$_REQUEST['rowid'].'"');
}

?>
<?php
$no = 1;
$wherenew='parentId="'.$lastId.'" order by id asc';
$rsnew=GetPageRecord('*','stockTransfer',$wherenew);
while($rslistnew=mysqli_fetch_array($rsnew)){

if($materialType==1){
$where2 = '1 and materialid="1"';
$lotWiseDataFabricq=GetPageRecord('sum(acceptedField) as totalacceptedField','lotWiseData',$where2);
$lotWiseDataFabric=mysqli_fetch_array($lotWiseDataFabricq);
$inspectedQty=$lotWiseDataFabric['totalacceptedField'];

}
if($materialType==2){
$qualityreportmasterDataq=GetPageRecord('sum(accepted) as totalaccepted','1 and materialid="2"');
$qualityreportmasterData=mysqli_fetch_array($qualityreportmasterDataq);
$inspectedQty=$qualityreportmasterData['totalaccepted'];
}
if($materialType==3){

$packagingqualityreportmasterDataq=GetPageRecord('sum(accepted) as totalaccepted','packagingqualityreportmaster','1 and materialid="3"');
$packagingqualityreportmasterData=mysqli_fetch_array($packagingqualityreportmasterDataq);
$inspectedQty=$packagingqualityreportmasterData['totalaccepted'];

}

?>
<tr>
	<td><select id="fromIndentMaterailId<?php echo $rslistnew['id']; ?>" name="fromIndentMaterailId" class="form-control" onchange="savelinedetail<?php echo $rslistnew['id']; ?>();">
		<option value="">Select</option>
		<?php
		$wh = 'styleId="'.$fromStyle.'" and materialType="'.$materialTypeId.'" and costsheetVersionId=1';
		$rsa=GetPageRecord('name,id','styleSubCategoryMaster',$wh);
		while($resultStylea=mysqli_fetch_array($rsa)){
		?>
		<option value="<?php echo $resultStylea['id']; ?>" <?php if($rslistnew['fromIndentMaterailId']==$resultStylea['id']){ echo 'selected'; } ?>><?php echo $resultStylea['name'].$resultStylea['id']; ?></option>
		<?php } ?>
	</select></td>
	<td>
	<select id="toIndentMaterailId<?php echo $rslistnew['id']; ?>" name="toIndentMaterailId" class="form-control" onchange="savelinedetail<?php echo $rslistnew['id']; ?>();">
		<option value="">Select</option>
		<?php
		$rss=GetPageRecord('name,id','styleSubCategoryMaster','styleId="'.$toStyle.'" and materialType="'.$materialTypeId.'" and costsheetVersionId=1');
		while($resultStyle=mysqli_fetch_array($rss)){
		?>
		<option value="<?php echo $resultStyle['id']; ?>" <?php if($rslistnew['toIndentMaterailId']==$resultStyle['id']){ echo 'selected'; } ?>><?php echo $resultStyle['name']; ?></option>
		<?php } ?>
	</select>
	</td>
	<td><input type="text" name="availableQty" id="availableQty<?php echo $rslistnew['id']; ?>" value="<?php $inspectedQty; ?>" class="form-control" onchange="savelinedetail<?php echo $rslistnew['id']; ?>();"  readonly /></td>
	<td><input type="text" name="transferQty" id="transferQty<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['transferQty']; ?>" class="form-control" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();"  /></td>
	<td align="center"></td>
	<td align="center"><a href="javascript:void(0);" onclick="deleterow('<?php echo $rslistnew['id']; ?>');"><i class="icon-trash" style="font-size:13px;cursor:pointer; color:#FF0000;"></i></a></td>
</tr>
<script>
function savelinedetail<?php echo $rslistnew['id']; ?>(){

var fromIndentMaterailId = $('#fromIndentMaterailId<?php echo $rslistnew['id']; ?>').val();
var toIndentMaterailId = $('#toIndentMaterailId<?php echo $rslistnew['id']; ?>').val();
var availableQty = $('#availableQty<?php echo $rslistnew['id']; ?>').val();
var transferQty = $('#transferQty<?php echo $rslistnew['id']; ?>').val();

$('#addcolordetails').load('newaction.php?action=savestocktransferdetail&id=<?php echo $rslistnew['id']; ?>&fromIndentMaterailId='+fromIndentMaterailId+'&toIndentMaterailId='+toIndentMaterailId+'&availableQty='+availableQty+'&transferQty='+transferQty);

}
</script>

<?php $no++; }  ?>

<tr style="display:none;">
<td ><div id="addcolordetails" ></div></td>
</tr>
<?php
if($no==1){
?>
<tr>
	<td colspan="50" style="text-align: center;">No record found.</td>
</tr>
<?php } ?>


<?php } ?>
