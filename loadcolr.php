<?php
include "inc.php";
include "config/logincheck.php";

$id=$_REQUEST['id'];
$selectId=$_REQUEST['sty_id'];
?>
 <!--<option value="">Select</option>-->
 <?php
$styleColorDetailMasterq=GetPageRecord('colorId','styleColorDetailMaster','1 and styleId="'.$selectId.'" group by colorId');
while($styleColorDetailMasterData=mysqli_fetch_array($styleColorDetailMasterq)){

$colorLotNameq=GetPageRecord('id,name','colorCardMaster','1 and id="'.$styleColorDetailMasterData['colorId'].'"');
$colorLotName=mysqli_fetch_array($colorLotNameq);
?>

<option value="<?php echo $colorLotName['name']; ?>" <?php if($colorLotName['name']==$selectId){ ?>selected="selected"<?php } ?>><?php echo $colorLotName['name']; ?></option>
<?php } ?>

