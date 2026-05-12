<?php
include "inc.php";
$id=$_REQUEST['id'];
$selectId=$_REQUEST['selectId'];
?>

<option value="">Select</option>
<?php
$select='';
$where='';
$rs='';
$select='*';
if($id!=''){
$id=' and id="'.$id.'" ';
}

$where=' deletestatus=0 and status=1 '.$id.' order by name asc';
$rs=GetPageRecord($select,'assemblyoperationsMaster',$where);
while($resListing=mysqli_fetch_array($rs)){

$newdata = explode(',', $resListing['machineId']);

foreach($newdata as $key => $value) {
$mdmd=GetPageRecord('*','machineMaster','1 and id="'.$value.'"');
$machloadata=mysqli_fetch_array($mdmd);
?>
<option value="<?php echo strip($machloadata['id']); ?>" <?php if($machloadata['id']==$selectId){ ?>selected="selected"<?php } ?>><?php echo strip($machloadata['name']); ?></option>
<?php } } ?>