<?php
include "inc.php";
include "config/logincheck.php";

$brandId = trim($_REQUEST['brandId']);
?>
<option value="">Select</option>
<?php
$select='';
$where='';
$rs='';
$select='*';
echo $where='1 and deletestatus=0 and status=1 and brandId="'.$brandId.'" order by name asc';
$rs11=GetPageRecord('name,id,brandId','colorCardMaster',$where);
while($resListing11=mysqli_fetch_array($rs11)){
?>
<option value="<?php echo strip($resListing11['id']); ?>" ><?php echo strip($resListing11['name']); ?></option>
<?php } ?>

