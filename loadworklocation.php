 <?php
include "inc.php";
include "config/logincheck.php";

$empType=$_REQUEST['empType'];
$selectId=$_REQUEST['selectId'];

?>
<option value="">Select</option>
<?php
if($empType!=3){
$kkk=GetPageRecord('*','workplaceMaster','1 order by name asc');
}
else{
$kkk=GetPageRecord('*','workplaceMaster','1 and type=2 order by name asc');
}
while($workplace=mysqli_fetch_array($kkk)){

if($workplace['type']==1){
$type="Office";
}
if($workplace['type']==2){
$type="Factory";
}
?>
<option value="<?php echo strip($workplace['id']); ?>" <?php if($workplace['id']==$selectId){ ?>selected="selected"<?php } ?>><?php echo strip($workplace['name']).' - '.$type; ?></option>
<?php } ?>




