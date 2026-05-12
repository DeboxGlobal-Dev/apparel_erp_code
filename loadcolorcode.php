<?php
include "inc.php";
include "config/logincheck.php";

$id=$_REQUEST['id'];
$selectId=$_REQUEST['selectId'];
?>
 <option value="">Select</option>
 <?php
$styleColorDetailMasterq=GetPageRecord('colorId','styleColorDetailMaster','1 and styleId="'.$id.'" group by colorId');
while($styleColorDetailMasterData=mysqli_fetch_array($styleColorDetailMasterq)){

$colorLotNameq=GetPageRecord('id,name','colorCardMaster','1 and id="'.$styleColorDetailMasterData['colorId'].'"');
$colorLotName=mysqli_fetch_array($colorLotNameq);

				?>
<option value="<?php echo $colorLotName['id']; ?>" <?php if($colorLotName['id']==$selectId){ ?>selected="selected"<?php } ?>><?php echo $colorLotName['name']; ?></option>
<?php } ?>

